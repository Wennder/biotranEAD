<?php require 'structure/header.php' ?>
<?php

$papel = $_SESSION["usuarioLogado"]->getId_papel();
switch ($papel) {
    case 1:
        require 'structure/leftcolumn_admin.php';
        break;
    case 3:
        require 'structure/leftcolumn_professor_curso.php';
        break;
}
?>
<?php require 'structure/content.php' ?>
<script src="js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
<script>
    $(function() {
        $( ".menu_accordion" ).accordion({
            active: false,
            //            animated: 'bounceslice',
            //            clearStyle: true,
            //            fillSpace: true,
            autoHeight: false,
            navigation: true,
            collapsible: false
        });
    });
</script>

<div id="form_cadastro" style="">
    <form id="" class="form_cadastro" method="post" action="index.php?c=ead&a=cadastrar_exercicio" enctype="multipart/form-data">
        <fieldset style="width: 100%;">
            <legend>Dados do Exercicio</legend>
            <table>
                <tr>
                    <td style="width: 150px;">
                        <label class="label_cadastro">Nome do Exercicio: </label>
                    </td>
                    <td style="width: 600px;">
                        <input type="text" id="nome" name="nome" value="" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 500px"/>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">
                        <label class="label_cadastro">Descricao (opcional): </label>
                    </td>
                    <td>
                        <textarea id="descricao" style="width:500px;" name="descricao" rows="3" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100"></textarea>
                    </td>
                </tr>
            </table>
        </fieldset>
        <div class="menu_accordion">
            <h3>
                <a>Perguntas</a>
            </h3>
            <div>
                <ul>
                    <li>
                        <div class="menu_accordion">
                            <h4>
                                <a>Adicionar nova pergunta</a>
                            </h4>
                            <div>
                                <ul>
                                    <li>
                                       <fieldset style="width:100%;">
                                            <legend>Nova Pergunta</legend>
                                            <table>
                                                <tr>
                                                    <td style="width: 150px;">
                                                        <label class="label_cadastro">Titulo: </label>
                                                    </td>
                                                    <td style="width: 600px;">
                                                        <input type="text" id="titulo" name="titulo" value="" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 500px"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 150px;">
                                                        <label class="label_cadastro">Enunciado: </label>
                                                    </td>
                                                    <td>
                                                        <textarea id="enunciado" style="width:500px;" name="enunciado" rows="3" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100"></textarea>
                                                    </td>
                                                </tr>
                                            </table>
                                       </fieldset>
                                        <fieldset style="width:100%;">
                                            <legend>Alternativa 1</legend>
                                            <table>
                                                <tr>
                                                    <td style="width: 150px;">
                                                        <label class="label_cadastro">Resposta: </label>
                                                    </td>
                                                    <td style="width: 600px;">
                                                        <input type="text" id="resposta1" name="resposta1" value="" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 500px"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 150px;">
                                                        <label class="label_cadastro">Justificativa: </label>
                                                    </td>
                                                    <td>
                                                        <textarea id="justificativa1" style="width:500px;" name="justificativa1" rows="3" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100"></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;">
                                                        <input type="radio" name="correta" value="alternativa1" />Alternativa Correta<br />
                                                    </td>
                                                </tr>
                                            </table>
                                        </fieldset>
                                        <fieldset style="width:100%;">
                                            <legend>Alternativa 2</legend>
                                            <table>
                                                <tr>
                                                    <td style="width: 150px;">
                                                        <label class="label_cadastro">Resposta: </label>
                                                    </td>
                                                    <td style="width: 600px;">
                                                        <input type="text" id="resposta2" name="resposta2" value="" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 500px"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 150px;">
                                                        <label class="label_cadastro">Justificativa: </label>
                                                    </td>
                                                    <td>
                                                        <textarea id="justificativa2" style="width:500px;" name="justificativa2" rows="3" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100"></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;">
                                                        <input type="radio" name="correta" value="alternativa2" />Alternativa Correta<br />
                                                    </td>
                                                </tr>
                                            </table>
                                        </fieldset>

                                        <fieldset style="width:100%;">
                                            <legend>Alternativa 3</legend>
                                            <table>
                                                <tr>
                                                    <td style="width: 150px;">
                                                        <label class="label_cadastro">Resposta: </label>
                                                    </td>
                                                    <td style="width: 600px;">
                                                        <input type="text" id="resposta3" name="resposta3" value="" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 500px"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 150px;">
                                                        <label class="label_cadastro">Justificativa: </label>
                                                    </td>
                                                    <td>
                                                        <textarea id="justificativa3" style="width:500px;" name="justificativa3" rows="3" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100"></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;">
                                                        <input type="radio" name="correta" value="alternativa3" />Alternativa Correta<br />
                                                    </td>
                                                </tr>
                                            </table>
                                        </fieldset>

                                        <fieldset style="width:100%;">
                                            <legend>Alternativa 4</legend>
                                            <table>
                                                <tr>
                                                    <td style="width: 150px;">
                                                        <label class="label_cadastro">Resposta: </label>
                                                    </td>
                                                    <td style="width: 600px;">
                                                        <input type="text" id="resposta4" name="resposta4" value="" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 500px"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 150px;">
                                                        <label class="label_cadastro">Justificativa: </label>
                                                    </td>
                                                    <td>
                                                        <textarea id="justificativa4" style="width:500px;" name="justificativa4" rows="3" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100"></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;">
                                                        <input class="label_cadastro" type="radio" name="correta" value="alternativa4" />Alternativa Correta<br />
                                                    </td>
                                                </tr>
                                            </table>
                                        </fieldset>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <br>
        <input type="submit" id="button_add_exercicio" name="button_cadastrar" value="Adicionar" class="button"/>

    </form>
    </br></br>
</div>

<?php require 'structure/footer.php' ?>
