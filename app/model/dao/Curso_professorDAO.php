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

    public function select($idCurso, $idUsuario) {
        try {
            $stmt = $this->conex->query("SELECT * FROM curso_professor WHERE id_curso=" . $idCurso . " AND id_usuario=" . $idUsuario . "");
            if ($stmt->rowCount() == 1) {
                return 1;
            }else
                return 0;
        } catch (PDOException $ex) {
            return "erro: " . $ex;
        }
    }

    public function selectProfessores($idCurso) {
        try {
            $stmt = null;
            $stmt = $this->conex->query("SELECT id_usuario, login, senha, id_papel, nome_completo, data_nascimento, cpf_passaporte, rg, id_profissional, atuacao, descricao_pessoal, sexo, tel_principal, tel_secundario, email FROM curso_professor NATURAL JOIN usuario WHERE id_curso = " . $idCurso . " ORDER BY nome_completo");
            $professores = array();
            for ($i = 0; $i < $stmt->rowCount(); $i++) {
                $professores[$i] = $stmt->fetchObject('Usuario');
            }
            if ($i == 0) {
                $professores = null;
            }
            return $professores;
        } catch (PDOException $ex) {
            return "erro: " . $ex;
        }
    }

}

?>
