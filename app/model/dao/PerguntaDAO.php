<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PerguntaDAO
 *
 * @author cead-p057007
 */
class PerguntaDAO extends PDOConnectionFactory {

    private $conex = null;

    public function PerguntaDAO() {
        $this->conex = $this->getConnection();
    }

    public function insert(Pergunta $pergunta) {
        try {
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("INSERT INTO pergunta(id_exercicio, numeracao, enunciado) VALUES (?,?,?)");
            $stmt->bindValue(1, $pergunta->getId_exercicio());
            $stmt->bindValue(2, $pergunta->getNumeracao());
            $stmt->bindValue(3, $pergunta->getEnunciado());

            if(!$stmt->execute()){
                echo($pergunta->getId_exercicio()); die();
            }            
            return $this->conex->lastInsertId("Pergunta");            
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function update(Pergunta $pergunta) {
        try {
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("UPDATE pergunta SET id_exercicio=?, numeracao=?, descricao=? WHERE id_pergunta=?");
            $stmt->bindValue(1, $pergunta->getId_exercicio());
            $stmt->bindValue(2, $pergunta->getNumeracao());
            $stmt->bindValue(3, $pergunta->getEnunciado());          
            $stmt->bindValue(4, $pergunta->getId_pergunta());          
            $stmt->execute();
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function delete(Pergunta $pergunta) {
        try {
            $num = $this->conex->exec("DELETE FROM pergunta WHERE id_pergunta=" . $pergunta->getId_pergunta());
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
                $stmt = $this->conex->query("SELECT * FROM pergunta");
            } else {
                $stmt = $this->conex->query("SELECT * FROM pergunta WHERE " . $condicao);
            }
            $pergunta = array();
            if($stmt){                
                for ($i = 0; $i < $stmt->rowCount(); $i++) {
                    $pergunta[$i] = $stmt->fetchObject('Pergunta');
                }            
            }else return null;
            return $pergunta;
        } catch (PDOException $ex) {
            return "erro: " . $ex;
        }
    }
}

?>
