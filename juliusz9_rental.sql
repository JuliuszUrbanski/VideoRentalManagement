-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: 192.168.101.60
-- Czas wygenerowania: 07 Cze 2018, 15:54
-- Wersja serwera: 5.6.36-82.1-log
-- Wersja PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `juliusz9_rental`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `movies`
--

CREATE TABLE IF NOT EXISTS `movies` (
  `id` int(100) NOT NULL,
  `filmname` mediumtext NOT NULL,
  `director` mediumtext NOT NULL,
  `genres` mediumtext NOT NULL,
  `country` mediumtext NOT NULL,
  `year` text NOT NULL,
  `runtime` mediumtext NOT NULL,
  `quantityactual` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` mediumtext NOT NULL,
  `datetime` mediumtext NOT NULL,
  `admin` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `movies`
--

INSERT INTO `movies` (`id`, `filmname`, `director`, `genres`, `country`, `year`, `runtime`, `quantityactual`, `quantity`, `description`, `datetime`, `admin`) VALUES
(1, 'It', 'Andy Muschietti', 'Drama, Horror, Thriller', 'USA | Canada', '2017', '135 min', 5, 10, 'A group of bullied kids band together when a shapeshifting demon, taking the appearance of a clown, begins hunting children.', 'October-14-2017 20:29:00', 'Monster9800'),
(2, 'Wonderstruck', 'Todd Haynes', 'Drama, Family, Mystery', 'USA', '2004', '117 min', 3, 5, 'The story of a young boy in the Midwest is told simultaneously with a tale about a young girl in New York from fifty years ago as they both seek the same mysterious connection.', 'October-14-2017 20:30:41', 'Monster9800'),
(3, 'Kill Bill', 'Quentin Tarantino', 'Action, Crime, Thriller ', 'USA', '2017', '111 min', 5, 5, '', 'October-15-2017 12:22:04', 'Monster9800');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `registration`
--

CREATE TABLE IF NOT EXISTS `registration` (
  `id` int(11) NOT NULL,
  `datetime` mediumtext NOT NULL,
  `username` mediumtext NOT NULL,
  `password` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `registration`
--

INSERT INTO `registration` (`id`, `datetime`, `username`, `password`) VALUES
(1, '', 'Monster9800', 'Haslo'),
(2, '', 'admin', 'admin'),
(3, '', 'guest', 'guest');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rent`
--

CREATE TABLE IF NOT EXISTS `rent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_movie` int(11) NOT NULL,
  `datetime` date NOT NULL,
  `rdatetime` text COLLATE utf8_polish_ci NOT NULL,
  `admin` text COLLATE utf8_polish_ci NOT NULL,
  `radmin` text COLLATE utf8_polish_ci NOT NULL,
  `return` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_movie` (`id_movie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=24 ;

--
-- Zrzut danych tabeli `rent`
--

INSERT INTO `rent` (`id`, `id_user`, `id_movie`, `datetime`, `rdatetime`, `admin`, `radmin`, `return`) VALUES
(11, 5, 1, '2018-02-18', '2018-02-18', 'Monster9800', 'Monster9800', 1),
(12, 4, 3, '2018-02-18', '2018-02-18', 'Monster9800', 'admin', 1),
(13, 5, 1, '2018-02-21', '', 'Monster9800', '', 0),
(14, 5, 3, '2018-02-21', '2018-02-21', 'Monster9800', 'admin', 1),
(15, 5, 1, '2018-02-24', '', 'Monster9800', '', 0),
(16, 4, 1, '2018-03-06', '2018-03-31', 'admin', 'Monster9800', 1),
(17, 5, 2, '2018-03-06', '2018-03-06', 'admin', 'admin', 1),
(23, 4, 2, '2018-06-07', '', 'guest', '', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` mediumtext NOT NULL,
  `address` mediumtext NOT NULL,
  `country` mediumtext NOT NULL,
  `mobile` mediumtext NOT NULL,
  `email` mediumtext NOT NULL,
  `admin` mediumtext NOT NULL,
  `datetime` mediumtext NOT NULL,
  `sex` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `fullname`, `address`, `country`, `mobile`, `email`, `admin`, `datetime`, `sex`) VALUES
(4, 'Dorothy Mattox', '1335 Juniper Drive, Saginaw', 'USA', '989-920-7341', 'DorothyMattox@teleworm.us', 'Monster9800', '02-November-2017', 'Male'),
(5, 'Janet Diaz', '2431 Bolman Court, Champaign', 'USA', '217-304-8140', 'JanetCDiaz@jourrapide.com', 'Monster9800', '09-November-2017', 'Male'),
(6, 'mdas', 'asdas', 'dasdas', '4234523523', 'dsada@das.cs', 'Monster9800', '04-December-2017', 'Female'),
(7, 'Juliusz UrbaĹski', 'adres, 2', 'Polska', '123123123', 'juliuszurbanski18@gmail.com', 'admin', '26-May-2018', 'Male');

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `rent`
--
ALTER TABLE `rent`
  ADD CONSTRAINT `rent_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `rent_ibfk_2` FOREIGN KEY (`id_movie`) REFERENCES `movies` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
