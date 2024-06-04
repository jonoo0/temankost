-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2023 at 06:44 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_gilang`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_barang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int(11) NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_kategori` int(11) UNSIGNED DEFAULT NULL,
  `id_rak` int(11) UNSIGNED DEFAULT NULL,
  `id_variasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `nama_barang`, `kode_barang`, `harga`, `stok`, `keterangan`, `created_at`, `updated_at`, `id_kategori`, `id_rak`, `id_variasi`) VALUES
(27, 'cek nama barang', 'R-CE027', '10', 18, '<p>c</p>', '2022-10-30 05:06:49', '2022-11-21 23:03:53', 11, 4, '[\"14\"]'),
(30, 'cek 2', 'R-CE030', '20', 18, '<p>1</p>', '2022-11-21 23:02:39', '2022-11-21 23:03:53', 11, 4, '[\"15\"]'),
(31, 'buku', 'R-BU031', '2000', 0, '<p>qq</p>', '2023-01-19 08:56:39', '2023-01-19 08:56:40', 11, 4, '[\"15\"]');

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
  `id_kost` bigint(20) UNSIGNED NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gambars`
--

INSERT INTO `gambars` (`id`, `id_kost`, `file`, `created_at`, `updated_at`) VALUES
(60, 18, 'uploads/images/1d54c76f48f146c3b2d66daf9d7f845e.jpeg', '2023-02-06 20:18:49', '2023-02-06 20:18:49'),
(61, 18, 'uploads/images/c09b1eadea0efc7914f73ac698494b5e.jpeg', '2023-02-06 20:18:49', '2023-02-06 20:18:49'),
(62, 18, 'uploads/images/c366c2c97d47b02b24c3ecade4c40a01.jpeg', '2023-02-06 20:18:49', '2023-02-06 20:18:49'),
(63, 18, 'uploads/images/f39ae9ff3a81f499230c4126e01f421b.jpeg', '2023-02-06 20:18:49', '2023-02-06 20:18:49'),
(65, 19, 'uploads/images/6fae4e7975cfb72a356e6a8682456c6e.jpeg', '2023-02-07 19:25:32', '2023-02-07 19:25:32'),
(66, 19, 'uploads/images/6a4d5952d4c018a1c1af9fa590a10dda.jpg', '2023-02-07 19:25:32', '2023-02-07 19:25:32'),
(67, 20, 'uploads/images/52292e0c763fd027c6eba6b8f494d2eb.jpeg', '2023-02-08 00:52:16', '2023-02-08 00:52:16'),
(68, 20, 'uploads/images/f9ab16852d455ce9203da64f4fc7f92d.jpeg', '2023-02-08 00:52:16', '2023-02-08 00:52:16'),
(69, 20, 'uploads/images/4afa19649ae378da31a423bcd78a97c8.jpeg', '2023-02-08 00:52:16', '2023-02-08 00:52:16'),
(70, 20, 'uploads/images/59b5a32ef22091b6057d844141c0bafd.jpg', '2023-02-08 00:52:16', '2023-02-08 00:52:16'),
(71, 21, 'uploads/images/68abef8ee1ac9b664a90b0bbaff4f770.jpeg', '2023-02-09 05:24:54', '2023-02-09 05:24:54'),
(72, 21, 'uploads/images/a35fe7f7fe8217b4369a0af4244d1fca.jpeg', '2023-02-09 05:24:54', '2023-02-09 05:24:54'),
(73, 21, 'uploads/images/dfa92d8f817e5b08fcaafb50d03763cf.jpeg', '2023-02-09 05:24:54', '2023-02-09 05:24:54'),
(74, 21, 'uploads/images/d5776aeecb3c45ab15adce6f5cb355f3.jpg', '2023-02-09 05:24:54', '2023-02-09 05:24:54'),
(75, 22, 'uploads/images/ed519c02f134f2cdd836cba387b6a3c8.jpeg', '2023-02-13 08:39:39', '2023-02-13 08:39:39'),
(76, 22, 'uploads/images/bf1b2f4b901c21a1d8645018ea9aeb05.jpeg', '2023-02-13 08:39:39', '2023-02-13 08:39:39'),
(77, 22, 'uploads/images/6b39183e7053a0106e4376f4e9c5c74d.jpeg', '2023-02-13 08:39:39', '2023-02-13 08:39:39'),
(78, 22, 'uploads/images/de3f712d1a02c5fb481a7a99b0da7fa3.jpg', '2023-02-13 08:39:39', '2023-02-13 08:39:39'),
(79, 23, 'uploads/images/8c8a58fa97c205ff222de3685497742c.jpeg', '2023-02-13 08:40:44', '2023-02-13 08:40:44'),
(80, 23, 'uploads/images/c5a8c45bb92b22b295a2e79afdc26280.jpeg', '2023-02-13 08:40:44', '2023-02-13 08:40:44'),
(81, 23, 'uploads/images/9978b7063e297d84bb2ac8e46c1c845f.jpeg', '2023-02-13 08:40:44', '2023-02-13 08:40:44'),
(82, 23, 'uploads/images/161c5c5ad51fcc884157890511b3c8b0.jpg', '2023-02-13 08:40:44', '2023-02-13 08:40:44'),
(83, 24, 'uploads/images/c7b3f097f4810cbb3c4b18c09ab893bc.jpeg', '2023-02-16 06:51:32', '2023-02-16 06:51:32'),
(84, 24, 'uploads/images/f18224a1adfb7b3dbff668c9b655a35a.jpeg', '2023-02-16 06:51:32', '2023-02-16 06:51:32'),
(85, 24, 'uploads/images/8606f35ec6c77858dfb80a385d0d1151.jpeg', '2023-02-16 06:51:32', '2023-02-16 06:51:32'),
(86, 24, 'uploads/images/811be42d722f824eb6cb90ab95ef9e21.jpg', '2023-02-16 06:51:32', '2023-02-16 06:51:32'),
(87, 25, 'uploads/images/5a1e3a5aede16d438c38862cac1a78db.jpeg', '2023-02-19 00:08:08', '2023-02-19 00:08:08'),
(88, 25, 'uploads/images/2451041557a22145b3701b0184109cab.jpeg', '2023-02-19 00:08:08', '2023-02-19 00:08:08'),
(89, 26, 'uploads/images/acab0116c354964a558e65bdd07ff047.jpg', '2023-02-19 03:11:37', '2023-02-19 03:11:37'),
(90, 27, 'uploads/images/752d2c9ecfe079e5e5f3539f4d750e5c.jpg', '2023-02-19 03:13:08', '2023-02-19 03:13:08'),
(91, 28, 'uploads/images/7aa7b77461bd44a3f9da9984da1346fb.jpg', '2023-02-19 03:14:13', '2023-02-19 03:14:13'),
(92, 29, 'uploads/images/9fc64354454711c97058db6110b3a369.jpeg', '2023-02-19 03:16:21', '2023-02-19 03:16:21'),
(93, 30, 'uploads/images/a5909bff60540745d3da1ccda2f99bff.jpg', '2023-02-19 03:19:29', '2023-02-19 03:19:29'),
(94, 31, 'uploads/images/1ab60b5e8bd4eac8a7537abb5936aadc.jpg', '2023-02-19 03:21:20', '2023-02-19 03:21:20'),
(95, 32, 'uploads/images/90aef91f0d9e7c3be322bd7bae41617d.jpeg', '2023-02-19 03:22:40', '2023-02-19 03:22:40');

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
(1, 'Putraa', NULL, '2023-02-07 21:58:50'),
(2, 'Putri', NULL, NULL),
(5, 'Campur', '2023-02-06 20:15:41', '2023-02-06 20:15:41');

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pilihan_ukuran` enum('ya','tidak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `nama_kategori`, `pilihan_ukuran`, `created_at`, `updated_at`) VALUES
(11, 'Baju Batik', 'ya', '2022-10-27 05:51:08', '2022-10-27 05:51:08');

-- --------------------------------------------------------

--
-- Table structure for table `kost`
--

CREATE TABLE `kost` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pemilik` bigint(20) NOT NULL,
  `nama_kost` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_kamar` int(11) NOT NULL,
  `jenis_kost_id` bigint(20) NOT NULL,
  `fasilitas_kost` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `luas` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `long` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tarif_perbulan` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kost`
--

INSERT INTO `kost` (`id`, `id_pemilik`, `nama_kost`, `jumlah_kamar`, `jenis_kost_id`, `fasilitas_kost`, `keterangan`, `luas`, `lokasi`, `lat`, `long`, `alamat`, `tarif_perbulan`, `created_at`, `updated_at`) VALUES
(22, 4, 'Kost Andi 1', 0, 1, '<p>ini fasilitas</p>', '<p>ini keterangan</p>', '2x1', '-7.782913007886634, 110.38177947759077', '-7.782913007886634', '110.38177947759077', NULL, 500000, '2023-02-13 08:39:39', '2023-02-14 08:04:52'),
(23, 4, 'Kost Andi 2', 0, 5, '<p>fasilitas</p>', '<p>key</p>', '2x5', '-7.782913007886634, 110.38177947759077', '-7.782913007886634', '110.38177947759077', NULL, 700000, '2023-02-13 08:40:44', '2023-02-15 10:08:19'),
(24, 4, 'kost andi 3', 1, 1, '<p>ini fasilitas</p>', '<p>ini keterangan</p>', '3x4', '-7.965401196490186, 110.60871117473962', '-7.965401196490186', '110.60871117473962', NULL, 200000, '2023-02-16 06:51:32', '2023-02-16 06:53:15'),
(25, 5, 'KOS ANISA 1', 19, 2, '<p>air</p>', '<p>ini</p>', '3x4', '-7.782062606647052, 110.3684757206904', '-7.782062606647052', '110.3684757206904', NULL, 2000, '2023-02-19 00:08:08', '2023-02-19 00:09:30'),
(26, 4, 'kos 2', 2, 2, '<p>fa</p>', '<p>ket</p>', '3x4', '-7.804390897385567, 110.38885057460372', '-7.804390897385567', '110.38885057460372', NULL, 200, '2023-02-19 03:11:37', '2023-02-19 03:11:37'),
(27, 4, 'kos 2', 2, 2, '<p>fa</p>', '<p>ket</p>', '3x4', '-7.804390897385567, 110.38885057460372', '-7.804390897385567', '110.38885057460372', NULL, 200, '2023-02-19 03:13:08', '2023-02-19 03:13:08'),
(28, 4, 'kos 2', 2, 2, '<p>fa</p>', '<p>ket</p>', '3x4', '-7.804390897385567, 110.38885057460372', '-7.804390897385567', '110.38885057460372', NULL, 200, '2023-02-19 03:14:13', '2023-02-19 03:14:13'),
(29, 4, 'a', 10, 1, '<p>fasis</p>', '<p>kett</p>', '44', '-7.805708948264718, 110.38644731529267', '-7.805708948264718', '110.38644731529267', NULL, 200, '2023-02-19 03:16:21', '2023-02-19 03:16:21'),
(30, 4, 'kos andi', 3, 2, '<p>22</p>', '<p>22</p>', '22', '-7.803625575613116, 110.38179100037755', '-7.803625575613116', '110.38179100037755', NULL, 22, '2023-02-19 03:19:29', '2023-02-19 03:19:29'),
(31, 5, 'asas', 6, 1, '<p>fas</p>', '<p>kett</p>', 'asas', '-7.803625575613116, 110.38179100037755', '-7.803625575613116', '110.38179100037755', NULL, 220000, '2023-02-19 03:21:20', '2023-02-19 03:21:20');

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
(5, '2022_07_31_114835_create_penjualans_table', 1),
(6, '2022_07_31_114851_create_barangs_table', 1),
(7, '2022_07_31_114902_create_barang_masuks_table', 1),
(8, '2022_08_03_171917_create_gambars_table', 2),
(9, '2022_08_12_151012_create_raks_table', 3),
(10, '2022_08_16_102915_create_kategoris_table', 3),
(11, '2022_08_16_103625_create_variasis_table', 4),
(12, '2022_08_18_054545_create_barang_keluars_table', 5),
(13, '2023_01_18_141044_create_jenis_kost_table', 6),
(14, '2023_01_18_141753_create_kost_table', 6),
(15, '2023_01_20_142459_create_pemilik_table', 7),
(16, '2023_01_20_142459_create_penghuni_table', 8),
(17, '2023_02_02_113057_create_pesanan_table', 9),
(18, '2023_02_19_100616_create_kamars_table', 10);

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
  `no_rek` bigint(20) NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemilik`
