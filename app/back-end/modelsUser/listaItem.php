<?php

class ItemList {

    public function fetchItems() {
        $conexao = new Conexao();
        $pdo = $conexao->getPdo();

        // Realizar consulta (SELECT) na tabela 'items'
        $sql = "SELECT * FROM items";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        // Listar todos os itens
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $items;
    }
}

// Exemplo de uso
$itemList = new ItemList();
$items = $itemList->fetchItems();

foreach ($items as $item) {
    echo "ID: " . $item['id'] . "<br>";
    echo "Nome: " . $item['nome'] . "<br>";
    echo "Descrição: " . $item['descricao'] . "<br>";
    echo "<hr>";
}

}