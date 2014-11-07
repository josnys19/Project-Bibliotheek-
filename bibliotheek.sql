-- phpMyAdmin SQL Dump
-- version 4.2.10.1
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Gegenereerd op: 02 nov 2014 om 17:17
-- Serverversie: 5.5.38
-- PHP-versie: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `bibliotheek`
--
CREATE DATABASE IF NOT EXISTS `bibliotheek` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bibliotheek`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `boeken`
--

CREATE TABLE IF NOT EXISTS `boeken` (
`id` int(11) NOT NULL,
  `schrijver` int(11) NOT NULL,
  `titel` varchar(70) NOT NULL,
  `isbn` varchar(20) DEFAULT NULL,
  `uitgever` varchar(30) NOT NULL,
  `jaar` int(4) NOT NULL,
  `samenvatting` text
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `boeken`
--

INSERT INTO `boeken` (`id`, `schrijver`, `titel`, `isbn`, `uitgever`, `jaar`, `samenvatting`) VALUES
(1, 1, 'Creating your MySQL Database', '1904811302', 'Packt Publishing Ltd', 2006, 'A short guide for everyone on how to structure your data and set-up your MySQL database tables efficiently and easily.'),
(2, 2, 'Drupal in 24 stappen', '1904811868', 'Averbode Ltd.', 2010, 'In 24 stappen leer je een Drupal raamwerk opzetten'),
(3, 3, 'Building Websites with Plone', '1904811027', 'Pact Publishing Ltd', 2004, 'Een diepgaande en duidelijke gids over het Plone inhoudmanagementssysteem');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `schrijvers`
--

CREATE TABLE IF NOT EXISTS `schrijvers` (
`id` int(11) NOT NULL,
  `voornaam` varchar(30) NOT NULL,
  `achternaam` varchar(40) NOT NULL,
  `biografie` text
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `schrijvers`
--

INSERT INTO `schrijvers` (`id`, `voornaam`, `achternaam`, `biografie`) VALUES
(1, 'Marc', 'Delisle', 'Marc Delisle is a member of the MySQL Developers Guide'),
(2, 'Koen', 'Timmers', 'De laatste jaren heeft Koen meerdere boeken geschreven over webontwikkeling'),
(3, 'Toon', 'Gorissen', 'Toon Gorissen is al enige tijd zichtbaar op het internet met een aantal blogs over webdesign en alles wat er mee te maken heeft');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `boeken`
--
ALTER TABLE `boeken`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `idx_isbn` (`isbn`);

--
-- Indexen voor tabel `schrijvers`
--
ALTER TABLE `schrijvers`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `boeken`
--
ALTER TABLE `boeken`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT voor een tabel `schrijvers`
--
ALTER TABLE `schrijvers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
