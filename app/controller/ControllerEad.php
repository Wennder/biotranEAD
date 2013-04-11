<?php

class ControllerEad extends Biotran_Mvc_Controller {

    private $controller = null;

    public function actionIndex() {
        $this->visao->usuarioLogado = $_SESSION['usuarioLogado'];
        $this->renderizar();
    }

    public function actionVisualizar_modulo() {
        $id_curso = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->controller = new controllerCurso();
        $this->visao->curso = $this->controller->getCurso("id_curso = " . $id_curso);
        $this->renderizar();
    }

    public function actionConteudo_modulo() {
        if (isset($_REQUEST['id_curso'])) {
            $id_curso = $_REQUEST['id_curso'];
            $this->controller = new controllerModulo();
            $modulos_curso = $this->controller->getListaModulo("id_curso=" . $id_curso . " ORDER BY numero_modulo");
            $this->visao->modulo = $modulos_curso[0];
            $this->controllerCurso = new controllerCurso();
            $this->visao->curso = $this->controllerCurso->getCurso("id_curso=" . $id_curso . "");
        } else {
            $id_modulo = Biotran_Mvc::pegarInstancia()->pegarId();
            $this->controller = new controllerModulo();
            $this->visao->modulo = $this->controller->getModulo("id_modulo=" . $id_modulo);
            $this->controllerCurso = new controllerCurso();
            $this->visao->curso = $this->controllerCurso->getCurso("id_curso=" . $this->visao->modulo->getId_curso() . "");
        }
        $this->visao->listaVideo = $this->controller->visualizar_listaVideo_aulas_modulo($this->visao->modulo->getId_modulo());
        $this->visao->listaTexto = $this->controller->visualizar_listaArquivos($this->visao->modulo, 'texto_referencia');
        $this->visao->listaMaterial = $this->controller->visualizar_listaArquivos($this->visao->modulo, 'material_complementar');
        $this->visao->listaExercicio = $this->controller->visualizar_listaExercicio($this->visao->modulo->getId_modulo());

        $this->renderizar();
    }

    public function actionCadastrar_usuario() {
        $this->controller = new controllerUsuario();
        if ($this->controller->validarLogin($_POST["email"])) {
            $this->controller->inserirNovoUsuario_post();
            Biotran_Mvc::pegarInstancia()->mudarAcao('gerenciar_usuarios');
            $this->renderizar();
        } else {
            trigger_error("1 Reenvio de formulario, usuario ja cadastrado");
        }
    }

    public function actionGerenciar_usuarios() {
        $this->visao->titulo = "Gerenciar Usuários";
        $this->controller = new controllerUsuario();
        //Pega a id passa na url e monta o objeto buscando os dados no banco
        $id_usuario = Biotran_Mvc::pegarInstancia()->pegarId();
        if ($id_usuario != '') {
            $this->visao->usuario = $this->controller->getUsuario("id_usuario=" . $id_usuario . "");
            $this->visao->endereco = $this->controller->getEndereco_usuario($id_usuario);
        } else {
            $this->visao->usuario = null;
            $this->visao->endereco = null;
        }
        //Monta a tabela de usuários        
        $this->visao->tabela = $this->controller->tabelaUsuarios();
        $this->renderizar();
    }

    public function actionGerenciar_usuarios_1() {
        $this->visao->titulo = "Gerenciar Usuários";
        $this->controller = new controllerUsuario();
        //Pega a id passa na url e monta o objeto buscando os dados no banco
        $id_usuario = Biotran_Mvc::pegarInstancia()->pegarId();
        if ($id_usuario != '') {
            $this->visao->usuario = $this->controller->getUsuario("id_usuario=" . $id_usuario . "");
            $this->visao->endereco = $this->controller->getEndereco_usuario($id_usuario);
        } else {
            $this->visao->usuario = null;
            $this->visao->endereco = null;
        }
        //Monta a tabela de usuários        
        $this->visao->tabela = $this->controller->tabelaUsuarios();
        $this->renderizar();
    }

    public function actionCursos_professor() {
        $this->controller = new controllerCurso();
        $id_usuario = $_SESSION['usuarioLogado']->getId_usuario();
        $this->visao->lista = $this->controller->listaCursos_professor($id_usuario);

        $this->visao->usuario = $_SESSION['usuarioLogado'];
        $this->renderizar();
    }

