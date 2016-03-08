-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2016 at 03:13 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.3

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
  `code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `majorname` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `major`
--

INSERT INTO `major` (`code`, `majorname`) VALUES
('1', 'Đào tạo từ xa'),
('11', 'Toán tin'),
('12', 'CNTT'),
('13', 'Vật Lý'),
('14', 'Hóa học'),
('15', 'Sinh học'),
('16', 'Địa chất'),
('17', 'Môi trường'),
('18', 'CN Sinh'),
('19', 'Vật liệu'),
('20', 'ĐT Viễn thông'),
('21', 'Hải Dương'),
('22', 'CN Môi trường'),
('23', 'KT Hạt nhân'),
('3', 'Cao học'),
('41', 'HC CNTT'),
('42', 'HC CNTT'),
('5', 'Đào tạo từ xa'),
('51', 'Chương trình TT'),
('52', 'CT Việt Pháp'),
('53', 'CT Chất lượng cao'),
('58', 'ITEC - QTKD'),
('59', 'ITEC - CNTT'),
('60', 'CĐ CNTT'),
('61', 'CĐ CNTT'),
('8', 'Đào tạo từ xa'),
('B', 'Cán bộ'),
('C', 'Cao học'),
('N', 'Ngoài trường');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `studentid` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `majorname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `registerdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`studentid`, `fullname`, `majorname`, `registerdate`) VALUES
('1213059', 'Nguyễn Duy Hoàng Minh', 'Vật Lý', '2016-03-03 15:44:24'),
('1217094', 'Nguyễn Thị Thanh Huệ', 'Môi trường', '2016-03-03 15:44:24'),
('1217126', 'Nguyễn ThịLoan', 'Môi trường', '2016-03-03 15:44:24'),
('1217137', 'Hồ Thị Lý', 'Môi trường', '2016-03-03 15:44:24'),
('1312032', 'Nguyễn HữuBảo', 'CNTT', '2016-03-03 15:44:24'),
('1312227', 'Lê Xuân Hồng', 'CNTT', '2016-03-03 15:44:24'),
('1312347', 'Đặng ThànhLuân', 'CNTT', '2016-03-03 15:44:24'),
('1312352', 'Phạm Song Lương', 'CNTT', '2016-03-03 15:44:24'),
('1312635', 'Nguyễn ĐứcTrung', 'CNTT', '2016-03-03 15:44:24'),
('1312659', 'Lê QuangTuấn', 'CNTT', '2016-03-03 15:44:24'),
('1312690', 'Mạc Thị Kiều Vận', 'CNTT', '2016-03-03 15:44:24'),
('1313224', 'Chí ĐàoAnh', 'Vật Lý', '2016-03-03 15:44:24'),
('1315403', 'Lê Văn Quý', 'Sinh học', '2016-03-03 15:44:24'),
('1315566', 'Trần Phi Trung', 'Sinh học', '2016-03-03 15:44:24'),
('1316117', 'Trần Hoàng Lâm', 'Địa chất', '2016-03-03 15:44:24'),
('1316151', 'Nguyễn Văn Nam', 'Địa chất', '2016-03-03 15:44:24'),
('1316175', 'Nguyễn Thị Ái Như', 'Địa chất', '2016-03-03 15:44:24'),
('1316193', 'Nguyễn Chí Phúc', 'Địa chất', '2016-03-03 15:44:24'),
('1316236', 'Đặng Thanh Thanh', 'Địa chất', '2016-03-03 15:44:24'),
('1316286', 'Nguyễn Hồ Trọng Tiến', 'Địa chất', '2016-03-03 15:44:24'),
('1316299', 'Hoàng Thị Minh Trang', 'Địa chất', '2016-03-03 15:44:24'),
('1316318', 'Nguyễn Nhựt Trường', 'Địa chất', '2016-03-03 15:44:24'),
('1316321', 'Bùi Khắc Tuấn', 'Địa chất', '2016-03-03 15:44:24'),
('1316325', 'Lê Công Tú', 'Địa chất', '2016-03-03 15:44:24'),
('1316326', 'Mã Anh Tú', 'Địa chất', '2016-03-03 15:44:24'),
('1316338', 'Đào Tuấn Vũ', 'Địa chất', '2016-03-03 15:44:24'),
('1316340', 'Hồ AnhVũ', 'Địa chất', '2016-03-03 15:44:24'),
('1316344', 'Nguyễn Trương Thanh Vũ', 'Địa chất', '2016-03-03 15:44:24'),
('1318049', 'Đặng Thị Mỹ Duyên', 'CN Sinh', '2016-03-03 15:44:24'),
('1318251', 'Trần Thị Ngọc', 'CN Sinh', '2016-03-03 15:44:24'),
('1318315', 'Phạm Thị Mộng Quỳnh', 'CN Sinh', '2016-03-03 15:44:24'),
('1461100', 'Lê Vĩnh Tuyến', 'CĐ CNTT', '2016-03-03 15:44:24'),
('1461321', 'Nguyễn Phú Hảo', 'CĐ CNTT', '2016-03-03 15:44:25'),
('1553001', 'Nguyễn Quốc Bảo', 'CT Chất lượng cao', '2016-03-03 15:44:24'),
('1553002', 'Lê Công Cảnh', 'CT Chất lượng cao', '2016-03-03 15:44:24'),
('1553003', 'Liêu Hy Chánh', 'CT Chất lượng cao', '2016-03-03 15:44:24'),
('1553004', 'Võ Hoàng Chương', 'CT Chất lượng cao', '2016-03-03 15:44:24'),
('1553005', 'Ngô Xuân Cường', 'CT Chất lượng cao', '2016-03-03 15:44:24'),
('1553006', 'Hồ Thành Đạt', 'CT Chất lượng cao', '2016-03-03 15:44:24'),
('1553007', 'Nguyễn Thanh Dự', 'CT Chất lượng cao', '2016-03-03 15:44:24'),
('1553008', 'Lâm Hoàng Dũng', 'CT Chất lượng cao', '2016-03-03 15:44:24'),
('1553009', 'Tôn Thất Bảo Hân', 'CT Chất lượng cao', '2016-03-03 15:44:24'),
('1553010', 'Trần Công Hậu', 'CT Chất lượng cao', '2016-03-03 15:44:24'),
('1553011', 'Trần Đức Hiếu', 'CT Chất lượng cao', '2016-03-03 15:44:24'),
('1553013', 'Huỳnh Xuân Khánh', 'CT Chất lượng cao', '2016-03-03 15:44:24'),
('1553014', 'Nguyễn Trần Quốc Khánh', 'CT Chất lượng cao', '2016-03-03 15:44:24'),
('1553015', 'Nguyễn Đăng Khoa', 'CT Chất lượng cao', '2016-03-03 15:44:24'),
('1553017', 'Trần Đình Khoa', 'CT Chất lượng cao', '2016-03-03 15:44:24'),
('1553018', 'Nguyễn Hữu Khôi', 'CT Chất lượng cao', '2016-03-03 15:44:24'),
('1553019', 'Hoa Minh Luân', 'CT Chất lượng cao', '2016-03-03 15:44:24'),
('1553021', 'Nguyễn Sĩ Nhân', 'CT Chất lượng cao', '2016-03-03 15:44:24'),
('1553022', 'Nguyễn Trung Nhân', 'CT Chất lượng cao', '2016-03-03 15:44:24'),
('1553023', 'Trần Gia Trọng Nhân', 'CT Chất lượng cao', '2016-03-03 15:44:24'),
('1553024', 'Lê Thanh Phong', 'CT Chất lượng cao', '2016-03-03 15:44:24'),
('1553025', 'Tiêu Vĩnh Phong', 'CT Chất lượng cao', '2016-03-03 15:44:24'),
('1553026', 'Nguyễn Phan Minh Phú', 'CT Chất lượng cao', '2016-03-03 15:44:24'),
('1553028', 'Lý Thiết Quang', 'CT Chất lượng cao', '2016-03-03 15:44:24'),
('1553029', 'Khưu Minh Tâm', 'CT Chất lượng cao', '2016-03-03 15:44:24'),
('1553030', 'Nguyễn Lê Tâm', 'CT Chất lượng cao', '2016-03-03 15:44:24'),
('1553031', 'Huỳnh Hán Thành', 'CT Chất lượng cao', '2016-03-03 15:44:24'),
('1553032', 'Nguyễn Văn Quan Thịnh', 'CT Chất lượng cao', '2016-03-03 15:44:24'),
('1553033', 'Nguyễn Trung Tín', 'CT Chất lượng cao', '2016-03-03 15:44:24'),
('1553034', 'Đặng Văn Triển', 'CT Chất lượng cao', '2016-03-03 15:44:24'),
('1553035', 'Trần Quốc Thái Triều', 'CT Chất lượng cao', '2016-03-03 15:44:24'),
('1553036', 'Nguyễn Xuân Hoàng Tú', 'CT Chất lượng cao', '2016-03-03 15:44:24'),
('1553037', 'Trần Trịnh Quốc Việt', 'CT Chất lượng cao', '2016-03-03 15:44:24'),
('1560105', 'Nguyễn Ngọc Dũng', 'CĐ CNTT', '2016-03-03 15:44:24'),
('1560529', 'Lê Tự Quốc Thắng', 'CĐ CNTT', '2016-03-03 15:44:24'),
('1560705', 'Nguyễn Hoàng Lâm', 'CĐ CNTT', '2016-03-03 15:44:24');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `room` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `room`) VALUES
('admin', 'admin', 'admin'),
('linhtrung', 'linhtrung', 'linhtrung'),
('luuhanh', 'luuhanh', 'luuhanh'),
('thamkhao', 'thamkhao', 'thamkhao');

-- --------------------------------------------------------

--
-- Table structure for table `visit`
--

CREATE TABLE `visit` (
  `visitid` int(11) NOT NULL,
  `studentid` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `major` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` datetime NOT NULL,
  `room` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `visit`
