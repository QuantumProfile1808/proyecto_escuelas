<?php
?>
<?php
// Define la dirección del host de la base de datos
$host = "127.0.0.1:3306";
// Define el nombre de usuario para la conexión
$usuario = "root";
// Define la contraseña para la conexión
$contrasenia = "";
// Define el nombre de la base de datos a utilizar
$base_de_datos = "sistema_gestion";

// Crea una nueva conexión a la base de datos MySQL
$mysqli = new mysqli($host, $usuario, $contrasenia, $base_de_datos);

// Verifica si hubo un error en la conexión
if ($mysqli->connect_errno) {
    // Si hay un error, muestra un mensaje con el error
    echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
