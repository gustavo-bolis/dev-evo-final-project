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
    <title>GPUs</title>
    <div id="aviso" class="aviso oculto"></div>
    <style>
        body {
            background-color: #212121;
            color: #f5f5f5;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #4f4f4f;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        .aviso {
            position: fixed;
            top: 90%;
            left: 85%;
            width: 10%;
            padding: 10px;
            background-color: #17fd00;
            color: black;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            border-radius: 10px;
            animation: subir-descer 2s ease-in-out;
        }

        .aviso-delete {
            background-color: #FFCC00;
        }

        .oculto {
            display: none;
        }

        .id-column {
            width: 50px; /* ajuste o valor conforme necessário */
        }

        .nvidia {
            background-color: rgba(23, 253, 0, 0.2); /* Verde */
        }

        .amd {
            background-color: rgba(255, 0, 0, 0.2); /* Vermelho */
        }

        .intel {
            background-color: rgba(0, 48, 250, 0.2); /* Azul */
        }

        @keyframes subir-descer {
            0% {
                transform: translateY(-100%);
            }
            50% {
                transform: translateY(10%);
            }
            100% {
                transform: translateY(0%);
            }
        }

    </style>
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
<script>
    function confirmDeletion(id) {
        const confirmation = confirm('Deseja realmente deletar o registro ID: ' + id + '?');
        if (confirmation) {
            window.location.href = "delete.php?id=" + id;
        }
    }
    // Seleciona o elemento de aviso
    const avisoEl = document.querySelector('#aviso');

    // Função para exibir uma mensagem de aviso
    function exibirAviso(mensagem, tipo) {
        // Define o texto do aviso
        avisoEl.textContent = mensagem;

        if (tipo === 'delete') {
            avisoEl.classList.add('aviso-delete');
        } else {
            avisoEl.classList.remove('aviso-delete');
        }

        // Remove a classe 'oculto' para exibir o aviso
        avisoEl.classList.remove('oculto');

        // Define um tempo de espera para remover o aviso
        setTimeout(() => {
            // Adiciona a classe 'oculto' para ocultar o aviso novamente
            avisoEl.classList.add('oculto');
            // Remove o texto do aviso
            avisoEl.textContent = '';
        }, 5000); // Tempo em milissegundos (5 segundos)
    }
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
}
?>
