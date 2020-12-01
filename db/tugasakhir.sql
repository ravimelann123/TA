-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2020 at 05:41 AM
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
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `users_id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nohp` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id`, `users_id`, `nama`, `email`, `nohp`, `alamat`, `avatar`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 5, 'Ravi Melan', 'datates1@gmail.com', '081299188617', 'Sarana Indah Permai', '1711500072.jpg', '2020-10-07 22:49:21', '2020-10-25 20:28:27', NULL),
(15, 15, 'Admin app', 'melan485@gmail.com', '081299188617', 'sarana', 'account.png', '2020-10-21 23:43:19', '2020-10-29 19:31:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `aturan`
--

CREATE TABLE `aturan` (
  `id` int(11) NOT NULL,
  `tag` varchar(50) NOT NULL,
  `aturanproduksi` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aturan`
--

INSERT INTO `aturan` (`id`, `tag`, `aturanproduksi`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'aturan1', 'tampilkan seluruh produk ', NULL, NULL, NULL),
(2, 'aturan1', 'tampilkan seluruh pesanan ', NULL, NULL, NULL),
(3, 'aturan1', 'tampilkan nama produk ', NULL, NULL, NULL),
(4, 'aturan1', 'tampilkan harga produk ', NULL, NULL, NULL),
(5, 'aturan1', 'tampilkan nama produk harga produk ', NULL, NULL, NULL),
(7, 'aturan1', 'tampilkan status pesanan ', NULL, NULL, NULL),
(8, 'aturan2', 'pesan ', NULL, NULL, NULL),
(9, 'aturan3', 'batalkan pesanan bernomer ', NULL, NULL, NULL),
(10, 'aturan3', 'batalkan pesanan nomer ', NULL, NULL, NULL),
(11, 'aturan4', 'ubah pesanan', NULL, NULL, NULL),
(12, 'aturan5', 'berapa jumlah pesanan ', NULL, NULL, NULL),
(13, 'aturan5', 'berapa jumlah biaya pesanan ', NULL, NULL, NULL),
(14, 'aturan6', 'kapan pesanan nomer ', NULL, NULL, NULL),
(15, 'aturan7', 'apa pesanan nomer ', NULL, NULL, NULL),
(16, 'aturan7', 'apa produk ditawarkan ', NULL, NULL, NULL),
(17, 'aturan3', 'batalkan pesanan tanggal', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bahasaalami`
--

CREATE TABLE `bahasaalami` (
  `id` int(11) NOT NULL,
  `tag` varchar(50) NOT NULL,
  `kata` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bahasaalami`
--

INSERT INTO `bahasaalami` (`id`, `tag`, `kata`, `created_at`, `updated_at`, `deleted_at`) VALUES
(27, 'kata perintah', 'tampilkan', '2020-11-30 04:29:39', '2020-11-30 04:29:39', NULL),
(28, 'operator', 'seluruh', '2020-11-30 04:30:14', '2020-11-30 04:30:14', NULL),
(29, 'kata', 'pesanan', '2020-11-30 04:30:51', '2020-11-30 04:30:51', NULL),
(30, 'kata', 'produk', '2020-11-30 04:30:51', '2020-11-30 04:30:51', NULL),
(31, 'atribut', 'nama', '2020-11-30 04:32:20', '2020-11-30 04:32:20', NULL),
(32, 'atribut', 'harga', '2020-11-30 04:32:20', '2020-11-30 04:32:20', NULL),
(33, 'atribut', 'status', '2020-11-30 04:33:08', '2020-11-30 04:33:08', NULL),
(34, 'kata perintah', 'pesan', '2020-11-30 04:33:08', '2020-11-30 04:33:08', NULL),
(35, 'kata perintah', 'batalkan', '2020-11-30 04:33:44', '2020-11-30 04:33:44', NULL),
(36, 'kata', 'bernomer', '2020-11-30 04:33:44', '2020-11-30 04:33:44', NULL),
(37, 'atribut', 'nomer', '2020-11-30 04:34:32', '2020-11-30 04:34:32', NULL),
(38, 'kata perintah', 'ubah', '2020-11-30 04:34:32', '2020-11-30 04:34:32', NULL),
(39, 'kata tanya', 'berapa', '2020-11-30 04:38:37', '2020-11-30 04:38:37', NULL),
(40, 'kata', 'jumlah', '2020-11-30 04:38:37', '2020-11-30 04:38:37', NULL),
(41, 'kata', 'biaya', '2020-11-30 04:39:10', '2020-11-30 04:39:10', NULL),
(42, 'kata tanya', 'kapan', '2020-11-30 04:39:10', '2020-11-30 04:39:10', NULL),
(43, 'kata tanya', 'apa', '2020-11-30 04:39:40', '2020-11-30 04:39:40', NULL),
(44, 'kata', 'ditawarkan', '2020-11-30 04:40:14', '2020-11-30 04:40:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `jumlah` int(20) NOT NULL,
  `users_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `chatbot`
--

CREATE TABLE `chatbot` (
  `id` int(11) NOT NULL,
  `chat` varchar(300) NOT NULL,
  `balas` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chatbot`
--

INSERT INTO `chatbot` (`id`, `chat`, `balas`) VALUES
(1, 'hi', 'hi juga'),
(2, 'siapa nama kamu', 'nama saya Bot Kue Bolu RM'),
(3, 'hallo', 'hallo juga'),
(4, 'hai', 'hai juga');

-- --------------------------------------------------------

--
-- Table structure for table `kalimat`
--

CREATE TABLE `kalimat` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `kalimat` varchar(100) NOT NULL,
  `parsing` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_10_05_015655_create_users_table', 1),
(2, '2020_10_06_023041_create_akun_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `nomerpesanan` varchar(50) NOT NULL,
  `users_id` int(11) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `total` int(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `nomerpesanan`, `users_id`, `status`, `total`, `created_at`, `updated_at`, `deleted_at`) VALUES
(14, 'o20201016345', 5, 'Pesanan Selesai', 180000, '2020-10-15 23:00:34', '2020-10-18 23:24:31', NULL),
(19, 'o20201019455', 5, 'Sedang Diproses', 225000, '2020-10-18 21:26:45', '2020-10-18 21:26:45', NULL),
(21, 'o20201019535', 5, 'Menunggu Diproses', 90000, '2020-10-18 21:53:53', '2020-10-18 21:53:53', NULL),
(84, 'o20201130545', 5, 'Menunggu Diproses', 675000, '2020-11-29 19:11:54', '2020-11-29 19:11:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `jumlah` int(15) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`id`, `order_id`, `produk_id`, `jumlah`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, 14, 4, 2, '2020-10-15 23:00:34', '2020-10-15 23:00:34', NULL),
(11, 14, 5, 2, '2020-10-15 23:00:34', '2020-10-15 23:00:34', NULL),
(16, 19, 10, 2, '2020-10-18 21:26:45', '2020-10-18 21:26:45', NULL),
(17, 19, 5, 3, '2020-10-18 21:26:45', '2020-10-18 21:26:45', NULL),
(18, 21, 10, 2, '2020-10-18 21:53:53', '2020-10-18 21:53:53', NULL),
(70, 84, 4, 10, '2020-11-29 19:11:54', '2020-11-29 19:11:54', NULL),
(71, 84, 11, 5, '2020-11-29 19:11:54', '2020-11-29 19:11:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE `photo` (
  `id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `namafoto` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`id`, `produk_id`, `namafoto`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 4, 'Screenshot_1.png', '2020-10-12 23:15:47', '2020-10-12 23:15:47', NULL),
(8, 5, 'gmail-email-logo-png-16.png', '2020-10-13 16:13:34', '2020-10-13 16:13:34', NULL),
(14, 10, 'logo-bl.jpg', '2020-10-15 18:47:08', '2020-10-15 18:47:08', NULL),
(15, 11, 'business.png', '2020-10-15 18:47:23', '2020-10-15 18:47:23', NULL),
(17, 13, 'Screenshot_1.jpg', '2020-10-21 19:37:31', '2020-10-21 19:37:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `stok` int(25) NOT NULL,
  `harga` int(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `deskripsi`, `stok`, `harga`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'b10', 'Kue Bolu Isi 10', 1000, 45000, '2020-10-12 23:15:47', '2020-11-02 20:45:58', NULL),
(5, 'kc10', 'Kue Kuning Coklat Isi 10', 1000, 45000, '2020-10-13 16:13:34', '2020-11-26 19:02:43', NULL),
(10, 'itam10', 'Kue Itam Isi 10', 1000, 45000, '2020-10-15 18:47:08', '2020-10-31 22:39:08', NULL),
(11, 'c10', 'Kue Coklat Isi 10', 1000, 45000, '2020-10-15 18:47:23', '2020-10-31 22:39:08', NULL),
(13, 'kc5', 'Kue Kuning Coklat Isi 5', 1000, 45000, '2020-10-21 19:37:31', '2020-10-31 22:39:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prosesnlp`
--

CREATE TABLE `prosesnlp` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `proses_id` varchar(50) NOT NULL,
  `kalimat_id` varchar(255) DEFAULT NULL,
  `kata` varchar(255) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `similaritytable`
--

CREATE TABLE `similaritytable` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `training_id` varchar(50) NOT NULL,
  `pesan` varchar(255) DEFAULT NULL,
  `balas` varchar(255) DEFAULT NULL,
  `similarity` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tambahstok`
--

CREATE TABLE `tambahstok` (
  `id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `stok` int(25) NOT NULL,
  `users_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tambahstok`
--

INSERT INTO `tambahstok` (`id`, `produk_id`, `stok`, `users_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(33, 4, 10, 15, '2020-10-27 18:28:54', '2020-10-27 18:28:54', NULL),
(60, 4, 10, 15, '2020-10-27 21:34:04', '2020-10-27 21:34:04', NULL),
(66, 5, 10, 15, '2020-11-10 22:35:36', '2020-11-10 22:35:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `username`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 'user', 'ravimelann', '$2y$10$t3E1YW2DsZ4bl28Dcbkx8O6GKXwQk0D8vUyWPUTDJVv4pWGk/ufxK', '2020-10-07 22:49:21', '2020-10-29 20:09:51', NULL),
(15, 'admin', 'xx', '$2y$10$jsyjak3I3Pq80x17XJkgfO3QNwKM3kaYNuHoOKenqqAaU5m2EOJQK', '2020-10-21 23:43:19', '2020-10-22 00:55:29', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `akun_email_unique` (`email`);

--
-- Indexes for table `aturan`
--
ALTER TABLE `aturan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bahasaalami`
--
ALTER TABLE `bahasaalami`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chatbot`
--
ALTER TABLE `chatbot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kalimat`
--
ALTER TABLE `kalimat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
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
-- Indexes for table `similaritytable`
--
ALTER TABLE `similaritytable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tambahstok`
--
ALTER TABLE `tambahstok`
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
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `aturan`
--
ALTER TABLE `aturan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `bahasaalami`
--
ALTER TABLE `bahasaalami`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `chatbot`
--
ALTER TABLE `chatbot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kalimat`
--
ALTER TABLE `kalimat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `prosesnlp`
--
ALTER TABLE `prosesnlp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=371;

--
-- AUTO_INCREMENT for table `similaritytable`
--
ALTER TABLE `similaritytable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `tambahstok`
--
ALTER TABLE `tambahstok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
