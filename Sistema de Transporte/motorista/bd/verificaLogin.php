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

$emailMotorista = $_REQUEST["emailMotorista"];
$senhaMotorista = $_REQUEST["senhaMotorista"];

$comando = "SELECT * FROM motorista WHERE email = '$emailMotorista' AND senha = '$senhaMotorista';";
$consulta = mysqli_query($conexao, $comando);
$resultado = mysqli_fetch_assoc($consulta);

if (isset($resultado)) {
    if ($resultado['autorizado']) {
        $_SESSION['nomeMotorista'] = $resultado['nome'];
        $_SESSION['emailMotorista'] = $resultado['email'];

        $conexao->close();
        header("location: ../telaPrincipal.php");
    } else {
        $_SESSION['erroLogin'] = 'Motorista não autorizado!';

        $conexao->close();
        header("location: ../telaLogin.php");
    }
} else {
    $_SESSION['erroLogin'] = "Email ou senha inválidos!";

    $conexao->close();
    header("location: ../telaLogin.php");
}
