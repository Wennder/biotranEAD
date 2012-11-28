<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controllerEercicio
 *
 * @author cead-p057007
 */
class controllerExercicio {
    /*
     * Retorna apenas um exercicio de acordo com a condicao da query.
     * Se houver mais de um registro em banco, apenas o primeiro sera retornado
     * 
     * @param $condicao = condicao de busca do tipo String no formato ex.: 'id_exercicio_usuario=1'
     * 
     * @return Objeto exercicio encontrado, ou o primeiro da lista
     */

    public function getExercicio($condicao) {
        $dao = new ExercicioDAO();
        $exe = $dao->select($condicao);
        if ($exe != null) {
            return $exe[0];
        }
        return $exe; // null
    }

    /*
     * Retorna uma lista de exercicios de acordo com a condicao da query.
     * condicao de busca do tipo String no formato ex.: 'id_exercicio_usuario=1'     
     * 
     * @param string $condicao
     * @return array de objetos exercicio_usuario encontrado
     */

    public function getListaExercicio($condicao) {
        $dao = new ExercicioDAO();
        $exe = $dao->select($condicao);
        return $exe;
    }

    /*
     * Retorna uma lista de todos os usuarios
     *      
     * @return array de objetos com todos os usuarios
     */

    public function getAllExercicio() {
        $dao = new ExercicioDAO();
        $exe = $dao->select();
        return $exe;
    }

    public function novoExercicio(Exercicio $e) {
        if ($e != null) {
            $dao = new ExercicioDAO();
            return $dao->insert($e);
        } else {
            return 'ERRO: funcao novoExercicio - [controllerExercicio]';
        }
    }

    public function deleteExercicio(Exercicio $exe) {
        $dao = new ExercicioDAO();
        return $dao->delete($exe);
    }

    public function setConteudo($conteudo) {
        $classe = ucfirst(strtolower($conteudo));
        $objeto = new $classe();
        if (!empty($_POST)) {
            foreach ($_POST as $k => $v) {
                $aux = explode('_', $k);
                $setAtributo = 'set' . ucfirst($aux[0]);
                if (method_exists($objeto, $setAtributo)) {
                    $objeto->$setAtributo($v);
                }
                $setAtributo = 'set' . ucfirst($k);
                if (method_exists($objeto, $setAtributo)) {
                    $objeto->$setAtributo($v);
                }
            }
        }
        return $objeto;
    }

    public function inserir_exercicio() {
        $e = $this->setConteudo('exercicio');
        $controller = new controllerExercicio();
        $e->setId_exercicio($controller->novoExercicio($e));
        if ($e->getId_exercicio() != 0) {
            $retorno = $e->getId_exercicio() . '-' . $e->getTitulo();
            return $retorno;
        }
        return 0;
    }

    public function inserir_pergunta($id_exercicio) {
        $controller = new controllerPergunta();
        $pergunta = $controller->setPergunta();
        $pergunta->setId_exercicio($id_exercicio);
        $pergunta->setId_pergunta($controller->novoPergunta($pergunta));
        $controller = new controllerAlternativa();
        $alternativa = $controller->setTodasAlternativa();
        for ($i = 0; $i < count($alternativa); $i++) {
            $alternativa[$i]->setId_pergunta($pergunta->getId_pergunta());
            $controller->novoAlternativa($alternativa[$i]);
        }
        $controller = new controllerPergunta();
        //prepara o DOM para inserir na lista de perguntas
        $retorno = array('form' => $this->formNovaPergunta($pergunta, $alternativa),
            'numeracao' => $pergunta->getNumeracao(),
            'numPerguntas' => $controller->getMaxNumeracao($id_exercicio));
        return $retorno;
    }

    public function atualizar_descritivo() {
        $p = $this->setConteudo('exercicio');
        $dao = new ExercicioDAO();
        if ($dao->update($p)) {
            return 1;
        }
        return 0;
    }

