-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 29 2019 г., 01:24
-- Версия сервера: 8.0.15
-- Версия PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `avito-pro-intern-test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `generations`
--

CREATE TABLE `generations` (
  `id` int(11) NOT NULL,
  `value` text NOT NULL,
  `type` varchar(100) NOT NULL,
  `length` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `generations`
--

INSERT INTO `generations` (`id`, `value`, `type`, `length`) VALUES
(195, '{5D0B1B57-0E36-2DB7-C702-68335B7D15E5}', 'guid', NULL),
(196, '{2EB63C24-5367-F46E-3F55-30658725B081}', 'guid', NULL),
(197, '{2CC82F15-D7EA-7A57-6C05-AF990212BFAF}', 'guid', NULL),
(198, '{907EADD0-003B-E26C-59C8-EB286488D361}', 'guid', NULL),
(199, 'dAAJS39', 'custom', '7'),
(200, 'SAd3sL3', 'custom', '7'),
(201, 'As<S3Ls', 'custom', '7'),
(202, '<<s13L1', 'custom', '7');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `generations`
--
ALTER TABLE `generations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `generations`
--
ALTER TABLE `generations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
