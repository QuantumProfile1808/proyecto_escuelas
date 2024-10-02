<?php
?>
<?php
// Incluye el archivo de conexión a la base de datos
include_once "conexion.php";
// Incluye la definición de la clase Materia
include_once "Materia.php";
// Incluye la definición de la clase Estudiante
include_once "Estudiante.php";

// Crea una nueva instancia de la clase Estudiante
// utilizando los datos enviados por POST (nombre e id)
$materia = new Estudiante($_POST["nombre"], $_POST["id"]);

// Llama al método actualizar de la clase Estudiante
$materia->actualizar();

// Redirige al usuario a la página mostrar_materias.php
header("Location: mostrar_materias.php");
