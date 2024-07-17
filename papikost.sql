-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:4306
-- Generation Time: Apr 07, 2023 at 10:01 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `papikost`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gambars`
--

CREATE TABLE `gambars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_kost` bigint(20) NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gambars`
--

INSERT INTO `gambars` (`id`, `id_kost`, `file`, `created_at`, `updated_at`) VALUES
(1, 1, 'uploads/images/2107931de60c5a7c5d526bd1d6a8a34d.jpg', '2023-04-07 00:03:01', '2023-04-07 00:03:01'),
(2, 1, 'uploads/images/4da9d7b6d119db4d2d564a2197798380.jpg', '2023-04-07 00:03:01', '2023-04-07 00:03:01'),
(3, 1, 'uploads/images/3a824154b16ed7dab899bf000b80eeee.jpg', '2023-04-07 00:03:01', '2023-04-07 00:03:01'),
(4, 1, 'uploads/images/e60e81c4cbe5171cd654662d9887aec2.jpg', '2023-04-07 00:03:01', '2023-04-07 00:03:01'),
(12, 2, 'uploads/images/7bfa32686d200c64cb46de03ac2eac0d.jpg', '2023-04-07 00:48:35', '2023-04-07 00:48:35'),
(13, 2, 'uploads/images/85ea6fd7a2ca3960d0cf5201933ac998.jpg', '2023-04-07 00:48:35', '2023-04-07 00:48:35'),
(14, 2, 'uploads/images/2d1ef8f39d2c1590daf9a3737c8a931d.jpg', '2023-04-07 00:48:35', '2023-04-07 00:48:35'),
(15, 3, 'uploads/images/77bdfcff53815626ecab7f6a1454f007.jpg', '2023-04-07 00:59:55', '2023-04-07 00:59:55'),
(16, 3, 'uploads/images/51681a7c14879f9eca39669df858f75b.jpg', '2023-04-07 00:59:55', '2023-04-07 00:59:55'),
(17, 3, 'uploads/images/3bbfdde8842a5c44a0323518eec97cbe.jpg', '2023-04-07 00:59:55', '2023-04-07 00:59:55');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kost`
--

CREATE TABLE `jenis_kost` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_kost`
--

INSERT INTO `jenis_kost` (`id`, `jenis`, `created_at`, `updated_at`) VALUES
(1, 'Putra', '2023-04-06 23:45:43', '2023-04-06 23:45:43'),
(2, 'Putri', '2023-04-06 23:45:43', '2023-04-06 23:45:43'),
(3, 'Campur', '2023-04-06 23:45:43', '2023-04-06 23:45:43'),
(4, 'Pasutri', '2023-04-06 23:45:43', '2023-04-06 23:45:43');

-- --------------------------------------------------------

--
-- Table structure for table `kost`
--

CREATE TABLE `kost` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pemilik` bigint(20) NOT NULL,
  `jenis_kost_id` bigint(20) NOT NULL,
  `nama_kost` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_kamar` int(11) NOT NULL,
  `fasilitas_kost` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `luas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `long` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tarif_perbulan` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kost`
--

INSERT INTO `kost` (`id`, `id_pemilik`, `jenis_kost_id`, `nama_kost`, `jumlah_kamar`, `fasilitas_kost`, `keterangan`, `luas`, `lokasi`, `lat`, `long`, `alamat`, `tarif_perbulan`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Kost Karunia', 4, '<ul><li>Ada 2 kamar mandi</li><li>Ruang Dapur</li><li>Ruang Tamu</li><li>Jemuran pakaian</li><li>Parkir motor terlindung</li></ul>', '<ul><li>Lokasi istimewa:</li><li>Warung makan 2 meter</li><li>Masjid 10 meter</li><li>Gardena 50 meter</li><li>Indomaret 2 menit</li></ul><p>&nbsp;</p>', '4x4', '-7.783239507216701, 110.38381879453736', '-7.783239507216701', '110.38381879453736', NULL, 400000, '2023-04-07 00:03:01', '2023-04-07 00:34:14'),
(2, 1, 2, 'Kost Sakura', 4, '<ul><li>Halaman parkir luas</li><li>Free Wifi</li><li>Dapur bersama</li><li>Kompor gas dan alat masak tinggal pakai</li><li>Kasur, bantal + guling, kipas</li><li>Bebas jam malam</li><li>Bawa kucing boleh (asal bersih)</li></ul>', '<ul><li>Kost 2 lantai&nbsp;</li><li>Kamar kosongan ada&nbsp;</li><li>Kamar isian ada&nbsp;</li><li>Toilet Luar, Dalam ada&nbsp;</li><li>*Lokasi kost strategis, ke jalan raya cuma 50 meteran</li></ul>', '4x4', '-7.769190654232467, 110.42762046825953', '-7.769190654232467', '110.42762046825953', NULL, 300000, '2023-04-07 00:44:13', '2023-04-07 00:44:13'),
(3, 2, 1, 'Kost Arjuna', 2, '<ul><li>Free air</li><li>Dapur bersama</li><li>Wifi</li></ul>', '<ul><li>Pinggir sawah</li><li>View pagi merapi, view sunset</li><li>Ada parir mobil, motor didalam</li><li>Bebas jam malam</li></ul>', '4x4', '-7.7901199081228745, 110.3006945109331', '-7.7901199081228745', '110.3006945109331', NULL, 450000, '2023-04-07 00:59:55', '2023-04-07 00:59:55');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_02_22_163655_create_gambars_table', 1),
(6, '2023_02_22_163705_create_jenis_kost_table', 1),
(7, '2023_02_22_163715_create_pemilik_table', 1),
(8, '2023_02_22_163721_create_penghuni_table', 1),
(9, '2023_02_22_163726_create_pesanan_table', 1),
(10, '2023_02_22_164504_create_kost_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemilik`
--

