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

    private $conex = null;

    public function UsuarioDAO() {
        $this->conex = $this->getConnection();
    }

    public function insert(Usuario $user, Endereco $end1, Endereco $end2) {
        try {
            $stmt = $this->conex->prepare("INSERT INTO usuario(login, senha, id_papel, nome_completo, 
                data_nascimento, cpf, rg, id_profissional, atuacao, descricao_pessoal, sexo, tel_residencial, 
                tel_comercial, tel_celular1, tel_celular2, email) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $stmt->bindValue(1, $user->getEmail());
            $stmt->bindValue(2, $user->getSenha());
            $stmt->bindValue(3, $user->getId_papel());
            $stmt->bindValue(4, $user->getNome_completo());
            $stmt->bindValue(5, $user->getData_nascimento());
            $stmt->bindValue(6, $user->getCpf());
            $stmt->bindValue(7, $user->getRg());
            $stmt->bindValue(8, $user->getId_profissional());
            $stmt->bindValue(9, $user->getAtuacao());
            $stmt->bindValue(10, $user->getDescricao_pessoal());
            $stmt->bindValue(11, $user->getSexo());
            $stmt->bindValue(12, $user->getTel_residencial());
            $stmt->bindValue(13, $user->getTel_comercial());
            $stmt->bindValue(14, $user->getTel_celular1());
            $stmt->bindValue(15, $user->getTel_celular2());
            $stmt->bindValue(16, $user->getEmail());
            //inserindo usuario no banco
            $stmt->execute();
                            
            //inserindo enderecos de usuario no banco                        
            $buscaId = $this->select("login='". $user->getLogin() ."'");
            $enderecoDAO = new EnderecoDAO();
            $end1->setId_usuario($buscaId[0]->getId_usuario());
            $end2->setId_usuario($buscaId[0]->getId_usuario());
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
    
    //$condicao entra no formato, ex: 'nome_coluna = valor'
    public function select($condicao = null) {
        try {
            $stmt = null;
            if ($condicao == null) {
                $stmt = $this->conex->query("SELECT * FROM usuario");
            } else {
                $stmt = $this->conex->query("SELECT * FROM usuario WHERE " . $condicao);
            }
            $usuario = array();                                   
            for ($i = 0; $i < $stmt->rowCount(); $i++){
                $usuario[$i] = $stmt->fetchObject('Usuario');
            }
            return $usuario;
        } catch (PDOException $ex) {
            return "erro: ".$ex;
        }
    }   
    
}

?>
