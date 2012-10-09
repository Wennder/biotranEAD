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
    
     public function inserir_pergunta($id_exercicio){
        $controller = new controllerPergunta();
        $pergunta = $controller->setPergunta();
        $pergunta->setId_exercicio($id_exercicio);
        $pergunta->setId_pergunta($controller->novoPergunta($pergunta));
        $controller = new controllerAlternativa();
        $alternativa = $controller->setTodasAlternativa();
        for($i = 0; $i < count($alternativa); $i++){
            $alternativa[$i]->setId_pergunta($pergunta->getId_pergunta());
            $controller->novoAlternativa($alternativa[$i]);
        }
        return 1;
    }
    
    public function atualizar_descritivo_exercicio(){        
        $p = $this->setConteudo('exercicio');
        $dao = new ExercicioDAO();
        if($dao->update($p)){
            return 1;            
        }
        return 0;
    }
    
}

?>
