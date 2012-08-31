<?php

class Papel_pagina {
    
    private $id_papel_pagina;
    private $id_papel;
    private $pagina;
    
    public function getId_papel_pagina() {
        return $this->id_papel_pagina;
    }

    public function setId_papel_pagina($id_papel_pagina) {
        $this->id_papel_pagina = $id_papel_pagina;
    }

    public function getId_papel() {
        return $this->id_papel;
    }

    public function setId_papel($id_papel) {
        $this->id_papel = $id_papel;
    }

    public function getPagina() {
        return $this->pagina;
    }

    public function setPagina($pagina) {
        $this->pagina = $pagina;
    }
    
}

?>