    public function actionAtualizar_cadastro_usuario() {
        $this->controller = new controllerUsuario();
        $id_usuario = Biotran_Mvc::pegarInstancia()->pegarId();
        if ($id_usuario != '') {
            echo json_encode($this->controller->atualizarUsuario($_SESSION['usuarioLogado']->getId_usuario()));
        } else {
            echo json_encode(0);
        }
//        Biotran_Mvc::pegarInstancia()->mudarAcao('index');
////        $this->visao->tabela = $this->controller->tabelaUsuarios();
//        $this->renderizar();
    }

    public function actionAtualizar_cadastro_admin() {
        $this->controller = new controllerUsuario();
        $id_usuario = Biotran_Mvc::pegarInstancia()->pegarId();
        if ($id_usuario != '') {
            $this->controller->atualizarUsuario_post($id_usuario);
            Biotran_Mvc::pegarInstancia()->mudarAcao('gerenciar_usuarios');
        }

        $this->visao->tabela = $this->controller->tabelaUsuarios();
        $this->renderizar();
    }

    public function actionGerenciar_cursos() {
        $this->visao->titulo = "Gerenciar Cursos";

        $this->controller = new controllerCurso();
        //Pega a id passa na url e monta o objeto buscando os dados no banco
        $id_curso = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->visao->curso = null;
        if ($id_curso != '') {
            $this->visao->curso = $this->controller->getCurso("id_curso=" . $id_curso . "");
            $this->visao->optionsPC = $this->controller->comboProfessores_curso($id_curso);
            $this->visao->optionsPD = $this->controller->comboProfessoresDisponiveis($id_curso);
        } else {
            $this->visao->optionsTP = $this->controller->comboTodos_Professores();
        }
        //print_r($this->visao->curso);die();
        //Monta a tabela de cursos            
        $this->visao->tabela = $this->controller->tabelaCursos();
        $this->renderizar();
    }

    public function actionCadastrar_curso() {
        $this->controller = new controllerCurso();
        //$_POST['destino'] - destino é o select dos professores responsaveis
        if ($this->controller->validarNome($_POST['nome']) && count($_POST["destino"]) > 0) {
            $this->controller->novoCurso_post();
            Biotran_Mvc::pegarInstancia()->mudarAcao('gerenciar_cursos');
            $this->actionGerenciar_cursos();
            // $this->renderizar();
        } else {
            trigger_error("1 Reenvio de formulario, curso ja cadastrado");
        }
    }

    public function actionDados_pessoais() {
        $this->controller = new controllerUsuario();
        //Pega a id passa na url e monta o objeto buscando os dados no banco
        $id_usuario = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->visao->usuario = $this->controller->getUsuario("id_usuario=" . $id_usuario . "");
        $this->visao->endereco = $this->controller->getEndereco_usuario($id_usuario);
        $this->renderizar();
    }

    public function actionProfile() {
        //Pega a id passa na url e monta o objeto buscando os dados no banco                
//        $this->visao->usuario = $usuarioDAO->select("id_usuario=" . $id_usuario . "");
//        $this->visao->usuario = $this->visao->usuario[0];
        $this->visao->usuario = $_SESSION['usuarioLogado'];
        $this->renderizar();
    }

    public function actionAcesso_negado() {
        $this->renderizar();
    }

    public function actionAtualizar_curso() {
        if (count($_POST["destino"]) == 0) {
            trigger_error("1 Reenvio de formulario, curso ja cadastrado");
        } else {

            $this->controller = new controllerCurso();
            $id_curso = Biotran_Mvc::pegarInstancia()->pegarId();
            if ($id_curso != '') {
                $this->controller->atualizarCurso_post($id_curso);
            }
            //$_GET['a'] = 'gerenciar_curso';
            Biotran_Mvc::pegarInstancia()->mudarAcao('index');
//        $this->visao->tabela = $this->controller->tabelaUsuarios();
            $this->renderizar();
        }
    }

