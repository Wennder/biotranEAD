<?php require 'structure/header.php'; ?>
<?php require 'structure/leftcolumn_admin.php'; ?>
<?php require 'structure/content.php'; ?>

<script src="js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>

<script>
    $(function() {
        $( ".accordion_cursos" ).accordion({
            active: false,
//            animated: 'bounceslice',
//            clearStyle: true,
//            fillSpace: true,
            autoHeight: false,
            navigation: true,
            collapsible: true
        });
    });
    
   </script>

<div class="accordion_cursos">
    <?php echo $this->lista; ?>
</div>

