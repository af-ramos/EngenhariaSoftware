<?php
session_start();
?>

<!DOCTYPE html>

<head>
    <title> Cadastro de Motorista </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>

<body>
    <div class="jumbotron m-2">
        <h1 class="display-4">Cadastro de Motorista</h1>
        <p class="lead">Preencha os campos para se cadastrar no sistema de motoristas.</p>
        <hr class="my-4">
    </div>

    <form method="POST" action="bd/verificaCadastro.php">
        <div class="form-group">
            <p class="m-2"> Nome </p>
            <input type="text" class="form-control m-2" name="nomeMotorista" required placeholder="Digite o nome..." style="width: 400px">
        </div>

        <div class="form-group">
            <p class="m-2"> Endereço de Email </p>
            <input type="email" class="form-control m-2" name="emailMotorista" required placeholder="Digite o email..." style="width: 400px">
        </div>

        <div class="form-group">
            <p class="m-2"> CPF </p>
            <input type="text" class="form-control m-2" name="cpfMotorista" required placeholder="Digite o CPF..." style="width: 400px">
        </div>

        <div class="form-group">
            <p class="m-2"> Senha </p>
            <input type="password" class="form-control m-2" name="senhaMotorista" required placeholder="Digite a senha..." style="width: 400px">
        </div>

        <div class="m-2 mt-4">
            <input type="submit" class="btn btn-primary" value="Cadastrar"> &nbsp;
            <input type="reset" class="btn btn-secondary" value="Limpar"> &nbsp;
            <a class="btn btn-success" href="telaLogin.php" role="button"">Login</a>
        </div>
    </form>
    <p class="text-danger m-2 mt-3">
        <?php
        if (isset($_SESSION['erroCadastro'])) {
            echo $_SESSION['erroCadastro'];
            unset($_SESSION['erroCadastro']);
        }
        ?>
    </p>
</body>

</html>