    public function actionTodos_cursos() {
        $this->controller = new controllerCurso();
        $this->visao->listaCursos = $this->controller->lista_cursosAluno();
        $this->visao->usuario = $_SESSION['usuarioLogado'];
        $this->renderizar();
    }

    public function actionCurso_aluno() {
        $id_curso = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->controllerCurso = new controllerCurso();
        $this->visao->curso = $this->controllerCurso->getCurso("id_curso=" . $id_curso . "");
        $this->renderizar();
    }

    public function actionPag_curso() {
        $id_curso = Biotran_Mvc::pegarInstancia()->pegarId();
        $id_usuario = $_SESSION['usuarioLogado']->getId_usuario();
        $this->controller = new controllerCurso();
        $this->visao->curso = $this->controller->getCurso("id_curso=" . $id_curso . "");
        $this->controller = new controllerMatricula_curso();
        $this->visao->mc = $this->controller->getMatricula_curso("id_usuario=" . $id_usuario . " AND id_curso=" . $id_curso . "");
        //Se ainda não finalizou o curso..
        if (!$this->visao->mc->getStatus_finalizado()) {
            //CALCULANDO DIFERENÇA ENTRE DATAS PARA SABER TEMPO DE TERMINO DO CURSO
            // Usa a função criada e pega o timestamp das duas datas:
            $data_atual = date("d/m/Y");
            $time_inicial = $this->geraTimestamp($data_atual);
            $time_final = $this->geraTimestamp($this->visao->mc->getData_fim());
            // Calcula a diferença de segundos entre as duas datas:
            $diferenca = $time_final - $time_inicial;
            // Calcula a diferença de dias
            $this->visao->dias_restantes = (int) floor($diferenca / (60 * 60 * 24));
            //Se ainda tem tempo para fazer curso não finalizado            
            if ($this->visao->dias_restantes > -1) {
                $this->controller = new controllerModulo();
                $this->visao->listaModulos = $this->controller->listaModulos($id_curso);
                $this->controller = new controllerUsuario();
                $this->visao->listaAlunos = $this->controller->listaAlunos($id_curso);
                $this->renderizar();
            } else {//se o tempo acabou..
                echo 'Seu tempo para realizar o curso ' . $this->visao->curso->getNome() . ' acabou. Consulte a Biotran para renovação de sua matrícula';
            }
        } else {
            //CURSO FINALIZADO - redireciona para página do curso finalizado
            Biotran_Mvc::pegarInstancia()->mudarAcao('pag_curso_finalizado');
            $this->renderizar();
        }
    }

    public function actionPag_modulo() {
        $id_modulo = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->controller = new controllerModulo();
        $this->visao->modulo = $this->controller->getModulo("id_modulo=" . $id_modulo . "");
        $c = new controllerMatricula_curso();
        $mc = $c->getMatricula_curso('id_curso=' . $this->visao->modulo->getId_curso() . ' AND id_usuario=' . $_SESSION['usuarioLogado']->getId_usuario());
        $this->controllerCurso = new controllerCurso();
        $this->visao->curso = $this->controllerCurso->getCurso("id_curso=" . $this->visao->modulo->getId_curso() . "");
        if (!$mc->getStatus_finalizado()) {
            $this->visao->boolAcesso_modulo = $mc->getModulo_atual() >= $this->visao->modulo->getNumero_modulo();
            if ($this->visao->boolAcesso_modulo) {
                $this->visao->listaVideo = $this->controller->visualizar_listaVideo_aulas_modulo($id_modulo);
                $this->visao->listaTexto = $this->controller->visualizar_listaArquivos($this->visao->modulo, 'texto_referencia');
                $this->visao->listaMaterial = $this->controller->visualizar_listaArquivos($this->visao->modulo, 'material_complementar');
                $this->visao->listaExercicio = $this->controller->visualizar_listaExercicio($id_modulo);
            }
        } else {
            echo 'Seu tempo para realizar o curso ' . $this->visao->curso->getNome() . ' acabou. Consulte a Biotran para renovação de sua matrícula';
        }
        $this->renderizar();
    }

    public function actionMatricula() {
        $id_curso = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->controller = new controllerCurso();
        $this->visao->curso = $this->controller->getCurso("id_curso=" . $id_curso . "");
        $this->renderizar();
    }

