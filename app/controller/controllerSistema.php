<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllerGerencia_sistema
 *
 * @author Rodolfo
 */
class controllerSistema {

    //put your code here
    private $patrocinador;
    private $destaque;
    private $noticia;
    private $comentario;

    //funcoes referentes a patrocinadores
    public function listaPatrocinadores() {
        $dao = new PatrocinadorDAO();
        $patrocinador = $dao->select();
        $quant = count($patrocinador);
        $lista = '<table><tr>';
        $aux = 1;
        for ($i = 0; $i < $quant; $i++) {
            $lista.="<td><div style='margin: 5px;'><div><a class='button3' href='index.php?c=ead&a=pini_patrocinadores&id=" . $patrocinador[$i]->getId_patrocinador() . "' style='position:relative; float:right; text-decoration:none; margin-bottom: 5px;'>Remover</a></div><img src='" . $patrocinador[$i]->getImagem() . "' /></div></td>";
            if ($aux % 4 == 0 && $aux != $quant) {
                $lista.="</tr><tr>";
            }
            $aux++;
        }
        $lista.="</tr><table>";
        return $lista;
    }

    /**/

    public function listaPatrocinadores_index() {
        $dao = new PatrocinadorDAO();
        $patrocinador = $dao->select();
        $quant = count($patrocinador);
        $i = 0;
        $lista = '';
        for (; $i < $quant; $i++) {
            $lista.="<img src='" . $patrocinador[$i]->getImagem() . "' width='200' height='200'/>";
        }
        return $lista;
    }

    /**/

    public function setPatrocinador_Post() {
        if (!empty($_POST)) {
            if ($this->patrocinador == null) {
                $this->patrocinador = new Patrocinador();
            }

            foreach ($_POST as $k => $v) {
                $setAtributo = 'set' . ucfirst($k);
                if (method_exists($this->patrocinador, $setAtributo)) {

                    $this->patrocinador->$setAtributo($v);
                }
            }
            return $this->patrocinador;
        }
    }

    /**/

    public function inserirFotoPatrocinador($id_patrocinador) {
        //Inserção da foto
        if (isset($_FILES["imagem"])) {
            if ($_FILES["imagem"]["name"] != '') {
                $imagem = $_FILES["imagem"];
                $tipos = array("image/jpg", "image/jpeg");
                $pasta_dir = "img/patrocinadores/";
                if (in_array($imagem["type"], $tipos)) {
                    $imagem_nome = $pasta_dir . $id_patrocinador . ".jpg";
                    move_uploaded_file($imagem["tmp_name"], $imagem_nome);
                    $imagem_arquivo = "img/patrocinadores/" . $id_patrocinador . ".jpg";
                    $this->patrocinador->setImagem($imagem_arquivo);
                    list($altura, $largura) = getimagesize($imagem_nome);
                    if ($altura > 200 && $largura > 200) {
                        $img = wiImage::load($imagem_arquivo);
                        $img = $img->resize(250, 250, 'outside');
                        $img = $img->crop('50% - 50', '50% - 40', 200, 200);
                        $img->saveToFile($imagem_arquivo);
                    }
                }
            }
        }
    }

    /**/

    public function inserir_patrocinador() {
        $this->patrocinador = new Patrocinador();
        $this->patrocinador->setImagem("img/patrocinadores/");
        //echo $this->patrocinador->getImagem();die();

        $this->patrocinador->setId_patrocinador($this->novoPatrocinador($this->patrocinador));
        $this->inserirFotoPatrocinador($this->patrocinador->getId_patrocinador());
        $dao = new PatrocinadorDAO();
        $dao->update($this->patrocinador);
        return $this->patrocinador;
    }

    /**/

