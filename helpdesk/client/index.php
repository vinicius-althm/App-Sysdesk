    <?php
    require_once('../config/verificaSessao.php'); 

     require_once('../includes/header.php'); 
     
     ?>


    <section class="container-fluid">
        <div class="row justify-content-center p-3">
            <div class="col-12 col-md-8 col-lg-6 mb-3">
                <div class="card shadow ">
                    <div class="card-header text-light bg-primary bg-gradiant"> <i class="fa-solid fa-gear me-2"></i> Ferramentas</div>
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-md-6 mb-4">
                                <div class="d-flex flex-column align-items-center">
                                    <a href="novo_chamado.php">
                                        <img src="/App/helpdesk/assets/images/logo_chamado.png" alt="Novos chamados" width="70px" height="70px">

                                    </a>
                                    <span class="mt-2 text-muted fw-bold">Novo Chamado</span>

                                </div>



                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column align-items-center">
                                    <a href="consultar.php">
                                        <img src="/App/helpdesk/assets/images/logo_consultar.png" alt="Consultar chamados" width="70px" height="70px">
                                    </a>
                                    <span class="mt-2 text-muted fw-bold">Consultar Chamados</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php require_once('../includes/footer.php'); ?>
    <?php require_once('../includes/script.php'); ?>