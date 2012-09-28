<?php require ROOT_PATH.'/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH.'/app/view/ead/structure/leftcolumn.php' ?>
<?php require ROOT_PATH.'/app/view/ead/structure/content.php'; ?>
<script src="js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
<script src="js/accordion.js" type="text/javascript"></script>
<style>
    #div_conteudo_professor_editar_curso{
        position: relative;
        padding:40px;
        padding-top:0px;
    }

    #div_conteudo_professor_editar_curso h4{
        margin:0;

        padding:0;
    }

    #disposicao_conteudo_professor_editar_curso{
        position: relative;
        margin: 20px;
        margin-top:40px;
    }


    .quadro_de_conteudo_especifico{
        margin:0px;
        margin-bottom:20px;
        border:1px solid #CCCCCC;
        padding: 10px;
        color: #888888;
        overflow: auto;
	width: 100%;
    }

    .quadro_de_conteudo_especifico ul{
        margin:0;
        padding: 0;
    }

    .quadro_de_conteudo_especifico ul li{
        list-style: none;
        color: #888888;
        background-color: #eeeeee;
        border:1px solid #CCCCCC;
        padding:4px;
    }

    .quadro_de_conteudo_especifico ul li:hover{
        border:1px solid black;

    }
    .quadro_de_conteudo_especifico ul li h4{
        float:left; margin-right: 3px;

    }

    .quadro_de_conteudo_especifico ul a:hover,a:active,a:visited{
        text-decoration: none;
        outline: none;

    }

    hr{
        border: 0; 
        height: 0; 
        border-top: 1px solid rgba(0, 0, 0, 0.1); 
        border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        margin-bottom: 10px;
    }

    #professor_adicionar_modulo{
        padding: 7px 7px;
        color: #888888;
        background-color: #eeeeee;
        border:1px solid #CCCCCC;
    }

    #professor_adicionar_modulo:hover{
        border-color: black;
        text-decoration: none;
    }
    
    [readonly = readonly] {
        border:0px;
        border:1px none;
    }
    
    #image_holder{
        padding:3px;
        border:1px solid #cbdcea;
        float:left;
        background-color: white;
    }
    
    #titulo_holder{
        position: relative;
        float:left; 
        clear:right; 
    }
    #div_conteudo_professor_editar_curso *{
        position:relative;
    }
</style>
<?php
if (isset($_GET['id'])) {
    $id_curso = $_GET['id'];
}
$cursoDAO = new CursoDAO();
$this->cursos = $cursoDAO->select("id_curso=" . $id_curso);
?>
<div id="div_conteudo_professor_editar_curso">
   
<!--    <input type="text" readonly="readonly" value="<?php echo $this->cursos[0]->getNome() ?>"/>-->
<!--    <input type="button" value="Editar" />-->
    <div id="disposicao_conteudo_professor_editar_curso">
        <div class="quadro_de_conteudo_especifico" style="background-color:#f0f0f0;">
         <div id="image_holder">
        <img src="<?php echo "img/cursos/" .$id_curso .".jpg" ?>" alt="Imagem do Curso" />    </div>
            <div id="titulo_holder" style="">
            <h2 style=""><?php echo $this->cursos[0]->getNome();?></h2></div>
        </div>
        <div class="quadro_de_conteudo_especifico">
            <h4>Descricao: </h4>
            <input type="text-field" readonly="readonly" value="<?php echo $this->cursos[0]->getDescricao() ?>"/>
        <h4>Tempo: </h4>
        
            <input type="text" readonly="readonly" value="<?php echo $this->cursos[0]->getTempo() ?> Dias"/>
       
        <h4>Status: </h4>
        
            <input type="text" readonly="readonly" value="<?php echo $this->cursos[0]->getStatus(0) ?>"/>
        
        <h4>Gratuito: </h4>
        
            <input type="text" readonly="readonly" value="<?php echo $this->cursos[0]->getGratuito() ?>"/>
        
        <h4>Valor: </h4>
      
            <input type="text" readonly="readonly" value="<?php echo $this->cursos[0]->getValor() ?>"/>
       
        <h4>Objetivo: </h4>
       
            <input type="text" readonly="readonly" value="<?php echo $this->cursos[0]->getObjetivo() ?>"/>
        
        <h4>Justificativa: </h4>
       
            <input type="text" readonly="readonly" value="<?php echo $this->cursos[0]->getJustificativa() ?>"/>
       
        <h4>Observacoes: </h4>
       
            <input type="text" readonly="readonly" value="<?php echo $this->cursos[0]->getObs() ?>"/>
      </div>
        
        
            <input type="button" value="Editar" float="right" />
            
                <div>
                    <ul style="list-style-type:none;">
                        <?php
                        $controllerModulo = new ControllerModulo();
                        echo $controllerModulo->listaModulos($id_curso);
                        ?>
                    </ul>
                </div>
           
        </div>
    </div>
</div>
<?php require ROOT_PATH.'/app/view/ead/structure/footer.php'; ?>