    public function novoPatrocinador(Patrocinador $patrocinador = null) {
        if ($patrocinador != null) {
            $dao = new PatrocinadorDAO();
            //verifica se realmente já não existe o registro
            //prevenir reenvio de formulário

            return $dao->insert($patrocinador);

            // trigger_error("1 Reenvio de formulario, usuario ja cadastrado");
        } else {
            return 'ERRO: funcao novoPatrocinador - [ControllerGerencia_sistema]';
        }
    }

    /**/

    public function removerPatrocinador($id_patrocinador) {
        $dao = new PatrocinadorDAO();
        $dao->deletePorId($id_patrocinador);
        $caminho = ROOT_PATH . '/public/img/patrocinadores/' . $id_patrocinador . '.jpg';
        if (is_file($caminho)) {
            unlink($caminho);
        }
    }

    /**/

    //------------------------------------------------------------------------//
    //funcoes referentes a destaque
    public function setDestaque_Post() {
        if (!empty($_POST)) {
            if ($this->destaque == null) {
                $this->destaque = new Destaque();
            }

            foreach ($_POST as $k => $v) {
                $setAtributo = 'set' . ucfirst($k);
                if (method_exists($this->destaque, $setAtributo)) {

                    $this->destaque->$setAtributo($v);
                }
            }
            return $this->destaque;
        }
    }

    /**/

    public function inserirFotoDestaque($id_destaque) {
        //Inserção da foto
        if (isset($_FILES["imagem"])) {
            if ($_FILES["imagem"]["name"] != '') {
                $imagem = $_FILES["imagem"];
                $tipos = array("image/jpg", "image/jpeg");
                $pasta_dir = "img/destaques/";
                if (in_array($imagem["type"], $tipos)) {
                    $imagem_nome = $pasta_dir . $id_destaque . ".jpg";

                    move_uploaded_file($imagem["tmp_name"], $imagem_nome);
                    $imagem_arquivo = "img/destaques/" . $id_destaque . ".jpg";
                    $this->destaque->setDestaque($imagem_arquivo);

                    list($altura, $largura) = getimagesize($imagem_nome);
                    if ($altura > 300 && $largura > 650) {
                        $img = wiImage::load($imagem_arquivo);
                        $img = $img->resize(650, 300, 'outside');
                        $img->saveToFile($imagem_arquivo);
                    }
                }
            }
        }
    }

    /**/

    public function inserir_destaque() {
        $this->destaque = new Destaque();
        $this->destaque->setDestaque("img/destaques/");
        //echo $this->patrocinador->getImagem();die();
        $id = $this->novoDestaque($this->destaque);
        if (!$id) {
            return $id;
        } else {
            $this->destaque->setId_destaque($id);
            $this->inserirFotoDestaque($this->destaque->getId_destaque());
            $dao = new DestaqueDAO();
            $dao->update($this->destaque);
        }
        return $this->destaque;
    }

    /**/

    public function novoDestaque(Destaque $destaque = null) {
        if ($destaque != null) {
            $dao = new DestaqueDAO();
            //verifica se realmente já não existe o registro
            //prevenir reenvio de formulário

            return $dao->insert($destaque);

            // trigger_error("1 Reenvio de formulario, usuario ja cadastrado");
        } else {
            return 'ERRO: funcao novoPatrocinador - [ControllerGerencia_sistema]';
        }
    }

    /**/

    public function removerDestaque($id_destaque) {
        $dao = new DestaqueDAO();
        $dao->deletePorId($id_destaque);
        $caminho = ROOT_PATH . '/public/img/destaques/' . $id_destaque . '.jpg';
        if (is_file($caminho)) {
            unlink($caminho);
        }
    }

    /**/

    public function listaDestaques() {
        $dao = new DestaqueDAO();
        $destaque = $dao->select();
        $quant = count($destaque);
        $i = 0;
        $lista = '';
        for (; $i < $quant; $i++) {

            $lista.="<div><div style='margin-bottom: 5px;'><a class='button3' href='index.php?c=ead&a=pini_destaques&id=" . $destaque[$i]->getId_destaque() . "' style='position:relative; text-decoration:none;'>Remover</a></div><img src='" . $destaque[$i]->getDestaque() . "' /></div>";
        }
        return $lista;
    }

