-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2022-02-07 18:47:03
-- 服务器版本： 5.7.26
-- PHP 版本： 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `test`
--

-- --------------------------------------------------------

--
-- 表的结构 `keytab`
--

CREATE TABLE `keytab` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `superior` int(11) NOT NULL,
  `key_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `use_date` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `keytab`
--

INSERT INTO `keytab` (`id`, `type`, `superior`, `key_name`, `user`, `use_date`) VALUES
(1, 0, 0, '123', '1231', 1643806925),
(2, 0, 0, '123', 'huangmo', 1643808575);

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `superior` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `register_time` int(11) NOT NULL,
  `hwid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_change` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `type`, `superior`, `username`, `password`, `register_time`, `hwid`, `last_change`) VALUES
(1, 0, 0, 'huangmo', '$2y$10$vcUpeESBeMqTWijrg88yzeLv8Hbs2snOSJ8AqPwTHiznOZGp.4JUi', 0, '', 1643974751),
(2, 0, 0, '111', '111', 0, '', 0),
(3, 0, 0, '123', '123', 1643808575, '', 0),
(4, 0, 0, 'huangmo1', '$2y$10$G5grGP5NDTBV2ROPTKhFVebvyFExcsRLQznlcJu38kIQRttkhPIjm', 1643808575, '', 0);

--
-- 转储表的索引
--

--
-- 表的索引 `keytab`
--
ALTER TABLE `keytab`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `keytab`
--
ALTER TABLE `keytab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
