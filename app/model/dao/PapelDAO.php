<?php

class PapelDAO extends PDOConnectionFactory {

    private $conex = null;

    public function PapelDAO() {
        $this->conex = $this->getConnection();
    }

    public function insert(Papel $papel) {
        try {
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("INSERT INTO papel(id_papel, papel) VALUES (?,?)");
            $stmt->bindValue(1, $papel->getId_papel());
            $stmt->bindValue(2, $papel->getPapel());

            $stmt->execute();
            $stmt->conex = null;
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function update(Papel $papel, $condicao) {
        try {
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("UPDATE papel SET papel=? WHERE id_papel=?");
            $stmt->bindValue(1, $papel->getPapel());
            $stmt->bindValue(2, $papel->getId_papel());            
            $stmt->execute();
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function delete(Papel $papel) {
        try {
            $num = $this->conex->exec("DELETE FROM papel WHERE id=" . $papel->getId_papel());
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
                $stmt = $this->conex->query("SELECT * FROM papel");
            } else {
                $stmt = $this->conex->query("SELECT * FROM papel WHERE " . $condicao);
            }
            $papel = array();
            for ($i = 0; $i < $stmt->rowCount(); $i++) {
                $papel[$i] = $stmt->fetchObject('Papel');
            }
            return $papel;
        } catch (PDOException $ex) {
            return "erro: " . $ex;
        }
    }

}

?>
