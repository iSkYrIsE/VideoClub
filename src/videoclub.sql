-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-01-2021 a las 17:30:36
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `videoclub`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alquileres`
--

CREATE TABLE `alquileres` (
  `CodAlquiler` int(6) NOT NULL,
  `CodCliente` int(6) NOT NULL,
  `CodPelicula` int(6) NOT NULL,
  `CodFactura` int(6) NOT NULL,
  `FechaFinAlquiler` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alquileres`
--

INSERT INTO `alquileres` (`CodAlquiler`, `CodCliente`, `CodPelicula`, `CodFactura`, `FechaFinAlquiler`) VALUES
(3, 7, 19, 2, '2021-06-22'),
(13, 5, 31, 13, '2021-02-01'),
(14, 5, 31, 14, '2021-02-01'),
(15, 5, 17, 15, '2021-02-02'),
(16, 5, 21, 16, '2021-02-02'),
(18, 5, 28, 18, '2021-02-05'),
(19, 5, 27, 19, '2021-02-05'),
(20, 0, 27, 20, '2021-02-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `CodCliente` int(6) NOT NULL,
  `Nombre` varchar(15) NOT NULL,
  `Email` varchar(25) NOT NULL,
  `Clave` varchar(20) NOT NULL,
  `CuentaBancaria` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`CodCliente`, `Nombre`, `Email`, `Clave`, `CuentaBancaria`) VALUES
(0, '-', '-', '-', '-'),
(5, 'Juan', 'elmejor@gmail.com', 'asdf', '2345 2345 98765432109876'),
(6, 'Brais', 'recuperacion@gmail.com', '1234', '5555 2345 98765432559876'),
(7, 'Robertito ', 'robertito@gmail.com', 'qwerty', '6666 2345 98765432109876'),
(8, 'Maria', 'peleta@gmail.com', '1234', '8888 2345 98765432109876');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `CodFactura` int(6) NOT NULL,
  `PrecioTotal` float NOT NULL,
  `FechaFactura` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`CodFactura`, `PrecioTotal`, `FechaFactura`) VALUES
