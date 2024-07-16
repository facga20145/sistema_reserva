<?php
require_once 'conexion.php';

class Asignacion {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function asignarAula($id_docente, $id_curso, $dia, $hora_inicio, $hora_fin, $grupo, $cantidad_alumnos) {
        // Obtener el ciclo del curso
        $query_ciclo = "SELECT Ciclo FROM cursos WHERE Id_Curso = ?";
        $stmt_ciclo = $this->conn->prepare($query_ciclo);
        $stmt_ciclo->bind_param("i", $id_curso);
        $stmt_ciclo->execute();
        $result_ciclo = $stmt_ciclo->get_result();
        $curso = $result_ciclo->fetch_assoc();
        $ciclo = $curso['Ciclo'];

        // Obtener un aula disponible
        $id_aula = $this->obtenerAulaDisponible($cantidad_alumnos, $dia, $hora_inicio, $hora_fin);

        if ($id_aula) {
            $query = "CALL SP_AsignarAula(?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("iiissssi", $id_docente, $id_curso, $id_aula, $dia, $hora_inicio, $hora_fin, $grupo, $cantidad_alumnos);

            if ($stmt->execute()) {
                return true;
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

    public function obtenerAsignacionesPorEscuela($escuelaId) {
        if ($escuelaId == '') {
            $query = "SELECT asignaciones.*, docentes.Nombre AS Docente, cursos.Nombre AS Curso, aulas.Nombre AS Aula, cursos.Ciclo, asignaciones.Cantidad_Alumnos 
                      FROM asignaciones 
                      JOIN docentes ON asignaciones.Id_Docente = docentes.Id_Docente 
                      JOIN cursos ON asignaciones.Id_Curso = cursos.Id_Curso 
                      JOIN aulas ON asignaciones.Id_Aula = aulas.Id_Aula";
        } else {
            $query = "SELECT asignaciones.*, docentes.Nombre AS Docente, cursos.Nombre AS Curso, aulas.Nombre AS Aula, cursos.Ciclo, asignaciones.Cantidad_Alumnos 
                      FROM asignaciones 
                      JOIN docentes ON asignaciones.Id_Docente = docentes.Id_Docente 
                      JOIN cursos ON asignaciones.Id_Curso = cursos.Id_Curso 
                      JOIN aulas ON asignaciones.Id_Aula = aulas.Id_Aula
                      WHERE cursos.Id_Escuela = ? OR (cursos.Ciclo = 1 AND cursos.Id_Escuela IN (1, 2))";
        }

        $stmt = $this->conn->prepare($query);
        if ($escuelaId != '') {
            $stmt->bind_param("i", $escuelaId);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function obtenerAsignaciones() {
        $query = "SELECT * FROM asignaciones";
        $result = $this->conn->query($query);
        return $result;
    }
}
?>
