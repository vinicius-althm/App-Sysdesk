<?php
require_once('../../config/verificaSessao.php');
require_once('../../config/functions/service.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST'):
    require_once('../../config/database/conexao.php');
    $id  = trim($_POST['finalizar']);

    if ($global_departamento == 'TI'):
        //Finalizar chamado
        $query_finalizar = "UPDATE tb_suporte 
                SET atendente = '{$global_email}', 
                id_status_chamado = 3,
                dt_concluido = NOW()
                WHERE id = {$id}";
        if (mysqli_query($conn, $query_finalizar)):

            set_message_default('success', "Ticket #{$id}", 'Finalizado com sucesso');

            header('Location: ../consultar.php');
        else:
            $erro = mysqli_error($conn);
            set_message_default('success', "Ticket #{$id}", "'Não foi possivel finalizar");
            header('Location: ../consultar.php');

        endif;
    else:

        //Atualizar chamado - Cliente
        $query_finalizar_cliente = "UPDATE tb_suporte 
                SET
                id_status_chamado = 4,
                dt_concluido = NOW()
                WHERE id = {$id}";

        if (mysqli_query($conn, $query_finalizar_cliente)):
            set_message_default('success', "Ticket #{$id}", 'Finalizado com sucesso');
            header('Location: ../consultar.php');

        else:
            $erro = mysqli_error($conn);
            set_message_default('success', "Ticket #{$id}", "Não foi possivel finalizar ");
            header('Location: ../consultar.php');
        endif;
    endif;
    mysqli_close($conn);

endif;
