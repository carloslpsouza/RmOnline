-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09-Ago-2021 às 12:25
-- Versão do servidor: 10.4.20-MariaDB
-- versão do PHP: 8.0.8

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
  `id_func` int(11) NOT NULL
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
  `id_setor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`id_func`, `nome`, `email`, `senha`, `id_setor`) VALUES
(1, 'Carlos Souza', 'carlos.souza@concer.com.br', 'dd5d13a28e2a17bbbe8393ea52e36aba', 1),
(2, 'Constantino Demetrio', 'constantino@concer.com.br', NULL, 2),
(3, 'Juliana Sousa', 'juliana.sousa@concer.com.br', NULL, 2);

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
(2, 2, 2);

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
  `assinatura` varchar(50) DEFAULT NULL,
  `id_func` int(11) DEFAULT NULL,
  `id_setor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `rm`
--

INSERT INTO `rm` (`id_rm`, `data`, `tipo`, `estado`, `c_custo`, `assinatura`, `id_func`, `id_setor`) VALUES
(1, '2021-08-02 14:17:25', 'Normal', 'Solicitado', '1701', '6c14da109e294d1e8155be8aa4b1ce8e', 1, 1),
(2, '2021-08-02 16:05:26', 'Normal', 'Fechado', '1701', 'e53a0a2978c28872a4505bdb51db06dc', 1, 1),
(3, '2021-08-04 01:11:31', 'Emergencial', 'Solicitado', '1701', 'f9db5504033136572d2e88640e0b7a3d', 1, 1);

-- --------------------------------------------------------

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
(2, 'TI', 1702);

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
-- Extraindo dados da tabela `solicita`
--

INSERT INTO `solicita` (`id_sol`, `qtde`, `unidade`, `codigo`, `descricao`, `id_rm`) VALUES
(1, '2', 'UN', '', 'Antena Ubiquiti', 1),
(2, '100', 'M', '', 'Cabo PP', 1),
(3, '1', 'UN', '', 'Nobreak', 1),
(4, '1', 'UN', '', 'Câmera Intelbras', 1),
(5, '2', 'UN', '', 'Nobreak', 3),
(6, '1', 'UN', '', 'Mouse', 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `assinatura`
--
ALTER TABLE `assinatura`
  ADD PRIMARY KEY (`id_assinatura`);

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
  MODIFY `id_assinatura` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id_func` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `gerencia`
--
ALTER TABLE `gerencia`
  MODIFY `id_ger` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `rm`
--
ALTER TABLE `rm`
  MODIFY `id_rm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `setor`
--
ALTER TABLE `setor`
  MODIFY `id_setor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `solicita`
--
ALTER TABLE `solicita`
  MODIFY `id_sol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para despejos de tabelas
--

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
