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
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
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
            <td><?php echo $gpu['tdp']; ?></td>
            <td><?php echo $gpu['rendimento']; ?></td>
            <td><?php echo $gpu['mem_size']; ?></td>
            <td>
                <button onclick="location.href='/back-end/modelsUser/add_Edit.php?id=<?php echo $gpu['id']; ?>'">Editando</button>
                <button onclick="location.href='delete.php?id=<?php echo $gpu['id']; ?>'">Deletar</button>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<button onclick="location.href='add.php'">Adicionar GPU</button>
</body>
</html>