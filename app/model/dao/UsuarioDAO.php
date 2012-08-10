<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DAOUsuario
 *
 * @author cead-p057007
 */
class UsuarioDAO extends PDOConnectionFactory {

    public $conex = null;

    public function UsuarioDAO() {
        $this->conex = $this->getConnection();
    }

    public function insert(Usuario $user) {
        try {
            $stmt = $this->conex->prepare("INSERT INTO usuario(id_usuario, nome, senha, email, tel, id_papel) VALUES (?,?,?,?,?,?)");
            $stmt->bindValue(1, $user->getId_usuario());
            $stmt->bindValue(2, $user->getNome());
            $stmt->bindValue(3, $user->getSenha());
            $stmt->bindValue(4, $user->getEmail());
            $stmt->bindValue(5, $user->getTel());
            $stmt->bindValue(6, $user->getId_papel());

            $stmt->execute();
            $stmt->conex = null;
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function update(Usuario $user, $condicao) {
        try {
            $stmt = $this->conex->prepare("UPDATE usuario SET id_usuario=?, nome=?, senha=?, email=?, tel=?, id_papel=? WHERE id=?");
            $stmt->bindValue(1, $user->getId_usuario());
            $stmt->bindValue(2, $user->getNome());
            $stmt->bindValue(3, $user->getSenha());
            $stmt->bindValue(4, $user->getEmail());
            $stmt->bindValue(5, $user->getTel());
            $stmt->bindValue(6, $user->getId_papel());
            $stmt->bindValue(7, $condicao);
            $stmt->execute();
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function delete(Usuario $user) {
        try {
            $num = $this->conex->exec("DELETE FROM usuario WHERE id=" . $user->getId_usuario());
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
            if ($query == null) {
                if($condicao == null){
                    $stmt = $this->conex->query("SELECT * FROM usuario");                    
                }else{
                    $stmt = $this->conex->query("SELECT * FROM usuario WHERE ". $condicao);
                }                
            } else {
                if ($condicao == null) {
                    $stmt = $this->conex->query("SELECT " . $selecao . " FROM usuario");
                }else{
                    $stmt = $this->conex->query("SELECT " . $selecao . " FROM usuario WHERE " . $condicao);
                }
            }
        } catch (PDOException $ex) {
            return "erro";
        }
    }

}

?>
