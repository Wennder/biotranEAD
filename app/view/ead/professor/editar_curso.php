<?php 
//define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/biotranEAD');
//include ROOT_PATH . "/app/model/pdo/PDOConnectionFactory.class.php";
//include ROOT_PATH . '/app/model/dao/CursoDAO.php';
?>

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
$controller = new controllerCurso();
$this->cursos = $controller->getCurso("id_curso=" . $id_curso);
?>
<div id="disposicao_conteudo_professor_editar_curso">
    <div class="quadro_de_conteudo_especifico" style="background-color:#f0f0f0;">
        <div id="image_holder">
            <img src="<?php echo "img/cursos/" . $id_curso . ".jpg" ?>" alt="Imagem do Curso" />    </div>
        <div id="titulo_holder" style="">
            <h2 style=""><?php echo $this->curso->getNome(); ?></h2>

        </div>
        <h4>Descricao: </h4>
        <input type="text-field" readonly="readonly" value="<?php echo $this->curso->getDescricao() ?>"/>

        <h4>Tempo: </h4>
        <input type="text" readonly="readonly" value="<?php echo $this->curso->getTempo() ?> Dias"/>

        <h4>Status: </h4>
        <input type="text" readonly="readonly" value="<?php echo $this->curso->getStatus(0) ?>"/>

        <h4>Gratuito: </h4>
        <input type="text" readonly="readonly" value="<?php echo $this->curso->getGratuito() ?>"/>

        <h4>Valor: </h4>
        <input type="text" readonly="readonly" value="<?php echo $this->curso->getValor() ?>"/>

        <h4>Objetivo: </h4>
        <input type="text" readonly="readonly" value="<?php echo $this->curso->getObjetivo() ?>"/>

        <h4>Justificativa: </h4>
        <input type="text" readonly="readonly" value="<?php echo $this->curso->getJustificativa() ?>"/>

        <h4>Observacoes: </h4>
        <input type="text" readonly="readonly" value="<?php echo $this->curso->getObs() ?>"/>

    </div>

    <div id="lista_de_modulos">
        <ul style="list-style-type:none;">
            <?php
            $controllerModulo = new ControllerModulo();
            echo $controllerModulo->listaModulos($id_curso);
            ?>
        </ul>
    </div>
</div>
