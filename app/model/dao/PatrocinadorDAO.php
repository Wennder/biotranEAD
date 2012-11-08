<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PatrocinadorDAO
 *
 * @author Rodolfo
 */
class PatrocinadorDAO extends PDOConnectionFactory {
    //put your code here
    private $conex = null;

    public function PatrocinadorDAO() {
        $this->conex = $this->getConnection();
    }

    public function insert(Patrocinador $patrocinador) {
        try {
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("INSERT INTO patrocinador(id_patrocinador, imagem) VALUES (?,?)");
            $stmt->bindValue(1, $patrocinador->getId_patrocinador());
            $stmt->bindValue(2, $patrocinador->getImagem());
            if(!$stmt->execute()){
                echo($patrocinador->getId_patrocinador()); die();
            }            
            return $this->conex->lastInsertId("Patrocinador");            
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function update(Patrocinador $patrocinador) {
        try {
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("UPDATE patrocinador SET imagem=? WHERE id_patrocinador=?");
            $stmt->bindValue(1, $patrocinador->getImagem());
            $stmt->bindValue(2, $patrocinador->getId_patrocinador());          
            $stmt->execute();
            return 1;
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function delete(Patrocinador $patrocinador) {
        try {
            $num = $this->conex->exec("DELETE FROM patrocinador WHERE id_patrocinador=" . $patrocinador->getId_patrocinador());
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
    public function deletePorId( $id_patrocinador) {
        try {
            $num = $this->conex->exec("DELETE FROM patrocinador WHERE id_patrocinador=" . $id_patrocinador);
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
                $stmt = $this->conex->query("SELECT * FROM patrocinador");
            } else {
                $stmt = $this->conex->query("SELECT * FROM patrocinador WHERE " . $condicao);
            }            
            $patrocinador = array();
            if($stmt){                
                for ($i = 0; $i < $stmt->rowCount(); $i++) {
                    $patrocinador[$i] = $stmt->fetchObject('Patrocinador');
                }            
            }else return null;
            return $patrocinador;
        } catch (PDOException $ex) {
            return "erro: " . $ex;
        }
    }
}

?>
