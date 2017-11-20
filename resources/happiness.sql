-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 20, 2017 at 01:58 PM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id3639174_happiness`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `first_name`, `last_name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Victor', 'Irechukwu', 'victor@happiness.com', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '13/11/2017', '');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `chatfuel_user_id` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `conversation` text NOT NULL COMMENT 'conversation details are stored as json string',
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `governors`
--

CREATE TABLE `governors` (
  `id` int(11) NOT NULL,
  `state` varchar(255) NOT NULL,
  `governor` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `governors`
--

INSERT INTO `governors` (`id`, `state`, `governor`) VALUES
(1, 'Abia', 'Okezie Ikpeazu'),
(2, 'Adamawa', 'Bindo Jibrilla'),
(3, 'Akwa-Ibom', 'Udom Gabriel Emmanuel'),
(4, 'Anambra', 'Willie Obiano'),
(5, 'Bauchi', 'Mohammed Abdullahi Abubakar'),
(6, 'Bayelsa', 'Henry Dickson'),
(7, 'Benue', 'Samuel Ortom'),
(8, 'Borno', 'Kashim Shettima'),
(9, 'Cross River', 'Benedict Ayade'),
(10, 'Delta', 'Ifeanyi Okowa'),
(11, 'Ebonyi', 'Dave Umahi'),
(12, 'Edo', 'Godwin Obaseki'),
(13, 'Ekiti', 'Ayo Fayose'),
(14, 'Enugu', 'Ifeanyi Ugwuanyi'),
(15, 'Gombe', 'Ibrahim Hassan Dankwambo'),
(16, 'Imo', 'Owelle Rochas Okorocha'),
(17, 'Jigawa', 'Badaru Abubakar'),
(18, 'Kaduna', 'Nasir Ahmad el-Rufai'),
(19, 'Kano', 'Abdullahi Umar Ganduje'),
(20, 'Katsina', 'Aminu Bello Masari'),
(21, 'Kebbi', 'Abubakar Atiku Bagudu'),
(22, 'Kogi', 'Yahaya Bello'),
(23, 'Kwara', 'Abdulfatah Ahmed'),
(24, 'Lagos', 'Akinwunmi Ambode'),
(25, 'Nassarawa', 'Umaru Tanko Al-Makura'),
(26, 'Niger', 'Abubakar Sani Bello'),
(27, 'Ogun', 'Ibikunle Oyelaja Amosun'),
(28, 'Ondo', 'Oluwarotimi Odunayo Akeredolu'),
(29, 'Osun', 'Rauf Aregbesola'),
(30, 'Oyo', 'Isiaka Abiola Ajimobi'),
(31, 'Plateau', 'Simon Lalong'),
(32, 'Rivers', 'Ezenwo Nyesom Wike'),
(33, 'Sokoto', 'Aminu Waziri Tambuwal'),
(34, 'Taraba', 'Arch. Darius Ishaku'),
(35, 'Yobe', 'Ibrahim Geidam'),
(36, 'Zamfara', 'Abdul-Aziz Yari Abubakar'),
(37, 'FCT', 'THIS IS THE FEDERAL CAPITAL');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
