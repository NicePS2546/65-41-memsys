-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2024 at 11:18 AM
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
-- Database: `db67_6541_member`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id`, `fname`, `lname`, `email`, `password`, `role`) VALUES
(1, 'Pasit', 'Bungoed', 'maoezxooo@gmail.com', '123456789', 1),
(2, '1', 'Pasit', 'maoezxooo@gmail.com', '123456789', 0),
(3, 'Tony', 'Stark', 'tony.stark@gmail.com', '1234', 1),
(22, 'Tony', 'Stark', 'tony.stark@gmail.com', '1234', 1),
(23, 'Tony', 'Stark', 'tony.stark@gmail.com', '1234', 1),
(24, 'Tony', 'Stark', 'tony.stark@gmail.com', '1234', 0),
(25, 'Tony', 'Stark', 'tony.stark@gmail.com', '1234', 1),
(26, 'Tony', 'Stark', 'tony.stark@gmail.com', '1234', 1),
(27, 'Tony', 'Stark', 'tony.stark@gmail.com', '1234', 0),
(28, 'Tony', 'Stark', 'tony.stark@gmail.com', '1234', 1),
(29, 'Tony', 'Stark', 'tony.stark@gmail.com', '1234', 1),
(30, 'Tony', 'Stark', 'tony.stark@gmail.com', '1234', 0),
(31, 'Nice', 'Sim', 'asdasdd@gmail.com', '123456', 0),
(32, 'Tony', 'Stark', 'tony.stark@gmail.com', '1234', 1),
(33, 'Nice', 'HEEHEE', 'asdasd@g.com', '123456', 1),
(34, 'dr.doom', 'dr.doom', 'dr.doom@gmail.com', '11111111', 0),
(35, 'dr.mem', 'dr.mem', 'asdasd@g.com', 'dr.mem', 1),
(36, 'dr.mem', 'dr.mem', 'asdasd@g.com', 'asdas', 0),
(37, 'dr.mem', 'dr.mem', 'ฟหกฟก', 'ฟหก', 1),
(38, 'dr.mem', 'ฟหก', 'ฟหกฟหก', 'ฟหกฟก', 1),
(39, 'ฟหกฟหก', 'ฟหกฟก', 'ฟหกฟหก', 'ฟหก', 0),
(40, 'ฟหกฟหก', 'ฟหกฟก', 'ฟหกฟหก', 'ฟหก', 1),
(41, 'ฟหกฟหก', 'ฟหกฟก', 'ฟหกฟหก', 'ฟหก', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
