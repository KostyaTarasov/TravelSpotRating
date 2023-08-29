-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 29 2023 г., 20:39
-- Версия сервера: 5.7.36
-- Версия PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `service_travelers`
--

-- --------------------------------------------------------

--
-- Структура таблицы `attractions`
--

DROP TABLE IF EXISTS `attractions`;
CREATE TABLE IF NOT EXISTS `attractions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_catalog` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `distance` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `attractions`
--

INSERT INTO `attractions` (`id`, `id_catalog`, `name`, `distance`) VALUES
(1, 1, 'Кремль', 0),
(2, 1, 'Третьяковская галерея', 2),
(3, 3, 'Знаменитая трёхкупольная церковь', 12),
(4, 3, 'Мельницы Ии', 11),
(5, 2, 'Пирамида Хеопса', 15),
(6, 4, 'Статуя Свободы', 9);

-- --------------------------------------------------------

--
-- Структура таблицы `cairo`
--

DROP TABLE IF EXISTS `cairo`;
CREATE TABLE IF NOT EXISTS `cairo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `id_attraction` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `score` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cairo`
--

INSERT INTO `cairo` (`id`, `author_id`, `id_attraction`, `name`, `text`, `score`) VALUES
(1, 1, 5, 'Впечатляет', 'Не мог поверить, какое великолепие открывается перед глазами. Обязательно стоит посетить!', 4),
(2, 2, 5, 'Ужасно', 'Кроме пирамид здесь нечего смотреть', 2),
(3, 1, 5, 'Не понравилось', 'Очень жарко', 1),
(4, 2, 5, 'Прекрасное место!', 'Великолепная архитектура и история. Это место действительно переносит вас в прошлое.', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `catalog`
--

DROP TABLE IF EXISTS `catalog`;
CREATE TABLE IF NOT EXISTS `catalog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cpu_name_catalog` char(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `content` mediumblob NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `catalog`
--

INSERT INTO `catalog` (`id`, `cpu_name_catalog`, `name`, `text`, `content`) VALUES
(1, 'moscow', 'Москва', 'Москва́ — столица России, город федерального значения, административный центр Центрального федерального округа и центр Московской области', 0x6d6f73636f77),
(2, 'cairo', 'Каир', 'Столица Арабской Республики Египет. Крупнейший город Ближнего Востока и третий по величине город Африки', 0x636169726f),
(3, 'oia', 'Ия', 'Ия (Ойя, Oia) – крупнейший город-курорт на Санторини', 0x6f6961),
(4, 'new-york', 'Нью-Йорк', 'Крупнейший город США, входящий в одну из крупнейших агломераций мира.', 0x6e65775f796f726b);

-- --------------------------------------------------------

--
-- Структура таблицы `moscow`
--

DROP TABLE IF EXISTS `moscow`;
CREATE TABLE IF NOT EXISTS `moscow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `id_attraction` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `score` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `moscow`
--

INSERT INTO `moscow` (`id`, `author_id`, `id_attraction`, `name`, `text`, `score`) VALUES
(1, 1, 1, 'Советую всем посетить', 'Я был поражен красотой этой достопримечательности. Она просто ошеломляет своим величием.', 4),
(2, 1, 2, 'Замечательное место', 'Уникальное место, где можно погрузиться в культуру и традиции. Обязательно добавьте это в свой список мест для посещения.', 5),
(3, 2, 2, '\nОтвратительно', 'Безобразно организована продажа электронных билетов.', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `new_york`
--

DROP TABLE IF EXISTS `new_york`;
CREATE TABLE IF NOT EXISTS `new_york` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `id_attraction` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `score` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `new_york`
--

INSERT INTO `new_york` (`id`, `author_id`, `id_attraction`, `name`, `text`, `score`) VALUES
(1, 2, 6, 'Супер', 'Лучшее месте в мире!', 3),
(2, 2, 6, 'Хороший выбор', 'Очень понравилось', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `oia`
--

DROP TABLE IF EXISTS `oia`;
CREATE TABLE IF NOT EXISTS `oia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `id_attraction` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `score` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `oia`
--

INSERT INTO `oia` (`id`, `author_id`, `id_attraction`, `name`, `text`, `score`) VALUES
(1, 1, 3, 'Магическое место, которое нельзя оставить без внимания. Чувствуется дух времени.', 'Экскурсия отличная! История достижений людей древних эпох в периоды настоящего расцвета талантов архитекторов, скульпторов, мыслителей и творческих идей.', 5),
(2, 2, 4, 'Волшебное место', 'Пребывание здесь было как погружение в прошлое. Очень впечатляюще!', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `role` enum('admin','user') NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `auth_token` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nickname` (`nickname`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `nickname`, `email`, `is_confirmed`, `role`, `password_hash`, `auth_token`, `created_at`) VALUES
(1, 'Alex', 'admin@gmail.com', 1, 'admin', 'hash1', 'token1', '2023-08-28 18:52:29'),
(2, 'Lena', 'user@gmail.com', 1, 'user', 'hash2', 'token2', '2023-08-28 18:52:29');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