    public function actionCadastrar_modulo() {
        $this->controller = new controllerCurso();
        $this->visao->options = $this->controller->comboCursos();
        if ($this->visao->options != null) {
            $this->renderizar();
        }//possivel parada de erro
        $this->renderizar();
    }

    public function actionAdicionar_videoaula() {
        $id_modulo = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->controller = new controllerModulo();
        $this->visao->modulo = $this->controller->getModulo("id_modulo=" . $id_modulo);
        $this->renderizar();
    }

    public function actionAdicionar_bibliografia() {
        $this->renderizar();
    }

    public function actionCadastrar_primeiro_acesso_curso() {
        $this->controller = new controllerCurso();
        $id_curso = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->visao->curso = $this->controller->getCurso("id_curso=" . $id_curso . "");
        if ($this->visao->curso->getStatus(1) == 0) {
            $this->controller->primeiro_acesso($this->visao->curso);
        }
        Biotran_Mvc::pegarInstancia()->mudarAcao('gerenciar_curso');
        $this->renderizar();
    }

    public function actionEditar_curso() {
        $this->controller = new controllerCurso();
        $id_curso = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->visao->curso = $this->controller->getCurso("id_curso=" . $id_curso . "");
        $this->controller = new controllerUsuario();
        $this->visao->listaAlunos = $this->controller->listaAlunos($id_curso);
        if ($this->visao->curso->getNumero_modulos() == 0) {
            Biotran_Mvc::pegarInstancia()->mudarAcao('primeiro_acesso_curso');
        }
        $this->renderizar();
    }

    public function actionProfessor_editar_curso() {
        $this->controller = new controllerCurso();
        $id_curso = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->visao->curso = $this->controller->getCurso("id_curso=" . $id_curso . "");
        if ($this->visao->curso->getNumero_modulos() == 0) {
            Biotran_Mvc::pegarInstancia()->mudarAcao('primeiro_acesso_curso');
        }
        $this->renderizar();
    }

    public function actionGerenciar_curso() {
        $this->controller = new controllerCurso();
        $id_curso = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->visao->curso = $this->controller->getCurso("id_curso=" . $id_curso . "");
        if ($this->visao->curso->getNumero_modulos() == 0) {
            Biotran_Mvc::pegarInstancia()->mudarAcao('primeiro_acesso_curso');
        }
        $this->renderizar();
    }

    public function actionPrimeiro_acesso_curso() {
        $this->controller = new controllerCurso();
        $id_curso = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->visao->curso = $this->controller->getCurso("id_curso=" . $id_curso . "");
        $this->renderizar();
    }

    public function actionEditar_modulo() {
        $id_modulo = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->controller = new controllerModulo();
        $this->visao->modulo = $this->controller->getModulo("id_modulo=" . $id_modulo . "");
        $this->controllerCurso = new controllerCurso();
        $this->visao->curso = $this->controllerCurso->getCurso("id_curso=" . $this->visao->modulo->getId_curso() . "");
        $this->visao->listaVideo = $this->controller->listaVideo_aulas_modulo($id_modulo);
        $this->visao->listaTexto = $this->controller->listaArquivos($this->visao->modulo, 'texto_referencia');
        $this->visao->listaMaterial = $this->controller->listaArquivos($this->visao->modulo, 'material_complementar');
        $this->visao->listaExercicio = $this->controller->listaExercicio($id_modulo);
        $this->renderizar();
    }

    public function actionAdicionar_texto_referencia() {
        $this->controller = new controllerModulo();
        $id_modulo = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->visao->modulo = $this->controller->getModulo("id_modulo=" . $id_modulo . "");
        $this->renderizar();
    }

    public function actionAdicionar_material_complementar() {
        $this->controller = new controllerModulo();
        $id_modulo = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->visao->modulo = $this->controller->getModulo("id_modulo=" . $id_modulo . "");
        $this->renderizar();
    }

