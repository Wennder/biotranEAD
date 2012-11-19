<?php

/*
 * Arquivo de importação da pasta app do projeto.
 * Contém apenas comandos de importação
 */
define('FALHA_SISTEMA', "falha no sistema");
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/biotranEAD');

include ROOT_PATH . "/app/model/pdo/PDOConnectionFactory.class.php";
include ROOT_PATH . '/app/model/vo/Usuario.php';
include ROOT_PATH . '/app/model/vo/Endereco.php';
include ROOT_PATH . '/app/model/vo/Exercicio.php';
include ROOT_PATH . '/app/model/vo/Papel.php';
include ROOT_PATH . '/app/model/vo/Curso.php';
include ROOT_PATH . '/app/model/vo/Modulo.php';
include ROOT_PATH . '/app/model/vo/Matricula_curso.php'; 
include ROOT_PATH . '/app/model/vo/Curso_professor.php';
include ROOT_PATH . '/app/model/vo/Video.php';
include ROOT_PATH . '/app/model/vo/Texto_referencia.php';
include ROOT_PATH . '/app/model/vo/Material_complementar.php';
include ROOT_PATH . '/app/model/vo/Pergunta.php';
include ROOT_PATH . '/app/model/vo/Alternativa.php';
include ROOT_PATH . '/app/model/vo/Topico.php';
include ROOT_PATH . '/app/model/vo/Resposta.php';
include ROOT_PATH . '/app/model/vo/Patrocinador.php';
include ROOT_PATH . '/app/model/vo/Resposta_exercicio.php';
include ROOT_PATH . '/app/model/vo/Destaque.php';
include ROOT_PATH . '/app/model/vo/Noticia.php';
include ROOT_PATH . '/app/model/vo/Comentario.php';
include ROOT_PATH . '/app/model/dao/Material_complementarDAO.php';
include ROOT_PATH . '/app/model/dao/Texto_referenciaDAO.php';
include ROOT_PATH . '/app/model/dao/UsuarioDAO.php';
include ROOT_PATH . '/app/model/dao/ExercicioDAO.php';
include ROOT_PATH . '/app/model/dao/CursoDAO.php';
include ROOT_PATH . '/app/model/dao/ModuloDAO.php';
include ROOT_PATH . '/app/model/dao/Curso_professorDAO.php';
include ROOT_PATH . '/app/model/dao/EnderecoDAO.php';
include ROOT_PATH . '/app/model/dao/Matricula_cursoDAO.php';
include ROOT_PATH . '/app/model/dao/PapelDAO.php';
include ROOT_PATH . '/app/model/dao/Papel_paginaDAO.php';
include ROOT_PATH . '/app/model/dao/VideoDAO.php';
include ROOT_PATH . '/app/model/dao/PerguntaDAO.php';
include ROOT_PATH . '/app/model/dao/AlternativaDAO.php';
include ROOT_PATH . '/app/model/dao/TopicoDAO.php';
include ROOT_PATH . '/app/model/dao/RespostaDAO.php';
include ROOT_PATH . '/app/model/dao/PatrocinadorDAO.php';
include ROOT_PATH . '/app/model/dao/DestaqueDAO.php';
include ROOT_PATH . '/app/model/dao/NoticiaDAO.php';
include ROOT_PATH . '/app/model/dao/ComentarioDAO.php';
include ROOT_PATH . '/app/controller/controllerMatricula_curso.php';
include ROOT_PATH . '/app/controller/ControllerSeguranca.php';
include ROOT_PATH . '/app/controller/ControllerErros.php';
include ROOT_PATH . '/app/controller/controllerCurso_professor.php';
include ROOT_PATH . '/app/controller/controllerTexto_referencia.php';
include ROOT_PATH . '/app/controller/controllerMaterial_complementar.php';
include ROOT_PATH . '/app/controller/controllerPergunta.php';
include ROOT_PATH . '/app/controller/controllerAlternativa.php';
require ROOT_PATH . '/library/Biotran/AutoLoad.php';
require ROOT_PATH . '/library/Biotran/mvc/view.php';
require ROOT_PATH . '/library/Biotran/mvc/controller.php'; 
include ROOT_PATH . '/library/wideimage/lib/WideImage.inc.php';


?>
