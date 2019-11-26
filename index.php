<?php include_once("config.php") ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modelo Site :: Hospital</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilo.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">Inicio</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pacientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?p=endereco">Endereco</a>
                    </li>
                </ul>

                <?php if (session_status() != PHP_SESSION_ACTIVE) {
                    session_start();
                } ?>

                <?php if (!isset($_SESSION["user"])) : ?>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Cadastro</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Entrar</a>
                        </li>
                    </ul>

                <?php else : ?>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <?= $_SESSION['user']->nome; ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Sair</a>
                        </li>
                    </ul>

                <?php endif; ?>

            </div>
        </div>
    </nav>

    <?php
    include("pages/mensagens.php");
    if (isset($_GET['p'])) {
        if ($_GET['p'] == "endereco")
            include("pages/add-endereco.php");
    } else {
        include("pages/home.php");
    }
    ?>

    <footer class="mt-2 p-3 bg-dark text-light text-center fixed-bottom">
        <p>feito por <a href="https://fabianomoreira.blogspot.com">Fabiano Moreira</a></p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>