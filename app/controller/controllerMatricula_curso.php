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
class controllerMatricula_curso {
    /*
     * Retorna apenas um cpereco de acordo com a condicao da query.
     * Se houver mais de um registro em banco, apenas o primeiro sera retornado
     * 
     * @param $condicao = condicao de busca do tipo String no formato ex.: 'id_curso_professor=1'
     * 
     * @return Objeto cpereco encontrado, ou o primeiro da lista
     */

    public function getMatricula_curso($condicao) {
        $dao = new Matricula_cursoDAO();
        $mc = $dao->select($condicao);
        if ($mc != null) {
            return $mc[0];
        }
        return $mc; //null
    }

    /*
     * Retorna uma lista de cperecos de acordo com a condicao da query.
     * condicao de busca do tipo String no formato ex.: 'id_curso_professor=1'     
     * 
     * @param string $condicao
     * @return array de objetos curso_professor encontrado
     */

    public function getListaMatricula_curso($condicao) {
        $dao = new Matricula_cursoDAO();
        $mc = $dao->select($condicao);
        return $mc;
    }

    /* Retorna a relação de matrículas existentes
     * a partir de id dos cursos
     * @param string $id_usuario
     * 
     */

    public function getAllMatricula_curso($id_curso) {
        $dao = new Matricula_cursoDAO();
        $mc = $dao->selectMatriculaCurso($id_curso);
        return $mc;
    }

    /* Retorna a relação de matrículas existentes a partir de id dos usuarios
     * @param string $id_usuario
     */

    public function getAllMatricula_curso_usuario($id_usuario) {
        $dao = new Matricula_cursoDAO();
        $mc = $dao->selectMatricula_curso_usuario($id_usuario);
        return $mc;
    }

    /* Remove a matricula a partir de id dos curso e usuarios
     * @param string $id_usuario -
     * @param string $id_curso -
     */

    public function removeMatricula_curso($id_curso, $id_usuario) {
        $dao = new Matricula_cursoDAO();
        $mc = $dao->deleteMatriculaCurso($id_curso, $id_usuario);
        return $mc;
    }

    public function novaMatricula(Curso $curso, Usuario $usuario, $bool = 1) {
        $mc = $this->getMatricula_curso('id_curso=' . $curso->getId_curso() . ' AND id_usuario=' . $usuario->getId_usuario());
        if ($mc == null) {
            if ($usuario->getId_papel() == 4) {
                $mc = new Matricula_curso();              
                $mc->setData_inicio(date('d/m/y'));                
                $mc->setData_fim(date('d/m/y', strtotime('+'.$curso->getTempo().' days')));
                $mc->setId_curso($curso->getId_curso());
                $mc->setId_usuario($usuario->getId_usuario());
                $mc->setModulo_atual(1);
                $mc->setStatus_acesso($bool);
                //--
                $dao = new Matricula_cursoDAO();
                return $dao->insert($mc);
            }
        } else {
            if ($mc->getData_inicio() == '--') {
                //curso iniciado - primeiro acesso ao curso..
                date_default_timezone_set("Brazil/East");
                $mc->setData_inicio(date("d/m/y"));
                $this->updateMatricula_curso($mc);
            }
        }
    }

    function updateMatricula_curso(Matricula_curso $mc) {
        if ($mc != null) {
            $dao = new Matricula_cursoDAO();
            return $dao->update($mc);
        } else {
            return 'ERRO: parametros nullos - funcao novoUsuario - [controllerUsuario]';
        }
    }

    public function liberarAcesso($id_matricula_curso, $chave) {
        $mc = $this->getMatricula_curso('id_matricula_curso=' . $id_matricula_curso);
        if ($mc != null) {
            $mc->setStatus_acesso($chave);
            return $this->updateMatricula_curso($mc);
        }
        return 0;
    }

}

?>
