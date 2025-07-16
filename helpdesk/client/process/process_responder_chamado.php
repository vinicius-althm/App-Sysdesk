<?php
require_once('../../config/verificaSessao.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST'):
    require_once('../../config/database/conexao.php');
    $id  = trim($_POST['id_chamado']);
    $tramite_chamado = $_POST['tramite_chamado'];
        $perfil_resposta  = trim($_POST['perfil_resposta']);

   
    $query_resposta = "INSERT 
    INTO tb_suporte_chamados (id_chamado, tramite, usuario_tramite, perfil_user_reply) 
    VALUES ({$id}, '{$tramite_chamado}', '{$global_email}', '{$perfil_resposta}')";
    mysqli_query($conn, $query_resposta);
            
if ($global_departamento == 'TI'):
        //Atualizar chamado
        $query_update_atendente = "UPDATE tb_suporte 
            SET atendente = '{$global_email}', 
            id_status_chamado = 2,
            dt_atualizacao = NOW()
            WHERE id = {$id}";
        if (mysqli_query($conn, $query_update_atendente)):

            $_SESSION['status'] = 'Resposta enviada';
            header('Location: ../consultar.php');
        else:
            echo '[ERRO] - Não foi possiel atualizar os dados na tabela. '  . mysqli_error($conn);
        endif;
    else:

        //Atualizar chamado - Cliente
        $query_update_cliente = "UPDATE tb_suporte 
            SET
            id_status_chamado = 1,
            dt_atualizacao = NOW()
            WHERE id = {$id}";

        if (mysqli_query($conn, $query_update_cliente)):
            $_SESSION['status'] = 'Resposta enviada';
            header('Location: ../consultar.php');

        else:
            echo '[ERRO] - Não foi possiel atualizar os dados na tabela. ' . mysqli_error($conn);
        endif;
    endif;
    mysqli_close($conn);

endif;
