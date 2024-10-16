-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12/09/2024 às 14:15
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_inclusipet`
--
CREATE DATABASE IF NOT EXISTS `bd_inclusipet` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bd_inclusipet`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `adocao`
--

CREATE TABLE `adocao` (
  `CodAdocao` int(11) NOT NULL,
  `CodEspecie` int(11) NOT NULL,
  `CodCliente` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Idade` int(11) NOT NULL,
  `Porte` varchar(20) NOT NULL,
  `Castrado` tinyint(1) NOT NULL,
  `Sexo` char(5) NOT NULL,
  `Descricao` varchar(80) NOT NULL,
  `Detalhes` varchar(250) NOT NULL,
  `Telefone` varchar(15) NOT NULL,
  `Endereco` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `agendamento`
--

CREATE TABLE `agendamento` (
  `CodAgendamento` int(11) NOT NULL,
  `CodFuncionario` int(11) NOT NULL,
  `CodAnimal` int(11) NOT NULL,
  `CodCliente` int(11) NOT NULL,
  `CodUnidade` int(11) NOT NULL,
  `Servico` varchar(30) NOT NULL,
  `Data` date NOT NULL,
  `Hora` time NOT NULL,
  `Info` varchar(200) DEFAULT NULL,
  `Resultado` varchar(1) DEFAULT NULL,
  `CodServico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `animal`
--

CREATE TABLE `animal` (
  `CodAnimal` int(11) NOT NULL,
  `CodRaca` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Sexo` char(5) NOT NULL,
  `DataNasc` date NOT NULL,
  `DataAprox` year(4) NOT NULL,
  `Peso` double NOT NULL,
  `Castrado` tinyint(1) NOT NULL,
  `Imagem` varchar(200)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cargo`
--

CREATE TABLE `cargo` (
  `CodCargo` int(11) NOT NULL,
  `Descricao` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `CodCliente` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `DataNasc` date NOT NULL,
  `Telefone` varchar(15) NOT NULL,
  `CEP` varchar(9) NOT NULL,
  `CPF` varchar(14) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Senha` varchar(200) NOT NULL,
  `Token` varchar(200),
  `Imagem` varchar(200)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `especie`
--

CREATE TABLE `especie` (
  `CodEspecie` int(11) NOT NULL,
  `Descricao` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `imagem_adocao`
--

CREATE TABLE `imagem_adocao` (
  `CodAdocao` int(11) NOT NULL,
  `Imagem` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `raca`
--

CREATE TABLE `raca` (
  `CodRaca` int(11) NOT NULL,
  `CodEspecie` int(11) NOT NULL,
  `Descricao` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `servico`
--

CREATE TABLE `servico` (
  `CodServico` int(11) NOT NULL,
  `Descricao` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `unidade`
--

CREATE TABLE `unidade` (
  `CodUnidade` int(11) NOT NULL,
  `Nome` varchar(35) NOT NULL,
  `Endereco` varchar(50) NOT NULL,
  `Bairro` varchar(50) NOT NULL,
  `Telefone` varchar(15) NOT NULL,
  `HorarioInicial` time DEFAULT NULL,
  `HorarioFinal` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `CodFuncionario` int(11) NOT NULL,
  `CodCargo` int(11) NOT NULL,
  `Senha` varchar(200) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `RG` varchar(12) NOT NULL,
  `CPF` varchar(14) NOT NULL,
  `Telefone` varchar(15) NOT NULL,
  `CEP` varchar(9) NOT NULL,
  `CodUnidade` int(11) NOT NULL,
  `Token` varchar(200),
  `Imagem` varchar(200)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `adocao`
--
ALTER TABLE `adocao`
  ADD PRIMARY KEY (`CodAdocao`),
  ADD KEY `CodClienteAdocao` (`CodCliente`),
  ADD KEY `CodEspecieAdocao` (`CodEspecie`);

--
-- Índices de tabela `agendamento`
--
ALTER TABLE `agendamento`
  ADD PRIMARY KEY (`CodAgendamento`),
  ADD KEY `CodAnimalAgendamento` (`CodAnimal`),
  ADD KEY `CodClienteAgendamento` (`CodCliente`),
  ADD KEY `CodFuncionarioAgendamento` (`CodFuncionario`),
  ADD KEY `CodUnidadeAgendamento` (`CodUnidade`),
  ADD KEY `CodServicoAgendamento` (`CodServico`);

--
-- Índices de tabela `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`CodAnimal`),
  ADD KEY `CodRacaAnimal` (`CodRaca`);

--
-- Índices de tabela `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`CodCargo`);

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`CodCliente`),
  ADD UNIQUE KEY `CPF` (`CPF`);

--
-- Índices de tabela `especie`
--
ALTER TABLE `especie`
  ADD PRIMARY KEY (`CodEspecie`);

--
-- Índices de tabela `imagem_adocao`
--
ALTER TABLE `imagem_adocao`
  ADD KEY `CodAdocaoImagem` (`CodAdocao`);

--
-- Índices de tabela `raca`
--
ALTER TABLE `raca`
  ADD PRIMARY KEY (`CodRaca`),
  ADD KEY `CodEspecieRaca` (`CodEspecie`);

--
-- Índices de tabela `servico`
--
ALTER TABLE `servico`
  ADD PRIMARY KEY (`CodServico`);

--
-- Índices de tabela `unidade`
--
ALTER TABLE `unidade`
  ADD PRIMARY KEY (`CodUnidade`);

--
-- Índices de tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`CodFuncionario`),
  ADD UNIQUE KEY `RG` (`RG`),
  ADD UNIQUE KEY `CPF` (`CPF`),
  ADD KEY `CodCargoFuncionario` (`CodCargo`),
  ADD KEY `CodUnidadeFuncionario` (`CodUnidade`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `adocao`
--
ALTER TABLE `adocao`
  MODIFY `CodAdocao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `agendamento`
--
ALTER TABLE `agendamento`
  MODIFY `CodAgendamento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `animal`
--
ALTER TABLE `animal`
  MODIFY `CodAnimal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cargo`
--
ALTER TABLE `cargo`
  MODIFY `CodCargo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `CodCliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `especie`
--
ALTER TABLE `especie`
  MODIFY `CodEspecie` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `raca`
--
ALTER TABLE `raca`
  MODIFY `CodRaca` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `servico`
--
ALTER TABLE `servico`
  MODIFY `CodServico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `unidade`
--
ALTER TABLE `unidade`
  MODIFY `CodUnidade` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `CodFuncionario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `adocao`
--
ALTER TABLE `adocao`
  ADD CONSTRAINT `CodClienteAdocao` FOREIGN KEY (`CodCliente`) REFERENCES `cliente` (`CodCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `CodEspecieAdocao` FOREIGN KEY (`CodEspecie`) REFERENCES `especie` (`CodEspecie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `agendamento`
--
ALTER TABLE `agendamento`
  ADD CONSTRAINT `CodAnimalAgendamento` FOREIGN KEY (`CodAnimal`) REFERENCES `animal` (`CodAnimal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `CodClienteAgendamento` FOREIGN KEY (`CodCliente`) REFERENCES `cliente` (`CodCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `CodServicoAgendamento` FOREIGN KEY (`CodServico`) REFERENCES `servico` (`CodServico`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `CodUnidadeAgendamento` FOREIGN KEY (`CodUnidade`) REFERENCES `unidade` (`CodUnidade`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `CodFuncionarioAgendamento` FOREIGN KEY (`CodFuncionario`) REFERENCES `funcionario` (`CodFuncionario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `CodRacaAnimal` FOREIGN KEY (`CodRaca`) REFERENCES `raca` (`CodRaca`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `imagem_adocao`
--
ALTER TABLE `imagem_adocao`
  ADD CONSTRAINT `CodAdocaoImagem` FOREIGN KEY (`CodAdocao`) REFERENCES `adocao` (`CodAdocao`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `raca`
--
ALTER TABLE `raca`
  ADD CONSTRAINT `CodEspecieRaca` FOREIGN KEY (`CodEspecie`) REFERENCES `especie` (`CodEspecie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `CodCargoFuncionario` FOREIGN KEY (`CodCargo`) REFERENCES `cargo` (`CodCargo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `CodUnidadeFuncionario` FOREIGN KEY (`CodUnidade`) REFERENCES `unidade` (`CodUnidade`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
