<?php require ROOT_PATH.'/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH.'/app/view/ead/structure/leftcolumn.php'; ?>
<?php require ROOT_PATH.'/app/view/ead/structure/content.php'; ?>

<script src="js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
<script src="js/accordion.js" type="text/javascript"></script>
<style>
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
<div class="accordion_body">
    <?php echo $this->lista; ?>
</div>
