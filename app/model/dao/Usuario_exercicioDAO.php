<?php

class Usuario_exercicioDAO extends PDOConnectionFactory {

    private $conex = null;

    public function Usuario_exercicioDAO() {
        $this->conex = $this->getConnection();
    }

    public function insert(Usuario_exercicio $usuario_exercicio) {
        try {
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("INSERT INTO usuario_exercicio(id_usuario, id_exercicio, id_modulo, por_acertos) VALUES (?,?,?)");
            $stmt->bindValue(1, $usuario_exercicio->getId_usuario());
            $stmt->bindValue(2, $usuario_exercicio->getId_exercicio());
            $stmt->bindValue(3, $usuario_exercicio->getId_modulo());
            $stmt->bindValue(4, $usuario_exercicio->getPorc_acertos());

            //inserindo usuario_exercicio no banco            
            if (!$stmt->execute()) {
                trigger_error("0 Erro insersao banco de dados");
            }
            $stmt->conex = null;
        } catch (PDOException $ex) {
            $msgErro = "dao";
            trigger_error($ex->getMessage());
        }
    }

    /*
     * atualiza usuario_exercicio. Insere novos registros na tabela usuario_exercicio_professor
     * 
     * @param $usuario_exercicio - objeto usuario_exercicio     
     */

    public function update(Usuario_exercicio $usuario_exercicio = null) {
        try {
            if ($usuario_exercicio != null) {
                $this->conex->exec("SET NAMES 'utf8'");
                $stmt = $this->conex->prepare("UPDATE usuario_exercicio SET id_usuario=?, id_exercicio=?, id_modulo=?, porc_acertos=? WHERE id_usuario_exercicio=?");
                $stmt->bindValue(1, $usuario_exercicio->getId_usuario());
                $stmt->bindValue(2, $usuario_exercicio->getId_exercicio());
                $stmt->bindValue(4, $usuario_exercicio->getId_modulo());
                $stmt->bindValue(3, $usuario_exercicio->getPorc_acertos());
                $stmt->bindValue(5, $usuario_exercicio->getId_usuario_exercicio());

                if ($stmt->execute()) {
                    return 1;
                }
                return 0;
            }
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function delete(Usuario_exercicio $usuario_exercicio) {
        try {
            $num = $this->conex->exec("DELETE FROM usuario_exercicio WHERE id_usuario_exercicio=" . $usuario_exercicio->getId_usuario_exercicio());
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
                $stmt = $this->conex->query("SELECT * FROM usuario_exercicio");
            } else {
                $stmt = $this->conex->query("SELECT * FROM usuario_exercicio WHERE " . $condicao);
            }
            $usuario_exercicio = array();
            for ($i = 0; $i < $stmt->rowCount(); $i++) {
                $usuario_exercicio[$i] = $stmt->fetchObject('Usuario_exercicio');
            }
            if ($i == 0) {
                $usuario_exercicio = null;
            }
            return $usuario_exercicio;
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

}

?>
