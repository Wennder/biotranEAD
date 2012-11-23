<script src="js/jquery-ui-1.8.24.custom.min.js" type="text/javascript"></script>
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
                            alert('erro ao alterar data, tente novamente');
                        }
                    });
                }
            }
        });
        
    });
</script>

<div id="tab_matricula_curso" style="">    
    <?php
    echo $this->tabela;
    ?>
</div>
