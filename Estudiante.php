<?php
 ?>
<?php
// Define la clase Estudiante
class Estudiante
{
    private $nombre, $grupo, $id;

    public function __construct($nombre, $grupo, $id = null)
    {
        $this->nombre = $nombre;
        $this->grupo = $grupo;
        if ($id) {
            $this->id = $id;
        }
    }

    public function guardar()
    {
        global $mysqli;
        $sentencia = $mysqli->prepare("INSERT INTO estudiantes (nombre, grupo) VALUES (?, ?)");
        $sentencia->bind_param("ss", $this->nombre, $this->grupo);
        $sentencia->execute();
    }

    // Método estático para obtener estudiantes con búsqueda
    public static function obtener($terminoBusqueda = '')
    {
        global $mysqli;
        $query = "SELECT id, nombre, grupo FROM estudiantes";
        
        // Si hay un término de búsqueda, modificamos la consulta
        if (!empty($terminoBusqueda)) {
            $terminoBusqueda = "%" . $mysqli->real_escape_string($terminoBusqueda) . "%";
            $query .= " WHERE nombre LIKE ? OR grupo LIKE ?";
        }

        // Prepara la sentencia
        $sentencia = $mysqli->prepare($query);
        
        // Si hay búsqueda, vinculamos los parámetros
        if (!empty($terminoBusqueda)) {
            $sentencia->bind_param("ss", $terminoBusqueda, $terminoBusqueda);
        }
        
        // Ejecuta la sentencia
        $sentencia->execute();
        
        // Obtiene el resultado
        $resultado = $sentencia->get_result();
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public static function obtenerUno($id)
    {
        global $mysqli;
        $sentencia = $mysqli->prepare("SELECT id, nombre, grupo FROM estudiantes WHERE id = ?");
        $sentencia->bind_param("i", $id);
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        return $resultado->fetch_object();
    }

    public function actualizar()
    {
        global $mysqli;
        $sentencia = $mysqli->prepare("UPDATE estudiantes SET nombre = ?, grupo = ? WHERE id = ?");
        $sentencia->bind_param("ssi", $this->nombre, $this->grupo, $this->id);
        $sentencia->execute();
    }

    public static function eliminar($id)
    {
        global $mysqli;
        $sentencia = $mysqli->prepare("DELETE FROM estudiantes WHERE id = ?");
        $sentencia->bind_param("i", $id);
        $sentencia->execute();
    }
}
