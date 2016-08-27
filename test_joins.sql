-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3366
-- Generation Time: Aug 26, 2016 at 05:03 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test_joins`
--

-- --------------------------------------------------------

--
-- Table structure for table `music_artist`
--

CREATE TABLE IF NOT EXISTS `music_artist` (
  `artist_id` int(11) NOT NULL AUTO_INCREMENT,
  `artist` varchar(20) NOT NULL,
  PRIMARY KEY (`artist_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `music_artist`
--

INSERT INTO `music_artist` (`artist_id`, `artist`) VALUES
(1, 'Kishore'),
(2, 'Sonu Nigum'),
(3, 'Raj Kishan');

-- --------------------------------------------------------

--
-- Table structure for table `music_cds`
--

CREATE TABLE IF NOT EXISTS `music_cds` (
  `cd_id` int(11) NOT NULL AUTO_INCREMENT,
  `gen_id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `title` varchar(20) NOT NULL,
  PRIMARY KEY (`cd_id`),
  KEY `gen_id` (`gen_id`),
  KEY `artist_id` (`artist_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `music_cds`
--

INSERT INTO `music_cds` (`cd_id`, `gen_id`, `artist_id`, `year`, `title`) VALUES
(1, 3, 1, 1974, 'Padosan'),
(2, 3, 1, 1975, 'Sholey'),
(3, 3, 1, 1976, 'Kati Patang'),
(4, 4, 2, 2001, 'Jaan'),
(5, 4, 2, 2002, 'Dweena'),
(6, 3, 2, 2003, 'Yaad'),
(7, 7, 3, 1975, 'Kirshan Janam'),
(8, 6, 3, 1976, 'Gpoichand'),
(9, 6, 3, 1978, 'Puran Mal'),
(10, 2, 3, 1978, 'Mahabharat'),
(11, 11, 3, 1979, 'Kirshan Sudama'),
(12, 11, 3, 1979, 'Mahabharat'),
(13, 11, 3, 1980, 'Nal Damyanti'),
(14, 2, 3, 1981, 'Jayani Choor'),
(15, 11, 3, 1982, 'Chanderkiran');

-- --------------------------------------------------------

--
-- Table structure for table `music_gens`
--

CREATE TABLE IF NOT EXISTS `music_gens` (
  `gen_id` int(11) NOT NULL AUTO_INCREMENT,
  `gen_type` varchar(50) NOT NULL,
  PRIMARY KEY (`gen_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `music_gens`
--

INSERT INTO `music_gens` (`gen_id`, `gen_type`) VALUES
(1, 'Pop'),
(2, 'Easy Listening'),
(3, 'Blue'),
(4, 'Hip Hop'),
(5, 'Soft'),
(6, 'Jazz'),
(7, 'Dance'),
(8, 'Party Soft'),
(9, 'Party Hard'),
(10, 'Slow Dance'),
(11, 'Raagni');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
