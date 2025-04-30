<?php
$host = "localhost";
$username = "root";
$password = ""; // XAMPP por defecto no usa contraseña
$dbname = "calculadora_seguro2";

try {
    // Conectamos al servidor MySQL (sin seleccionar base de datos aún)
    $conn = new PDO("mysql:host=$host", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Crear base de datos si no existe
    $conn->exec("CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");

    // Seleccionar la base de datos
    $conn->exec("USE $dbname");

    // Crear tabla si no existe
    $conn->exec("
        CREATE TABLE IF NOT EXISTS registros (
            id INT AUTO_INCREMENT PRIMARY KEY,
            fecha_inicio DATE,
            codigo_postal VARCHAR(10),
            numero_asegurados INT,
            datos_asegurados TEXT,
            dental VARCHAR(10),
            cliente_mapfre VARCHAR(10),
            nombre VARCHAR(100),
            telefono VARCHAR(20),
            email VARCHAR(100),
            fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");

    echo "Base de datos y tabla creadas correctamente.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
