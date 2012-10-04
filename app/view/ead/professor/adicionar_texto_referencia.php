
<script src="js/jquery-ui-1.8.24.custom.min.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine-pt_BR.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript"></script>
<script type="text/javascript" src="http://malsup.github.com/jquery.form.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
<script>
    
    $(document).ready(function(){                
        $('#form_cadastrar').validationEngine();                
    });
    
</script>

<div id="form_cadastro" style="">
    <form id="" class="form_cadastrar" method="post" action="ajax/crud_conteudo_modulo.php?acao=inserir_texto_referencia
          " enctype="multipart/form-data">
        <fieldset style="width: 100%;">
            <legend>Dados do texto de referencia</legend>
            <table>                
                <tr>
                    <td>
                        <label class="label_cadastro">Arquivo: </label>
                    </td>
                    <td>
                        <input type="file" id="arquivo" style="width:200px;" value="" class="validate[required] text-input" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <progress value="0" max="100"></progress><span id="porcentagem">0%</span>
                    </td>
                </tr>
            </table>
        </fieldset>
        <br>
        <input type="submit" id="button_add" name="button_cadastrar" value="Adicionar" class="button"/>

        <div style="display:none;">
            <input type="text" id="id_modulo" name="id_modulo" value="<?php echo ($this->modulo != null ? $this->modulo->getId_modulo() : '') ?>" class="button"/>
        </div>
    </form>
    </br></br>
</div>
