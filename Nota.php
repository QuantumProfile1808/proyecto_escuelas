<?php
class Nota
{
    // Propiedades de la clase
    private $puntaje, $idEstudiante, $idMateria;

    // Constructor que inicializa las propiedades
    public function __construct($puntaje, $idEstudiante, $idMateria)
    {
        $this->puntaje = $puntaje; // Puntaje del examen
        $this->idEstudiante = $idEstudiante; // ID del estudiante
        $this->idMateria = $idMateria; // ID de la materia
    }

    // Método para guardar o actualizar la nota
    public function guardar()
    {
        global $mysqli; // Acceso a la conexión de la base de datos
        // Primero eliminamos la nota existente, si hay alguna
        $this->eliminar();
        // Luego insertamos la nueva nota
        $sentencia = $mysqli->prepare("INSERT INTO notas_estudiantes_materias
            (id_estudiante, id_materia, puntaje)
                VALUES
                (?, ?, ?)");
        // Vinculamos los parámetros a la consulta
        $sentencia->bind_param("ssd", $this->idEstudiante, $this->idMateria, $this->puntaje);
        $sentencia->execute(); // Ejecutamos la consulta
    }

    // Método para obtener las notas de un estudiante específico
    public static function obtenerDeEstudiante($idEstudiante)
    {
        global $mysqli; // Acceso a la conexión de la base de datos
        $sentencia = $mysqli->prepare("SELECT id, id_estudiante, id_materia, puntaje FROM notas_estudiantes_materias WHERE id_estudiante = ?");
        $sentencia->bind_param("i", $idEstudiante); // Vinculamos el ID del estudiante
        $sentencia->execute(); // Ejecutamos la consulta
        $resultado = $sentencia->get_result(); // Obtenemos el resultado
        return $resultado->fetch_all(MYSQLI_ASSOC); // Retornamos las notas como un array asociativo
    }

    // Método para combinar las materias con sus respectivas calificaciones
    public static function combinar($materias, $notas)
    {
        // Iteramos sobre las materias
        for ($x = 0; $x < count($materias); $x++) {
            // Asignamos la calificación a cada materia
            $materias[$x]["puntaje"] = self::obtenerCalificacion($notas, $materias[$x]["id"]);
        }
        return $materias; // Retornamos el array combinado
    }

    // Método privado para obtener la calificación de una materia específica
    private static function obtenerCalificacion($notas, $idMateria)
    {
        // Buscamos la nota correspondiente a la materia
        foreach ($notas as $nota) {
            if (intval($nota["id_materia"]) === intval($idMateria)) {
                return $nota["puntaje"]; // Retornamos el puntaje si se encuentra
            }
        }
        return 0; // Retornamos 0 si no hay nota
    }

    // Método para eliminar la nota de un estudiante en una materia específica
    public function eliminar()
    {
        global $mysqli; // Acceso a la conexión de la base de datos
        $sentencia = $mysqli->prepare("DELETE FROM notas_estudiantes_materias WHERE id_estudiante = ? AND id_materia = ?");
        $sentencia->bind_param("ii", $this->idEstudiante, $this->idMateria); // Vinculamos los parámetros
        $sentencia->execute(); // Ejecutamos la consulta
    }
}
?>
