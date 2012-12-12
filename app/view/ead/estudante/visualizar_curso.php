<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php' ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>
<?php $caminho = file_exists("img/cursos/" . $this->curso->getId_curso() . ".jpg") ? "img/cursos/" . $this->curso->getId_curso() . ".jpg" : "img/cursos/00.jpg"; ?>

<style>
    .lista_modulos{
        border-bottom:1px solid #eeeeee;
        border-top:1px solid #fefefe;
        background-color: #fafafa;
        padding: 5px;
        cursor: pointer;
    }
</style>

<script>
    $('#btn_matricular').live('click', function(){
        //AQUI REDIRECIONA PARA MATRICULA_CURSO COM SISTEMA DE PAGAMENTO
        var id = $(this).attr('name');
        document.location = 'index.php?a=curso_aluno&c=ead&id='+id;
    });
</script>

<div style="border-bottom:1px solid #f0f0f0; margin-left:20px">
    <div style="border-bottom:1px solid #eeeeee;">
        <center><label><b>Informações do curso</b></label></center>
    </div>
    <div>
        <table style="width: 100%;">
            <tr>
                <td rowspan="7" style="width: 262px;">
                    <div id="imagem_curso" style="margin: 15px 15px 15px 5px; width: 240px; height: 180px;">
                        <img id="img_curso" src="<?php echo $caminho ?>" alt="Imagem do Curso" height="180" width="240" />
                    </div> 
                </td>
                <td style="height: 15px;"></td>
            </tr>
            <tr style="height: 35px;">
                <td>
                    <label>
                        <b>Nome: </b><?php echo $this->curso->getNome(); ?>
                    </label>
                </td>
            </tr>
            <tr style="height: 35px;">
                <td>
                    <label>
                        <b>Duração: </b><?php echo $this->curso->getTempo(); ?> dias
                    </label>
                </td>
            </tr>
            <tr style="height: 35px;">
                <td>
                    <label>
                        <?php echo ($this->curso->getGratuito() == "Sim") ? "<b>Gratuito</b>" : "<b>Valor: </b>R$" . $this->curso->getValor(); ?>
                    </label>
                </td>
            </tr>
            <tr><td style="height: 15px;"></td></tr>
        </table>
        <div style="position: absolute; margin: -70px 0 0 590px;">
            <input type="button" id="btn_matricular" name="<?php echo $this->curso->getId_curso(); ?>" value="Matricular-se" class="button2"/>
        </div>
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
    <div id="div_atualizar" align="right" style="display: none; ">
        <input id="id" name="id" type="text" value="<?php echo $this->curso->getId_curso() ?>"/>    
    </div>
    <div id="lista_modulos">
        <label style="margin: 5px 0 0 9px; position: absolute;"><b>Módulos:</b></label><br>
        <ul style="list-style-type:none; width: 725px; padding: 10px 0 0 10px; margin-bottom: 20px;">
            <?php $controllerModulo = new controllerModulo();
            echo $controllerModulo->listaModulos($this->curso->getId_curso()); ?>
        </ul>
    </div>
</div>

<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>