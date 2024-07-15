<?php
require_once '../modelos/Asignacion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_docente = $_POST['docente'];
    $id_curso = $_POST['curso'];
    $id_aula = $_POST['aula'];
    $dia = $_POST['dia'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];

    $asignacion = new Asignacion();
    if ($asignacion->asignarAula($id_docente, $id_curso, $id_aula, $dia, $hora_inicio, $hora_fin)) {
        header("Location: ../Vista/V_V_Asignacion/asignaciones.html");
    } else {
        echo "Error al asignar el aula";
    }
}
?>
