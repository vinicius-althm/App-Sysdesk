<?php
require_once('../../config/verificaSessao.php');
require_once('../../config/functions/service.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST'):
    require_once('../../config/database/conexao.php');
    $id  = trim($_POST['id_chamado']);
    $id_usuario_resposta = $_POST['id_usuario_resposta'];
    $perfil_resposta  = trim($_POST['perfil_resposta']);    
    $tramite_chamado = $_POST['tramite_chamado'];

    $query_resposta = "INSERT INTO tb_suporte_chamados (id_chamado, id_usuario_tramite, tramite, id_perfil_reply) VALUES({$id}, {$id_usuario_resposta}, '{$tramite_chamado}', {$perfil_resposta})";
    mysqli_query($conn, $query_resposta);

    if ($global_departamento == 'TI'):
        //Atualizar chamado
        $query_update_atendente = "UPDATE tb_suporte 
            SET atendente = '{$global_email}', 
            id_status_chamado = 2,
            dt_atualizacao = NOW()
            WHERE id = {$id}";
            
       if (mysqli_query($conn, $query_update_atendente)):

            set_message_default('success', "Ticket #{$id}", 'Resposta enviada com sucesso');

            header('Location: ../consultar.php');
        else:
            set_message_default('erro', 'Ticket' , 'Erro ao enviar resposta');;
            header('Location: ../consultar.php');
        endif;
    else:
        //Atualizar chamado - Cliente
        $query_update_cliente = "UPDATE tb_suporte 
            SET
            id_status_chamado = 1,
            dt_atualizacao = NOW()
            WHERE id = {$id}";

        if (mysqli_query($conn, $query_update_cliente)):
            set_message_default('success', "Ticket #{$id}", 'Resposta enviada com sucesso');
            header('Location: ../consultar.php');
        else:
            set_message_default('erro', 'Ticket', 'Erro ao enviar resposta');
            header('Location: ../consultar.php');
        endif;
    endif;
endif;

