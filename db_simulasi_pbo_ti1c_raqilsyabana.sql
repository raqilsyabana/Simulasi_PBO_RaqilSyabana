-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 17, 2026 at 02:49 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simulasi_pbo_ti1c_raqilsyabana`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_pendaftaran`
--

CREATE TABLE `tabel_pendaftaran` (
  `id_pendaftaran` int NOT NULL,
  `nama_calon` varchar(100) NOT NULL,
  `asal_sekolah` varchar(100) NOT NULL,
  `nilai_ujian` decimal(5,2) NOT NULL,
  `biaya_pendaftaran_dasar` decimal(10,2) NOT NULL,
  `jalur_pendaftaran` enum('Reguler','Prestasi','Kedinasan') NOT NULL,
  `pilihan_prodi` varchar(50) DEFAULT NULL,
  `lokasi_kampus` varchar(50) DEFAULT NULL,
  `jenis_prestasi` varchar(50) DEFAULT NULL,
  `tingkat_prestasi` varchar(30) DEFAULT NULL,
  `sk_ikatan_dinas` varchar(50) DEFAULT NULL,
  `instansi_sponsor` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_pendaftaran`
--

INSERT INTO `tabel_pendaftaran` (`id_pendaftaran`, `nama_calon`, `asal_sekolah`, `nilai_ujian`, `biaya_pendaftaran_dasar`, `jalur_pendaftaran`, `pilihan_prodi`, `lokasi_kampus`, `jenis_prestasi`, `tingkat_prestasi`, `sk_ikatan_dinas`, `instansi_sponsor`) VALUES
(1, 'Ahmad Fauzi', 'SMAN 1 Jakarta', '85.50', '150000.00', 'Reguler', 'Teknik Informatika', 'Kampus Utama', NULL, NULL, NULL, NULL),
(2, 'Siti Aminah', 'SMAN 3 Bandung', '78.25', '150000.00', 'Reguler', 'Sistem Informasi', 'Kampus Utama', NULL, NULL, NULL, NULL),
(3, 'Budi Wijaya', 'SMKN 2 Surabaya', '82.00', '150000.00', 'Reguler', 'Teknik Elektro', 'Kampus B', NULL, NULL, NULL, NULL),
(4, 'Citra Lestari', 'SMA Kristen Yusuf', '90.15', '150000.00', 'Reguler', 'Kedokteran', 'Kampus Utama', NULL, NULL, NULL, NULL),
(5, 'Dedi Kurniawan', 'SMAN 5 Semarang', '74.80', '150000.00', 'Reguler', 'Manajemen', 'Kampus C', NULL, NULL, NULL, NULL),
(6, 'Eka Putri', 'SMAN 1 Yogyakarta', '88.00', '150000.00', 'Reguler', 'Akuntansi', 'Kampus Utama', NULL, NULL, NULL, NULL),
(7, 'Fajar Ramadhan', 'MAN 2 Malang', '80.50', '150000.00', 'Reguler', 'Psikologi', 'Kampus B', NULL, NULL, NULL, NULL),
(8, 'Gita Gutawa', 'SMA Taruna Nusantara', '92.00', '100000.00', 'Prestasi', NULL, NULL, 'Olimpiade Matematika', 'Nasional', NULL, NULL),
(9, 'Hendra Setiawan', 'SMAN 1 Solo', '85.00', '100000.00', 'Prestasi', NULL, NULL, 'Bulutangkis Tunggal', 'Provinsi', NULL, NULL),
(10, 'Indah Permata', 'SMAN 8 Jakarta', '95.50', '100000.00', 'Prestasi', NULL, NULL, 'Karya Ilmiah Remaja', 'Internasional', NULL, NULL),
(11, 'Joko Tingkir', 'SMKN 1 Blitar', '79.00', '100000.00', 'Prestasi', NULL, NULL, 'Lomba Kompetensi Siswa', 'Nasional', NULL, NULL),
(12, 'Kevin Sanjaya', 'SMA Ragunan', '81.30', '100000.00', 'Prestasi', NULL, NULL, 'Ganda Putra Tenis Meja', 'Nasional', NULL, NULL),
(13, 'Larasati Dewi', 'SMAN 3 Yogyakarta', '91.00', '100000.00', 'Prestasi', NULL, NULL, 'Debat Bahasa Inggris', 'Provinsi', NULL, NULL),
(14, 'Muhammad Rizky', 'MAN 1 Medan', '87.40', '100000.00', 'Prestasi', NULL, NULL, 'Tahfidz Al-Quran 20 Juz', 'Nasional', NULL, NULL),
(15, 'Nadia Vega', 'SMAN 1 padang', '86.00', '200000.00', 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-IKD-2026-001', 'Kementerian Keuangan'),
(16, 'Oki Setiana', 'SMAN 2 makassar', '83.50', '200000.00', 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-IKD-2026-002', 'Badan Pusat Statistik'),
(17, 'Putra Perdana', 'SMAN 4 Denpasar', '89.00', '200000.00', 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-IKD-2026-003', 'Kementerian Dalam Negeri'),
(18, 'Qori Sandioriva', 'SMAN 1 Palembang', '80.00', '200000.00', 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-IKD-2026-004', 'Kementerian Perhubungan'),
(19, 'Rian Agung', 'SMKN 1 Balikpapan', '84.20', '200000.00', 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-IKD-2026-005', 'Badan Siber dan Sandi Negara'),
(20, 'Sinta Nuriyah', 'SMAN 1 Banjarmasin', '87.80', '200000.00', 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-IKD-2026-006', 'Kementerian Hukum dan HAM'),
(21, 'Taufik Hidayat', 'MAN 1 Bandung', '82.10', '200000.00', 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-IKD-2026-007', 'Badan Meteorologi Klimatologi Geofisika');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_pendaftaran`
--
ALTER TABLE `tabel_pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_pendaftaran`
--
ALTER TABLE `tabel_pendaftaran`
  MODIFY `id_pendaftaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
