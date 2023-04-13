<?php
require_once '../login/sessao.php';
validaSessao();

require_once '../classes/configDB.php';

$rendimentoObj = new Rendimento();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $custoenergia = $_POST["custoenergia"];
    $valor = $_POST["valor"];
    $moeda = $_POST["moeda"];

    $rendimentoObj->insertRendimento($custoenergia, $valor, $moeda);

    header("Location: configuracoes.php?added={$rendimentoObj->getPDO()->lastInsertId()}");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="add.css">
    <title>Adicionar Rendimento</title>
</head>
<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <h1>Adicionar Rendimento</h1>
    <label for="custoenergia">Custo de energia:</label>
    <input type="text" name="custoenergia" id="custoenergia" required autofocus placeholder="valor por kw/h em centavos">
    <label for="valor">Valor:</label>
    <input type="text" name="valor" id="valor" required placeholder="Lucro por cada 1 Gigahash por segundo">
    <label for="moeda">Moeda:</label>
    <input type="text" name="moeda" id="moeda" required>
    <div class="button-container">
        <button type="submit">Adicionar Rendimento</button>
        <button onclick="location.href='configuracoes.php'">Voltar</button>
    </div>
</form>
</body>
</html>
