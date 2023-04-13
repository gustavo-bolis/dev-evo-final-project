<?php
require_once '../DB/mysqlConnection.php';

class Usuarios {
    private $pdo;

    public function __construct() {
        $this->pdo = Conexao::conectar();
    }

    // Método para inserir um usuário
    public function insertUsuario($name, $user, $password) {
        $sql = "INSERT INTO usuarios (name, user, password) VALUES (:name, :user, :password)";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':user', $user, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);

        try {
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            die("Insert Failed: " . $e->getMessage());
        }
    }

    // Método para selecionar todos os usuários
    public function selectAllUsuarios() {
        $sql = "SELECT * FROM usuarios";
        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Select All Failed: " . $e->getMessage());
        }
    }

    // Método para selecionar usuário por ID
    public function selectUsuario($id) {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Select Failed: " . $e->getMessage());
        }
    }

    // Método para atualizar usuário por ID
    public function updateUsuario($id, $name, $user, $password) {
        $sql = "UPDATE usuarios SET name = :name, user = :user, password = :password WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':user', $user, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);

        try {
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            die("Update Failed: " . $e->getMessage());
        }
    }

    // Método para excluir usuário por ID
    public function deleteUsuario($id) {
        // Checar quantos usuários existem no banco de dados
        $sql = "SELECT COUNT(*) as total FROM usuarios";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalUsuarios = (int) $result['total'];

        if ($totalUsuarios > 1) {
            // Deletar usuário somente se houver mais de um usuário no banco de dados
            $sql = "DELETE FROM usuarios WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            try {
                $stmt->execute();
                return $stmt->rowCount();
            } catch (PDOException $e) {
                die("Delete Failed: " . $e->getMessage());
            }
        } else {
            // Não deletar usuário se houver somente um usuário no banco de dados
            return false;
        }
    }

    public function getPDO() {
        return $this->pdo;
    }
}
