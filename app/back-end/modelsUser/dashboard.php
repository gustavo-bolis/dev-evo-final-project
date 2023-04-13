<?php
require_once '../login/sessao.php';
validaSessao();

require_once '../classes/configDB.php';
$rendimentoObj = new Rendimento();
$allRendimentos = $rendimentoObj->selectAllRendimentos();

require_once '../classes/insertDB.php';
$gpuObj = new gpu();
$allGpus = $gpuObj->selectAllGpus();


$totalW = 0;
$totalH = 0;
foreach ($allGpus as $gpu) {
    $totalW += $gpu['tdp'];
    $totalH += $gpu['rendimento'];
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="lista.css">
    <title>Lucratividade</title>
    <div id="aviso" class="aviso oculto"></div>
</head>
<body>
<h1>Lucratividade</h1>
<table>
    <thead>
    <tr>
        <th class="id-column">ID</th>
        <th>Moeda</th>
        <th>Custo Energia mensal</th>
        <th>Rendimento mensal</th>
        <th>Lucro mensal esperado</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($allRendimentos as $rendimento) : ?>
        <tr>
            <td class="id-column"><?php echo $rendimento['id']; ?></td>
            <td><?php echo $rendimento['moeda']; ?></td>
            <td><?php echo number_format($totalW * ($rendimento['custoenergia'] / 100) * 30 * 24 / 1000, 2); ?></td>
            <td><?php echo (($totalH / 1000) * $rendimento['valor']); ?></td>
            <td><?php echo ((($totalH / 1000) * $rendimento['valor']) - ($totalW * ($rendimento['custoenergia'] / 100) * 30 * 24 / 1000)); ?></td>
            <td>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<button onclick="location.href='../../index.php'">Voltar</button>

</body>
</html>

