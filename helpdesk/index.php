<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/App/helpdesk/config/functions/service.php');

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SysDesk | Login</title>
    <link rel="shortcut icon" href="assets/images/sup.png" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/preloader.css">
</head>

<body id="body_login_bg">
    <!--Flash message-->
    <div aria-live="polite" aria-atomic="true" class="position-fixed top-0 end-0 p-3" style="z-index: 1055">
        <?php show_flash_message(); ?>
    </div>
    <!-- fim flash message-->
    <!--container principal-->
    <div class="container mt-3">
        <!--container formulario-->
        <div class="container-formulario">
            <div class="text-center mb-3 p-2">

                <img src="assets/images/sup.png" class="img-login mb-3" alt="logo">
                <h3 class="text-success fw-bold">SysDesk</h3>
            </div>
            <form action="./config/autenticacao.php" method="POST" id="formLogin">

                <div class="mb-3">
                    <label for="email" class="form-label"><i class="fa-solid fa-circle-user me-2"></i>E-mail*</label>
                    <input type="email" class="form-control" name="email" id="email">
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label"> <i class="fa-solid fa-lock me-2"></i>Senha *</label>
                    <input type="password" class="form-control" name="senha" id="senha">
                </div>

                <button type="submit" id="button" class="btn btn-login btn-secondary mb-3 w-100">
                    Entrar <i class="fa-solid fa-right-to-bracket"></i>
                </button>


                <a href="#" class="link-senha">
                    <label class="form-check-label link-item" for="exampleCheck1">
                        <i class="fa-solid fa-circle-info"></i> Esqueceu a senha?
                    </label>
                </a>

            </form>
        </div>
        <!-- fim container formulario-->
    </div> <!--fim container principal-->






    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="assets/js/flash_message.js"></script>
</body>

</html>