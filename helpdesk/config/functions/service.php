<?php


/*Flash messages*/

function set_message_default($tipo, $titulo, $mensagem)
{
    $_SESSION['status'] = [
        'tipo' => $tipo,
        'titulo' => $titulo,
        'mensagem' => $mensagem
    ];
}

/*Apresenta as mensagens*/
function show_flash_message()
{
    if (isset($_SESSION['status'])):
        $message_default = $_SESSION['status'];
        echo notification_status($message_default['tipo'], $message_default['titulo'], $message_default['mensagem']);
        unset($_SESSION['status']);
    endif;
}
/*Cria a notificação Toast*/
function notification_status($tipo, $titulo, $mensagem)
{
    $class_toast = match ($tipo) {
        'success' => 'bg-success text-white border-0',
        'erro' => 'bg-danger text-white border-0',
        'warning' => 'bg-warning text-dark border-0',
         default => 'bg-secondary text-white border-0'
    };

    return
        '<div class="toast w-100 ' . $class_toast . ' role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <strong>' . htmlspecialchars($titulo) . '</strong><br>' . htmlspecialchars($mensagem) . '
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>';
}
