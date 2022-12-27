<?php
session_start();

unset(
    $_SESSION['nomeMotorista'],
    $_SESSION['emailMotorista']
);

header("location: ../telaLogin.php");
