<?php
require_once '../login/sessao.php';
validaSessao();

require_once '../classes/usersDB.php';
$usuarioObj = new Usuarios();

$id = isset($_GET['id']) ? $_GET['id'] : null;
$usuarioData = [
    'id' => '',
    'name' => '',
    'user' => '',
    'password' => ''
];

if ($id) {
    $usuarioData = $usuarioObj->selectUsuario($id);
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="add.css">
    <title><?php echo $id ? 'Editar' : 'Adicionar'; ?> Usuário</title>
</head>
<body>
<form method="post" action="insertUser.php">
    <h1><?php echo $id ? 'Editar' : 'Adicionar'; ?> Usuário</h1>
    <input type="hidden" name="id" value="<?php echo $usuarioData['id']; ?>">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome" value="<?php echo $usuarioData['name']; ?>" required autofocus>
    <label for="email">Usuário:</label>
    <input type="text" name="email" id="email" value="<?php echo $usuarioData['user']; ?>" required>
    <label for="senha">Senha:</label>
    <input type="password" name="senha" id="senha" placeholder="Insira a nova senha" required>
    <div class="button-container">
        <button type="submit"><?php echo $id ? 'Salvar Alterações' : 'Adicionar Usuário'; ?></button>
        <button onclick="location.href='listaUsers.php'">Voltar</button>
    </div>
</form>
</body>
</html>
