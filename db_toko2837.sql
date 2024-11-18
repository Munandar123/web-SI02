-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 07, 2024 at 07:44 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_toko2837`
--

-- --------------------------------------------------------

--
-- Table structure for table `About`
--

CREATE TABLE `About` (
  `id` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `About`
--

INSERT INTO `About` (`id`, `img`, `judul`, `deskripsi`) VALUES
(1, 'e75180f90fe051f0b9bf9aa647ef02d4.jpg', 'About Blanja', 'Blanja adalah platform e-commerce modern yang menghubungkan penjual dan pembeli dalam pengalaman belanja online yang cepat, aman, dan nyaman. Dengan berbagai kategori produk, mulai dari elektronik, fashion, hingga peralatan rumah tangga, Blanja menyediakan solusi belanja lengkap dalam satu tempat. Desain antarmuka yang ramah pengguna memudahkan navigasi dan pencarian produk. Keamanan transaksi menjadi prioritas utama Blanja, didukung teknologi enkripsi canggih untuk melindungi data pengguna. Blanja juga menawarkan berbagai metode pembayaran, termasuk transfer bank, e-wallet, dan pembayaran tunai saat pengiriman (COD). Bagi penjual, Blanja menyediakan alat manajemen toko yang praktis dengan fitur pelacakan inventaris, laporan penjualan terperinci, dan promosi produk. Sistem logistik yang terintegrasi dengan layanan pengiriman tepercaya memastikan produk sampai ke konsumen dengan cepat dan aman. Blanja berkomitmen memberikan layanan berkualitas dan kemudahan dalam berbelanja online, menjadikannya pilihan ideal untuk pengalaman e-commerce yang menyenangkan dan tepercaya.');

-- --------------------------------------------------------

--
-- Table structure for table `Contact`
--

CREATE TABLE `Contact` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Contact`
--

INSERT INTO `Contact` (`id`, `email`, `lokasi`, `phone`) VALUES
(1, 'blanja@murah.com', '2715 Ash Dr. San Jose, South Dakota 83474', '082174635261');

-- --------------------------------------------------------

--
-- Table structure for table `Home`
--

