-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 08, 2026 at 10:42 AM
-- Server version: 8.4.3
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saka`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2026_01_01_000000_create_saka_admin_table', 1),
(2, '2026_01_01_000001_create_saka_sessions_table', 1),
(3, '2026_01_01_000002_create_saka_kelas_table', 1),
(4, '2026_01_01_000003_create_saka_siswa_table', 1),
(5, '2026_01_01_000004_create_saka_guru_table', 1),
(6, '2026_01_01_000005_create_saka_mapel_table', 1),
(7, '2026_01_01_000006_create_saka_akses_mapel_table', 1),
(8, '2026_01_01_000007_create_saka_wali_siswa_table', 1),
(9, '2026_01_01_000008_create_saka_komponen_nilai_harian_table', 1),
(10, '2026_01_01_000009_create_saka_nilai_harian_table', 1),
(11, '2026_01_01_000010_create_saka_komponen_nilai_assesmen_table', 1),
(12, '2026_01_01_000011_create_saka_nilai_assesmen_table', 1),
(13, '2026_01_01_000012_create_saka_pengaturan_nilai_akhir_table', 1),
(14, '2026_01_01_000013_create_saka_nilai_akhir_table', 1),
(15, '2026_01_01_000014_create_saka_simpanan_nilai_table', 1),
(16, '2026_04_29_125847_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `saka_admin`
--

CREATE TABLE `saka_admin` (
  `id_admin` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `saka_admin`
--

INSERT INTO `saka_admin` (`id_admin`, `username`, `password`, `nama`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin_saka', '$2y$12$9C.8uCKHoHSfRy3jbM6u7OrAmrq37n0LRs/0aHX8odBG9xKujP/E.', 'Administrator Sistem', NULL, '2026-05-07 02:10:15', '2026-05-07 02:10:15');

-- --------------------------------------------------------

--
-- Table structure for table `saka_akses_mapel`
--

CREATE TABLE `saka_akses_mapel` (
  `id_akses_mapel` bigint UNSIGNED NOT NULL,
  `id_mapel` bigint UNSIGNED NOT NULL,
  `id_guru` bigint UNSIGNED NOT NULL,
  `id_kelas` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `saka_guru`
--

CREATE TABLE `saka_guru` (
  `id_guru` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `saka_guru`
--

INSERT INTO `saka_guru` (`id_guru`, `username`, `password`, `nama`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'guru_saka', '$2y$12$G24jajJKOvKsLmBBjMzRyuD8KTDOL4hNrd1s6.n6GCf0CUnBkRPZq', 'Pak Arman', NULL, '2026-05-07 02:10:15', '2026-05-07 02:10:15');

-- --------------------------------------------------------

--
-- Table structure for table `saka_kelas`
--

CREATE TABLE `saka_kelas` (
  `id_kelas` bigint UNSIGNED NOT NULL,
  `kode_kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tingkat` enum('1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `saka_kelas`
--

INSERT INTO `saka_kelas` (`id_kelas`, `kode_kelas`, `nama_kelas`, `tingkat`, `created_at`, `updated_at`) VALUES
(1, 'X_RPL_2', 'X RPL 2', '1', '2026-05-07 02:10:14', '2026-05-07 02:10:14'),
(2, 'XI_RPL_2', 'XI RPL 2', '2', '2026-05-07 02:10:14', '2026-05-07 02:10:14'),
(3, 'XII_RPL_2', 'XII RPL 2', '3', '2026-05-07 02:10:14', '2026-05-07 02:10:14');

-- --------------------------------------------------------

--
-- Table structure for table `saka_komponen_nilai_assesmen`
--

CREATE TABLE `saka_komponen_nilai_assesmen` (
  `id_komponen_nilai_assesmen` bigint UNSIGNED NOT NULL,
  `kode_komponen_assesmen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_mapel` bigint UNSIGNED NOT NULL,
  `id_guru` bigint UNSIGNED NOT NULL,
  `nama_komponen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kkm` int NOT NULL DEFAULT '75',
  `is_active` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `saka_komponen_nilai_harian`
--

CREATE TABLE `saka_komponen_nilai_harian` (
  `id_komponen_nilai_harian` bigint UNSIGNED NOT NULL,
  `kode_komponen_harian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_mapel` bigint UNSIGNED NOT NULL,
  `id_guru` bigint UNSIGNED NOT NULL,
  `nama_komponen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kkm` int NOT NULL DEFAULT '75',
  `is_active` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `saka_mapel`
--

CREATE TABLE `saka_mapel` (
  `id_mapel` bigint UNSIGNED NOT NULL,
  `kode_mapel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_mapel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `saka_nilai_akhir`
