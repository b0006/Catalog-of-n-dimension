-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Окт 16 2017 г., 16:50
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `my_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `element`
--

CREATE TABLE IF NOT EXISTS `element` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_section` int(10) NOT NULL,
  `Title_element` varchar(255) NOT NULL,
  `Create_date` date NOT NULL,
  `Modify_date` date NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Дамп данных таблицы `element`
--

INSERT INTO `element` (`ID`, `ID_section`, `Title_element`, `Create_date`, `Modify_date`, `Type`, `Description`) VALUES
(1, 137, 'SmartBuy', '2017-10-16', '2017-10-16', 'SmartBuy', 'SmartBuy'),
(2, 137, 'Sven', '2017-10-16', '2017-10-16', 'Удмурт', 'Sven'),
(3, 137, 'DNS', '2017-10-16', '2017-10-16', 'DNS', 'DNS'),
(4, 167, 'FX8350', '2017-10-16', '2017-10-16', 'FX8350', 'FX8350'),
(5, 167, 'FX4350', '2017-10-16', '2017-10-16', 'FX4350', 'FX4350'),
(6, 166, 'Байкал', '2017-10-16', '2017-10-16', 'Байкал', 'Байкал'),
(15, 137, 'SmartBuy', '2017-10-16', '2017-10-16', 'SmartBuy', 'SmartBuy'),
(17, 137, 'Sven', '2017-10-16', '2017-10-16', 'Удмурт', 'Sven'),
(19, 137, 'DNS', '2017-10-16', '2017-10-16', 'DNS', 'DNS'),
(20, 167, 'FX8350', '2017-10-16', '2017-10-16', 'FX8350', 'FX8350'),
(21, 167, 'FX4350', '2017-10-16', '2017-10-16', 'FX4350', 'FX4350'),
(22, 166, 'Байкал', '2017-10-16', '2017-10-16', 'Байкал', 'Байкал');

-- --------------------------------------------------------

--
-- Структура таблицы `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) NOT NULL,
  `Create_date` date NOT NULL,
  `Modify_date` date NOT NULL,
  `Description` text NOT NULL,
  `PID` int(10) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=170 ;

--
-- Дамп данных таблицы `section`
--

INSERT INTO `section` (`ID`, `Title`, `Create_date`, `Modify_date`, `Description`, `PID`) VALUES
(135, 'Аудиотехника', '2017-10-16', '2017-10-16', 'Аудиотехника', -1),
(137, 'Колонки', '2017-10-16', '2017-10-16', 'Колонки', 135),
(149, 'Компьютеры', '2017-10-16', '2017-10-16', 'Компьютеры', -1),
(162, 'Сканеры', '2017-10-16', '2017-10-16', 'Сканеры', 164),
(163, 'Автотовары', '2017-10-16', '2017-10-16', 'Автотовары', -1),
(164, 'Оргтехника', '2017-10-16', '2017-10-16', 'Оргтехника', -1),
(165, 'Комплектующие', '2017-10-16', '2017-10-16', 'Комплектующие', 149),
(166, 'Процессоры', '2017-10-16', '2017-10-16', 'Процессоры', 165),
(167, 'AMD', '2017-10-16', '2017-10-16', 'AMD', 166),
(168, 'Intel', '2017-10-16', '2017-10-16', 'Intel', 166),
(169, 'Принтеры', '2017-10-16', '2017-10-16', 'Принтеры', 164);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
