-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Maio-2025 às 17:14
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tasksync`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tarefas`
--

CREATE TABLE `tarefas` (
  `id_tarefa` int(11) NOT NULL,
  `descricao_tarefa` varchar(200) NOT NULL,
  `prioridade_tarefa` enum('baixa','media','alta') NOT NULL,
  `status_tarefa` enum('aFazer','fazendo','concluido') NOT NULL,
  `setor_tarefa` enum('rh','manutencao','desenvolvedor','professor') NOT NULL,
  `data_tarefa` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tarefas`
--

INSERT INTO `tarefas` (`id_tarefa`, `descricao_tarefa`, `prioridade_tarefa`, `status_tarefa`, `setor_tarefa`, `data_tarefa`) VALUES
(10, 'Enviar o gitHub', 'media', 'fazendo', 'professor', '2025-05-21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `email_usuario` varchar(200) NOT NULL,
  `senha_usuario` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `email_usuario`, `senha_usuario`) VALUES
(1, 'teste@teste.com', '$2y$10$s7wEsKW8MtTNf7k/nhbCUeliZT3IT6gCEcEuBHc1Gq3X.Q9oO/ip2'),
(2, 'koba@gmail.com', '$2y$10$uxHkn7neFZ3ULstGUfsqF.M/btaCzd.AOrCOfy1In3aD75cvQDhhq');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tarefas`
--
ALTER TABLE `tarefas`
  ADD PRIMARY KEY (`id_tarefa`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tarefas`
--
ALTER TABLE `tarefas`
  MODIFY `id_tarefa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
