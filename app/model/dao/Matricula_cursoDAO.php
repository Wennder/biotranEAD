<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Matricula_curso
 *
 * @author cead-p057007
 */
class Matricula_cursoDAO extends PDOConnectionFactory {

    private $conex = null;

    public function Matricula_cursoDAO() {
        $this->conex = $this->getConnection();
    }

    public function insert(Matricula_curso $matricula_curso) {

        try {
            $stmt = $this->conex->prepare("INSERT INTO matricula_curso (id_curso, id_usuario, data_inicio, data_fim, status_acesso, modulo_atual) VALUES (?,?,?,?,?,?)");
            $stmt->bindValue(1, $matricula_curso->getId_curso());
            $stmt->bindValue(2, $matricula_curso->getId_usuario());
            $stmt->bindValue(3, $matricula_curso->getData_inicio());
            $stmt->bindValue(4, $matricula_curso->getData_fim());
            $stmt->bindValue(5, $matricula_curso->getStatus_acesso());
            $stmt->bindValue(6, $matricula_curso->getModulo_atual());

            if ($stmt->execute()) {
                $id = $this->conex->lastInsertId("Matricula_curso");
                $this->conex = null;
                return $id;
            } else {
                return 0;
            }
        } catch (PDOException $ex) {
            echo "ERRO:" . trigger_error('Impossivel inserir matrícula');
        }
    }

    public function update(Matricula_curso $mc = null) {
        try {
            if ($mc != null) {
                $this->conex->exec("SET NAMES 'utf8'");
                $stmt = $this->conex->prepare("UPDATE matricula_curso SET id_curso=?, id_usuario=?,data_inicio=?, data_fim =?, status_acesso=?, modulo_atual=?  WHERE id_matricula_curso=?");
                $stmt->bindValue(1, $mc->getId_curso());
                $stmt->bindValue(2, $mc->getId_usuario());
                $stmt->bindValue(3, $mc->getData_inicio());
                $stmt->bindValue(4, $mc->getData_fim());
                $stmt->bindValue(5, $mc->getStatus_acesso());
                $stmt->bindValue(6, $mc->getModulo_atual());
                $stmt->bindValue(7, $mc->getId_matricula_curso());

                $stmt->execute();
                if ($stmt->execute()) {
                    $this->conex = null;
                    return 1;
                }
                return 0;
            }
        } catch (PDOException $ex) {
            echo "Erro: " . trigger_error('Impossivel atualizar matrícula');
        }
    }

    public function deleteMatriculaCurso($id_curso, $id_usuario) {
        try {
            $num = $this->conex->exec("DELETE FROM matricula_curso WHERE id_curso=" . $id_curso . " AND id_usuario=" . $id_usuario);
            // caso seja executado ele retorna o número de rows que foram afetadas.
            if ($num >= 1) {
                return $num;
            } else {
                return 0;
            }
            // caso ocorra um erro, retorna o erro;
        } catch (PDOException $ex) {
            echo "Erro: " . trigger_error('Impossivel deletar matrícula do curso');
        }
    }

    public function select($condicao) {
        try {
            $stmt = null;
            if ($condicao == null) {
                $stmt = $this->conex->query("SELECT * FROM matricula_curso");
            } else {
                $stmt = $this->conex->query("SELECT * FROM matricula_curso WHERE " . $condicao);
            }
            $mc = null;
            if ($stmt->rowCount() > 0) {
                $mc = array();
            }
            for ($i = 0; $i < $stmt->rowCount(); $i++) {
                $mc[$i] = $stmt->fetchObject('Matricula_curso');
            }
            return $mc;
        } catch (PDOException $ex) {
            return "erro: " . trigger_error('Impossivel selecinar matricula');
        }
    }

    public function selectMatriculaCurso($id_curso) {
        try {
            $stmt = $this->conex->query("SELECT * FROM matricula_curso NATURAL JOIN usuario WHERE id_curso = " . $id_curso);
            $mc = array();
            for ($i = 0; $i < $stmt->rowCount(); $i++) {
                $mc[$i] = $stmt->fetchObject('Usuario');
            }
            return $mc;
        } catch (PDOException $ex) {
            return "erro: " . trigger_error('Impossivel selecionar matricula do curso');
        }
    }

    public function selectMatricula_curso_usuario($id_usuario) {
        try {
            $stmt = $this->conex->query("SELECT * FROM matricula_curso NATURAL JOIN usuario WHERE id_usuario = " . $id_usuario);
            $mc = array();
            for ($i = 0; $i < $stmt->rowCount(); $i++) {
                $mc[$i] = $stmt->fetchObject('Usuario');
            }
            return $mc;
        } catch (PDOException $ex) {
            return "erro: " . trigger_error('Impossivel selecionar matricula do curso a partir do id de usuario');
        }
    }

}

?>
