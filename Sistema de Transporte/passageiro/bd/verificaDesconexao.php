<?php
session_start();

unset(
    $_SESSION['nomePassageiro'],
    $_SESSION['emailPassageiro']
);

header("location: ../telaLogin.php");
