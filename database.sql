-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Agu 2024 pada 19.45
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `septian1`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen`
--

CREATE TABLE `absen` (
  `id` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `tahun_id` int(11) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `id_guru` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `tgl` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `absen`
--

INSERT INTO `absen` (`id`, `id_peserta`, `id_kelas`, `tahun_id`, `semester`, `id_guru`, `id_mapel`, `status`, `tgl`, `created_at`, `updated_at`) VALUES
(59, 23, 4, 10, 1, 5, 23, 'hadir', '2024-07-24', '2024-07-24 09:11:09', '2024-07-24 09:11:09'),
(60, 23, 4, 10, 1, 5, 23, 'alfa', '2024-07-23', '2024-07-24 09:12:26', '2024-07-24 09:12:26'),
(61, 23, 4, 10, 1, 5, 23, 'izin', '2024-07-28', '2024-07-28 09:25:06', '2024-07-28 09:25:06'),
(62, 24, 4, 10, 1, 5, 23, 'hadir', '2024-07-28', '2024-07-28 09:25:06', '2024-07-28 09:25:06'),
(63, 25, 4, 10, 1, 5, 23, 'sakit', '2024-07-28', '2024-07-28 09:25:06', '2024-07-28 09:25:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `angkatan`
--

CREATE TABLE `angkatan` (
  `id` int(11) NOT NULL,
  `angkatan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `angkatan`
--

