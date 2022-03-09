-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 09, 2022 at 07:51 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_lengkap` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'admin', 'admin', 'Reza Putra Febriyan');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Sport'),
(2, 'Style');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(11) NOT NULL,
  `kota` varchar(40) NOT NULL,
  `biaya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `kota`, `biaya`) VALUES
(1, 'Bekasi', 10000),
(2, 'Jakarta Timur', 8000),
(3, 'Jakarta Selatan', 11000),
(4, 'Jakarta Utara', 12000),
(5, 'Jakarta Barat', 11000);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `pass_pelanggan` varchar(40) NOT NULL,
  `nama_pelanggan` varchar(40) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email`, `pass_pelanggan`, `nama_pelanggan`, `telepon`, `alamat`) VALUES
(1, 'rio@gmail.com', 'rio', 'Rio Putra', '085277776666', 'Jl. Budi Luhur No.98 Bekasi Barat. Kode Pos 17999'),
(2, 'rista@gmail.com', 'rista', 'Rista Amelia', '085399996666', 'Jl. Budi Luhur No.99 Bekasi Barat. Kode Pos 17999'),
(3, 'elfin@gmail.com', 'elfin', 'Elfin Sanjaya', '087899887799', 'Jl. Imam Bonjol No.98 Cilandak. Kode Pos 19789'),
(4, 'cindyseptianora@yahoo.com', 'cindy', 'Cindy Septianora', '083181958498', 'Jl. Kereta Api, Marpoyan');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `bank` varchar(40) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `bukti`) VALUES
(8, 56, 'Rio Putra Andriyan', 'BRI', 408000, '2021-07-06', '20210706001023login.JPG'),
(9, 59, 'rio', 'BNI', 554000, '2021-08-28', '20210828022622fg.JPG'),
(10, 61, 'Rista', 'BCA', 1166000, '2021-09-13', '20210913041730ro.JPG'),
(11, 63, 'Cindy', 'BCA', 574000, '2021-12-19', '20211219071239dpssis22.JPG'),
(12, 58, 'Elfin Sanjaya', 'BRI', 1435000, '2021-12-19', '20211219081212fg.JPG'),
(13, 65, 'Elfin Sanjaya', 'Riau', 1481000, '2021-12-21', '20211221015631sert.JPG'),
(14, 71, 'Rista Amelia', 'BCA', 1516000, '2022-03-09', '20220309075104C.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tanggal_beli` date NOT NULL,
  `total_beli` int(11) NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `status_beli` varchar(40) NOT NULL DEFAULT 'Belum Bayar',
  `resi` varchar(40) NOT NULL,
  `total_berat` int(11) NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `distrik` varchar(50) NOT NULL,
  `tipe` varchar(50) NOT NULL,
  `kodepos` varchar(50) NOT NULL,
  `ekspedisi` varchar(50) NOT NULL,
  `paket` varchar(50) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `estimasi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `tanggal_beli`, `total_beli`, `alamat_pengiriman`, `status_beli`, `resi`, `total_berat`, `provinsi`, `distrik`, `tipe`, `kodepos`, `ekspedisi`, `paket`, `ongkir`, `estimasi`) VALUES
(58, 3, '2021-08-27', 1435000, 'Jl. Merpati Putih, Bantul. N0. 55', 'Lunas', '', 3000, 'DI Yogyakarta', 'Bantul', 'Kabupaten', '55715', 'jne', 'YES', 105000, '1-1'),
(59, 1, '2021-08-28', 554000, 'Jl. Teratai Putih, No. 89', 'Lunas', '', 1750, 'Jawa Timur', 'Malang', 'Kota', '65112', 'jne', 'REG', 44000, '1-2'),
(61, 2, '2021-09-13', 1166000, 'Jl. Ahmad Yani No.77', 'Lunas', '', 1850, 'Riau', 'Indragiri Hulu', 'Kabupaten', '29319', 'tiki', 'ECO', 136000, '4'),
(62, 2, '2021-09-13', 1258000, 'Jl. Kartajaya No.79', 'Belum Bayar', '', 3000, 'Bali', 'Gianyar', 'Kabupaten', '80519', 'tiki', 'ECO', 78000, '4'),
(63, 4, '2021-11-23', 574000, 'Jl. Kereta Api, Marpoyan.\r\nNo. 96\r\n29897', 'Lunas', '', 1750, 'Riau', 'Pekanbaru', 'Kota', '28112', 'jne', 'OKE', 64000, '2-3'),
(64, 1, '2021-12-19', 534000, 'Jl. Madura No.99', 'Belum Bayar', '', 1500, 'Jawa Tengah', 'Magelang', 'Kota', '56133', 'jne', 'OKE', 34000, '2-3'),
(65, 3, '2021-12-19', 1481000, 'Jl. Flamboyan No.77', 'Lunas', '', 3000, 'Jawa Timur', 'Batu', 'Kota', '65311', 'tiki', 'REG', 81000, '3'),
(66, 3, '2021-12-19', 1000000, 'Jl. Ketapang No.88', 'Belum Bayar', '', 1600, 'Sumatera Selatan', 'Palembang', 'Kota', '30111', 'tiki', 'ECO', 40000, '4'),
(67, 1, '2021-12-19', 1427000, 'Jl. Beruang No.95', 'Belum Bayar', '', 3000, 'Banten', 'Tangerang Selatan', 'Kota', '15435', 'tiki', 'REG', 27000, '2'),
(68, 4, '2021-12-21', 1026000, 'Jl. Majapahit No.79', 'Belum Bayar', '', 1500, 'Sumatera Barat', 'Padang Panjang', 'Kota', '27122', 'tiki', 'ECO', 76000, '4'),
(69, 3, '2021-12-27', 1619000, 'Jl. Kapuk No.99 \r\n19675', 'Belum Bayar', '', 3100, 'Jawa Timur', 'Blitar', 'Kota', '66124', 'jne', 'OKE', 69000, '3-6'),
(70, 3, '2022-01-21', 424000, 'hfgh nm dfgsd n nm ', 'Belum Bayar', '', 1400, 'Lampung', 'Metro', 'Kota', '34111', 'jne', 'OKE', 64000, '3-6'),
(71, 2, '2022-03-09', 1516000, 'Jl. Kelapa Ijo No.77', 'Lunas', '', 3000, 'Sumatera Selatan', 'Palembang', 'Kota', '30111', 'tiki', 'REG', 66000, '2');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `harga` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `sub_berat` int(11) NOT NULL,
  `sub_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah`, `nama`, `harga`, `berat`, `sub_berat`, `sub_harga`) VALUES
(37, 56, 6, 1, 'Sepatu Futsal Specs Metasala', 400000, 1500, 1500, 400000),
(44, 58, 10, 1, 'Sepatu Futsal Specs Accelerator', 450000, 1500, 1500, 450000),
(45, 58, 16, 1, 'Vans Slip On Black White', 880000, 1500, 1500, 880000),
(46, 59, 25, 1, 'Baju Polo Shirt Ortuseight', 150000, 350, 350, 150000),
(47, 59, 11, 1, 'Sepatu Running Specs Lightstreak', 360000, 1400, 1400, 360000),
(50, 61, 16, 1, 'Vans Slip On Black White', 880000, 1500, 1500, 880000),
(51, 61, 25, 1, 'Baju Polo Shirt Ortuseight', 150000, 350, 350, 150000),
(52, 62, 24, 2, 'Sepatu Futsal Ortuseight Jagosala', 590000, 1500, 3000, 1180000),
(53, 63, 11, 1, 'Sepatu Running Specs Lightstreak', 360000, 1400, 1400, 360000),
(54, 63, 25, 1, 'Baju Polo Shirt Ortuseight', 150000, 350, 350, 150000),
(55, 64, 9, 1, 'Sepatu Futsal Specs Maestro', 500000, 1500, 1500, 500000),
(56, 65, 17, 1, 'Vans Old School Black White', 900000, 1500, 1500, 900000),
(57, 65, 9, 1, 'Sepatu Futsal Specs Maestro', 500000, 1500, 1500, 500000),
(58, 66, 18, 1, 'Converse 70s Black White', 960000, 1600, 1600, 960000),
(59, 67, 19, 1, 'Vans Old School Colorful', 950000, 1500, 1500, 950000),
(60, 67, 10, 1, 'Sepatu Futsal Specs Accelerator', 450000, 1500, 1500, 450000),
(61, 68, 19, 1, 'Vans Old School Colorful', 950000, 1500, 1500, 950000),
(62, 69, 24, 1, 'Sepatu Futsal Ortuseight Jagosala', 590000, 1500, 1500, 590000),
(63, 69, 18, 1, 'Converse 70s Black White', 960000, 1600, 1600, 960000),
(64, 70, 11, 1, 'Sepatu Running Specs Lightstreak', 360000, 1400, 1400, 360000),
(65, 71, 19, 1, 'Vans Old School Colorful', 950000, 1500, 1500, 950000),
(66, 71, 9, 1, 'Sepatu Futsal Specs Maestro', 500000, 1500, 1500, 500000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_produk` varchar(40) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `foto_produk` varchar(40) NOT NULL,
  `deskripsi` text NOT NULL,
  `stok_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `harga_produk`, `berat`, `foto_produk`, `deskripsi`, `stok_produk`) VALUES
(6, 1, 'Sepatu Futsal Specs Metasala', 400000, 1500, '60d1e7a8a8d4d.jpg', 'Sepatu ini direkomendasikan untuk posisi pivot dan anchor', 5),
(9, 1, 'Sepatu Futsal Specs Maestro', 500000, 1500, '60d27611c2810.jpg', 'BARRICADA MAESTRO XT ELITE IN-ALL BLACK', 4),
(10, 1, 'Sepatu Futsal Specs Accelerator', 450000, 1500, '60d27693b3273.jpg', 'ACCELERATOR LIGHTSPEED II BATTLEPACK IN JR-INFANTRY', 3),
(11, 1, 'Sepatu Running Specs Lightstreak', 360000, 1400, '60d2772c201a4.jpg', 'Easy running shoes with hi breatable mesh plus PU Nosew on the upper and zerp gravity on the bottom for lighweight, rekomended for recreational runner,training,gym and daily activity.', 3),
(16, 2, 'Vans Slip On Black White', 880000, 1500, '60d3e2591b70a.jpg', 'Vans Slip On Black White with black line', 22),
(17, 2, 'Vans Old School Black White', 900000, 1500, '60d3e3338860b.jpg', 'Vans Old School Black White natural', 18),
(18, 2, 'Converse 70s Black White', 960000, 1600, '60d3e4352965e.jpg', 'Converse 70s Black White with black line', 14),
(19, 2, 'Vans Old School Colorful', 950000, 1500, '60d3e4ffded99.jpg', 'Vans Old School colorful brush', 16),
(20, 1, 'Sepatu Futsal Ortuseight Zenith', 300000, 1400, '60dc679be99a3.jpg', 'Ortus Eight Zenith IN merupakan sepatu futsal dengan menggunakan teknologi Quick-Fit dengan material pelapis dalam upper sepatu dan teknologi Ort-Curve.', 5),
(24, 1, 'Sepatu Futsal Ortuseight Jagosala', 590000, 1500, '60dc6921605c0.jpg', 'Ortus Eight Jagosala Rabona sepatu futsal yang menggunakan teknologi Quick-Fit dengan material pelapis dalam upper dan teknologi Ort-Curve.', 16),
(25, 1, 'Baju Polo Shirt Ortuseight', 150000, 350, '60dc6a6a35edd.jpg', 'Catalyst polo ini merupakan polo shirt pertama dari Ortuseight dengan dua pilihan warna Black dan Navy dengan aksen warna orange pada lengan sangat cocok untuk classic look.', 24);

-- --------------------------------------------------------

--
-- Table structure for table `produk_foto`
--

CREATE TABLE `produk_foto` (
  `id_produk_foto` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_produk_foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `produk_foto`
--
ALTER TABLE `produk_foto`
  ADD PRIMARY KEY (`id_produk_foto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `produk_foto`
--
ALTER TABLE `produk_foto`
  MODIFY `id_produk_foto` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
