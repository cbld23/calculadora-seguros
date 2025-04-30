<?php
session_start();

if (!isset($_SESSION['fecha_inicio']) || !isset($_SESSION['codigo_postal']) || !isset($_SESSION['numero_asegurados'])) {
    header('Location: ../index.php');
    exit;
}

$progreso = 40;
$stepAnterior = "step3.php";
$stepSiguiente = "step5.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero_asegurados = $_SESSION['numero_asegurados'];
    $errores = [];

    for ($i = 1; $i <= $numero_asegurados; $i++) {
        $fecha_nacimiento = $_POST['nacimiento_' . $i];
        $sexo = $_POST['sexo_' . $i];
        $parentesco = $_POST['parentesco_' . $i] ?? null;

        $fecha_nac = DateTime::createFromFormat('Y-m-d', $fecha_nacimiento);
        $hoy = new DateTime();
        $edad = $fecha_nac ? $fecha_nac->diff($hoy)->y : null;

        if ($edad === null || $edad < 15) {
            $errores[$i] = "Debe tener al menos 15 años.";
        }

        $_SESSION['asegurado_' . $i] = [
            'nacimiento' => $fecha_nacimiento,
            'sexo' => $sexo,
            'parentesco' => $parentesco
        ];
    }

    if (!empty($errores)) {
        $_SESSION['errores_step4'] = $errores;
    } else {
        $datos_asegurados = [];
        for ($i = 1; $i <= $numero_asegurados; $i++) {
            $datos_asegurados[] = $_SESSION['asegurado_' . $i];
        }
        $_SESSION['datos_asegurados'] = json_encode($datos_asegurados);
        header('Location: ' . $stepSiguiente);
        exit;
    }
}

require_once __DIR__ . '/../includes/header.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script defer>
        function validarEdad(input, mensajeId) {
            const fechaInput = new Date(input.value);
            const hoy = new Date();
            const edad = hoy.getFullYear() - fechaInput.getFullYear();
            const mes = hoy.getMonth() - fechaInput.getMonth();
            const dia = hoy.getDate() - fechaInput.getDate();
            const mensaje = document.getElementById(mensajeId);

            let edadExacta = edad;
            if (mes < 0 || (mes === 0 && dia < 0)) edadExacta--;

            if (edadExacta < 15) {
                mensaje.style.display = 'block';
                input.classList.add('input-error');
            } else {
                mensaje.style.display = 'none';
                input.classList.remove('input-error');
            }
        }
    </script>
    <style>
        .error-msg {
            display: none;
            color: #d9534f;
            font-size: 0.9em;
            margin-top: 4px;
        }

        .input-error {
            border-color: #d9534f;
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="progress-container-custom">
        <a href="<?= $stepAnterior ?>" class="flecha">&#8592;</a>

        <div class="progress-bar-custom">
            <div class="progress-custom" style="width: <?= $progreso ?>%;"></div>
        </div>

        <?php
        $datosCompletos = true;
        for ($i = 1; $i <= $_SESSION['numero_asegurados']; $i++) {
            if (empty($_SESSION['asegurado_' . $i]['nacimiento']) || empty($_SESSION['asegurado_' . $i]['sexo']) || ($i > 1 && empty($_SESSION['asegurado_' . $i]['parentesco']))) {
                $datosCompletos = false;
                break;
            }
        }
        ?>
        <?php if ($datosCompletos): ?>
            <a href="<?= $stepSiguiente ?>" class="flecha">&#8594;</a>
        <?php else: ?>
            <span class="flecha desactivada">&#8594;</span>
        <?php endif; ?>
    </div>

    <div class="container">
        <div class="titulo-centrado">
            <h1>Datos de los asegurados</h1>
            <button onclick="openModal()" class="info-icon">ℹ️</button>
        </div>

        <form action="" method="POST" novalidate>
            <?php for ($i = 1; $i <= $_SESSION['numero_asegurados']; $i++): ?>
                <h3>Asegurado <?= $i ?></h3>

                <label>Fecha de Nacimiento:</label>
                <input type="date" class="input_generic"
                    name="nacimiento_<?= $i ?>"
                    id="nacimiento_<?= $i ?>"
                    value="<?= $_SESSION['asegurado_' . $i]['nacimiento'] ?? '' ?>"
                    onblur="validarEdad(this, 'error_edad_<?= $i ?>')"
                    required>
                <div class="error-msg" id="error_edad_<?= $i ?>">
                    La edad debe ser al menos 15 años.
                </div>
                <?php if (!empty($_SESSION['errores_step4'][$i])): ?>
                    <div class="error-msg" style="display: block;">
                        <?= htmlspecialchars($_SESSION['errores_step4'][$i]) ?>
                    </div>
                <?php endif; ?>

                <label>Sexo:</label>
                <select class="input_generic" name="sexo_<?= $i ?>" required>
                    <option value="">Seleccionar</option>
                    <option value="M" <?= (isset($_SESSION['asegurado_' . $i]['sexo']) && $_SESSION['asegurado_' . $i]['sexo'] === 'M') ? 'selected' : '' ?>>Hombre</option>
                    <option value="F" <?= (isset($_SESSION['asegurado_' . $i]['sexo']) && $_SESSION['asegurado_' . $i]['sexo'] === 'F') ? 'selected' : '' ?>>Mujer</option>
                </select>

                <?php if ($i > 1): ?>
                    <label>Parentesco:</label>
                    <select class="input_generic" name="parentesco_<?= $i ?>" required>
                        <option value="">Seleccionar</option>
                        <option value="conyuge" <?= (isset($_SESSION['asegurado_' . $i]['parentesco']) && $_SESSION['asegurado_' . $i]['parentesco'] === 'conyuge') ? 'selected' : '' ?>>Cónyuge</option>
                        <option value="hijo" <?= (isset($_SESSION['asegurado_' . $i]['parentesco']) && $_SESSION['asegurado_' . $i]['parentesco'] === 'hijo') ? 'selected' : '' ?>>Hijo/a</option>
                        <option value="otros" <?= (isset($_SESSION['asegurado_' . $i]['parentesco']) && $_SESSION['asegurado_' . $i]['parentesco'] === 'otros') ? 'selected' : '' ?>>Otros</option>
                    </select>
                <?php endif; ?>
            <?php endfor; ?>
            <button type="submit">Siguiente</button>
        </form>
    </div>

    <!-- Modal -->
    <div id="infoModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal()">&times;</span>
            <h2>Fecha de nacimiento</h2>
            <p>Los menores de 15 años deben ir acompañados en la póliza por padre, madre o tutor legal.</p>
        </div>
    </div>

    <?php
    unset($_SESSION['errores_step4']);
    require_once __DIR__ . '/../includes/footer.php';
    ?>
</body>

</html>