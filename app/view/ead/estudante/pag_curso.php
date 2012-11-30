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



<!--


<img id="imagem_curso_matricula" src=<?php // echo "img/cursos/" . $this->curso->getId_curso() . ".jpg"; ?> style="float:left; margin:10px;"/>
     <div style="padding:15px;">
        <h1  style=""><?php // echo $this->curso->getNome(); ?></h1> 
        <fieldset style="border: 1px solid #eeeeee;padding:15px;">
            <legend>Descricao</legend>            
            <p  style="margin-left:10px; margin-bottom: 20px; text-indent: 10px; text-align: justify;"><?php // echo $this->curso->getDescricao(); ?></p>
            <h4 style="float:left;">Duração:</h4>
            <h4 style="float:left; clear:right;"><?php // echo $this->curso->getTempo() ?></h4>
        </fieldset>
    </div>
<fieldset style="100%">
    <legend>Modulos e Conteudo</legend>
    <div name="editar_curso" id="lista_de_modulos">
        <ul style="list-style-type:none;">
            <?php            
//            echo $this->listaModulos;
            ?>
        </ul>
    </div>
</fieldset>-->