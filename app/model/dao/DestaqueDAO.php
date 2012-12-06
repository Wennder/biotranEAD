<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DestaqueDAO
 *
 * @author Rodolfo
 */
class DestaqueDAO extends PDOConnectionFactory {
    //put your code here
     private $conex = null;

    public function DestaqueDAO() {
        $this->conex = $this->getConnection();
    }

    public function insert(Destaque $destaque) {
        try {
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("INSERT INTO destaque(id_destaque, destaque) VALUES (?,?)");
            $stmt->bindValue(1, $destaque->getId_destaque());
            $stmt->bindValue(2, $destaque->getDestaque());
            if(!$stmt->execute()){
                return 0;
            }            
            return $this->conex->lastInsertId("Destaque");            
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function update(Destaque $destaque) {
        try {
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("UPDATE destaque SET destaque=? WHERE id_destaque=?");
            $stmt->bindValue(1, $destaque->getDestaque());
            $stmt->bindValue(2, $destaque->getId_destaque());          
            $stmt->execute();
            return 1;
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function delete(Destaque $destaque) {
        try {
            $num = $this->conex->exec("DELETE FROM destaque WHERE id_destaque=" . $destaque->getId_destaque());
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
    public function deletePorId( $id_destaque) {
        try {
            $num = $this->conex->exec("DELETE FROM destaque WHERE id_destaque=" . $id_destaque);
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
                $stmt = $this->conex->query("SELECT * FROM destaque");
            } else {
                $stmt = $this->conex->query("SELECT * FROM destaque WHERE " . $condicao);
            }            
            $destaque = array();
            if($stmt){                
                for ($i = 0; $i < $stmt->rowCount(); $i++) {
                    $destaque[$i] = $stmt->fetchObject('Destaque');
                }            
            }else return null;
            return $destaque;
        } catch (PDOException $ex) {
            return "erro: " . $ex;
        }
    }
}

?>
