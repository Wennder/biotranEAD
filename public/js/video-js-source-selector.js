/*
Extension to VideoJS by Audun Nystad Bugge
*/
		
VideoJS.player.newBehavior("source_select", function(player){
		this.onPlay(this.volumeHack); // Hack for volume on Opera
	},
	{
		createResolutionControl: function(formats)
		{
			/* Set some utility variables */
			this.current_format = this.current_res = '';
			this.checkCount = 0;
			this.resumeTime = 0;
			this.preferred_formats = ['mp4', 'webm', 'ogg'];
			this.preferred_resolutions = ['480', '360', '320', '720', '1080']
			
			this.activateElement(this, "source_select")
			
			
			this.resolutions = new Object();

			/* formats is an array on the form formats[] = [format, height, type, url], e.g. ['mp4', '720', 'video/mp4; codecs="avc1.64001F, mp4a.40.2"', 'http://example.com/video_720.mp4'] */
			for (var i=0;i<formats.length;i++)
			{
				if (this.video.canPlayType(formats[i][2]))
				{
					if (!$.isPlainObject(this.resolutions[formats[i][0]])) this.resolutions[formats[i][0]] = new Object();
					this.resolutions[formats[i][0]][formats[i][1]] = formats[i][3];
					if ($.inArray(formats[i][0], formats) == '-1') formats.push(formats[i][0]);
				}
			}
			
			/* Load preferred quality */
			this.changeSource('','', false);
			
			/* Create the resolution control */
			this.resolutionControl = _V_.createElement("div", {
				className: "vjs-resolution-control",
				innerHTML: this.createResolutionSelect()
			});
			this.controls.appendChild(this.resolutionControl);
			/* Save some style variables for the resolution control in order to get it back to the pristine state after minimizing the menu */
			this.pristineContainer = $("div.vjs-resolution-control");
			this.pristineContainer_image = this.pristineContainer.css('background-image');
			this.pristineContainer_attachment = this.pristineContainer.css('background-attachment');
			this.resolutionLoadHandlers();
		},
		
		createResolutionSelect: function()
		{
			var html = '<div class="vjs-resolution-selector">';
			for (var i in this.resolutions)
			{
				html += '<div';
				if (i == this.current_format) html += ' class="vjs-resolution-current_format"';
				html += '><div class="vjs-resolution-resolutions"><div class="vjs-resolution-format">'+i+'</div>';
				for (j in this.resolutions[i])
				{
					html += '<div class="vjs-resolution-resolution';
					if (j == this.current_res)
						html += ' vjs-resolution-current_res';
					html += '">'+j+'</div>';
				}
				html += '</div>';
				html += '</div>';
			}
			html += '</div><span class="vjs-resolution-current">'+this.current_res+'</span>';
			
			return html;
		},
		
		/* Set handlers for clicks on the resolution control */
		resolutionLoadHandlers: function()
		{
			/* "this" changes meaning inside the jQuery functions, so we keep it as "obj" instead.. */
			obj = this;
			current = $("span.vjs-resolution-current");
			/* Listen for clicks on the resolution button */
			current.click(function(e)
			{
				var menu = $(".vjs-resolution-selector");
				var container = $("div.vjs-resolution-control");
				
				if (menu.css('display') == 'none')
				{
					container.css('background', obj.pristineContainer.css('background-color'));
					menu.css('height', 'auto');
					$(".vjs-resolution-selector div div div").not(".vjs-resolution-current_format div").not(".vjs-resolution-format").hide();
					var menuHeight = menu.height();
					var containerHeight = container.height();
					var menuTop = -menu.height();
					menu.css('height', 0);
					menu.css('top', -containerHeight+'px');
					$(".vjs-resolution-selector :first-child").css('border-radius', '5px 5px 0 0');
					$(".vjs-resolution-selector :first-child").css('-webkit-border-radius', '5px 5px 0 0');
					$(".vjs-resolution-selector :first-child").css('-moz-border-radius', '5px 5px 0 0');
					current.css('position', 'absolute');
// 					menu.animate({height: menuHeight+'px', top: (menuTop-containerHeight)+'px'}, 100);
					container.animate({height: (menuHeight+containerHeight)+'px', top: 5-menuHeight+'px'}, 100);
					menu.show();
				}
				else
				{
					container.css('background', '');
					container.css('background-color', obj.pristineContainer.css('background-color'));
					container.css('background-image', obj.pristineContainer_image);
					var containerHeight = $('div.vjs-fullscreen-control').css('height');
					menu.animate({height: 0, top: '-'+containerHeight}, 100, function(){ menu.hide(); });
					container.animate({height: containerHeight, top: 5 }, 100);
				}
			});
			
			/* Change resolution */
			$("div.vjs-resolution-resolution").click(function(e)
			{
				$("span.vjs-resolution-current").click();
				var res = $(e.target).text();
				obj.changeSource(obj.current_format,res, true);
				$(".vjs-resolution-current_res").removeClass("vjs-resolution-current_res");
				$(e.target).addClass("vjs-resolution-current_res");
				current.text(obj.current_res);
			});
			
			/* Change format */
			$("div.vjs-resolution-format").click(function(e)
			{
				current.click();
				var format = $(e.target).text();
				var res = obj.current_res;
				obj.changeSource(format, obj.current_res, true);
				$(".vjs-resolution-control").html(obj.createResolutionSelect());
				obj.resolutionLoadHandlers();
			});
		},

		changeSource: function(format, res, resume)
		{
			this.resumeVolume = this.volume();
			this.videoWasPlaying = !this.video.paused;
			this.pause();
			
			this.resumeTime = this.video.currentTime-0.5;
			if (this.resumeTime < 0) this.resumeTime = 0;
			this.showSpinners();
			if (!this.resolutions[format])
			{
				// No or invalid format given, pick the first available format from the list of preferred formats
				failed = true;
				for (f in this.preferred_formats) {
					format = this.preferred_formats[f];
					if (this.resolutions[format])
					{
						failed = false;
						break;
					}
				}
				if (failed) {
					/* Pick first available format */
					for (format in this.resolutions) break; 
				}
			}
			if (!this.resolutions[format][res])
			{
				// No or invalid resolutions selected, pick the first available resolution from the list of available resolutions
				failed = true;
				for (r in this.preferred_resolutions) {
					res = this.preferred_resolutions[r];
					if (this.resolutions[format][res]) {
						failed = false; break;
					}
				}
				if (failed) {
					if (this.resolutions[format]) {
						/* Just pick the first res in the chosen format */
						for (res in this.resolutions[format]) { failed=false; break; }
					}
				}
			}
			this.current_res = res;
			this.current_format = format;
			this.video.src = this.resolutions[format][res];
			
			if (!resume) return;
			this.video.load();
			
			this.percentLoaded = 0;
			this.trackBuffered();
// 			this.updateLoadProgress();
			this.checkResume();
		},
		
		/* Check if the video is loaded and ready to resume playing */
		checkResume: function()
		{
			this.checkCount++;
			if (this.checkCount > 200){ this.checkCount=0; this.video.load(); this.play(); return; }
			if (this.video.readyState < this.video.HAVE_METADATA) setTimeout(this.checkResume.context(this), 40);
			else {
				this.checkCount=0; 
				this.currentTime(this.resumeTime);
				if (this.videoWasPlaying) this.play();
			}
		},
		
		/* A bug in opera 11.50 forces us to actually change the volume to make it have any effect */
		volumeHack: function(event)
		{
			if (window.opera)
			{
				volume = this.values.volume
				if (volume > 0.5)
					volume -= 0.001;
				else
					volume += 0.001;
				this.volume(volume);
			}
		}
	}
);