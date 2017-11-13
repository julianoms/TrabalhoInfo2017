-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 13-Nov-2017 às 04:16
-- Versão do servidor: 5.7.17
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `idFuncionario` bigint(20) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `cargo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`idFuncionario`, `nome`, `usuario`, `senha`, `cargo`) VALUES
(1, 'juliano', 'junin', '$2y$10$65EeLEDzqlk2IGn2vhtvEuPTENoqPNPfHG/e4sVcaGJ0MiUl8N3L2', 'admin'),
(6, 'teste', 'teste', '$2y$10$iaX.yFAdimTD2PzIm5RlquIoGk0nZPaiXY4zSr9MPNwmvMmKjjhKu', 'admin'),
(7, 'guizao', 'guizao', '$2y$10$CbdAZNemIo93Fm9SXGdjJuJQVnUj9g6HQ/zIPuEg8X6jdv7dn33Pm', 'admin');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `idPedido` bigint(20) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `quantidade` tinyint(4) NOT NULL,
  `Produto_idProduto` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`idPedido`, `nome`, `endereco`, `quantidade`, `Produto_idProduto`) VALUES
(1, 'Juliano Marcel Salgueiro', 'rua são miguel', 2, 3),
(2, 'usuario666', 'casa do caraio', 10, 4),
(3, 'sscs', 'sdsdsd', 23, 4),
(4, 'sscs', 'sdsdsd', 23, 4),
(5, 'dedede', 'rua 45', 2, 4),
(6, 'teste20', 'shuahsuahdksafn~ef', 2, 4),
(7, 'mais um teste', 'av 20A', 1, 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `idProduto` bigint(20) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` text NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `disponivel` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`idProduto`, `nome`, `descricao`, `valor`, `disponivel`) VALUES
(3, 'tenis', 'nike zica       ', '5.00', 1),
(4, 'Camisa Segurança', 'Camisa preta segurança pra &#34;tirar onda&#34; por ai', '40.00', 1),
(5, 'Bermuda 2', 'Bermuda 2 tipo atleta, tamanho G', '50.00', 1),
(6, 'blusa Feminina', 'blusa feminina vermelha !!', '80.00', 1),
(7, 'Blusa de Frio', 'Blusa Azul de Frio , ultima moda!!', '120.00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`idFuncionario`);

--
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idPedido`,`Produto_idProduto`),
  ADD KEY `fk_Pedido_Produto_idx` (`Produto_idProduto`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`idProduto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `idFuncionario` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idPedido` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `idProduto` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_Pedido_Produto` FOREIGN KEY (`Produto_idProduto`) REFERENCES `produto` (`idProduto`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
