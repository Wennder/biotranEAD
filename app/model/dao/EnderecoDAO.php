<?php


class EnderecoDAO extends PDOConnectionFactory{
    
    private $conex = null;

    public function EnderecoDAO() {
        $this->conex = $this->getConnection();
    }

    public function insert(Endereco $endereco) {
        try {            
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("INSERT INTO endereco_usuario(rua, numero, complemento, bairro, cidade, id_usuario, pais, estado) VALUES (?,?,?,?,?,?)");
            $stmt->bindValue(1, $endereco->getRua());
            $stmt->bindValue(2, $endereco->getNumero());
            $stmt->bindValue(3, $endereco->getComplemento());
            $stmt->bindValue(4, $endereco->getBairro());
            $stmt->bindValue(5, $endereco->getCidade());
            $stmt->bindValue(6, $endereco->getPais());
            $stmt->bindValue(7, $endereco->getEstado());
            $stmt->bindValue(8, $endereco->getId_usuario());

            $stmt->execute();
            $stmt->conex = null;
        } catch (PDOException $ex) {           
            echo "Erro: " . $ex->getMessage();            
        }
    }

    public function update(Endereco $endereco) {
        try {
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("UPDATE endereco_usuario SET rua=?, numero=?, complemento=?, bairro=?, cidade=?, id_usuario=? WHERE id_endereco_usuario=?");
            $stmt->bindValue(1, $endereco->getRua());
            $stmt->bindValue(2, $endereco->getNumero());
            $stmt->bindValue(3, $endereco->getComplemento());
            $stmt->bindValue(4, $endereco->getBairro());
            $stmt->bindValue(5, $endereco->getCidade());
            $stmt->bindValue(6, $endereco->getPais());
            $stmt->bindValue(7, $endereco->getEstado());
            $stmt->bindValue(8, $endereco->getId_usuario());
            $stmt->bindValue(9, $endereco->getId_endereco_usuario());
            $stmt->execute();
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function delete(Endereco $endereco) {
        try {
            $num = $this->conex->exec("DELETE FROM endereco_usuario WHERE id=" . $endereco->getId_endereco_usuario());
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
        
    public function deleteEnderecoUsuario($id_usuario) {
        try {
            $num = $this->conex->exec("DELETE FROM endereco_usuario WHERE id_usuario=". $id_usuario);
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
                $stmt = $this->conex->query("SELECT * FROM endereco_usuario");
            } else {
                $stmt = $this->conex->query("SELECT * FROM endereco_usuario WHERE " . $condicao);
            }
            $endereco = array();                                   
            for ($i = 0; $i < $stmt->rowCount(); $i++){
                $endereco[$i] = $stmt->fetchObject('Endereco');
            }
            return $endereco;
        } catch (PDOException $ex) {
            return "erro: ".$ex;
        }
    }   
}


?>
