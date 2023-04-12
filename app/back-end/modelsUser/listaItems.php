<?php
require_once '../classes/insertDB.php';

$gpuObj = new gpu();
$allGpus = $gpuObj->selectAllGpus();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="lista.css">
    <title>GPUs</title>
    <div id="aviso" class="aviso oculto"></div>
</head>
<body>
<h1>Lista de GPUs</h1>
<table>
    <thead>
    <tr>
        <th class="id-column">ID</th>
        <th>Nome</th>
        <th>Fabricante</th>
        <th>TDP</th>
        <th>Hashs/s</th>
        <th>Memória</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($allGpus as $gpu) : ?>
        <tr class="<?php echo strtolower($gpu['fabricante']); ?>">
            <td class="id-column"><?php echo $gpu['id']; ?></td>
            <td><?php echo $gpu['nome']; ?></td>
            <td><?php echo $gpu['fabricante']; ?></td>
            <td><?php echo $gpu['tdp']." W"; ?></td>
            <td><?php echo $gpu['rendimento']." MH/s"; ?></td>
            <td><?php echo $gpu['memsize']." Mb"; ?></td>
            <td>
                <button onclick="location.href='add_Edit.php?id=<?php echo $gpu['id']; ?>'">Editar</button>
                <form method="post" action="delete.php" id="delete-form-<?php echo $gpu['id']; ?>">
                    <input type="hidden" name="id" value="<?php echo $gpu['id']; ?>">
                    <button type="button" onclick="confirmDeletion(<?php echo $gpu['id']; ?>)">Deletar</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    <?php
    $totalW = 0;
    $totalH = 0;
    foreach ($allGpus as $gpu) {
        $totalW += $gpu['tdp'];
        $totalH += $gpu['rendimento'];
    }
    echo "<tr>";
    echo "<td colspan='3'></td>";
    echo "<td>"."Total Watts: " . $totalW ."</td>". PHP_EOL;
    echo "<td class='hash-column'>"."Total Hashs/s: " . $totalH ."</td>". PHP_EOL;
    echo "<td></td>";
    echo "</tr>";
    ?>
    </tbody>
</table>
<button onclick="location.href='add_Edit.php'">Adicionar GPU</button>
<button id="duplicar-btn">Duplicar GPU</button>
<div id="duplicar-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Duplicar GPU</h2>
        <form id="duplicar-form">
            <label for="gpu-id">Selecione o ID da GPU para duplicar:</label>
            <select name="gpu-id" id="gpu-id">
                <?php foreach ($allGpus as $gpu) : ?>
                    <option value="<?php echo $gpu['id']; ?>"><?php echo $gpu['id']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Duplicar GPU</button>
        </form>
    </div>
</div>
<script>
    function confirmDeletion(id) {
        const confirmation = confirm('Deseja realmente deletar o registro ID: ' + id + '?');
        if (confirmation) {
            window.location.href = "delete.php?id=" + id;
        }
    }
    const avisoEl = document.querySelector('#aviso');

    function exibirAviso(mensagem, tipo) {
        avisoEl.textContent = mensagem;
        if (tipo === 'delete') {
            avisoEl.classList.add('aviso-delete');
        } else {
            avisoEl.classList.remove('aviso-delete');
        }
        if (tipo === 'duplicado') {
            avisoEl.classList.add('aviso-duplicado');
        } else {
            avisoEl.classList.remove('aviso-duplicado');
        }
        avisoEl.classList.remove('oculto');
        setTimeout(() => {
            avisoEl.classList.add('oculto');
            avisoEl.textContent = '';
        }, 5000); // Tempo em milissegundos (5 segundos)
    }

    const duplicarBtn = document.getElementById("duplicar-btn");
    const duplicarModal = document.getElementById("duplicar-modal");
    const duplicarForm = document.getElementById("duplicar-form");
    const closeModal = document.querySelector(".close");

    duplicarBtn.onclick = function () {
        duplicarModal.style.display = "block";
    };

    closeModal.onclick = function () {
        duplicarModal.style.display = "none";
    };

    window.onclick = function (event) {
        if (event.target == duplicarModal) {
            duplicarModal.style.display = "none";
        }
    };
    duplicarForm.addEventListener("submit", function (event) {
        event.preventDefault();
        const gpuId = document.getElementById("gpu-id").value;
        if (gpuId) {
            window.location.href = `duplicateGpu.php?id=${gpuId}`;
        } else {
            alert("Selecione um ID de GPU válido.");
        }
    });
</script>
</body>
</html>
<?php
if (isset($_GET['deleted'])) {
    $id = $_GET['deleted'];
    echo "<script>exibirAviso('Registro $id excluído com sucesso.', 'delete');</script>";
}elseif (isset($_GET['updated'])){
    $id = $_GET['updated'];
    echo "<script>exibirAviso('Registro $id alterado com sucesso.');</script>";
}elseif (isset($_GET['added'])){
    $id = $_GET['added'];
    echo "<script>exibirAviso('Registro $id adicionado com sucesso.');</script>";
}elseif (isset($_GET['duplicated'])){
    $id = $_GET['duplicated'];
    $idNew = $_GET['new'];
    echo "<script>exibirAviso('Duplicado $id novo registro ID: $idNew', 'duplicado');</script>";
}
?>
