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
        if($exe != null){
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
    
}

?>
