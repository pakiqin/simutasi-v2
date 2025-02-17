-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Feb 2025 pada 15.34
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
(25, 'CD000', 'Dinas Pendidikan Aceh'),
(31, 'CD020', 'Cabang Dinas Wilayah Kota Subulussalam dan Kabupaten Aceh Singkil');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cabang_dinas_kabupaten`
--

CREATE TABLE `cabang_dinas_kabupaten` (
  `id` int(11) NOT NULL,
  `cabang_dinas_id` int(11) NOT NULL,
  `kabupaten_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cabang_dinas_kabupaten`
--

INSERT INTO `cabang_dinas_kabupaten` (`id`, `cabang_dinas_id`, `kabupaten_id`) VALUES
(1, 3, 20),
(2, 3, 9),
(3, 13, 18),
(5, 22, 4),
(6, 21, 13),
(7, 20, 16),
(8, 19, 8),
(9, 17, 17),
(10, 16, 14),
(11, 15, 5),
(12, 14, 7),
(13, 12, 15),
(14, 11, 22),
(15, 10, 6),
(16, 9, 12),
(17, 8, 23),
(18, 7, 11),
(19, 6, 10),
(20, 6, 19),
(21, 5, 21),
(25, 24, 1),
(26, 31, 2),
(27, 31, 24);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_sekolah`
--

