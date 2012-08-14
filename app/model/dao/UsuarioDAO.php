<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//include "../app/model/pdo/PDOConnectionFactory.class.php";

include ROOT_PATH . "/app/model/dao/EnderecoDAO.php";

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

    public function insert(Usuario $user, Endereco $end1, Endereco $end2) {
        try {
            $stmt = $this->conex->prepare("INSERT INTO usuario(login, senha, id_papel, nome_completo, 
                data_nascimento, cpf, rg, id_profissional, atuacao, descricao_pessoal, sexo, tel_residencial, tel_celular, email) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $stmt->bindValue(1, $user->getLogin());
            $stmt->bindValue(2, $user->getSenha());
            $stmt->bindValue(3, $user->getPapel()->getId_papel());
            $stmt->bindValue(4, $user->getNome_completo());
            $stmt->bindValue(5, $user->getData_nascimento());
            $stmt->bindValue(6, $user->getCpf());
            $stmt->bindValue(7, $user->getRg());
            $stmt->bindValue(8, $user->getId_profissional());
            $stmt->bindValue(9, $user->getAtuacao());
            $stmt->bindValue(10, $user->getDescricao_pessoal());
            $stmt->bindValue(11, $user->getSexo());
            $stmt->bindValue(12, $user->getTel_residencial());
            $stmt->bindValue(13, $user->getTel_celular());
            $stmt->bindValue(14, $user->getEmail());
            //inserindo usuario no banco
            $stmt->execute();
            //inserindo enderecos de usuario no banco
            $buscaId = $this->select("id_usuario", "login='" . $user->getLogin() . "'")->fetch();
            $enderecoDAO = new EnderecoDAO();
            $end1->setId_usuario($buscaId["id_usuario"]);
            $end2->setId_usuario($buscaId["id_usuario"]);
            $enderecoDAO->insert($end1);
            $enderecoDAO->insert($end2);

            $stmt->conex = null;
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function update(Usuario $user) {
        try {
            $stmt = $this->conex->prepare("UPDATE usuario SET id_usuario=?, login=?, senha=?, id_papel=?, nome_completo=?, 
                data_nascimento=?, cpf=?, rg=?, id_profissional=?, atuacao=?, descricao_pessoal=?, sexo=?, tel_residencial=?, tel_celular=?, id_endereco1=?, id_endereco2=?, email=? WHERE id_usuario=?");
            $stmt->bindValue(1, $user->getLogin());
            $stmt->bindValue(2, $user->getSenha());
            $stmt->bindValue(3, $user->getPapel()->getId_papel());
            $stmt->bindValue(4, $user->getNome_completo());
            $stmt->bindValue(5, $user->getData_nascimento());
            $stmt->bindValue(6, $user->getCpf());
            $stmt->bindValue(7, $user->getRg());
            $stmt->bindValue(8, $user->getId_profissional());
            $stmt->bindValue(9, $user->getAtuacao());
            $stmt->bindValue(10, $user->getDescricao_pessoal());
            $stmt->bindValue(11, $user->getSexo());
            $stmt->bindValue(12, $user->getTel_residencial());
            $stmt->bindValue(13, $user->getTel_celular());
            $stmt->bindValue(14, $user->getId_endereco1()->getId_endereco_usuario());
            $stmt->bindValue(15, $user->getId_endereco2()->getId_endereco_usuario());
            $stmt->bindValue(16, $user->getEmail());
            $stmt->bindValue(7, $user->getId_usuario());
            $stmt->execute();
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function delete(Usuario $user) {
        try {
            $num = $this->conex->exec("DELETE FROM usuario WHERE id_usuario=" . $user->getId_usuario());
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
                if ($condicao == null) {
                    $stmt = $this->conex->query("SELECT * FROM usuario");
                } else {
                    $stmt = $this->conex->query("SELECT * FROM usuario WHERE " . $condicao);
                }
            } else {
                if ($condicao == null) {
                    $stmt = $this->conex->query("SELECT " . $selecao . " FROM usuario");
                } else {
                    $stmt = $this->conex->query("SELECT " . $selecao . " FROM usuario WHERE " . $condicao);
                }
            }
            return $stmt;
        } catch (PDOException $ex) {
            return "erro";
        }
    }

    public function selectAll($query = null) {
        $obj = new Usuario();
        $usuarios = array();
        try {
            $stmt = null;
            if ($query == null) {
                $stmt = $this->conex->query("SELECT * FROM usuario")->fetchAll();
            } else {
                $stmt = $this->conex->query($query)->fetchAll();
            }
            foreach ($stmt as $usuario) {
                $obj->setNome_completo(stripslashes($usuario["nome_completo"]));
                $usuarios[] = clone $obj;
//                echo($usuarios[0]->getNome_completo());
//                die();
            }
            return $usuarios;
        } catch (PDOException $ex) {
            return "erro";
        }
    }

}

?>
