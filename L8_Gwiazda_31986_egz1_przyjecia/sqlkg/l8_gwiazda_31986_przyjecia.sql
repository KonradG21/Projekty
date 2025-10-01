-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Lip 06, 2024 at 03:41 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `l8_gwiazda_31986_przyjecia`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klientkg`
--
CREATE DATABASE l8_gwiazda_31986_przyjecia;
CREATE TABLE `klientkg` (
  `klient_idkg` int(11) NOT NULL,
  `klient_nazwakg` varchar(70) NOT NULL,
  `cena_talerza` double(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `klientkg`
--

INSERT INTO `klientkg` (`klient_idkg`, `klient_nazwakg`, `cena_talerza`) VALUES
(1, 'Konrad', 15.00),
(2, 'Mateusz', 17.00),
(3, 'Kacper', 22.00),
(4, 'Małgosia', 18.00),
(5, 'Dorota', 16.00),
(6, 'Konrad', 15.00),
(7, 'Mateusz', 17.00),
(8, 'Kacper', 22.00),
(9, 'Małgosia', 18.00),
(10, 'Dorota', 16.99),
(11, 'Adam', 15.00);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rezerwacje_klientakg`
--

CREATE TABLE `rezerwacje_klientakg` (
  `rezerwacja_idkg` int(11) NOT NULL,
  `klient_idkg` int(11) NOT NULL,
  `iloscosobkg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `rezerwacje_klientakg`
--

INSERT INTO `rezerwacje_klientakg` (`rezerwacja_idkg`, `klient_idkg`, `iloscosobkg`) VALUES
(1, 1, 20),
(2, 3, 15),
(3, 4, 25),
(4, 6, 10),
(5, 9, 15),
(6, 5, 17),
(7, 11, 60);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rodzaje_spotkankg`
--

CREATE TABLE `rodzaje_spotkankg` (
  `spotkanie_idkg` int(11) NOT NULL,
  `spotkanie_nazwakg` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `rodzaje_spotkankg`
--

INSERT INTO `rodzaje_spotkankg` (`spotkanie_idkg`, `spotkanie_nazwakg`) VALUES
(1, 'Wesele'),
(2, 'Urodziny'),
(3, 'Rocznice'),
(4, 'Bankiet'),
(5, 'Spotkanie z pracy');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rozliczenie`
--

CREATE TABLE `rozliczenie` (
  `rozliczenie_idkg` int(11) NOT NULL,
  `rezerwacja_idkg` int(11) NOT NULL,
  `sale_idkg` int(11) NOT NULL,
  `kosztcałykg` double(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `rozliczenie`
--

INSERT INTO `rozliczenie` (`rozliczenie_idkg`, `rezerwacja_idkg`, `sale_idkg`, `kosztcałykg`) VALUES
(1, 2, 4, 3800.00),
(2, 4, 1, 6000.00),
(3, 3, 4, 7900.00),
(4, 1, 4, 3990.00),
(10, 6, 4, 10000.00);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sale_kg`
--

CREATE TABLE `sale_kg` (
  `sale_idkg` int(11) NOT NULL,
  `spotkanie_idkg` int(11) NOT NULL,
  `nazwa_salikg` varchar(70) NOT NULL,
  `limit_osobkg` int(11) NOT NULL,
  `koszt_salikg` double(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `sale_kg`
--

INSERT INTO `sale_kg` (`sale_idkg`, `spotkanie_idkg`, `nazwa_salikg`, `limit_osobkg`, `koszt_salikg`) VALUES
(1, 4, 'Sala Bananów', 40, 350.00),
(2, 2, 'Sala Miłości', 50, 700.00),
(3, 3, 'Sala Piratów', 20, 450.00),
(4, 1, 'Sala Prezydentów', 15, 350.00),
(5, 5, 'Sala biurowa', 100, 12000.00);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `klientkg`
--
ALTER TABLE `klientkg`
  ADD PRIMARY KEY (`klient_idkg`);

--
-- Indeksy dla tabeli `rezerwacje_klientakg`
--
ALTER TABLE `rezerwacje_klientakg`
  ADD PRIMARY KEY (`rezerwacja_idkg`),
  ADD KEY `klient_idkg` (`klient_idkg`);

--
-- Indeksy dla tabeli `rodzaje_spotkankg`
--
ALTER TABLE `rodzaje_spotkankg`
  ADD PRIMARY KEY (`spotkanie_idkg`);

--
-- Indeksy dla tabeli `rozliczenie`
--
ALTER TABLE `rozliczenie`
  ADD PRIMARY KEY (`rozliczenie_idkg`),
  ADD KEY `sale_idkg` (`sale_idkg`),
  ADD KEY `rezerwacja_idkg` (`rezerwacja_idkg`);

--
-- Indeksy dla tabeli `sale_kg`
--
ALTER TABLE `sale_kg`
  ADD PRIMARY KEY (`sale_idkg`),
  ADD KEY `spotkanie_idkg` (`spotkanie_idkg`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `klientkg`
--
ALTER TABLE `klientkg`
  MODIFY `klient_idkg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rezerwacje_klientakg`
--
ALTER TABLE `rezerwacje_klientakg`
  MODIFY `rezerwacja_idkg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rodzaje_spotkankg`
--
ALTER TABLE `rodzaje_spotkankg`
  MODIFY `spotkanie_idkg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rozliczenie`
--
ALTER TABLE `rozliczenie`
  MODIFY `rozliczenie_idkg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sale_kg`
--
ALTER TABLE `sale_kg`
  MODIFY `sale_idkg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rezerwacje_klientakg`
--
ALTER TABLE `rezerwacje_klientakg`
  ADD CONSTRAINT `rezerwacje_klientakg_ibfk_1` FOREIGN KEY (`klient_idkg`) REFERENCES `klientkg` (`klient_idkg`);

--
-- Constraints for table `rozliczenie`
--
ALTER TABLE `rozliczenie`
  ADD CONSTRAINT `rozliczenie_ibfk_1` FOREIGN KEY (`sale_idkg`) REFERENCES `sale_kg` (`sale_idkg`),
  ADD CONSTRAINT `rozliczenie_ibfk_2` FOREIGN KEY (`sale_idkg`) REFERENCES `sale_kg` (`sale_idkg`),
  ADD CONSTRAINT `rozliczenie_ibfk_3` FOREIGN KEY (`rezerwacja_idkg`) REFERENCES `rezerwacje_klientakg` (`rezerwacja_idkg`);

--
-- Constraints for table `sale_kg`
--
ALTER TABLE `sale_kg`
  ADD CONSTRAINT `sale_kg_ibfk_1` FOREIGN KEY (`spotkanie_idkg`) REFERENCES `rodzaje_spotkankg` (`spotkanie_idkg`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
