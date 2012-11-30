<?php
$id_exercicio = $_REQUEST['id_exercicio'];
$id_usuario = $_SESSION['usuarioLogado'];
//FALTA CRIAR LÓGICA PARA PEGAR LISTA DE RESPOSTAS DO BANCO PRA TERMINAR DE MONTAR A PÁGINA
$cp = new controllerPergunta();
$ca = new controllerAlternativa();
$p = $cp->getListaPerguntas('id_exercicio="' . $id_exercicio . '" ORDER BY numeracao');
$erros = 0;
$acertos = 0;
$estatistica = '';
$lista = '';
for ($i = 0; $i < count($p); $i++) {
    if ($id_perguntas[$i] == $p[$i]->getId_pergunta()) {
        $a = $ca->getAlternativa("id_alternativa=" . $respostas[$i]);
        //pintar de verde
        if ($a->getEh_correta() == 1) {
            $lista .= "<div id='div_pergunta_" . $p[$i]->getNumeracao() . "' class='accord_body list_conteudo'><h4>Pergunta " . $p[$i]->getNumeracao() . "</h4></div>";
            $acertos++;
        } else {
            //pintar de vermelho
            $lista .= "<div id='div_pergunta_" . $p[$i]->getNumeracao() . "' class='accord_body list_conteudo'><h4>Pergunta " . $p[$i]->getNumeracao() . "</h4></div>";
            $erros++;
        }
        $lista .= "<div id='div_pergunta_body_" . $p[$i]->getNumeracao() . "' class='accord_content_body' style='display:none;'>";
        $lista .='<fieldset style="width:640px; padding:0 5px 5px 5px; margin: 0 2.5px; ">                
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
                    <fieldset style="width:300px; float:left; padding:0 5px 5px 5px; margin:0 2.5px; clear:left;">
                        <legend>Respostas</legend>';

        $lista .='<div style="padding:0; margin:0">
                            <textarea readonly="true" id="resposta" name="resposta" rows="2" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 300px">' . $a->getResposta() . '</textarea>
                        </div>';
        $lista .= '</fieldset>';
        $lista .= '<fieldset style="width:300px; float: left; padding:0 5px 5px 5px; margin:0 2.5px">
                        <legend>Justificativas</legend>';
        $lista .= '<div>
                            <textarea placeholder="Justificativa" id="justificativa" name="justificativa" rows="2" maxlength="100" style="width: 300px;">' . $a->getJustificativa() . '</textarea>
                        </div>';
        $lista .='</fieldset>';
        $lista .='</div>
                        </fieldset>
                    </div>';
    }
}
if ($acertos == 0) {
    $porc = 0;
} else {
    $porc = (100 * $acertos) / ($acertos + $erros);
}
//        echo $porc;die();
$botao = '<div>
            <input type="button" value="Submeter exercicio" id="submeter_exercicio"/>        
            <input type="button" value="Refazer" id="refazer_exercicio"/>
            </div>
            <div style="display:none;" >
            <input type="text" value="' . $porc . '" id="porc_acertos"/>        
            </div>';
$estatistica .='<div><div>Acertos ' . $porc . '%</div>' . $lista . $botao . '</div>';
echo $estatistica;
?>
