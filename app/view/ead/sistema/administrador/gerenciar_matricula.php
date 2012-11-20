<style type="text/css" title="currentStyle">
    @import "http://code.jquery.com/ui/1.8.24/themes/base/jquery-ui.css";
</style>
<script>
    $(document).ready(function e(){
        oTable_matricula = $('#tabela_matricula_cursos').dataTable({
            "bJQueryUI":true
        });
    });
</script>

<div id="tab_matricula_curso" style="">    
    <?php
        echo $this->tabela;
    ?>
</div>
