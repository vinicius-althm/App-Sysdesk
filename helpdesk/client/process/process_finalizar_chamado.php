<?php
require_once('../../config/verificaSessao.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST'):
    require_once('../../config/database/conexao.php');
    $id  = trim($_POST['finalizar']);



    if ($global_departamento == 'TI'):
        //Finalizar chamado
        $query_finalizar = "UPDATE tb_suporte 
                SET atendente = '{$global_email}', 
                id_status_chamado = 5,
                dt_atualizacao = NOW()
                WHERE id = {$id}";
        if (mysqli_query($conn, $query_finalizar)):

            $_SESSION['status'] = 'Chamado Finalizado';
            header('Location: ../consultar.php');
        else:
            echo '[ERRO] - Não foi possivel finalizar o chamado. '  . mysqli_error($conn);
        endif;
    else:

        //Atualizar chamado - Cliente
        $query_finalizar_cliente = "UPDATE tb_suporte 
                SET
                id_status_chamado = 3,
                dt_atualizacao = NOW()
                WHERE id = {$id}";

        if (mysqli_query($conn, $query_finalizar_cliente)):
            $_SESSION['status'] = 'Chamado Finalizado';
            header('Location: ../consultar.php');

        else:
            echo '[ERRO] - Não foi possivel finalizar o chamado. ' . mysqli_error($conn);
        endif;
    endif;
    mysqli_close($conn);

endif;
