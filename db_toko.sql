-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2024 at 02:16 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_toko`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ID` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `foto` text NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ID`, `nama`, `harga`, `stock`, `foto`, `kategori`, `deskripsi`) VALUES
(7, 'Pancake', 21, 25, '19.jpg', 'Cake', 'so good'),
(8, 'Cinamonn Roll', 45, 35, 'img 13 (1).jpg', 'Cake', 'good'),
(14, 'Melon Bun', 30, 20, 'img 7.jpg', 'Bread', 'best seller'),
(29, 'Sandwich', 20, 15, 'img 13 (2).jpg', 'Bread', 'cute and nice'),
(31, 'Bombolone', 40, 23, '20.jpg', 'Bread', 'so good and creamy'),
(39, 'Choco Pancake', 32, 43, 'fa83da4a628972321c22b914a629ca1f.jpg', 'Cake', 'so good'),
(46, 'Cotton Candy Bread', 15, 23, '150280528abff1fa8dc9fbdcd5e64667.jpg', 'Bread', 'sweet '),
(47, 'Pink Bagel', 13, 24, '3b126e3b71e3397ca5a823454a5526c2.jpg', 'Bread', 'pinkyy'),
(48, 'Strawberry Pie', 20, 25, '2a1a9ccbe387f0dba8d2956792c46f66.jpg', 'Cake', 'niceee'),
(49, 'Strawberry Smoothies', 15, 15, 'img 16.jpg', 'Smoothies', 'sweet '),
(50, 'Mango Smoothies', 15, 18, '8a647cf8ba9db1f8cde5e92c01ff22c1.jpg', 'Smoothies', 'sweetie mango'),
(51, 'Blueberry Smoothies', 15, 15, '23.jpg', 'Smoothies', 'yummy'),
(52, 'Americano', 8, 35, 'img 15.jpg', 'Coffee', 'if you like bitter, you like it'),
(53, 'Cofffee Ice Cream', 18, 28, '31.jpg', 'Coffee', 'best'),
(54, 'Rosy Ocean', 22, 38, '28.jpg', 'Coctail', 'aesthetic color'),
(55, 'Dreamlannd', 21, 35, '30.jpg', 'Coctail', 'nice');

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail`
--

CREATE TABLE `tb_detail` (
  `id_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hp` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `role` enum('admin','pelanggan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `nama`, `email`, `username`, `password`, `hp`, `alamat`, `role`) VALUES
(2, 'tiara', '', 'tiara', '123', '', '', 'admin'),
(6, 'lala', 'lala@gmail.com', 'lala', '222', '0985742', 'korea', 'pelanggan'),
(7, 'nisa', 'nisa@gmail.com', 'nisa', '333', '0985742', 'jepang', 'pelanggan'),
(9, 'bila', 'bila@gmail.com', 'bila', '444', '090842', 'cirebon', 'pelanggan'),
(13, 'rara', 'raa@gmail.com', 'rara', '32', '32918475', 'sby', 'pelanggan'),
(14, 'blue', 'blue@gmail.com', 'blue', '88', '0876754', 'bali', 'pelanggan'),
(15, 'kiki', 'ki@gmail.com', 'kiii', '8319', '049583406', 'isekai', 'pelanggan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tb_detail`
--
ALTER TABLE `tb_detail`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tb_detail`
--
ALTER TABLE `tb_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
