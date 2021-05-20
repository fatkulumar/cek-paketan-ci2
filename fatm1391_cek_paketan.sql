-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 19 Bulan Mei 2021 pada 22.56
-- Versi server: 10.2.37-MariaDB-cll-lve
-- Versi PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fatm1391_cek_paketan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_other`
--

CREATE TABLE `tb_other` (
  `id_other` int(11) NOT NULL,
  `warning` mediumtext NOT NULL,
  `info` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_other`
--

INSERT INTO `tb_other` (`id_other`, `warning`, `info`) VALUES
(1, 'Gasek Multimedia atau yang biasa disebut gasmul ini adalah badan otonom yang menangani bidang multimedia, komunikasi, informasi dan dokumentasi. Selain itu Gasmul juga melayani Peminjaman Barang, Penyediaan Jasa, serta Printing. Gasek multimedia ini beranggotakan dari santriwan santriwati Pondok Pesantren Sabilurrosyad. Gasek Multimedia mempunyai 6 divisi dengan beberapa jobdisk. Gasek Multimedia terdiri dari Divisi Web, Divisi Content Creator, Divisi Teknisi, Divisi Fotografi, Divisi Desain, Divisi Teknisi2.', 'Selamat Datang di Sympas, silahkan cek paketan anda');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_paket`
--

CREATE TABLE `tb_paket` (
  `id_paket` int(255) NOT NULL,
  `id_santri` int(225) NOT NULL,
  `nama_paket` varchar(50) NOT NULL,
  `penerima` varchar(50) NOT NULL,
  `jenis_kirim` varchar(8) NOT NULL DEFAULT 'Langsung',
  `tgl_terima` varchar(20) DEFAULT NULL,
  `tgl_ambil` varchar(20) DEFAULT NULL,
  `pengambil` varchar(50) NOT NULL,
  `status_ambil` varchar(20) DEFAULT NULL,
  `hp` varchar(13) NOT NULL,
  `creat_at` varchar(20) DEFAULT NULL,
  `modified_at` varchar(20) DEFAULT NULL,
  `tahun` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_paket`
--

