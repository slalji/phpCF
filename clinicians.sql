-- phpMyAdmin SQL Dump
-- version 3.4.11.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 12, 2014 at 05:57 PM
-- Server version: 5.5.36
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `likejagg_dtcu`
--

-- --------------------------------------------------------

--
-- Table structure for table `clinicians`
--

DROP TABLE IF EXISTS `clinicians`;
CREATE TABLE IF NOT EXISTS `clinicians` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `complete` varchar(10) NOT NULL DEFAULT '',
  `counter` int(11) NOT NULL DEFAULT '0',
  `startdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tableName` varchar(60) NOT NULL,
  `study` varchar(60) NOT NULL,
  `round0` varchar(30) NOT NULL,
  `round1` varchar(30) NOT NULL,
  `round2` varchar(30) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
)  ;

--
-- Dumping data for table `clinicians`
--

INSERT INTO `clinicians` (`id`, `complete`, `counter`, `startdate`, `tableName`, `study`, `round0`, `round1`, `round2`, `username`, `password`) VALUES
(13, 'yes', 3, '2014-02-13 00:21:01', 'salma@wisecrack.ca', 'clinicians', 'Mag1', 'Mag2', 'Mag3', 'salma@wisecrack.ca', '760b87ae1f0131d156e79a8aed8bbc10aae2fd84'),
(10, '', 2, '2014-02-12 19:33:30', 'Mag2', 'clinicians', 'Mag1', 'Mag3', 'Mag2', 'salma', '75c329f996b5d31efac27400dcbaddc3e26aa0dd'),
(12, '', 0, '2014-02-12 23:55:39', 'Mag1', 'clinicians', 'Mag2', 'Mag3', 'Mag1', 'salma3', '75c329f996b5d31efac27400dcbaddc3e26aa0dd'),
(11, 'yes', 3, '2014-02-12 19:37:30', 'salma2', 'clinicians', 'Mag3', 'Mag1', 'Mag2', 'salma2', '75c329f996b5d31efac27400dcbaddc3e26aa0dd'),
(15, '', 0, '2014-02-13 00:40:36', 'Mag2', 'clinicians', 'Mag2', 'Mag3', 'Mag1', 'scriptalerthelscript', '75c329f996b5d31efac27400dcbaddc3e26aa0dd');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
