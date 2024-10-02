<?php
?>
<?php
// Incluye el archivo de conexión a la base de datos
include_once "conexion.php";
// Incluye la definición de la clase Estudiante
include_once "Estudiante.php";

// Llama al método eliminar de la clase Estudiante
// Utiliza el ID pasado por GET para identificar al estudiante a eliminar
Estudiante::eliminar($_GET["id"]);

// Redirige al usuario a la página mostrar_estudiantes.php después de eliminar el estudiante
header("Location: mostrar_estudiantes.php");
