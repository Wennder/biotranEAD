<?php

require '../library/Biotran/AutoLoad.php';
 
Biotran_AutoLoad::registrar();
Biotran_Mvc::pegarInstancia()->rodar();

////define a função mágica de carregamento automático de classes.
////Essa função é chamada sempre que criamos um objeto, assim, não precisamos dar o require manualmente.
//function __autoload($nomeClasse) {
//    $dir = '../app/controller';
//    $localClasse = realpath($dir) . '/' . $nomeClasse . '.php';
// 
//    if (file_exists($localClasse)) {
//        require($localClasse);
//        return true;
//    }
//	return false;
//}
// 
////define o nome padrão para o controlador e a acao
//$nomeControlador = "index";
//$nomeAcao        = "index";
// 
////verifica se existe parametro "controlador" e se ele tem valor
//if (isset($_GET['controller']) && $_GET['controller']) {
//    $nomeControlador = $_GET['controller'];
//}
// 
////verifica se existe parametro "acao" e se ele tem valor
//if (isset($_GET['action']) && $_GET['action']) {
//    $nomeAcao = $_GET['action'];
//}
// 
////padronizacao de nome
//$nomeControlador = 'Controller' . ucfirst(strtolower($nomeControlador));
//$nomeAcao 	 = 'action' . ucfirst(strtolower($nomeAcao));
// 
////chamada da classe(controlador) e metodo(acao)
//if (class_exists($nomeControlador)) {
//	$controlador = new $nomeControlador;
// 
//	if (method_exists($controlador, $nomeAcao)) {
//	    $controlador->$nomeAcao();
//	} else {
//            echo "Acao nao encontrada.";
//        }
//} else {
//    echo "Controlador nao encontrado.";
//}

?>