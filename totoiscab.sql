-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2024 at 02:47 PM
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
-- Database: `totoiscab`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin1');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `name1` varchar(255) NOT NULL,
  `email1` varchar(255) NOT NULL,
  `phone1` varchar(15) NOT NULL,
  `idnumber` varchar(20) NOT NULL,
  `pickdate` varchar(255) NOT NULL,
  `picklocation` varchar(255) NOT NULL,
  `returnd` varchar(255) NOT NULL,
  `vehicle` varchar(50) NOT NULL,
  `vname1` varchar(120) NOT NULL,
  `confirm` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `name1`, `email1`, `phone1`, `idnumber`, `pickdate`, `picklocation`, `returnd`, `vehicle`, `vname1`, `confirm`) VALUES
(19, 'winslause busale shioso', 'wenbusale383@gmail.com', '0769525570', '88888', '2024-11-14T13:37', 'kkkk', '2024-11-30', 'SUV', 'hhhddddd', 1),
(21, 'winslause busale shioso', 'wenbusale383@gmail.com', '0769525570', '88888', '2024-11-14T14:13', 'jjjjjjjjjj', 'hshshhs', 'self-drive', 'liiiiiiiiiii', 0);

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` int(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `idnumber` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `fname`, `email`, `phone`, `idnumber`) VALUES
(1, 'winslause busale shioso', 'wenbusale383@gmail.com', '0769525570', '877655'),
(2, 'Brian Barasa', 'brian236@gmail.com', '0748699974', '877655'),
(3, 'winslause busale shioso', 'wenbusale383@gmail.com', '0769525570', '877655'),
(4, 'winslause busale shioso', 'wenbusale383@gmail.com', '0769525570', '877655'),
(5, 'winslause busale shioso', 'wenbusale383@gmail.com', '0769525570', '877655'),
(6, 'winslause busale shioso', 'wenbusale383@gmail.com', '0769525570', '877655');

-- --------------------------------------------------------

--
-- Table structure for table `form_submissions`
--

CREATE TABLE `form_submissions` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form_submissions`
--

INSERT INTO `form_submissions` (`id`, `name`, `email`, `message`) VALUES
(1, 'Brian Barasa', 'brian236@gmail.com', 'testing');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `email1` varchar(100) NOT NULL,
  `phone1` varchar(100) NOT NULL,
  `password1` varchar(100) NOT NULL,
  `photo1` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `email1`, `phone1`, `password1`, `photo1`) VALUES
(8, 'winslause busale shioso', 'wenbusale383@gmail.com', '0769525570', '$2y$10$mWrPjx40lq5tgGelERQdCegijYRoVnqKZ/ttapl7ooWDTao8pKs9.', '');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `plate` varchar(100) NOT NULL,
  `capacity` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `category`, `name`, `plate`, `capacity`, `image`) VALUES
(4, 'executive', 'Mercedes Gle (Sports Package)', 'kcb 1234', '4', '../images/mercedes-gle.jpg'),
(5, 'standard-taxi', 'Toyota Axio/Fielder', 'xxxxx', '4', '../images/axio1.jpg'),
(7, 'standard-taxi', 'Toyota Vans', 'xxxxx', '11', '../images/toyota-vans.jpg'),
(8, 'self-drive', 'Toyota Axio/Fielder', 'xxxxx', '4', '../images/axio.jpg'),
(9, 'self-drive', 'Toyota Prado/V8', 'xxxxx', '4', '../images/prado1.jpg'),
(10, 'self-drive', 'Toyota Alphard', 'xxxxx', '6', '../images/toyota-alphard.jpg'),
(11, 'self-drive', 'Toyota Prado/V8', 'xxxxx', '4', '../images/prad.jpg'),
(12, 'executive', 'Mercedes ML350 (Sports Package)', 'xxxxx', '4', '../images/mercedes-ml350.jpg'),
(13, 'executive', 'Mercedes Gle (Sports Package)', 'xxxxx', '4', '../images/image2.png'),
(14, 'executive', 'Mercedes Gle (Sports Package)', 'xxxxx', '4', '../images/mercedes-gle.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_submissions`
--
ALTER TABLE `form_submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `form_submissions`
--
ALTER TABLE `form_submissions`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