CREATE TABLE `Home` (
  `id` int(11) NOT NULL,
  `bagian` varchar(50) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Home`
--

INSERT INTO `Home` (`id`, `bagian`, `img`, `judul`, `deskripsi`) VALUES
(1, 'slideshow1', 'a.jpg', 'Discover The Best Furniture', 'Look for your inspiration here'),
(2, 'slideshow2', 'otomotif.jpg', 'Discover The Best Otomotif', 'Look for your inspiration here'),
(3, 'slideshow3', 'accesories.jpg', 'Discover The Best Accesories', 'Look for your inspiration here'),
(4, 'trustedbadge1', 'free-shipping.png', 'Free Shipping & Return', 'On all order over $99.00'),
(5, 'trustedbadge2', 'help-desk.png', 'Customer Support 24/7', 'Instant access to support'),
(6, 'trustedbadge3', 'payment-method.png', '100% Secure Payment', 'We ensure secure payment!'),
(7, 'banner1', 'helmet.jpg', '20% Off On New Helmet', 'Get Instant Cashback'),
(8, 'banner2', 'helmet.jpg', 'Let’s buy New Helmet', 'Get Instant Cashback'),
(9, 'banner3', 'helmet.jpg', 'Let’s buy New Helmet', 'Get Instant Cashback');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `kategori`) VALUES
(1, 'Elektronik'),
(2, 'Buku'),
(3, 'Pakaian'),
(4, 'Sepatu'),
(5, 'Aksesoris'),
(6, 'Peralatan Rumah Tangga'),
(7, 'Kesehatan & Kecantikan'),
(8, 'Olahraga & Outdoor'),
(9, 'Mainan & Hobi'),
(10, 'Perlengkapan Bayi'),
(11, 'Perhiasan'),
(12, 'Automotif');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` decimal(10,2) NOT NULL DEFAULT 0.00,
  `stok` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama_produk`, `kategori_id`, `deskripsi`, `harga`, `stok`, `gambar`, `created_at`, `status`) VALUES
(1, 'Smartphone XYZ', 1, 'Smartphone terbaru dengan fitur canggihh.', 499.99, 65, 'hp.jpg', '2024-11-05 23:17:28', 'aktif'),
(2, 'Buku \"Belajar PHP\"', 2, 'Panduan lengkap untuk belajar PHP dari dasar.', 29.99, 5, 'buku.jpg', '2024-11-05 23:17:28', 'aktif'),
(3, 'Kaos Polos', 3, 'Kaos polos berkualitas tinggi dengan berbagai warna.', 15.00, 8, 'kaos.jpg', '2024-11-05 23:17:28', 'aktif'),
(4, 'Sepatu Lari ABC', 4, 'Sepatu lari ringan dan nyaman untuk aktivitas sehari-hari.', 75.50, 12, 'sepatu.jpg', '2024-11-05 23:17:28', 'aktif'),
(5, 'Jam Tangan Elegan', 5, 'Jam tangan elegan dengan desain minimalis.', 120.00, 34, 'jam.jpg', '2024-11-05 23:17:28', 'aktif'),
(6, 'Blender 500W', 6, 'Blender dengan daya 500W untuk kebutuhan dapur Anda.', 60.00, 65, 'blender.jpg', '2024-11-05 23:17:28', 'aktif'),
(7, 'Set Skincare', 7, 'Set skincare lengkap untuk perawatan kulit harian.', 40.00, 34, 'skincare.jpg', '2024-11-05 23:17:28', 'aktif'),
(8, 'Tenda Camping', 8, 'Tenda camping tahan air untuk petualangan outdoor.', 150.00, 2, 'tenda.jpg', '2024-11-05 23:17:28', 'aktif'),
(9, 'Puzzle 1000 Potongan', 9, 'Puzzle dengan 1000 potongan untuk tantangan otak.', 25.00, 9, 'puzzle.jpg', '2024-11-05 23:17:28', 'aktif'),
(10, 'Stroller Bayi', 10, 'Stroller bayi yang aman dan nyaman untuk si kecil.', 200.00, 45, 'stroller.jpg', '2024-11-05 23:17:28', 'aktif'),
(11, 'Kalung Perak', 11, 'Kalung perak dengan desain modern dan elegan.', 50.00, 23, 'kalung.jpg', '2024-11-05 23:17:28', 'aktif'),
(12, 'Helm Motor', 12, 'Helm motor berkualitas tinggi dengan perlindungan maksimal.', 80.00, 23, 'helm.jpg', '2024-11-05 23:17:28', 'aktif'),
(13, 'Gelang Emas', 11, 'Gelang dengan bahan emas 24 karat', 50000.00, 8, '637904df83fba5970e0310bbb9fbfd34.jpg', '2024-11-05 17:00:00', 'nonaktif'),
(14, 'Helm TTC', 12, 'Helm KYT TTC sudah SNI dan DOT.', 346455.00, 6, '3e89586bbe94bcf2deaeea19eb9c02fd.jpg', '2024-11-05 17:00:00', 'nonaktif');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `address` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `status_user` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `gender`, `address`, `password`, `role`, `status_user`, `created_at`) VALUES
(1, 'Ahmad Zilong', 'zilong', 'admin@blanja.com', 'male', 'Jl. Land of Dawn', '$2y$10$//16zinNvRq8w1MwVPhV..iQaTm9RGIqqCV9PWv2EcuMRp6OyuNna', 'admin', 'aktif', '2024-11-06 17:40:32'),
(2, 'Khusnul Irithel slebew', 'irith', 'irithel@gmail.com', 'female', 'Jl. Land of Dawn 1', '$2y$10$24O2.fwSYvxKrkhyOcNA3OEjE0.BBdvwjPXoO9zqyWI8/LB60U01G', 'user', 'aktif', '2024-11-06 17:42:44'),
(3, 'Uni Bakwan', 'uwan', 'uni@bakwan.com', 'female', 'Jl Bantul', '$2y$10$XZnZX.mhw0NAvNVj4ga1IefcFXcJk6fJw.FPUFyOLIare/idQnoHm', 'user', 'aktif', '2024-11-06 20:24:20'),
(4, 'admin', 'admin', 'admin@admin.com', 'male', 'admin', '$2y$10$2Q3IjjFJg2n5FLeDSk.7v.2xwySEEHUdbjsoZNnglnb1HUvtH4oyW', 'admin', 'aktif', '2024-11-06 20:35:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `About`
--
ALTER TABLE `About`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Contact`
--
ALTER TABLE `Contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Home`
--
ALTER TABLE `Home`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `About`
--
ALTER TABLE `About`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Contact`
--
ALTER TABLE `Contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Home`
--
ALTER TABLE `Home`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
