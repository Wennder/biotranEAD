<script>       
    $('#btn_editar_modulo').click(function(){
        if($(this).attr('value') == 'Editar'){
            $('#titulo_modulo').removeAttr('readonly');
            $('#descricao').removeAttr('readonly');
            $('#div_atualizar_modulo').css('display','inline');
            $(this).attr('value', 'Cancelar');            
        }else{
            $('#titulo_modulo').attr('readonly', 'true');
            $('#descricao').attr('readonly', 'true');
            $('#div_atualizar_modulo').css('display','none');
            $(this).attr('value', 'Editar');
        }
    });
    
    $('#btn_atualizar_modulo').click(function(){
        $.post('ajax/crud_conteudo_modulo.php?acao=atualizar_descritivo&id='+$('#id_modulo').val(), $('#form_descritivo').serialize(), function(json) {
            // handle response
            if(json != false){
                $('#titulo_modulo').attr('readonly', 'true');
                $('#descricao').attr('readonly', 'true');
                $('#div_atualizar_modulo').css('display','none');
                $('#btn_editar_modulo').attr('value', 'Editar');
                alert('Dados atualizados');
            }                                                                
        }, "json");                
    });        
    
</script>

<div id="div_conteudo_professor_editar_modulo">
    <div style="border-bottom:1px solid #f0f0f0; margin-left:20px">
        <div style="border-bottom:1px solid #eeeeee;">
            <center><label><b>Módulo <?php echo $this->modulo->getId_modulo() . ' - ' . $this->curso->getNome(); ?></b></label></center>
        </div>
        <div id="info_modulo">
            <form id="form_descritivo" enctype="multipart/form-data" method="post">
                <table>
                    <tr>
                        <td>
                            <label><b>Título: </b></label>
                        </td>
                        <td>
                            <input readonly="true" id="titulo_modulo" type="text" name="titulo_modulo" class="text-input" value="<?php echo $this->modulo->getTitulo_modulo(); ?>" /><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label style="margin: -10px 0 0 0;"><b>Descrição: </b></label>
                        </td>
                        <td>
                            <textarea readonly="true" type="text" id="descricao" name="descricao" class="text-area" rows="2" cols="29"><?php echo $this->modulo->getDescricao() ?></textarea>                        
                        </td>
                    </tr>
                </table>
                <div style="position: absolute; margin: -35px 0 0 370px;">
                    <div id="div_atualizar_modulo" style="display: none;">
                        <input id="btn_atualizar_modulo" type="button" class="button2" value="Atualizar"/>
                    </div>
                    <input id="btn_editar_modulo" type="button" class="button2" value="Editar"/>
                </div>
            </form><br>
            <div id="menu_accordion">
                <div class="accord_body">
                    <div class='accord_list'>
                        <img src="img/movie.png"/><label class="accord_label">Vídeo Aulas</label>
                    </div>
                </div>
                <div class="accord_content_body" style="display:none;">
                    <ul id="lista_video" class="accord_ul">
                        <li>
                            <input type="button" class="btn_add" name="video" id="index.php?c=ead&a=adicionar_videoaula&id=<?php echo $this->modulo->getId_modulo(); ?>" value="Adicionar"/>
                        </li>
                        <?php echo $this->listaVideo; ?>                                    
                    </ul>
                </div>
                <div class="accord_body">
                    <div class='accord_list'>
                        <img src="img/text_enriched.png"/><label class="accord_label">Textos de Referência</label>
                    </div>
                </div>
                <div class="accord_content_body" style="display:none;">
                    <ul id="lista_texto_referencia" class="accord_ul">
                        <li>
                            <input type="button" class="btn_add" name="texto_referencia" id="index.php?c=ead&a=adicionar_texto_referencia&id=<?php echo $this->modulo->getId_modulo(); ?>" value="Adicionar"/>
                        </li>
                        <?php echo $this->listaTexto; ?>
                    </ul>
                </div>
                <div class="accord_body">
                    <div class='accord_list'>
                        <img src="img/folder-icon.png"/><label class="accord_label">Material Complementar</label>
                    </div>
                </div>
                <div class="accord_content_body" style="display:none;">
                    <ul id="lista_material_complementar" class="accord_ul">
                        <li>
                            <input type="button" class="btn_add" name="material_complementar" id="index.php?c=ead&a=adicionar_material_complementar&id=<?php echo $this->modulo->getId_modulo(); ?>" value="Adicionar"/>
                        </li>
                        <?php echo $this->listaMaterial; ?>
                    </ul>
                </div>
                <div class="accord_body">
                    <div class='accord_list'>
                        <img src="img/check.png"/><label class="accord_label">Exercicios</label>
                    </div>
                </div>
                <div class="accord_content_body" style="display:none;">
                    <ul id="lista_exercicio" class="accord_ul">
                        <li>
                            <input type="button" class="btn_add" name="exercicio" id="index.php?c=ead&a=adicionar_exercicio&id=<?php echo $this->modulo->getId_modulo(); ?>" value="Adicionar"/>
                        </li>
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