    public function atualizar_pergunta($id_pergunta) {
        $controller = new controllerPergunta();
        $pergunta = $controller->getPergunta('id_pergunta=' . $id_pergunta);
        $pergunta = $controller->setPergunta($pergunta);
//        $pergunta->setId_exercicio($id_exercicio);
        $controller->atualizarPergunta($pergunta);
        $controller = new controllerAlternativa();
        $alternativa = $controller->getListaAlternativas('id_pergunta=' . $id_pergunta);
        $alternativa = $controller->setTodasAlternativa($alternativa);
        for ($i = 0; $i < count($alternativa); $i++) {
            $alternativa[$i]->setId_pergunta($pergunta->getId_pergunta());
            $controller->atualizarAlternativa($alternativa[$i]);
        }
        return 1;
    }

    public function deletar_pergunta($id_pergunta) {
        $controller = new controllerPergunta();
        $p = $controller->getPergunta('id_pergunta=' . $id_pergunta);
        $controller->deletePergunta($p);
        return $p->getNumeracao();
    }

    public function listaPerguntas($id_exercicio) {
        $controller = new controllerPergunta();
        $lista = "";
        $p = $controller->getListaPerguntas('id_exercicio="' . $id_exercicio . '" ORDER BY numeracao');
        $controller = new controllerAlternativa();
        for ($i = 0; $i < count($p); $i++) {
            $a = $controller->getListaAlternativas("id_pergunta=" . $p[$i]->getId_pergunta());
            $lista .= "<div id='div_pergunta_" . $p[$i]->getNumeracao() . "' class='accord_body list_conteudo'><h4>Pergunta " . $p[$i]->getNumeracao() . "</h4></div>";
            $lista .= "<div id='div_pergunta_body_" . $p[$i]->getNumeracao() . "' class='accord_content_body' style='display:none;'>";
            $lista .='<form class="form_submit" id="form_atualizar_pergunta_' . $p[$i]->getId_pergunta() . '" name="form_atualizar_pergunta" method="post" action="ajax/crud_exercicio.php?acao=atualizar_pergunta">
            <fieldset style="width:640px; padding:0 5px 5px 5px; margin: 0 2.5px; ">
                <legend>Editar Pergunta</legend>
                <div>
                    <fieldset style="width:30px; float:left; padding:0 5px 5px 5px; margin: 0 2.5px">
                        <legend>Nº:</legend>
                        <input type="text" id="numeracao" name="numeracao" value="' . $p[$i]->getNumeracao() . '" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 30px"/>
                    </fieldset>
                    <fieldset style="width:410px; float:left; padding:0 5px 5px 5px; margin: 0 2.5px;">
                        <legend>Enunciado:</legend>
                        <textarea placeholder="Enunciado da Pergunta" id="enunciado" name="enunciado" rows="3" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100" style="width:410px;">' . $p[$i]->getEnunciado() . '</textarea>
                    </fieldset>
                </div>
                <div>
                    <fieldset style="width:145px; float: left; padding:0 5px 5px 5px; margin: 0 2.5px; ">
                        <legend>Opção Correta</legend>';

            for ($j = 0; $j < count($a); $j++) {
                $c = '';
                if ($a[$j]->getEh_correta()) {
                    $c = 'checked';
                }
                $lista.='<div style="font-size:12px; border: 0">
                            <input type="radio" ' . $c . ' name="eh_correta" value="' . $j . '" style="border:0"/> Alternativa ' . ($j + 1) . '
                        </div>';
            }
            $lista .='</fieldset>
                    <fieldset style="width:300px; float:left; padding:0 5px 5px 5px; margin:0 2.5px; clear:left;">
                        <legend>Respostas</legend>';

            for ($j = 0; $j < count($a); $j++) {
                $lista .='<div style="padding:0; margin:0">
                            <textarea placeholder="Alternativa ' . ($j + 1) . '" id="resposta-' . $j . '" name="resposta-' . $j . '" rows="2" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 300px">' . $a[$j]->getResposta() . '</textarea>
                        </div>';
            }
            $lista .= '</fieldset >  
                    <fieldset style="width:300px; float: left; padding:0 5px 5px 5px; margin:0 2.5px">
                        <legend>Justificativas</legend>';
            for ($j = 0; $j < count($a); $j++) {
                $lista .= '<div>
                            <textarea placeholder="Justificativa" id="justificativa-' . $j . '" name="justificativa-' . $j . '" rows="2" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100" style="width: 300px; ">' . $a[$j]->getJustificativa() . '</textarea>
                        </div>';
            }
            $lista .='</fieldset>
                    <input type="submit" id="btn_upd_pergunta" class="btn_submit" name="form_atualizar_pergunta_' . $p[$i]->getId_pergunta() . '" value="Atualizar" class="button"/>
                    <input type="button" id="' . $p[$i]->getId_pergunta() . '" class="btn_del_pergunta" value="Excluir"/>
                </div>
            </fieldset>
            <div style="display:none;">                
                <input type="text" name="id_pergunta" id="id_pergunta" value="' . $p[$i]->getId_pergunta() . '"/>                
            </div>
        </form></div>';
        }
        return $lista;
    }

