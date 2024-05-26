-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 04, 2024 at 10:40 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(1, 'tech'),
(2, 'data'),
(3, 'help');

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
(2, '2202-02-02', 'uuuuu', 'Contents', 'hj', 47.00, 1, '431266865_1744751382702414_7626407470546934318_n.jpg', 'cat1');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sender_username` varchar(255) NOT NULL,
  `recipient_username` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `sent_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `sender_email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_username`, `recipient_username`, `message`, `sent_at`, `sender_email`, `subject`) VALUES
(1, 'tyyuy', '', 'gygygy', '2024-03-04 21:43:46', '', ''),
(2, 'Victor Adly Israel', '', 'yhhuyuyyu', '2024-03-04 22:04:39', 'victor.mecdoors@gmail.com', 'yuytyv'),
(3, 'vico', '', 'sededce fvrtfg rgtvbtgt', '2024-03-04 22:15:19', 'victor@gmail.com', 'aaaaaaaaa'),
(4, 'yahoo', '', 'cecefcefcr rvfrfr rfvf', '2024-03-04 22:16:53', 'victor@gmail.com', 'ewdec'),
(5, 'yahoo', '', 'dede rfrf rfre', '2024-03-04 22:17:25', 'victor@gmail.com', 'ewdec'),
(6, 'yahoo', '', 'dede drfede', '2024-03-04 22:17:59', 'victdedor@gmail.com', 'ewddedec'),
(7, 'nih', '', 'ddddddddddddd', '2024-03-04 22:22:02', 'victor.mecdoors@gmail.com', 'cdscd');

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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `regdate`, `full_name`, `username`, `email`, `password`, `active`, `image_path2`) VALUES
(2, '2024-03-01 16:32:51', 'name', 'sooooo', 'some@gmail.com', '$2y$10$etyUsHjoprCrlGbk9I9gpuJgiHNSVjRmGcHJvB5wxuzO/Q3Dzi/La', 1, 'heading-bg.jpg'),
(3, '2024-03-02 21:17:17', 'white', 'vivooo', 'hh@hh.vv', '$2y$10$pTV1Iiwh5XyRrMJEow/qXOrjNAAXbbqT18ZLZeOcay0GtB7oYt1xS', 1, 'meeting-03.jpg'),
(4, '2024-03-02 21:23:00', 'victor rider', 'victor4040', 'victor@gmail.com', '$2y$10$icyR77aFt13lL.gQOApHduk6FNHXieYN5fgr4G/2A3A.yrEIxOYNm', 1, 'meeting-03.jpg'),
(5, '2024-03-03 07:45:38', 'Victor Adly Israel', 'victor2020', 'victor.mecdoors@gmail.com', '$2y$10$Ly4pP0JkWQPEsJT2PEUDeeEIYGyaQE1gvpUbCIDwVfZxKVAuSFgWC', 1, ''),
(10, '2024-03-03 10:02:20', 'guru', 'victor66', 'go44@gmail.com', '$2y$10$jsh1DhnpHOvSZnjaqN9YWOypG1.WIMwk/ZgVFzmI8xUuUU.JHDM7.', 1, ''),
(11, '2024-03-03 10:54:56', 'Victor israel', 'victor4080', 'victor.mecdoors@gmail.com', '$2y$10$.otxn24JNhHUnId8be1qXOjLJHTEyL4as7Me3G2NJF.CSBn/LuPu.', 1, 'avatars-000052089163-w0ujrh-t500x500.jpg'),
(12, '2024-03-03 12:50:56', 'Victor israel', 'hollow', 'victor@gmail.com', '$2y$10$dJ3lF6BfVNYimas.VIvylOQN9J3/j833onkVsLG17ysEMTSRXAPoG', 1, 'mastercard.png'),
(13, '2024-03-04 18:36:17', 'vico ', 'vico2025', 'victor@gmail.com', '$2y$10$5oaXebGbAucArJ7pEk2WQ.u9o/sAwyd2DArFuiYj1Uoj6Yi7EYIWe', 1, 'video-item-bg.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
