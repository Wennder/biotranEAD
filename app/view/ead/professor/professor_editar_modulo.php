<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php' ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>

<script src="js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
<script src="js/accordion.js" type="text/javascript"></script>
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
<?php
if (isset($_GET['id'])) {
    $id_modulo = $_GET['id'];
}
$moduloDAO = new ModuloDAO();
$this->modulos = $moduloDAO->select("id_modulo=" . $id_modulo);
?>

<div id="div_conteudo_professor_editar_modulo">
    <h1>Modulo <?php echo $this->modulos[0]->getNumero_modulo() ?>: <?php echo $this->modulos[0]->getTitulo_modulo() ?></h1>
    <div id="disposicao_conteudo_professor_editar_modulo">
        <h4>Descricao: </h4>
        <div class="quadro_de_conteudo_especifico">
            <?php echo $this->modulos[0]->getDescricao() ?>
        </div>

        <div class="accordion_body">
            <div class='list_index_admin_gray' style='margin-top:0px;'>
                <a><div class='detalhe'></div>
                    <img class='seta_formatacao' src='img/seta_gray.png' />Conteudo
                </a>
            </div>
            <div>
                <ul>
                    <li>
                        <div class="accordion_body">
                            <div class='list_index_admin_blue'>
                                <a><div class='detalhe1'></div>
                                    <img  src='img/seta_blue.png' />Video Aulas
                                </a>
                            </div>
                            <div>
                                <ul>
                                    <li>
                                        <a href="index.php?c=ead&a=adicionar_videoaula&id=<?php echo $id_modulo ?>">Adicionar nova video aula</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="accordion_body">
                            <div class='list_index_admin_blue'>
                                <a><div class='detalhe1'></div>
                                    <img  src='img/seta_blue.png' />Textos de Referencia
                                </a>
                            </div>
                            <div>
                                <ul>
                                    <li>
                                        <a href="index.php?c=ead&a=adicionar_texto_referencia&id=<?php echo $id_modulo ?>">Adicionar novo texto de referencia</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="accordion_body">
                            <div class='list_index_admin_blue'>
                                <a><div class='detalhe1'></div>
                                    <img  src='img/seta_blue.png' />Material Complementar
                                </a>
                            </div>
                            <div>
                                <ul>
                                    <li>
                                        <a href="index.php?c=ead&a=adicionar_material_complementar&id=<?php echo $id_modulo ?>">Adicionar nova material complementar</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="accordion_body">
                            <div class='list_index_admin_blue'>
                                <a><div class='detalhe1'></div>
                                    <img  src='img/seta_blue.png' />Exercicios
                                </a>
                            </div>
                            <div>
                                <ul>
                                    <li>
                                        <a href="index.php?c=ead&a=adicionar_exercicio&id=<?php echo $id_modulo ?>">Adicionar nova exercicio</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>
