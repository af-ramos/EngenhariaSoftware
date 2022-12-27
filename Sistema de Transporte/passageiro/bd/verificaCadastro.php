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

$nomePassageiro = $_REQUEST["nomePassageiro"];
$emailPassageiro = $_REQUEST["emailPassageiro"];
$senhaPassageiro = $_REQUEST["senhaPassageiro"];
$cpfPassageiro = $_REQUEST["cpfPassageiro"];

$comando = "INSERT INTO passageiro VALUES ('$cpfPassageiro', '$nomePassageiro', '$emailPassageiro', '$senhaPassageiro')";

try {
    mysqli_query($conexao, $comando);

    $conexao->close();
    header("location: ../telaLogin.php");
} catch (mysqli_sql_exception $e) {
    $_SESSION['erroCadastro'] = "Email ou CPF já existentes!";

    $conexao->close();
    header("location: ../telaCadastro.php");
}
