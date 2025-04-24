-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 24/04/2025 às 15:52
-- Versão do servidor: 8.0.41-0ubuntu0.24.04.1
-- Versão do PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cadastro_medico`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agendamentos`
--

CREATE TABLE `agendamentos` (
  `id` int NOT NULL,
  `medico_id` int NOT NULL,
  `paciente_id` int NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `agendamentos`
--

INSERT INTO `agendamentos` (`id`, `medico_id`, `paciente_id`, `data`, `hora`, `criado_em`) VALUES
(1, 4, 1, '2025-04-29', '10:30:00', '2025-04-24 15:45:57');

-- --------------------------------------------------------

--
-- Estrutura para tabela `agenda_medica`
--

CREATE TABLE `agenda_medica` (
  `id` int NOT NULL,
  `medico_id` int NOT NULL,
  `dia_semana` varchar(20) NOT NULL,
  `inicio` time DEFAULT NULL,
  `almoco_inicio` time DEFAULT NULL,
  `almoco_fim` time DEFAULT NULL,
  `fim` time DEFAULT NULL,
  `duracao_consulta` int NOT NULL,
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `agenda_medica`
--

INSERT INTO `agenda_medica` (`id`, `medico_id`, `dia_semana`, `inicio`, `almoco_inicio`, `almoco_fim`, `fim`, `duracao_consulta`, `criado_em`) VALUES
(3, 4, 'segunda', '08:00:00', '12:00:00', '13:00:00', '18:00:00', 45, '2025-04-24 15:05:52'),
(4, 4, 'terca', '09:00:00', '12:00:00', '13:00:00', '15:00:00', 30, '2025-04-24 15:05:52');

-- --------------------------------------------------------

--
-- Estrutura para tabela `medicos`
--

CREATE TABLE `medicos` (
  `id` int NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `rg` varchar(20) NOT NULL,
  `data_nascimento` date NOT NULL,
  `genero` enum('Masculino','Feminino','Outro') NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `numero_crm` varchar(20) NOT NULL,
  `estado_crm` varchar(2) NOT NULL,
  `especialidades` text,
  `subespecialidades` text,
  `data_emissao_crm` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `medicos`
--

INSERT INTO `medicos` (`id`, `nome`, `cpf`, `rg`, `data_nascimento`, `genero`, `telefone`, `email`, `endereco`, `numero_crm`, `estado_crm`, `especialidades`, `subespecialidades`, `data_emissao_crm`) VALUES
(4, 'Teste', '123455678910', '12345678', '1985-10-10', 'Masculino', '21999998888', 'teste@teste.com', 'Rua Teste, 152151 - Centro - Rio de Janeiro', '123123123', 'RJ', 'Cardiologia', 'Pediatra', '2020-10-10');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int NOT NULL,
  `nome_completo` varchar(150) NOT NULL,
  `nome_social` varchar(150) DEFAULT NULL,
  `cpf` varchar(14) NOT NULL,
  `rg` varchar(20) DEFAULT NULL,
  `cartao_sus` varchar(20) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `genero` varchar(20) DEFAULT NULL,
  `estado_civil` varchar(30) DEFAULT NULL,
  `nacionalidade` varchar(50) DEFAULT NULL,
  `naturalidade` varchar(50) DEFAULT NULL,
  `telefone_principal` varchar(20) DEFAULT NULL,
  `telefone_secundario` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `logradouro` varchar(100) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `tipo_sanguineo` varchar(5) DEFAULT NULL,
  `alergias` text,
  `condicoes_medicas` text,
  `medicamentos` text,
  `convenio` varchar(50) DEFAULT NULL,
  `numero_convenio` varchar(30) DEFAULT NULL,
  `validade_convenio` date DEFAULT NULL,
  `profissao` varchar(50) DEFAULT NULL,
  `escolaridade` varchar(50) DEFAULT NULL,
  `necessidades_especiais` text,
  `consentimento_dados` tinyint(1) DEFAULT '0',
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `pacientes`
--

INSERT INTO `pacientes` (`id`, `nome_completo`, `nome_social`, `cpf`, `rg`, `cartao_sus`, `data_nascimento`, `genero`, `estado_civil`, `nacionalidade`, `naturalidade`, `telefone_principal`, `telefone_secundario`, `email`, `cep`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `tipo_sanguineo`, `alergias`, `condicoes_medicas`, `medicamentos`, `convenio`, `numero_convenio`, `validade_convenio`, `profissao`, `escolaridade`, `necessidades_especiais`, `consentimento_dados`, `criado_em`) VALUES
(1, 'Carlos Eduardo de Farias Candido', 'Carlos Eduardo de Farias Candido', '099.258.477-96', '123', '31321', '1984-12-10', 'masculino', 'casado', 'dfjiodfjgio', 'fkgkdfjkgjdfkl', '21967732060', '2125896276', 'carlosefcandido@gmail.com', '25931-314', 'Rua Geraldo Anacleto', '146', 'fdfgdf', 'Piabetá', 'Magé', 'RJ', 'A+', 'dfgdfgdf', 'dfgdfg', 'dfgdfgdf', 'Particular', '', '2025-10-10', '', '', '', 1, '2025-04-24 14:24:22');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unico_agendamento` (`medico_id`,`data`,`hora`),
  ADD KEY `paciente_id` (`paciente_id`);

--
-- Índices de tabela `agenda_medica`
--
ALTER TABLE `agenda_medica`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medico_id` (`medico_id`);

--
-- Índices de tabela `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices de tabela `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `agenda_medica`
--
ALTER TABLE `agenda_medica`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `medicos`
--
ALTER TABLE `medicos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD CONSTRAINT `agendamentos_ibfk_1` FOREIGN KEY (`medico_id`) REFERENCES `medicos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `agendamentos_ibfk_2` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `agenda_medica`
--
ALTER TABLE `agenda_medica`
  ADD CONSTRAINT `agenda_medica_ibfk_1` FOREIGN KEY (`medico_id`) REFERENCES `medicos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
