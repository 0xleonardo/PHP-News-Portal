-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 12, 2022 at 03:12 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `franceinfo`
--

-- --------------------------------------------------------

--
-- Table structure for table `clanak`
--

CREATE TABLE `clanak` (
  `id` int(11) NOT NULL,
  `autor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datum` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `naslov` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kratki_sadrzaj` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sadrzaj` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slika` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `arhiva` tinyint(1) NOT NULL,
  `kategorija` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clanak`
--

INSERT INTO `clanak` (`id`, `autor`, `datum`, `naslov`, `kratki_sadrzaj`, `sadrzaj`, `slika`, `arhiva`, `kategorija`) VALUES
(12, '', '28.05.2022', 'PROMIJENIO SAM', 'Split je potpisao trogodišnji ugovor s nadarenim juniorom Marinom Dubravčićem, 206 cm', 'U petak u 18 sati košarkaši Splita i Zadra započinju polufinalnu seriju doigravanja za prvaka Hrvatske. Prošlogodišnji finalisti prvenstva i kupa sastaju se ove godine u polufinalu, a Split se nada da će ovoga puta oni biti bolji te da će proći u finale.\r\n\r\n- Nema velikih nepoznanica među nama, sigurno da ćemo taktički i oni i mi biti spremni, kao i uvijek do sada. Odlučit će neki sitni detalji, tko bude imao manje pogrešaka i tko bude imao nekog inspiriranog pojedinca taj će slaviti.  Sve međusobne utakmice bile su dosta izjednačene, Zadar je bio malo bolji, a mi smo im to omogućili našim pogreškama, pogotovo u utakmicama na Gripama. Domaći teren do sada nije imao važnu ulogu, ali nadam se da će od sada imati, i da ćemo mi uz podršku naše publike doći do cilja.', 'img/uploads/milan.jpg', 0, 'sport'),
(13, '', '21.05.2022', 'Otvoren Svjetski kup', 'Oleksej Špak osvajao je sa ukrajinskim Torpedom četiri prethodna izdanja Svjetskog kupa', 'Spektakularnim otvaranjem i defileom oko 1000 sudionika u omiškom Sportskom centru Ribnjak započeo je peti po redu \"Cedevita svjetski kup rukometnih veterana\", natjecanje koje mnogi u rukometnom svijetu doživljavaju kao neslužbeno svjetsko veteransko prvenstvo.Plesačice i Dj podigli su nakon svečanog defilea atmosferu u dvorani do usijanja, svi su se sudionici vrlo brzo našili u klupku plesa, pjesme, radosti i dobrih vibracija, a slavlje je potrajalo i dugo nakon završetka ceremonije. Svi su sudionici toplo pozdravljeni, a posebno jedini predstavnik Ukrajine - Oleksej Špak - koji je u Omiš stigao sa svojom obitelji. Špak je bio dio vrlo uspješne ukrajinske momčadi Tornado, a ovoga puta kao poseban gost nastupa za slovačku momčad Nitra.', 'img/uploads/rukomet.jpg', 0, 'sport'),
(14, '', '21.05.2022', 'Kameni pogled Savagea', 'Dok je granica nove bridger kategorije 102 kilograma, oba su borca bila debelo ispod.', 'Očekujem još jedan nokaut, lagani nokaut. Neću ići boksati ni pokušavati nešto novo, samo ću ga pokušati pregaziti. Poštujem ga kao i on mene, ali ovo će mu biti drugi poraz u karijeri. Možda i posljednji jer sam nekima već završavao karijere, rekao je Alen Savage Babić (31, 10-0) na konferenciji za novinare dan prije vaganja, a onda se pojavio na posljednjem sučeljavanju prije meča i odradio sve bez problema. ', 'img/uploads/borba.jpg', 0, 'sport'),
(16, '', '21.05.2022', 'Predsjedniku doista nije lako', 'Pokazao je pismo koje je Milanović poslao NATO-u i rekao da su ga pisali njegovi suradnici', 'Predsjedniku doista nije lako, a da mu nije možda ni dobro ponekad, kazao je ministar vanjskih i europskih poslova Gordan Grlić Radman komentirajući pismo predsjednika Zorana Milanovića NATO-u, kao i njegove izjave. - On tu liježe uvijek i ustaje u mislima na Vladu, na HDZ, posebno na premijera, ministre i naravno na svakoga onoga tko ne plješće njegovom prostom uličnom vokabularu i uvredama. To pismo koje je krotkog karaktera, ako ste ga čitali, je jedan totalni kopernikanski obrat, zaokret. I zapravo demantira i govori o tome koliko je nepotrebna bila njegova halabuka, koliko su nepotrebne bile njegove poruke i vrijeđanja u javnom prostoru tih zemalja aplikantica, dakle Švedske i Finske. Zemalja koje su nas priznale prije trideset godina, zemlje s kojima uživamo i pokazujemo solidarnost jer to su zemlje članice Europske unije – visokodemokratske zemlje, visokih standarda - rekao je, prenosi', 'img/uploads/milan.jpg', 0, 'politika'),
(18, '', '21.05.2022', 'Počela ludnica na Maksimiru', 'Dinamo je osvojio naslov, no bez obzira što derbi ne donosi rezultatsku važnost, čast je čast.', 'Utakmica samo što nije počela, a južna tribina na Maksimiru zjapi prazna. Nema Torcide i, kako sada stvari stoje, neće je ni biti na današnjem derbiju.\r\n\r\nKako doznajemo, ne dopuštaju im unošenje rekvizita.\r\n\r\n- Redari ne dopuštaju unošenje bilo kakvih rekvizita osim šalova. Ni bubnjeve, ni transparente, ni megafon.... Kažu da je to naredba Dinama. Zbog toga vjerojatno neće nitko od nas ni ulaziti na tribine - saznajemo od navijača Hajduka ispred južne tribine.', 'img/uploads/torcida.jpg', 0, 'sport'),
(50, 'admin', '27.05.2022', 'Krovinovića žele u Bundesligi', 'Predstavnici Herthe već dulje vrijeme prate nastupe Filipa Krovinovića', 'Filip Krovinović mogao bi, već na ljeto, postati novi član Herthe. Njemački bundesligaš teškim je mukama, tek kroz dodatne kvalifikacije, osigurao ostanak u prvoligaškom društvu, pa su u Berlinu već krenuli s traženjem pojačanja za novu sezonu. A prvi \"pick\" Herthe danas je Filip Krovinović iza kojeg je prilično uspješna sezona u dresu Hajduka koju je okrunio trofejem Kupa', 'img/uploads/hajduk.jpg', 0, 'sport'),
(52, 'admin', '27.05.2022', 'Shorter najbolji strijelac', 'Ova nagrada potvrda je da se u našem klubu rade dobre stvari, ovo je nagrada za koju su svi zaslužni', 'Splitov Amerikanac Shanon Shorter najbolji je strijelac ABA lige u regularnom dijelu sezone i tim mu je povodom danas direktor ABA lige Dubravko Kmetović uručio posebno priznanje. Shorter je u  protekloj sezoni odigrao svega 14 susreta u žutom dresu, no postigao je 238 koševa, u prosjeku 17 po susretu, a tome je dodao 5.9 skokova i 3.2 asistencije i 1.6 ukradene lopte.\r\n\r\n- S velikim veseljem i ponosom uručujemo gospodinu Shorteru trofej za najboljeg strijelca lige u regularnom dijelu sezone. Naša liga je najveće regionalno natjecanje i svaki trofej ima posebnu težinu. Možda košarka nije u Hrvatskoj trenutno na najvišem nivou ali time je i značajnije što je dobitnik priznanja jedan igrač iz hrvatskog kluba. Čestitam i Splitu na opstanku u ABA ligi, veselimo se što će se i sljedeću sezone ovdje igrati utakmice ABA lige. Posebno nam je zadovoljstvo što smo u dvorani kluba koji je osvojio tri uzastopna naslova prvaka Europe - kazao je Kmetović, a poslije njega je govorio Shorter', 'img/uploads/kosarka.jpg', 0, 'sport'),
(53, 'admin', '27.05.2022', 'Užas na Roland Garrosu', 'Ne znam kako sam se onesvjestio. Sjećam se samo da me je trener podigao.', 'Nevjerojatna priča dolazi nam iz Pariza, točnije Roland Garrosa! Naime, argentinski tenisač Camilo Ugo Carabelli (ATP - 155.) doživio je nezgodu u hotelskoj sobi, a ni sam ne zna što se točno dogodilo?!\r\n\r\nCarabelli je u prvom kolu senzacionalno slavio protiv favoriziranog Aslana Karaceva nakon čega je pronađen u hotelskoj sobi kako leži bez svijesti u lokvi krvi!\r\n\r\n- Stvarno se ne sjećam ničega, ne znam kako sam se onesvijestio. Sjećam se samo da me je trener podigao, a moje lice je bilo puno krvi. Vidio sam tragove udarca na ramenu i na zidu, tako da pretpostavljam da sam u padu ramenom udario u zid, a potom glavom u pod- otkrio je Argentinac nakon poraza u drugom kolu.\r\n\r\n\r\n', 'img/uploads/tenis.jpg', 0, 'sport'),
(55, '0xleonardo', '27.05.2022', 'OIB je ušao u punu primjenu', 'Vlada je u saborsku proceduru uputila prijedlog o prestanku važenja Zakona o matičnom broju građana', 'Ovim prijedlogom se predlaže prestanak važenja Zakona o o matičnom broju, poručio je ministar unutarnjih poslova Davor Božinović na sjednici Vlade s koje su prijedlog i uputili u saborsku proceduru. \r\n\r\n- S određivanjem jedinstvenog matičnog broja građana započelo se 1982. prema tada važećem Zakonu, a koristio se do 1. siječnja 2003., otkad se koristi termin matični broj građana. Danom prestanka važenja Zakona o matičnom broju prestat će se određivati matični brojevi građana i na taj način će se ukinuti ta identifikacijska oznaka za kojom nakon ulaska u punu primjenu osobnog identifikacijskog broja (OIB) ne postoji potreba - dodao je Božinović. \r\n\r\nMatični brojevi građana koji su određeni do dana prestanka Zakona, dodao je, neće se brisati iz evidencije te će se moći koristiti za povezivanje i razmjenu podataka u onim slučajevima kada se povezivanje neće moći izvršiti korištenjem OIB-a.\r\n\r\n- Međutim, ne kao osnovna i stalna identifikacijska oznaka građanina, već kao kontrolni mehanizam - istaknuo je.', 'img/uploads/bozo.jpg', 0, 'politika'),
(62, 'admin', '04.06.2022', 'Perišić je sve bliže prelasku', 'Iako su mu 33 godine, Perišić je u životnoj formi te je najbolje ocijenjeni Hrvat u ligama petice.', '\"Perišić je spreman prihvatiti dvogodišnji ugovor. Hrvatski krilni igrač stvarno je blizu prelaska u Spurse, samo se čeka da to kaže vodstvu Intera\", objavio je Romano dodavši da pregovori traju od ponedjeljka te se istima bliži kraj. ', 'img/uploads/perisic.jpg', 0, 'sport'),
(70, 'admin', '08.06.2022.', 'Damir Vanđelić udara na vrh', 'Ovih dana Vanđelić predstavlja svoju udrugu ZRIN, koju analitičari vide kao zametak nove Vlade.', 'Premijer je opsjednut podacima o rejtingu, kažu ljudi iz njegove blizine. Već u zoru dobije sve novine, odnosno sve članke koji govore o njemu. Prije mu je analize radio pokojni otac, ali sad ih radi sam. Opsesivno se', 'img/uploads/milan2.jpg', 0, 'politika'),
(74, 'leo', '09.06.2022.', 'Boston - NBA naslov', 'Celticsi su tako poveli 2-1 u finalnoj seriji, sljedeći susret za dva dana', 'Nakon 12 godina čekanja, finale NBA lige vratilo se u legendarni TD Garden. Bila je to paklena atmosfera pred više od 19 tisuća ljudi koji su godinama sanjali ovaj trenutak i povratak među elitu nakon dugogodišnjeg lutanja pa onda i slaganja ove momčadi. I na krilima masovnog vjetra u leđa Boston je na svome terenu pobijedio Golden State Warriorse 116-110 i poveo 2-1 u finalnoj seriji!\r\n\r\nCelticsi su vodili veći dio utakmice, a u treću četvrtinu ušli su s prednošću od plus 14. Sjajnom obranom limitirali ih na 56 koševa, dok je u napadu ulazilo baš sve. Na poluvremenu je bilo 70-56.', 'img/uploads/boston.jpg', 0, 'sport'),
(75, 'leo', '12.06.2022.', 'Liga Plenkijevih uhljeba', 'Premijer Plenković seu Vladi i stranci, okruživao ljudima koji nemaju svoju političku težinu', 'Potpuno podređeni stranačkom i državnom vladaru\r\n\r\nDa se malo razumijemo. Kakav je tko - nema toga. Da mi je ne znam što u životu, da će mi diktirati ritam što ćemo raditi, tko će biti u Vladi a tko ne. Ne postoji taj akter, “grmio” je nedavno premijer Andrej Plenković', 'img/uploads/plenki.jpg', 0, 'politika');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prezime` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `korisnicko_ime` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lozinka` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `razina` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `korisnicko_ime`, `lozinka`, `razina`) VALUES
(2, 'admin', 'admin', 'admin', '$2y$10$B6ygNoGUQlU35RNZpaEVHuygLNCHHZ/pMxdyxVVuUTG/uzQJiWJcu', 2),
(11, 'Leonardo', 'Štavalj-Ladišić', 'leo', '$2y$10$m3.lYwZme0e8dhbS1z3uQ..ADou8mHbKLA71WDArrqV09rNEM6VWW', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clanak`
--
ALTER TABLE `clanak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `korisnicko_ime` (`korisnicko_ime`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clanak`
--
ALTER TABLE `clanak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