    public function actionJanela_video() {
        $this->controller = new controllerVideo();
        $id_video = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->visao->video = $this->controller->getVideo('id_video=' . $id_video);
        $this->controller = new controllerModulo();
        $this->visao->modulo = $this->controller->getModulo("id_modulo=" . $this->visao->video->getId_modulo() . "");
        //descobrindo navegador
//        $useragent = $_SERVER['HTTP_USER_AGENT'];
//
//        if (preg_match('|Firefox/([0-9\.]+)|', $useragent, $matched)) {
//            $this->visao->caminho = "cursos/" . $this->visao->modulo->getId_curso() . "/modulos/" . $this->visao->video->getId_modulo() . "/video_aula/" . $this->visao->video->getId_video() . ".webm";
//        } else {
//            $this->visao->caminho = "cursos/" . $this->visao->modulo->getId_curso() . "/modulos/" . $this->visao->video->getId_modulo() . "/video_aula/" . $this->visao->video->getId_video() . ".mp4";
//        }
        $this->visao->caminho = "cursos/" . $this->visao->modulo->getId_curso() . "/modulos/" . $this->visao->video->getId_modulo() . "/video_aula/" . $this->visao->video->getId_video() . ".webm";
        $this->renderizar();
    }

    public function actionAdicionar_exercicio() {
        $this->controller = new controllerModulo();
        $id_modulo = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->visao->modulo = $this->controller->getModulo("id_modulo=" . $id_modulo . "");
        $this->renderizar();
    }

    public function actionEditar_exercicio() {
        $this->controller = new controllerExercicio();
        $id_exercicio = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->visao->exercicio = $this->controller->getExercicio("id_exercicio=" . $id_exercicio . "");
        $this->visao->listaPerguntas = $this->controller->listaPerguntas($id_exercicio);
        $this->renderizar();
    }

    public function actionResolver_exercicio() {
        $this->controller = new controllerExercicio();
        $id_exercicio = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->visao->exercicio = $this->controller->getExercicio("id_exercicio=" . $id_exercicio . "");
        $this->visao->listaPerguntas = $this->controller->listaPerguntas_aluno($id_exercicio);
        $this->renderizar();
    }

    public function actionForum() {
        if (isset($_GET['d'])) {
            $this->controller = new ControllerForum();
            $resposta = $this->controller->removerTopico($_GET['d']);
            echo json_encode($resposta);
            die();
        }
        $this->controller = new controllerCurso();
        $id_curso = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->visao->curso = $this->controller->getCurso('id_curso = ' . $id_curso);

        $this->renderizar();
    }

    public function actionAdicionar_topico() {
        $this->controller = new controllerCurso();
        $id_curso = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->visao->curso = $this->controller->getCurso('id_curso = ' . $id_curso);
        $this->renderizar();
    }

    public function actionResponder_topico() {
        $this->renderizar();
    }

