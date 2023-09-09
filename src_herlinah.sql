-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.11-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for herlinah_src
DROP DATABASE IF EXISTS `herlinah_src`;
CREATE DATABASE IF NOT EXISTS `herlinah_src` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `herlinah_src`;

-- Dumping structure for table herlinah_src.barang
DROP TABLE IF EXISTS `barang`;
CREATE TABLE IF NOT EXISTS `barang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(50) NOT NULL DEFAULT '0',
  `nama_barang` varchar(100) DEFAULT NULL,
  `keuntungan` int(11) DEFAULT NULL,
  `stok` int(11) NOT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=206 DEFAULT CHARSET=utf8;

-- Dumping data for table herlinah_src.barang: ~204 rows (approximately)
DELETE FROM `barang`;
INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `keuntungan`, `stok`, `satuan`) VALUES
	(1, '1001', 'Gula Pasir Raja Gula 1SAK', 1000, 40, 'SAK'),
	(2, '1002', 'Gula Pasir Raja Gula 1KG', 100, 0, 'Kg'),
	(3, '1003', 'Tepung Beras Rose Brand 200GR 1DUS', 200, 5, 'Dus'),
	(4, '1004', 'Tepung Beras Rose Brand 500GR 1DUS', 0, 0, ''),
	(5, '1005', 'Tepung Beras Rose Brand 200GR', 0, 0, ''),
	(6, '1006', 'Tepung Beras Rose Brand 500GR', 0, 0, ''),
	(7, '1007', 'Garam Kotak', 0, 0, ''),
	(8, '1008', 'Garam Halus Segitiga', 0, 0, ''),
	(9, '1009', 'Aroma Slim 12 1SLOP', 0, 0, ''),
	(10, '1010', 'Aroma Slim 12 1BKS', 0, 0, ''),
	(11, '1011', 'Terigu Segitiga 1SAK', 0, 0, ''),
	(12, '1012', 'Terigu Segitiga 1KG', 0, 0, ''),
	(13, '2001', 'Anget Sari Susu Jahe 1BOX', 0, 0, ''),
	(14, '2002', 'Anget Sari Susu Jahe 1RCN', 0, 0, ''),
	(15, '3001', 'Nutrisari American Sweet Orange 1PACK', 0, 0, ''),
	(16, '3002', 'Nutrisari American Sweet Orange 1RCN', 0, 0, ''),
	(17, '4001', 'Gery Chocolatos (ASTOR) 1BOX', 0, 0, ''),
	(18, '4002', 'Gery Salut Choco 500 1BOX', 0, 0, ''),
	(19, '4003', 'Kacang Atom 26GR 1PACK', 0, 0, ''),
	(20, '4004', 'Kacang Atom 26GR 1RCN', 0, 0, ''),
	(21, '4005', 'Pilus Rumput Laut 1PACK', 0, 0, ''),
	(22, '4006', 'Pilus Rumput Laut 1RCN', 0, 0, ''),
	(23, '4007', 'Gery Salut Roll Coklat ', 0, 0, ''),
	(24, '4008', 'Kacang Atom 50GR 1PACK', 0, 0, ''),
	(25, '4009', 'Kacang Atom 50GR 1RCN', 0, 0, ''),
	(26, '4010', 'Gery Malkist Coklat Family 110GR 1BOX', 0, 0, ''),
	(27, '4011', 'Gery Malkist Coklat Family 110GR 1PCS', 0, 0, ''),
	(28, '4012', 'Gery Malkist Salut Keju 110GR 1BOX', 0, 0, ''),
	(29, '4013', 'Gery Malkist Salut Keju 110GR 1BPCS', 0, 0, ''),
	(30, '5001', 'Kapal Api 6.5GR 1DUS', 0, 0, ''),
	(31, '5002', 'Kapal Api 6.5GR 1RCN', 0, 0, ''),
	(32, '5003', 'Kapal Api 30GR 1DUS', 0, 0, ''),
	(33, '5004', 'Kapal Api 30GR 1BKS', 0, 0, ''),
	(34, '5005', 'Kapal Api 65GR 1DUS', 0, 0, ''),
	(35, '5006', 'Kapal Api 65GR 1BKS', 0, 0, ''),
	(36, '5007', 'Kapal Api 165GR 1DUS', 0, 0, ''),
	(37, '5008', 'Kapal Api 165GR 1BKS', 0, 0, ''),
	(38, '5009', 'Kapal Api Spesial Mix 1DUS', 0, 0, ''),
	(39, '5010', 'Kapal Api Spesial Mix 1RCN', 0, 0, ''),
	(40, '5011', 'Kapal Api Susu 1DUS', 0, 0, ''),
	(41, '5012', 'Kapal Api Susu 1RCN', 0, 0, ''),
	(42, '5013', 'Kapal Api Granade Java Latte 1DUS', 0, 0, ''),
	(43, '5014', 'Kapal Api Granade Java Latte 1RCN', 0, 0, ''),
	(44, '5015', 'ABC Susu 1DUS', 0, 0, ''),
	(45, '5016', 'ABC Susu 1RCN', 0, 0, ''),
	(46, '5017', 'Goodday Mocacinno 1PACK', 0, 0, ''),
	(47, '5018', 'Goodday Mocacinno 1RCN', 0, 0, ''),
	(48, '5019', 'Fresco Kopi Susu 1DUS', 0, 0, ''),
	(49, '5020', 'Fresco Kopi Susu 1RCN', 0, 0, ''),
	(50, '5021', 'Kapal Api Granade White Choco Toping 1DUS', 0, 0, ''),
	(51, '5022', 'Kapal Api Granade White Choco Toping 1RCN', 0, 0, ''),
	(52, '5023', 'Goodday Chococino 1PACK', 0, 0, ''),
	(53, '5024', 'Goodday Chococino 1RCN', 0, 0, ''),
	(54, '5025', 'Goodday Vanila Latte 1PACK', 0, 0, ''),
	(55, '5026', 'Goodday Vanila Latte 1RCN', 0, 0, ''),
	(56, '5027', 'Goodday Collin 1PACK', 0, 0, ''),
	(57, '5028', 'Goodday Collin 1RCN', 0, 0, ''),
	(58, '5029', 'Goodday Carebian 1PACK', 0, 0, ''),
	(59, '5030', 'Goodday Carebian 1RCN', 0, 0, ''),
	(60, '5031', 'Torabika Cappucino 1DUS', 0, 0, ''),
	(61, '5032', 'Torabika Cappucino 1RCN', 0, 0, ''),
	(62, '5033', 'Energen Coklat 1DUS', 0, 0, ''),
	(63, '5034', 'Energen Vanila', 0, 0, ''),
	(64, '5035', 'Energen Kacang Ijo', 0, 0, ''),
	(65, '5036', 'Energen Jahe', 0, 0, ''),
	(66, '5037', 'Torabika Creamy Latte 1DUS', 0, 0, ''),
	(67, '5038', 'Torabika Creamy Latte 1RCN', 0, 0, ''),
	(68, '5039', 'Torabika Duo 1DUS', 0, 0, ''),
	(69, '5040', 'Torabika Duo 1RCN', 0, 0, ''),
	(70, '6001', 'Roma Kelapa', 0, 0, ''),
	(71, '6002', 'Roma Marie Susu', 0, 0, ''),
	(72, '6003', 'Roma Malkist Abon 145GR', 0, 0, ''),
	(73, '6004', 'Roma Better ', 0, 0, ''),
	(74, '6005', 'Roma Zuper Keju ', 0, 0, ''),
	(75, '6006', 'Permen Kopiko 1DUS', 0, 0, ''),
	(76, '6007', 'Permen Kopiko 1PSC', 0, 0, ''),
	(77, '6008', 'Permen Kiss 1DUS', 0, 0, ''),
	(78, '6009', 'Permen Kiss 1PSC', 0, 0, ''),
	(79, '6010', 'Roma Sari Gandum Roll 149GR', 0, 0, ''),
	(80, '6011', 'Beng Beng ', 0, 0, ''),
	(81, '6012', 'Roma Malkist Coklat', 0, 0, ''),
	(82, '6013', 'Roma Superstar', 0, 0, ''),
	(83, '6014', 'Roma Malkist Merah ', 0, 0, ''),
	(84, '6015', 'Roma Slai Olai Kecil', 0, 0, ''),
	(85, '6016', 'Roma Sari Gandum Coklat 115GR', 0, 0, ''),
	(86, '7001', 'Ekonomi Kuning 500', 0, 0, ''),
	(87, '7002', 'Ekonomi Kuning 1000', 0, 0, ''),
	(88, '7003', 'Ekonomi Kuning 2000', 0, 0, ''),
	(89, '7004', 'Mama Lemon 1000', 0, 0, ''),
	(90, '7005', 'Mama Lemon 2000', 0, 0, ''),
	(91, '7006', 'Sedap Kecap 2000 1PACK', 0, 0, ''),
	(92, '7007', 'Sedap Kecap 2000 1PCS', 0, 0, ''),
	(93, '7008', 'Sedap Mie Ayam Bawang 1DUS', 0, 0, ''),
	(94, '7009', 'Sedap Mie Ayam Bawang 1PCS', 0, 0, ''),
	(95, '7010', 'Sedap Mie Soto', 0, 0, ''),
	(96, '7011', 'Sedap Mie Soto', 0, 0, ''),
	(97, '7012', 'Sedap Mie Kari', 0, 0, ''),
	(98, '7013', 'Sedap Mie Kari', 0, 0, ''),
	(99, '7014', 'Sedap Mie Goreng', 0, 0, ''),
	(100, '7015', 'Sedap Mie Goreng', 0, 0, ''),
	(101, '7016', 'Sedap Kecap 550ML  ', 0, 0, ''),
	(102, '7017', 'Ale-Ale1DUS', 0, 0, ''),
	(103, '7018', 'Teh Rio 1DUS', 0, 0, ''),
	(104, '7019', 'Top Kopi Gula 1DUS', 0, 0, ''),
	(105, '7020', 'Top Kopi Gula 1RCN', 0, 0, ''),
	(106, '7021', 'Top Kopi Susu 1DUS', 0, 0, ''),
	(107, '7022', 'Top Kopi Susu 1RCN', 0, 0, ''),
	(108, '7023', 'Ciptadent Pasta Gigi 75GR 1DUS', 0, 0, ''),
	(109, '7024', 'Ciptadent Pasta Gigi 75GR 1RCN', 0, 0, ''),
	(110, '7025', 'Sikat Gigi Ciptadent 1PACK', 0, 0, ''),
	(111, '7026', 'Sikat Gigi Ciptadent 1PCS', 0, 0, ''),
	(112, '7027', 'Floridina Orange 300ML 1PACK', 0, 0, ''),
	(113, '7028', 'Floridina Orange 300ML 1PCS', 0, 0, ''),
	(114, '7029', 'Sedap Cup Kuah 1DUS', 0, 0, ''),
	(115, '7030', 'Sedap Cup Kuah 1CUP', 0, 0, ''),
	(116, '7031', 'Sedap Cup Goreng 1DUS', 0, 0, ''),
	(117, '7032', 'Sedap Cup Goreng 1CUP', 0, 0, ''),
	(118, '7033', 'Top Kopi White 1DUS', 0, 0, ''),
	(119, '7034', 'Top Kopi White 1RCN', 0, 0, ''),
	(120, '7035', 'Sedap Mie Baso 1DUS', 0, 0, ''),
	(121, '7036', 'Sedap Mie Baso 1PCS', 0, 0, ''),
	(122, '7037', 'Top Plus 1DUS', 0, 0, ''),
	(123, '7038', 'Top Plus 1RCN', 0, 0, ''),
	(124, '7039', 'Nuvo Cair 80ML 1DUS', 0, 0, ''),
	(125, '7040', 'Nuvo Cair 80ML 1PCS', 0, 0, ''),
	(126, '7041', 'GIV Cair 70ML 1DUS', 0, 0, ''),
	(127, '7042', 'GIV Cair 70ML 1PCS', 0, 0, ''),
	(128, '7043', 'Nuvo Sabun 1DUS', 0, 0, ''),
	(129, '7044', 'Nuvo Sabun 1PCS', 0, 0, ''),
	(130, '7045', 'Boom Detergent 1PACK', 0, 0, ''),
	(131, '7046', 'Boom Detergent 1PCS', 0, 0, ''),
	(132, '7047', 'Zinc ', 0, 0, ''),
	(133, '7048', 'Ekonomi Putih 500', 0, 0, ''),
	(134, '7049', 'Ekonomi Putih 1000', 0, 0, ''),
	(135, '7050', 'Ekonomi Putih 2000', 0, 0, ''),
	(136, '7051', 'Soklin 500 1PACK', 0, 0, ''),
	(137, '7052', 'Soklin 500 1PCS', 0, 0, ''),
	(138, '7053', 'Soklin Liquid Merah 1PACK', 0, 0, ''),
	(139, '7054', 'Soklin Liquid Merah 1PCS', 0, 0, ''),
	(140, '7055', 'Soklin Lantai 800ML 1PACK', 0, 0, ''),
	(141, '7056', 'Soklin Lantai 800ML 1PCS', 0, 0, ''),
	(142, '8001', 'Nikisari Syrup Frambozen 1PACK', 0, 0, ''),
	(143, '8002', 'Nikisari Syrup Frambozen 1PCS', 0, 0, ''),
	(144, '8003', 'Cuka Kecil 1PACK', 0, 0, ''),
	(145, '8004', 'Cuka Kecil 1PCS', 0, 0, ''),
	(146, '8005', 'Cuka Apollo 1PACK', 0, 0, ''),
	(147, '8006', 'Cuka Apollo 1PCS', 0, 0, ''),
	(148, '9001', 'Charm 500', 0, 0, ''),
	(149, '9002', 'Charm Maxi ', 0, 0, ''),
	(150, '9003', 'Mami Poko S 1DUS', 0, 0, ''),
	(151, '9004', 'Mami Poko S 1RCN', 0, 0, ''),
	(152, '9005', 'Mami Poko M 1DUS', 0, 0, ''),
	(153, '9006', 'Mami Poko M 1RCN', 0, 0, ''),
	(154, '9007', 'Mami Poko L 1DUS', 0, 0, ''),
	(155, '9008', 'Mami Poko M 1RCN', 0, 0, ''),
	(156, '9009', 'Mami Poko XL 1DUS', 0, 0, ''),
	(157, '9010', 'Mami Poko XL 1RCN', 0, 0, ''),
	(158, '9011', 'Mami Poko XXL 1DUS', 0, 0, ''),
	(159, '9012', 'Mami Poko XXL 1RCN', 0, 0, ''),
	(160, '10001', 'Aqua 240ML', 0, 0, ''),
	(161, '10002', 'Aqua 330ML', 0, 0, ''),
	(162, '10003', 'Aqua 600ML', 0, 0, ''),
	(163, '10004', 'Aqua 1500ML', 0, 0, ''),
	(164, '10005', 'Mizone', 0, 0, ''),
	(165, '10006', 'Tropical Refill 500ML', 0, 0, ''),
	(166, '10007', 'Tropical Refill 1000ML', 0, 0, ''),
	(167, '10008', 'Tropical Refill 2000ML', 0, 0, ''),
	(168, '11001', 'ABC Batu Alkaline A2', 0, 0, ''),
	(169, '11002', 'ABC Batu Alkaline A3', 0, 0, ''),
	(170, '11003', 'ABC Batu Biru Kecil ', 0, 0, ''),
	(171, '11004', 'ABC Batu A3 Super Power', 0, 0, ''),
	(172, '11005', 'ABC Batu Biru R2 Besar', 0, 0, ''),
	(173, '11006', 'ABC Batu Biru R14 Tanggung', 0, 0, ''),
	(174, '12001', 'Ajinomoto 50GR', 0, 0, ''),
	(175, '12002', 'Ajinomoto 250GR', 0, 0, ''),
	(176, '12003', 'Masako Sapi 500', 0, 0, ''),
	(177, '12004', 'Masako Ayam 500', 0, 0, ''),
	(178, '13001', 'Indomie Goreng', 0, 0, ''),
	(179, '13002', 'Indomie Ayam Bawang', 0, 0, ''),
	(180, '13003', 'Indomie Ayam Special ', 0, 0, ''),
	(181, '13004', 'Sarimi Ayam', 0, 0, ''),
	(182, '13005', 'Sarimi Duo Kecap', 0, 0, ''),
	(183, '13006', 'Sarimi Dua Kari', 0, 0, ''),
	(184, '13007', 'Indomilk Kaleng Putih 1DUS', 0, 0, ''),
	(185, '13008', 'Indomilk Kaleng Putih 1PCS', 0, 0, ''),
	(186, '13009', 'Indomilk Kaleng Coklat 1DUS', 0, 0, ''),
	(187, '13010', 'Indomilk Kaleng Coklat 1PCS', 0, 0, ''),
	(188, '13011', 'Indomilk Sachet Putih 1DUS', 0, 0, ''),
	(189, '13012', 'Indomilk Sachet Putih 1RCN', 0, 0, ''),
	(190, '13013', 'Indomilk Sachet Coklat 1DUS', 0, 0, ''),
	(191, '13014', 'Indomilk Sachet Coklat 1RCN', 0, 0, ''),
	(192, '13015', 'Indomilk Botol Coklat 190ML 1DUS', 0, 0, ''),
	(193, '13016', 'Indomilk Botol Coklat 190ML 1PCS', 0, 0, ''),
	(194, '13017', 'Indomilk Kid Coklat 115ML 1DUS ', 0, 0, ''),
	(195, '13018', 'Indomilk Kid Coklat 115ML 1PCS', 0, 0, ''),
	(196, '13019', 'Indomie Soto', 0, 0, ''),
	(197, '13020', 'Indomie Goreng Rendang', 0, 0, ''),
	(198, '13021', 'Indomie Goreng Iga Penyet', 0, 0, ''),
	(199, '13022', 'Pop Mie Mini Ayam Bawang 1DUS', 0, 0, ''),
	(200, '13023', 'Pop Mie Mini Ayam Bawang 1PCS', 0, 0, ''),
	(201, '13024', 'Indomilk Kid Stroberi 115ML 1DUS ', 0, 0, ''),
	(202, '13025', 'Indomilk Kid Stroberi 115ML 1PCS', 0, 0, ''),
	(203, '13026', 'Indomilk Botol Strober 190ML 1DUS', 0, 0, ''),
	(204, '13027', 'Indomilk Botol Strober 190ML 1PCS', 0, 0, '');

-- Dumping structure for table herlinah_src.pembelian
DROP TABLE IF EXISTS `pembelian`;
CREATE TABLE IF NOT EXISTS `pembelian` (
  `id_pembelian` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) unsigned NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `jumlah_barang` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  PRIMARY KEY (`id_pembelian`),
  KEY `FK_idbarang_pembelian` (`id_barang`),
  CONSTRAINT `FK_idbarang_pembelian` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping data for table herlinah_src.pembelian: ~2 rows (approximately)
DELETE FROM `pembelian`;
INSERT INTO `pembelian` (`id_pembelian`, `id_barang`, `tanggal`, `jumlah_barang`, `harga_beli`) VALUES
	(1, 1, '2022-12-29 21:47:34', 50, 80000),
	(7, 3, '2023-01-01 00:00:00', 5, 20000);

-- Dumping structure for table herlinah_src.penjualan
DROP TABLE IF EXISTS `penjualan`;
CREATE TABLE IF NOT EXISTS `penjualan` (
  `id_penjualan` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) unsigned NOT NULL,
  `tanggal_penjualan` datetime NOT NULL DEFAULT current_timestamp(),
  `id_barang` int(11) unsigned NOT NULL,
  `jumlah_barang` int(11) unsigned NOT NULL,
  `harga_jual` int(11) unsigned NOT NULL,
  `harga_beli` int(11) unsigned NOT NULL,
  `total` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_penjualan`),
  KEY `FK_penjualan_idtransksi` (`id_transaksi`),
  KEY `FK_penjualan_idbarang` (`id_barang`),
  CONSTRAINT `FK_penjualan_idbarang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_penjualan_idtransksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Dumping data for table herlinah_src.penjualan: ~2 rows (approximately)
DELETE FROM `penjualan`;
INSERT INTO `penjualan` (`id_penjualan`, `id_transaksi`, `tanggal_penjualan`, `id_barang`, `jumlah_barang`, `harga_jual`, `harga_beli`, `total`) VALUES
	(4, 4, '2023-01-05 08:02:35', 3, 3, 20200, 20000, 60600);

-- Dumping structure for table herlinah_src.transaksi
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id_transaksi` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(50) NOT NULL DEFAULT '',
  `tanggal_penjualan` datetime NOT NULL DEFAULT current_timestamp(),
  `status` char(2) NOT NULL DEFAULT '0',
  `total` int(11) NOT NULL DEFAULT 0,
  `bayar` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `FK_id_user` (`id_user`),
  CONSTRAINT `FK_id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table herlinah_src.transaksi: ~2 rows (approximately)
DELETE FROM `transaksi`;
INSERT INTO `transaksi` (`id_transaksi`, `kode_transaksi`, `tanggal_penjualan`, `status`, `total`, `bayar`, `id_user`) VALUES
	(4, '2023010500002', '2023-01-05 08:02:35', '1', 60600, 100000, 2);

-- Dumping structure for table herlinah_src.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `kode_user` varchar(20) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `email` varchar(260) NOT NULL,
  `password` varchar(16) NOT NULL,
  `role_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table herlinah_src.user: ~2 rows (approximately)
