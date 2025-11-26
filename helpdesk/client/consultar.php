        <?php
        require_once('../includes/header.php');
        require_once('query/query_chamados.php');
        ?>
        <section class="container">
            <div class="row justify-content-center">


                <div class="col-12 col-lg-8 ">

                    <div class="row justify-content-between">
                        <div class=" col-sm-6">
                            <a href="novo_chamado.php" class="btn btn-success  mb-3"><i class="fa-solid fa-square-plus fa-sm me-3"></i><span>Novo chamado</span></a>
                        </div>

                    </div>
                    <div class="card p-4">
                        <div class="table-responsive">
                            <table id="tab_consulta" class="table   table-hover align-midd nowrap ">
                                <thead class="table-light text-muted">
                                    <tr>

                                        <th>Data/Atualizacao</th>
                                        <th>Ferramentas</th>
                                        <th>Cliente</th>
                                        <th>Assunto</th>
                                        <th>Categoria</th>
                                        <th>Solicitação</th>
                                        <th>Atendente</th>

                                        <th>Data/Registro</th>
                                        <th>Data/Conclusão</th>

                                    </tr>
                                </thead>
                                <tbody class="text-nowrap">
                                    <?php
                                    $i = 0;
                                    while ($row_chamados = mysqli_fetch_assoc($result_chamados)):
                                        $id = $row_chamados['id'];
                                        $result_registros = isset($total_respostas_por_chamado[$id]) ? $total_respostas_por_chamado[$id] : 0;
                                        $inativo = "";
                                        if (in_array($row_chamados['id_status'], [3, 4])):
                                            $inativo = "disabled";
                                        endif;
                                    ?>
                                        <tr>
                                            <td><?= $dat_atualizacao = ($row_chamados['dt_atualizacao'] == null) ? '-' : date('d/m/Y H:i', strtotime($row_chamados['dt_atualizacao'])) ?></td>
                                           

                                            <td class="d-flex justify-content-center">

                                                <!-- detalhes do chamado-->
                                                <button title="Detalhes do chamado" href="#" type="button" class="btn btn-sm btn-outline-secondary me-2" data-bs-toggle="modal" data-bs-target="#detalhes<?= $i ?>">
                                                    <i class="fa-regular fa-file-lines fa-sm"></i> <span>Detalhes</span>
                                                </button>
                                                <a title="Historico" href="#" type="button" class="btn btn-sm btn-outline-warning me-2" data-bs-toggle="modal" data-bs-target="#visualizar<?= $i ?>">
                                                    <div class="position-relative d-inline-block">
                                                        <i class="fa-regular fa-comment-dots fa-sm"></i> <span>Historico</span>
                                                        <?php if ($result_registros > 0): ?>
                                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                                <?= $result_registros ?>
                                                            </span>
                                                        <?php endif; ?>
                                                    </div>
                                                </a>

                                                <!-- Finalizar chamado-->

                                                <form action="process/process_finalizar_chamado.php" method="POST" class="d-inline">
                                                    <input type="hidden" name="finalizar" value="<?= $id ?>">
                                                    <button type="submit" class="btn btn-sm btn-outline-success me-2 <?= $inativo ?>">
                                                        <i class="fa-regular fa-circle-check fa-sm"></i> <span>Finalizar</span>
                                                    </button>
                                                </form>
                                            </td>
                                            <td><?= htmlspecialchars($row_chamados['email']) ?></td>
                                            <td><?= htmlspecialchars($row_chamados['assunto']) ?></td>
                                            <td><?= htmlspecialchars($row_chamados['categoria']) ?></td>

                                            <td>
                                                <?php
                                                $badge_status = match ($row_chamados['id_status_chamado']) {
                                                    '1', '2' => 'badge bg-secondary',
                                                    '3', '4' => 'badge bg-success'
                                                } ?>
                                                <span class="badge <?= $badge_status ?>"><?= htmlspecialchars($row_chamados['descricao_status']) ?></span>
                                            </td>
                                            <td><?= htmlspecialchars($row_chamados['atendente']) ?></td>

                                            <td><?= date('d/m/Y H:i', strtotime($row_chamados['dt_registro'])) ?></td>
                                                 <td><?= $dat_conclusao = ($row_chamados['dt_concluido'] == null) ? '-' : date('d/m/Y H:i', strtotime($row_chamados['dt_concluido'])) ?></td>


                                        </tr>


                                    <?php
                                        $i++;
                                    endwhile; ?>

                                </tbody>

                            </table>
                            <?php
                            mysqli_data_seek($result_chamados, 0); // Volta ponteiro do result
                            $i = 0;
                            while ($row_chamados = mysqli_fetch_assoc($result_chamados)):
                                $inativo = "";
                                if (in_array($row_chamados['id_status'], [3, 4])):
                                    $inativo = "disabled";
                                endif; ?>
                                <!-- RESPONDER CHAMADOS-->
                                <div class="modal fade" id="responder<?= $i ?>" tabindex="-1" aria-labelledby="responderModal<?= $i ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary bg-gradient">
                                                <h5 class="modal-title text-white" id="responderModal<?= $i ?>">Chamado <?= '#' . $row_chamados['id']; ?></h5>

                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="process/process_responder_chamado.php" method="post">
                                                <div class="modal-body">

                                                    <!--id chamado-->
                                                    <input type="hidden" name="id_chamado" value=<?= $row_chamados['id']; ?>>
                                                    <!-- id_usuario-->
                                                    <input type="hidden" name="id_usuario_resposta" value=<?= $registro_id ?>>

                                                    <input type="hidden" class="form-control" id="perfil_resposta" name="perfil_resposta" readonly value="<?= $global_profile ?>">
                                                    <div class="mb-3">
                                                        <input type="email" class="form-control" placeholder=<?= htmlspecialchars($row_chamados['email']) ?> readonly>
                                                    </div>

                                                    <div class="mb-3">
                                                        <input type="text" class="form-control" placeholder=<?= htmlspecialchars($row_chamados['categoria']); ?> readonly>
                                                    </div>
                                                    <label for="descricao" class="mb-2 fw-bold">Motivo </label>
                                                    <div class="mb-3">
                                                        <textarea class="form-control" rows="1" readonly> <?= htmlspecialchars($row_chamados['descricao']); ?> </textarea>
                                                    </div>
                                                    <hr class="divide">
                                                    </hr>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlTextarea1" class="form-label"><strong>Responder Mensagem</strong></label>
                                                        <textarea class="form-control" id="respostaChamado" rows="3" name="tramite_chamado" required></textarea>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#visualizar<?= $i ?>"><i class="fa-solid fa-receipt me-2"></i><span>Histórico</span></button>
                                                    <button type="submit" class="btn btn-outline-success"><i class="fa-solid fa-reply me-2"></i><span>Responder</span></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- VISUALIZAR HISTORICO DE CHAMADOS-->
                                <div class="modal fade" id="visualizar<?= $i ?>" tabindex="-1" aria-labelledby="visualizarModal<?= $i ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary bg-gradient">
                                                <h5 class="modal-title text-white" id="visualizarModal<?= $i ?>">Historico do chamado <?= '#' . $row_chamados['id']; ?></h5>

                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <?php
                                                $id_chamado = $row_chamados['id'];
                                                if (isset($historico_por_chamado[$id_chamado])):
                                                    foreach ($historico_por_chamado[$id_chamado] as $row_visualizacao): ?>
                                                        <div class="card mb-3">
                                                            <div class="card-header d-flex justify-content-between bg-transparent border-success">
                                                                <?php $badge = $row_visualizacao['id_usuario_tramite'] == $row_chamados['id_usuario_criacao'] ? 'bg-success text-white' : 'bg-primary text-white'; ?>
                                                                <span class="badge <?= $badge; ?> text-dark"><?= $row_visualizacao['nome'] ?></span> <span><?= date('d/m/Y H:i:s', strtotime($row_visualizacao['dt_registro'])) ?></span>
                                                            </div>
                                                            <div class="card-body">
                                                                <p class="text-muted"><?= htmlspecialchars($row_visualizacao['tramite']) ?></p>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>

                                            <div class="modal-footer">

                                                <button type="button" class="btn btn-outline-success  <?= $inativo ?>" data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#responder<?= $i ?>"><i class="fa-solid fa-reply me-2"></i><span>Responder</span></button>
                                            </div>
                                        </div>


                                    </div>

                                </div>

                                <!-- VISUALIZAR DETALHES DO CHAMADO-->
                                <div class="modal fade" id="detalhes<?= $i ?>" tabindex="-1" aria-labelledby="detalhes<?= $i ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary bg-gradient">
                                                <h5 class="modal-title text-white" id="detalhes<?= $i ?>">Detalhes do chamado <?= '#' . $row_chamados['id']; ?></h5>

                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <?php
                                                $id_chamado = $row_chamados['id']; ?>

                                                <div class="card">
                                                    <div class="alert alert-light m-0" role="alert">

                                                        <span><strong>Cliente:</strong> <?= $row_chamados['email'] ?></span><br>
                                                        <span><strong>Criado:</strong> <?= date('d/m/Y H:i', strtotime($row_chamados['dt_registro']))  ?></span><br>
                                                        <span><strong>Responsavel Técnico:</strong> <?= !empty($row_chamados['atendente']) ? $row_chamados['atendente'] : 'n/a' ?> </span><br>
                                                        <span><strong>Assunto</strong> <?= ($row_chamados['assunto']) ?> </span><br>
                                                        <span><strong>Categoria:</strong> <?= ($row_chamados['categoria']) ?> </span><br>
                                                        <span><strong>Descrição:</strong> <?= ($row_chamados['descricao']) ?> </span><br>
                                                        <span><strong>Concluido:</strong> <?= !empty($row_chamados['dt_concluido']) ? date('d/m/Y H:i', strtotime($row_chamados['dt_concluido'])) : 'n/a' ?> </span><br>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#visualizar<?= $i ?>"><i class="fa-solid fa-receipt me-2"></i><span>Histórico</span></button>

                                            </div>
                                        </div>


                                    </div>

                                </div>
                            <?php $i++;
                            endwhile; ?>
                        </div>

                    </div>
                </div>

        </section>


        <?php require_once('../includes/footer.php'); ?>
        <?php require_once('../includes/script.php'); ?>