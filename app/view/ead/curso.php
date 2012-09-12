<?php require 'structure/header.php'; ?>
<?php require 'structure/leftcolumn_aluno_curso.php';?>
<?php require 'structure/content.php'; ?>

<img id="imagem_curso_matricula" src="img/cursos/00.jpg" style="float:left; margin:10px;"/>
<div style="padding:15px;">
<h1  style=""><?php echo $this->curso->getNome(); ?></h1> 



<p  style="margin-left:10px; margin-bottom: 20px; text-indent: 10px; text-align: justify;"><?php echo $this->curso->getDescricao(); ?></p>
        <h4 style="float:left;">Duração:</h4>
        <h4 style="float:left; clear:right;"><?php echo $this->curso->getTempo() ?></h4>

<?php require 'structure/footer.php'; ?>