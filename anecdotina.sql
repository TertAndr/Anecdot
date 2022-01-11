-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Дек 22 2021 г., 10:52
-- Версия сервера: 5.7.25
-- Версия PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `anecdotina`
--

-- --------------------------------------------------------

--
-- Структура таблицы `anecdots`
--

CREATE TABLE `anecdots` (
  `id_anecdot` int(11) NOT NULL,
  `anecdot_date` date NOT NULL,
  `anecdot_user` int(11) NOT NULL,
  `anecdot` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `akceptet` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `anecdots`
--

INSERT INTO `anecdots` (`id_anecdot`, `anecdot_date`, `anecdot_user`, `anecdot`, `akceptet`) VALUES
(1, '2021-09-17', 1, 'Надел мужик шляпу, а она ему как раз', 1),
(2, '2021-12-21', 1, 'Идет медведь по лесу,видит машина горит,сел в нее и сгорел', 1),
(9, '2021-12-06', 1, 'Надел мужик шляпу, а она ему как раз два три', 1),
(24, '2021-12-22', 1, 'Одесса. Привоз. Колбасный ряд.\r\n— Мужчина! Шо вы ото целый час ходите, пробуете и ничего не берёте?! Вам шо, таки ничего не нравится?\r\n— Нравится!\r\n— Шо, денег нет?!\r\n— Есть!\r\n— Ну так покупайте!\r\n— Зачем?\r\n— Шобы кушать!\r\n— А я шо делаю?', 1),
(25, '2021-12-22', 1, 'Звонок в морг:\r\n— Дедушка уже три дня не ночует дома. Вы не могли бы проверить, может, он у вас?\r\n— Опишите особые приметы.\r\n— Он картавит.', 1),
(26, '2021-12-22', 1, '— Почему у бегемотов круглые ступни?\r\n— Чтобы легче было перепрыгивать с кувшинки на кувшинку!', 1),
(27, '2021-12-22', 1, 'Решил математик отдохнуть на Кубе. Промахнулся и сел на конус.', 1),
(28, '2021-12-22', 1, 'Почему носорог отлично танцует? Ходил на ринопластику.', 1),
(29, '2021-12-22', 1, 'Как называется поединок двух каннибалов?\r\n.\r\n.\r\n.\r\n.\r\n.\r\n.\r\n.\r\n.\r\n.\r\n.\r\n.\r\nпоединок', 1),
(30, '2021-12-22', 1, 'Приходит ежиха к наркологу, и говорит \"Доктор помогите!! Мой муж колется☻\"', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `anecdots_tags`
--

CREATE TABLE `anecdots_tags` (
  `id_anecdots_tags` int(11) NOT NULL,
  `id_anecdot` int(11) NOT NULL,
  `id_tag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `anecdots_tags`
--

INSERT INTO `anecdots_tags` (`id_anecdots_tags`, `id_anecdot`, `id_tag`) VALUES
(53, 1, 3),
(58, 2, 3),
(59, 2, 5),
(60, 9, 3),
(61, 9, 5),
(62, 24, 3),
(63, 25, 5),
(65, 26, 5),
(66, 26, 12),
(67, 27, 5),
(68, 28, 5),
(69, 28, 12),
(70, 29, 5),
(71, 30, 5),
(72, 30, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL,
  `role_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id_role`, `role_name`) VALUES
(1, 'СУПЕРУЛЬТРАМЕГААДМИН'),
(2, 'Админ'),
(3, 'Пользователь');

-- --------------------------------------------------------

--
-- Структура таблицы `tags`
--

CREATE TABLE `tags` (
  `id_tag` int(11) NOT NULL,
  `tag` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tags`
--

INSERT INTO `tags` (`id_tag`, `tag`) VALUES
(1, 'Все'),
(2, 'Родственники'),
(3, 'Классические'),
(4, 'Про Чапаева'),
(5, '/b'),
(6, 'Про Завод'),
(7, 'Про врачей'),
(8, 'Про тещу'),
(9, 'Про работу'),
(10, 'Про дачу'),
(11, 'Про машину'),
(12, 'Про животных');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `user` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `user`, `password`, `id_role`) VALUES
(1, 'user1', '1', 3),
(2, 'admin2', '2', 2),
(4, 'user3', '3', 3);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `anecdots`
--
ALTER TABLE `anecdots`
  ADD PRIMARY KEY (`id_anecdot`),
  ADD KEY `anecdot_user` (`anecdot_user`);

--
-- Индексы таблицы `anecdots_tags`
--
ALTER TABLE `anecdots_tags`
  ADD PRIMARY KEY (`id_anecdots_tags`),
  ADD KEY `id_anecdot` (`id_anecdot`),
  ADD KEY `id_tag` (`id_tag`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Индексы таблицы `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id_tag`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `anecdots`
--
ALTER TABLE `anecdots`
  MODIFY `id_anecdot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `anecdots_tags`
--
ALTER TABLE `anecdots_tags`
  MODIFY `id_anecdots_tags` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `tags`
--
ALTER TABLE `tags`
  MODIFY `id_tag` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `anecdots`
--
ALTER TABLE `anecdots`
  ADD CONSTRAINT `anecdots_ibfk_1` FOREIGN KEY (`anecdot_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `anecdots_tags`
--
ALTER TABLE `anecdots_tags`
  ADD CONSTRAINT `anecdots_tags_ibfk_1` FOREIGN KEY (`id_anecdot`) REFERENCES `anecdots` (`id_anecdot`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `anecdots_tags_ibfk_2` FOREIGN KEY (`id_tag`) REFERENCES `tags` (`id_tag`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
