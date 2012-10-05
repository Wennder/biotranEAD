<?php require ROOT_PATH.'/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH.'/app/view/ead/structure/leftcolumn.php' ?>
<?php require ROOT_PATH.'/app/view/ead/structure/content.php'; ?>
<!--<script src="js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>-->
<!--<script src="js/accordion.js" type="text/javascript"></script>-->

<script>
    function todos(){
        $(".matriculado").show();
        $(".nao_matriculado").show();
    }
    
    function matriculados(){
        $(".matriculado").show();
        $(".nao_matriculado").hide();
    }

    function nao_matriculados(){
        $(".nao_matriculado").show();
        $(".matriculado").hide();
    }

</script>


<style>
    #cursos_aluno *{
        background-color: #eeeeee;
        color: #333333;
    }
    
    .detalhe{
        position: relative;
        height:1px;
        background-color: white;
    }
</style>

<div id="cursos_top_bar">
    <h2 align="center">CURSOS</h2>
    </br>
</div>

<div class="accordion_body">
    <?php $controllerCurso = new controllerCurso(); 
    echo $controllerCurso->cursosAluno(); ?>
</div>

<?php require ROOT_PATH.'/app/view/ead/structure/footer.php'; ?>