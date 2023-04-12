<?php
require_once '../classes/insertDB.php';
$gpuObj = new gpu();

$id = $_GET['id'];
$gpuData = [
    'id' => '',
    'nome' => '',
    'fabricante' => '',
    'tdp' => '',
    'rendimento' => '',
    'memsize' => ''
];

if ($id) {
    $gpuData = $gpuObj->selectGpu($id);
}
    $result = $gpuObj->insertGpu($gpuData["nome"], $gpuData["fabricante"], $gpuData["tdp"], $gpuData["rendimento"], $gpuData["memsize"]);
    $newId = $gpuObj->getPDO()->lastInsertId();

if ($result) {
    header('Location: listaItems.php?duplicated='.$id.'&new='.$newId);
    exit();
} else {
    echo "Erro ao inserir registro.";
}