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
    
    public function listaPatrocinadores(){
        $dao = new PatrocinadorDAO();
        $patrocinador = $dao->select();
        $quant = count($patrocinador);
        $i=0;
        $lista='';
        for(;$i<$quant;$i++){
           
            $lista.="<div class='patrocinador_holder'><a href='#'>x</a><img src='".$patrocinador[$i]->getImagem()."' /></div>";
        }
        return $lista;
    }
    
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

    public function inserirFotoPatrocinador($id_patrocinador) {
        //Inserção da foto
        if (isset($_FILES["imagem"])) {
            if ($_FILES["imagem"]["name"] != '') {
                $imagem = $_FILES["imagem_patrocinador"];
                $tipos = array("image/jpg");
                $pasta_dir = "../img/patrocinadores/";
                if (!in_array($imagem['type'], $tipos)) {
                    $imagem_nome = $pasta_dir . $id_patrocinador . ".jpg";
                    move_uploaded_file($imagem["tmp_name"], $imagem_nome);
                    $imagem_arquivo = "../img/patrocinadores/" . $id_patrocinador . ".jpg";
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
    
    public function inserir_patrocinador() {
        $this->patrocinador = new Patrocinador();
        $this->patrocinador->setImagem("../img/patrocinadores/");
        //echo $this->patrocinador->getImagem();die();
        
        $this->patrocinador->setId_patrocinador($this->novoPatrocinador($this->patrocinador));
        $this->inserirFotoPatrocinador($this->patrocinador->getId_patrocinador());
        $dao = new PatrocinadorDAO();
        $dao->update($this->patrocinador);
        return $this->patrocinador;
    }

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
    
    public function removerPatrocinador($id_patrocinador){
        $dao = new PatrocinadorDAO();
        $dao->deletePorId($id_patrocinador);
    }
    
}

?>
