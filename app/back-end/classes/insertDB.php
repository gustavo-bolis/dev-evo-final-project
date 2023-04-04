<?php
require_once 'DatabaseConnection.php';

class gpu {
    private $dbConnection;

    public function __construct() {
        $this->dbConnection = new DatabaseConnection();
    }

    public function insertGpu($name, $brand, $tdp, $hashPerSec, $mem_size) {
        $pdo = $this->dbConnection->getPdo();
        $sql = "INSERT INTO GPU (name, brand, tdp, hashPerSec, mem_size) VALUES (:name, :brand, :tdp, :hashPerSec, :mem_size)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
        $stmt->bindParam(':tdp', $tdp, PDO::PARAM_INT);
        $stmt->bindParam(':hash', $hashPerSec, PDO::PARAM_STR);
        $stmt->bindParam(':mem_size', $mem_size, PDO::PARAM_INT);

        try {
            $stmt->execute();
            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            die("Insert Failed: " . $e->getMessage());
        }
    }
}