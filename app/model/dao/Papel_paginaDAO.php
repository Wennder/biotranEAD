<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Papel_paginaDAO
 *
 * @author cead-p057007
 */
class Papel_paginaDAO extends PDOConnectionFactory {

    private $conex = null;

    public function Papel_paginaDAO() {
        $this->conex = $this->getConnection();
    }

    public function select($idPapel, $pagina) {
        try {                        
            $stmt = $this->conex->query("SELECT * FROM papel_pagina WHERE id_papel=" . $idPapel . " AND pagina='".$pagina."'");            
            if($stmt->rowCount() == 1) {
                return 1;
            }else return 0;
        } catch (PDOException $ex) {
            return "erro: " . $ex;
        }
    }

}

?>
