<?php
session_start();

// Comprobar que viene del paso correcto
if (!isset($_SESSION['cliente_mapfre']) || $_SESSION['cliente_mapfre'] !== 'si') {
    header('Location: step6.php');
    exit;
}

$progreso = 75;
$stepAnterior = "step6.php";
$stepSiguiente = "step7.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tipo_documento']) && isset($_POST['numero_documento'])) {
        $_SESSION['tipo_documento'] = $_POST['tipo_documento'];
        $_SESSION['numero_documento'] = $_POST['numero_documento'];

        header('Location: step7.php');
        exit;
    }
}

require_once __DIR__ . '/../includes/header.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="../assets/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="noOverflow">

    <div class="progress-container-custom">
        <a href="<?= $stepAnterior ?>" class="flecha">&#8592;</a>

        <div class="progress-bar-custom">
            <div class="progress-custom" style="width: <?= $progreso ?>%;"></div>
        </div>

        <?php if (isset($_SESSION['tipo_documento']) && isset($_SESSION['numero_documento'])): ?>
        <a href="<?= $stepSiguiente ?>" class="flecha">&#8594;</a>
        <?php else: ?>
        <span class="flecha desactivada">&#8594;</span>
        <?php endif; ?>
    </div>

    <div class="container">
        <h1>Documento de identidad</h1>

        <form action="" method="POST" id="docForm">
            <div class="tab_buttons">
                <button type="button" id="btnNIF" class="tab" onclick="selectDoc('NIF')">NIF (Persona física)</button>
                <button type="button" id="btnNIE" class="tab" onclick="selectDoc('NIE')">NIE (Extranjeros)</button>
            </div>

            <input class="input_generic" type="hidden" name="tipo_documento" id="tipo_documento"
                value="<?= isset($_SESSION['tipo_documento']) ? htmlspecialchars($_SESSION['tipo_documento']) : 'NIF' ?>">

            <div class="input-block">
                <input class="input_generic" type="text" name="numero_documento" id="numero_documento"
                    placeholder="Introduce tu documento" required style="width: 100%; padding: 10px; font-size: 1.2em;"
                    value="<?= isset($_SESSION['numero_documento']) ? htmlspecialchars($_SESSION['numero_documento']) : '' ?>">
            </div>

            <button type="submit" id="btnAceptar" class="disabled" disabled>ACEPTAR</button>
        </form>
    </div>

    <script>
    function selectDoc(tipo) {
        document.getElementById('tipo_documento').value = tipo;
        document.getElementById('btnNIF').classList.remove('active');
        document.getElementById('btnNIE').classList.remove('active');

        if (tipo === 'NIF') {
            document.getElementById('btnNIF').classList.add('active');
        } else if (tipo === 'NIE') {
            document.getElementById('btnNIE').classList.add('active');
        }

        updatePlaceholder();
    }

    function updatePlaceholder() {
        const tipo = document.getElementById('tipo_documento').value;
        const input = document.getElementById('numero_documento');

        if (tipo === 'NIF') {
            input.placeholder = 'Ej: 12345678A';
        } else if (tipo === 'NIE') {
            input.placeholder = 'Ej: X1234567B';
        }
    }

    // Habilitar el botón ACEPTAR si el campo no está vacío
    document.getElementById('numero_documento').addEventListener('input', function() {
        const btnAceptar = document.getElementById('btnAceptar');
        if (this.value.trim().length > 0) {
            btnAceptar.classList.remove('disabled');
            btnAceptar.disabled = false;
        } else {
            btnAceptar.classList.add('disabled');
            btnAceptar.disabled = true;
        }
    });

    // Al cargar la página, marcar el botón correcto y actualizar placeholder
    window.onload = function() {
        <?php if (isset($_SESSION['tipo_documento'])): ?>
        selectDoc('<?= $_SESSION['tipo_documento'] ?>');
        <?php else: ?>
        selectDoc('NIF'); // por defecto
        <?php endif; ?>
    };
    </script>

    <?php require_once __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>