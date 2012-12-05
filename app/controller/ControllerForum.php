<?php

class ControllerForum {
    //put your code here

    const COR_LINHA_PAR = '#CCCCCC';
    const COR_LINHA_IMPAR = '#DDDDDD';

    private $topico = null;
    private $usuario = null;
    private $resposta = null;

    public function getTitulo() {
        if ($this->topico != null) {
            return $this->topico[0]->getTitulo();
        }
    }

    public function getMensagem() {
        if ($this->topico != null) {
            return $this->topico[0]->getMensagem();
        }
    }

    public function getUsuarioNome() {
        if ($this->topico != null) {
            $dao = new UsuarioDAO();
            $user = $dao->select("id_usuario=" . $this->topico[0]->getId_usuario());
            return $user[0]->getNome_completo();
        }
    }

    public function getData_hora() {
        if ($this->topico != null) {
            return $this->topico[0]->getData_hora();
        }
    }

    //buscas no banco
    //altera a variavel global diferente da ListaTopicos
    public function getTopico($condicao) {
        $dao = new TopicoDAO();
        $this->topico = $dao->select($condicao);
        return $this->topico;
    }

    public function getListaTopicos($condicao) {
        $dao = new TopicoDAO();
        $topico = $dao->select($condicao);
        return $topico;
    }

    public function getUsuario($condicao) {
        $dao = new UsuarioDAO();
        $usuario = $dao->select($condicao);
        return $usuario;
    }

    public function getListaRespostas($condicao) {
        $dao = new RespostaDAO();
        $respostas = $dao->select($condicao);
        return $respostas;
    }

    //mostra os topicos
    public function listTopicos($id_curso) {
        $topicos = $this->getListaTopicos('id_curso=' . $id_curso);

        $quant = count($topicos);
        $i = 0;
        $lista_topicos = "";
        for (; $i < $quant; $i++) {
            $corlinha = ($i % 2 == 0) ? self::COR_LINHA_PAR : self::COR_LINHA_IMPAR;
            $respostas = $this->getListaRespostas("id_topico=" . $topicos[$i]->getId_topico());
            $quant_respostas = count($respostas);
            $lista_topicos.="<tr id='lista_topicos-".$topicos[$i]->getId_topico()."' bgcolor='$corlinha' onmouseover=\"mouseover(this);\" onmouseout=\"mouseout(this, '$corlinha');\" onclick=\"mouseclick(this, '$corlinha')\" >";
            $lista_topicos.="<td>";
            $lista_topicos.=$topicos[$i]->getTitulo();
            $lista_topicos.="</td>";
            $lista_topicos.="<td>";
            $user = $this->getUsuario("id_usuario=" . $topicos[$i]->getId_usuario());
            $lista_topicos.=$user[0]->getNome_completo();
            $lista_topicos.="</td>";
            $lista_topicos.="<td align='center'>";
            $lista_topicos.= $quant_respostas;
            $lista_topicos.="</td>";
            //Adicionar links a cada linha da tabela
            $lista_topicos.="<td><fr><a name='topico' href='#' id='index.php?c=ead&a=topico&id=" . $topicos[$i]->getId_topico() . "'>";
            $lista_topicos.="<img src='../public/img/botao_visualizar.png' title='Visualizar' />";
            $lista_topicos.="</td></a></fr>";
            if ($topicos[$i]->getId_usuario() == $_SESSION['usuarioLogado']->getId_usuario()) {
                $lista_topicos.="<td><input type='button' title='Excluir' class='classeBotaoExcluir btn_excluir_topico' name='lista_topico' id='" . $topicos[$i]->getId_topico() . "'/>";
//                $lista_topicos.="<img src='../public/img/botao_excluir.png' title='Excluir' />";
//                $lista_topicos.="</input></td>";
            } else {
                $lista_topicos.="<td ><img src='../public/img/botao_excluir_desativado.png' title='' /></td>";
            }
        }
        $lista_topicos.="</tr>";
        return $lista_topicos;
    }

