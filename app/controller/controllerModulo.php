<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controllerModulo
 *
 * @author cead-p057007
 */
class controllerModulo {
    /*
     * Retorna apenas um moduloereco de acordo com a condicao da query.
     * Se houver mais de um registro em banco, apenas o primeiro sera retornado
     * 
     * @param $condicao = condicao de busca do tipo String no formato ex.: 'id_curso_professor=1'
     * 
     * @return Objeto moduloereco encontrado, ou o primeiro da lista
     */

    public function getModulo($condicao) {
        $dao = new ModuloDAO();
        $modulo = $dao->select($condicao);
        if ($modulo != null) {
            return $modulo[0];
        }
        return $modulo; // null
    }

    /*
     * Retorna uma lista de moduloerecos de acordo com a condicao da query.
     * condicao de busca do tipo String no formato ex.: 'id_curso_professor=1'     
     * 
     * @param string $condicao
     * @return array de objetos curso_professor encontrado
     */

    public function getListaModulo($condicao) {
        $dao = new ModuloDAO();
        $modulo = $dao->select($condicao);
        return $modulo;
    }

    /*
     * Retorna uma lista de todos os usuarios
     *      
     * @return array de objetos com todos os usuarios
     */

    public function getAllModulo() {
        $dao = new ModuloDAO();
        $modulo = $dao->select();
        return $modulo;
    }

    //Lista lateral para adicionar o conteudo dos modulos
    //Lista todos os modulos existentes e opcao de adicionar conteudo em cada
    public function listaAdicionar_conteudo_modulo($id_curso) {
        $modulos = $this->getListaModulo('id_curso=' . $id_curso);
        $quant = count($modulos);
        $i = 0;
        $listaModulos = "";
        for (; $i < $quant; $i++) {
            $listaModulos .= "<div class='accordion_leftcolumn'><h3>Modulo " . $modulos[$i]->getNumero_modulo() . "</h3><div><ul style='list-style-type:none;'>";
            $listaModulos .= "<li><p><a href='index.php?c=ead&a=editar_modulo&id=" . $modulos[$i]->getId_curso() . "'>Editar Modulo</a></p></li>";
            $listaModulos .= "<li><p><a href='index.php?c=ead&a=adicionar_videoaula&id=" . $modulos[$i]->getId_modulo() . "'>Adicionar Video Aula</a></p></li>";
            $listaModulos .= "<li><p><a href='index.php?c=ead&a=adicionar_bibliografia&id=" . $modulos[$i]->getId_modulo() . "'>Adicionar Bibliografia</a></p></li>";
            $listaModulos .= "<li><p><a href='index.php?c=ead&a=adicionar_materialcomplementar&id=" . $modulos[$i]->getId_modulo() . "'>Adicionar Material Complementar</a></p></li>";
            $listaModulos .= "<li><p><a href='index.php?c=ead&a=adicionar_exercicio&id=" . $modulos[$i]->getId_modulo() . "'>Adicionar Exercicio</a></p></li>";
            $listaModulos .= "</ul></div></div>";
        }
        return $listaModulos;
    }

    public function listaModulos($id_curso) {
        $modulos = $this->getListaModulo('id_curso=' . $id_curso);
        $quant = count($modulos);
        $i = 0;
        $listaModulos = "";
        for (; $i < $quant; $i++) {
            $listaModulos .= "<li><div class='accordion_body'><h4><a>Modulo " . $modulos[$i]->getNumero_modulo() . ": " . $modulos[$i]->getTitulo_modulo() . "</a></h4><div><ul>";
            $listaModulos .= "<li><p>Descricao: " .$modulos[$i]->getDescricao() ."</p></li></ul></div></div></li>";
        }
        return $listaModulos;
    }

}

?>
