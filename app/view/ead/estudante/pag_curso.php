<img id="imagem_curso_matricula" src=<?php echo "img/cursos/" . $this->curso->getId_curso() . ".jpg"; ?> style="float:left; margin:10px;"/>
     <div style="padding:15px;">
        <h1  style=""><?php echo $this->curso->getNome(); ?></h1> 
        <fieldset style="border: 1px solid #eeeeee;padding:15px;">
            <legend>Descricao</legend>            
            <p  style="margin-left:10px; margin-bottom: 20px; text-indent: 10px; text-align: justify;"><?php echo $this->curso->getDescricao(); ?></p>
            <h4 style="float:left;">Duração:</h4>
            <h4 style="float:left; clear:right;"><?php echo $this->curso->getTempo() ?></h4>
        </fieldset>
    </div>
<fieldset style="100%">
    <legend>Modulos e Conteudo</legend>
    <div name="editar_curso" id="lista_de_modulos">
        <ul style="list-style-type:none;">
            <?php            
            echo $this->listaModulos;
            ?>
        </ul>
    </div>
</fieldset>