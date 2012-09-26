<?php require 'structure/header.php'; ?>
<?php require 'structure/leftcolumn_professor_curso.php' ?>
<?php require 'structure/content.php'; ?>
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
</style>
<?php
if (isset($_GET['id'])) {
    $id_curso = $_GET['id'];
}
$cursoDAO = new CursoDAO();
$this->cursos = $cursoDAO->select("id_curso=" . $id_curso);
?>
<div id="div_conteudo_professor_editar_curso">
    
    <img src="<?php echo "img/cursos/" .$id_curso .".jpg" ?>" alt="Imagem do Curso" />    
    <input type="text" readonly="readonly" value="<?php echo $this->cursos[0]->getNome() ?>"/>
    <input type="button" value="Editar" />
    <div id="disposicao_conteudo_professor_editar_curso">
        <h4>Descricao: </h4>
        <div class="quadro_de_conteudo_especifico">
            <input type="text" readonly="readonly" value="<?php echo $this->cursos[0]->getDescricao() ?>"/>
        </div>
        <h4>Tempo: </h4>
        <div class="quadro_de_conteudo_especifico">
            <input type="text" readonly="readonly" value="<?php echo $this->cursos[0]->getTempo() ?> Dias"/>
        </div>
        <h4>Status: </h4>
        <div class="quadro_de_conteudo_especifico">
            <input type="text" readonly="readonly" value="<?php echo $this->cursos[0]->getStatus(0) ?>"/>
        </div>
        <h4>Gratuito: </h4>
        <div class="quadro_de_conteudo_especifico">
            <input type="text" readonly="readonly" value="<?php echo $this->cursos[0]->getGratuito() ?>"/>
        </div>
        <h4>Valor: </h4>
        <div class="quadro_de_conteudo_especifico">
            <input type="text" readonly="readonly" value="<?php echo $this->cursos[0]->getValor() ?>"/>
        </div>
        <h4>Objetivo: </h4>
        <div class="quadro_de_conteudo_especifico">
            <input type="text" readonly="readonly" value="<?php echo $this->cursos[0]->getObjetivo() ?>"/>
        </div>
        <h4>Justificativa: </h4>
        <div class="quadro_de_conteudo_especifico">
            <input type="text" readonly="readonly" value="<?php echo $this->cursos[0]->getJustificativa() ?>"/>
        </div>
        <h4>Observacoes: </h4>
        <div class="quadro_de_conteudo_especifico">
            <input type="text" readonly="readonly" value="<?php echo $this->cursos[0]->getObs() ?>"/>
        </div>
        
        <div class="quadro_de_conteudo_especifico">
            <input type="button" value="Editar" float="right" />
            <div class="accordion_body" float="left">
                <h3>
                    <a>Modulos: Clique para expandir</a>
                </h3>
                <div>
                    <ul>
                        <?php
                        $controllerModulo = new ControllerModulo();
                        echo $controllerModulo->listaModulos($id_curso);
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require 'structure/footer.php'; ?>