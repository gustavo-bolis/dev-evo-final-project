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
    </style>
</head>
<body>
<h1>Lista de GPUs</h1>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Fabricante</th>
        <th>TDP</th>
        <th>Rendimento</th>
        <th>Memória</th>
        <th>Ações</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($allGpus as $gpu) : ?>
        <tr>
            <td><?php echo $gpu['id']; ?></td>
            <td><?php echo $gpu['nome']; ?></td>
            <td><?php echo $gpu['fabricante']; ?></td>
            <td><?php echo $gpu['tdp']." W"; ?></td>
            <td><?php echo $gpu['rendimento']." MH/s"; ?></td>
            <td><?php echo $gpu['memsize']." Mb"; ?></td>
            <td>
                <button onclick="location.href='edit.php?id=<?php echo $gpu['id']; ?>'">Editar</button>
                <button onclick="location.href='delete.php?id=<?php echo $gpu['id']; ?>'">Deletar</button>
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
    echo "<td>"."Total Watts: " . $totalW ."</td>". PHP_EOL;
    echo "<td>"."Total Hashs/s: " . $totalH ."</td>". PHP_EOL;
    ?>
    </tbody>
</table>
<button onclick="location.href='add.php'">Adicionar GPU</button>
</body>
</html>