<?php

class Biotran_Mvc_View {
    
    public $usuario;
    
    public function renderizar($diretorio, $arquivo) {        
        $local = '../app/view/';
        require $local . $diretorio . '/' . $arquivo;
    }

}

?>
