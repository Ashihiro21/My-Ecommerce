-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2024 at 02:41 PM
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
-- Database: `samples`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_to_cart`
--

CREATE TABLE `add_to_cart` (
  `id` int(11) NOT NULL,
  `i_id` int(11) NOT NULL,
  `tracking_number` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` varchar(255) NOT NULL,
  `images` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `add_to_cart`
--

INSERT INTO `add_to_cart` (`id`, `i_id`, `tracking_number`, `name`, `price`, `quantity`, `total`, `images`, `username`) VALUES
(59, 0, 1059495864, 'G.Skill Ripjaws V', '3600', 8, '28800', 'ram_img/ram_stick.jpg', 'LfaEc8M9'),
(60, 1, 1406004445, 'ASUS Prime X570-Pro ATX Motherboard', '9499', 9, '85491', 'board_img/board.jpg', 'LfaEc8M9'),
(64, 1, 1236668675, 'ASUS Prime X570-Pro ATX Motherboard', '9499', 13, '123487', 'board_img/board.jpg', 'Elexis21'),
(65, 0, 63311588, 'G.Skill Ripjaws V', '3600', 5, '18000', 'ram_img/ram_stick.jpg', 'Elexis21');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_images` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `user_images`) VALUES
(1, 'Admin', 'Admin123', '../img/dp.png');

-- --------------------------------------------------------

--
-- Table structure for table `case`
--

CREATE TABLE `case` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Mobo_Size` varchar(50) DEFAULT NULL,
  `Graphics_Cards` varchar(255) DEFAULT NULL,
  `Case_Fans` int(11) DEFAULT NULL,
  `Expansion_Slots` int(11) DEFAULT NULL,
  `images` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `categories_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `categories_image`) VALUES
(0, 'Ram', 'img/ram_stick.jpg'),
(1, 'Motherboard', 'img/board.jpg'),
(2, 'Case', 'img/case.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `filename`, `category_id`) VALUES
(0, 'Ram', 0),
(1, 'Motherboard', 1),
(2, 'Case', 2);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `time` time NOT NULL DEFAULT current_timestamp(),
  `date` date NOT NULL DEFAULT current_timestamp(),
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `content`, `time`, `date`, `username`) VALUES
(17, 'sadasdsa', '09:02:06', '2024-03-03', ''),
(18, 'sadasdsa', '09:21:14', '2024-03-03', 'Elexis21'),
(19, 'sadasdsa', '09:22:19', '2024-03-03', 'Elexis21'),
(20, 'sadasdsa', '09:23:28', '2024-03-03', ''),
(21, 'asdasdsa', '09:31:09', '2024-03-03', 'Elexis21'),
(22, 'asdasdsa', '09:31:19', '2024-03-03', 'Elexis21'),
(23, 'Elexis Falceso', '09:37:03', '2024-03-03', 'Elexis21'),
(24, 'Eliza bETH fALCESO', '09:37:32', '2024-03-03', 'Elexis21'),
(25, 'ASDSADA', '09:38:06', '2024-03-03', 'Elexis21'),
(26, 'ASDSA', '09:38:10', '2024-03-03', 'Elexis21'),
(27, 'ASDSADSAD', '09:38:12', '2024-03-03', 'Elexis21'),
(28, 'ASDSADSAD', '09:40:37', '2024-03-03', 'Elexis21'),
(29, 'ASDSADSAD', '09:44:56', '2024-03-03', 'Elexis21'),
(30, 'ASDSADSAD', '09:45:57', '2024-03-03', 'Elexis21'),
(31, 'ASDSADSAD', '09:46:23', '2024-03-03', 'Elexis21'),
(32, 'ASDSADSAD', '09:46:34', '2024-03-03', 'Elexis21'),
(33, 'ASDSADSAD', '09:46:48', '2024-03-03', 'Elexis21'),
(34, 'ASDSADSAD', '09:47:08', '2024-03-03', 'Elexis21'),
(35, 'ASDSADSAD', '09:48:31', '2024-03-03', 'Elexis21'),
(36, 'ASDSADSAD', '09:49:27', '2024-03-03', 'Elexis21'),
(37, 'ASDSADSAD', '09:49:43', '2024-03-03', 'Elexis21'),
(38, 'ASDSADSAD', '09:49:55', '2024-03-03', 'Elexis21'),
(39, 'ASDSADSAD', '09:50:05', '2024-03-03', 'Elexis21'),
(40, 'ASDSADSAD', '09:50:13', '2024-03-03', 'Elexis21'),
(41, 'ASDSADSAD', '09:50:23', '2024-03-03', 'Elexis21'),
(42, 'ASDSADSAD', '09:51:35', '2024-03-03', 'Elexis21'),
(43, 'ASDSADSAD', '09:51:44', '2024-03-03', 'Elexis21'),
(44, 'ASDSADSAD', '09:51:52', '2024-03-03', 'Elexis21'),
(45, 'ASDSADSAD', '09:52:00', '2024-03-03', 'Elexis21'),
(46, 'asdasdasdsadsadsadsadsadsadsa', '09:52:08', '2024-03-03', 'Elexis21');

-- --------------------------------------------------------

--
-- Table structure for table `motherboards`
--

CREATE TABLE `motherboards` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `manufacturer` varchar(255) DEFAULT NULL,
  `i_id` int(11) DEFAULT NULL,
  `tracking_number` int(11) NOT NULL,
  `memory_support` varchar(255) DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `motherboards`
--

INSERT INTO `motherboards` (`id`, `name`, `manufacturer`, `i_id`, `tracking_number`, `memory_support`, `images`, `price`, `quantity`) VALUES
(0, 'ASUS Prime X570-Pro ATX Motherboard', 'ASUS', 1, 123456789, 'DDR4', 'board_img/board.jpg', '9499', 20);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `i_id` varchar(255) NOT NULL,
  `tracking_number` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` varchar(255) NOT NULL,
  `images` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `i_id`, `tracking_number`, `name`, `price`, `quantity`, `total`, `images`, `username`) VALUES