DELETE FROM `user`;
INSERT INTO `user` (`id_user`, `kode_user`, `nama`, `email`, `password`, `role_id`) VALUES
	(1, 'OWN-001', 'jhon doe', 'jhon@gmail.com', '123456', 0),
	(2, 'STAFF-001', 'Lorems', 'lorem@gmail.com', '123456', 1),
	(3, 'STAFF-002', 'Stuff', 'stuff@gmail.com', '123456', 1);

-- Dumping structure for trigger herlinah_src.pembelian_after_delete
DROP TRIGGER IF EXISTS `pembelian_after_delete`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `pembelian_after_delete` AFTER DELETE ON `pembelian` FOR EACH ROW BEGIN
	DECLARE lates_stok INT;
	SET lates_stok = (SELECT stok FROM barang WHERE id = OLD.id_barang) - OLD.jumlah_barang;
	UPDATE barang SET stok = lates_stok WHERE id = OLD.id_barang;	
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger herlinah_src.pembelian_after_insert
DROP TRIGGER IF EXISTS `pembelian_after_insert`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `pembelian_after_insert` AFTER INSERT ON `pembelian` FOR EACH ROW BEGIN
   DECLARE curr_stok INT;
   DECLARE lates_stok INT;
	SET curr_stok = (SELECT stok FROM barang WHERE id = NEW.id_barang);
   SET lates_stok = curr_stok + NEW.jumlah_barang;
   
	UPDATE barang SET stok = lates_stok WHERE id = NEW.id_barang;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger herlinah_src.pembelian_after_update
