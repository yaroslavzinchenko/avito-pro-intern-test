-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 29 2019 г., 13:58
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
(258, '87586', 'number', '5'),
(259, '-47510', 'number', '5'),
(260, '77498', 'number', '5'),
(261, 'b4eee1', 'alphanumeric', '3'),
(262, 'c501ed', 'alphanumeric', '3'),
(263, '5c3c0b', 'alphanumeric', '3'),
(264, '{2CCF7432-A085-D24F-0B37-D55E91E4564F}', 'guid', '32'),
(265, '{DAE6FA06-2E79-5A5B-487A-420B556EEA87}', 'guid', '32'),
(266, '{65564046-7942-7746-CB2A-F6CBBFF56763}', 'guid', '32'),
(267, 'KRTJEwEDEb', 'string', '10'),
(268, 'eyuYPJgSti', 'string', '10'),
(269, 'xTBgWhnstL', 'string', '10'),
(270, '3ssdss3', 'custom', '7'),
(271, 'ssJJ<ss', 'custom', '7'),
(272, 'dJ8899L', 'custom', '7');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
