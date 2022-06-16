-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2022 at 03:46 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan_kategori` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_kategori` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `nama_kategori`, `keterangan_kategori`, `stok`, `foto_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Plywood', 'Kayu lapis atau sering disebut tripleks adalah sejenis papan pabrikan yang terdiri dari lapisan kayu yang direkatkan bersama-sama.', '100', 'plywood.jpg', NULL, NULL),
(2, 'LVL', 'Kayu veneer laminasi adalah produk kayu rekayasa yang menggunakan beberapa lapisan kayu tipis yang dirakit dengan perekat.', '100', 'LVL.jpg', NULL, NULL),
(3, 'Veneer', 'Venir kayu atau venir adalah lembaran tipis kayu, biasanya lebih tipis daripada 3 mm, yang dihasilkan dengan mengiris balok kayu.', '100', 'veneer.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customs`
--

CREATE TABLE `customs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `kode_pemesanan_cus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_cus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `ongkir_cus` bigint(20) DEFAULT NULL,
  `total_harga_cus` int(11) DEFAULT NULL,
  `tanggal_transaksi_cus` timestamp NOT NULL DEFAULT current_timestamp(),
  `alat_angkut_cus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_cus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_midtrans` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uniqode` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customs`
--

INSERT INTO `customs` (`id`, `user_id`, `kode_pemesanan_cus`, `status_cus`, `ongkir_cus`, `total_harga_cus`, `tanggal_transaksi_cus`, `alat_angkut_cus`, `ket_cus`, `kode_midtrans`, `uniqode`, `created_at`, `updated_at`) VALUES
(2, 4, 'CVMAS-222057347', '0', 1, 2, '2022-05-23 03:49:17', 'Pickup', 'P 3232 BM', '299c271c-61d6-4def-b092-cc560bae60eb', '172559162', '2022-05-22 20:49:17', '2022-05-22 20:53:39');

-- --------------------------------------------------------

--
-- Table structure for table `detail_customs`
--

CREATE TABLE `detail_customs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori` bigint(20) UNSIGNED DEFAULT NULL,
  `material` bigint(20) UNSIGNED DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_pesanan_cus` int(11) DEFAULT NULL,
  `harga_cus` int(11) DEFAULT NULL,
  `custom_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_customs`
--

INSERT INTO `detail_customs` (`id`, `kategori`, `material`, `ukuran`, `jumlah_pesanan_cus`, `harga_cus`, `custom_id`, `created_at`, `updated_at`) VALUES
(2, 2, 1, '1 x 1 x 2 mm', 24, 1, 2, '2022-05-22 20:49:17', '2022-05-22 20:49:17');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `histories`
--

CREATE TABLE `histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `ongkir` bigint(20) DEFAULT NULL,
  `total_harga` int(11) NOT NULL,
  `jumlah_pesanan` int(11) NOT NULL,
  `tanggal_transaksi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `alat_angkut` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `histories`
--

INSERT INTO `histories` (`id`, `status`, `ongkir`, `total_harga`, `jumlah_pesanan`, `tanggal_transaksi`, `alat_angkut`, `ket`, `product_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '5', NULL, 8108800, 60, '2022-04-15 18:54:11', 'Truk', 'P 2292 ABV', 5, 2, NULL, '2022-04-15 13:22:34'),
(2, '4', 1, 4992095, 43, '2022-05-22 03:48:30', 'Truk', 'N 3738 PS', 1, 2, NULL, '2022-04-27 12:16:01'),
(3, '2', 1000000, 3049527, 34, '2022-04-30 07:31:34', 'Truk', 'P 1292 BN', 6, 2, NULL, '2022-05-19 03:03:23'),
(4, '5', 1000000, 2607472, 20, '2022-05-23 03:47:26', 'Truk', 'P 1243 BN', 2, 4, NULL, '2022-05-22 20:47:26'),
(5, '2', 1000000, 10287616, 80, '2022-06-16 12:57:31', NULL, NULL, 1, 4, NULL, '2022-06-16 13:00:08');

-- --------------------------------------------------------

--
-- Table structure for table `history_custom`
--

