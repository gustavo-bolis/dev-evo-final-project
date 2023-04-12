<?php
session_start();

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
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function countLogin() {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios");
        $stmt->execute();
        return $stmt->rowCount();
    }

}

$login = new Login();
$userInit = $login->countLogin();
if ($userInit == 0) {
    header("Location: ../login/initUser.php");
}
$result = $login->validarLogin($user, $password);
if ($result) {
    $_SESSION['user_id'] = $result['id'];
    $_SESSION['username'] = $result['user'];
    $_SESSION['logado'] = true;
    header("Location: ../../index.php");
    exit;
} else {
    header("Location: ../../login.php?erro=1");
    exit;
}

?>
