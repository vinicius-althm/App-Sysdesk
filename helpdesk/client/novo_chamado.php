<?php
require_once('../config/verificaSessao.php');
require_once('../includes/header.php');

?>
<section class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 mb-3">
            <div class="row d-flex">
                <div class=" col-sm-4">
                    <a href="consultar.php" class="btn btn-success  mb-3"><i class="fa-solid fa-magnifying-glass fa-sm me-3"></i></i><span>Consultar</span></a>

                </div>


            </div>
            <div class="card">
                <div class="card-header bg-light bg-gradient p-2">
                    <span class="text-muted fw-bold"><i class="fa-solid fa-up-right-from-square me-2"></i>Novo chamado</span>
                </div>
                <div class="card-body">
                    <form class="p-2" action="process/process_novo_chamado.php" method="POST" enctype="multipart/form-data" id="formChamado">
                        <input type="hidden" class="form-control" id="perfil" name="perfil" readonly value="<?= $global_profile ?>">

                        <div class="form-group mb-2">
                            <label for="email" class="mb-2">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" readonly value="suporte@service.com.br">
                        </div>
                        <div class="form-group mb-2">
                            <label for="assunto" class="mb-2">Assunto</label>
                            <input type="text" class="form-control" id="assunto" name="assunto" placeholder="Digite o assunto" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="categoria" class="mb-2">Categoria</label>
                            <select class="form-control p-2" id="categoria" name="categoria" required>
                                <option value=""> --- Selecione uma categoria ---</option>
                                <option value="Dúvida">Dúvida</option>
                                <option value="Email">E-mail</option>
                                <option value="Servidor">Servidor</option>
                                <option value="VPN">VPN</option>
                                <option value="Compras - informatica">Compras - informatica</option>
                                <option value="Sistema">Sistema</option>
                                <option value="Manutenção">Manutenção</option>
                            </select>
                        </div>

                        <div class="form-group mb-4">
                            <label for="descricao">Descrição</label>
                            <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
                        </div>

                        <div class="form-group mb-4">
                            <input class="form-control" type="file" id="formFile" name="arquivo">
                            <blockquote class="blockquote">
                                <p class="text-muted ">(Arquivo ou imagem do erro)</p>
                            </blockquote>
                        </div>

                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type="submit" class="btn btn-outline-success ">
                                <i class="fa-solid fa-paper-plane"></i>
                                <span class="descricao-itens ms-2">Enviar</span>
                            </button>
                        </div>


                    </form>
                </div>

            </div>
        </div>

    </div>
</section>

<?php require_once('../includes/footer.php'); ?>
<?php require_once('../includes/script.php'); ?>