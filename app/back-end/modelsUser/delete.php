<?php
require_once '../login/sessao.php';
validaSessao();

require_once '../classes/insertDB.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $gpuObj = new gpu();

    $id = $_GET['id'];
    $result = $gpuObj->deleteGpu($id);
    if ($result) {
        header('Location: listaItems.php?deleted='.$id);
        exit;
    } else {
        echo "Erro ao Deletar registro ID: ". $id. PHP_EOL;
    }

}