-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 03, 2024 at 11:11 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `backrv`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(1, 'tech'),
(2, 'data'),
(3, 'help'),
(4, 'TEST2');

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

DROP TABLE IF EXISTS `meetings`;
CREATE TABLE IF NOT EXISTS `meetings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `meeting_date` date NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `active` tinyint(1) DEFAULT '0',
  `image_path` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_meetings_categories` (`category`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`id`, `meeting_date`, `title`, `content`, `location`, `price`, `active`, `image_path`, `category`) VALUES
(1, '2022-04-04', 'vfgvfv', 'Contentsrfrfrvr', 'tgtgtgt', '55.00', 1, '319632449_1542786829480436_4425933772347584683_n.jpg', 'cat1'),
(2, '2202-02-02', 'uuuuu', 'Contents', 'hj', '47.00', 1, '431266865_1744751382702414_7626407470546934318_n.jpg', 'cat1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `regdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `full_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `image_path2` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `regdate`, `full_name`, `username`, `email`, `password`, `active`, `image_path2`) VALUES
(2, '2024-03-01 16:32:51', 'name', 'some', 'some@gmail.com', '$2y$10$RFpLA8Lej3WwTCKT1ivPiuroGoQFOSGld2GpVFqtx1X/aLX3vjYYi', 1, ''),
(3, '2024-03-02 21:17:17', 'white', 'vivooo', 'hh@hh.vv', '$2y$10$y1jMjeN74rgV9TRwv/gFfe/nK2JGQeg1DCJJX9sE.L7JQA3YAh.ha', 0, ''),
(4, '2024-03-02 21:23:00', 'victor rider', 'victor4040', 'victor@gmail.com', '$2y$10$SGLCX2GaqwaIbhEu7To/R.S7Sl80RKX6vwRr3ZsMejAk.akKjn0RS', 1, ''),
(5, '2024-03-03 07:45:38', '', 'victor2020', '', '$2y$10$EHNlYLWQU9VQ.zB6MPtUSuMRQtfvUaR72KCEdq7Fxq9qlFDexBzj2', 1, ''),
(10, '2024-03-03 10:02:20', 'guru', 'victor66', 'go44@gmail.com', '$2y$10$jsh1DhnpHOvSZnjaqN9YWOypG1.WIMwk/ZgVFzmI8xUuUU.JHDM7.', 1, ''),
(11, '2024-03-03 10:54:56', 'Victor israel', 'victor4080', 'victor.mecdoors@gmail.com', '$2y$10$USeyxqcZdW5ewhmaaQ54LeYABZeqO507z.HVfhokeEGtbpPUB/hEu', 1, 'avatars-000052089163-w0ujrh-t500x500.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
