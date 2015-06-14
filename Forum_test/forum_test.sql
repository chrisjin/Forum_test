-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-06-14 01:36:13
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
-- 表的结构 `post`
--

CREATE TABLE IF NOT EXISTS `post` (
`post_id` int(15) NOT NULL,
  `isop` tinyint(1) NOT NULL,
  `content` text NOT NULL,
  `post_time` datetime(6) NOT NULL,
  `thread_id` int(15) NOT NULL,
  `user_id` int(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `post`
--

INSERT INTO `post` (`post_id`, `isop`, `content`, `post_time`, `thread_id`, `user_id`) VALUES
(5, 1, 'Hello Content', '2015-06-08 22:38:40.000000', 11, 1),
(6, 1, '&lt;p&gt;hahahahahahahahhahahahah&lt;/p&gt;', '2015-06-10 23:06:17.000000', 12, 5),
(7, 1, '&lt;p&gt;gaga&lt;/p&gt;', '2015-06-10 23:28:56.000000', 13, 5),
(8, 1, '&lt;p&gt;ssss&lt;/p&gt;', '2015-06-11 00:19:46.000000', 14, 5),
(9, 1, '&lt;p&gt;OKKKK&lt;/p&gt;', '2015-06-11 00:25:45.000000', 15, 1),
(10, 0, '&lt;p&gt;shafa&lt;/p&gt;\r\n', '2015-06-11 20:30:43.000000', 12, 1),
(11, 0, '&lt;p&gt;sha fa&lt;/p&gt;\r\n', '2015-06-11 20:45:15.000000', 12, 1),
(14, 0, '哈哈', '2015-06-11 21:15:24.000000', 12, 1),
(15, 0, '&lt;p&gt;试试&lt;/p&gt;\r\n', '2015-06-11 21:16:41.000000', 12, 1),
(16, 0, '&lt;p&gt;咩咩咩&lt;/p&gt;\r\n', '2015-06-12 23:44:14.000000', 12, 1),
(17, 0, '&lt;p&gt;咩咩咩试试&lt;/p&gt;\r\n', '2015-06-12 23:49:31.000000', 12, 1),
(18, 0, '&lt;p&gt;咩咩咩试试&lt;/p&gt;\r\n', '2015-06-12 23:49:52.000000', 12, 1),
(19, 0, '&lt;p&gt;生生世世&lt;/p&gt;\r\n', '2015-06-12 23:50:07.000000', 12, 1),
(20, 0, '&lt;p&gt;哈哈哈哈哈&lt;/p&gt;\r\n', '2015-06-12 23:52:27.000000', 12, 1),
(21, 0, '&lt;p&gt;新一页&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;', '2015-06-13 00:02:01.000000', 12, 1),
(22, 0, '&lt;p&gt;新&lt;/p&gt;\r\n', '2015-06-13 00:02:14.000000', 12, 1),
(23, 0, '&lt;p&gt;xx&lt;/p&gt;\r\n', '2015-06-13 00:07:56.000000', 12, 1),
(24, 1, '&lt;p&gt;RT&lt;/p&gt;', '2015-06-13 13:21:53.000000', 16, 1),
(25, 1, '&lt;p&gt;哈哈&lt;/p&gt;', '2015-06-13 15:21:38.000000', 17, 1),
(26, 0, '&lt;p&gt;顶&lt;/p&gt;\r\n', '2015-06-13 16:45:08.000000', 12, 1),
(27, 0, '&lt;p&gt;顶&lt;/p&gt;\r\n', '2015-06-13 16:46:26.000000', 12, 1),
(28, 0, '&lt;p&gt;顶&lt;/p&gt;\r\n', '2015-06-13 16:48:45.000000', 12, 1),
(29, 1, '&lt;p&gt;水水水水水&lt;/p&gt;', '2015-06-13 19:01:43.000000', 18, 7),
(30, 0, '哈哈哈', '2015-06-13 19:23:17.000000', 18, 7),
(31, 0, '这阵子', '2015-06-13 19:26:28.000000', 18, 7),
(32, 0, '生生世世', '2015-06-13 19:27:33.000000', 18, 7),
(33, 0, '压', '2015-06-13 19:28:33.000000', 18, 7);

-- --------------------------------------------------------

--
-- 表的结构 `section`
--

CREATE TABLE IF NOT EXISTS `section` (
`section_id` int(15) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `section`
--

INSERT INTO `section` (`section_id`, `name`) VALUES
(1, 'General Discussion'),
(2, 'Academic Discussion');

-- --------------------------------------------------------

--
-- 表的结构 `subsection`
--

CREATE TABLE IF NOT EXISTS `subsection` (
`subsection_id` int(15) NOT NULL,
  `name` varchar(30) NOT NULL,
  `section_id` int(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `subsection`
--

INSERT INTO `subsection` (`subsection_id`, `name`, `section_id`) VALUES
(1, 'Syracuse Life', 1),
(2, 'Other', 1),
(3, 'Computer Science', 2),
(4, 'iSchool', 2);

-- --------------------------------------------------------

--
-- 表的结构 `thread`
--

CREATE TABLE IF NOT EXISTS `thread` (
`thread_id` int(15) NOT NULL,
  `title` varchar(30) NOT NULL,
  `create_time` datetime NOT NULL,
  `lastreply` datetime NOT NULL,
  `subsection_id` int(15) NOT NULL,
  `user_id` int(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `thread`
--

INSERT INTO `thread` (`thread_id`, `title`, `create_time`, `lastreply`, `subsection_id`, `user_id`) VALUES
(11, 'First', '2015-06-08 22:38:40', '2015-06-08 22:38:40', 2, 1),
(12, 'Tiezihahahahahahahahha', '2015-06-10 23:06:17', '2015-06-13 16:48:45', 1, 5),
(13, 'second thread', '2015-06-10 23:28:56', '2015-06-10 23:28:56', 1, 5),
(14, 'KKK', '2015-06-11 00:19:46', '2015-06-11 00:19:46', 1, 5),
(15, 'Haha', '2015-06-11 00:25:45', '2015-06-11 00:25:45', 1, 1),
(16, '中文题目', '2015-06-13 13:21:53', '2015-06-13 13:21:53', 1, 1),
(17, '新回复', '2015-06-13 15:21:38', '2015-06-13 15:21:38', 1, 1),
(18, 'Yell', '2015-06-13 19:01:43', '2015-06-13 19:28:33', 1, 7);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`user_id` int(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`user_id`, `email`, `username`, `password`, `salt`, `firstname`, `lastname`) VALUES
(1, '1132743253@qq.com', 'Jin', 'e10adc3949ba59abbe56e057f20f883e', '', '', ''),
(5, 'iamjinsk@gmail.com', 'jjjjjj', 'ec20019911a77ad39d023710be68aaa1', '', '', ''),
(6, 'sjin02@syr.edu', 'ShikaiJin_Syracuse', '3e896e8ce46287afc196e9ab100bc5be', '', '', ''),
(7, 'a@dummy.com', 'admin', '63a9f0ea7bb98050796b649e85481845', '3e09312b7d', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `post`
--
ALTER TABLE `post`
 ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
 ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `subsection`
--
ALTER TABLE `subsection`
 ADD PRIMARY KEY (`subsection_id`);

--
-- Indexes for table `thread`
--
ALTER TABLE `thread`
 ADD PRIMARY KEY (`thread_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
MODIFY `post_id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
MODIFY `section_id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `subsection`
--
ALTER TABLE `subsection`
MODIFY `subsection_id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `thread`
--
ALTER TABLE `thread`
MODIFY `thread_id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `user_id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
