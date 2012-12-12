<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NoticiaDAO
 *
 * @author Rodolfo
 */
class NoticiaDAO extends PDOConnectionFactory {
    //put your code here
    private $conex = null;

    public function NoticiaDAO() {
        $this->conex = $this->getConnection();
    }

    public function insert(Noticia $noticia) {
        try {
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("INSERT INTO noticia(id_noticia, titulo, noticia, data, manchete,autor) VALUES (?,?,?,?,?,?)");
            $stmt->bindValue(1, $noticia->getId_noticia());
            $stmt->bindValue(2, $noticia->getTitulo());
            $stmt->bindValue(3, $noticia->getNoticia());
            $stmt->bindValue(4, $noticia->getData());
            $stmt->bindValue(5, $noticia->getManchete());
            $stmt->bindValue(6, $noticia->getAutor());
            if(!$stmt->execute()){
                return 0;
            }            
            return $this->conex->lastInsertId("Noticia");            
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function update(Noticia $noticia) {
        try {
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("UPDATE noticia SET titulo=?,noticia=?,data=?,manchete=?, autor=? WHERE id_noticia=?");
            $stmt->bindValue(1, $noticia->getTitulo());
            $stmt->bindValue(2, $noticia->getNoticia());
            $stmt->bindValue(3, $noticia->getData());
            $stmt->bindValue(4, $noticia->getManchete());
            $stmt->bindValue(5, $noticia->getAutor());          
            $stmt->bindValue(6, $noticia->getId_noticia());          
            if(!$stmt->execute()){
                return 0 ;
            }            
            return 1;
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function delete(Noticia $noticia) {
        try {
            $num = $this->conex->exec("DELETE FROM noticia WHERE id_noticia=" . $noticia->getId_noticia());
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
    public function deletePorId( $id_noticia) {
        try {
            $num = $this->conex->exec("DELETE FROM noticia WHERE id_noticia=" . $id_noticia);
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
                $stmt = $this->conex->query("SELECT * FROM noticia");
            } else {
                $stmt = $this->conex->query("SELECT * FROM noticia WHERE " . $condicao);
            }            
            $noticia = array();
            if($stmt){                
                for ($i = 0; $i < $stmt->rowCount(); $i++) {
                    $noticia[$i] = $stmt->fetchObject('Noticia');
                }            
            }else return null;
            return $noticia;
        } catch (PDOException $ex) {
            return "erro: " . $ex;
        }
    }
}

?>