--

INSERT INTO `pemilik` (`id`, `user_id`, `no_tlp`, `no_rek`, `alamat`, `created_at`, `updated_at`) VALUES
(4, 10, '08912812012', 112133434, 'Sleman Utaraa', '2023-02-06 20:16:28', '2023-02-16 05:24:01'),
(5, 14, '08950987834', 111, 'jl wonosari', '2023-02-18 01:27:47', '2023-02-18 01:27:47'),
(6, 15, '020129012', 18201302, 'Jl Semarang', '2023-02-19 02:57:33', '2023-02-19 02:57:33');

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
(5, 11, '0812901293123', 'jl merpati putih', '2023-02-06 20:20:12', '2023-02-06 20:20:12'),
(6, 12, '08391020', 'jl panggang', '2023-02-07 00:24:45', '2023-02-07 00:24:45'),
(7, 13, '0290121', 'jl wonosari', '2023-02-16 06:01:03', '2023-02-16 06:01:03');

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
  `id_penghuni` int(11) NOT NULL,
  `id_kost` int(11) NOT NULL,
  `kode_trx` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL DEFAULT current_timestamp(),
  `jml_bulan` int(6) NOT NULL,
  `nominal` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `via_bayar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bukti_bayar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `id_penghuni`, `id_kost`, `kode_trx`, `tgl_mulai`, `tgl_selesai`, `jml_bulan`, `nominal`, `status`, `via_bayar`, `bukti_bayar`, `created_at`, `updated_at`) VALUES
(57, 6, 23, 'TR-023-0001', '2023-02-13', '2023-08-13', 6, '4200000', 'paid', 'tf-manual', '069948400_1584609485-hl_sentanurozaq.jpg', '2023-02-13 08:41:28', '2023-02-14 07:51:47'),
(58, 6, 22, 'TR-022-0058', '2023-02-14', '2024-02-14', 12, '6000000', 'paid', 'tf-manual', 'Capture.JPG', '2023-02-14 08:00:29', '2023-02-14 08:01:04'),
(59, 6, 22, 'TR-022-0059', '2023-02-28', '2023-08-28', 6, '3000000', 'ditolak', 'tf-manual', '069948400_1584609485-hl_sentanurozaq.jpg', '2023-02-14 08:01:51', '2023-02-14 08:04:52'),
(60, 6, 23, 'TR-023-0060', '2023-02-15', '2023-03-15', 1, '700000', 'paid', 'tf-manual', '069948400_1584609485-hl_sentanurozaq.jpg', '2023-02-15 09:47:22', '2023-02-15 09:57:59'),
(61, 6, 23, 'TR-023-0061', '2023-02-22', '2023-03-22', 1, '700000', 'paid', 'midtrans', NULL, '2023-02-15 10:07:50', '2023-02-15 10:08:19'),
(62, 6, 24, 'TR-024-0062', '2023-02-16', '2023-08-16', 6, '1200000', 'paid', 'tf-manual', 'wkwk.JPG', '2023-02-16 06:52:25', '2023-02-16 06:53:15'),
(63, 6, 24, 'TR-024-0063', '2023-02-21', '2023-05-21', 3, '600000', 'unpaid', 'midtrans', NULL, '2023-02-16 06:54:17', '2023-02-16 06:54:17'),
(64, 6, 25, 'TR-025-0064', '2023-02-20', '2023-02-19', 3, '6000', 'paid', 'tf-manual', 'Capture.JPG', '2023-02-19 00:08:45', '2023-02-19 00:09:30'),
(65, 6, 25, 'TR-025-0065', '2023-02-22', '2023-03-22', 1, '2000', 'unpaid', 'tf-manual', 'index.jpeg', '2023-02-21 10:06:10', '2023-02-21 10:06:27'),
(66, 6, 24, 'TR-024-0066', '2023-02-22', '2023-03-22', 1, '200000', 'unpaid', 'tf-manual', NULL, '2023-02-21 10:34:51', '2023-02-21 10:34:51');

-- --------------------------------------------------------

--
-- Table structure for table `raks`
--

CREATE TABLE `raks` (
  `id` int(11) UNSIGNED NOT NULL,
  `kode_rak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `raks`
