<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Asignaciones</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="../V_V_Principal/index.html">Inicio</a></li>
            <li><a href="../V_V_Docentes/docente.html">Datos del Docente</a></li>
            <li><a href="../V_V_Cursos/cursos.php">Datos del Curso</a></li>
            <li><a href="../V_V_Asignacion/asignaciones.php">Asignación de Aulas</a></li>
            <li><a href="editar.php">Actualizar y Editar</a></li>
        </ul>
    </nav>
    <h1>Editar Asignaciones</h1>
    <div class="main-container">
        <label for="asignacion-select">Seleccionar Asignación:</label>
        <select id="asignacion-select">
            <option value="">Seleccione una asignación</option>
        </select>
        <form id="form-editar">
            <label for="docente">Docente:</label>
            <input type="text" id="docente" name="docente" required>

            <label for="curso">Curso:</label>
            <input type="text" id="curso" name="curso" required>

            <label for="dia">Día:</label>
            <input type="text" id="dia" name="dia" required>

            <label for="hora_inicio">Hora Inicio:</label>
            <input type="time" id="hora_inicio" name="hora_inicio" required>

            <label for="hora_fin">Hora Fin:</label>
            <input type="time" id="hora_fin" name="hora_fin" required>

            <label for="grupo">Grupo:</label>
            <input type="number" id="grupo" name="grupo" required>

            <label for="ciclo">Ciclo:</label>
            <input type="number" id="ciclo" name="ciclo" required>

            <label for="cantidad_alumnos">Cantidad de Alumnos:</label>
            <input type="number" id="cantidad_alumnos" name="cantidad_alumnos" required>

            <button type="button" id="guardar-btn">Guardar</button>
            <button type="button" id="eliminar-btn">Eliminar</button>
        </form>
    </div>
    <script src="editar_asignaciones.js"></script>
</body>
</html>
