<?php

class Papel_paginaDAO extends PDOConnectionFactory {

    private $conex = null;

    public function Papel_paginaDAO() {
        $this->conex = $this->getConnection();
    }

    public function select($idPapel, $pagina) {
        try {                        
            $stmt = null;            
            $stmt = $this->conex->query("SELECT * FROM papel_pagina WHERE id_papel=" . $idPapel . " AND pagina='".$pagina."'");            
            if($stmt->rowCount() == 1) {
                return 1;
            }else return 0;
        } catch (PDOException $ex) {
            return "erro: " . $ex;
        }
    }
    public function teste() {
        try {                                    
            $stmt = $this->conex->query("SELECT * FROM papel_pagina;");
            $result = $stmt->execute(); 
            echo $stmt;die();
            if($stmt->rowCount() == 1) {
                return $stmt;
            }else return 0;
        } catch (PDOException $ex) {
            return "erro: " . $ex;
        }
    }

}

?>
