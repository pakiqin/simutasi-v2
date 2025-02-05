-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Feb 2025 pada 11.27
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simutasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cabang_dinas`
--

CREATE TABLE `cabang_dinas` (
  `id` int(11) NOT NULL,
  `kode_cabang` varchar(10) NOT NULL,
  `nama_cabang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cabang_dinas`
--

INSERT INTO `cabang_dinas` (`id`, `kode_cabang`, `nama_cabang`) VALUES
(1, 'CD01', 'Cabang Dinas Contoh'),
(3, 'CD001', 'Cabang Dinas Wilayah Kota Banda Aceh dan Kabupaten Aceh Besar'),
(5, 'CD002', 'Cabang Dinas Wilayah Kota Sabang'),
(6, 'CD003', 'Cabang Dinas Wilayah Kabupaten Pidie dan Kabupaten Pidie Jaya'),
(7, 'CD004', 'Cabang Dinas Wilayah Kabupaten Bireuen'),
(8, 'CD005', 'Cabang Dinas Wilayah Kota Lhokseumawe'),
(9, 'CD006', 'Cabang Dinas Wilayah Kabupaten Aceh Utara'),
(10, 'CD007', 'Cabang Dinas Wilayah Kabupaten Aceh Timur'),
(11, 'CD008', 'Cabang Dinas Wilayah Kota Langsa'),
(12, 'CD009', 'Cabang Dinas Wilayah Kabupaten Aceh Tamiang'),
(13, 'CD010', 'Cabang Dinas Wilayah Kabupaten Bener Meriah'),
(14, 'CD011', 'Cabang Dinas Wilayah Kabupaten Aceh Tengah'),
(15, 'CD012', 'Cabang Dinas Wilayah Kabupaten Aceh Tenggara'),
(16, 'CD013', 'Cabang Dinas Wilayah Kabupaten Gayo Lues'),
(17, 'CD014', 'Cabang Dinas Wilayah Kabupaten Aceh Jaya'),
(19, 'CD015', 'Cabang Dinas Wilayah Kabupaten Aceh Barat'),
(20, 'CD016', 'Cabang Dinas Wilayah Kabupaten Nagan Raya'),
(21, 'CD017', 'Cabang Dinas Wilayah Kabupaten Aceh Barat Daya'),
(22, 'CD018', 'Cabang Dinas Wilayah Kabupaten Aceh Selatan'),
(24, 'CD019', 'Cabang Dinas Wilayah Kabupaten Simeulue'),
(25, 'CD000', 'Dinas Pendidikan Aceh');

-- --------------------------------------------------------

--
-- Struktur dari tabel `operator_cabang_dinas`
--

CREATE TABLE `operator_cabang_dinas` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cabang_dinas_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `operator_cabang_dinas`
--

INSERT INTO `operator_cabang_dinas` (`id`, `user_id`, `cabang_dinas_id`, `created_at`) VALUES
(38, 42, 3, '2025-01-14 13:21:41'),
(41, 46, 5, '2025-01-14 13:50:52'),
(49, 29, 6, '2025-01-15 09:59:23'),
(50, 29, 7, '2025-01-15 09:59:23'),
(51, 32, 3, '2025-01-15 09:59:39'),
(52, 32, 5, '2025-01-15 09:59:39'),
(53, 33, 22, '2025-01-15 09:59:59'),
(54, 33, 24, '2025-01-15 09:59:59'),
(57, 47, 9, '2025-01-15 10:02:18'),
(60, 48, 24, '2025-01-15 10:43:58'),
(61, 25, 8, '2025-01-16 05:35:09'),
(62, 25, 9, '2025-01-16 05:35:09'),
(63, 21, 10, '2025-01-20 17:04:17'),
(64, 21, 11, '2025-01-20 17:04:17'),
(65, 21, 12, '2025-01-20 17:04:17'),
(66, 49, 10, '2025-01-20 17:06:21'),
(67, 50, 14, '2025-01-27 02:19:20'),
(68, 51, 6, '2025-01-27 02:23:16'),
(69, 52, 7, '2025-01-27 02:23:50'),
(70, 10, 13, '2025-01-27 10:15:59'),
(71, 10, 14, '2025-01-27 10:15:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengiriman_usulan`
--

