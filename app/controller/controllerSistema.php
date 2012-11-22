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
    public function listaPatrocinadores(){
        $dao = new PatrocinadorDAO();
        $patrocinador = $dao->select();
        $quant = count($patrocinador);
        $i=0;
        $lista='';
        for(;$i<$quant;$i++){
           
            $lista.="<div class='patrocinador_holder'><div style='overflow:auto;'><a href='index.php?c=ead&a=patrocinadores&id=".$patrocinador[$i]->getId_patrocinador()."' style='position:relative;float:right;'>x</a></div><img src='".$patrocinador[$i]->getImagem()."' /></div>";
        }
        return $lista;
    }
    /**/
    public function listaPatrocinadores_index(){
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
                $tipos = array("image/jpg");
                $pasta_dir = "img/patrocinadores/";
                if (!in_array($imagem["type"], $tipos)) {
                    $imagem_nome = $pasta_dir . $id_patrocinador . ".jpg";
//                    print_r($_FILES); echo $imagem_nome; die();
                    
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
    public function novoPatrocinador(Destaque $patrocinador = null) {
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
    public function removerPatrocinador($id_patrocinador){
        $dao = new PatrocinadorDAO();
        $dao->deletePorId($id_patrocinador);
         $caminho = ROOT_PATH . '/public/img/patrocinadores/' . $id_patrocinador . '.jpg';
         if(is_file($caminho)){
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
                $tipos = array("image/jpg");
                $pasta_dir = "img/destaques/";
                if (!in_array($imagem["type"], $tipos)) {
                    $imagem_nome = $pasta_dir . $id_destaque . ".jpg";
                    
                    move_uploaded_file($imagem["tmp_name"], $imagem_nome);
                    $imagem_arquivo = "img/destaques/" . $id_destaque . ".jpg";
                    $this->destaque->setDestaque($imagem_arquivo);
                    list($altura, $largura) = getimagesize($imagem_nome);
                    if ($altura > 300 && $largura > 650) {
                        $img = wiImage::load($imagem_arquivo);
                        $img = $img->resize(700, 350, 'outside');
                        $img = $img->crop('50% - 50', '50% - 40', 300, 650);
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
        
        $this->destaque->setId_destaque($this->novoDestaque($this->destaque));
        $this->inserirFotoDestaque($this->destaque->getId_destaque());
        $dao = new DestaqueDAO();
        $dao->update($this->destaque);
        return $this->destaque;
    }
    /**/
    public function novoDestaque(Destaque $destaque= null) {
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
    public function removerDestaque($id_destaque){
        $dao = new DestaqueDAO();
        $dao->deletePorId($id_destaque);
         $caminho = ROOT_PATH . '/public/img/destaques/' . $id_destaque . '.jpg';
         if(is_file($caminho)){
             unlink($caminho);
         }
    }
    /**/
    public function listaDestaques(){
        $dao = new DestaqueDAO();
        $destaque = $dao->select();
        $quant = count($destaque);
        $i=0;
        $lista='';
        for(;$i<$quant;$i++){
           
            $lista.="<div class='destaque_holder'><div style='overflow:auto;'><a href='index.php?c=ead&a=destaques&id=".$destaque[$i]->getId_destaque()."' style='position:relative;'>x</a></div><img src='".$destaque[$i]->getDestaque()."' /></div>";
        }
        return $lista;
    }
    /**/
    public function listaDestaques_index(){
        $dao = new DestaqueDAO();
        $destaque = $dao->select();
        $quant = count($destaque);
        $i=0;
        $lista='';
        for(;$i<$quant;$i++){
           
            $lista.="<img src='".$destaque[$i]->getDestaque()."'/>";
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
     public function novaNoticia(Noticia $noticia= null) {
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
                $tipos = array("image/jpg");
                $pasta_dir = "img/noticias/";
                if (!in_array($imagem["type"], $tipos)) {
                    $imagem_nome = $pasta_dir . $id_noticia . ".jpg";
//                    echo $imagem_nome; die();
                    
                    move_uploaded_file($imagem["tmp_name"], $imagem_nome);
                    //$this->destaque->setDestaque($imagem_arquivo);
                   
                    
                }
            }
        }
    }
    public function removerNoticia($id_noticia){
        $dao = new NoticiaDAO();
        $dao->deletePorId($id_noticia);
         $caminho = ROOT_PATH . '/public/img/noticias/' . $id_noticia . '.jpg';
         if(is_file($caminho)){
             unlink($caminho);
         }
    }
    /**/
    public function atualizar_noticia(){
        $this->noticia = new Noticia();
        $this->setNoticia_Post();
        $this->inserirFotoNoticia($this->noticia->getId_noticia());
        $dao = new NoticiaDAO();
        $dao->update($this->noticia);
    }
    /**/
     public function listaNoticia(){
        $dao = new NoticiaDAO();
        $noticia = $dao->select();
        $quant = count($noticia);
        $i=0;
        $lista='';
        for(;$i<$quant;$i++){
           
            $lista.="<div><p><b>::</b>".$noticia[$i]->getData()." -<b> ".$noticia[$i]->getTitulo()."</b></p>
                <span>".$noticia[$i]->getManchete()."</span><ul style='list-style:none;'><li style='display:inline;float:left;margin-right:10px;'>
                    <a href='index.php?c=ead&a=editar_noticia&id=".$noticia[$i]->getId_noticia()."'>editar</a></li><li><a href='index.php?c=ead&a=noticias&id=".$noticia[$i]->getId_noticia()."'>remover</a></li></ul></div>";
        }
        return $lista;
    }
    /**/
    public function listaNoticia_index(){
        $dao = new NoticiaDAO();
        $noticia = $dao->select();
        $quant = count($noticia);
        $i=0;
        $lista='';
        $c =0;
        for(;$i<$quant;$i++){
           if($c>4){
               $c=0;
           }
            $lista.="<div class='noticia b_$c'><a href='index.php?c=index&a=noticia&id=".$noticia[$i]->getId_noticia()."'><div><p><b>:: </b>".$noticia[$i]->getData()." -<b> ".$noticia[$i]->getTitulo()."</b></p>
                <span>".$noticia[$i]->getManchete()."</span></div></a></div>";
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
        $this->comentario->setId_comentario($this->novoComentario($this->comentario));
        return $this->comentario;
    }
    /**/
     public function novoComentario(Comentario $comentario= null) {
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
    public function atualizar_comentario(){
        $this->comentario = new comentario();
        $this->setComentario_Post();
        $dao = new ComentarioDAO();
        $dao->update($this->comentario);
    }
    /**/
    public function removerComentario($id_comentairo){
        $dao = new ComentarioDAO();
        $dao->deletePorId($id_comentairo);
         
    }
    /**/
    public function listaComentarios(){
        $dao = new ComentarioDAO();
        $comentario = $dao->select();
        $quant = count($comentario);
        $i=0;
        $lista='';
//        echo $quant;die();
        for(;$i<$quant;$i++){
           
            $lista.="<div><p> ".$comentario[$i]->getComentario()."</p>
                <span>".$comentario[$i]->getAutor()." - </span>".$comentario[$i]->getData()." <ul style='list-style:none;'><li style='display:inline;float:left;margin-right:10px;'>
                    <a href='index.php?c=ead&a=editar_comentario&id=".$comentario[$i]->getId_comentario()."'>editar</a></li><li><a href='index.php?c=ead&a=comentarios&id=".$comentario[$i]->getId_comentario()."'>remover</a></li></ul></div>";
        }
        return $lista;
    }
    /**/
     public function listaComentarios_index(){
        $dao = new ComentarioDAO();
        $comentario = $dao->select();
        $quant = count($comentario);
        $i=0;
        $lista='';
//        echo $quant;die();
        $c=0;
        for(;$i<$quant;$i++){
           if($c>4){
               $c=0;
           }
            $lista.="<div class='comentario b_$c'><p> ".$comentario[$i]->getComentario()."</p>
                <span>".$comentario[$i]->getAutor()." - </span>".$comentario[$i]->getData()."</div>";
            $c++;
        }
        return $lista;
    }
    /**/
    //------------------------------------------------------------------------//
}

?>
