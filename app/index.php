<?php
require_once 'back-end/login/sessao.php';

validaSessao();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dark Mode Example</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
  <div class="container">
    <button id="list-btn">Listar GPUs</button>
    <button id="add-btn">Dashboard</button>
      <span id="settings-icon">&#x2022;&#x2022;&#x2022;</span>
  </div>

  <div id="settings-modal" class="modal">
      <div class="modal-content">
          <span class="close">&times;</span>
          <h2>Ajustes</h2>
          <button id="users-btn">Usuários</button>
          <button id="config-btn">Configurações</button>
          <button id="logout-btn">Logout</button>
      </div>
  </div>

  <script>
    document.getElementById("users-btn").addEventListener("click", function () {
      window.location.href = "back-end/modelsUser/listaUsers.php";
    });
    document.getElementById("config-btn").addEventListener("click", function () {
      window.location.href = "back-end/modelsUser/configuracoes.php";
    });
    document.getElementById("logout-btn").addEventListener("click", function () {
        window.location.href = "back-end/login/logout.php";
    });
    document.getElementById("list-btn").addEventListener("click", function () {
        window.location.href = "back-end/modelsUser/listaItems.php";
    });

    document.getElementById("add-btn").addEventListener("click", function () {
        window.location.href = "back-end/modelsUser/dashboard.php";
    });

    var modal = document.getElementById("settings-modal");
    var settingsIcon = document.getElementById("settings-icon");
    var closeBtn = document.getElementsByClassName("close")[0];

    settingsIcon.onclick = function () {
        modal.style.display = "block";
    }

    closeBtn.onclick = function () {
        modal.style.display = "none";
    }

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
  </script>
</body>
</html>
