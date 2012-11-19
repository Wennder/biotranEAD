<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Noticia
 *
 * @author Rodolfo
 */
class Noticia {
    //put your code here
    private $id_noticia;
    private $titulo;
    private $noticia;
    private $data;
    private $manchete;
    private $imagem;
    private $autor;
    
    public function getId_noticia(){
        return $this->id_noticia ;
    }
    public function getTitulo(){
        return $this->titulo ;
    }
    public function getNoticia(){
        return $this->noticia ;
    }
    public function getData(){
        return $this->data ;
    }
    public function getManchete(){
        return $this->manchete ;
    }
    
    public function getImagem(){
        return $this->imagem;
    }
    public function getAutor(){
        return $this->autor;
    }
    
    public function setId_noticia($id_noticia){
        $this->id_noticia = $id_noticia ;
    }
    public function setTitulo($titulo){
        $this->titulo = $titulo ;
    }
    public function setNoticia($noticia){
        $this->noticia = $noticia ;
    }
    public function setData($data){
        $this->data =  $data;
    }
    public function setManchete($manchete){
        $this->manchete = $manchete ;
    }
    
    public function setImagem($imagem){
        $this->imagem = $imagem;
    }
    public function setAutor($autor){
        $this->autor = $autor;
    }
    
}

?>
