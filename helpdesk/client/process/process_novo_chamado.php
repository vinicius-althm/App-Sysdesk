        <?php
        require_once('../../config/verificaSessao.php');
        require_once('../../config/functions/service.php');

        if ($_SERVER['REQUEST_METHOD'] == 'POST'):
            require_once('../../config/database/conexao.php');

            //Dados do formulario
            $assunto = $_POST['assunto'];
            $categoria = $_POST['categoria'];
            $descricao = $_POST['descricao'];

            #Inserir registro na tabela de suporte
                //Registro_id (id do usuario)

            $query_novo_registro = "INSERT INTO tb_suporte (id_usuario_criacao, assunto, categoria, descricao, atendente, id_status_chamado, dt_registro) 
            VALUES ('{$registro_id}', '{$assunto}', '{$categoria}', '{$descricao}', '', 1,  NOW())";
            $result_novo_registro = mysqli_query($conn, $query_novo_registro);

            //retornar o max(id) da tb_suporte
            $query_id = "SELECT MAX(id) as id FROM tb_suporte";
            $consulta_id = mysqli_query($conn, $query_id);
            $retornar_id = mysqli_fetch_assoc($consulta_id);
            $id_chamado = $retornar_id['id'];

            //Inserir registro em tb_suporte_chamados para manter o histórico de mensagens
            
            $query_chamados = "INSERT INTO tb_suporte_chamados (id_chamado,id_usuario_tramite,tramite, id_perfil_reply, dt_registro)
             VALUES ({$id_chamado},{$registro_id},'{$descricao}', {$global_profile}, NOW())";

            if ($result_novo_registro):
                mysqli_query($conn, $query_chamados);
                set_message_default('success', "Ticket #{$id_chamado}", 'Registrado com sucesso');
                header('location: ../novo_chamado.php');
                exit();
            else:

                $error_insert = mysqli_error($conn);
                set_message_default('erro', 'Erro ao registrar', 'O ticket não foi criado');
                header('location: ../novo_chamado.php');
                 exit();
            endif;

        endif;
