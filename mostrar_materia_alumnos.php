<?php
// Incluye el archivo de conexión a la base de datos
include 'db.php';

// Consulta para obtener materias, estudiantes y sus notas
$sql = "
    SELECT m.nombre AS materia, e.nombre AS estudiante, n.puntaje
    FROM materias m
    LEFT JOIN notas_estudiantes_materias n ON m.id = n.id_materia
    LEFT JOIN estudiantes e ON n.id_estudiante = e.id
    ORDER BY m.nombre, e.nombre
";

// Ejecuta la consulta y almacena el resultado
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Materias y Estudiantes</title>
    <link rel="stylesheet" href="styles.css"> <!-- Agrega tu CSS aquí -->
</head>
<body>
    <h1>Materias y Estudiantes</h1>

    <table>
        <thead>
            <tr>
                <th>Materia</th>
                <th>Estudiante</th>
                <th>Nota</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): // Verifica si hay resultados ?>
                <?php while ($row = $result->fetch_assoc()): // Itera sobre cada fila del resultado ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['materia']); ?></td> <!-- Muestra el nombre de la materia -->
                        <td><?php echo htmlspecialchars($row['estudiante'] ?: 'No inscrito'); ?></td> <!-- Muestra el nombre del estudiante o 'No inscrito' -->
                        <td><?php echo htmlspecialchars($row['puntaje'] ?: 'N/A'); ?></td> <!-- Muestra el puntaje o 'N/A' si no hay nota -->
                    </tr>
                <?php endwhile; ?>
            <?php else: // Si no hay resultados ?>
                <tr>
                    <td colspan="3">No hay datos disponibles.</td> <!-- Mensaje si no hay datos -->
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php
    // Cierra la conexión a la base de datos
    $conn->close();
    ?>
</body>
</html>
