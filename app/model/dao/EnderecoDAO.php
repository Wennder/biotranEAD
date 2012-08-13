<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//include "../app/model/pdo/PDOConnectionFactory.class.php";
/**
 * Description of EnderecoDAO
 *
 * @author cead-p057007
 */
class EnderecoDAO extends PDOConnectionFactory{
    public $conex = null;

    public function EnderecoDAO() {
        $this->conex = $this->getConnection();
    }

    public function insert(Endereco $endereco) {
        try {            
            $stmt = $this->conex->prepare("INSERT INTO endereco_usuario(rua, numero, complemento, bairro, cidade, id_usuario) VALUES (?,?,?,?,?,?)");
            $stmt->bindValue(1, $endereco->getRua());
            $stmt->bindValue(2, $endereco->getNumero());
            $stmt->bindValue(3, $endereco->getComplemento());
            $stmt->bindValue(4, $endereco->getBairro());
            $stmt->bindValue(5, $endereco->getCidade());
            $stmt->bindValue(6, $endereco->getId_usuario());

            $stmt->execute();
            echo "executa";
            $stmt->conex = null;
        } catch (PDOException $ex) {           
            echo "Erro: " . $ex->getMessage();            
        }
    }

    public function update(Endereco $endereco) {
        try {
            $stmt = $this->conex->prepare("UPDATE endereco_usuario SET rua=?, numero=?, complemento=?, bairro=?, cidade=?, id_usuario=? WHERE id_endereco_usuario=?");
            $stmt->bindValue(1, $endereco->getRua());
            $stmt->bindValue(2, $endereco->getNumero());
            $stmt->bindValue(3, $endereco->getComplemento());
            $stmt->bindValue(4, $endereco->getBairro());
            $stmt->bindValue(5, $endereco->getCidade());
            $stmt->bindValue(6, $endereco->getId_usuario());
            $stmt->bindValue(7, $endereco->getId_endereco_usuario());
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

    public function select($selecao = null, $condicao = null) {
        try {
            $stmt = null;
            if ($selecao == null) {
                if($condicao == null){
                    $stmt = $this->conex->query("SELECT * FROM endereco_usuario");
                }else{
                    $stmt = $this->conex->query("SELECT * FROM endereco_usuario WHERE ". $condicao);
                }
            } else {
                if ($condicao == null) {
                    $stmt = $this->conex->query("SELECT " . $selecao . " FROM endereco_usuario");
                }else{
                    $stmt = $this->conex->query("SELECT " . $selecao . " FROM endereco_usuario WHERE " . $condicao);
                }
            }
            return $stmt;
        } catch (PDOException $ex) {
            echo "Erro: ". $ex->getMessage();
        }
    }
}


?>