--

INSERT INTO `raks` (`id`, `kode_rak`, `created_at`, `updated_at`) VALUES
(4, 'A123', '2022-10-27 05:51:40', '2022-10-27 05:51:40');

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
  `role` enum('Admin','Pemilik','Penghuni') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('menunggu','aktif','tidak aktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', NULL, '$2y$10$y/RhtTiSlkMAhl3igecLoeyAttY7T.R74zAnmU33UegbxFQkHvJ1m', 'Admin', '', NULL, NULL, '2023-02-07 20:47:27'),
(10, 'Andi Subagyaa', 'andi@gmail.com', NULL, '$2y$10$JP6w5o.LNwJug/iW.rtgBuiHNGRCoNddZWd3K70Azbc7Dp00GcxqS', 'Pemilik', 'aktif', NULL, '2023-02-06 20:16:28', '2023-02-16 05:24:12'),
(11, 'ahmad dani', 'ahmad@gmail.com', NULL, '$2y$10$kDRES0fgMlhZYNSYvcyBQ.ujqXCTF7xtOUInNWQ5fTmw.33jxDTvy', 'Penghuni', '', NULL, '2023-02-06 20:20:12', '2023-02-06 20:20:12'),
(12, 'nur', 'nur@gmail.com', NULL, '$2y$10$ThKeipnfK8F0jEh.84slC.8qupGkb8kLc7U9XqL1fCSK0NQRS5z2K', 'Penghuni', '', NULL, '2023-02-07 00:24:45', '2023-02-07 00:24:45'),
(13, 'Agus Salim', 'agus@salim', NULL, '$2y$10$iebPbRyOPSYPruGD6KI6fuXoZ8D5u8FRu/Zn7781hCaAkiLKT8U3m', 'Penghuni', '', NULL, '2023-02-16 06:01:03', '2023-02-18 21:49:43'),
(14, 'Anisa', 'anisa@gmail.com', NULL, '$2y$10$bRtM0fTu1.sMztm6eu9na.ErvsJrub/hyxxG3EbirIyCnI/tR4IRO', 'Pemilik', 'aktif', NULL, '2023-02-18 01:27:47', '2023-02-18 20:39:20'),
(15, 'santo', 'santo@gmail.com', NULL, '$2y$10$EKqslXEVFR1x8chACQwsdujtL5VR7vUoXHLHdzQK9tKF1oGDr5XBi', 'Pemilik', 'menunggu', NULL, '2023-02-19 02:57:33', '2023-02-19 02:57:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_rak` (`id_rak`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_barang` (`id_kost`);

--
-- Indexes for table `jenis_kost`
--
ALTER TABLE `jenis_kost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
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
-- Indexes for table `raks`
--
ALTER TABLE `raks`
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
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gambars`
--
ALTER TABLE `gambars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `jenis_kost`
--
ALTER TABLE `jenis_kost`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kost`
--
ALTER TABLE `kost`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pemilik`
--
ALTER TABLE `pemilik`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penghuni`
--
ALTER TABLE `penghuni`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `raks`
--
ALTER TABLE `raks`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barangs`
--
ALTER TABLE `barangs`
  ADD CONSTRAINT `barangs_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategoris` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `barangs_ibfk_2` FOREIGN KEY (`id_rak`) REFERENCES `raks` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
