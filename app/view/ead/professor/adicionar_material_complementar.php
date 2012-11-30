<script>
    $(document).ready(function(){ 
        $('#form_cadastrar').validate({
            rules:{
                nome: {
                    required: true
                },
                arquivos: {
                    required: true
                }
            }
        });
    });
</script>

<div id="form_cadastro" style="">
    <form id="form_cadastrar" class="form_cadastrar" method="post" action="ajax/crud_conteudo_modulo.php?acao=inserir_material_complementar" enctype="multipart/form-data">
        <fieldset style="width:420px; padding:0 5px 5px 5px; margin: 0 2.5px; ">
            <legend>Inserir material complementar</legend>
            <fieldset style="width:400px; padding:0 5px 5px 5px; margin: 0 2.5px; ">
                <legend>Nome</legend>
                <input type="text" name="nome" id="nome" style="width:400px;" value="" class="text-input" />
            </fieldset>
            <fieldset style="width:400px; padding:0 5px 5px 5px; margin: 0 2.5px; ">
                <legend>Arquivo</legend>
                <input type="file" name="arquivo" id="arquivos" style="width:400px;" value="" class="text-input"/>
                <progress value="0" max="100"></progress><span id="porcentagem">0%</span>
                <label class="error" for="arquivos" generated="true" style="display: none; position: relative;">Os formatos de arquivos aceitos são somente .pdf e.mp4.</label>
            </fieldset>
            <input type="submit" id="button_add" name="button_cadastrar" value="Adicionar" class="button2"/>
        </fieldset>
        <div style="display:none;">
            <input type="text" id="id_modulo" name="id_modulo" value="<?php echo ($this->modulo != null ? $this->modulo->getId_modulo() : '') ?>" class="button"/>
        </div>
    </form>
    </br></br>
</div>
