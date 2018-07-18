-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 11 Iun 2016 la 14:23
-- Versiune server: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exam2`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `links`
--

DROP TABLE IF EXISTS `links`;
CREATE TABLE IF NOT EXISTS `links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expr` varchar(100) NOT NULL,
  `counts` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `links`
--

INSERT INTO `links` (`id`, `expr`, `counts`) VALUES
(1, 'aj', 1),
(2, 'a', 2),
(3, 'lim', 3),
(18, 'as', 1),
(17, 'programare', 1),
(16, 'ax', 1),
(19, 'de', 3);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userSource` varchar(50) NOT NULL,
  `userTarget` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `transactions`
--

INSERT INTO `transactions` (`id`, `userSource`, `userTarget`, `amount`, `date_time`) VALUES
(14, 'ana', 'aaa', 3, '2016-06-11 15:31:26'),
(13, 'ana', 'alex', 3, '2016-06-11 15:30:43'),
(12, 'ana', 'alex', 44, '2016-06-11 15:30:36'),
(11, 'ana', 'alex', 44, '2016-06-11 15:30:20'),
(10, 'ana', 'alex', 44, '2016-06-11 15:29:37'),
(9, 'ana', 'alex', 3, '2016-06-11 15:29:10'),
(8, 'ana', 'alex', 33, '2016-06-11 14:56:46'),
(15, 'ana', 'aaa', 10, '2016-06-11 15:43:58'),
(16, 'ana', 'alex', 44, '2016-06-11 16:48:34'),
(17, 'ana', 'alex', 44, '2016-06-11 16:48:35'),
(18, 'ana', 'aaa', 1, '2016-06-11 16:49:38'),
(19, 'ana', 'aaa', 1, '2016-06-11 16:49:44'),
(20, 'ana', 'aaa', 1, '2016-06-11 16:49:48'),
(21, 'ana', 'aaa', 1, '2016-06-11 16:51:16');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `sold` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `sold`) VALUES
(1, 'ana', '1a1dc91c907325c69271ddf0c944bc72', 24),
(2, 'alex', '1a1dc91c907325c69271ddf0c944bc72', 792),
(3, 'aaa', '1a1dc91c907325c69271ddf0c944bc72', 317);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
