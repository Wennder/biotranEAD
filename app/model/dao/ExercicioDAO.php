<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExercicioDAO
 *
 * @author cead-p057007
 */
class ExercicioDAO extends PDOConnectionFactory {

    private $conex = null;

    public function ExercicioDAO() {
        $this->conex = $this->getConnection();
    }

    public function insert(Exercicio $exercicio) {
        try {
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("INSERT INTO exercicio(id_modulo, titulo, descricao) VALUES (?,?,?)");
            $stmt->bindValue(1, $exercicio->getId_modulo());
            $stmt->bindValue(2, $exercicio->getTitulo());
            $stmt->bindValue(3, $exercicio->getDescricao());

            $stmt->execute();
            return $this->conex->lastInsertId("Exercicio");            
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function update(Exercicio $exercicio) {
        try {
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("UPDATE exercicio SET id_modulo=?, titulo=?, descricao=? WHERE id_exercicio=?");
            $stmt->bindValue(1, $exercicio->getId_modulo());
            $stmt->bindValue(2, $exercicio->getTitulo());
            $stmt->bindValue(3, $exercicio->getDescricao());          
            $stmt->bindValue(4, $exercicio->getId_exercicio());          
            $stmt->execute();
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function delete(Exercicio $exercicio) {
        try {
            $num = $this->conex->exec("DELETE FROM exercicio WHERE id=" . $exercicio->getId_exercicio());
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
                $stmt = $this->conex->query("SELECT * FROM exercicio");
            } else {
                $stmt = $this->conex->query("SELECT * FROM exercicio WHERE " . $condicao);
            }
            $exercicio = array();
            for ($i = 0; $i < $stmt->rowCount(); $i++) {
                $exercicio[$i] = $stmt->fetchObject('Exercicio');
            }
            return $exercicio;
        } catch (PDOException $ex) {
            return "erro: " . $ex;
        }
    }

}

?>
