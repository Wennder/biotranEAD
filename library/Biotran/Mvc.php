<?php

class Biotran_Mvc {

    /**
     * Nome do controlador
     * 
     * @var string
     */
    protected $controlador;

    /**
     * Nome do controlador
     * 
     * @var string
     */
    protected $acao;

    /**
     * Instancia única do objeto Planeta_Mvc
     * 
     * @var Planeta_Mvc
     */
    private static $instancia;

    /**
     * Implementação do Singleton
     *
     * @return Planeta_Mvc 
     */
    public static function pegarInstancia() {
        //verifica se a instância existe
        if (!self::$instancia) {
            self::$instancia = new Biotran_Mvc();
        }

        return self::$instancia;
    }

    /**
     * Construtor privado para forçar o Singleton
     * 
     * @return void
     */
    private function __construct() {
        
    }

    /**
     * Pega o controlador da requisição atual
     * 
     * @return string  
     */
    public function pegarControlador() {
        return $this->controlador;
    }

    /**
     * Pega a ação da requisição atual
     * 
     * @return string  
     */
    public function pegarAcao() {
        return $this->acao;
    }

    public function rodar() {
        //pega o modulo, controlador e acao 
        $controlador = isset($_GET['c']) ? $_GET['c'] : 'index';
        $acao = isset($_GET['a']) ? $_GET['a'] : 'index';

        //padronizacao de nomes
        $this->controlador = ucfirst(strtolower($controlador));
        $this->acao = ucfirst(strtolower($acao));

        $nomeClasseControlador = 'Controller' . $this->controlador;
        $nomeAcao = 'action' . $this->acao;

        //verifica se a classe existe
        if (class_exists($nomeClasseControlador)) {
            $controladorObjeto = new $nomeClasseControlador;

            //verifica se o metodo existe
            if (method_exists($controladorObjeto, $nomeAcao)) {
                $controladorObjeto->$nomeAcao();
                return true;
            }
            throw new Exception('Acao nao existente.');
        }
        throw new Exception('Controlador nao existente.');
    }

    private function __clone() {
        throw Exception('Nao pode');
    }

}

?>
