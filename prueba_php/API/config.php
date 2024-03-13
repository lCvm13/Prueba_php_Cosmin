<?php
// Archivo de configuración que usará la api.
// Declaramos a que base de datos se conectará la api para hacer la consulta.
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prueba_php";
try {
    $conn = new PDO(
        "mysql:host=$servername;dbname=$dbname",
        $username,
        $password
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

?>