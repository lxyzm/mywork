-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2019 �?07 �?30 �?12:45
-- 服务器版本: 5.5.53
-- PHP 版本: 5.5.38

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `blog`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `logintime` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `time`, `logintime`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1560256389, 1564374062, 0);

-- --------------------------------------------------------

--
-- 表的结构 `column`
--

CREATE TABLE IF NOT EXISTS `column` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `typeid` int(11) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `text` text,
  `zannum` int(11) DEFAULT NULL,
  `shounum` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `news`
--

INSERT INTO `news` (`id`, `title`, `time`, `author`, `typeid`, `num`, `img`, `keywords`, `description`, `text`, `zannum`, `shounum`) VALUES
(19, 'asdfasdf', 1564374150, 'asdf', 1, 35, '20190729\\7cd9bcf1229eb52138b1fc0e8f79202b.jpg', '<>', 'asdfas', '<p><img src="/ueditor/php/upload/image/20190729/1564374131440042.jpg" title="1564374131440042.jpg" alt="1.jpg"/></p>', 0, 0),
(18, 'aaaa', 1562156619, 'aa', 1, 17, '20190703\\903f82eec718c0b274bcdc3babce7384.jpg', 'aaa', 'aa', '<p>safdsa<br/></p>', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `newtype`
--

CREATE TABLE IF NOT EXISTS `newtype` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `newtype`
--

INSERT INTO `newtype` (`id`, `name`) VALUES
(1, 'a'),
(2, 'aaa'),
(3, 'aaaa');

-- --------------------------------------------------------

--
-- 表的结构 `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `slider`
--

INSERT INTO `slider` (`id`, `name`, `url`, `img`, `sort`) VALUES
(1, 'a', 'a', '20190703\\8e943fced70729d3669ee13bd6a91ffd.jpg', 0),
(2, 'b', 'a', '20190703\\d730637e7f80b14f37e2693f49ff230e.jpg', 0),
(3, 'c', 'a', '20190703\\b17a63c6758b1c9672d7f084344711fc.jpg', 0);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `nickname` varchar(30) DEFAULT NULL,
  `img` varchar(50) DEFAULT NULL,
  `collect` tinytext,
  `prise` tinytext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `phone`, `email`, `time`, `status`, `nickname`, `img`, `collect`, `prise`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '1630282085', NULL, 1564487438, 0, NULL, NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
