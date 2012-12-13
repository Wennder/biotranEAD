<?php
include '../../library/Biotran/importar_app.php';
include ROOT_PATH . '/app/controller/controllerUsuario.php';
include ROOT_PATH . '/app/controller/controllerEndereco.php';

$id = $_REQUEST["id_usuario"];
$controller = new controllerUsuario();
$usuario = $controller->getUsuario("id_usuario = ". $id);
$controller = new controllerEndereco();
$end = $controller->getEndereco('id_usuario = ' .$usuario->getId_usuario());
$id_foto = $usuario->getId_usuario();
if(!file_exists(ROOT_PATH. '/public/img/profile/pic/'.$id.'.jpg')){
   $id_foto = '00'; 
}


$retorno = array(
  "atuacao"   => $usuario->getAtuacao(),
  "sexo"   => $usuario->getSexo(),
  "papel"   => 'Estudante',
  "nome_completo"   => $usuario->getNome_completo(),
  "data_nascimento"   => $usuario->getData_nascimento(),
  "descricao"   => $usuario->getDescricao_pessoal(),
  "cidade"   => $end->getCidade(),
  "email"   => $usuario->getEmail(),
  "foto"   => $id_foto,
);

echo json_encode($retorno);
?>