--

INSERT INTO `visit` (`visitid`, `studentid`, `major`, `timestamp`, `room`) VALUES
(70, '1461100', 'CĐ CNTT', '2016-03-08 16:38:29', 'linhtrung'),
(71, '1461100', 'CĐ CNTT', '2016-03-08 18:55:28', 'linhtrung'),
(72, '1461100', 'CĐ CNTT', '2016-03-08 18:55:51', 'linhtrung'),
(73, '1461100', 'CĐ CNTT', '2016-03-08 19:07:21', 'thamkhao'),
(74, '1461100', 'CĐ CNTT', '2016-03-08 19:28:36', 'thamkhao'),
(75, '1461100', 'CĐ CNTT', '2016-03-08 19:30:00', 'thamkhao'),
(76, '1461100', 'CĐ CNTT', '2016-03-08 19:32:22', 'thamkhao'),
(77, '1461100', 'CĐ CNTT', '2016-03-08 19:32:43', 'thamkhao'),
(78, '1461100', 'CĐ CNTT', '2016-03-08 20:13:38', 'thamkhao'),
(79, '1461100', 'CĐ CNTT', '2016-03-08 20:14:31', 'thamkhao'),
(80, '1461100', 'CĐ CNTT', '2016-03-08 20:15:05', 'thamkhao'),
(81, '1461100', 'CĐ CNTT', '2016-03-08 20:16:31', 'thamkhao'),
(82, '1461100', 'CĐ CNTT', '2016-03-08 20:20:18', 'thamkhao');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `major`
--
ALTER TABLE `major`
  ADD PRIMARY KEY (`code`);

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
-- AUTO_INCREMENT for table `visit`
--
ALTER TABLE `visit`
  MODIFY `visitid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
