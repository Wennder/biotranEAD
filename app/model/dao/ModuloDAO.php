<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModuloDAO
 *
 * @author Rodolfo
 */
class ModuloDAO extends PDOConnectionFactory{
    //put your code here
    
    private $conex = null;
    
    public function ModuloDAO(){
        $this->conex = $this->getConnection();
    }
    
     public function insert(Modulo $modulo) {
        try {
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("INSERT INTO modulo(id_curso, numero_modulo, titulo_modulo, descricao) VALUES (?,?,?,?)");
            $stmt->bindValue(1, $modulo->getId_curso());
            $stmt->bindValue(2, $modulo->getNumero_modulo());
            $stmt->bindValue(3, $modulo->getTitulo_modulo());
            $stmt->bindValue(4, $modulo->getDescricao());
            

            //inserindo modulo no banco
            if (!$stmt->execute()) {
                trigger_error("0 Erro insersao banco de dados");                
            }

            $stmt->conex = null;
        } catch (PDOException $ex) {
            $msgErro = "dao";
            trigger_error($ex->getMessage());
        }
    }
    
    public function update(Modulo $modulo = null) {
        try {
            if ($modulo != null) {
                $this->conex->exec("SET NAMES 'utf8'");
                $stmt = $this->conex->prepare("UPDATE modulo SET id_curso=?, numero_modulo=?, titulo_modulo=?, descricao=? WHERE id_modulo=?");
                $stmt->bindValue(1, $modulo->getId_curso());
                $stmt->bindValue(2, $modulo->getNumero_modulo());
                $stmt->bindValue(3, $modulo->getTitulo_modulo());
                $stmt->bindValue(4, $modulo->getDescricao());
                $stmt->bindValue(5, $modulo->getId_modulo());
               
                return $stmt->execute();

                
            }
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }
    
    public function select($condicao = null) {
        try {
            $stmt = null;
            if ($condicao == null) {
                $stmt = $this->conex->query("SELECT * FROM modulo");
            } else {
                $stmt = $this->conex->query("SELECT * FROM modulo WHERE " . $condicao);
            }            
            $modulo = array();
            for ($i = 0; $i < $stmt->rowCount(); $i++) {
                $modulo[$i] = $stmt->fetchObject('Modulo');
            }
            if ($i == 0) {
                $modulo = null;
            }
            return $modulo;
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }
    
    public function delete(Modulo $modulo) {
        try {
            $num = $this->conex->exec("DELETE FROM modulo WHERE id_curso=" . $modulo->getId_modulo());
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
    
}

?>
