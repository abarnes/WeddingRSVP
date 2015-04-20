-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 28, 2012 at 12:55 AM
-- Server version: 5.1.44
-- PHP Version: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rsvp`
--

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `attending` int(1) NOT NULL,
  `responded` tinyint(1) NOT NULL,
  `guest_allowed` tinyint(1) NOT NULL,
  `guest_attending` int(1) NOT NULL,
  `party_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=74 ;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` VALUES(66, 'Randy', 'Olson', 0, 0, 0, 0, 1, '2012-01-25 19:07:32', '2012-01-25 19:07:32');
INSERT INTO `guests` VALUES(67, 'Dani', 'Olson', 0, 0, 0, 0, 1, '2012-01-25 19:07:32', '2012-01-25 19:07:32');
INSERT INTO `guests` VALUES(68, 'Robert', 'Barnes', 0, 0, 0, 0, 2, '2012-01-25 19:07:32', '2012-01-25 19:07:32');
INSERT INTO `guests` VALUES(69, 'Jonnie Ruth', 'Barnes', 0, 0, 0, 0, 2, '2012-01-25 19:07:32', '2012-01-25 19:07:32');
INSERT INTO `guests` VALUES(70, 'Colton', 'Barnes', 0, 0, 0, 0, 3, '2012-01-25 19:07:32', '2012-01-25 19:07:32');
INSERT INTO `guests` VALUES(71, 'Kyle', 'Barnes', 0, 0, 0, 0, 4, '2012-01-25 19:07:32', '2012-01-25 19:07:32');
INSERT INTO `guests` VALUES(72, 'Robert "The Quaker"', 'Baker', 0, 0, 0, 0, 5, '2012-01-25 19:08:04', '2012-01-25 19:08:04');
INSERT INTO `guests` VALUES(73, 'Jamie', 'Jackson', 0, 0, 0, 0, 5, '2012-01-25 19:08:15', '2012-01-25 19:08:15');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `w_date` date NOT NULL,
  `c_date` date NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `settings`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES(1, 'austin', 'd91eef46379097b4a030aec6114fa442c048239e', NULL, '2012-01-24 19:13:05', '2012-01-24 19:13:05');
INSERT INTO `users` VALUES(2, 'ashleigh', 'e0ca6181b849ade54e4147904982a27f4a15be29', NULL, '2012-01-24 19:15:53', '2012-01-24 19:15:53');