    /**/

    public function listaDestaques_index() {
        $dao = new DestaqueDAO();
        $destaque = $dao->select();
        $quant = count($destaque);
        $i = 0;
        $lista = '';
        for (; $i < $quant; $i++) {

            $lista.="<img src='" . $destaque[$i]->getDestaque() . "'/>";
        }
        return $lista;
    }

    /**/

    //------------------------------------------------------------------------//
    //funcoes de noticias
    public function setNoticia_Post() {
        if (!empty($_POST)) {
            if ($this->noticia == null) {
                $this->noticia = new Noticia();
            }

            foreach ($_POST as $k => $v) {
                $setAtributo = 'set' . ucfirst($k);
                if (method_exists($this->noticia, $setAtributo)) {

                    $this->noticia->$setAtributo($v);
                }
            }
            return $this->noticia;
        }
    }

    /**/

    public function inserir_noticia() {
        $this->noticia = new Noticia();
        //echo $this->patrocinador->getImagem();die();

        $this->setNoticia_Post();
        //$this->noticia->setImagem(null);
        $this->noticia->setId_noticia($this->novaNoticia($this->noticia));
        $this->inserirFotoNoticia($this->noticia->getId_noticia());
        return $this->noticia;
    }

    /**/

    public function novaNoticia(Noticia $noticia = null) {
        if ($noticia != null) {
            $dao = new NoticiaDAO();
            //verifica se realmente já não existe o registro
            //prevenir reenvio de formulário

            return $dao->insert($noticia);

            // trigger_error("1 Reenvio de formulario, usuario ja cadastrado");
        } else {
            return 'ERRO: funcao novoPatrocinador - [ControllerGerencia_sistema]';
        }
    }

    /**/

    public function inserirFotoNoticia($id_noticia) {
        //Inserção da foto
        if (isset($_FILES["imagem"])) {
            if ($_FILES["imagem"]["name"] != '') {
                $imagem = $_FILES["imagem"];
                $tipos = array("image/jpg", "image/jpeg");
                $pasta_dir = "img/noticias/";
                if (in_array($imagem["type"], $tipos)) {
                    $imagem_nome = $pasta_dir . $id_noticia . ".jpg";
//                    echo $imagem_nome; die();

                    move_uploaded_file($imagem["tmp_name"], $imagem_nome);
                    //$this->destaque->setDestaque($imagem_arquivo);
                }
            }
        }
    }

    public function removerNoticia($id_noticia) {
        $dao = new NoticiaDAO();
        $dao->deletePorId($id_noticia);
        $caminho = ROOT_PATH . '/public/img/noticias/' . $id_noticia . '.jpg';
        if (is_file($caminho)) {
            unlink($caminho);
        }
    }

    /**/

    public function atualizar_noticia() {
        $this->noticia = new Noticia();
        $this->setNoticia_Post();
        $this->inserirFotoNoticia($this->noticia->getId_noticia());
        $dao = new NoticiaDAO();
        $dao->update($this->noticia);
    }

    /**/

    public function listaNoticia() {
        $dao = new NoticiaDAO();
        $noticia = $dao->select();
        $quant = count($noticia);
        $i = 0;
        $lista = '';
        $c = 0;
        for (; $i < $quant; $i++) {
            if ($c > 4) {
                $c = 0;
            }
            $lista.="<div class='noticia b_$c'><div><p><b>:: </b>" . $noticia[$i]->getData() . " -<b> " . $noticia[$i]->getTitulo() . "</b></p>
                <span>" . $noticia[$i]->getManchete() . "</span></div>
                <div style='margin: 5px 0;'><a class='button3' style='margin-right: 5px;' href='index.php?c=ead&a=pini_editar_noticia&id=" . $noticia[$i]->getId_noticia() . "'>Editar</a><a class='button3' href='index.php?c=ead&a=pini_noticias&id=" . $noticia[$i]->getId_noticia() . "'>Remover</a></div>
                </div>";
            $c++;
        }
        return $lista;
    }

