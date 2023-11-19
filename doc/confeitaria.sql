-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2023 at 03:37 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `confeitaria`
--

-- --------------------------------------------------------

--
-- Table structure for table `contatos`
--

CREATE TABLE `contatos` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contatos`
--

INSERT INTO `contatos` (`id`, `name`, `email`, `phone`, `subject`, `message`) VALUES
(1, 'Gabriel Motta', 'gabrielmottadev@gmail.com', '21900000000', 'elogio', 'Este é um elogio'),
(4, 'Gabriel Motta', 'gabrielmottadev@gmail.com', '21980000000', 'reclamação', 'Esta é uma reclamação');

-- --------------------------------------------------------

--
-- Table structure for table `lojas`
--

CREATE TABLE `lojas` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `img_dir` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `func_1` varchar(32) NOT NULL,
  `func_2` varchar(32) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `whatsapp` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lojas`
--

INSERT INTO `lojas` (`id`, `name`, `img_dir`, `address`, `func_1`, `func_2`, `phone`, `whatsapp`) VALUES
(1, 'Barra Shopping - Rio de Janeiro', 'rsrc/img/lojas/barra-shopping.webp', 'Av. das Américas, 4666, Loja 485, 2º Piso - Barra da Tijuca, Rio de Janeiro - RJ, 22640-102', '10h às 23h', '12h às 22h', '2124318182', '2124318182'),
(2, 'Rio Sul - Rio de Janeiro', 'rsrc/img/lojas/riosul.webp', 'Rua Lauro Müller, 116, Loja 235, 1º Piso - Botafogo, Rio de Janeiro - RJ, 22290-160', '10h às 23h', '12h às 22h', '2124318182', '2124318182'),
(3, 'JK Iguatemi - São Paulo', 'rsrc/img/lojas/jk-iguatemi.webp', 'Av. Pres. Juscelino Kubitschek, 2041, Loja 368, 2º Piso - Vila Olímpia, São Paulo - SP, 04543-011', '10h às 23h', '12h às 22h', '2124318182', '2124318182');

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `loja_id` int(11) NOT NULL,
  `status` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` varchar(16) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pedidos`
--

INSERT INTO `pedidos` (`id`, `produto_id`, `loja_id`, `status`, `password`, `code`, `name`, `email`, `phone`) VALUES
(9, 1, 1, 'Aguardando retirada', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '65289858', 'Gabriel Motta', 'gabrielmottadev@gmail.com', '21980000000');

-- --------------------------------------------------------

--
-- Table structure for table `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `img_dir` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `featured` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produtos`
--

INSERT INTO `produtos` (`id`, `name`, `img_dir`, `description`, `price`, `featured`) VALUES
(1, 'Red Velvet', 'rsrc/img/produtos/redvelvet.jpeg', 'Massa vermelha a base de chocolate + 3 camadas de recheio de buttercream (creme manteiga) + coberta com chantilly, farelos de massa vermelha e uma fina camada de massa vermelha na laterais. *Torta Premium serve até 10 fatias.', '85.00', 1),
(2, 'Mousse de Chocolate', 'rsrc/img/produtos/mousse.jpeg', 'Massa de chocolate com recheio de creme de chocolate ao leite e cobertura de chocolate, morangos inteiros para decorar. *Torta Especial serve até 20 fatias.', '85.00', 1),
(3, 'Chocolate Premium', 'rsrc/img/produtos/chocolate.jpeg', 'Massa de chocolate, recheio de creme de avelã com pedaços de avelã e cobertura de brigadeiro com raspas de chocolate. *Torta Premium serve até 20 fatias. ', '75.00', 1),
(4, 'Red Velvet 2', 'rsrc/img/produtos/redvelvet.jpeg', 'Massa vermelha a base de chocolate + 3 camadas de recheio de buttercream (creme manteiga) + coberta com chantilly, farelos de massa vermelha e uma fina camada de massa vermelha na laterais. *Torta Premium serve até 10 fatias.', '85.00', 0),
(5, 'Mousse de Chocolate 2', 'rsrc/img/produtos/mousse.jpeg', 'Massa de chocolate com recheio de creme de chocolate ao leite e cobertura de chocolate, morangos inteiros para decorar. *Torta Especial serve até 20 fatias.', '85.00', 0),
(6, 'Chocolate Premium 2', 'rsrc/img/produtos/chocolate.jpeg', 'Massa de chocolate, recheio de creme de avelã com pedaços de avelã e cobertura de brigadeiro com raspas de chocolate. *Torta Premium serve até 20 fatias. ', '75.00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contatos`
--
ALTER TABLE `contatos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lojas`
--
ALTER TABLE `lojas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedidos_loja_id` (`loja_id`),
  ADD KEY `pedidos_produto_id` (`produto_id`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contatos`
--
ALTER TABLE `contatos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lojas`
--
ALTER TABLE `lojas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_loja_id` FOREIGN KEY (`loja_id`) REFERENCES `lojas` (`id`),
  ADD CONSTRAINT `pedidos_produto_id` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
