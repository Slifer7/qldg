-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2016 at 12:56 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qldg`
--

-- --------------------------------------------------------

--
-- Table structure for table `major`
--

CREATE TABLE `major` (
  `majorid` int(11) NOT NULL,
  `code` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `majorname` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `major`
--

INSERT INTO `major` (`majorid`, `code`, `majorname`) VALUES
(1, '41', 'HC CNTT'),
(2, '42', 'HC CNTT'),
(3, '60', 'CĐ CNTT'),
(4, '61', 'CĐ CNTT'),
(5, '11', 'Toán tin'),
(6, '12', 'CNTT'),
(7, '13', 'Vật lý'),
(8, '14', 'Hóa học'),
(9, '15', 'Sinh học'),
(10, '16', 'Địa chất'),
(11, '17', 'Môi trường'),
(12, '18', 'CN Sinh'),
(13, '19', 'Vật liệu'),
(14, '20', 'ĐT Viễn thông'),
(15, '21', 'Hải dương'),
(16, '22', 'CN môi trường'),
(17, '23', 'KT Hạt nhân'),
(18, '51', 'Chương trình TT'),
(19, '52', 'CT Việt Pháp'),
(20, '53', 'CT Chất lượng cao'),
(21, '58', 'ITEC - QTKD'),
(22, '59', 'ITEC - CNTT'),
(23, '3', 'Cao học'),
(24, 'C', 'Cao học'),
(25, 'B', 'Cán bộ'),
(26, 'N', 'Ngoài trường'),
(27, '1', 'Đào tạo từ xa'),
(28, '5', 'Đào tạo từ xa'),
(29, '8', 'Đào tạo từ xa');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `studentid` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `majorname` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`studentid`, `fullname`, `majorname`) VALUES
('1461100', 'Lê Vĩnh Tuyến', 'CĐ CNTT');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `rolename` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `rolename`) VALUES
('admin', 'admin', 'admin'),
('linhtrung', 'linhtrung', 'quanly');

-- --------------------------------------------------------

--
-- Table structure for table `visit`
--

CREATE TABLE `visit` (
  `visitid` int(11) NOT NULL,
  `studentid` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `major` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `visit`
--

INSERT INTO `visit` (`visitid`, `studentid`, `major`, `timestamp`) VALUES
(1, 'A', 'Test', '2016-02-24 08:31:42'),
(2, 'B', 'Bsd', '2016-02-24 09:14:25'),
(3, 'C', 'sfsdf', '2016-02-23 10:36:30'),
(4, 'D', 'fdfda', '2016-02-24 11:18:39'),
(5, '1212111', 'CNTT', '2016-02-25 08:10:28'),
(7, '123', 'CĐ CNTT', '2016-02-25 10:13:06'),
(8, '12456', 'Hóa học', '2016-02-25 10:43:31'),
(9, '12389', 'Địa chất', '2016-02-25 10:43:52'),
(10, '12147', 'CĐ CNTT', '2016-02-25 10:59:52'),
(11, '378', 'Toán tin', '2016-02-25 11:56:36'),
(12, '379', 'Hải dương', '2016-02-25 11:58:02'),
(13, '380', 'KT Hạt nhân', '2016-02-25 11:58:28'),
(14, '123', 'Toán tin', '2016-02-26 09:29:35'),
(15, '124', 'CĐ CNTT', '2016-02-26 09:31:20'),
(16, '125', 'Vật liệu', '2016-02-26 09:34:40'),
(17, '126', 'ĐT Viễn thông', '2016-02-26 09:34:59'),
(18, '127', 'CĐ CNTT', '2016-02-26 09:51:57'),
(19, '128', 'CNTT', '2016-02-26 10:01:17'),
(20, '126', 'Vật lý', '2016-02-26 10:10:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `major`
--
ALTER TABLE `major`
  ADD PRIMARY KEY (`majorid`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`studentid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `visit`
--
ALTER TABLE `visit`
  ADD PRIMARY KEY (`visitid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `major`
--
ALTER TABLE `major`
  MODIFY `majorid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `visit`
--
ALTER TABLE `visit`
  MODIFY `visitid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
