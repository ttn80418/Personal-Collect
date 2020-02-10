-- phpMyAdmin SQL Dump
-- version 2.11.10
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 建立日期: Mar 26, 2019, 02:46 PM
-- 伺服器版本: 5.1.73
-- PHP 版本: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫: `demoDB`
--

-- --------------------------------------------------------

--
-- 資料表格式： `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Bday` datetime NOT NULL,
  `Sex` varchar(30) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '註冊日期',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- 列出以下資料庫的數據： `members`
--

INSERT INTO `members` (`ID`, `Username`, `Password`, `Bday`, `Sex`, `Date`) VALUES
(3, 'owner01', '123456', '2019-03-20 00:00:00', 'ç”·', '2019-03-03 17:59:22'),
(4, 'owner02', '123456789', '2019-03-14 00:00:00', 'å¥³', '2019-03-03 20:27:54'),
(6, 'allen', '123456', '2019-03-13 00:00:00', 'ç”·', '2019-03-03 20:35:03'),
(7, 'shelly', '123456789', '2019-03-30 00:00:00', 'å¥³', '2019-03-03 20:36:04'),
(8, 'kevin', '123456', '2019-03-14 00:00:00', 'ç”·', '2019-03-03 20:36:53');