    public function actionTopico() {
        if ($_GET['r'] == '1') {
            $this->controller = new ControllerForum();
            $topico = $this->controller->inserir_resposta();
            if ($topico != 0) {
                if ($_SESSION['usuarioLogado']->getId_usuario() != $topico->getId_usuario()) {
                    $dao = new UsuarioDAO();
                    $usuario = $dao->select("id_usuario=" . $topico->getId_usuario());

                    //---enviar e-mail
                    $mail = new PHPMailer(); //instancia o objeto PHPMailer
                    $mail->IsSMTP(); //informa que foi trabalhar com SMTP
                    $mail->Host = "mail.dietsmart.com.br"; //o endereço do meu servidor smtp
                    $mail->SMTPAuth = true; //informo que o servidor SMTP requer autenticação
                    $mail->Username = "contato@dietsmart.com.br"; //informo o usuário para autenticação no SMTP
                    $mail->Password = "teste2012"; //informo a senha do usuário para autenticação no SMTP
                    $mail->From = "contato@biotraead.com.br"; //informo o e-mail Remetente
                    $mail->FromName = "Biotran EAD"; //o nome do que irá aparecer para a pessoa que vai receber o e-mail
                    $mail->AddAddress($usuario[0]->getEmail()); //e-mail do destinatário
                    $mail->WordWrap = 50; //informo a quebra de linha no e-mail (isso é opcional)
                    $mail->IsHTML(true); //informo que o e-mail é em HTML (opcional)
                    $mail->Subject = "Teste"; //informo o assunto do e-mail
                    //gerando nova senha de usuario:
                    //criando o corpo do e-mail
                    $mail->Body = "<html><body>
                    Olá, " . $usuario[0]->getNome_completo() . " </br>
                        o " . $_SESSION['usuarioLogado']->getNome_completo() . " respondeu seu topico </br>
                         ;).
                        
            </body></html>"; //aqui vai o corpo do e-mail em HTML
                    //Enfim, envio o e-mail.
                    $mail->Send();
                }
                echo $topico->getId_topico();
                die();
            } else {
                echo 0;
                die();
            }
        } else {
            if (isset($_GET['i'])) {
                $this->controller = new ControllerForum();
                $topico = $this->controller->inserir_topico();
                /*
                 * se o usuario for professor do curso
                 * envia email para alunos e outros professores envolvidos no curso
                 * 
                 * se o usuario for um aluno envia email apenas para os professores
                 */
                if ($topico != 0) {
                    $usuarioLogado = $_SESSION['usuarioLogado'];
                    if ($usuarioLogado->getId_papel() == 3) {
                        $matricula_cursoDAO = new Matricula_cursoDAO();
                        $matriculados = $matricula_cursoDAO->select("id_curso=" . $_POST['id_curso']);
                        $quant = count($matriculados);
                        $i = 0;
                        for (; $i < $quant; $i++) {
                            $dao = new UsuarioDAO();
                            $usuario = $dao->select("id_usuario=" . $matriculados[$i]->getId_usuario());
                            //---enviar e-mail
                            $this->enviarEmail($usuario[0], $usuarioLogado);
                            //atualizando no banco
                        }
                        $curso_professorDAO = new Curso_professorDAO();
                        $professores = $curso_professorDAO->select("id_curso=" . $_POST['id_curso']);
                        $quant = count($professores);
                        $i = 0;
                        for (; $i < $quant; $i++) {
                            $dao = new UsuarioDAO();
                            $usuario = $dao->select("id_usuario=" . $matriculados[$i]->getId_usuario());
                            $this->enviarEmail($usuario[0], $usuarioLogado);
                        }
                    } else if ($usuarioLogado->getId_papel() == 4) {
                        $curso_professorDAO = new Curso_professorDAO();
                        $professores = $curso_professorDAO->select("id_curso=" . $_POST['id_curso']);
                        $quant = count($professores);
                        $i = 0;
                        for (; $i < $quant; $i++) {
                            $dao = new UsuarioDAO();
                            $usuario = $dao->select("id_usuario=" . $professores[$i]->getId_usuario());
                            $this->enviarEmail($usuario[0], $usuarioLogado);
                        }
                    }
                    echo $topico->getId_topico();
                    die();
                } else {
                    echo 0;
                    die();
                }
            } else if (isset($_GET['d'])) {
                $this->controller = new ControllerForum();
                echo json_encode($this->controller->removerResposta($_GET['d']));
                die();
            }
        }
        $this->renderizar();
    }

    public function enviarEmail($user, $user_logado) {
        //---enviar e-mail
        $mail = new PHPMailer(); //instancia o objeto PHPMailer
        $mail->IsSMTP(); //informa que foi trabalhar com SMTP
        $mail->Host = "mail.dietsmart.com.br"; //o endereço do meu servidor smtp
        $mail->SMTPAuth = true; //informo que o servidor SMTP requer autenticação
        $mail->Username = "contato@dietsmart.com.br"; //informo o usuário para autenticação no SMTP
        $mail->Password = "teste2012"; //informo a senha do usuário para autenticação no SMTP
        $mail->From = "contato@biotraead.com.br"; //informo o e-mail Remetente
        $mail->FromName = "Biotran EAD"; //o nome do que irá aparecer para a pessoa que vai receber o e-mail
        $mail->AddAddress($user->getEmail()); //e-mail do destinatário
        $mail->WordWrap = 50; //informo a quebra de linha no e-mail (isso é opcional)
        $mail->IsHTML(true); //informo que o e-mail é em HTML (opcional)
        $mail->Subject = "Teste"; //informo o assunto do e-mail
        //gerando nova senha de usuario:
        //criando o corpo do e-mail
        $mail->Body = "<html><body>
                    Olá, " . $user->getNome_completo() . " </br>
                        o " . $user_logado->getNome_completo() . " adicionou um novo topico </br>
                         ;).
                        
            </body></html>"; //aqui vai o corpo do e-mail em HTML
        //Enfim, envio o e-mail.
