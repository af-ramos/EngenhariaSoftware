<?php

session_start();

$nomeServidor = "localhost";
$usuarioServidor = "root";
$senhaServidor = "";
$bancoServidor = "apptransporte";

$conexao = new mysqli($nomeServidor, $usuarioServidor, $senhaServidor, $bancoServidor);

if ($conexao->connect_error) {
    die("Erro na Conexão: " + $conexao->connect_error);
}

$nomeMotorista = $_REQUEST["nomeMotorista"];
$emailMotorista = $_REQUEST["emailMotorista"];
$senhaMotorista = $_REQUEST["senhaMotorista"];
$cpfMotorista = $_REQUEST["cpfMotorista"];

$comando = "INSERT INTO motorista VALUES ('$cpfMotorista', '$nomeMotorista', '$emailMotorista', '$senhaMotorista', 0)";

try {
    mysqli_query($conexao, $comando);

    $conexao->close();
    header("location: ../telaLogin.php");
} catch (mysqli_sql_exception $e) {
    $_SESSION['erroCadastro'] = "Email ou CPF já existentes!";

    $conexao->close();
    header("location: ../telaCadastro.php");
}
