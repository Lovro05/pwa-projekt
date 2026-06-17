-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2026 at 01:11 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS pwa_projekt
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

USE pwa_projekt;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pwa_projekt`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(32) NOT NULL,
  `prezime` varchar(32) NOT NULL,
  `korisnicko_ime` varchar(64) NOT NULL,
  `lozinka` varchar(255) NOT NULL,
  `razina` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `korisnicko_ime`, `lozinka`, `razina`) VALUES
(1, 'Lovro', 'Novosel', 'LN', '$2y$10$OkTVf12CgG5TWNfEYOHXKOli3A/vwXYg6TUbwFfk7UuedIgX3VzEm', 1),
(2, 'Pero', 'Perić', 'PP', '$2y$10$xo3Jn.9uISn2vXIjM1QUzeLrYXhr0Ui.t/wV9uJOb.bYXlkK1e9su', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vijesti`
--

CREATE TABLE `vijesti` (
  `id` int(11) NOT NULL,
  `datum` varchar(32) NOT NULL,
  `naslov` varchar(255) NOT NULL,
  `sazetak` text NOT NULL,
  `tekst` text NOT NULL,
  `slika` varchar(255) NOT NULL,
  `kategorija` varchar(64) NOT NULL,
  `arhiva` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vijesti`
--

INSERT INTO `vijesti` (`id`, `datum`, `naslov`, `sazetak`, `tekst`, `slika`, `kategorija`, `arhiva`) VALUES
(1, '17.06.2026.', 'PSG are UCL champions 2026 !!!', 'Paris Saint-German have won the champions league for the second year in a row.', 'After a long game and many exciteing chances, PSG came out on top!\r\n\r\nThey have won the champions league for the second year in a row.', 'psg_ucl.jfif', 'Parisien', 1),
(2, '17.06.2026', 'Vos idées pour l’Europe : et si on supprimait la directive sur les travailleurs détachés ?', 'Prijedlog o ukidanju direktive o upućenim radnicima.', 'Europska unija već godinama raspravlja o direktivi o upućenim radnicima. Zagovornici ukidanja smatraju da postojeća pravila stvaraju nejednake uvjete na tržištu rada među državama članicama. S druge strane, protivnici upozoravaju da bi ukidanje moglo dovesti do smanjenja zaštite radnika. Rasprava se posebno intenzivirala uoči europskih izbora, kada su pitanja radnih prava i mobilnosti radne snage postala jedna od glavnih tema političkih kampanja. Stručnjaci smatraju da će se o ovoj temi raspravljati još godinama prije donošenja konačne odluke.', 'img1.png', 'Parisien', 0),
(3, '17.06.2026', 'Vos idées pour l’Europe : et si on interdisait le glyphosate immédiatement ?', 'Rasprava o zabrani glifosata.', 'Glifosat je jedan od najčešće korištenih herbicida na svijetu. Dok pojedine organizacije upozoravaju na moguće negativne posljedice za zdravlje ljudi i okoliš, poljoprivrednici ističu njegovu važnost za održavanje proizvodnje hrane. Europske institucije već nekoliko godina pokušavaju pronaći kompromis između zaštite okoliša i potreba poljoprivrednog sektora. Rasprava o potpunoj zabrani glifosata ostaje jedna od najkontroverznijih tema europske poljoprivredne politike.', 'img2.png', 'Parisien', 0),
(4, '17.06.2026', 'Vos idées pour l’Europe : et si on harmonisait les règles fiscales ?', 'Harmonizacija poreznih pravila u Europskoj uniji.', 'Porezna pravila razlikuju se među državama članicama Europske unije, što često dovodi do različitih uvjeta poslovanja. Zagovornici harmonizacije smatraju da bi zajednička pravila smanjila mogućnost izbjegavanja poreza i povećala pravednost na jedinstvenom tržištu. Kritičari pak upozoravaju da bi države izgubile dio svoje financijske neovisnosti. Europska komisija već je predstavila nekoliko prijedloga kojima bi se postupno uskladili porezni sustavi unutar Unije.', 'img3.png', 'Parisien', 0),
(5, '17.06.2026', 'À Rouen, des familles relèvent le défi de manger mieux sans dépenser plus', 'Obitelji pokušavaju zdravije jesti bez većih troškova.', 'Sve više obitelji pokušava pronaći način kako poboljšati kvalitetu prehrane bez značajnog povećanja troškova. U francuskom gradu Rouenu pokrenut je projekt koji građanima pruža savjete o planiranju obroka, kupnji lokalnih proizvoda i smanjenju bacanja hrane. Sudionici ističu da su uz male promjene uspjeli ostvariti značajne uštede te istovremeno poboljšati prehrambene navike cijele obitelji.', 'img4.png', 'Vivre mieux', 0),
(6, '17.06.2026', 'Que faire en cas de démission du syndic ?', 'Savjeti za situaciju kada upravitelj zgrade podnese ostavku.', 'Ostavka upravitelja zgrade može izazvati brojne organizacijske probleme među stanarima. Stručnjaci savjetuju brzo sazivanje sastanka suvlasnika kako bi se odabrao novi upravitelj i osigurao kontinuitet upravljanja zajedničkom imovinom. Važno je provjeriti postojeće ugovore i zakonske obveze kako bi prijelaz na novog upravitelja prošao bez poteškoća.', 'img5.png', 'Vivre mieux', 0),
(7, '17.06.2026', 'Comment déménager sans se ruiner', 'Savjeti za preseljenje bez stresa i velikih troškova.', 'Preseljenje često predstavlja velik financijski izazov, no pažljivim planiranjem moguće je znatno smanjiti troškove. Stručnjaci preporučuju pravovremeno prikupljanje ponuda prijevozničkih tvrtki, korištenje postojećih kutija i ambalaže te organizaciju pomoći prijatelja i obitelji. Dobrom organizacijom moguće je izbjeći nepotrebne troškove i stres koji često prate promjenu mjesta stanovanja.', 'img6.png', 'Vivre mieux', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `korisnicko_ime` (`korisnicko_ime`);

--
-- Indexes for table `vijesti`
--
ALTER TABLE `vijesti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vijesti`
--
ALTER TABLE `vijesti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
