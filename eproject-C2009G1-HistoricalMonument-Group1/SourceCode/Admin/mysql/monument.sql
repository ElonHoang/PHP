-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.18-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for historical_monuments
CREATE DATABASE IF NOT EXISTS `historical_monuments` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `historical_monuments`;

-- Dumping structure for table historical_monuments.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table historical_monuments.admin: ~2 rows (approximately)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`username`, `password`, `fullname`, `address`, `phone`, `email`) VALUES
	('dev', '0fc42b563bcad000336b195a172aab46031ca145', 'vu minh hieu', '99 hang buom', '0985874070', 'hieudz1234566@gmail.com'),
	('pecklo', 'eb170ef15e975f97a59fdd79fe029aea6a9a1534', 'vu minh hieu', '99 hang buom', '0985874070', 'hieudz1234566@gmail.com');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table historical_monuments.continents
CREATE TABLE IF NOT EXISTS `continents` (
  `continentid` int(11) NOT NULL AUTO_INCREMENT,
  `continentname` varchar(50) NOT NULL,
  PRIMARY KEY (`continentid`),
  UNIQUE KEY `continentname` (`continentname`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table historical_monuments.continents: ~5 rows (approximately)
/*!40000 ALTER TABLE `continents` DISABLE KEYS */;
INSERT INTO `continents` (`continentid`, `continentname`) VALUES
	(5, ' North Pole'),
	(4, 'America'),
	(1, 'Asia'),
	(3, 'Australia'),
	(2, 'Europe');
/*!40000 ALTER TABLE `continents` ENABLE KEYS */;

-- Dumping structure for table historical_monuments.feedback
CREATE TABLE IF NOT EXISTS `feedback` (
  `feedbackid` int(11) NOT NULL AUTO_INCREMENT,
  `sendername` varchar(50) NOT NULL,
  `comment` varchar(2000) NOT NULL,
  `visible` varchar(3) NOT NULL,
  `monumentid` int(11) NOT NULL,
  PRIMARY KEY (`feedbackid`),
  KEY `monumentid` (`monumentid`),
  CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`monumentid`) REFERENCES `monuments` (`monumentid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table historical_monuments.feedback: ~3 rows (approximately)
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` (`feedbackid`, `sendername`, `comment`, `visible`, `monumentid`) VALUES
	(1, 'vu minh hieu', 'bai viet nay hay qua', 'Yes', 1),
	(2, 'nguyen viet hoang', 'bai viet nay nhu shit', 'No', 1),
	(4, 'le viet back', 'nhom em lam bai tot day', 'Yes', 1);
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;

-- Dumping structure for table historical_monuments.gallery
CREATE TABLE IF NOT EXISTS `gallery` (
  `imgid` int(11) NOT NULL AUTO_INCREMENT,
  `embedlink` varchar(200) NOT NULL,
  `monumentid` int(11) DEFAULT NULL,
  PRIMARY KEY (`imgid`),
  KEY `monumentid` (`monumentid`),
  CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`monumentid`) REFERENCES `monuments` (`monumentid`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table historical_monuments.gallery: ~21 rows (approximately)
/*!40000 ALTER TABLE `gallery` DISABLE KEYS */;
INSERT INTO `gallery` (`imgid`, `embedlink`, `monumentid`) VALUES
	(1, 'IMG-607bb7caa9c5e5.67203050.jpg', 19),
	(2, 'IMG-607bb7d4df55c8.14327368.jpg', 19),
	(3, 'IMG-607bb7e10ee304.87099162.jpg', 20),
	(4, 'IMG-607bb7e873ceb6.26083981.jpg', 20),
	(5, 'IMG-607bb7f2cfbfe5.97354479.jpg', 21),
	(6, 'IMG-607bb7fbcf2fc5.25216701.jpg', 21),
	(7, 'IMG-607bb81148a863.82285085.jpg', 22),
	(8, 'IMG-607bb8231dde17.91998314.jpg', 1),
	(9, 'IMG-607bb830c27d00.90323881.jpg', 1),
	(10, 'IMG-607bb838f410b0.26523943.jpeg', 2),
	(11, 'IMG-607bb84a63daf5.16424805.jpg', 2),
	(12, 'IMG-607bb854795c33.23501177.jpg', 3),
	(13, 'IMG-607bb85be32263.88416443.jpg', 3),
	(14, 'IMG-607bb8669dfb87.09852069.jpg', 23),
	(15, 'IMG-607bb86d9be074.64308442.jpg', 23),
	(16, 'IMG-607bb87d6df5c3.26475755.jpg', 24),
	(17, 'IMG-607bb885d08922.63386584.jpg', 24),
	(18, 'IMG-607bb894d07e07.22173626.jpg', 12),
	(19, 'IMG-607bb8a1e69cd4.65141057.jpg', 12),
	(20, 'IMG-607bb8bb0f17b9.57878677.jpg', 17),
	(21, 'IMG-607bb8d03f2ba4.64899297.jpg', 17),
	(22, 'IMG-607bb8ddd31345.38718676.jpg', 18),
	(23, 'IMG-607bb8e44d1a11.85144383.jpg', 18),
	(24, 'IMG-607c3732bd3dd9.16345245.jfif', 22);
/*!40000 ALTER TABLE `gallery` ENABLE KEYS */;

-- Dumping structure for table historical_monuments.monuments
CREATE TABLE IF NOT EXISTS `monuments` (
  `monumentid` int(11) NOT NULL AUTO_INCREMENT,
  `monumentname` varchar(50) NOT NULL,
  `nation` varchar(60) NOT NULL,
  `worldwonder` varchar(3) NOT NULL,
  `detail` text NOT NULL,
  `history` text NOT NULL,
  `foundation` text NOT NULL,
  `recognition` text NOT NULL,
  `continentid` int(11) NOT NULL,
  PRIMARY KEY (`monumentid`),
  UNIQUE KEY `monumentname` (`monumentname`),
  KEY `continentid` (`continentid`),
  CONSTRAINT `monuments_ibfk_1` FOREIGN KEY (`continentid`) REFERENCES `continents` (`continentid`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table historical_monuments.monuments: ~11 rows (approximately)
/*!40000 ALTER TABLE `monuments` DISABLE KEYS */;
INSERT INTO `monuments` (`monumentid`, `monumentname`, `nation`, `worldwonder`, `detail`, `history`, `foundation`, `recognition`, `continentid`) VALUES
	(1, 'The great wall of china', 'China', 'Yes', 'The Great Wall has a total length of 21,196 km, the Great Wall has an average height of 7.8 meters and a width of about 4.6 - 9.1 meters so that 5-6 horses can run horizontally. they stretched from Liaodong in the east to Lop Lake in the west, from today\'s Sino-Russian border in the north to the Tao River (Taohe) in the south; along an arc roughly delineating the edge of the Mongolian steppe; The total stretches over 20,000 km (12,000 mi).', ' Chinese folk have still passed down the story of Meng Khuong Nu crying Truong Thanh. The story tells that, in the period of Tan Thuy Hoang, right on the wedding night, Manh Khuong Nu\'s husband was arrested by the court to build the Great Wall. In the winter, Manh Khuong Nu knitting clothes for her husband and went to find her husband to give clothes. Manh Khuong Nu traveled the length of the Truong Thanh, inquiring about many people and finally received the news that his husband was dead, buried under the Truong Thanh. She cried bitterly for 3 days 3 nights, water mixed with blood. Manh Khuong\'s cry resounded 800 miles away from the Truong Thanh, collapsing a section of the citadel, revealing his husband\'s corpse. After finishing her funeral, she committed suicide.', 'The Great Wall of today was built in the Ming Dynasty, starting around 1368 and ending around 1640. An estimated 25,000 watchtowers were built along the wall. In a passage in the Koran, Arab geographers also associate Alexander the great with the con', 'The Great Wall was recognized by UNESCO as a world heritage site in 1987', 1),
	(2, 'Petra', 'Jordan', 'Yes', 'The road to the city is through a 1.2 km (0.75 mi) long gorge called Siq, which leads to Khazneh. Famous for its architectural stone and plumbing, Petra is also known as "The City of Roses" because of the color of the rock from which it was carved, the area is: 264km of square, due to the height of 810.', 'The Nabataeans is an in some of a Lac nomad Bedouin roam the Arabian desert and move with their herds wherever they can find meadows and water. Although Nabataean was originally embedded in Aramaic culture, the hypothesis of their work with Aramean origin has been rejected by many modern scholars. Instead, by stock antiques, religion and language confirm that they are an Arab tribe to the north. Evidence shows that the Nabataean name for Petra is Raqēmō, which is spelled differently in inscriptions as rqmw or rqm.', '5th century BC', 'recognized by UNESCO as a World Heritage Site since 1985', 1),
	(3, 'Taj Mahal', 'India', 'Yes', 'Area of ​​17ha, height 73m (240ft), Basic structure as a large cube for the angle of VAT creating into a structured with equal eight faces have of length between 55 meters (180 ft) on each of the four long edges. Each side of Iwan is framed with an uncomfortable pishtaq or covered archway with two similarly shaped balconies stacked on the sides.', 'The Taj Mahal commissioned by Shah Jahan in 1631, built to commemorate his wife Mumtaz Mahal, who passed away on June 17, giving birth to their 14th child , Gauhara Begum. Construction began in 1632 and the mausoleum was completed in 1648, while the surrounding buildings and gardens were completed five years later. The court record of Shah Jahan\'s grief after Mumtaz Mahal\'s death illustrates the love story considered as the inspiration for Taj Mahal.', 'Construction of the Taj Mahal began in Agra shortly after the death of Queen Mahal Mumtaz. Construction work began in 1632 and the Taj Mahal was built over a period of 16 years, employing 20,000 workers. It was completed in 1648.', 'The Taj Mahal was recognized by UNESCO as a World Heritage Site in 1983 for being "the jewel of Islamic art in India and one of the world\'s masterpieces admired worldwide"', 1),
	(12, 'Lascaux', 'France', 'No', 'These original caves are located in the Black Périgord region in the Vézère valley, in Montignac commune, Dordogne province. It is located about 40 km southeast of the provincial capital of Périgueux and about 25 km from the commune Sarlat-la-Canéda.', 'a cave system in southwestern France, famous for its cave drawings. These include the most famous works of the Late Paleolithic period. These paintings are estimated to be 16,000 years old. They consist mainly of depictions of large animals, most of which are known for fossil evidence that existed in that area and at that time.', '12/09/1940', 'Lascaux became a UNESCO World Heritage Site in 1979', 2),
	(17, 'The roman colosseum ', 'italy', 'Yes', 'The dimensions of the Colosseo: 48 m high, 189 m long, 156 m wide.\r\nUnlike the previous arenas, this structure was a free standing structure, built on a level ground rather than against a hill or natural depression. The outer wall was initially 545 m in circumference and required 100,000 m of travertine rock held together by 300 tons of iron clamps. It can hold up to 50,000 to 80,000 people, and is so well designed that each person can get out of this building within minutes.', 'Construction of the Colosseum began under Emperor Vespasian around 70-72 AD, and was completed in 80 under Titus. It is then adjusted during the reign of King Domitian (81–96). The site chosen was a flat plot in a valley between the Caeli Hills and the Esquiline Hills and the Palatine Hills, between which a canal flowed through. By 62, the land was densely inhabited and abandoned after the Great Fire of Rome in AD 64, after which Nero took most of the area\'s land as his own territory. He built the monumental Domus Aurea on the site, in front of it he created an artificial lake surrounded by halls, gardens and gates. The existing Aqua Claudia sewer was enlarged to supply water for the area and the giant bronze Colosseum of Nero was built near the entrance of Domus Aurea.', 'Construction of the Colosseum began under Emperor Vespasian around 70-72 AD, and was completed in 80 under Titus. It is then adjusted during the reign of King Domitian (81–96).', 'Colosseum Colosseum is one of the 7 architectural wonders of the World recognized in 2007, it is known as Amphitheatrum Flavium in Latin or Anfiteatro Flavio in Italian, today the arena is called Colosseum. or Colosseo', 2),
	(18, ' Triumphal arch', 'Paris', 'No', '50 meters high, 45 meters wide, Works by sculptor François Rude, 11.6 meters high and 6 meters wide. The inner four-legged face of the Arc de Triomphe is decorated with reliefs depicting famous battles during the Revolution and the Empire.', 'In 1806, after the victory of Austerlitz, Emperor Napoleon Bonaparte decided to build on Étoile square a work honoring the army. The Arc de Triomphe was designed by architect Jean-François-Thérèse Chalgrin, inspired by ancient works, 50 meters high and 45 meters wide. After Jean-François-Thérèse Chalgrin, the successors to the construction were Louis-Robert Goust and Jean-Nicolas Huyot.', 'Originally built by Napoleon in 1806 in honor of the First Army of the French Empire, the Arc de Triomphe was completed in 1836, under the July Monarchy.', 'In 1989, Grande Arche was completed in the La Défense area, which is considered a new Arc de Triomphe, extending the Ax historique axis.\r\n(nam my)\r\n', 2),
	(19, 'Christ the Redeemer ', 'Brazil', 'Yes', 'Art Deco statue, 30 meters (98 ft) high, mounted on a 8 meter (26 ft) high pedestal, its arm span is 28 meters (92 ft) weighs 635 tons, located on top of Corcovado mountain 700 meters (2,300 ft), belongs to Tijuca Forest National Park towards the city citadel', 'The idea of building a large statue on top of Corcovado was first proposed in the mid-1850s, when Father Pedro Maria Boss proposed placing a Christian monument on Corcovado Mountain in honor of Princess Isabel, the regent princess of Brazil and the son of Emperor Pedro II; Princess Isabel did not follow the request. In 1889, the country became a republic, the idea was abolished with the formal separation of state and church.', 'was built from 1922 to 1931', 'In October 2006, on the 75th anniversary of the completion of the statue, Archbishop Eusebio Oscar Scheid dedicated a small church below the statue, named after Brazil\'s patron saint, the epiphany. . This allows members to celebrate baptism and wedding here', 4),
	(20, 'Machu Picchu', 'Peru', 'Yes', 'Machu Picchu is 70 km northwest of Cusco, on the top of Mount Machu Picchu, at an altitude of about 2,350 meters above sea level, area 325.92 kilometers', 'It is believed that the city was built by Sapa Inca Pachacuti, starting around 1440, and was uninhabited until the Spanish Conquest of Peru in 1532. Archaeological evidence (plus studies recent early colonial texts) indicate that Machu Picchu was not an ordinary city, but rather a resort town of the Inca nobility (similar to the Roma Villages). There is a large palace and temples devoted to the Inca gods surrounding a courtyard, with other structures for the servants. It is estimated that no more than 750 people lived in Machu Picchu at the same time, and perhaps only a small fraction of them lived there during the rainy season and when no nobles were there.', 'The Incas built this residence around 1450 but it was abandoned only a century later by the time Spain conquered South America.', 'was declared a historic site of Peru in 1981 and a UNESCO World Heritage Site in 1983, In 2007, Machu Picchu was voted as one of the New Seven Wonders of the World', 4),
	(21, 'Obelisco de Buenos Aires ', 'Argentina', 'No', 'Its height is 67.5 meters (221 ft), and 63 meters (207 ft) of these up to the beginning of the peak, is 3.5 x 3.5 meters (11 x 11 ft). The tip is blunt, measuring 40 cm (16 in) in size and ending with a lightning rod that cannot be seen because of its height; Its cables run through the inside of the turret.', 'It was designed by architect Alberto Prebisch (one of the main architects of modern Argentineism, who also designed Teatro Gran Rex, in Corrientes and Suipacha) at the request of Mayor Mariano. de Vedia y Miter (appointed by President Agustín Pedro Justo). To build it, costing 200,000 pesos moneda nacional, 680 cubic meters (24,000 cu ft) of concrete and 1,360 square meters (14,600 square meters) of Olaen white stone from Córdoba were used.', 'Construction began March 20, 1936, and was completed on May 23 of the same year', 'On 1 November 2005, it was announced that a comprehensive restoration, sponsored by the Argentine Paint and Restoration Industry Association (Ceprara), was completed.', 4),
	(22, 'Chichén Itzá', ' Mexico', 'Yes', 'Chichen Itza was a major economic center of the lowlands north of Maya at its peak. Participating in the maritime trade route around the peninsula through the port at Isla Cerritos, Chichen Itza is able to access resources not in the region from as far away as central Mexico (obsidian) and South Central America (gold)', 'Chichen Itza is located in the eastern part of Yucatán state in Mexico The northern part of the Yucatán peninsula is arid, and the rivers run underground. As there are no rivers in the northern region of Yucatán, the three natural sinks (low-lying ponds) become the year-round water supply for Chichen and become an attractive spot for residents. Two of the three sunken ponds still exist today; The "pond of sacrifice" is the more famous pond, and it was dedicated to the sacrifice of the rain god Maya, Chaac', 'Chichen Itza emerged as a prominent area in the region around the end of the Early Classical period (or, c. 600 AD).', 'In 1961 and 1967 the sacred pond was excavated again, this time under the direction of the Mexican National Institute of Anthropology and History (INAH). Since the 1980s, INAH has excavated and restored many other structures.', 4),
	(23, 'Sydney Harbour Bridge', 'Australia', 'No', 'However, just as Lang was about to cut the ribbon, a man in military uniform rode up on a horse, slashing the ribbon with his sword and opening the Sydney Harbour Bridge in the name of the people of New South Wales before the official ceremony began. He was promptly arrested The ribbon was hurriedly retied and Lang performed the official opening ceremony and Game thereafter inaugurated the name of the bridge as \'Sydney Harbour Bridge\' and the associated roadway as the \'Bradfield Highway\'. After they did so, there was a 21-gun salute and an RAAF flypast. The intruder was identified as Francis de Groot. He was convicted of offensive behaviour and fined £5 after a psychiatric test proved he was sane, but this verdict was reversed on appeal. De Groot then successfully sued the Commissioner of Police for wrongful arrest and was awarded an undisclosed out of court settlement. De Groot was a member of a right-wing paramilitary group called the New Guard, opposed to Lang\'s leftist policies and resentful of the fact that a member of the Royal Family had not been asked to open the bridge De Groot was not a member of the regular army but his uniform allowed him to blend in with the real cavalry. This incident was one of several involving Lang and the New Guard during that year', 'In 1900, the Lyne government committed to building a new Central railway station and organised a worldwide competition for the design and construction of a harbour bridge. Local engineer Norman Selfe submitted a design for a suspension bridge and won the second prize of £500. In 1902, when the outcome of the first competition became mired in controversy, Selfe won a second competition outright, with a design for a steel cantilever bridge. The selection board were unanimous, commenting that, "The structural lines are correct and in true proportion, and... the outline is graceful" However due to an economic downturn and a change of government at the 1904 NSW State election construction never began', 'In 1914 John Bradfield was appointed "Chief Engineer of Sydney Harbour Bridge and Metropolitan Railway Construction", and his work on the project over many years earned him the legacy as the "father" of the bridge.', ': On 19 January 1932, the first test train, a steam locomotive, safely crossed the bridge. Load testing of the bridge took place in February 1932, with the four rail tracks being loaded with as many as 96 steam locomotives positioned end-to-end. The bridge underwent testing for three weeks, after which it was declared safe and ready to be opened The construction worksheds were demolished after the bridge was completed, and the land that they were on is now occupied by Luna Park.', 3),
	(24, 'Shrine of Remembrance', ' Austraylia', 'No', 'The foundation stone was laid on 11 November 1927, by the Governor of Victoria, Lord Somers.] Although both the Victorian and Commonwealth governments made contributions, most of the cost of the Shrine (£160,000 out of a total of £250,000; equating to about £ 9.6 million out of £ 15 million in 2021) was raised in less than six months by public contributions, with Monash as chief fundraiser. \r\nMonash, who was also an engineer, took personal charge of the construction which began in 1928 and was handled by the contractors Vaughan & Lodge Monash died in 1931, before the Shrine was finished, but the Shrine was the cause "closest to his heart" in his later years. \r\nWork was finally completed in September 1934, and the Shrine was formally dedicated on 11 November 1934 by the Duke of Gloucester, witnessed by a crowd of over 300,000 people—a "massive turnout" given that Melbourne\'s population at the time was approximately 1 million and, according to Carl Bridge, the "largest crowd ever to assemble in Australia to that date"\r\n', '\r\nThe Shrine went through a prolonged process of development, which began in 1918 with an initial proposal to build a Victorian memorial. Two committees were formed, the second of which ran a competition for the memorial\'s design. The winner was announced in 1922. However, opposition to the proposal, led by Keith Murdoch and The Herald, forced the governments of the day to rethink the design. A number of alternatives were proposed, the most significant of which was the ANZAC Square and cenotaph proposal of 1926. In response, General Sir John Monash used the 1927 ANZAC Day march to garner support for the Shrine, and finally won the support of the Victorian government later that year. The foundation stone was laid on 11 November 1927, and the Shrine was officially dedicated on 11 November 1934', 'The foundation stone was laid on 11 November 1927, by the Governor of Victoria, Lord Somers. Although both the Victorian and Commonwealth governments made contributions, most of the cost of the Shrine (£160,000 out of a total of £250,000; equating to about £ 9.6 million out of £ 15 million in 2021) was raised in less than six months by public contributions,with Monash as chief fundraiser.', ' In 2012 the Victorian Government announced that $22.5 million would be allocated to redevelop the Shrine\'s undercroft and extend it to the south. The new exhibition space, known as the "Galleries of Remembrance", was opened on Remembrance Day in 2014. A lifeboat from the ship SS Devanha, deployed during the landing at Anzac Cove at the start of the Gallipoli Campaign in 1915, is a centrepiece of the new development', 3);
/*!40000 ALTER TABLE `monuments` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

