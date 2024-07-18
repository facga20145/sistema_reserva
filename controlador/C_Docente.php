<?php
require_once '../modelos/Docente.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];

    $docente = new Docente();
    if ($docente->registrarDocente($nombre)) {
        header("Location: ../Vista/V_V_Docentes/docente.html");
    } else {
        echo "Error al registrar el docente";
    }
}
?>
