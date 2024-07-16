-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-07-2024 a las 03:05:34
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `trabajo`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_AsignarAula` (IN `Id_Docente` INT, IN `Id_Curso` INT, IN `Id_Aula` INT, IN `Dia` VARCHAR(10), IN `Hora_Inicio` TIME, IN `Hora_Fin` TIME, IN `Grupo` VARCHAR(10), IN `Cantidad_Alumnos` INT)   BEGIN
    INSERT INTO `asignaciones` (`Id_Docente`, `Id_Curso`, `Id_Aula`, `Dia`, `Hora_Inicio`, `Hora_Fin`, `Grupo`, `Cantidad_Alumnos`)
    VALUES (`Id_Docente`, `Id_Curso`, `Id_Aula`, `Dia`, `Hora_Inicio`, `Hora_Fin`, `Grupo`, `Cantidad_Alumnos`);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_RegistrarCurso` (IN `p_Nombre` VARCHAR(100), IN `p_Ciclo` INT, IN `p_Id_Escuela` INT)   BEGIN
    INSERT INTO Cursos (Nombre, Ciclo, Id_Escuela) VALUES (p_Nombre, p_Ciclo, p_Id_Escuela);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_RegistrarDocente` (IN `p_Nombre` VARCHAR(100))   BEGIN
    INSERT INTO Docentes (Nombre) VALUES (p_Nombre);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaciones`
--

CREATE TABLE `asignaciones` (
  `Id_Asignacion` int(11) NOT NULL,
  `Id_Docente` int(11) DEFAULT NULL,
  `Id_Curso` int(11) DEFAULT NULL,
  `Id_Aula` int(11) DEFAULT NULL,
  `Dia` varchar(20) NOT NULL,
  `Hora_Inicio` time NOT NULL,
  `Hora_Fin` time NOT NULL,
  `Grupo` varchar(10) DEFAULT NULL,
  `Cantidad_Alumnos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asignaciones`
--

INSERT INTO `asignaciones` (`Id_Asignacion`, `Id_Docente`, `Id_Curso`, `Id_Aula`, `Dia`, `Hora_Inicio`, `Hora_Fin`, `Grupo`, `Cantidad_Alumnos`) VALUES
(1, 4, 1, 2, 'Lunes', '08:00:00', '12:00:00', '3', 50),
(2, 2, 2, 3, 'Lunes', '08:00:00', '13:00:00', '8', 40);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aulas`
--

CREATE TABLE `aulas` (
  `Id_Aula` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Capacidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `aulas`
--

INSERT INTO `aulas` (`Id_Aula`, `Nombre`, `Capacidad`) VALUES
(1, '101', 30),
(2, '102', 60),
(3, '103', 59),
(4, '105', 41),
(5, '106', 40),
(6, '107', 26),
(7, '108', 27),
(8, '109', 40),
(9, '201', 30),
(10, '202', 30),
(11, '203', 30),
(12, '204', 30),
(13, '205', 30),
(14, '209', 60),
(15, '210', 30),
(16, '211', 30),
(17, '212', 30),
(18, 'magna', 80),
(19, 'np101', 40),
(20, 'np102', 45),
(21, 'np103', 45),
(22, 'np105', 42),
(23, 'np106', 45),
(24, 'np107', 40),
(25, 'np108', 45),
(26, 'np109', 36),
(27, 'np201', 50),
(28, 'np203', 51),
(29, 'np205', 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `Id_Curso` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Ciclo` int(11) NOT NULL,
  `Id_Escuela` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`Id_Curso`, `Nombre`, `Ciclo`, `Id_Escuela`) VALUES
(1, '(2023) (2018) REDACCIÓN Y TÉCNICAS DE COMUNICACIÓN EFECTIVA I', 1, 1),
(2, '(2023) (2018) SERIES Y ECUACIONES DIFERENCIALES (2014) SERIES Y ECUACIONES DIFERENCIALES', 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `Id_Docente` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`Id_Docente`, `Nombre`) VALUES
(1, 'VEGA HUERTA, Hugo Froilan'),
(2, 'FERMIN PEREZ, Felix Armando'),
(3, 'ARIAS RAMIREZ ANGELA'),
(4, 'RIOS DELGADO JHOANNA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escuelas`
--

CREATE TABLE `escuelas` (
  `Id_Escuela` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `escuelas`
--

INSERT INTO `escuelas` (`Id_Escuela`, `Nombre`) VALUES
(1, 'EPIS'),
(2, 'EPISW');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD PRIMARY KEY (`Id_Asignacion`),
  ADD KEY `Id_Docente` (`Id_Docente`),
  ADD KEY `Id_Curso` (`Id_Curso`),
  ADD KEY `Id_Aula` (`Id_Aula`);

--
-- Indices de la tabla `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`Id_Aula`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`Id_Curso`),
  ADD KEY `Id_Escuela` (`Id_Escuela`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`Id_Docente`);

--
-- Indices de la tabla `escuelas`
--
ALTER TABLE `escuelas`
  ADD PRIMARY KEY (`Id_Escuela`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  MODIFY `Id_Asignacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `aulas`
--
ALTER TABLE `aulas`
  MODIFY `Id_Aula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `Id_Curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `Id_Docente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `escuelas`
--
ALTER TABLE `escuelas`
  MODIFY `Id_Escuela` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD CONSTRAINT `asignaciones_ibfk_1` FOREIGN KEY (`Id_Docente`) REFERENCES `docentes` (`Id_Docente`),
  ADD CONSTRAINT `asignaciones_ibfk_2` FOREIGN KEY (`Id_Curso`) REFERENCES `cursos` (`Id_Curso`),
  ADD CONSTRAINT `asignaciones_ibfk_3` FOREIGN KEY (`Id_Aula`) REFERENCES `aulas` (`Id_Aula`);

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`Id_Escuela`) REFERENCES `escuelas` (`Id_Escuela`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
