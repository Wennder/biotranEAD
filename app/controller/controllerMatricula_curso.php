<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controllerMatricula_curso
 *
 * @author cead-p057007
 */
class controllerMatricula_curso{
           
    
   /*
     * Retorna apenas um cpereco de acordo com a condicao da query.
     * Se houver mais de um registro em banco, apenas o primeiro sera retornado
     * 
     * @param $condicao = condicao de busca do tipo String no formato ex.: 'id_curso_professor=1'
     * 
     * @return Objeto cpereco encontrado, ou o primeiro da lista
     */
    
    public function getMatricula_curso($condicao){
        $dao=new Matricula_cursoDAO();
        $mc=$dao->select($condicao);
        if ($mc==null){
            return $mc[0];
        }
        return $mc;//null
   }
       /*
     * Retorna uma lista de cperecos de acordo com a condicao da query.
     * condicao de busca do tipo String no formato ex.: 'id_curso_professor=1'     
     * 
     * @param string $condicao
     * @return array de objetos curso_professor encontrado
     */
 
   
   public function getListaMatricula_curso($condicao){
       $dao=new Matricula_cursoDAO();
       $mc=$dao->select($condicao);
       return $mc;
       }
   
       /*Retorna a relação de matrículas existentes
        * a partir de id dos cursos
        * @param string $id_usuario
        * 
        */
       
       
   public function getAllMatricula_curso($id_curso){
       $dao=new Matricula_cursoDAO();
       $mc=$dao->selectMatriculaCurso($id_curso);
       return $mc;
       }
       
       
        /*Retorna a relação de matrículas existentes a partir de id dos usuarios
        * @param string $id_usuario
        */
       
    public function getAllMatricula_curso_usuario($id_usuario){
        $dao=new Matricula_cursoDAO();
        $mc=$dao->selectMatricula_curso_usuario($id_usuario);
        return $mc; 
    }  
    
    /* Remove a matricula a partir de id dos curso e usuarios
     * @param string $id_usuario -
     * @param string $id_curso -
     */

    public function removeMatricula_curso($id_curso,$id_usuario){
        $dao=new Matricula_cursoDAO();
        $mc=$dao->deleteMatriculaCurso($id_curso, $id_usuario);
        return $mc;
    }
    
    public function novaMatricula($id_curso){
        $usuario = $_SESSION['usuarioLogado'];
        if($this->getMatricula_curso('id_curso='.$id_curso.' AND id_usuario='.$usuario->getId_usuario()) == null){
            if ($usuario->getId_papel() == 4) {
                $mc = new Matricula_curso();
                $mc->setData_inicio('12/12/1212');
                $mc->setData_fim('12/12/1212');
                $mc->setId_curso($id_curso);
                $mc->setId_usuario($usuario->getId_usuario());
                $mc->setModulo_atual(1);
                $mc->setStatus_acesso('1');
                //--
                $dao = new Matricula_cursoDAO();
                return $dao->insert($mc);
            }
        }
    }
    
    public function VerificarNovaMatricula(){
        
    }
    
    
    
    
}

?>
