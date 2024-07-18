<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Asignación</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="../V_V_Principal/index.html">Inicio</a></li>
            <li><a href="../V_V_Docentes/docente.html">Datos del Docente</a></li>
            <li><a href="../V_V_Cursos/cursos.php">Datos del Curso</a></li>
            <li><a href="../V_V_Asignacion/asignaciones.php">Asignación de Aulas</a></li>
            <li><a href="../V_V_Editar/editar.php">Actualizar y Editar</a></li>
            <li><a href="excel.php">Vista Asignación</a></li>
        </ul>
    </nav>
    <h1>Vista de Asignaciones</h1>
    <div class="table-container">
        <?php
        require_once '../../modelos/AsignacionExcel.php';
        $asignacionModel = new AsignacionVista();
        $asignaciones = $asignacionModel->obtenerAsignacionesPorAula();

        $horas = ["08:00-09:00", "09:00-10:00", "10:00-11:00", "11:00-12:00", "12:00-13:00", "13:00-14:00", "14:00-15:00", "15:00-16:00", "16:00-17:00", "17:00-18:00", "18:00-19:00", "19:00-20:00", "20:00-21:00", "21:00-22:00"];
        $dias = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
        $ocupadas = [];

        foreach ($asignaciones as $aula => $data) {
            echo "<h2>Aula: $aula</h2>";
            echo "<table class='asignaciones-table'>";
            echo "<thead><tr><th>Hora</th>";
            foreach ($dias as $dia) {
                echo "<th>$dia</th>";
            }
            echo "</tr></thead><tbody>";

            foreach ($horas as $hora) {
                list($hora_inicio, $hora_fin) = explode("-", $hora);
                echo "<tr><td>$hora_inicio-$hora_fin</td>";

                foreach ($dias as $dia) {
                    if (isset($ocupadas[$aula][$dia][$hora_inicio])) {
                        continue;
                    }
                    $celda_vacia = true;

                    if (isset($data[$dia])) {
                        foreach ($data[$dia] as $asignacion) {
                            if ($asignacion['hora_inicio'] == $hora_inicio) {
                                $hora_inicio_asignacion = strtotime($asignacion['hora_inicio']);
                                $hora_fin_asignacion = strtotime($asignacion['hora_fin']);
                                $duracion_horas = ($hora_fin_asignacion - $hora_inicio_asignacion) / 3600;
                                $rowspan = ceil($duracion_horas);
                                $color = ($asignacion['escuela'] == 'EPIS') ? 'background-color: #d9ead3;' : 'background-color: #c9daf8;';
                                echo "<td style='$color' rowspan='$rowspan'>{$asignacion['detalle']}</td>";

                                for ($i = 0; $i < $rowspan; $i++) {
                                    $hora_ocupada = date("H:i", strtotime("+$i hour", $hora_inicio_asignacion));
                                    $ocupadas[$aula][$dia][$hora_ocupada] = true;
                                }
                                
                                $celda_vacia = false;
                                break;
                            }
                        }
                    }

                    if ($celda_vacia) {
                        echo "<td></td>";
                    }
                }
                echo "</tr>";
            }

            echo "</tbody></table>";
        }
        ?>
    </div>
</body>
</html>
