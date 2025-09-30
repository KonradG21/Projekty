-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Maj 05, 2025 at 07:09 PM
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
  `numer_mieszkania` varchar(11) DEFAULT NULL,
  `kod_pocztowy` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `adres_zamieszkania`
--

INSERT INTO `adres_zamieszkania` (`id_adresu`, `id_pracownika`, `miejscowosc`, `ulica`, `numer_mieszkania`, `kod_pocztowy`) VALUES
(1, 1, 'Warszawa', 'Białorzeska', '49', '00-001'),
(2, 2, 'Warszawa', 'Stefana Banacha', '70', '00-001'),
(3, 3, 'Warszawa', 'Dąbrowa', '4', '00-001'),
(4, 4, 'Warszawa', 'Brzoskwiniowa', '2', '00-001'),
(5, 5, 'Kadzidło', 'Akacjowa', '2/1', '07-420');

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
  `email` varchar(100) NOT NULL,
  `login` varchar(50) DEFAULT NULL,
  `haslo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `dane_personalne_pracownika`
--

INSERT INTO `dane_personalne_pracownika` (`id_pracownika`, `imie`, `nazwisko`, `pesel`, `telefon`, `email`, `login`, `haslo`) VALUES
(1, 'Jan', 'Kowalski', '90010112345', '600123456', 'jan.kowalski@example.com', 'jkowalski1', 'a03d603193c93860b74fb3839bc62716'),
(2, 'Anna', 'Nowak', '85050554321', '601234567', 'anna.nowak@example.com', 'anowak2', '4a8e415057b6a07fcc83399d82527802'),
(3, 'Piotr', 'Wiśniewski', '78030367890', '602345678', 'piotr.wisniewski@example.com', 'pwisniewski', '34c26b7db24bce1e052e5ce9a15579e8'),
(4, 'Magdalena', 'Dąbrowska', '72070798765', '603456789', 'magdalena.dabrowska@example.com', 'mdabrowska', '1cf4efdbbcec689831e5c6653077e1e0'),
(5, 'Konrad', 'Gwiazda', '02271903330', '501334993', 'konradgwiazda@example.com', 'konrad1', 'cc16f6c0a2d54fc3f7475764376926d5');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dane_robocze_pracownika`
--

CREATE TABLE `dane_robocze_pracownika` (
  `id_danych_roboczych` int(11) NOT NULL,
  `id_pracownika` int(11) NOT NULL,
  `stanowisko` enum('pracownik','kierownik','prezes','HR') DEFAULT NULL,
  `rodzaj_umowy` enum('umowa o pracę','umowa zlecenie','umowa o dzieło') NOT NULL,
  `data_podpisania_umowy` date DEFAULT NULL,
  `data_rozpoczecia_umowy` date DEFAULT NULL,
  `data_zakonczenia_umowy` date NOT NULL,
  `dni_urlopowe` int(11) NOT NULL,
  `pozostaly_urlop` int(11) NOT NULL,
  `zwolnienia_lekarskie` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `dane_robocze_pracownika`
--

INSERT INTO `dane_robocze_pracownika` (`id_danych_roboczych`, `id_pracownika`, `stanowisko`, `rodzaj_umowy`, `data_podpisania_umowy`, `data_rozpoczecia_umowy`, `data_zakonczenia_umowy`, `dni_urlopowe`, `pozostaly_urlop`, `zwolnienia_lekarskie`) VALUES
(1, 1, 'pracownik', 'umowa o pracę', NULL, NULL, '2026-12-31', 26, 26, 2),
(2, 2, 'kierownik', 'umowa o pracę', NULL, NULL, '2025-12-31', 30, 30, 0),
(3, 3, 'prezes', 'umowa o pracę', NULL, NULL, '2027-12-31', 35, 31, 1),
(4, 4, 'HR', 'umowa o pracę', NULL, NULL, '2030-12-31', 40, 30, 0),
(5, 5, 'pracownik', 'umowa o dzieło', '2025-05-01', '2025-05-05', '2025-05-26', 1, 1, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dni_urlopowe`
--

CREATE TABLE `dni_urlopowe` (
  `id` int(11) NOT NULL,
  `id_pracownika` int(11) NOT NULL,
  `data_od` date NOT NULL,
  `data_do` date NOT NULL,
  `dni_robocze` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `dni_urlopowe`
--

INSERT INTO `dni_urlopowe` (`id`, `id_pracownika`, `data_od`, `data_do`, `dni_robocze`) VALUES
(1, 1, '2025-04-08', '2025-04-10', 3),
(2, 1, '2025-04-23', '2025-04-30', 5),
(4, 2, '2025-05-12', '2025-05-15', 4),
(10, 3, '2025-05-07', '2025-05-09', 3),
(12, 3, '2025-05-20', '2025-05-23', 4),
(13, 4, '2025-05-12', '2025-05-23', 10);

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

--
-- Dumping data for table `szkolenia`
--

INSERT INTO `szkolenia` (`id_szkolenia`, `id_pracownika`, `nazwa_szkolenia`, `data_ukonczenia`) VALUES
(1, 4, 'Szkolenie BHP', '2024-01-18'),
(2, 3, 'Szkolenie BHP', '2024-01-15'),
(3, 2, 'Szkolenie BHP', '2024-01-15'),
(5, 4, 'Szkolenie PPOŻ', '2024-02-20'),
(6, 3, 'Szkolenie PPOŻ', '2024-02-20'),
(7, 2, 'Szkolenie PPOŻ', '2024-02-20'),
(16, 1, 'Wózki widłowe UDT', '2022-04-13'),
(17, 1, 'Szkolenie BHP', '2024-03-13'),
(18, 1, 'Szkolenie PPOŻ', '2025-05-01');

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
(1, 1, 4000.00, 5000.00, '2025-05-09'),
(2, 2, 6000.00, 7500.00, '2025-05-09'),
(3, 4, 9000.00, 11250.00, '2025-05-09'),
(4, 3, 15000.00, 18750.00, '2025-05-09'),
(5, 1, 4000.00, 5000.00, '2025-04-10'),
(6, 2, 6100.00, 7530.00, '2025-04-10'),
(7, 4, 9000.00, 11250.00, '2025-04-10'),
(8, 3, 15000.00, 18750.00, '2025-04-10');

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
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `login` (`login`);

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
  MODIFY `id_adresu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `dane_personalne_pracownika`
--
ALTER TABLE `dane_personalne_pracownika`
  MODIFY `id_pracownika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `dane_robocze_pracownika`
--
ALTER TABLE `dane_robocze_pracownika`
  MODIFY `id_danych_roboczych` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `dni_urlopowe`
--
ALTER TABLE `dni_urlopowe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `szkolenia`
--
ALTER TABLE `szkolenia`
  MODIFY `id_szkolenia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `wypłaty`
--
ALTER TABLE `wypłaty`
  MODIFY `id_wyplaty` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
