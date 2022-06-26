-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27-Set-2021 às 04:05
-- Versão do servidor: 10.4.20-MariaDB
-- versão do PHP: 8.0.8

-- CREATE DATABASE `rmonline`;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `rmonline`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `assinatura`
--

CREATE TABLE `assinatura` (
  `id_assinatura` int(10) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_func` int(11) NOT NULL,
  `id_rm` int(11) NOT NULL,
  `ass` varchar(20)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `id_func` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `senha` varchar(50) DEFAULT NULL,
  `id_setor` int(11) DEFAULT NULL,
  `tipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`id_func`, `nome`, `email`, `senha`, `id_setor`, `tipo`) VALUES
(1, 'Carlos Souza', 'carlos.souza@rmonline.com.br', 'dd5d13a28e2a17bbbe8393ea52e36aba', 2, 'user'),
(2, 'Gerente', 'gerente@rmonline.com.br', 'dd5d13a28e2a17bbbe8393ea52e36aba', 2, 'gerente'),
(3, 'Supervisor', 'supervisor@rmonline.com.br', 'dd5d13a28e2a17bbbe8393ea52e36aba', 2, 'user'),
(4, 'Comprador', 'comprador@rmonline.com.br', 'dd5d13a28e2a17bbbe8393ea52e36aba', 3, 'suprimentos'),
(5, 'Gerente Operações', 'ger_op@rmonline.com.br', 'dd5d13a28e2a17bbbe8393ea52e36aba', 4, 'gerente');

-- --------------------------------------------------------

--
-- Estrutura da tabela `gerencia`
--

CREATE TABLE `gerencia` (
  `id_ger` int(11) NOT NULL,
  `id_func` int(11) DEFAULT NULL,
  `id_setor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `gerencia`
--

INSERT INTO `gerencia` (`id_ger`, `id_func`, `id_setor`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 5, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `rm`
--

CREATE TABLE `rm` (
  `id_rm` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp(),
  `tipo` varchar(20) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `c_custo` varchar(20) DEFAULT NULL,
  `id_func` int(11) DEFAULT NULL,
  `id_setor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Estrutura da tabela `setor`
--

CREATE TABLE `setor` (
  `id_setor` int(11) NOT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `c_custo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `setor`
--

INSERT INTO `setor` (`id_setor`, `descricao`, `c_custo`) VALUES
(1, 'Manutencao', 1701),
(2, 'TI', 1702),
(3, 'Suprimentos', 1703),
(4, 'Manutencao Civil', 1705);

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicita`
--

CREATE TABLE `solicita` (
  `id_sol` int(11) NOT NULL,
  `qtde` varchar(20) DEFAULT NULL,
  `unidade` varchar(20) DEFAULT NULL,
  `codigo` varchar(20) NOT NULL,
  `descricao` varchar(20) DEFAULT NULL,
  `id_rm` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tabela `assinatura`
--
ALTER TABLE `assinatura`
  ADD PRIMARY KEY (`id_assinatura`),
  ADD KEY `id_func` (`id_func`),
  ADD KEY `id_rm` (`id_rm`);

--
-- Índices para tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`id_func`),
  ADD KEY `id_setor` (`id_setor`);

--
-- Índices para tabela `gerencia`
--
ALTER TABLE `gerencia`
  ADD PRIMARY KEY (`id_ger`),
  ADD KEY `id_func` (`id_func`),
  ADD KEY `id_setor` (`id_setor`);

--
-- Índices para tabela `rm`
--
ALTER TABLE `rm`
  ADD PRIMARY KEY (`id_rm`),
  ADD KEY `id_func` (`id_func`),
  ADD KEY `id_setor` (`id_setor`);

--
-- Índices para tabela `setor`
--
ALTER TABLE `setor`
  ADD PRIMARY KEY (`id_setor`);

--
-- Índices para tabela `solicita`
--
ALTER TABLE `solicita`
  ADD PRIMARY KEY (`id_sol`),
  ADD KEY `id_rm` (`id_rm`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `assinatura`
--
ALTER TABLE `assinatura`
  MODIFY `id_assinatura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id_func` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `gerencia`
--
ALTER TABLE `gerencia`
  MODIFY `id_ger` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `rm`
--
ALTER TABLE `rm`
  MODIFY `id_rm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de tabela `setor`
--
ALTER TABLE `setor`
  MODIFY `id_setor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `solicita`
--
ALTER TABLE `solicita`
  MODIFY `id_sol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `assinatura`
--
ALTER TABLE `assinatura`
  ADD CONSTRAINT `ASSINATURA_ibfk_1` FOREIGN KEY (`id_func`) REFERENCES `funcionario` (`id_func`),
  ADD CONSTRAINT `ASSINATURA_ibfk_2` FOREIGN KEY (`id_rm`) REFERENCES `rm` (`id_rm`);

--
-- Limitadores para a tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `FUNCIONARIO_ibfk_1` FOREIGN KEY (`id_setor`) REFERENCES `setor` (`id_setor`);

--
-- Limitadores para a tabela `gerencia`
--
ALTER TABLE `gerencia`
  ADD CONSTRAINT `GERENCIA_ibfk_1` FOREIGN KEY (`id_func`) REFERENCES `funcionario` (`id_func`),
  ADD CONSTRAINT `GERENCIA_ibfk_2` FOREIGN KEY (`id_setor`) REFERENCES `setor` (`id_setor`);

--
-- Limitadores para a tabela `rm`
--
ALTER TABLE `rm`
  ADD CONSTRAINT `RM_ibfk_1` FOREIGN KEY (`id_func`) REFERENCES `funcionario` (`id_func`),
  ADD CONSTRAINT `RM_ibfk_2` FOREIGN KEY (`id_setor`) REFERENCES `setor` (`id_setor`);

--
-- Limitadores para a tabela `solicita`
--
ALTER TABLE `solicita`
  ADD CONSTRAINT `SOLICITA_ibfk_1` FOREIGN KEY (`id_rm`) REFERENCES `rm` (`id_rm`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
