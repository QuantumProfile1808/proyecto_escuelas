<?php
?>
<?php
// Incluye el archivo de conexión a la base de datos
include_once "conexion.php";
// Incluye la definición de la clase Materia
include_once "Materia.php";

// Crea una nueva instancia de la clase Materia
// Utiliza los datos enviados por POST (nombre)
$materia = new Materia($_POST["nombre"]);

// Llama al método guardar de la clase Materia para guardar los datos en la base de datos
$materia->guardar();

// Redirige al usuario a la página mostrar_materias.php después de guardar la materia
header("Location: mostrar_materias.php");
