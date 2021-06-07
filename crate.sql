-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2021 at 03:06 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crate`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `company` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company`) VALUES
(1, 'melinda'),
(2, 'rigoni');

-- --------------------------------------------------------

--
-- Table structure for table `crates`
--

CREATE TABLE `crates` (
  `id` int(11) NOT NULL,
  `id_company` int(11) NOT NULL,
  `content` enum('apple','pear','grape') NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `crates`
--

INSERT INTO `crates` (`id`, `id_company`, `content`, `active`) VALUES
(1, 1, 'apple', 0),
(3, 2, 'grape', 0),
(4, 1, 'apple', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `id_company` int(11) NOT NULL,
  `auth_key` varchar(32) DEFAULT NULL,
  `owner` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `id_company`, `auth_key`, `owner`) VALUES
(2, 'luca', 'a05bd890c4868ea1807f8564055d1fba77c6ba81', 1, '', 1),
(3, 'luca2', '44d2fd8a3a8af30eea7be3a1b1e42d4c690f84d1', 2, NULL, 1),
(15, 'dealer', '27f65806fb21d86a7d06426f00e446f7c8e9d381', 1, '', 0),
(20, 'reseller', 'b5e13d82f19a015d638e3368a8e9cc1bf6d4a69a', 1, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `values`
--

CREATE TABLE `values` (
  `id` int(11) NOT NULL,
  `id_crate` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `temperature` float NOT NULL,
  `humidity` int(11) NOT NULL,
  `hydrogen` int(11) NOT NULL,
  `oxigen` int(11) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `values`
--

INSERT INTO `values` (`id`, `id_crate`, `date`, `temperature`, `humidity`, `hydrogen`, `oxigen`, `latitude`, `longitude`) VALUES
(4, 1, '2021-04-18 13:37:15', 20, 10, 10, 10, 46.154869079589844, 12.219490051269531),
(5, 1, '2021-04-19 13:41:05', 21, 15, 10, 10, 46.1562625, 12.2127896),
(6, 3, '2021-04-20 17:32:24', 20, 13, 10, 10, 46.14, 12.1),
(7, 1, '2021-04-20 17:32:24', 20, 13, 10, 10, 46.145, 12.219490051269531),
(8, 1, '2021-04-21 17:32:24', 15, 20, 10, 10, 46.154869079589844, 12.219490051269531),
(9, 4, '2021-04-22 17:32:24', 21, 25, 10, 10, 46.154869079589844, 12.219490051269531);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crates`
--
ALTER TABLE `crates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_company` (`id_company`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_company` (`id_company`);

--
-- Indexes for table `values`
--
ALTER TABLE `values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_crate` (`id_crate`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `crates`
--
ALTER TABLE `crates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `values`
--
ALTER TABLE `values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `crates`
--
ALTER TABLE `crates`
  ADD CONSTRAINT `crates_ibfk_1` FOREIGN KEY (`id_company`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_company`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `values`
--
ALTER TABLE `values`
  ADD CONSTRAINT `values_ibfk_1` FOREIGN KEY (`id_crate`) REFERENCES `crates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
