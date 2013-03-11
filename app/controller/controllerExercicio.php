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
        if (!empty($_FILES)) {
            $this->imagem_pergunta($pergunta->getId_pergunta());
        }
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

    public function imagem_pergunta($id) {
        if (isset($_FILES["imagem"])) {
            if ($_FILES["imagem"]["name"] != '') {
                $imagem = $_FILES["imagem"];
                $tipos = array("image/jpg", "image/jpeg");
                $pasta_dir = ROOT_PATH . "/public/img/perguntas/";
                if (in_array($imagem["type"], $tipos)) {
                    $aux = explode('/', $imagem["type"]);
                    $caminho = ROOT_PATH . '/public/img/respostas/' . $id . '.' . $aux[1];
                    if (is_file($caminho)) {
                        unlink($caminho);
                    }
                    $imagem_nome = $pasta_dir . $id . ".jpg";
//                    echo $imagem["tmp_name"] . '--' . $imagem_nome; die();
                    move_uploaded_file($imagem["tmp_name"], $imagem_nome);
                    $imagem_arquivo = ROOT_PATH . "/public/img/perguntas/" . $id . ".jpg";
                    list($altura, $largura) = getimagesize($imagem_nome);
                    if ($altura > 200 && $largura > 200) {
                        $img = wiImage::load($imagem_arquivo);
                        $img = $img->resize(250, 250, 'outside');
                        $img = $img->crop('50% - 50', '50% - 40', 200, 200);
                        $img->saveToFile($imagem_arquivo);
                    }
                }
            }
        }
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
        $retorno = 1;
        $controller = new controllerPergunta();
        $pergunta = $controller->getPergunta('id_pergunta=' . $id_pergunta);
        $pergunta = $controller->setPergunta($pergunta);
//        $pergunta->setId_exercicio($id_exercicio);
        $controller->atualizarPergunta($pergunta);
        if (!empty($_FILES)) {
            $this->imagem_pergunta($pergunta->getId_pergunta());
            $retorno = 2;
        }
        $controller = new controllerAlternativa();
        $alternativa = $controller->getListaAlternativas('id_pergunta=' . $id_pergunta);
        $alternativa = $controller->setTodasAlternativa($alternativa);
        for ($i = 0; $i < count($alternativa); $i++) {
            $alternativa[$i]->setId_pergunta($pergunta->getId_pergunta());
            $controller->atualizarAlternativa($alternativa[$i]);
        }
        return $retorno;
    }

    public function deletar_pergunta($id_pergunta) {
        $controller = new controllerPergunta();
        $p = $controller->getPergunta('id_pergunta=' . $id_pergunta);
        $resp = $controller->deletePergunta($p);
        if ($resp != 0) {
            $caminho = ROOT_PATH . "/public/img/perguntas/" . $id_pergunta . ".jpg";
            if (file_exists($caminho)) {
                unlink($caminho);
            }
        }
        return $p->getNumeracao();
    }

    public function listaPerguntas($id_exercicio) {
        $controller = new controllerPergunta();
        $lista = "";
        $p = $controller->getListaPerguntas('id_exercicio="' . $id_exercicio . '" ORDER BY numeracao');
        $controller = new controllerAlternativa();
        for ($i = 0; $i < count($p); $i++) {
            $a = $controller->getListaAlternativas("id_pergunta=" . $p[$i]->getId_pergunta());
            $lista .= "<div id='div_pergunta_" . $p[$i]->getNumeracao() . "' class='accord_body'><div class='accord_list'><label class='accord_label'><b>Questão " . $p[$i]->getNumeracao() . ":</b> " . substr($p[$i]->getEnunciado(), 0, 139) . "...</label></div></div>";
            $lista .= "<div id='div_pergunta_body_" . $p[$i]->getNumeracao() . "' class='accord_content_body' style='display:none;'>";
            $lista .='<div style="margin: 0 0 0 5px;"><form class="formulario" id="form_atualizar_pergunta_' . $p[$i]->getId_pergunta() . '" name="form_atualizar_pergunta" method="post" action="ajax/crud_exercicio.php?acao=atualizar_pergunta" enctype="multipart/form-data"><br>
            <fieldset style="width:893px;">
                <legend>Editar Questão</legend>
                <table>
                    <tr>
                        <td><label>Nº </label><input id="numeracao" readonly="true" name="numeracao" value="' . $p[$i]->getNumeracao() . '" class="text-input" style="width: 30px"/></td>
                        <td><textarea placeholder="Enunciado da Questão" id="enunciado" name="enunciado" class="text-area" style="height: 34px; width:650px;">' . $p[$i]->getEnunciado() . '</textarea></td>
                    </tr>';
            $lista .= '<tr>
                        <td><label>Imagem: </label></td>';
            if (file_exists(ROOT_PATH . "/public/img/perguntas/" . $p[$i]->getId_pergunta() . ".jpg")) {
                $lista .= '<td><div id="div_imagem"><img src="img/perguntas/' . $p[$i]->getId_pergunta() . '.jpg" /></td></tr>';
            } else {
                $lista .= '<td><div id="div_imagem"><img src="img/perguntas/00.jpg" /></td></tr>';
            }
            $lista .= '<tr><td></td><td><input type="file" id="imagem" name="imagem" class="text-input"/></td></tr>
                <tr>
                    <td></td>
                    <td>
                        <progress id="progress" value="0" max="100"></progress><span id="porcentagem">0%</span>                        
                    </td>
                </tr>  ';
            $lista .= '<tr>
                        <td colspan="2">
                            <div style="margin-top: 30px;">
                                <label>Respostas:</label>
                                <table style="width: 100%;">';
            for ($j = 0; $j < count($a); $j++) {
                $c = '';
                if ($a[$j]->getEh_correta()) {
                    $c = 'checked';
                }
                $lista.='
                                    <tr>
                                        <td>
                                            <input type="radio" ' . $c . ' name="eh_correta" value="' . $j . '" style="margin: 5px 0 0 15px;"/>
                                        </td>
                                        <td>
                                            <textarea placeholder="Alternativa ' . ($j + 1) . '" id="resposta_' . $j . '" name="resposta_' . $j . '" class="text-area" style="height: 34px; width: 650px;">' . $a[$j]->getResposta() . '</textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <textarea placeholder="Justificativa" id="justificativa_' . $j . '" name="justificativa_' . $j . '" class="text-area" style="height:34px; width: 650px; ">' . $a[$j]->getJustificativa() . '</textarea>
                                        </td>
                                    </tr>';
            }
            $lista .='</table>
                            </div>
                        </td>
                    </tr>
                </table><br>';
            $lista .='<input type="submit" id="btn_upd_pergunta" class="button2" name="form_atualizar_pergunta_' . $p[$i]->getId_pergunta() . '" value="Atualizar"/>
                    <input type="button" id="' . $p[$i]->getId_pergunta() . '" class="button2 btn_del_pergunta" value="Excluir"/><br>';
            $lista .='</fieldset><div style="display:none;"><input type="text" name="id_pergunta" id="id_pergunta" value="' . $p[$i]->getId_pergunta() . '"/></div></form></div></div>';
        }
        return $lista;
    }

    public function listaPerguntas_admin($id_exercicio) {
        $controller = new controllerPergunta();
        $lista = "";
        $p = $controller->getListaPerguntas('id_exercicio="' . $id_exercicio . '" ORDER BY numeracao');
        $controller = new controllerAlternativa();
        for ($i = 0; $i < count($p); $i++) {
            $a = $controller->getListaAlternativas("id_pergunta=" . $p[$i]->getId_pergunta());
            $lista .= "<div id='div_pergunta_" . $p[$i]->getNumeracao() . "' class='accord_body'><div class='accord_list'><label class='accord_label'><b>Questão " . $p[$i]->getNumeracao() . ":</b> " . substr($p[$i]->getEnunciado(), 0, 139) . "...</label></div></div>";
            $lista .= "<div id='div_pergunta_body_" . $p[$i]->getNumeracao() . "' class='accord_content_body' style='display:none;'>";
            $lista .='<div style="margin: 0 0 0 5px;"><br>
            <fieldset style="width:893px;">
                <legend>Visualizar Questão</legend>
                <table>
                    <tr>
                        <td><label>Nº: ' . $p[$i]->getNumeracao() . '</label></td>
                        <td><label placeholder="Enunciado da Questão" id="enunciado" name="enunciado" class="text-area" style="height: 34px; width:650px;">' . $p[$i]->getEnunciado() . '</textarea></td>
                    </tr>';
            if (file_exists(ROOT_PATH . "/public/img/perguntas/" . $p[$i]->getId_pergunta() . ".jpg")) {
                $lista .= '<tr>
                        <td><label>Imagem: </label></td>
                        <td><div id="div_imagem"><img src="img/perguntas/' . $p[$i]->getId_pergunta() . '.jpg" /></td>
                    </tr>';
            }
            $lista .= '<tr>
                        <td colspan="2">
                            <div style="margin-top: 30px;">
                                <label>Respostas:</label>
                                <table style="width: 100%;">';
            for ($j = 0; $j < count($a); $j++) {
                $lista.='
                                    <tr>
                                        <td>
                                            <textarea readonly="true" placeholder="Alternativa ' . ($j + 1) . '" id="resposta_' . $j . '" name="resposta_' . $j . '" class="text-area" style="height: 34px; width: 650px;">' . $a[$j]->getResposta() . '</textarea>
                                        </td>
                                    </tr>
                                    <tr>                                        
                                        <td>
                                            <textarea readonly="true" placeholder="Justificativa" id="justificativa_' . $j . '" name="justificativa_' . $j . '" class="text-area" style="height:34px; width: 650px; ">' . $a[$j]->getJustificativa() . '</textarea>
                                        </td>
                                    </tr>';
            }
            $lista .='</table>
                            </div>
                        </td>
                    </tr>
                </table><br>';
            $lista .='</fieldset></div></div></div>';
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
            $lista .= "<div id='div_pergunta_" . $p[$i]->getNumeracao() . "' class='accord_body'><div class='accord_list questaoBody_" . $p[$i]->getNumeracao() . "'><label class='accord_label'><b>Questão " . $p[$i]->getNumeracao() . "</b></label></div></div>";
            $lista .= "<div id='div_pergunta_body_" . $p[$i]->getNumeracao() . "' class='accord_content_body questao_body' style='display:none;'>";
            $lista .='<div style="margin: 0 0 0 5px;" class="formulario"><br><fieldset style="width:893px;">
                <table>
                    <tr>
                        <td valign="top"><label><b>' . $p[$i]->getNumeracao() . 'º)</b> </label></td>
                        <td><label>' . $p[$i]->getEnunciado() . '</label></td>
                    </tr>
                    <tr>
                        <td><br></td>';
            if (file_exists(ROOT_PATH . "/public/img/perguntas/" . $p[$i]->getId_pergunta() . ".jpg")) {
                $lista .= '<td><div><img src="img/perguntas/' . $p[$i]->getId_pergunta() . '.jpg" /></td>';
            }
            $lista .='</tr>
                    <tr>
                        <td colspan="2">
                            <div style="margin-top: 30px;" class="radio" id="' . $p[$i]->getNumeracao() . '">
                                <label style="margin-left: 20px;"><b>Alternativas:</b></label>
                                <table style="width: 100%;">';
            for ($j = 0; $j < count($a); $j++) {
                $lista.='
                                    <tr>
                                        <td style="width: 40px;">
                                            <input name="resposta_' . $i . '" type="radio" ' . $c . ' value="' . $a[$j]->getId_alternativa() . '" style="margin: 5px 0 0 15px;" onclick="setarQuestao(' . $p[$i]->getNumeracao() . ')" class="radioQuestao_' . $p[$i]->getNumeracao() . '"/>
                                        </td>
                                        <td>
                                            <label>' . $a[$j]->getResposta() . '</label>
                                        </td>
                                    </tr>';
            }
            $lista .='</table>
                            </div>
                        </td>
                    </tr>
                </table><br>';
            $lista .='</fieldset><div style="display:none;"><input type="text" name="id_pergunta" id="id_pergunta_' . $i . '" value="' . $p[$i]->getId_pergunta() . '"/></div></div></div>';
        }
        $lista .= '<div style="display: none;"><input type="text" id="total_perguntas" value="' . count($p) . '"/></div>';
        return $lista;
    }