CREATE TABLE `pengiriman_usulan` (
  `id` int(11) NOT NULL,
  `nomor_usulan` varchar(50) NOT NULL,
  `dokumen_rekomendasi` varchar(255) NOT NULL,
  `operator` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_usulan_cabdin` varchar(20) DEFAULT 'Terkirim',
  `catatan` text DEFAULT '-',
  `status_telaah` enum('Disetujui','Ditolak') DEFAULT NULL,
  `catatan_telaah` text DEFAULT NULL,
  `updated_at_telaah` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengiriman_usulan`
--

INSERT INTO `pengiriman_usulan` (`id`, `nomor_usulan`, `dokumen_rekomendasi`, `operator`, `no_hp`, `created_at`, `updated_at`, `status_usulan_cabdin`, `catatan`, `status_telaah`, `catatan_telaah`, `updated_at_telaah`) VALUES
(17, 'CD006202501270005', 'CD006202501270005-rekomendasicabdin.pdf', 'Spiderman', '085358207706', '2025-01-27 02:13:27', '2025-01-27 09:48:43', 'Lengkap', '', 'Disetujui', 'Usulan mutasi memenuhi syarat', '2025-01-26 19:48:43'),
(19, 'CD006202501270002', 'CD006202501270002-rekomendasicabdin.pdf', 'Spiderman', '085373600369', '2025-01-27 02:13:50', '2025-01-27 10:33:20', 'Lengkap', '', 'Ditolak', 'Usulan mutasi tidak memenuhi syarat', '2025-01-26 20:33:20'),
(20, 'CD001202501270004', 'CD001202501270004-rekomendasicabdin.pdf', 'Prabowo Subianto', '085391592165', '2025-01-27 02:18:03', '2025-01-29 10:06:22', 'Lengkap', '', 'Disetujui', 'Usulan mutasi memenuhi syarat', '2025-01-28 20:06:22'),
(21, 'CD001202501270003', 'CD001202501270003-rekomendasicabdin.pdf', 'Prabowo Subianto', '085391592165', '2025-01-27 02:18:13', '2025-01-27 09:33:29', 'TdkLengkap', 'berkas usulan tidak lengkap', NULL, NULL, NULL),
(22, 'CD011202501270003', 'CD011202501270003-rekomendasicabdin.pdf', 'Op Cabdin Aceh Tengah', '085358207706', '2025-01-27 02:22:04', '2025-01-29 10:45:57', 'Lengkap', '', 'Disetujui', 'Usulan mutasi memenuhi syarat', '2025-01-28 20:45:57'),
(23, 'CD011202501270002', 'CD011202501270002-rekomendasicabdin.pdf', 'Op Cabdin Aceh Tengah', '085358207706', '2025-01-27 02:22:15', '2025-01-29 10:37:36', 'Lengkap', '', 'Disetujui', 'Usulan mutasi memenuhi syarat', '2025-01-28 20:37:36'),
(24, 'CD003202501270002', 'CD003202501270002-rekomendasicabdin.pdf', 'OP Cabdin Kab Pidie', '085358207706', '2025-01-27 02:25:44', '2025-01-27 09:33:54', 'Lengkap', '', 'Disetujui', 'Usulan mutasi memenuhi syarat', '2025-01-26 19:33:54'),
(25, 'CD003202501270001', 'CD003202501270001-rekomendasicabdin.pdf', 'OP Cabdin Kab Pidie', '085373600369', '2025-01-27 02:26:02', '2025-01-27 09:32:49', 'TdkLengkap', 'rekom lepas tidak terbaca', NULL, NULL, NULL),
(26, 'CD006202501270003', 'CD006202501270003-rekomendasicabdin.pdf', 'Spiderman', '085373600369', '2025-01-27 03:36:58', '2025-01-27 12:32:05', 'Lengkap', '', 'Ditolak', 'Usulan mutasi tidak memenuhi syarat', '2025-01-26 22:32:05'),
(29, 'CD006202501270004', 'CD006202501270004-rekomendasicabdin.pdf', 'Spiderman', '085358207706', '2025-01-27 09:43:29', '2025-01-29 10:47:50', 'Lengkap', 'lanjut ke proses telaah kabid gtk', 'Disetujui', 'Usulan mutasi memenuhi syarat', '2025-01-28 20:47:50'),
(31, 'CD011202501270001', 'CD011202501270001-rekomendasicabdin.pdf', 'Op Cabdin Aceh Tengah', '085391592165', '2025-01-29 04:57:03', '2025-01-29 12:26:22', 'Lengkap', '', 'Disetujui', 'Usulan mutasi memenuhi syarat', '2025-01-28 22:26:22'),
(33, 'CD006202501270007', 'CD006202501270007-rekomendasicabdin.pdf', 'Spiderman', '085358207706', '2025-01-29 05:22:57', '2025-01-31 16:06:40', 'Lengkap', 'verif admin', 'Disetujui', 'Usulan mutasi memenuhi syarat', '2025-01-31 02:06:40'),
(34, 'CD011202501290001', 'CD011202501290001-rekomendasicabdin.pdf', 'Op Cabdin Aceh Tengah', '34565456', '2025-01-29 05:46:00', '2025-01-29 12:47:25', 'Lengkap', 'lanjut ke proses telaah', 'Disetujui', 'Usulan mutasi memenuhi syarat', '2025-01-28 22:47:25'),
(35, 'CD007202501260004', 'CD007202501260004-rekomendasicabdin.pdf', 'OP Cabdin Aceh Timur', '085391592165', '2025-01-30 17:15:51', '2025-02-01 22:59:29', 'Lengkap', '', 'Disetujui', 'Usulan mutasi memenuhi syarat', '2025-02-01 08:59:29'),
(36, 'CD007202501260003', 'CD007202501260003-rekomendasicabdin.pdf', 'OP Cabdin Aceh Timur', '085391592165', '2025-01-30 17:16:00', '2025-01-31 00:49:32', 'TdkLengkap', 'dokumen tidak terbaca', NULL, NULL, NULL),
(37, 'CD007202501260002', 'CD007202501260002-rekomendasicabdin.pdf', 'OP Cabdin Aceh Timur', '085270584376', '2025-01-30 17:16:11', '2025-01-30 17:16:11', 'Terkirim', '-', NULL, NULL, NULL),
(38, 'CD007202501260001', 'CD007202501260001-rekomendasicabdin.pdf', 'OP Cabdin Aceh Timur', '085270584376', '2025-01-30 17:16:19', '2025-01-30 17:16:19', 'Terkirim', '-', NULL, NULL, NULL),
(39, 'CD001202501270002', 'CD001202501270002-rekomendasicabdin.pdf', 'Prabowo Subianto', '34565456', '2025-01-31 07:35:03', '2025-02-02 01:45:21', 'Lengkap', '', 'Disetujui', 'Usulan mutasi memenuhi syarat', '2025-02-01 11:45:21'),
(40, 'CD001202501270001', 'CD001202501270001-rekomendasicabdin.pdf', 'Prabowo Subianto', '34565456', '2025-01-31 07:35:13', '2025-02-02 01:45:26', 'Lengkap', '', 'Disetujui', 'Usulan mutasi memenuhi syarat', '2025-02-01 11:45:26'),
(41, 'CD004202501270003', 'CD004202501270003-rekomendasicabdin.pdf', 'Op Cabdin Bireuen', '34565456', '2025-01-31 07:36:47', '2025-01-31 15:19:15', 'Lengkap', '', 'Disetujui', 'Usulan mutasi memenuhi syarat', '2025-01-31 01:19:15'),
(42, 'CD004202501270002', 'CD004202501270002-rekomendasicabdin.pdf', 'Op Cabdin Bireuen', '34565456', '2025-01-31 07:36:55', '2025-02-01 22:59:23', 'Lengkap', '', 'Disetujui', 'Usulan mutasi memenuhi syarat', '2025-02-01 08:59:23'),
(43, 'CD004202501270001', 'CD004202501270001-rekomendasicabdin.pdf', 'Op Cabdin Bireuen', '34565456', '2025-01-31 07:37:04', '2025-02-01 22:59:16', 'Lengkap', '', 'Disetujui', 'Usulan mutasi memenuhi syarat', '2025-02-01 08:59:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekom_kadis`
--

CREATE TABLE `rekom_kadis` (
  `id` int(11) NOT NULL,
  `nomor_rekomkadis` varchar(50) NOT NULL,
  `tanggal_rekomkadis` date NOT NULL,
  `perihal_rekomkadis` varchar(255) NOT NULL,
  `file_rekomkadis` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rekom_kadis`
--

INSERT INTO `rekom_kadis` (`id`, `nomor_rekomkadis`, `tanggal_rekomkadis`, `perihal_rekomkadis`, `file_rekomkadis`, `created_at`, `updated_at`) VALUES
(4, '800/1', '2025-01-24', 'surat rekom kadis mutasi 2024 tahap 1', '2025-01-27_18-00-49-rekom_kadis.pdf', '2025-01-27 16:38:19', '2025-01-27 18:00:49'),
(6, '800/2', '2025-01-28', 'surat rekom kadis mutasi 2024 tahap 2', '2025-01-28_08-02-09-rekom_kadis.pdf', '2025-01-28 08:02:09', '2025-01-28 08:02:09'),
(7, '800/3', '2025-01-28', 'surat rekom kadis mutasi 2024 tahap 3', '2025-01-28_08-02-29-rekom_kadis.pdf', '2025-01-28 08:02:29', '2025-01-28 08:02:29'),
(8, '800/4', '2025-01-29', 'surat rekom kadis mutasi 2024 tahap 4', '2025-01-28_08-02-56-rekom_kadis.pdf', '2025-01-28 08:02:56', '2025-01-28 08:02:56'),
(9, '800/5', '2025-01-28', 'surat rekom kadis mutasi 2024 tahap 5', '2025-01-28_08-03-14-rekom_kadis.pdf', '2025-01-28 08:03:14', '2025-01-28 08:03:14'),
(10, '800/6', '2025-01-29', 'surat rekom kadis mutasi 2024 tahap 6', '2025-01-28_08-03-30-rekom_kadis.pdf', '2025-01-28 08:03:31', '2025-01-28 08:03:31'),
(11, '800/7', '2025-01-29', 'surat rekom kadis mutasi 2024 tahap 7', '2025-01-28_08-03-53-rekom_kadis.pdf', '2025-01-28 08:03:53', '2025-01-28 08:03:53'),
(12, '800/878', '2025-01-29', 'surat rekom kadis mutasi 2024 tahap 8', '2025-01-29_05-31-39-rekom_kadis.pdf', '2025-01-29 05:31:39', '2025-01-29 05:31:39'),
(13, '800/876', '2025-01-29', 'surat rekom kadis mutasi 2025', '2025-01-29_05-31-58-rekom_kadis.pdf', '2025-01-29 05:31:58', '2025-01-29 05:31:58'),
(14, '800/877', '2025-01-29', 'surat rekom kadis mutasi 2025 tahap 2', '2025-01-29_05-41-49-rekom_kadis.pdf', '2025-01-29 05:41:49', '2025-01-29 05:41:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sk_mutasi`
--

CREATE TABLE `sk_mutasi` (
  `id_skmutasi` int(11) NOT NULL,
  `nomor_usulan` varchar(50) NOT NULL,
  `nomor_skmutasi` varchar(100) NOT NULL,
  `jenis_mutasi` enum('SK Mutasi','Nota Dinas') NOT NULL,
  `tanggal_skmutasi` date NOT NULL,
  `file_skmutasi` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sk_mutasi`
--

INSERT INTO `sk_mutasi` (`id_skmutasi`, `nomor_usulan`, `nomor_skmutasi`, `jenis_mutasi`, `tanggal_skmutasi`, `file_skmutasi`, `created_at`, `updated_at`) VALUES
(12, 'CD006202501270007', 'xxx', 'SK Mutasi', '2025-01-30', 'CD006202501270007-20250130.pdf', '2025-02-01 18:15:09', '2025-02-01 19:12:48'),
(13, 'CD001202501270001', 'xcxcxc', 'Nota Dinas', '2025-01-30', 'CD001202501270001-20250130.pdf', '2025-02-01 18:46:20', '2025-02-02 01:46:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','operator','kabid','dinas') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('enable','disable') DEFAULT 'enable',
  `login_attempts` int(11) DEFAULT 0,
  `last_attempt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `nama`, `email`, `no_hp`, `password`, `role`, `created_at`, `updated_at`, `status`, `login_attempts`, `last_attempt`) VALUES
(3, 'admin', 'pakiqin', 'pakiqin@gmail.com', '085358207706', '$2y$10$DKS5u732GHgaNWgrPVx9NuB5fpUtJFbsU1iaiTloIHNadU4uehR/K', 'admin', '2025-01-09 11:20:40', '2025-01-15 09:24:05', 'enable', 0, NULL),
(8, 'kabid', 'Muksalmina', 'kabid@gmail.com', '987656789', '$2y$10$IqfMEu1ITaNElbKux6LcmuLtqliCEhdETl/WVRK3l9.b30qzMpW9u', 'kabid', '2025-01-10 02:59:30', '2025-02-02 02:07:49', 'enable', 0, '2025-02-02 01:08:43'),
(9, 'iqin', 'sodiqin', 'pakiqin@gmail.com', '34567890', '$2y$10$l8vZwxK52D5TqzpLSO363u0vH.ZWNBiidnUpGErjqSg2vri6VQV96', 'admin', '2025-01-10 07:16:25', '2025-02-01 23:41:04', 'enable', 0, NULL),
(10, 'opdinas1', 'opdinas1', 'opdinas1@gmail.com', '3453463463565', '$2y$10$QvI98bypu2djh6eZscVWMuxPdVhkdiZf8aPKho2fGVr/AAuN8AQk2', 'dinas', '2025-01-10 07:45:04', '2025-01-27 03:15:59', 'enable', 0, NULL),
(11, 'opcabdin1', 'aefsdf', 'opcabdin1@gmail.com', 'dsfsdg', '$2y$10$6lpNx9fZurL5dLHaKuYgAuiTmcO1QM.ijhRZQxWnbmwIIUh27UCye', 'operator', '2025-01-10 07:51:17', '2025-01-13 22:13:12', 'disable', 0, NULL),
(12, 'opcabdin2', NULL, 'opcabdin2@gmail.com', NULL, '$2y$10$byhHoezEQ782vl0HaVOmluG0gPVE3Eqv5t9oz/tVzCz2u9Xi6HjAO', 'operator', '2025-01-10 07:59:01', '2025-01-10 08:02:24', 'enable', 0, NULL),
(21, 'opdinas2', 'Gibran Rakabuming Raka', 'opdinas2@gmail.com', '34567', '$2y$10$IsfltneZ53rKp7lWbOZeHe.LDaWyCJKJ1JACy4n6fmhXwJix/JuF.', 'dinas', '2025-01-13 11:14:18', '2025-01-20 10:04:56', 'enable', 0, NULL),
(22, 'opcabdintest', NULL, 'opcabdintest@gmail.com', NULL, '$2y$10$4avvGgUONIK0rKZTf98O8udb/r6yimo4ubvKS5KHiC6hLlxjsCA6S', 'operator', '2025-01-13 11:14:42', '2025-01-13 11:14:42', 'enable', 0, NULL),
(25, 'opdinas3', 'OP Dinas Cabdin Aceh Utara', 'opdinas1@gmail.com', '876567', '$2y$10$XoZI85LWOHoO4krMG0OuierEK2GKrWmSrevZ.WnwTFZR.kuGn22ZC', 'dinas', '2025-01-13 11:42:40', '2025-01-22 01:21:49', 'enable', 0, NULL),
(29, 'opdinas4', 'opdinas4', 'opdinas4@gmail.com', '34567890', '$2y$10$8hRvvMBjRyWKswTfojm29OjExcmqTgJtX3OcMyjh8zQ04nvPFIoNC', 'dinas', '2025-01-13 12:45:24', '2025-01-27 03:15:45', 'enable', 0, NULL),
(32, 'opdinas5', 'OP Dinas Banda Aceh Aceh Besar dan Sabang', 'opdinas5@gmail.com', '09876543', '$2y$10$Mt1wNgQYwmdMgy6cWfNQHOhGHz4zi5lpic.p.66RezjLGySy5mTqu', 'dinas', '2025-01-14 01:26:00', '2025-01-22 08:33:04', 'enable', 0, NULL),
(33, 'opdinas6', 'Operator Dinas 6', 'opdinas6@gmail.com', '8765678', '$2y$10$BSRJloMkSkJo9WuUI0lV6ek/pYh2/E5l5ImBuhLaJKNq9Aw7jSu8G', 'dinas', '2025-01-14 02:33:26', '2025-01-15 05:41:51', 'enable', 0, NULL),
(42, 'opcabdinab', 'Prabowo Subianto', 'opcabdinab@gmail.com', '8765678', '$2y$10$g57mRMoUy.lR4pmw0iDO8.59JKzKMEp.rPPFY9Al45SFSQR7cSWqW', 'operator', '2025-01-14 06:21:41', '2025-01-17 02:48:09', 'enable', 0, NULL),
(46, 'opcabdincb', 'OP Cabdin Sabang', 'opcabdincb@gmail.com', '9876543', '$2y$10$ixy/ON5SZR.WM4KmrPBPReDPSkSqv/5w1i.boTkr/JWgRCLcqB3XC', 'operator', '2025-01-14 06:50:52', '2025-01-14 06:50:52', 'enable', 0, NULL),
(47, 'opcabdinacut', 'Spiderman', 'opcabdinacut@gmail.com', '987654345', '$2y$10$tlA2rpTaVCu4Bq7MbkXwqO4Xu5xOJU/.W9IMdom9vBSRwJOEH/8dm', 'operator', '2025-01-15 03:02:18', '2025-01-22 00:54:54', 'enable', 0, NULL),
(48, 'opcabdinse', 'OP Cabdin Se', 'opcabdinse@gmail.com', '4567890', '$2y$10$Z9LiZUXBTd2PCCNu5pfzNOZUdvWWusN7WbEY8qD4Gt5lWZSpHkm0y', 'operator', '2025-01-15 03:43:58', '2025-01-15 09:36:24', 'enable', 0, NULL),
(49, 'opcabdinatim', 'OP Cabdin Aceh Timur', 'opcabdinatim@gmail.com', '0987654376', '$2y$10$hchoaagsnCyz5NQXS/5C5eEc9su4npijq85gR.3x9t8gabJ9jB5Ge', 'operator', '2025-01-20 10:06:21', '2025-01-27 03:26:26', 'enable', 0, NULL),
(50, 'opcabdinat', 'Op Cabdin Aceh Tengah', 'opcabdinat@gmail.com', '0987656789987', '$2y$10$J08yc2wuwpJOowHaQCdSR.tFo9k5mDvzez441ixizQSMF8Rssmbou', 'operator', '2025-01-26 19:19:20', '2025-01-26 19:19:20', 'enable', 0, NULL),
(51, 'opcabdinpidie', 'OP Cabdin Kab Pidie', 'opcabdinpidie@gmail.com', '09876798769', '$2y$10$bO2kXeCdeWtJnWtb.O.Pnu/TR/M8DJZk6aW93JtfeTvs0sWSbgm4q', 'operator', '2025-01-26 19:23:16', '2025-01-26 19:23:16', 'enable', 0, NULL),
(52, 'opcabdinbi', 'Op Cabdin Bireuen', 'opcabdinbi@gmai.com', '09876567890987', '$2y$10$oWCThRpLNl5FnZ9vyIlGdOSA7Lf9gi9VMzZqnAVY9dvvMtD7LbbAS', 'operator', '2025-01-26 19:23:50', '2025-01-26 19:23:50', 'enable', 0, NULL),
(54, 'kabid2', 'kabid2', 'kabid2@gmail.com', '987654', '$2y$10$8XInwkc4IyBGyHG1WoHxveI12E1TdPC8T8coBYLxGIISaS45T/yDG', 'kabid', '2025-02-01 23:41:44', '2025-02-01 23:58:00', 'enable', 5, '2025-02-01 23:58:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_logs`
--

CREATE TABLE `user_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` enum('login','logout') NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `user_agent` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_logs`
--

INSERT INTO `user_logs` (`id`, `user_id`, `action`, `ip_address`, `user_agent`, `timestamp`) VALUES
(1, 8, 'logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', '2025-02-02 07:03:43'),
(2, 3, 'login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', '2025-02-02 07:03:46'),
(3, 8, 'login', '::1', 'Mozilla/5.0 (Linux; Android 13; SM-G981B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Mobile Safari/537.36', '2025-02-02 07:40:48'),
(4, 8, 'logout', '::1', 'Mozilla/5.0 (Linux; Android 13; SM-G981B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Mobile Safari/537.36', '2025-02-02 07:42:58'),
(5, 8, 'login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', '2025-02-02 07:43:06'),
(6, 8, 'login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', '2025-02-02 07:43:33'),
(7, 8, 'logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', '2025-02-02 07:45:07'),
(8, 8, 'logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', '2025-02-02 07:45:13'),
(9, 8, 'login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', '2025-02-02 07:45:24'),
(10, 8, 'login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', '2025-02-02 07:45:50'),
(11, 8, 'logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', '2025-02-02 07:46:15'),
(12, 8, 'logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', '2025-02-02 07:46:23'),
(13, 8, 'login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', '2025-02-02 07:49:01'),
(14, 8, 'login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 Edg/132.0.0.0', '2025-02-02 07:49:15'),
(15, 8, 'logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 Edg/132.0.0.0', '2025-02-02 07:49:52'),
(16, 8, 'logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', '2025-02-02 07:50:02'),
(17, 8, 'login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', '2025-02-02 07:50:15'),
(18, 8, 'logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', '2025-02-02 07:52:37'),
(19, 3, 'login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', '2025-02-02 08:08:27'),
(20, 3, 'logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', '2025-02-02 08:08:30'),
(21, 3, 'login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', '2025-02-02 08:25:06'),
(22, 3, 'logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', '2025-02-02 08:27:01'),
(23, 8, 'login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', '2025-02-02 09:07:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `usulan`
--

CREATE TABLE `usulan` (
  `id` int(11) NOT NULL,
  `guru_nama` varchar(100) NOT NULL,
  `guru_nip` varchar(20) NOT NULL,
  `guru_nik` varchar(16) NOT NULL,
  `sekolah_asal` varchar(100) NOT NULL,
  `sekolah_tujuan` varchar(100) NOT NULL,
  `alasan` text DEFAULT NULL,
  `google_drive_link` varchar(255) DEFAULT NULL,
  `nomor_usulan` varchar(50) NOT NULL,
  `status` enum('01','02','03','04','05','06','07','08') DEFAULT '01',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cabang_dinas_id` int(11) DEFAULT NULL,
  `id_rekomkadis` int(11) DEFAULT NULL,
  `kirimbkpsdm` tinyint(1) DEFAULT NULL,
  `tglkirimbkpsdm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `usulan`
--

INSERT INTO `usulan` (`id`, `guru_nama`, `guru_nip`, `guru_nik`, `sekolah_asal`, `sekolah_tujuan`, `alasan`, `google_drive_link`, `nomor_usulan`, `status`, `created_at`, `updated_at`, `cabang_dinas_id`, `id_rekomkadis`, `kirimbkpsdm`, `tglkirimbkpsdm`) VALUES
(60, 'Wicaksono Abdi, ST', '198409102010031000', '3273168409100020', 'SMA Negeri 1 Idie', 'SMA Negeri 1 Tanah Jambo Aye', 'Pulang Kampung', 'http://example.com', 'CD007202501260001', '02', '2025-01-26 10:00:37', '2025-01-30 10:16:19', 10, NULL, NULL, NULL),
(61, 'Kangen Band, S.Pd', '198007172008012000', '3273168007170021', 'SMK Taman Fajar', 'SMK Negeri 1 Lhokseumawe', 'Pulang kampung', 'https://pakiqin.com', 'CD007202501260002', '02', '2025-01-26 15:23:28', '2025-01-30 10:16:11', 10, NULL, NULL, NULL),
(62, 'Surya Kencana, S.Pd', '198506062010032004', '3273168506060022', 'SMK Negeri 1 Peureulak', 'SMK Negeri 1 Lhoksukon', 'Pulang kampung halaman', 'https://pakiqin.com', 'CD007202501260003', '02', '2025-01-26 15:24:23', '2025-01-30 10:16:00', 10, NULL, NULL, NULL),
(63, 'Sudirman, SP', '197901052009042003', '3273167901050023', 'SMK Negeri 1 Peureulak Timur', 'SMK Negeri 5 Langsa', 'Ikut-Ikutan', 'https://pakiqin.com', 'CD007202501260004', '06', '2025-01-26 15:25:12', '2025-02-01 19:51:05', 10, 7, 1, '2025-02-01 16:00:24'),
(65, 'Rizki Aulia, S.Pd.I', '198105042008011001', '3273178105040025', 'SMA Negeri 1 Tanah Jambo Aye', 'SMA Negeri 1 Lhokseumawe', 'Pulang Kampung', 'https://pakiqin.com', 'CD006202501270002', '02', '2025-01-27 02:10:30', '2025-01-27 03:33:20', 9, NULL, NULL, NULL),
(66, 'Rahmad Zairi. S. Kom', '199211252022211004', '3273179211250026', 'SMA Negeri 1 Langkahan', 'SMA Negeri 3 Langsa', 'Pulang Kampung Suami', 'http://example.com', 'CD006202501270003', '02', '2025-01-27 02:11:10', '2025-01-27 05:32:05', 9, NULL, NULL, NULL),
(69, 'Purwoko,S.Pd', '196812312008012008', '3273186812310029', 'SMK Negeri 1 Banda Aceh', 'SMK Negeri 1 Sigli', 'Pulang Kampung', 'https://pakiqin.com', 'CD001202501270001', '07', '2025-01-27 02:16:01', '2025-02-01 18:46:20', 3, 7, 1, '2025-02-01 18:45:57'),
(70, 'Dra. Khairalina', '197404052009041005', '3273187404050030', 'SMK Negeri 2 Banda Aceh', 'SMK Negeri 1 Lhokseumawe', 'Ikut suami', 'https://pakiqin.com', 'CD001202501270002', '06', '2025-01-27 02:16:35', '2025-02-01 18:45:57', 3, 10, 1, '2025-02-01 18:45:57'),
(71, 'Mawaddah, S.Si, M.Pd', '198006152022211005', '3273188006150031', 'SMA Negeri 1 Aceh Besar', 'SMA Negeri 1 Tanah Jambo Aye', 'Pulang Kampung', 'https://pakiqin.com', 'CD001202501270003', '02', '2025-01-27 02:17:12', '2025-01-26 19:18:13', 3, NULL, NULL, NULL),
(76, 'Irmayani, ST', '199310162022211002', '3273199310160036', 'SMA Negeri 1 Meureudu', 'SMA Negeri 1 Banda Aceh', 'izin pulang kampung', 'http://example.com', 'CD003202501270001', '02', '2025-01-27 02:24:48', '2025-01-26 19:26:02', 6, NULL, NULL, NULL),
(78, 'Ridwan, S.Sn', '199107242023212025', '3273199107240038', 'SMK Negeri 2 Bireuen', 'SMK Negeri 1 Tanah Jambo Aye', 'test mutasi', 'http://example.com', 'CD004202501270001', '06', '2025-01-27 02:27:00', '2025-02-01 19:12:08', 7, 7, 1, '2025-02-01 16:00:24'),
(79, 'Lailal Fakhrah, S.Pd', '199206202023212042', '3273199206200039', 'SMA Negeri 2 Bireuen', 'SMA Negeri 1 Takengon', 'Ikut suami', 'https://pakiqin.com', 'CD004202501270002', '06', '2025-01-27 02:27:46', '2025-02-01 19:12:00', 7, 14, 1, '2025-02-01 16:00:24'),
(80, 'Sahfitri. S. Pd', '199508152023212029', '3273199508150040', 'SMA Negeri 4 Bireuen', 'SMA Negeri 1 Karang Baru', 'Pulang Kampung', 'http://example.com', 'CD004202501270003', '06', '2025-01-27 02:28:26', '2025-02-01 19:11:52', 7, 14, 1, '2025-02-01 16:00:24'),
(81, 'Cahyo Kumolo', '199608152023212029', '8973199508150040', 'SMK Negeri 1 Sawang', 'SMK Negeri 1 Banda Aceh', 'Ikut suami', 'http://example.com', 'CD006202501270006', '01', '2025-01-27 05:53:16', '2025-01-31 06:57:24', 9, NULL, NULL, NULL),
(83, 'Wali Dunia, ST', '199009092021011001', '1234567890987654', 'SMK Mana AJa', 'SMK wewe', 'tets', 'https://pakiqin.com', 'CD006202501270007', '07', '2025-01-27 09:21:18', '2025-02-01 18:15:09', 9, 8, 1, '2025-02-01 15:58:53'),
(86, 'Test Guru', '98765456789', '987656789', 'SMK Test mutasi', 'SMK Tes terima mutasi', 'test alasan', 'https://pakiqin.com', 'CD011202501290001', '06', '2025-01-29 05:45:34', '2025-02-01 19:10:33', 14, 10, 1, '2025-02-01 15:58:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `usulan_status_history`
--

CREATE TABLE `usulan_status_history` (
  `id` int(11) NOT NULL,
  `nomor_usulan` varchar(255) NOT NULL,
  `status` enum('01','02','03','04','05','06','07','08') NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `catatan_history` text DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `usulan_status_history`
--

INSERT INTO `usulan_status_history` (`id`, `nomor_usulan`, `status`, `updated_at`, `catatan_history`) VALUES
(76, 'CD007202501260001', '01', '2025-01-26 03:00:37', 'Input data usulan mutasi oleh Cabang Dinas'),
(77, 'CD007202501260002', '01', '2025-01-26 08:23:28', 'Input data usulan mutasi oleh Cabang Dinas'),
(78, 'CD007202501260003', '01', '2025-01-26 08:24:23', 'Input data usulan mutasi oleh Cabang Dinas'),
(79, 'CD007202501260004', '01', '2025-01-26 08:25:12', 'Input data usulan mutasi oleh Cabang Dinas'),
(81, 'CD006202501270002', '01', '2025-01-26 19:10:30', 'Input data usulan mutasi oleh Cabang Dinas'),
(82, 'CD006202501270003', '01', '2025-01-26 19:11:10', 'Input data usulan mutasi oleh Cabang Dinas'),
(87, 'CD006202501270002', '02', '2025-01-26 19:13:50', 'Berkas usulan mutasi telah dikirim ke Dinas Provinsi'),
(88, 'CD001202501270001', '01', '2025-01-26 19:16:01', 'Input data usulan mutasi oleh Cabang Dinas'),
(89, 'CD001202501270002', '01', '2025-01-26 19:16:35', 'Input data usulan mutasi oleh Cabang Dinas'),
(90, 'CD001202501270003', '01', '2025-01-26 19:17:12', 'Input data usulan mutasi oleh Cabang Dinas'),
(93, 'CD001202501270003', '02', '2025-01-26 19:18:13', 'Berkas usulan mutasi telah dikirim ke Dinas Provinsi'),
(99, 'CD003202501270001', '01', '2025-01-26 19:24:48', 'Input data usulan mutasi oleh Cabang Dinas'),
(102, 'CD003202501270001', '02', '2025-01-26 19:26:02', 'Berkas usulan mutasi telah dikirim ke Dinas Provinsi'),
(103, 'CD004202501270001', '01', '2025-01-26 19:27:00', 'Input data usulan mutasi oleh Cabang Dinas'),
(104, 'CD004202501270002', '01', '2025-01-26 19:27:46', 'Input data usulan mutasi oleh Cabang Dinas'),
(105, 'CD004202501270003', '01', '2025-01-26 19:28:26', 'Input data usulan mutasi oleh Cabang Dinas'),
(110, 'CD006202501270002', '03', '2025-01-26 19:32:10', 'Proses Verifikasi Berkas di Dinas Provinsi Lengkap. .'),
(112, 'CD003202501270001', '02', '2025-01-26 19:32:49', 'Proses Verifikasi Berkas di Dinas Provinsi TdkLengkap. rekom lepas tidak terbaca.'),
(114, 'CD001202501270003', '02', '2025-01-26 19:33:29', 'Proses Verifikasi Berkas di Dinas Provinsi TdkLengkap. berkas usulan tidak lengkap.'),
(117, 'CD006202501270002', '02', '2025-01-26 20:33:20', 'Telaah Usulan oleh Kepala Bidang GTK (Ditolak). Usulan mutasi tidak memenuhi syarat'),
(118, 'CD006202501270003', '02', '2025-01-26 20:36:59', 'Berkas usulan mutasi telah dikirim ke Dinas Provinsi'),
(119, 'CD006202501270003', '03', '2025-01-26 22:25:04', 'Proses Verifikasi Berkas di Dinas Provinsi (Lengkap). .'),
(120, 'CD006202501270003', '02', '2025-01-26 22:32:05', 'Telaah Usulan oleh Kepala Bidang GTK (Ditolak). Usulan mutasi tidak memenuhi syarat'),
(124, 'CD006202501270006', '01', '2025-01-26 22:53:16', 'Input data usulan mutasi oleh Cabang Dinas'),
(125, 'CD006202501270006', '02', '2025-01-26 23:51:58', 'Berkas usulan mutasi telah dikirim ke Dinas Provinsi'),
(126, 'CD006202501270006', '02', '2025-01-26 23:52:13', 'Proses Verifikasi Berkas di Dinas Provinsi (TdkLengkap). dokumen tidak lengkap'),
(129, 'CD006202501270007', '01', '2025-01-27 02:21:18', 'Input data usulan mutasi oleh Cabang Dinas'),
(132, 'CD006202501270006', '02', '2025-01-27 02:45:11', 'Berkas usulan mutasi telah dikirim ke Dinas Provinsi'),
(134, 'CD006202501270006', '02', '2025-01-27 03:33:59', 'Proses Verifikasi Berkas di Dinas Provinsi (TdkLengkap). Berkas tidak lengkap'),
(156, 'CD006202501270007', '02', '2025-01-28 22:22:57', 'Berkas usulan mutasi telah dikirim ke Dinas Provinsi'),
(159, 'CD011202501290001', '01', '2025-01-28 22:45:34', 'Input data usulan mutasi oleh Cabang Dinas'),
(160, 'CD011202501290001', '02', '2025-01-28 22:46:00', 'Berkas usulan mutasi telah dikirim ke Dinas Provinsi'),
(161, 'CD011202501290001', '03', '2025-01-28 22:46:43', 'Proses Verifikasi Berkas di Dinas Provinsi (Lengkap). lanjut ke proses telaah'),
(162, 'CD011202501290001', '04', '2025-01-28 22:47:25', 'Telaah Usulan oleh Kepala Bidang GTK (Disetujui). Usulan mutasi memenuhi syarat'),
(163, 'CD007202501260004', '02', '2025-01-30 10:15:51', 'Berkas usulan mutasi telah dikirim ke Dinas Provinsi'),
(164, 'CD007202501260003', '02', '2025-01-30 10:16:00', 'Berkas usulan mutasi telah dikirim ke Dinas Provinsi'),
(165, 'CD007202501260002', '02', '2025-01-30 10:16:11', 'Berkas usulan mutasi telah dikirim ke Dinas Provinsi'),
(166, 'CD007202501260001', '02', '2025-01-30 10:16:19', 'Berkas usulan mutasi telah dikirim ke Dinas Provinsi'),
(167, 'CD007202501260004', '03', '2025-01-30 10:49:22', 'Proses Verifikasi Berkas di Dinas Provinsi (Lengkap). '),
(168, 'CD007202501260003', '02', '2025-01-30 10:49:32', 'Proses Verifikasi Berkas di Dinas Provinsi (TdkLengkap). dokumen tidak terbaca'),
(169, 'CD006202501270007', '03', '2025-01-30 11:28:28', 'Proses Verifikasi Berkas di Dinas Provinsi (Lengkap). verif admin'),
(176, 'CD011202501290001', '05', '2025-01-31 06:38:34', 'Penerbitan surat rekomendasi Kepala Dinas'),
(177, 'CD006202501270006', '01', '2025-01-30 23:57:24', 'Data usulan mutasi dilakukan revisi oleh Cabang Dinas'),
(178, 'CD001202501270002', '02', '2025-01-31 00:35:03', 'Berkas usulan mutasi telah dikirim ke Dinas Provinsi'),
(179, 'CD001202501270001', '02', '2025-01-31 00:35:13', 'Berkas usulan mutasi telah dikirim ke Dinas Provinsi'),
(180, 'CD004202501270003', '02', '2025-01-31 00:36:47', 'Berkas usulan mutasi telah dikirim ke Dinas Provinsi'),
(181, 'CD004202501270002', '02', '2025-01-31 00:36:55', 'Berkas usulan mutasi telah dikirim ke Dinas Provinsi'),
(182, 'CD004202501270001', '02', '2025-01-31 00:37:04', 'Berkas usulan mutasi telah dikirim ke Dinas Provinsi'),
(183, 'CD004202501270003', '03', '2025-01-31 00:37:32', 'Proses Verifikasi Berkas di Dinas Provinsi (Lengkap). '),
(184, 'CD004202501270002', '03', '2025-01-31 00:37:37', 'Proses Verifikasi Berkas di Dinas Provinsi (Lengkap). '),
(185, 'CD004202501270001', '03', '2025-01-31 00:37:42', 'Proses Verifikasi Berkas di Dinas Provinsi (Lengkap). '),
(186, 'CD004202501270003', '04', '2025-01-31 01:19:15', 'Telaah Usulan oleh Kepala Bidang GTK (Disetujui). Usulan mutasi memenuhi syarat'),
(187, 'CD006202501270007', '04', '2025-01-31 02:06:40', 'Telaah Usulan oleh Kepala Bidang GTK (Disetujui). Usulan mutasi memenuhi syarat'),
(188, 'CD006202501270007', '05', '2025-01-31 09:07:37', 'Penerbitan surat rekomendasi Kepala Dinas'),
(195, 'CD011202501290001', '06', '2025-02-01 08:58:53', 'Berkas dikirim ke Badan Kepegawaian Aceh (BKA).'),
(196, 'CD006202501270007', '06', '2025-02-01 08:58:53', 'Berkas dikirim ke Badan Kepegawaian Aceh (BKA).'),
(197, 'CD004202501270001', '04', '2025-02-01 08:59:16', 'Telaah Usulan oleh Kepala Bidang GTK (Disetujui). Usulan mutasi memenuhi syarat'),
(198, 'CD004202501270002', '04', '2025-02-01 08:59:23', 'Telaah Usulan oleh Kepala Bidang GTK (Disetujui). Usulan mutasi memenuhi syarat'),
(199, 'CD007202501260004', '04', '2025-02-01 08:59:29', 'Telaah Usulan oleh Kepala Bidang GTK (Disetujui). Usulan mutasi memenuhi syarat'),
(200, 'CD007202501260004', '05', '2025-02-01 15:59:39', 'Penerbitan surat rekomendasi Kepala Dinas'),
(201, 'CD004202501270001', '05', '2025-02-01 15:59:45', 'Penerbitan surat rekomendasi Kepala Dinas'),
(202, 'CD004202501270002', '05', '2025-02-01 15:59:52', 'Penerbitan surat rekomendasi Kepala Dinas'),
(203, 'CD004202501270003', '05', '2025-02-01 15:59:57', 'Penerbitan surat rekomendasi Kepala Dinas'),
(204, 'CD004202501270003', '06', '2025-02-01 09:00:24', 'Berkas dikirim ke Badan Kepegawaian Aceh (BKA).'),
(205, 'CD004202501270002', '06', '2025-02-01 09:00:24', 'Berkas dikirim ke Badan Kepegawaian Aceh (BKA).'),
(206, 'CD004202501270001', '06', '2025-02-01 09:00:24', 'Berkas dikirim ke Badan Kepegawaian Aceh (BKA).'),
(207, 'CD007202501260004', '06', '2025-02-01 09:00:24', 'Berkas dikirim ke Badan Kepegawaian Aceh (BKA).'),
(208, 'CD007202501260004', '07', '2025-02-01 09:02:02', 'Nota Dinas (dapat diunduh)'),
(209, 'CD004202501270001', '07', '2025-02-01 09:03:15', 'Nota Dinas (dapat diunduh)'),
(210, 'CD004202501270002', '07', '2025-02-01 09:07:16', 'Nota Dinas (dapat diunduh)'),
(211, 'CD004202501270003', '07', '2025-02-01 09:08:56', 'Nota Dinas (dapat diunduh)'),
(212, 'CD011202501290001', '07', '2025-02-01 09:13:56', 'Nota Dinas (dapat diunduh)'),
(213, 'CD007202501260004', '07', '2025-02-01 11:00:07', 'SK Mutasi diperbarui (dapat diunduh)'),
(214, 'CD006202501270007', '07', '2025-02-01 11:15:10', 'SK Mutasi (dapat diunduh)'),
(215, 'CD001202501270002', '03', '2025-02-01 11:45:01', 'Proses Verifikasi Berkas di Dinas Provinsi (Lengkap). '),
(216, 'CD001202501270001', '03', '2025-02-01 11:45:06', 'Proses Verifikasi Berkas di Dinas Provinsi (Lengkap). '),
(217, 'CD001202501270002', '04', '2025-02-01 11:45:21', 'Telaah Usulan oleh Kepala Bidang GTK (Disetujui). Usulan mutasi memenuhi syarat'),
(218, 'CD001202501270001', '04', '2025-02-01 11:45:26', 'Telaah Usulan oleh Kepala Bidang GTK (Disetujui). Usulan mutasi memenuhi syarat'),
(219, 'CD001202501270001', '05', '2025-02-01 18:45:35', 'Penerbitan surat rekomendasi Kepala Dinas'),
(220, 'CD001202501270002', '05', '2025-02-01 18:45:42', 'Penerbitan surat rekomendasi Kepala Dinas'),
(221, 'CD001202501270002', '06', '2025-02-01 11:45:57', 'Berkas dikirim ke Badan Kepegawaian Aceh (BKA).'),
(222, 'CD001202501270001', '06', '2025-02-01 11:45:57', 'Berkas dikirim ke Badan Kepegawaian Aceh (BKA).'),
(223, 'CD001202501270001', '07', '2025-02-01 11:46:20', 'Nota Dinas (dapat diunduh)'),
(224, 'CD007202501260004', '07', '2025-02-01 11:59:29', 'File SK Mutasi / Nota Dinas diperbarui'),
(225, 'CD011202501290001', '06', '2025-02-01 12:10:33', 'SK Mutasi / Nota Dinas telah dibatalkan'),
(226, 'CD004202501270003', '06', '2025-02-01 12:11:52', 'SK Mutasi / Nota Dinas telah dibatalkan'),
(227, 'CD004202501270002', '06', '2025-02-01 12:12:00', 'SK Mutasi / Nota Dinas telah dibatalkan'),
(228, 'CD004202501270001', '06', '2025-02-01 12:12:08', 'SK Mutasi / Nota Dinas telah dibatalkan'),
(229, 'CD006202501270007', '07', '2025-02-01 12:12:48', 'File SK Mutasi / Nota Dinas diperbarui'),
(230, 'CD007202501260004', '06', '2025-02-01 12:51:05', 'SK Mutasi / Nota Dinas telah dibatalkan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cabang_dinas`
--
ALTER TABLE `cabang_dinas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_cabang` (`kode_cabang`);

--
-- Indeks untuk tabel `operator_cabang_dinas`
--
ALTER TABLE `operator_cabang_dinas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cabang_dinas_id` (`cabang_dinas_id`),
  ADD KEY `fk_user_operator` (`user_id`);

--
-- Indeks untuk tabel `pengiriman_usulan`
--
ALTER TABLE `pengiriman_usulan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rekom_kadis`
--
ALTER TABLE `rekom_kadis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sk_mutasi`
--
ALTER TABLE `sk_mutasi`
  ADD PRIMARY KEY (`id_skmutasi`),
  ADD UNIQUE KEY `nomor_usulan` (`nomor_usulan`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `usulan`
--
ALTER TABLE `usulan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `guru_nip` (`guru_nip`),
  ADD UNIQUE KEY `nomor_usulan` (`nomor_usulan`),
  ADD UNIQUE KEY `unique_nip_status` (`guru_nip`,`status`),
  ADD KEY `fk_cabang_dinas` (`cabang_dinas_id`),
  ADD KEY `fk_usulan_rekomkadis` (`id_rekomkadis`);

--
-- Indeks untuk tabel `usulan_status_history`
--
ALTER TABLE `usulan_status_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nomor_usulan` (`nomor_usulan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cabang_dinas`
--
ALTER TABLE `cabang_dinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `operator_cabang_dinas`
--
ALTER TABLE `operator_cabang_dinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT untuk tabel `pengiriman_usulan`
--
ALTER TABLE `pengiriman_usulan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `rekom_kadis`
--
ALTER TABLE `rekom_kadis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `sk_mutasi`
--
ALTER TABLE `sk_mutasi`
  MODIFY `id_skmutasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `usulan`
--
ALTER TABLE `usulan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT untuk tabel `usulan_status_history`
--
ALTER TABLE `usulan_status_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=231;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `operator_cabang_dinas`
--
ALTER TABLE `operator_cabang_dinas`
  ADD CONSTRAINT `fk_user_operator` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `operator_cabang_dinas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `operator_cabang_dinas_ibfk_2` FOREIGN KEY (`cabang_dinas_id`) REFERENCES `cabang_dinas` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_logs`
--
ALTER TABLE `user_logs`
  ADD CONSTRAINT `user_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `usulan`
--
ALTER TABLE `usulan`
  ADD CONSTRAINT `fk_cabang_dinas` FOREIGN KEY (`cabang_dinas_id`) REFERENCES `cabang_dinas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_usulan_rekomkadis` FOREIGN KEY (`id_rekomkadis`) REFERENCES `rekom_kadis` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `usulan_status_history`
--
ALTER TABLE `usulan_status_history`
  ADD CONSTRAINT `usulan_status_history_ibfk_1` FOREIGN KEY (`nomor_usulan`) REFERENCES `usulan` (`nomor_usulan`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
