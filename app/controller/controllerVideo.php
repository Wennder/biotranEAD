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

    public function novoVideo(Video $v) {
        if ($v != null) {
            $dao = new VideoDAO();
            return $dao->insert($v);
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
    
    public function deleteVideo(Video $v) {
        $dao = new VideoDAO();
        return $dao->delete($v);        
    }        
    
    public function atualizaVideo(Video $v){
        $dao = new VideoDAO();
        return $dao->update($v);
    }

}
?>
