<script>
    $(document).ready(function e(){
        oTable_matricula = $('#tabela_matricula_cursos').dataTable({
            "bJQueryUI":true
        });
        
        $('.i_data_termino').datepicker({
            dateFormat: "dd/mm/yy",
            minDate: 1,
            onClose: function (selected, dpinstance){                                
                if(selected != ''){
                    $.getJSON('ajax/ajax-gerenciar_matricula.php', {
                        data: selected,
                        id_matricula_curso: $(this).attr('name'),
                        acao:'atualizar_data'
                    }, function(j){
                        if(j != 1){                            
                            alert('Erro ao alterar data, tente novamente.');
                        }
                    });
                }
            }
        });                       
    });
</script>

<div id="tab_matricula_curso" style="">
    <div style="border-bottom:1px solid #eeeeee; width: 940px;">
        <center><label style="font-weight: bold; font-size: 14px;">Gerenciar Matrícula</label></center>
    </div><br>
    <center><label style="font-size: 13px;"><?php echo $this->usuario->getNome_completo(); ?></label></center><br>
    <input type="button" value="" id="btn_matricular" class="classeBotaoAdicionar" style="margin: 0 0 5px 5px;"/> Matricular
    <?php
    echo $this->tabela;
    ?>
</div>
