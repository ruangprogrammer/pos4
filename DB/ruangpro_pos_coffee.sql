-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2018 at 11:00 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ruangpro_pos_coffee`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) UNSIGNED NOT NULL,
  `cart_session` varchar(32) DEFAULT NULL,
  `cart_date` date DEFAULT NULL,
  `cart_qty` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(250) DEFAULT NULL,
  `category_status` enum('Y','N') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_status`) VALUES
(11, 'Beverages', 'Y'),
(16, 'alcoholic beverages', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `forecasting`
--

CREATE TABLE `forecasting` (
  `fc_id` int(11) NOT NULL,
  `fc_tahun` int(11) DEFAULT NULL,
  `fc_penjualan` int(11) DEFAULT NULL,
  `fc_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forecasting`
--

INSERT INTO `forecasting` (`fc_id`, `fc_tahun`, `fc_penjualan`, `fc_status`) VALUES
(7, 2000, 3000, 'mv'),
(8, 2016, 3500, 'mv'),
(9, 2017, 34500, 'mv'),
(10, 2018, 1233, 'mv');

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE `note` (
  `note_id` int(11) NOT NULL,
  `note_name` varchar(250) DEFAULT NULL,
  `note_status` enum('k','m') DEFAULT NULL,
  `note_price` int(11) DEFAULT NULL,
  `note_desc` text,
  `note_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `note`
--

INSERT INTO `note` (`note_id`, `note_name`, `note_status`, `note_price`, `note_desc`, `note_date`) VALUES
(3, '11', 'k', 1000, '111', '2017-05-17 20:17:43'),
(5, 'twst', 'k', 10000, 'pengeluaran barang', '2017-05-19 20:21:44'),
(6, 'pembelian paket data', 'k', 10000, 'pembelian paket data Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo', '2017-04-18 23:16:36'),
(7, '333', 'k', 23333, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo', '2017-04-17 23:21:25'),
(8, 'pembelian CUP 200 biji', 'k', 300000, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2017-04-27 23:35:07'),
(9, 'keuntungan', 'm', 100000, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo', '2017-04-29 21:16:52');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_orders` int(5) NOT NULL,
  `nama_petugas` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_order` datetime NOT NULL,
  `jam_order` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_orders`, `nama_petugas`, `tgl_order`, `jam_order`) VALUES
(1, 'kasir', '2018-05-25 07:03:37', '02:03:37'),
(2, 'admin', '2018-05-25 07:10:25', '02:10:25');

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id_orders` int(5) NOT NULL,
  `product_id` int(5) NOT NULL,
  `jumlah` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `orders_detail`
--

INSERT INTO `orders_detail` (`id_orders`, `product_id`, `jumlah`) VALUES
(1, 33, 1),
(2, 34, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders_temp`
--

CREATE TABLE `orders_temp` (
  `id_orders_temp` int(5) NOT NULL,
  `product_id` int(11) NOT NULL,
  `id_session` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `jumlah` int(5) NOT NULL,
  `tgl_order_temp` date NOT NULL,
  `jam_order_temp` time NOT NULL,
  `stok_temp` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `product_price` int(11) DEFAULT NULL,
  `product_desc` text,
  `product_images` text,
  `product_stock` int(11) DEFAULT NULL,
  `product_date` datetime DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_price`, `product_desc`, `product_images`, `product_stock`, `product_date`, `category_id`) VALUES
(32, 'Triple Chocolate Cake	', 9500, 'Triple Chocolate Cake	', '15211523665207650307aplikasi pos berbasis web aplikasi penjualan pos (point of sales) dengan php mysql dan bootstrap-3.jpg', 98, '2018-04-02 20:27:50', 17),
(33, 'Rich Blueberry Muffin	', 13000, 'Rich Blueberry Muffin	', '22730182324990925192aplikasi pos berbasis web aplikasi penjualan pos (point of sales) dengan php mysql dan bootstrap-09.jpg', 93, '2018-04-02 20:28:02', 0),
(34, 'Chocolate Chocho Mama	', 12000, 'Nikmati malamu dengan Chocolate Chocho Mama	', '49796076114010850969aplikasi pos berbasis web aplikasi penjualan pos (point of sales) dengan php mysql dan bootstrap-1.jpg', 22, '2018-04-02 20:28:15', 11),
(35, 'Chocolate Chocho Mama	', 21000, 'Rich Blueberry Muffin ', '25795937682964061317aplikasi pos berbasis web aplikasi penjualan pos (point of sales) dengan php mysql dan bootstrap-5.jpg', 99, '2018-04-04 05:43:12', 11);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `user_foto` text,
  `user_name` varchar(40) NOT NULL,
  `user_password` varchar(250) NOT NULL,
  `user_level` varchar(8) NOT NULL,
  `user_status` enum('N','Y') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_foto`, `user_name`, `user_password`, `user_level`, `user_status`) VALUES
(1, '1886098097user2.png', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'Y'),
(27, '2902452910user1.png', 'kasir', 'c7911af3adbd12a035b289556d96470a', 'Kasir', 'Y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `forecasting`
--
ALTER TABLE `forecasting`
  ADD PRIMARY KEY (`fc_id`);

--
-- Indexes for table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`note_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_orders`);

--
-- Indexes for table `orders_temp`
--
ALTER TABLE `orders_temp`
  ADD PRIMARY KEY (`id_orders_temp`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `forecasting`
--
ALTER TABLE `forecasting`
  MODIFY `fc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `note`
--
ALTER TABLE `note`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_orders` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders_temp`
--
ALTER TABLE `orders_temp`
  MODIFY `id_orders_temp` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