CREATE TABLE `history_custom` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status_cus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `ongkir_cus` bigint(20) NOT NULL,
  `ukuran_cus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `total_harga_cus` int(11) NOT NULL,
  `jumlah_pesanan_cus` int(11) NOT NULL,
  `tanggal_transaksi_cus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alat_angkut_cus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_cus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_kategori` bigint(20) UNSIGNED DEFAULT NULL,
  `id_material` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `history_custom`
--

INSERT INTO `history_custom` (`id`, `status_cus`, `ongkir_cus`, `ukuran_cus`, `total_harga_cus`, `jumlah_pesanan_cus`, `tanggal_transaksi_cus`, `alat_angkut_cus`, `ket_cus`, `id_kategori`, `id_material`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '4', 4500000, '2 x 3 x 4 mm', 8100000, 67, '2022-04-16 01:43:41', 'Truk', 'N 8907 PB', 1, 1, 2, '2022-04-19 19:06:00', '2022-04-22 12:09:54');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_lokasi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ongkir` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id`, `nama_lokasi`, `ongkir`, `created_at`, `updated_at`) VALUES
(1, 'Surabaya', 1200000, NULL, NULL),
(2, 'Jakarta', 4600000, NULL, NULL),
(3, 'Mojokerto', 1000000, NULL, NULL),
(4, 'Probolinggo', 700000, NULL, NULL),
(5, 'Pasuruan', 800000, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_material` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok_material` int(11) NOT NULL,
  `foto_material` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`id`, `nama_material`, `stok_material`, `foto_material`, `created_at`, `updated_at`) VALUES
(1, 'Kayu Meranti', 1000, 'triplek.jpg', NULL, NULL);

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
(1, '2014_10_11_000000_create_permission_tables', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2020_08_11_130923_create_categories_table', 1),
(6, '2020_08_11_131249_create_material_table', 1),
(7, '2020_08_11_131251_create_products_table', 1),
(8, '2020_08_11_131307_create_pesanans_table', 1),
(9, '2020_08_11_131327_create_pesanan_details_table', 1),
(10, '2021_10_31_140256_create_lokasi_table', 1),
(11, '2022_01_24_133819_create_customs_table', 1),
(12, '2022_01_24_134447_create_detail_customs_table', 1),
(13, '2022_01_31_193758_create_histories_table', 1),
(14, '2022_04_03_081445_history_custom', 1),
(15, '2022_05_26_033208_create_ongkir_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(1, 'App\\User', 3),
(2, 'App\\User', 2),
(2, 'App\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `ongkirs`
--

CREATE TABLE `ongkirs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_ongkir` int(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ongkirs`
--

INSERT INTO `ongkirs` (`id`, `nama_kota`, `harga_ongkir`, `created_at`, `updated_at`) VALUES
(1, 'Surabaya', 1200000, NULL, '2022-06-08 09:11:14'),
(2, 'Jakarta', 4600000, NULL, NULL),
(3, 'Mojokerto', 1000000, NULL, NULL),
(4, 'Probolinggo', 700000, NULL, NULL),
(6, 'Pasuruan', 800000, '2022-06-08 09:11:48', '2022-06-08 09:11:48');

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesanans`
--

CREATE TABLE `pesanans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_pemesanan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `ongkir` int(255) DEFAULT NULL,
  `total_harga` int(255) DEFAULT NULL,
  `tanggal_transaksi` timestamp NOT NULL DEFAULT current_timestamp(),
  `alat_angkut` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `kode_midtrans` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uniqode` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_details`
--

