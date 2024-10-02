<?php
include_once "conexion.php";
include_once "encabezado.php";
include_once "Estudiante.php";

// Verifica si se ha enviado un término de búsqueda
$terminoBusqueda = isset($_POST['busqueda']) ? $_POST['busqueda'] : '';
// Obtiene la lista de estudiantes desde la base de datos, aplicando el filtro de búsqueda
$estudiantes = Estudiante::obtener($terminoBusqueda);
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/mostrar_estudiantes-estilos.css">
    <title>Mostrar estudiantes</title>
</head>
<body>
    <div class="contenido">
        <div class="titulo">
            <h1>Listado de estudiantes</h1>
            <br><br>
        </div>
        <div class="buscar-container">
            <a href="formulario_registro_estudiante.php" class="btn boton-agregar">Nuevo +</a> 
            <form method="post" class="buscar">
                <input type="text" name="busqueda" value="<?php echo htmlspecialchars($terminoBusqueda); ?>" placeholder="Buscar estudiante" class="form-control" />
                <button type="submit" class="boton-buscar">Buscar</button>
            </form>
        </div>
        <div class="table-container">
            <?php if (count($estudiantes) != 0) { ?>
                <table class="tabla-estudiantes">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Grupo</th>
                            <th>Notas</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($estudiantes as $estudiante) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($estudiante["nombre"]); ?></td>
                                <td><?php echo htmlspecialchars($estudiante["grupo"]); ?></td>
                                <td>
                                    <a href="notas_estudiante.php?id=<?php echo $estudiante["id"]; ?>" class="btn boton-notas">Notas</a>
                                </td>
                                <td>
                                    <a href="editar_estudiante.php?id=<?php echo $estudiante["id"]; ?>" class="btn boton-editar">Editar</a>
                                    <a href="eliminar_estudiante.php?id=<?php echo $estudiante["id"]; ?>" class="btn boton-eliminar">Eliminar</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <h1>No hay ningún alumno guardado en la base de datos =(</h1>
            <?php } ?> 
        </div>
    </div>

    <footer class="footer">
        <p>© 2024 Control de Notas - Todos los derechos reservados</p>
    </footer>
</body>
</html>
