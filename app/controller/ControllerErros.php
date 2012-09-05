<?php

/*
 * registra o erro em um arquivo de log
 */

function customerErros($error_level, $error_msg, $error_file, $error_line, $error_ctx) {

    $date = date("d/m/y");
    $time = date("H:i");
    
    $tipo_erro = $error_msg[0];
    $error_msg[0] = $error_msg[1] = '';
    $erro = "---$date $time--- \r\nerror_level:$error_level \r\n$error_msg $error_file - line: $error_line \r\n\r\nerror_context: " . print_r($error_ctx, 1) . "\r\n\r\n";
    
    //erro de usuario
    if ($tipo_erro == 0) {        
        error_log($erro, 3, "../app/relatorios/log_erros_usuario.txt");
    }else{
        error_log($erro, 3, "../app/relatorios/log_erros_sistema.txt");
    }
}

?>
