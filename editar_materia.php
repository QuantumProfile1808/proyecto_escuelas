<?php
// Incluye el archivo de conexión a la base de datos
include_once "conexion.php"; // Asegúrate de que este archivo inicializa correctamente $conn
// Incluye la definición de la clase Materia
include_once "Materia.php";
// Incluye el encabezado de la página
include_once "encabezado.php";

// Valida y sanitiza la entrada
// Obtiene el ID de la materia de la URL, o asigna 0 si no está presente
$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;
// Obtiene una materia específica basada en el ID
$materia = Materia::obtenerUna($id);

// Consulta SQL para obtener materias, estudiantes y sus notas
$sql = "
    SELECT m.nombre AS materia, e.nombre AS estudiante, n.puntaje
    FROM materias m
    LEFT JOIN notas_estudiantes_materias n ON m.id = n.id_materia
    LEFT JOIN estudiantes e ON n.id_estudiante = e.id
    ORDER BY m.nombre, e.nombre
";

// Ejecuta la consulta y almacena el resultado
$result = $mysqli->query($sql);

// Verifica si hubo un error en la consulta
if (!$result) {
    // Si hay un error, termina la ejecución y muestra el mensaje de error
    die("Error en la consulta: " . $mysqli->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Materias y Estudiantes</title>
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
            <?php if ($result->num_rows > 0): // Verifica si hay filas en el resultado ?>
                <?php while ($row = $result->fetch_assoc()): // Itera sobre cada fila del resultado ?>
                    <tr>
                        <!-- Muestra el nombre de la materia, sanitizando la salida -->
                        <td><?php echo htmlspecialchars($row['materia']); ?></td>
                        <!-- Muestra el nombre del estudiante, o 'No inscrito' si no hay nombre -->
                        <td><?php echo htmlspecialchars($row['estudiante'] ?: 'No inscrito'); ?></td>
                        <!-- Muestra el puntaje, o 'N/A' si no hay puntaje -->
                        <td><?php echo htmlspecialchars($row['puntaje'] ?: 'N/A'); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: // Si no hay datos en el resultado ?>
                <tr>
                    <!-- Muestra un mensaje cuando no hay datos disponibles -->
                    <td colspan="3">No hay datos disponibles.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php
    // Cierra la conexión a la base de datos
    $mysqli->close();
    ?>
</body>
</html>
