<script src="js/jquery.js"></script> 
<script type="text/javascript" src="js/jquery.form.js"></script>
<script src="js/jquery-ui-1.8.24.custom.min.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine-pt_BR.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>

<script>
    
    $(document).ready(function(){ 
        $('#form_cadastrar').validationEngine();    
//        $('#form_cadastrar').ajaxForm({                 
//            uploadProgress: function(event, position, total, percentComplete) {
//                $('progress').attr('value',percentComplete);
//                $('#porcentagem').html(percentComplete+'%');
//            },                            
//            success: function(data) {                             
//                $('progress').attr('value','100');
//                $('#porcentagem').html('100%');
//                $('pre').html(data);
//                if(data != 0){                                         
//                    if(tipo == 'video'){                                        
//                        data = data.split('-');
//                        insereVideo(data);
//                    }else{//insere novo arquivo(texto/material)
//                                    
//                    }
//                    var dialog = 'dialog';
//                    $(dialog.toString()).dialog('close');
//                }                       
//            }                    
//        });     
    });
    
</script>

<div id="form_cadastro" style="">
    <form id="form_cadastrar" class="form_cadastro" method="post" action="ajax/crud_conteudo_modulo.php?acao=inserir_video" enctype="multipart/form-data">
        <fieldset style="width: 100%;">
            <legend>Dados da video-aula</legend>
            <table>
                <tr>
                    <td style="width: 150px;">
                        <label class="label_cadastro">Título da aula: </label>
                    </td>
                    <td style="width: 600px;">
                        <input type="text" id="titulo" name="titulo" value="" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 500px"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">Video: </label>
                    </td>
                    <td>                                                
                        <input type="file" id="video" name="video" style="width:500px;" value="" class="validate[required] text-input" />
                        <br ><br >
                        <progress value="0" max="100"></progress><span id="porcentagem">0%</span>
                    </td>

                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">Descrição: </label>
                    </td>
                    <td>
                        <textarea id="descricao" style="width:500px;" name="descricao" rows="3" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100"></textarea>
                    </td>
                </tr>
            </table>
        </fieldset>
        <br>
        <input type="submit" id="btn_add" name="btn_add" value="Adicionar" class="button"/>

        <div style="display:none;">
            <input type="text" id="id_modulo" name="id_modulo" value="<?php echo ($this->modulo != null ? $this->modulo->getId_modulo() : '') ?>" class="button"/>
        </div>
    </form>
    </br></br>
</div>
