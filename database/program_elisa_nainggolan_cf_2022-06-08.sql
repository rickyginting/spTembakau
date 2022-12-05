# ************************************************************
# Sequel Ace SQL dump
# Version 20033
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: localhost (MySQL 5.5.5-10.4.21-MariaDB)
# Database: program_elisa_nainggolan_cf
# Generation Time: 2022-06-08 12:28:52 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table tbl_diagnosa
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_diagnosa`;

CREATE TABLE `tbl_diagnosa` (
  `id_diagnosa` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(190) DEFAULT NULL,
  `jk` varchar(190) DEFAULT NULL,
  `alamat` varchar(190) DEFAULT NULL,
  `no_hp` varchar(190) DEFAULT NULL,
  `gejala` text DEFAULT NULL,
  `penyakit` text DEFAULT NULL,
  `nilai` float DEFAULT NULL,
  `proses_diagnosa` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_diagnosa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `tbl_diagnosa` WRITE;
/*!40000 ALTER TABLE `tbl_diagnosa` DISABLE KEYS */;

INSERT INTO `tbl_diagnosa` (`id_diagnosa`, `nama_lengkap`, `jk`, `alamat`, `no_hp`, `gejala`, `penyakit`, `nilai`, `proses_diagnosa`, `created_at`)
VALUES
	(3,'User 1','l','Alamat','081234567890','a:4:{i:0;s:3:\"G01\";i:1;s:3:\"G02\";i:2;s:3:\"G03\";i:3;s:3:\"G04\";}','a:1:{i:0;s:3:\"P02\";}',0.9762,'a:2:{s:3:\"P02\";d:0.976199999999999956656893118633888661861419677734375;s:3:\"P01\";d:0.80159999999999997921662497901706956326961517333984375;}','2022-06-07 16:25:11');

/*!40000 ALTER TABLE `tbl_diagnosa` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_gejala
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_gejala`;