    public function listaPerguntas_aluno($id_exercicio) {
        $controller = new controllerPergunta();
        $lista = "";
        $p = $controller->getListaPerguntas('id_exercicio="' . $id_exercicio . '" ORDER BY numeracao');
        $controller = new controllerAlternativa();
        for ($i = 0; $i < count($p); $i++) {
            $a = $controller->getListaAlternativas("id_pergunta=" . $p[$i]->getId_pergunta());
            $lista .= "<div id='div_pergunta_" . $p[$i]->getNumeracao() . "' class='accord_body list_conteudo'><h4>Pergunta " . $p[$i]->getNumeracao() . "</h4></div>";
            $lista .= "<div id='div_pergunta_body_" . $p[$i]->getNumeracao() . "' class='accord_content_body' style='display:none;'>";
            $lista .='<fieldset style="width:640px; padding:0 5px 5px 5px; margin: 0 2.5px; ">
                <legend>Editar Pergunta</legend>
                <div>
                    <fieldset style="width:30px; float:left; padding:0 5px 5px 5px; margin: 0 2.5px">
                        <legend>Nº:</legend>
                        <input type="text" readonly="true" id="numeracao" name="numeracao" value="' . $p[$i]->getNumeracao() . '" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 30px"/>
                    </fieldset>
                    <fieldset style="width:410px; float:left; padding:0 5px 5px 5px; margin: 0 2.5px;">
                        <legend>Enunciado:</legend>
                        <textarea readonly="true" placeholder="Enunciado da Pergunta" id="enunciado" name="enunciado" rows="3" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100" style="width:410px;">' . $p[$i]->getEnunciado() . '</textarea>
                    </fieldset>
                </div>
                <div>
                    <fieldset style="width:145px; float: left; padding:0 5px 5px 5px; margin: 0 2.5px; ">
                        <legend>Opção Correta</legend>';

            for ($j = 0; $j < count($a); $j++) {
                $lista.='<div style="font-size:12px; border: 0">
                            <input type="radio" name="resposta_' . $i . '" value="' . $j . '" style="border:0"/> Alternativa ' . ($j + 1) . '
                        </div>';
            }
            $lista .='</fieldset>
                    <fieldset style="width:300px; float:left; padding:0 5px 5px 5px; margin:0 2.5px; clear:left;">
                        <legend>Respostas</legend>';

            for ($j = 0; $j < count($a); $j++) {
                $lista .='<div style="padding:0; margin:0">
                            <textarea readonly="true" placeholder="Alternativa ' . ($j + 1) . '" id="resposta-' . $j . '" name="resposta-' . $j . '" rows="2" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 300px">' . $a[$j]->getResposta() . '</textarea>
                        </div>';
            }
            $lista .= '</fieldset >';
//            for ($j = 0; $j < count($a); $j++) {
//                $lista .= '<div>
//                            <textarea readonly="true" placeholder="Justificativa" id="justificativa-' . $j . '" name="justificativa-' . $j . '" rows="2" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100" style="width: 300px; ">' . $a[$j]->getJustificativa() . '</textarea>
//                        </div>';
//            }
            $lista .='</div>
            </fieldset>
            <div style="display:none;">                
                <input type="text" name="id_pergunta_' . $i . '" id="id_pergunta_' . $i . '" value="' . $p[$i]->getId_pergunta() . '"/>                
            </div>
        </div>';
        }
        $lista .= '<div style="display: none;"><input type="text" id="total_perguntas" value="' . count($p) . '"/></div>';
        return $lista;
    }

