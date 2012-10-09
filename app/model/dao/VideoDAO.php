<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VideoDAO
 *
 * @author cead-p057007
 */
class VideoDAO extends PDOConnectionFactory {
    
    private $conex = null;

    public function VideoDAO() {
        $this->conex = $this->getConnection();
    }

    public function insert(Video $video) {
        try {
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("INSERT INTO video(descricao, titulo, id_modulo) VALUES (?,?,?)");
            $stmt->bindValue(1, $video->getDescricao());
            $stmt->bindValue(2, $video->getTitulo());
            $stmt->bindValue(3, $video->getId_modulo());

            $stmt->execute();
            $id = $this->conex->lastInsertId("Video");
            $this->conex = null;
            return $id;
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function update(Video $video, $condicao) {
        try {
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("UPDATE video SET descricao=?, titulo=?, id_modulo=? WHERE id_video=?");
            $stmt->bindValue(1, $video->getDescricao());
            $stmt->bindValue(2, $video->getTitulo());
            $stmt->bindValue(3, $video->getId_modulo());
            $stmt->bindValue(4, $video->getId_video());
            
            $stmt->execute();
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function delete(Video $video) {
        try {
            $num = $this->conex->exec("DELETE FROM video WHERE id_video=" . $video->getId_video());
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
                $stmt = $this->conex->query("SELECT * FROM video");
            } else {
                $stmt = $this->conex->query("SELECT * FROM video WHERE " . $condicao);
            }
            $video = null;
            if($stmt){
            $video = array();
                for ($i = 0; $i < $stmt->rowCount(); $i++) {
                    $video[$i] = $stmt->fetchObject('Video');
                }
                
            }
            return $video;
        } catch (PDOException $ex) {
            return "erro: " . $ex;
        }
    }
}

?>
