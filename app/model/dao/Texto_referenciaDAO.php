<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Exercicio_referenciaDAO
 *
 * @author cead-p057007
 */
class Texto_referenciaDAO extends PDOConnectionFactory {

    private $conex = null;

    public function Texto_referenciaDAO() {
        $this->conex = $this->getConnection();
    }

    public function insert(Texto_referencia $texto_referencia) {
        try {
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("INSERT INTO texto_referencia(id_modulo, nome) VALUES (?,?)");
            $stmt->bindValue(1, $texto_referencia->getId_modulo());
            $stmt->bindValue(2, $texto_referencia->getNome());

            $stmt->execute();
            $id = $this->conex->lastInsertId("Texto_referencia");
            $this->conex = null;
            return $id;
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function update(Texto_referencia $texto_referencia) {
        try {
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("UPDATE texto_referencia SET id_modulo=?, nome=? WHERE id_texto_referencia=?");
            $stmt->bindValue(1, $texto_referencia->getId_modulo());
            $stmt->bindValue(2, $texto_referencia->getNome());
            $stmt->bindValue(3, $texto_referencia->getId_texto_referencia());
            $stmt->execute();
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function delete(Texto_referencia $texto_referencia) {
        try {
            $num = $this->conex->exec("DELETE FROM texto_referencia WHERE id_texto_referencia=" . $texto_referencia->getId_texto_referencia());
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
                $stmt = $this->conex->query("SELECT * FROM texto_referencia");
            } else {
                $stmt = $this->conex->query("SELECT * FROM texto_referencia WHERE " . $condicao);
            }
            $texto_referencia = array();
            for ($i = 0; $i < $stmt->rowCount(); $i++) {
                $texto_referencia[$i] = $stmt->fetchObject('Texto_referencia');
            }
            return $texto_referencia;
        } catch (PDOException $ex) {
            return "erro: " . $ex;
        }
    }

}

?>
