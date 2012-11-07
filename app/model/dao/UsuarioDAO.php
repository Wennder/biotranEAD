<?php

class UsuarioDAO extends PDOConnectionFactory {

    private $conex = null;

    public function UsuarioDAO() {
        $this->conex = $this->getConnection();
    }

    public function insert(Usuario $user, Endereco $end) {
        try {
            $this->conex->exec("SET NAMES 'utf-8_unicode_ci'");
            $stmt = $this->conex->prepare("INSERT INTO usuario(login, senha, id_papel, nome_completo, 
                data_nascimento, cpf_passaporte, rg, id_profissional, atuacao, descricao_pessoal, sexo, tel_principal, 
                tel_secundario, email) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $stmt->bindValue(1, $user->getEmail());
            $stmt->bindValue(2, $user->getSenha());
            $stmt->bindValue(3, $user->getId_papel());
            $stmt->bindValue(4, $user->getNome_completo());
            $stmt->bindValue(5, $user->getData_nascimento());
            $stmt->bindValue(6, $user->getCpf_passaporte());
            $stmt->bindValue(7, $user->getRg());
            $stmt->bindValue(8, $user->getId_profissional());
            $stmt->bindValue(9, $user->getAtuacao());
            $stmt->bindValue(10, $user->getDescricao_pessoal());
            $stmt->bindValue(11, $user->getSexo());
            $stmt->bindValue(12, $user->getTel_principal());
            $stmt->bindValue(13, $user->getTel_secundario());
            $stmt->bindValue(14, $user->getEmail());
            //inserindo usuario no banco
            if(!$stmt->execute()){
                trigger_error(FALHA_SISTEMA);
            }
            $id = $this->conex->lastInsertId("Usuario");               
            //inserindo enderecos de usuario no banco                                    
            $enderecoDAO = new EnderecoDAO();
            $end->setId_usuario($id);
            $enderecoDAO->insert($end);
            $stmt->conex = null;
            return $id;
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function update(Usuario $user = null, Endereco $end = null) {
        try {                
            if($user != null){ 
                $this->conex->exec("SET NAMES 'utf-8_unicode_ci'");                
                $stmt = $this->conex->prepare("UPDATE usuario SET login=?, senha=?, id_papel=?, nome_completo=?, 
                data_nascimento=?, cpf_passaporte=?, rg=?, id_profissional=?, atuacao=?, descricao_pessoal=?, sexo=?, tel_principal=?, tel_secundario=?, email=? WHERE id_usuario=?");
                $stmt->bindValue(1, $user->getEmail());
                $stmt->bindValue(2, $user->getSenha());
                $stmt->bindValue(3, $user->getId_papel());
                $stmt->bindValue(4, $user->getNome_completo());
                $stmt->bindValue(5, $user->getData_nascimento());
                $stmt->bindValue(6, $user->getCpf_passaporte());
                $stmt->bindValue(7, $user->getRg());
                $stmt->bindValue(8, $user->getId_profissional());
                $stmt->bindValue(9, $user->getAtuacao());
                $stmt->bindValue(10, $user->getDescricao_pessoal());
                $stmt->bindValue(11, $user->getSexo());
                $stmt->bindValue(12, $user->getTel_principal());
                $stmt->bindValue(13, $user->getTel_secundario());
                $stmt->bindValue(14, $user->getEmail());
                $stmt->bindValue(15, $user->getId_usuario());
                if(!$stmt->execute()){
                    trigger_error(FALHA_SISTEMA);
                }
                if ($end != null) {
                    $dao = new EnderecoDAO();
                    $dao->update($end);
                }
            }
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }       

    public function delete(Usuario $user) {
        try {
            $num = $this->conex->exec("DELETE FROM usuario WHERE id_usuario=" . $user->getId_usuario());
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
    
    //$condicao entra no formato, ex: 'nome_coluna = valor'
    public function select($condicao = null) {
        try {
//            $this->conex->exec("SET NAMES 'utf-8_unicode_ci'");
            $stmt = null;
            if ($condicao == null) {
                $stmt = $this->conex->query("SELECT * FROM usuario");
            } else {
                $stmt = $this->conex->query("SELECT * FROM usuario WHERE " . $condicao);
            }
            $usuario = array(); 
//            echo "SELECT * FROM usuario WHERE " . $condicao; die();
            for ($i = 0; $i < $stmt->rowCount(); $i++){                
                $usuario[$i] = $stmt->fetchObject('Usuario');
            }
            if($i==0){                
                $usuario = null;
            }
            return $usuario;
        } catch (PDOException $ex) {
            return "erro: ".$ex;
        }
    }
    
//    public function selectProfessores() {
//        try {
//            $stmt = null;
//            $stmt = $this->conex->query("SELECT * FROM usuario WHERE id_papel = 3 ORDER BY nome_completo");
//            $usuario = array();
//            for ($i = 0; $i < $stmt->rowCount(); $i++){
//                $usuario[$i] = $stmt->fetchObject('Usuario');
//            }
//            if($i==0){
//                $usuario = null;
//            }            
//            return $usuario;
//        } catch (PDOException $ex) {
//            return "erro: ".$ex;
//        }
//    }  
    
}

?>
