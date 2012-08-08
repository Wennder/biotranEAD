<?php

class ControllerIndex extends Biotran_Mvc_Controller{

    public function actionIndex() {
        $this->visao->titulo = "Blog Planeta Framework";
        $this->renderizar();
//        echo "Sou a acao inicial";
    }

}

?>
