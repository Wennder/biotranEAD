<?php require 'structure/header.php'; ?>
<?php require 'structure/leftcolumn_aluno_home.php';?>
<?php require 'structure/content.php'; ?>

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
    <label>Exibir: </label>
    <select>
        <option value="Todos" onclick="todos()">Todos</option>
        <option value="Matriculado" onclick="matriculados()" >Matriculado</option>
        <option value="Não Matriculado" onclick="nao_matriculados()">Não Matriculado</option>
    </select>
    </br>
</div>

<div id="cursos_aluno">
    <?php $controllerCurso = new controllerCurso(); 
    echo $controllerCurso->cursosAluno(); ?>
</div>

<?php require 'structure/footer.php'; ?>