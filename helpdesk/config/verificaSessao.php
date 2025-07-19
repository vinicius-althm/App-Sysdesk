<?php
date_default_timezone_set('America/Sao_paulo');

//Verifica se existe uma sessao ativa
if (session_status() !== PHP_SESSION_ACTIVE):
    session_start();

    // Gravar variáveis globais de sessão
    $global_nome = isset($_SESSION['nome']) ? $_SESSION['nome'] : null;
    $global_email = isset($_SESSION['email']) ? $_SESSION['email'] : null;
    $global_senha = isset($_SESSION['senha']) ? $_SESSION['senha'] : null;
    $global_cargo = isset($_SESSION['cargo']) ? $_SESSION['cargo'] : null;
    $global_departamento = isset($_SESSION['departamento']) ? $_SESSION['departamento'] : null;
    $global_admin = isset($_SESSION['admin_user']) ? $_SESSION['admin_user'] : null;
    $global_profile = isset($_SESSION['perfil_user']) ? $_SESSION['perfil_user'] : null;
    $global_status = isset($_SESSION['Ativo']) ? $_SESSION['Ativo'] : null;
    $global_dt_registro = isset($_SESSION['dt_registro']) ? $_SESSION['dt_registro'] : null;
    $global_dt_atualizacao = isset($_SESSION['dt_atualizacao']) ? $_SESSION['dt_atualizacao'] : null;
endif;
//Verifica se a sessão esta definida, caso não esteja redirecionamos para a pagina de login
if (!$_SESSION['email']) :
    header('Location: ../');
    exit();
    // Verifica a URL atual para saber se o usuário está no CID ou Hub
    $current_page = $_SERVER['REQUEST_URI'];

   /* if (strpos($current_page, '../') !== false) {
        // Se estiver na página do helpdesk, redireciona para o login do helpdesk
        header('Location: ../admin');
        exit();
    } */
    //Desloga o usuario em um determinado tempo
    if (isset($_SESSION['tempo_login'])) :
        // Define o tempo limite de inatividade em segundos (1 minuto)
        $tempo_limite_inatividade = 3600; // 60minutos

        // Verifica se o tempo desde o último acesso excede o limite de inatividade
        if (time() - $_SESSION['tempo_login'] > $tempo_limite_inatividade) :
            // Destroi a sessão e todos os dados associados a ela
            session_unset();
            session_destroy();

            // Se excedeu o tempo limite, faz logout do usuário e redireciona para o index
            header('Location: ../');
            exit();
        else:
            // Se não expirou, atualiza o tempo:
            $_SESSION['tempo_login'] = time();
        endif;
    endif;
endif;
