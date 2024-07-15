<?php
require_once 'conexion.php';

class Asignacion {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function asignarAula($id_docente, $id_curso, $id_aula, $dia, $hora_inicio, $hora_fin) {
        $query = "CALL SP_AsignarAula(?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iiisss", $id_docente, $id_curso, $id_aula, $dia, $hora_inicio, $hora_fin);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function obtenerAsignaciones() {
        $query = "SELECT * FROM asignaciones";
        $result = $this->conn->query($query);
        return $result;
    }
}
?>
