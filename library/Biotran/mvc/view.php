<?php

class Biotran_Mvc_View {
    
    public $curso = null;
    public $usuario = null;
    public $endereco = null;
    public $options = null;
    
    public function renderizar($diretorio, $arquivo) {        
        $local = '../app/view/';
        require $local . $diretorio . '/' . $arquivo;
    }
    
    public function renderizar_get($diretorio, $arquivo) {
        $local = '../app/view/';
        require $local . $diretorio . '/' . $arquivo;
    }

}

?>
