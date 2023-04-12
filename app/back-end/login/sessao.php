<?php
session_start();

function validaSessao() {
    if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
        // Redirecionar para a página de login
        header('Location: ../login.php');
        exit;
    }
}
?>
