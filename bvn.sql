-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2018 at 06:27 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bvn`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_numbers`
--

CREATE TABLE `account_numbers` (
  `id` int(11) NOT NULL,
  `account_id` int(15) NOT NULL,
  `account_number` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_numbers`
--

INSERT INTO `account_numbers` (`id`, `account_id`, `account_number`) VALUES
(14, 50, 2070725896),
(15, 50, 712589636),
(16, 51, 2070725896),
(17, 51, 712589636),
(18, 52, 2147483647),
(19, 52, 2147483647),
(20, 52, 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `bvn` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `date_joined` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL,
  `last_modified` datetime NOT NULL,
  `user_role` varchar(15) NOT NULL,
  `account_number` text NOT NULL,
  `account_name` varchar(50) NOT NULL,
  `passport` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `full_name`, `phone_number`, `bvn`, `email`, `password`, `date_joined`, `last_login`, `last_modified`, `user_role`, `account_number`, `account_name`, `passport`) VALUES
(51, 'Njoku Samson Ebere', '08031904145', '22274333899', 'ebereplenty@gmail.com', '$2y$10$NSaH2InBE3mveNypOXNbg.68dybhmyFQQSPNMXu3Fj4cDahTC7/gq', '2018-06-25 20:44:06', '2018-06-25 21:44:31', '0000-00-00 00:00:00', 'admin', '2070725896 0712589636', 'Njoku Samson Ebere', '/bvn-master/images/97933df028a33a71d3d46bea390ac288.JPG'),
(52, 'Emma Chukwudi', '08052707200', '22223342950', 'emmac@gmail.com', '$2y$10$IPcdSZY/NBhzhpBiGhhet.qQV89c0F0Y1qat6fKcM4oQLdVVJTg3q', '2018-06-25 20:49:11', '2018-06-25 21:49:26', '0000-00-00 00:00:00', 'user', '2548745121 5864587523 8529634596', 'Emma Chukwudi', '/bvn-master/images/a66a2c484df59a388c5d5ca6b7e845ac.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_numbers`
--
ALTER TABLE `account_numbers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_numbers`
--
ALTER TABLE `account_numbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
