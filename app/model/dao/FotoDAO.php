<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FotoDAO
 *
 * @author Rodolfo
 */
class FotoDAO extends PDOConnectionFactory {
    //put your code here
      private $conex = null;

    public function FotoDAO() {
        $this->conex = $this->getConnection();
    }

    public function insert(Foto $foto) {
        try {
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("INSERT INTO foto(id_foto, imagem) VALUES (?,?)");
            $stmt->bindValue(1, $foto->getId_foto());
            $stmt->bindValue(2, $foto->getImagem());
            if(!$stmt->execute()){
                echo($foto->getId_foto()); die();
            }            
            return $this->conex->lastInsertId("Foto");            
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function update(Foto $foto) {
        try {
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("UPDATE foto SET imagem=? WHERE id_foto=?");
            $stmt->bindValue(1, $foto->getImagem());
            $stmt->bindValue(2, $foto->getId_foto());          
            $stmt->execute();
            return 1;
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function delete(Foto $foto) {
        try {
            $num = $this->conex->exec("DELETE FROM foto WHERE id_foto=" . $foto->getId_patrocinador());
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
    public function deletePorId( $id_foto) {
        try {
            $num = $this->conex->exec("DELETE FROM foto WHERE id_foto=" . $id_foto);
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
                $stmt = $this->conex->query("SELECT * FROM foto");
            } else {
                $stmt = $this->conex->query("SELECT * FROM foto WHERE " . $condicao);
            }            
            $foto = array();
            if($stmt){                
                for ($i = 0; $i < $stmt->rowCount(); $i++) {
                    $foto[$i] = $stmt->fetchObject('Foto');
                }            
            }else return null;
            return $foto;
        } catch (PDOException $ex) {
            return "erro: " . $ex;
        }
    }
}

?>
