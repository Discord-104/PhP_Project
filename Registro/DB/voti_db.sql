-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 13, 2025 alle 17:59
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `voti_db`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `materie`
--

CREATE TABLE `materie` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `materie`
--

INSERT INTO `materie` (`id`, `nome`) VALUES
(10, 'Educazione Civica'),
(11, 'Educazione Fisica'),
(9, 'Gestione Progetto'),
(6, 'Informatica'),
(4, 'Inglese'),
(2, 'Italiano'),
(1, 'Matematica'),
(12, 'Religione'),
(7, 'Sistemi e Reti'),
(3, 'Storia'),
(8, 'Tecnologie Progettazione'),
(5, 'Telecomunicazioni');

-- --------------------------------------------------------

--
-- Struttura della tabella `studenti`
--

CREATE TABLE `studenti` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ruolo` enum('studente','admin') NOT NULL DEFAULT 'studente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `studenti`
--

INSERT INTO `studenti` (`id`, `username`, `password`, `ruolo`) VALUES
(1, 'mario.rossi', '482c811da5d5b4bc6d497ffa98491e38', 'studente'),
(2, 'giulia.bianchi', 'bb77d0d3b3f239fa5db73bdf27b8d29a', 'studente'),
(3, 'luca.verdi', 'a029d0df84eb5549c641e04a9ef389e5', 'studente'),
(4, 'anna.neri', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'studente'),
(5, 'marco.gialli', 'e10adc3949ba59abbe56e057f20f883e', 'studente'),
(6, 'luigi.mangione', '81dc9bdb52d04dc20036dbd8313ed055', 'admin'),
(7, 'diddy', '1aab23051b24582c5dc8e23fc595d505', 'studente');

-- --------------------------------------------------------

--
-- Struttura della tabella `voti`
--

CREATE TABLE `voti` (
  `id` int(11) NOT NULL,
  `studente_id` int(11) DEFAULT NULL,
  `materia_id` int(11) DEFAULT NULL,
  `voto` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `voti`
--

INSERT INTO `voti` (`id`, `studente_id`, `materia_id`, `voto`) VALUES
(1, 7, 1, 5.00),
(2, 7, 1, 8.00),
(3, 7, 1, 5.00),
(4, 7, 6, 3.00),
(5, 7, 6, 3.00),
(6, 7, 1, 6.00);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `materie`
--
ALTER TABLE `materie`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Indici per le tabelle `studenti`
--
ALTER TABLE `studenti`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indici per le tabelle `voti`
--
ALTER TABLE `voti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studente_id` (`studente_id`),
  ADD KEY `materia_id` (`materia_id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `materie`
--
ALTER TABLE `materie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT per la tabella `studenti`
--
ALTER TABLE `studenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `voti`
--
ALTER TABLE `voti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `voti`
--
ALTER TABLE `voti`
  ADD CONSTRAINT `voti_ibfk_1` FOREIGN KEY (`studente_id`) REFERENCES `studenti` (`id`),
  ADD CONSTRAINT `voti_ibfk_2` FOREIGN KEY (`materia_id`) REFERENCES `materie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
