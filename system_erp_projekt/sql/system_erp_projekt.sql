-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2025 at 09:06 AM
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
-- Database: `system_erp_projekt`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `adres_zamieszkania`
--

CREATE TABLE `adres_zamieszkania` (
  `id_adresu` int(11) NOT NULL,
  `id_pracownika` int(11) NOT NULL,
  `miejscowosc` varchar(100) NOT NULL,
  `ulica` varchar(100) NOT NULL,
  `numer_mieszkania` int(11) DEFAULT NULL,
  `kod_pocztowy` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dane_personalne_pracownika`
--

CREATE TABLE `dane_personalne_pracownika` (
  `id_pracownika` int(11) NOT NULL,
  `imie` varchar(50) NOT NULL,
  `nazwisko` varchar(50) NOT NULL,
  `pesel` char(11) NOT NULL,
  `telefon` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `dane_personalne_pracownika`
--

INSERT INTO `dane_personalne_pracownika` (`id_pracownika`, `imie`, `nazwisko`, `pesel`, `telefon`, `email`) VALUES
(1, 'Jan', 'Kowalski', '90010112345', '600123456', 'jan.kowalski@example.com'),
(2, 'Anna', 'Nowak', '85050554321', '601234567', 'anna.nowak@example.com'),
(3, 'Piotr', 'Wiśniewski', '78030367890', '602345678', 'piotr.wisniewski@example.com'),
(4, 'Magdalena', 'Dąbrowska', '72070798765', '603456789', 'magdalena.dabrowska@example.com');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dane_robocze_pracownika`
--

CREATE TABLE `dane_robocze_pracownika` (
  `id_danych_roboczych` int(11) NOT NULL,
  `id_pracownika` int(11) NOT NULL,
  `stanowisko` enum('admin','pracownik','kierownik','prezes','HR') DEFAULT NULL,
  `rodzaj_umowy` enum('umowa o pracę','umowa zlecenie','umowa o dzieło') NOT NULL,
  `data_podpisania_umowy` date DEFAULT NULL,
  `data_rozpoczęcia_umowy` date DEFAULT NULL,
  `data_zakonczenia_umowy` date NOT NULL,
  `dni_urlopowe` int(11) NOT NULL,
  `zwolnienia_lekarskie` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `dane_robocze_pracownika`
--

INSERT INTO `dane_robocze_pracownika` (`id_danych_roboczych`, `id_pracownika`, `stanowisko`, `rodzaj_umowy`, `data_podpisania_umowy`, `data_rozpoczęcia_umowy`, `data_zakonczenia_umowy`, `dni_urlopowe`, `zwolnienia_lekarskie`) VALUES
(1, 1, 'pracownik', 'umowa o pracę', NULL, NULL, '2026-12-31', 26, 2),
(2, 2, 'kierownik', 'umowa o pracę', NULL, NULL, '2025-12-31', 30, 0),
(3, 3, 'prezes', 'umowa o pracę', NULL, NULL, '2027-12-31', 35, 1),
(4, 4, 'admin', 'umowa o pracę', NULL, NULL, '2030-12-31', 40, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dni_urlopowe`
--

CREATE TABLE `dni_urlopowe` (
  `id` int(11) NOT NULL,
  `id_pracownika` int(11) NOT NULL,
  `data_od` date NOT NULL,
  `data_do` date NOT NULL,
  `dni_robocze` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `dni_urlopowe`
--

INSERT INTO `dni_urlopowe` (`id`, `id_pracownika`, `data_od`, `data_do`, `dni_robocze`) VALUES
(1, 1, '2025-04-08', '2025-04-10', NULL),
(2, 1, '2025-04-23', '2025-04-30', 5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `login_uzyt`
--

CREATE TABLE `login_uzyt` (
  `id_login` int(11) NOT NULL,
  `id_pracownika` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `haslo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `login_uzyt`
--

INSERT INTO `login_uzyt` (`id_login`, `id_pracownika`, `login`, `haslo`) VALUES
(1, 1, 'jkowalski', 'pracownik1'),
(2, 2, 'anowak', 'admin1'),
(3, 3, 'pwisniewski', 'kierownik1'),
(4, 4, 'mdabrowska', 'prezes1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `szkolenia`
--

CREATE TABLE `szkolenia` (
  `id_szkolenia` int(11) NOT NULL,
  `id_pracownika` int(11) NOT NULL,
  `nazwa_szkolenia` varchar(255) NOT NULL,
  `data_ukonczenia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wypłaty`
--

CREATE TABLE `wypłaty` (
  `id_wyplaty` int(11) NOT NULL,
  `id_pracownika` int(11) NOT NULL,
  `wyplata_netto` decimal(10,2) NOT NULL,
  `wyplata_brutto` decimal(10,2) NOT NULL,
  `data_transakcji` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `wypłaty`
--

INSERT INTO `wypłaty` (`id_wyplaty`, `id_pracownika`, `wyplata_netto`, `wyplata_brutto`, `data_transakcji`) VALUES
(1, 1, 4000.00, 5000.00, NULL),
(2, 2, 6000.00, 7500.00, NULL),
(3, 3, 9000.00, 11250.00, NULL),
(4, 4, 15000.00, 18750.00, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zwolnienia_lekarskie`
--

CREATE TABLE `zwolnienia_lekarskie` (
  `id_zwolnienia` int(11) NOT NULL,
  `id_pracownika` int(11) NOT NULL,
  `data_od` date NOT NULL,
  `data_do` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `adres_zamieszkania`
--
ALTER TABLE `adres_zamieszkania`
  ADD PRIMARY KEY (`id_adresu`),
  ADD KEY `id_pracownika` (`id_pracownika`);

--
-- Indeksy dla tabeli `dane_personalne_pracownika`
--
ALTER TABLE `dane_personalne_pracownika`
  ADD PRIMARY KEY (`id_pracownika`),
  ADD UNIQUE KEY `pesel` (`pesel`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeksy dla tabeli `dane_robocze_pracownika`
--
ALTER TABLE `dane_robocze_pracownika`
  ADD PRIMARY KEY (`id_danych_roboczych`),
  ADD KEY `id_pracownika` (`id_pracownika`);

--
-- Indeksy dla tabeli `dni_urlopowe`
--
ALTER TABLE `dni_urlopowe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pracownika` (`id_pracownika`);

--
-- Indeksy dla tabeli `login_uzyt`
--
ALTER TABLE `login_uzyt`
  ADD PRIMARY KEY (`id_login`),
  ADD UNIQUE KEY `login` (`login`),
  ADD KEY `id_pracownika` (`id_pracownika`);

--
-- Indeksy dla tabeli `szkolenia`
--
ALTER TABLE `szkolenia`
  ADD PRIMARY KEY (`id_szkolenia`),
  ADD KEY `id_pracownika` (`id_pracownika`);

--
-- Indeksy dla tabeli `wypłaty`
--
ALTER TABLE `wypłaty`
  ADD PRIMARY KEY (`id_wyplaty`),
  ADD KEY `id_pracownika` (`id_pracownika`);

--
-- Indeksy dla tabeli `zwolnienia_lekarskie`
--
ALTER TABLE `zwolnienia_lekarskie`
  ADD PRIMARY KEY (`id_zwolnienia`),
  ADD KEY `id_pracownika` (`id_pracownika`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adres_zamieszkania`
--
ALTER TABLE `adres_zamieszkania`
  MODIFY `id_adresu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dane_personalne_pracownika`
--
ALTER TABLE `dane_personalne_pracownika`
  MODIFY `id_pracownika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dane_robocze_pracownika`
--
ALTER TABLE `dane_robocze_pracownika`
  MODIFY `id_danych_roboczych` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dni_urlopowe`
--
ALTER TABLE `dni_urlopowe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login_uzyt`
--
ALTER TABLE `login_uzyt`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `szkolenia`
--
ALTER TABLE `szkolenia`
  MODIFY `id_szkolenia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wypłaty`
--
ALTER TABLE `wypłaty`
  MODIFY `id_wyplaty` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `zwolnienia_lekarskie`
--
ALTER TABLE `zwolnienia_lekarskie`
  MODIFY `id_zwolnienia` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adres_zamieszkania`
--
ALTER TABLE `adres_zamieszkania`
  ADD CONSTRAINT `adres_zamieszkania_ibfk_1` FOREIGN KEY (`id_pracownika`) REFERENCES `dane_personalne_pracownika` (`id_pracownika`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dane_robocze_pracownika`
--
ALTER TABLE `dane_robocze_pracownika`
  ADD CONSTRAINT `dane_robocze_pracownika_ibfk_1` FOREIGN KEY (`id_pracownika`) REFERENCES `dane_personalne_pracownika` (`id_pracownika`) ON DELETE CASCADE;

--
-- Constraints for table `dni_urlopowe`
--
ALTER TABLE `dni_urlopowe`
  ADD CONSTRAINT `dni_urlopowe_ibfk_1` FOREIGN KEY (`id_pracownika`) REFERENCES `dane_personalne_pracownika` (`id_pracownika`);

--
-- Constraints for table `login_uzyt`
--
ALTER TABLE `login_uzyt`
  ADD CONSTRAINT `login_uzyt_ibfk_1` FOREIGN KEY (`id_pracownika`) REFERENCES `dane_personalne_pracownika` (`id_pracownika`) ON DELETE CASCADE;

--
-- Constraints for table `szkolenia`
--
ALTER TABLE `szkolenia`
  ADD CONSTRAINT `szkolenia_ibfk_1` FOREIGN KEY (`id_pracownika`) REFERENCES `dane_personalne_pracownika` (`id_pracownika`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wypłaty`
--
ALTER TABLE `wypłaty`
  ADD CONSTRAINT `wypłaty_ibfk_1` FOREIGN KEY (`id_pracownika`) REFERENCES `dane_personalne_pracownika` (`id_pracownika`) ON DELETE CASCADE;

--
-- Constraints for table `zwolnienia_lekarskie`
--
ALTER TABLE `zwolnienia_lekarskie`
  ADD CONSTRAINT `zwolnienia_lekarskie_ibfk_1` FOREIGN KEY (`id_pracownika`) REFERENCES `dane_personalne_pracownika` (`id_pracownika`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
