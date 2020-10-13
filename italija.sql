-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2019 at 05:34 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `italija`
--

-- --------------------------------------------------------

--
-- Table structure for table `anketa`
--

CREATE TABLE `anketa` (
  `idAnketa` int(11) NOT NULL,
  `pitanje` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `aktivna` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `anketa`
--

INSERT INTO `anketa` (`idAnketa`, `pitanje`, `aktivna`) VALUES
(2, 'Koji vam je grad najlepši?', 0),
(3, 'Da li Vam se svidja Španija?', 1);

-- --------------------------------------------------------

--
-- Table structure for table `galerija`
--

CREATE TABLE `galerija` (
  `idGalerija` int(50) NOT NULL,
  `alt` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `putanja` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `galerija`
--

INSERT INTO `galerija` (`idGalerija`, `alt`, `putanja`) VALUES
(1, 'Slika1', '/img/slika1.jpg'),
(2, 'Slika2', '/img/slika2.jpg'),
(3, 'Slika3', '/img/slika3.jpg'),
(4, 'Slika4', '/img/slika4.jpg'),
(5, 'Slika5', '/img/slika5.jpg'),
(6, 'Slika6', '/img/slika6.jpg\r\n'),
(7, 'Slika7', '/img/slika7.jpg'),
(8, 'Slika8', '/img/slika8.jpg'),
(9, 'Slika9', '/img/slika9.jpg'),
(10, 'Slika10', '/img/slika10.jpg'),
(11, 'Alt', '/img/1552397254.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `glasanje`
--

CREATE TABLE `glasanje` (
  `idGlasanje` int(11) NOT NULL,
  `idKorisnik` int(11) NOT NULL,
  `idAnketa` int(11) NOT NULL,
  `idOdgovor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `glasanje`
--

INSERT INTO `glasanje` (`idGlasanje`, `idKorisnik`, `idAnketa`, `idOdgovor`) VALUES
(2, 1, 1, 1),
(3, 3, 1, 1),
(4, 5, 1, 1),
(5, 1, 2, 4),
(6, 5, 2, 5),
(7, 1, 3, 7),
(8, 6, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `kategorija`
--

CREATE TABLE `kategorija` (
  `idKategorije` int(11) NOT NULL,
  `grad` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kategorija`
--

INSERT INTO `kategorija` (`idKategorije`, `grad`) VALUES
(1, 'Madrid'),
(2, 'Barselona'),
(3, 'Valensija'),
(4, 'Malaga'),
(5, 'Sevilja');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `idKomentar` int(11) NOT NULL,
  `komentar` text COLLATE utf8_unicode_ci NOT NULL,
  `idKorisnik` int(11) NOT NULL,
  `vreme` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idPost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`idKomentar`, `komentar`, `idKorisnik`, `vreme`, `idPost`) VALUES
(3, 'prelepoo', 6, '2019-03-12 14:38:51', 6),
(4, 'Prelepo, svakome bih preporucila', 1, '2019-03-12 14:42:10', 2);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `idKorisnik` int(11) NOT NULL,
  `ime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lozinka` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `idUloga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`idKorisnik`, `ime`, `prezime`, `email`, `lozinka`, `idUloga`) VALUES
(1, 'Nevena', 'Djakovic', 'nena@gmail.com', '201ae15dfdbc703302334ef9034c0df3', 1),
(5, 'Jovana', 'Jovanic', 'joka@gmail.com', '067a9d48f2884037e1320ac03b18e86f', 2),
(6, 'Ivana', 'Ivanovic', 'iva@gmail.com', '8a79ae8c062722dcb973068e7bdaf63a', 2),
(7, 'Maja', 'Majic', 'maja@gmail.com', 'd855db9851db7dfa20b86d44dd2c753a', 2);

-- --------------------------------------------------------

--
-- Table structure for table `meni`
--

CREATE TABLE `meni` (
  `idMeni` int(11) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `putanja` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pozicija` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `meni`
--

INSERT INTO `meni` (`idMeni`, `naziv`, `putanja`, `pozicija`) VALUES
(1, 'Pocetna', '/', 1),
(2, 'Kontakt', '/kontakt', 2),
(3, 'Galerija', '/galerija', 3),
(4, 'Destinacije', '/destinacije', 4);

-- --------------------------------------------------------

--
-- Table structure for table `odgovor`
--

CREATE TABLE `odgovor` (
  `idOdgovor` int(11) NOT NULL,
  `idAnketa` int(11) NOT NULL,
  `odgovor` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `odgovor`
--

INSERT INTO `odgovor` (`idOdgovor`, `idAnketa`, `odgovor`) VALUES
(4, 2, 'Valensija'),
(6, 2, 'Madrid'),
(7, 3, 'Da'),
(8, 3, 'Ne'),
(9, 3, 'Onako'),
(10, 2, 'Barselona');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `idPost` int(11) NOT NULL,
  `naslov` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `opis` text COLLATE utf8_unicode_ci NOT NULL,
  `sadrzaj` text COLLATE utf8_unicode_ci NOT NULL,
  `datum_kreiranja` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datum_izmene` datetime DEFAULT CURRENT_TIMESTAMP,
  `idSlika` int(11) NOT NULL,
  `idKorisnik` int(11) NOT NULL,
  `brojKomentara` int(11) NOT NULL DEFAULT '0',
  `idKategorije` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`idPost`, `naslov`, `opis`, `sadrzaj`, `datum_kreiranja`, `datum_izmene`, `idSlika`, `idKorisnik`, `brojKomentara`, `idKategorije`) VALUES
(1, 'Madrid', 'Madrid je prestonica Španije i treci po velicini grad u Evropskoj uniji posle Londona i Berlina. U njemu živi oko 3,2 miliona stanovnika, a isto toliko ih ima i u predgradu.', 'Madrid je važan politicki, ekonomski i kulturni centar Španije, a smatra se i važnim finansijskim južne Evrope.\r\nMadrid nije tako lep kao Barselona niti ima tradicionalni šarm Andaluzije, ali je zato uzbudljiv i pun akcije. Mnoštvo muzeja, spomenika i umetnickih dela okupira svakog turistu i pruža neverovatno iskustvo.\r\n\r\nNeke od glavnih atrakcija koje morate obici u Madridu su Muzej Prado, Kraljevska palata, Plaza Major, Puerta del Sol, park Buen Retiro, Muzej arheologije, ali ima i još mnoštvo drugih koje vredi obici.\r\n\r\nMuzej Prado je prvoklasni muzej sa više od 5.000 slika koji može da parira Luvru u Parizu. U njemu se mogu naci slike iz 12. veka pa sve do 19. veka, a mnoge od njih su cuvena umetnicka dela. U muzeju se nalazi cak 140 slika španskog slikara Fransiska Goje. Muzej je toliko obiman da se jednostavno ne može obici u jednom danu.\r\nKraljevska palata je španska verzija Versaja koju je sagradio Filip V u 18. veku. Maestralna neoklasicna fasada sa jonskim i dorskim stubovima je zasnovana na crtežima koje je Bernini prvobitno namenio za Luvr, a u balustradi se nalaze španski kraljevi', '2019-03-11 00:00:00', '2019-03-11 17:35:36', 1, 1, 0, 1),
(2, 'Barselona', 'Barselona je drugi po naseljenosti grad u Španiji i prestonica autonomne pokrajine Katalonija. Sama Barselona broji oko 1,6 miliona stanovnika, a sa okolnim oblastima ima ukupno 3 miliona stanovnika.', 'Barselona je najveca metropola na Sredozemnom moru, nalazi se na obali izmedu reka Ljobrega i Besos, a na zapadu je \r\nogranicena planinskim vencem Sera de Kolserola. Ona je danas vodece svetsko turisticko, ekonomsko, kulturno i modno \r\nodredište.\r\nBazilika Sagrada Familija je jedna od najnekonvecionalnijih crkava u Evropi, ali i najposecenija atrakcija u\r\n Barseloni. Ona se nalazi u severnom delu grada gde dominira sa svojih 18 uvrnutih tornjeva.\r\n Izgradnju bazilike je zapoceo Antonio Gaudi 1883. godine koji je dobio zadatak da projektuje neogotsku crkvu. \r\nMedutim, on nije pratio planove vec je napravio nadrealnu gradevinu koju možemo videti danas. \r\nIako je on predvideo da ce se crkva graditi 10-15 godina, ona ni dan-danas nije završena.', '2019-03-11 00:00:00', NULL, 2, 1, 1, 2),
(3, 'Valensija', 'Valensija je prestonica autonomne zajednice Valensija i treci po velicini grad u Španiji posle Madrida i Barselone. Luka Valensije je peta najzauzetija luka u Evropi i najzauzetija luka na Sredozemnom moru.', 'Trgovi Valensije su prepuni života, a crkve poseduju neverovatne kupole koje ce vam oduzeti dah. Spomenici i arhitektura Valensije ce vas bez sumnje oduševiti.\r\n\r\nNajpoznatija gradevina Valensije je La Lonja de Seda, gotska gradevina iz 15. veka koja je napravljena posebno za razmenu svile. Ovo je jedan od najboljih primera gotske civilne arhitekture u Evropi, a fasada je bogato ukrašena hodnicima, dekorativnim prozorima i grotesknim ukrasima. Turisti se mogu popeti na vrh tornja odakle se pruža zapanjujuc pogled.', '2019-03-11 00:00:00', '2019-03-11 00:00:00', 31, 1, 0, 3),
(4, 'Malaga', 'Malaga je veliki grad na jugu Španije, i jedan je od najvažnijih turistickih destinacija u \r\nŠpaniji, Evropi i Mediteranu.', 'Malaga je glavni grad i geografsko središte na Kosti del Sol, \r\nturistickoj zoni koja se proteže od Nerhe do Manilve.\r\nMalaga je rodni grad cuvenog slikara Pabla Pikasa. Grad prepun carolija i \r\nkosmopolitizma, a prostire se od jednog lepog malog zaliva na jugu Andaluzije. \r\nPrivilegovana suncem koje gotovo neprekidno greje i spektakularnom svetlošcu, ona je grad \r\nvelikih avenija, sa drvoredima palmi, intenzivnim nocnim životom, važnim muzejima,\r\ni izvrsnim restoranima ribljih specijaliteta svih vrsta.\r\n', '2019-03-11 15:34:41', '2019-03-11 00:00:00', 34, 5, 0, 4),
(6, 'Sevilja', 'Sevilja je prestonica Andaluzije, kulturni i finansijski centar južne Španije. Grad ima nešto preko 700.000 stanovnika i glavno je turisticko odredište u Andaluziji..', 'Posetioci Sevilje bi trebalo da kupe Sevilja karticu dizajniranu za istraživanje grada uz uštedu. Ta kartica obuhvata slobodan ulaz u brojne muzeje i omogucava neograniceno korišcenje gradskog prevoza.\r\n\r\nKatedrala Sevilje je treca po velicini crkva u svetu nakon crkve Svetog Petra u Rimu i crkve Svetog Pavla u Londonu, a prva po zapremini. Ova katedrala iz 15. veka se nalazi na mestu nekadašnje džamije koja je sagradena krajem 12. veka. Centralni deo crkve se uzdiže na cak 37 metara i obuhvata površinu od 11.520 kvadratnih metara. U ovoj katedrali se nalaze ostaci Kristofera Kolumba. U sklopu katedrale se nalazi toranj La Giralda koji je prvobitno bio minaret džamije, a sada je zvonik katedrale.\r\n', '2019-03-11 00:00:00', '2019-03-11 00:00:00', 15, 5, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `rezultat`
--

CREATE TABLE `rezultat` (
  `idRezultat` int(11) NOT NULL,
  `idAnketa` int(11) NOT NULL,
  `idOdgovor` int(11) NOT NULL,
  `rezultat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rezultat`
--

INSERT INTO `rezultat` (`idRezultat`, `idAnketa`, `idOdgovor`, `rezultat`) VALUES
(1, 1, 1, 2),
(2, 1, 2, 0),
(3, 1, 3, 0),
(4, 2, 4, 1),
(6, 2, 6, 0),
(7, 3, 7, 1),
(8, 3, 8, 0),
(9, 3, 9, 0),
(10, 2, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `slika`
--

CREATE TABLE `slika` (
  `idSlika` int(11) NOT NULL,
  `alt` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `putanja` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slika`
--

INSERT INTO `slika` (`idSlika`, `alt`, `putanja`) VALUES
(1, 'madrid', '/img/madrid.jpg'),
(2, 'barselona', '/img/barselona.jpg'),
(15, 'sevilja', '/img/sevilja.jpg'),
(31, 'valensija', '/img/valensija.jpg'),
(34, 'Malaga', '/img/malaga.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `idUloga` int(11) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`idUloga`, `naziv`) VALUES
(1, 'admin'),
(2, 'korisnik');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anketa`
--
ALTER TABLE `anketa`
  ADD PRIMARY KEY (`idAnketa`);

--
-- Indexes for table `galerija`
--
ALTER TABLE `galerija`
  ADD PRIMARY KEY (`idGalerija`);

--
-- Indexes for table `glasanje`
--
ALTER TABLE `glasanje`
  ADD PRIMARY KEY (`idGlasanje`);

--
-- Indexes for table `kategorija`
--
ALTER TABLE `kategorija`
  ADD PRIMARY KEY (`idKategorije`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`idKomentar`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`idKorisnik`);

--
-- Indexes for table `meni`
--
ALTER TABLE `meni`
  ADD PRIMARY KEY (`idMeni`);

--
-- Indexes for table `odgovor`
--
ALTER TABLE `odgovor`
  ADD PRIMARY KEY (`idOdgovor`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`idPost`);

--
-- Indexes for table `rezultat`
--
ALTER TABLE `rezultat`
  ADD PRIMARY KEY (`idRezultat`);

--
-- Indexes for table `slika`
--
ALTER TABLE `slika`
  ADD PRIMARY KEY (`idSlika`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`idUloga`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anketa`
--
ALTER TABLE `anketa`
  MODIFY `idAnketa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `galerija`
--
ALTER TABLE `galerija`
  MODIFY `idGalerija` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `glasanje`
--
ALTER TABLE `glasanje`
  MODIFY `idGlasanje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kategorija`
--
ALTER TABLE `kategorija`
  MODIFY `idKategorije` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `idKomentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `idKorisnik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `meni`
--
ALTER TABLE `meni`
  MODIFY `idMeni` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `odgovor`
--
ALTER TABLE `odgovor`
  MODIFY `idOdgovor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `idPost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rezultat`
--
ALTER TABLE `rezultat`
  MODIFY `idRezultat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `slika`
--
ALTER TABLE `slika`
  MODIFY `idSlika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `idUloga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
