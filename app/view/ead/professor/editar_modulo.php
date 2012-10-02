<!--<script src="js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>-->
<script src="js/accordion.js" type="text/javascript"></script>

<style>

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
<script src="js/jquery-ui-1.8.2.min.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.24.custom.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/jquery-ui-1.8.24.custom.css" type="text/css"/>
<script>
    
    $(function() {                
        //Se clicar no link, redireciona
        $("#accordion_body2 div ul li h3").click(function() {
            alert($(this).attr('id'));
            $('#dialog').load($(this).attr('id'), 'oi', function (){   
               var dialog = $(this).dialog({
                    width:800, 
                    height:300,
                    dialogClass:'dialogstyle',
                    modal: true,                    
                    close: function(event,ui){                                           
                        dialog.dialog('destroy');
                        dialog.find('div').remove();
                    }                  
                });                            
            });       
        });             
    }); 
    
</script>

<div id="dialog" style="display:none">
    
</div>

<div id="div_conteudo_professor_editar_modulo">
    <h1>Modulo <?php echo $this->modulo->getNumero_modulo() ?>: <?php echo $this->modulo->getTitulo_modulo() ?></h1>
    <div id="disposicao_conteudo_professor_editar_modulo">
        <h4>Descricao: </h4>
        <div class="quadro_de_conteudo_especifico">
            <?php echo $this->modulo->getDescricao() ?>
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
                        <div id="accordion_body2" class="accordion_body">
                            <div class='list_index_admin_blue'>
                                <a><div class='detalhe1'></div>
                                    <img  src='img/seta_blue.png' />Video Aulas
                                </a>
                            </div>
                            <div>
                                <ul>
                                    <li>
                                        <h3  id="index.php?c=ead&a=adicionar_videoaula&id=<?php echo $this->modulo->getId_modulo(); ?>">Adicionar nova video aula</h3>
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
                                        <a href="index.php?c=ead&a=adicionar_texto_referencia&id=<?php echo $this->modulo->getId_modulo(); ?>">Adicionar novo texto de referencia</a>
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
                                        <a href="index.php?c=ead&a=adicionar_material_complementar&id=<?php echo $this->modulo->getId_modulo(); ?>">Adicionar nova material complementar</a>
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
                                        <a href="index.php?c=ead&a=adicionar_exercicio&id=<?php echo $this->modulo->getId_modulo(); ?>">Adicionar nova exercicio</a>
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
