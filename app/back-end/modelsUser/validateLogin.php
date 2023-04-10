<?php
$user = $_POST['email'];
$password = $_POST['senha'];
require_once('../DB/mysqlConnection.php');

class Login {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexao::conectar();
    }

    public function validarLogin($user, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE user = :user AND password = :password");
        $stmt->bindValue(':user', $user);
        $stmt->bindValue(':password', $password);
        $stmt->execute();
        $result = $stmt->fetch();

        if ($result) {
            // Login e senha corretos
            return true;
        } else {
            // Login e/ou senha incorretos
            return false;
        }
    }

}

$login = new Login();
if ($login->validarLogin($user, $password)) {
    header("Location: ../../index.php");
    exit;
} else {
    header("Location: ../login.php?erro=1");
    exit;
}

?>
