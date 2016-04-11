/*
Navicat MySQL Data Transfer

Source Server         : local instance MySQL
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : rcsukamakmur

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-04-11 22:13:28
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

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
-- Table structure for kegiatan
-- ----------------------------
DROP TABLE IF EXISTS `kegiatan`;
CREATE TABLE `kegiatan` (
  `idkegiatan` int(8) NOT NULL AUTO_INCREMENT,
  `nama` varchar(80) NOT NULL,
  `lamakegiatan` int(3) NOT NULL,
  `pesertamin` int(4) NOT NULL,
  `pesertamax` int(4) NOT NULL,
  `harga` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`idkegiatan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

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
  `totalharga` int(11) DEFAULT NULL,
  `status` varchar(70) NOT NULL,
  PRIMARY KEY (`idpemesanan`),
  KEY `fkIdTamu` (`idtamu`),
  CONSTRAINT `fkIdTamu` FOREIGN KEY (`idtamu`) REFERENCES `tamu` (`idtamu`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

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
