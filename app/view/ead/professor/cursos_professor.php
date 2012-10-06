<?php require ROOT_PATH.'/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH.'/app/view/ead/structure/leftcolumn.php'; ?>
<?php require ROOT_PATH.'/app/view/ead/structure/content.php'; ?>

<script src="js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>


<script> $(document).ready(function(){
    
        //On click any <h3> within the container
//        $('.accord').click(function(e) {
//
//            //Close all <div> but the <div> right after the clicked <a>
//            //$(e.target).next('div').siblings('div').slideUp('fast');
//            
//            //Toggle open/close on the <div> after the <h3>, opening it if not open.
//            $(e.target).next('.accord_content').slideToggle('fast');
//          
//        });
    });</script>

<style>
    ul{
        list-style: none;
    }

    .accord_content{
        display:none;
        box-shadow: 0px 2px 2px #eeeeee inset;
    -moz-box-shadow: 0px 2px 2px #eeeeee inset;
    -webkit-box-shadow: 0px 2px 2px #eeeeee inset;
    }

    .accord{
        border-bottom:1px solid #eeeeee;
        border-top:1px solid #fefefe;
        background-color: #fafafa;
    }
    .accord *{
        cursor: pointer;
        
        z-index: 8;
    }

    .lista_cursos_professor{
        padding:0px 20px;
    }
    .lista_cursos_professor a:hover{
        color:#565656;
        cursor: pointer;
    }

    
    .list_conteudo{
        border-bottom:1px solid #eeeeee;
        border-top:1px solid #fefefe;
        background-color: #fafafa;
    }
    
    
    .seta_formatacao{
        margin:7px 7px 0px 5px;
        float:left;
    }
    
    #meus_cursos{
         background: #ffffff;
z-index: 90;
        border: 1px solid #e7e7e7;
        border-top:1px solid #f6f6f6;
        padding: 5px 12px 10px 12px;;
        box-shadow: 0px 3px 3px #eeeeee ;
    -moz-box-shadow: 0px 3px 3px #eeeeee ;
    -webkit-box-shadow: 0px 3px 3px #eeeeee ;
    overflow: auto;
    }
    
    #meus_cursos h3:first-letter{
        font-weight: bolder;
    }
</style>
<div>
    <div id="meus_cursos"><div style="">
        <h3>Meus Cursos</h3></div>
    <div style="padding: 1px 10px; z-index: 10;">
    <?php echo $this->lista; ?>
    </div>
    </div>
</div>
