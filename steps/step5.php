<?php
session_start();

// Verificar que los pasos anteriores estén completos
if (!isset($_SESSION['asegurado_1'])) {
    header('Location: step4.php');
    exit;
}

$progreso = 60;
$stepAnterior = "step4.php";
$stepSiguiente = null; // Bloqueado hasta que rellene "dental"

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['dental'])) {
        $_SESSION['dental'] = $_POST['dental'];

        // Redirigir al siguiente paso
        header('Location: step6.php');
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

        <?php if (isset($_SESSION['dental']) && !empty($_SESSION['dental'])): ?>
        <a href="step6.php" class="flecha">&#8594;</a>
        <?php else: ?>
        <span class="flecha desactivada">&#8594;</span>
        <?php endif; ?>

    </div>

    <div class="container">
        <h1>¿Quieres cobertura dental?</h1>

        <form action="" method="POST">
            <select class="input_generic" name="dental" required>
                <option value="">Seleccionar...</option>
                <option value="si" <?= (isset($_SESSION['dental']) && $_SESSION['dental'] == 'si') ? 'selected' : '' ?>>
                    Sí</option>
                <option value="no" <?= (isset($_SESSION['dental']) && $_SESSION['dental'] == 'no') ? 'selected' : '' ?>>
                    No</option>
            </select>

            <button type="submit">Siguiente</button>
        </form>
    </div>

    <?php require_once __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>