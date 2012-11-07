<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php' ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>
<script src="js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
<script src="js/accordion_1.js" type="text/javascript"></script>

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
    
    function em_construcao(){
        alert('Em construcao!');
    }
    
    $('#matricular').live('click', function(){
        var id = $(this).attr('name');
        document.location = 'index.php?a=curso&c=ead&id='+id;
//        var id_estudante = $('#id_usuario').val();
//        var id_curso = $(this).attr('name');
//        $.getJSON('ajax/avaliar_curso.php', {id_curso: id_curso, acao:'submeter_analise'}, function(j){
//            if(j == 1){
//                alert('enviado com sucesso');
//                $('#div_env_analise').remove();
//            }else{
//                alert('erro ao enviar, tente novamente');
//            }
//        });
    });

</script>


<style>
    #cursos_aluno *{
        background-color: #eeeeee;
        color: #333333;
    }

    #meus_cursos{
        background: #ffffff;
        /*       
            background: -webkit-gradient(linear, left top, left bottom, from(#fafafa), to(#f0f0f0));
            background: -webkit-linear-gradient(top, #fafafa, #f0f0f0);
            background: -moz-linear-gradient(top, #fafafa, #f0f0f0);
            background: -ms-linear-gradient(top, #fafafa, #f0f0f0);
            background: -o-linear-gradient(top, #fafafa, #f0f0f0);
            background: linear-gradient(top, #fafafa, #f0f0f0);*/
        border: 1px solid #e7e7e7;
        border-top:1px solid #f6f6f6;
        padding: 5px 12px;
        box-shadow: 0px 3px 3px #eeeeee ;
        -moz-box-shadow: 0px 3px 3px #eeeeee ;
        -webkit-box-shadow: 0px 3px 3px #eeeeee ;
    }
    
    .detalhe{
        position: relative;
        height:1px;
        background-color: white;
    }

    .lista_cursos{
        border-bottom:1px solid #eeeeee;
        border-top:1px solid #fefefe;
        background-color: #fafafa;
    }

    .aluno_cursos{
        padding:2px;
        box-shadow: 0px 2px 2px #eeeeee inset;
        -moz-box-shadow: 0px 2px 2px #eeeeee inset;
        -webkit-box-shadow: 0px 2px 2px #eeeeee inset;
    }
   
    
    #meus_cursos h3:first-letter{
        font-weight: bolder;
    }
</style>

<div id="meus_cursos"><div style="">
        <h3>Cursos</h3></div>

    <div class="">
        <?php $controllerCurso = new controllerCurso();
        echo $controllerCurso->cursosAluno();
        ?>
    </div>
    
    <div id="div_inputhidden" style="display:none"> 
        <input type="text" id="id_usuario" value="<?php echo $this->usuario->getId_usuario()?>"/>
    </div>
    
</div>
<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>