CREATE TABLE `tbl_gejala` (
  `kode_gejala` varchar(190) NOT NULL,
  `nama_gejala` varchar(190) DEFAULT NULL,
  `nilai_mb` float DEFAULT NULL,
  `nilai_md` float DEFAULT NULL,
  `nilai_cf` float DEFAULT NULL,
  PRIMARY KEY (`kode_gejala`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `tbl_gejala` WRITE;
/*!40000 ALTER TABLE `tbl_gejala` DISABLE KEYS */;

INSERT INTO `tbl_gejala` (`kode_gejala`, `nama_gejala`, `nilai_mb`, `nilai_md`, `nilai_cf`)
VALUES
	('G01','Timbul lubang tidak beraturan',1,0,1),
	('G02','Terdapat bekas gigitan berwarna  putih',0.9,0.06,0.84),
	('G03','Daun lengket dan menggulung',0.85,0.02,0.83),
	('G04','Terdapat cendawa berwarna  putih',0.9,0.04,0.86),
	('G05','Tanaman layu tiba-tiba dan  akhirnya mati',0.6,0.04,0.56),
	('G06','Pangkal batang membusuk  berwarna cokelat',0.94,0.05,0.89),
	('G07','Muncul Bercak-bercak berwarna  kelabu pada daun dan batang',0.95,0.03,0.92),
	('G08','Daun dan batangnya lemah',0.8,0.04,0.76),
	('G09','Pembusukan pada leher akar  berwarna cokelat kehitaman',0.7,0.05,0.65),
	('G10','Menyerang pucuk dan daundaun muda sehingga berlubanglubang',0.9,0.07,0.83),
	('G11','Menggerek buah dan memakan  biji',0.75,0.05,0.7),
	('G12','Daun tembakau tidak tumbuh  besar/lebar',1,0.02,0.98),
	('G13','Daun tembakau kering',0.95,0.04,0.91),
	('G14','Tanaman tidak tumbuh normal  sehingga menyebabkan tanaman  kerdil',0.8,0.05,0.75),
	('G15','Terdapat bercak-bercak kuning  pada permukaan daun',1,0,1),
	('G16','Tepi daun melengkung ke atas',0.83,0.04,0.79),
	('G17','Daun tanaman mengkerut',0.93,0.03,0.9),
	('G18','Terjadi pembusukan semai yang  dekat dengan permukaan tanah',0.95,0.02,0.93),
	('G19','Terjadi pembusukan pada  pangkal batang',0.88,0.04,0.84),
	('G20','Terdapat bisul-bisul bulat pada  akar',1,0,1),
	('G21','Tanaman kerdil',0.85,0.04,0.81),
	('G22','Tanaman layu',0.7,0.06,0.64),
	('G23','Batang yang terinfeksi akan  mengering',1,0.02,0.98),
	('G24','Batang berwarna cokelat sampai  hitam seperti terbakar',0.9,0.03,0.87);

/*!40000 ALTER TABLE `tbl_gejala` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_login
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_login`;

CREATE TABLE `tbl_login` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(190) DEFAULT NULL,
  `password` varchar(190) DEFAULT NULL,
  `nama` varchar(190) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `tbl_login` WRITE;
/*!40000 ALTER TABLE `tbl_login` DISABLE KEYS */;

INSERT INTO `tbl_login` (`id`, `username`, `password`, `nama`)
VALUES
	(1,'admin','password','Admin Website');

/*!40000 ALTER TABLE `tbl_login` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_penyakit
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_penyakit`;

CREATE TABLE `tbl_penyakit` (
  `kode_penyakit` varchar(190) NOT NULL,
  `nama_penyakit` varchar(190) DEFAULT NULL,
  `definisi` text DEFAULT NULL,
  `solusi_mekanis` text DEFAULT NULL,
  `solusi_kimiawi` text DEFAULT NULL,
  PRIMARY KEY (`kode_penyakit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `tbl_penyakit` WRITE;
/*!40000 ALTER TABLE `tbl_penyakit` DISABLE KEYS */;

INSERT INTO `tbl_penyakit` (`kode_penyakit`, `nama_penyakit`, `definisi`, `solusi_mekanis`, `solusi_kimiawi`)
VALUES
	('P01','Ulat Daun','Ulat Daun merupakan jenis Hama yang menyerang tanaman tembakau, hama ini akan mengakibatkan daun tembakau habis secara perlahan, biasanya hama ini muncul saat musim hujan.','Mengumpulkan kelompok telur dan ulat dan membakar/memusnahkannya. Dapat melakukan penyemprotan insektisita.','Regent, Curacon'),
	('P02','Kutu Tembakau','Kutu tembakau merupakan jenis hama yang menyerang tanaman tembakau yang mengakibatkan daun lengket dan menggulung. Hama ini sering muncul pada tanaman tembakau saat musim hujan.','Mengurangi pemupukan, Memangkas daun yang terserang, Melakukan penyemprotan insektisida kimia.','Numectin 20 EC'),
	('P03','Penyakit Layu','Salah satu penyakit tanaman tembakau yang mengakibatkan tanaman mati secara perlahan. Penyakit ini menyerang tanaman tembakau saat musim kemarau','Melakukan penyiraman pada sekitar tanaman 3x seminggu, mencabut dan memusnahkan tanaman yang terserang, Melakukan pengecoran.','Trichoderma SP'),
	('P04','Lanas','Salah satu jenis penyakit yang disebabkan oleh jamur pada Phytophthora nicotianae pada tanaman tembakau jamur ini berkembang pada suhu berkisar 24oC-28oC. Penyakit ini menyerang tanaman tembakau saat musim panas.','Mencabut tanaman yang terserang dan membakarnya, Pemakaian pupuk organik kandang.','Pupuk Urea dan SP36'),
	('P05','Ulat Pucuk Daun','Ulat pucuk daun merupakan hama tanaman tembakau yang mengakibatkan bagian pucuk berlubang-lubang sehingga lambat laun tumbuhan tembakau tidak mengalami pertumbuhan dengan sempurna.','Ulat dikumpulkan lalu dimusnahkan, menggunakan virus patogen HaNPV, Menyemprot bagian pucuk tanaman.','Pestisida nabati, al.mimba'),
	('P06','Ulat Kaca','Ulat kaca merupakan hama yang menyebabkan daun tidak bertumbuh besar, hama ini muncul saat musim hujan tiba.','Memangkas bagian daun yang terserang. Menyemprotkan obat-obatan seperti insektisida dan fungisida','Insektisida dan Fungisida'),
	('P07','Penyakit Mosaik Tembakau','Mosaik tembakau merupakan penyakit pada tembakau yang menyebabkan daun mengalami bercak-bercak kuning dan lambat laun mengalami kelayuan','Pangkas tanaman terinfeksi. Menggunakan varietas tahan dan membasmi vektornya yaitu kutu.','Regent 50SC, Furadan 3GR'),
	('P08','Rebah Semai','Rebah Semai merupakan penyakit yang menyebabkan kematian pada budidaya tanaman tembakau. Penyakit ini menyerang tanaman semasa pembibitan.','Mengatur jarak tanaman dalam pembibitan (tidak terlalu rapat) serta pemberian naungan pada pembibitan dengan plastik tembus cahaya.','Fungisida campuran fludioxonil dan mefenomax'),
	('P09','Nematoda','Merupakan jenis hama yang menyerang tanaman tembakau mulai dari akar. Biasanya Hama jenis ini menyerang tanaman pada musim kemarau.','Membongkar mengumpulkan akar. Dapat dilakukan pencegaahan dengan pengolahan lahan yang baik, menjaga sanitasi lingkungan tanaman dan membersihkan gulma','Velum Prime, 400SC'),
	('P10','Hangus Batang','Hangus batang disebabkan oleh suatu jamur yang menyebabkan batang melemah dan mengering. Penyakit ini menyerang tanaman tembakau pada musim kemarau karena kekurangan kandungan air.','Cabut tanaman yang terserang dan bakar, melakukan pengecoran min 3x 1 minggu. Pencegahan dapat dilakukan dengan penyemprotan.','Antracol');

/*!40000 ALTER TABLE `tbl_penyakit` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_rule
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_rule`;

CREATE TABLE `tbl_rule` (
  `id_rule` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `kode_penyakit` varchar(190) DEFAULT NULL,
  `kode_gejala` varchar(190) DEFAULT NULL,
  PRIMARY KEY (`id_rule`),
  KEY `tbl_rule.kode_penyakit` (`kode_penyakit`),
  KEY `tbl_rule_kode_gejala` (`kode_gejala`),
  CONSTRAINT `tbl_rule.kode_penyakit` FOREIGN KEY (`kode_penyakit`) REFERENCES `tbl_penyakit` (`kode_penyakit`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_rule_kode_gejala` FOREIGN KEY (`kode_gejala`) REFERENCES `tbl_gejala` (`kode_gejala`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `tbl_rule` WRITE;
/*!40000 ALTER TABLE `tbl_rule` DISABLE KEYS */;

INSERT INTO `tbl_rule` (`id_rule`, `kode_penyakit`, `kode_gejala`)
VALUES
	(1,'P01','G01'),
	(2,'P01','G02'),
	(3,'P02','G03'),
	(4,'P02','G04'),
	(5,'P03','G05'),
	(6,'P03','G06'),
	(7,'P04','G07'),
	(8,'P04','G08'),
	(9,'P04','G09'),
	(10,'P05','G10'),
	(11,'P05','G11'),
	(12,'P06','G12'),
	(13,'P06','G13'),
	(14,'P06','G14'),
	(15,'P07','G15'),
	(16,'P07','G16'),
	(17,'P07','G17'),
	(18,'P08','G18'),
	(19,'P08','G19'),
	(20,'P09','G20'),
	(21,'P09','G21'),
	(22,'P09','G22'),
	(23,'P10','G23'),
	(24,'P10','G24');

/*!40000 ALTER TABLE `tbl_rule` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
