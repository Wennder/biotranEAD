<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Alternativa
 *
 * @author cead-p057007
 */
class Alternativa {
    
    private $id_alternativa = '';
    private $id_pergunta = '';
    private $resposta = '';
    private $justificativa = '';
    private $eh_correta = 0;
    
    public function getId_alternativa() {
        return $this->id_alternativa;
    }

    public function setId_alternativa($id_alternativa) {
        $this->id_alternativa = $id_alternativa;
    }

    public function getId_pergunta() {
        return $this->id_pergunta;
    }

    public function setId_pergunta($id_pergunta) {
        $this->id_pergunta = $id_pergunta;
    }

    public function getResposta() {
        return $this->resposta;
    }

    public function setResposta($resposta) {
        $this->resposta = $resposta;
    }

    public function getJustificativa() {
        return $this->justificativa;
    }

    public function setJustificativa($justificativa) {
        $this->justificativa = $justificativa;
    }

    public function getEh_correta() {
        return $this->eh_correta;
    }

    public function setEh_correta($eh_correta) {
        $this->eh_correta = $eh_correta;
    }


}

?>
