        <?php
        require_once('../../config/verificaSessao.php');
        if ($_SERVER['REQUEST_METHOD'] == 'POST'):
            require_once('../../config/database/conexao.php');

            //Dados
            $perfil_user = trim($_POST['perfil']);
            $assunto = $_POST['assunto'];
            $categoria = $_POST['categoria'];
            $descricao = $_POST['descricao'];

            // Inserir registro na tabela de suporte
            $query_novo_registro = "INSERT INTO tb_suporte (usuario_criacao, assunto, categoria, descricao, atendente, id_status_chamado, dt_registro) VALUES ('{$global_email}', '{$assunto}', '{$categoria}', '{$descricao}', '', 1, NOW())";
            $result_novo_registro = mysqli_query($conn, $query_novo_registro);

            //retornar o max(id) da tb-suporte
            $query_id = "SELECT MAX(id) as id FROM tb_suporte";
            $consulta_id = mysqli_query($conn, $query_id);
            $retornar_id = mysqli_fetch_array($consulta_id);
            $id = $retornar_id['id'];

            //Inserir registro em tb_suporte_chamados para manter o histórico de mensagens
            
            $query_chamados = "INSERT INTO tb_suporte_chamados (id_chamado,tramite,usuario_tramite, perfil_user_reply, dt_registro) VALUES ({$id},'{$descricao}','{$global_email}', '{$perfil_user}', NOW())";

            if ($result_novo_registro):
                $_SESSION['status'] = 'Chama criado com sucesso';
                mysqli_query($conn, $query_chamados);
                header('location: ../novo_chamado.php');
            else:

                $error_insert = mysqli_error($conn);
                $_SESSION['status'] = "Chama criado com sucesso: {$error_insert}";
                header('location: ../novo_chamado.php');
            endif;

        endif;
