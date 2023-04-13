<?php
require_once '../login/sessao.php';
validaSessao();

require_once '../classes/configDB.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $rendimentoObj = new Rendimento();

    $id = $_GET['id'];
    $result = $rendimentoObj->deleteRendimento($id);
    if ($result) {
        header('Location: configuracoes.php?deleted='.$id);
        exit;
    } else {
        header('Location: configuracoes.php?falha');
    }
}
