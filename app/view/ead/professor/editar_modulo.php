
<!--<script src="js/accordion.js" type="text/javascript"></script>-->
<script src="js/jquery-ui-1.8.24.custom.min.js" type="text/javascript"></script>
<link href="css/jquery-ui-1.8.24.custom.css" rel="stylesheet" type="text/css"/>        
<link href="css/jquery.dialog.css" rel="stylesheet" type="text/css"/>        
<script type="text/javascript" src="http://malsup.github.com/jquery.form.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
<style>
    @import "http://code.jquery.com/ui/1.8.23/themes/base/jquery-ui.css";
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

<script>    
    $(document).ready(function() {                                                        
        _V_.options.flash.swf = "video-js.swf";              
        
        $(".btn_add").live('click', function(){
            var btn = $(this);
            $('#dialog').load(btn.attr('id'), 'oi', function (){
                var width = 0;
                var height = 0;                  
                var tipo = btn.attr('name');
                if(tipo == 'video'){
                    width = 800;height = 350;
                }else{
                    if(tipo == 'texto'){
                        width = 500;height = 250;
                    }else{
                        if(tipo == 'material'){
                            width = 500;height = 200;
                        }else{//novo exercício
                            width = 500;
                            height = 200;
                        }
                    }
                }                                
                var options = {
                    width:width, 
                    height:height,
                    dialogClass:'dialogstyle',
                    modal: true,
                    open: function(event,ui){                        
                        var form = $('#dialog').find('#form_cadastrar');
                        form.ajaxForm({
                            uploadProgress: function(event, position, total, percentComplete) {
                                $('progress').attr('value',percentComplete);
                                $('#porcentagem').html(percentComplete+'%');
                            },                            
                            success: function(data) {                
                                $('progress').attr('value','100');
                                $('#porcentagem').html('100%');
                                $('pre').html(data);
                                if(data == 1){               
                                    alert('Dados atualizados');
                                    dialog.dialog('close');
                                }                       
                            }                    
                        });
                    },
                    close: function(event,ui){                     
                        dialog.dialog('destroy');
                        dialog.find('div').remove();
                    }                  
                   
                }
                var dialog = $(this).dialog(options);
            });
            
        });
        
        //        $("#accordion_body2 .accordion_body .add li h3").live('click',function() {            
        //            console.log(dialog);
        //        });             
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
        <div class="quadro_de_conteudo_especifico">
        </div>

        <div class="accordion_body">
            <div class='list_index_admin_gray' style='margin-top:0px;'>
                <a><div class='detalhe'></div>
                    <img class='seta_formatacao' src='img/seta_gray.png' />Conteudo
                </a>
            </div>
            <div id="accordion_body2">
                <ul>
                    <li>
                        <div class="accordion_body">
                            <div class='list_index_admin_blue'>
                                <a><div class='detalhe1'></div>
                                    <img  src='img/seta_blue.png' />Video Aulas
                                </a>
                            </div>                            
                            <div id="lista_video">                                                                
                                <ul class="add">
                                    <?php echo $this->listaVideo; ?>
                                    <li>
                                        <input type="button" class="btn_add" name="video" id="index.php?c=ead&a=adicionar_videoaula&id=<?php echo $this->modulo->getId_modulo(); ?>" value="novo"/>
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
                            <div class="add">
                                <ul>
                                    <?php echo $this->listaTexto; ?>
                                    <li>
                                        <input type="button" class="btn_add" name="texto" id="index.php?c=ead&a=adicionar_texto_referencia&id=<?php echo $this->modulo->getId_modulo(); ?>" value="novo"/>
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

                            <div class="add">
                                <ul>
                                    <?php echo $this->listaMaterial; ?>
                                    <li>
                                        <input type="button" class="btn_add" name="material" id="index.php?c=ead&a=adicionar_material_complementar&id=<?php echo $this->modulo->getId_modulo(); ?>" value="novo"/>
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

                            <div class="add">
                                <ul>
                                    <li>
                                        <input type="button" class="btn_add" name="exercicio" id="index.php?c=ead&a=adicionar_exercicio&id=<?php echo $this->modulo->getId_modulo(); ?>" value="novo"/>
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
