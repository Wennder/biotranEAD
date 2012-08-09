<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PapelDAO
 *
 * @author cead-p057007
 */
class PapelDAO {
    public $conex = null;

    public function PapelDAO() {
        $this->conex = $this->getConnection();
    }

    public function insert(Papel $papel) {
        try {
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
            $stmt = $this->conex->prepare("UPDATE papel SET id_papel=?, papel=? WHERE id=?");
            $stmt->bindValue(1, $papel->getId_papel());
            $stmt->bindValue(2, $papel->getPapel());
            $stmt->bindValue(7, $condicao);
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

    public function select($selecao = null, $condicao = null) {
        try {
            if ($query == null) {
                if($condicao == null){
                    $stmt = $this->conex->query("SELECT * FROM papel");                    
                }else{
                    $stmt = $this->conex->query("SELECT * FROM papel WHERE ". $condicao);
                }
            } else {
                if ($condicao == null) {
                    $stmt = $this->conex->query("SELECT " . $selecao . " FROM papel");
                }else{
                    $stmt = $this->conex->query("SELECT " . $selecao . " FROM papel WHERE " . $condicao);
                }
            }
        } catch (PDOException $ex) {
            echo "Erro: ". $ex->getMessage();
        }
    }
}

?>