//        $mail->Send();
        //atualizando no banco
    }

    public function actionVisualizar_curso() {
        $this->controller = new controllerCurso();
        $id_curso = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->visao->curso = $this->controller->getCurso('id_curso = ' . $id_curso);
        $this->renderizar();
    }

    public function actionGerenciar_sistema() {
        $this->renderizar();
    }

    public function actionPini_patrocinadores() {
        if ($_GET['i'] == 1) {
            $controllerG = new controllerSistema();
            $p = $controllerG->inserir_patrocinador();
            if ($p != 0) {
                echo $p->getImagem() . '--' . $p->getId_patrocinador();
                die();
            }
            echo 0;
            die();
        } else if (isset($_GET['id'])) {
            $controllerG = new controllerSistema();
            $retorno = $controllerG->removerPatrocinador($_GET['id']);
            echo json_encode($retorno);
            die();
        }
        $this->renderizar();
    }

    public function actionPini_adicionar_patrocinador() {
        $this->renderizar();
    }

    public function actionPini_noticias() {
        if ($_GET['i'] == '1') {
            $this->controller = new controllerSistema();
            $n = $this->controller->inserir_noticia();
            if (!$n) {
                echo 0;
                die();
            }
            echo $n->getId_noticia() . '--' . $n->getData() . '--' . $n->getTitulo() . '--' . $n->getManchete();
            die();
        } else if (isset($_GET['u'])) {
            $this->controller = new controllerSistema();
            $n = $this->controller->atualizar_noticia();
            if (!$n) {
                echo 0;
                die();
            }
            echo $n->getId_noticia() . '--' . $n->getData() . '--' . $n->getTitulo() . '--' . $n->getManchete();
            die();
        } else if (isset($_GET['id'])) {
            $this->controller = new controllerSistema();
            $resposta = $this->controller->removerNoticia($_GET['id']);
            echo json_encode($resposta);
            die();
        }
        $this->renderizar();
    }

    public function actionPini_comentarios() {
        if ($_GET['i'] == '1') {
            $this->controller = new controllerSistema();
            $c = $this->controller->inserir_comentario();
            if (!$c) {
                echo 0;
                die();
            }
            echo $c->getId_comentario() . '--' . $c->getData();
            die();
        } else if (isset($_GET['u'])) {
            $this->controller = new controllerSistema();
            $this->controller->atualizar_comentario();
            header("Location: index.php?c=ead&a=pini_comentarios");
        } else if (isset($_GET['id'])) {
            $this->controller = new controllerSistema();
            $resposta = $this->controller->removerComentario($_GET['id']);
            echo json_encode($resposta);
            die();
        }
        $this->renderizar();
    }

    public function actionPini_destaques() {
        if ($_GET['i'] == 1) {
            $controllerG = new controllerSistema();
            $d = $controllerG->inserir_destaque();
            if (!$d) {
                echo 0;
            } else {
                echo $d->getDestaque() . '--' . $d->getId_destaque();
            }
            die();
        } else if (isset($_GET['id'])) {
            $controllerG = new controllerSistema();
            $retorno = $controllerG->removerDestaque($_GET['id']);
            echo json_encode($retorno);
            die();
        }
        $this->renderizar();
    }

    public function actionPini_adicionar_noticia() {
        $this->renderizar();
    }

    public function actionPini_editar_noticia() {
        if (isset($_GET['f'])) {
            $caminho = ROOT_PATH . '/public/img/noticias/' . $_GET['id'] . '.jpg';
            if (is_file($caminho)) {
                unlink($caminho);
            }
            header("Location: index.php?c=ead&a=pini_editar_noticia&id=" . $_GET['id']);
        }
        $this->renderizar();
    }

    public function actionPini_editar_comentario() {
        $this->renderizar();
    }

    public function actionPini_adicionar_comentario() {
        $this->renderizar();
    }

    public function actionPini_adicionar_destaque() {
        $this->renderizar();
    }

    public function actionPini_fotos() {
        if ($_GET['i'] == 1) {
            $controllerG = new controllerSistema();
            $f = $controllerG->inserir_foto();
            if (!$f) {
                echo 0;
            } else {
                echo $f->getImagem() . '--' . $f->getId_foto();
            }
            die();
        } else if (isset($_GET['id'])) {
            $controllerG = new controllerSistema();
            $retorno = $controllerG->removerFoto($_GET['id']);
            echo json_encode($retorno);
            die();
        }
        $this->renderizar();
    }

    public function actionPini_adicionar_foto() {
        $this->renderizar();
    }

    public function actionGerenciar_matricula() {
        $controllerCurso = new controllerCurso();
        $controllerUsuario = new controllerUsuario();
        $this->visao->id_usuario = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->visao->tabela = $controllerCurso->tabelaGerenciar_matricula($this->visao->id_usuario);
        $this->visao->usuario = $controllerUsuario->getUsuario("id_usuario=" . $this->visao->id_usuario . "");
        $this->renderizar();
    }

    public function actionVisualizar_exercicio() {
        $id_exercicio = Biotran_Mvc::pegarInstancia()->pegarId();
        $c = new controllerExercicio();
        $this->visao->exercicio = $c->getExercicio("id_exercicio=" . $id_exercicio);
        $this->visao->listaPerguntas = $c->listaPerguntas_admin($id_exercicio);
        $this->renderizar();
    }

    public function actionDownload() {
        $this->renderizar();
    }

    public function geraTimestamp($data) {
        $partes = explode('/', $data);
        return mktime(0, 0, 0, $partes[1], $partes[0], $partes[2]);
    }

    public function actionCertificado() {
        $c = new controllerCurso();
        $id_curso = Biotran_Mvc::pegarInstancia()->pegarId();
        $id_usuario = $_SESSION['usuarioLogado']->getId_usuario();
        $curso = $c->getCurso("id_curso=" . $id_curso);
        $c = new controllerMatricula_curso();
        $mc = $c->getMatricula_curso("id_curso=" . $id_curso . " AND id_usuario=" . $id_usuario);
        $data_fim = split('/', $mc->getData_fim());
        // $handle = fopen(ROOT_PATH . "app/view/ead/estudante/certificado.php","r");
        $certificado = "<html>
    <head> 
        <style type='text/css'>
            *{margin:0px;padding:0px;font-family: Verdana, Geneva, sans-serif; font-weight:400;letter-spacing:6px;}
            
            h1{
                font-size:45px;
            }
        </style>
    </head>
    <body>
        <table style='width: 1340px;'>
            <tr>
                <td style='height: 200px;'><img src='img/certificado/Picture1.jpg' /></td>
                <td rowspan='4' align='right'>
                    <img style='height: 780px;' src='img/certificado/Picture2.jpg' />
                </td>
            </tr>
            <tr style='height: 215px';>
                <td align='center' style='padding-left:150px;'>
                    <h1>Certificamos que <br> concluiu o curso online '" . $curso->getNome() . "'</h1>
                </td>
            </tr>
            <tr>
                <td style='padding-left:100px; height: 105px;'>
                    <h4>Alfenasççá, " . $data_fim[0] . " de " . utf8_encode($this->num_mes($data_fim[1])) . " de " . $data_fim[2] . "</h5>
                </td>
            </tr>
            <tr align='center'>
                <td style='padding-left:100px;'>
                    <img src='img/cursos/ass-" . $id_curso . ".jpg' />
                </td>
            </tr>
        </table>
        </body>
        </html>";
        //print($conteudo);
        $c = new controllerCurso();
        $c->gerarCertificado($curso->getNome(), $certificado);
    }

    public function num_mes($mes) {
        switch ($mes) {
            case '1': return 'Janeiro';
            case '2': return 'Feveiro';
            case '3': return 'Março';
            case '4': return 'Abril';
            case '5': return 'Maio';
            case '6': return 'Junho';
            case '7': return 'Julho';
            case '8': return 'Agosto';
            case '9': return 'Setembro';
            case '10': return 'Outubro';
            case '11': return 'Novembro';
            case '12': return 'Dezembro';
        }
        return 0;
    }

}

?>
