<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dark Mode Example</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl7/0UzDJr6ApR0s1Jr59PktU5w/ELY6Nq9WflgL3l" crossorigin="anonymous">
    <style>
body {
    background-color: #333;
      color: #fff;
      font-family: Arial, sans-serif;
    }

    .container {
    display: flex;
    flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    button {
    background-color: #444;
      color: #fff;
      border: none;
      padding: 10px 20px;
      margin: 10px;
      cursor: pointer;
      font-size: 16px;
    }

    button:hover {
    background-color: #555;
    }

    #settings-icon {
        font-size: 24px;
        line-height: 0.6;
        writing-mode: vertical-rl;
        cursor: pointer;
        position: absolute;
        top: 10px;
        right: 10px;
    }

    /* Modal */
    .modal {
    display: none;
    position: fixed;
    z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
    background-color: #333;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
    }

    .close {
    color: #aaa;
    float: right;
    font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
    color: #000;
    text-decoration: none;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="container">
    <button id="list-btn">Listar</button>
    <button id="add-btn">Adicionar</button>
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
      window.location.href = "listaUsuarios.php";
    });
    document.getElementById("config-btn").addEventListener("click", function () {
      window.location.href = "configuracoes.php";
          });
    // app/back-end/login/logout.php
    // app/index.php
    document.getElementById("logout-btn").addEventListener("click", function () {
        window.location.href = "back-end/login/logout.php";
    });
    document.getElementById("list-btn").addEventListener("click", function () {
        window.location.href = "listaItems.php";
    });

    document.getElementById("add-btn").addEventListener("click", function () {
        window.location.href = "adicionaItem.php";
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
