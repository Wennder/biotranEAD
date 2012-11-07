<?php

class Biotran_Mvc_View {

    public $curso = null;
    public $usuario = null;
    public $endereco = null;
    public $options = null;
    public $listaCursos = null;
    public $msgErro_html = null;

    public function renderizar($diretorio, $arquivo) {

        //se realmente existe alguém logado
        if ($diretorio!='index' && $arquivo != 'profile.php' && $arquivo != 'index.php' && $arquivo!='acesso_negado.php' && $arquivo != 'forum.php'
                && $arquivo!='adicionar_topico.php' && $arquivo!='topico.php' && $arquivo!='responder_topico.php') {
           
            if (isset($_SESSION['usuarioLogado'])) {
                $user = $_SESSION['usuarioLogado'];
                $controller = new controllerPapel();
                if ($user->getId_papel() == 1) {
                    $diretorio .= '/sistema';
                }
                $local = '../app/view/' . $diretorio;
                require $local . '/' . strtolower($controller->getPapel("id_papel=" . $user->getId_papel())->getPapel()) . '/' . $arquivo;
            }
        } else {//controllerIndex nao tem restricao
            $local = '../app/view/';
            require $local . $diretorio . '/' . $arquivo;
        }
    }

    public function renderizar_erro($msgErro_html) {
        $this->msgErro_html = $msgErro_html;
        $local = '../app/view/';
        require $local . 'error' . '/' . 'index.php';
    }

}

?>
