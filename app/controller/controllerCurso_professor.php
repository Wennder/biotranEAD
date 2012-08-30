<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controllerCurso_professor
 *
 * @author cead-p057007
 */
class controllerCurso_professor {
    /*
     * Retorna apenas um cpereco de acordo com a condicao da query.
     * Se houver mais de um registro em banco, apenas o primeiro sera retornado
     * 
     * @param $condicao = condicao de busca do tipo String no formato ex.: 'id_curso_professor=1'
     * 
     * @return Objeto cpereco encontrado, ou o primeiro da lista
     */

    public function getCurso_professor($condicao) {
        $dao = new Curso_professorDAO();
        $cp = $dao->select($condicao);
        if($cp != null){
            return $cp[0];            
        }
        return $cp; // null
    }

    /*
     * Retorna uma lista de cperecos de acordo com a condicao da query.
     * condicao de busca do tipo String no formato ex.: 'id_curso_professor=1'     
     * 
     * @param string $condicao
     * @return array de objetos curso_professor encontrado
     */

    public function getListaCurso_professor($condicao) {
        $dao = new UsuarioDAO();
        $cp = $dao->select($condicao);
        return $cp;
    }

    /*
     * Retorna uma lista de todos os usuarios
     *      
     * @return array de objetos com todos os usuarios
     */

    public function getAllCurso_professor() {
        $dao = new Curso_professorDAO();
        $cp = $dao->select();
        return $cp;
    }
}

?>
