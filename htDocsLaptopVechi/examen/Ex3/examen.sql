-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2018 at 10:45 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `examen`
--

-- --------------------------------------------------------

--
-- Table structure for table `cereri`
--

CREATE TABLE `cereri` (
  `nume` varchar(30) NOT NULL,
  `prenume` varchar(30) NOT NULL,
  `adresa` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telefon` varchar(30) NOT NULL,
  `file` varchar(30) NOT NULL,
  `idCerere` int(11) NOT NULL,
  `procesare` int(11) NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cereri`
--

INSERT INTO `cereri` (`nume`, `prenume`, `adresa`, `email`, `telefon`, `file`, `idCerere`, `procesare`, `timestamp`) VALUES
('Boros', 'dsa', 'dasd', 'oti_otniel97@yahoo.com', '123', '01_introAI.pdf', 21, 1, '2018-06-15 10:09:30'),
('Boros Florin', 'dsa', 'sadsad', 'sdadasdsadas', '014324', '01_search.pdf', 22, 0, '2018-06-15 10:10:04'),
('das', 'dsa', 'dsa', 'otiotniel97@gmail.com', '14331', '02_search_EA_suplim.pdf', 23, 1, '2018-06-15 10:32:52'),
('dsa', 'dsa', 'dsa', 'dsa', '3434', 'injection.php', 24, 0, '2018-06-15 11:23:05'),
('dsa', 'dsa', 'dsa', 'dsa', '3434', 'injection.php', 25, 0, '2018-06-15 12:12:44'),
('dsa', 'dsa', 'dsa', 'dsa', '3434', 'injection.php', 26, 0, '2018-06-15 12:15:32'),
('dsa', 'dsa', 'dsa', 'dsa', '3434', 'injection.php', 27, 0, '2018-06-15 12:19:27'),
('dsa', 'dsa', 'dsa', 'dsa', '3434', 'injection.php', 28, 0, '2018-06-15 12:41:19'),
('dsa', 'dsa', 'dsa', 'dsa', '3434', 'injection.php', 29, 0, '2018-06-15 12:41:42');

-- --------------------------------------------------------

--
-- Table structure for table `intrebari`
--

CREATE TABLE `intrebari` (
  `id` int(11) NOT NULL,
  `intrebare` varchar(150) NOT NULL,
  `r1` varchar(150) NOT NULL,
  `r2` varchar(150) NOT NULL,
  `r3` varchar(150) NOT NULL,
  `rc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `intrebari`
--

INSERT INTO `intrebari` (`id`, `intrebare`, `r1`, `r2`, `r3`, `rc`) VALUES
(1, 'Intrebare1', 'da', 'nu', 'poate', 1),
(2, 'Intrebare2', 'da', 'nu', 'poate', 2),
(3, 'intrebare3', 'da', 'nu', 'poate', 3),
(4, 'intrebare4', 'da ', 'nu', 'poate', 2),
(5, 'intrebare5', 'da', 'nu', 'poate', 2),
(6, 'intrebare6', 'da', 'poate', 'nu', 1),
(7, 'intrebare7', 'nu ', 'poate', 'da', 2);

-- --------------------------------------------------------

--
-- Table structure for table `useri`
--

CREATE TABLE `useri` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `useri`
--

INSERT INTO `useri` (`username`, `password`) VALUES
('admin', 'admin'),
('root', 'root');

-- --------------------------------------------------------

--
-- Table structure for table `utilizatori`
--

CREATE TABLE `utilizatori` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `fotografie` varchar(30) NOT NULL,
  `telefon` varchar(30) NOT NULL,
  `varsta` int(11) NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utilizatori`
--

INSERT INTO `utilizatori` (`username`, `password`, `email`, `fotografie`, `telefon`, `varsta`, `timestamp`) VALUES
('', 'adsa', 'dsa', 'Screenshot (4).png', 'd134', 123, '2018-06-15 18:22:27'),
('admin', 'admin', 'oti_otniel97@yahoo.com', 'adsa', '05324234', 134, '2018-06-13 05:16:00'),
('asdada', 'dsadsa', 'dsada', 'Screenshot (5).png', '1231231', 111, '2018-06-15 18:27:08'),
('dsa', 'sda', 'dsa', 'Screenshot (4).png', '143141', 123, '2018-06-15 18:23:46'),
('root', 'root', 'oti_otniel97@yahoo.com', 'screen.png', '977343242', 77, '2018-06-15 17:10:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cereri`
--
ALTER TABLE `cereri`
  ADD PRIMARY KEY (`idCerere`);

--
-- Indexes for table `intrebari`
--
ALTER TABLE `intrebari`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `useri`
--
ALTER TABLE `useri`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `utilizatori`
--
ALTER TABLE `utilizatori`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cereri`
--
ALTER TABLE `cereri`
  MODIFY `idCerere` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `intrebari`
--
ALTER TABLE `intrebari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
