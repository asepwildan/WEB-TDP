-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jan 2021 pada 15.46
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_awal`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `katalog_depan`
--

CREATE TABLE `katalog_depan` (
  `id` int(11) NOT NULL,
  `nama` varchar(500) NOT NULL,
  `warna` varchar(50) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `bahan` varchar(50) NOT NULL,
  `ukuran` char(10) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `katalog_depan`
--

INSERT INTO `katalog_depan` (`id`, `nama`, `warna`, `jenis`, `bahan`, `ukuran`, `gambar`) VALUES
(1, 'hoodie hijau', 'hijau', 'hoodie', 'Baby Terry', 'S', 'hoodie1.jpg'),
(2, 'hoodie untuk katirisan', 'hitam', 'JAKET', 'parasit', 'Small', 'hoodie2.jpg'),
(3, 'hoodie hitam variasi', 'hitam', 'HOODIE', 'babyterry', 'medium', 'hoodie3.jpg'),
(4, 'wadidaw', 'hitam', 'HOODIE', 'babyterry', 'medium', 'hoodie4.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `katalog_depan`
--
ALTER TABLE `katalog_depan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `katalog_depan`
--
ALTER TABLE `katalog_depan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
