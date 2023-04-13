<?php
require_once('../DB/mysqlConnection.php');

class validaUserInit {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexao::conectar();
    }

    public function insertUser($name, $user, $password) {
        $stmt = $this->pdo->prepare("INSERT INTO usuarios (name, user, password) VALUES (:name, :user, :password)");
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':user', $user);
        $stmt->bindValue(':password', $password);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function countLogin() {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios");
        $stmt->execute();
        return $stmt->rowCount();
    }

}

$login = new validaUserInit();
$userInit = $login->countLogin();
if ($userInit != 0) {
    header("Location: ../../login.php?exists");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['nome'];
    $user = $_POST['user'];
    $password = $_POST['password'];

    if ($login->insertUser($name, $user, $password)) {
        header("Location: ../../login.php");
        exit();
    } else {
        $error = "Erro ao cadastrar usuário.";
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="init.css">
    <title>Cadastro de Usuário</title>
</head>
<body>
<form method="post">
    <h1>Cadastro Usuário Inicial</h1>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" required autofocus>
    <label for="user">Usuário:</label>
    <input type="text" id="user" name="user" required>
    <label for="password">Senha:</label>
    <input type="password" id="password" name="password" required>
    <button type="submit">Cadastrar</button>
</form>
</body>
</html>