    public function formNovaPergunta($p, $a) {
        $lista = '';
        $lista .= "<div id='div_pergunta_" . $p->getNumeracao() . "' class='accord_body list_conteudo'><h4>Pergunta " . $p->getNumeracao() . "</h4></div>";
        $lista .= "<div id='div_pergunta_body_" . $p->getNumeracao() . "' class='accord_content_body' style='display:none;'>";
        $lista .='<form class="form_submit" id="form_atualizar_pergunta_' . $p->getId_pergunta() . '" name="form_atualizar_pergunta" method="post" action="ajax/crud_exercicio.php?acao=atualizar_pergunta">
            <fieldset style="width:640px; padding:0 5px 5px 5px; margin: 0 2.5px; ">
                <legend>Editar Pergunta</legend>
                <div>
                    <fieldset style="width:30px; float:left; padding:0 5px 5px 5px; margin: 0 2.5px">
                        <legend>Nº:</legend>
                        <input type="text" id="numeracao" name="numeracao" value="' . $p->getNumeracao() . '" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 30px"/>
                    </fieldset>
                    <fieldset style="width:410px; float:left; padding:0 5px 5px 5px; margin: 0 2.5px;">
                        <legend>Enunciado:</legend>
                        <textarea placeholder="Enunciado da Pergunta" id="enunciado" name="enunciado" rows="3" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100" style="width:410px;">' . $p->getEnunciado() . '</textarea>
                    </fieldset>
                </div>
                <div>
                    <fieldset style="width:145px; float: left; padding:0 5px 5px 5px; margin: 0 2.5px; ">
                        <legend>Opção Correta</legend>';

        for ($j = 0; $j < count($a); $j++) {
            $c = '';
            if ($a[$j]->getEh_correta()) {
                $c = 'checked';
            }
            $lista.='<div style="font-size:12px; border: 0">
                            <input type="radio" ' . $c . ' name="eh_correta" value="' . $j . '" style="border:0"/> Alternativa ' . ($j + 1) . '
                        </div>';
        }

        $lista .='</fieldset>
                    <fieldset style="width:300px; float:left; padding:0 5px 5px 5px; margin:0 2.5px; clear:left;">
                        <legend>Respostas</legend>';

        for ($j = 0; $j < count($a); $j++) {
            $lista .='<div style="padding:0; margin:0">
                            <textarea placeholder="Alternativa ' . ($j + 1) . '" id="resposta-' . $j . '" name="resposta-' . $j . '" rows="2" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 300px">' . $a[$j]->getResposta() . '</textarea>
                        </div>';
        }
        $lista .= '</fieldset>
                    <fieldset style="width:300px; float: left; padding:0 5px 5px 5px; margin:0 2.5px">
                        <legend>Justificativas</legend>';
        for ($j = 0; $j < count($a); $j++) {
            $lista .= '<div>
                            <textarea placeholder="Justificativa" id="justificativa-' . $j . '" name="justificativa-' . $j . '" rows="2" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100" style="width: 300px;">' . $a[$j]->getJustificativa() . '</textarea>
                        </div>';
        }
        $lista .='</fieldset>
                    <input type="submit" id="btn_upd_pergunta" class="btn_submit" name="form_atualizar_pergunta_' . $p->getId_pergunta() . '" value="Atualizar" class="button"/>
                    <input type="button" id="' . $p->getId_pergunta() . '" class="btn_del_pergunta" name="btn_del_pergunta" value="Excluir"/>
                </div>
            </fieldset>
            <div style="display:none;">                
                <input type="text" name="id_pergunta" id="id_pergunta" value="' . $p->getId_pergunta() . '"/>                
            </div>
        </form></div>';
        return $lista;
    }

    public function submeterQuestionario($id_perguntas, $respostas) {
        $dao = new ExercicioDAO();
        $id_usuario = $_SESSION['usuarioLogado']->getId_usuario();          
        for ($i = 0; $i < count($id_perguntas) - 1; $i++) {
            if ($id_perguntas[$i] != '') {
                if (!$dao->insertResposta($id_usuario, $id_perguntas[$i], $respostas[$i])) {
                    return 0;
                }
            }
        }
        return 1;
    }

    public function getResposta($id_pergunta) {
        $dao = new ExercicioDAO();
        return $dao->selectResposta($id_pergunta);
    }

}

?>
