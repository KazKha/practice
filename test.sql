-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2023 at 08:26 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `membertable`
--

CREATE TABLE `membertable` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `parentId` int(11) NOT NULL DEFAULT 0,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `membertable`
--

INSERT INTO `membertable` (`id`, `name`, `parentId`, `create_at`) VALUES
(1, ' Parent-abcd', 0, '2023-06-16 15:00:54'),
(2, ' Parent-xyz', 0, '2023-06-16 15:00:54'),
(3, ' Parent-efgh', 0, '2023-06-16 15:01:33'),
(4, ' Parent-ijkl', 0, '2023-06-16 15:01:33'),
(39, 'test one', 3, '2023-06-17 11:52:57'),
(40, 'test two ', 1, '2023-06-17 11:53:04'),
(41, 'testone child', 39, '2023-06-17 11:55:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `membertable`
--
ALTER TABLE `membertable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `membertable`
--
ALTER TABLE `membertable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
