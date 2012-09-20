<?php

class Biotran_Mvc_View {
    
    public $curso = null;
    public $usuario = null;
    public $endereco = null;
    public $options = null;    
    
    public $msgErro_html = null;
    
    public function renderizar($diretorio, $arquivo) {        
        $local = '../app/view/';
        require $local . $diretorio . '/' . $arquivo;
    }
    
    public function renderizar_erro($msgErro_html) {
        $this->msgErro_html = $msgErro_html;
        $local = '../app/view/';
        require $local . 'error' . '/' . 'index.php';
    }

}

?>
