<?php
?>
<?php
// Incluye el archivo de conexión a la base de datos
include_once "conexion.php";
// Incluye la definición de la clase Estudiante
include_once "Estudiante.php";

// Crea una nueva instancia de la clase Estudiante
// utilizando los datos enviados por POST (nombre, grupo e id)
$estudiante = new Estudiante($_POST["nombre"], $_POST["grupo"], $_POST["id"]);

// Llama al método actualizar de la clase Estudiante
$estudiante->actualizar();

// Redirige al usuario a la página mostrar_estudiantes.php
header("Location: mostrar_estudiantes.php");
