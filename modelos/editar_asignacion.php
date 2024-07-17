<?php
require_once 'conexion.php';

class Asignacion {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function obtenerTodasAsignaciones() {
        $query = "SELECT Id_Asignacion, docentes.Nombre AS Docente, cursos.Nombre AS Curso, Dia 
                  FROM asignaciones 
                  JOIN docentes ON asignaciones.Id_Docente = docentes.Id_Docente 
                  JOIN cursos ON asignaciones.Id_Curso = cursos.Id_Curso";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerAsignacionPorId($id) {
        $query = "SELECT asignaciones.*, docentes.Nombre AS Docente, cursos.Nombre AS Curso, aulas.Nombre AS Aula, cursos.Ciclo 
                  FROM asignaciones 
                  JOIN docentes ON asignaciones.Id_Docente = docentes.Id_Docente 
                  JOIN cursos ON asignaciones.Id_Curso = cursos.Id_Curso 
                  JOIN aulas ON asignaciones.Id_Aula = aulas.Id_Aula 
                  WHERE Id_Asignacion = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function actualizarAsignacion($id, $docente, $curso, $dia, $hora_inicio, $hora_fin, $grupo, $ciclo, $cantidad_alumnos) {
        // Actualizar la asignación
        $query = "UPDATE asignaciones 
                  SET Id_Docente = (SELECT Id_Docente FROM docentes WHERE Nombre = ?), 
                      Id_Curso = (SELECT Id_Curso FROM cursos WHERE Nombre = ?), 
                      Dia = ?, Hora_Inicio = ?, Hora_Fin = ?, Grupo = ?, 
                      Cantidad_Alumnos = ? 
                  WHERE Id_Asignacion = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssssii", $docente, $curso, $dia, $hora_inicio, $hora_fin, $grupo, $cantidad_alumnos, $id);
        $result = $stmt->execute();

        if ($result) {
            // Obtener el Id del curso actualizado
            $query_curso = "SELECT Id_Curso FROM cursos WHERE Nombre = ?";
            $stmt_curso = $this->conn->prepare($query_curso);
            $stmt_curso->bind_param("s", $curso);
            $stmt_curso->execute();
            $result_curso = $stmt_curso->get_result();
            $curso_data = $result_curso->fetch_assoc();
            $id_curso = $curso_data['Id_Curso'];

            // Obtener un aula disponible basada en la nueva cantidad de alumnos
            $id_aula = $this->obtenerAulaDisponible($cantidad_alumnos, $dia, $hora_inicio, $hora_fin);

            if ($id_aula) {
                // Actualizar el aula en la asignación
                $query_update_aula = "UPDATE asignaciones SET Id_Aula = ? WHERE Id_Asignacion = ?";
                $stmt_update_aula = $this->conn->prepare($query_update_aula);
                $stmt_update_aula->bind_param("ii", $id_aula, $id);
                return $stmt_update_aula->execute();
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function obtenerAulaDisponible($cantidad_alumnos, $dia, $hora_inicio, $hora_fin) {
        // Obtener un aula disponible que tenga capacidad suficiente y no esté asignada en ese horario
        $query_aula = "SELECT a.Id_Aula FROM aulas a
                       LEFT JOIN asignaciones asig ON a.Id_Aula = asig.Id_Aula AND asig.Dia = ? AND (
                           (asig.Hora_Inicio < ? AND asig.Hora_Fin > ?) OR
                           (asig.Hora_Inicio < ? AND asig.Hora_Fin > ?) OR
                           (asig.Hora_Inicio >= ? AND asig.Hora_Fin <= ?)
                       )
                       WHERE a.Capacidad >= ? AND asig.Id_Aula IS NULL
                       LIMIT 1";
        $stmt_aula = $this->conn->prepare($query_aula);
        $stmt_aula->bind_param("sssssssi", $dia, $hora_fin, $hora_inicio, $hora_inicio, $hora_inicio, $hora_inicio, $hora_fin, $cantidad_alumnos);
        $stmt_aula->execute();
        $result_aula = $stmt_aula->get_result();
        $aula = $result_aula->fetch_assoc();
        
        return $aula ? $aula['Id_Aula'] : null;
    }

    public function eliminarAsignacion($id) {
        $query = "DELETE FROM asignaciones WHERE Id_Asignacion = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