(84, '0', 1448905430, 'G.Skill Ripjaws V', '3600', 8, '28800', 'ram_img/ram_stick.jpg', '8hAHv8Az'),
(85, '0', 159534243, 'G.Skill Ripjaws V', '3600', 8, '28800', 'ram_img/ram_stick.jpg', '8hAHv8Az'),
(86, '1', 1740412216, 'ASUS Prime X570-Pro ATX Motherboard', '9499', 4, '37996', 'board_img/board.jpg', '8hAHv8Az'),
(87, '1', 1931643807, 'ASUS Prime X570-Pro ATX Motherboard', '9499', 4, '37996', 'board_img/board.jpg', '8hAHv8Az'),
(88, '1', 1751194463, 'ASUS Prime X570-Pro ATX Motherboard', '9499', 4, '37996', 'board_img/board.jpg', '8hAHv8Az'),
(89, '1', 734853860, 'ASUS Prime X570-Pro ATX Motherboard', '9499', 4, '37996', 'board_img/board.jpg', '8hAHv8Az'),
(90, '0', 104860236, 'G.Skill Ripjaws V', '3600', 7, '25200', 'ram_img/ram_stick.jpg', ''),
(91, '0', 104860236, 'G.Skill Ripjaws V', '3600', 7, '25200', 'ram_img/ram_stick.jpg', ''),
(92, '0', 841412709, 'G.Skill Ripjaws V', '3600', 24, '86400', 'ram_img/ram_stick.jpg', ''),
(93, '0', 1059495864, 'G.Skill Ripjaws V', '3600', 8, '28800', 'ram_img/ram_stick.jpg', ''),
(94, '1', 1406004445, 'ASUS Prime X570-Pro ATX Motherboard', '9499', 9, '85491', 'board_img/board.jpg', ''),
(95, '1', 1406004445, 'ASUS Prime X570-Pro ATX Motherboard', '9499', 9, '85491', 'board_img/board.jpg', ''),
(96, '1', 1406004445, 'ASUS Prime X570-Pro ATX Motherboard', '9499', 9, '85491', 'board_img/board.jpg', 'LfaEc8M9'),
(97, '0', 1059495864, 'G.Skill Ripjaws V', '3600', 8, '28800', 'ram_img/ram_stick.jpg', 'LfaEc8M9'),
(98, '0', 1059495864, 'G.Skill Ripjaws V', '3600', 8, '28800', 'ram_img/ram_stick.jpg', 'LfaEc8M9'),
(99, '1', 1406004445, 'ASUS Prime X570-Pro ATX Motherboard', '9499', 9, '85491', 'board_img/board.jpg', 'LfaEc8M9'),
(107, '1', 1236668675, 'ASUS Prime X570-Pro ATX Motherboard', '9499', 5, '47495', 'board_img/board.jpg', 'Elexis21');

-- --------------------------------------------------------

--
-- Table structure for table `ram`
--

