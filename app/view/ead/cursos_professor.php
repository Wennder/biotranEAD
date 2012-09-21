<?php require 'structure/header.php'; ?>
<?php require 'structure/leftcolumn_professor_home.php'; ?>
<?php require 'structure/content.php'; ?>

<script src="js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
<script src="js/accordion.js" type="text/javascript"></script>

<div class="accordion_cursos">
    <?php echo $this->lista; ?>
</div>
