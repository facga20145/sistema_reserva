<?php
require_once '../modelos/editar_asignacion.php';

$asignacion = new Asignacion();
$asignaciones = $asignacion->obtenerTodasAsignaciones();

echo json_encode($asignaciones);
?>
