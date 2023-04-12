<?php
require_once '../login/sessao.php';
validaSessao();

require_once '../classes/insertDB.php';
$gpuObj = new gpu();

$id = isset($_GET['id']) ? $_GET['id'] : null;
$gpuData = [
    'id' => '',
    'nome' => '',
    'fabricante' => '',
    'tdp' => '',
    'rendimento' => '',
    'memsize' => ''
];

if ($id) {
    $gpuData = $gpuObj->selectGpu($id);
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="add.css">
    <title><?php echo $id ? 'Editar' : 'Adicionar'; ?> GPU</title>
</head>
<body>
<form method="post" action="insert.php">
    <h1><?php echo $id ? 'Editar' : 'Adicionar'; ?> GPU</h1>
    <input type="hidden" name="id" value="<?php echo $gpuData['id']; ?>">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome" value="<?php echo $gpuData['nome']; ?>" required>
    <div class="form-row">
        <label for="fabricante">Fabricante:</label>
        <select name="fabricante" id="fabricante" required>
            <option value="NVIDIA" <?php echo $gpuData['fabricante'] == 'NVIDIA' ? 'selected' : ''; ?>>NVIDIA</option>
            <option value="AMD" <?php echo $gpuData['fabricante'] == 'AMD' ? 'selected' : ''; ?>>AMD</option>
            <option value="INTEL" <?php echo $gpuData['fabricante'] == 'INTEL' ? 'selected' : ''; ?>>INTEL</option>
        </select>
    </div>
    <div class="input-group">
        <label for="tdp">TDP:</label>
        <div class="input-wrapper">
            <input class="half-width" type="number" name="tdp" id="tdp" value="<?php echo $gpuData['tdp']; ?>" required>
            <span data-unit="Watts"><?php echo $gpuData['tdp'] ? $gpuData['tdp'].' Watts' : 'Watts'; ?></span>
        </div>
        <!--    </div>-->
        <!--    <div class="input-group">-->
        <label for="rendimento">Rendimento:</label>
        <div class="input-wrapper">
            <input class="half-width" type="number" name="rendimento" id="rendimento" value="<?php echo $gpuData['rendimento']; ?>" required>
            <span data-unit="MH/s"><?php echo $gpuData['rendimento'] ? $gpuData['rendimento'].' MH/s' : 'MH/s'; ?></span>
        </div>
        <!--    </div>-->
        <!--    <div class="input-group">-->
        <label for="memsize">Memória:</label>
        <div class="input-wrapper">
            <input class="half-width" type="number" name="memsize" id="memsize" value="<?php echo $gpuData['memsize']; ?>" required>
            <span data-unit="Mb"><?php echo $gpuData['memsize'] ? $gpuData['memsize'].' Mb' : 'Mb'; ?></span>
        </div>
    </div>
    <div class="button-container">
        <button type="submit"><?php echo $id ? 'Salvar Alterações' : 'Adicionar GPU'; ?></button>
        <button onclick="location.href='listaItems.php'">Voltar</button>
    </div>
</form>
<script>
    document.querySelectorAll('.input-wrapper input[type="number"]').forEach(input => {
        input.addEventListener('input', event => {
            const wrapper = event.target.parentNode;
            const span = wrapper.querySelector('span');
            const unit = span.getAttribute('data-unit');
            span.textContent = event.target.value ? event.target.value + ' ' + unit : unit;
        });
    });

    const fabricanteSelect = document.getElementById('fabricante');

    function atualizarCorDoSeletor() {
        if (fabricanteSelect.value === 'NVIDIA') {
            fabricanteSelect.style.backgroundColor = '#17fd00'; // Verde
        } else if (fabricanteSelect.value === 'AMD') {
            fabricanteSelect.style.backgroundColor = '#ff0000'; // Vermelho
        }else if (fabricanteSelect.value === 'INTEL') {
            fabricanteSelect.style.backgroundColor = '#0034ff'; // Azul
        }
    }

    // Atualizar a cor do seletor com base na opção selecionada inicialmente
    atualizarCorDoSeletor();

    // Adicionar um ouvinte de evento para atualizar a cor do seletor quando a opção selecionada mudar
    fabricanteSelect.addEventListener('change', atualizarCorDoSeletor);

</script>
</body>
</html>

