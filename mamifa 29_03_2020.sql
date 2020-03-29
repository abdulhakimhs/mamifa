-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Mar 2020 pada 08.34
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mamifa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_files`
--

CREATE TABLE `tb_files` (
  `file_id` int(11) NOT NULL,
  `file_title` varchar(100) DEFAULT NULL,
  `file_desc` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_size` varchar(100) DEFAULT NULL,
  `file_type` varchar(100) DEFAULT NULL,
  `file_created` date DEFAULT NULL,
  `file_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jenis_laporan`
--

CREATE TABLE `tb_jenis_laporan` (
  `jenis_lap_id` int(11) NOT NULL,
  `jenis_laporan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_jenis_laporan`
--

INSERT INTO `tb_jenis_laporan` (`jenis_lap_id`, `jenis_laporan`) VALUES
(1, 'Laporan 1'),
(2, 'Laporan 2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mitra`
--

CREATE TABLE `tb_mitra` (
  `mitra_id` int(11) NOT NULL,
  `nama_mitra` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_mitra`
--

INSERT INTO `tb_mitra` (`mitra_id`, `nama_mitra`) VALUES
(1, 'Telkom Akses'),
(2, 'Infomedia Solusi Humanika (ISH)'),
(3, 'Koperasi Pegawai Telkom (KOPEGTEL)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_monila`
--

CREATE TABLE `tb_monila` (
  `monila_id` int(11) NOT NULL,
  `nik` varchar(25) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `jenis_lap_id` int(11) DEFAULT NULL,
  `lokasi_temuan` char(3) DEFAULT NULL,
  `koordinat` varchar(100) NOT NULL,
  `odp` varchar(25) DEFAULT NULL,
  `file_evident` varchar(255) DEFAULT NULL,
  `saran_perbaikan` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0' COMMENT '0 blm diterima, 1 sdh diterima'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_monila`
--

INSERT INTO `tb_monila` (`monila_id`, `nik`, `nama_lengkap`, `jenis_lap_id`, `lokasi_temuan`, `koordinat`, `odp`, `file_evident`, `saran_perbaikan`, `status`) VALUES
(1, '6547891230123456789', 'Abdul Hakim', 1, 'TEG', '', 'ODP-TEG-FK/090', 'canting.jpg', 'Kabel putus', 0),
(2, '19929291', 'Nuril Muslichin', 1, 'PKL', '', 'ODP-PKL-FN/108', 'canting1.jpg', 'Mohon segera dicek!', 1),
(3, '01929192', 'Bobby', 2, 'BRB', '-6.8898998,109.6682281', '', 'kelapa.jpg', 'Pintu ODP Terbuka', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_naker`
--

CREATE TABLE `tb_naker` (
  `naker_id` int(11) NOT NULL,
  `position_name` varchar(100) DEFAULT NULL,
  `position_title` varchar(100) DEFAULT NULL,
  `nik` varchar(15) DEFAULT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `sektor` varchar(50) DEFAULT NULL,
  `rayon` varchar(50) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `bpjs` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_naker`
--

INSERT INTO `tb_naker` (`naker_id`, `position_name`, `position_title`, `nik`, `nama`, `sektor`, `rayon`, `level`, `bpjs`) VALUES
(1, 'Waspang Digitalisasi SPBU Pertamina', 'Waspang Digitalisasi SPBU Pertamina', '92170416', 'MUHAMMAD SOFYAN', NULL, NULL, 'Teknisi', '92170416.jpg'),
(2, 'Data Manajemen', 'Staff', '91829122', 'LUTFI ADI IRAWAN', '', '', 'Team Leader', NULL),
(4, 'IT Konsultan', 'Team Leader', '91112121', 'Abdul Hakim Hassan', '', '', 'Team Leader', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_name_of_training`
--

CREATE TABLE `tb_name_of_training` (
  `not_id` int(11) NOT NULL,
  `name_of_training` varchar(150) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '0 tdk aktif, 1 aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_name_of_training`
--

INSERT INTO `tb_name_of_training` (`not_id`, `name_of_training`, `status`) VALUES
(1, 'Training 1', 1),
(2, 'Training 2', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_operation`
--

CREATE TABLE `tb_operation` (
  `operation_id` int(11) NOT NULL,
  `operation_code` varchar(10) DEFAULT NULL,
  `operation_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_operation`
--

INSERT INTO `tb_operation` (`operation_id`, `operation_code`, `operation_name`) VALUES
(1, 'Operasi 1', 'O-001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelatihan`
--

CREATE TABLE `tb_pelatihan` (
  `pelatihan_id` int(11) NOT NULL,
  `jenis_pelatihan` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '0 tdk aktif, 1 aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pelatihan`
--

INSERT INTO `tb_pelatihan` (`pelatihan_id`, `jenis_pelatihan`, `status`) VALUES
(1, 'Pelatihan 1', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_training_plan`
--

CREATE TABLE `tb_training_plan` (
  `training_plan_id` int(11) NOT NULL,
  `tgl_awal` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `pelatihan_id` int(11) DEFAULT NULL,
  `not_id` int(11) DEFAULT NULL,
  `nama_pengajar` varchar(100) NOT NULL,
  `ta_bop` smallint(6) DEFAULT NULL,
  `ta_pelatihan` smallint(6) DEFAULT NULL,
  `mitra_pelatihan` smallint(6) DEFAULT NULL,
  `mitra_id` int(11) DEFAULT NULL,
  `staff_teknisi` tinyint(4) DEFAULT '0' COMMENT '0 tdk ikut, 1 ikut',
  `team_leader` tinyint(4) DEFAULT '0' COMMENT '0 tdk ikut, 1 ikut',
  `officer` tinyint(4) DEFAULT '0' COMMENT '0 tdk ikut, 1 ikut',
  `site_manager` tinyint(4) DEFAULT '0' COMMENT '0 tdk ikut, 1 ikut',
  `mgr` tinyint(4) DEFAULT '0' COMMENT '0 tdk ikut, 1 ikut',
  `mitra` tinyint(4) DEFAULT '0' COMMENT '0 tdk ikut, 1 ikut',
  `senin` tinyint(4) DEFAULT '0' COMMENT '0 tdk, 1 ya',
  `selasa` tinyint(4) DEFAULT '0' COMMENT '0 tdk, 1 ya',
  `rabu` tinyint(4) DEFAULT '0' COMMENT '0 tdk, 1 ya',
  `kamis` tinyint(4) DEFAULT '0' COMMENT '0 tdk, 1 ya',
  `jumat` tinyint(4) DEFAULT '0' COMMENT '0 tdk, 1 ya'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_training_plan`
--

INSERT INTO `tb_training_plan` (`training_plan_id`, `tgl_awal`, `tgl_akhir`, `pelatihan_id`, `not_id`, `nama_pengajar`, `ta_bop`, `ta_pelatihan`, `mitra_pelatihan`, `mitra_id`, `staff_teknisi`, `team_leader`, `officer`, `site_manager`, `mgr`, `mitra`, `senin`, `selasa`, `rabu`, `kamis`, `jumat`) VALUES
(1, '2020-03-23', '2020-03-27', 1, 1, '', 15, NULL, 30, 0, 1, 0, 0, 0, 0, 1, 1, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_training_request`
--

CREATE TABLE `tb_training_request` (
  `training_request_id` int(11) NOT NULL,
  `nik` varchar(25) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `level` varchar(25) DEFAULT NULL,
  `sub_level` varchar(50) DEFAULT NULL,
  `pelatihan_id` int(11) DEFAULT NULL,
  `alasan_permintaan` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0' COMMENT '0 menunggu, 1 diterima, 2 ditolak'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users`
--

CREATE TABLE `tb_users` (
  `users_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `level` tinyint(4) DEFAULT NULL COMMENT '0 tamu, 1 admin',
  `active` tinyint(4) DEFAULT '1' COMMENT '0 tdk aktif, 1 aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_files`
--
ALTER TABLE `tb_files`
  ADD PRIMARY KEY (`file_id`);

--
-- Indeks untuk tabel `tb_jenis_laporan`
--
ALTER TABLE `tb_jenis_laporan`
  ADD PRIMARY KEY (`jenis_lap_id`);

--
-- Indeks untuk tabel `tb_mitra`
--
ALTER TABLE `tb_mitra`
  ADD PRIMARY KEY (`mitra_id`);

--
-- Indeks untuk tabel `tb_monila`
--
ALTER TABLE `tb_monila`
  ADD PRIMARY KEY (`monila_id`);

--
-- Indeks untuk tabel `tb_naker`
--
ALTER TABLE `tb_naker`
  ADD PRIMARY KEY (`naker_id`);

--
-- Indeks untuk tabel `tb_name_of_training`
--
ALTER TABLE `tb_name_of_training`
  ADD PRIMARY KEY (`not_id`);

--
-- Indeks untuk tabel `tb_operation`
--
ALTER TABLE `tb_operation`
  ADD PRIMARY KEY (`operation_id`);

--
-- Indeks untuk tabel `tb_pelatihan`
--
ALTER TABLE `tb_pelatihan`
  ADD PRIMARY KEY (`pelatihan_id`);

--
-- Indeks untuk tabel `tb_training_plan`
--
ALTER TABLE `tb_training_plan`
  ADD PRIMARY KEY (`training_plan_id`);

--
-- Indeks untuk tabel `tb_training_request`
--
ALTER TABLE `tb_training_request`
  ADD PRIMARY KEY (`training_request_id`);

--
-- Indeks untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_files`
--
ALTER TABLE `tb_files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_jenis_laporan`
--
ALTER TABLE `tb_jenis_laporan`
  MODIFY `jenis_lap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_mitra`
--
ALTER TABLE `tb_mitra`
  MODIFY `mitra_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_monila`
--
ALTER TABLE `tb_monila`
  MODIFY `monila_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_naker`
--
ALTER TABLE `tb_naker`
  MODIFY `naker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_name_of_training`
--
ALTER TABLE `tb_name_of_training`
  MODIFY `not_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_operation`
--
ALTER TABLE `tb_operation`
  MODIFY `operation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_pelatihan`
--
ALTER TABLE `tb_pelatihan`
  MODIFY `pelatihan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_training_plan`
--
ALTER TABLE `tb_training_plan`
  MODIFY `training_plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_training_request`
--
ALTER TABLE `tb_training_request`
  MODIFY `training_request_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
