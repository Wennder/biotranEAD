<?php require 'structure/header.php'; ?>
<?php require 'structure/leftcolumn_professor.php' ?>
<?php require 'structure/content.php'; ?>


<div id="form_cadastro" >
    <h2><?php echo $this->curso->getNome(); ?></h2>
<p style="text-indent: 10px;"> Por favor, preencha o formulario para continuar!</p>
    
<form id="cadastro" class="form_cadastro" method="post" action="index.php?c=ead&a=cadastrar_usuario" enctype="multipart/form-data">
        <fieldset style="width: 100%;">
            <legend>Definicões do Curso</legend>
            <table>
                <tr>
                    <td style="width: 150px;">
                        <label class="label_cadastro">Objetivo: </label>
                    </td>
                    <td style="width: 500px;">
                        <textarea id="objetivo" name="descricao" rows="4" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="500"></textarea>
<!--                        <input type="text" id="nome_completo" name="nome_completo" value="" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 500px"/>-->
                    </td>
                </tr>
                <tr>
                    <td style="width:150px;">
                        <label class="label_cadastro">Justificativa: </label>
                    </td>
                    <td>
                        <textarea id="justificativa" name="descricao" rows="4" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="500"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">Numero de Modulos: </label>
                    </td>
                    <td>
                        <input type="text" style="width:50px;" name="numeroCursos" id="numeroCursos" value="" data-prompt_position="centerRight" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">Observação: </label>
                    </td>
                    <td>
                        <textarea id="observacao" name="descricao" rows="4" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="500"></textarea>
                    </td>
                </tr>
                
            </table>
        </fieldset>             
        <br>
        <input type="submit" id="button_ok" name="button_ok" value="Ok" class="button"/>
        
        
    </form>
</div>
<?php require 'structure/footer.php'; ?>
