<style>
    /*@import "http://code.jquery.com/ui/1.8.24/themes/base/jquery-ui.css";*/
    .quadro_de_conteudo_especifico{
        margin:0px;
        margin-bottom:20px;
        border:0px solid #eeeeee;
        padding: 10px;
        color: #888888;
        box-shadow: 0px 2px 3px #eeeeee inset;
        -moz-box-shadow: 0px 2px 3px #eeeeee inset;
        -webkit-box-shadow: 0px 2px 3px #eeeeee inset;
    }

    ul{
        list-style: none;
    }

    .quadro_de_conteudo_especifico ul{
        margin:0;
        padding: 0;
        list-style: none;
    }

    .quadro_de_conteudo_especifico ul li{
        color: #888888;
        background-color: #eeeeee;
        border:1px solid #e0e0e0;
        padding:4px;
    }

    .quadro_de_conteudo_especifico ul li:hover{
        border:1px solid black;

    }

    .quadro_de_conteudo_especifico ul a:hover,a:active,a:visited{
        text-decoration: none;
        outline: none;

    }

    #disposicao_conteudo_professor_editar_modulo{
        padding:20px;
    }

    .btn_resolver_exe{
        float:right;
        background-image: url('img/document_edit.png');
        background-repeat: no-repeat;
        background-position: left;
        padding-left: 24px;
        margin-left:8px;
    }

    .list_conteudo{
        border-bottom:1px solid #eeeeee;
        border-top:1px solid #fefefe;
        background-color: #fafafa;
    }


    .list_conteudo:first-letter{
        font-weight: 600;
    }

    .list_conteudo img{
        float:left; margin-right: 5px;
    }

    #titulo_modulo{
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





    .conteudo_row{
        overflow: auto;
        padding:1px 10px;
        border-bottom:1px solid #f2f2f2;
        border-top:1px solid #f2f2f2;
        cursor:pointer;
    }

    .conteudo_row h3{
        float:left;
        font-size:18px;
        font-weight: 600;
        line-height: 38px;
    }

</style>

<script> 
        
    $(document).ready(function() {                                                                                                                           
    });            
            
    $('#btn_editar_modulo').click(function(){
        if($(this).attr('value') == 'Editar'){
            $('#titulo_modulo').removeAttr('readonly');
            $('#descricao').removeAttr('readonly');
            $('#div_atualizar_modulo').removeAttr('style');
            $(this).attr('value', 'Cancelar');            
        }else{
            $('#titulo_modulo').attr('readonly', 'true');
            $('#descricao').attr('readonly', 'true');
            $('#div_atualizar_modulo').attr('style', 'display:none;');
            $(this).attr('value', 'Editar');
        }
    });
    
    $('#btn_atualizar_modulo').click(function(){
        $.post('ajax/crud_conteudo_modulo.php?acao=atualizar_descritivo&id='+$('#id_modulo').val(), $('#form_descritivo').serialize(), function(json) {
            // handle response
            if(json != false){
                $('#titulo_modulo').attr('readonly', 'true');
                $('#descricao').attr('readonly', 'true');
                $('#div_atualizar_modulo').attr('style', 'display:none;');
                $('#btn_editar_modulo').attr('value', 'Editar');
                alert('Dados atualizados');
            }                                                                
        }, "json");                
    });        
    
</script>

<div id="div_conteudo_estudante_modulo">
    <div id="titulo_modulos"><h1>Modulo <?php echo $this->modulo->getNumero_modulo() ?></h1>
        <form id="form_descritivo">
            <h4>Titulo: </h4>        
            <input readonly="true" id="titulo_modulo" type="text" name="titulo_modulo" value="<?php echo $this->modulo->getTitulo_modulo(); ?>" />
            <h4>Descricao: </h4>        
            <textarea readonly="true" type="text" id="descricao" name="descricao"><?php echo $this->modulo->getDescricao() ?></textarea>                           
        </form>    
        <div id="disposicao_conteudo_professor_editar_modulo">
            <div class="">            
                <div class="accord_body">
                    <div id="div_conteudo_video" class='list_conteudo accord_body'>
                        <img src="img/movie.png" style="float:left;" />Video Aulas
                    </div>      
                </div>
                <div class="accord_content_body" style="display:none;">                                                                
                    <ul id="lista_video" class="ul_lista">                                    
                        <?php echo $this->listaVideo; ?>                                    
                    </ul>
                </div>
                <div class="accord_body">
                    <div id="div_conteudo_texto_referencia" class='list_conteudo accord_body'>
                        <img src="img/text_enriched.png" />Textos de Referencia
                    </div>
                </div>
                <div class="add accord_content_body" style="display:none;">
                    <ul id="lista_texto_referencia" class="ul_lista">
                        <?php echo $this->listaTexto; ?>
                    </ul>
                </div>
                <div class="accord_body">
                    <div id="div_conteudo_material_complementar" class='list_conteudo accord_body'>
                        <img src="img/folder-icon.png"/>Material Complementar
                    </div>
                </div>
                <div class="add accord_content_body" style="display:none;">
                    <ul id="lista_material_complementar" class="ul_lista">
                        <?php echo $this->listaMaterial; ?>
                    </ul>
                </div>

                <div class="accord_body">
                    <div id="div_conteudo_exercicio" class='list_conteudo accord_body'>
                        <img src="img/check.png"/>Exercicios
                    </div>
                </div>
                <div class="add accord_content_body" style="display:none;">
                    <ul id="lista_exercicio" class="ul_lista">
                        <?php echo $this->listaExercicio; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="display:none;">
    <input type="text" name="id_modulo" id="id_modulo" value="<?php echo $this->modulo->getId_modulo(); ?>"/>
    <input type="text" name="id_curso" id="id_curso" value="<?php echo $this->modulo->getId_curso(); ?>"/>
</div>

