<?php

require_once('../DB/mysqlConnection.php');

class Login {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexao::conectar();
    }

    public function validarLogin($user, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM tabela_nome WHERE user = :user AND password = :password");
        $stmt->bindValue(':user', $user);
        $stmt->bindValue(':password', $password);
        $stmt->execute();
        $result = $stmt->fetch();

        if ($result) {
            echo "deu boa";
            // Login e senha corretos
            return true;
        } else {
            echo "deu ruim";
            // Login e/ou senha incorretos
            return false;
        }
    }

}
?>
