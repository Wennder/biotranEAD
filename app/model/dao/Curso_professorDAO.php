<?php

class Curso_professorDAO extends PDOConnectionFactory {

    private $conex = null;

    public function Curso_professorDAO() {
        $this->conex = $this->getConnection();
    }
    
    public function insert(Curso_professor $curso_professor) {
        try {            
            $stmt = $this->conex->prepare("INSERT INTO curso_usuario (id_curso, id_usuario) VALUES (?,?)");
            $stmt->bindValue(1, $curso_professor->getId_usuario());
            $stmt->bindValue(2, $curso_professor->getId_curso());

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

}

?>
