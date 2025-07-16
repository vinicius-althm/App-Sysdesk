 <?php
      require_once('../config/verificaSessao.php');
      require_once('../config/database/conexao.php');

      $query_chamados = "SELECT *, tbs.descricao_status AS status_descricao
      FROM tb_suporte  ts
      JOIN  tb_status tbs 
      ON tbs.id_status = ts.id_status_chamado";

      if ($global_departamento != 'TI'):
            $query_chamados .= " WHERE usuario_criacao = '{$global_email}'";    // Filtro para clientes
      endif;
      $query_chamados .= " ORDER BY dt_atualizacao DESC";
      $result_chamados = mysqli_query($conn, $query_chamados);

      /*--- HISTORICO CHAMADOS --- */
      /* Retorna o historico cliente e suporte*/
      $query_visualizacao = "SELECT id_chamado, tramite, usuario_tramite, perfil_user_reply, dt_registro FROM tb_suporte_chamados ORDER BY dt_registro DESC";
      $result_visualizacao = mysqli_query($conn, $query_visualizacao);

      /*Conta os registros de acordo com o perfil*/
      $query_respostas = "SELECT COUNT(*) as total_respostas FROM tb_suporte_chamados";
      if ($global_profile == 'suporte'):
            $query_respostas .= " WHERE perfil_user_reply = 'cliente' ORDER BY dt_registro DESC";
      else:
            $query_respostas .= " WHERE perfil_user_reply = 'suporte' ORDER BY dt_registro DESC";
      endif;

      $result = mysqli_query($conn, $query_respostas);
      $row = mysqli_fetch_assoc($result);
      $result_registros = $row['total_respostas'];
      