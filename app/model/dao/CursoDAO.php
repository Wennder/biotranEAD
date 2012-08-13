<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include "../app/model/pdo/PDOConnectionFactory.class.php";
/**
 * Description of CursoDAO
 *
 * @author cead-p057007
 */
class CursoDAO extends PDOConnectionFactory{
    public $conex = null;

    public function CursoDAO() {
        $this->conex = $this->getConnection();
    }

    public function insert(Curso $curso) {
        try {
            $stmt = $this->conex->prepare("INSERT INTO curso(id_curso, nome, descricao) VALUES (?,?,?)");
            $stmt->bindValue(1, $curso->getId_curso());
            $stmt->bindValue(2, $curso->getNome());
            $stmt->bindValue(3, $curso->getDescricao());

            $stmt->execute();
            $stmt->conex = null;
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function update(Curso $curso, $condicao) {
        try {
            $stmt = $this->conex->prepare("UPDATE curso SET id_curso=?, nome=?, descricao=? WHERE id=?");
            $stmt->bindValue(1, $curso->getId_curso());
            $stmt->bindValue(2, $curso->getNome());
            $stmt->bindValue(3, $curso->getDescricao());
            $stmt->bindValue(7, $condicao);
            $stmt->execute();
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function delete(Curso $curso) {
        try {
            $num = $this->conex->exec("DELETE FROM curso WHERE id=" . $curso->getId_curso());
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
            $stmt = null;
            if ($selecao == null) {
                if($condicao == null){
                    $stmt = $this->conex->query("SELECT * FROM curso");                    
                }else{
                    $stmt = $this->conex->query("SELECT * FROM curso WHERE ". $condicao);
                }
            } else {
                if ($condicao == null) {
                    $stmt = $this->conex->query("SELECT " . $selecao . " FROM curso");
                }else{
                    $stmt = $this->conex->query("SELECT " . $selecao . " FROM curso WHERE " . $condicao);
                }
            }
            return $stmt;
        } catch (PDOException $ex) {
            echo "Erro: ". $ex->getMessage();
        }
    }

}

?>
