<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controllerVideo
 *
 * @author cead-p057007
 */
class controllerVideo {
    
    public function novoVideo(Video $v){
        if ($v != null) {
            $dao = new VideoDAO();
            //se realmente não existe registro com o mesmo nome, insere
            if ($dao->select("id_video=" . $v->getId_video()) == null) {
                $dao->insert($v);
            } else {
                //caso contrário, enviar para a página principal
                trigger_error("1 Reenvio de formulario, v ja cadastrado");
            }
        } else {
            return 'ERRO: funcao novoVideo - [controllerVideo]';
        }
    }
    
    public function getVideo($condicao) {
        $dao = new VideoDAO();
        $v = $dao->select($condicao);
        if ($v != null) {
            return $v[0];
        }
        return $v; // null
    }

    public function getListaVideos($condicao = null) {
        $dao = new VideoDAO();
        $v = $dao->select($condicao);
        return $v; // null
    }
    
}

?>
