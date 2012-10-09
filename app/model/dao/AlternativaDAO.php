<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AlternativaDAO
 *
 * @author cead-p057007
 */
class AlternativaDAO extends PDOConnectionFactory {

    private $conex = null;

    public function AlternativaDAO() {
        $this->conex = $this->getConnection();
    }

    public function insert(Alternativa $alternativa) {
        try {
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("INSERT INTO alternativa(id_pergunta, resposta, justificativa, eh_correta) VALUES (?,?,?,?)");
            $stmt->bindValue(1, $alternativa->getId_pergunta());
            $stmt->bindValue(2, $alternativa->getResposta());
            $stmt->bindValue(3, $alternativa->getJustificativa());
            $stmt->bindValue(4, $alternativa->getEh_correta());

            $stmt->execute();
            return $this->conex->lastInsertId("Alternativa");            
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function update(Alternativa $alternativa) {
        try {
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("UPDATE alternativa SET id_pergunta=?, resposta=?, justificativa=?, eh_correta=? WHERE id_alternativa=?");
            $stmt->bindValue(1, $alternativa->getId_pergunta());
            $stmt->bindValue(2, $alternativa->getNumeracao());
            $stmt->bindValue(3, $alternativa->getJustificativa());          
            $stmt->bindValue(3, $alternativa->getEh_correta());          
            $stmt->bindValue(4, $alternativa->getId_alternativa());          
            $stmt->execute();
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function delete(Alternativa $alternativa) {
        try {
            $num = $this->conex->exec("DELETE FROM alternativa WHERE id_alternativa=" . $alternativa->getId_alternativa());
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
                $stmt = $this->conex->query("SELECT * FROM alternativa");
            } else {
                $stmt = $this->conex->query("SELECT * FROM alternativa WHERE " . $condicao);
            }
            $alternativa = array();
            for ($i = 0; $i < $stmt->rowCount(); $i++) {
                $alternativa[$i] = $stmt->fetchObject('Alternativa');
            }
            return $alternativa;
        } catch (PDOException $ex) {
            return "erro: " . $ex;
        }
    }
}

?>
