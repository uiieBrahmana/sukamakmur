/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 50621
Source Host           : localhost:3306
Source Database       : rcsukamakmur

Target Server Type    : MYSQL
Target Server Version : 50621
File Encoding         : 65001

Date: 2016-04-18 16:29:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for akomodasi
-- ----------------------------
DROP TABLE IF EXISTS `akomodasi`;
CREATE TABLE `akomodasi` (
  `idakomodasi` int(8) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `kapasitas` int(8) NOT NULL,
  `status` varchar(20) NOT NULL,
  `harga` int(11) NOT NULL,
  PRIMARY KEY (`idakomodasi`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for daemons
-- ----------------------------
DROP TABLE IF EXISTS `daemons`;
CREATE TABLE `daemons` (
  `Start` text NOT NULL,
  `Info` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for fotoakomodasi
-- ----------------------------
DROP TABLE IF EXISTS `fotoakomodasi`;
CREATE TABLE `fotoakomodasi` (
  `idakomodasi` int(8) NOT NULL,
  `namafile` varchar(255) NOT NULL,
  `ekstensifile` varchar(100) NOT NULL,
  `filedata` longblob NOT NULL,
  KEY `foreignakomodasi` (`idakomodasi`),
  CONSTRAINT `foreignakomodasi` FOREIGN KEY (`idakomodasi`) REFERENCES `akomodasi` (`idakomodasi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for gammu
-- ----------------------------
DROP TABLE IF EXISTS `gammu`;
CREATE TABLE `gammu` (
  `Version` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for inbox
-- ----------------------------
DROP TABLE IF EXISTS `inbox`;
CREATE TABLE `inbox` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ReceivingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Text` text NOT NULL,
  `SenderNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text NOT NULL,
  `SMSCNumber` varchar(20) NOT NULL DEFAULT '',
  `Class` int(11) NOT NULL DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `RecipientID` text NOT NULL,
  `Processed` enum('false','true') NOT NULL DEFAULT 'false',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for kegiatan
-- ----------------------------
DROP TABLE IF EXISTS `kegiatan`;
CREATE TABLE `kegiatan` (
  `idkegiatan` int(8) NOT NULL AUTO_INCREMENT,
  `nama` varchar(80) NOT NULL,
  `pesertamin` int(4) NOT NULL,
  `pesertamax` int(4) NOT NULL,
  `harga` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`idkegiatan`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for menumakanan
-- ----------------------------
DROP TABLE IF EXISTS `menumakanan`;
CREATE TABLE `menumakanan` (
  `idmenumakanan` int(8) NOT NULL AUTO_INCREMENT,
  `idtipemakanan` varchar(2) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`idmenumakanan`),
  KEY `fktipemakanan` (`idtipemakanan`),
  CONSTRAINT `fktipemakanan` FOREIGN KEY (`idtipemakanan`) REFERENCES `tipemakanan` (`idtipemakanan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for outbox
-- ----------------------------
DROP TABLE IF EXISTS `outbox`;
CREATE TABLE `outbox` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendBefore` time NOT NULL DEFAULT '23:59:59',
  `SendAfter` time NOT NULL DEFAULT '00:00:00',
  `Text` text,
  `DestinationNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text,
  `Class` int(11) DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MultiPart` enum('false','true') DEFAULT 'false',
  `RelativeValidity` int(11) DEFAULT '-1',
  `SenderID` varchar(255) DEFAULT NULL,
  `SendingTimeOut` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `DeliveryReport` enum('default','yes','no') DEFAULT 'default',
  `CreatorID` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `outbox_date` (`SendingDateTime`,`SendingTimeOut`),
  KEY `outbox_sender` (`SenderID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for outbox_multipart
-- ----------------------------
DROP TABLE IF EXISTS `outbox_multipart`;
CREATE TABLE `outbox_multipart` (
  `Text` text,
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text,
  `Class` int(11) DEFAULT '-1',
  `TextDecoded` text,
  `ID` int(10) unsigned NOT NULL DEFAULT '0',
  `SequencePosition` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`,`SequencePosition`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pbk
-- ----------------------------
DROP TABLE IF EXISTS `pbk`;
CREATE TABLE `pbk` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `GroupID` int(11) NOT NULL DEFAULT '-1',
  `Name` text NOT NULL,
  `Number` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pbk_groups
-- ----------------------------
DROP TABLE IF EXISTS `pbk_groups`;
CREATE TABLE `pbk_groups` (
  `Name` text NOT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pembayaran
-- ----------------------------
DROP TABLE IF EXISTS `pembayaran`;
CREATE TABLE `pembayaran` (
  `idpembayaran` int(8) NOT NULL AUTO_INCREMENT,
  `idpemesanan` int(8) NOT NULL,
  `idpetugas` int(8) DEFAULT NULL,
  `tanggalbayar` datetime NOT NULL,
  `nominal` int(11) NOT NULL,
  `metodepembayaran` varchar(50) NOT NULL,
  `bukti` longblob NOT NULL,
  PRIMARY KEY (`idpembayaran`),
  KEY `fkIdPetugasPembayaran` (`idpetugas`),
  KEY `fkIdPesanan` (`idpemesanan`),
  CONSTRAINT `fkIdPesanan` FOREIGN KEY (`idpemesanan`) REFERENCES `pemesanan` (`idpemesanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fkIdPetugasPembayaran` FOREIGN KEY (`idpetugas`) REFERENCES `petugas` (`idpetugas`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for pemesanan
-- ----------------------------
DROP TABLE IF EXISTS `pemesanan`;
CREATE TABLE `pemesanan` (
  `idpemesanan` int(8) NOT NULL AUTO_INCREMENT,
  `idtamu` int(8) NOT NULL,
  `tanggalpesan` datetime NOT NULL,
  `totalharga` decimal(15,0) DEFAULT NULL,
  `status` varchar(70) NOT NULL,
  PRIMARY KEY (`idpemesanan`),
  KEY `fkIdTamu` (`idtamu`),
  CONSTRAINT `fkIdTamu` FOREIGN KEY (`idtamu`) REFERENCES `tamu` (`idtamu`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for peralatan
-- ----------------------------
DROP TABLE IF EXISTS `peralatan`;
CREATE TABLE `peralatan` (
  `idperalatan` int(8) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `hargasewa` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `jumlah` int(8) NOT NULL,
  PRIMARY KEY (`idperalatan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for pesananakomodasi
-- ----------------------------
DROP TABLE IF EXISTS `pesananakomodasi`;
CREATE TABLE `pesananakomodasi` (
  `idpesananakomodasi` int(8) NOT NULL AUTO_INCREMENT,
  `idpemesanan` int(8) NOT NULL,
  `idakomodasi` int(8) NOT NULL,
  `jumlahtamu` int(4) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`idpesananakomodasi`),
  KEY `fkIdAkomodasi` (`idakomodasi`),
  KEY `fkIdPemesananAkomodasi` (`idpemesanan`),
  CONSTRAINT `fkIdAkomodasi` FOREIGN KEY (`idakomodasi`) REFERENCES `akomodasi` (`idakomodasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fkIdPemesananAkomodasi` FOREIGN KEY (`idpemesanan`) REFERENCES `pemesanan` (`idpemesanan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for pesanankegiatan
-- ----------------------------
DROP TABLE IF EXISTS `pesanankegiatan`;
CREATE TABLE `pesanankegiatan` (
  `idpesanankegiatan` int(8) NOT NULL AUTO_INCREMENT,
  `idpemesanan` int(8) NOT NULL,
  `idpetugas` int(8) DEFAULT NULL,
  `idkegiatan` int(8) NOT NULL,
  `jumlahpeserta` int(4) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`idpesanankegiatan`),
  KEY `fkIdPetugasKegiatan` (`idpetugas`),
  KEY `fkIdKegiatan` (`idkegiatan`),
  KEY `fkIdPemesananKegiatan` (`idpemesanan`),
  CONSTRAINT `fkIdKegiatan` FOREIGN KEY (`idkegiatan`) REFERENCES `kegiatan` (`idkegiatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fkIdPemesananKegiatan` FOREIGN KEY (`idpemesanan`) REFERENCES `pemesanan` (`idpemesanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fkIdPetugasKegiatan` FOREIGN KEY (`idpetugas`) REFERENCES `petugas` (`idpetugas`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for pesananmakanan
-- ----------------------------
DROP TABLE IF EXISTS `pesananmakanan`;
CREATE TABLE `pesananmakanan` (
  `idpesananmakanan` int(8) NOT NULL AUTO_INCREMENT,
  `idpemesanan` int(8) NOT NULL,
  `idmenumakanan` int(8) NOT NULL,
  `tanggalpemesanan` date NOT NULL,
  `porsi` int(3) NOT NULL,
  `waktupemesanan` varchar(15) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`idpesananmakanan`),
  KEY `fkIdMenu` (`idmenumakanan`),
  KEY `fkIdPemesananMakanan` (`idpemesanan`),
  CONSTRAINT `fkIdMenu` FOREIGN KEY (`idmenumakanan`) REFERENCES `menumakanan` (`idmenumakanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fkIdPemesananMakanan` FOREIGN KEY (`idpemesanan`) REFERENCES `pemesanan` (`idpemesanan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for pesananperalatan
-- ----------------------------
DROP TABLE IF EXISTS `pesananperalatan`;
CREATE TABLE `pesananperalatan` (
  `idpesananperalatan` int(8) NOT NULL AUTO_INCREMENT,
  `idpemesanan` int(8) NOT NULL,
  `idperalatan` int(8) NOT NULL,
  `jumlah` int(4) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`idpesananperalatan`),
  KEY `fkIdPeralatan` (`idperalatan`),
  KEY `fkIdPemesananPeralatan` (`idpemesanan`),
  CONSTRAINT `fkIdPemesananPeralatan` FOREIGN KEY (`idpemesanan`) REFERENCES `pemesanan` (`idpemesanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fkIdPeralatan` FOREIGN KEY (`idperalatan`) REFERENCES `peralatan` (`idperalatan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for petugas
-- ----------------------------
DROP TABLE IF EXISTS `petugas`;
CREATE TABLE `petugas` (
  `idpetugas` int(8) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `tglLahir` date NOT NULL,
  `jenisKelamin` varchar(15) NOT NULL,
  `notelp` varchar(13) NOT NULL,
  `email` varchar(70) NOT NULL,
  `status` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`idpetugas`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for phones
-- ----------------------------
DROP TABLE IF EXISTS `phones`;
CREATE TABLE `phones` (
  `ID` text NOT NULL,
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TimeOut` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Send` enum('yes','no') NOT NULL DEFAULT 'no',
  `Receive` enum('yes','no') NOT NULL DEFAULT 'no',
  `IMEI` varchar(35) NOT NULL,
  `Client` text NOT NULL,
  `Battery` int(11) NOT NULL DEFAULT '-1',
  `Signal` int(11) NOT NULL DEFAULT '-1',
  `Sent` int(11) NOT NULL DEFAULT '0',
  `Received` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IMEI`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for sentitems
-- ----------------------------
DROP TABLE IF EXISTS `sentitems`;
CREATE TABLE `sentitems` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `DeliveryDateTime` timestamp NULL DEFAULT NULL,
  `Text` text NOT NULL,
  `DestinationNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text NOT NULL,
  `SMSCNumber` varchar(20) NOT NULL DEFAULT '',
  `Class` int(11) NOT NULL DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) unsigned NOT NULL DEFAULT '0',
  `SenderID` varchar(255) NOT NULL,
  `SequencePosition` int(11) NOT NULL DEFAULT '1',
  `Status` enum('SendingOK','SendingOKNoReport','SendingError','DeliveryOK','DeliveryFailed','DeliveryPending','DeliveryUnknown','Error') NOT NULL DEFAULT 'SendingOK',
  `StatusError` int(11) NOT NULL DEFAULT '-1',
  `TPMR` int(11) NOT NULL DEFAULT '-1',
  `RelativeValidity` int(11) NOT NULL DEFAULT '-1',
  `CreatorID` text NOT NULL,
  PRIMARY KEY (`ID`,`SequencePosition`),
  KEY `sentitems_date` (`DeliveryDateTime`),
  KEY `sentitems_tpmr` (`TPMR`),
  KEY `sentitems_dest` (`DestinationNumber`),
  KEY `sentitems_sender` (`SenderID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for tamu
-- ----------------------------
DROP TABLE IF EXISTS `tamu`;
CREATE TABLE `tamu` (
  `idtamu` int(8) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `tanggallahir` date NOT NULL,
  `jeniskelamin` varchar(12) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(70) NOT NULL,
  `notelp` varchar(13) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`idtamu`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tipemakanan
-- ----------------------------
DROP TABLE IF EXISTS `tipemakanan`;
CREATE TABLE `tipemakanan` (
  `idtipemakanan` varchar(2) NOT NULL,
  `keterangan` text NOT NULL,
  `harga` int(8) NOT NULL,
  PRIMARY KEY (`idtipemakanan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
DROP TRIGGER IF EXISTS `inbox_timestamp`;
DELIMITER ;;
CREATE TRIGGER `inbox_timestamp` BEFORE INSERT ON `inbox` FOR EACH ROW BEGIN
    IF NEW.ReceivingDateTime = '0000-00-00 00:00:00' THEN
        SET NEW.ReceivingDateTime = CURRENT_TIMESTAMP();
    END IF;
END
;;
DELIMITER ;
