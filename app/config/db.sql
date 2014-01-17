-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 17, 2014 at 04:09 PM
-- Server version: 5.5.32-0ubuntu0.12.04.1
-- PHP Version: 5.3.10-1ubuntu3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `boilerplate`
--

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

DROP TABLE IF EXISTS `cms`;
CREATE TABLE IF NOT EXISTS `cms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `hook` int(11) NOT NULL,
  `is_visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`id`, `title`, `content`, `slug`, `hook`, `is_visible`) VALUES
(1, 'Ceci est une page', '<p>Et ca le contenu</p>', 'ceci-est-une-page', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `roles` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `roles`) VALUES
(1, 'admin', 'BFEQkknI/c+Nd7BaG7AaiyTfUFby/pkMHy3UsYqKqDcmvHoPRX/ame9TnVuOV2GrBH0JK9g4koW+CgTYI9mK+w==', 'ROLE_ADMIN');
