/*
SQLyog Ultimate v11.33 (32 bit)
MySQL - 5.6.15-log : Database - museum_tiket
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`museum_tiket` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `museum_tiket`;

/*Table structure for table `tmdiskon` */

DROP TABLE IF EXISTS `tmdiskon`;

CREATE TABLE `tmdiskon` (
  `id_diskon` varchar(4) NOT NULL,
  `nama_diskon` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `jumlah_diskon` varchar(4) NOT NULL,
  PRIMARY KEY (`id_diskon`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `tmloket` */

DROP TABLE IF EXISTS `tmloket`;

CREATE TABLE `tmloket` (
  `id_loket` varchar(4) NOT NULL COMMENT 'Identitas Loket',
  `nama_loket` varchar(25) NOT NULL COMMENT 'Nama Loket',
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT 'Status Loket',
  PRIMARY KEY (`id_loket`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `tmpengunjung` */

DROP TABLE IF EXISTS `tmpengunjung`;

CREATE TABLE `tmpengunjung` (
  `id_pengunjung` int(3) NOT NULL AUTO_INCREMENT,
  `nama_pengunjung` varchar(50) NOT NULL,
  PRIMARY KEY (`id_pengunjung`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `tmstaf` */

DROP TABLE IF EXISTS `tmstaf`;

CREATE TABLE `tmstaf` (
  `id_staf` varchar(5) NOT NULL,
  `nama_staf` varchar(50) NOT NULL COMMENT 'Nama Staf',
  `alamat_staf` text NOT NULL COMMENT 'Alamat Staf',
  `kota` varchar(10) NOT NULL COMMENT 'Kota Tempat Tinggal',
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `no_handphone` varchar(15) DEFAULT NULL,
  `role` enum('admin','loket','guide') NOT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '1' COMMENT 'Tidak Aktif, Aktif, Busy',
  `last_active` datetime DEFAULT NULL,
  PRIMARY KEY (`id_staf`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `tmtiket` */

DROP TABLE IF EXISTS `tmtiket`;

CREATE TABLE `tmtiket` (
  `id_tiket` varchar(3) NOT NULL,
  `nama_tiket` varchar(10) NOT NULL,
  `harga` int(9) NOT NULL,
  PRIMARY KEY (`id_tiket`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `tmwilayah` */

DROP TABLE IF EXISTS `tmwilayah`;

CREATE TABLE `tmwilayah` (
  `id_wilayah` varchar(12) NOT NULL,
  `asal_wilayah` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_wilayah`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `tttiket` */

DROP TABLE IF EXISTS `tttiket`;

CREATE TABLE `tttiket` (
  `id_transaksi` varchar(20) NOT NULL,
  `tgl_transaksi` datetime NOT NULL,
  `nama_pengunjung` varchar(50) NOT NULL,
  `id_wilayah` varchar(12) NOT NULL,
  `id_loket` varchar(4) NOT NULL,
  `id_staf` varchar(5) NOT NULL,
  `id_tiket` varchar(3) NOT NULL,
  `tot_tiket` int(2) NOT NULL,
  `id_diskon` varchar(4) NOT NULL,
  `id_guide` varchar(5) DEFAULT NULL,
  `tot_bayar` int(7) NOT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `id_wilayah` (`id_wilayah`),
  KEY `id_loket` (`id_loket`),
  KEY `id_staf` (`id_staf`),
  KEY `id_tiket` (`id_tiket`),
  CONSTRAINT `tttiket_ibfk_4` FOREIGN KEY (`id_tiket`) REFERENCES `tmtiket` (`id_tiket`),
  CONSTRAINT `tttiket_ibfk_1` FOREIGN KEY (`id_wilayah`) REFERENCES `tmwilayah` (`id_wilayah`),
  CONSTRAINT `tttiket_ibfk_2` FOREIGN KEY (`id_loket`) REFERENCES `tmloket` (`id_loket`),
  CONSTRAINT `tttiket_ibfk_3` FOREIGN KEY (`id_staf`) REFERENCES `tmstaf` (`id_staf`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