CREATE TABLE `data_sekolah` (
  `id` int(11) NOT NULL,
  `npsn` varchar(20) NOT NULL,
  `nama_sekolah` varchar(255) NOT NULL,
  `alamat_sekolah` text NOT NULL,
  `kabupaten_id` int(11) NOT NULL,
  `jenjang` enum('SLB','SMA','SMK') NOT NULL,
  `status` enum('Negeri','Swasta') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_sekolah`
--

INSERT INTO `data_sekolah` (`id`, `npsn`, `nama_sekolah`, `alamat_sekolah`, `kabupaten_id`, `jenjang`, `status`) VALUES
(53, '10104044', 'SMA NEGERI 1 SULTAN DAULAT', 'Kec. Sultan Daulat', 24, 'SMA', 'Negeri'),
(54, '10104056', 'SMK NEGERI 1 SIMPANG KIRI', 'Kec. Simpang Kiri', 24, 'SMK', 'Negeri'),
(55, '10104059', 'SMAN 1 RUNDENG', 'Kec. Rundeng', 24, 'SMA', 'Negeri'),
(56, '69962012', 'SMK NEGERI 2 SIMPANG KIRI', 'Kec. Simpang Kiri', 24, 'SMK', 'Negeri'),
(57, '10113652', 'SMK NEGERI SULTAN DAULAT', 'Kec. Sultan Daulat', 24, 'SMK', 'Negeri'),
(58, '69883598', 'SMK NEGERI 1 RUNDENG', 'Kec. Rundeng', 24, 'SMK', 'Negeri'),
(59, '10111321', 'SMAS JANNATUL FIRDAUS', 'Kec. Simpang Kiri', 24, 'SMA', 'Swasta'),
(60, '69981914', 'SMA Negeri 8 Subulussalam', 'Kec. Sultan Daulat', 24, 'SMA', 'Negeri'),
(61, '10104040', 'SMA NEGERI 1 SIMPANG KIRI', 'Kec. Simpang Kiri', 24, 'SMA', 'Negeri'),
(62, '10107804', 'SMA NEGERI UNGGUL SUBULUSSALAM', 'Kec. Simpang Kiri', 24, 'SMA', 'Negeri'),
(63, '10104041', 'SMA HIDAYATULLAH', 'Kec. Simpang Kiri', 24, 'SMA', 'Swasta'),
(64, '69864676', 'SMA NEGERI 1 PENANGGALAN', 'Kec. Penanggalan', 24, 'SMA', 'Negeri'),
(65, '69991961', 'SMA Swasta Syekh Al-Fansyuri', 'Kec. Rundeng', 24, 'SMA', 'Swasta'),
(66, '10104058', 'SMK NEGERI 1 PENANGGALAN', 'Kec. Penanggalan', 24, 'SMK', 'Negeri'),
(67, '70004322', 'SLB Negeri Syech Abdurrauf', 'Kec. Simpang Kiri', 24, 'SLB', 'Negeri'),
(68, '10111320', 'SMA NEGERI 1 LONGKIB', 'Kec. Longkib', 24, 'SMA', 'Negeri'),
(69, '69822414', 'SMA NEGERI 2 SIMPANG KIRI', 'Kec. Simpang Kiri', 24, 'SMA', 'Negeri'),
(70, '69822416', 'SMA DAYAH PERBATASAN MINHAJUSSALAM', 'Kec. Penanggalan', 24, 'SMA', 'Swasta'),
(71, '10111326', 'SMAS PLUS MUHAMMADIYAH', 'Kec. Simpang Kiri', 24, 'SMA', 'Swasta'),
(72, '70012124', 'SMKS BP Darussalam', 'Kec. Simpang Kiri', 24, 'SMK', 'Swasta'),
(73, '10113367', 'SMA SWASTA RAUDHATUL JANNAH', 'Kec. Simpang Kiri', 24, 'SMA', 'Swasta'),
(74, '10111680', 'SMAN 1 TEUPAH BARAT', 'Kec. Teupah Barat', 1, 'SMA', 'Negeri'),
(75, '10103348', 'SMKN 2 SINABANG', 'Kec. Simeulue Timur', 1, 'SMK', 'Negeri'),
(76, '10103352', 'SMAN 1 SIMEULUE BARAT', 'Kec. Simeulue Barat', 1, 'SMA', 'Negeri'),
(77, '10110896', 'SMAN 2 SALANG', 'Kec. Salang', 1, 'SMA', 'Negeri'),
(78, '10110895', 'SMAN 1 SALANG', 'Kec. Salang', 1, 'SMA', 'Negeri'),
(79, '10110904', 'SMAN 1 SIMEULUE CUT', 'Kec. Simeulue Cut', 1, 'SMA', 'Negeri'),
(80, '70003654', 'SMA IT Ruhul Islam', 'Kec. Simeulue Timur', 1, 'SMA', 'Swasta'),
(81, '10110902', 'SMAN 2 SIMEULUE TENGAH', 'Kec. Simeulue Tengah', 1, 'SMA', 'Negeri'),
(82, '60726437', 'SMA NEGERI 2 ALAFAN', 'Kec. Alafan', 1, 'SMA', 'Negeri'),
(83, '10103347', 'SMKN 1 SINABANG', 'Kec. Simeulue Timur', 1, 'SMK', 'Negeri'),
(84, '10113403', 'SMA NEGERI 3 TEUPAH SELATAN', 'Kec. Teupah Selatan', 1, 'SMA', 'Negeri'),
(85, '10110894', 'SMAN 1 ALAFAN', 'Kec. Alafan', 1, 'SMA', 'Negeri'),
(86, '10113064', 'SMAN 2 TEUPAH BARAT', 'Kec. Teupah Barat', 1, 'SMA', 'Negeri'),
(87, '10103326', 'SMAN 1 SINABANG', 'Kec. Simeulue Timur', 1, 'SMA', 'Negeri'),
(88, '69949037', 'SMA Negeri 5 Simeulue Barat', 'Kec. Simeulue Barat', 1, 'SMA', 'Negeri'),
(89, '69896252', 'SMK NEGERI 1 SIMEULUE CUT', 'Kec. Simeulue Cut', 1, 'SMK', 'Negeri'),
(90, '10111681', 'SMAN 1 TEUPAH SELATAN', 'Kec. Teupah Selatan', 1, 'SMA', 'Negeri'),
(91, '69969845', 'SLB Negeri Simeulue', 'Kec. Simeulue Timur', 1, 'SLB', 'Negeri'),
(92, '10111679', 'SMAN 1 TELUK DALAM', 'Kec. Teluk Dalam', 1, 'SMA', 'Negeri'),
(93, '69949251', 'SMK NEGERI PERIKANAN SIMEULUE BARAT', 'Kec. Simeulue Barat', 1, 'SMK', 'Negeri'),
(94, '10110901', 'SMAN 3 SIMEULUE BARAT', 'Kec. Simeulue Barat', 1, 'SMA', 'Negeri'),
(95, '69775747', 'SMA NEGERI 3 SIMEULUE TENGAH', 'Kec. Simeulue Tengah', 1, 'SMA', 'Negeri'),
(96, '10111935', 'SMKN 1 TEUPAH SELATAN', 'Kec. Teupah Selatan', 1, 'SMK', 'Negeri'),
(97, '10112509', 'SMKN 1 SALANG', 'Kec. Salang', 1, 'SMK', 'Negeri'),
(98, '10103325', 'SMAN 1 SIMEULUE TENGAH', 'Kec. Simeulue Tengah', 1, 'SMA', 'Negeri'),
(99, '10110879', 'SMAN 2 SINABANG', 'Kec. Simeulue Timur', 1, 'SMA', 'Negeri'),
(100, '60726439', 'SMA NEGERI 2 TELUK DALAM', 'Kec. Teluk Dalam', 1, 'SMA', 'Negeri'),
(101, '10110903', 'SMAN 2 SIMEULUE BARAT', 'Kec. Simeulue Barat', 1, 'SMA', 'Negeri'),
(102, '69949446', 'SMAN 3 Sinabang', 'Kec. Simeulue Timur', 1, 'SMA', 'Negeri'),
(103, '10111947', 'SMKN 1 TEUPAH TENGAH', 'Kec. Teupah Tengah', 1, 'SMK', 'Negeri'),
(104, '10110880', 'SMAN 1 TEUPAH TENGAH', 'Kec. Teupah Tengah', 1, 'SMA', 'Negeri'),
(105, '60726436', 'SMA NEGERI 4 SIMEULUE BARAT', 'Kec. Simeulue Barat', 1, 'SMA', 'Negeri'),
(106, '10111684', 'SMKN 3 SINABANG', 'Kec. Simeulue Timur', 1, 'SMK', 'Negeri'),
(107, '69775748', 'SMA NEGERI 2 TEUPAH SELATAN', 'Kec. Teupah Selatan', 1, 'SMA', 'Negeri'),
(108, '60726435', 'SMA NEGERI 4 TEUPAH SELATAN', 'Kec. Teupah Selatan', 1, 'SMA', 'Negeri'),
(109, '10105273', 'SMAN 1 SABANG', 'Kec. Sukajaya', 21, 'SMA', 'Negeri'),
(110, '10110706', 'SMAS ISLAM AL-MUJADDID', 'Kec. Sukajaya', 21, 'SMA', 'Swasta'),
(111, '10105272', 'SMAN 2 SABANG', 'Kec. Sukakarya', 21, 'SMA', 'Negeri'),
(112, '10105280', 'SMKN 1 SABANG', 'Kec. Sukajaya', 21, 'SMK', 'Negeri'),
(113, '10105289', 'SLB Negeri 1 Sabang', 'Kec. Sukajaya', 21, 'SLB', 'Negeri'),
(114, '69838664', 'SLB Negeri 2 Sabang', 'Kec. Sukakarya', 21, 'SLB', 'Negeri'),
(115, '10111806', 'SMKN I BANDAR DUA', 'Kec. Bandar Dua', 19, 'SMK', 'Negeri'),
(116, '10100543', 'SMAN 1 TRIENGGADENG', 'Kec. Trienggadeng', 19, 'SMA', 'Negeri'),
(117, '69950731', 'SMK UMMUL AYMAN 2', 'Kec. Meurah Dua', 19, 'SMK', 'Swasta'),
(118, '10100575', 'SMAN 1 MEUREUDU', 'Kec. Meureudu', 19, 'SMA', 'Negeri'),
(119, '10113086', 'SMA NEGERI UNGGUL', 'Kec. Meureudu', 19, 'SMA', 'Negeri'),
(120, '10112855', 'SMKN 1 BANDAR BARU', 'Kec. Bandar Baru', 19, 'SMK', 'Negeri'),
(121, '10100550', 'SMAN 2 BANDAR BARU', 'Kec. Bandar Baru', 19, 'SMA', 'Negeri'),
(122, '10107933', 'SMAN 1 PANTERAJA', 'Kec. Panteraja', 19, 'SMA', 'Negeri'),
(123, '10100569', 'SMAN 1 BANDAR BARU', 'Kec. Bandar Baru', 19, 'SMA', 'Negeri'),
(124, '69984140', 'SLB BAITUL ILMI', 'Kec. Trienggadeng', 19, 'SLB', 'Swasta'),
(125, '10113045', 'SMAN 1 JANGKA BUYA', 'Kec. Jangka Buya', 19, 'SMA', 'Negeri'),
(126, '10100551', 'SMAN 2 MEUREUDU', 'Kec. Meurah Dua', 19, 'SMA', 'Negeri'),
(127, '10112856', 'SMKN TRIENGGADENG', 'Kec. Trienggadeng', 19, 'SMK', 'Negeri'),
(128, '69972006', 'SMK BUDI', 'Kec. Bandar Dua', 19, 'SMK', 'Swasta'),
(129, '69946884', 'SMA DARUSSAADAH LANGIEN', 'Kec. Bandar Baru', 19, 'SMA', 'Swasta'),
(130, '10112857', 'SMK NEGERI ULIM', 'Kec. Ulim', 19, 'SMK', 'Negeri'),
(131, '10100570', 'SMAN 1 BANDAR DUA', 'Kec. Bandar Dua', 19, 'SMA', 'Negeri'),
(132, '69970973', 'SMA Swasta Misbahud Dhulam Al Aziziyah', 'Kec. Bandar Baru', 19, 'SMA', 'Swasta'),
(133, '10113050', 'SMA NEGERI 2 BANDAR DUA', 'Kec. Bandar Dua', 19, 'SMA', 'Negeri'),
(134, '69775447', 'SMKS Kesehatan Putroe Nanggroe', 'Kec. Meureudu', 19, 'SMK', 'Swasta'),
(135, '69830103', 'SLB NEGERI PIDIE JAYA', 'Kec. Meureudu', 19, 'SLB', 'Negeri'),
(136, '69943660', 'SMA TERPADU RAUDHATUL ULUM', 'Kec. Ulim', 19, 'SMA', 'Swasta'),
(137, '69896284', 'SMA DARUSSAADAH PIJAY', 'Kec. Panteraja', 19, 'SMA', 'Swasta'),
(138, '70049631', 'SMK Swasta Tastafi', 'Kec. Meureudu', 19, 'SMK', 'Swasta'),
(139, '10100634', 'SMKN 2 SIGLI', 'Kec. Kota Sigli', 10, 'SMK', 'Negeri'),
(140, '10100617', 'SMKS MUTIARA', 'Kec. Mutiara Timur', 10, 'SMK', 'Swasta'),
(141, '10100557', 'SMAN 1 PEUKAN PIDIE', 'Kec. Pidie', 10, 'SMA', 'Negeri'),
(142, '10100559', 'SMAN 1 MUTIARA', 'Kec. Mutiara Timur', 10, 'SMA', 'Negeri'),
(143, '10100541', 'SMAN 1 SIGLI', 'Kec. Kota Sigli', 10, 'SMA', 'Negeri'),
(144, '10100563', 'SMAN 1 PEUKAN BARO', 'Kec. Peukan Baro', 10, 'SMA', 'Negeri'),
(145, '10100577', 'SMAS DARUSSA ADAH', 'Kec. Glumpang Tiga', 10, 'SMA', 'Swasta'),
(146, '69753602', 'SMK NEGERI MANE', 'Kec. Mane', 10, 'SMK', 'Negeri'),
(147, '10100566', 'SMAN 2 MUTIARA', 'Kec. Mutiara Timur', 10, 'SMA', 'Negeri'),
(148, '10110275', 'SMKN 3 SIGLI', 'Kec. Kota Sigli', 10, 'SMK', 'Negeri'),
(149, '10100553', 'SMAN 2 SIGLI', 'Kec. Kota Sigli', 10, 'SMA', 'Negeri'),
(150, '69899931', 'SMK SWASTA SAKTI', 'Kec. Sakti', 10, 'SMK', 'Swasta'),
(151, '10100576', 'SMAN 1 MUARA TIGA', 'Kec. Muara Tiga', 10, 'SMA', 'Negeri'),
(152, '69950432', 'SMKN BATEE', 'Kec. Batee', 10, 'SMK', 'Negeri'),
(153, '10100572', 'SMAN 1 GLUMPANG TIGA', 'Kec. Glumpang Tiga', 10, 'SMA', 'Negeri'),
(154, '10100633', 'SMKS LILAWANGSA SIGLI', 'Kec. Pidie', 10, 'SMK', 'Swasta'),
(155, '10110265', 'SLB NEGERI BAMBI', 'Kec. Peukan Baro', 10, 'SLB', 'Negeri'),
(156, '10100558', 'SMAN 1 PADANG TIJI', 'Kec. Padang Tiji', 10, 'SMA', 'Negeri'),
(157, '10107931', 'SMA NEGERI 3 UNGGUL SIGLI', 'Kec. Pidie', 10, 'SMA', 'Negeri'),
(158, '10100571', 'SMAN 1 GEUMPANG', 'Kec. Geumpang', 10, 'SMA', 'Negeri'),
(159, '70002887', 'SMA Islam Al-Khaidar', 'Kec. Padang Tiji', 10, 'SMA', 'Swasta'),
(160, '10100574', 'SMAN 1 KEMBANG TANJONG', 'Kec. Kembang Tanjung', 10, 'SMA', 'Negeri'),
(161, '10108241', 'SMA NEGERI UNGGUL SIGLI', 'Kec. Pidie', 10, 'SMA', 'Negeri'),
(162, '10108240', 'SMAS ISLAM TGK. CHIK DI BEUREU-EH', 'Kec. Mutiara', 10, 'SMA', 'Swasta'),
(163, '10100618', 'SMKS TUNAS HARAPAN SIGLI', 'Kec. Pidie', 10, 'SMK', 'Swasta'),
(164, '10100556', 'SMAS CHIK DITIRO SIGLI', 'Kec. Kota Sigli', 10, 'SMA', 'Swasta'),
(165, '69831498', 'SLB NEGERI PIDIE', 'Kec. Mutiara', 10, 'SLB', 'Negeri'),
(166, '10100540', 'SMAN 1 SAKTI', 'Kec. Sakti', 10, 'SMA', 'Negeri'),
(167, '10100635', 'SMKN 1 SIGLI', 'Kec. Kota Sigli', 10, 'SMK', 'Negeri'),
(168, '10100542', 'SMAN 1 SIMPANG TIGA', 'Kec. Simpang Tiga', 10, 'SMA', 'Negeri'),
(169, '10110276', 'SMKS AL FITRI BEUREUNUEN', 'Kec. Mutiara', 10, 'SMK', 'Swasta'),
(170, '10108074', 'SMAN 1 GLUMPANG BARO', 'Kec. Glumpang Baro', 10, 'SMA', 'Negeri'),
(171, '10100573', 'SMAN 1 INDRAJAYA', 'Kec. Indrajaya', 10, 'SMA', 'Negeri'),
(172, '10100545', 'SMAN 1 DELIMA', 'Kec. Grong-Grong', 10, 'SMA', 'Negeri'),
(173, '10100554', 'SMAN 1 KEUMALA', 'Kec. Keumala', 10, 'SMA', 'Negeri'),
(174, '10100565', 'SMAN 2 INDRAJAYA', 'Kec. Indrajaya', 10, 'SMA', 'Negeri'),
(175, '10113017', 'SMAN 2 DELIMA', 'Kec. Delima', 10, 'SMA', 'Negeri'),
(176, '69760847', 'SMAN 1 MILA', 'Kec. Mila', 10, 'SMA', 'Negeri'),
(177, '10107932', 'SMA SUKMA BANGSA KABUPATEN PIDIE', 'Kec. Peukan Baro', 10, 'SMA', 'Swasta'),
(178, '69984146', 'SMA ISLAM TERPADU AL-USWAH', 'Kec. Kota Sigli', 10, 'SMA', 'Swasta'),
(179, '69899743', 'SMA NEGERI ULUMUL QURAN', 'Kec. Pidie', 10, 'SMA', 'Negeri'),
(180, '10100564', 'SMAN 1 TANGSE', 'Kec. Tangse', 10, 'SMA', 'Negeri'),
(181, '69980202', 'SMAS THAUTHIATUL ABRAAR', 'Kec. Mutiara', 10, 'SMA', 'Swasta'),
(182, '69970774', 'SMK Negeri Glumpang Baro', 'Kec. Glumpang Baro', 10, 'SMK', 'Negeri'),
(183, '70042085', 'SMK IT AL AZIZIYYAH AL-WALIYYAH', 'Kec. Kembang Tanjung', 10, 'SMK', 'Swasta'),
(184, '10112889', 'SMKN BEUNGGA', 'Kec. Tangse', 10, 'SMK', 'Negeri'),
(185, '69978381', 'SMKS BP Sirajul Huda Al-Aziziyah', 'Kec. Pidie', 10, 'SMK', 'Swasta'),
(186, '70045439', 'SLB Permata Aceh', 'Kec. Glumpang Tiga', 10, 'SLB', 'Swasta'),
(187, '70039856', 'SMA IT Baitul Ula Tangse', 'Kec. Tangse', 10, 'SMA', 'Swasta'),
(188, '10113239', 'SMAN 3 SEUNAGAN', 'Kec. Seunagan', 16, 'SMA', 'Negeri'),
(189, '10104701', 'SMAN 2 SEUNAGAN', 'Kec. Seunagan Timur', 16, 'SMA', 'Negeri'),
(190, '10108059', 'SMAN 2 KUALA', 'Kec. Kuala', 16, 'SMA', 'Negeri'),
(191, '10104680', 'SMAN 1 BEUTONG', 'Kec. Beutong', 16, 'SMA', 'Negeri'),
(192, '10113240', 'SMA NEGERI 1 SUKA MAKMUE', 'Kec. Suka Makmue', 16, 'SMA', 'Negeri'),
(193, '10110632', 'SMAN BUNGA BANGSA', 'Kec. Darul Makmur', 16, 'SMA', 'Negeri'),
(194, '10107965', 'SMAN 2 BEUTONG', 'Kec. Beutong', 16, 'SMA', 'Negeri'),
(195, '60726181', 'SMKN 1 KUALA PESISIR', 'Kec. Kuala Pesisir', 16, 'SMK', 'Negeri'),
(196, '10107964', 'SMAN 1 KUALA', 'Kec. Kuala', 16, 'SMA', 'Negeri'),
(197, '70024106', 'SMA IT Nurul Ikhwah', 'Kec. Kuala Pesisir', 16, 'SMA', 'Swasta'),
(198, '10114230', 'SLB NEGERI SEUNAGAN', 'Kec. Seunagan', 16, 'SLB', 'Negeri'),
(199, '10113241', 'SMAN 1 TADU RAYA', 'Kec. Tadu Raya', 16, 'SMA', 'Negeri'),
(200, '10107926', 'SMAN 1 SEUNAGAN', 'Kec. Seunagan', 16, 'SMA', 'Negeri'),
(201, '10108057', 'SMAN 2 DARUL MAKMUR', 'Kec. Darul Makmur', 16, 'SMA', 'Negeri'),
(202, '10108209', 'SMKN 1 NAGAN RAYA', 'Kec. Suka Makmue', 16, 'SMK', 'Negeri'),
(203, '10113243', 'SMAN 6 DARUL MAKMUR', 'Kec. Darul Makmur', 16, 'SMA', 'Negeri'),
(204, '10110295', 'SMAN 3 DARUL MAKMUR', 'Kec. Tripa Makmur', 16, 'SMA', 'Negeri'),
(205, '10108208', 'SMKS DARMA SHALIHAT ALUE BILIE', 'Kec. Darul Makmur', 16, 'SMK', 'Swasta'),
(206, '69899799', 'SMK DHARMA SHALIHAT 2 UJONG PATIHAH', 'Kec. Kuala', 16, 'SMK', 'Swasta'),
(207, '10113242', 'SMAN 5 DARUL MAKMUR', 'Kec. Darul Makmur', 16, 'SMA', 'Negeri'),
(208, '70041493', 'SLB Bina Generasi Emas', 'Kec. Kuala', 16, 'SLB', 'Swasta'),
(209, '10110338', 'SMAN 4 KUALA', 'Kec. Tadu Raya', 16, 'SMA', 'Negeri'),
(210, '10107963', 'SMAN 3 KUALA', 'Kec. Kuala Pesisir', 16, 'SMA', 'Negeri'),
(211, '10108058', 'SMAN 1 DARUL MAKMUR', 'Kec. Darul Makmur', 16, 'SMA', 'Negeri'),
(212, '10105619', 'SMAN 1 LHOKSEUMAWE', 'Kec. Banda Sakti', 23, 'SMA', 'Negeri'),
(213, '10105624', 'SMAN 6 LHOKSEUMAWE', 'Kec. Blang Mangat', 23, 'SMA', 'Negeri'),
(214, '69932555', 'SLB NEGERI ANEUK NANGGROE', 'Kec. Muara Dua', 23, 'SLB', 'Negeri'),
(215, '10105604', 'SMAN MODAL BANGSA ARUN', 'Kec. Muara Satu', 23, 'SMA', 'Negeri'),
(216, '10105625', 'SMKN 1 LHOKSEUMAWE', 'Kec. Banda Sakti', 23, 'SMK', 'Negeri'),
(217, '10105622', 'SMAN 4 LHOKSEUMAWE', 'Kec. Muara Dua', 23, 'SMA', 'Negeri'),
(218, '10105626', 'SMKN 2 LHOKSEUMAWE', 'Kec. Banda Sakti', 23, 'SMK', 'Negeri'),
(219, '10105628', 'SMKN 4 LHOKSEUMAWE', 'Kec. Banda Sakti', 23, 'SMK', 'Negeri'),
(220, '10111838', 'SMK NEGERI 7 LHOKSEUMAWE', 'Kec. Muara Satu', 23, 'SMK', 'Negeri'),
(221, '10105621', 'SMAN 3 LHOKSEUMAWE', 'Kec. Banda Sakti', 23, 'SMA', 'Negeri'),
(222, '10110714', 'SMKN 5 LHOKSEUMAWE', 'Kec. Blang Mangat', 23, 'SMK', 'Negeri'),
(223, '10105623', 'SMAN 5 LHOKSEUMAWE', 'Kec. Muara Dua', 23, 'SMA', 'Negeri'),
(224, '10105620', 'SMA NEGERI 2 LHOKSEUMAWE', 'Kec. Banda Sakti', 23, 'SMA', 'Negeri'),
(225, '69955275', 'SMA BP AN-NAHLA', 'Kec. Banda Sakti', 23, 'SMA', 'Swasta'),
(226, '69758279', 'SMKS KESEHATAN DARUSSALAM', 'Kec. Banda Sakti', 23, 'SMK', 'Swasta'),
(227, '10105627', 'SMKN 3 LHOKSEUMAWE', 'Kec. Banda Sakti', 23, 'SMK', 'Negeri'),
(228, '69758278', 'SMKN 8 LHOKSEUMAWE', 'Kec. Muara Dua', 23, 'SMK', 'Negeri'),
(229, '10107919', 'SMAS SUKMA BANGSA', 'Kec. Muara Dua', 23, 'SMA', 'Swasta'),
(230, '10113641', 'SLB KOTA LHOKSEUMAWE', 'Kec. Banda Sakti', 23, 'SLB', 'Swasta'),
(231, '10110769', 'SMK NEGERI 6 LHOKSEUMAWE', 'Kec. Banda Sakti', 23, 'SMK', 'Negeri'),
(232, '70037285', 'SMA IT Dataqu Imam Syafii', 'Kec. Muara Dua', 23, 'SMA', 'Swasta'),
(233, '10111836', 'SMAN 7 LHOKSEUMAWE', 'Kec. Muara Satu', 23, 'SMA', 'Negeri'),
(234, '10110650', 'SMKS ULUMUDDIN', 'Kec. Muara Dua', 23, 'SMK', 'Swasta'),
(235, '70050297', 'SMA IT Riyadhatul Qulub', 'Kec. Blang Mangat', 23, 'SMA', 'Swasta'),
(236, '70039275', 'SMA IT Zurriyatul Quran Al-Maarif', 'Kec. Blang Mangat', 23, 'SMA', 'Swasta'),
(237, '10105629', 'SMKS KARYA BERINGIN', 'Kec. Banda Sakti', 23, 'SMK', 'Swasta'),
(238, '70003663', 'SMK IT Pesantren Tabina Aceh', 'Kec. Muara Satu', 23, 'SMK', 'Swasta'),
(239, '10113250', 'SLB CINTA MANDIRI', 'Kec. Muara Dua', 23, 'SLB', 'Swasta'),
(240, '69944036', 'SMA AL QUR AN AR-RAUDHAH', 'Kec. Blang Mangat', 23, 'SMA', 'Swasta'),
(241, '10107115', 'SMK N 5 LANGSA', 'Kec. Langsa Timur', 22, 'SMK', 'Negeri'),
(242, '10105735', 'SMA N 1 LANGSA', 'Kec. Langsa Baro', 22, 'SMA', 'Negeri'),
(243, '10107501', 'SMA N 5 LANGSA', 'Kec. Langsa Baro', 22, 'SMA', 'Negeri'),
(244, '10105736', 'SMA N 2 LANGSA', 'Kec. Langsa Timur', 22, 'SMA', 'Negeri'),
(245, '10105724', 'SMK N 2 LANGSA', 'Kec. Langsa Baro', 22, 'SMK', 'Negeri'),
(246, '10113917', 'SMK N 6 LANGSA', 'Kec. Langsa Baro', 22, 'SMK', 'Negeri'),
(247, '10105744', 'SMK N 4 LANGSA', 'Kec. Langsa Baro', 22, 'SMK', 'Negeri'),
(248, '10105706', 'SMK AL-WASHLIYAH', 'Kec. Langsa Kota', 22, 'SMK', 'Swasta'),
(249, '10105752', 'SMA N 4 LANGSA', 'Kec. Langsa Barat', 22, 'SMA', 'Negeri'),
(250, '10105707', 'SMK N 3 LANGSA', 'Kec. Langsa Baro', 22, 'SMK', 'Negeri'),
(251, '10105732', 'SMA JAYA LANGSA', 'Kec. Langsa Baro', 22, 'SMA', 'Swasta'),
(252, '10112965', 'SLB TERPADU KOTA LANGSA', 'Kec. Langsa Baro', 22, 'SLB', 'Swasta'),
(253, '69896933', 'SMA UNGGUL CUT NYAK DHIEN', 'Kec. Langsa Baro', 22, 'SMA', 'Swasta'),
(254, '10105737', 'SMA N 3 LANGSA', 'Kec. Langsa Kota', 22, 'SMA', 'Negeri'),
(255, '10105716', 'SLB NEGERI KOTA LANGSA', 'Kec. Langsa Kota', 22, 'SLB', 'Negeri'),
(256, '10105704', 'SMK N 1 LANGSA', 'Kec. Langsa Kota', 22, 'SMK', 'Negeri'),
(257, '10105745', 'SMPLB KOTA LANGSA', 'Kec. Langsa Baro', 22, 'SLB', 'Swasta'),
(258, '10105731', 'SMA CUT NYAK DHIEN', 'Kec. Langsa Kota', 22, 'SMA', 'Swasta'),
(259, '10105733', 'SMA MUHAMMADIYAH LANGSA', 'Kec. Langsa Kota', 22, 'SMA', 'Swasta'),
(260, '69896934', 'SMK PERBANKAN GRAHA MEDIA', 'Kec. Langsa Kota', 22, 'SMK', 'Swasta'),
(261, '10105708', 'SMK 2 CUT NYAK DHIEN', 'Kec. Langsa Kota', 22, 'SMK', 'Swasta'),
(262, '69991216', 'SLB GLOBAL SCHOOL LANGSA', 'Kec. Langsa Kota', 22, 'SLB', 'Swasta'),
(263, '10104524', 'SMA NEGERI 1 PUTRI BETUNG', 'Kec. Putri Betung', 14, 'SMA', 'Negeri'),
(264, '10112966', 'SMA NEGERI 2 BLANGKEJEREN', 'Kec. Blang Pegayon', 14, 'SMA', 'Negeri'),
(265, '10104541', 'SMKN 1 GAYO LUES', 'Kec. Dabun Gelang', 14, 'SMK', 'Negeri'),
(266, '10104525', 'SMA NEGERI 1 BLANGPEGAYON', 'Kec. Blang Pegayon', 14, 'SMA', 'Negeri'),
(267, '10113610', 'SMA NEGERI 1 PANTAN CUACA', 'Kec. Pantan Cuaca', 14, 'SMA', 'Negeri'),
(268, '10104547', 'SMA NEGERI SERIBU BUKIT', 'Kec. Blang Pegayon', 14, 'SMA', 'Negeri'),
(269, '10110281', 'SMA NEGERI 1 BLANGJERANGO', 'Kec. Blangjerango', 14, 'SMA', 'Negeri'),
(270, '10104527', 'SMA NEGERI 1 TERANGUN', 'Kec. Terangun', 14, 'SMA', 'Negeri'),
(271, '10111906', 'SMKN 2 BLANGKEJEREN', 'Kec. Kutapanjang', 14, 'SMK', 'Negeri'),
(272, '10113205', 'SLB PEMBINA BLANGKEJEREN', 'Kec. Dabun Gelang', 14, 'SLB', 'Negeri'),
(273, '10104529', 'SMA NEGERI 1 KUTAPANJANG', 'Kec. Kutapanjang', 14, 'SMA', 'Negeri'),
(274, '10104528', 'SMA NEGERI 1 BLANGKEJEREN', 'Kec. Blangkejeren', 14, 'SMA', 'Negeri'),
(275, '10104530', 'SMA NEGERI 1 RIKIT GAIB', 'Kec. Rikit Gaib', 14, 'SMA', 'Negeri'),
(276, '10111952', 'SMA NEGERI 1 TRIPE JAYA', 'Kec. Tripe Jaya', 14, 'SMA', 'Negeri'),
(277, '10110280', 'SMA NEGERI 1 PINING', 'Kec. Pining', 14, 'SMA', 'Negeri'),
(278, '10111359', 'SLB Swasta Mutiara Louser', 'Kec. Blangkejeren', 14, 'SLB', 'Swasta'),
(279, '69934208', 'SMA SWASTA TERPADU BUSTANUL ARIFIN', 'Kec. Blangjerango', 14, 'SMA', 'Swasta'),
(280, '70028767', 'SMA IT Askaril Ikhlas', 'Kec. Blangkejeren', 14, 'SMA', 'Swasta'),
(281, '70048756', 'SMA Muhammadiyah Gayo Lues', 'Kec. Blangkejeren', 14, 'SMA', 'Swasta'),
(282, '70010959', 'SMAIT BUNAYYA', 'Kec. Blangkejeren', 14, 'SMA', 'Swasta'),
(283, '69786524', 'SMALBS MUTIARA LOUSER', 'Kec. Blangkejeren', 14, 'SMA', 'Swasta'),
(284, '70047395', 'SMK Negeri 3 Blangkejeren', 'Kec. Blang Pegayon', 14, 'SMK', 'Negeri'),
(285, '10107102', 'SMA NEGERI 1 KUALA', 'Kec. Kuala', 11, 'SMA', 'Negeri'),
(286, '10107087', 'SMA NEGERI 1 KUTABLANG', 'Kec. Kuta Blang', 11, 'SMA', 'Negeri'),
(287, '10107092', 'SMA NEGERI 1 PEUSANGAN', 'Kec. Peusangan', 11, 'SMA', 'Negeri'),
(288, '10107106', 'SMK NEGERI 1 BIREUEN', 'Kec. Kota Juang', 11, 'SMK', 'Negeri'),
(289, '70001673', 'SLB Vokasional Muhammadiyah Bireuen', 'Kec. Kota Juang', 11, 'SLB', 'Swasta'),
(290, '10107083', 'SMA NEGERI 1 BIREUEN', 'Kec. Kota Juang', 11, 'SMA', 'Negeri'),
(291, '10111943', 'SMA NEGERI 1 JEUNIEB', 'Kec. Jeunib', 11, 'SMA', 'Negeri'),
(292, '10107101', 'SMA NEGERI 3 BIREUEN', 'Kec. Kota Juang', 11, 'SMA', 'Negeri'),
(293, '69981359', 'SMA SWASTA SIRAJUL MUDI', 'Kec. Makmur', 11, 'SMA', 'Swasta'),
(294, '10112848', 'SMA NEGERI 3 PEUSANGAN', 'Kec. Peusangan', 11, 'SMA', 'Negeri'),
(295, '10107107', 'SMK NEGERI 1 JEUNIEB', 'Kec. Jeunib', 11, 'SMK', 'Negeri'),
(296, '10107097', 'SMA NEGERI 2 BIREUEN', 'Kec. Kota Juang', 11, 'SMA', 'Negeri'),
(297, '10107090', 'SMA NEGERI 1 PEUDADA', 'Kec. Peudada', 11, 'SMA', 'Negeri'),
(298, '10112852', 'SMA SWASTA TAUTHIAH ARONGAN', 'Kec. Simpang Mamplam', 11, 'SMA', 'Swasta'),
(299, '10107099', 'SMA NEGERI 2 PEUSANGAN', 'Kec. Peusangan', 11, 'SMA', 'Negeri'),
(300, '69766971', 'SMK NEGERI 2 PEUSANGAN', 'Kec. Peusangan', 11, 'SMK', 'Negeri'),
(301, '69766972', 'SLB JEUMPA BIREUEN', 'Kec. Jeumpa', 11, 'SLB', 'Swasta'),
(302, '69848999', 'SMA NEGERI 1 JEUMPA', 'Kec. Jeumpa', 11, 'SMA', 'Negeri'),
(303, '10113435', 'SMA SWASTA ISLAM DARUL ULUM', 'Kec. Peusangan', 11, 'SMA', 'Swasta'),
(304, '10107098', 'SMA NEGERI 2 KUTABLANG', 'Kec. Kuta Blang', 11, 'SMA', 'Negeri'),
(305, '69947570', 'SMA SWASTA NURUL ISLAM', 'Kec. Peudada', 11, 'SMA', 'Swasta'),
(306, '69889024', 'SMA Swasta Islam Zulkifliyah', 'Kec. Simpang Mamplam', 11, 'SMA', 'Swasta'),
(307, '10107085', 'SMA NEGERI 1 JANGKA', 'Kec. Jangka', 11, 'SMA', 'Negeri'),
(308, '10107089', 'SMA NEGERI 1 PANDRAH', 'Kec. Pandrah', 11, 'SMA', 'Negeri'),
(309, '70012119', 'SMAIT Entrepreneur Muhammadiyah', 'Kec. Kota Juang', 11, 'SMA', 'Swasta'),
(310, '10107094', 'SMA NEGERI 1 PEUSANGAN SIBLAH KRUENG', 'Kec. Peusangan Siblah Krueng', 11, 'SMA', 'Negeri'),
(311, '69757212', 'SMK NEGERI 1 SIMPANG MAMPLAM', 'Kec. Simpang Mamplam', 11, 'SMK', 'Negeri'),
(312, '69950369', 'SMA ISLAM SWASTA IHDAL ULUM AL AZIZIYAH', 'Kec. Samalanga', 11, 'SMA', 'Swasta'),
(313, '10107105', 'SMA SWASTA SUKMA BANGSA BIREUEN', 'Kec. Jeumpa', 11, 'SMA', 'Swasta'),
(314, '69759042', 'SMA NEGERI 3 SAMALANGA', 'Kec. Samalanga', 11, 'SMA', 'Negeri'),
(315, '10107095', 'SMA NEGERI 1 SAMALANGA', 'Kec. Samalanga', 11, 'SMA', 'Negeri'),
(316, '10107108', 'SMK NEGERI 1 PEUSANGAN', 'Kec. Peusangan', 11, 'SMK', 'Negeri'),
(317, '70042805', 'SMK Harapan Ummat', 'Kec. Simpang Mamplam', 11, 'SMK', 'Swasta'),
(318, '10107096', 'SMA NEGERI 1 SIMPANG MAMPLAM', 'Kec. Simpang Mamplam', 11, 'SMA', 'Negeri'),
(319, '69964066', 'SLB Negeri Terpadu Bireuen', 'Kec. Peusangan', 11, 'SLB', 'Negeri'),
(320, '10107088', 'SMA NEGERI 1 MAKMUR', 'Kec. Makmur', 11, 'SMA', 'Negeri'),
(321, '10107084', 'SMA NEGERI 1 GANDAPURA', 'Kec. Ganda Pura', 11, 'SMA', 'Negeri'),
(322, '10107100', 'SMA NEGERI 2 SAMALANGA', 'Kec. Samalanga', 11, 'SMA', 'Negeri'),
(323, '10107109', 'SMK NEGERI 1 JEUMPA', 'Kec. Jeumpa', 11, 'SMK', 'Negeri'),
(324, '10110286', 'SLB NEGERI BIREUEN', 'Kec. Kota Juang', 11, 'SLB', 'Negeri'),
(325, '69945354', 'SMK SWASTA AL-HIDAYAH', 'Kec. Peulimbang', 11, 'SMK', 'Swasta'),
(326, '70041708', 'SMA-IT Baitul Ihsan Al-Hanafiah', 'Kec. Samalanga', 11, 'SMA', 'Swasta'),
(327, '10107086', 'SMA NEGERI 1 JULI', 'Kec. Juli', 11, 'SMA', 'Negeri'),
(328, '10107192', 'SMA SWASTA MUSLIMAT SAMALANGA', 'Kec. Samalanga', 11, 'SMA', 'Swasta'),
(329, '69979147', 'SMA IT ASSALAM ISLAMIC SCHOOL', 'Kec. Jeunib', 11, 'SMA', 'Swasta'),
(330, '10112957', 'SMK NEGERI 1 GANDA PURA', 'Kec. Ganda Pura', 11, 'SMK', 'Negeri'),
(331, '10113428', 'SMK-PP NEGERI BIREUEN', 'Kec. Peusangan', 11, 'SMK', 'Negeri'),
(332, '69970305', 'SMA Swasta Terpadu Al-Furqan', 'Kec. Peusangan', 11, 'SMA', 'Swasta'),
(333, '70041647', 'SMA Darsa Boarding School', 'Kec. Jeunib', 11, 'SMA', 'Swasta'),
(334, '10107113', 'SLB YTC KUTA BLANG', 'Kec. Kuta Blang', 11, 'SLB', 'Swasta'),
(335, '10107093', 'SMA NEGERI 1 PEUSANGAN SELATAN', 'Kec. Peusangan Selatan', 11, 'SMA', 'Negeri'),
(336, '69766970', 'SMK SWASTA ASD FOUNDATION', 'Kec. Juli', 11, 'SMK', 'Swasta'),
(337, '69763257', 'SMK SWASTA JAMIAH AL-AZIZIYAH', 'Kec. Samalanga', 11, 'SMK', 'Swasta'),
(338, '10103755', 'SMK SWASTA KESEHATAN MUHAMMADIYAH', 'Kec. Kota Juang', 11, 'SMK', 'Swasta'),
(339, '10107091', 'SMA NEGERI 1 PEULIMBANG', 'Kec. Peulimbang', 11, 'SMA', 'Negeri'),
(340, '10107112', 'SLB AL IKHLAS', 'Kec. Juli', 11, 'SLB', 'Swasta'),
(341, '69964064', 'SMA Plus Al-Fata', 'Kec. Juli', 11, 'SMA', 'Swasta'),
(342, '69948358', 'SMA Swasta THAUTHIATU ASYRAF', 'Kec. Simpang Mamplam', 11, 'SMA', 'Swasta'),
(343, '69896698', 'SMA TERPADU DARUSSAADAH', 'Kec. Bener Kelipah', 18, 'SMA', 'Swasta'),
(344, '10107283', 'SMKN 1 BENER MERIAH', 'Kec. Bukit', 18, 'SMK', 'Negeri'),
(345, '10107207', 'SLBN PEMBINA BENER MERIAH', 'Kec. Wih Pesam', 18, 'SLB', 'Negeri'),
(346, '10107276', 'SMA NEGERI UNGGUL BINAAN', 'Kec. Wih Pesam', 18, 'SMA', 'Negeri'),
(347, '10105184', 'SMA NEGERI 1 PERMATA', 'Kec. Permata', 18, 'SMA', 'Negeri'),
(348, '10105182', 'SMAN 1 BANDAR', 'Kec. Bandar', 18, 'SMA', 'Negeri'),
(349, '69874081', 'SMA TERPADU BUSTANUL ARIFIN 2', 'Kec. Bukit', 18, 'SMA', 'Swasta'),
(350, '10107284', 'SMK Negeri 2 Bener Meriah', 'Kec. Timang Gajah', 18, 'SMK', 'Negeri'),
(351, '10107279', 'SMA NEGERI 3 TIMANG GAJAH', 'Kec. Timang Gajah', 18, 'SMA', 'Negeri'),
(352, '10107277', 'SMAN 2 BANDAR', 'Kec. Bandar', 18, 'SMA', 'Negeri'),
(353, '10105183', 'SMA NEGERI 1 BUKIT', 'Kec. Bukit', 18, 'SMA', 'Negeri'),
(354, '10107285', 'SMKN 4 BENER MERIAH', 'Kec. Wih Pesam', 18, 'SMK', 'Negeri'),
(355, '69972330', 'SMK Negeri 5 Bener Meriah', 'Kec. Permata', 18, 'SMK', 'Negeri'),
(356, '10107281', 'SMAS TERPADU SEMAYOEN NUSANTARA', 'Kec. Bukit', 18, 'SMA', 'Swasta'),
(357, '10107274', 'SMA NEGERI 1 PINTU RIME GAYO', 'Kec. Pintu Rime Gayo', 18, 'SMA', 'Negeri'),
(358, '10105185', 'SMAN 1 TIMANG GAJAH', 'Kec. Gajah Putih', 18, 'SMA', 'Negeri'),
(359, '60724680', 'SMA NEGERI 1 MESIDAH', 'Kec. Mesidah', 18, 'SMA', 'Negeri'),
(360, '10105171', 'SMA NEGERI 2 TIMANG GAJAH', 'Kec. Timang Gajah', 18, 'SMA', 'Negeri'),
(361, '70015169', 'SLB Swasta Anugerah Rizky Nabila', 'Kec. Permata', 18, 'SLB', 'Swasta'),
(362, '10107275', 'SMA NEGERI 2 BUKIT', 'Kec. Bukit', 18, 'SMA', 'Negeri'),
(363, '10113405', 'SMA TERPADU BUSTANUL ULUM', 'Kec. Permata', 18, 'SMA', 'Swasta'),
(364, '10107271', 'SMAS TERPADU BUSTANUL ARIFIN', 'Kec. Bukit', 18, 'SMA', 'Swasta'),
(365, '10107282', 'SMA NEGERI 1 SYIAH UTAMA', 'Kec. Syiah Utama', 18, 'SMA', 'Negeri'),
(366, '69984841', 'SMA SWASTA HAFIDZ TERPADU DARUL MUKLASIN', 'Kec. Pintu Rime Gayo', 18, 'SMA', 'Swasta'),
(367, '10105249', 'SLB-YIBM Pondok Gajah', 'Kec. Bandar', 18, 'SLB', 'Swasta'),
(368, '69966704', 'SMK Hidayatul Insani Abadi', 'Kec. Bandar', 18, 'SMK', 'Swasta'),
(369, '10107280', 'SMA NEGERI 2 PINTU RIME GAYO', 'Kec. Pintu Rime Gayo', 18, 'SMA', 'Negeri'),
(370, '10110766', 'SLBS RESTU PERMATA BUNDA', 'Kec. Timang Gajah', 18, 'SLB', 'Swasta'),
(371, '69963053', 'SLB Ashabul Kahfi', 'Kec. Pintu Rime Gayo', 18, 'SLB', 'Swasta'),
(372, '69947949', 'SMA TERPADU HAQQUL MUBIN', 'Kec. Bandar', 18, 'SMA', 'Swasta'),
(373, '69855673', 'SMK NEGERI 3 PERTANIAN BENER MERIAH', 'Kec. Pintu Rime Gayo', 18, 'SMK', 'Negeri'),
(374, '69948198', 'SMA TERPADU NURUL HUDA', 'Kec. Permata', 18, 'SMA', 'Swasta'),
(375, '69874080', 'SMA TERPADU AHLUSSUNNAH WALJAMAAH', 'Kec. Wih Pesam', 18, 'SMA', 'Swasta'),
(376, '10105399', 'SMAN 2 BANDA ACEH', 'Kec. Kuta Alam', 20, 'SMA', 'Negeri'),
(377, '10107310', 'SMAS LAB SCHOOL', 'Kec. Syiah Kuala', 20, 'SMA', 'Swasta'),
(378, '10105388', 'SMAN 3 BANDA ACEH', 'Kec. Kuta Alam', 20, 'SMA', 'Negeri'),
(379, '10107195', 'SMAN 11 BANDA ACEH', 'Kec. Lueng Bata', 20, 'SMA', 'Negeri'),
(380, '10107194', 'SMAN 10 FAJAR HARAPAN BANDA ACEH', 'Kec. Baiturrahman', 20, 'SMA', 'Negeri'),
(381, '10110454', 'SMK SMTI BANDA ACEH', 'Kec. Kuta Alam', 20, 'SMK', 'Negeri'),
(382, '10105338', 'SMKN 2 BANDA ACEH', 'Kec. Banda Raya', 20, 'SMK', 'Negeri'),
(383, '10107197', 'SMAN 9 BANDA ACEH', 'Kec. Banda Raya', 20, 'SMA', 'Negeri'),
(384, '10113601', 'SMK KESEHATAN ASSYIFA SCHOOL', 'Kec. Baiturrahman', 20, 'SMK', 'Swasta'),
(385, '69822495', 'SMA PLUS AL-ATHIYAH BANDA ACEH', 'Kec. Kuta Alam', 20, 'SMA', 'Swasta'),
(386, '70048895', 'SLB YAPDI Banda Aceh', 'Kec. Jaya Baru', 20, 'SLB', 'Swasta'),
(387, '10110818', 'SMKS FARMASI CUT MEUTIA', 'Kec. Baiturrahman', 20, 'SMK', 'Swasta'),
(388, '10105404', 'SMAS AL MISBAH', 'Kec. Meuraxa', 20, 'SMA', 'Swasta'),
(389, '10107309', 'SMAS FATIH BILINGUAL SCHOOL', 'Kec. Banda Raya', 20, '', 'Swasta'),
(390, '10106294', 'SMKN 1 BANDA ACEH', 'Kec. Banda Raya', 20, 'SMK', 'Negeri'),
(391, '10105387', 'SMAN 4 BANDA ACEH', 'Kec. Kuta Alam', 20, 'SMA', 'Negeri'),
(392, '10105389', 'SMAN 1 BANDA ACEH', 'Kec. Meuraxa', 20, 'SMA', 'Negeri'),
(393, '69989237', 'SMA Keberbakatan Olahraga Negeri Aceh', 'Kec. Banda Raya', 20, 'SMA', 'Negeri'),
(394, '10113048', 'SMAN 14 BANDA ACEH', 'Kec. Kuta Raja', 20, 'SMA', 'Negeri'),
(395, '10105340', 'SMAN 8 BANDA ACEH', 'Kec. Kuta Alam', 20, 'SMA', 'Negeri'),
(396, '10105398', 'SMAN 5 BANDA ACEH', 'Kec. Syiah Kuala', 20, 'SMA', 'Negeri'),
(397, '10105396', 'SMAN 7 BANDA ACEH', 'Kec. Banda Raya', 20, 'SMA', 'Negeri'),
(398, '10105344', 'SLB NEGERI BANDA ACEH', 'Kec. Baiturrahman', 20, 'SLB', 'Negeri'),
(399, '10106291', 'SMAN 13 BANDA ACEH', 'Kec. Kuta Raja', 20, 'SMA', 'Negeri'),
(400, '69892366', 'SLB-YBSM', 'Kec. Meuraxa', 20, 'SLB', 'Swasta'),
(401, '10105331', 'SLB BUKESRA ACEH', 'Kec. Ulee Kareng', 20, 'SLB', 'Swasta'),
(402, '10113599', 'SMAN 16 BANDA ACEH', 'Kec. Ulee Kareng', 20, 'SMA', 'Negeri'),
(403, '69959161', 'SLB TNCC', 'Kec. Kuta Alam', 20, 'SLB', 'Swasta'),
(404, '10105337', 'SMKN 3 BANDA ACEH', 'Kec. Banda Raya', 20, 'SMK', 'Negeri'),
(405, '10106295', 'SMKN 4 BANDA ACEH', 'Kec. Kuta Alam', 20, 'SMK', 'Negeri'),
(406, '10111577', 'SMKN 5 TELKOM', 'Kec. Kuta Alam', 20, 'SMK', 'Negeri'),
(407, '10107303', 'SLB-B YPAC Banda Aceh', 'Kec. Kuta Alam', 20, 'SLB', 'Swasta'),
(408, '10107196', 'SMA NEGERI 12 BANDA ACEH', 'Kec. Kuta Alam', 20, 'SMA', 'Negeri'),
(409, '10105381', 'SMAS KARTIKA XIV-I', 'Kec. Baiturrahman', 20, 'SMA', 'Swasta'),
(410, '10105397', 'SMAN 6 BANDA ACEH', 'Kec. Meuraxa', 20, 'SMA', 'Negeri'),
(411, '10110808', 'SLB YPPC BANDA ACEH', 'Kec. Kuta Alam', 20, 'SLB', 'Swasta'),
(412, '10105394', 'SMAS KATOLIK', 'Kec. Baiturrahman', 20, 'SMA', 'Swasta'),
(413, '10105342', 'SMAS INSHAFUDDIN', 'Kec. Kuta Alam', 20, 'SMA', 'Swasta'),
(414, '10111885', 'SMA TEUKU NYAK ARIF FATIH BILINGUAL SCHOOL', 'Kec. Syiah Kuala', 20, '', 'Swasta'),
(415, '10105407', 'SMAS MUHAMMADIYAH', 'Kec. Baiturrahman', 20, 'SMA', 'Swasta'),
(416, '10107304', 'SLB-CD YPAC Banda Aceh', 'Kec. Lueng Bata', 20, 'SLB', 'Swasta'),
(417, '10105385', 'SMAS CUT MUTIA BANDA ACEH', 'Kec. Baiturrahman', 20, 'SMA', 'Swasta'),
(418, '10105386', 'SMA NEGERI 15 ADIDARMA', 'Kec. Kuta Alam', 20, 'SMA', 'Negeri'),
(419, '10106293', 'SMKS MUHAMMADIYAH', 'Kec. Baiturrahman', 20, 'SMK', 'Swasta'),
(420, '10105384', 'SMAS GRANADA PGRI', 'Kec. Kuta Alam', 20, 'SMA', 'Swasta'),
(421, '10105395', 'SMAS METHODIST', 'Kec. Banda Raya', 20, 'SMA', 'Swasta'),
(422, '10101909', 'SMAN 1 PANTEE BIDARI', 'Kec. Pante Beudari', 6, 'SMA', 'Negeri'),
(423, '10113366', 'SMAN 1 DARUL IHSAN', 'Kec. Darul Ihsan', 6, 'SMA', 'Negeri'),
(424, '10110606', 'SMKN 1 SIMPANG ULIM', 'Kec. Simpang Ulim', 6, 'SMK', 'Negeri'),
(425, '10101875', 'SMAN 1 DARUL AMAN', 'Kec. Darul Aman', 6, 'SMA', 'Negeri'),
(426, '10113651', 'SMAN 2 IDI', 'Kec. Idi Rayeuk', 6, 'SMA', 'Negeri'),
(427, '69978666', 'SMK Negeri 2 Ranto Peureulak', 'Kec. Ranto Peureulak', 6, 'SMK', 'Negeri'),
(428, '10110367', 'SMAN UNGGUL ACEH TIMUR', 'Kec. Birem Bayeun', 6, 'SMA', 'Negeri'),
(429, '10110368', 'SMKN TAMAN FAJAR', 'Kec. Peureulak', 6, 'SMK', 'Negeri'),
(430, '10110578', 'SMKN 1 IDI', 'Kec. Idi Rayeuk', 6, 'SMK', 'Negeri'),
(431, '10113344', 'SMKN 1 PEUREULAK', 'Kec. Peureulak Barat', 6, 'SMK', 'Negeri'),
(432, '10110366', 'SMAN 1 PEUNARON', 'Kec. Peunaron', 6, 'SMA', 'Negeri'),
(433, '10110460', 'SMAN 1 SUNGAI RAYA', 'Kec. Sungai Raya', 6, 'SMA', 'Negeri'),
(434, '69946252', 'SMAN TITI BARO', 'Kec. Idi Rayeuk', 6, 'SMA', 'Negeri'),
(435, '10101872', 'SMAN 1 SIMPANG ULIM', 'Kec. Simpang Ulim', 6, 'SMA', 'Negeri'),
(436, '10101884', 'SMAN 1 RANTO PEUREULAK', 'Kec. Ranto Peureulak', 6, 'SMA', 'Negeri'),
(437, '10111334', 'SMKN 2 PEUREULAK', 'Kec. Peureulak', 6, 'SMK', 'Negeri'),
(438, '60726233', 'SMAN 1 BANDA ALAM', 'Kec. Banda Alam', 6, 'SMA', 'Negeri'),
(439, '10101876', 'SMAN 1 IDI RAYEUK', 'Kec. Idi Rayeuk', 6, 'SMA', 'Negeri'),
(440, '10101877', 'SMAN 1 JULOK', 'Kec. Julok', 6, 'SMA', 'Negeri'),
(441, '10113373', 'SMKN 1 PANTE BIDARI', 'Kec. Pante Beudari', 6, 'SMK', 'Negeri'),
(442, '10113346', 'SMKN 1 PEUREULAK TIMUR', 'Kec. Peureulak Timur', 6, 'SMK', 'Negeri'),
(443, '10112863', 'SMAN 1 BIREM BAYEUN', 'Kec. Birem Bayeun', 6, 'SMA', 'Negeri'),
(444, '69970762', 'SMK Negeri Darul Ihsan', 'Kec. Darul Ihsan', 6, 'SMK', 'Negeri'),
(445, '10101907', 'SMAN 1 MADAT', 'Kec. Madat', 6, 'SMA', 'Negeri'),
(446, '10112170', 'SMKN 1 JULOK', 'Kec. Julok', 6, 'SMK', 'Negeri'),
(447, '69990050', 'SMK NEGERI 1 NURUSSALAM', 'Kec. Nurussalam', 6, 'SMK', 'Negeri'),
(448, '10111584', 'SMKN 1 LOKOP', 'Kec. Serba Jadi', 6, 'SMK', 'Negeri'),
(449, '69833370', 'SMAN 2 MADAT', 'Kec. Madat', 6, 'SMA', 'Negeri'),
(450, '69946304', 'SMKN 1 INDRA MAKMU', 'Kec. Indra Makmur', 6, 'SMK', 'Negeri'),
(451, '10110364', 'SMAN 1 NURUSSALAM', 'Kec. Nurussalam', 6, 'SMA', 'Negeri'),
(452, '69896121', 'SMA NEGERI 2 BIREM BAYEUN', 'Kec. Birem Bayeun', 6, 'SMA', 'Negeri'),
(453, '60726151', 'SMAN 1 DARUL FALAH', 'Kec. Darul Falah', 6, 'SMA', 'Negeri'),
(454, '10110365', 'SMAN 1 PEUDAWA', 'Kec. Peudawa', 6, 'SMA', 'Negeri'),
(455, '10101904', 'SMAN 1 RANTAU SELAMAT', 'Kec. Rantau Selamat', 6, 'SMA', 'Negeri'),
(456, '69952591', 'SMAN 3 BIREM BAYEUN', 'Kec. Birem Bayeun', 6, 'SMA', 'Negeri'),
(457, '69873975', 'SMKN 1 DARUL AMAN', 'Kec. Darul Aman', 6, 'SMK', 'Negeri'),
(458, '10110559', 'SMAN 1 INDRA MAKMU', 'Kec. Indra Makmur', 6, 'SMA', 'Negeri'),
(459, '10113602', 'SMAN 2 RANTAU SELAMAT', 'Kec. Rantau Selamat', 6, 'SMA', 'Negeri'),
(460, '10101881', 'SMAN 1 PEUREULAK', 'Kec. Peureulak', 6, 'SMA', 'Negeri'),
(461, '69814205', 'SLBS CAHAYA', 'Kec. Peureulak', 6, 'SLB', 'Swasta'),
(462, '69991917', 'SLB Negeri Aceh Timur', 'Kec. Peudawa', 6, 'SLB', 'Negeri'),
(463, '10113409', 'SMAS PLUS AMAL', 'Kec. Peureulak Barat', 6, 'SMA', 'Swasta'),
(464, '10111344', 'SMAN 1 IDI TUNONG', 'Kec. Idi Tunong', 6, 'SMA', 'Negeri'),
(465, '69755583', 'SMKN 1 SIMPANG JERNIH', 'Kec. Simpang Jernih', 6, 'SMK', 'Negeri'),
(466, '70003664', 'SMK Swasta Ashabul Huda Al Asyi', 'Kec. Sungai Raya', 6, 'SMK', 'Swasta'),
(467, '69939616', 'SMAN 2 PANTE BIDARI', 'Kec. Pante Beudari', 6, 'SMA', 'Negeri'),
(468, '10112901', 'SMAS DARUSS ADAH', 'Kec. Banda Alam', 6, 'SMA', 'Swasta'),
(469, '69726324', 'SMKS PLUS AMAL', 'Kec. Peureulak Barat', 6, 'SMK', 'Swasta'),
(470, '10101903', 'SMAS PLUS NURUL ULUM', 'Kec. Peureulak', 6, 'SMA', 'Swasta'),
(471, '70003384', 'SMAS Terpadu Fathurrahman', 'Kec. Pante Beudari', 6, 'SMA', 'Swasta'),
(472, '10102284', 'SMAN 7 TAKENGON', 'Kec. Bintang', 7, 'SMA', 'Negeri'),
(473, '10102248', 'SMAN 2 TAKENGON', 'Kec. Kebayakan', 7, 'SMA', 'Negeri'),
(474, '10112426', 'SMAN 17 TAKENGON', 'Kec. Bies', 7, 'SMA', 'Negeri'),
(475, '10107816', 'SMKN 3 TAKENGON', 'Kec. Bebesen', 7, 'SMK', 'Negeri'),
(476, '69775643', 'SLBS QALBUN FITRAH TAKENGON', 'Kec. Ketol', 7, 'SLB', 'Swasta'),
(477, '10112956', 'SMKN 4 TAKENGON', 'Kec. Jagong Jeget', 7, 'SMK', 'Negeri'),
(478, '70003115', 'SMK Negeri 5 Takengon', 'Kec. Laut Tawar', 7, 'SMK', 'Negeri'),
(479, '10102277', 'SMKN 1 TAKENGON', 'Kec. Bebesen', 7, 'SMK', 'Negeri'),
(480, '10102278', 'SMKN 2 TAKENGON', 'Kec. Pegasing', 7, 'SMK', 'Negeri'),
(481, '10102319', 'SLB Negeri Kebayakan Takengon', 'Kec. Kebayakan', 7, 'SLB', 'Negeri'),
(482, '10107824', 'SMAN 11 TAKENGON', 'Kec. Atu Lintang', 7, 'SMA', 'Negeri'),
(483, '10102261', 'SMAN 5 TAKENGON', 'Kec. Jagong Jeget', 7, 'SMA', 'Negeri'),
(484, '10102255', 'SLB YRPC TAKENGON', 'Kec. Bebesen', 7, 'SLB', 'Swasta'),
(485, '69774764', 'SMAN 19 TAKENGON', 'Kec. Rusip Antara', 7, 'SMA', 'Negeri'),
(486, '10102311', 'SMAN 3 TAKENGON', 'Kec. Pegasing', 7, 'SMA', 'Negeri'),
(487, '10112425', 'SMAN 13 TAKENGON', 'Kec. Linge', 7, 'SMA', 'Negeri'),
(488, '10112861', 'SMAN 15 TAKENGON BINAAN NENGGERI ANTARA', 'Kec. Pegasing', 7, 'SMA', 'Negeri'),
(489, '10102259', 'SMAN 6 TAKENGON', 'Kec. Silih Nara', 7, 'SMA', 'Negeri'),
(490, '10102283', 'SMAN 8 TAKENGON UNGGUL', 'Kec. Bebesen', 7, 'SMA', 'Negeri'),
(491, '10102181', 'SMAN 4 TAKENGON', 'Kec. Kebayakan', 7, 'SMA', 'Negeri'),
(492, '69929702', 'SLB MUSARA ATE', 'Kec. Bintang', 7, 'SLB', 'Swasta'),
(493, '10102285', 'SMAN 1 TAKENGON', 'Kec. Bebesen', 7, 'SMA', 'Negeri'),
(494, '10107514', 'SMAN 9 TAKENGON', 'Kec. Ketol', 7, 'SMA', 'Negeri'),
(495, '69971546', 'SMA Terpadu Al-Azhar Takengon', 'Kec. Pegasing', 7, 'SMA', 'Swasta'),
(496, '10107175', 'SLB Negeri Silih Nara Angkup', 'Kec. Silih Nara', 7, 'SLB', 'Negeri'),
(497, '10102291', 'SMAS MUHAMMADIYAH 5 TAKENGON', 'Kec. Kebayakan', 7, 'SMA', 'Swasta'),
(498, '10107513', 'SMAN 10 TAKENGON', 'Kec. Celala', 7, 'SMA', 'Negeri'),
(499, '10102320', 'SLB Negeri Pegasing', 'Kec. Pegasing', 7, 'SLB', 'Negeri'),
(500, '69815341', 'SMK KESEHATAN DEDINGIN 1001 TAKENGON', 'Kec. Bebesen', 7, 'SMK', 'Swasta'),
(501, '69893697', 'SLB QALBUN INSANNI CELALA', 'Kec. Celala', 7, 'SLB', 'Swasta'),
(502, '10112862', 'SMAN 16 TAKENGON', 'Kec. Kute Panang', 7, 'SMA', 'Negeri'),
(503, '69774763', 'SMAN 18 TAKENGON', 'Kec. Linge', 7, 'SMA', 'Negeri'),
(504, '69859400', 'SLB KUTE PANANG', 'Kec. Kute Panang', 7, 'SLB', 'Swasta'),
(505, '69948026', 'SMA Negeri 1 Bandar Pusaka', 'Kec. Bandar Pusaka', 15, 'SMA', 'Negeri'),
(506, '10104315', 'SMAN 2 PATRA NUSA MANYAK PAYED', 'Kec. Manyak Payed', 15, 'SMA', 'Negeri'),
(507, '10110624', 'SMKN 1 BENDAHARA', 'Kec. Bendahara', 15, 'SMK', 'Negeri'),
(508, '60726644', 'SMKN 1 KUALASIMPANG', 'Kec. Kualasimpang', 15, 'SMK', 'Negeri'),
(509, '10108048', 'SMKN 2 KARANG BARU', 'Kec. Karang Baru', 15, 'SMK', 'Negeri'),
(510, '10107120', 'SLB NEGERI PEMBINA ACEH TAMIANG', 'Kec. Rantau', 15, 'SLB', 'Negeri'),
(511, '10104272', 'SMAN 1 MANYAK PAYED', 'Kec. Manyak Payed', 15, 'SMA', 'Negeri'),
(512, '10104275', 'SMAN 1 BENDAHARA', 'Kec. Bendahara', 15, 'SMA', 'Negeri'),
(513, '10108044', 'SMAN 2 TAMIANG HULU', 'Kec. Tamiang Hulu', 15, 'SMA', 'Negeri'),
(514, '69948100', 'SMA Negeri 3 Manyak Payed', 'Kec. Manyak Payed', 15, 'SMA', 'Negeri'),
(515, '10108046', 'SMAN 4 KEJURUAN MUDA', 'Kec. Kejuruan Muda', 15, 'SMA', 'Negeri'),
(516, '10104273', 'SMAN 1 KEJURUAN MUDA', 'Kec. Rantau', 15, 'SMA', 'Negeri'),
(517, '10104271', 'SMAN 1 SERUWAY', 'Kec. Seruway', 15, 'SMA', 'Negeri'),
(518, '10112849', 'SMAN 2 SERUWAY', 'Kec. Seruway', 15, 'SMA', 'Negeri'),
(519, '10104269', 'SMAN 2 KEJURUAN MUDA', 'Kec. Kejuruan Muda', 15, 'SMA', 'Negeri'),
(520, '10107154', 'SMAN 3 KEJURUAN MUDA', 'Kec. Rantau', 15, 'SMA', 'Negeri'),
(521, '10110796', 'SMAS AL HIDAYAH', 'Kec. Kejuruan Muda', 15, 'SMA', 'Swasta'),
(522, '10107156', 'SMAN 5 KEJURUAN MUDA', 'Kec. Tenggulun', 15, 'SMA', 'Negeri'),
(523, '10107158', 'SMKN 1 KARANG BARU', 'Kec. Karang Baru', 15, 'SMK', 'Negeri'),
(524, '10107152', 'SMAN 2 BENDAHARA', 'Kec. Banda Mulya', 15, 'SMA', 'Negeri'),
(525, '10104267', 'SMKS MAIMUN HABSYAH KUALA SIMPANG', 'Kec. Kejuruan Muda', 15, 'SMK', 'Swasta'),
(526, '10108271', 'SMAS DARUL MUKHLISIN', 'Kec. Karang Baru', 15, 'SMA', 'Swasta'),
(527, '10104274', 'SMAN 1 KARANG BARU', 'Kec. Karang Baru', 15, 'SMA', 'Negeri'),
(528, '69966741', 'SMKS Sabilul Ulum', 'Kec. Manyak Payed', 15, 'SMK', 'Swasta'),
(529, '69948029', 'SMA Negeri 1 Rantau', 'Kec. Rantau', 15, 'SMA', 'Negeri'),
(530, '69948194', 'SMA Negeri 1 Tenggulun', 'Kec. Tenggulun', 15, 'SMA', 'Negeri'),
(531, '10108049', 'SMKN 3 KARANG BARU', 'Kec. Karang Baru', 15, 'SMK', 'Negeri'),
(532, '10104270', 'SMAN 1 TAMIANG HULU', 'Kec. Tamiang Hulu', 15, 'SMA', 'Negeri'),
(533, '69948028', 'SMA Negeri 3 Karang Baru', 'Kec. Karang Baru', 15, 'SMA', 'Negeri'),
(534, '10108225', 'SMAN 2 PERCONTOHAN KARANG BARU', 'Kec. Karang Baru', 15, 'SMA', 'Negeri'),
(535, '69888594', 'SMA SWASTA MANARUL ISLAM', 'Kec. Kejuruan Muda', 15, 'SMA', 'Swasta'),
(536, '70005918', 'SMK Swasta Misra', 'Kec. Rantau', 15, 'SMK', 'Swasta'),
(537, '10107157', 'SMAS SYAKIRAH', 'Kec. Kejuruan Muda', 15, 'SMA', 'Swasta'),
(538, '69899606', 'SMA ISLAM SWASTA MIFTAHUL ILMI', 'Kec. Manyak Payed', 15, 'SMA', 'Swasta'),
(539, '69948027', 'SMA Negeri 1 Sekerak', 'Kec. Sekerak', 15, 'SMA', 'Negeri'),
(540, '10104295', 'SMAS AL - WASHLIYAH', 'Kec. Kualasimpang', 15, 'SMA', 'Swasta'),
(541, '10107161', 'SMKS SYUKRONIYAH', 'Kec. Kejuruan Muda', 15, 'SMK', 'Swasta'),
(542, '10108201', 'SMAN 2 GUNUNG MERIAH', 'Kec. Gunung Mariah', 2, 'SMA', 'Negeri'),
(543, '10104048', 'SMAN 1 SINGKOHOR', 'Kec. Singkohor', 2, 'SMA', 'Negeri'),
(544, '10104057', 'SMKN1 SINGKIL UTARA', 'Kec. Singkil Utara', 2, 'SMK', 'Negeri'),
(545, '10104051', 'SMAN 1 SIMPANG KANAN', 'Kec. Simpang Kanan', 2, 'SMA', 'Negeri'),
(546, '10107807', 'SMKN 1 GUNUNG MERIAH', 'Kec. Gunung Mariah', 2, 'SMK', 'Negeri'),
(547, '10104039', 'SMAN 1 SINGKIL', 'Kec. Singkil', 2, 'SMA', 'Negeri'),
(548, '70003803', 'SMK Negeri 6 Aceh Singkil', 'Kec. Gunung Mariah', 2, 'SMK', 'Negeri'),
(549, '10104046', 'SMAN 1 DANAU PARIS', 'Kec. Danau Paris', 2, 'SMA', 'Negeri'),
(550, '10104042', 'SMAN 1 PULAU BANYAK', 'Kec. Pulau Banyak', 2, 'SMA', 'Negeri'),
(551, '10107801', 'SMKN KELAUTAN DAN PERIKANAN KUALA BARU', 'Kec. Kuala Baru', 2, 'SMK', 'Negeri'),
(552, '10104043', 'SMAN 1 GUNUNG MERIAH', 'Kec. Gunung Mariah', 2, 'SMA', 'Negeri'),
(553, '69758285', 'SMKN 1 SIMPANG KANAN', 'Kec. Simpang Kanan', 2, 'SMK', 'Negeri'),
(554, '69947031', 'SMK Swasta Muhammadiyah Singkil', 'Kec. Singkil', 2, 'SMK', 'Swasta'),
(555, '10108199', 'SMAS MUHAMMADIYAH GUNUNG MERIAH', 'Kec. Gunung Mariah', 2, 'SMA', 'Swasta'),
(556, '69968408', 'SLB Negeri Al-Fansury', 'Kec. Singkil', 2, 'SLB', 'Negeri'),
(557, '10104038', 'SMAN 1 SINGKIL UTARA', 'Kec. Singkil Utara', 2, 'SMA', 'Negeri'),
(558, '10104049', 'SMAN 1 SURO', 'Kec. Suro Makmur', 2, 'SMA', 'Negeri'),
(559, '70012731', 'SMAIT Al-Ulum Singkohor', 'Kec. Singkohor', 2, 'SMA', 'Swasta'),
(560, '70044960', 'SMA IT Darur Rasyid', 'Kec. Simpang Kanan', 2, 'SMA', 'Swasta'),
(561, '69988418', 'SMK Teknologi Al-Ishaqi', 'Kec. Gunung Mariah', 2, 'SMK', 'Swasta'),
(562, '69864640', 'SMK NEGERI 1 KUTA BAHARU', 'Kec. Kuta Baharu', 2, 'SMK', 'Negeri'),
(563, '69864689', 'SMK GLOBAL MANDIRI', 'Kec. Gunung Mariah', 2, 'SMK', 'Swasta'),
(564, '69786208', 'SMA NEGERI 1 PULAU BANYAK BARAT', 'Kec. Pulau Banyak Barat', 2, 'SMA', 'Negeri'),
(565, '69762597', 'SMAS SAFINATUSSALAMAH', 'Kec. Danau Paris', 2, 'SMA', 'Swasta'),
(566, '69992983', 'SMA IT Al-Hafidz Rizqullah', 'Kec. Kuta Baharu', 2, 'SMA', 'Swasta'),
(567, '10111870', 'SMAN 3 KLUET UTARA', 'Kec. Kluet Utara', 4, 'SMA', 'Negeri'),
(568, '10102772', 'SMKN 1 PASIE RAJA', 'Kec. Pasie Raja', 4, 'SMK', 'Negeri'),
(569, '10102790', 'SMAN 1 LABUHAN HAJI TIMUR', 'Kec. Labuhan Haji Timur', 4, 'SMA', 'Negeri'),
(570, '10102784', 'SMKN 1 SAWANG', 'Kec. Sawang', 4, 'SMK', 'Negeri'),
(571, '10102738', 'SMA SWASTA TARBIYAH', 'Kec. Labuhan Haji', 4, 'SMA', 'Swasta'),
(572, '10102728', 'SMAN 1 KLUET TENGAH', 'Kec. Kluet Tengah', 4, 'SMA', 'Negeri'),
(573, '10102726', 'SMAN 1 TRUMON TIMUR', 'Kec. Trumon Timur', 4, 'SMA', 'Negeri'),
(574, '10102774', 'SMKN 1 LABUHANHAJI', 'Kec. Labuhan Haji', 4, 'SMK', 'Negeri'),
(575, '70050033', 'SMA Plus Ulumul Quran Aceh Selatan', 'Kec. Tapak Tuan', 4, 'SMA', 'Swasta'),
(576, '10102773', 'SMKN 1 TAPAKTUAN', 'Kec. Tapak Tuan', 4, 'SMK', 'Negeri'),
(577, '69947303', 'SMA Negeri 3 Kluet Timur', 'Kec. Kluet Timur', 4, 'SMA', 'Negeri'),
(578, '10102742', 'SMKN MEUKEK', 'Kec. Meukek', 4, 'SMK', 'Negeri'),
(579, '10113257', 'SMK NEGERI 1 KLUET TIMUR', 'Kec. Kluet Timur', 4, 'SMK', 'Negeri'),
(580, '10102729', 'SMAN 1 TAPAKTUAN', 'Kec. Tapak Tuan', 4, 'SMA', 'Negeri'),
(581, '69874011', 'SMA UNGGUL HIDAYATUL ILMI', 'Kec. Trumon', 4, 'SMA', 'Negeri'),
(582, '10102771', 'SMA NEGERI 1 SAMADUA', 'Kec. Samadua', 4, 'SMA', 'Negeri'),
(583, '10102741', 'SMAS INSAN MADANI', 'Kec. Meukek', 4, 'SMA', 'Swasta'),
(584, '10102732', 'SMAN 1 KLUET UTARA', 'Kec. Kluet Utara', 4, 'SMA', 'Negeri'),
(585, '10102787', 'SMAN 1 KLUET SELATAN', 'Kec. Kluet Selatan', 4, 'SMA', 'Negeri'),
(586, '10102793', 'SMAN 2 TAPAKTUAN', 'Kec. Tapak Tuan', 4, 'SMA', 'Negeri'),
(587, '69991920', 'SLB Azzahra', 'Kec. Kluet Selatan', 4, 'SLB', 'Swasta'),
(588, '10102743', 'SMK NEGERI 1 TRUMON TIMUR', 'Kec. Trumon Timur', 4, 'SMK', 'Negeri'),
(589, '69874008', 'SMA NEGERI KOTA BAHAGIA', 'Kec. Kota Bahagia', 4, 'SMA', 'Negeri'),
(590, '10102722', 'SMA NEGERI 1 LABUHAN HAJI', 'Kec. Labuhan Haji', 4, 'SMA', 'Negeri'),
(591, '70014576', 'SMKS Labuhanhaji Barat', 'Kec. Labuhan Haji Barat', 4, 'SMK', 'Swasta'),
(592, '69946702', 'SMA Negeri 2 Kluet Timur', 'Kec. Kluet Timur', 4, 'SMA', 'Negeri'),
(593, '10102740', 'SMAN 1 LABUHAN HAJI BARAT', 'Kec. Labuhan Haji Barat', 4, 'SMA', 'Negeri'),
(594, '10102788', 'SMAN 1 PASIE RAJA', 'Kec. Pasie Raja', 4, 'SMA', 'Negeri'),
(595, '10102727', 'SMAN 2 KLUET UTARA', 'Kec. Kluet Utara', 4, 'SMA', 'Negeri'),
(596, '69874009', 'SMA NEGERI TRUMON TENGAH', 'Kec. Trumon Tengah', 4, 'SMA', 'Negeri'),
(597, '10102785', 'SMAN 1 SAWANG', 'Kec. Sawang', 4, 'SMA', 'Negeri'),
(598, '10102775', 'SMK NEGERI 1 SAMADUA', 'Kec. Samadua', 4, 'SMK', 'Negeri'),
(599, '10102730', 'SMAN 1 TRUMON', 'Kec. Trumon', 4, 'SMA', 'Negeri'),
(600, '10113351', 'SMA Negeri Unggul Darussalam Labuhan Haji', 'Kec. Labuhan Haji', 4, 'SMA', 'Negeri'),
(601, '69875551', 'SMA UNGGUL DARUSSAADAH KLUET RAYA', 'Kec. Pasie Raja', 4, 'SMA', 'Negeri'),
(602, '10102739', 'SMA ISLAM TERPADU DARUL AMILIN', 'Kec. Labuhan Haji Timur', 4, 'SMA', 'Swasta'),
(603, '69874007', 'SMA NEGERI 2 MEUKEK', 'Kec. Meukek', 4, 'SMA', 'Negeri'),
(604, '10102744', 'SMAN UNGGUL TAPAKTUAN', 'Kec. Tapak Tuan', 4, 'SMA', 'Negeri'),
(605, '10113369', 'SMKS HIDAYATUL ANAM', 'Kec. Kota Bahagia', 4, 'SMK', 'Swasta'),
(606, '10102770', 'SMAN 1 MEUKEK', 'Kec. Meukek', 4, 'SMA', 'Negeri'),
(607, '10113035', 'SMK NEGERI LABUHAN HAJI TIMUR', 'Kec. Labuhan Haji Timur', 4, 'SMK', 'Negeri'),
(608, '10102794', 'SMAN 1 BAKONGAN', 'Kec. Bakongan', 4, 'SMA', 'Negeri'),
(609, '69845478', 'SMA NEGERI 2 SAMADUA', 'Kec. Samadua', 4, 'SMA', 'Negeri'),
(610, '10102783', 'SMKN 1 KLUET SELATAN', 'Kec. Kluet Selatan', 4, 'SMK', 'Negeri'),
(611, '10111579', 'SMAN 1 BAKONGAN TIMUR', 'Kec. Bakongan Timur', 4, 'SMA', 'Negeri'),
(612, '70013935', 'SLB Negeri Aceh Selatan', 'Kec. Pasie Raja', 4, 'SLB', 'Negeri'),
(613, '10102731', 'SMAN 1 KLUET TIMUR', 'Kec. Kluet Timur', 4, 'SMA', 'Negeri'),
(614, '10102723', 'SMAS SIRAJUL IBAD', 'Kec. Meukek', 4, 'SMA', 'Swasta'),
(615, '10105042', 'SMA NEGERI 1 TEUNOM', 'Kec. Teunom', 17, 'SMA', 'Negeri'),
(616, '10108069', 'SMK NEGERI 1 CALANG', 'Kec. Krueng Sabee', 17, 'SMK', 'Negeri'),
(617, '69773552', 'SMA SWASTA NURUL HUDA AL AZIZIYYAH', 'Kec. Jaya', 17, 'SMA', 'Swasta'),
(618, '10108260', 'SMK NEGERI 1 DARUL HIKMAH', 'Kec. Darul Hikmah', 17, 'SMK', 'Negeri'),
(619, '10110489', 'SMA NEGERI 2 SAMPOINIET', 'Kec. Sampoiniet', 17, 'SMA', 'Negeri'),
(620, '10105059', 'SMA NEGERI 1 PANGA', 'Kec. Panga', 17, 'SMA', 'Negeri'),
(621, '69773569', 'SMK NEGERI 1 TEUNOM', 'Kec. Teunom', 17, 'SMK', 'Negeri'),
(622, '10110488', 'SMA NEGERI 1 SAMPOINIET', 'Kec. Sampoiniet', 17, 'SMA', 'Negeri'),
(623, '10113618', 'SMA NEGERI 1 KRUENG SABEE', 'Kec. Krueng Sabee', 17, 'SMA', 'Negeri'),
(624, '10113619', 'SMA NEGERI 1 INDRA JAYA', 'Kec. Indra Jaya', 17, 'SMA', 'Negeri'),
(625, '10105043', 'SMA NEGERI 1 CALANG', 'Kec. Krueng Sabee', 17, 'SMA', 'Negeri'),
(626, '10107925', 'SMA NEGERI 1 JAYA', 'Kec. Jaya', 17, 'SMA', 'Negeri'),
(627, '69946581', 'SMA NEGERI KEULUANG', 'Kec. Jaya', 17, 'SMA', 'Negeri'),
(628, '10108261', 'SMK SWASTA MUDI', 'Kec. Jaya', 17, 'SMK', 'Swasta'),
(629, '10110732', 'SMA NEGERI 1 SETIA BAKTI', 'Kec. Setia Bakti', 17, 'SMA', 'Negeri'),
(630, '10110768', 'SMK NEGERI 1 PASIE RAYA', 'Kec. Pasie Raya', 17, 'SMK', 'Negeri'),
(631, '10113622', 'SMK NEGERI 1 SETIA BAKTI', 'Kec. Setia Bakti', 17, 'SMK', 'Negeri'),
(632, '10113621', 'SMK NEGERI 1 PANGA', 'Kec. Panga', 17, 'SMK', 'Negeri'),
(633, '10110740', 'SMA SWASTA DARUL ABRAR', 'Kec. Setia Bakti', 17, 'SMA', 'Swasta'),
(634, '69773568', 'SMA NEGERI 1 DARUL HIKMAH', 'Kec. Darul Hikmah', 17, 'SMA', 'Negeri'),
(635, '69988487', 'SLB Negeri Aceh Jaya', 'Kec. Krueng Sabee', 17, 'SLB', 'Negeri'),
(636, '69934939', 'SMA SWASTA AL-ANSHAR', 'Kec. Setia Bakti', 17, 'SMA', 'Swasta'),
(637, '10113630', 'SLB Negeri Semadam', 'Kec. Semadam', 5, 'SLB', 'Negeri'),
(638, '69788573', 'SMK ISLAM TERPADU AL-IKHLAS', 'Kec. Darul Hasanah', 5, 'SMK', 'Swasta'),
(639, '69851868', 'SMA NEGERI 3 LAWE SIGALA GALA', 'Kec. Babul Makmur', 5, 'SMA', 'Negeri'),
(640, '10113639', 'SMAN LAWE SUMUR', 'Kec. Lawe Sumur', 5, 'SMA', 'Negeri'),
(641, '69935594', 'SMK SWASTA PERIKANAN YAYASAN WIRNA RAFIKA SYARI', 'Kec. Deleng Pokhkisen', 5, 'SMK', 'Swasta'),
(642, '69964239', 'SMK SWASTA ANAK BANGSA', 'Kec. Lawe Bulan', 5, 'SMK', 'Swasta'),
(643, '10103071', 'SMAN PERISAI KUTACANE', 'Kec. Badar', 5, 'SMA', 'Negeri'),
(644, '10103020', 'SMKN 2 KUTACANE', 'Kec. Badar', 5, 'SMK', 'Negeri'),
(645, '10103097', 'SMAN 1 BADAR', 'Kec. Badar', 5, 'SMA', 'Negeri'),
(646, '10110348', 'SMAN 2 BADAR', 'Kec. Ketambe', 5, 'SMA', 'Negeri'),
(647, '10110357', 'SMKS BADRUL ULUM', 'Kec. Ketambe', 5, 'SMK', 'Swasta'),
(648, '10113638', 'SMA NEGERI 2 LAWE BULAN', 'Kec. Lawe Bulan', 5, 'SMA', 'Negeri'),
(649, '10103096', 'SMAN 1 BAMBEL', 'Kec. Bukit Tusam', 5, 'SMA', 'Negeri'),
(650, '69767777', 'SMKS KESEHATAN NURUL HASANAH', 'Kec. Babussalam', 5, 'SMK', 'Swasta'),
(651, '10111912', 'SMK-PP NEGERI KUTACANE', 'Kec. Badar', 5, 'SMK', 'Negeri'),
(652, '10103030', 'SMAN 1 KUTACANE', 'Kec. Babussalam', 5, 'SMA', 'Negeri'),
(653, '10103021', 'SMKN 1 KUTA CANE', 'Kec. Babussalam', 5, 'SMK', 'Negeri'),
(654, '69830658', 'SMK NEGERI 4 KUTACANE', 'Kec. Semadam', 5, 'SMK', 'Negeri'),
(655, '10103048', 'SD NEGERI LUAR BIASA SIMPANG EMPAT', 'Kec. Lawe Bulan', 5, 'SLB', 'Negeri'),
(656, '10103092', 'SMAN 1 LAWE SIGALA-GALA', 'Kec. Lawe Sigala-Gala', 5, 'SMA', 'Negeri'),
(657, '69761851', 'SMKN 3 KUTACANE', 'Kec. Bukit Tusam', 5, 'SMK', 'Negeri'),
(658, '10103091', 'SMAN 2 KUTACANE', 'Kec. Babussalam', 5, 'SMA', 'Negeri'),
(659, '10103098', 'SMAN 3 KUTACANE', 'Kec. Babussalam', 5, 'SMA', 'Negeri'),
(660, '10103090', 'SMAN 2 LAWE SIGALAGALA', 'Kec. Babul Makmur', 5, 'SMA', 'Negeri'),
(661, '10110350', 'SMAN 1 DARUL HASANAH', 'Kec. Darul Hasanah', 5, 'SMA', 'Negeri'),
(662, '10110349', 'SMAN 1 LAWE BULAN', 'Kec. Lawe Bulan', 5, 'SMA', 'Negeri'),
(663, '10103103', 'SMAN 1 LAWE ALAS', 'Kec. Lawe Alas', 5, 'SMA', 'Negeri'),
(664, '10110358', 'SMKS DARUNNAJAH', 'Kec. Lawe Alas', 5, 'SMK', 'Swasta'),
(665, '10103099', 'SMAS PANTI HARAPAN', 'Kec. Babul Makmur', 5, 'SMA', 'Swasta'),
(666, '69773523', 'SMAN 1 TANOH ALAS', 'Kec. Tanoh Alas', 5, 'SMA', 'Negeri'),
(667, '69922862', 'SMA SWASTA RAUDHATUL HASANAH', 'Kec. Semadam', 5, 'SMA', 'Swasta');
INSERT INTO `data_sekolah` (`id`, `npsn`, `nama_sekolah`, `alamat_sekolah`, `kabupaten_id`, `jenjang`, `status`) VALUES
(668, '69773522', 'SMAN 1 KETAMBE', 'Kec. Ketambe', 5, 'SMA', 'Negeri'),
(669, '10111560', 'SMKS NUSANTARA', 'Kec. Lawe Sigala-Gala', 5, 'SMK', 'Swasta'),
(670, '70005737', 'SMA Swasta Darul Ulum', 'Kec. Lawe Alas', 5, 'SMA', 'Swasta'),
(671, '10103100', 'SMAS DARUL IMAN', 'Kec. Lawe Sumur', 5, 'SMA', 'Swasta'),
(672, '69830659', 'SMK NEGERI DARUL HASANAH', 'Kec. Darul Hasanah', 5, 'SMK', 'Negeri'),
(673, '10112892', 'SMKS IT AL AMANAH', 'Kec. Babul Makmur', 5, 'SMK', 'Swasta'),
(674, '10110351', 'SMAS AL AZHAR', 'Kec. Babussalam', 5, 'SMA', 'Swasta'),
(675, '10113631', 'SMAN SEMADAM', 'Kec. Semadam', 5, 'SMA', 'Negeri'),
(676, '10110355', 'SMA NEGERI BABUL RAHMAH', 'Kec. Babul Rahmat', 5, 'SMA', 'Negeri'),
(677, '69896979', 'SMA NEGERI 1 LEUSER', 'Kec. Lueser', 5, 'SMA', 'Negeri'),
(678, '10110354', 'SMAS PELITA NUSANTARA', 'Kec. Lawe Sigala-Gala', 5, 'SMA', 'Swasta'),
(679, '70023907', 'SMKS Muzammil Al Aziziyah', 'Kec. Tanoh Alas', 5, 'SMK', 'Swasta'),
(680, '10103122', 'SMK SWASTA ULANG KISAT', 'Kec. Lawe Bulan', 5, 'SMK', 'Swasta'),
(681, '10110352', 'SMAS PERMATA', 'Kec. Babussalam', 5, 'SMA', 'Swasta'),
(682, '69993051', 'SMA Swasta Darussalam', 'Kec. Lawe Sumur', 5, 'SMA', 'Swasta'),
(683, '70041490', 'SMA Swasta Darul Istiqamah', 'Kec. Bukit Tusam', 5, 'SMA', 'Swasta'),
(684, '60729113', 'SMK NEGERI PENERBANGAN ACEH', 'Kec. Blang Bintang', 9, 'SMK', 'Negeri'),
(685, '10100179', 'SMA NEGERI 1 PULO ACEH', 'Kec. Pulo Aceh', 9, 'SMA', 'Negeri'),
(686, '10100194', 'SMA NEGERI 1 KOTA JANTHO', 'Kec. Kota Jantho', 9, 'SMA', 'Negeri'),
(687, '10112821', 'SMK-PP NEGERI SAREE', 'Kec. Lembah Seulawah', 9, 'SMK', 'Negeri'),
(688, '10100156', 'SLB NEGERI KOTA JANTHO', 'Kec. Kota Jantho', 9, 'SLB', 'Negeri'),
(689, '10100195', 'SMA NEGERI 1 INGIN JAYA', 'Kec. Ingin Jaya', 9, 'SMA', 'Negeri'),
(690, '10100186', 'SMA NEGERI 1 KRUENG BARONA JAYA', 'Kec. Krung Barona Jaya', 9, 'SMA', 'Negeri'),
(691, '10107494', 'SMA ISLAM AL-FALAH', 'Kec. Ingin Jaya', 9, 'SMA', 'Swasta'),
(692, '69831961', 'SMKN 1 AL MUBARKEYA INGIN JAYA', 'Kec. Ingin Jaya', 9, 'SMK', 'Negeri'),
(693, '10113256', 'SMA NEGERI 1 DARUSSALAM', 'Kec. Darussalam', 9, 'SMA', 'Negeri'),
(694, '70005615', 'SMAIT Al-Arabiyah', 'Kec. Krung Barona Jaya', 9, 'SMA', 'Swasta'),
(695, '10100112', 'SMK NEGERI 1 MESJID RAYA', 'Kec. Mesjid Raya', 9, 'SMK', 'Negeri'),
(696, '10100190', 'SMA NEGERI 1 MESJID RAYA', 'Kec. Mesjid Raya', 9, 'SMA', 'Negeri'),
(697, '10107492', 'SMAS BINA BANGSA', 'Kec. Ingin Jaya', 9, 'SMA', 'Swasta'),
(698, '10113258', 'SMAN 2 UNGGUL ALI HASJMY', 'Kec. Indrapuri', 9, 'SMA', 'Negeri'),
(699, '69978768', 'SMA Islam Ruhul Falah', 'Kec. Kuta Malaka', 9, 'SMA', 'Swasta'),
(700, '10107497', 'SMA TEUNGKU CHIK KUTA KARANG', 'Kec. Darul Imarah', 9, 'SMA', 'Swasta'),
(701, '70025125', 'SMA IT Dayah Mulia', 'Kec. Blang Bintang', 9, 'SMA', 'Swasta'),
(702, '10110817', 'SMA NEGERI 2 PULO ACEH', 'Kec. Pulo Aceh', 9, 'SMA', 'Negeri'),
(703, '10100113', 'SMK NEGERI 1 KOTA JANTHO', 'Kec. Kota Jantho', 9, 'SMK', 'Negeri'),
(704, '10100187', 'SMA NEGERI 1 SUKAMAKMUR', 'Kec. Suka Makmur', 9, 'SMA', 'Negeri'),
(705, '69816807', 'SMA NEGERI 2 KUTA BARO', 'Kec. Kuta Baro', 9, 'SMA', 'Negeri'),
(706, '10110571', 'SMA SWASTA BABUL MAGHFIRAH', 'Kec. Kuta Baro', 9, 'SMA', 'Swasta'),
(707, '10107498', 'SMAN 2 SEULIMEUM', 'Kec. Seulimeum', 9, 'SMA', 'Negeri'),
(708, '10100197', 'SMA NEGERI 1 BAITUSSALAM', 'Kec. Baitussalam', 9, 'SMA', 'Negeri'),
(709, '10112822', 'SUPM NEGERI LADONG', 'Kec. Mesjid Raya', 9, 'SMK', 'Negeri'),
(710, '10110790', 'SMA FAJAR HIDAYAH', 'Kec. Blang Bintang', 9, 'SMA', 'Swasta'),
(711, '69972487', 'SMAIT Nurul Fikri Boarding School Aceh', 'Kec. Seulimeum', 9, 'SMA', 'Swasta'),
(712, '10113124', 'SMA PLUS MARYAM BINTI IBRAHIM', 'Kec. Kuta Malaka', 9, 'SMA', 'Swasta'),
(713, '10100191', 'SMAN 1 LHOONG', 'Kec. Lhoong', 9, 'SMA', 'Negeri'),
(714, '10100177', 'SMA NEGERI 1 LEUPUNG', 'Kec. Leupung', 9, 'SMA', 'Negeri'),
(715, '10100188', 'SMA NEGERI 1 SEULIMEUM', 'Kec. Seulimeum', 9, 'SMA', 'Negeri'),
(716, '10100181', 'SMA NEGERI 1 KUTA BARO', 'Kec. Kuta Baro', 9, 'SMA', 'Negeri'),
(717, '10100196', 'SMA NEGERI 1 INDRAPURI', 'Kec. Indrapuri', 9, 'SMA', 'Negeri'),
(718, '10100192', 'SMAN 1 LHOKNGA', 'Kec. Lhoknga', 9, 'SMA', 'Negeri'),
(719, '10107493', 'SMAN 3 SEULIMEUM', 'Kec. Seulimeum', 9, 'SMA', 'Negeri'),
(720, '10113347', 'SMK SWASTA GRAFIKA ISS', 'Kec. Kota Jantho', 9, 'SMK', 'Swasta'),
(721, '10110604', 'SMA IT AL FITYAN', 'Kec. Ingin Jaya', 9, 'SMA', 'Swasta'),
(722, '10100185', 'SMA NEGERI 1 DARUL IMARAH', 'Kec. Darul Imarah', 9, 'SMA', 'Negeri'),
(723, '69899342', 'SMA IT DARUL ULUM UMAR FARUQ', 'Kec. Montasik', 9, 'SMA', 'Swasta'),
(724, '60729112', 'SMKN 1  LHOKNGA', 'Kec. Lhoknga', 9, 'SMK', 'Negeri'),
(725, '10107496', 'SMA NEGERI 1 KUTA COT GLIE', 'Kec. Kuta Cot Glie', 9, 'SMA', 'Negeri'),
(726, '69969844', 'SLBN Pembina Provinsi Aceh', 'Kec. Ingin Jaya', 9, 'SLB', 'Negeri'),
(727, '10100170', 'SMA NEGERI MODAL BANGSA', 'Kec. Blang Bintang', 9, 'SMA', 'Negeri'),
(728, '10113359', 'SMK NEGERI 1 DARUL KAMAL', 'Kec. Darul Kamal', 9, 'SMK', 'Negeri'),
(729, '10100139', 'SMA NEGERI 1 LEMBAH SEULAWAH', 'Kec. Lembah Seulawah', 9, 'SMA', 'Negeri'),
(730, '10113429', 'SMA NEGERI 3 INDRAPURI', 'Kec. Indrapuri', 9, 'SMA', 'Negeri'),
(731, '10107495', 'SMAS MALEM PUTRA 2', 'Kec. Darul Imarah', 9, 'SMA', 'Swasta'),
(732, '10110816', 'SMA TGK. CHIEK EUMPE AWEE', 'Kec. Montasik', 9, 'SMA', 'Swasta'),
(733, '69774714', 'SMKS Mahyal Ulum Al-Aziziyah', 'Kec. Suka Makmur', 9, 'SMK', 'Swasta'),
(734, '70029045', 'SMA Islam Al Muhajirin', 'Kec. Kuta Baro', 9, 'SMA', 'Swasta'),
(735, '10100189', 'SMA NEGERI 1 PEUKAN BADA', 'Kec. Peukan Bada', 9, 'SMA', 'Negeri'),
(736, '10100176', 'SMAS MALEM PUTRA 1', 'Kec. Darul Imarah', 9, 'SMA', 'Swasta'),
(737, '10113363', 'SMA NEGERI 1 SIMPANG TIGA', 'Kec. Simpang Tiga', 9, 'SMA', 'Negeri'),
(738, '10107491', 'SMAS ABULYATAMA', 'Kec. Kuta Baro', 9, 'SMA', 'Swasta'),
(739, '10110257', 'SMAS Darul Quran Aceh', 'Kec. Kuta Malaka', 9, 'SMA', 'Swasta'),
(740, '69952683', 'SMK DARUL IHSAN', 'Kec. Darussalam', 9, 'SMK', 'Swasta'),
(741, '10100180', 'SMAN 1 MONTASIK', 'Kec. Montasik', 9, 'SMA', 'Negeri'),
(742, '69993043', 'SMA IT AWJA', 'Kec. Blang Bintang', 9, 'SMA', 'Swasta'),
(743, '69986030', 'SMA Madani Al-Aziziyah', 'Kec. Darul Imarah', 9, 'SMA', 'Swasta'),
(744, '10100183', 'SMA NEGERI 2 LHOKNGA', 'Kec. Lhoknga', 9, 'SMA', 'Negeri'),
(745, '10104847', 'SMA NEGERI 5 ACEH BARAT DAYA', 'Kec. Tangan-Tangan', 13, 'SMA', 'Negeri'),
(746, '10104848', 'SMA NEGERI 3 ACEH BARAT DAYA', 'Kec. Susoh', 13, 'SMA', 'Negeri'),
(747, '10104880', 'SMA NEGERI 6 ACEH BARAT DAYA', 'Kec. Jeumpa', 13, 'SMA', 'Negeri'),
(748, '10104864', 'SMA NEGERI 1 ACEH BARAT DAYA', 'Kec. Blangpidie', 13, 'SMA', 'Negeri'),
(749, '10104846', 'SMK NEGERI 1 ACEH BARAT DAYA', 'Kec. Susoh', 13, 'SMK', 'Negeri'),
(750, '10104862', 'SMA NEGERI 2 ACEH BARAT DAYA', 'Kec. Manggeng', 13, 'SMA', 'Negeri'),
(751, '10110530', 'SMA NEGERI UNGGUL HARAPAN PERSADA', 'Kec. Susoh', 13, 'SMA', 'Negeri'),
(752, '10104837', 'SMA NEGERI 8 ACEH BARAT DAYA', 'Kec. Setia', 13, 'SMA', 'Negeri'),
(753, '10104883', 'SMA NEGERI 9 ACEH BARAT DAYA', 'Kec. Lembah Sabil', 13, 'SMA', 'Negeri'),
(754, '69861153', 'SMA BABUL ISTIQAMAH', 'Kec. Susoh', 13, 'SMA', 'Swasta'),
(755, '10104852', 'SMA NEGERI 11 ACEH BARAT DAYA', 'Kec. Susoh', 13, 'SMA', 'Negeri'),
(756, '10110534', 'SMK NEGERI 4 ACEH BARAT DAYA', 'Kec. Lembah Sabil', 13, 'SMK', 'Negeri'),
(757, '10110537', 'SMK NEGERI 5 ACEH BARAT DAYA', 'Kec. Babahrot', 13, 'SMK', 'Negeri'),
(758, '10110535', 'SMK NEGERI 3 ACEH BARAT DAYA', 'Kec. Lembah Sabil', 13, 'SMK', 'Negeri'),
(759, '10104863', 'SMA NEGERI 4 ACEH BARAT DAYA', 'Kec. Kuala Batee', 13, 'SMA', 'Negeri'),
(760, '10104851', 'SMA NEGERI 10 ACEH BARAT DAYA', 'Kec. Kuala Batee', 13, 'SMA', 'Negeri'),
(761, '10111578', 'SMAS JABAL NUR JADID', 'Kec. Lembah Sabil', 13, 'SMA', 'Swasta'),
(762, '10104793', 'SLB NEGERI Aceh Barat Daya', 'Kec. Susoh', 13, 'SLB', 'Negeri'),
(763, '10104878', 'SMA NEGERI 7 ACEH BARAT DAYA', 'Kec. Babahrot', 13, 'SMA', 'Negeri'),
(764, '10110536', 'SMK NEGERI 2 ACEH BARAT DAYA', 'Kec. Susoh', 13, 'SMK', 'Negeri'),
(765, '10110529', 'SMA NEGERI UNGGUL TUNAS BANGSA', 'Kec. Susoh', 13, 'SMA', 'Negeri'),
(766, '10110562', 'SMA NEGERI 2 MEULABOH', 'Kec. Johan Pahlawan', 8, 'SMA', 'Negeri'),
(767, '10102516', 'SMA SWASTA ISLAM SERAMBI MEUKAH', 'Kec. Johan Pahlawan', 8, 'SMA', 'Swasta'),
(768, '10102505', 'SMA NEGERI 1 MEULABOH', 'Kec. Johan Pahlawan', 8, 'SMA', 'Negeri'),
(769, '10110635', 'SMAN 1 ARONGAN LAMBALEK', 'Kec. Arongan Lambalek', 8, 'SMA', 'Negeri'),
(770, '10108272', 'SMK NEGERI 1 PANTE CEUREUMEN', 'Kec. Pantee Ceureumen', 8, 'SMK', 'Negeri'),
(771, '10110683', 'SMA SWASTA BINA GENERASI BANGSA', 'Kec. Johan Pahlawan', 8, 'SMA', 'Swasta'),
(772, '69945828', 'SLB NEGERI MEULABOH', 'Kec. Johan Pahlawan', 8, 'SLB', 'Negeri'),
(773, '10107959', 'SMK NEGERI 1 WOYLA', 'Kec. Woyla', 8, 'SMK', 'Negeri'),
(774, '10110273', 'SMK Negeri 1 Arongan Lambalek', 'Kec. Arongan Lambalek', 8, 'SMK', 'Negeri'),
(775, '10110269', 'SMK NEGERI 2 MEULABOH', 'Kec. Johan Pahlawan', 8, 'SMK', 'Negeri'),
(776, '10110564', 'SMA NEGERI 1 BUBON', 'Kec. Bubon', 8, 'SMA', 'Negeri'),
(777, '10108105', 'SMK NEGERI 3 MEULABOH', 'Kec. Johan Pahlawan', 8, 'SMK', 'Negeri'),
(778, '10111328', 'SMK NEGERI 4 MEULABOH', 'Kec. Johan Pahlawan', 8, 'SMK', 'Negeri'),
(779, '10102509', 'SMA NEGERI 1 WOYLA', 'Kec. Woyla', 8, 'SMA', 'Negeri'),
(780, '10111327', 'SMK NEGERI 1 MEUREUBO', 'Kec. Meureubo', 8, 'SMK', 'Negeri'),
(781, '10102506', 'SMA NEGERI 1 SAMATIGA', 'Kec. Samatiga', 8, 'SMA', 'Negeri'),
(782, '10110274', 'SMA NEGERI 4 WIRA BANGSA MEULABOH', 'Kec. Johan Pahlawan', 8, 'SMA', 'Negeri'),
(783, '10102502', 'SMA NEGERI 1 KAWAY XVI', 'Kec. Kaway XVI', 8, 'SMA', 'Negeri'),
(784, '10108106', 'SMK NEGERI 1 SAMATIGA', 'Kec. Samatiga', 8, 'SMK', 'Negeri'),
(785, '10102571', 'SMK NEGERI 1 MEULABOH', 'Kec. Johan Pahlawan', 8, 'SMK', 'Negeri'),
(786, '10102499', 'SMK NEGERI 2 WOYLA', 'Kec. Woyla', 8, 'SMK', 'Negeri'),
(787, '10110701', 'SMA NEGERI 1 WOYLA TIMUR', 'Kec. Woyla Timur', 8, 'SMA', 'Negeri'),
(788, '70013416', 'SMA IT Darul Mutaalimin', 'Kec. Johan Pahlawan', 8, 'SMA', 'Swasta'),
(789, '10108265', 'SMK NEGERI 1 KAWAY XVI', 'Kec. Kaway XVI', 8, 'SMK', 'Negeri'),
(790, '10110605', 'SMA NEGERI 2 KAWAY XVI', 'Kec. Kaway XVI', 8, 'SMA', 'Negeri'),
(791, '69786603', 'SMAS DARUL AITAMI', 'Kec. Meureubo', 8, 'SMA', 'Swasta'),
(792, '10108103', 'SMA NEGERI 1 WOYLA BARAT', 'Kec. Woyla Barat', 8, 'SMA', 'Negeri'),
(793, '10110609', 'SMA NEGERI 1 MEUREUBO', 'Kec. Meureubo', 8, 'SMA', 'Negeri'),
(794, '10110255', 'SMA NEGERI 2 MEUREUBO', 'Kec. Meureubo', 8, 'SMA', 'Negeri'),
(795, '10111595', 'SMA NEGERI 1 PANTON REE', 'Kec. Panton Reu', 8, 'SMA', 'Negeri'),
(796, '10102529', 'SMA NEGERI 3 MEULABOH', 'Kec. Johan Pahlawan', 8, 'SMA', 'Negeri'),
(797, '10102514', 'SMA NEGERI 1 SUNGAI MAS', 'Kec. Sungai Mas', 8, 'SMA', 'Negeri'),
(798, '10110262', 'SMA NEGERI 1 PANTE CEUREUMEN', 'Kec. Pantee Ceureumen', 8, 'SMA', 'Negeri'),
(799, '69964436', 'SLB Rahmatillah', 'Kec. Samatiga', 8, 'SLB', 'Swasta'),
(800, '10102510', 'SMA MUHAMMADIYAH 6 MEULABOH', 'Kec. Johan Pahlawan', 8, 'SMA', 'Swasta'),
(801, '70045946', 'SLB Nadiatul Khairi', 'Kec. Panton Reu', 8, 'SLB', 'Swasta'),
(802, '70036211', 'SMK Swasta IT Manahilul Irfan', 'Kec. Matangkuli', 12, 'SMK', 'Swasta'),
(803, '10113067', 'SMK NEGERI 1 LAPANG', 'Kec. Lapang', 12, 'SMK', 'Negeri'),
(804, '10108102', 'SMA NEGERI 1 SIMPANG KEURAMAT', 'Kec. Simpang Keramat', 12, 'SMA', 'Negeri'),
(805, '10108220', 'SMK NEGERI 1 SYAMTALIRA ARON', 'Kec. Syamtalira Aron', 12, 'SMK', 'Negeri'),
(806, '69830444', 'SLB ANEUK NANGGROE', 'Kec. Sawang', 12, 'SLB', 'Swasta'),
(807, '10101309', 'SMA NEGERI 1 MATANG KULI', 'Kec. Matangkuli', 12, 'SMA', 'Negeri'),
(808, '10101192', 'SMA NEGERI 1 TANAH LUAS', 'Kec. Tanah Luas', 12, 'SMA', 'Negeri'),
(809, '69939938', 'SMA SWASTA AS SUNNAH', 'Kec. Seunuddon', 12, 'SMA', 'Swasta'),
(810, '10108219', 'SMK NEGERI 1 TANAH LUAS', 'Kec. Tanah Luas', 12, 'SMK', 'Negeri'),
(811, '10111869', 'SMA NEGERI 1 GEUREUDONG PASE', 'Kec. Geureudong Pase', 12, 'SMA', 'Negeri'),
(812, '10101193', 'SMA NEGERI 1 TANAH JAMBO AYE', 'Kec. Tanah Jambo Aye', 12, 'SMA', 'Negeri'),
(813, '69759157', 'SMA NEGERI 1 PIRAK TIMU', 'Kec. Pirak Timu', 12, 'SMA', 'Negeri'),
(814, '69759159', 'SMK NEGERI 1 BAKTIYA', 'Kec. Baktiya', 12, 'SMK', 'Negeri'),
(815, '69854731', 'SMK NEGERI 1 SEUNUDDON', 'Kec. Seunuddon', 12, 'SMK', 'Negeri'),
(816, '10101327', 'SMK NEGERI 1 DEWANTARA', 'Kec. Dewantara', 12, 'SMK', 'Negeri'),
(817, '10106277', 'SMA NEGERI 2 SEUNUDDON', 'Kec. Seunuddon', 12, 'SMA', 'Negeri'),
(818, '10101306', 'SMA NEGERI 1 SEUNUDDON', 'Kec. Seunuddon', 12, 'SMA', 'Negeri'),
(819, '10101355', 'SMK NEGERI 1 LHOKSUKON', 'Kec. Lhoksukon', 12, 'SMK', 'Negeri'),
(820, '10106280', 'SMK NEGERI 1 BAKTIYA BARAT', 'Kec. Baktiya Barat', 12, 'SMK', 'Negeri'),
(821, '10101190', 'SMA NEGERI 1 SYAMTALIRA ARON', 'Kec. Syamtalira Aron', 12, 'SMA', 'Negeri'),
(822, '10101311', 'SMA NEGERI 1 KUTA MAKMUR', 'Kec. Kuta Makmur', 12, 'SMA', 'Negeri'),
(823, '10110554', 'SMA NEGERI 2 TANAH JAMBO AYE', 'Kec. Tanah Jambo Aye', 12, 'SMA', 'Negeri'),
(824, '69787070', 'SMAS TERPADU DARUL MUTTAQIN', 'Kec. Baktiya', 12, 'SMA', 'Swasta'),
(825, '10112168', 'SMA NEGERI 2 LANGKAHAN', 'Kec. Langkahan', 12, 'SMA', 'Negeri'),
(826, '10110462', 'SMA NEGERI 1 BAKTIYA BARAT', 'Kec. Baktiya Barat', 12, 'SMA', 'Negeri'),
(827, '10101177', 'SMA NEGERI 1 BAKTIYA', 'Kec. Baktiya', 12, 'SMA', 'Negeri'),
(828, '10108210', 'SMK NEGERI 1 TANAH JAMBO AYE', 'Kec. Tanah Jambo Aye', 12, 'SMK', 'Negeri'),
(829, '10108216', 'SMA NEGERI 3 CITRA BANGSA TANAH JAMBOAYE', 'Kec. Tanah Jambo Aye', 12, 'SMA', 'Negeri'),
(830, '10110793', 'SMK NEGERI 1 NISAM', 'Kec. Nisam', 12, 'SMK', 'Negeri'),
(831, '10108101', 'SMA NEGERI 1 PAYA BAKONG', 'Kec. Paya Bakong', 12, 'SMA', 'Negeri'),
(832, '10101189', 'SMA NEGERI 1 TANAH PASIR', 'Kec. Tanah Pasir', 12, 'SMA', 'Negeri'),
(833, '10101307', 'SMA NEGERI 1 SAMUDERA', 'Kec. Samudera', 12, 'SMA', 'Negeri'),
(834, '69726917', 'SMA NEGERI 2 KUTA MAKMUR', 'Kec. Kuta Makmur', 12, 'SMA', 'Negeri'),
(835, '69948792', 'SMK NURUL ISLAM', 'Kec. Kuta Makmur', 12, 'SMK', 'Swasta'),
(836, '10101182', 'SMA NEGERI 1 MEURAH MULIA', 'Kec. Meurah Mulia', 12, 'SMA', 'Negeri'),
(837, '70006104', 'SMK SWASTA NURUL YAQIN', 'Kec. Seunuddon', 12, 'SMK', 'Swasta'),
(838, '69970964', 'SMKS Kafilul Yatim', 'Kec. Pirak Timu', 12, 'SMK', 'Swasta'),
(839, '69726919', 'SMK SWASTA HUMANIORA', 'Kec. Tanah Jambo Aye', 12, 'SMK', 'Swasta'),
(840, '10101176', 'SMA NEGERI 1 COT GIREK', 'Kec. Cot Girek', 12, 'SMA', 'Negeri'),
(841, '10101183', 'SMA NEGERI 1 NISAM', 'Kec. Nisam', 12, 'SMA', 'Negeri'),
(842, '69909282', 'SMK NEGERI 1 COT GIREK', 'Kec. Cot Girek', 12, 'SMK', 'Negeri'),
(843, '10101312', 'SMA NEGERI 2 DEWANTARA', 'Kec. Dewantara', 12, 'SMA', 'Negeri'),
(844, '10110461', 'SMAS NURUL ISLAM', 'Kec. Meurah Mulia', 12, 'SMA', 'Swasta'),
(845, '69767583', 'SMK NEGERI 1 SAWANG', 'Kec. Sawang', 12, 'SMK', 'Negeri'),
(846, '10110576', 'SMA NEGERI 3 PUTRA BANGSA', 'Kec. Lhoksukon', 12, 'SMA', 'Negeri'),
(847, '10110593', 'SMAS ISKANDAR MUDA', 'Kec. Dewantara', 12, 'SMA', 'Swasta'),
(848, '10106274', 'SMA NEGERI 2 NISAM', 'Kec. Nisam', 12, 'SMA', 'Negeri'),
(849, '10111954', 'SMA Negeri 4 Tanah Jambo Aye', 'Kec. Tanah Jambo Aye', 12, 'SMA', 'Negeri'),
(850, '69767582', 'SMAS NURUL ARAFAH', 'Kec. Baktiya', 12, 'SMA', 'Swasta'),
(851, '69857708', 'SMA ISLAM DARUL MUTA ALLIMIN', 'Kec. Baktiya Barat', 12, 'SMA', 'Swasta'),
(852, '69830443', 'SMA SWASTA DARUL IHSAN', 'Kec. Muara Batu', 12, 'SMA', 'Swasta'),
(853, '10101175', 'SMA NEGERI 1 DEWANTARA', 'Kec. Dewantara', 12, 'SMA', 'Negeri'),
(854, '10111598', 'SMA NEGERI 2 KESUMA BANGSA MUARA BATU', 'Kec. Muara Batu', 12, 'SMA', 'Negeri'),
(855, '10101181', 'SMA NEGERI 2 LHOKSUKON', 'Kec. Lhoksukon', 12, 'SMA', 'Negeri'),
(856, '10111502', 'SMK SWASTA MUHAMMADIYAH LHOKSUKON', 'Kec. Lhoksukon', 12, 'SMK', 'Swasta'),
(857, '69978223', 'SLB Babul Huda', 'Kec. Meurah Mulia', 12, 'SLB', 'Swasta'),
(858, '10108100', 'SMA NEGERI 1 MUARA BATU', 'Kec. Muara Batu', 12, 'SMA', 'Negeri'),
(859, '10101174', 'SMA NEGERI 1 LHOKSUKON', 'Kec. Lhoksukon', 12, 'SMA', 'Negeri'),
(860, '69963029', 'SMA NEGERI 2 SAWANG', 'Kec. Sawang', 12, 'SMA', 'Negeri'),
(861, '10113041', 'SMK FARMASI CITRA BANGSA', 'Kec. Tanah Jambo Aye', 12, 'SMK', 'Swasta'),
(862, '10106163', 'SLB YPAC DEWANTARA', 'Kec. Dewantara', 12, 'SLB', 'Swasta'),
(863, '10101191', 'SMA NEGERI 1 SAWANG', 'Kec. Sawang', 12, 'SMA', 'Negeri'),
(864, '69787116', 'SMKS TERPADU BABUSSALAM', 'Kec. Baktiya', 12, 'SMK', 'Swasta'),
(865, '70035709', 'SMK Swasta Aneuk Laot', 'Kec. Seunuddon', 12, 'SMK', 'Swasta'),
(866, '69988419', 'SMK Al Fhattani', 'Kec. Tanah Luas', 12, 'SMK', 'Swasta'),
(867, '10108217', 'SMAS GLOBAL PERINTIS', 'Kec. Tanah Luas', 12, 'SMA', 'Swasta'),
(868, '10101305', 'SMA NEGERI 1 SYAMTALIRA BAYU', 'Kec. Syamtalira Bayu', 12, 'SMA', 'Negeri'),
(869, '10108221', 'SMKS TERPADU AL AZHAR', 'Kec. Baktiya', 12, 'SMK', 'Swasta'),
(870, '69768295', 'SMAS ULUMUL ISLAM', 'Kec. Tanah Jambo Aye', 12, 'SMA', 'Swasta'),
(871, '10112955', 'SMK SWASTA BUSTANUL YATAMA', 'Kec. Syamtalira Bayu', 12, 'SMK', 'Swasta'),
(872, '69939943', 'SMA SWASTA AL FHATTANI', 'Kec. Tanah Luas', 12, 'SMA', 'Swasta'),
(873, '69943314', 'SMK MUBARAK AL-WALIYAH', 'Kec. Samudera', 12, 'SMK', 'Swasta'),
(874, '69831997', 'SMA SWASTA RAUDHATUL FUQARA PAYA BAKONG', 'Kec. Paya Bakong', 12, 'SMA', 'Swasta'),
(875, '70042989', 'SLB Swasta Harapan Bangsa Aceh Utara', 'Kec. Baktiya Barat', 12, 'SLB', 'Swasta'),
(876, '10108099', 'SMAN 1 NISAM ANTARA', 'Kec. Nisam Antara', 12, 'SMA', 'Negeri'),
(877, '69726918', 'SMA NEGERI 1 BANDA BARO', 'Kec. Banda Baro', 12, 'SMA', 'Negeri'),
(878, '10106278', 'SMK NEGERI 1 MUARA BATU', 'Kec. Muara Batu', 12, 'SMK', 'Negeri'),
(879, '69964433', 'SMK Negeri 1 Nibong', 'Kec. Nibong', 12, 'SMK', 'Negeri'),
(880, '69907803', 'SMA SUKMA ALMUBARAKAH', 'Kec. Matangkuli', 12, 'SMA', 'Swasta'),
(881, '69901468', 'SMA Swasta Uswatun Hasanah', 'Kec. Samudera', 12, 'SMA', 'Swasta'),
(882, '69930309', 'SLB NEGERI BINA BANGSA SYAMTALIRA ARON', 'Kec. Syamtalira Aron', 12, 'SLB', 'Negeri'),
(883, '69978226', 'SMA Swasta Al Hilal Al Aziziyah', 'Kec. Nibong', 12, 'SMA', 'Swasta'),
(884, '10101186', 'SMA NEGERI 1 LANGKAHAN', 'Kec. Langkahan', 12, 'SMA', 'Negeri'),
(885, '10101180', 'SMAS RUHUL ISLAM', 'Kec. Tanah Luas', 12, 'SMA', 'Swasta'),
(886, '69954207', 'SLB BLANG JRUEN', 'Kec. Tanah Luas', 12, 'SLB', 'Swasta'),
(887, '10101184', 'SMAS PGRI KRG GEUKEUH', 'Kec. Dewantara', 12, 'SMA', 'Swasta'),
(888, '69761734', 'SMKS KESEHATAN YPUNARA', 'Kec. Nisam', 12, 'SMK', 'Swasta');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kabupaten`
--

CREATE TABLE `kabupaten` (
  `id_kab` int(11) NOT NULL,
  `nama_kab` varchar(255) NOT NULL,
  `nama_ibukotakab` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kabupaten`
--

INSERT INTO `kabupaten` (`id_kab`, `nama_kab`, `nama_ibukotakab`) VALUES
(1, 'Kabupaten Simeulue', 'Sinabang'),
(2, 'Kabupaten Aceh Singkil', 'Singkil'),
(4, 'Kabupaten Aceh Selatan', 'Tapaktuan'),
(5, 'Kabupaten Aceh Tenggara', 'Kuta Cane'),
(6, 'Kabupaten Aceh Timur', 'Idi Rayeuk'),
(7, 'Kabupaten Aceh Tengah', 'Takengon'),
(8, 'Kabupaten Aceh Barat', 'Meulaboh'),
(9, 'Kabupaten Aceh Besar', 'Jantho'),
(10, 'Kabupaten Pidie', 'Sigli'),
(11, 'Kabupaten Bireuen', 'Bireuen'),
(12, 'Kabupaten Aceh Utara', 'Lhoksukon'),
(13, 'Kabupaten Aceh Barat Daya', 'Blang Pidie'),
(14, 'Kabupaten Gayo Lues', 'Blang Kejeren'),
(15, 'Kabupaten Aceh Tamiang', 'Kuala Simpang'),
(16, 'Kabupaten Nagan Raya', 'Suka Makmue'),
(17, 'Kabupaten Aceh Jaya', 'Calang'),
(18, 'Kabupaten Bener Meriah', 'Simpang Tiga Redelong'),
(19, 'Kabupaten Pidie Jaya', 'Meureudu'),
(20, 'Kota Banda Aceh', 'Banda Aceh'),
(21, 'Kota Sabang', 'Sabang'),
(22, 'Kota Langsa', 'Langsa'),
(23, 'Kota Lhokseumawe', 'Lhokseumawe'),
(24, 'Kota Subulussalam', 'Subulussalam');

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
(3, 'admin', 'pakiqin', 'pakiqin@gmail.com', '085358207706', '$2y$10$LdcGulUcIWVSgqe3NILbUe9Dc2RVBNg7UOENScrjVV8Xl0OpbgoJG', 'admin', '2025-01-09 11:20:40', '2025-02-16 06:54:07', 'enable', 0, '2025-02-16 06:53:45'),
(8, 'kabid', 'Muksalmina', 'kabid@gmail.com', '987656789', '$2y$10$IqfMEu1ITaNElbKux6LcmuLtqliCEhdETl/WVRK3l9.b30qzMpW9u', 'kabid', '2025-01-10 02:59:30', '2025-02-14 11:20:32', 'enable', 0, '2025-02-13 07:51:18'),
(9, 'iqin', 'sodiqin', 'pakiqin@gmail.com', '34567890', '$2y$10$l8vZwxK52D5TqzpLSO363u0vH.ZWNBiidnUpGErjqSg2vri6VQV96', 'admin', '2025-01-10 07:16:25', '2025-02-01 23:41:04', 'enable', 0, NULL),
(10, 'opdinas1', 'opdinas1', 'opdinas1@gmail.com', '3453463463565', '$2y$10$QvI98bypu2djh6eZscVWMuxPdVhkdiZf8aPKho2fGVr/AAuN8AQk2', 'dinas', '2025-01-10 07:45:04', '2025-01-27 03:15:59', 'enable', 0, NULL),
(11, 'opcabdin1', 'aefsdf', 'opcabdin1@gmail.com', 'dsfsdg', '$2y$10$6lpNx9fZurL5dLHaKuYgAuiTmcO1QM.ijhRZQxWnbmwIIUh27UCye', 'operator', '2025-01-10 07:51:17', '2025-01-13 22:13:12', 'disable', 0, NULL),
(12, 'opcabdin2', NULL, 'opcabdin2@gmail.com', NULL, '$2y$10$byhHoezEQ782vl0HaVOmluG0gPVE3Eqv5t9oz/tVzCz2u9Xi6HjAO', 'operator', '2025-01-10 07:59:01', '2025-01-10 08:02:24', 'enable', 0, NULL),
(21, 'opdinas2', 'Gibran Rakabuming Raka', 'opdinas2@gmail.com', '34567', '$2y$10$IsfltneZ53rKp7lWbOZeHe.LDaWyCJKJ1JACy4n6fmhXwJix/JuF.', 'dinas', '2025-01-13 11:14:18', '2025-01-20 10:04:56', 'enable', 0, NULL),
(22, 'opcabdintest', NULL, 'opcabdintest@gmail.com', NULL, '$2y$10$4avvGgUONIK0rKZTf98O8udb/r6yimo4ubvKS5KHiC6hLlxjsCA6S', 'operator', '2025-01-13 11:14:42', '2025-01-13 11:14:42', 'enable', 0, NULL),
(25, 'opdinas3', 'OP Dinas Cabdin Aceh Utara', 'opdinas1@gmail.com', '876567', '$2y$10$XoZI85LWOHoO4krMG0OuierEK2GKrWmSrevZ.WnwTFZR.kuGn22ZC', 'dinas', '2025-01-13 11:42:40', '2025-01-22 01:21:49', 'enable', 0, NULL),
(29, 'opdinas4', 'opdinas4', 'opdinas4@gmail.com', '34567890', '$2y$10$8hRvvMBjRyWKswTfojm29OjExcmqTgJtX3OcMyjh8zQ04nvPFIoNC', 'dinas', '2025-01-13 12:45:24', '2025-02-10 22:18:38', 'enable', 0, NULL),
(32, 'opdinas5', 'OP Dinas Banda Aceh Aceh Besar dan Sabang', 'opdinas5@gmail.com', '09876543', '$2y$10$Mt1wNgQYwmdMgy6cWfNQHOhGHz4zi5lpic.p.66RezjLGySy5mTqu', 'dinas', '2025-01-14 01:26:00', '2025-01-22 08:33:04', 'enable', 0, NULL),
(33, 'opdinas6', 'Operator Dinas 6', 'opdinas6@gmail.com', '8765678', '$2y$10$BSRJloMkSkJo9WuUI0lV6ek/pYh2/E5l5ImBuhLaJKNq9Aw7jSu8G', 'dinas', '2025-01-14 02:33:26', '2025-01-15 05:41:51', 'enable', 0, NULL),
(42, 'opcabdinab', 'Prabowo Subianto', 'opcabdinab@gmail.com', '8765678', '$2y$10$g57mRMoUy.lR4pmw0iDO8.59JKzKMEp.rPPFY9Al45SFSQR7cSWqW', 'operator', '2025-01-14 06:21:41', '2025-01-17 02:48:09', 'enable', 0, NULL),
(46, 'opcabdincb', 'OP Cabdin Sabang', 'opcabdincb@gmail.com', '9876543', '$2y$10$ixy/ON5SZR.WM4KmrPBPReDPSkSqv/5w1i.boTkr/JWgRCLcqB3XC', 'operator', '2025-01-14 06:50:52', '2025-01-14 06:50:52', 'enable', 0, NULL),
(47, 'opcabdinacut', 'Spiderman', 'opcabdinacut@gmail.com', '987654345', '$2y$10$tlA2rpTaVCu4Bq7MbkXwqO4Xu5xOJU/.W9IMdom9vBSRwJOEH/8dm', 'operator', '2025-01-15 03:02:18', '2025-01-22 00:54:54', 'enable', 0, NULL),
(48, 'opcabdinse', 'OP Cabdin Se', 'opcabdinse@gmail.com', '4567890', '$2y$10$Z9LiZUXBTd2PCCNu5pfzNOZUdvWWusN7WbEY8qD4Gt5lWZSpHkm0y', 'operator', '2025-01-15 03:43:58', '2025-01-15 09:36:24', 'enable', 0, NULL),
(49, 'opcabdinatim', 'OP Cabdin Aceh Timur', 'opcabdinatim@gmail.com', '0987654376', '$2y$10$hchoaagsnCyz5NQXS/5C5eEc9su4npijq85gR.3x9t8gabJ9jB5Ge', 'operator', '2025-01-20 10:06:21', '2025-02-11 10:35:42', 'enable', 0, NULL),
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
(167, 3, 'logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '2025-02-16 14:02:30'),
(168, 8, 'login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '2025-02-16 14:02:37'),
(169, 10, 'login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '2025-02-16 14:03:35'),
(170, 10, 'logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '2025-02-16 14:06:44');

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
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cabang_dinas`
--
ALTER TABLE `cabang_dinas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_cabang` (`kode_cabang`);

--
-- Indeks untuk tabel `cabang_dinas_kabupaten`
--
ALTER TABLE `cabang_dinas_kabupaten`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cabang_dinas_id` (`cabang_dinas_id`),
  ADD KEY `kabupaten_id` (`kabupaten_id`);

--
-- Indeks untuk tabel `data_sekolah`
--
ALTER TABLE `data_sekolah`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `npsn` (`npsn`),
  ADD KEY `kabupaten_id` (`kabupaten_id`);

--
-- Indeks untuk tabel `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD PRIMARY KEY (`id_kab`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `cabang_dinas_kabupaten`
--
ALTER TABLE `cabang_dinas_kabupaten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `data_sekolah`
--
ALTER TABLE `data_sekolah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=889;

--
-- AUTO_INCREMENT untuk tabel `kabupaten`
--
ALTER TABLE `kabupaten`
  MODIFY `id_kab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `operator_cabang_dinas`
--
ALTER TABLE `operator_cabang_dinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT untuk tabel `pengiriman_usulan`
--
ALTER TABLE `pengiriman_usulan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `rekom_kadis`
--
ALTER TABLE `rekom_kadis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `sk_mutasi`
--
ALTER TABLE `sk_mutasi`
  MODIFY `id_skmutasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT untuk tabel `usulan`
--
ALTER TABLE `usulan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT untuk tabel `usulan_status_history`
--
ALTER TABLE `usulan_status_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=292;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cabang_dinas_kabupaten`
--
ALTER TABLE `cabang_dinas_kabupaten`
  ADD CONSTRAINT `cabang_dinas_kabupaten_ibfk_1` FOREIGN KEY (`cabang_dinas_id`) REFERENCES `cabang_dinas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cabang_dinas_kabupaten_ibfk_2` FOREIGN KEY (`kabupaten_id`) REFERENCES `kabupaten` (`id_kab`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_sekolah`
--
ALTER TABLE `data_sekolah`
  ADD CONSTRAINT `data_sekolah_ibfk_1` FOREIGN KEY (`kabupaten_id`) REFERENCES `kabupaten` (`id_kab`) ON DELETE CASCADE;

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
