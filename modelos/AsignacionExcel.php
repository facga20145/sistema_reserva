<?php
require_once 'conexion.php';

class AsignacionVista {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function obtenerAsignacionesPorAula() {
        $query = "SELECT aulas.Nombre as Aula, Dia, Hora_Inicio, Hora_Fin, cursos.Nombre as Curso, docentes.Nombre as Docente, escuelas.Nombre as Escuela 
                  FROM asignaciones 
                  JOIN docentes ON asignaciones.Id_Docente = docentes.Id_Docente 
                  JOIN cursos ON asignaciones.Id_Curso = cursos.Id_Curso 
                  JOIN aulas ON asignaciones.Id_Aula = aulas.Id_Aula 
                  JOIN escuelas ON cursos.Id_Escuela = escuelas.Id_Escuela
                  ORDER BY aulas.Nombre, Dia, Hora_Inicio";
        $result = $this->conn->query($query);
        $asignaciones = [];
        while ($row = $result->fetch_assoc()) {
            $aula = $row['Aula'];
            $dia = $row['Dia'];
            $hora_inicio = substr($row['Hora_Inicio'], 0, 5);
            $hora_fin = substr($row['Hora_Fin'], 0, 5);
            $detalle = "{$row['Curso']} ({$row['Docente']})";
            $escuela = $row['Escuela'];

            if (!isset($asignaciones[$aula])) {
                $asignaciones[$aula] = [];
            }
            if (!isset($asignaciones[$aula][$dia])) {
                $asignaciones[$aula][$dia] = [];
            }
            $asignaciones[$aula][$dia][] = [
                'hora_inicio' => $hora_inicio,
                'hora_fin' => $hora_fin,
                'detalle' => $detalle,
                'escuela' => $escuela
            ];
        }
        return $asignaciones;
    }
}
