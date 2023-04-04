<?php
require_once 'parametros_db.php';

class DatabaseConnection {
    private $pdo;

    public function __construct() {
        try {
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
            $this->pdo = new PDO($dsn, DB_USER, DB_PASSWORD);

            // Configura o modo de erro para lançar exceções
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Define o modo de recuperação padrão para objetos
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die("Connection Refused: " . $e->getMessage());
        }
    }

    public function getPdo() {
        return $this->pdo;
    }
}
