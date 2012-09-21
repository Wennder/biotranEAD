<?php require 'structure/header.php'; ?>
<?php require 'structure/leftcolumn_professor_curso.php' ?>
<?php require 'structure/content.php'; ?>

<script src="js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
<script>
    $(function() {
        $( ".menu_accordion" ).accordion({
            active: false,
            //            animated: 'bounceslice',
            //            clearStyle: true,
            //            fillSpace: true,
            autoHeight: false,
            navigation: true,
            collapsible: false
        });
    });
</script>
<style>
    #div_conteudo_professor_editar_modulo{
        position: relative;
        padding:40px;
        padding-top:0px;
    }

    #div_conteudo_professor_editar_modulo h4{
        margin:0;

        padding:0;
    }

    #disposicao_conteudo_professor_editar_modulo{
        position: relative;
        margin: 20px;
        margin-top:40px;
    }


    .quadro_de_conteudo_especifico{
        margin:0px;
        margin-bottom:20px;
        border:1px solid #CCCCCC;
        padding: 10px;
        color: #888888;
    }

    .quadro_de_conteudo_especifico ul{
        margin:0;
        padding: 0;
    }

    .quadro_de_conteudo_especifico ul li{
        list-style: none;
        color: #888888;
        background-color: #eeeeee;
        border:1px solid #CCCCCC;
        padding:4px;
    }

    .quadro_de_conteudo_especifico ul li:hover{
        border:1px solid black;

    }

    .quadro_de_conteudo_especifico ul a:hover,a:active,a:visited{
        text-decoration: none;
        outline: none;

    }
</style>

<div id="div_conteudo_professor_editar_modulo">
    <h1>Título do Módulo</h1>
    <div id="disposicao_conteudo_professor_editar_modulo">
        <h4>Descricao: </h4>
        <div class="quadro_de_conteudo_especifico">
            Modulo muito bacana!
        </div>
        <h4>Conteudo: </h4>
        <div class="menu_accordion">
            <p>
                <a>Video Aulas</a>
            </p>
            <div>
                <ul>
                    <li>
                        <a href="index.php?c=ead&a=adicionar_videoaula">Adicionar nova video aula</a>
                    </li>
                    <li>
                        <a style="float:left; margin-right: 3px;">Video 1</a>
                    </li>
                    <li>
                        <a style="float:left; margin-right: 3px;">Video 2</a>
                    </li>
                </ul>
            </div>
            <p>
                <a>Texto de Referencia</a>
            </p>
            <div>
                <ul>
                    <li>
                        <a style="float:left; margin-right: 3px;">Adicionar novo texto de referencia</a>
                    </li>
                    <li>
                        <a style="float:left; margin-right: 3px;">Texto 1</a>
                    </li>
                    <li>
                        <a style="float:left; margin-right: 3px;">Texto 2</a>
                    </li>
                </ul>
            </div>
            <p>
                <a>Material Complementar</a>
            </p>
            <div>
                <ul>
                    <li>
                        <a style="float:left; margin-right: 3px;">Adicionar novo material complementar</a>
                    </li>
                    <li>
                        <a style="float:left; margin-right: 3px;">Material 1</a>
                    </li>
                    <li>
                        <a style="float:left; margin-right: 3px;">Material 2</a>
                        </li>
                    </ul>
                </div>
                <p>
                    <a>Exercicios</a>
                </p>
                <div>
                    <ul style="list-style-type:none;">
                        <li>
                            <p>
                                <a style="float:left; margin-right: 3px;">Adicionar novo exercicio</a>
                            </p>
                        </li>
                        <li>
                            <p>
                                <a style="float:left; margin-right: 3px;">Exercicio 1</a>
                            </p>
                        </li>
                        <li>
                            <p>
                                <a style="float:left; margin-right: 3px;">Exercicio 2</a>
                            </p>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <?php require 'structure/footer.php'; ?>
