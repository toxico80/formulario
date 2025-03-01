<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "reporte";


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $name = htmlspecialchars($_POST['name']);
    $grade = htmlspecialchars($_POST['grade']);

    
    $spanish = intval($_POST['spanish']);
    $english = intval($_POST['english']);
    $math = intval($_POST['math']);
    $social_science = intval($_POST['social_science']);
    $natural_science = intval($_POST['natural_science']);

    
    $db_admin = floatval($_POST['db_admin']);
    $app_dev = floatval($_POST['app_dev']);
    $report_design = floatval($_POST['report_design']);

    
    $final_condition = htmlspecialchars($_POST['final_condition']);

    
    $comments = htmlspecialchars($_POST['comments']);

    
    $sql = "INSERT INTO calificaciones (nombre, grado, lengua_espanola, lengua_ingles, matematica, ciencias_sociales, ciencias_naturales, admin_bd, desarrollo_apps, diseno_reportes, condicion_final, comentarios)

            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiiiiidddss", $name, $grade, $spanish, $english, $math, $social_science, $natural_science, $db_admin, $app_dev, $report_design, $final_condition, $comments);


    if ($stmt->execute()) {
        echo "<p>Datos guardados exitosamente.</p>";
    } else {
        echo "<p>Error al guardar los datos: " . $conn->error . "</p>";
    }

    $stmt->close();
} else {
    echo "<p>Acceso no autorizado.</p>";
}

$conn->close();
?>
