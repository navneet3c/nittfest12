-- phpMyAdmin SQL Dump
-- version 3.0.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 22, 2012 at 04:05 PM
-- Server version: 5.0.67
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nittfest`
--

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE IF NOT EXISTS `scores` (
  `branch_id` int(5) NOT NULL auto_increment,
  `branch_name` varchar(500) NOT NULL,
  `culturals` int(5) NOT NULL,
  `english_lits` int(5) NOT NULL,
  `hindi_lits` int(5) NOT NULL,
  `tamil_lits` int(5) NOT NULL,
  `arts` int(5) NOT NULL,
  `design` int(5) NOT NULL,
  PRIMARY KEY  (`branch_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`branch_id`, `branch_name`, `culturals`, `english_lits`, `hindi_lits`, `tamil_lits`, `arts`, `design`) VALUES
(1, 'Architecture', 0, 0, 0, 0, 0, 0),
(2, 'Chemical Engineering', 0, 0, 0, 0, 0, 0),
(3, 'Civil Engineering', 0, 0, 0, 0, 0, 0),
(4, 'Computer Applications', 0, 0, 0, 0, 0, 0),
(5, 'Computer Science and Engineering', 0, 0, 0, 0, 0, 0),
(6, 'Electrical and Electronics Engineering', 0, 0, 0, 0, 0, 0),
(7, 'Electronics and Communication Engineering', 0, 0, 0, 0, 0, 0),
(8, 'Instrumentation and Control Engineering', 0, 0, 0, 0, 0, 0),
(9, 'Management Studies', 0, 0, 0, 0, 0, 0),
(10, 'Mechanical Engineering', 0, 0, 0, 0, 0, 0),
(11, 'Metallurgical and Materials Engineering', 0, 0, 0, 0, 0, 0),
(12, 'Production Engineering', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `score_details`
--

CREATE TABLE IF NOT EXISTS `score_details` (
  `update_id` int(8) NOT NULL auto_increment,
  `branch_id` int(5) NOT NULL,
  `category_id` int(2) NOT NULL,
  `rank` int(2) NOT NULL,
  `score` int(3) NOT NULL,
  `event_id` int(3) NOT NULL,
  `description` text NOT NULL,
  `time` double NOT NULL,
  PRIMARY KEY  (`update_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `score_details`
--


-- --------------------------------------------------------

--
-- Table structure for table `score_log`
--

CREATE TABLE IF NOT EXISTS `score_log` (
  `serial` int(8) NOT NULL auto_increment,
  `branch` int(2) NOT NULL,
  `event` int(2) NOT NULL,
  `subevent` int(3) NOT NULL,
  `position` int(2) NOT NULL,
  `points` int(3) NOT NULL,
  `time` double NOT NULL,
  PRIMARY KEY  (`serial`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `score_log`
--