INSERT INTO `angkatan` (`id`, `angkatan`, `created_at`, `updated_at`) VALUES
(1, 2020, '2024-05-10 22:01:35', '2024-06-27 05:56:21'),
(3, 2021, '2024-05-10 22:14:41', '2024-06-27 05:56:29'),
(4, 2022, '2024-05-10 22:14:45', '2024-06-27 05:56:40'),
(5, 2023, '2024-06-27 05:56:01', '2024-06-27 05:56:52'),
(6, 2024, '2024-06-27 05:57:05', '2024-06-27 05:57:05'),
(7, 2019, '2024-07-23 10:11:28', '2024-07-23 10:11:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `catatan_ngaji`
--

CREATE TABLE `catatan_ngaji` (
  `id` int(11) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `tahun_id` int(11) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `juz_surat` text NOT NULL,
  `hal` bigint(20) NOT NULL,
  `ayat` bigint(20) DEFAULT NULL,
  `ket` varchar(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `catatan_ngaji`
--

INSERT INTO `catatan_ngaji` (`id`, `nisn`, `id_guru`, `id_kelas`, `tahun_id`, `semester`, `juz_surat`, `hal`, `ayat`, `ket`, `created_at`, `updated_at`) VALUES
(8, '0084743106', 5, 4, 10, 1, 'iqro 10', 34, NULL, 'L', '2024-07-20 08:55:29', '2024-07-20 14:22:05'),
(9, '0084743106', 7, 4, 10, 1, 'iqro3', 32, NULL, 'U', '2024-07-20 14:11:56', '2024-07-20 14:11:56'),
(10, '0084743106', 7, 4, 10, 1, 'iqro 4', 66, NULL, 'U', '2024-07-20 14:13:01', '2024-07-20 14:13:01'),
(11, '0084743106', 7, 4, 10, 1, 'iqro 6', 100, NULL, 'L-', '2024-07-20 14:13:41', '2024-07-20 14:13:41'),
(12, '0084743106', 7, 4, 10, 1, 'babi', 88, NULL, 'U', '2024-07-20 14:14:32', '2024-07-20 14:14:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED DEFAULT NULL,
  `kode_guru` varchar(255) NOT NULL,
  `nama_guru` varchar(255) NOT NULL,
  `alamat_guru` varchar(255) NOT NULL,
  `ttl_guru` varchar(255) NOT NULL,
  `no_hp_guru` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id`, `id_user`, `kode_guru`, `nama_guru`, `alamat_guru`, `ttl_guru`, `no_hp_guru`, `status`, `created_at`, `updated_at`) VALUES
(5, 11, 'MDHM_001', 'Suhartini, S. Pd', 'Kel.ngampel, GG.6, Kota Kediri', '1970-05-11', '085235592389', 'guru_inti', '2024-06-25 14:02:10', '2024-07-23 08:07:46'),
(6, 12, 'MDHM_006', 'Marina Septari M. W., S. Pd', 'Kediri', '1982-08-04', '085813675688', 'guru_inti', '2024-06-25 14:13:26', '2024-06-25 14:13:26'),
(7, 14, 'MDHM_007', 'Aji Nurul Hidayat', 'Kel. Ngampel, Kota Kediri', '1975-11-20', '089521056005', 'guru_piket', '2024-06-25 14:17:38', '2024-06-25 14:17:38'),
(14, 17, 'MDHM_008', 'suka suka', 'madiun', '2024-07-23', '089767856789', 'guru_inti', '2024-07-23 08:05:58', '2024-07-23 08:09:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hafalan`
--

CREATE TABLE `hafalan` (
  `id` int(11) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `tahun_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `surat` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_ta` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_mapel1` int(11) NOT NULL,
  `id_mapel2` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_guruPiket` int(11) NOT NULL,
  `hari` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id`, `id_kelas`, `id_ta`, `id_mapel`, `id_mapel1`, `id_mapel2`, `id_guru`, `id_guruPiket`, `hari`, `created_at`, `updated_at`) VALUES
(14, 4, 10, 23, 0, 0, 5, 7, 'selasa', '2024-07-20 19:25:02', '2024-07-20 19:25:02'),
(15, 5, 10, 26, 0, 0, 6, 7, 'senin', '2024-07-24 05:02:47', '2024-07-24 05:02:47'),
(16, 4, 10, 23, 24, 0, 5, 0, 'senin', '2024-07-24 12:52:49', '2024-07-24 12:52:49'),
(17, 5, 10, 26, 0, 26, 6, 0, 'selasa', '2024-07-24 12:55:51', '2024-07-24 12:55:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` int(11) NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `tgl_kegiatan` date NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `nama_kegiatan`, `tgl_kegiatan`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'maulidan', '2024-05-08', 'diikuti seluruh siswa', '2024-05-11 23:30:32', '2024-05-11 23:33:34'),
(3, 'Dibaan', '2024-06-11', 'khusus guru - guru', '2024-06-10 09:01:14', '2024-06-10 09:01:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL,
  `id_guru` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `id_guru`, `created_at`, `updated_at`) VALUES
(4, '1', 5, '2024-07-19 07:10:43', '2024-07-19 07:10:43'),
(5, '2', 6, '2024-07-19 07:11:22', '2024-07-19 07:11:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_angkatan` int(11) NOT NULL,
  `kode_mapel` varchar(50) NOT NULL,
  `mapel` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id`, `id_kelas`, `id_angkatan`, `kode_mapel`, `mapel`, `created_at`, `updated_at`) VALUES
(23, 4, 1, 'NA', 'nahwu', '2024-07-19 21:20:21', '2024-07-20 06:28:00'),
(24, 4, 1, 'TAJ', 'Tajwid', '2024-07-20 06:28:20', '2024-07-20 06:28:20'),
(25, 4, 1, 'SHO', 'shorof', '2024-07-20 06:28:38', '2024-07-20 06:28:38'),
(26, 5, 3, 'AB', 'kkk', NULL, '2024-07-23 12:32:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_03_15_095952_create_table_guru', 2),
(6, '2024_03_15_100955_create_guru', 3),
(7, '2024_03_16_004127_create_tahun_ajaran', 4),
(8, '2024_03_16_145010_create_peserta_didik', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id` int(11) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `tahun_id` int(11) NOT NULL,
  `kode_mapel` varchar(20) NOT NULL,
  `ulangan_1` double DEFAULT NULL,
  `uts` double DEFAULT NULL,
  `ulangan_2` double DEFAULT NULL,
  `uas` double DEFAULT NULL,
  `id_guru` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`id`, `nisn`, `id_kelas`, `semester`, `tahun_id`, `kode_mapel`, `ulangan_1`, `uts`, `ulangan_2`, `uas`, `id_guru`, `created_at`, `updated_at`) VALUES
(44, '11', 4, 1, 10, 'AB', 70, 70, 70, 70, 5, '2024-07-30 07:16:03', '2024-07-30 07:16:03'),
(45, '12', 4, 1, 10, 'AB', 71, 71, 71, 71, 5, '2024-07-30 07:16:03', '2024-07-30 07:16:03'),
(46, '13', 4, 1, 10, 'AB', 72, 72, 72, 72, 5, '2024-07-30 07:16:03', '2024-07-30 07:16:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peserta_didik`
--

CREATE TABLE `peserta_didik` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_angkatan` int(11) NOT NULL,
  `nisn` varchar(255) NOT NULL,
  `email` varchar(20) DEFAULT NULL,
  `nama_peserta` varchar(255) NOT NULL,
  `alamat_peserta` varchar(255) NOT NULL,
  `ttl_peserta` date NOT NULL,
  `no_hp_peserta` varchar(15) NOT NULL,
  `nama_ayah` varchar(255) NOT NULL,
  `nama_ibu` varchar(255) NOT NULL,
  `foto` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `peserta_didik`
--

INSERT INTO `peserta_didik` (`id`, `id_kelas`, `id_angkatan`, `nisn`, `email`, `nama_peserta`, `alamat_peserta`, `ttl_peserta`, `no_hp_peserta`, `nama_ayah`, `nama_ibu`, `foto`, `status`, `created_at`, `updated_at`) VALUES
(23, 4, 1, '0084743106', 'editorzal@gmail.com', 'AIRA PUTRI WIDIANTO', 'KEDIRI', '2010-01-07', '085656789012', 'AGUS WIDIANTO', 'SARTI MARSITI', 'storage/foto/WhatsApp Image 2024-07-02 at 05.27.00_57a0237c.jpg', 'aktif', '2023-07-01 22:48:53', '2024-07-01 22:48:53'),
(24, 4, 1, '0051195945', 'dziazahroannisa@gmai', 'ALMAND KURNIA RAMADHAN', 'KEDIRI', '2008-09-09', '085667890123', 'BAGAS KURNIA', 'ARIANI NUR HALIJAH', 'storage/foto/WhatsApp Image 2024-07-02 at 05.27.00_57a0237c.jpg', 'aktif', '2024-07-01 22:53:14', '2024-07-01 22:53:14'),
(25, 4, 1, '0085540981', NULL, 'ANDIKA MIKO SETYAWAN', 'KEDIRI', '2007-07-14', '085678901234', 'ROBI SETIAWAN', 'MAHYA ASYAHRI PUTRI', 'storage/foto/WhatsApp Image 2024-07-02 at 05.27.02_694464ee.jpg', 'aktif', '2024-07-01 22:56:28', '2024-07-01 22:56:28'),
(34, 5, 3, '4444444', 'kurop612@gmail.com', 'toti', 'jjj', '2024-07-23', '876578767876', 'aji', 'cuih', 'storage/foto/1.jpg', 'aktif', '2024-07-23 11:11:38', '2024-07-23 12:25:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profile`
--

CREATE TABLE `profile` (
  `id` bigint(20) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nisn` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `profile`
--

INSERT INTO `profile` (`id`, `id_user`, `nisn`, `created_at`, `updated_at`) VALUES
(6, 29, '4444444', '2024-07-24 04:29:30', '2024-07-24 04:29:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tahun` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id`, `tahun`, `created_at`, `updated_at`) VALUES
(10, '2023/2024', '2024-06-27 05:28:57', '2024-06-27 12:12:49'),
(11, '2023/2024', '2024-06-27 05:29:17', '2024-06-27 12:13:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(11, 'Suhartini, S. Pd', 'Suhartini@gmail.com', NULL, '$2y$12$adY1cN0cY3sC7AC5b9srGOLBvD/nswBKYcrRhENMvS3ZLsogVbwqu', 'guru', NULL, '2024-06-25 08:14:36', '2024-06-25 08:14:36'),
(12, 'Marina Septari Maslakah Wardani, S. Pd', 'MarinaSeptari@gmail.com', NULL, '$2y$12$kaZ8pDXUUZv3ALhqZjR32eSo5CtMfRy6pWcIbvVdYwvgnbrkE7I0q', 'guru', NULL, '2024-06-25 08:20:55', '2024-06-25 08:20:55'),
(13, 'Rini Wulandari, S. Pd. I', 'Rini_Wulandari@gmail.com', NULL, '$2y$12$t0S26FQXoyN9Dt6lx7f2M.ptCOCVkSYDE9xwk92e89KPKdJfTcstq', 'kepalaMadrasah', NULL, '2024-06-25 08:23:30', '2024-06-25 08:23:30'),
(14, 'Aji Nurul Hidayat', 'Aji_Nurul_H@gmail.com', NULL, '$2y$12$0v4rGBvPyqbmnhXPeu249u2vBl.doVbxbRJgCLJEpqEeehoapsm2m', 'guru', NULL, '2024-06-25 08:25:02', '2024-06-25 08:25:02'),
(15, 'Ika Utama Putri', 'Ika_Utama@gmail.com', NULL, '$2y$12$5QpL55GzC4UNWdcuS9./He2K1OrDLNixSX/jaTlqEGz0Qmr0wQ4ei', 'guru', NULL, '2024-06-25 08:26:21', '2024-06-25 08:26:21'),
(16, 'Muhammad Fikry Kurniawastu', 'M_Fikry_Kurniawastu@gmail.com', NULL, '$2y$12$UUctDJSdosJv4d0eiU0xbe0cYX0pmOPxoXhOYrdzz4nkqQFOHBMtS', 'admin', NULL, '2024-06-25 08:32:06', '2024-06-25 08:32:06'),
(17, 'Sukarni', 'Sukarni@gmail.com', NULL, '$2y$12$Qjk7hs0YETlcrjVkw.kmLOD25z5zAAlV/y1imTfjd4u6l7I3bTwFW', 'guru', NULL, '2024-06-25 08:33:36', '2024-06-25 08:33:36'),
(18, 'Martina', 'Martina@gmail.com', NULL, '$2y$12$IDlAEovJtDL45N2PWANo8eyd4.3Za6wF7faPou5lnDrBpFSIK7t5e', 'guru', NULL, '2024-06-25 08:34:33', '2024-06-25 08:34:33'),
(19, 'Husni Mubarok', 'Husni_Mubarok@gmail.com', NULL, '$2y$12$XiQA3Qag8PslYjNCjAFg9.F9SmKHL9z9AH0oGkYtBXQlC0ikY96XK', 'guru', NULL, '2024-06-25 08:35:12', '2024-06-25 08:35:12'),
(20, 'Ahmad Syuhada Ilmi Muttaqin', 'Ahmad_Syuhada@gmail.com', NULL, '$2y$12$gmZTvueomSM6IcNIu/Prd./.aAH1TmDkfxjRJHz.i8wRtQ9M/ek9a', 'guru', NULL, '2024-06-25 08:36:24', '2024-06-25 08:36:24'),
(21, 'Faisal Amin', 'Faisal_Amin@gmail.com', NULL, '$2y$12$HfiqrtDQKH5L3Wfj1/7wbe4pGti5Zg2WIZsf0o3c0Sbk7cBAP3dkK', 'guru', NULL, '2024-06-25 08:37:17', '2024-06-25 08:37:17'),
(29, 'dandi', 'kurop612@gmail.com', NULL, '$2y$12$1gX9gzWLCroUCNilu1wPS.wkXIMeKz/sxRxcJN3tCBOcRprOzLMqu', 'waliMurid', NULL, '2024-07-24 04:29:30', '2024-07-26 04:15:58');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `angkatan`
--
ALTER TABLE `angkatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `catatan_ngaji`
--
ALTER TABLE `catatan_ngaji`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hafalan`
--
ALTER TABLE `hafalan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `peserta_didik`
--
ALTER TABLE `peserta_didik`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absen`
--
ALTER TABLE `absen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT untuk tabel `angkatan`
--
ALTER TABLE `angkatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `catatan_ngaji`
--
ALTER TABLE `catatan_ngaji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `guru`
--
ALTER TABLE `guru`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `hafalan`
--
ALTER TABLE `hafalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `peserta_didik`
--
ALTER TABLE `peserta_didik`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `profile`
--
ALTER TABLE `profile`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
