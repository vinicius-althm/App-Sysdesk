<?php

define('DB_HOST', 'localhost/dominio/IP');
define('DB_USER', 'seu_usuario');
define('DB_PASS', 'sua_senha');
define('DB_NAME', 'seu_database');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Verifica se houve erro na conexão
if (!$conn) {
    die('Erro na conexão: ' . mysqli_connect_error());
}