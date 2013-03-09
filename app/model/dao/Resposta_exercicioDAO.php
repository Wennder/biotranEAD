<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Resposta_exercicioDAO
 *
 * @author Rodolfo
 */
class Resposta_exercicioDAO extends PDOConnectionFactory{
    //put your code here
    private $conex = null;

    public function Resposta_exercicioDAO() {
        $this->conex = $this->getConnection();
    }

    public function insert(Resposta_exercicio $resposta_exercicio) {
        try {
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("INSERT INTO resposta_exercicio(id_pergunta, id_exercicio, id_usuario, resposta) VALUES (?,?,?,?)");
            $stmt->bindValue(1, $resposta_exercicio->getId_pergunta());
            $stmt->bindValue(2, $resposta_exercicio->getId_exercicio());
            $stmt->bindValue(3, $resposta_exercicio->getId_usuario());               
            $stmt->bindValue(4, $resposta_exercicio->getResposta());               
            
            if(!$stmt->execute()){
                return 0;
            }
            
            $id = $this->conex->lastInsertId("Resposta_exercicio");
            $this->conex = null;
            return $id;  
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function update(Resposta_exercicio $resposta_exercicio) {
        try {
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("UPDATE resposta_exercicio SET id_pergunta=?, id_exercicio=?, id_usuario=?, resposta=? WHERE idresposta_exercicio=?");
            $stmt->bindValue(1, $resposta_exercicio->getId_pergunta());
            $stmt->bindValue(2, $resposta_exercicio->getId_exercicio());
            $stmt->bindValue(3, $resposta_exercicio->getId_usuario());          
            $stmt->bindValue(4, $resposta_exercicio->getResposta());          
            $stmt->bindValue(5, $resposta_exercicio->getId_resposta_exercicio());          
            $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function delete(Resposta_exercicio $resposta_exercicio) {
        try {
            $num = $this->conex->exec("DELETE FROM resposta_exercicio WHERE id_resposta_exercicio=" . $resposta_exercicio->getId_resposta_exercicio());
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
    public function deletePor_id($id_resposta_exercicio) {
        try {
            $num = $this->conex->exec("DELETE FROM resposta_exercicio WHERE id_resposta_exercicio=" . $id_resposta_exercicio);
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
                $stmt = $this->conex->query("SELECT * FROM resposta_exercicio");
            } else {
                $stmt = $this->conex->query("SELECT * FROM resposta_exercicio WHERE " . $condicao);
            }            
            $resposta_exercicio = array();
            if($stmt){                
                for ($i = 0; $i < $stmt->rowCount(); $i++) {
                    $resposta_exercicio[$i] = $stmt->fetchObject('Resposta_exercicio');
                }            
            }else return null;
            return $resposta_exercicio;
        } catch (PDOException $ex) {
            return "erro: " . $ex;
        }
    }
}

?>
