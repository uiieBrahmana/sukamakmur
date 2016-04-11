/*
Navicat MySQL Data Transfer

Source Server         : local instance MySQL
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : rcsukamakmur

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-04-11 22:50:28
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
-- Records of akomodasi
-- ----------------------------
INSERT INTO `akomodasi` VALUES ('1', 'Karmel', 'Per Hari', '44', 'Tersedia', '1500000');
INSERT INTO `akomodasi` VALUES ('2', 'Sharon', 'Per Hari', '52', 'Tersedia', '1500000');
INSERT INTO `akomodasi` VALUES ('3', 'Haifa', 'Per Hari', '52', 'Tersedia', '1500000');
INSERT INTO `akomodasi` VALUES ('4', 'Bethel', 'Per Hari', '58', 'Tersedia', '1500000');
INSERT INTO `akomodasi` VALUES ('5', 'Migdal', 'Per Hari', '58', 'Tersedia', '1500000');
INSERT INTO `akomodasi` VALUES ('6', 'Hermon', 'Per Hari', '100', 'Tersedia', '4000000');
INSERT INTO `akomodasi` VALUES ('7', 'Sion', 'Per Hari', '100', 'Tersedia', '4000000');
INSERT INTO `akomodasi` VALUES ('8', 'Convention Hall (Gedung 2) - Kosong', 'Per Hari', '350', 'Tersedia', '1000000');
INSERT INTO `akomodasi` VALUES ('9', 'Gedung KAKR 1', 'Per Hari', '50', 'Tersedia', '300000');
INSERT INTO `akomodasi` VALUES ('10', 'Gedung KAKR 2', 'Per Hari', '50', 'Tersedia', '300000');
INSERT INTO `akomodasi` VALUES ('11', 'Gedung KAKR 3', 'Per Hari', '50', 'Tersedia', '300000');
INSERT INTO `akomodasi` VALUES ('12', 'Gedung Penunjang - Dengan Kursi', 'Per Hari', '30', 'Tersedia', '350000');
INSERT INTO `akomodasi` VALUES ('13', 'Hall / Jambur - Kosong', 'Per Hari', '1000', 'Tersedia', '1000000');
INSERT INTO `akomodasi` VALUES ('14', 'Ruang Makan', 'Per Hari', '250', 'Tersedia', '2500000');
INSERT INTO `akomodasi` VALUES ('15', 'Lapo PA', 'Per Hari', '40', 'Tersedia', '150000');
INSERT INTO `akomodasi` VALUES ('16', 'Lapo PA Salib', 'Per Hari', '60', 'Tersedia', '200000');
INSERT INTO `akomodasi` VALUES ('17', 'Cottage 1', 'Per Hari', '2', 'Tersedia', '200000');
INSERT INTO `akomodasi` VALUES ('18', 'Cottage 4', 'Per Hari', '2', 'Tersedia', '200000');
INSERT INTO `akomodasi` VALUES ('19', 'Cottage 15', 'Per Hari', '2', 'Tersedia', '200000');
INSERT INTO `akomodasi` VALUES ('20', 'Cottage 2', 'Per Hari', '2', 'Tersedia', '150000');
INSERT INTO `akomodasi` VALUES ('21', 'Cottage 3', 'Per Hari', '2', 'Tersedia', '150000');
INSERT INTO `akomodasi` VALUES ('22', 'Cottage 5', 'Per Hari', '2', 'Tersedia', '150000');
INSERT INTO `akomodasi` VALUES ('23', 'Cottage 6', 'Per Hari', '2', 'Tersedia', '150000');
INSERT INTO `akomodasi` VALUES ('24', 'Cottage 7', 'Per Hari', '2', 'Tersedia', '150000');
INSERT INTO `akomodasi` VALUES ('25', 'Cottage 8', 'Per Hari', '2', 'Tersedia', '150000');
INSERT INTO `akomodasi` VALUES ('26', 'Cottage 9', 'Per Hari', '2', 'Tersedia', '150000');
INSERT INTO `akomodasi` VALUES ('27', 'Cottage 10', 'Per Hari', '2', 'Tersedia', '150000');
INSERT INTO `akomodasi` VALUES ('28', 'Cottage 11', 'Per Hari', '2', 'Tersedia', '150000');
INSERT INTO `akomodasi` VALUES ('29', 'Cottage 12', 'Per Hari', '2', 'Tersedia', '150000');
INSERT INTO `akomodasi` VALUES ('30', 'Cottage 13', 'Per Hari', '2', 'Tersedia', '150000');
INSERT INTO `akomodasi` VALUES ('31', 'Cottage 14', 'Per Hari', '2', 'Tersedia', '150000');
INSERT INTO `akomodasi` VALUES ('32', 'Family Cottage 1', 'Per Hari', '6', 'Tersedia', '350000');
INSERT INTO `akomodasi` VALUES ('33', 'Family Cottage 2', 'Per Hari', '6', 'Tersedia', '500000');
INSERT INTO `akomodasi` VALUES ('34', 'Family Cottage 3', 'Per Hari', '8', 'Tersedia', '500000');

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
-- Records of fotoakomodasi
-- ----------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kegiatan
-- ----------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of menumakanan
-- ----------------------------

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
-- Records of pembayaran
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pemesanan
-- ----------------------------
INSERT INTO `pemesanan` VALUES ('2', '1', '2016-04-11 17:39:38', null, 'DRAFT');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of peralatan
-- ----------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pesananakomodasi
-- ----------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pesanankegiatan
-- ----------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pesananmakanan
-- ----------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pesananperalatan
-- ----------------------------

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
-- Records of petugas
-- ----------------------------
INSERT INTO `petugas` VALUES ('1', 'Dwi Paulina br S. Brahmana', 'Sukamekar 2 No 14 A', '1993-08-02', 'W', '082129293180', 'dwipaulina@windowslive.com', 'Administrator', 'dwiadmin', 'dwiadmin');
INSERT INTO `petugas` VALUES ('2', 'Nurcholid Achmad', 'Sukamekar 2 No 14 B', '1993-11-26', 'P', '081381461286', 'diditvelliz@outlook.com', 'Trainer', 'diditvelliz', 'diditvelliz');
INSERT INTO `petugas` VALUES ('3', 'Fadhil Hafidz Ardiansyah', 'Gede Bage', '1993-09-03', 'P', '081382131131', 'fadhil.h.@gmail.com', 'Trainer', 'fadhil', 'fadhil');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tamu
-- ----------------------------
INSERT INTO `tamu` VALUES ('1', 'Dwi Paulina br S. Brahmana', '1993-08-02', 'W', 'Sukamekar 2 No 14', 'dwipaulina@windowslive.com', '082129293180', 'dwi', 'dwi');
INSERT INTO `tamu` VALUES ('2', 'Asa Ednatry Ayala', '1993-06-02', 'W', 'Surya Sumantri 66', 'asaho@gmail.com', '081233416533', 'asa', 'asa');

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

-- ----------------------------
-- Records of tipemakanan
-- ----------------------------
INSERT INTO `tipemakanan` VALUES ('A', '1x makan tanpa snack', '18500');
INSERT INTO `tipemakanan` VALUES ('B', '1x makan tanpa snack', '17000');
INSERT INTO `tipemakanan` VALUES ('C', '1x makan tanpa buah', '15000');
