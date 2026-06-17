-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-06-2026 a las 07:58:33
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
-- Base de datos: `eldorado_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asientos`
--

CREATE TABLE `asientos` (
  `id` int(10) UNSIGNED NOT NULL,
  `bus_id` int(10) UNSIGNED NOT NULL,
  `numero` varchar(4) NOT NULL,
  `tipo` enum('normal','premium') NOT NULL DEFAULT 'normal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `asientos`
--

INSERT INTO `asientos` (`id`, `bus_id`, `numero`, `tipo`) VALUES
(1, 1, 'A1', 'premium'),
(2, 1, 'A2', 'premium'),
(3, 1, 'A3', 'premium'),
(4, 1, 'A4', 'premium'),
(5, 1, 'B1', 'premium'),
(6, 1, 'B2', 'premium'),
(7, 1, 'B3', 'premium'),
(8, 1, 'B4', 'premium'),
(9, 1, 'C1', 'normal'),
(10, 1, 'C2', 'normal'),
(11, 1, 'C3', 'normal'),
(12, 1, 'C4', 'normal'),
(13, 1, 'D1', 'normal'),
(14, 1, 'D2', 'normal'),
(15, 1, 'D3', 'normal'),
(16, 1, 'D4', 'normal'),
(17, 1, 'E1', 'normal'),
(18, 1, 'E2', 'normal'),
(19, 1, 'E3', 'normal'),
(20, 1, 'E4', 'normal'),
(21, 1, 'F1', 'normal'),
(22, 1, 'F2', 'normal'),
(23, 1, 'F3', 'normal'),
(24, 1, 'F4', 'normal'),
(25, 1, 'G1', 'normal'),
(26, 1, 'G2', 'normal'),
(27, 1, 'G3', 'normal'),
(28, 1, 'G4', 'normal'),
(29, 1, 'H1', 'normal'),
(30, 1, 'H2', 'normal'),
(31, 1, 'H3', 'normal'),
(32, 1, 'H4', 'normal'),
(33, 1, 'I1', 'normal'),
(34, 1, 'I2', 'normal'),
(35, 1, 'I3', 'normal'),
(36, 1, 'I4', 'normal'),
(37, 1, 'J1', 'normal'),
(38, 1, 'J2', 'normal'),
(39, 1, 'J3', 'normal'),
(40, 1, 'J4', 'normal'),
(64, 2, 'A1', 'premium'),
(65, 2, 'A2', 'premium'),
(66, 2, 'A3', 'premium'),
(67, 2, 'A4', 'premium'),
(68, 2, 'B1', 'premium'),
(69, 2, 'B2', 'premium'),
(70, 2, 'B3', 'premium'),
(71, 2, 'B4', 'premium'),
(72, 2, 'C1', 'normal'),
(73, 2, 'C2', 'normal'),
(74, 2, 'C3', 'normal'),
(75, 2, 'C4', 'normal'),
(76, 2, 'D1', 'normal'),
(77, 2, 'D2', 'normal'),
(78, 2, 'D3', 'normal'),
(79, 2, 'D4', 'normal'),
(80, 2, 'E1', 'normal'),
(81, 2, 'E2', 'normal'),
(82, 2, 'E3', 'normal'),
(83, 2, 'E4', 'normal'),
(84, 2, 'F1', 'normal'),
(85, 2, 'F2', 'normal'),
(86, 2, 'F3', 'normal'),
(87, 2, 'F4', 'normal'),
(88, 2, 'G1', 'normal'),
(89, 2, 'G2', 'normal'),
(90, 2, 'G3', 'normal'),
(91, 2, 'G4', 'normal'),
(92, 2, 'H1', 'normal'),
(93, 2, 'H2', 'normal'),
(94, 2, 'H3', 'normal'),
(95, 2, 'H4', 'normal'),
(96, 2, 'I1', 'normal'),
(97, 2, 'I2', 'normal'),
(98, 2, 'I3', 'normal'),
(99, 2, 'I4', 'normal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `buses`
--

CREATE TABLE `buses` (
  `id` int(10) UNSIGNED NOT NULL,
  `placa` varchar(10) NOT NULL,
  `tipo` enum('economico','ejecutivo','premium_cama') NOT NULL DEFAULT 'ejecutivo',
  `total_seats` tinyint(3) UNSIGNED NOT NULL DEFAULT 40,
  `imagen` varchar(200) DEFAULT 'bus_default.jpg',
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `buses`
--

INSERT INTO `buses` (`id`, `placa`, `tipo`, `total_seats`, `imagen`, `activo`) VALUES
(1, '2345-BLV', 'ejecutivo', 40, 'bus_ejecutivo.jpg', 1),
(2, '6789-SCZ', 'premium_cama', 36, 'bus_premium.jpg', 1),
(3, '1122-CBB', 'economico', 44, 'bus_economico.jpg', 1),
(4, '3344-LPZ', 'ejecutivo', 40, 'bus_ejecutivo.jpg', 1),
(5, '5566-ORU', 'premium_cama', 36, 'bus_premium.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `codigo` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`id`, `nombre`, `codigo`) VALUES
(1, 'La Paz', 'LPZ'),
(2, 'Santa Cruz', 'SCZ'),
(3, 'Cochabamba', 'CBB'),
(4, 'Sucre', 'SRE'),
(5, 'Potosí', 'POT'),
(6, 'Oruro', 'ORU'),
(7, 'Trinidad', 'TDD'),
(8, 'Tarija', 'TJA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `ruta_id` int(10) UNSIGNED NOT NULL,
  `bus_id` int(10) UNSIGNED NOT NULL,
  `hora_salida` time NOT NULL,
  `hora_llegada` time NOT NULL,
  `dias` set('lun','mar','mie','jue','vie','sab','dom') NOT NULL DEFAULT 'lun,mar,mie,jue,vie,sab,dom',
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id`, `ruta_id`, `bus_id`, `hora_salida`, `hora_llegada`, `dias`, `activo`) VALUES
(1, 1, 1, '08:00:00', '16:00:00', 'lun,mar,mie,jue,vie,sab,dom', 1),
(2, 1, 2, '20:00:00', '04:00:00', 'lun,mar,mie,jue,vie,sab,dom', 1),
(3, 2, 3, '07:30:00', '13:30:00', 'lun,mar,mie,jue,vie,sab,dom', 1),
(4, 2, 4, '14:00:00', '20:00:00', 'lun,mar,mie,jue,vie,sab,dom', 1),
(5, 3, 5, '19:00:00', '04:30:00', 'lun,mar,mie,jue,vie,sab,dom', 1),
(6, 4, 1, '09:00:00', '14:00:00', 'lun,mar,mie,jue,vie,sab,dom', 1),
(7, 5, 3, '11:00:00', '14:00:00', 'lun,mar,mie,jue,vie,sab,dom', 1),
(8, 6, 4, '06:00:00', '09:30:00', 'lun,mar,mie,jue,vie,sab,dom', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(10) UNSIGNED NOT NULL,
  `reserva_id` int(10) UNSIGNED NOT NULL,
  `monto` decimal(8,2) NOT NULL,
  `estado` enum('pendiente','aprobado','rechazado','reembolsado') NOT NULL DEFAULT 'pendiente',
  `referencia` varchar(80) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `reserva_id`, `monto`, `estado`, `referencia`, `created_at`) VALUES
(1, 1, 85.00, 'aprobado', 'TXN-001-2025', '2026-06-16 19:06:47'),
(2, 2, 60.00, 'aprobado', 'QR-002-2025', '2026-06-16 19:06:47'),
(3, 3, 110.00, 'pendiente', NULL, '2026-06-16 19:06:47'),
(4, 5, 85.00, 'aprobado', 'TXN-41AE1D59', '2026-06-16 19:48:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(12) NOT NULL,
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `viaje_id` int(10) UNSIGNED NOT NULL,
  `asiento_id` int(10) UNSIGNED NOT NULL,
  `nombre_pasajero` varchar(80) NOT NULL,
  `apellido_pasajero` varchar(80) NOT NULL,
  `ci_pasajero` varchar(20) NOT NULL,
  `precio_final` decimal(8,2) NOT NULL,
  `estado` enum('pendiente','confirmada','cancelada') NOT NULL DEFAULT 'pendiente',
  `metodo_pago` enum('tarjeta','qr','efectivo') DEFAULT 'tarjeta',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `codigo`, `usuario_id`, `viaje_id`, `asiento_id`, `nombre_pasajero`, `apellido_pasajero`, `ci_pasajero`, `precio_final`, `estado`, `metodo_pago`, `created_at`) VALUES
(1, 'BB-482931', 4, 1, 5, 'Carlos', 'Mamani', '7654321', 85.00, 'confirmada', 'tarjeta', '2026-06-16 19:06:47'),
(2, 'BB-391047', 2, 3, 6, 'Carlos', 'Mamani', '7654321', 60.00, 'confirmada', 'qr', '2026-06-16 19:06:47'),
(3, 'BB-205813', 3, 5, 10, 'Sofia', 'Quispe', '8123456', 110.00, 'pendiente', 'tarjeta', '2026-06-16 19:06:47'),
(4, 'TEST-001', 4, 1, 5, 'Nain', 'Prueba', '1234567', 85.00, 'confirmada', 'tarjeta', '2026-06-16 19:42:00'),
(5, 'BB-F794DA', 4, 1, 9, 'Juan', 'Perez', '133216659', 85.00, 'confirmada', 'tarjeta', '2026-06-16 19:48:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas`
--

CREATE TABLE `rutas` (
  `id` int(10) UNSIGNED NOT NULL,
  `origen_id` int(10) UNSIGNED NOT NULL,
  `destino_id` int(10) UNSIGNED NOT NULL,
  `distancia_km` smallint(5) UNSIGNED DEFAULT NULL,
  `duracion_h` decimal(4,1) NOT NULL,
  `precio_base` decimal(8,2) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `rutas`
--

INSERT INTO `rutas` (`id`, `origen_id`, `destino_id`, `distancia_km`, `duracion_h`, `precio_base`, `activo`) VALUES
(1, 1, 2, 1500, 8.0, 85.00, 1),
(2, 1, 3, 450, 6.0, 60.00, 1),
(3, 1, 4, 750, 9.5, 95.00, 1),
(4, 2, 3, 500, 5.0, 55.00, 1),
(5, 4, 5, 160, 3.0, 35.00, 1),
(6, 6, 1, 230, 3.5, 40.00, 1),
(7, 1, 8, 1050, 12.0, 110.00, 1),
(8, 2, 7, 600, 8.0, 80.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `apellido` varchar(80) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `ci` varchar(20) DEFAULT NULL,
  `rol` enum('cliente','admin') NOT NULL DEFAULT 'cliente',
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `password`, `telefono`, `ci`, `rol`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'El Dorado', 'admin@eldorado.com', '78932155', '77000001', '1000001', 'admin', 1, '2026-06-16 19:06:47', '2026-06-16 19:33:31'),
(2, 'Carlos', 'Mamani', 'carlos@gmail.com', '12345', '78901234', '7654321', 'cliente', 1, '2026-06-16 19:06:47', '2026-06-16 19:32:42'),
(3, 'Sofia', 'Quispe', 'sofia@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '79012345', '8123456', 'cliente', 1, '2026-06-16 19:06:47', '2026-06-16 19:06:47'),
(4, 'Nain', 'Ticona', 'paco@gmail.com', '$2y$10$2B2yVrfxvzHDc9cyzYFgCex/L8QVQYUAdU7N4nB/Sjfto0.WWmIBq', '63092699', '13423693', 'cliente', 1, '2026-06-16 19:34:44', '2026-06-16 19:34:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajes`
--

CREATE TABLE `viajes` (
  `id` int(10) UNSIGNED NOT NULL,
  `horario_id` int(10) UNSIGNED NOT NULL,
  `fecha_viaje` date NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `estado` enum('programado','en_curso','completado','cancelado') NOT NULL DEFAULT 'programado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `viajes`
--

INSERT INTO `viajes` (`id`, `horario_id`, `fecha_viaje`, `precio`, `estado`) VALUES
(1, 1, '2026-06-17', 85.00, 'programado'),
(2, 1, '2026-06-18', 85.00, 'programado'),
(3, 1, '2026-06-19', 85.00, 'programado'),
(4, 2, '2026-06-17', 110.00, 'programado'),
(5, 3, '2026-06-17', 60.00, 'programado'),
(6, 3, '2026-06-18', 60.00, 'programado'),
(7, 4, '2026-06-17', 60.00, 'programado'),
(8, 5, '2026-06-17', 95.00, 'programado'),
(9, 6, '2026-06-17', 55.00, 'programado'),
(10, 7, '2026-06-17', 35.00, 'programado'),
(11, 8, '2026-06-17', 40.00, 'programado');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_mis_reservas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_mis_reservas` (
`codigo` varchar(12)
,`estado` enum('pendiente','confirmada','cancelada')
,`precio_final` decimal(8,2)
,`metodo_pago` enum('tarjeta','qr','efectivo')
,`created_at` timestamp
,`nombre_pasajero` varchar(80)
,`apellido_pasajero` varchar(80)
,`asiento` varchar(4)
,`tipo_asiento` enum('normal','premium')
,`origen` varchar(80)
,`destino` varchar(80)
,`fecha_viaje` date
,`hora_salida` time
,`hora_llegada` time
,`email` varchar(120)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_viajes_disponibles`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_viajes_disponibles` (
`viaje_id` int(10) unsigned
,`fecha_viaje` date
,`precio` decimal(8,2)
,`estado` enum('programado','en_curso','completado','cancelado')
,`origen` varchar(80)
,`destino` varchar(80)
,`hora_salida` time
,`hora_llegada` time
,`duracion_h` decimal(4,1)
,`tipo_bus` enum('economico','ejecutivo','premium_cama')
,`total_seats` tinyint(3) unsigned
,`placa` varchar(10)
,`asientos_ocupados` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `v_mis_reservas`
--
DROP TABLE IF EXISTS `v_mis_reservas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_mis_reservas`  AS SELECT `res`.`codigo` AS `codigo`, `res`.`estado` AS `estado`, `res`.`precio_final` AS `precio_final`, `res`.`metodo_pago` AS `metodo_pago`, `res`.`created_at` AS `created_at`, `res`.`nombre_pasajero` AS `nombre_pasajero`, `res`.`apellido_pasajero` AS `apellido_pasajero`, `a`.`numero` AS `asiento`, `a`.`tipo` AS `tipo_asiento`, `c_o`.`nombre` AS `origen`, `c_d`.`nombre` AS `destino`, `v`.`fecha_viaje` AS `fecha_viaje`, `h`.`hora_salida` AS `hora_salida`, `h`.`hora_llegada` AS `hora_llegada`, `u`.`email` AS `email` FROM (((((((`reservas` `res` join `viajes` `v` on(`v`.`id` = `res`.`viaje_id`)) join `horarios` `h` on(`h`.`id` = `v`.`horario_id`)) join `rutas` `r` on(`r`.`id` = `h`.`ruta_id`)) join `ciudades` `c_o` on(`c_o`.`id` = `r`.`origen_id`)) join `ciudades` `c_d` on(`c_d`.`id` = `r`.`destino_id`)) join `asientos` `a` on(`a`.`id` = `res`.`asiento_id`)) join `usuarios` `u` on(`u`.`id` = `res`.`usuario_id`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_viajes_disponibles`
--
DROP TABLE IF EXISTS `v_viajes_disponibles`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_viajes_disponibles`  AS SELECT `v`.`id` AS `viaje_id`, `v`.`fecha_viaje` AS `fecha_viaje`, `v`.`precio` AS `precio`, `v`.`estado` AS `estado`, `c_o`.`nombre` AS `origen`, `c_d`.`nombre` AS `destino`, `h`.`hora_salida` AS `hora_salida`, `h`.`hora_llegada` AS `hora_llegada`, `r`.`duracion_h` AS `duracion_h`, `b`.`tipo` AS `tipo_bus`, `b`.`total_seats` AS `total_seats`, `b`.`placa` AS `placa`, (select count(0) from `reservas` `res` where `res`.`viaje_id` = `v`.`id` and `res`.`estado` <> 'cancelada') AS `asientos_ocupados` FROM (((((`viajes` `v` join `horarios` `h` on(`h`.`id` = `v`.`horario_id`)) join `rutas` `r` on(`r`.`id` = `h`.`ruta_id`)) join `ciudades` `c_o` on(`c_o`.`id` = `r`.`origen_id`)) join `ciudades` `c_d` on(`c_d`.`id` = `r`.`destino_id`)) join `buses` `b` on(`b`.`id` = `h`.`bus_id`)) WHERE `v`.`estado` = 'programado' AND `v`.`fecha_viaje` >= curdate() ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asientos`
--
ALTER TABLE `asientos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_asiento_bus` (`bus_id`,`numero`);

--
-- Indices de la tabla `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `placa` (`placa`);

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ruta_id` (`ruta_id`),
  ADD KEY `bus_id` (`bus_id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reserva_id` (`reserva_id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `viaje_id` (`viaje_id`),
  ADD KEY `asiento_id` (`asiento_id`);

--
-- Indices de la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `origen_id` (`origen_id`),
  ADD KEY `destino_id` (`destino_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `viajes`
--
ALTER TABLE `viajes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_viaje` (`horario_id`,`fecha_viaje`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asientos`
--
ALTER TABLE `asientos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT de la tabla `buses`
--
ALTER TABLE `buses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `rutas`
--
ALTER TABLE `rutas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `viajes`
--
ALTER TABLE `viajes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asientos`
--
ALTER TABLE `asientos`
  ADD CONSTRAINT `asientos_ibfk_1` FOREIGN KEY (`bus_id`) REFERENCES `buses` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD CONSTRAINT `horarios_ibfk_1` FOREIGN KEY (`ruta_id`) REFERENCES `rutas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `horarios_ibfk_2` FOREIGN KEY (`bus_id`) REFERENCES `buses` (`id`);

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`reserva_id`) REFERENCES `reservas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`viaje_id`) REFERENCES `viajes` (`id`),
  ADD CONSTRAINT `reservas_ibfk_3` FOREIGN KEY (`asiento_id`) REFERENCES `asientos` (`id`);

--
-- Filtros para la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD CONSTRAINT `rutas_ibfk_1` FOREIGN KEY (`origen_id`) REFERENCES `ciudades` (`id`),
  ADD CONSTRAINT `rutas_ibfk_2` FOREIGN KEY (`destino_id`) REFERENCES `ciudades` (`id`);

--
-- Filtros para la tabla `viajes`
--
ALTER TABLE `viajes`
  ADD CONSTRAINT `viajes_ibfk_1` FOREIGN KEY (`horario_id`) REFERENCES `horarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
