-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2022 at 04:59 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sugar_nr`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `email`, `password`, `image`, `created_at`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', 'default.jpg', '2022-01-07 13:54:33'),
(3, 'admin2', 'admin2@gmail.com', 'admin', 'default.jpg', '2022-01-07 14:03:28');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telp` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `email`, `password`, `alamat`, `telp`, `created_at`, `updated_at`) VALUES
(1, 'pelanggan 1', 'pelanggan@gmail.com', 'pelanggan', 'denpasar', '081212313', '2022-01-07 07:53:24', '2022-01-07 15:53:24'),
(2, 'cust', 'cust@gmail.com', 'cust', 'denpasar', '081223123', '2022-01-07 08:38:20', '2022-01-07 09:38:20'),
(3, 'cust3', 'cust3@gmail.com', 'cust3', 'denpasar', '08123123123', '2022-01-07 11:54:13', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `keterangan`, `harga`, `jumlah`, `image`, `created_at`, `updated_at`, `status`) VALUES
(1, 'dream cather satu', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem ipsum dolor sit amet, consectetur adipiscing elit', 50000, 10, '07-01-2022_10-00-20.jpg', '2022-01-07 09:00:20', '2022-01-07 10:00:20', 'Aktif'),
(3, 'dream cather dua', 'keterangan dream cather dua', 10000, 50, '07-01-2022_10-00-29.jpg', '2022-01-07 09:00:29', '2022-01-07 10:00:29', 'Aktif'),
(4, 'produk 3', 'ket 3', 30000, 90, '07-01-2022_10-00-57.jpg', '2022-01-07 09:00:57', '2022-01-07 10:00:57', 'Aktif'),
(5, 'produk 4', 'ket 4', 40000, 40, '07-01-2022_10-01-23.jpg', '2022-01-07 09:01:23', '2022-01-07 10:01:23', 'Aktif'),
(6, 'produk 5', 'ket 5', 50000, 49, '10-01-2022_02-17-44.jpg', '2022-01-10 01:17:44', '2022-01-10 02:17:44', 'Aktif'),
(7, 'produk 6', 'ket 6', 60000, 58, '07-01-2022_10-01-57.jpg', '2022-01-07 09:01:57', '2022-01-07 10:01:57', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `kode_transaksi` varchar(255) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `bukti_transfer` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `noresi` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `kode_transaksi`, `id_pelanggan`, `id_produk`, `jumlah`, `bukti_transfer`, `status`, `noresi`, `created_at`) VALUES
(1, 'T1', 1, 1, 1, '12-01-2022_01-56-33.jpg', 'Menunggu Konfirmasi', '', '2022-01-11 12:55:18'),
(2, 'T1', 1, 3, 2, '12-01-2022_01-56-33.jpg', 'Menunggu Konfirmasi', '', '2022-01-11 12:55:18'),
(3, 'T2', 1, 1, 1, '12-01-2022_01-54-31.jpg', 'Barang Dikirim', '123123123123', '2022-01-21 12:55:31'),
(4, 'T2', 1, 3, 2, '12-01-2022_01-54-31.jpg', 'Barang Dikirim', '123123123123', '2022-01-21 12:55:31'),
(5, 'T3', 2, 6, 1, '12-01-2022_04-27-20.jpg', 'Barang Dikirim', '123333333', '2022-01-12 04:23:18'),
(6, 'T3', 2, 7, 2, '12-01-2022_04-27-20.jpg', 'Barang Dikirim', '123333333', '2022-01-12 04:23:18'),
(7, 'T4', 2, 3, 5, '', 'Belum Bayar', '', '2022-01-12 04:58:02'),
(8, 'T4', 2, 4, 10, '', 'Belum Bayar', '', '2022-01-12 04:58:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
