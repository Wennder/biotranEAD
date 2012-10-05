<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Material_complementar
 *
 * @author cead-p057007
 */
class Material_complementarDAO  extends PDOConnectionFactory {        
    
    private $conex = null;

    public function Material_complementarDAO() {
        $this->conex = $this->getConnection();
    }

    public function insert(Material_complementar $material_complementar) {
        try {            
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("INSERT INTO material_complementar(id_modulo, nome) VALUES (?,?)");            
            $stmt->bindValue(1, $material_complementar->getId_modulo());
            $stmt->bindValue(2, $material_complementar->getNome());

            $stmt->execute();
            $id = $this->conex->lastInsertId("Material_complementar");
            $this->conex = null;
            return $id;
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function update(Material_complementar $material_complementar) {
        try {
            $this->conex->exec("SET NAMES 'utf8'");
            $stmt = $this->conex->prepare("UPDATE material_complementar SET id_modulo=?, nome=? WHERE id_material_complementar=?");
            $stmt->bindValue(1, $material_complementar->getId_modulo());
            $stmt->bindValue(2, $material_complementar->getNome());            
            $stmt->bindValue(3, $material_complementar->getId_material_complementar());            
            $stmt->execute();
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function delete(Material_complementar $material_complementar) {
        try {
            $num = $this->conex->exec("DELETE FROM material_complementar WHERE id_material_complementar=" . $material_complementar->getId_material_complementar());
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
                $stmt = $this->conex->query("SELECT * FROM material_complementar");
            } else {
                $stmt = $this->conex->query("SELECT * FROM material_complementar WHERE " . $condicao);
            }
            $material_complementar = array();
            for ($i = 0; $i < $stmt->rowCount(); $i++) {
                $material_complementar[$i] = $stmt->fetchObject('Material_complementar');
            }
            return $material_complementar;
        } catch (PDOException $ex) {
            return "erro: " . $ex;
        }
    }
}

?>
