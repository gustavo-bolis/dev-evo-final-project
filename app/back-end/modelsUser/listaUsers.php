<?php
require_once '../login/sessao.php';
validaSessao();

require_once '../classes/usersDB.php';

$usuariosObj = new Usuarios();
$allUsuarios = $usuariosObj->selectAllUsuarios();
?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="lista.css">
        <title>Usuários</title>
        <div id="aviso" class="aviso oculto"></div>
    </head>
    <body>
    <h1>Lista de Usuários</h1>
    <table>
        <thead>
        <tr>
            <th class="id-column">ID</th>
            <th>Nome</th>
            <th>Usuário</th>
            <th>Senha</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($allUsuarios as $usuario) : ?>
            <tr>
                <td class="id-column"><?php echo $usuario['id']; ?></td>
                <td><?php echo $usuario['name']; ?></td>
                <td><?php echo $usuario['user']; ?></td>
                <td><?php echo "Senha Oculta"; ?></td>
                <td>
                    <div class="button-container">
                        <button onclick="location.href='add_EditUser.php?id=<?php echo $usuario['id']; ?>'">Editar</button>
                        <form method="post" action="deleteUser.php" id="delete-form-<?php echo $usuario['id']; ?>">
                            <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
                            <button type="button" onclick="confirmDeletion(<?php echo $usuario['id']; ?>)">Deletar</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <button onclick="location.href='add_EditUser.php'">Adicionar Usuário</button>
    <button onclick="location.href='../../index.php'">Voltar</button>

    <script>
        function confirmDeletion(id) {
            const confirmation = confirm('Deseja realmente deletar o registro ID: ' + id + '?');
            if (confirmation) {
                window.location.href = "deleteUser.php?id=" + id;
            }
        }
        const avisoEl = document.querySelector('#aviso');

        function exibirAviso(mensagem, tipo) {
            avisoEl.textContent = mensagem;
            if (tipo === 'falha') {
                avisoEl.classList.add('aviso-falha');
            } else {
                avisoEl.classList.remove('aviso-falha');
            }
            avisoEl.classList.remove('oculto');
            setTimeout(() => {
                avisoEl.classList.add('oculto');
                avisoEl.textContent = '';
            }, 5000); // Tempo em milissegundos (5 segundos)
        }

    </script>
    </body>
    </html>
<?php
if (isset($_GET['deleted'])) {
    $id = $_GET['deleted'];
    echo "<script>exibirAviso('Registro $id excluído com sucesso.');</script>";
}elseif (isset($_GET['updated'])){
    $id = $_GET['updated'];
    echo "<script>exibirAviso('Registro $id alterado com sucesso.');</script>";
}elseif (isset($_GET['added'])){
    $id = $_GET['added'];
    echo "<script>exibirAviso('Registro $id adicionado com sucesso.');</script>";
}elseif (isset($_GET['falha'])){
    $id = $_GET['falha'];
    echo "<script>exibirAviso('Não permitida exclusão de todos os usuários.', 'falha');</script>";
}
?>