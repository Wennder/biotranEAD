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

<script>    
    $(document).ready(function(){                        
        
        $('.profile_aluno').click(function(){
            var id_usuario = $(this).attr('id');                
            var _HTML = $('#dialog_profile').html();                            
            $.ajax({
                url: 'ajax/profile_aluno.php',
                data:{id_usuario: id_usuario},
                dataType: 'json',
                async: false,
                success: function(data, textStatus, jqXHR){
                    if(data != 0){
                        _HTML = _HTML.replace('#ATUACAO#', data.atuacao);
                        _HTML = _HTML.replace('#SEXO#', data.sexo);
                        _HTML = _HTML.replace('#PAPEL#', data.papel);
                        _HTML = _HTML.replace('#NOME_COMPLETO#', data.nome_completo);               
                        _HTML = _HTML.replace('#DATA_NASCIMENTO#', data.data_nascimento);                                
                        _HTML = _HTML.replace('#DESCRICAO#', data.descricao);              
                        _HTML = _HTML.replace('#CIDADE#', data.cidade);
                        _HTML = _HTML.replace('#EMAIL#', data.email);
                        _HTML = _HTML.replace('#FOTO#', data.foto);
                    }
                }
            });        
            dialog = $(_HTML).dialog({
                draggable: false,
                resizable: false,
                position: [(($(window).width()-900)/2), 15],
                show: {
                    effect: 'drop', 
                    direction: "up"
                },
                width:900,
                height: 350,
                modal:true,
                close: function(){
                    dialog.dialog("destroy");
                    dialog.remove();
                }
            });
        });
    });
</script>

<div style="display: none;">
    <input type="text" id="i_nome_curso" value="<?php echo $this->curso->getNome()?>">
    <input type="text" id="i_nome_aluno" value="<?php echo $_SESSION['usuarioLogado']->getNome_completo()?>">
    
</div>

<div style="border-bottom:1px solid #f0f0f0; margin-left:20px">
    <form id="form_editar_curso">
        <div style="border-bottom:1px solid #eeeeee;">
            <center><label><b>CURSO FINALIZADO</b></label></center>
        </div>
        <div>
            <table>
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
                            <b>Data de Matrícula: </b><?php echo $this->mc->getData_inicio(); ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            <b>Data de Término: </b><?php echo $this->mc->getData_fim(); ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            <a target="_blank" class="button3" id="btn_gerar_certificado" href="index.php?c=ead&a=certificado&id=<?php echo $this->curso->getId_curso(); ?>">Gerar Certificado</a>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            <input type="button" class="button3" id="btn_ver_desempenho" name="<?php echo $this->mc->getId_matricula_curso(); ?>" value="Ver Desempenho"/>
                        </label>
                    </td>
                </tr>
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
                  
                </tr>
                <tr>
                      <td>
                        <div style="padding:5px;">
                            <div>
                                <label><b>Objetivo:</b></label>
                            </div>
                            <textarea id="objetivo" name="objetivo" rows="3" cols="40" type="text" readonly="readonly" class="text-area"><?php echo $this->curso->getObjetivo() ?> </textarea>
                        </div>
                    </td>
                    <td>
                        <div style="padding:5px;">
                            <div>
                                <label><b>Justificativa:</b></label>
                            </div>
                            <textarea id="justificativa" name="justificativa" rows="3" cols="40" type="text" readonly="readonly" class="text-area"><?php echo $this->curso->getJustificativa() ?> </textarea>
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
<?php require ROOT_PATH . '/app/view/ead/profile_dialog.php'; ?>