DROP TRIGGER IF EXISTS `pembelian_after_update`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `pembelian_after_update` AFTER UPDATE ON `pembelian` FOR EACH ROW BEGIN
 	DECLARE curr_stok INT;
 	DECLARE lates_stok INT;
 	SET curr_stok = (SELECT stok FROM barang WHERE id = NEW.id_barang) - OLD.jumlah_barang;
 	set lates_stok = curr_stok + NEW.jumlah_barang;
 	
 	UPDATE barang SET stok = lates_stok WHERE id = NEW.id_barang;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger herlinah_src.penjualan_after_delete
DROP TRIGGER IF EXISTS `penjualan_after_delete`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `penjualan_after_delete` AFTER DELETE ON `penjualan` FOR EACH ROW BEGIN
	UPDATE barang SET stok = stok + OLD.jumlah_barang WHERE id = OLD.id_barang;	
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger herlinah_src.penjualan_after_insert
DROP TRIGGER IF EXISTS `penjualan_after_insert`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `penjualan_after_insert` AFTER INSERT ON `penjualan` FOR EACH ROW BEGIN
   DECLARE curr_stok INT;
   DECLARE lates_stok INT;
	SET curr_stok = (SELECT stok FROM barang WHERE id = NEW.id_barang);
   SET lates_stok = curr_stok - NEW.jumlah_barang;
   
	UPDATE barang SET stok = lates_stok WHERE id = NEW.id_barang;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger herlinah_src.penjualan_after_update
DROP TRIGGER IF EXISTS `penjualan_after_update`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `penjualan_after_update` AFTER UPDATE ON `penjualan` FOR EACH ROW BEGIN
 	DECLARE curr_stok INT;
 	DECLARE lates_stok INT;
 	SET curr_stok = (SELECT stok FROM barang WHERE id = NEW.id_barang) + OLD.jumlah_barang;
 	set lates_stok = curr_stok - NEW.jumlah_barang;
 	
 	UPDATE barang SET stok = lates_stok WHERE id = NEW.id_barang;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger herlinah_src.transaksi_after_delete
DROP TRIGGER IF EXISTS `transaksi_after_delete`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `transaksi_after_delete` AFTER DELETE ON `transaksi` FOR EACH ROW BEGIN
	DELETE FROM penjualan WHERE id_transaksi = OLD.id_transaksi;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
