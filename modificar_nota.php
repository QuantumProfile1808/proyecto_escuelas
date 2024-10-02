<?php
?>
<?php
// Incluye el archivo de conexión a la base de datos
include_once "conexion.php";
// Incluye la definición de la clase Nota
include_once "Nota.php";

// Crea una nueva instancia de la clase Nota
// Utiliza los datos enviados por POST (puntaje, id del estudiante, id de la materia)
$nota = new Nota($_POST["puntaje"], $_POST["id_estudiante"], $_POST["id_materia"]);

// Llama al método guardar de la clase Nota para guardar los datos en la base de datos
$nota->guardar();

// Redirige al usuario a la página notas_estudiante.php, pasando el ID del estudiante en la URL
header("Location: notas_estudiante.php?id=" . $_POST["id_estudiante"]);
