-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Дек 09 2019 г., 11:37
-- Версия сервера: 5.5.40-0+wheezy1-log
-- Версия PHP: 5.6.40-1~dotdeb+7.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ratings`
--

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `name`) VALUES
(1, 'UP-1'),
(2, 'GH-3');

-- --------------------------------------------------------

--
-- Структура таблицы `marks`
--

CREATE TABLE `marks` (
  `id` int(11) NOT NULL,
  `id_subject` int(11) DEFAULT NULL,
  `id_student` int(11) DEFAULT NULL,
  `mark` int(11) DEFAULT NULL,
  `create_worker` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_worker` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `marks`
--

INSERT INTO `marks` (`id`, `id_subject`, `id_student`, `mark`, `create_worker`, `create_time`, `update_worker`, `update_time`) VALUES
(1, 1, 1, 5, 2, NULL, NULL, NULL),
(2, 2, 1, 3, 2, NULL, NULL, NULL),
(3, 3, 1, 4, 2, NULL, NULL, NULL),
(4, 1, 1, 4, 2, NULL, NULL, NULL),
(5, 1, 1, 5, 2, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `students_in_group`
--

CREATE TABLE `students_in_group` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_group` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `students_in_group`
--

INSERT INTO `students_in_group` (`id`, `id_user`, `id_group`) VALUES
(1, 1, 1),
(2, 3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name_sub` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `subjects`
--

INSERT INTO `subjects` (`id`, `name_sub`) VALUES
(1, 'Русский'),
(2, 'Английский'),
(3, 'Математика');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `patronymic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `surname`, `name`, `patronymic`, `access`, `active`) VALUES
(1, '123456', '123', 'Test', 'Bro', 'My', 'student', 1),
(2, '4321', '123', 'Teacher', 'First', 'Test', 'worker', 1),
(3, '654321', '123', 'Second', 'Student', 'Test', 'student', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_subject` (`id_subject`),
  ADD KEY `id_student` (`id_student`),
  ADD KEY `create_worker` (`create_worker`),
  ADD KEY `update_worker` (`update_worker`);

--
-- Индексы таблицы `students_in_group`
--
ALTER TABLE `students_in_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `marks`
--
ALTER TABLE `marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `students_in_group`
--
ALTER TABLE `students_in_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `marks`
--
ALTER TABLE `marks`
  ADD CONSTRAINT `marks_ibfk_4` FOREIGN KEY (`update_worker`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `marks_ibfk_1` FOREIGN KEY (`id_subject`) REFERENCES `subjects` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `marks_ibfk_2` FOREIGN KEY (`id_student`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `marks_ibfk_3` FOREIGN KEY (`create_worker`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `students_in_group`
--
ALTER TABLE `students_in_group`
  ADD CONSTRAINT `students_in_group_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
