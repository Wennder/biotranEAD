<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RespostaDAO
 *
 * @author Rodolfo
 */
class RespostaDAO extends PDOConnectionFactory{
    //put your code here
    private $conex = null;

    public function RespostaDAO() {
        $this->conex = $this->getConnection();
    }

    public function insert(Resposta $resposta) {
        try {
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("INSERT INTO resposta(id_topico, id_usuario, mensagem, data_hora) VALUES (?,?,?,?)");
            $stmt->bindValue(1, $resposta->getId_topico());
            $stmt->bindValue(2, $resposta->getId_usuario());
            $stmt->bindValue(3, $resposta->getMensagem());               
            $stmt->bindValue(4, $resposta->getData_hora());               
            
            if(!$stmt->execute()){
                return 0;
            }
            
            $id = $this->conex->lastInsertId("Resposta");
            $this->conex = null;
            return $id;  
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function update(Resposta $resposta) {
        try {
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("UPDATE resposta SET id_topico=?, id_usuario=?, mensagem=?, data_hora=? WHERE id_respsota=?");
            $stmt->bindValue(1, $resposta->getId_exercicio());
            $stmt->bindValue(2, $resposta->getNumeracao());
            $stmt->bindValue(3, $resposta->getEnunciado());          
            $stmt->bindValue(4, $resposta->getData_hora());          
            $stmt->bindValue(5, $resposta->getId_pergunta());          
            $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function delete(Resposta $resposta) {
        try {
            $num = $this->conex->exec("DELETE FROM resposta WHERE id_resposta=" . $resposta->getId_resposta());
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
    public function deletePor_id($id_resposta) {
        try {
            $num = $this->conex->exec("DELETE FROM resposta WHERE id_resposta=" . $id_resposta);
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
                $stmt = $this->conex->query("SELECT * FROM resposta");
            } else {
                $stmt = $this->conex->query("SELECT * FROM resposta WHERE " . $condicao);
            }            
            $resposta = array();
            if($stmt){                
                for ($i = 0; $i < $stmt->rowCount(); $i++) {
                    $resposta[$i] = $stmt->fetchObject('Resposta');
                }            
            }else return null;
            return $resposta;
        } catch (PDOException $ex) {
            return "erro: " . $ex;
        }
    }
}

?>
