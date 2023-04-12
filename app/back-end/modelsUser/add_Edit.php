<?php
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
    <title><?php echo $id ? 'Editar' : 'Adicionar'; ?> GPU</title>
    <style>
        body {
            background-color: #212121;
            color: #f5f5f5;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            display: block;
            width: 100%;
            text-align: left;
        }

        input.full-width {
            width: 300px;
        }

        input.half-width {
            width: 150px;
        }

        input {
            background-color: #303030;
            color: #f5f5f5;
            border: none;
            padding: 10px;
            width: 300px;
            margin-bottom: 15px;
            border-radius: 5px;
            outline: none;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        button {
            background-color: #303030;
            color: #f5f5f5;
            border: none;
            padding: 10px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #4f4f4f;
        }

        .input-wrapper {
            display: flex;
            align-items: center;
            position: relative;
            margin-bottom: 15px;
            width: 100%;
        }

        .input-wrapper input {
            width: 260px;
            color: transparent;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 300px;
            margin-bottom: 15px;
        }

        .input-wrapper span {
            position: absolute;
            left: 0;
            width: 100%;
            overflow: hidden;
            white-space: nowrap;
            pointer-events: none;
            padding-left: 5px; /* Ajuste o valor de acordo com o padding do input */
        }

        .form-row {
            display: flex;
            align-items: center;
        }

        .form-row label {
            margin-right: 10px;
        }

        #fabricante {
            background-color: #17fd00;
        }

        .input-wrapper input::-webkit-inner-spin-button,
        .input-wrapper input::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
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

