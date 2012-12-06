<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ComentarioDAO
 *
 * @author Rodolfo
 */
class ComentarioDAO extends PDOConnectionFactory {
    //put your code here
    private $conex = null;

    public function ComentarioDAO() {
        $this->conex = $this->getConnection();
    }

    public function insert(Comentario $comentario) {
        try {
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("INSERT INTO comentario( id_comentario, autor, comentario, data) VALUES (?,?,?,?)");
            $stmt->bindValue(1, $comentario->getId_comentario());
            $stmt->bindValue(2, $comentario->getAutor());
            $stmt->bindValue(3, $comentario->getComentario());
            $stmt->bindValue(4, $comentario->getData());
            if(!$stmt->execute()){               
                return false;
            }            
            return $this->conex->lastInsertId("Comentario");            
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function update(Comentario $comentario) {
        try {
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("UPDATE comentario SET autor=?, comentario=?, data=? WHERE id_comentario=?");
            $stmt->bindValue(1, $comentario->getAutor());
            $stmt->bindValue(2, $comentario->getComentario());          
            $stmt->bindValue(3, $comentario->getData());          
            $stmt->bindValue(4, $comentario->getId_comentario());          
            $stmt->execute();
            return 1;
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function delete(Comentario $comentario) {
        try {
            $num = $this->conex->exec("DELETE FROM comentario WHERE id_comentario=" . $comentario->getId_patrocinador());
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
    public function deletePorId( $id_comentario) {
        try {
            $num = $this->conex->exec("DELETE FROM comentario WHERE id_comentario=" . $id_comentario);
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
                $stmt = $this->conex->query("SELECT * FROM comentario");
            } else {
                $stmt = $this->conex->query("SELECT * FROM comentario WHERE " . $condicao);
            }            
            $comentario = array();
            if($stmt){                
                for ($i = 0; $i < $stmt->rowCount(); $i++) {
                    $comentario[$i] = $stmt->fetchObject('Comentario');
                }            
            }else return null;
            return $comentario;
        } catch (PDOException $ex) {
            return "erro: " . $ex;
        }
    }
}

?>
