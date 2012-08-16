<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controllerUsuario
 *
 * @author cead-p057007
 */
class controllerUsuario {

    private $usuario;
    private $usuarios;

    public function novoUsuario(Usuario $user = null) {
        if (!empty($_POST)) {
            $this->usuario = new Usuario();
            foreach ($_POST as $k => $v) {
                $setAtributo = 'set' . ucfirst($k);
                if (method_exists($this->usuario, $setAtributo)) {
                    $this->usuario->$setAtributo($v);
                }
            }
        } else {
            if ($user != null) {
                
            }
        }
    }

    public function tabelaUsuarios() {
        $tabela = "<table id='tabela_usuarios' width='100%' align='center'>
         <thead> 
                <tr> 
                    <th>Nome</th> 
                    <th>Permissao</th> 
                    <th>Atuacao</th> 
                    <th></th> 
                    <th></th> 
                    <th></th> 
                </tr> 
            </thead> 
            <tbody>";
        
        $usuarioDAO = new UsuarioDAO();
        $papelDAO = new PapelDAO();
        $this->usuarios = $usuarioDAO->select(null);
        $quant =  count($this->usuarios);
        $i = 0;
        for (; $i < $quant; $i++) {
            $tabela .= "<tr id=" . $this->usuarios[$i]->getId_usuario() . ">";
            $tabela .= "<td width='55%' id='nome_completo'>" . $this->usuarios[$i]->getNome_completo() . "</td>";
            $tabela .= "<td width='15%' id='permissao' align='center'>" . $papelDAO->select($this->usuarios[$i]->getId_papel()) . "</td>";
            $tabela .= "<td width='15%' id='atuacao' align='center'>" . $this->usuarios[$i]->getAtuacao() . "</td>";
            $tabela .= "<td width='5%' id='b_visualizar' align='center'>" . "" . "</td>";
            $tabela .= "<td width='5%' id='b_editar' align='center'>" . "" . "</td>";
            $tabela .= "<td width='5%' id='b_excluir' align='center'>" . "" . "</td>";
            $tabela .= "</tr>";
        }
        $tabela .= "</tbody></table>";
        return utf8_encode($tabela);
    }

}
?>

