<?php
require_once('./database/conexao.php');

session_start();

//Recupera o usuario antes de encerrar
$usuario = isset($_SESSION['email']) ? $_SESSION['email'] : 'Usuário Desconhecido';
// Recupera o IP do usuário
$ip = $_SERVER['REMOTE_ADDR'];


//Apagando todos os dados de uma sessão e redirecionar para a tela de login
$log_encerrou = "INSERT INTO logs_users(email,status, ip) VALUES ('{$usuario}','Encerrou','{$ip}')";
$result_log_encerrou = mysqli_query($conn, $log_encerrou);

//finaliza a sessão
session_unset();
session_destroy();

header('Location: ../');
exit();