INSERT INTO `tb_paket` (`id_paket`, `id_santri`, `nama_paket`, `penerima`, `jenis_kirim`, `tgl_terima`, `tgl_ambil`, `pengambil`, `status_ambil`, `hp`, `creat_at`, `modified_at`, `tahun`) VALUES
(1, 0, 'firly kamilah', 'Gasmul', 'Langsung', '05-04-2021 01:43:15', NULL, '', NULL, '08983434675', '05-04-2021 01:43:15', NULL, '2021'),
(2, 0, 'wahyuni wulan', 'Gasmul', 'Langsung', '05-04-2021 01:47:44', NULL, '', NULL, '0895375700880', '05-04-2021 01:47:44', NULL, '2021'),
(3, 0, 'lina mawaddah zakiyyah', 'Gasmul', 'Langsung', '05-04-2021 01:47:44', NULL, '', NULL, '085743979787', '05-04-2021 01:47:44', NULL, '2021'),
(4, 0, 'yasmin zia', 'Gasmul', 'Langsung', '05-04-2021 01:47:44', NULL, '', NULL, '085100439534', '05-04-2021 01:47:44', NULL, '2021'),
(5, 0, 'hikmah', 'Gasmul', 'Langsung', '05-04-2021 01:47:44', NULL, '', NULL, '0895333342953', '05-04-2021 01:47:44', NULL, '2021'),
(6, 0, 'Rahmi kartikawangi', 'Gasmul', 'Langsung', '21-04-2021 03:02:22', NULL, '', NULL, '085708291593', '21-04-2021 03:02:22', NULL, '2021'),
(7, 0, 'Aulul', 'Gasmul', 'Langsung', '21-04-2021 03:02:22', NULL, '', NULL, '082244115879', '21-04-2021 03:02:22', NULL, '2021'),
(8, 0, 'Ella 12', 'Gasmul', 'Langsung', '21-04-2021 03:02:22', NULL, '', NULL, '081929652746', '21-04-2021 03:02:22', NULL, '2021'),
(9, 0, 'Qonita amalia', 'Gasmul', 'Langsung', '21-04-2021 03:02:22', NULL, '', NULL, '085850819229', '21-04-2021 03:02:22', NULL, '2021'),
(10, 0, 'Yunji', 'Gasmul', 'Langsung', '21-04-2021 03:02:22', NULL, '', NULL, '085732707910', '21-04-2021 03:02:22', NULL, '2021'),
(11, 0, 'Prass', 'Gasmul', 'Langsung', '21-04-2021 03:02:22', NULL, '', NULL, '085755223374', '21-04-2021 03:02:22', NULL, '2021'),
(12, 0, 'Edy purwanto', 'Gasmul', 'Langsung', '21-04-2021 03:02:22', NULL, '', NULL, '0895366442227', '21-04-2021 03:02:22', NULL, '2021'),
(13, 0, 'Zulfa hidayatul', 'Gasmul', 'Langsung', '21-04-2021 03:02:22', NULL, '', NULL, '085748345606', '21-04-2021 03:02:22', NULL, '2021'),
(14, 0, 'Zulfa hidayatul', 'Gasmul', 'Langsung', '21-04-2021 03:02:22', NULL, '', NULL, '085748345606', '21-04-2021 03:02:22', NULL, '2021'),
(15, 0, 'M alawy', 'Gasmul', 'Langsung', '21-04-2021 03:02:22', NULL, '', NULL, '081216128385', '21-04-2021 03:02:22', NULL, '2021'),
(16, 0, 'Isma harika', 'Gasmul', 'Langsung', '21-04-2021 03:02:22', NULL, '', NULL, '085735283839', '21-04-2021 03:02:22', NULL, '2021'),
(17, 0, 'Trisna dwi', 'Gasmul', 'Langsung', '21-04-2021 03:02:22', NULL, '', NULL, '08885717198', '21-04-2021 03:02:22', NULL, '2021'),
(18, 0, 'Bachtiyar', 'Gasmul', 'Langsung', '21-04-2021 03:02:22', NULL, '', NULL, '089694446983', '21-04-2021 03:02:22', NULL, '2021'),
(19, 0, 'Milatul mufidah (guru smp)', 'Gasmul', 'Langsung', '21-04-2021 03:02:22', NULL, '', NULL, '082139646773', '21-04-2021 03:02:22', NULL, '2021'),
(20, 0, 'Anis shofia', 'Gasmul', 'Langsung', '21-04-2021 03:02:22', NULL, '', NULL, '085895524481', '21-04-2021 03:02:22', NULL, '2021');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_santri`
--

CREATE TABLE `tb_santri` (
  `id_santri` int(255) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `hp` varchar(13) NOT NULL,
  `creat_at` timestamp NULL DEFAULT NULL,
  `last_modified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_santri`
--

INSERT INTO `tb_santri` (`id_santri`, `nama_lengkap`, `hp`, `creat_at`, `last_modified`) VALUES
(1, 'Pasha', '085876545671', '2021-01-01 01:08:11', '2021-01-02 01:08:11'),
(2, 'Wahib', '085876545671', '2021-01-01 01:08:11', '2021-01-02 01:08:11');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_other`
--
ALTER TABLE `tb_other`
  ADD PRIMARY KEY (`id_other`);

--
-- Indeks untuk tabel `tb_paket`
--
ALTER TABLE `tb_paket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indeks untuk tabel `tb_santri`
--
ALTER TABLE `tb_santri`
  ADD PRIMARY KEY (`id_santri`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_other`
--
ALTER TABLE `tb_other`
  MODIFY `id_other` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_paket`
--
ALTER TABLE `tb_paket`
  MODIFY `id_paket` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tb_santri`
--
ALTER TABLE `tb_santri`
  MODIFY `id_santri` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
