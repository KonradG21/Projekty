-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 14, 2024 at 06:26 PM
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
-- Database: `sklep_kwiaciarnia`
--

DELIMITER $$
--
-- Procedury
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `dodaj_zamowienie` (IN `Klient` INT, IN `Kwiat` INT, IN `Ilość_Kwiatow` INT, IN `Bukiet` INT, IN `Ilość_Bukietow` INT, IN `Data_zalozenia` DATE)   BEGIN
    DECLARE v_klient_exists INT;
    DECLARE v_kwiat_exists INT;
    DECLARE v_bukiet_exists INT;
    
    -- Sprawdzenie czy klient istnieje
    SELECT COUNT(*) INTO v_klient_exists FROM klient WHERE klient_ID = Klient;
    IF v_klient_exists = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Klient nie istnieje.';
    END IF;

    -- Sprawdzenie czy kwiat istnieje
    IF Kwiat IS NOT NULL THEN
        SELECT COUNT(*) INTO v_kwiat_exists FROM kwiaty WHERE kwiat_ID = Kwiat;
        IF v_kwiat_exists = 0 THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Kwiat nie istnieje.';
        END IF;
    END IF;

    -- Sprawdzenie czy bukiet istnieje
    IF Bukiet IS NOT NULL THEN
        SELECT COUNT(*) INTO v_bukiet_exists FROM bukiet WHERE bukiet_ID = Bukiet;
        IF v_bukiet_exists = 0 THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Bukiet nie istnieje.';
        END IF;
    END IF;

    IF Data_zalozenia> CURDATE() THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Data założenia zamówienia nie może być późniejsza niż dzisiejszy dzień.';
    END IF;

    -- Wstawienie zamówienia
    INSERT INTO zamówienia (ID_klient, ID_kwiat, ilosc_kwiat, ID_bukiet, ilosc_bukiet, Data)
    VALUES (Klient, Kwiat, Ilość_Kwiatow, Bukiet, Ilość_Bukietow, Data_zalozenia);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pokaz_zamowienia_klientow` ()   BEGIN
    DECLARE done INT DEFAULT 0;
    DECLARE k_ID INT;
    DECLARE k_Imie VARCHAR(50);
    DECLARE k_Nazwisko VARCHAR(50);

    -- Deklaracja kursora dla klientów
    DECLARE klient_cursor CURSOR FOR 
    SELECT klient_ID, Imie, Nazwisko FROM klient;

    -- Deklaracja warunków zakończenia kursora
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    -- Otwarcie kursora
    OPEN klient_cursor;

    klient_loop: LOOP
        FETCH klient_cursor INTO k_ID, k_Imie, k_Nazwisko;
        IF done THEN
            LEAVE klient_loop;
        END IF;

        -- Wyświetlanie informacji o kliencie
        SELECT CONCAT('Klient: ', k_Imie, ' ', k_Nazwisko) AS klient;

        -- Wyświetlanie zamówień klienta
        SELECT * FROM zamówienia WHERE ID_klient = k_ID;

    END LOOP klient_loop;

    -- Zamknięcie kursora
    CLOSE klient_cursor;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `liczba_dni_od_zlozenia` (`p_zamowienia_ID` INT) RETURNS INT(11)  BEGIN
    DECLARE dni_od_zlozenia INT;
    
    SELECT DATEDIFF(CURDATE(), Data)
    INTO dni_od_zlozenia
    FROM zamówienia
    WHERE zamowienia_ID = p_zamowienia_ID;

    RETURN dni_od_zlozenia;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `oblicz_wartosc_zamowien` (`p_typ` VARCHAR(10)) RETURNS DECIMAL(10,2) DETERMINISTIC BEGIN
    DECLARE wynik DECIMAL(10, 2);

    IF p_typ = 'MIN' THEN
        SELECT MIN(wartosc) INTO wynik FROM (
            SELECT 
                z.zamowienia_ID,
                IFNULL(kw.cena * z.ilosc_kwiat, 0) + IFNULL(b.cena * z.ilosc_bukiet, 0) AS wartosc
            FROM zamówienia z
            LEFT JOIN kwiaty kw ON z.ID_kwiat = kw.kwiat_ID
            LEFT JOIN bukiet b ON z.ID_bukiet = b.bukiet_ID
        ) subquery;
    ELSEIF p_typ = 'MAX' THEN
        SELECT MAX(wartosc) INTO wynik FROM (
            SELECT 
                z.zamowienia_ID,
                IFNULL(kw.cena * z.ilosc_kwiat, 0) + IFNULL(b.cena * z.ilosc_bukiet, 0) AS wartosc
            FROM zamówienia z
            LEFT JOIN kwiaty kw ON z.ID_kwiat = kw.kwiat_ID
            LEFT JOIN bukiet b ON z.ID_bukiet = b.bukiet_ID
        ) subquery;
    ELSEIF p_typ = 'AVG' THEN
        SELECT AVG(wartosc) INTO wynik FROM (
            SELECT 
                z.zamowienia_ID,
                IFNULL(kw.cena * z.ilosc_kwiat, 0) + IFNULL(b.cena * z.ilosc_bukiet, 0) AS wartosc
            FROM zamówienia z
            LEFT JOIN kwiaty kw ON z.ID_kwiat = kw.kwiat_ID
            LEFT JOIN bukiet b ON z.ID_bukiet = b.bukiet_ID
        ) subquery;
    ELSE
        SET wynik = NULL;
    END IF;

    RETURN wynik;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bukiet`
