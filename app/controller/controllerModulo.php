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

    private $modulo = null;

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
        $modulos = $this->getListaModulo("id_curso=$id_curso ORDER BY numero_modulo");
        $quant = count($modulos);
        $i = 0;
        $listaModulos = "";
        for (; $i < $quant; $i++) {
            $listaModulos .= "<li><a class='navbar_item moduloIcon link desc' href='#' id='index.php?c=ead&a=editar_modulo&id=" . $modulos[$i]->getId_modulo() . "'> Módulo " . $modulos[$i]->getNumero_modulo() . "</a></li>";
        }

        return $listaModulos;
    }

    public function lista_visualizarModulos_lefcolumn($id_curso) {
        $modulos = $this->getListaModulo("id_curso=$id_curso ORDER BY numero_modulo");
        $quant = count($modulos);
        $i = 0;
        $listaModulos = "";
        for (; $i < $quant; $i++) {
            $listaModulos .= "<li><a class='navbar_item moduloIcon' href='#' id='index.php?c=ead&a=conteudo_modulo&id=" . $modulos[$i]->getId_modulo() . "'> Módulo " . $modulos[$i]->getNumero_modulo() . "</a></li>";
        }

        return $listaModulos;
    }

    public function lista_visualizarModulos_lefcolumn_aluno($id_curso) {
        $modulos = $this->getListaModulo('id_curso=' . $id_curso);
        $quant = count($modulos);
        $i = 0;
        $listaModulos = "";
        for (; $i < $quant; $i++) {
//            $listaModulos .= "<div class='accordion_leftcolumn '><div name='editar_modulo' class='accord'><h4 style='float:left;'>></h4><h3 id='index.php?c=ead&a=pag_modulo&id=" . $modulos[$i]->getId_modulo() . "'>Modulo " . $modulos[$i]->getNumero_modulo() . "</h3></div><div class='accord_content' style='display:none;'><ul style='list-style-type:none;'>";
            $listaModulos .= "<li><a class='navbar_item moduloIcon link desc' href='#' id='index.php?c=ead&a=pag_modulo&id=" . $modulos[$i]->getId_modulo() . "'> Módulo " . $modulos[$i]->getNumero_modulo() . "</a></li>";
//            $listaModulos .= "</ul></div></div>";
        }

        return $listaModulos;
    }

    public function listaVideo_aulas_modulo($id_modulo) {
        $controllerVideo = new controllerVideo();
        $lista = "";
        $videos = $controllerVideo->getListaVideos('id_modulo=' . $id_modulo);
        for ($i = 0; $i < count($videos); $i++) {
            $lista .= "<li class='conteudo_row' id='li_video_" . $videos[$i]->getId_video() . "'><label name='video' user='professor' class='link_video' id='index.php?c=ead&a=janela_video&id=" . $videos[$i]->getId_video() . "'>";
            $lista .= $videos[$i]->getTitulo();
            $lista .= "</label><input id='" . $videos[$i]->getId_video() . "' type='button' name='video' class='btn_del' value='Excluir' style='float: left;'/></li>";
            $lista .= "</li>";
        }
        return $lista;
    }

    public function visualizar_listaVideo_aulas_modulo($id_modulo) {
        $controllerVideo = new controllerVideo();
        $lista = "";
        $videos = $controllerVideo->getListaVideos('id_modulo=' . $id_modulo);
        $qnt = count($videos);
        for ($i = 0; $i < count($videos); $i++) {
            $lista .= "<li class='conteudo_row' id='li_video_" . $videos[$i]->getId_video() . "'><label name='video' class='link_video' id='index.php?c=ead&a=janela_video&id=" . $videos[$i]->getId_video() . "'>";
            $lista .= $videos[$i]->getTitulo();
            $lista .= "</label></li>";
        }
        if ($qnt < 1) {
            $lista = '<li class="conteudo_row"><label class="link_video">Não há registros de vídeo-aulas no sistema.</label></li>';
        }
        return $lista;
    }

    public function listaExercicio($id_modulo) {
        $controller = new controllerExercicio();
        $lista = "";
        $exercicio = $controller->getListaExercicio('id_modulo=' . $id_modulo);
        for ($i = 0; $i < count($exercicio); $i++) {
            $lista .= "<li class='conteudo_row' id='li_exercicio_" . $exercicio[$i]->getId_exercicio() . "'><label class='edt_exe' name='exercicio' id='index.php?c=ead&a=editar_exercicio&id=" . $exercicio[$i]->getId_exercicio() . "'>";
            $lista .= $exercicio[$i]->getTitulo();
            //BOTAO EDITAR - <input type='button' id='index.php?c=ead&a=editar_exercicio&id=" . $exercicio[$i]->getId_exercicio() . "' class='btn_edt edt" . $exercicio[$i]->getId_exercicio() . "' name='exercicio' value='Editar'/>
            $lista .= "</label><input id='" . $exercicio[$i]->getId_exercicio() . "' type='button' name='exercicio' class='btn_del' value='Excluir'/></li>";
        }
        return $lista;
    }

    public function visualizar_listaExercicio($id_modulo) {
        $controller = new controllerExercicio();
//        $controller2 = new controllerPergunta();
        $lista = "";
        $exercicio = $controller->getListaExercicio('id_modulo=' . $id_modulo);
        $controller = new controllerUsuario_exercicio();
        for ($i = 0; $i < count($exercicio); $i++) {
//            $id_pergunta = $controller2->getListaPerguntas('id_exercicio = ' . $exercicio[$i]->getId_exercicio());
            if ($_SESSION['usuarioLogado']->getId_papel() == 4) {
                if ($controller->getUsuario_exercicio('id_usuario=' . $_SESSION['usuarioLogado']->getId_usuario() . ' AND id_exercicio=' . $exercicio[$i]->getId_exercicio()) == null) {
                    $lista .= "<li class='conteudo_row' id='li_exercicio_" . $exercicio[$i]->getId_exercicio() . "'><label name='exercicio' id='index.php?c=ead&a=resolver_exercicio&id=" . $exercicio[$i]->getId_exercicio() . "'>";
                    $lista .= $exercicio[$i]->getTitulo();
                    $lista .= "</label><input type='button' id='index.php?c=ead&a=resolver_exercicio&id=" . $exercicio[$i]->getId_exercicio() . "' name='exercicio_" . $exercicio[$i]->getId_exercicio() . "' value='Resolver' class='btn_resolver btn_resolver_exe'/>";
                } else {
                    $lista .= "<li class='conteudo_row' id='li_exercicio_" . $exercicio[$i]->getId_exercicio() . "'><label class='btn_exercicio_resolvido' name='exercicio' id='" . $exercicio[$i]->getId_exercicio() . "'>";
                    $lista .= $exercicio[$i]->getTitulo();
                    $lista .= "</label>";
                }
            } else {
                $lista .= "<li class='conteudo_row' id='li_exercicio_" . $exercicio[$i]->getId_exercicio() . "'><label name='video' class='link_exercicio' id='index.php?c=ead&a=visualizar_exercicio&id=" . $exercicio[$i]->getId_exercicio() . "'>";
                $lista .= $exercicio[$i]->getTitulo();
                $lista .= "</label>";
                $lista .= "</label>";
            }
        }
        if ($i == 0) {
            $lista = 'Não há registros no sistema.';
        }
        $lista .= "</li>";
        return $lista;
    }

    /*
     * tipo pode ser: texto_referencia ou material_complementar
     */

    public function listaArquivos(Modulo $modulo, $tipo) {
        $lista = 0;
        $tipo = strtolower($tipo);
        if ($tipo == 'texto_referencia' || $tipo == 'material_complementar') {
            $link = "cursos/" . $modulo->getId_curso() . "/modulos/" . $modulo->getId_modulo() . "/" . $tipo . "/";
            $diretorio = ROOT_PATH . "/public/cursos/" . $modulo->getId_curso() . "/modulos/" . $modulo->getId_modulo() . "/" . $tipo . "/";
            $arquivos = glob($diretorio . "*.pdf");
            $controle = 0;
            if (!$arquivos && $tipo == 'material_complementar') {
                $arquivos = glob($diretorio . "*.mp4");
                $controle = 1;
            }
            $lista = "";
            $controller = 'controller' . ucfirst($tipo);
            $controller = new $controller;
            foreach ($arquivos as $arquivo) {
                $id = explode('.', basename($arquivo));
                $get = 'get' . ucfirst($tipo);
                $txt = $controller->$get('id_' . $tipo . '=' . $id[0]);
                $lista .= "<li class='conteudo_row' id='li_" . $tipo . "_" . $id[0] . "'><label>";
                if ($controle) {
                    $lista .= "<a href='index.php?c=ead&a=download&arquivo=" . $link . basename($arquivo) . "'>" . $txt->getNome() . "</a>";
                } else {
                    $lista .= "<a target='_blank' href='" . $link . basename($arquivo) . "'>" . $txt->getNome() . "</a>";
                }
                $lista .= "</label><input type='button' name='" . $tipo . "' id='" . $id[0] . "' class='btn_del' value='Excluir'/>";
                $lista .= "</li>";
            }
        }
        return $lista;
    }

    public function visualizar_listaArquivos(Modulo $modulo, $tipo) {
        $lista = 0;
        $tipo = strtolower($tipo);
        if ($tipo == 'texto_referencia' || $tipo == 'material_complementar') {
            $link = "cursos/" . $modulo->getId_curso() . "/modulos/" . $modulo->getId_modulo() . "/" . $tipo . "/";
            $diretorio = ROOT_PATH . "/public/cursos/" . $modulo->getId_curso() . "/modulos/" . $modulo->getId_modulo() . "/" . $tipo . "/";
            $arquivos = glob($diretorio . "*.pdf");
            $lista = "";
            $controller = 'controller' . ucfirst($tipo);
            $controller = new $controller;
            $aux = 1;
            foreach ($arquivos as $arquivo) {
                $aux = 0;
                $id = explode('.', basename($arquivo));
                $get = 'get' . ucfirst($tipo);
                $txt = $controller->$get('id_' . $tipo . '=' . $id[0]);
                $lista .= "<li class='conteudo_row' id='li_" . $tipo . "_" . $id[0] . "'><label>";
                $lista .= "<a target='_blank' href='" . $link . basename($arquivo) . "'>" . $txt->getNome() . "</a>";
                $lista .= "</label></li>";
            }
            if ($aux) {
                $lista = 'Não há registros no sistema.';
            }
        }
        return $lista;
    }

    public function listaModulos($id_curso) {
        $modulos = $this->getListaModulo('id_curso=' . $id_curso . ' ORDER BY numero_modulo');
        $quant = count($modulos);
        $i = 0;
        $listaModulos = "";
        for (; $i < $quant; $i++) {
            $listaModulos .= "<li class='lista_modulos' id=" . $modulos[$i]->getId_modulo() . "><label style='cursor: pointer;'><b>Módulo " . $modulos[$i]->getNumero_modulo() . ":</b> " . $modulos[$i]->getTitulo_modulo() . "</label></li>";
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

    public function removeDiretorioModulo(Modulo $modulo) {
        $caminho = ROOT_PATH . '/public/cursos/' . $modulo->getId_curso() . '/modulos/' . $modulo->getId_modulo();
        if (is_dir($caminho)) {
            $objects = scandir($caminho);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($caminho . "/" . $object) == "dir")
                        rmdir($caminho . "/" . $object); else
                        unlink($caminho . "/" . $object);
                }
            }
            reset($objects);
            rmdir($caminho);
        }
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

    public function setModulo() {
        if (!empty($_POST)) {
            if ($this->modulo == null) {
                $this->modulo = new Modulo();
            }
            foreach ($_POST as $k => $v) {
                $setAtributo = 'set' . ucfirst($k);
                if (method_exists($this->modulo, $setAtributo)) {
                    $this->modulo->$setAtributo($v);
                }
            }
        }
    }

    public function setArquivoVideo(Video $v) {
        $id_video = $v->getId_video();
        $id_modulo = $v->getId_modulo();
        $id_curso = $this->getModulo("id_modulo=" . $id_modulo)->getId_curso();
        if (isset($_FILES["video"])) {
            if ($_FILES["video"]["name"] != '') {
                $video = $_FILES["video"];
                $tipos = array("video/mp4");
                $pasta_dir = "../cursos/" . $id_curso . "/modulos/" . $id_modulo . "/video_aula/";
                if (in_array($video['type'], $tipos)) {
                    $video_mp4 = $pasta_dir . $id_video . ".mp4";
                    $video_webm = $pasta_dir . $id_video . ".webm";
                    if (is_file($video_mp4)) {
                        if (!unlink($video_mp4)) {
                            return 0;
                        }
                    }
                    if (is_file($video_webm)) {
                        if (!unlink($video_webm)) {
                            return 0;
                        }
                    }
                    move_uploaded_file($_FILES['video']['tmp_name'], $video_mp4);
                    return 1;
                }
            }
        }
        return 0;
    }

    public function removeVideoMp4(Video $v) {
        $id_video = $v->getId_video();
        $id_modulo = $v->getId_modulo();
        $id_curso = $this->getModulo("id_modulo=" . $id_modulo)->getId_curso();
        $video = $_FILES["video"];
        $tipos = array("video/mp4");
        $pasta_dir = "../cursos/" . $id_curso . "/modulos/" . $id_modulo . "/video_aula/";
        if (in_array($video['type'], $tipos)) {
            $video_mp4 = $pasta_dir . $id_video . ".mp4";
            if (is_file($video_mp4)) {
                if (!unlink($video_mp4)) {
                    return 0;
                }
            }
            return 1;
        }
        return 0;
    }

    /*
     * $tipo_arquivo: material complementar, bibliográfico e texto de referencia
     */

    public function setArquivoTexto_referencia(Texto_referencia $txt) {
        $id_curso = $this->getModulo("id_modulo=" . $txt->getId_modulo())->getId_curso();
        if (isset($_FILES["arquivo"])) {
            if ($_FILES["arquivo"]["name"] != '') {
                $arquivo = $_FILES["arquivo"];
                $tipos = array("application/pdf");
                $pasta_dir = "../cursos/" . $id_curso . "/modulos/" . $txt->getId_modulo() . "/texto_referencia/";
                if (in_array($arquivo['type'], $tipos)) {
                    $arquivo_nome = $pasta_dir . $txt->getId_texto_referencia() . '.pdf';
                    move_uploaded_file($_FILES["arquivo"]["tmp_name"], $arquivo_nome);
                    return 1;
                } else {
                    //2 - tipo inválido
                    return 2;
                }
            }
        }
        return 0;
    }

    public function setArquivoMaterial_complementar(Material_complementar $material) {
        $id_curso = $this->getModulo("id_modulo=" . $material->getId_modulo())->getId_curso();
        if (isset($_FILES["arquivo"])) {
            if ($_FILES["arquivo"]["name"] != '') {
                $arquivo = $_FILES["arquivo"];
                $tipos = array("application/pdf", "video/mp4");
                $pasta_dir = "../cursos/" . $id_curso . "/modulos/" . $material->getId_modulo() . "/material_complementar/";
                if (in_array($arquivo['type'], $tipos)) {
                    if ($arquivo['type'] == "video/mp4") {
                        $arquivo_nome = $pasta_dir . $material->getId_material_complementar() . '.mp4';
                        move_uploaded_file($_FILES["arquivo"]["tmp_name"], $arquivo_nome);
                        return 3;
                    } else {
                        $arquivo_nome = $pasta_dir . $material->getId_material_complementar() . '.pdf';
                    }
                    move_uploaded_file($_FILES["arquivo"]["tmp_name"], $arquivo_nome);
                    return 1;
                } else {
                    //2 - tipo inválido
                    return 2;
                }
            }
        }
        return 0;
    }

    public function convert_video(Video $v) {
        $id_curso = $this->getModulo("id_modulo=" . $v->getId_modulo())->getId_curso();
        $input = ROOT_PATH . "/public/cursos/" . $id_curso . "/modulos/" . $v->getId_modulo() . "/video_aula/" . $v->getId_video() . ".mp4";
        $output = ROOT_PATH . "/public/cursos/" . $id_curso . "/modulos/" . $v->getId_modulo() . "/video_aula/" . $v->getId_video() . ".webm";
        $cmd = "C:\\ffmpeg\bin\\ffmpeg -y -i " . $input . " " . $output;
        shell_exec($cmd);
    }

    public function inserir_video() {
        $v = $this->setConteudo('video');
        $controller = new controllerVideo();
        $v->setId_video($controller->novoVideo($v));
        if ($this->setArquivoVideo($v)) {
            $this->convert_video($v);
            $this->removeVideoMp4($v);
            $retorno = $v->getId_video() . '-' . $v->getTitulo();
            return $retorno;
        }
        $controller->deleteVideo($v);
        return 0;
    }

    public function atualizar_video() {
        $v = $this->setConteudo('video');
        $controller = new controllerVideo();
        $aux = $controller->getVideo("id_video=" . $v->getId_video());
        $v->setId_modulo($aux->getId_modulo());
        if ($this->setArquivoVideo($v)) {
            $controller->atualizaVideo($v);
            $this->convert_video($v);
            $retorno = $v->getId_video() . '-' . $v->getTitulo();
            return $retorno;
        } else {
            return 0;
        }
    }

    public function inserir_texto_referencia() {
        $texto = $this->setConteudo('texto_referencia');
        $controller = new controllerTexto_referencia();
        $texto->setId_texto_referencia($controller->novoTexto_referencia($texto));
        if ($this->setArquivoTexto_referencia($texto) == 1) {
            $retorno = $texto->getId_texto_referencia() . '-' . $texto->getNome() . "-.pdf";
            return $retorno;
        }
        $controller->deleteTexto_referencia($texto);
        return 0;
    }

    public function inserir_material_complementar() {
        $material = $this->setConteudo('material_complementar');
        $controller = new controllerMaterial_complementar();
        $material->setId_material_complementar($controller->novoMaterial_complementar($material));
        $aux = $this->setArquivoMaterial_complementar($material);
        if ($aux > 0 && $aux != 2) {
            $retorno = $material->getId_material_complementar() . '-' . $material->getNome();
            if ($aux == 3) {
                $retorno .= "-.mp4";
            } else {
                $retorno .= "-.pdf";
            }
            return $retorno;
        }
        $controller->deleteMaterial_complementar($material);
        return 0;
    }

    public function remover_exercicio($id_exercicio) {
        $controller = new controllerExercicio();
        $exe = $controller->getExercicio("id_exercicio=" . $id_exercicio);
        if ($controller->deleteExercicio($exe) > 0) {
            return 1;
        }
        return 0;
    }

    public function remover_video($id_video) {
        $controller = new controllerVideo();
        $v = $controller->getVideo("id_video=" . $id_video);
        $modulo = $this->getModulo("id_modulo=" . $v->getId_modulo());
        if ($controller->deleteVideo($v) > 0) {
            $diretorio_mp4 = ROOT_PATH . "/public/cursos/" . $modulo->getId_curso() . "/modulos/" . $v->getId_modulo() . "/video_aula/" . $v->getId_video() . ".mp4";
            $diretorio_webm = ROOT_PATH . "/public/cursos/" . $modulo->getId_curso() . "/modulos/" . $v->getId_modulo() . "/video_aula/" . $v->getId_video() . ".webm";
            if (unlink($diretorio_webm)) {
                return 1;
            }
        }
        return 0;
    }

    public function remover_texto_referencia($id_texto_referencia) {
        $controller = new controllerTexto_referencia();
        $txt = $controller->getTexto_referencia("id_texto_referencia=" . $id_texto_referencia);
        $modulo = $this->getModulo("id_modulo=" . $txt->getId_modulo());
        if ($controller->deleteTexto_referencia($txt) > 0) {
            $diretorio = ROOT_PATH . "/public/cursos/" . $modulo->getId_curso() . "/modulos/" . $txt->getId_modulo() . "/texto_referencia/" . $txt->getId_texto_referencia() . ".pdf";
            if (unlink($diretorio)) {
                return 1;
            }
        }
        return 0;
    }

    public function remover_material_complementar($id_material_complementar) {
        $controller = new controllerMaterial_complementar();
        $material = $controller->getMaterial_complementar("id_material_complementar=" . $id_material_complementar);
        $modulo = $this->getModulo("id_modulo=" . $material->getId_modulo());
        if ($controller->deleteMaterial_complementar($material) > 0) {
            $diretorio = ROOT_PATH . "/public/cursos/" . $modulo->getId_curso() . "/modulos/" . $material->getId_modulo() . "/material_complementar/" . $material->getId_material_complementar() . ".pdf";
            if (is_file($diretorio) && unlink($diretorio)) {
                return 1;
            } else {
                $diretorio = ROOT_PATH . "/public/cursos/" . $modulo->getId_curso() . "/modulos/" . $material->getId_modulo() . "/material_complementar/" . $material->getId_material_complementar() . ".mp4";
                if (is_file($diretorio) &&unlink($diretorio)) {
                    return 1;
                }
            }
        }
        return 0;
    }

    /*
     * atualiza atributos descritivos do modulo
     */

    public function atualizar_descritivo($id_modulo) {
        $this->modulo = $this->getModulo("id_modulo=" . $id_modulo);
        $this->setModulo();
        $dao = new ModuloDAO();
        if ($dao->update($this->modulo)) {
            return 1;
        }
        return 0;
    }

    /*
     * Adiciona novo Módulo no curso de id: $id_curso
     * @param $id_curso: id do curso    
     */

    public function adicionarModulo($id_curso) {
        $this->modulo = null;
        $this->setModulo();
        $this->modulo->setId_curso($id_curso);
        // se módulo já existe - numeração igual
//        if ($dao->select("id_curso =$id_curso AND numero_modulo = " . $this->modulo->getNumero_modulo()) != null) {
        //aqui atualiza em +1 as numerações dos módulos a partir da 'nova' numeração inserida
//            $dao->updateNumero_modulo($this->modulo->getNumero_modulo(), $id_curso);
//        }
        //insere modulo
        $dao = new ModuloDAO();
        $id = $dao->insert($this->modulo);
        if ($id) {
            $this->modulo->setId_modulo($id);
        }
        $this->criaDiretorioModulo($this->modulo);
        return $id;
    }

    public function removerModulo($id_modulo) {
        /* remover todos os itens relacionados com módulo:
         *  - vídeo, material complementar e etc
         */
        $m = $this->getModulo("id_modulo=$id_modulo");
        $this->removeDiretorioModulo($m);
        $dao = new ModuloDAO();
        $retorno = $dao->deleteModulo($m);
        return $retorno;
    }

    public function getQuantidadeExercicios($id_modulo) {
        $dao = new ExercicioDAO();
        return $dao->selectQuantidadeExercicio($id_modulo);
    }

}

?>
