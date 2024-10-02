<?php
// Incluye el archivo de conexión a la base de datos
include_once "conexion.php"; // Asegúrate de que este archivo inicialice correctamente $mysqli
// Incluye la definición de la clase Materia
include_once "Materia.php";
// Incluye el encabezado de la página
include_once "encabezado.php";

// Validar y sanitizar entrada
$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0; // Obtiene el ID de la materia desde la URL

// Verificar si el ID es válido
if ($id <= 0) {
    die("ID de materia no válido."); // Mensaje de error si el ID no es válido
}

// Preparar la consulta para obtener las notas de la materia
$sql = "
    SELECT e.nombre AS estudiante, n.puntaje
    FROM notas_estudiantes_materias n
    JOIN estudiantes e ON n.id_estudiante = e.id
    WHERE n.id_materia = ?
";

// Preparar y ejecutar la consulta
$stmt = $mysqli->prepare($sql); // Prepara la consulta SQL
$stmt->bind_param("i", $id); // Asocia el parámetro ID a la consulta
$stmt->execute(); // Ejecuta la consulta
$result = $stmt->get_result(); // Obtiene el resultado

// Verifica si la consulta se ejecutó correctamente
if (!$result) {
    die("Error en la consulta: " . $mysqli->error); // Mensaje de error si hay un problema
}

// Mostrar resultados
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notas de la Materia</title>
</head>
<body>
    <h1>Notas de la Materia</h1>
    <table>
        <thead>
            <tr>
                <th>Estudiante</th> <!-- Encabezado para el nombre del estudiante -->
                <th>Nota</th      <!-- Encabezado para la nota del estudiante -->
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): // Verifica si hay resultados ?>
                <?php while ($row = $result->fetch_assoc()): // Itera sobre cada fila del resultado ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['estudiante']); ?></td> <!-- Muestra el nombre del estudiante -->
                        <td><?php echo htmlspecialchars($row['puntaje'] ?: 'N/A'); ?></td> <!-- Muestra la nota o 'N/A' si no hay nota -->
                    </tr>
                <?php endwhile; ?>
            <?php else: // Si no hay resultados ?>
                <tr>
                    <td colspan="2">No hay notas disponibles para esta materia.</td> <!-- Mensaje si no hay notas -->
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php
    // Cierra la declaración y la conexión a la base de datos
    $stmt->close();
    $mysqli->close();
    ?>
</body>
</html>
