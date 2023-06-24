-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 24-06-2023 a las 21:52:18
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `restaurante`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `id` int NOT NULL,
  `plato` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `ingredientes` varchar(255) NOT NULL,
  `precio` int NOT NULL,
  `popularidad` int NOT NULL DEFAULT '4',
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id`, `plato`, `descripcion`, `ingredientes`, `precio`, `popularidad`, `img`) VALUES
(1, 'SALMÓN A LA PLANCHA CON ARROZ Y ESPÁRRAGOS', 'El salmón a la plancha con arroz y espárragos es un plato delicioso y saludable que combina ingredientes frescos y sabores equilibrados.', '600 g de salmón, 1 limón, 400 g de espárragos trigueros, 400 g de arroz, 8 dl de caldo de verduras, 2 puerros, 1 dl de vino blanco, 4 ajos, Aceite de oliva, Sal, Pimienta.', 47, 4, '../assets\\img\\2.jpg'),
(2, 'SOLOMILLO CON SALSA VERDE', 'El solomillo con salsa verde es un exquisito plato que destaca por su jugoso solomillo de carne de res acompañado de una deliciosa salsa verde.', '700 g de solomillo de ternera, 150 g de yuca, 1/2 cebolla, 1 dl de nata para montar, Albahaca fresca, Perejil, Aceite de oliva, Sal, Pimienta.', 50, 5, '../assets/img/solomillo.jpg'),
(3, 'COSTILLAS DE CERDO CON VINO TINTO', 'Las costillas de cerdo con vino tinto son un plato delicioso y sabroso que combina tiernas costillas de cerdo con una rica salsa de vino tinto.', '1,5 kg de costillar de cerdo, 1 cebolla, 2 zanahorias, 1 tallo de apio, 2 cucharadas de salsa de tomate, 1/2 l de vino tinto, 1 hoja de laurel, 2 dl de caldo de pollo, 1 cabeza de ajos, Sal, Pimienta.', 87, 5, '../assets/img/costillas.jpg'),
(4, 'LASAÑA DE LENGUADO', 'La lasaña de lenguado es un plato exquisito y sofisticado que combina capas de finas láminas de lenguado con una deliciosa mezcla de ingredientes.', '1 paquete de lasaña, 100 g de aceitunas negras, 1 ajo, 500 g de lenguado en filetes, 250 g de pimientos del piquillo, Mayonesa, Aceite de oliva, Sal, Pimienta.', 73, 4, '../assets/img/lasaña.jpg'),
(5, 'PESCADO ENVUELTO EN PASTA FILO', 'El plato de \"Pescado envuelto en pasta filo\" es una deliciosa preparación culinaria en la que un filete de pescado fresco se envuelve en finas capas de pasta filo, creando una textura crujiente y dorada al hornearse.', '4 filetes de gallo o similar, 8 hojas de pasta filo, 180 g de carne de cangrejo, 1/2 taza de champiñones picados, Perejil picado, Eneldo, 1 taza de pan rallado fresco, 1/2 taza de mantequilla derretida, Sal, Pimienta.', 36, 3, '../assets/img/pasta.jpg'),
(6, 'MUSLOS DE PAVO CON VERDURAS Y PATATAS ASADAS', 'Los muslos de pavo con verduras y patatas asadas es un plato delicioso y saludable.', '2 muslos de pavo, 1 cebolla, 1 pimiento verde, 1 pimiento rojo, 4 patatas, 2 ajos, 1 dl de cerveza rubia, Sal, Pimienta, Aceite de oliva, Perejil picado.', 60, 5, '../assets/img/pollo.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `id` int NOT NULL,
  `mesa` varchar(255) NOT NULL,
  `disponible` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'true'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id`, `mesa`, `disponible`) VALUES
(1, 'mesa 2', 'true'),
(2, 'mesa 1', 'true'),
(3, 'mesa 7', 'true'),
(5, 'mesa 18', 'true');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_reservas`
--

CREATE TABLE `registro_reservas` (
  `id` int NOT NULL,
  `fecha` date NOT NULL,
  `hora` varchar(255) NOT NULL,
  `rol` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'cliente',
  `id_usuario` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int NOT NULL,
  `fecha` date NOT NULL,
  `hora` varchar(255) NOT NULL,
  `mesa` varchar(255) NOT NULL,
  `id_usuario` int NOT NULL,
  `id_mesa` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `fecha`, `hora`, `mesa`, `id_usuario`, `id_mesa`) VALUES
(64, '2023-06-22', '21:00', 'mesa 2', 29, 1);

--
-- Disparadores `reservas`
--
DELIMITER $$
CREATE TRIGGER `registro` AFTER INSERT ON `reservas` FOR EACH ROW INSERT INTO `registro_reservas`(`fecha`, `hora`,  `id_usuario`) VALUES (NEW.fecha, NEW.hora,NEW.id_usuario)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `rol` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `id_rol` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `clave`, `id_rol`) VALUES
(27, 'CARLOS', 'test@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 2),
(28, 'FABRIZIO', 'fabio@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1),
(29, 'SEBASTIAN', 'asda@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 2),
(30, 'LEROY', 'fab123io@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mesa` (`mesa`);

--
-- Indices de la tabla `registro_reservas`
--
ALTER TABLE `registro_reservas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_mesa` (`id_mesa`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `registro_reservas`
--
ALTER TABLE `registro_reservas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`id_mesa`) REFERENCES `mesas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
