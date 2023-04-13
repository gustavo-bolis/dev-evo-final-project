<?php
require_once '../login/sessao.php';
validaSessao();

require_once '../classes/configDB.php';

$rendimentoObj = new Rendimento();
$allRendimentos = $rendimentoObj->selectAllRendimentos();

?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="lista.css">
        <title>Rendimento</title>
        <div id="aviso" class="aviso oculto"></div>
    </head>
    <body>
    <h1>Lista de Rendimentos</h1>
    <table>
        <thead>
        <tr>
            <th class="id-column">ID</th>
            <th>Custo Energia</th>
            <th>Valor</th>
            <th>Moeda</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($allRendimentos as $rendimento) : ?>
            <tr>
                <td class="id-column"><?php echo $rendimento['id']; ?></td>
                <td><?php echo $rendimento['custoenergia']; ?></td>
                <td><?php echo $rendimento['valor']; ?></td>
                <td><?php echo $rendimento['moeda']; ?></td>
                <td>
                    <div class="button-container">
                        <form method="post" action="deleteRendimento.php" id="delete-form-<?php echo $rendimento['id']; ?>">
                            <input type="hidden" name="id" value="<?php echo $rendimento['id']; ?>">
                            <button type="button" onclick="confirmDeletion(<?php echo $rendimento['id']; ?>)">Deletar</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <button onclick="location.href='addRendimento.php'">Adicionar Rendimento</button>
    <button onclick="location.href='../../index.php'">Voltar</button>

    <script>
        function confirmDeletion(id) {
            const confirmation = confirm('Deseja realmente deletar o registro ID: ' + id + '?');
            if (confirmation) {
                window.location.href = "deleteRendimento.php?id=" + id;
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
}elseif (isset($_GET['added'])){
    $id = $_GET['added'];
    echo "<script>exibirAviso('Registro $id adicionado com sucesso.');</script>";
}elseif (isset($_GET['falha'])){
    echo "<script>exibirAviso('Falha ao excluir registro.', 'falha');</script>";
}
?>