    /**/

    public function listaNoticia_index() {
        $dao = new NoticiaDAO();
        $noticia = $dao->select();
        $quant = count($noticia);
        $i = 0;
        $lista = '';
        $c = 0;
        for (; $i < $quant; $i++) {
            if ($c > 4) {
                $c = 0;
            }
            $lista.="<div class='noticia b_$c'><a href='index.php?c=index&a=noticia&id=" . $noticia[$i]->getId_noticia() . "'><div><p><b>:: </b>" . $noticia[$i]->getData() . " -<b> " . $noticia[$i]->getTitulo() . "</b></p>
                <span>" . $noticia[$i]->getManchete() . "</span></div></a></div>";
            $c++;
        }
        return $lista;
    }

    /**/

    //------------------------------------------------------------------------//
    //funcoes de comentarios
    /**/
    public function setComentario_Post() {
        if (!empty($_POST)) {
            if ($this->comentario == null) {
                $this->comentario = new Comentario();
            }

            foreach ($_POST as $k => $v) {
                $setAtributo = 'set' . ucfirst($k);
                if (method_exists($this->comentario, $setAtributo)) {

                    $this->comentario->$setAtributo($v);
                }
            }
            return $this->comentario;
        }
    }

    /**/

    public function inserir_comentario() {
        $this->comentario = new Comentario();
        //echo $this->patrocinador->getImagem();die();
        $this->setComentario_Post();
        $id = $this->novoComentario($this->comentario);
        if ($id) {
            $this->comentario->setId_comentario($id);
            return $this->comentario;
        }
        return $id;
    }

    /**/

    public function novoComentario(Comentario $comentario = null) {
        if ($comentario != null) {
            $dao = new ComentarioDAO();
            //verifica se realmente já não existe o registro
            //prevenir reenvio de formulário

            return $dao->insert($comentario);

            // trigger_error("1 Reenvio de formulario, usuario ja cadastrado");
        } else {
            return 'ERRO: funcao novoPatrocinador - [ControllerGerencia_sistema]';
        }
    }

    /**/

    public function atualizar_comentario() {
        $this->comentario = new comentario();
        $this->setComentario_Post();
        $dao = new ComentarioDAO();
        $dao->update($this->comentario);
    }

    /**/

    public function removerComentario($id_comentairo) {
        $dao = new ComentarioDAO();
        $dao->deletePorId($id_comentairo);
    }

    /**/

    public function listaComentarios() {
        $dao = new ComentarioDAO();
        $comentario = $dao->select();
        $quant = count($comentario);
        $i = 0;
        $c = 0;
        for (; $i < $quant; $i++) {
            if ($c > 4) {
                $c = 0;
            }
            $lista.="<div class='comentario b_$c'><div><p><b>:: </b>" . $comentario[$i]->getData() . " -<b> " . $comentario[$i]->getAutor() . "</b></p>
                <span>" . $comentario[$i]->getComentario() . "</span></div>
                <div style='margin: 5px 0;'><a class='button3' href='index.php?c=ead&a=pini_comentarios&id=" . $comentario[$i]->getId_comentario() . "'>Remover</a></div>
                </div>";
            $c++;
        }
        return $lista;
    }

    /**/

    public function listaComentarios_index() {
        $dao = new ComentarioDAO();
        $comentario = $dao->select();
        $quant = count($comentario);
        $i = 0;
        $lista = '';
//        echo $quant;die();
        $c = 0;
        for (; $i < $quant; $i++) {
            if ($c > 4) {
                $c = 0;
            }
            $lista.="<div class='comentario b_$c'><p> " . $comentario[$i]->getComentario() . "</p>
                <span>" . $comentario[$i]->getAutor() . " - </span>" . $comentario[$i]->getData() . "</div>";
            $c++;
        }
        return $lista;
    }

