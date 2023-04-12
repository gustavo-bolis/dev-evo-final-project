<?php
require_once '../DB/mysqlConnection.php';

class gpu {
    private $pdo;

    public function __construct() {
        $this->pdo = Conexao::conectar();
    }
    //Metodo para inserir a GPU
    public function insertGpu($nome, $fabricante, $tdp, $rendimento, $memsize) {
        $sql = "INSERT INTO gpu (nome, fabricante, tdp, rendimento, memsize) VALUES (:nome, :fabricante, :tdp, :rendimento, :memsize)";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':fabricante', $fabricante, PDO::PARAM_STR);
        $stmt->bindParam(':tdp', $tdp, PDO::PARAM_INT);
        $stmt->bindParam(':rendimento', $rendimento, PDO::PARAM_STR);
        $stmt->bindParam(':memsize', $memsize, PDO::PARAM_INT);

        try {
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            die("Insert Failed: " . $e->getMessage());
        }
    }

    // Método para selecionar todas as GPUs
    public function selectAllGpus() {
        $sql = "SELECT * FROM gpu";
        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Select All Failed: " . $e->getMessage());
        }
    }

    // Método para selecionar GPU por ID
    public function selectGpu($id) {
        $sql = "SELECT * FROM gpu WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Select Failed: " . $e->getMessage());
        }
    }

    // Método para atualizar GPU por ID
    public function updateGpu($id, $nome, $fabricante, $tdp, $rendimento, $memsize) {
        $sql = "UPDATE gpu SET nome = :nome, fabricante = :fabricante, tdp = :tdp, rendimento = :rendimento, memsize = :memsize WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':fabricante', $fabricante, PDO::PARAM_STR);
        $stmt->bindParam(':tdp', $tdp, PDO::PARAM_INT);
        $stmt->bindParam(':rendimento', $rendimento, PDO::PARAM_STR);
        $stmt->bindParam(':memsize', $memsize, PDO::PARAM_INT);

        try {
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            die("Update Failed: " . $e->getMessage());
        }
    }

    // Método para excluir GPU por ID
    public function deleteGpu($id) {
        $sql = "DELETE FROM gpu WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        try {
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            die("Delete Failed: " . $e->getMessage());
        }
    }

    public function getPDO() {
        return $this->pdo;
    }
}