CREATE TABLE `ram` (
  `id` int(11) NOT NULL,
  `capacity_gb` int(11) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `speed_mhz` varchar(10) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `images` varchar(255) NOT NULL,
  `i_id` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registration_user`
--

CREATE TABLE `registration_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `user_images` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `birth_month` varchar(255) NOT NULL,
  `birth_date` varchar(255) NOT NULL,
  `birth_year` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `payment_mode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration_user`
--

INSERT INTO `registration_user` (`id`, `username`, `email`, `password`, `user_id`, `fullname`, `user_images`, `phone_number`, `gender`, `birth_month`, `birth_date`, `birth_year`, `address`, `payment_mode`) VALUES
(80, 'Princess', 'elexis.falceso.dit.cvsu@gmail.com', '1231231010', 0, 'Princess Falceso', 'img/elexis.jpg', '9505934815', 'male', '01', '21', '1998', 'Dasmariñas Cavite', 'COD'),
(81, 'Elexis21', 'elexis.falceso@cvsu.edu.ph', '$2y$10$I9rL/cMiF/Cz./jPM2fuk.sQ5/J72OhiCsbVZLIQ6TRhHRsSi.qVa', 0, 'Elexis Falceso', 'img/elexis.jpg', '2147483647', 'male', '01', '21', '1998', 'Dasmariñas Cavite', 'COD'),
(82, 'Mu004h9U', 'elexis.falceso.dit.cvsu@gmail.com', '$2y$10$lu00/WHFChDrU6qsDQKpaOvlkQGFu76xSL7ZNIKSA.ZjL3/EAYbE.', 0, '', '', '0', '', '', '', '', '', ''),
(83, 'YMFNNtC1', 'elexis.falceso.dit.cvsu@gmail.com', '$2y$10$wkCxxsYqvVnZsqR1POLeSuYA4c/lq4q9pTmQcE5aHrrN28O/KHsUi', 41, '', '', '', '', '', '', '', '', ''),
(84, 'MPyyMhpy', 'elexis.falceso@cvsu.edu.ph', '$2y$10$ThxdlLZEoBU1L5U7Pevl9.vAVbvIkwvbLRhfCYiN67K5n4TT7faKO', 69627, '', '', '', '', '', '', '', '', ''),
(85, 'SljJG0iw', 'elexis.falceso@cvsu.edu.ph', '$2y$10$/wGrrM8yyHuQMVcKDMBWyO.HzHyMwwdBkEUom19.zOulINUFPyXdO', 0, '', '', '', '', '', '', '', '', ''),
(86, 'AiFyb5By', 'elexis.falceso.dit.cvsu@gmail.com', '$2y$10$wQLohMJtGCXtBx/TQGTv1uKs2B7AzDK73U1zXEsWvZ.4DxoDgbpK2', 458, '', '', '', '', '', '', '', '', ''),
(87, 'UbR04B2T', 'elexis.falceso@cvsu.edu.ph', '$2y$10$NYKYZRvd6EEziaIs6X1XaOoJAp6.LRHm/7M75MSywg2.PJ4mrA68K', 0, '', '', '', '', '', '', '', '', ''),
(88, 'Vw7c0orC', 'elexis.falceso.dit.cvsu@gmail.com', '$2y$10$GewamzHb0e8JYHdlMYyUgOTSr2vFKhNHQqhGAenLSorBtQbXTdyBW', 0, '', '', '', '', '', '', '', '', ''),
(89, 'PNJaFn9L', 'elexis.falceso21@cvsu.edu.ph', '$2y$10$NjH7w9HnLjyJ2VrLPgjFduTGLyuWpO0qm2ZR1qLUO1PP5KTWF3jo2', 0, '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `shipping_address` text DEFAULT NULL,
  `billing_address` text DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `payment_information` text DEFAULT NULL,
  `preferences` text DEFAULT NULL,
  `security_question` varchar(255) DEFAULT NULL,
  `security_answer` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_to_cart`
--
ALTER TABLE `add_to_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `case`
--
ALTER TABLE `case`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `motherboards`
--
ALTER TABLE `motherboards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mobo_id` (`i_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ram`
--
ALTER TABLE `ram`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ram_id` (`i_id`);

--
-- Indexes for table `registration_user`
--
ALTER TABLE `registration_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_to_cart`
--
ALTER TABLE `add_to_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `motherboards`
--
ALTER TABLE `motherboards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `ram`
--
ALTER TABLE `ram`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `registration_user`
--
ALTER TABLE `registration_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `motherboards`
--
ALTER TABLE `motherboards`
  ADD CONSTRAINT `motherboards_ibfk_1` FOREIGN KEY (`i_id`) REFERENCES `files` (`category_id`);

--
-- Constraints for table `ram`
--
ALTER TABLE `ram`
  ADD CONSTRAINT `ram_ibfk_1` FOREIGN KEY (`i_id`) REFERENCES `files` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
