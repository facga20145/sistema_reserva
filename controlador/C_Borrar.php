<?php
require_once '../modelos/editar_asignacion.php';

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $data);
    $idAsignacion = $data['id_asignacion'];

    $asignacion = new Asignacion();
    $result = $asignacion->eliminarAsignacion($idAsignacion);

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Asignación eliminada correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al eliminar la asignación.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
}
?>