    //mostra as respostas
    public function listaRespostas($id_topico) {
        $respostas = $this->getListaRespostas("id_topico=" . $id_topico);

        $this->getTopico("id_topico=" . $id_topico);
        $quant = count($respostas);
        $i = 0;
        $return = "";
        for (; $i < $quant; $i++) {
            ($i % 2 == 0) ? $id_fundo = 'fundo1' : $id_fundo = 'fundo2';
            $return.="<div id='".$id_fundo."' name='".$respostas[$i]->getId_resposta()."'><div class='$id_fundo" . "_header'>";
            if ($respostas[$i]->getId_usuario() == $_SESSION['usuarioLogado']->getId_usuario()) {
                $return.="<input style='float:right;' class='classeBotaoExcluir btn_excluir_resposta' id='" . $respostas[$i]->getId_resposta() . "' name='".$this->topico[0]->getId_topico()."'/>";
            }
            $return.="<b>Re: </b>" . $this->topico[0]->getTitulo() . "<br>";
            $usuario = $this->getUsuario("id_usuario=" . $respostas[$i]->getId_usuario());
            $return.="<b>Autor: </b>" . $usuario[0]->getNome_completo();
            $return.="<span>  " . $this->topico[0]->getData_hora() . "</span>";
            $return.="</div><div class='$id_fundo" . "_mensagem'><p>" . $respostas[$i]->getMensagem() . "</p></div><br><a href='index.php?c=ead&a=responder_topico&id=" . $this->topico[0]->getId_topico() . "' id='forum_responder'>Responder</a></div><br>";
        }

        return $return;
    }

    //funcoes de inserção no banco de um topico
    public function setTopico_Post() {
        if (!empty($_POST)) {
            if ($this->topico == null) {
                $this->topico = new Topico();
            }
            foreach ($_POST as $k => $v) {
                $setAtributo = 'set' . ucfirst($k);
                if (method_exists($this->topico, $setAtributo)) {
                    $this->topico->$setAtributo($v);
                }
            }
            return $this->topico;
        }
    }

    public function inserir_topico() {
        $resposta = $this->setTopico_Post();
        $id = $this->novoTopico($this->topico);
        if ($id != 0) {
            $resposta->setId_topico($id);
            return $resposta;
        }
        return 0;
    }

    public function novoTopico(Topico $topico = null) {
        if ($topico != null) {
            $dao = new TopicoDAO();
            //verifica se realmente já não existe o registro
            //prevenir reenvio de formulário
            return $dao->insert($topico);
        } else {
            return 'ERRO: funcao novoTopico - [controllerUsuario]';
        }
    }

    //funcoes de insercao no bando de uma resposta 
    public function setResposta_Post() {
        if (!empty($_POST)) {
            if ($this->resposta == null) {
                $this->resposta = new Resposta();
            }

            foreach ($_POST as $k => $v) {
                $setAtributo = 'set' . ucfirst($k);
                if (method_exists($this->resposta, $setAtributo)) {

                    $this->resposta->$setAtributo($v);
                }
            }
            return $this->resposta;
        }
    }

    public function inserir_resposta() {
        $resposta = $this->setResposta_Post();
        $id = $this->novaResposta($this->resposta);
        if ($id != 0) {
            $resposta->setId_resposta();
            return $resposta;
        }
        return 0;
    }

    public function novaResposta(Resposta $resposta = null) {
        if ($resposta != null) {
            $dao = new RespostaDAO();
            //verifica se realmente já não existe o registro
            //prevenir reenvio de formulário
            return $dao->insert($resposta);           
        } else {
            return 'ERRO: funcao novoTopico - [controllerUsuario]';
        }
    }

    public function removerResposta($id_resposta) {
        $dao = new RespostaDAO();
        return $dao->deletePor_id($id_resposta);
    }

    public function removerTopico($id_topico) {
        $dao = new TopicoDAO();
        return $dao->deletePor_id($id_topico);
    }

}
?>