CREATE TABLE `pemilik` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `no_tlp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rek` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemilik`
--

INSERT INTO `pemilik` (`id`, `user_id`, `no_tlp`, `no_rek`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 3, '08249585393579', '352892350', 'Jl. Raya Janti No. 143, Karang Jambe, Banguntapan', '2023-04-06 23:48:03', '2023-04-06 23:48:03'),
(2, 4, '6289658253256', '98256085', 'jl. in aja dulu', '2023-04-06 23:49:07', '2023-04-06 23:49:07');

-- --------------------------------------------------------

--
-- Table structure for table `penghuni`
--

CREATE TABLE `penghuni` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `no_tlp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penghuni`
--

INSERT INTO `penghuni` (`id`, `user_id`, `no_tlp`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 2, '6281269336785', 'Nglipar Lor, Nglipar, Kec. Nglipar, Kabupaten Gunung Kidul', '2023-04-06 23:46:58', '2023-04-06 23:46:58'),
(2, 5, '6281269336785', 'jl. yang lurus', '2023-04-06 23:49:57', '2023-04-06 23:49:57');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_penghuni` bigint(20) NOT NULL,
  `id_kost` bigint(20) NOT NULL,
  `kode_trx` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `jml_bulan` bigint(20) NOT NULL,
  `nominal` bigint(20) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `via_bayar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `snap_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bukti_bayar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('Admin','Pemilik','Penghuni') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `status`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'super admin', 'admin@admin.com', NULL, '$2y$10$zQbcBFLmr6FKGgH/d3nYh.IqAAbLS.JitMfJaBplNiFgEdBAz8ucK', NULL, 'Admin', NULL, '2023-04-06 23:45:43', '2023-04-06 23:45:43'),
(2, 'Alfian Fahrizal', 'alfian@gmail.com', NULL, '$2y$10$kJlc14FklgY2RhVVFQ.Ce.g5BMMCyO.zpC.ZN8.yJ9EMYhDFFWXWW', NULL, 'Penghuni', NULL, '2023-04-06 23:46:58', '2023-04-06 23:46:58'),
(3, 'Nanda Ilham', 'nanda@gmail.com', NULL, '$2y$10$V6ce88/hNqkcRpZAevO1lOD3rI2rG.K1fekJ5BFzs2fXUJXeGewom', 'aktif', 'Pemilik', NULL, '2023-04-06 23:48:03', '2023-04-06 23:59:11'),
(4, 'Agrin Fauzi', 'agrin@gmail.com', NULL, '$2y$10$/YZZmfayf.A/Ljf6pDZxjuImRic42xVZpk31uNNV7VZY.xMbd.yEG', 'aktif', 'Pemilik', NULL, '2023-04-06 23:49:07', '2023-04-06 23:58:53'),
(5, 'Nurdiyanto', 'nur@gmail.com', NULL, '$2y$10$U1EkacsWpg.W4pvjCY7o7OIdqwC1cPPEhClRljJ3npDWY/G/x9HY.', NULL, 'Penghuni', NULL, '2023-04-06 23:49:57', '2023-04-06 23:49:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gambars`
--
ALTER TABLE `gambars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_kost`
--
ALTER TABLE `jenis_kost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kost`
--
ALTER TABLE `kost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pemilik`
--
ALTER TABLE `pemilik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penghuni`
--
ALTER TABLE `penghuni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gambars`
--
ALTER TABLE `gambars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `jenis_kost`
--
ALTER TABLE `jenis_kost`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kost`
--
ALTER TABLE `kost`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pemilik`
--
ALTER TABLE `pemilik`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penghuni`
--
ALTER TABLE `penghuni`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
