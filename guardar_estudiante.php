<?php
?>
<?php
// Incluye el archivo de conexión a la base de datos
include_once "conexion.php";
// Incluye la definición de la clase Estudiante
include_once "Estudiante.php";

// Crea una nueva instancia de la clase Estudiante
// Utiliza los datos enviados por POST (nombre y grupo)
$estudiante = new Estudiante($_POST["nombre"], $_POST["grupo"]);

// Llama al método guardar de la clase Estudiante para guardar los datos en la base de datos
$estudiante->guardar();

// Redirige al usuario a la página mostrar_estudiantes.php después de guardar el estudiante
header("Location: mostrar_estudiantes.php");
