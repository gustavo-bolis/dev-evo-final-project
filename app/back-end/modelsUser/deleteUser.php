<?php
require_once '../login/sessao.php';
validaSessao();

require_once '../classes/usersDB.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
$usuarioObj = new Usuarios();

$id = $_GET['id'];
$result = $usuarioObj->deleteUsuario($id);
if ($result) {
header('Location: listaUsers.php?deleted='.$id);
exit;
} else {
    header('Location: listaUsers.php?falha');
}

}
