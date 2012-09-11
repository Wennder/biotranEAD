<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Matricula_curso
 *
 * @author cead-p057007
 */
class Matricula_cursoDAO  extends PDOConnectionFactory{
    
    private $conex=null;
    
    public function Matricula_cursoDAO() {
        $this->conex = $this->getConnection();
    }

    public function insert(Matricula_curso $matricula_curso) {

        try {
            $stmt = $this->conex->prepare("INSERT INTO matricula_curso (id_curso, id_usuario, data_inicio, data_fim, status_acesso, modulo_atual) VALUES (?,?,?,?,?,?)");
            $stmt->bindValue(1, $matricula_curso->getId_curso());
            $stmt->bindValue(2, $matricula_curso->getData_inicio());
            $stmt->bindValue(3, $matricula_curso->getData_fim());
            $stmt->bindValue(4, $matricula_curso->getStatus_acesso());
            $stmt->bindValue(5, $matricula_curso->getModulo_atual());


            $stmt->execute();
            $stmt->conex = null;
        } catch (PDOException $ex) {
            echo "ERRO:" . trigger_error('Impossivel inserir matrícula');
        }
    }

    public function update(){}
        
        
        public function delete(){}
        
        
        public function select(){}
    
    
    
}

?>
