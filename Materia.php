<?php
?>
<?php
// Define la clase Materia
class Materia
{
    // Propiedades privadas de la clase
    private $nombre, $id;

    // Constructor de la clase, inicializa las propiedades
    public function __construct($nombre, $id = null)
    {
        $this->nombre = $nombre; // Asigna el nombre
        // Si se proporciona un ID, lo asigna
        if ($id) {
            $this->id = $id;
        }
    }

    // Método para guardar una nueva materia en la base de datos
    public function guardar()
    {
        global $mysqli; // Accede a la conexión a la base de datos
        // Prepara la sentencia SQL para insertar una nueva materia
        $sentencia = $mysqli->prepare("INSERT INTO materias
            (nombre)
                VALUES
                (?)");
        // Vincula el parámetro
        $sentencia->bind_param("s", $this->nombre);
        // Ejecuta la sentencia
        $sentencia->execute();
    }

    // Método estático para obtener todas las materias
// Método estático para obtener todas las materias o filtrar por nombre
public static function obtener($termino = '')
{
    global $mysqli; // Accede a la conexión a la base de datos
    // Construye la consulta base
    $sql = "SELECT id, nombre FROM materias";
    
    if ($termino) {
        // Si hay un término de búsqueda, modifica la consulta
        $sql .= " WHERE nombre LIKE ?";
    }

    // Prepara la sentencia SQL
    $sentencia = $mysqli->prepare($sql);
    
    if ($termino) {
        // Vincula el parámetro de búsqueda
        $busqueda = '%' . $termino . '%';
        $sentencia->bind_param("s", $busqueda);
    }

    // Ejecuta la sentencia
    $sentencia->execute();
    // Obtiene el resultado
    $resultado = $sentencia->get_result();
    // Retorna el resultado como un array asociativo
    return $resultado->fetch_all(MYSQLI_ASSOC);
}


    // Método estático para obtener una materia específica por ID
    public static function obtenerUna($id)
    {
        global $mysqli; // Accede a la conexión a la base de datos
        // Prepara la sentencia SQL para seleccionar una materia por ID
        $sentencia = $mysqli->prepare("SELECT id, nombre FROM materias WHERE id = ?");
        // Vincula el parámetro ID
        $sentencia->bind_param("i", $id);
        // Ejecuta la sentencia
        $sentencia->execute();
        // Obtiene el resultado
        $resultado = $sentencia->get_result();
        // Retorna el objeto de la materia
        return $resultado->fetch_object();
    }

    // Método para actualizar la información de una materia
    public function actualizar()
    {
        global $mysqli; // Accede a la conexión a la base de datos
        // Prepara la sentencia SQL para actualizar una materia
        $sentencia = $mysqli->prepare("UPDATE materias SET nombre = ? WHERE id = ?");
        // Vincula los parámetros
        $sentencia->bind_param("si", $this->nombre, $this->id);
        // Ejecuta la sentencia
        $sentencia->execute();
    }

    // Método estático para eliminar una materia por ID
    public static function eliminar($id)
    {
        global $mysqli; // Accede a la conexión a la base de datos
        // Prepara la sentencia SQL para eliminar una materia
        $sentencia = $mysqli->prepare("DELETE FROM materias WHERE id = ?");
        // Vincula el parámetro ID
        $sentencia->bind_param("i", $id);
        // Ejecuta la sentencia
        $sentencia->execute();
    }
}