    /**/
    
          //funcoes referentes a FOTOS
    public function listaFotos(){
        $dao = new FotoDAO();
        $foto = $dao->select();
        $quant = count($foto);
        $i=0;
        $lista='';
        for(;$i<$quant;$i++){
           
            $lista.="<div class='foto_holder'><div style='overflow:auto;'><a href='index.php?c=ead&a=pini_fotos&id=".$foto[$i]->getId_foto()."' style='position:relative;float:right;'>x</a></div><img src='".$foto[$i]->getImagem()."' /></div>";
        }
        return $lista;
    }
    /**/
    public function listaFotos_index(){
        $dao = new PatrocinadorDAO();
        $patrocinador = $dao->select();
        $quant = count($patrocinador);
        $i=0;
        $lista='';
        for(;$i<$quant;$i++){
            $lista.="<img src='".$patrocinador[$i]->getImagem()."' width='200' height='200'/>";
        }
        return $lista;
    }
    /**/
    public function setFoto_Post() {
        if (!empty($_POST)) {
            if ($this->foto == null) {
                $this->foto= new Patrocinador();
            }

            foreach ($_POST as $k => $v) {
                $setAtributo = 'set' . ucfirst($k);
                if (method_exists($this->foto, $setAtributo)) {

                    $this->foto->$setAtributo($v);
                }
            }
            return $this->foto;
        }
    }
    /**/
    public function inserirFoto($id_foto) {
        //Inserção da foto
        if (isset($_FILES["imagem"])) {
            if ($_FILES["imagem"]["name"] != '') {
                $imagem = $_FILES["imagem"];
                $tipos = array("image/jpg", "image/jpeg");
                $pasta_dir = "img/fotos/";
                if (in_array($imagem["type"], $tipos)) {
                    $imagem_nome = $pasta_dir . $id_foto . ".jpg";
                    move_uploaded_file($imagem["tmp_name"], $imagem_nome);
                    $imagem_arquivo = "img/fotos/" . $id_foto . ".jpg";
                    $this->foto->setImagem($imagem_arquivo);
                    list($altura, $largura) = getimagesize($imagem_nome);
                    if ($altura > 200 && $largura > 200) {
                        $img = wiImage::load($imagem_arquivo);
                        $img = $img->resize(250, 250, 'outside');
                        $img = $img->crop('50% - 50', '50% - 40', 200, 200);
                        $img->saveToFile($imagem_arquivo);
                    }
                    
                }
            }
        }
    }
    /**/
    public function inserir_foto() {
        $this->foto = new Foto();
        $this->foto->setImagem("img/fotos/");
        //echo $this->patrocinador->getImagem();die();        
        $this->foto->setId_foto($this->novaFoto($this->foto));
        $this->inserirFoto($this->foto->getId_foto());
        $dao = new FotoDAO();
        $dao->update($this->foto);
        return $this->foto;
    }
    /**/
    public function novaFoto(Foto $foto = null) {
        if ($foto != null) {
            $dao = new FotoDAO();
            //verifica se realmente já não existe o registro
            //prevenir reenvio de formulário

            return $dao->insert($foto);

           // trigger_error("1 Reenvio de formulario, usuario ja cadastrado");
        } else {
            return 'ERRO: funcao novaFoto - [ControllerGerencia_sistema]';
        }
    }
    /**/
    public function removerFoto($id_foto){
        $dao = new PatrocinadorDAO();
        $dao->deletePorId($id_foto);
         $caminho = ROOT_PATH . '/public/img/fotos/' . $id_foto . '.jpg';
         if(is_file($caminho)){
             unlink($caminho);
         }
    }
    /**/
    //------------------------------------------------------------------------//
}

?>
