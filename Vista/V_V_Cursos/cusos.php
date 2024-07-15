<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Curso</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="../V_V_Principal/index.html">Inicio</a></li>
            <li><a href="../V_V_Docentes/docentes.html">Datos del Docente</a></li>
            <li><a href="../V_V_Asignacion/asignaciones.html">Asignación de Aulas</a></li>
        </ul>
    </nav>
    <h1>Registrar Curso</h1>
    <div class="course-container">
        <form action="../../controlador/C_Curso.php" method="post">
            <label for="nombre">Nombre del Curso:</label>
            <input type="text" id="nombre" name="nombre" required>
            
            <label for="ciclo">Ciclo:</label>
            <input type="number" id="ciclo" name="ciclo" min="1" max= "10" required>
            
            <label for="escuela">Escuela:</label>
            <select id="escuela" name="escuela" required>
                <?php
                require_once '../../modelos/Curso.php';
                $curso = new Curso();
                $escuelas = $curso->obtenerEscuelas();
                while ($row = $escuelas->fetch_assoc()): ?>
                    <option value="<?php echo $row['Id_Escuela']; ?>"><?php echo $row['Nombre']; ?></option>
                <?php endwhile; ?>
            </select>
            
            <button type="submit">Registrar</button>
        </form>
    </div>
</body>
</html>