(1, 7, '2020-10-10'),
(2, 6, '2020-09-09'),
(4, 6.4, '2021-01-25'),
(5, 12, '2021-01-25'),
(6, 12, '2021-01-25'),
(7, 12, '2021-01-25'),
(8, 12, '2021-01-25'),
(9, 12, '2021-01-25'),
(10, 12, '2021-01-25'),
(11, 12, '2021-01-25'),
(12, 12, '2021-01-25'),
(13, 12, '2021-01-25'),
(14, 15, '2021-01-25'),
(15, 4, '2021-01-26'),
(16, 4.5, '2021-01-26'),
(18, 7, '2021-01-29'),
(19, 9, '2021-01-29'),
(20, 9, '2021-01-29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas`
--

CREATE TABLE `ofertas` (
  `CodOferta` int(6) NOT NULL,
  `Descuento` int(3) NOT NULL,
  `DescripcionDescuento` text NOT NULL,
  `NombreOferta` varchar(20) NOT NULL,
  `FechaIni` date NOT NULL,
  `FechaFin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ofertas`
--

INSERT INTO `ofertas` (`CodOferta`, `Descuento`, `DescripcionDescuento`, `NombreOferta`, `FechaIni`, `FechaFin`) VALUES
(2, 20, 'Descuento por Halloween, todas las pelis de terror tendran un 20% de descuento', 'Halloween', '2021-10-21', '2021-11-11'),
(3, 25, 'Descuento por San Valentin, todas las pelis de romance tendran un 25% de descuento', 'SanValentin', '2021-02-07', '2021-02-21'),
(4, 30, 'Descuento por dia del niño, todas las pelis de infantil tendran un 30% de descuento', 'Infantil', '2021-11-01', '2021-11-17'),
(5, 20, 'Descuento por Navidad, todas las pelis de tematica navidadad tendran un 20% de descuento', 'Navidad', '2021-12-21', '2021-12-31'),
(6, 10, 'Descuento por dia de la tierra, todas ldocumentales dsobre la tierra un 20% de descuento', 'Documental', '2021-04-15', '2021-04-28'),
(12, 70, 'Descuento por peliculas antiguas, todas las pelis anteriores a los años 80 tendran un 70% de descuento', 'Antiguas', '2021-01-21', '2021-12-31'),
(18, 30, 'Semana santa', 'Semana Santa', '2021-04-14', '2021-04-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `CodPelicula` int(6) NOT NULL,
  `Titulo` varchar(30) NOT NULL,
  `Genero` varchar(20) NOT NULL,
  `DesactivarPelicula` tinyint(1) DEFAULT NULL,
  `AnnoProduccion` date NOT NULL,
  `AnnoEstreno` date NOT NULL,
  `Precio` float NOT NULL,
  `CodOferta` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`CodPelicula`, `Titulo`, `Genero`, `DesactivarPelicula`, `AnnoProduccion`, `AnnoEstreno`, `Precio`, `CodOferta`) VALUES
(17, 'Viernes 13', 'Terror', 0, '1995-03-04', '1996-04-05', 4, 2),
(18, 'La Sirenita', 'Animacion', 0, '1996-01-01', '1997-02-02', 10, 4),
(19, 'Pocahontas', 'Animacion', 0, '1998-03-03', '1999-06-02', 12, 4),
(20, 'Mulan', 'Animacion', 0, '2000-07-05', '2001-04-02', 8, 4),
(21, 'El Laberinto Del Fauno', 'Antigua', 0, '1984-02-02', '1985-04-05', 15, 12),
(22, 'PulpFiction', 'Antigua', 0, '1997-03-03', '1998-04-04', 8, 12),
(23, 'National Geography', 'Documental', 0, '2001-02-02', '2001-05-06', 8, 6),
(24, 'Cuento de Navidad', 'Familiar', 0, '2001-10-08', '2003-04-12', 15, 5),
(25, 'Solo en Casa 20', 'Familiar', 0, '1998-02-03', '1999-02-02', 8, 5),
(26, 'Atrevete si me quieres', 'Romance', 0, '2001-02-04', '2001-04-06', 15, 3),
(27, 'Amelie', 'Romance', 0, '1995-02-04', '1998-04-05', 9, 3),
(28, 'Avatar', 'Accion', 0, '2001-01-03', '2004-08-09', 7, NULL),
(29, 'IronMan', 'Accion', 0, '2002-12-23', '2003-09-22', 4, NULL),
(31, 'Scary Movie', 'Terror', 1, '2000-01-23', '2000-01-30', 15, 2),
(38, 'Scary Movie 2', 'Terror', 0, '2020-03-12', '2020-03-12', 20, NULL),
(39, 'Scary Movie 2', 'Terror', 0, '2010-10-10', '2011-10-10', 14, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoraciones`
--

CREATE TABLE `valoraciones` (
  `CodValoracion` int(6) NOT NULL,
  `CodPelicula` int(6) NOT NULL,
  `Puntuacion` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `valoraciones`
--

INSERT INTO `valoraciones` (`CodValoracion`, `CodPelicula`, `Puntuacion`) VALUES
(1, 29, 4),
(2, 29, 1),
(3, 29, 5),
(4, 17, 5),
(5, 17, 4),
(6, 17, 2),
(7, 21, 5),
(8, 21, 4),
(9, 21, 2),
(10, 20, 3),
(11, 20, 3),
(12, 20, 4),
(13, 20, 5),
(14, 29, 2),
(15, 29, 1),
(16, 29, 5),
(17, 29, 5),
(18, 21, 5),
(19, 21, 3),
(20, 21, 1),
(21, 21, 4),
(23, 21, 5),
(24, 28, 4),
(25, 17, 3),
(26, 17, 3),
(27, 17, 4),
(28, 17, 4),
(29, 17, 4),
(30, 21, 1),
(31, 21, 1),
(32, 21, 1),
(33, 21, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alquileres`
--
ALTER TABLE `alquileres`
  ADD PRIMARY KEY (`CodAlquiler`),
  ADD KEY `CodCliente` (`CodCliente`),
  ADD KEY `CodFactura` (`CodFactura`),
  ADD KEY `CodPelicula` (`CodPelicula`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`CodCliente`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`CodFactura`);

--
-- Indices de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD PRIMARY KEY (`CodOferta`),
  ADD UNIQUE KEY `NombreOferta` (`NombreOferta`);

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`CodPelicula`),
  ADD KEY `CodOferta` (`CodOferta`);

--
-- Indices de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD PRIMARY KEY (`CodValoracion`),
  ADD KEY `CodPelicula` (`CodPelicula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alquileres`
--
ALTER TABLE `alquileres`
  MODIFY `CodAlquiler` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `CodCliente` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `CodFactura` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  MODIFY `CodOferta` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `CodPelicula` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  MODIFY `CodValoracion` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alquileres`
--
ALTER TABLE `alquileres`
  ADD CONSTRAINT `alquileres_ibfk_1` FOREIGN KEY (`CodCliente`) REFERENCES `clientes` (`CodCliente`),
  ADD CONSTRAINT `alquileres_ibfk_2` FOREIGN KEY (`CodFactura`) REFERENCES `facturas` (`CodFactura`),
  ADD CONSTRAINT `alquileres_ibfk_3` FOREIGN KEY (`CodPelicula`) REFERENCES `peliculas` (`CodPelicula`);

--
-- Filtros para la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD CONSTRAINT `peliculas_ibfk_1` FOREIGN KEY (`CodOferta`) REFERENCES `ofertas` (`CodOferta`);

--
-- Filtros para la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD CONSTRAINT `valoraciones_ibfk_1` FOREIGN KEY (`CodPelicula`) REFERENCES `peliculas` (`CodPelicula`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
