-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-04-2026 a las 02:55:19
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
-- Base de datos: `zeus`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_disciplinas`
--

CREATE TABLE `categoria_disciplinas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria_disciplinas`
--

INSERT INTO `categoria_disciplinas` (`id`, `nombre`) VALUES
(1, 'Sala de Máquinas y Pesas'),
(2, 'Entrenamiento Funcional'),
(3, 'Área de Cardio'),
(4, 'Sesión con Entrenador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_estados_cita`
--

CREATE TABLE `categoria_estados_cita` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria_estados_cita`
--

INSERT INTO `categoria_estados_cita` (`id`, `nombre`) VALUES
(1, 'Pendiente'),
(2, 'Completada'),
(3, 'Cancelada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_estados_usuario`
--

CREATE TABLE `categoria_estados_usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria_estados_usuario`
--

INSERT INTO `categoria_estados_usuario` (`id`, `nombre`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_membresias`
--

CREATE TABLE `categoria_membresias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria_membresias`
--

INSERT INTO `categoria_membresias` (`id`, `nombre`) VALUES
(1, 'Ninguna'),
(2, 'Estándar'),
(3, 'Premium');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_roles`
--

CREATE TABLE `categoria_roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria_roles`
--

INSERT INTO `categoria_roles` (`id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Cliente'),
(3, 'Entrenador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_disciplina` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `bloque_horario` varchar(50) NOT NULL,
  `notas` text DEFAULT NULL,
  `id_estado_cita` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_rol` int(11) NOT NULL DEFAULT 2,
  `id_membresia` int(11) DEFAULT NULL,
  `id_estado_usuario` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria_disciplinas`
--
ALTER TABLE `categoria_disciplinas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria_estados_cita`
--
ALTER TABLE `categoria_estados_cita`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria_estados_usuario`
--
ALTER TABLE `categoria_estados_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria_membresias`
--
ALTER TABLE `categoria_membresias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria_roles`
--
ALTER TABLE `categoria_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cita_usuario` (`id_usuario`),
  ADD KEY `fk_cita_disciplina` (`id_disciplina`),
  ADD KEY `fk_cita_estado` (`id_estado_cita`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cedula` (`cedula`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_usuario_membresia` (`id_membresia`),
  ADD KEY `fk_usuario_estado` (`id_estado_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria_disciplinas`
--
ALTER TABLE `categoria_disciplinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `categoria_estados_cita`
--
ALTER TABLE `categoria_estados_cita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categoria_estados_usuario`
--
ALTER TABLE `categoria_estados_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categoria_membresias`
--
ALTER TABLE `categoria_membresias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categoria_roles`
--
ALTER TABLE `categoria_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `fk_cita_disciplina` FOREIGN KEY (`id_disciplina`) REFERENCES `categoria_disciplinas` (`id`),
  ADD CONSTRAINT `fk_cita_estado` FOREIGN KEY (`id_estado_cita`) REFERENCES `categoria_estados_cita` (`id`),
  ADD CONSTRAINT `fk_cita_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuario_estado` FOREIGN KEY (`id_estado_usuario`) REFERENCES `categoria_estados_usuario` (`id`),
  ADD CONSTRAINT `fk_usuario_membresia` FOREIGN KEY (`id_membresia`) REFERENCES `categoria_membresias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
