<?php

class CursoDAO extends PDOConnectionFactory {

    private $conex = null;

    public function CursoDAO() {
        $this->conex = $this->getConnection();
    }

    public function insert(Curso $curso, array $curso_professor) {
        try {
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("INSERT INTO curso(id_curso, nome, descricao, tempo, gratuito, valor, status, numero_modulos, objetivo, justificativa, obs) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
            $stmt->bindValue(1, $curso->getId_curso());
            $stmt->bindValue(2, $curso->getNome());
            $stmt->bindValue(3, $curso->getDescricao());
            $stmt->bindValue(4, $curso->getTempo());
            $stmt->bindValue(5, $curso->getGratuito(1));
            $stmt->bindValue(6, $curso->getValor());
            $stmt->bindValue(7, $curso->getStatus(1));
            $stmt->bindValue(8, $curso->getNumero_modulos());
            $stmt->bindValue(9, $curso->getObjetivo());
            $stmt->bindValue(10, $curso->getJustificativa());
            $stmt->bindValue(11, $curso->getObs());

            //inserindo curso no banco
            if (!$stmt->execute()) {
                trigger_error("0 Erro insersao banco de dados");                
            }

            //inserindo professores do curso no banco                        
            $buscaId = $this->select("nome='" . $curso->getNome() . "'");
            $curso_professorDAO = new Curso_professorDAO();            
            for ($i = 0; $i < count($curso_professor); $i++) {                
                $curso_professor[$i]->setId_curso($buscaId[0]->getId_curso());
                $curso_professorDAO->insert($curso_professor[$i]);
            }

            $stmt->conex = null;
        } catch (PDOException $ex) {
            $msgErro = "dao";
            trigger_error($ex->getMessage());
        }
    }

    /*
     * atualiza curso. Insere novos registros na tabela curso_professor
     * 
     * @param $curso - objeto curso
     * @param $cp - array dos novoso curso_professor      
     */
    public function update(Curso $curso = null, array $cp = null) {
        try {
            if ($curso != null) {
                $this->conex->exec("SET NAMES 'utf8'");
                $stmt = $this->conex->prepare("UPDATE curso SET nome=?, descricao=?, tempo=?, gratuito=?, valor=?, status=?, numero_modulos=?, objetivo=?, justificativa=?, obs=? WHERE id_curso=?");
                $stmt->bindValue(1, $curso->getNome());
                $stmt->bindValue(2, $curso->getDescricao());
                $stmt->bindValue(3, $curso->getTempo());
                $stmt->bindValue(4, $curso->getGratuito(1));
                $stmt->bindValue(5, $curso->getValor());
                $stmt->bindValue(6, $curso->getStatus(1));
                $stmt->bindValue(7, $curso->getNumero_modulos());
                $stmt->bindValue(8, $curso->getObjetivo());
                $stmt->bindValue(9, $curso->getJustificativa());
                $stmt->bindValue(10, $curso->getObs());                
                $stmt->bindValue(11, $curso->getId_curso());
                $stmt->execute();

                if ($cp != null) {
                    $dao = new Curso_professorDAO();
                    for($i = 0; $i < count($cp); $i++){
                        $cp[$i]->setId_curso($curso->getId_curso());
                        $dao->insert($cp[$i]);
                    }
                }
            }
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function delete(Curso $curso) {
        try {
            
            $num = $this->conex->exec("DELETE FROM curso WHERE id_curso=" . $curso->getId_curso());
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
                $stmt = $this->conex->query("SELECT * FROM curso");
            } else {
                $stmt = $this->conex->query("SELECT * FROM curso WHERE " . $condicao);
            }            
            $curso = array();            
            for ($i = 0; $i < $stmt->rowCount(); $i++) {
                $curso[$i] = $stmt->fetchObject('Curso');
            }
            if ($i == 0) {
                $curso = null;                
            }
            return $curso;
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

}

?>
