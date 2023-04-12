<?php
require_once '../login/sessao.php';
validaSessao();

require_once '../classes/insertDB.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gpuObj = new gpu();

    $id = isset($_POST['id']) && !empty($_POST['id']) ? $_POST['id'] : null;
    $nome = $_POST['nome'];
    $fabricante = $_POST['fabricante'];
    $tdp = $_POST['tdp'];
    $rendimento = $_POST['rendimento'];
    $memsize = $_POST['memsize'];

    if ($id) {
        // Atualizar GPU existente
        $result = $gpuObj->updateGpu($id, $nome, $fabricante, $tdp, $rendimento, $memsize);
        $newGpu = true;
    } else {
        // Inserir nova GPU
        $result = $gpuObj->insertGpu($nome, $fabricante, $tdp, $rendimento, $memsize);
        $newId = $gpuObj->getPDO()->lastInsertId();
        $newGpu = false;
    }

    if ($result) {
        header('Location: listaItems.php?' . ($newGpu ? "updated=" . $id : "added=" . $newId));
        exit();
    } else {
        echo "Erro ao " . ($id ? "atualizar" : "inserir") . " registro.";
    }
}
