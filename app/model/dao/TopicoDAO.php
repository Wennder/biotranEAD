<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TopicoDAO
 *
 * @author Rodolfo
 */
class TopicoDAO extends PDOConnectionFactory{
    //put your code here
    private $conex = null;

    public function TopicoDAO() {
        $this->conex = $this->getConnection();
    }

    public function insert(Topico $topico) {
        try {
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("INSERT INTO topico(id_curso, id_usuario, titulo, mensagem,data_hora) VALUES (?,?,?,?,?)");
            $stmt->bindValue(1, $topico->getId_curso());
            $stmt->bindValue(2, $topico->getId_usuario());
            $stmt->bindValue(3, $topico->getTitulo());               
            $stmt->bindValue(4, $topico->getMensagem()); 
            $stmt->bindValue(5, $topico->getData_hora()); 
            $stmt->execute();
            $id = $this->conex->lastInsertId("Topico");
            $this->conex = null;
            return $id;      
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function update(Topico $topico) {
        try {
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("UPDATE pergunta SET id_curso=?, id_usuario=?, mensagem=?, titulo=?,data_hora=? WHERE id_topico=?");
            $stmt->bindValue(1, $topico->getId_curso());
            $stmt->bindValue(2, $topico->getId_usuario());
            $stmt->bindValue(3, $topico->getMensagem());          
            $stmt->bindValue(4, $topico->getTitulo());          
            $stmt->bindValue(5, $topico->getData_hora());          
            $stmt->bindValue(6, $topico->getId_topico());          
            $stmt->execute();
           
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function delete(Topico $pergunta) {
        try {
            $num = $this->conex->exec("DELETE FROM topico WHERE id_topico=" . $pergunta->getId_topico());
            // caso seja execuado ele retorna o número de rows que foram afetadas.
            if ($num >= 1) {
                return $num;
            } else {
                return 0;
            }
            // caso ocorra um erro, retorna o erro;
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }
    public function deletePor_id($id_topico) {
        try {
            $num = $this->conex->exec("DELETE FROM topico WHERE id_topico=" . $id_topico);
            // caso seja execuado ele retorna o número de rows que foram afetadas.
            if ($num >= 1) {
                return $num;
            } else {
                return 0;
            }
            // caso ocorra um erro, retorna o erro;
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function select($condicao = null) {
        try {
            $stmt = null;
            if ($condicao == null) {
                $stmt = $this->conex->query("SELECT * FROM topico");
            } else {
                $stmt = $this->conex->query("SELECT * FROM topico WHERE " . $condicao);
            }            
            $topico = array();
            if($stmt){                
                for ($i = 0; $i < $stmt->rowCount(); $i++) {
                    $topico[$i] = $stmt->fetchObject('Topico');
                }            
            }else return null;
            return $topico;
        } catch (PDOException $ex) {
            return "erro: " . $ex;
        }
    }
}

?>
