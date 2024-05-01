-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2024 at 11:50 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_banking`
--

-- --------------------------------------------------------

--
-- Table structure for table `transaction_table`
--

CREATE TABLE `transaction_table` (
  `transaction_id` bigint(13) NOT NULL,
  `account_number` bigint(20) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL,
  `to_account_number` bigint(12) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_table`
--

INSERT INTO `transaction_table` (`transaction_id`, `account_number`, `amount`, `to_account_number`, `date_time`) VALUES
(2095098810211, 537145866765, 100, 208234973677, '2023-08-06 19:02:24'),
(2403986099348, 537145866765, 500, 208234973677, '2024-04-15 08:45:14'),
(2801034548742, 537145866765, 1000, 208234973677, '2023-05-01 12:32:18'),
(2903962355098, 10001, 10000, 208234973677, '2023-05-10 08:18:21'),
(3039732629899, 10001, 10000, 850555649541, '2023-05-10 07:55:10'),
(3068901981968, 10001, 1000, 120178706850, '2023-05-02 18:36:03'),
(3124533610313, 208234973677, 100, 537145866765, '2023-07-25 12:36:48'),
(4053774519855, 10001, 1000, 537145866765, '2024-04-15 08:52:55'),
(4330586783395, 537145866765, 1000, 208234973677, '2023-05-01 12:27:52'),
(4356358735159, 208234973677, 500, 537145866765, '2023-05-01 18:59:29'),
(4871800670623, 208234973677, 1000, 537145866765, '2023-05-01 12:22:14'),
(6307162583525, 10001, 1000, 208234973677, '2024-04-15 08:52:38'),
(6310677716965, 208234973677, 1000, 537145866765, '2023-05-01 12:31:21'),
(6487291473485, 208234973677, 2000, 537145866765, '2023-05-01 11:42:05'),
(6684799914918, 537145866765, 100, 537145866765, '2023-08-06 19:01:38'),
(6693077662159, 10001, 10000, 208234973677, '2023-05-01 11:41:40'),
(7740040823572, 208234973677, 500, 537145866765, '2023-05-01 19:06:00'),
(9017046099128, 10001, 100, 208234973677, '2023-07-25 12:34:41'),
(9195181319376, 10001, 2000, 537145866765, '2023-05-01 12:33:22'),
(9980180404729, 208234973677, 1000, 537145866765, '2023-05-01 12:32:46');

-- --------------------------------------------------------

--
-- Table structure for table `user_application_table`
--

CREATE TABLE `user_application_table` (
  `account_number` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `mobile_number` bigint(10) NOT NULL,
  `email` varchar(25) NOT NULL,
  `address` text NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(20) NOT NULL,
  `account_bal` int(11) DEFAULT NULL,
  `no_of_transactions` int(11) DEFAULT NULL,
  `activate_flag` varchar(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_application_table`
--

INSERT INTO `user_application_table` (`account_number`, `name`, `mobile_number`, `email`, `address`, `dob`, `password`, `account_bal`, `no_of_transactions`, `activate_flag`) VALUES
(10001, 'Admin', 9959883787, 'abc123@gmail.com', 'Ainavolu, Amaravathi, Andhrapradesh. 521301', '2000-11-02', 'password123', 0, 0, 'Y'),
(208234973677, 'Niteesh', 7981947819, 'niteeshch57@gmail.com', 'santhi nagar 4th line, Gudivada, AndhraPradesh. 521301', '2003-10-28', 'Niteesh#07', 2147483647, 17, 'Y'),
(537145866765, 'ram', 9963251459, 'ram123@gmail.com', 'santhi nagar 4th line, Gudivada, AndhraPradesh. 521301', '2000-11-03', 'password123', 7700, 14, 'Y'),
(741782216907, 'Prasanna', 9944323421, 'prasanna123@gmail.com', 'Vijayawada, Krishna, Andhra Pradesh. ', '2003-08-29', 'password123', 0, 0, 'N');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transaction_table`
--
ALTER TABLE `transaction_table`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `Test` (`account_number`);

--
-- Indexes for table `user_application_table`
--
ALTER TABLE `user_application_table`
  ADD PRIMARY KEY (`account_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_application_table`
--
ALTER TABLE `user_application_table`
  MODIFY `account_number` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000000000;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaction_table`
--
ALTER TABLE `transaction_table`
  ADD CONSTRAINT `Test` FOREIGN KEY (`account_number`) REFERENCES `user_application_table` (`account_number`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
