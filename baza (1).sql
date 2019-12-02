-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 25 2018 г., 16:33
-- Версия сервера: 10.1.36-MariaDB
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `baza`
--

-- --------------------------------------------------------

--
-- Структура таблицы `appointeddiagnosis`
--

CREATE TABLE `appointeddiagnosis` (
  `Id` int(11) NOT NULL,
  `Id_admission` int(11) NOT NULL,
  `Id_diagnosis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `appointeddiagnosis`
--

INSERT INTO `appointeddiagnosis` (`Id`, `Id_admission`, `Id_diagnosis`) VALUES
(31, 20, 15),
(32, 21, 15);

-- --------------------------------------------------------

--
-- Структура таблицы `appointment`
--

CREATE TABLE `appointment` (
  `Id` int(11) NOT NULL,
  `Id_customers` int(11) NOT NULL,
  `Id_referral` int(11) NOT NULL,
  `Data` date NOT NULL,
  `Tim` time NOT NULL,
  `Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `appointment`
--

INSERT INTO `appointment` (`Id`, `Id_customers`, `Id_referral`, `Data`, `Tim`, `Status`) VALUES
(18, 40, 4, '2222-03-12', '17:00:00', 0),
(19, 40, 3, '1112-11-11', '16:00:00', 0),
(20, 40, 4, '0111-12-25', '15:00:00', 1),
(21, 42, 4, '2222-12-12', '16:00:00', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `assignedservices`
--

CREATE TABLE `assignedservices` (
  `Id` int(11) NOT NULL,
  `Id_admission` int(11) NOT NULL,
  `Id_services` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `assignedservices`
--

INSERT INTO `assignedservices` (`Id`, `Id_admission`, `Id_services`) VALUES
(7, 18, 2),
(8, 21, 2),
(9, 20, 2),
(10, 20, 2),
(11, 21, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `customers`
--

CREATE TABLE `customers` (
  `Id` int(11) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `Date_birth` text NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Phone` varchar(25) NOT NULL,
  `Discount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `customers`
--

INSERT INTO `customers` (`Id`, `FullName`, `Date_birth`, `Address`, `Phone`, `Discount`) VALUES
(40, 'Никита Андреевич Болбатун', '2222-02-12', '', '89033373123', 5),
(42, 'Андрей', '2222-03-12', '', '89033373123', 25);

-- --------------------------------------------------------

--
-- Структура таблицы `diagnosis`
--

CREATE TABLE `diagnosis` (
  `Id` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `diagnosis`
--

INSERT INTO `diagnosis` (`Id`, `Title`, `Description`) VALUES
(15, 'Чума', 'Смертельная болезнь'),
(16, 'Грипп', 'Сезонная болезнь'),
(22, 'ОРЗ', 'Сезонная болезнь');

-- --------------------------------------------------------

--
-- Структура таблицы `doctors`
--

CREATE TABLE `doctors` (
  `Id` int(11) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `Position` varchar(255) NOT NULL,
  `Experience` int(100) NOT NULL,
  `Id_useraccount` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `doctors`
--

INSERT INTO `doctors` (`Id`, `FullName`, `Position`, `Experience`, `Id_useraccount`) VALUES
(4, '123123', 'Хирург', 0, '38'),
(5, '123123', 'Груммер', 0, '41');

-- --------------------------------------------------------

--
-- Структура таблицы `medicines`
--

CREATE TABLE `medicines` (
  `Id` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Dosage` varchar(255) NOT NULL,
  `CourseDuration` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `medicines`
--

INSERT INTO `medicines` (`Id`, `Title`, `Dosage`, `CourseDuration`) VALUES
(9, 'Мизин', '1', '7'),
(10, 'ЛСП', '5', '12');

-- --------------------------------------------------------

--
-- Структура таблицы `patientadmission`
--

CREATE TABLE `patientadmission` (
  `Id` int(11) NOT NULL,
  `Id_customers` int(11) NOT NULL,
  `Id_patients` int(11) NOT NULL,
  `Id_doctors` int(11) NOT NULL,
  `Id_referral` int(11) NOT NULL,
  `Data` date NOT NULL,
  `Time` time NOT NULL,
  `Complaints` text NOT NULL,
  `TotalPrice` int(11) NOT NULL,
  `Status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `patientadmission`
--

INSERT INTO `patientadmission` (`Id`, `Id_customers`, `Id_patients`, `Id_doctors`, `Id_referral`, `Data`, `Time`, `Complaints`, `TotalPrice`, `Status`) VALUES
(34, 42, 6, 5, 4, '2222-12-12', '16:00:00', '', 1231, '1'),
(35, 40, 5, 5, 4, '0111-12-25', '15:00:00', '', 1231, '1'),
(36, 40, 5, 5, 4, '0111-12-25', '15:00:00', '', 1231, '1'),
(37, 42, 6, 5, 4, '2222-12-12', '16:00:00', '', 1231, '1');

-- --------------------------------------------------------

--
-- Структура таблицы `patients`
--

CREATE TABLE `patients` (
  `Id` int(11) NOT NULL,
  `Id_customers` int(11) NOT NULL,
  `Type` varchar(100) NOT NULL,
  `Kind` varchar(100) NOT NULL,
  `YearBirth` int(4) NOT NULL,
  `Nickname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `patients`
--

INSERT INTO `patients` (`Id`, `Id_customers`, `Type`, `Kind`, `YearBirth`, `Nickname`) VALUES
(5, 40, 'Енот', '', 1998, 'Енот'),
(6, 42, 'Енот', '', 1222, 'Гажя');

-- --------------------------------------------------------

--
-- Структура таблицы `prescriptionmedicines`
--

CREATE TABLE `prescriptionmedicines` (
  `Id` int(11) NOT NULL,
  `Id_admission` int(11) NOT NULL,
  `Id_medicines` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `prescriptionmedicines`
--

INSERT INTO `prescriptionmedicines` (`Id`, `Id_admission`, `Id_medicines`) VALUES
(6, 20, 9),
(7, 21, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `referral`
--

CREATE TABLE `referral` (
  `Id` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `referral`
--

INSERT INTO `referral` (`Id`, `Title`) VALUES
(3, 'Хирург'),
(4, 'Груммер');

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `Id` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`Id`, `Title`) VALUES
(0, 'Клиент'),
(2, 'Доктор'),
(3, 'Администратор');

-- --------------------------------------------------------

--
-- Структура таблицы `roleaccount`
--

CREATE TABLE `roleaccount` (
  `Id` int(11) NOT NULL,
  `Id_role` int(11) NOT NULL,
  `Id_user_account` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `roleaccount`
--

INSERT INTO `roleaccount` (`Id`, `Id_role`, `Id_user_account`) VALUES
(7, 3, 24),
(10, 0, 27),
(20, 2, 38),
(21, 0, 39),
(22, 0, 40),
(23, 2, 41),
(24, 0, 42),
(25, 0, 43);

-- --------------------------------------------------------

--
-- Структура таблицы `service`
--

CREATE TABLE `service` (
  `Id` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `service`
--

INSERT INTO `service` (`Id`, `Title`, `Cost`) VALUES
(1, 'Хирург', 10),
(2, 'Груммер', 1231);

-- --------------------------------------------------------

--
-- Структура таблицы `useraccount`
--

CREATE TABLE `useraccount` (
  `Id` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` char(32) NOT NULL,
  `username` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `useraccount`
--

INSERT INTO `useraccount` (`Id`, `email`, `password`, `username`) VALUES
(24, 'admin', '4297f44b13955235245b2497399d7a93', 'Болбатун Никита Андреевич'),
(27, 'Cnfhxf100@mail.ru', 'c8837b23ff8aaa8a2dde915473ce0991', 'Енот'),
(38, 'Doctor123@mail.ru', 'c5c3f201a8e8fc634d37a766a0299218', '123123'),
(39, 'cnfhxf100198@mail.ru', '4297f44b13955235245b2497399d7a93', 'Никита'),
(40, 'Nikita@mail.ru', '4297f44b13955235245b2497399d7a93', 'Никита'),
(41, 'Cnfhxf1010@mail.ru', '4297f44b13955235245b2497399d7a93', '123123'),
(42, 'c123@mail.ru', '4297f44b13955235245b2497399d7a93', '123123'),
(43, 'c1323@mail.ru', '4297f44b13955235245b2497399d7a93', '123123');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `appointeddiagnosis`
--
ALTER TABLE `appointeddiagnosis`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_admission` (`Id_admission`),
  ADD KEY `Id_diagnosis` (`Id_diagnosis`);

--
-- Индексы таблицы `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_customers` (`Id_customers`),
  ADD KEY `Id_referral` (`Id_referral`);

--
-- Индексы таблицы `assignedservices`
--
ALTER TABLE `assignedservices`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_admission` (`Id_admission`),
  ADD KEY `Id_services` (`Id_services`);

--
-- Индексы таблицы `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `diagnosis`
--
ALTER TABLE `diagnosis`
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `patientadmission`
--
ALTER TABLE `patientadmission`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_customers` (`Id_customers`),
  ADD KEY `Id_patients` (`Id_patients`),
  ADD KEY `Id_doctors` (`Id_doctors`),
  ADD KEY `Id_referral` (`Id_referral`);

--
-- Индексы таблицы `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_customers` (`Id_customers`);

--
-- Индексы таблицы `prescriptionmedicines`
--
ALTER TABLE `prescriptionmedicines`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_admission` (`Id_admission`),
  ADD KEY `Id_medicines` (`Id_medicines`);

--
-- Индексы таблицы `referral`
--
ALTER TABLE `referral`
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `roleaccount`
--
ALTER TABLE `roleaccount`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_role` (`Id_role`),
  ADD KEY `Id_user_account` (`Id_user_account`);

--
-- Индексы таблицы `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `useraccount`
--
ALTER TABLE `useraccount`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `appointeddiagnosis`
--
ALTER TABLE `appointeddiagnosis`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT для таблицы `appointment`
--
ALTER TABLE `appointment`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `assignedservices`
--
ALTER TABLE `assignedservices`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `customers`
--
ALTER TABLE `customers`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT для таблицы `diagnosis`
--
ALTER TABLE `diagnosis`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `doctors`
--
ALTER TABLE `doctors`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `medicines`
--
ALTER TABLE `medicines`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `patientadmission`
--
ALTER TABLE `patientadmission`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT для таблицы `patients`
--
ALTER TABLE `patients`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `prescriptionmedicines`
--
ALTER TABLE `prescriptionmedicines`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `referral`
--
ALTER TABLE `referral`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `roleaccount`
--
ALTER TABLE `roleaccount`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `service`
--
ALTER TABLE `service`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `useraccount`
--
ALTER TABLE `useraccount`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `patientadmission`
--
ALTER TABLE `patientadmission`
  ADD CONSTRAINT `patientadmission_ibfk_1` FOREIGN KEY (`Id_customers`) REFERENCES `customers` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patientadmission_ibfk_2` FOREIGN KEY (`Id_patients`) REFERENCES `patients` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patientadmission_ibfk_5` FOREIGN KEY (`Id_doctors`) REFERENCES `doctors` (`Id`);

--
-- Ограничения внешнего ключа таблицы `roleaccount`
--
ALTER TABLE `roleaccount`
  ADD CONSTRAINT `roleaccount_ibfk_1` FOREIGN KEY (`Id_role`) REFERENCES `role` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
