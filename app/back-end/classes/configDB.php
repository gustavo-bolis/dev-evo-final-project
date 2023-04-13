<?php
require_once '../DB/mysqlConnection.php';

class Rendimento {
    private $pdo;

    public function __construct() {
        $this->pdo = Conexao::conectar();
    }

    // Método para inserir um rendimento
    public function insertRendimento($custoEnergia, $valor, $moeda) {
        $sql = "INSERT INTO rendimento (custoenergia, valor, moeda) VALUES (:custoenergia, :valor, :moeda)";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':custoenergia', $custoEnergia, PDO::PARAM_STR);
        $stmt->bindParam(':valor', $valor, PDO::PARAM_STR);
        $stmt->bindParam(':moeda', $moeda, PDO::PARAM_STR);

        try {
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            die("Insert Failed: " . $e->getMessage());
        }
    }

    // Método para selecionar todos os rendimentos
    public function selectAllRendimentos() {
        $sql = "SELECT * FROM rendimento";
        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Select All Failed: " . $e->getMessage());
        }
    }

    // Método para excluir rendimento por ID
    public function deleteRendimento($id) {
        $sql = "DELETE FROM rendimento WHERE id = :id";
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
