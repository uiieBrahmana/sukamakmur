-- phpMyAdmin SQL Dump
-- version 4.0.10.12
-- http://www.phpmyadmin.net
--
-- Inang: 127.4.205.2:3306
-- Waktu pembuatan: 12 Jun 2016 pada 14.11
-- Versi Server: 5.5.45
-- Versi PHP: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `rcsukamakmur`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akomodasi`
--

CREATE TABLE IF NOT EXISTS `akomodasi` (
  `idakomodasi` int(8) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `kapasitas` int(8) NOT NULL,
  `status` varchar(20) NOT NULL,
  `harga` int(11) NOT NULL,
  PRIMARY KEY (`idakomodasi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `fotoakomodasi`
--

CREATE TABLE IF NOT EXISTS `fotoakomodasi` (
  `idakomodasi` int(8) NOT NULL,
  `namafile` varchar(255) NOT NULL,
  `ekstensifile` varchar(100) NOT NULL,
  `filedata` longblob NOT NULL,
  KEY `foreignakomodasi` (`idakomodasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan`
--

CREATE TABLE IF NOT EXISTS `kegiatan` (
  `idkegiatan` int(8) NOT NULL AUTO_INCREMENT,
  `nama` varchar(80) NOT NULL,
  `pesertamin` int(4) NOT NULL,
  `pesertamax` int(4) NOT NULL,
  `harga` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`idkegiatan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menumakanan`
--

CREATE TABLE IF NOT EXISTS `menumakanan` (
  `idmenumakanan` int(8) NOT NULL AUTO_INCREMENT,
  `idtipemakanan` varchar(2) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`idmenumakanan`),
  KEY `fktipemakanan` (`idtipemakanan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE IF NOT EXISTS `pembayaran` (
  `idpembayaran` int(8) NOT NULL AUTO_INCREMENT,
  `idpemesanan` int(8) NOT NULL,
  `idpetugas` int(8) DEFAULT NULL,
  `tanggalbayar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nominal` int(11) NOT NULL,
  `metodepembayaran` varchar(50) NOT NULL,
  `bukti` longblob,
  `ekstensifile` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idpembayaran`),
  KEY `fkIdPetugasPembayaran` (`idpetugas`),
  KEY `fkIdPesanan` (`idpemesanan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE IF NOT EXISTS `pemesanan` (
  `idpemesanan` int(8) NOT NULL AUTO_INCREMENT,
  `idtamu` int(8) NOT NULL,
  `tanggalpesan` datetime NOT NULL,
  `totalharga` int(11) DEFAULT NULL,
  `status` varchar(70) NOT NULL,
  PRIMARY KEY (`idpemesanan`),
  KEY `fkIdTamu` (`idtamu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peralatan`
--

CREATE TABLE IF NOT EXISTS `peralatan` (
  `idperalatan` int(8) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `hargasewa` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `jumlah` int(8) NOT NULL,
  PRIMARY KEY (`idperalatan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesananakomodasi`
--

CREATE TABLE IF NOT EXISTS `pesananakomodasi` (
  `idpesananakomodasi` int(8) NOT NULL AUTO_INCREMENT,
  `idpemesanan` int(8) NOT NULL,
  `idakomodasi` int(8) NOT NULL,
  `jumlahtamu` int(4) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`idpesananakomodasi`),
  KEY `fkIdAkomodasi` (`idakomodasi`),
  KEY `fkIdPemesananAkomodasi` (`idpemesanan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanankegiatan`
--

CREATE TABLE IF NOT EXISTS `pesanankegiatan` (
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
  KEY `fkIdPemesananKegiatan` (`idpemesanan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesananmakanan`
--

CREATE TABLE IF NOT EXISTS `pesananmakanan` (
  `idpesananmakanan` int(8) NOT NULL AUTO_INCREMENT,
  `idpemesanan` int(8) NOT NULL,
  `idmenumakanan` int(8) NOT NULL,
  `tanggalpemesanan` date NOT NULL,
  `porsi` int(3) NOT NULL,
  `waktupemesanan` varchar(15) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`idpesananmakanan`),
  KEY `fkIdMenu` (`idmenumakanan`),
  KEY `fkIdPemesananMakanan` (`idpemesanan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesananperalatan`
--

CREATE TABLE IF NOT EXISTS `pesananperalatan` (
  `idpesananperalatan` int(8) NOT NULL AUTO_INCREMENT,
  `idpemesanan` int(8) NOT NULL,
  `idperalatan` int(8) NOT NULL,
  `jumlah` int(4) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`idpesananperalatan`),
  KEY `fkIdPeralatan` (`idperalatan`),
  KEY `fkIdPemesananPeralatan` (`idpemesanan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE IF NOT EXISTS `petugas` (
  `idpetugas` int(8) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `tglLahir` date NOT NULL,
  `jenisKelamin` varchar(15) NOT NULL,
  `notelp` varchar(20) NOT NULL,
  `email` varchar(70) NOT NULL,
  `status` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`idpetugas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tamu`
--

CREATE TABLE IF NOT EXISTS `tamu` (
  `idtamu` int(8) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `tanggallahir` date NOT NULL,
  `jeniskelamin` varchar(12) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(70) NOT NULL,
  `notelp` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`idtamu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tipemakanan`
--

CREATE TABLE IF NOT EXISTS `tipemakanan` (
  `idtipemakanan` varchar(2) NOT NULL,
  `keterangan` text NOT NULL,
  `harga` int(8) NOT NULL,
  PRIMARY KEY (`idtipemakanan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `fotoakomodasi`
--
ALTER TABLE `fotoakomodasi`
  ADD CONSTRAINT `foreignakomodasi` FOREIGN KEY (`idakomodasi`) REFERENCES `akomodasi` (`idakomodasi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `menumakanan`
--
ALTER TABLE `menumakanan`
  ADD CONSTRAINT `fktipemakanan` FOREIGN KEY (`idtipemakanan`) REFERENCES `tipemakanan` (`idtipemakanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `fkIdPesanan` FOREIGN KEY (`idpemesanan`) REFERENCES `pemesanan` (`idpemesanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkIdPetugasPembayaran` FOREIGN KEY (`idpetugas`) REFERENCES `petugas` (`idpetugas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `fkIdTamu` FOREIGN KEY (`idtamu`) REFERENCES `tamu` (`idtamu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pesananakomodasi`
--
ALTER TABLE `pesananakomodasi`
  ADD CONSTRAINT `fkIdAkomodasi` FOREIGN KEY (`idakomodasi`) REFERENCES `akomodasi` (`idakomodasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkIdPemesananAkomodasi` FOREIGN KEY (`idpemesanan`) REFERENCES `pemesanan` (`idpemesanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pesanankegiatan`
--
ALTER TABLE `pesanankegiatan`
  ADD CONSTRAINT `fkIdKegiatan` FOREIGN KEY (`idkegiatan`) REFERENCES `kegiatan` (`idkegiatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkIdPemesananKegiatan` FOREIGN KEY (`idpemesanan`) REFERENCES `pemesanan` (`idpemesanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkIdPetugasKegiatan` FOREIGN KEY (`idpetugas`) REFERENCES `petugas` (`idpetugas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pesananmakanan`
--
ALTER TABLE `pesananmakanan`
  ADD CONSTRAINT `fkIdMenu` FOREIGN KEY (`idmenumakanan`) REFERENCES `menumakanan` (`idmenumakanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkIdPemesananMakanan` FOREIGN KEY (`idpemesanan`) REFERENCES `pemesanan` (`idpemesanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pesananperalatan`
--
ALTER TABLE `pesananperalatan`
  ADD CONSTRAINT `fkIdPemesananPeralatan` FOREIGN KEY (`idpemesanan`) REFERENCES `pemesanan` (`idpemesanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkIdPeralatan` FOREIGN KEY (`idperalatan`) REFERENCES `peralatan` (`idperalatan`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Event
--
CREATE DEFINER=`adminQmyx4LR`@`127.4.205.2` EVENT `pemesananhangus` ON SCHEDULE EVERY 1 DAY STARTS '2016-06-05 23:39:18' ON COMPLETION NOT PRESERVE ENABLE DO DELETE `rcsukamakmur`.`pemesanan` FROM `rcsukamakmur`.`pemesanan`
LEFT JOIN `rcsukamakmur`.`pembayaran` ON (`rcsukamakmur`.`pemesanan`.`idpemesanan` = `rcsukamakmur`.`pembayaran`.`idpemesanan`)
WHERE `rcsukamakmur`.`pemesanan`.`status` IN ('DRAFT', 'CHECKOUT') 
AND `rcsukamakmur`.`pembayaran`.`bukti` IS NULL AND `rcsukamakmur`.`pembayaran`.`ekstensifile` IS NULL
AND `rcsukamakmur`.`pemesanan`.`tanggalpesan` < DATE_SUB(NOW(), INTERVAL 1 DAY)$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
