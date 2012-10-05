<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controllerModulo
 *
 * @author cead-p057007
 */
class controllerModulo {
    /*
     * Retorna apenas um moduloereco de acordo com a condicao da query.
     * Se houver mais de um registro em banco, apenas o primeiro sera retornado
     * 
     * @param $condicao = condicao de busca do tipo String no formato ex.: 'id_curso_professor=1'
     * 
     * @return Objeto moduloereco encontrado, ou o primeiro da lista
     */

    public function getModulo($condicao) {
        $dao = new ModuloDAO();
        $modulo = $dao->select($condicao);
        if ($modulo != null) {
            return $modulo[0];
        }
        return $modulo; // null
    }

    /*
     * Retorna uma lista de moduloerecos de acordo com a condicao da query.
     * condicao de busca do tipo String no formato ex.: 'id_curso_professor=1'     
     * 
     * @param string $condicao
     * @return array de objetos curso_professor encontrado
     */

    public function getListaModulo($condicao) {
        $dao = new ModuloDAO();
        $modulo = $dao->select($condicao);
        return $modulo;
    }

    /*
     * Retorna uma lista de todos os usuarios
     *      
     * @return array de objetos com todos os usuarios
     */

    public function getAllModulo() {
        $dao = new ModuloDAO();
        $modulo = $dao->select();
        return $modulo;
    }

    public function listaModulos_leftcolumn($id_curso) {
        $modulos = $this->getListaModulo('id_curso=' . $id_curso);
        $quant = count($modulos);
        $i = 0;
        $listaModulos = "";
        for (; $i < $quant; $i++) {
            $listaModulos .= "<div class='accordion_leftcolumn'><h3>Modulo " . $modulos[$i]->getNumero_modulo() . "</h3><div><ul style='list-style-type:none;'>";
            $listaModulos .= "<li><p><a href='index.php?c=ead&a=editar_modulo&id=" . $modulos[$i]->getId_curso() . "'>Editar Modulo</a></p></li>";
            $listaModulos .= "<li><p><a href='index.php?c=ead&a=adicionar_videoaula&id=" . $modulos[$i]->getId_modulo() . "'>Adicionar Video Aula</a></p></li>";
            $listaModulos .= "<li><p><a href='index.php?c=ead&a=adicionar_bibliografia&id=" . $modulos[$i]->getId_modulo() . "'>Adicionar Bibliografia</a></p></li>";
            $listaModulos .= "<li><p><a href='index.php?c=ead&a=adicionar_materialcomplementar&id=" . $modulos[$i]->getId_modulo() . "'>Adicionar Material Complementar</a></p></li>";
            $listaModulos .= "<li><p><a href='index.php?c=ead&a=adicionar_exercicio&id=" . $modulos[$i]->getId_modulo() . "'>Adicionar Exercicio</a></p></li>";
            $listaModulos .= "</ul></div></div>";
        }
        return $listaModulos;
    }

    //Lista lateral para adicionar o conteudo dos modulos
    //Lista todos os modulos existentes e opcao de adicionar conteudo em cada
    public function listaAdicionar_conteudo_modulo($id_curso) {
        $modulos = $this->getListaModulo('id_curso=' . $id_curso);
        $quant = count($modulos);
        $i = 0;
        $listaModulos = "";
        for (; $i < $quant; $i++) {
            $listaModulos .= "<div class='accordion_leftcolumn'><h3><a href='index.php?c=ead&a=editar_modulo&id=" . $modulos[$i]->getId_modulo() . "'>Modulo " . $modulos[$i]->getNumero_modulo() . "</a></h3><div><ul style='list-style-type:none;'>";
            $listaModulos .= "<li><p><a href='index.php?c=ead&a=adicionar_videoaula&id=" . $modulos[$i]->getId_modulo() . "'>Adicionar Video Aula</a></p></li>";
            $listaModulos .= "<li><p><a href='index.php?c=ead&a=adicionar_bibliografia&id=" . $modulos[$i]->getId_modulo() . "'>Adicionar Bibliografia</a></p></li>";
            $listaModulos .= "<li><p><a href='index.php?c=ead&a=adicionar_materialcomplementar&id=" . $modulos[$i]->getId_modulo() . "'>Adicionar Material Complementar</a></p></li>";
            $listaModulos .= "<li><p><a href='index.php?c=ead&a=adicionar_exercicio&id=" . $modulos[$i]->getId_modulo() . "'>Adicionar Exercicio</a></p></li>";
            $listaModulos .= "</ul></div></div>";
        }
        return $listaModulos;
    }

    public function listaVideo_aulas_modulo($id_modulo) {
        $controllerVideo = new controllerVideo();
        $modulo = new Modulo();
        $dao = new ModuloDAO();
        $id_curso = $modulo->getId_curso('id_modulo=' . $id_modulo);
        $diretorio = ROOT_PATH . "/public/cursos/" . $id_curso . "/modulos/" . $id_modulo . "/video_aula/";
        $lista = "";

        $videos = $controllerVideo->getListaVideos('id_modulo=' . $id_modulo);
        for ($i = 0; $i < count($videos); $i++) {
            $lista .= "<li><h3 id=" . $videos[$i]->getId_video() . ">";
            $lista .= $videos[$i]->getTitulo();
            $lista .= "</h3><input type='button' class='btn_edt' value='Editar' float='right'/><input type='button' class='btn_del' value='Excluir' float='right'/></li>";
        }
        return $lista;
    }
    
