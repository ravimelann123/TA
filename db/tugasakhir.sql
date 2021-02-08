-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2021 at 01:48 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugasakhir`
--

-- --------------------------------------------------------

--
-- Table structure for table `dataset`
--

CREATE TABLE `dataset` (
  `id` bigint(20) NOT NULL,
  `chat` varchar(250) NOT NULL,
  `balas` varchar(250) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dataset`
--

INSERT INTO `dataset` (`id`, `chat`, `balas`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, 'hai', 'hai  juga', '2021-01-25 19:13:31', '2021-01-25 19:13:31', NULL),
(14, 'hi', 'hi juga', '2021-01-29 01:14:24', '2021-01-29 01:14:24', NULL),
(15, 'hay', 'hay juga', '2021-01-29 01:14:38', '2021-01-29 01:14:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kalimat`
--

CREATE TABLE `kalimat` (
  `id` bigint(20) NOT NULL,
  `users_id` bigint(20) NOT NULL,
  `kalimat` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kalimat`
--

INSERT INTO `kalimat` (`id`, `users_id`, `kalimat`, `created_at`, `updated_at`, `deleted_at`) VALUES
(626, 71, 'tampilkan seluruh pesanan', '2021-01-30 19:09:13', '2021-01-30 19:09:13', NULL),
(627, 71, 'pesan kue b10 12 b10 12', '2021-01-30 19:09:52', '2021-01-30 19:09:52', NULL),
(628, 71, 'pesan kue b10 12 c10 12', '2021-01-30 19:10:41', '2021-01-30 19:10:41', NULL),
(629, 71, 'batal pesanan nomor inv014171', '2021-01-30 19:10:54', '2021-01-30 19:10:54', NULL),
(630, 71, 'batal pesanan nomor inv014171', '2021-01-30 19:16:38', '2021-01-30 19:16:38', NULL),
(631, 71, 'batal pesanan nomor inv014171', '2021-01-30 19:17:16', '2021-01-30 19:17:16', NULL),
(632, 71, 'batal pesanan nomor inv015171', '2021-01-30 19:18:38', '2021-01-30 19:18:38', NULL),
(633, 71, 'batal pesanan nomor inv015271', '2021-01-30 19:19:20', '2021-01-30 19:19:20', NULL),
(634, 71, 'pesan b10 10', '2021-01-30 19:20:20', '2021-01-30 19:20:20', NULL),
(635, 71, 'batal pesanan nomor inv012071', '2021-01-30 19:20:27', '2021-01-30 19:20:27', NULL),
(636, 71, 'batal pesanan nomor inv012071', '2021-01-30 19:20:50', '2021-01-30 19:20:50', NULL),
(637, 71, 'batal pesanan nomor inv012071', '2021-01-30 19:20:55', '2021-01-30 19:20:55', NULL),
(638, 71, 'batal pesanan nomor inv012071', '2021-01-30 19:21:15', '2021-01-30 19:21:15', NULL),
(639, 71, 'batal pesanan nomor inv012071', '2021-01-30 19:27:21', '2021-01-30 19:27:21', NULL),
(640, 71, 'pesan b10 10', '2021-01-30 19:27:30', '2021-01-30 19:27:30', NULL),
(641, 71, 'batal pesanan nomor inv012071', '2021-01-30 19:27:45', '2021-01-30 19:27:45', NULL),
(642, 71, 'batal pesanan nomor inv012071', '2021-01-30 19:29:13', '2021-01-30 19:29:13', NULL),
(643, 71, 'pesan b10 10', '2021-01-30 19:30:12', '2021-01-30 19:30:12', NULL),
(644, 71, 'batal pesanan nomor inv011271', '2021-01-30 19:30:20', '2021-01-30 19:30:20', NULL),
(645, 71, 'tampilkan seluruh pesanan', '2021-01-30 19:32:07', '2021-01-30 19:32:07', NULL),
(646, 71, 'batal pesanan nomor inv013071', '2021-01-30 19:32:16', '2021-01-30 19:32:16', NULL),
(647, 71, 'batal pesanan nomor', '2021-01-30 19:33:50', '2021-01-30 19:33:50', NULL),
(648, 71, 'batal pesanan nomor', '2021-01-30 19:39:00', '2021-01-30 19:39:00', NULL),
(649, 71, 'batal pesanan nomor', '2021-01-30 19:39:49', '2021-01-30 19:39:49', NULL),
(650, 71, 'batal pesanan nomor inv013071', '2021-01-30 19:42:21', '2021-01-30 19:42:21', NULL),
(651, 71, 'batal pesanan nomor inv013071', '2021-01-30 19:42:49', '2021-01-30 19:42:49', NULL),
(652, 71, 'batal pesanan nomor inv013071', '2021-01-30 20:02:31', '2021-01-30 20:02:31', NULL),
(653, 71, 'batal pesanan nomor inv013071', '2021-01-30 20:02:48', '2021-01-30 20:02:48', NULL),
(654, 71, 'pesan b10 10', '2021-01-30 20:03:04', '2021-01-30 20:03:04', NULL),
(655, 71, 'batal pesanan nomor inv010471', '2021-01-30 20:03:31', '2021-01-30 20:03:31', NULL),
(656, 71, 'batal pesanan nomor inv010471', '2021-01-30 20:03:48', '2021-01-30 20:03:48', NULL),
(657, 71, 'pesan b10 10 c10 10 c5 10', '2021-01-30 20:04:09', '2021-01-30 20:04:09', NULL),
(658, 72, 'pesan b10 10', '2021-01-30 20:10:36', '2021-01-30 20:10:36', NULL),
(659, 72, 'pesan b10 112', '2021-01-30 20:19:14', '2021-01-30 20:19:14', NULL),
(660, 71, 'hai', '2021-01-31 20:00:37', '2021-01-31 20:00:37', NULL),
(661, 71, 'hai', '2021-02-02 22:58:44', '2021-02-02 22:58:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` varchar(50) NOT NULL,
  `prosesnlp_id` bigint(20) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `total` int(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `prosesnlp_id`, `status`, `total`, `created_at`, `updated_at`, `deleted_at`) VALUES
('inv010971', 1674, 'Pesanan Selesai', 900000, '2021-01-30 20:04:09', '2021-01-30 21:13:16', NULL),
('inv011472', 1676, 'Menunggu Diproses', 5040000, '2021-01-30 20:19:14', '2021-01-30 20:19:14', NULL),
('inv013672', 1675, 'Sedang Diproses', 450000, '2021-01-30 20:10:36', '2021-01-30 21:08:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `order_id` varchar(50) NOT NULL,
  `produk_id` bigint(20) NOT NULL,
  `jumlah` int(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`order_id`, `produk_id`, `jumlah`, `created_at`, `updated_at`, `deleted_at`) VALUES
('inv010971', 4, 10, '2021-01-30 20:04:09', '2021-01-30 20:04:09', NULL),
('inv010971', 37, 10, '2021-01-30 20:04:09', '2021-01-30 20:04:09', NULL),
('inv013672', 4, 10, '2021-01-30 20:10:36', '2021-01-30 20:10:36', NULL),
('inv011472', 4, 112, '2021-01-30 20:19:14', '2021-01-30 20:19:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` bigint(20) NOT NULL,
  `kode` varchar(25) DEFAULT NULL,
  `nama` varchar(25) NOT NULL,
  `deskripsi` varchar(200) NOT NULL,
  `harga` int(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kode`, `nama`, `deskripsi`, `harga`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'b10', 'kue bolu original', 'kemasan isi 10', 45000, '2020-10-12 23:15:47', '2021-01-26 00:57:13', NULL),
(5, 'kc10', 'kue kuning coklat', 'kemasan isi 10', 45000, '2020-10-13 16:13:34', '2021-01-26 00:57:24', NULL),
(37, 'c10', 'kue coklat', 'kemasan isi 10', 45000, '2021-01-26 00:53:02', '2021-01-26 00:53:02', NULL),
(40, 'itam10', 'kue ketan hitam', 'kemasan isi 10', 45000, '2021-01-28 15:50:35', '2021-01-28 15:50:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prosesnlp`
--

CREATE TABLE `prosesnlp` (
  `id` bigint(20) NOT NULL,
  `parsing` varchar(50) DEFAULT NULL,
  `kalimat_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prosesnlp`
--

INSERT INTO `prosesnlp` (`id`, `parsing`, `kalimat_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1643, 'aturan1', 626, '2021-01-30 19:09:13', '2021-01-30 19:09:13', NULL),
(1644, 'aturan2', 627, '2021-01-30 19:09:52', '2021-01-30 19:09:52', NULL),
(1645, 'aturan2', 628, '2021-01-30 19:10:41', '2021-01-30 19:10:41', NULL),
(1646, 'aturan3', 629, '2021-01-30 19:10:54', '2021-01-30 19:10:54', NULL),
(1647, 'aturan3', 630, '2021-01-30 19:16:38', '2021-01-30 19:16:38', NULL),
(1648, 'aturan3', 631, '2021-01-30 19:17:16', '2021-01-30 19:17:16', NULL),
(1649, 'aturan3', 632, '2021-01-30 19:18:38', '2021-01-30 19:18:38', NULL),
(1650, 'aturan3', 633, '2021-01-30 19:19:20', '2021-01-30 19:19:20', NULL),
(1651, 'aturan2', 634, '2021-01-30 19:20:20', '2021-01-30 19:20:20', NULL),
(1652, 'aturan3', 635, '2021-01-30 19:20:27', '2021-01-30 19:20:27', NULL),
(1653, 'aturan3', 636, '2021-01-30 19:20:50', '2021-01-30 19:20:50', NULL),
(1654, 'aturan3', 637, '2021-01-30 19:20:55', '2021-01-30 19:20:55', NULL),
(1655, 'aturan3', 638, '2021-01-30 19:21:15', '2021-01-30 19:21:15', NULL),
(1656, 'aturan3', 639, '2021-01-30 19:27:21', '2021-01-30 19:27:21', NULL),
(1657, 'aturan2', 640, '2021-01-30 19:27:30', '2021-01-30 19:27:30', NULL),
(1658, 'aturan3', 641, '2021-01-30 19:27:45', '2021-01-30 19:27:45', NULL),
(1659, 'aturan3', 642, '2021-01-30 19:29:13', '2021-01-30 19:29:13', NULL),
(1660, 'aturan2', 643, '2021-01-30 19:30:12', '2021-01-30 19:30:12', NULL),
(1661, 'aturan3', 644, '2021-01-30 19:30:20', '2021-01-30 19:30:20', NULL),
(1662, 'aturan1', 645, '2021-01-30 19:32:07', '2021-01-30 19:32:07', NULL),
(1663, 'aturan3', 646, '2021-01-30 19:32:16', '2021-01-30 19:32:16', NULL),
(1664, 'aturan3', 647, '2021-01-30 19:33:50', '2021-01-30 19:33:50', NULL),
(1665, 'aturan3', 648, '2021-01-30 19:39:00', '2021-01-30 19:39:00', NULL),
(1666, 'aturan3', 649, '2021-01-30 19:39:49', '2021-01-30 19:39:49', NULL),
(1667, 'aturan3', 650, '2021-01-30 19:42:21', '2021-01-30 19:42:21', NULL),
(1668, 'aturan3', 651, '2021-01-30 19:42:49', '2021-01-30 19:42:49', NULL),
(1669, 'aturan3', 652, '2021-01-30 20:02:31', '2021-01-30 20:02:31', NULL),
(1670, 'aturan3', 653, '2021-01-30 20:02:48', '2021-01-30 20:02:48', NULL),
(1671, 'aturan2', 654, '2021-01-30 20:03:04', '2021-01-30 20:03:04', NULL),
(1672, 'aturan3', 655, '2021-01-30 20:03:31', '2021-01-30 20:03:31', NULL),
(1673, 'aturan3', 656, '2021-01-30 20:03:48', '2021-01-30 20:03:48', NULL),
(1674, 'aturan2', 657, '2021-01-30 20:04:09', '2021-01-30 20:04:09', NULL),
(1675, 'aturan2', 658, '2021-01-30 20:10:36', '2021-01-30 20:10:36', NULL),
(1676, 'aturan2', 659, '2021-01-30 20:19:14', '2021-01-30 20:19:14', NULL),
(1677, '', 660, '2021-01-31 20:00:37', '2021-01-31 20:00:37', NULL),
(1678, '', 661, '2021-02-02 22:58:44', '2021-02-02 22:58:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prosesnlp_detail`
--

CREATE TABLE `prosesnlp_detail` (
  `id` bigint(20) NOT NULL,
  `kata` varchar(100) NOT NULL,
  `token` varchar(25) NOT NULL,
  `prosesnlp_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prosesnlp_detail`
--

INSERT INTO `prosesnlp_detail` (`id`, `kata`, `token`, `prosesnlp_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(830, 'tampilkan', '1', 1643, '2021-01-30 19:09:13', '2021-01-30 19:09:13', NULL),
(831, 'seluruh', '1', 1643, '2021-01-30 19:09:13', '2021-01-30 19:09:13', NULL),
(832, 'pesanan', '1', 1643, '2021-01-30 19:09:13', '2021-01-30 19:09:13', NULL),
(833, 'pesan', '1', 1644, '2021-01-30 19:09:52', '2021-01-30 19:09:52', NULL),
(834, 'kue', '0', 1644, '2021-01-30 19:09:52', '2021-01-30 19:09:52', NULL),
(835, 'b10', '0', 1644, '2021-01-30 19:09:52', '2021-01-30 19:09:52', NULL),
(836, '12', '0', 1644, '2021-01-30 19:09:52', '2021-01-30 19:09:52', NULL),
(837, 'b10', '0', 1644, '2021-01-30 19:09:52', '2021-01-30 19:09:52', NULL),
(838, '12', '0', 1644, '2021-01-30 19:09:52', '2021-01-30 19:09:52', NULL),
(839, 'pesan', '1', 1645, '2021-01-30 19:10:41', '2021-01-30 19:10:41', NULL),
(840, 'kue', '0', 1645, '2021-01-30 19:10:41', '2021-01-30 19:10:41', NULL),
(841, 'b10', '0', 1645, '2021-01-30 19:10:41', '2021-01-30 19:10:41', NULL),
(842, '12', '0', 1645, '2021-01-30 19:10:41', '2021-01-30 19:10:41', NULL),
(843, 'c10', '0', 1645, '2021-01-30 19:10:41', '2021-01-30 19:10:41', NULL),
(844, '12', '0', 1645, '2021-01-30 19:10:41', '2021-01-30 19:10:41', NULL),
(845, 'batal', '1', 1646, '2021-01-30 19:10:54', '2021-01-30 19:10:54', NULL),
(846, 'pesanan', '1', 1646, '2021-01-30 19:10:54', '2021-01-30 19:10:54', NULL),
(847, 'nomor', '1', 1646, '2021-01-30 19:10:54', '2021-01-30 19:10:54', NULL),
(848, 'inv014171', '0', 1646, '2021-01-30 19:10:54', '2021-01-30 19:10:54', NULL),
(849, 'batal', '1', 1647, '2021-01-30 19:16:38', '2021-01-30 19:16:38', NULL),
(850, 'pesanan', '1', 1647, '2021-01-30 19:16:38', '2021-01-30 19:16:38', NULL),
(851, 'nomor', '1', 1647, '2021-01-30 19:16:38', '2021-01-30 19:16:38', NULL),
(852, 'inv014171', '0', 1647, '2021-01-30 19:16:38', '2021-01-30 19:16:38', NULL),
(853, 'batal', '1', 1648, '2021-01-30 19:17:16', '2021-01-30 19:17:16', NULL),
(854, 'pesanan', '1', 1648, '2021-01-30 19:17:16', '2021-01-30 19:17:16', NULL),
(855, 'nomor', '1', 1648, '2021-01-30 19:17:16', '2021-01-30 19:17:16', NULL),
(856, 'inv014171', '0', 1648, '2021-01-30 19:17:16', '2021-01-30 19:17:16', NULL),
(857, 'batal', '1', 1649, '2021-01-30 19:18:38', '2021-01-30 19:18:38', NULL),
(858, 'pesanan', '1', 1649, '2021-01-30 19:18:38', '2021-01-30 19:18:38', NULL),
(859, 'nomor', '1', 1649, '2021-01-30 19:18:38', '2021-01-30 19:18:38', NULL),
(860, 'inv015171', '0', 1649, '2021-01-30 19:18:38', '2021-01-30 19:18:38', NULL),
(861, 'batal', '1', 1650, '2021-01-30 19:19:20', '2021-01-30 19:19:20', NULL),
(862, 'pesanan', '1', 1650, '2021-01-30 19:19:20', '2021-01-30 19:19:20', NULL),
(863, 'nomor', '1', 1650, '2021-01-30 19:19:20', '2021-01-30 19:19:20', NULL),
(864, 'inv015271', '0', 1650, '2021-01-30 19:19:20', '2021-01-30 19:19:20', NULL),
(865, 'pesan', '1', 1651, '2021-01-30 19:20:20', '2021-01-30 19:20:20', NULL),
(866, 'b10', '0', 1651, '2021-01-30 19:20:20', '2021-01-30 19:20:20', NULL),
(867, '10', '0', 1651, '2021-01-30 19:20:20', '2021-01-30 19:20:20', NULL),
(868, 'batal', '1', 1652, '2021-01-30 19:20:27', '2021-01-30 19:20:27', NULL),
(869, 'pesanan', '1', 1652, '2021-01-30 19:20:27', '2021-01-30 19:20:27', NULL),
(870, 'nomor', '1', 1652, '2021-01-30 19:20:27', '2021-01-30 19:20:27', NULL),
(871, 'inv012071', '0', 1652, '2021-01-30 19:20:27', '2021-01-30 19:20:27', NULL),
(872, 'batal', '1', 1653, '2021-01-30 19:20:50', '2021-01-30 19:20:50', NULL),
(873, 'pesanan', '1', 1653, '2021-01-30 19:20:50', '2021-01-30 19:20:50', NULL),
(874, 'nomor', '1', 1653, '2021-01-30 19:20:50', '2021-01-30 19:20:50', NULL),
(875, 'inv012071', '0', 1653, '2021-01-30 19:20:50', '2021-01-30 19:20:50', NULL),
(876, 'batal', '1', 1654, '2021-01-30 19:20:55', '2021-01-30 19:20:55', NULL),
(877, 'pesanan', '1', 1654, '2021-01-30 19:20:55', '2021-01-30 19:20:55', NULL),
(878, 'nomor', '1', 1654, '2021-01-30 19:20:55', '2021-01-30 19:20:55', NULL),
(879, 'inv012071', '0', 1654, '2021-01-30 19:20:55', '2021-01-30 19:20:55', NULL),
(880, 'batal', '1', 1655, '2021-01-30 19:21:15', '2021-01-30 19:21:15', NULL),
(881, 'pesanan', '1', 1655, '2021-01-30 19:21:15', '2021-01-30 19:21:15', NULL),
(882, 'nomor', '1', 1655, '2021-01-30 19:21:15', '2021-01-30 19:21:15', NULL),
(883, 'inv012071', '0', 1655, '2021-01-30 19:21:15', '2021-01-30 19:21:15', NULL),
(884, 'batal', '1', 1656, '2021-01-30 19:27:21', '2021-01-30 19:27:21', NULL),
(885, 'pesanan', '1', 1656, '2021-01-30 19:27:21', '2021-01-30 19:27:21', NULL),
(886, 'nomor', '1', 1656, '2021-01-30 19:27:21', '2021-01-30 19:27:21', NULL),
(887, 'inv012071', '0', 1656, '2021-01-30 19:27:21', '2021-01-30 19:27:21', NULL),
(888, 'pesan', '1', 1657, '2021-01-30 19:27:30', '2021-01-30 19:27:30', NULL),
(889, 'b10', '0', 1657, '2021-01-30 19:27:30', '2021-01-30 19:27:30', NULL),
(890, '10', '0', 1657, '2021-01-30 19:27:30', '2021-01-30 19:27:30', NULL),
(891, 'batal', '1', 1658, '2021-01-30 19:27:45', '2021-01-30 19:27:45', NULL),
(892, 'pesanan', '1', 1658, '2021-01-30 19:27:45', '2021-01-30 19:27:45', NULL),
(893, 'nomor', '1', 1658, '2021-01-30 19:27:45', '2021-01-30 19:27:45', NULL),
(894, 'inv012071', '0', 1658, '2021-01-30 19:27:45', '2021-01-30 19:27:45', NULL),
(895, 'batal', '1', 1659, '2021-01-30 19:29:13', '2021-01-30 19:29:13', NULL),
(896, 'pesanan', '1', 1659, '2021-01-30 19:29:13', '2021-01-30 19:29:13', NULL),
(897, 'nomor', '1', 1659, '2021-01-30 19:29:13', '2021-01-30 19:29:13', NULL),
(898, 'inv012071', '0', 1659, '2021-01-30 19:29:13', '2021-01-30 19:29:13', NULL),
(899, 'pesan', '1', 1660, '2021-01-30 19:30:12', '2021-01-30 19:30:12', NULL),
(900, 'b10', '0', 1660, '2021-01-30 19:30:12', '2021-01-30 19:30:12', NULL),
(901, '10', '0', 1660, '2021-01-30 19:30:12', '2021-01-30 19:30:12', NULL),
(902, 'batal', '1', 1661, '2021-01-30 19:30:20', '2021-01-30 19:30:20', NULL),
(903, 'pesanan', '1', 1661, '2021-01-30 19:30:20', '2021-01-30 19:30:20', NULL),
(904, 'nomor', '1', 1661, '2021-01-30 19:30:20', '2021-01-30 19:30:20', NULL),
(905, 'inv011271', '0', 1661, '2021-01-30 19:30:20', '2021-01-30 19:30:20', NULL),
(906, 'tampilkan', '1', 1662, '2021-01-30 19:32:07', '2021-01-30 19:32:07', NULL),
(907, 'seluruh', '1', 1662, '2021-01-30 19:32:07', '2021-01-30 19:32:07', NULL),
(908, 'pesanan', '1', 1662, '2021-01-30 19:32:07', '2021-01-30 19:32:07', NULL),
(909, 'batal', '1', 1663, '2021-01-30 19:32:16', '2021-01-30 19:32:16', NULL),
(910, 'pesanan', '1', 1663, '2021-01-30 19:32:16', '2021-01-30 19:32:16', NULL),
(911, 'nomor', '1', 1663, '2021-01-30 19:32:16', '2021-01-30 19:32:16', NULL),
(912, 'inv013071', '0', 1663, '2021-01-30 19:32:16', '2021-01-30 19:32:16', NULL),
(913, 'batal', '1', 1664, '2021-01-30 19:33:50', '2021-01-30 19:33:50', NULL),
(914, 'pesanan', '1', 1664, '2021-01-30 19:33:50', '2021-01-30 19:33:50', NULL),
(915, 'nomor', '1', 1664, '2021-01-30 19:33:50', '2021-01-30 19:33:50', NULL),
(916, 'batal', '1', 1665, '2021-01-30 19:39:00', '2021-01-30 19:39:00', NULL),
(917, 'pesanan', '1', 1665, '2021-01-30 19:39:00', '2021-01-30 19:39:00', NULL),
(918, 'nomor', '1', 1665, '2021-01-30 19:39:00', '2021-01-30 19:39:00', NULL),
(919, 'batal', '1', 1666, '2021-01-30 19:39:49', '2021-01-30 19:39:49', NULL),
(920, 'pesanan', '1', 1666, '2021-01-30 19:39:49', '2021-01-30 19:39:49', NULL),
(921, 'nomor', '1', 1666, '2021-01-30 19:39:49', '2021-01-30 19:39:49', NULL),
(922, 'batal', '1', 1667, '2021-01-30 19:42:21', '2021-01-30 19:42:21', NULL),
(923, 'pesanan', '1', 1667, '2021-01-30 19:42:21', '2021-01-30 19:42:21', NULL),
(924, 'nomor', '1', 1667, '2021-01-30 19:42:21', '2021-01-30 19:42:21', NULL),
(925, 'inv013071', '0', 1667, '2021-01-30 19:42:21', '2021-01-30 19:42:21', NULL),
(926, 'batal', '1', 1668, '2021-01-30 19:42:49', '2021-01-30 19:42:49', NULL),
(927, 'pesanan', '1', 1668, '2021-01-30 19:42:49', '2021-01-30 19:42:49', NULL),
(928, 'nomor', '1', 1668, '2021-01-30 19:42:49', '2021-01-30 19:42:49', NULL),
(929, 'inv013071', '0', 1668, '2021-01-30 19:42:49', '2021-01-30 19:42:49', NULL),
(930, 'batal', '1', 1669, '2021-01-30 20:02:31', '2021-01-30 20:02:31', NULL),
(931, 'pesanan', '1', 1669, '2021-01-30 20:02:31', '2021-01-30 20:02:31', NULL),
(932, 'nomor', '1', 1669, '2021-01-30 20:02:31', '2021-01-30 20:02:31', NULL),
(933, 'inv013071', '0', 1669, '2021-01-30 20:02:31', '2021-01-30 20:02:31', NULL),
(934, 'batal', '1', 1670, '2021-01-30 20:02:48', '2021-01-30 20:02:48', NULL),
(935, 'pesanan', '1', 1670, '2021-01-30 20:02:48', '2021-01-30 20:02:48', NULL),
(936, 'nomor', '1', 1670, '2021-01-30 20:02:48', '2021-01-30 20:02:48', NULL),
(937, 'inv013071', '0', 1670, '2021-01-30 20:02:48', '2021-01-30 20:02:48', NULL),
(938, 'pesan', '1', 1671, '2021-01-30 20:03:04', '2021-01-30 20:03:04', NULL),
(939, 'b10', '0', 1671, '2021-01-30 20:03:04', '2021-01-30 20:03:04', NULL),
(940, '10', '0', 1671, '2021-01-30 20:03:04', '2021-01-30 20:03:04', NULL),
(941, 'batal', '1', 1672, '2021-01-30 20:03:31', '2021-01-30 20:03:31', NULL),
(942, 'pesanan', '1', 1672, '2021-01-30 20:03:31', '2021-01-30 20:03:31', NULL),
(943, 'nomor', '1', 1672, '2021-01-30 20:03:31', '2021-01-30 20:03:31', NULL),
(944, 'inv010471', '0', 1672, '2021-01-30 20:03:31', '2021-01-30 20:03:31', NULL),
(945, 'batal', '1', 1673, '2021-01-30 20:03:48', '2021-01-30 20:03:48', NULL),
(946, 'pesanan', '1', 1673, '2021-01-30 20:03:48', '2021-01-30 20:03:48', NULL),
(947, 'nomor', '1', 1673, '2021-01-30 20:03:48', '2021-01-30 20:03:48', NULL),
(948, 'inv010471', '0', 1673, '2021-01-30 20:03:48', '2021-01-30 20:03:48', NULL),
(949, 'pesan', '1', 1674, '2021-01-30 20:04:09', '2021-01-30 20:04:09', NULL),
(950, 'b10', '0', 1674, '2021-01-30 20:04:09', '2021-01-30 20:04:09', NULL),
(951, '10', '0', 1674, '2021-01-30 20:04:09', '2021-01-30 20:04:09', NULL),
(952, 'c10', '0', 1674, '2021-01-30 20:04:09', '2021-01-30 20:04:09', NULL),
(953, '10', '0', 1674, '2021-01-30 20:04:09', '2021-01-30 20:04:09', NULL),
(954, 'c5', '0', 1674, '2021-01-30 20:04:09', '2021-01-30 20:04:09', NULL),
(955, '10', '0', 1674, '2021-01-30 20:04:09', '2021-01-30 20:04:09', NULL),
(956, 'pesan', '1', 1675, '2021-01-30 20:10:36', '2021-01-30 20:10:36', NULL),
(957, 'b10', '0', 1675, '2021-01-30 20:10:36', '2021-01-30 20:10:36', NULL),
(958, '10', '0', 1675, '2021-01-30 20:10:36', '2021-01-30 20:10:36', NULL),
(959, 'pesan', '1', 1676, '2021-01-30 20:19:14', '2021-01-30 20:19:14', NULL),
(960, 'b10', '0', 1676, '2021-01-30 20:19:14', '2021-01-30 20:19:14', NULL),
(961, '112', '0', 1676, '2021-01-30 20:19:14', '2021-01-30 20:19:14', NULL),
(962, 'hai', '0', 1677, '2021-01-31 20:00:37', '2021-01-31 20:00:37', NULL),
(963, 'hai', '0', 1678, '2021-02-02 22:58:44', '2021-02-02 22:58:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `similarity`
--

CREATE TABLE `similarity` (
  `id` bigint(20) NOT NULL,
  `prosesnlp_id` bigint(20) DEFAULT NULL,
  `dataset_id` bigint(20) DEFAULT NULL,
  `similarity` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `similarity`
--

INSERT INTO `similarity` (`id`, `prosesnlp_id`, `dataset_id`, `similarity`, `created_at`, `updated_at`, `deleted_at`) VALUES
(398, 1677, 12, '1', '2021-01-31 20:00:37', '2021-01-31 20:00:37', NULL),
(399, 1677, 14, '0', '2021-01-31 20:00:37', '2021-01-31 20:00:37', NULL),
(400, 1677, 15, '0', '2021-01-31 20:00:37', '2021-01-31 20:00:37', NULL),
(401, 1678, 12, '1', '2021-02-02 22:58:44', '2021-02-02 22:58:44', NULL),
(402, 1678, 14, '0', '2021-02-02 22:58:44', '2021-02-02 22:58:44', NULL),
(403, 1678, 15, '0', '2021-02-02 22:58:44', '2021-02-02 22:58:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nohp` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `username`, `nama`, `email`, `nohp`, `alamat`, `avatar`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES
(66, 'admin', 'raviadmin', 'Ravi - admin', 'melan485@gmail.com', '081299188617', 'Jalan pandan wangi 2 Blok D4/20', '1711500072_4x6.jpg', '$2y$10$eXT6vQCnkXw7Xf.P3L0ICuolGNHH5IYgVH3duBTEGV4LAExnZPXN2', '2021-01-25 18:49:12', '2021-01-26 00:06:21', NULL),
(71, 'user', 'raviuser', 'Ravi - user', 'example@gmail.com', '085156313078', 'SIP', '1711500072.jpg', '$2y$10$y0VIBFCfrY50Gq/QHqoQ9umIA70KO8/Q9MFp.KDPqOa7OfuVQBEGi', '2021-01-26 00:05:25', '2021-01-26 00:06:08', NULL),
(72, 'user', 'raviuser1', 'Default Name', NULL, NULL, NULL, NULL, '$2y$10$aC9uWfAKDsU4yiyJm9L0deb/QGhjpH.WaGx5UPjaWreGYeUQ/AyTe', '2021-01-30 20:10:13', '2021-01-30 20:10:13', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dataset`
--
ALTER TABLE `dataset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kalimat`
--
ALTER TABLE `kalimat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prosesnlp`
--
ALTER TABLE `prosesnlp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prosesnlp_detail`
--
ALTER TABLE `prosesnlp_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `similarity`
--
ALTER TABLE `similarity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dataset`
--
ALTER TABLE `dataset`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kalimat`
--
ALTER TABLE `kalimat`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=662;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `prosesnlp`
--
ALTER TABLE `prosesnlp`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1679;

--
-- AUTO_INCREMENT for table `prosesnlp_detail`
--
ALTER TABLE `prosesnlp_detail`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=964;

--
-- AUTO_INCREMENT for table `similarity`
--
ALTER TABLE `similarity`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=404;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