--

CREATE TABLE `saka_nilai_akhir` (
  `id_nilai_akhir` bigint UNSIGNED NOT NULL,
  `id_mapel` bigint UNSIGNED NOT NULL,
  `id_siswa` bigint UNSIGNED NOT NULL,
  `nilai` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `saka_nilai_assesmen`
--

CREATE TABLE `saka_nilai_assesmen` (
  `id_nilai_assesmen` bigint UNSIGNED NOT NULL,
  `id_komponen_nilai_assesmen` bigint UNSIGNED NOT NULL,
  `id_siswa` bigint UNSIGNED NOT NULL,
  `nilai` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `saka_nilai_harian`
--

CREATE TABLE `saka_nilai_harian` (
  `id_nilai_harian` bigint UNSIGNED NOT NULL,
  `id_komponen_nilai_harian` bigint UNSIGNED NOT NULL,
  `id_siswa` bigint UNSIGNED NOT NULL,
  `nilai` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `saka_pengaturan_nilai_akhir`
--

CREATE TABLE `saka_pengaturan_nilai_akhir` (
  `id_pengaturan_nilai_akhir` bigint UNSIGNED NOT NULL,
  `id_guru` bigint UNSIGNED NOT NULL,
  `id_mapel` bigint UNSIGNED NOT NULL,
  `pres_nilai_harian` int NOT NULL DEFAULT '60',
  `pres_nilai_assesmen` int NOT NULL DEFAULT '40',
  `kkm` int NOT NULL DEFAULT '75',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `saka_sessions`
--

CREATE TABLE `saka_sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `saka_sessions`
--

INSERT INTO `saka_sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('h4hRdQYfm0n5fw5moaIb1DWLiKb7lpwamKXJeslz', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'eyJfdG9rZW4iOiJHOU9wb29oZ2NUNWZWVFY3bnh1Y1FYN3ZWbVlwUGk4aTRJN1VVOFRvIiwidXJsIjp7ImludGVuZGVkIjoiaHR0cHM6XC9cL3Nha2EudGVzdFwvZGV2ZWxvcCJ9LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cHM6XC9cL3Nha2EudGVzdFwvZGFzaGJvYXJkIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEsImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEsInJvbGUiOiJhZG1pbiJ9', 1778121938),
('ujSjztVrNNlYyiBsJQFkbV4u9hVaaBnC0kAg0PFw', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'eyJfdG9rZW4iOiJVZVA2dzBLWFltTE55ZnlncVVaaTFyeEVWSXFNUFdDT2hIWmg3RUphIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9zYWthLnRlc3RcL2Rhc2hib2FyZCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxLCJsb2dpbl9hZG1pbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxLCJyb2xlIjoiYWRtaW4ifQ==', 1778236277);

-- --------------------------------------------------------

--
-- Table structure for table `saka_simpanan_nilai`
--

CREATE TABLE `saka_simpanan_nilai` (
  `id_simpanan_nilai` bigint UNSIGNED NOT NULL,
  `id_mapel` bigint UNSIGNED NOT NULL,
  `id_guru` bigint UNSIGNED NOT NULL,
  `id_siswa` bigint UNSIGNED NOT NULL,
  `nilai` decimal(8,2) NOT NULL,
  `terpakai_harian` decimal(8,2) NOT NULL,
  `terpakai_assesmen` decimal(8,2) NOT NULL,
  `max_pemakaian` decimal(8,2) NOT NULL DEFAULT '100.00',
  `nilai_prioritas` decimal(8,2) NOT NULL DEFAULT '75.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `saka_siswa`
--

CREATE TABLE `saka_siswa` (
  `id_siswa` bigint UNSIGNED NOT NULL,
  `id_kelas` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kontak` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `saka_siswa`
--

INSERT INTO `saka_siswa` (`id_siswa`, `id_kelas`, `username`, `password`, `nama`, `kontak`, `alamat`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 2, 'siswa_saka', '$2y$12$ANsnqb3V1YiGvDSnwRDRPuNRGBv6D5Xnwobh1wquhPs5zNh/3ZQeq', 'Satria Anugrah Pratama', '081234567890', 'Jl. Merdeka No. 10, Jakarta', NULL, '2026-05-07 02:10:15', '2026-05-07 02:10:15');

-- --------------------------------------------------------

--
-- Table structure for table `saka_wali_siswa`
--

CREATE TABLE `saka_wali_siswa` (
  `id_wali_siswa` bigint UNSIGNED NOT NULL,
  `id_siswa` bigint UNSIGNED NOT NULL,
  `nama_wali` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kontak` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_wali` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Orang tua, Orang tua angkat, kakak, perwakilan, dll....',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `saka_admin`
--
ALTER TABLE `saka_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `saka_admin_username_unique` (`username`);

--
-- Indexes for table `saka_akses_mapel`
--
ALTER TABLE `saka_akses_mapel`
  ADD PRIMARY KEY (`id_akses_mapel`),
  ADD KEY `saka_akses_mapel_id_mapel_foreign` (`id_mapel`),
  ADD KEY `saka_akses_mapel_id_guru_foreign` (`id_guru`),
  ADD KEY `saka_akses_mapel_id_kelas_foreign` (`id_kelas`);

--
-- Indexes for table `saka_guru`
--
ALTER TABLE `saka_guru`
  ADD PRIMARY KEY (`id_guru`),
  ADD UNIQUE KEY `saka_guru_username_unique` (`username`);

--
-- Indexes for table `saka_kelas`
--
ALTER TABLE `saka_kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD UNIQUE KEY `saka_kelas_kode_kelas_unique` (`kode_kelas`);

--
-- Indexes for table `saka_komponen_nilai_assesmen`
--
ALTER TABLE `saka_komponen_nilai_assesmen`
  ADD PRIMARY KEY (`id_komponen_nilai_assesmen`),
  ADD UNIQUE KEY `saka_komponen_nilai_assesmen_kode_komponen_assesmen_unique` (`kode_komponen_assesmen`),
  ADD KEY `saka_komponen_nilai_assesmen_id_mapel_foreign` (`id_mapel`),
  ADD KEY `saka_komponen_nilai_assesmen_id_guru_foreign` (`id_guru`);

--
-- Indexes for table `saka_komponen_nilai_harian`
--
ALTER TABLE `saka_komponen_nilai_harian`
  ADD PRIMARY KEY (`id_komponen_nilai_harian`),
  ADD UNIQUE KEY `saka_komponen_nilai_harian_kode_komponen_harian_unique` (`kode_komponen_harian`),
  ADD KEY `saka_komponen_nilai_harian_id_mapel_foreign` (`id_mapel`),
  ADD KEY `saka_komponen_nilai_harian_id_guru_foreign` (`id_guru`);

--
-- Indexes for table `saka_mapel`
--
ALTER TABLE `saka_mapel`
  ADD PRIMARY KEY (`id_mapel`),
  ADD UNIQUE KEY `saka_mapel_kode_mapel_unique` (`kode_mapel`);

--
-- Indexes for table `saka_nilai_akhir`
--
ALTER TABLE `saka_nilai_akhir`
  ADD PRIMARY KEY (`id_nilai_akhir`),
  ADD UNIQUE KEY `nilai_akhir_unique` (`id_mapel`,`id_siswa`),
  ADD KEY `saka_nilai_akhir_id_siswa_foreign` (`id_siswa`);

--
-- Indexes for table `saka_nilai_assesmen`
--
ALTER TABLE `saka_nilai_assesmen`
  ADD PRIMARY KEY (`id_nilai_assesmen`),
  ADD UNIQUE KEY `nilai_assesmen_unique` (`id_komponen_nilai_assesmen`,`id_siswa`),
  ADD KEY `saka_nilai_assesmen_id_siswa_foreign` (`id_siswa`);

--
-- Indexes for table `saka_nilai_harian`
--
ALTER TABLE `saka_nilai_harian`
  ADD PRIMARY KEY (`id_nilai_harian`),
  ADD UNIQUE KEY `nilai_harian_unique` (`id_komponen_nilai_harian`,`id_siswa`),
  ADD KEY `saka_nilai_harian_id_siswa_foreign` (`id_siswa`);

--
-- Indexes for table `saka_pengaturan_nilai_akhir`
--
ALTER TABLE `saka_pengaturan_nilai_akhir`
  ADD PRIMARY KEY (`id_pengaturan_nilai_akhir`),
  ADD UNIQUE KEY `pengaturan_nilai_akhir_unique` (`id_guru`,`id_mapel`),
  ADD KEY `saka_pengaturan_nilai_akhir_id_mapel_foreign` (`id_mapel`);

--
-- Indexes for table `saka_sessions`
--
ALTER TABLE `saka_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `saka_sessions_user_id_index` (`user_id`),
  ADD KEY `saka_sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `saka_simpanan_nilai`
--
ALTER TABLE `saka_simpanan_nilai`
  ADD PRIMARY KEY (`id_simpanan_nilai`),
  ADD UNIQUE KEY `simpanan_nilai_unique` (`id_mapel`,`id_guru`,`id_siswa`),
  ADD KEY `saka_simpanan_nilai_id_guru_foreign` (`id_guru`),
  ADD KEY `saka_simpanan_nilai_id_siswa_foreign` (`id_siswa`);

--
-- Indexes for table `saka_siswa`
--
ALTER TABLE `saka_siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `saka_siswa_username_unique` (`username`),
  ADD KEY `saka_siswa_id_kelas_foreign` (`id_kelas`);

--
-- Indexes for table `saka_wali_siswa`
--
ALTER TABLE `saka_wali_siswa`
  ADD PRIMARY KEY (`id_wali_siswa`),
  ADD KEY `saka_wali_siswa_id_siswa_foreign` (`id_siswa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `saka_admin`
--
ALTER TABLE `saka_admin`
  MODIFY `id_admin` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `saka_akses_mapel`
--
ALTER TABLE `saka_akses_mapel`
  MODIFY `id_akses_mapel` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `saka_guru`
--
ALTER TABLE `saka_guru`
  MODIFY `id_guru` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `saka_kelas`
--
ALTER TABLE `saka_kelas`
  MODIFY `id_kelas` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `saka_komponen_nilai_assesmen`
--
ALTER TABLE `saka_komponen_nilai_assesmen`
  MODIFY `id_komponen_nilai_assesmen` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `saka_komponen_nilai_harian`
--
ALTER TABLE `saka_komponen_nilai_harian`
  MODIFY `id_komponen_nilai_harian` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `saka_mapel`
--
ALTER TABLE `saka_mapel`
  MODIFY `id_mapel` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `saka_nilai_akhir`
--
ALTER TABLE `saka_nilai_akhir`
  MODIFY `id_nilai_akhir` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `saka_nilai_assesmen`
--
ALTER TABLE `saka_nilai_assesmen`
  MODIFY `id_nilai_assesmen` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `saka_nilai_harian`
--
ALTER TABLE `saka_nilai_harian`
  MODIFY `id_nilai_harian` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `saka_pengaturan_nilai_akhir`
--
ALTER TABLE `saka_pengaturan_nilai_akhir`
  MODIFY `id_pengaturan_nilai_akhir` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `saka_simpanan_nilai`
--
ALTER TABLE `saka_simpanan_nilai`
  MODIFY `id_simpanan_nilai` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `saka_siswa`
--
ALTER TABLE `saka_siswa`
  MODIFY `id_siswa` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `saka_wali_siswa`
--
ALTER TABLE `saka_wali_siswa`
  MODIFY `id_wali_siswa` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `saka_akses_mapel`
--
ALTER TABLE `saka_akses_mapel`
  ADD CONSTRAINT `saka_akses_mapel_id_guru_foreign` FOREIGN KEY (`id_guru`) REFERENCES `saka_guru` (`id_guru`) ON DELETE CASCADE,
  ADD CONSTRAINT `saka_akses_mapel_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `saka_kelas` (`id_kelas`) ON DELETE CASCADE,
  ADD CONSTRAINT `saka_akses_mapel_id_mapel_foreign` FOREIGN KEY (`id_mapel`) REFERENCES `saka_mapel` (`id_mapel`) ON DELETE CASCADE;

--
-- Constraints for table `saka_komponen_nilai_assesmen`
--
ALTER TABLE `saka_komponen_nilai_assesmen`
  ADD CONSTRAINT `saka_komponen_nilai_assesmen_id_guru_foreign` FOREIGN KEY (`id_guru`) REFERENCES `saka_guru` (`id_guru`) ON DELETE CASCADE,
  ADD CONSTRAINT `saka_komponen_nilai_assesmen_id_mapel_foreign` FOREIGN KEY (`id_mapel`) REFERENCES `saka_mapel` (`id_mapel`) ON DELETE CASCADE;

--
-- Constraints for table `saka_komponen_nilai_harian`
--
ALTER TABLE `saka_komponen_nilai_harian`
  ADD CONSTRAINT `saka_komponen_nilai_harian_id_guru_foreign` FOREIGN KEY (`id_guru`) REFERENCES `saka_guru` (`id_guru`) ON DELETE CASCADE,
  ADD CONSTRAINT `saka_komponen_nilai_harian_id_mapel_foreign` FOREIGN KEY (`id_mapel`) REFERENCES `saka_mapel` (`id_mapel`) ON DELETE CASCADE;

--
-- Constraints for table `saka_nilai_akhir`
--
ALTER TABLE `saka_nilai_akhir`
  ADD CONSTRAINT `saka_nilai_akhir_id_mapel_foreign` FOREIGN KEY (`id_mapel`) REFERENCES `saka_mapel` (`id_mapel`) ON DELETE CASCADE,
  ADD CONSTRAINT `saka_nilai_akhir_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `saka_siswa` (`id_siswa`) ON DELETE CASCADE;

--
-- Constraints for table `saka_nilai_assesmen`
--
ALTER TABLE `saka_nilai_assesmen`
  ADD CONSTRAINT `saka_nilai_assesmen_id_komponen_nilai_assesmen_foreign` FOREIGN KEY (`id_komponen_nilai_assesmen`) REFERENCES `saka_komponen_nilai_assesmen` (`id_komponen_nilai_assesmen`) ON DELETE CASCADE,
  ADD CONSTRAINT `saka_nilai_assesmen_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `saka_siswa` (`id_siswa`) ON DELETE CASCADE;

--
-- Constraints for table `saka_nilai_harian`
--
ALTER TABLE `saka_nilai_harian`
  ADD CONSTRAINT `saka_nilai_harian_id_komponen_nilai_harian_foreign` FOREIGN KEY (`id_komponen_nilai_harian`) REFERENCES `saka_komponen_nilai_harian` (`id_komponen_nilai_harian`) ON DELETE CASCADE,
  ADD CONSTRAINT `saka_nilai_harian_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `saka_siswa` (`id_siswa`) ON DELETE CASCADE;

--
-- Constraints for table `saka_pengaturan_nilai_akhir`
--
ALTER TABLE `saka_pengaturan_nilai_akhir`
  ADD CONSTRAINT `saka_pengaturan_nilai_akhir_id_guru_foreign` FOREIGN KEY (`id_guru`) REFERENCES `saka_guru` (`id_guru`) ON DELETE CASCADE,
  ADD CONSTRAINT `saka_pengaturan_nilai_akhir_id_mapel_foreign` FOREIGN KEY (`id_mapel`) REFERENCES `saka_mapel` (`id_mapel`) ON DELETE CASCADE;

--
-- Constraints for table `saka_simpanan_nilai`
--
ALTER TABLE `saka_simpanan_nilai`
  ADD CONSTRAINT `saka_simpanan_nilai_id_guru_foreign` FOREIGN KEY (`id_guru`) REFERENCES `saka_guru` (`id_guru`) ON DELETE CASCADE,
  ADD CONSTRAINT `saka_simpanan_nilai_id_mapel_foreign` FOREIGN KEY (`id_mapel`) REFERENCES `saka_mapel` (`id_mapel`) ON DELETE CASCADE,
  ADD CONSTRAINT `saka_simpanan_nilai_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `saka_siswa` (`id_siswa`) ON DELETE CASCADE;

--
-- Constraints for table `saka_siswa`
--
ALTER TABLE `saka_siswa`
  ADD CONSTRAINT `saka_siswa_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `saka_kelas` (`id_kelas`) ON DELETE CASCADE;

--
-- Constraints for table `saka_wali_siswa`
--
ALTER TABLE `saka_wali_siswa`
  ADD CONSTRAINT `saka_wali_siswa_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `saka_siswa` (`id_siswa`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
