-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2024 at 07:25 AM
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
-- Database: `flashcard_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_card`
--

CREATE TABLE `tbl_card` (
  `tbl_card_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_card`
--

INSERT INTO `tbl_card` (`tbl_card_id`, `question`, `answer`) VALUES
(2, 'What is HTML stands for?', 'How To Make Lumpia adadadas da asd asd asds asda sdas d asd aa dasadsa sada dasd asds'),
(3, 'CSS is the acronym of?', 'Cascading Style Sheets adklja;ssssssssssssssssssssssssssssssssssssssssssssadad');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_card`
--
ALTER TABLE `tbl_card`
  ADD PRIMARY KEY (`tbl_card_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_card`
--
ALTER TABLE `tbl_card`
  MODIFY `tbl_card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
