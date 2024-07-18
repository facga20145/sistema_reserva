<?php
require_once '../modelos/Asignacion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_docente = $_POST['docente'];
    $id_curso = $_POST['curso'];
    $dia = $_POST['dia'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];
    $grupo = $_POST['grupo'];
    $cantidad_alumnos = $_POST['cantidad_alumnos'];
    $escuelaId = isset($_POST['escuela']) ? $_POST['escuela'] : null;

    $asignacion = new Asignacion();
    if ($asignacion->asignarAula($id_docente, $id_curso, $dia, $hora_inicio, $hora_fin, $grupo, $cantidad_alumnos, $escuelaId)) {
        header("Location: ../Vista/V_V_Asignacion/asignaciones.php");
    } else {
        echo "Error al asignar el aula o no hay aulas disponibles";
    }
}
?>
