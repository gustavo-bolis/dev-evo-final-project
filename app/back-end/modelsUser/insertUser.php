<?php
require_once '../login/sessao.php';
validaSessao();

require_once '../classes/usersDB.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuarioObj = new Usuarios();

    $id = isset($_POST['id']) && !empty($_POST['id']) ? $_POST['id'] : null;
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if ($id) {
        // Atualizar usuário existente
        $result = $usuarioObj->updateUsuario($id, $nome, $email, $senha);
        $newUsuario = true;
    } else {
        // Inserir novo usuário
        $result = $usuarioObj->insertUsuario($nome, $email, $senha);
        $newId = $usuarioObj->getPDO()->lastInsertId();
        $newUsuario = false;
    }

    if ($result) {
        header('Location: listaUsers.php?' . ($newUsuario ? "updated=" . $id : "added=" . $newId));
        exit();
    } else {
        echo "Erro ao " . ($id ? "atualizar" : "inserir") . " registro.";
    }
}