    public function listaTextos_referencia_modulo($id_modulo) {
        $modulo = $this->getModulo('id_modulo='.$id_modulo);
        $id_curso = $modulo->getId_curso();
        $diretorio = $diretorio = ROOT_PATH . "/public/cursos/" . $id_curso . "/modulos/" . $id_modulo . "/texto_referencia/";
        $arquivos = glob($diretorio . "*.pdf");
        $lista = "";
        foreach ($arquivos as $arquivo) {            
            $lista .= "<li><h3>";
            $lista .= basename($arquivo);
            $lista .= "</h3><input type='button' class='btn_edt' value='Editar' float='right'/><input type='button' class='btn_del' value='Excluir' float='right'/></li>";
        }
        return $lista;
    }

    public function listaModulos($id_curso) {
        $modulos = $this->getListaModulo('id_curso=' . $id_curso);
        $quant = count($modulos);
        $i = 0;
        $listaModulos = "";
        for (; $i < $quant; $i++) {
            $listaModulos .= "<li><div class=''><h3 id=" . $modulos[$i]->getId_modulo() . " ><div class='list_index_admin_blue'><div class='detalhe1'></div><img  src='img/seta_blue.png' />Modulo " . $modulos[$i]->getNumero_modulo() . ": " . $modulos[$i]->getTitulo_modulo() . "</div></h3></div></li>";
        }
        return $listaModulos;
    }

    public function inserirModulo(Modulo $modulo) {
        $dao = new ModuloDAO();
        $modulo = $dao->insert($modulo);
        return $modulo;
    }

    /*
     * cria toda a estrutura de diretórios do módulo
     * id_curso/modulos/id_modulo:
     * -video
     * -texto
     * -material
     */

    public function criaDiretorioModulo(Modulo $modulo) {
        $caminho = ROOT_PATH . '/public/cursos/' . $modulo->getId_curso() . '/modulos/' . $modulo->getId_modulo();
        if (!mkdir($caminho, 0777, true))
            trigger_error("Não foi possível criar o diretório de modulos");
        $video = $caminho . '/video_aula';
        if (!mkdir($video, 0777, true))
            trigger_error("Não foi possível criar o diretório de video_aulas");
        $texto = $caminho . '/texto_referencia';
        if (!mkdir($texto, 0777, true))
            trigger_error("Não foi possível criar o diretório de texto_referencia");
        $material = $caminho . '/material_complementar';
        if (!mkdir($material, 0777, true))
            trigger_error("Não foi possível criar o diretório de material_complementar");
    }

    /*
     * seta objeto conteudo de módulo de forma genérica
     * 
     * $conteudo pode ser: Video, Material_complementar e Texto_referencia
     *      
     */

    public function setConteudo($conteudo) {
        $classe = ucfirst(strtolower($conteudo));
        $objeto = new $classe();
        if (!empty($_POST)) {
            foreach ($_POST as $k => $v) {
                $setAtributo = 'set' . ucfirst($k);
                if (method_exists($objeto, $setAtributo)) {
                    $objeto->$setAtributo($v);
                }
            }
        }
        return $objeto;
    }

    public function setArquivoVideo(Video $v) {
        $id_video = $v->getId_video();
        $id_modulo = $v->getId_modulo();
        $id_curso = $this->getModulo("id_modulo=" . $id_modulo)->getId_curso();
        if (isset($_FILES["video"])) {
            if ($_FILES["video"]["name"] != '') {
                $video = $_FILES["video"];
                $tipos = array("wmv");
                $pasta_dir = "../cursos/" . $id_curso . "/modulos/" . $id_modulo . "/video_aula/";
                if (!in_array($video['type'], $tipos)) {
                    $video_nome = $pasta_dir . $id_video . ".wmv";
                    move_uploaded_file($_FILES['video']['tmp_name'], $video_nome);
                    return 1;
                }
            }
        }
        return 0;
    }

    /*
     * $tipo_arquivo: material complementar, bibliográfico e texto de referencia
     */

    public function setArquivo($tipo_arquivo, $id_modulo) {
        $id_modulo = $v->getId_modulo();
        $id_curso = $this->getModulo("id_modulo=" . $id_modulo)->getId_curso();
        if (isset($_FILES["arquivo"])) {
            if ($_FILES["arquivo"]["name"] != '') {
                $arquivo = $_FILES["arquivo"];
                $tipos = array("pdf", "doc");
                $pasta_dir = "../cursos/" . $id_curso . "/modulos/" . $id_modulo . "/" . $tipo_arquivo . "/";
                if (!in_array($arquivo['type'], $tipos)) {
                    $video_nome = $pasta_dir . $_FILES["arquivo"]["name"] . ".wmv";
                    move_uploaded_file($_FILES["arquivo"]["tmp_name"], $video_nome);
                    return 1;
                } else {
                    //2 - tipo inválido
                    return 2;
                }
            }
        }
        return 0;
    }

    public function inserir_video() {
        $v = $this->setConteudo('video');
        $controller = new controllerVideo();
        $v->setId_video($controller->novoVideo($v));
        return $this->setArquivoVideo($v);
    }

    public function inserir_texto_referencia() {
        $id_modulo = $_POST["id_modulo"];
        return $this->setArquivo('texto_referencia', $id_modulo);
    }

    public function inserir_material_complementar() {
        $id_modulo = $_POST["id_modulo"];
        return $this->setArquivo('material_complementar', $id_modulo);
    }

}

?>
