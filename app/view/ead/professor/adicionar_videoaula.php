<?php require 'structure/header.php' ?>
<?php require 'structure/leftcolumn_professor_curso.php' ?>
<?php require 'structure/content.php' ?>

<div id="form_cadastro" style="">
    <form id="" class="form_cadastro" method="post" action="index.php?c=ead&a=cadastrar_videoaula" enctype="multipart/form-data">
        <fieldset style="width: 100%;">
            <legend>Dados da video-aula</legend>
            <table>
                <tr>
                    <td style="width: 150px;">
                        <label class="label_cadastro">Nome da aula: </label>
                    </td>
                    <td style="width: 600px;">
                        <input type="text" id="nome" name="nome" value="" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 500px"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">Video: </label>
                    </td>
                    <td>
                        <input type="file" id="" style="width:500px;" value="" class="validate[required] text-input" />
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
        <input type="submit" id="button_add_videoaula" name="button_cadastrar" value="Adicionar" class="button"/>

    </form>
    </br></br>
</div>

<?php require 'structure/footer.php' ?>