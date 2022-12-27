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

$emailPassageiro = $_REQUEST["emailPassageiro"];
$senhaPassageiro = $_REQUEST["senhaPassageiro"];

$comando = "SELECT * FROM passageiro WHERE email = '$emailPassageiro' AND senha = '$senhaPassageiro';";
$consulta = mysqli_query($conexao, $comando);
$resultado = mysqli_fetch_assoc($consulta);

if (isset($resultado)) {
    $_SESSION['nomePassageiro'] = $resultado['nome'];
    $_SESSION['emailPassageiro'] = $resultado['email'];

    $conexao->close();
    header("location: ../telaPrincipal.php");
} else {
    $_SESSION['erroLogin'] = "Email ou senha inválidos!";

    $conexao->close();
    header("location: ../telaLogin.php");
}