//    public function listaPerguntas_aluno($id_exercicio) {
//        $controller = new controllerPergunta();
//        $lista = "";
//        $p = $controller->getListaPerguntas('id_exercicio="' . $id_exercicio . '" ORDER BY numeracao');
//        $controller = new controllerAlternativa();
//        for ($i = 0; $i < count($p); $i++) {
//            $a = $controller->getListaAlternativas("id_pergunta=" . $p[$i]->getId_pergunta());
//            $lista .= "<div id='div_pergunta_" . $p[$i]->getNumeracao() . "' class='accord_body list_conteudo'><h4>Pergunta " . $p[$i]->getNumeracao() . "</h4></div>";
//            $lista .= "<div id='div_pergunta_body_" . $p[$i]->getNumeracao() . "' class='accord_content_body' style='display:none;'>";
//            $lista .='<fieldset style="width:640px; padding:0 5px 5px 5px; margin: 0 2.5px; ">
//                <legend>Editar Pergunta</legend>
//                <div>
//                    <fieldset style="width:30px; float:left; padding:0 5px 5px 5px; margin: 0 2.5px">
//                        <legend>Nº:</legend>
//                        <input type="text" readonly="true" id="numeracao" name="numeracao" value="' . $p[$i]->getNumeracao() . '" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 30px"/>
//                    </fieldset>
//                    <fieldset style="width:410px; float:left; padding:0 5px 5px 5px; margin: 0 2.5px;">
//                        <legend>Enunciado:</legend>
//                        <textarea readonly="true" placeholder="Enunciado da Pergunta" id="enunciado" name="enunciado" rows="3" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100" style="width:410px;">' . $p[$i]->getEnunciado() . '</textarea>
//                    </fieldset>
//                </div>
//                <div>
//                    <fieldset style="width:145px; float: left; padding:0 5px 5px 5px; margin: 0 2.5px; ">
//                        <legend>Opção Correta</legend>';
//
//            for ($j = 0; $j < count($a); $j++) {
//                $lista.='<div style="font-size:12px; border: 0">
//                            <input type="radio" name="resposta_' . $i . '" value="' . $a[$j]->getId_alternativa() . '" style="border:0"/> Alternativa ' . ($j + 1) . '
//                        </div>';
//            }
//            $lista .='</fieldset>
//                    <fieldset style="width:300px; float:left; padding:0 5px 5px 5px; margin:0 2.5px; clear:left;">
//                        <legend>Respostas</legend>';
//
//            for ($j = 0; $j < count($a); $j++) {
//                $lista .='<div style="padding:0; margin:0">
//                            <textarea readonly="true" placeholder="Alternativa ' . ($j + 1) . '" id="resposta_' . $j . '" name="resposta_' . $j . '" rows="2" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 300px">' . $a[$j]->getResposta() . '</textarea>
//                        </div>';
//            }
//            $lista .= '</fieldset >';
////            for ($j = 0; $j < count($a); $j++) {
////                $lista .= '<div>
////                            <textarea readonly="true" placeholder="Justificativa" id="justificativa_' . $j . '" name="justificativa_' . $j . '" rows="2" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100" style="width: 300px; ">' . $a[$j]->getJustificativa() . '</textarea>
////                        </div>';
////            }
//            $lista .='</div>
//            </fieldset>
//            <div style="display:none;">                
//                <input type="text" name="id_pergunta_' . $i . '" id="id_pergunta_' . $i . '" value="' . $p[$i]->getId_pergunta() . '"/>                
//            </div>
//        </div>';
//        }
//        $lista .= '<div style="display: none;"><input type="text" id="total_perguntas" value="' . count($p) . '"/></div>';
//        return $lista;
//    }

    public function formNovaPergunta($p, $a) {
        $lista = '';
        $lista .= "<div id='div_pergunta_" . $p->getNumeracao() . "' class='accord_body'><div class='accord_list'><label class='accord_label'><b>Questão " . $p->getNumeracao() . ":</b> " . substr($p->getEnunciado(), 0, 139) . "...</label></div></div>";
        $lista .= "<div id='div_pergunta_body_" . $p->getNumeracao() . "' class='accord_content_body' style='display:none;'>";
        $lista .= '<div style="margin: 0 0 0 5px;"><form class="formulario id="form_atualizar_pergunta_' . $p->getId_pergunta() . '" name="form_atualizar_pergunta" method="post" action="ajax/crud_exercicio.php?acao=atualizar_pergunta"><br>
            <fieldset style="width:893px;">
                <legend>Editar Questão</legend>
                <table>
                    <tr>
                        <td><label>Nº </label><input id="numeracao" readonly="true" name="numeracao" value="' . $p->getNumeracao() . '" class="text-input" style="width: 30px"/></td>
                        <td><textarea placeholder="Enunciado da Questão" id="enunciado" name="enunciado" class="text-area" style="height: 34px; width:650px;">' . $p->getEnunciado() . '</textarea></td>
                    </tr>
                    <tr>
                        <td><label>Imagem: </label></td>';
        if (file_exists(ROOT_PATH . "/public/img/perguntas/" . $p->getId_pergunta() . ".jpg")) {
            $lista .='<td><div id="div_imagem"><img src="img/perguntas/' . $p->getId_pergunta() . '.jpg" /></td></tr>';
        } else {
            $lista .='<td><div id="div_imagem"><img src="img/perguntas/00.jpg" /></td></tr>';
        }
        $lista .= '<tr><td><input type="file" id="imagem" name="imagem" class="text-input"/></td></tr>
                <tr>
                    <td>
                        <progress id="progress" value="0" max="100"></progress><span id="porcentagem">0%</span>
                    </td>
                </tr>  ';
        $lista .= '<tr>
                        <td colspan="2">
                            <div style="margin-top: 30px;">
                                <label>Respostas:</label>
                                <table style="width: 100%;">';
        for ($j = 0; $j < count($a); $j++) {
            $c = '';
            if ($a[$j]->getEh_correta()) {
                $c = 'checked';
            }
            $lista.='
                                    <tr>
                                        <td>
                                            <input type="radio" ' . $c . ' name="eh_correta" value="' . $j . '" style="margin: 5px 0 0 15px;"/>
                                        </td>
                                        <td>
                                            <textarea placeholder="Alternativa ' . ($j + 1) . '" id="resposta_' . $j . '" name="resposta_' . $j . '" class="text-area" style="height: 34px; width: 650px;">' . $a[$j]->getResposta() . '</textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <textarea placeholder="Justificativa" id="justificativa_' . $j . '" name="justificativa_' . $j . '" class="text-area" style="height:34px; width: 650px; ">' . $a[$j]->getJustificativa() . '</textarea>
                                        </td>
                                    </tr>';
        }
        $lista .='</table>
                            </div>
                        </td>
                    </tr>
                </table><br>';
        $lista .='<input type="submit" id="btn_upd_pergunta" class="button2" name="form_atualizar_pergunta_' . $p->getId_pergunta() . '" value="Atualizar"/>
                    <input type="button" id="' . $p->getId_pergunta() . '" class="button2 btn_del_pergunta" value="Excluir"/><br>';
        $lista .='</fieldset><div style="display:none;"><input type="text" name="id_pergunta" id="id_pergunta" value="' . $p->getId_pergunta() . '"/></div></form></div></div>';
        return $lista;
    }

    public function submeterQuestionario($id_perguntas, $respostas, $id_exercicio, $porc_acertos) {
        $dao = new ExercicioDAO();
        $id_usuario = $_SESSION['usuarioLogado']->getId_usuario();
        //inserindo respostas
        for ($i = 0; $i < count($id_perguntas) - 1; $i++) {
            if ($id_perguntas[$i] != '') {
                if (!$dao->insertResposta($id_usuario, $id_exercicio, $id_perguntas[$i], $respostas[$i])) {
                    return 0;
                }
            }
        }
        //inserindo usuario exercicio
        $c = new controllerExercicio();
        $e = $c->getExercicio('id_exercicio=' . $id_exercicio);
        $c = new controllerUsuario_exercicio();
        $ue = new Usuario_exercicio();
        $ue->setId_exercicio($id_exercicio);
        $ue->setId_usuario($id_usuario);
        $ue->setPorc_acertos($porc_acertos);
        $ue->setId_modulo($e->getId_modulo());
        //inserindo
        $c->novoUsuario_exercicio($ue);
        //--verificando se resolveu ultimo exercicio
        $c = new controllerExercicio();
        $qnt_exer = count($c->getListaExercicio('id_modulo=' . $e->getId_modulo()));
        $c = new controllerUsuario_exercicio();
        $qnt_exer_resolvidos = count($c->getListaUsuario_exercicios('id_usuario=' . $id_usuario . ' AND id_modulo=' . $e->getId_modulo()));
        //--
        //verificando se terminou módulo
        if ($qnt_exer == $qnt_exer_resolvidos) {
            $c = new controllerModulo();
            $m = $c->getModulo('id_modulo=' . $e->getId_modulo());
            $c = new controllerCurso();
            $curso = $c->getCurso('id_curso=' . $m->getId_curso());

            $c = new controllerMatricula_curso();
            $mc = $c->getMatricula_curso("id_usuario=" . $id_usuario . ' AND id_curso=' . $m->getId_curso());
            
            //se esta no ultimo módulo
            if ($m->getNumero_modulo() == $curso->getNumero_modulos()) {
                $mc->setStatus_finalizado(1);
                $c->updateMatricula_curso($mc);
                return 3; //ULTIMO MÓDULO TERMINADO - CURSO FINALIZADO
            }
            //passou para o próximo módulo
            $mc->setModulo_atual(((int) $mc->getModulo_atual()) + 1);
            $c->updateMatricula_curso($mc);
            return 2;
        }
        //terminou exercicio mas não passou de módulo
        return 1;
    }

    public function corrigirQuestionario($id_perguntas, $respostas, $id_exercicio) {
        $cp = new controllerPergunta();
        $ca = new controllerAlternativa();
        $p = $cp->getListaPerguntas('id_exercicio="' . $id_exercicio . '" ORDER BY numeracao');
        $erros = 0;
        $acertos = 0;
        $estatistica = '';
        $lista = '';
        $aux = '';
        for ($i = 0; $i < count($p); $i++) {
            if ($id_perguntas[$i] == $p[$i]->getId_pergunta()) {
                $aux = '';
                $a = $ca->getListaAlternativas("id_pergunta=" . $id_perguntas[$i]);
                $lista .= "<div id='div_pergunta_" . $p[$i]->getNumeracao() . "' class='accord_body'><div class='accord_list questaoBody_" . $p[$i]->getNumeracao() . "'><label class='accord_label'><b>Questão " . $p[$i]->getNumeracao() . "</b></label></div></div>";
                $lista .= "<div id='div_pergunta_body_" . $p[$i]->getNumeracao() . "' class='accord_content_body questao_body' style='display:none;'>";
                $lista .='<div style="margin: 0 0 0 5px;" class="formulario"><br><fieldset style="width:893px;">
                            <table>
                                <tr>
                                    <td valign="top"><label><b>' . $p[$i]->getNumeracao() . 'º)</b> </label></td>
                                    <td><label>' . $p[$i]->getEnunciado() . '</label></td>
                                </tr>
                                <tr>
                                    <td><br></td>';
                if (file_exists(ROOT_PATH . "/public/img/perguntas/" . $p[$i]->getId_pergunta() . ".jpg")) {
                    $lista .= '<td><div><img src="img/perguntas/' . $p[$i]->getId_pergunta() . '.jpg" /></td>';
                }
                for ($j = 0; $j < count($a); $j++) {
                    if ($a[$j]->getId_alternativa() == $respostas[$i]) {
                        if ($a[$j]->getEh_correta()) {
                            //se for a alternativa correta pinta o corpo da pergunta de verde
                            $acertos++;
                            //alternativa q ele marcou: dar um destaque pra ela
                            $aux.='
                                    <tr>
                                        <td style="width: 40px;">
                                            <input type="radio" value="' . $a[$j]->getId_alternativa() . '" style="margin: 5px 0 0 15px;" checked disabled="true"/>
                                        </td>
                                        <td>
                                            <label style="color: green;">' . $a[$j]->getResposta() . '</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <label>' . $a[$j]->getJustificativa() . '</label>
                                        </td>
                                    </tr>
                                    <tr style="height: 15px;"><td colspan="2"></td></tr>';
                        } else {
                            $aux.='
                                    <tr>
                                        <td style="width: 40px;">
                                            <input type="radio" value="' . $a[$j]->getId_alternativa() . '" style="margin: 5px 0 0 15px;" checked disabled="true"/>
                                        </td>
                                        <td>
                                            <label style="color: red;">' . $a[$j]->getResposta() . '</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <label>' . $a[$j]->getJustificativa() . '</label>
                                        </td>
                                    </tr>
                                    <tr style="height: 15px;"><td colspan="2"></td></tr>';
                        }
                    } else if ($a[$j]->getEh_correta()) {
                        //Mazotas alternativas
                        $aux.='
                                    <tr>
                                        <td style="width: 40px;">
                                            <input type="radio" value="' . $a[$j]->getId_alternativa() . '" style="margin: 5px 0 0 15px;" disabled="true"/>
                                        </td>
                                        <td>
                                            <label style="color: green;">' . $a[$j]->getResposta() . '</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <label>' . $a[$j]->getJustificativa() . '<br></label>
                                        </td>
                                    </tr>
                                    <tr style="height: 15px;"><td colspan="2"></td></tr>';
                    } else {
                        //Mazotas alternativas
                        $aux.='
                                    <tr>
                                        <td style="width: 40px;">
                                            <input type="radio" value="' . $a[$j]->getId_alternativa() . '" style="margin: 5px 0 0 15px;" disabled="true"/>
                                        </td>
                                        <td>
                                            <label style="color: red;">' . $a[$j]->getResposta() . '</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <label>' . $a[$j]->getJustificativa() . '<br></label>
                                        </td>
                                    </tr>
                                    <tr style="height: 15px;"><td colspan="2"></td></tr>';
                    }
                }
                $lista .='</tr>
                    <tr>
                        <td colspan="2">
                            <div style="margin-top: 30px;" class="radio">
                                <label style="margin-left: 20px;"><b>Alternativas:</b></label>
                                <table style="width: 100%;">';
                $lista .= $aux;
                $lista .='</table>
                            </div>
                        </td>
                    </tr>
                </table><br></fieldset></div></div><br>';
            }
        }

        if ($acertos == 0) {
            $porc = 0;
        } else {
            $porc = (100 * $acertos) / ($acertos + $erros);
        }
        $botao = '<div>
            <input type="button" value="Submeter exercício" id="submeter_exercicio" class="button2"/>        
            <input type="button" value="Refazer" id="refazer_exercicio" class="button2"/>
            </div>
            <div style="display:none;" >
            <input type="text" value="' . $porc . '" id="porc_acertos"/>        
            </div>';
        $estatistica .='<div><div id="div_acertos">Acertos ' . $porc . '%</div>' . $botao . '</div>';
        $retorno = array(
            'estatistica' => $estatistica,
            'lista' => $lista,
        );
        return $retorno;
    }

    public function visualizarExercicioResolvido($id_exercicio) {
        $ue = new controllerResposta_exercicio();
        $id_usuario = $_SESSION['usuarioLogado']->getId_usuario();
        $resp_exercicio = $ue->getListaResposta_exercicios("id_usuario=" . $id_usuario . " AND id_exercicio=" . $id_exercicio);
        $id_perguntas = array();
        $respostas = array();
        for ($i = 0; $i < count($resp_exercicio); $i++) {
            $id_perguntas[$i] = $resp_exercicio[$i]->getId_pergunta();
            $respostas[$i] = $resp_exercicio[$i]->getResposta();
        }
        return $this->htmlExercicioResolvido($id_perguntas, $respostas);
    }

    public function htmlExercicioResolvido($id_perguntas, $respostas) {
        $cp = new controllerPergunta();
        $ca = new controllerAlternativa();
        $erros = 0;
        $acertos = 0;
        $estatistica = '';
        $lista = '';
        $aux = '';
        for ($i = 0; $i < count($id_perguntas); $i++) {
            $aux = '';
            $p = $cp->getPergunta("id_pergunta=" . $id_perguntas[$i]);
            $a = $ca->getListaAlternativas("id_pergunta=" . $id_perguntas[$i]);
            $lista .= '<div>';
            $lista .= "<div id='div_pergunta_" . $p->getNumeracao() . "' class='accord_body'><div class='accord_list questaoBody_" . $p->getNumeracao() . "'><label class='accord_label'><b>Questão " . $p->getNumeracao() . "</b></label></div></div>";
            $lista .= "<div id='div_pergunta_body_" . $p->getNumeracao() . "' class='accord_content_body questao_body' style='display:none;'>";
            $lista .='<div style="margin: 0 0 0 5px;" class="formulario"><br><fieldset style="width:893px;">
                            <table>
                                <tr>
                                    <td valign="top"><label><b>' . $p->getNumeracao() . 'º)</b> </label></td>
                                    <td><label>' . $p->getEnunciado() . '</label></td>
                                </tr>
                                <tr>
                                    <td><br></td>';
            if (file_exists(ROOT_PATH . "/public/img/perguntas/" . $p->getId_pergunta() . ".jpg")) {
                $lista .= '<td><div><img src="img/perguntas/' . $p->getId_pergunta() . '.jpg" /></td>';
            }
            for ($j = 0; $j < count($a); $j++) {
                if ($a[$j]->getId_alternativa() == $respostas[$i]) {
                    if ($a[$j]->getEh_correta()) {
                        //se for a alternativa correta pinta o corpo da pergunta de verde
                        $acertos++;
                        //alternativa q ele marcou: dar um destaque pra ela
                        $aux.='
                                    <tr>
                                        <td style="width: 40px;">
                                            <input type="radio" value="' . $a[$j]->getId_alternativa() . '" style="margin: 5px 0 0 15px;" checked disabled="true"/>
                                        </td>
                                        <td>
                                            <label style="color: green;">' . $a[$j]->getResposta() . '</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <label>' . $a[$j]->getJustificativa() . '</label>
                                        </td>
                                    </tr>
                                    <tr style="height: 15px;"><td colspan="2"></td></tr>';
                    } else {
                        $aux.='
                                    <tr>
                                        <td style="width: 40px;">
                                            <input type="radio" value="' . $a[$j]->getId_alternativa() . '" style="margin: 5px 0 0 15px;" checked disabled="true"/>
                                        </td>
                                        <td>
                                            <label style="color: red;">' . $a[$j]->getResposta() . '</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <label>' . $a[$j]->getJustificativa() . '</label>
                                        </td>
                                    </tr>
                                    <tr style="height: 15px;"><td colspan="2"></td></tr>';
                    }
                } else if ($a[$j]->getEh_correta()) {
                    //Mazotas alternativas
                    $aux.='
                                    <tr>
                                        <td style="width: 40px;">
                                            <input type="radio" value="' . $a[$j]->getId_alternativa() . '" style="margin: 5px 0 0 15px;" disabled="true"/>
                                        </td>
                                        <td>
                                            <label style="color: green;">' . $a[$j]->getResposta() . '</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <label>' . $a[$j]->getJustificativa() . '<br></label>
                                        </td>
                                    </tr>
                                    <tr style="height: 15px;"><td colspan="2"></td></tr>';
                } else {
                    //Mazotas alternativas
                    $aux.='
                                    <tr>
                                        <td style="width: 40px;">
                                            <input type="radio" value="' . $a[$j]->getId_alternativa() . '" style="margin: 5px 0 0 15px;" disabled="true"/>
                                        </td>
                                        <td>
                                            <label style="color: red;">' . $a[$j]->getResposta() . '</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <label>' . $a[$j]->getJustificativa() . '<br></label>
                                        </td>
                                    </tr>
                                    <tr style="height: 15px;"><td colspan="2"></td></tr>';
                }
            }
            $lista .='</tr>
                    <tr>
                        <td colspan="2">
                            <div style="margin-top: 30px;" class="radio">
                                <label style="margin-left: 20px;"><b>Alternativas:</b></label>
                                <table style="width: 100%;">';
            $lista .= $aux;
            $lista .='</table>
                            </div>
                        </td>
                    </tr>
                </table><br></fieldset></div></div><br>';
            $lista .= '</div>';
        }

        if ($acertos == 0) {
            $porc = 0;
        } else {
            $porc = (100 * $acertos) / ($acertos + $erros);
        }
        $botao = '<div>
            <input type="button" value="Fechar" id="fechar_exercicio" class="button2"/>                    
            </div>
            <div style="display:none;" >
            <input type="text" value="' . $porc . '" id="porc_acertos"/>        
            </div>';
        $estatistica .='<div><div id="div_acertos">Acertos ' . $porc . '%</div>' . $botao . '</div>';
        $retorno = array(
            'estatistica' => $estatistica,
            'lista' => $lista,
        );
        return $retorno;
    }

    public function getResposta($id_pergunta) {
        $dao = new ExercicioDAO();
        return $dao->selectResposta($id_pergunta);
    }

}

?>
