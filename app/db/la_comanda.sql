-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 18, 2024 at 03:47 AM
-- Server version: 8.0.29
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `la_comanda`
--

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `id` int UNSIGNED NOT NULL,
  `idUsuario` int UNSIGNED NOT NULL,
  `codigoPedido` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `dineroDisponible` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`id`, `idUsuario`, `codigoPedido`, `dineroDisponible`) VALUES
(1, 12, NULL, '5000.00'),
(2, 13, NULL, '2500.00');

-- --------------------------------------------------------

--
-- Table structure for table `empleados`
--

CREATE TABLE `empleados` (
  `id` int UNSIGNED NOT NULL,
  `idUsuario` int UNSIGNED NOT NULL,
  `salario` decimal(10,2) UNSIGNED NOT NULL,
  `rol` enum('Bartender','Cerveceros','Cocineros','Mozos','Socios') NOT NULL,
  `fechaIngreso` datetime DEFAULT CURRENT_TIMESTAMP,
  `estado` enum('Activo','Inactivo') DEFAULT 'Inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `empleados`
--

INSERT INTO `empleados` (`id`, `idUsuario`, `salario`, `rol`, `fechaIngreso`, `estado`) VALUES
(1, 1, '50000.00', 'Socios', '2024-01-01 00:00:00', 'Activo'),
(2, 2, '50000.00', 'Socios', '2024-01-01 00:00:00', 'Activo'),
(3, 3, '50000.00', 'Socios', '2024-01-01 00:00:00', 'Activo'),
(4, 4, '25000.00', 'Bartender', '2024-01-06 00:00:00', 'Activo'),
(5, 5, '25000.00', 'Bartender', '2024-01-06 00:00:00', 'Activo'),
(6, 6, '24000.00', 'Cerveceros', '2024-01-06 00:00:00', 'Activo'),
(7, 7, '24000.00', 'Cerveceros', '2024-01-06 00:00:00', 'Activo'),
(8, 8, '30000.00', 'Cocineros', '2024-01-06 00:00:00', 'Activo'),
(9, 9, '30000.00', 'Cocineros', '2024-01-06 00:00:00', 'Activo'),
(10, 10, '20000.00', 'Mozos', '2024-01-06 00:00:00', 'Activo'),
(11, 11, '20000.00', 'Mozos', '2024-01-06 00:00:00', 'Activo');

-- --------------------------------------------------------

--
-- Table structure for table `mesas`
--

CREATE TABLE `mesas` (
  `id` int UNSIGNED NOT NULL,
  `codigoMesa` varchar(5) NOT NULL,
  `estado` enum('Abierta','Cliente Pagando','Cliente Comiendo','Cliente Esperando Pedido','Cerrada') NOT NULL DEFAULT 'Abierta'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mesas`
--

INSERT INTO `mesas` (`id`, `codigoMesa`, `estado`) VALUES
(1, 'M-001', 'Abierta'),
(2, 'M-002', 'Abierta'),
(3, 'M-003', 'Abierta');

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int UNSIGNED NOT NULL,
  `idCliente` int UNSIGNED NOT NULL,
  `idMozo` int UNSIGNED NOT NULL,
  `codigoMesa` varchar(5) NOT NULL,
  `codigoPedido` varchar(5) NOT NULL,
  `pedido` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `estado` enum('Pendiente','En Preparacion','Listo para Servir') DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id` int UNSIGNED NOT NULL,
  `nombreProducto` varchar(50) NOT NULL,
  `tipo` enum('Comida','Bebida') NOT NULL,
  `productoSector` enum('Barra de Tragos y Vinos','Barra de Cerveza Artesanal','Cocina','Candy Bar') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tiempoDePreparacion` int UNSIGNED NOT NULL,
  `estado` enum('Listo','En Preparacion','Pendiente') NOT NULL DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id`, `nombreProducto`, `tipo`, `productoSector`, `tiempoDePreparacion`, `estado`) VALUES
(1, 'Milanesa a Caballo', 'Comida', 'Cocina', 20, 'Pendiente'),
(2, 'Pastel de Papa', 'Comida', 'Cocina', 15, 'Pendiente'),
(3, 'Pollo al horno con Pure', 'Comida', 'Cocina', 25, 'Pendiente'),
(4, 'Vino Rutini Apartado Malbec', 'Bebida', 'Barra de Tragos y Vinos', 1, 'Pendiente'),
(5, 'Caipirinha', 'Bebida', 'Barra de Tragos y Vinos', 5, 'Pendiente'),
(6, 'Naparbier', 'Bebida', 'Barra de Cerveza Artesanal', 1, 'Pendiente'),
(7, 'Cierzo Brewing Co', 'Bebida', 'Barra de Cerveza Artesanal', 1, 'Pendiente'),
(8, 'Milhojas', 'Comida', 'Candy Bar', 10, 'Pendiente'),
(9, 'Postre de Vainilla', 'Comida', 'Candy Bar', 5, 'Pendiente');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipoUsuario` enum('Cliente','Empleado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `password`, `tipoUsuario`) VALUES
(1, 'Desmond', 'Miles', 'desmonmiles@mail.com', 'SOC1D', 'Empleado'),
(2, 'Jack', 'Richer', 'jackricher@mail.com', 'SOC2J', 'Empleado'),
(3, 'Diego', 'de la Vega', 'delavegadiego@mail.com', 'SOC3V', 'Empleado'),
(4, 'Juan', 'de la Cruz', 'juancruz@mail.com', 'BAR1C', 'Empleado'),
(5, 'Maria', 'O´Neil', 'mariaoneil@mail.com', 'BAR2M', 'Empleado'),
(6, 'Jazmine', 'Mcclain', 'jazmcclain@mail.com', 'CER1J', 'Empleado'),
(7, 'Emilio', 'Kramer', 'krameremilio@mail.com', 'CER2K', 'Empleado'),
(8, 'Travis', 'Poole', 'travispoole@mail.com', 'COC1T', 'Empleado'),
(9, 'Virginia', 'Schwartz', 'scwartvirginia@mail.com', 'COC2S', 'Empleado'),
(10, 'Siena', 'Horton', 'hortonsiena@mail.com', 'MOZ1S', 'Empleado'),
(11, 'Martin', 'Perez', 'martinperez@mail.com', 'MOZ1P', 'Empleado'),
(12, 'Ernesto', 'Pinto', 'ernestopinto@mail.com', 'CLI1EP', 'Cliente'),
(13, 'Alexandria', 'Van Assenberg', 'assenbergalex@mail.com', 'CLI2AA', 'Cliente');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indexes for table `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indexes for table `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigoMesa` (`codigoMesa`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `codigoMesa` (`codigoMesa`),
  ADD KEY `idCliente` (`idCliente`),
  ADD KEY `idMozo` (`idMozo`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`codigoMesa`) REFERENCES `mesas` (`codigoMesa`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`idMozo`) REFERENCES `empleados` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
