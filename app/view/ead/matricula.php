

<?php require 'structure/header.php'; ?>
<?php require 'structure/leftcolumn_aluno_home.php';?>
<?php require 'structure/content.php'; ?>


<div>
<img id="imagem_curso_matricula" src=<?php echo "img/cursos/". $this->curso->getId_curso() .".jpg"; ?> style="float:left; margin:10px;" />
<div style="padding-right:15px;">
<h1  style=""><?php echo $this->curso->getNome(); ?></h1> 



<p  style="margin-left:10px; margin-bottom: 20px; text-indent: 10px; text-align: justify;"><?php echo $this->curso->getDescricao(); ?></p>
        <h4 style="float:left;">Duração:</h4>
        <h4 style=" "><?php echo $this->curso->getTempo() ?></h4>

    <ul style=" list-style: none;  ">
        <li style="display:inline; float: left;" ><h3 >Valor:</h3></li>
        <li  style="display:inline; float: left;"><h3 ><?php echo $this->curso->getValor(); ?></h3></li> 
        <li style="display:inline; float: right;"><h3><a style="color:#333333;line-height: 100%;" id="link_curso_matricular" href="" >Matricular</a></h3></li>
    </ul>

</div>
     </div>
<?php require 'structure/footer.php'; ?>
