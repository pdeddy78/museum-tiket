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

/*Data for the table `tmdiskon` */

insert  into `tmdiskon`(`id_diskon`,`nama_diskon`,`keterangan`,`jumlah_diskon`) values ('DK01','Diskon 20%','Pengunjung > 40 orang','0.2'),('DK02','Diskon 10%','Pengunjung > 25 orang','0.10'),('DK03','Diskon Hari Pelajar','Diskon Hari Pelajar','0.12');

/*Table structure for table `tmloket` */

DROP TABLE IF EXISTS `tmloket`;

CREATE TABLE `tmloket` (
  `id_loket` varchar(4) NOT NULL COMMENT 'Identitas Loket',
  `nama_loket` varchar(25) NOT NULL COMMENT 'Nama Loket',
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT 'Status Loket',
  PRIMARY KEY (`id_loket`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tmloket` */

insert  into `tmloket`(`id_loket`,`nama_loket`,`status`) values ('LOK1','Loket Barat','0'),('LOK2','Loket Selatan','0'),('LOK3','Loket Tenggara','0');

/*Table structure for table `tmpengunjung` */

DROP TABLE IF EXISTS `tmpengunjung`;

CREATE TABLE `tmpengunjung` (
  `id_pengunjung` int(3) NOT NULL AUTO_INCREMENT,
  `nama_pengunjung` varchar(50) NOT NULL,
  PRIMARY KEY (`id_pengunjung`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tmpengunjung` */

insert  into `tmpengunjung`(`id_pengunjung`,`nama_pengunjung`) values (1,'Pengunjung'),(2,'Instansi A'),(3,'Instansi B'),(4,'Instansi C');

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

/*Data for the table `tmstaf` */

insert  into `tmstaf`(`id_staf`,`nama_staf`,`alamat_staf`,`kota`,`username`,`password`,`no_handphone`,`role`,`status`,`last_active`) values ('STF01','Administrator','','Tangerang','root','d40c4acc66585a678066872a6be5685badd6aad1',NULL,'admin','1','2016-01-02 19:01:04'),('STF02','Sukarno','','Solo','sukarno','d40c4acc66585a678066872a6be5685badd6aad1','','loket','1','2015-12-07 06:12:30'),('STF03','Yanti','','Subang','yanti','f8f352b35605a2b68a4f2058722d6e3c067fbad3',NULL,'loket','1','2015-10-27 23:10:19'),('STF04','Tatang','Jalan Perumahan A RT08/01','Purwakarta','tatang','0efbe002edc322c9336dd5d846c562ae228d1932',NULL,'guide','1','0000-00-00 00:00:00');

/*Table structure for table `tmtiket` */

DROP TABLE IF EXISTS `tmtiket`;

CREATE TABLE `tmtiket` (
  `id_tiket` varchar(3) NOT NULL,
  `nama_tiket` varchar(10) NOT NULL,
  `harga` int(9) NOT NULL,
  PRIMARY KEY (`id_tiket`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tmtiket` */

insert  into `tmtiket`(`id_tiket`,`nama_tiket`,`harga`) values ('JT1','Umum',12000),('JT2','Pelajar',9000);

/*Table structure for table `tmwilayah` */

DROP TABLE IF EXISTS `tmwilayah`;

CREATE TABLE `tmwilayah` (
  `id_wilayah` varchar(12) NOT NULL,
  `asal_wilayah` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_wilayah`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tmwilayah` */

insert  into `tmwilayah`(`id_wilayah`,`asal_wilayah`) values ('domestik','Wisatawan Domestik'),('lokal','Wisatawan Lokal'),('mancanegara','Wisatawan Mancanegara');

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

/*Data for the table `tttiket` */

insert  into `tttiket`(`id_transaksi`,`tgl_transaksi`,`nama_pengunjung`,`id_wilayah`,`id_loket`,`id_staf`,`id_tiket`,`tot_tiket`,`id_diskon`,`id_guide`,`tot_bayar`) values ('TKT-20151025-0000001','2015-10-25 23:44:00','Pengunjung','lokal','LOK2','STF01','JT1',5,'','STF02',110000),('TKT-20151025-0000002','2015-10-25 23:59:00','Instansi A','domestik','LOK3','STF01','JT1',9,'','',108000),('TKT-20151026-0000003','2015-10-26 00:04:00','Pengunjung','lokal','LOK2','STF01','JT1',9,'','',108000),('TKT-20151026-0000004','2015-10-26 00:11:46','Instansi B','mancanegara','LOK3','STF01','JT1',20,'','',240000),('TKT-20151026-0000005','2015-10-26 00:16:00','Instansi A','lokal','LOK3','STF01','JT2',10,'','',85000),('TKT-20151026-0000006','2015-10-26 00:18:24','Instansi B','domestik','LOK3','STF01','JT2',7,'','',59500),('TKT-20151026-0000007','2015-10-26 18:00:25','Pengunjung','lokal','LOK3','STF01','JT2',42,'DK02','',321300),('TKT-20151026-0000008','2015-10-26 18:03:16','pengunjung','lokal','LOK3','STF01','JT1',45,'DK01','',432000),('TKT-20151206-0000009','2015-12-06 22:32:11','Instansi B','domestik','LOK1','STF01','JT1',45,'DK01','STF02',482000),('TKT-20160102-0000010','2016-01-02 15:36:43','Instansi C','domestik','LOK1','STF01','JT2',4,'DK01','STF04',78800),('TKT-20160102-0000011','2016-01-02 15:52:13','Instansi B','mancanegara','LOK2','STF01','JT1',9,'DK02','STF04',147200);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
