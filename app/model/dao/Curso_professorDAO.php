<?php

class Curso_professorDAO extends PDOConnectionFactory {

    private $conex = null;

    public function Curso_professorDAO() {
        $this->conex = $this->getConnection();
    }

    public function insert(Curso_professor $curso_professor) {
        try {
            $stmt = $this->conex->prepare("INSERT INTO curso_professor (id_curso, id_usuario) VALUES (?,?)");
            $stmt->bindValue(1, $curso_professor->getId_curso());
            $stmt->bindValue(2, $curso_professor->getId_usuario());

            $stmt->execute();


            $stmt->conex = null;
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

//    public function select($idCurso, $idUsuario) {
//        try {
//            $this->conex->exec("SET NAMES 'utf8'");
//            $stmt = $this->conex->query("SELECT * FROM curso_professor WHERE id_curso=" . $idCurso . " AND id_usuario=" . $idUsuario . "");
//            if ($stmt->rowCount() == 1) {
//                return 1;
//            }else
//                return 0;
//        } catch (PDOException $ex) {
//            return "erro: " . $ex;
//        }
//    }

    public function update(Curso_professor $cp = null) {
        try {
            if ($cp != null) {
                $this->conex->exec("SET NAMES 'utf8'");
                $stmt = $this->conex->prepare("UPDATE curso_professor SET id_curso=?, id_usuario=? WHERE id_curso_professor=?");
                $stmt->bindValue(1, $cp->getId_curso());
                $stmt->bindValue(2, $cp->getId_usuario());
                $stmt->bindValue(3, $cp->getId_curso_professor());
                $stmt->execute();
                if ($cp != null) {
                    $dao = new Curso_professor();
                    $dao->update($cp);
                }
            }
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function deleteProfessoresCurso($id_curso) {
        try {
            $num = $this->conex->exec("DELETE FROM curso_professor WHERE id_curso=" . $id_curso);
            // caso seja executado ele retorna o número de rows que foram afetadas.
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

    public function select($condicao) {
        try {
            $stmt = null;
            if ($condicao == null) {
                $stmt = $this->conex->query("SELECT * FROM curso_professor");
            } else {
                $stmt = $this->conex->query("SELECT * FROM curso_professor WHERE " . $condicao);
            }
            $cp = array();
            for ($i = 0; $i < $stmt->rowCount(); $i++) {
                $cp[$i] = $stmt->fetchObject('Curso_professor');
            }
            return $cp;
        } catch (PDOException $ex) {
            return "erro: " . $ex;
        }
    }

    /*
     * retorna um array de Usuarios professor responsáveis pelo curso
     * de id = $id_curso;
     */

    public function selectProfessoresCurso($id_curso) {
        try {
            $stmt = $this->conex->query("SELECT * FROM curso_professor NATURAL JOIN usuario WHERE id_curso = " . $id_curso);
            $cp = array();
            for ($i = 0; $i < $stmt->rowCount(); $i++) {
                $cp[$i] = $stmt->fetchObject('Usuario');                
            }
            return $cp;
        } catch (PDOException $ex) {
            return "erro: " . $ex;
        }
    }

}

?>
