SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bank`
--

-- --------------------------------------------------------

--
-- Структура таблицы `accounts`
--

CREATE TABLE `accounts` (
  `id_account` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_currency` int(11) NOT NULL,
  `balance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `accounts`
--

INSERT INTO `accounts` (`id_account`, `id_user`, `id_currency`, `balance`) VALUES
(5, 25, 3, 384.5),
(6, 25, 3, 123);

-- --------------------------------------------------------

--
-- Структура таблицы `cards`
--

CREATE TABLE `cards` (
  `id_card` int(11) NOT NULL,
  `number` varchar(20) NOT NULL,
  `cvc` varchar(3) NOT NULL,
  `id_account` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `cards`
--

INSERT INTO `cards` (`id_card`, `number`, `cvc`, `id_account`) VALUES
(11, '1234 1234 1234 1232', '999', 5),
(12, '1234 1234 1234 1233', '999', 6);

-- --------------------------------------------------------

--
-- Структура таблицы `currencies`
--

CREATE TABLE `currencies` (
  `id_currency` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `currencies`
--

INSERT INTO `currencies` (`id_currency`, `title`, `rate`) VALUES
(3, 'Доллар', 123.2);

-- --------------------------------------------------------

--
-- Структура таблицы `operations`
--

CREATE TABLE `operations` (
  `id_operation` int(11) NOT NULL,
  `delta` double NOT NULL,
  `date` date DEFAULT NULL,
  `id_account` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `operations`
--

INSERT INTO `operations` (`id_operation`, `delta`, `date`, `id_account`) VALUES
(11, 123, '2023-12-06', 5),
(12, 123, '2023-12-06', 5),
(13, 12, '2023-12-06', 5),
(14, 12, '2023-12-06', 5),
(15, 1244, '2023-12-06', 5),
(16, -12, '2023-12-06', 5),
(17, -12, '2023-12-06', 5),
(18, -122, '2023-12-06', 5),
(19, -122, '2023-12-06', 5),
(20, -122, '2023-12-06', 5),
(21, 122, '2023-12-06', 5),
(22, 12, '2023-12-06', 5),
(23, 12, '2023-12-06', 5),
(24, 12, '2023-12-06', 5),
(25, 120, '2023-12-06', 5),
(26, -120, '2023-12-06', 5),
(27, -120, '2023-12-06', 5),
(28, 12, '2023-12-06', 5),
(29, -12, '2023-12-06', 5),
(30, -12, '2023-12-06', 5),
(31, 120, '2023-12-06', 5),
(32, -120, '2023-12-06', 5),
(33, 120, '2023-12-06', 5),
(34, 120, '2023-12-06', 5),
(35, 120.1, '2023-12-06', 5),
(36, -1.5, '2023-12-06', 5),
(37, -1.5, '2023-12-06', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) NOT NULL,
  `role` int(4) NOT NULL DEFAULT 0,
  `phone` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `first_name`, `middle_name`, `last_name`, `role`, `phone`, `email`, `password`) VALUES
(25, 'Антое', 'Сергеевич', 'Лосев', 0, '1234567890', 'test@mail.ru', '$2y$12$pBHeuDFBLXYIpFyUbIhEhOlxYRq4D53/2wyV00fVU7ZlPz1klG/tm'),
(31, 'Антое12', 'Сергеевич', 'Лосев', 0, '1234567890', 'test@mail.ru', '$2y$12$4oHU3XkMIKrLtKuDKAQdku0BlhHfSW2Xy9soC/SnP/2uo9zlW9uDK'),
(32, 'Антое12', 'Сергеевич', 'Лосев', 0, '1234567892', 'user@mail.ru', '$2y$12$JXBlc2fQMAgsWGv2DcLF3OQnsexg9pOH8Pz9eS9ToH..rNLLIhStC'),
(33, 'Антое', 'Сергеевич', 'Лосев', 1, '1234567890', 'admin@mail.ru', '$2y$12$22nXpNVL7Qka0aB1do02SuNgrjmf6GIzANEGYLCr2VX8rPU1YqxH6');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id_account`),
  ADD KEY `accounts_ibfk_1` (`id_user`),
  ADD KEY `accounts_ibfk_2` (`id_currency`);

--
-- Индексы таблицы `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id_card`),
  ADD KEY `cards_ibfk_1` (`id_account`);

--
-- Индексы таблицы `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id_currency`);

--
-- Индексы таблицы `operations`
--
ALTER TABLE `operations`
  ADD PRIMARY KEY (`id_operation`),
  ADD KEY `operations_ibfk_1` (`id_account`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id_account` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `cards`
--
ALTER TABLE `cards`
  MODIFY `id_card` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id_currency` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `operations`
--
ALTER TABLE `operations`
  MODIFY `id_operation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `accounts_ibfk_2` FOREIGN KEY (`id_currency`) REFERENCES `currencies` (`id_currency`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `cards`
--
ALTER TABLE `cards`
  ADD CONSTRAINT `cards_ibfk_1` FOREIGN KEY (`id_account`) REFERENCES `accounts` (`id_account`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `operations`
--
ALTER TABLE `operations`
  ADD CONSTRAINT `operations_ibfk_1` FOREIGN KEY (`id_account`) REFERENCES `accounts` (`id_account`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
