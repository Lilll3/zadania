-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 26 Paź 2023, 08:38
-- Wersja serwera: 10.4.25-MariaDB
-- Wersja PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `lil`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `aazadania`
--

CREATE TABLE `aazadania` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `as_user_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `descr` text NOT NULL,
  `c_date` datetime NOT NULL,
  `dl_date` date NOT NULL,
  `prior` enum('mało ważne','ważne','bardzo ważne') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `aazadania`
--

INSERT INTO `aazadania` (`id`, `user_id`, `as_user_id`, `title`, `descr`, `c_date`, `dl_date`, `prior`) VALUES
(8, 9, 8, 'Kanapki', 'Prosze zrobić kanapki dla całego zespołu', '2023-10-26 08:18:39', '2023-10-27', 'bardzo ważne'),
(9, 8, 9, 'Papier', 'Prosze kupić papier na ksero', '2023-10-26 08:20:08', '2023-11-05', 'ważne');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `aazadania`
--
ALTER TABLE `aazadania`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `aazadania`
--
ALTER TABLE `aazadania`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
