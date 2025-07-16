<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SysDesk</title>

    <link rel="shortcut icon" href="/App/helpdesk/assets/images/sup.png" type="image/x-icon">

    <!--links datatables-->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
    <!-- lnks bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.4/css/buttons.bootstrap5.min.css">

    <link rel="stylesheet" href="/App/helpdesk/assets/css/main.css">
</head>

<body class="d-flex flex-column min-vh-100 bg-body-tertiary">
    <header>
        <nav class=" navbar navbar-expand navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid p-2">
                <!-- Marca -->
                <a href="/App/helpdesk/client/" class="text-decoration-none">
                    <span class="navbar-brand ms-4">
                        <img src="/App/helpdesk/assets/images/sup.png" alt="logo" style="width:40px; height:40px;">
                        <span class="text-white fw-bold ms-2">SysDesk</span>
                    </span>


                </a>
                <!-- Espaçador automático para empurrar os itens à direita -->
                <div class="ms-auto d-flex align-items-center">

                    <!--


                    <!-- Novo ícone: exemplo de mensagem 
                    <a href="#" class="text-white me-3">
                        <i class="fa-solid fa-envelope"></i>
                    </a>

                    <!-- Novo ícone: configurações 
                    <a href="#" class="text-white me-3">
                        <i class="fa-solid fa-gear"></i>
                    </a>-->

                    <ul class="navbar-nav me-3">
                        <!-- Dropdown de usuário -->

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user fa-fw"></i>

                            </a>

                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">

                                <li><a class="dropdown-item"><?= $global_nome . '/' . $global_cargo; ?></a></li>

                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_alterar_senha"><i class="fa-solid fa-circle-info me-2 text-muted"></i><span>Alterar senha</a></li>

                                <li><a class="dropdown-item" href="/App/helpdesk/config/finalizaSessao.php"><i class="fa-solid fa-right-to-bracket me-2 text-muted"></i> Sair</a></li>
                            </ul>
                        </li>


                    </ul>

                </div>
            </div>
        </nav>

    </header>
    <main class="mt-2 pb-4 flex-fill">