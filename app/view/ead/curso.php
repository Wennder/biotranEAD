<?php require 'structure/header.php'; ?>
<?php require 'structure/leftcolumn_aluno_curso.php';?>
<?php require 'structure/content.php'; ?>

<div id="curso">
   <?php echo $this->curso->getNome(); ?>
</div>

<?php require 'structure/footer.php'; ?>