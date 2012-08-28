<?php

class Curso_professor {

    private $id_curso_professor;
    private $id_curso;
    private $id_usuario;
    
    public function getId_curso_professor() {
        return $this->id_curso_professor;
    }

    public function setId_curso_professor($id_curso_professor) {
        $this->id_curso_professor = $id_curso_professor;
    }

    public function getId_curso() {
        return $this->id_curso;
    }

    public function setId_curso($id_curso) {
        $this->id_curso = $id_curso;
    }

    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }
}

?>
