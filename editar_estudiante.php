<?php
?>
<?php
// Incluye el archivo de conexión a la base de datos
include_once "conexion.php";
// Incluye la definición de la clase Estudiante
include_once "Estudiante.php";
// Incluye el encabezado de la página
include_once "encabezado.php";

// Obtiene un estudiante específico basado en el ID pasado por GET
$estudiante = Estudiante::obtenerUno($_GET["id"]);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/estilo-registro.css">
    <title>Editar Estudiante</title>
</head>
<body>
    <div class="row">
        <div class="caja">
            <h1>Editar estudiante</h1>
            <!-- Formulario para editar la información del estudiante -->
            <form action="actualizar_estudiante.php" method="POST">
                <!-- Campo oculto para el ID del estudiante -->
                <input type="hidden" name="id" value="<?php echo $_GET["id"] ?>">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <!-- Campo de texto para el nombre del estudiante -->
                    <input value="<?php echo $estudiante->nombre ?>" name="nombre" required type="text" id="nombre" class="form-control" placeholder="Nombre">
                </div>
                <div class="form-group">
                    <label for="grupo">Grupo</label>
                    <!-- Campo de texto para el grupo del estudiante -->
                    <input value="<?php echo $estudiante->grupo ?>" name="grupo" required type="text" id="grupo" class="form-control" placeholder="Grupo">
                </div>
                <div class="form-group">
                    <!-- Botón para enviar el formulario -->
                    <button class="btn boton-guardar" type="submit">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>


<?php// include_once "pie.php" ?>
