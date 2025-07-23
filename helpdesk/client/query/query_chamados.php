 <?php
      require_once('../config/verificaSessao.php');
      require_once('../config/database/conexao.php');

      $query_chamados = "SELECT tb_suporte.*, 
      tb_usuarios.email AS email,
      tb_status.id_status AS id_status,
      tb_status.descricao_status AS descricao_status
      FROM tb_suporte tb_suporte
      JOIN tb_status tb_status ON tb_status.id_status = tb_suporte.id_status_chamado
      JOIN tb_usuarios tb_usuarios ON tb_usuarios.id = tb_suporte.id_usuario_criacao";

      if ($global_departamento != 'TI'):
            $query_chamados .= " WHERE id_usuario_criacao = '{$registro_id}'";    // Filtro para clientes
      endif;
      $query_chamados .= " ORDER BY tb_suporte.dt_registro DESC";
      $result_chamados = mysqli_query($conn, $query_chamados);


      #Historico#
      $query_historico = "SELECT  tb_s.id_chamado, tb_s.id_usuario_tramite, tb_u.nome, tb_s.tramite, tb_s.id_perfil_reply , tb_s.dt_registro
      FROM tb_suporte_chamados tb_s
      JOIN tb_usuarios tb_u ON tb_u.id = tb_s.id_usuario_tramite 
      ORDER BY tb_s.dt_registro DESC";
      $result_historico = mysqli_query($conn, $query_historico);
      # Organiza o historico  por chamado:
      $historico_por_chamado = [];

      while ($row_historico = mysqli_fetch_assoc($result_historico)) :
            $id_chamado = $row_historico['id_chamado'];
            if (!isset($historico_por_chamado[$id_chamado])):
                  $historico_por_chamado[$id_chamado] = [];
            endif;
            $historico_por_chamado[$id_chamado][] = $row_historico;
      endwhile;


      $query_respostas = "SELECT id_chamado, COUNT(*) AS total_respostas FROM tb_suporte_chamados";
      if ($global_profile == 3):
            $query_respostas .= " WHERE id_perfil_reply = 2 GROUP BY id_chamado";
      elseif ($global_profile == 2):
            $query_respostas .= " WHERE id_perfil_reply = 3 GROUP BY id_chamado";
      endif;


      $result_respostas = mysqli_query($conn, $query_respostas);

      $total_respostas_por_chamado = [];
      while ($row_resposta = mysqli_fetch_assoc($result_respostas)):
            $id_chamado = $row_resposta['id_chamado'];
            $total_respostas_por_chamado[$id_chamado] = $row_resposta['total_respostas'];
      endwhile;
