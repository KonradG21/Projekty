-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2025 at 02:57 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `l6_gwiazda_31986_kol1_kursy_fotograficzne1`
--

-- --------------------------------------------------------

--
-- Table structure for table `fotograf_majsterkg`
--

CREATE TABLE `fotograf_majsterkg` (
  `foto_majster_idkg` int(11) NOT NULL,
  `foto_majster_imiekg` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `fotograf_majsterkg`
--

INSERT INTO `fotograf_majsterkg` (`foto_majster_idkg`, `foto_majster_imiekg`) VALUES
(1, 'Robert'),
(2, 'Krzysiek'),
(3, 'Stanisław'),
(4, 'Przemek'),
(5, 'Damian'),
(6, 'Mateusz'),
(7, 'Ryszard'),
(8, 'Ryszard'),
(9, 'Ryszard'),
(10, 'Ryszard'),
(11, 'Wieisk'),
(12, 'Wieisk');

-- --------------------------------------------------------

--
-- Table structure for table `fotograf_majster_umiejetonoscikg`
--

CREATE TABLE `fotograf_majster_umiejetonoscikg` (
  `foto_majster_umiejetnosci_idkg` int(11) NOT NULL,
  `umiejetnosckg` varchar(70) NOT NULL,
  `foto_majster_idkg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `fotograf_majster_umiejetonoscikg`
--

INSERT INTO `fotograf_majster_umiejetonoscikg` (`foto_majster_umiejetnosci_idkg`, `umiejetnosckg`, `foto_majster_idkg`) VALUES
(1, 'Fotografia ruchomych obiektów', 1),
(2, 'Fotografia ruchomych obiektów', 2),
(3, 'Konserwacja aparatu', 2),
(4, 'Czyszczenie aparatu', 1),
(5, 'Czyszczenie aparatu', 3),
(6, 'Operowanie nieruchomej aparatu', 3),
(7, 'Fotografia uniwersalna', 4),
(8, 'Fotografia żywych zwierząt', 5),
(9, 'Fotografia żywych zwierząt', 5);

-- --------------------------------------------------------

--
-- Table structure for table `info_zajeciakg`
--

CREATE TABLE `info_zajeciakg` (
  `info_zajecia_idkg` int(11) NOT NULL,
  `foto_majster_umiejetnosci_idkg` int(11) NOT NULL,
  `kursy_idkg` int(11) NOT NULL,
  `koszt_majstrakg` decimal(9,2) NOT NULL,
  `Miejsce_kursukg` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `info_zajeciakg`
--

INSERT INTO `info_zajeciakg` (`info_zajecia_idkg`, `foto_majster_umiejetnosci_idkg`, `kursy_idkg`, `koszt_majstrakg`, `Miejsce_kursukg`) VALUES
(1, 1, 1, 100.00, 'Warszawa'),
(2, 2, 3, 150.00, 'Warszawa'),
(3, 2, 4, 75.00, 'Warszawa'),
(4, 3, 2, 125.00, 'Kraków'),
(5, 4, 5, 120.00, 'Kraków'),
(6, 5, 6, 300.00, 'Kraków'),
(7, 6, 4, 140.00, 'Kraków'),
(8, 8, 7, 250.00, 'Wrocław'),
(9, 8, 7, 250.00, 'Wrocław');

-- --------------------------------------------------------

--
-- Table structure for table `kursykg`
--

CREATE TABLE `kursykg` (
  `kursy_idkg` int(11) NOT NULL,
  `kursy_nazwakg` varchar(70) NOT NULL,
  `rodzaje_idkg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `kursykg`
--

INSERT INTO `kursykg` (`kursy_idkg`, `kursy_nazwakg`, `rodzaje_idkg`) VALUES
(1, 'Fotografia dzieł artystycznych', 1),
(2, 'Historia powstania dzieł artystycznych', 1),
(3, 'Fotografia dzieł turystycznych', 2),
(4, 'Kultura turystyki', 2),
(5, 'Fotografia dzieł sportowych', 3),
(6, 'Śledzenie ruchomych elementów w fotografii', 3),
(7, 'Fotografia żywych zwierząt', 2);

-- --------------------------------------------------------

--
-- Table structure for table `rodzajekg`
--

CREATE TABLE `rodzajekg` (
  `rodzaje_idkg` int(11) NOT NULL,
  `rodzaje_nazwakg` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `rodzajekg`
--

INSERT INTO `rodzajekg` (`rodzaje_idkg`, `rodzaje_nazwakg`) VALUES
(1, 'Artystyczna'),
(2, 'Turystyczna'),
(3, 'Sportowa'),
(4, 'Ogólna');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fotograf_majsterkg`
--
ALTER TABLE `fotograf_majsterkg`
  ADD PRIMARY KEY (`foto_majster_idkg`);

--
-- Indexes for table `fotograf_majster_umiejetonoscikg`
--
ALTER TABLE `fotograf_majster_umiejetonoscikg`
  ADD PRIMARY KEY (`foto_majster_umiejetnosci_idkg`),
  ADD KEY `foto_majster_idkg` (`foto_majster_idkg`);

--
-- Indexes for table `info_zajeciakg`
--
ALTER TABLE `info_zajeciakg`
  ADD PRIMARY KEY (`info_zajecia_idkg`),
  ADD KEY `kursy_idkg` (`kursy_idkg`),
  ADD KEY `foto_majster_umiejetnosci_idkg` (`foto_majster_umiejetnosci_idkg`);

--
-- Indexes for table `kursykg`
--
ALTER TABLE `kursykg`
  ADD PRIMARY KEY (`kursy_idkg`),
  ADD KEY `rodzaje_idkg` (`rodzaje_idkg`);

--
-- Indexes for table `rodzajekg`
--
ALTER TABLE `rodzajekg`
  ADD PRIMARY KEY (`rodzaje_idkg`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fotograf_majsterkg`
--
ALTER TABLE `fotograf_majsterkg`
  MODIFY `foto_majster_idkg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `fotograf_majster_umiejetonoscikg`
--
ALTER TABLE `fotograf_majster_umiejetonoscikg`
  MODIFY `foto_majster_umiejetnosci_idkg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `info_zajeciakg`
--
ALTER TABLE `info_zajeciakg`
  MODIFY `info_zajecia_idkg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kursykg`
--
ALTER TABLE `kursykg`
  MODIFY `kursy_idkg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rodzajekg`
--
ALTER TABLE `rodzajekg`
  MODIFY `rodzaje_idkg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fotograf_majster_umiejetonoscikg`
--
ALTER TABLE `fotograf_majster_umiejetonoscikg`
  ADD CONSTRAINT `fotograf_majster_umiejetonoscikg_ibfk_1` FOREIGN KEY (`foto_majster_idkg`) REFERENCES `fotograf_majsterkg` (`foto_majster_idkg`);

--
-- Constraints for table `info_zajeciakg`
--
ALTER TABLE `info_zajeciakg`
  ADD CONSTRAINT `info_zajeciakg_ibfk_1` FOREIGN KEY (`kursy_idkg`) REFERENCES `kursykg` (`kursy_idkg`),
  ADD CONSTRAINT `info_zajeciakg_ibfk_2` FOREIGN KEY (`foto_majster_umiejetnosci_idkg`) REFERENCES `fotograf_majster_umiejetonoscikg` (`foto_majster_umiejetnosci_idkg`);

--
-- Constraints for table `kursykg`
--
ALTER TABLE `kursykg`
  ADD CONSTRAINT `kursykg_ibfk_1` FOREIGN KEY (`rodzaje_idkg`) REFERENCES `rodzajekg` (`rodzaje_idkg`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
