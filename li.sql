-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 20 2018 г., 02:40
-- Версия сервера: 5.5.50
-- Версия PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `li`
--

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) unsigned NOT NULL,
  `id_user` bigint(20) DEFAULT NULL,
  `id_user_fb` bigint(20) NOT NULL,
  `id_parent` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) DEFAULT NULL,
  `post` varchar(1000) DEFAULT NULL,
  `time_update` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `id_user`, `id_user_fb`, `id_parent`, `name`, `post`, `time_update`) VALUES
(1, 2, 255752445228417, 0, 'User2', 'Lorem ipsum dolor sit amet, c', '2018-02-19 23:21:07'),
(2, 2, 255752445228417, 0, 'User2', 'Lorem ipsum dolor sit amet, consectetur', '2018-02-19 23:21:30'),
(3, 1, 155752445228417, 2, 'User1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum felis a molestie ornare. Donec et ipsum in purus bibendum venenatis quis at leo. Maecenas augue tortor, imperdiet consequat nisl a, pharetra vulputate urna. Vivamus consequat leo nisi, sit amet ullamcorper neque porta vitae. Phasellus faucibus orci quis convallis laoreet. Aliquam erat volutpat. Aliquam rutrum id est sit amet euismod. Praesent non eros massa. Fusce efficitur commodo leo ac bibendum', '2018-02-19 23:30:26'),
(4, 2, 255752445228417, 3, 'User2', 'Lorem', '2018-02-19 23:30:31');

-- --------------------------------------------------------

--
-- Структура таблицы `registration`
--

CREATE TABLE IF NOT EXISTS `registration` (
  `id` int(11) unsigned NOT NULL,
  `id_fb` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `registration`
--

INSERT INTO `registration` (`id`, `id_fb`, `name`, `email`) VALUES
(1, 155752445228417, 'User1', 'User1@gmail.com'),
(2, 255752445228417, 'User2', 'User2@gmail.com');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
