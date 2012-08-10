<?php

class Biotran_Mvc_View {
    
    public function __construct() {
        ;
    }
    
    public function renderizar($diretorio, $arquivo) {
        $local = '../app/view/';
        require $local . $diretorio . '/' . $arquivo;
    }

}

?>
