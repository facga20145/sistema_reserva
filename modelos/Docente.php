<?php
require_once 'conexion.php';

class Docente {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function registrarDocente($nombre) {
        $query = "CALL SP_RegistrarDocente(?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $nombre);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function obtenerDocentes() {
        $query = "SELECT * FROM docentes";
        $result = $this->conn->query($query);
        return $result;
    }
}
?>
