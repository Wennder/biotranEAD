/*
Extension to VideoJS by Audun Nystad Bugge
*/

var Video = VideoJS.extend({

	init: function(element, setOptions){
		this._super(element, setOptions);
		// Set some utility variables
		this.current_format = this.current_res = '';
		this.checkCount = 0;
		this.resumeTime = 0;
	},
	
	createResolutionControl: function(resolutions)
	{
		// Create the resolution control
		this.resolutions = resolutions;
		this.resolutionControl = _V_.createElement("li", {
			className: "vjs-resolution-control",
			innerHTML: this.createResolutionSelect()
		});
		this.controls.appendChild(this.resolutionControl);
		// Save some style variables for the resolution control in order to get it back to the pristine state after minimizing the menu
		this.pristineContainer = $("li.vjs-resolution-control");
		this.pristineContainer_image = this.pristineContainer.css('background-image');
		this.pristineContainer_attachment = this.pristineContainer.css('background-attachment');
		this.resolutionLoadHandlers();
	},
	
	createResolutionSelect: function()
	{
		var html = '<ul class="vjs-resolution-selector">';
		for (var i in this.resolutions)
		{
			html += '<li';
			if (i == this.current_format) html += ' class="vjs-resolution-current_format"';
			html += '><ul class="vjs-resolution-resolutions"><li class="vjs-resolution-format">'+i+'</li>';
			for (j in this.resolutions[i])
			{
				html += '<li class="vjs-resolution-resolution';
				if (j == this.current_res)
					html += ' vjs-resolution-current_res';
				html += '">'+j+'</li>';
			}
			html += '</ul>';
			html += '</li>';
		}
		html += '</ul><span class="vjs-resolution-current">'+this.current_res+'</span>';
		
		return html;
	},
	
	// Set handlers for clicks on the resolution control
	resolutionLoadHandlers: function()
	{
		// "this" changes meaning inside the jQuery functions, so we keep it as "obj" instead..
		obj = this;
		// Listen for clicks on the resolution button
		$("span.vjs-resolution-current").click(function(e)
		{
			var menu = $(".vjs-resolution-selector");
			var container = $("li.vjs-resolution-control");
			if (menu.css('display') == 'none')
			{
				container.css('background', obj.pristineContainer.css('background-color'));
				menu.css('height', 'auto');
				$(".vjs-resolution-selector li li").not(".vjs-resolution-current_format li").not(".vjs-resolution-format").hide();
				var menuHeight = menu.height()
				var containerHeight = container.height();
				var menuTop = -menu.height();
				menu.css('height', 0);
				menu.css('top', -containerHeight+'px');
				$(".vjs-resolution-selector :first-child").css('border-radius', '5px 5px 0 0');
				$(".vjs-resolution-selector :first-child").css('-webkit-border-radius', '5px 5px 0 0');
				$(".vjs-resolution-selector :first-child").css('-moz-border-radius', '5px 5px 0 0');
				menu.animate({height: menuHeight+'px', top: menuTop-containerHeight+'px'}, 100);
				container.animate({height: menuHeight+containerHeight+'px', top: -menuHeight+'px'}, 100);
			}
			else
			{
				container.css('background', '');
				container.css('background-color', obj.pristineContainer.css('background-color'));
				container.css('background-image', obj.pristineContainer_image);
				var containerHeight = $('li.vjs-fullscreen-control').css('height');
				menu.animate({height: 0, top: -containerHeight}, 100, function(){ menu.hide(); });
				container.animate({height: containerHeight, top: 0 }, 100);
			}
		});
		
		// Change resolution
		$("li.vjs-resolution-resolution").click(function(e)
		{
			$("span.vjs-resolution-current").click();
			var res = $(e.target).text();
			obj.resumeTime = obj.video.currentTime / obj.video.duration;
			obj.showSpinner();
			obj.video.src = obj.resolutions[obj.current_format][res];
			obj.checkResume();
			$(".vjs-resolution-current_res").removeClass("vjs-resolution-current_res");
			$(e.target).addClass("vjs-resolution-current_res");
			$(".vjs-resolution-current").text(res);
			obj.current_res = res;
		});
		
		// Change format
		$("li.vjs-resolution-format").click(function(e)
		{
			$("span.vjs-resolution-current").click();
			var format = $(e.target).text();
			var res = obj.current_res;
			obj.resumeTime = obj.video.currentTime / obj.video.duration;
			if (!obj.resolutions[format][res])
				for (i in obj.resolutions[format]) { res = obj.resolutions[format][i]; break; }
			obj.showSpinner();
			obj.video.src = obj.resolutions[format][res];
			obj.checkResume();
			obj.current_res = res;
			obj.current_format = format;
			$(".vjs-resolution-control").html(obj.createResolutionSelect());
			obj.resolutionLoadHandlers();
		});
	},
	
	// Check if the video is loaded and ready to resume playing
	checkResume: function()
	{
		this.checkCount++;
		if (this.checkCount > 200){ this.checkCount=0; this.video.load(); this.play(); return; }
		// Javascript does not play well with setTimeout and objects, hence the weirdness in the following two lines
		myContext = this;
		// HAVE_METADATA seems to be enough, but better safe then sorry
 		if (this.video.readyState < this.video.HAVE_FUTURE_DATA) setTimeout(function(){ myContext.checkResume.apply(myContext); }, 20);
		else { this.checkCount=0; this.setPlayProgress(this.resumeTime); this.play(); }
	}
});

$(function(){
	var vid = new Video('video-element');
	
	var resolutions = new Object();
	// formats is an array on the form formats[] = [format, height, type, url], e.g. ['mp4', '720', 'video/mp4; codecs="avc1.64001F, mp4a.40.2"', 'http://example.com/video_720.mp4']
	for (var i=0;i<formats.length;i++)
	{
		if (vid.video.canPlayType(formats[i][2]))
		{
			if (!$.isPlainObject(resolutions[formats[i][0]])) resolutions[formats[i][0]] = new Object();
			resolutions[formats[i][0]][formats[i][1]] = formats[i][3];
			if (vid.firstPlayableSource.src == formats[i][3])
			{
				vid.current_format = formats[i][0];
				vid.current_res = formats[i][1];
			}
			if ($.inArray(formats[i][0], formats) == '-1') formats.push(formats[i][0]);
		}
	}
	vid.createResolutionControl(resolutions);
});