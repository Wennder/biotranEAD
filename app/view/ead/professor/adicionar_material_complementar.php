<script src="js/jquery.js"></script> 
<script type="text/javascript" src="js/jquery.form.js"></script>
<script src="js/jquery-ui-1.8.24.custom.min.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine-pt_BR.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>

<script>
    
    $(document).ready(function(){                
        $('#form_cadastrar').validationEngine();                
    });
    
</script>

<div id="form_cadastro" style="">
    <form id="form_cadastrar" class="form_cadastrar" method="post" action="ajax/crud_conteudo_modulo.php?acao=inserir_material_complementar" enctype="multipart/form-data">
        <fieldset style="width: 100%;">
            <legend>Inserir material complementar</legend>
            <table> 
                <tr>
                    <td>
                        <label class="label_cadastro">Nome: </label>
                    </td>
                    <td>
                        <input type="text" name="nome" id="nome" style="width:200px;" value="" class="validate[required] text-input" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">Arquivo: </label>
                    </td>
                    <td>
                        <input type="file" name="arquivo" id="arquivo" style="width:200px;" value="" class="validate[required] text-input" />
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
