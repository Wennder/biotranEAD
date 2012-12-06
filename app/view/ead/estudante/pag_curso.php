<?php
if (isset($_GET['id'])) {
    $id_curso = $_GET['id'];
}
$caminho = file_exists("img/cursos/" . $this->curso->getId_curso() . ".jpg") ? "img/cursos/" . $this->curso->getId_curso() . ".jpg" : "img/cursos/00.jpg";
?>

<style>
    .lista_modulos{
        border-bottom:1px solid #eeeeee;
        border-top:1px solid #fefefe;
        background-color: #fafafa;
        padding: 5px;
        cursor: pointer;
    }
</style>

<div style="border-bottom:1px solid #f0f0f0; margin-left:20px">
    <form id="form_editar_curso">
        <div style="border-bottom:1px solid #eeeeee;">
            <center><label><b>Informações do curso</b></label></center>
        </div>
        <div>
            <table style="width: 100%;">
                <tr>
                    <td rowspan="8" style="width: 262px;">
                        <div id="imagem_curso" style="margin: 15px 15px 15px 5px; width: 240px; height: 180px;">
                            <img id="img_curso" src="<?php echo $caminho ?>" alt="Imagem do Curso" height="180" width="240" />
                        </div> 
                    </td>
                    <td style="height: 15px;"></td>
                </tr>
                <tr>
                    <td>
                        <label>
                            <b>Nome: </b><?php echo $this->curso->getNome(); ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            <b>Duração: </b><?php echo $this->curso->getTempo(); ?> dias
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            <b>Tempo restante: </b><?php echo $this->curso->getTempo(); ?> dias
                        </label>
                    </td>
                </tr>
                <tr><td style="height: 15px;"></td></tr>
                <tr><td style="height: 15px;"></td></tr>
                <tr><td style="height: 15px;"></td></tr>
                <tr><td style="height: 15px;"></td></tr>
                <tr><td style="height: 15px;"></td></tr>
            </table>
        </div>
        <div>
            <table>
                <tr>
                    <td>
                        <div style="padding:5px;">
                            <div>
                                <label><b>Descrição:</b></label>
                            </div>
                            <textarea id="descricao" name="descricao" rows="3" cols="40" type="text" readonly="readonly" class="text-area"><?php echo $this->curso->getDescricao() ?></textarea>
                        </div>
                    </td>
                    <td>
                        <div style="padding:5px;">
                            <div>
                                <label><b>Objetivo:</b></label>
                            </div>
                            <textarea id="objetivo" name="objetivo" rows="3" cols="40" type="text" readonly="readonly" class="text-area"><?php echo $this->curso->getObjetivo() ?> </textarea>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div id="lista_modulos">
            <label style="margin: 5px 0 0 9px; position: absolute;"><b>Módulos:</b></label><br>
            <ul style="list-style-type:none; width: 725px; padding: 10px 0 0 10px; margin-bottom: 20px;">
                <?php
                $controllerModulo = new controllerModulo();
                echo $controllerModulo->listaModulos($id_curso);
                ?>
            </ul>
        </div>
    </form>
</div>