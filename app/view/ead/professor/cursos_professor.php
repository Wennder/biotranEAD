<?php require ROOT_PATH.'/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH.'/app/view/ead/structure/leftcolumn.php'; ?>
<?php require ROOT_PATH.'/app/view/ead/structure/content.php'; ?>

<script src="js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
<!--<script src="js/accordion.js" type="text/javascript"></script>-->

<script> $(document).ready(function(){
        //On click any <h3> within the container
        $('.accord').click(function(e) {

            //Close all <div> but the <div> right after the clicked <a>
            //$(e.target).next('div').siblings('div').slideUp('fast');
            
            //Toggle open/close on the <div> after the <h3>, opening it if not open.
            $(e.target).next('.accord_content').slideToggle('fast');
          
        });
    });</script>

<style>
    ul{
        list-style: none;
    }

    .accord_content{
        display: none;
    }

    .accord{
        background-color: #eeeeee;
        border-top:1px solid white;
        border-bottom: 1px solid #cccccc;
        
        z-index: 10;
        cursor: pointer;
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

    .seta_formatacao{
        margin:7px 7px 0px 5px;
        float:left;
    }
</style>
<div>
    <?php echo $this->lista; ?>
</div>
