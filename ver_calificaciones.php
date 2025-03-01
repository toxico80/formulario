<?php

$host = 'localhost'; 
$dbname = 'reporte'; 
$username = 'root'; 
$password = ''; 


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}


if (isset($_GET['nombre'])) {
    $nombre = $_GET['nombre'];

   
    $sql = "SELECT * FROM calificaciones WHERE nombre = :nombre";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nombre', $nombre, PDO::PARAM_STR);

   
    $stmt->execute();

   
    $estudiante = $stmt->fetch(PDO::FETCH_ASSOC);

    
    if (!$estudiante) {
        die("<p>Estudiante no encontrado. Asegúrate de que el nombre sea correcto.</p>");
    }
} else {
    die("<p>El parámetro 'nombre' no fue proporcionado.</p>");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Calificaciones</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #c20ae7;
            color: white;
        }
        .back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #cc09f3;
            text-decoration: none;
        }
        .back-link:hover {
            color: #bf0bd3;
        }
    </style>
</head>
<body>
    <h1>Calificaciones de <?php echo htmlspecialchars($estudiante['nombre']); ?></h1>

    <table>
        <tr><th>Grado</th><td><?php echo htmlspecialchars($estudiante['grado']); ?></td></tr>
        <tr><th>Lengua Española</th><td><?php echo htmlspecialchars($estudiante['lengua_espanola']); ?></td></tr>
        <tr><th>Lengua Extranjera (Inglés)</th><td><?php echo htmlspecialchars($estudiante['lengua_ingles']); ?></td></tr>
        <tr><th>Matemática</th><td><?php echo htmlspecialchars($estudiante['matematica']); ?></td></tr>
        <tr><th>Ciencias Sociales</th><td><?php echo htmlspecialchars($estudiante['ciencias_sociales']); ?></td></tr>
        <tr><th>Ciencias  Naturales</th><td><?php echo htmlspecialchars($estudiante['ciencias_naturales']); ?></td></tr>
        <tr><th>Administración de Base de Datos</th><td><?php echo htmlspecialchars($estudiante['admin_bd']); ?></td></tr>
        <tr><th>Desarrollo de Aplicaciones</th><td><?php echo htmlspecialchars($estudiante['desarrollo_apps']); ?></td></tr>
        <tr><th>Análisis y Diseño de Reportes</th><td><?php echo htmlspecialchars($estudiante['diseno_reportes']); ?></td></tr>
        <tr><th>Condición Final</th><td><?php echo htmlspecialchars($estudiante['condicion_final']); ?></td></tr>
        <tr><th>Comentarios</th><td><?php echo nl2br(htmlspecialchars($estudiante['comentarios'])); ?></td></tr>
    </table>

    <a href="search.php" class="back-link">Volver a los resultados de búsqueda</a>
</body>
</html>