--

CREATE TABLE `bukiet` (
  `bukiet_ID` int(11) NOT NULL,
  `Nazwa` varchar(100) NOT NULL,
  `Rozmiar` varchar(50) NOT NULL,
  `Cena` decimal(9,2) NOT NULL,
  `Skład` varchar(100) NOT NULL,
  `Kolor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `bukiet`
--

INSERT INTO `bukiet` (`bukiet_ID`, `Nazwa`, `Rozmiar`, `Cena`, `Skład`, `Kolor`) VALUES
(1, 'Bukiet \"Magiczny\"', 'Duży', 70.99, 'róża gałązkowa, margaretka, waksfloter', 'Różne odcienie fioletowego i różowego'),
(2, 'Bukiet Tulipanów M', 'Mały', 15.99, 'Tulipany różnorodnego koloru', 'Czerwony, Biały, Żółty, Fioletowy'),
(3, 'Bukiet Tulipanów Ś', 'Średni', 22.99, 'Tulipany różnorodnego koloru', 'Czerwony, Biały, Żółty, Fioletowy'),
(4, 'Bukiet Tulipanów D', 'Duży', 28.99, 'Tulipany różnorodnego koloru', 'Czerwony, Biały, Żółty, Fioletowy'),
(5, 'Bukiet Róż M', 'Mały', 16.99, 'Róży w trzech kolorach', 'Czerwony, Żółty, Różowy'),
(6, 'Bukiet Róż Ś', 'Średni', 23.99, 'Róży w trzech kolorach', 'Czerwony, Żółty, Różowy'),
(7, 'Bukiet Róż D', 'Duży', 29.99, 'Róży w trzech kolorach', 'Czerwony, Żółty, Różowy'),
(8, 'Bukiet \"Randka w Paryżu\"', 'Duży', 34.99, 'Róża, Tulipan, Roża Peoniowa', 'Czerwony, Żółty, Różowy'),
(9, 'Bukiet \"Z Duszą\"', 'Średni', 25.99, 'Róży białe w stylowym bukiecie', 'Biały');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klient`
--

CREATE TABLE `klient` (
  `klient_ID` int(11) NOT NULL,
  `Imie` text NOT NULL,
  `Nazwisko` text NOT NULL,
  `Adres` text NOT NULL,
  `Miejscowosc` text DEFAULT NULL,
  `Telefon` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `klient`
--

INSERT INTO `klient` (`klient_ID`, `Imie`, `Nazwisko`, `Adres`, `Miejscowosc`, `Telefon`) VALUES
(1, 'Radosław', 'Gwiazda', 'Akacjowa 2', 'Kadzidło', 459595941),
(3, 'Maciek', 'Mieczystyczkowicz', 'Kościelna 14', 'Ostrołęka', 295248053),
(4, 'Stanisław', 'Olblęga', 'Kościuszki 13', 'Rzekuń', 662041644),
(5, 'Agata', 'Staniszewicz', 'Piastowa 23/1', 'Warszawa', 253370869),
(6, 'Mariusz', 'Pietrzyk', 'Świerkowa 3', 'Warszawa', 214214395),
(7, 'Wiktoria', 'Ruszczkiewicz', 'Jagodowa 4/3', 'Białobiel', 550449826),
(8, 'Marcel', 'Zalewski', 'św. Franciszka Salezego 6-1', 'Warszawa', 613807461),
(9, 'Zuzanna', 'Grzyb', 'Stefana Jaracza 2', 'Warszawa', 174378287),
(10, 'Nikola', 'Świtkowska', 'Sportowa 2/1', 'Piaseczno', 373031487),
(11, 'Reneta', 'Maryszowa', 'Stefana 16/6', 'Pruszków', 175152809);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kwiaty`
--

CREATE TABLE `kwiaty` (
  `kwiat_ID` int(11) NOT NULL,
  `Nazwa` varchar(100) NOT NULL,
  `Gatunek` varchar(100) NOT NULL,
  `Cena` decimal(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `kwiaty`
--

INSERT INTO `kwiaty` (`kwiat_ID`, `Nazwa`, `Gatunek`, `Cena`) VALUES
(1, 'Dzika róża', 'Rosa Canina', 4.99),
(2, 'Tulipan', 'Tulipa', 3.99),
(3, 'Lilak', 'Lilak pospolity', 2.99),
(4, 'Gipsówka błyszcząca', 'Gypsophila paniculata', 1.99),
(5, 'Firletka smółka', 'Lychnis viscaria alba', 3.99),
(6, 'Storczyk', 'Orchideceae', 2.99),
(7, 'Kohleria', 'Kohleria', 3.99),
(8, 'Gajlardia oścista', 'Gaillardia aristata', 4.99),
(9, 'Heliotrop peruwiański', 'Heliotropium arborescens', 3.99),
(10, 'Powojnik tangucki', 'Clematis tangutica', 6.99),
(11, 'Asarina', 'Asarina scandens', 5.99);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `widok_klienci_suma_zamowien`
-- (See below for the actual view)
--
CREATE TABLE `widok_klienci_suma_zamowien` (
`klient_ID` int(11)
,`Imie` text
,`Nazwisko` text
,`Adres` text
,`Miejscowosc` text
,`Telefon` int(9)
,`suma_kwiatow` decimal(32,0)
,`suma_bukietow` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `zamowienia_ostatnie_5_dni`
-- (See below for the actual view)
--
CREATE TABLE `zamowienia_ostatnie_5_dni` (
`klient_ID` int(11)
,`Imie` text
,`Nazwisko` text
,`Adres` text
,`Miejscowosc` text
,`Telefon` int(9)
,`zamowienia_ID` int(11)
,`ID_kwiat` int(11)
,`ilosc_kwiat` int(11)
,`ID_bukiet` int(11)
,`ilosc_bukiet` int(11)
,`Data` date
);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamówienia`
--

CREATE TABLE `zamówienia` (
  `zamowienia_ID` int(11) NOT NULL,
  `ID_klient` int(11) DEFAULT NULL,
  `ID_kwiat` int(11) DEFAULT NULL,
  `ilosc_kwiat` int(11) DEFAULT NULL,
  `ID_bukiet` int(11) DEFAULT NULL,
  `ilosc_bukiet` int(11) DEFAULT NULL,
  `Data` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `zamówienia`
--

INSERT INTO `zamówienia` (`zamowienia_ID`, `ID_klient`, `ID_kwiat`, `ilosc_kwiat`, `ID_bukiet`, `ilosc_bukiet`, `Data`) VALUES
(17, 4, 5, 4, 5, 1, '2024-06-02'),
(18, 8, 8, 4, NULL, NULL, '2024-06-01'),
(19, 5, 10, 3, 9, 1, '2024-06-09'),
(20, 10, 5, 5, 2, 3, '2024-06-11'),
(21, 11, NULL, NULL, 4, 2, '2024-05-29'),
(22, 9, NULL, NULL, 7, 3, '2024-06-10'),
(23, 6, 7, 2, 3, 2, '2024-05-28'),
(24, 1, 10, 4, 3, 1, '2024-06-08'),
(25, 9, 3, 5, 6, 5, '2024-06-03'),
(26, 4, NULL, NULL, 7, 5, '2024-06-06'),
(27, 10, 11, 5, NULL, NULL, '2024-06-04'),
(28, 3, 7, 10, 1, 4, '2024-06-05'),
(29, 9, 2, 1, 5, 1, '2024-05-30'),
(30, 4, 5, 4, 5, 1, '2024-05-29'),
(31, 8, 8, 4, NULL, NULL, '2024-05-23'),
(32, 5, 10, 3, 9, 1, '2024-06-12'),
(33, 10, 5, 5, 2, 3, '2024-05-28'),
(34, 11, NULL, NULL, 4, 2, '2024-05-29'),
(35, 9, NULL, NULL, 7, 3, '2024-05-28'),
(36, 6, 7, 2, 3, 2, '2024-05-27'),
(37, 1, 10, 4, 3, 1, '2024-06-12'),
(38, 9, 3, 5, 6, 5, '2024-06-12'),
(39, 4, NULL, NULL, 7, 5, '2024-06-11'),
(40, 10, 11, 5, NULL, NULL, '2024-06-03'),
(41, 3, 7, 10, 1, 4, '2024-05-27'),
(42, 9, 2, 1, 5, 1, '2024-05-28'),
(43, 6, 1, 1, 3, 1, '2024-05-21'),
(44, 8, 1, 1, 3, 1, '2024-05-24'),
(46, 1, 1, 1, 1, 1, '2024-06-11'),
(47, 1, 1, 1, 1, 1, '2024-06-12'),
(48, 1, 3, 10, 2, 5, '2024-06-01'),
(49, 7, 3, 10, 2, 5, '2024-06-01');

-- --------------------------------------------------------

--
-- Struktura widoku `widok_klienci_suma_zamowien`
--
DROP TABLE IF EXISTS `widok_klienci_suma_zamowien`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `widok_klienci_suma_zamowien`  AS SELECT `k`.`klient_ID` AS `klient_ID`, `k`.`Imie` AS `Imie`, `k`.`Nazwisko` AS `Nazwisko`, `k`.`Adres` AS `Adres`, `k`.`Miejscowosc` AS `Miejscowosc`, `k`.`Telefon` AS `Telefon`, coalesce(sum(`z`.`ilosc_kwiat`),0) AS `suma_kwiatow`, coalesce(sum(`z`.`ilosc_bukiet`),0) AS `suma_bukietow` FROM (`klient` `k` left join `zamówienia` `z` on(`k`.`klient_ID` = `z`.`ID_klient`)) GROUP BY `k`.`klient_ID`, `k`.`Imie`, `k`.`Nazwisko`, `k`.`Adres`, `k`.`Miejscowosc`, `k`.`Telefon` ;

-- --------------------------------------------------------

--
-- Struktura widoku `zamowienia_ostatnie_5_dni`
--
DROP TABLE IF EXISTS `zamowienia_ostatnie_5_dni`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `zamowienia_ostatnie_5_dni`  AS SELECT `k`.`klient_ID` AS `klient_ID`, `k`.`Imie` AS `Imie`, `k`.`Nazwisko` AS `Nazwisko`, `k`.`Adres` AS `Adres`, `k`.`Miejscowosc` AS `Miejscowosc`, `k`.`Telefon` AS `Telefon`, `z`.`zamowienia_ID` AS `zamowienia_ID`, `z`.`ID_kwiat` AS `ID_kwiat`, `z`.`ilosc_kwiat` AS `ilosc_kwiat`, `z`.`ID_bukiet` AS `ID_bukiet`, `z`.`ilosc_bukiet` AS `ilosc_bukiet`, `z`.`Data` AS `Data` FROM (`klient` `k` join `zamówienia` `z` on(`k`.`klient_ID` = `z`.`ID_klient`)) WHERE `z`.`Data` >= curdate() - interval 5 day ;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `bukiet`
--
ALTER TABLE `bukiet`
  ADD PRIMARY KEY (`bukiet_ID`);

--
-- Indeksy dla tabeli `klient`
--
ALTER TABLE `klient`
  ADD PRIMARY KEY (`klient_ID`);

--
-- Indeksy dla tabeli `kwiaty`
--
ALTER TABLE `kwiaty`
  ADD PRIMARY KEY (`kwiat_ID`);

--
-- Indeksy dla tabeli `zamówienia`
--
ALTER TABLE `zamówienia`
  ADD PRIMARY KEY (`zamowienia_ID`),
  ADD KEY `ID_klient` (`ID_klient`),
  ADD KEY `ID_kwiat` (`ID_kwiat`),
  ADD KEY `ID_bukiet` (`ID_bukiet`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bukiet`
--
ALTER TABLE `bukiet`
  MODIFY `bukiet_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `klient`
--
ALTER TABLE `klient`
  MODIFY `klient_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kwiaty`
--
ALTER TABLE `kwiaty`
  MODIFY `kwiat_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `zamówienia`
--
ALTER TABLE `zamówienia`
  MODIFY `zamowienia_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `zamówienia`
--
ALTER TABLE `zamówienia`
  ADD CONSTRAINT `zamówienia_ibfk_1` FOREIGN KEY (`ID_klient`) REFERENCES `klient` (`klient_ID`),
  ADD CONSTRAINT `zamówienia_ibfk_2` FOREIGN KEY (`ID_kwiat`) REFERENCES `kwiaty` (`kwiat_ID`),
  ADD CONSTRAINT `zamówienia_ibfk_3` FOREIGN KEY (`ID_bukiet`) REFERENCES `bukiet` (`bukiet_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
