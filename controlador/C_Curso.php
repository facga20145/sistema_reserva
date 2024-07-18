<?php
require_once '../modelos/Curso.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $ciclo = $_POST['ciclo'];
    $id_escuela = $_POST['escuela'];

    $curso = new Curso();
    if ($curso->registrarCurso($nombre, $ciclo, $id_escuela)) {
        header("Location: ../Vista/V_V_Cursos/cursos.php");
    } else {
        echo "Error al registrar el curso";
    }
}
?>
