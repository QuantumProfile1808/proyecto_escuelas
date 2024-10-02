<?php
?>
<?php
// Incluye el archivo de conexión a la base de datos
include_once "conexion.php";
// Incluye la definición de la clase Materia
include_once "Materia.php";

// Llama al método eliminar de la clase Materia
// Utiliza el ID pasado por GET para identificar la materia a eliminar
Materia::eliminar($_GET["id"]);

// Redirige al usuario a la página mostrar_materias.php después de eliminar la materia
header("Location: mostrar_materias.php");
