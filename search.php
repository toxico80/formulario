<?php

$host = 'localhost';  
$dbname = 'reporte';  
$username = 'root';   
$password = '';       


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("No se pudo conectar a la base de datos: " . $e->getMessage());
}


$searchTerm = '';


if (isset($_GET['search_term'])) {
    $searchTerm = $_GET['search_term'];
    

    $sql = "SELECT * FROM calificaciones WHERE nombre LIKE :searchTerm OR grado LIKE :searchTerm";
    
  
    $stmt = $pdo->prepare($sql);
    

    $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%');
    
    
    $stmt->execute();
    
    
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $resultados = [];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de Búsqueda</title>
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
        .no-results {
            text-align: center;
            color: red;
        }
    </style>
</head>
<body>

    <h1>Resultados de la Búsqueda</h1>

    <?php if (count($resultados) > 0): ?>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Grado</th>
                <th>Calificaciones</th>
            </tr>
            <?php foreach ($resultados as $estudiante): ?>
                <tr>
                    <td><?php echo htmlspecialchars($estudiante['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($estudiante['grado']); ?></td>
                    <td>
                        <a href="ver_calificaciones.php?nombre=<?php echo urlencode($estudiante['nombre']); ?>">Ver Calificaciones</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p class="no-results">
            <?php if (!empty($searchTerm)): ?>
                No se encontraron resultados para "<?php echo htmlspecialchars($searchTerm); ?>"
            <?php else: ?>
                Ingresa un término de búsqueda para empezar.
            <?php endif; ?>
        </p>
    <?php endif; ?>

    <p><a href="clasificacion.html">Volver al formulario</a></p>
</body>
</html>
