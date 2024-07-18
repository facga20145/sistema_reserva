<?php
require_once '../modelos/editar_asignacion.php';

if (isset($_GET['id_asignacion'])) {
    $idAsignacion = $_GET['id_asignacion'];

    $asignacion = new Asignacion();
    $asignacionDetalles = $asignacion->obtenerAsignacionPorId($idAsignacion);

    echo json_encode($asignacionDetalles);
}
?>
