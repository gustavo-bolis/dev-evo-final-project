<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
    <title>Dev-Evolution</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
    <style>
        html, body {
            height: 90%;
            margin: 0;
        }
        body {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-signin {
            width: 100%;
            max-width: 280px; /* Reduzido de 330px para 280px */
            padding: 15px;
            margin: auto;
        }

        .container {
            position: relative;
            z-index: 1;
            background-color: white;
            padding: 1rem;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 0 15px; /* Adicionado margem para evitar que o container toque as bordas da tela */
            max-width: 280px;
        }

        canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .logo-image {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
<canvas id="canvas"></canvas>
<script src="lib/requestAnimFrame.js"></script>
<script src="script.js"></script>
</canvas>
<div class="container">
<form class="form-signin" method="POST" action="back-end/modelsUser/validateLogin.php">
    <img class="mb-4 logo-image" src="dogecoin_logo.png">
    <h1 class="h3 mb-3 font-weight-normal">Login</h1>

    <label for="inputEmail" class="sr-only">Email</label>
    <input type="text" name="email" class="form-control" placeholder="Email" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="senha" class="form-control" placeholder="Senha" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Acessar</button>

    <p class="mt-5 mb-3 text-muted">&copy; Dev-Evolution 2023</p>
</form>
</div>
<script>
    function exibirAviso(mensagem, tipo) {
        let aviso = document.createElement("div");
        aviso.style.position = "fixed";
        aviso.style.bottom = "10px";
        aviso.style.right = "10px";
        aviso.style.padding = "10px";
        aviso.style.borderRadius = "10px";
        aviso.style.backgroundColor = tipo === "falha" ? "red" : "yellow";
        aviso.style.color = tipo === "falha" ? "white" : "black";
        aviso.style.zIndex = 1000;
        aviso.textContent = mensagem;

        document.body.appendChild(aviso);
    }
</script>
</body>
</html>
<?php
if (isset($_GET['erro'])) {
    echo "<script>exibirAviso('Usuário ou senha incorretos', 'falha');</script>";
}elseif (isset($_GET['exists'])){
    echo "<script>exibirAviso('Já existem usuários criados, prossiga com o login', 'exists');</script>";
}
?>