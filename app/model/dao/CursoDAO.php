<?php

class CursoDAO extends PDOConnectionFactory{
    
    private $conex = null;

    public function CursoDAO() {
        $this->conex = $this->getConnection();
    }

    public function insert(Curso $curso, Array $curso_professor) {
        try {
            $stmt = $this->conex->prepare("INSERT INTO curso(id_curso, nome, descricao, tempo, gratuito, valor) VALUES (?,?,?,?,?,?)");
            $stmt->bindValue(1, $curso->getId_curso());
            $stmt->bindValue(2, $curso->getNome());
            $stmt->bindValue(3, $curso->getDescricao());
            $stmt->bindValue(4, $curso->getTempo());
            $stmt->bindValue(5, $curso->getGratuito(1));
            $stmt->bindValue(6, $curso->getValor());
            //inserindo curso no banco
            $stmt->execute();
            
            //inserindo professores do curso no banco                        
            $buscaId = $this->select("nome='". $curso->getNome() ."'");
            $curso_professorDAO = new Curso_professorDAO();
            for($i = 0; $i < count($curso_professor); $i++){
                $curso_professor[$i]->setId_usuario($buscaId[0]->getId_curso());
                $curso_professorDAO->insert($curso_professor[$i]);
            }
            
            $stmt->conex = null;
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function update(Curso $curso, $condicao) {
        try {
            $stmt = $this->conex->prepare("UPDATE curso SET id_curso=?, nome=?, descricao=?, tempo=?, gratuito=?, valor=? WHERE id=?");
            $stmt->bindValue(1, $curso->getId_curso());
            $stmt->bindValue(2, $curso->getNome());
            $stmt->bindValue(3, $curso->getDescricao());
            $stmt->bindValue(4, $curso->getTempo());
            $stmt->bindValue(5, $curso->getGratuito());
            $stmt->bindValue(6, $curso->getValor());
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
            $curso = array();                                   
            for ($i = 0; $i < $stmt->rowCount(); $i++){
                $curso[$i] = $stmt->fetchObject('Curso');
            }
            if($i==0){
                $curso = null;
            }
            return $curso;
        } catch (PDOException $ex) {
            echo "Erro: ". $ex->getMessage();
        }
    }

}

?>
