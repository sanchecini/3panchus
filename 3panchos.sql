-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-08-2021 a las 18:34:12
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `3panchos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `domicilio` varchar(120) NOT NULL,
  `municipio` varchar(100) NOT NULL,
  `telefono` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id`, `nombre`, `imagen`, `descripcion`, `domicilio`, `municipio`, `telefono`) VALUES
(1, 'Contacto', '1629960385_contacto.jpg', 'El mejor restorante familiar', 'Hermilio 19 Colonia VLG', 'El Grullo, Jalisco', '321 690 1416');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta`
--

CREATE TABLE `encuesta` (
  `id` int(11) NOT NULL,
  `pregunta` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `encuesta`
--

INSERT INTO `encuesta` (`id`, `pregunta`) VALUES
(1, '¿Que te parece nuestro sitio web?'),
(2, 'Hola como estas?');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta_resultados`
--

CREATE TABLE `encuesta_resultados` (
  `id` int(11) NOT NULL,
  `respuesta1` varchar(50) NOT NULL,
  `voto1` float NOT NULL,
  `respuesta2` varchar(50) NOT NULL,
  `voto2` float NOT NULL,
  `respuesta3` varchar(50) NOT NULL,
  `voto3` float NOT NULL,
  `respuesta4` varchar(50) NOT NULL,
  `voto4` float NOT NULL,
  `respuesta5` varchar(50) NOT NULL,
  `voto5` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `encuesta_resultados`
--

INSERT INTO `encuesta_resultados` (`id`, `respuesta1`, `voto1`, `respuesta2`, `voto2`, `respuesta3`, `voto3`, `respuesta4`, `voto4`, `respuesta5`, `voto5`) VALUES
(1, 'Excelente', 2, 'Excelente', 0, 'Excelente', 0, 'Excelente', 0, 'Excelente', 0),
(2, 'Buena', 0, 'Buena', 0, 'Buena', 0, 'Buena', 0, 'Regular', 0),
(3, 'Regular', 0, 'Regular', 0, 'Regular', 0, 'Regular', 0, 'Regular', 0),
(4, 'Mala', 2, 'Mala', 0, 'Mala', 0, 'Mala', 0, 'Mala', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `imagen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `nombre`, `descripcion`, `imagen`) VALUES
(2, 'Cumpleaños', 'Rigo se celebro con nosotros', '1629680726_cash.png'),
(3, 'XV años de Lisa', 'Celebramos a Lisa sus 15 primaveras', '1629958539_2x1.jpg'),
(4, 'Aniversario de matrimonio', 'Lucas y Ana celebraron sus 30 años de casados', '1629958593_about.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(120) NOT NULL,
  `imagen` varchar(80) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id`, `nombre`, `descripcion`, `imagen`, `categoria`, `precio`) VALUES
(1, 'camaron', 'ricos camarones', '1629924704_yes.png', 'comida', 123),
(2, 'coca-cola', 'refresco de cola', '1629924828_aguachile-negro.jpg', 'bebida', 12),
(8, 'Aguachile', 'Pa que te arda la coliflor', '1629956774_camaron-chacal.jpg', 'Comida', 200),
(9, 'Molcajete Premium', 'De todo lleva esta madre', '1629956871_aguachile-negro.jpg', 'Comida', 400);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nosotros`
--

CREATE TABLE `nosotros` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `descripcion2` varchar(100) NOT NULL,
  `mision` text NOT NULL,
  `vision` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `nosotros`
--

INSERT INTO `nosotros` (`id`, `nombre`, `imagen`, `descripcion`, `descripcion2`, `mision`, `vision`) VALUES
(1, 'Tres Panchos Restaurante familiar', '1629757327_logo_pancho.png', 'Somos un grupo de personas que brinda el mejor de los servicios', 'Somos un grupo de personas que brinda el mejor de los servicios', '“Dar forma al futuro del Internet con la creación de valor y oportunidad sin precedentes para nuestros clientes, empleados, inversores y ecosistema de socios.”', '  ​“Ser el mejor restorante reconocido por su calidad y generación de bienestar a su entorno.”');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `dias` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `promociones`
--

INSERT INTO `promociones` (`id`, `nombre`, `descripcion`, `imagen`, `dias`) VALUES
(1, 'Juebebes', 'Compra tu cubeta de cerveza al 50%', '1629679402_logo2.png', 'Jueves'),
(2, 'Promo Cumpleañero', 'Ven a celebrar tu cumpleaños y te regalamos un platillo con su respectiva bebida', '1629943129_camarones-zarandeados.jpg', 'Todos los dias'),
(3, '2 X 1', 'Aprovecha esta promocion al comprar una cerveza te damos otra', '1629957168_2x1.jpg', 'Lunes a Viernes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(40) NOT NULL,
  `passwd` varchar(60) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `passwd`, `nombre`, `tipo`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Rayzo', 1),
(3, 'panel', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Jojo', 1),
(4, 'admin2', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Naranjo', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `encuesta_resultados`
--
ALTER TABLE `encuesta_resultados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nosotros`
--
ALTER TABLE `nosotros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `encuesta_resultados`
--
ALTER TABLE `encuesta_resultados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `nosotros`
--
ALTER TABLE `nosotros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `promociones`
--
ALTER TABLE `promociones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
