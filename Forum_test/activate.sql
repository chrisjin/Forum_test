-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-08-25 21:14:43
-- 服务器版本： 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `forum_test`
--

-- --------------------------------------------------------

--
-- 表的结构 `activate`
--

CREATE TABLE IF NOT EXISTS `activate` (
`activate_id` int(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `activate`
--

INSERT INTO `activate` (`activate_id`, `email`, `code`) VALUES
(1, 'iamjinsk@gmail.com', '111'),
(2, 'H@a.com', '32455b3b-52ca-ff6e-e4da-b664d33c0c45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activate`
--
ALTER TABLE `activate`
 ADD PRIMARY KEY (`activate_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activate`
--
ALTER TABLE `activate`
MODIFY `activate_id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
