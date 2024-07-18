<?php
require_once 'conexion.php';

class Curso {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function registrarCurso($nombre, $ciclo, $id_escuela) {
        $query = "CALL SP_RegistrarCurso(?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sis", $nombre, $ciclo, $id_escuela);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function obtenerCursos() {
        $query = "SELECT * FROM cursos";
        $result = $this->conn->query($query);
        return $result;
    }

    public function obtenerEscuelas() {
        $query = "SELECT * FROM escuelas";
        $result = $this->conn->query($query);
        return $result;
    }
}
?>
