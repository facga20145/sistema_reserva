<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignación de Aulas</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="../V_V_Principal/index.html">Inicio</a></li>
            <li><a href="../V_V_Docentes/docente.html">Datos del Docente</a></li>
            <li><a href="../V_V_Cursos/cursos.php">Datos del Curso</a></li>
        </ul>
    </nav>
    <h1>Asignación de Aulas</h1>
    <div class="assignment-container">
        <form action="../../controlador/C_Asignacion.php" method="post">
            <label for="docente">Docente:</label>
            <select id="docente" name="docente" required>
                <?php
                require_once '../../modelos/Docente.php';
                $docenteModel = new Docente();
                $docentes = $docenteModel->obtenerDocentes();
                while ($row = $docentes->fetch_assoc()): ?>
                    <option value="<?php echo $row['Id_Docente']; ?>"><?php echo $row['Nombre']; ?></option>
                <?php endwhile; ?>
            </select>
            
            <label for="curso">Curso:</label>
            <select id="curso" name="curso" required>
                <?php
                require_once '../../modelos/Curso.php';
                $cursoModel = new Curso();
                $cursos = $cursoModel->obtenerCursos();
                while ($row = $cursos->fetch_assoc()): ?>
                    <option value="<?php echo $row['Id_Curso']; ?>"><?php echo $row['Nombre']; ?></option>
                <?php endwhile; ?>
            </select>
            
            <label for="grupo">Grupo:</label>
            <input type="text" id="grupo" name="grupo" required>
            
            <label for="dia">Día:</label>
            <select id="dia" name="dia" required>
                <option value="Lunes">Lunes</option>
                <option value="Martes">Martes</option>
                <option value="Miércoles">Miércoles</option>
                <option value="Jueves">Jueves</option>
                <option value="Viernes">Viernes</option>
                <option value="Sábado">Sábado</option>
            </select>
            
            <label for="hora_inicio">Hora de Inicio:</label>
            <input type="time" id="hora_inicio" name="hora_inicio" required>
            
            <label for="hora_fin">Hora de Fin:</label>
            <input type="time" id="hora_fin" name="hora_fin" required>
            
            <label for="cantidad_alumnos">Cantidad de Alumnos:</label>
            <input type="number" id="cantidad_alumnos" name="cantidad_alumnos" required>
            
            <button type="submit">Asignar Aula</button>
        </form>
    </div>
</body>
</html>
