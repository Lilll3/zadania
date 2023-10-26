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
-- Struktura tabeli dla tabeli `aauser`
--

CREATE TABLE `aauser` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `salt` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `aauser`
--

INSERT INTO `aauser` (`id`, `name`, `pass`, `salt`) VALUES
(8, 'b', 'a374140ef69f85ea361926f5e8a36b3699b2f42bcb55173a9255e48f14362f91202674cfc3d158f358105b092e0d4e70', '85111'),
(9, 'a', '6d9c9ce6d61431efc70a163a671bcfe87c0b2bd8ba68ed2c1abb6f066b5646d5847454e319ea90e174abb35814ffc64b', '30790');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `aauser`
--
ALTER TABLE `aauser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `aauser`
--
ALTER TABLE `aauser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
