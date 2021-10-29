-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: mai 23, 2021 la 03:29 PM
-- Versiune server: 10.4.19-MariaDB
-- Versiune PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `music_competition`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `admins`
--

CREATE TABLE `admins` (
  `ID` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `admins`
--

INSERT INTO `admins` (`ID`, `Email`, `Password`) VALUES
(1, 'Admin', '$2y$10$ls2GOgcX3uxeufpFxvHS4ecnUMLooclrXE0pfnjBGXbD7WBDCq1Fq');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `contestants`
--

CREATE TABLE `contestants` (
  `ID` int(11) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Age` int(11) NOT NULL,
  `PhoneNumber` varchar(10) NOT NULL,
  `Instrument` varchar(6) NOT NULL,
  `FinalScore` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `contestants`
--

INSERT INTO `contestants` (`ID`, `FirstName`, `LastName`, `Email`, `Password`, `Age`, `PhoneNumber`, `Instrument`, `FinalScore`) VALUES
(1, 'Sorin', 'Pui', 'puisorin99@gmail.com', '$2y$10$r8iaJF.6qNTKlZJaH9bVkeJ/6jpU7RiITkETO4X.gjfDwK5zo7ouq', 21, '0747912269', 'piano', 0),
(3, 'Catalin', 'Candea', 'catalincandea@gmail.com', '$2y$10$dONqaX9/hJWlpOOkodvOE.4SDdANKtR.WINdPIonIuyVnBamN/x1u', 22, '0740212323', 'violin', 0),
(4, 'Bogdan', 'Samonid', 'bogdansamonid@gmail.com', '$2y$10$xzX3/UudPdaO1DWrdX6ri.SQswSrNSpFymIIDu/FDAm9KVxvhkAPS', 21, '0720000134', 'piano', 72),
(5, 'Cosmina', 'Sas', 'cosminasas@gmail.com', '$2y$10$m6L9BR2IIu7MfDFdc.uZJ.u5k3Y86F5eCGD0xIMWcSsiHsUcAh6du', 21, '0720000012', 'piano', 0),
(6, 'Oana', 'Rancov', 'oanarancov@gmail.com', '$2y$10$ZOs6Ab8nz8xoDbPINBL7c.sSini4HFxQUWmFq8xLY6j2P/m9h32vS', 21, '0720000002', 'piano', 0),
(7, 'Sebastian', 'Sofran', 'sofransebastian99@gmail.com', '$2y$10$fOPa7c4iHSLIdN..L5yEme78OFrcPwioedj3WW4CPRBrd3PvORAJG', 21, '0788111118', 'piano', 31),
(8, 'Denis', 'Beleuta', 'denisbeleuta@gmail.com', '$2y$10$2Z05lZk3nU6UsSbvcO0Tx.Sh6TaYiULxZZYGzgcI8VS5oBmtSzXb.', 21, '0722000039', 'violin', 61),
(9, 'Cristina', 'Gabriela', 'cristinagabriela@gmail.com', '$2y$10$/ujRDdUuCcGNAI/0bfSFFeiloAe8lPLuKrz.GqnQRIWFiB9Qj7KXi', 21, '0721221239', 'violin', 0),
(12, 'Alin', 'Pui', 'puialin99@gmail.com', '$2y$10$EEh/mbn8gkykuxK7ByOK0eVwLGbMHkGEYfW/IUvWwFY0QBTggeHyS', 21, '0721110045', 'piano', 100),
(13, 'Karina', 'Andrei', 'karinel@gmail.com', '$2y$10$QgyKyZ3VaDONcM3uznOdAOWfK.0XLCVXMeATsomKyazJwwHKEy9Ue', 21, '0750000001', 'violin', 30),
(14, 'Lorin', 'Rapciuc', 'lorinrapciuc@gmail.com', '$2y$10$0pe204jNTazpTMebkYaiHOtzHyvvU22QeSsNNYMrnHTu1QWbdvnuC', 21, '0720000099', 'piano', 0),
(15, 'Georgian', 'Danciu', 'georgiandanciu@gmail.com', '$2y$10$b.UGVVwK5seHSGlA2yFISuhhMeOwIWbM0gXl9XN7RsrVgmNVbodfW', 21, '0744411345', 'piano', 0),
(20, 'Andreea', 'Achim', 'andreeaachim@gmail.com', '$2y$10$gMQzOxED5jTJ9mq8ZWQ57uO0x7J8RedYWZZkt1QVeZdCDXj53UdIm', 21, '0722222221', 'piano', 0);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `judges`
--

CREATE TABLE `judges` (
  `ID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Instrument` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `judges`
--

INSERT INTO `judges` (`ID`, `FirstName`, `LastName`, `Email`, `Password`, `Instrument`) VALUES
(3, 'Maria', 'Ionescu', 'mariaionescu@gmail.com', '$2y$10$W4WIveROcOCkHJlh6Ox6LefTzjanl3JNf6CVw.EG3jLmi2oSjJ/mi', 'violin'),
(4, 'Ion', 'Popescu', 'ionpopescu@gmail.com', '$2y$10$Q5E8EBvhXEojSKa7Qm/qXOVRhNRo6GCJplYVqPNumcX/QAUAexc82', 'piano');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `pieces`
--

CREATE TABLE `pieces` (
  `ContestantID` int(11) NOT NULL,
  `PieceID` int(11) NOT NULL,
  `PieceName` varchar(50) NOT NULL,
  `ComposerName` varchar(50) NOT NULL,
  `Category` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `pieces`
--

INSERT INTO `pieces` (`ContestantID`, `PieceID`, `PieceName`, `ComposerName`, `Category`) VALUES
(1, 1, 'Etude Op. 25 No. 11', 'Chopin', 'option1'),
(1, 2, 'Moonlight Sonata 1st movement', 'Beethoven', 'option2'),
(1, 3, 'Chaconne in D minor', 'Bach-Busoni', 'option3'),
(3, 7, 'Some etude', 'Some composer', 'option1'),
(3, 8, 'Partita no. 1 in B minor, BWV 1002: V. Sarabande', 'Bach', 'option3'),
(4, 9, 'The School of Velocity No. 12', 'Czerny', 'option1'),
(4, 10, 'Sonata No. 11 in A Major 1st Movement', 'Mozart', 'option2'),
(4, 11, 'Prelude and Fugue in C minor', 'Bach', 'option3'),
(5, 12, 'The School of Velocity No. 11', 'Czerny', 'option1'),
(5, 13, 'Fur Elise', 'Beethoven', 'option2'),
(5, 14, 'Prelude and Fugue in D major', 'Bach', 'option3'),
(6, 15, 'The School of Velocity No. 21', 'Czerny', 'option1'),
(6, 16, 'Sonata Tempest 3rd movement', 'Beethoven', 'option2'),
(6, 17, 'Prelude and Fugue in C# Minor', 'Bach', 'option3'),
(7, 18, 'Etude Op. 10 No. 4', 'Chopin', 'option1'),
(7, 19, 'Sonata No. 11 in A Major 3st Movement', 'Mozart', 'option2'),
(7, 20, 'Prelude and Fugue in C Major', 'Bach', 'option3'),
(8, 21, 'Some etude', 'Some composer', 'option1'),
(8, 22, 'Op. 15, Variations on an original theme', 'Wienaski', 'option2'),
(8, 23, 'Partita No. 2 in D Minor, BWV 1004: V. Chaconne', 'Bach', 'option3'),
(9, 24, 'Some etude', 'Some composer', 'option1'),
(9, 25, 'Caprice. No 1', 'Paganini', 'option2'),
(9, 26, 'Partita No. 2 in D Minor, BWV 1004: I. Allemande', 'Bach', 'option3'),
(12, 31, 'The School of Velocity No. 7', 'Czerny', 'option1'),
(12, 32, 'Sonata Pathetique 1st Movement', 'Beethoven', 'option2'),
(12, 33, 'River Flows In You', 'Yiruma', 'option3'),
(13, 34, 'Some etude', 'Some composer', 'option1'),
(13, 35, 'Caprice No. 5', 'Paganini', 'option2'),
(13, 36, 'Some partita', 'Bach', 'option3'),
(14, 37, 'Fur Elise', 'Beethoven', 'option2'),
(14, 38, 'Canon in D', 'Johann Pachelbel', 'option3'),
(15, 39, 'Prelude and Fugue in B flat minor', 'Bach', 'option3'),
(20, 46, 'Some etude', 'Some composer', 'option1'),
(20, 47, 'Paganiniana', 'Milstein', 'option2'),
(20, 48, 'Sonata No. 1 in G minor, BWV: 1. Adagio', 'Bach', 'option3');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `scores`
--

CREATE TABLE `scores` (
  `ContestantID` int(11) NOT NULL,
  `PieceID` int(11) NOT NULL,
  `InterpretationScore` int(11) NOT NULL DEFAULT 0,
  `TechnicalScore` int(11) NOT NULL DEFAULT 0,
  `DifficultyScore` int(11) NOT NULL DEFAULT 0,
  `OverallScore` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `scores`
--

INSERT INTO `scores` (`ContestantID`, `PieceID`, `InterpretationScore`, `TechnicalScore`, `DifficultyScore`, `OverallScore`) VALUES
(1, 1, 85, 95, 77, 87),
(1, 2, 100, 100, 60, 93),
(1, 3, 100, 90, 96, 96),
(3, 7, 89, 73, 91, 84),
(3, 8, 100, 83, 88, 92),
(4, 9, 22, 22, 22, 22),
(4, 10, 94, 100, 80, 94),
(4, 11, 100, 100, 100, 100),
(5, 12, 0, 0, 0, 0),
(5, 13, 90, 100, 50, 87),
(5, 14, 0, 0, 0, 0),
(6, 15, 0, 0, 0, 0),
(6, 16, 0, 0, 0, 0),
(6, 17, 0, 0, 0, 0),
(7, 18, 0, 0, 0, 0),
(7, 19, 0, 0, 0, 0),
(7, 20, 97, 80, 100, 92),
(8, 21, 81, 93, 72, 84),
(8, 22, 93, 90, 92, 92),
(8, 23, 12, 3, 6, 8),
(9, 24, 0, 0, 0, 0),
(9, 25, 0, 0, 0, 0),
(9, 26, 0, 0, 0, 0),
(12, 31, 100, 100, 100, 100),
(12, 32, 100, 100, 100, 100),
(12, 33, 100, 100, 100, 100),
(13, 34, 0, 0, 0, 0),
(13, 35, 90, 84, 100, 90),
(13, 36, 0, 0, 0, 0),
(14, 37, 0, 0, 0, 0),
(14, 38, 0, 0, 0, 0),
(15, 39, 0, 0, 0, 0),
(20, 46, 0, 0, 0, 0),
(20, 47, 0, 0, 0, 0),
(20, 48, 0, 0, 0, 0);

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`ID`);

--
-- Indexuri pentru tabele `contestants`
--
ALTER TABLE `contestants`
  ADD PRIMARY KEY (`ID`);

--
-- Indexuri pentru tabele `judges`
--
ALTER TABLE `judges`
  ADD PRIMARY KEY (`ID`);

--
-- Indexuri pentru tabele `pieces`
--
ALTER TABLE `pieces`
  ADD PRIMARY KEY (`PieceID`),
  ADD KEY `ContestantID` (`ContestantID`);

--
-- Indexuri pentru tabele `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`ContestantID`,`PieceID`),
  ADD KEY `PieceID` (`PieceID`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `admins`
--
ALTER TABLE `admins`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pentru tabele `contestants`
--
ALTER TABLE `contestants`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pentru tabele `judges`
--
ALTER TABLE `judges`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pentru tabele `pieces`
--
ALTER TABLE `pieces`
  MODIFY `PieceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Constrângeri pentru tabele eliminate
--

--
-- Constrângeri pentru tabele `pieces`
--
ALTER TABLE `pieces`
  ADD CONSTRAINT `pieces_ibfk_1` FOREIGN KEY (`ContestantID`) REFERENCES `contestants` (`ID`);

--
-- Constrângeri pentru tabele `scores`
--
ALTER TABLE `scores`
  ADD CONSTRAINT `scores_ibfk_1` FOREIGN KEY (`ContestantID`) REFERENCES `contestants` (`ID`),
  ADD CONSTRAINT `scores_ibfk_2` FOREIGN KEY (`PieceID`) REFERENCES `pieces` (`PieceID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
