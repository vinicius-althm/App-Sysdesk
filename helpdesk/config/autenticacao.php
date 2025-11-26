<?php
//Iniciando a sessão:
session_start();
require_once('./database/conexao.php');
require_once('./functions/service.php');


// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST"):
    if (empty($_POST['email']) || empty($_POST['senha'])):
        set_message_default('warning', 'Campos obrigatorios', 'Preencha os campos E-mail e senha!');
        // Caso algum campo obrigatório não tenha sido preenchido, redirecione de volta para a página de login com uma mensagem de erro
        header('location: ../');
        exit();
    endif;

    // Recebe os dados do formulário
    $usuario = $_POST['email'];
    $pswd = sha1($_POST['senha']);
    //Limpar a string que, no caso, será enviada ao banco de dados. Essa função ajuda na prevenção de SQL Injection, pois não deixa que alguns caracteres como (\n ' ") entre outros quebrem a query ou mesmo cheguem no BD e assim cause algum estrago.
    $email = mysqli_real_escape_string($conn, $usuario);
    $senha = mysqli_real_escape_string($conn, $pswd);
    //Registra IP do usuário para log
    $ip = $_SERVER['REMOTE_ADDR'];
    // Consulta SQL para verificar se o usuário existe
    $query = "SELECT * FROM tb_usuarios WHERE email = '{$email}' AND senha = '{$senha}'";

    //query SQL para registro log de acesso    
    $log_sucesso = "INSERT INTO logs_users(email,status, ip) VALUES ('{$email}','Sucesso','{$ip}')";
    $log_falha = "INSERT INTO logs_users(email,status,ip) VALUES ('{$email}','Falha','{$ip}')";
    $log_inativo = "INSERT INTO logs_users(email,status,ip) VALUES ('{$email}','Inativo','{$ip}')";
    // Executa a consulta
    $resultado = mysqli_query($conn, $query);
    // Verifica se houve algum resultado retornado pela consulta
    if (mysqli_num_rows($resultado) != 0):
        //Transformar query do usuário em array
        $info = $resultado->fetch_assoc();
       
        if ($info['Ativo'] == 'S'):
      
            ini_set('session.gc_maxlifetime', 86400); // 60min
           
            $_SESSION['email'] = $email;
            $_SESSION['id_cliente'] = $info['id'];
            $_SESSION['nome'] = $info['nome'];
            $_SESSION['cargo'] = $info['cargo'];
            $_SESSION['departamento'] = $info['departamento'];
            $_SESSION['admin_user'] = $info['admin_user'];
            $_SESSION['id_perfil_usuario'] = $info['id_perfil_usuario'];
            $_SESSION['Ativo'] = $info['Ativo'];
            $_SESSION['dt_registro'] = $info['dt_registro'];
            $_SESSION['dt_atualizacao'] = $info['dt_atualizacao'];
            // Define o tempo de login na sessão
            $_SESSION['tempo_login'] = time();
            $result_log_sucesso = mysqli_query($conn, $log_sucesso);
            // Usuário encontrado  (redirecione para uma página de acordo com o perfil)
            if($info['id_perfil_user'] == 3):
                header('Location: ../client/');
            else:
                header('Location: ../client/');
            endif;
            exit();
            
        else:
            set_message_default('warning', 'Erro no login', 'Usuario inativo/Sem acesso');
            $result_log_inativo = mysqli_query($conn, $log_inativo);
            header('Location: ../');
            exit();
        endif;

    else:
        set_message_default('erro', 'Erro no login', 'E-mail ou senha incorretos');
        $result_log_falha = mysqli_query($conn, $log_falha);
        // Usuário não encontrado, exiba uma mensagem de erro (por exemplo, redirecione de volta para a página de login com uma mensagem de erro)
        header('location: ../');

        exit();
    endif;
endif;


mysqli_close($conn);