CREATE TABLE `pesanan_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jumlah_pesanan` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `pesanan_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_kategori` bigint(20) UNSIGNED DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `material` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jml_ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int(255) NOT NULL,
  `harga` int(255) NOT NULL,
  `is_ready` tinyint(1) NOT NULL DEFAULT 1,
  `gambar_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `id_kategori`, `nama`, `kategori`, `material`, `ukuran`, `jml_ukuran`, `stok`, `harga`, `is_ready`, `gambar_produk`, `created_at`, `updated_at`) VALUES
(1, 1, 'PLYWOOD 1', 'PLYWOOD', 'Kayu Meranti', '12 x 1220 x 1220 mm', '17860800', 50, 6500000, 1, 'plywood.jpg', NULL, NULL),
(2, 1, 'PLYWOOD 2', 'PLYWOOD', 'Kayu Meranti', '9 x 1220 x 1220 mm', '13395600', 50, 6000000, 1, 'plywood.jpg', NULL, NULL),
(3, 1, 'PLYWOOD 3', 'PLYWOOD', 'Kayu Meranti', '15 x 1000 x 1500 mm', '22500000', 50, 7000000, 1, 'plywood.jpg', NULL, NULL),
(4, 1, 'PLYWOOD 4', 'PLYWOOD', 'Kayu Meranti', '6 x 1220 x 1220 mm', '8930400', 50, 5500000, 1, 'plywood.jpg', NULL, NULL),
(5, 2, 'LVL 1', 'LVL', 'Kayu Meranti', '12 x 1220 x 1220 mm', '17860800', 1000, 5000000, 1, 'LVL.jpg', NULL, NULL),
(6, 2, 'LVL 2', 'LVL', 'Kayu Meranti', '9 x 1220 x 1220 mm', '13395600', 50, 4500000, 1, 'LVL.jpg', NULL, NULL),
(7, 2, 'LVL 3', 'LVL', 'Kayu Meranti', '15 x 600 x 2200 mm', '19800000', 50, 5600000, 1, 'LVL.jpg', NULL, NULL),
(8, 2, 'LVL 4', 'LVL', 'Kayu Meranti', '9 x 1000 x 1500 mm', '13500000', 50, 4000000, 1, 'LVL.jpg', NULL, NULL),
(9, 3, 'VENEER 1', 'VENEER', 'Kayu Meranti', '1,7 x 125 x 125 mm', '26563', 50, 6300000, 1, 'veneer.jpg', NULL, NULL),
(10, 3, 'VENEER 2', 'VENEER', 'Kayu Meranti', '2,7 x 125 x 125 mm', '42188', 50, 7000000, 1, 'veneer.jpg', NULL, NULL),
(11, 3, 'VENEER 3', 'VENEER', 'Kayu Meranti', '1,5 x 1000 x 1500 mm', '2250000', 50, 6000000, 1, 'veneer.jpg', NULL, NULL),
(12, 3, 'VENEER 4', 'VENEER', 'Kayu Meranti', '2,6 x 1000 x 1500 mm', '3900000', 100, 6500000, 1, 'veneer.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2022-04-15 11:02:50', '2022-04-15 11:02:50'),
(2, 'user', 'web', '2022-04-15 11:02:50', '2022-04-15 11:02:50');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nohp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama_perusahaan`, `name`, `email`, `lokasi`, `alamat`, `password`, `nohp`, `role`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, NULL, 'Shab', 's@gmail.com', 'Surabaya', 'Jl Kahuyungan no 103', '$2y$10$skfNVg3BFyc9754NDanQ..pgL4C7QStySGhS5KhD8IcgxYYgrCYVO', '0892828123', 'admin', NULL, NULL, '2022-05-22 09:03:57', '2022-05-22 09:03:57'),
(4, 'PT Gatra Mapan', 'Imel', 'i@gmail.com', 'Mojokerto', 'Jl Semeru no 103', '$2y$10$iDwSyvbzuTFrXtq3OSweYewrMWxaabDEKBpcUNpQBunlz2OpOewHi', '0892828128', 'customer', NULL, NULL, '2022-05-22 09:03:57', '2022-05-22 09:03:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customs`
--
ALTER TABLE `customs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_customs`
--
ALTER TABLE `detail_customs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_customs_kategori_foreign` (`kategori`),
  ADD KEY `detail_customs_material_foreign` (`material`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `histories`
--
ALTER TABLE `histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_custom`
--
ALTER TABLE `history_custom`
  ADD PRIMARY KEY (`id`),
  ADD KEY `history_custom_id_kategori_foreign` (`id_kategori`),
  ADD KEY `history_custom_id_material_foreign` (`id_material`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `ongkirs`
--
ALTER TABLE `ongkirs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `pesanans`
--
ALTER TABLE `pesanans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan_details`
--
ALTER TABLE `pesanan_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_id_kategori_foreign` (`id_kategori`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customs`
--
ALTER TABLE `customs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_customs`
--
ALTER TABLE `detail_customs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `histories`
--
ALTER TABLE `histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `history_custom`
--
ALTER TABLE `history_custom`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ongkirs`
--
ALTER TABLE `ongkirs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesanans`
--
ALTER TABLE `pesanans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pesanan_details`
--
ALTER TABLE `pesanan_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_customs`
--
ALTER TABLE `detail_customs`
  ADD CONSTRAINT `detail_customs_kategori_foreign` FOREIGN KEY (`kategori`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `detail_customs_material_foreign` FOREIGN KEY (`material`) REFERENCES `material` (`id`);

--
-- Constraints for table `history_custom`
--
ALTER TABLE `history_custom`
  ADD CONSTRAINT `history_custom_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `history_custom_id_material_foreign` FOREIGN KEY (`id_material`) REFERENCES `categories` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `categories` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
