<?php
session_start();

// Sesion caduca a los 7 minutos
$tiempo_inactividad = 420;
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $tiempo_inactividad) {
    session_unset();
    session_destroy();
    header('Location: ../index.php');
    exit;
}
$_SESSION['LAST_ACTIVITY'] = time();

if (!isset($_SESSION['fecha_inicio']) || !isset($_SESSION['codigo_postal']) || !isset($_SESSION['numero_asegurados'])) {
    header('Location: ../index.php');
    exit;
}

// Guardar en base de datos solo una vez
if (empty($_SESSION['datos_guardados'])) {
    require_once __DIR__ . '/../includes/conexion.php';

    try {
        $stmt = $conn->prepare("INSERT INTO registros 
            (fecha_inicio, codigo_postal, numero_asegurados, datos_asegurados, dental, cliente_mapfre, nombre, telefono, email)
            VALUES (:fecha_inicio, :codigo_postal, :numero_asegurados, :datos_asegurados, :dental, :cliente_mapfre, :nombre, :telefono, :email)");

        $stmt->execute([
            ':fecha_inicio'      => $_SESSION['fecha_inicio'] ?? null,
            ':codigo_postal'     => $_SESSION['codigo_postal'] ?? null,
            ':numero_asegurados' => $_SESSION['numero_asegurados'] ?? null,
            ':datos_asegurados'  => $_SESSION['datos_asegurados'] ?? null,
            ':dental'            => $_SESSION['dental'] ?? null,
            ':cliente_mapfre'    => $_SESSION['cliente_mapfre'] ?? null,
            ':nombre'            => $_SESSION['nombre'] ?? null,
            ':telefono'          => $_SESSION['telefono'] ?? null,
            ':email'             => $_SESSION['email'] ?? null
        ]);

        $_SESSION['datos_guardados'] = true;

        // Limpiar datos tras guardado
        unset($_SESSION['fecha_inicio']);
        unset($_SESSION['codigo_postal']);
        unset($_SESSION['numero_asegurados']);
        unset($_SESSION['datos_asegurados']);
        unset($_SESSION['dental']);
        unset($_SESSION['cliente_mapfre']);
        unset($_SESSION['nombre']);
        unset($_SESSION['telefono']);
        unset($_SESSION['email']);

        for ($i = 1; $i <= 10; $i++) {
            unset($_SESSION['asegurado_' . $i]);
        }
    } catch (PDOException $e) {
        error_log("Error al guardar en base de datos: " . $e->getMessage());
    }
}

require_once __DIR__ . '/../includes/header.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Resultados</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="../assets/js/script.js" defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container my-2">
        <div class="d-flex align-items-center mb-4">
            <a href="step7.php" class="flecha-back me-3">&#8592;</a>
            <div class="text-center w-100">
                <h1 class="mb-2">Tu seguro de Salud</h1>
                <h5 class="text-muted">PRECIO MES TOTAL ASEGURADOS</h5>
            </div>
        </div>

        <div class="row g-4">
            <?php for ($i = 1; $i <= 3; $i++): ?>
                <div class="col-md-4">
                    <div class="card h-100 text-center shadow-sm d-flex flex-column">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= $i === 3 ? 'Reembolso' : 'Cuadro Médico' ?></h5>
                            <h3 class="text-warning">
                                <?= $i === 1 ? 'Con copago' : ($i === 2 ? 'Sin copago' : 'Reembolso') ?>
                                <button onclick="abrirModalInfo(<?= $i ?>)" class="info-icon">ℹ️</button>
                            </h3>
                            <hr>
                            <p class="fw-bold"><?= $i === 3 ? '' : 'Asistencia Sanitaria:' ?></p>
                            <p>
                                <?= $i === 1 ? '<span class="text-warning">Tú e-liges</span> o Plus' : ($i === 2 ? 'Asistencia Sanitaria Supra' :
                                    'Muvraline te reembolsa entre el 80% y 90% de los gastos ocasionados con hospitalización') ?>
                            </p>
                            <?php if ($i === 1): ?><p>Con copago sin hospitalización</p><?php endif; ?>
                            <?php if ($i === 2): ?><p>Sin copago con hospitalización</p><?php endif; ?>
                            <h2><?= [29, 102, 140][$i - 1] ?> <small>€/mes</small></h2>
                            <div class="mt-auto">
                                <div class="d-grid gap-2 my-3">
                                    <button class="btn btn-warning" onclick="abrirFormularioAmpliado()">ME INTERESA</button>
                                    <button class="btn btn-dark" onclick="abrirModalAgente()">QUIERO HABLAR CON UN AGENTE</button>
                                </div>
                                <a href="generar_presupuesto.php" class="text-warning small">Presupuesto</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>

        <div class="text-center mt-4">
            <a href="modificar_datos.php" target="_blank" class="btn btn-outline-warning mx-2">Modificar datos</a>
            <a href="comparativa.php" target="_blank" class="btn btn-outline-warning mx-2">Ver comparativa</a>
        </div>
    </div>

    <?php require_once __DIR__ . '/../includes/modales.php'; ?>
    <?php require_once __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>