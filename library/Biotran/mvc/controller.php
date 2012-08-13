<?php

class Biotran_Mvc_Controller {

    protected $visao;

    public function __construct() {
        $this->visao = new Biotran_Mvc_View();
    }

    public function renderizar() {
        $diretorio = strtolower(Biotran_Mvc::pegarInstancia()->pegarControlador());
        $arquivo = strtolower(Biotran_Mvc::pegarInstancia()->pegarAcao()) . ".php";
        //$this->visao = new Biotran_Mvc_View();
        $this->visao->renderizar($diretorio, $arquivo);
    }
}

?>
