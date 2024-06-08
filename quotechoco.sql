-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2024 at 07:25 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quotechoco`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id_detail` varchar(20) NOT NULL,
  `id_transaksi` varchar(20) NOT NULL,
  `id_produdk` varchar(20) NOT NULL,
  `jumlah` int(20) NOT NULL,
  `harga_satuan` varchar(20) NOT NULL,
  `total_harga` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorit`
--

CREATE TABLE `favorit` (
  `id_favorit` varchar(20) NOT NULL,
  `id_user` varchar(20) NOT NULL,
  `id_produk` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` varchar(20) NOT NULL,
  `nama_kategori` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
('KT01', 'Birthday Cake'),
('KT02', 'Bolu Jadul'),
('KT03', 'Brownies'),
('KT04', 'Cookies'),
('KT05', 'Christmas Cake'),
('KT06', 'Hampers'),
('KT07', 'Kue Soes'),
('KT08', 'Puding');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` varchar(20) NOT NULL,
  `id_user` varchar(20) NOT NULL,
  `id_produk` varchar(20) NOT NULL,
  `jumlah` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` varchar(20) NOT NULL,
  `nama_produk` text NOT NULL,
  `id_kategori` varchar(20) NOT NULL,
  `harga` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `id_kategori`, `harga`) VALUES
('P001', 'Almond Cake', 'KT01', ''),
('P002', 'Ceres Cake', 'KT01', ''),
('P003', 'Choco Birthday', 'KT01', ''),
('P004', 'Fruit Birthday', 'KT01', ''),
('P005', 'Caracter Birthday', 'KT01', ''),
('P006', 'Bolu jadul spesial', 'KT02', ''),
('P007', 'Bolu Jadul', 'KT02', ''),
('P008', 'Bolu Coklat', 'KT02', ''),
('P009', 'Bolu Gulung', 'KT02', ''),
('P010', 'Bolu Keju', 'KT02', ''),
('P011', 'Birthday Brownies', 'KT03', ''),
('P012', 'Milky Brownies', 'KT03', ''),
('P013', 'Brownies for birthday', 'KT03', ''),
('P014', 'Brownies oni choco', 'KT03', ''),
('P015', 'Choco Brownies', 'KT03', ''),
('P016', 'Kue Sagu', 'KT04', ''),
('P017', 'Kastengel', 'KT04', ''),
('P018', 'Nastar', 'KT04', ''),
('P019', 'Cookies', 'KT04', ''),
('P020', 'Kue Kacang', 'KT04', ''),
('P021', 'Combo Snack', 'KT05', ''),
('P022', 'Almond Desert', 'KT05', ''),
('P023', 'Christmas Snack', 'KT05', ''),
('P024', 'Christmas box package', 'KT05', ''),
('P025', 'Red velvet cake', 'KT05', ''),
('P026', 'Christmas hampers', 'KT06', ''),
('P027', 'Birthday hampers', 'KT06', ''),
('P028', 'Eid hampers', 'KT06', ''),
('P029', 'Combo snack box for birthday', 'KT06', ''),
('P030', 'Puding box for hampers', 'KT06', ''),
('P031', 'Kue soes coklat', 'KT07', ''),
('P032', 'Kue soes keju', 'KT07', ''),
('P033', 'Kue soes vanila', 'KT07', ''),
('P034', 'Soes tart', 'KT07', ''),
('P035', 'Puding susu', 'KT08', ''),
('P036', 'Puding buah', 'KT08', ''),
('P037', 'Puding coklat', 'KT08', ''),
('P038', 'Choco vanila puding', 'KT08', ''),
('P039', 'Puding box', 'KT08', '');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_penjualan`
--

CREATE TABLE `transaksi_penjualan` (
  `id_transaksi` varchar(20) NOT NULL,
  `id_user` varchar(20) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `total_harga` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `nama_pengguna` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nomor_telepon` varchar(50) NOT NULL,
  `kata_sandi` varchar(50) NOT NULL,
  `konfirmasi_kata_sandi` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama_lengkap`, `nama_pengguna`, `email`, `nomor_telepon`, `kata_sandi`, `konfirmasi_kata_sandi`, `alamat`) VALUES
(3, 'guest', 'guest', 'guest@gmail.com', '123', '010', '010', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `transaksi_penjualan`
--
ALTER TABLE `transaksi_penjualan`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
