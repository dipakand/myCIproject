-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2021 at 11:48 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xlit1`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand_master`
--

CREATE TABLE `brand_master` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `bill_name` varchar(100) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gst` varchar(100) NOT NULL,
  `pan_no` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `user` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `date_time` datetime NOT NULL,
  `retail_m` decimal(10,2) NOT NULL,
  `db_m` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand_master`
--

INSERT INTO `brand_master` (`id`, `name`, `bill_name`, `contact_no`, `email`, `gst`, `pan_no`, `address`, `user`, `date`, `date_time`, `retail_m`, `db_m`) VALUES
(1, 'L G ', 'LG pvt ltd', '1111111111', 'lg@gmail.com', 'LGJG56JJ659345JKDV', 'CDSPD3456H', 'plot no 56 nagpur M.H. ', 'admin', '2019-01-25', '2019-01-25 11:30:04', '0.70', '0.94'),
(2, 'SAMSUNG ', 'samsung india pvt ltd', '1111111111', 'samsung@gmail.com', 'JFKJDF74578478JJDDHH', 'JFGHV3456H', 'plot no 45 trimurti nagar nagpur M.H. ', 'admin', '2019-01-25', '2019-01-25 11:31:52', '0.75', '0.94'),
(3, 'TITAN ', 'titan india pvt ltd ', '1111111111', 'titan@gmail.com', 'JKF5778GNJJHR7788', 'DFGCV34788H', 'plot no 45 nagpur butibori maharashtra pin 444345 ', 'admin', '2019-01-25', '2019-01-25 11:55:27', '0.70', '0.94'),
(4, 'mahalaxmi ', 'mahalaxmi traders', '0712665231', 'm@gmail.com', 'zasfgdgffdgdf', 'CSDDFRT4567JJ', 'PLLONO 6767 NAGPUR', 'admin', '2019-01-31', '2019-01-31 12:04:39', '0.00', '0.00'),
(5, 'Godrej', 'godrej', '4984854848', 'g@gmail.com', '545444', '95955959595', 'ygjuhygujg', 'admin', '2019-05-22', '2019-05-22 12:24:40', '0.00', '0.00'),
(6, 'apple ', 'apple ltd', '1541654651', 'apple@gmai.com', ' ', ' ', 'plot no 67 ', 'admin', '2019-05-22', '2019-05-22 12:34:23', '0.00', '0.00'),
(7, 'apple ', 'apple ttd ', '1261651651', 'apple@gmail.com', 'gfjkgfd34785', ' 4445253526', 'plot no 67 nagpur', 'admin', '2019-05-22', '2019-05-22 12:36:10', '0.00', '0.00'),
(8, 'olivia', 'olivia antibactarial', '9503916657', 'priyabansod20@gmail.com', '5', '1254632541', 'plot no.10 trimurti nagar nagpur.', 'admin', '2020-09-07', '2020-09-07 11:05:17', '0.00', '0.00'),
(9, 'oppo', 'mobile company', '9503916657', 'oppo23@gmail.com', '12', '2548635246', 'plot no. 30 trimurti nagar, jaitala road,\r\nnagpur.', 'admin', '2020-09-07', '2020-09-07 11:08:22', '0.00', '0.00'),
(10, 'vivo', 'vivo', '9503916657', 'vivo35@gmail.com', '12', '2548754852', 'hdgfsjfhre', 'admin', '2020-09-07', '2020-09-07 11:20:08', '0.00', '0.00'),
(11, 'realme', ' mobile', '3659458245', 'realme3@gmail.com', '12', '2548658458', 'suidsf', 'admin', '2020-09-07', '2020-09-07 11:27:20', '0.00', '0.00'),
(12, 'realme', 'realme', '9503916657', 'real23@gmail.com', '12', '5698569856', 'plot no. 40 trimurti nagar, jaitala road \r\nnagpur.', 'admin', '2020-09-07', '2020-09-07 11:30:55', '0.00', '0.00'),
(13, 'LED', 'LED', '9503916657', 'led34@gmail.com', '12', '5486587584', 'xgtftgve', 'admin', '2020-09-07', '2020-09-07 11:50:21', '0.00', '0.00'),
(14, 'samsung', 'samsung', '9096404311', 'samsung2@gmail.com', '7635', '8746537654', 'plot no.30 cosmos town, near deshpande clinic,\r\njaitala road nagpur.', 'admin', '2020-09-07', '2020-09-07 15:54:21', '0.00', '0.00'),
(15, 'sony', 'sony', '9096404311', 'sony23@gmail.com', '7845', '8569247365', 'Nagpur', 'admin', '2020-09-08', '2020-09-08 09:55:47', '0.00', '0.00'),
(16, 'samsung', 'samsung', '9503916657', 'samsung3@gmail.com', '635437', '9584569562', 'nagpur', 'admin', '2020-09-08', '2020-09-08 12:45:14', '0.00', '0.00'),
(17, 'Lenovo', 'Lenovo', '9507564838', 'lenovo2@gmail.com', '23456', '5476876546', 'nagpur', 'admin', '2020-09-08', '2020-09-08 17:56:24', '0.00', '0.00'),
(18, 'whirlpool', 'whirlpool', '9898989898', 'whirlpool4@gmail.com', '2435', '7645387637', 'Nagpur', 'admin', '2020-09-08', '2020-09-08 18:12:32', '0.00', '0.00'),
(19, 'Roberts', 'Roberts', '5347654876', 'robers1@gmail.com', '27bvcgf7654b7z6', '6543876547', 'Nagpur', 'admin', '2020-09-08', '2020-09-08 18:26:13', '0.00', '0.00'),
(20, 'Rolex', 'Rolex', '8390569568', 'rolex35@gmail.com', '4884783', '8746546783', 'Nagpur', 'admin', '2020-09-08', '2020-09-08 18:32:28', '0.00', '0.00'),
(21, 'xiaomi', 'xiaomi', '4768759457', 'xiaomi3@gmail.com', '27gsbdf2345byze', '6758495867', 'Nagpur', 'admin', '2020-09-11', '2020-09-11 13:09:51', '0.00', '0.00'),
(22, 'Honar', 'Honar', '8390567465', 'honar2@gmail.com', '27vbdgt7654b7z3', '8765984576', 'Nagpur', 'admin', '2020-09-11', '2020-09-11 13:28:21', '0.00', '0.00'),
(23, 'Dell', 'Dell', '9096839056', 'dell54@gmail.com', '27nbghy2345b9z4', '7564875487', 'Nagpur', 'admin', '2020-09-11', '2020-09-11 13:34:47', '0.00', '0.00'),
(24, 'oneplus', 'oneplus', '7476543833', 'oneplus2@gmail.com', '27bcvgf6543v6z5', '1457865254', 'Nagpur', 'admin', '2020-09-17', '2020-09-17 15:29:44', '0.00', '0.00'),
(25, 'Canon', 'Canon', '9887876868', 'canon6@gmail.com', '27bvcgd2345n7z7', '5869589565', 'Nagpur', 'admin', '2020-09-17', '2020-09-17 15:57:19', '0.00', '0.00'),
(26, 'Xiaomi', 'xiaomi', '9847548774', 'xiaomi2@gmail.com', '27dhfgr7564byzt', '9847564637', 'Nagpur', 'admin', '2020-09-17', '2020-09-17 16:00:31', '0.00', '0.00'),
(27, 'POCO', 'poco', '9758958398', 'poco3@gmail.com', '27gdure7438byzt', '9574984476', 'nagpur', 'admin', '2020-09-25', '2020-09-25 11:47:45', '0.00', '0.00'),
(28, 'iFFALCON', 'iFFALCON', '9798773749', 'iffalcon7@gmai.com', '27gdfdj7433byzu', '9747394933', 'nagpur', 'admin', '2020-09-25', '2020-09-25 12:23:19', '0.00', '0.00'),
(29, 'xaiomi', 'xaiomi', '9979459459', 'x3@gmail.com', '12', '5343536463', 'nagpur', 'admin', '2020-10-12', '2020-10-12 10:58:19', '0.00', '0.00'),
(30, 'poco', 'poco', '9745797495', 'p4@gmail.com', '27yrteg5342vrze', '7638473847', 'nagpur', 'admin', '2020-10-21', '2020-10-21 17:50:09', '0.00', '0.00'),
(31, 'Sony Ericson', 'nikki', '3216547896', 'a@gmail.com', '246535', '5464544696', 'Narendra Nagar', 'admin', '2020-10-28', '2020-10-28 12:22:37', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(60) NOT NULL,
  `user` varchar(20) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `user`, `datetime`) VALUES
(1, 'computer', 'admin', '2017-09-20 12:34:22'),
(2, 'tv', 'admin', '2017-09-20 12:34:22'),
(3, 'radio', 'admin', '2017-09-20 15:30:28'),
(4, 'washing machin', 'admin', '2017-09-20 15:30:28'),
(5, 'mobile', 'admin', '2017-09-20 17:49:45'),
(6, 'mobile watch', 'admin', '2017-09-20 17:49:45');

-- --------------------------------------------------------

--
-- Table structure for table `company_master`
--

CREATE TABLE `company_master` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `logo_image` text NOT NULL,
  `industry_type` varchar(50) NOT NULL,
  `company_city` varchar(50) NOT NULL,
  `company_state` int(11) NOT NULL,
  `postal_code` varchar(50) NOT NULL,
  `company_phone` varchar(50) NOT NULL,
  `website` varchar(50) NOT NULL,
  `gst_no` varchar(100) NOT NULL,
  `fs_no` varchar(200) NOT NULL,
  `company_address` text NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `show_email` varchar(50) NOT NULL,
  `footer_info` varchar(50) NOT NULL,
  `fssai_no` varchar(250) NOT NULL,
  `cd` int(11) NOT NULL,
  `tmc` text NOT NULL,
  `bank_details` text NOT NULL,
  `prefix` varchar(200) NOT NULL,
  `location` text NOT NULL,
  `bill_display_date` date NOT NULL,
  `barcode` int(11) NOT NULL,
  `passcode` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_master`
--

INSERT INTO `company_master` (`company_id`, `company_name`, `logo_image`, `industry_type`, `company_city`, `company_state`, `postal_code`, `company_phone`, `website`, `gst_no`, `fs_no`, `company_address`, `admin_email`, `show_email`, `footer_info`, `fssai_no`, `cd`, `tmc`, `bank_details`, `prefix`, `location`, `bill_display_date`, `barcode`, `passcode`) VALUES
(2, 'XL IT ITEM', 'user_images/904967_1565617293', 'IT', 'hyderabad', 22, '440002', '1234567890', 'xl@xlit.in', '516161666', '', '256, mou, hitman jo\r\n\r\n8908 256, mou, hitman jo\r\n\r\n8908 ', '', '', '', '', 10, 'Any issue raised will be Subject to Nagpur Jurisdiction., Management reserves te Right to Addmission.,NO REFUND  in any condition.', 'BOI*345634587645*BOI68394*37486783*', 'b', 'xlit1_wardha,xlit1_bhandara,xlit1_gondia,xlit1_amravati', '2020-10-15', 0, '12345');

-- --------------------------------------------------------

--
-- Table structure for table `creditor`
--

CREATE TABLE `creditor` (
  `id` int(11) NOT NULL,
  `party_id` int(11) NOT NULL,
  `return_date` date NOT NULL,
  `case_type` varchar(20) NOT NULL,
  `credit_type` text NOT NULL,
  `expiry_type` text NOT NULL,
  `credit_amt` varchar(255) NOT NULL,
  `user` varchar(20) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `footer`
--

CREATE TABLE `footer` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `logo_image` text NOT NULL,
  `industry_type` varchar(50) NOT NULL,
  `company_city` varchar(50) NOT NULL,
  `company_state` varchar(50) NOT NULL,
  `postal_code` varchar(50) NOT NULL,
  `company_phone` varchar(50) NOT NULL,
  `website` varchar(50) NOT NULL,
  `company_address` text NOT NULL,
  `footer_info` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `footer`
--

INSERT INTO `footer` (`company_id`, `company_name`, `logo_image`, `industry_type`, `company_city`, `company_state`, `postal_code`, `company_phone`, `website`, `company_address`, `footer_info`) VALUES
(1, 'xyz', 'user_images/594985_1498631667', 'user_images', 'nagpur', 'maharashtra', '440016', '999999999', 'www.xlitworks.in', 'nagpur', 'XL-IT-WORKS, All Rights Reserved');

-- --------------------------------------------------------

--
-- Table structure for table `hold_order`
--

CREATE TABLE `hold_order` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `items` text NOT NULL,
  `received` text NOT NULL,
  `inv_date` date NOT NULL,
  `inv_no` varchar(100) NOT NULL,
  `user` varchar(20) NOT NULL,
  `date_time` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `receipt` varchar(200) NOT NULL,
  `recev_status` int(11) NOT NULL,
  `return_item` text NOT NULL,
  `total_amt` varchar(250) NOT NULL,
  `receive_amt` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_party`
--

CREATE TABLE `manage_party` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(150) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state_id` int(11) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `landmark` varchar(100) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `contact_person` varchar(30) NOT NULL,
  `email_id` varchar(20) NOT NULL,
  `gst_in` varchar(20) NOT NULL,
  `limit_days` int(11) NOT NULL,
  `credit_type` varchar(255) NOT NULL,
  `user` varchar(20) NOT NULL,
  `date_time` datetime NOT NULL,
  `opening_date` date NOT NULL,
  `fssai_no` varchar(250) NOT NULL,
  `discount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manage_party`
--

INSERT INTO `manage_party` (`id`, `name`, `address`, `city`, `state_id`, `pincode`, `landmark`, `contact_no`, `contact_person`, `email_id`, `gst_in`, `limit_days`, `credit_type`, `user`, `date_time`, `opening_date`, `fssai_no`, `discount`) VALUES
(1, 'aa', 'gretrtfes', 'nagpur', 22, '', 'aaa', '3333322222', 'aa', 'a@gmail.com', '1212', 1, '0', 'admin', '2019-01-25 12:15:54', '0000-00-00', '', 5),
(2, 'bb', 'htyhrth', 'nagpur', 22, '550055', 'bbb', '6660000777', 'bb', 'b@gmail.com', '2224', 2, '', 'admin', '2019-01-25 12:17:18', '0000-00-00', '1234', 0),
(3, 'vinod pathak', 'plot no 67 kgn nagar near tukdoji putla ', 'nagpur', 22, '440012', '', '9894565615', 'vionod ', 'v@gmail.com', 'DFGFDHF4568FHF478584', 0, '0', 'admin', '2019-01-25 12:18:18', '0000-00-00', '', 0),
(4, 'rajesh raut', 'plot no 45 tilak nagar nagpur pin 440056', 'nagpur ', 22, '440056', 'bhumi land devoloper', '1234567890', '1234567890', 'rajesh@gmail.com', 'DFH75778H', 0, '0', 'admin', '2019-01-28 10:37:24', '0000-00-00', '788', 0),
(5, 'sunil', 'cosmos town ', 'nagpur', 22, '440022', 'new school', '1254887878', 'sunil', 's@gmail.com', 'DF43FF43445NN', 0, '0', 'admin', '2019-01-30 15:22:19', '0000-00-00', '7855', 0),
(7, 'shiv', 'syegau', 'nagpur', 5, '123123', 'asas', '9879879870', 'aa', 's@gmail.com', '11', 0, '0', 'admin', '2019-01-30 15:41:21', '0000-00-00', '', 0),
(9, 'ajay', 'dharampeth nagpur pin 440012 m.h ', '', 22, '440012', 'NEAR HIGH SCHOOL ', '1245367879', 'ajay', 'a@gmail.com', 'ZSARGGGRFRFV', 0, '5500', 'admin', '2019-02-01 11:08:57', '0000-00-00', '', 0),
(10, 'ramesh ', 'plot no 676 nagpur maharashtra pin 440023', 'nagpur', 14, '440023', 'hanuman mandir', '1238549677', 'ramesh', 'r@gmail.com', 'DHDSG4666326', 0, '0', 'admin', '2019-02-09 10:38:53', '0000-00-00', '', 0),
(11, 'hitesh ', 'plot no 56 sadar nagpur maharashtra pin 440089', 'nagpur', 22, '', 'hanuman mandir', '1848954545', 'hitesh', 'h@gmail.com', '', 0, '0', 'admin', '2019-03-20 09:49:45', '0000-00-00', '', 0),
(12, 'suraj', 'plot no 67 nagpur maharashtra', 'nagpur', 22, '440023', 'primary school ', '1564844545', 'suraj', 's@gmail.com', '', 0, '0', 'admin', '2019-03-27 14:01:09', '0000-00-00', '', 5),
(13, 'nishant', 'plot no 56 nagpur', 'nagpur', 22, '440022', 'primary school ', '1484545645', 'nishant', 'n@gmail.com', '', 0, '29393', 'admin', '2019-04-03 18:18:12', '0000-00-00', '1156', 0),
(14, 'abc', 'asdf', 'ngp', 22, '134566', 'asd', '1111111111', '', '', '', 0, '62001', 'admin', '2019-08-06 17:53:48', '0000-00-00', '', 0),
(16, 'moni', 'ftgfgcgh', 'nagpur', 22, '480001', 'Maharashtra', '3545446464', 'ankita', 's@gmail.com', '1236547894', 0, '', 'admin', '2019-08-06 17:59:22', '0000-00-00', '96869', 0),
(17, 'aq', 'trimurti nagar', 'nagpur', 22, '440022', '', '8888888888', '', '', '', 0, '0', 'admin', '2019-08-06 18:52:13', '0000-00-00', '', 0),
(18, 'akhilesh', 'town', 'nagpur', 22, '440022', 'kk', '1591591591', '', '', '', 0, '0', 'admin', '2019-08-10 14:32:09', '0000-00-00', '', 0),
(19, '111', 'nagpur', 'nagpur', 22, '480001', '', '9021204958', '', '', '', 0, '0', 'admin', '2019-08-10 15:26:14', '0000-00-00', '', 0),
(20, 'aa', 'aaaa', 'nagpur', 22, '480001', '', '7894561230', '', '', '', 0, '', 'admin', '2019-08-10 15:47:31', '0000-00-00', '', 0),
(21, 'Vinod Pathak', 'aaaa', 'nagpur', 22, '480001', '', '8787878878', '', '', '', 0, '0', 'admin', '2019-08-10 15:47:54', '0000-00-00', '', 0),
(22, 'asd', 'sadf', 'asd', 22, '121212', '', '5852584545', '', '', '', 0, '38700', 'admin', '2019-08-20 11:15:40', '0000-00-00', '', 0),
(23, 'Dipak', 'nagpur', 'Nagpur', 22, '480001', '', '1122445522', '', '', '', 0, '0', 'admin', '2019-08-20 13:31:41', '0000-00-00', '', 0),
(24, 'Ash', 'nagpur', 'Nagpur', 22, '480001', '', '1231231231', '', '', '', 0, '', 'admin', '2019-08-20 13:32:13', '0000-00-00', '', 0),
(25, 'shivani', 'nagpur', 'Nagpur', 22, '480001', '', '7441122541', '', '', '', 0, '0', 'admin', '2019-08-20 13:32:47', '0000-00-00', '', 10.5),
(27, 'abc', '', '', 22, '', '', '4563217898', '', '', '123', 0, '', '', '0000-00-00 00:00:00', '0000-00-00', '', 0),
(30, 'Mohan', '', '', 2, '', '', '7896541230', '', '', '123', 0, '', '', '0000-00-00 00:00:00', '0000-00-00', '', 0),
(33, 'Ajay', '', '', 1, '', '', '9874563210', '', '', '', 0, '', '', '0000-00-00 00:00:00', '0000-00-00', '', 0),
(46, 'Ganesh', '', '', 22, '', '', '9873214560', '', '', '123654', 0, '0', '', '0000-00-00 00:00:00', '0000-00-00', '', 0),
(54, 'Sumit', '', '', 4, '', '', '5556664447', '', '', '123654', 0, '', '', '0000-00-00 00:00:00', '0000-00-00', '', 0),
(55, 'Neha', '', '', 22, '', '', '9890461290', '', '', '7896541233', 0, '', '', '0000-00-00 00:00:00', '0000-00-00', '', 0),
(56, 'prakash kumar', '', '', 22, '', '', '6669998887', '', '', '4561234562', 0, '', '', '0000-00-00 00:00:00', '0000-00-00', '', 0),
(57, 'Sana Khan', '', '', 22, '', '', '7777888898', '', '', '7896541233', 0, '', '', '0000-00-00 00:00:00', '0000-00-00', '', 0),
(58, 'priya', 'Nagpur', 'Nagpur', 22, '440022', 'near deshpande clinic', '9040116584', '9508734965', 'priya4@gmail.com', '27bghfy6453b7z3', 2, '0', 'admin', '2020-09-11 11:08:37', '0000-00-00', '2534657', 0),
(59, 'annu', 'nagpur', 'nagpur', 22, '440022', 'near deshpande clinic', '9096834857', '', 'annu3@gmail.com', '27bvnfh2345n8z7', 2, '', 'admin', '2020-09-17 15:03:53', '0000-00-00', '45345', 0),
(60, 'palak', 'nagpur', 'nagpur', 22, '440022', 'near party hall', '9787584674', '', 'palak2@gmail.com', '27vfdgt1234b8z7', 2, '0', 'admin', '2020-09-19 11:42:47', '0000-00-00', '22323', 0),
(61, 'rashmi', 'nagpur', 'nagpur', 22, '440022', 'fgdg', '6587464642', '', 'rashmi2@gmail.com', 'ghfjufhfjhf', 2, '', 'admin', '2020-09-21 10:58:55', '0000-00-00', '2145465', 0),
(62, 'sanjana', 'nagpur', 'nagpur', 22, '440022', 'near renuka mandir', '8775768458', '', 'sanjana4@gmail.com', '27jdfdj7478b7z6', 2, '36150', 'admin', '2020-09-23 12:32:07', '0000-00-00', '7865489', 0),
(63, 'parvathi', 'nagpur', 'nagpur', 22, '440022', 'fhghjd', '9874987594', '', 'paru5@gmail.com', '27hgdgd4673byzy', 3, '', 'admin', '2020-09-23 12:33:46', '0000-00-00', '84638837', 0),
(64, 'deepti', 'nagpur', 'nagpur', 22, '440022', 'bvbdh', '9884384783', '', 'deepti4@gmail.com', '27bccxh5364b7z6', 4, '', 'admin', '2020-09-23 12:35:34', '0000-00-00', '', 0),
(65, 'teju', 'nagpur', 'nagpur', 22, '440022', 'near grossery shop', '9438777947', '', 'teju2@gmail.com', '27ncbck4393nuzy', 2, '20000', 'admin', '2020-09-24 10:57:37', '0000-00-00', '235644', 0),
(66, 'kinjal', '\r\n nagpur', 'nagpur', 22, '440022', 'near deshpande clinic', '8388467363', '', 'kinjal6@gmail.com', '27uyreu2334buzy', 2, '30000', 'admin', '2020-09-26 10:46:09', '0000-00-00', '99999', 0),
(67, 'kushal', 'Trimurti Nagar', 'Nagpur', 22, '440025', '', '1025896302', 'Minal', 'a@gmail.com', 'kh54545', 0, '', 'admin', '2020-11-04 15:29:16', '0000-00-00', '', 10.5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `item_array` text NOT NULL,
  `sales_ex` int(11) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `hsn` varchar(50) NOT NULL,
  `i_gst` varchar(50) NOT NULL,
  `c_gst` varchar(50) NOT NULL,
  `s_gst` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `brand_id`, `name`, `category_id`, `hsn`, `i_gst`, `c_gst`, `s_gst`, `user`, `date_time`) VALUES
(1, 1, 'home desktop', 1, '11111111', '5', '2.5', '2.5', 'admin', '2019-01-25 11:33:04'),
(2, 2, 'home desktop ', 1, '1111111', '5', '2.5', '2.5', 'admin', '2019-01-25 11:39:16'),
(3, 1, 't v ', 2, '1112222', '5', '2.5', '2.5', 'admin', '2019-01-25 11:43:40'),
(4, 2, 'home tv', 2, '1112222', '5', '2.5', '2.5', 'admin', '2019-01-25 11:47:26'),
(5, 2, 'mobile', 5, '1112222', '5', '2.5', '2.5', 'admin', '2019-01-25 11:50:03'),
(6, 3, 'hand watch gents ', 6, '124522', '5', '2.5', '2.5', 'admin', '2019-01-25 11:57:04'),
(7, 4, 'MOBILE', 5, '1111111', '5', '2.5', '2.5', 'admin', '2019-01-31 12:06:46'),
(8, 2, 'digital camera', 1, '12345', '5', '2.5', '2.5', 'admin', '2019-02-12 10:32:42'),
(9, 2, 'mobile', 5, '1290', '5', '2.5', '2.5', 'admin', '2019-02-12 10:48:24'),
(10, 4, 'pure', 5, '34013090', '18', '9', '9', 'admin', '2019-03-20 16:11:09'),
(11, 1, 'lg product', 1, '30049011', '12', '6', '6', 'admin', '2019-03-22 11:53:02'),
(12, 1, 'lg nice product', 1, '9021010', '5', '2.5', '2.5', 'admin', '2019-03-22 11:54:45'),
(13, 1, 'aaa', 1, '123', '18', '9', '9', 'admin', '2019-03-27 15:27:19'),
(14, 1, 'mobile1', 5, '1478', '5', '2.5', '2.5', 'admin', '2019-03-27 17:50:29'),
(15, 6, 'i phone ', 5, 'fg5345345', '10', '5', '5', 'admin', '2019-05-22 12:36:42'),
(16, 2, 'Galaxy S7', 2, '6789309132905397', '18', '9', '9', 'admin', '2019-07-01 10:48:14'),
(17, 2, 'Home Theater', 6, '6789309132905397', '12', '6', '6', 'admin', '2019-07-01 10:58:50'),
(18, 1, 'pen', 1, '123', '12', '6', '6', 'admin', '2019-07-27 12:38:17'),
(19, 1, 'ad', 1, 'asds14', '12', '6', '6', 'admin', '2020-02-10 13:11:28'),
(20, 2, 'samsung ', 5, '3422', '12', '6', '6', 'admin', '2020-09-04 12:25:17'),
(21, 9, 'oppo f7 mobile', 5, '2543', '12', '6', '6', 'admin', '2020-09-07 11:10:06'),
(22, 9, 'oppo f7 mobile', 5, 'oppo f7 mobile', 'oppo f7 mobile', 'oppo f7 mobile', 'oppo f7 mobile', 'admin', '2020-09-07 11:11:28'),
(23, 9, 'oppo f7', 5, '4525', '12', '6', '6', 'admin', '2020-09-07 11:14:26'),
(24, 10, 'vivo mobile', 5, '2546', '12', '6', '6', 'admin', '2020-09-07 11:20:30'),
(25, 12, ' realme mobile', 5, '5465', '12', '6', '6', 'admin', '2020-09-07 11:32:10'),
(26, 11, 'pro7', 5, '4544', '12', '6', '6', 'admin', '2020-09-07 11:44:25'),
(27, 13, 'samsung electronic tv', 2, '54865', '12', '6', '6', 'admin', '2020-09-07 11:52:29'),
(28, 13, 'samsung tv', 2, '54847', '12', '6', '6', 'admin', '2020-09-07 11:54:02'),
(29, 14, 'mobile', 5, '6453', '12', '6', '6', 'admin', '2020-09-07 15:55:08'),
(30, 15, 'full hD', 2, '5487', '12', '6', '6', 'admin', '2020-09-08 09:56:59'),
(31, 15, 'sony', 2, '4635', '12', '6', '6', 'admin', '2020-09-08 10:03:18'),
(32, 13, 'LED', 2, '3454', '12', '6', '6', 'admin', '2020-09-08 11:42:41'),
(33, 17, 'lenovo mobile', 5, '4667', '5', '2.5', '2.5', 'admin', '2020-09-08 17:57:19'),
(34, 18, 'washing machine', 4, '4521', '5', '2.5', '2.5', 'admin', '2020-09-08 18:15:48'),
(35, 19, 'radio', 3, '3643', '5', '2.5', '2.5', 'admin', '2020-09-08 18:26:39'),
(36, 20, 'watch', 6, '36467', '12', '', '', 'admin', '2020-09-08 18:33:11'),
(37, 18, 'washing machine', 4, '1232', '12', '6', '6', 'admin', '2020-09-09 11:45:11'),
(38, 21, 'mobile', 5, '645367', '12', '', '', 'admin', '2020-09-11 13:10:35'),
(39, 12, 'mobile', 5, '64756', '12', '6', '6', 'admin', '2020-09-11 13:20:26'),
(40, 22, ' mobile', 5, '666667', '12', '6', '6', 'admin', '2020-09-11 13:29:05'),
(41, 12, 'mobile', 5, '3333', '12', '6', '6', 'admin', '2020-09-16 18:07:23'),
(42, 24, 'mobile', 5, '554464', '18', '9', '9', 'admin', '2020-09-17 15:30:25'),
(43, 26, 'tV', 2, '333334', '18', '9', '9', 'admin', '2020-09-17 16:01:14'),
(44, 27, 'mobile', 5, '555525', '12', '6', '6', 'admin', '2020-09-25 11:48:36'),
(45, 28, 'tv', 2, '363636', '18', '9', '9', 'admin', '2020-09-25 12:24:13'),
(46, 28, 'tV', 2, '874833', '18', '9', '9', 'admin', '2020-09-25 12:25:51'),
(47, 11, 'realme', 5, '232323', '12', '6', '6', 'admin', '2020-10-12 10:40:02'),
(48, 9, 'oppo', 5, '5555', '12', '6', '6', 'admin', '2020-10-12 10:46:31'),
(49, 11, 'realme', 5, '2323', '12', '', '', 'admin', '2020-10-12 10:53:50'),
(50, 27, 'poco', 5, '1212', '18', '9', '9', 'admin', '2020-10-16 10:14:32'),
(51, 2, 'mobile', 5, '2222', '12', '6', '6', 'admin', '2020-10-21 17:56:11'),
(52, 29, 'Redmi Note 8 PRO', 5, 'jo56565', '28', '14', '14', 'admin', '2020-10-28 11:59:43'),
(53, 2, 'asdf', 2, '11223344', '12', '6', '6', 'admin', '2020-11-11 18:25:12'),
(54, 4, '16', 1, 'hgjh', 'kk,k', 'NaN', 'NaN', 'admin', '2020-12-02 16:24:47'),
(55, 1, 'new tv', 2, '11223344', '18', '9', '9', 'admin', '2020-12-16 14:38:47');

-- --------------------------------------------------------

--
-- Table structure for table `product_desc`
--

CREATE TABLE `product_desc` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `weight` varchar(100) NOT NULL,
  `mrp` varchar(50) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `sale_price` varchar(100) NOT NULL,
  `stock_2` varchar(20) NOT NULL,
  `user` varchar(20) NOT NULL,
  `date_time` datetime NOT NULL,
  `nos` int(11) NOT NULL,
  `purchase_rate` int(11) NOT NULL,
  `m1` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_desc`
--

INSERT INTO `product_desc` (`id`, `product_id`, `weight`, `mrp`, `barcode`, `stock`, `sale_price`, `stock_2`, `user`, `date_time`, `nos`, `purchase_rate`, `m1`) VALUES
(1, 1, 'i3', '15000', '5c4aa69925c7e', 97, '14000', '', 'admin', '2019-01-25 11:36:05', 10, 0, 7),
(2, 1, 'i5', '16000', '5c4aa70290ec4', 0, '15000', '0', 'admin', '2019-01-25 11:36:06', 10, 0, 7),
(3, 1, 'i7', '21000', '5c4aa71e8933e', 101, '20000', '', 'admin', '2019-01-25 11:36:06', 10, 0, 7),
(4, 2, 'i3', '15000', '5c4aa80d43ace', 102, '14000', '', 'admin', '2019-01-25 11:42:18', 10, 0, 7),
(5, 2, 'i5', '17000', '5c4aa896a031f', 99, '16000', '1', 'admin', '2019-01-25 11:42:18', 10, 0, 7),
(6, 2, 'i7', '21000', '5c4aa8ab4b641', 99, '20000', '', 'admin', '2019-01-25 11:42:18', 10, 0, 7),
(7, 3, '28 inch flat ', '7000', '5c4aa91521468', 97, '6000', '', 'admin', '2019-01-25 11:46:57', 10, 6000, 7),
(8, 3, '32 inch flat ', '12000', '5c4aa9716e114', 110, '11000', '', 'admin', '2019-01-25 11:46:57', 10, 9000, 7),
(9, 3, '42 inch ', '18000', '5c4aa993ebd71', 126, '16000', '1', 'admin', '2019-01-25 11:46:57', 10, 0, 7),
(10, 3, '52 inch ', '25000', '5c4aa9b56a0bb', 120, '24000', '', 'admin', '2019-01-25 11:46:57', 10, 0, 7),
(11, 4, '22 inch ', '6500', '5c4aa9f743dc5', 102, '5500', '', 'admin', '2019-01-25 11:49:22', 10, 0, 7),
(12, 4, '32 inch flat ', '9000', '5c4aaa1d90eab', 85, '8500', '', 'admin', '2019-01-25 11:49:22', 10, 0, 7),
(13, 4, '42 inch flat ', '15000', '5c4aaa3885728', 94, '14000', '2', 'admin', '2019-01-25 11:49:22', 10, 14000, 7),
(14, 4, '62 inch wall tv ', '30000', '5c4aaa4f43cbe', 92, '28000', '', 'admin', '2019-01-25 11:49:22', 10, 20000, 7),
(15, 5, 'galaxy s1 ', '5000', '5c4aaa9375a18', 89, '4500', '', 'admin', '2019-01-25 11:53:19', 10, 0, 7),
(16, 5, 'galaxy s2 ', '9000', '5c4aaab47dabf', 127, '8500', '', 'admin', '2019-01-25 11:53:19', 10, 8500, 7),
(17, 5, 'galaxy j1 blue ', '15000', '5c4aaadab6f62', 109, '14000', '', 'admin', '2019-01-25 11:53:19', 10, 0, 7),
(18, 5, 'galaxy j2 black ', '20000', '5c4aab1f0db00', 118, '19000', '', 'admin', '2019-01-25 11:53:19', 10, 15000, 7),
(19, 5, 'galaxy j4 plus ', '30000', '5c4aab3b353f5', 112, '28000', '', 'admin', '2019-01-25 11:53:19', 10, 0, 7),
(20, 6, 'segolike luxury', '3000', '5c4aac38984c0', 496, '2400', '', 'admin', '2019-01-25 12:01:41', 10, 0, 7),
(21, 7, 'galaxy s1', '100000', '5c52977ecf48f', 114, '8000', '', 'admin', '2019-01-31 12:08:22', 10, 50000, 7),
(22, 8, 'c1 plus', '6000', '5c625372e5e7c', 600, '5500.56', '', 'admin', '2019-02-12 10:34:34', 10, 0, 7),
(23, 8, 'c2 plus', '7000', '5c6254064fc33', 398, '6500.23', '', 'admin', '2019-02-12 10:35:43', 10, 0, 7),
(24, 8, 'c3 plus', '8000', '5c62542ceeb7f', 395, '7500.56', '', 'admin', '2019-02-12 10:37:37', 10, 0, 7),
(25, 8, 'c4 plus', '10000', '5c6254f739bbb', 400, '9500.23', '', 'admin', '2019-02-12 10:40:41', 10, 9000, 7),
(26, 8, 'c5 pluss', '5000', '5c62566b5c73c', 399, '5000', '', 'admin', '2019-02-12 10:48:48', 10, 3500, 7),
(27, 9, 'samsang galaxy c7 pro', '20000', '5c62572102f13', 119, '19500', '', 'admin', '2019-02-12 10:49:56', 10, 0, 7),
(28, 10, '30 ml', '100', '5c9218c5bb1a3', 100, '65.25', '1', 'admin', '2019-03-20 16:11:34', 10, 0, 7),
(29, 10, '30 ml ', '100', '5c9219339ca02', 100, '65.25', '', 'admin', '2019-03-20 16:13:24', 10, 0, 7),
(30, 11, '2 g', '35', '5c947f46e4a92', 4, '24.06', '', 'admin', '2019-03-22 11:54:10', 10, 0, 7),
(31, 12, '10 gm', '60', '5c947fada6cb0', 100, '44', '', 'admin', '2019-03-22 11:55:17', 10, 50, 7),
(32, 13, '100', '2000', '5c9b490007727', 400, '1500', '', 'admin', '2019-03-27 15:27:48', 10, 2000, 7),
(33, 14, 'new', '5000', '5c9b6a8d51549', 120, '4500', '', 'admin', '2019-03-27 17:50:50', 10, 0, 7),
(34, 15, '2s', '25000', '5ce4f50252179', 100, '22000', '', 'admin', '2019-05-22 12:37:11', 10, 0, 7),
(35, 16, '15', '12999', '5d199796ae987', 399, '10000', '', 'admin', '2019-07-01 10:49:05', 10, 0, 7),
(36, 17, '59', '16988', '5d199a12bdef9', 400, '15999', '', 'admin', '2019-07-01 10:59:58', 10, 15000, 7),
(37, 18, '-', '500', '5d3bf861b55a5', 1, '6.25', '', 'admin', '2019-07-27 12:39:45', 10, 0, 7),
(38, 20, '250', '10000', '5f51e4d5c9e75', 400, '10000', '', 'admin', '2020-09-04 12:27:20', 0, 0, 7),
(39, 23, '250', '18000', '5f55c8bb6b07d', 99, '20000', '', 'admin', '2020-09-07 11:15:24', 0, 0, 7),
(40, 21, '250', '18000', '5f55c945cfde8', 130, '20000', '', 'admin', '2020-09-07 11:17:02', 0, 0, 7),
(41, 24, '11 pro', '26000', '5f55ca26c71e4', 100, '25000', '', 'admin', '2020-09-07 11:22:35', 0, 0, 7),
(42, 24, 'v 19', '26000', '5f55ca530d8a0', 100, '24990', '', 'admin', '2020-09-07 11:22:35', 0, 0, 7),
(43, 24, 'Y 30', '16000', '5f55ca79467d7', 100, '14990', '', 'admin', '2020-09-07 11:22:35', 0, 0, 7),
(44, 25, 'realme pro7', '18000', '5f55cce320019', 100, '18099', '', 'admin', '2020-09-07 11:35:13', 0, 0, 7),
(45, 25, 'realme pro5', '26000', '5f55cd304afb8', 100, '19499', '', 'admin', '2020-09-07 11:35:13', 0, 0, 7),
(46, 25, ' 6pro', '17000', '5f55cd58ba174', 100, '23000', '', 'admin', '2020-09-07 11:35:13', 0, 0, 7),
(47, 26, 'pro 7', '18000', '5f55cfc215071', 100, '26000', '', 'admin', '2020-09-07 11:44:56', 0, 0, 7),
(48, 28, ' led ', '60000', '5f55d20354331', 100, '80000', '', 'admin', '2020-09-07 11:54:51', 0, 50000, 7),
(49, 29, 'samsung Galaxy M31', '20000', '5f560a84d6931', 130, '26000', '', 'admin', '2020-09-07 16:00:19', 0, 0, 7),
(50, 29, 'samsung Galaxy Note30', '30000', '5f560abc57fec', 130, '50000', '', 'admin', '2020-09-07 16:00:19', 0, 0, 7),
(51, 29, 'samsung Galaxy M21', '18000', '5f560b36eaf5c', 128, '35000', '', 'admin', '2020-09-07 16:00:19', 0, 0, 7),
(52, 29, 'samsung Galaxy Note10', '30000', '5f560b799447d', 120, '45000', '', 'admin', '2020-09-07 16:00:20', 0, 0, 7),
(53, 27, 'washing machine ', '40000', '5f560cd3cce1a', 400, '70000', '', 'admin', '2020-09-07 16:05:47', 0, 0, 6),
(54, 30, 'sony tv full hd', '6000', '5f5708140855e', 100, '80000', '', 'admin', '2020-09-08 09:57:44', 0, 0, 7),
(55, 31, 'full hd tv', '60000', '5f57098f19cf2', 100, '80000', '', 'admin', '2020-09-08 10:03:55', 0, 0, 7),
(56, 32, 'LED TV', '40000', '5f5720da00a72', 120, '50000', '', 'admin', '2020-09-08 11:43:27', 0, 0, 7),
(57, 33, 'K8 note', '20000', '5f5778a80c8c0', 100, '26000', '', 'admin', '2020-09-08 17:58:12', 0, 0, 7),
(58, 33, 'Tab m10', '18000', '5f5779ba9df71', 100, '19999', '', 'admin', '2020-09-08 18:02:54', 0, 0, 7),
(59, 33, 'Tab v17', '10000', '5f577a5c8baac', 100, '11990', '', 'admin', '2020-09-08 18:05:15', 0, 0, 7),
(60, 33, 'Vibe K5', '12000', '5f577a883d81b', 100, '13499', '', 'admin', '2020-09-08 18:06:23', 0, 0, 7),
(61, 34, '8 kg Front Loading full', '28000', '5f577cfc86007', 99, '29990', '', 'admin', '2020-09-08 18:17:12', 0, 0, 6),
(62, 34, '8 kg 5 star semi', '10000', '5f577d8033f70', 100, '11990', '', 'admin', '2020-09-08 18:19:11', 0, 0, 7),
(63, 34, '8 kg fully automatic', '18000', '5f577dcd3ae0f', 100, '19990', '', 'admin', '2020-09-08 18:20:47', 0, 0, 7),
(64, 35, 'fully audio', '30000', '5f577f87c2c6e', 99, '35000', '', 'admin', '2020-09-08 18:29:00', 0, 0, 7),
(65, 36, 'Datejust (ref 116233)', '40000', '5f57810f7489f', 100, '47000', '', 'admin', '2020-09-08 18:34:55', 0, 0, 7),
(66, 2, 'home desktop 2', '30000', '5f5b138c0f4bf', 100, '40000', '', 'admin', '2020-09-11 11:35:43', 0, 0, 7),
(67, 38, 'redmi 9A', '6799', '5f5b29f4554f9', 100, '8000', '', 'admin', '2020-09-11 13:17:54', 0, 0, 7),
(68, 38, 'redmi 9', '8999', '5f5b2a35b5158', 120, '10000', '', 'admin', '2020-09-11 13:17:54', 0, 0, 7),
(69, 38, 'redmi 9 prime', '11999', '5f5b2a65c5682', 140, '12000', '', 'admin', '2020-09-11 13:17:54', 0, 0, 7),
(70, 38, 'redmi note 9', '11999', '5f5b2a9d53491', 120, '12999', '', 'admin', '2020-09-11 13:17:54', 0, 0, 7),
(71, 38, 'redmi note 9 pro max', '18876', '5f5b2acc2b97a', 124, '19000', '', 'admin', '2020-09-11 13:17:54', 0, 0, 7),
(72, 38, 'xiaomi mi 10 5G', '47990', '5f5b2b2ed5dbe', 130, '48000', '', 'admin', '2020-09-11 13:17:55', 0, 0, 7),
(73, 39, 'realme 7', '14999', '5f5b2c428f13a', 100, '15000', '', 'admin', '2020-09-11 13:24:46', 0, 0, 7),
(74, 39, 'realme 7 pro', '19999', '5f5b2c7a4f4a4', 100, '20000', '', 'admin', '2020-09-11 13:24:46', 0, 0, 7),
(75, 39, 'realme c12', '8999', '5f5b2cb0b3b86', 100, '9000', '', 'admin', '2020-09-11 13:24:46', 0, 0, 7),
(76, 39, 'realme c15', '9999', '5f5b2cea6121b', 100, '10000', '', 'admin', '2020-09-11 13:24:46', 0, 0, 7),
(77, 39, 'realme c11', '7499', '5f5b2d0fc1383', 100, '8000', '', 'admin', '2020-09-11 13:24:47', 0, 0, 7),
(78, 40, 'honar 9A', '9999', '5f5b2e494dbf7', 98, '10000', '', 'admin', '2020-09-11 13:32:21', 0, 0, 7),
(79, 40, 'honar 9s', '6499', '5f5b2e6d695f7', 100, '7000', '', 'admin', '2020-09-11 13:32:21', 0, 0, 7),
(80, 40, 'honar 9X pro', '17999', '5f5b2ea54fee4', 100, '18000', '', 'admin', '2020-09-11 13:32:21', 0, 0, 7),
(81, 41, 'realme pro6', '27000', '5f620703a00dc', 100, '30000', '', 'admin', '2020-09-16 18:08:16', 0, 0, 7),
(82, 33, 'k10 note', '40000', '5f632c6c35294', 100, '40000', '', 'admin', '2020-09-17 15:00:01', 0, 0, 7),
(83, 42, 'nord', '24999', '5f6333ba01e1f', 400, '24999', '', 'admin', '2020-09-17 15:35:02', 0, 0, 7),
(84, 42, '8 pro', '54990', '5f6333dce798c', 400, '54990', '', 'admin', '2020-09-17 15:35:02', 0, 0, 7),
(85, 42, '8', '41999', '5f633400ba595', 400, '41999', '', 'admin', '2020-09-17 15:35:02', 0, 0, 7),
(86, 42, '7T pro', '43999', '5f633421e5689', 400, '43999', '', 'admin', '2020-09-17 15:35:02', 0, 0, 7),
(87, 42, '7', '29999', '5f63344bd5102', 400, '29999', '', 'admin', '2020-09-17 15:35:02', 0, 0, 7),
(88, 42, '7pro', '39995', '5f633474029c8', 400, '39995', '', 'admin', '2020-09-17 15:35:02', 0, 0, 7),
(89, 42, '6', '32999', '5f63349f32272', 400, '32999', '', 'admin', '2020-09-17 15:35:02', 0, 0, 7),
(90, 43, 'Mi 4A Horizon Edition', '22999', '5f633af305e1e', 120, '22999', '', 'admin', '2020-09-17 16:08:24', 0, 0, 7),
(91, 43, 'Mi Android smart 4s', '45480', '5f633b51bb70e', 120, '45480', '', 'admin', '2020-09-17 16:08:24', 0, 0, 7),
(92, 43, 'Mi TV 4X', '25999', '5f633ba25abe5', 120, '52999', '', 'admin', '2020-09-17 16:08:24', 0, 0, 7),
(93, 43, 'Mi TV 4A', '17999', '5f633bd9e48f7', 100, '17999', '', 'admin', '2020-09-17 16:08:24', 0, 0, 7),
(94, 43, 'Mi LED smart 4A pro', '12999', '5f633c0a41fa9', 99, '12999', '', 'admin', '2020-09-17 16:08:24', 0, 0, 7),
(95, 43, 'Mi LED smart 4A pro', '21999', '5f633c47b429d', 100, '21999', '', 'admin', '2020-09-17 16:08:24', 0, 0, 7),
(96, 40, 'honar 6A', '10000', '5f659f68e18a2', 100, '10000', '', 'admin', '2020-09-19 11:34:51', 0, 0, 7),
(97, 2, 'i4', '40000', '5f68390a8683c', 100, '2', '', 'admin', '2020-09-21 10:54:46', 0, 0, 7),
(98, 44, ' X3', '16999', '5f6d8bbcc6373', 400, '16999', '', 'admin', '2020-09-25 11:53:30', 0, 0, 7),
(99, 44, ' M2', '10999', '5f6d8bf09d8ce', 400, '10999', '', 'admin', '2020-09-25 11:53:30', 0, 0, 7),
(100, 44, ' M2 pro', '13999', '5f6d8c19adc59', 400, '13999', '', 'admin', '2020-09-25 11:53:30', 0, 0, 7),
(101, 44, ' X2', '17499', '5f6d8c3c30e45', 400, '17499', '', 'admin', '2020-09-25 11:53:30', 0, 0, 7),
(102, 44, ' X3 NFC', '14620', '5f6d8c5cda75f', 400, '14620', '', 'admin', '2020-09-25 11:53:30', 0, 0, 7),
(103, 44, ' F2', '24999', '5f6d8cae614fc', 400, '24999', '', 'admin', '2020-09-25 11:53:30', 0, 0, 7),
(104, 46, 'AI 4K LED Smart android', '23999', '5f6d9477cae36', 400, '23999', '', 'admin', '2020-09-25 12:31:40', 0, 0, 7),
(105, 46, 'V2A QLED Android smart (32F2)', '89999', '5f6d94caef29a', 399, '89999', '', 'admin', '2020-09-25 12:31:41', 0, 0, 7),
(106, 46, 'LED smart TV', '14999', '5f6d9533ed2c8', 400, '14999', '', 'admin', '2020-09-25 12:31:41', 0, 0, 7),
(107, 46, 'certified android smart  (75H2A)', '1,49,999', '5f6d956611436', 399, '1,49,999', '', 'admin', '2020-09-25 12:31:41', 0, 0, 7),
(108, 47, '400', '25000', '5f83e52b2d7ad', 100, '25000', '', 'admin', '2020-10-12 10:45:47', 0, 0, 7),
(109, 48, 'oppo ', '20000', '5f83e6af96a88', 1, '20000', '', 'admin', '2020-10-12 10:47:58', 0, 0, 7),
(110, 49, 'pro17', '10000', '5f83e86698442', 5, '10000', '', 'admin', '2020-10-12 10:54:20', 0, 0, 7),
(111, 18, 'dot pen', '100', '5f83ef8e6897a', 6, '100', '', 'admin', '2020-10-12 11:26:04', 0, 0, 7),
(112, 50, 'c11', '10000', '5f8925310cd1a', 100, '10000', '', 'admin', '2020-10-16 10:14:57', 0, 0, 7),
(113, 25, 'c11', '13000', '5f892710f3036', 20, '12000', '', 'admin', '2020-10-16 10:22:56', 0, 0, 7),
(114, 13, 'c11', '2000', '5f901922297bd', 3, '2000', '', 'admin', '2020-10-21 16:50:47', 0, 0, 7),
(115, 51, 'c11', '5000', '5f9028e3888ca', 3, '5000', '', 'admin', '2020-10-21 17:56:59', 0, 0, 7),
(116, 52, '64 mp', '18000', '5f991055b5752', 2, '20000', '', 'admin', '2020-10-28 12:10:32', 0, 0, 7),
(117, 6, 'Titan', '2000', '5fabe03319d92', 20, '2500', '', 'admin', '2020-11-11 18:30:44', 0, 0, 7),
(118, 20, 'Galaxy J7', '15000', '5fb90402e8d9f', 20, '18000', '', 'admin', '2020-11-21 17:42:29', 0, 0, 7),
(119, 20, 'test', '100', '5fb9040c951c8', 10, '5', '', 'admin', '2020-11-21 17:42:34', 0, 0, 7),
(120, 55, '111', '15000', '5fd9cea059f2b', 10, '16000', '', 'admin', '2020-12-16 14:39:13', 0, 0, 7);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_log`
--

CREATE TABLE `purchase_log` (
  `id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `deposit` int(11) NOT NULL,
  `detail` text NOT NULL,
  `user` varchar(250) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `items` text NOT NULL,
  `received` text NOT NULL,
  `inv_date` date NOT NULL,
  `inv_no` varchar(100) NOT NULL,
  `user` varchar(20) NOT NULL,
  `date_time` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `receipt` varchar(200) NOT NULL,
  `recev_status` int(11) NOT NULL,
  `return_item` text NOT NULL,
  `total_amt` varchar(250) NOT NULL,
  `receive_amt` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `party_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `taxable_amt` varchar(20) NOT NULL,
  `c_gst` varchar(20) NOT NULL,
  `s_gst` varchar(20) NOT NULL,
  `i_gst` varchar(20) NOT NULL,
  `total_amt` varchar(100) NOT NULL,
  `cod_percent` varchar(20) NOT NULL,
  `cod_amt` varchar(20) NOT NULL,
  `h_disc_percent` int(11) NOT NULL,
  `h_disc_amt` int(11) NOT NULL,
  `receive_amt` varchar(11) NOT NULL,
  `credit_amt` varchar(50) NOT NULL,
  `item_detail` text NOT NULL,
  `tax_detail` text NOT NULL,
  `return_item` text NOT NULL,
  `return_date` date NOT NULL,
  `return_amt` varchar(100) NOT NULL,
  `cancel_status` varchar(50) NOT NULL,
  `user` varchar(20) NOT NULL,
  `date_time` datetime NOT NULL,
  `pay_type` varchar(20) NOT NULL,
  `sale_exe` int(11) NOT NULL,
  `temp_sale` int(11) NOT NULL,
  `bill_no` varchar(200) NOT NULL,
  `m1` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_demi`
--

CREATE TABLE `sales_demi` (
  `id` int(11) NOT NULL,
  `inv_id` int(11) NOT NULL,
  `party_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `taxable_amt` varchar(20) NOT NULL,
  `c_gst` varchar(20) NOT NULL,
  `s_gst` varchar(20) NOT NULL,
  `i_gst` varchar(20) NOT NULL,
  `total_amt` varchar(100) NOT NULL,
  `cod_percent` varchar(20) NOT NULL,
  `cod_amt` varchar(20) NOT NULL,
  `receive_amt` varchar(11) NOT NULL,
  `credit_amt` varchar(50) NOT NULL,
  `item_detail` text NOT NULL,
  `tax_detail` text NOT NULL,
  `return_item` text NOT NULL,
  `return_date` date NOT NULL,
  `return_amt` varchar(100) NOT NULL,
  `cancel_status` varchar(50) NOT NULL,
  `user` varchar(20) NOT NULL,
  `date_time` datetime NOT NULL,
  `pay_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_executive`
--

CREATE TABLE `sales_executive` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `contact` decimal(10,0) NOT NULL,
  `email` varchar(70) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `unq_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_executive`
--

INSERT INTO `sales_executive` (`id`, `name`, `contact`, `email`, `username`, `password`, `status`, `date_time`, `unq_id`) VALUES
(1, 'Dipak Andraskar', '1256478952', 'Dipak@xlit.com', 'Dipak', '1234', 1, '2018-07-12 00:00:00', 892095),
(2, 'rutuja kadam', '0', '', '', '', 0, '2018-07-12 00:00:00', 0),
(3, 'ashish gupta', '0', '', '', '', 0, '2018-07-12 00:00:00', 0),
(4, 'kartik ubhad', '0', '', '', '', 0, '2018-07-12 00:00:00', 0),
(5, 'Pritam Ghanekar', '9604773475', 'priyabansod20@gmail.com', '', '9503916657', 1, '2018-07-12 00:00:00', 0),
(9, 'Naresh Kumar Pandey', '9503916658', 'naresh5@gmail.com', '', 'naesh12', 1, '0000-00-00 00:00:00', 0),
(23, 'Sushant Sakhre', '8523697893', 'sushant@xlit.com', '8523697893', 'tokyo', 1, '2019-07-30 15:45:51', 0),
(24, 'Kartik Nikode', '9015990159', 'kartik@xlit.com', '9015990159', 'tokyo', 1, '2019-07-30 15:46:03', 0),
(25, 'Sushant Sakhare', '9258965895', 'sushant@xlit.com', '9258965895', 'tokyo', 1, '2019-07-30 15:46:56', 632541),
(27, 'Ashwini Samrit', '4567891235', 'ashwini@xlit.com', '4567891235', 'tokyo', 1, '2019-07-30 15:52:18', 0),
(29, 'mahendra', '5789754656', 'm@gmail.com', '5789754656', '12345', 1, '2019-07-30 15:53:33', 482424),
(34, 'Shivani', '4567891235', 'shiwani@xlit.com', '4567891235', 'test', 1, '2019-07-30 17:06:40', 913223),
(38, 'krutka', '4567891237', 'test@test.com', '4567891237', 'test', 1, '2019-07-30 17:10:49', 300456),
(40, 'Priya', '6904773475', 'priyabansod20@gmail.com', '6904773475', '9503916657', 1, '2020-09-07 11:01:33', 479999),
(41, 'palak', '9978576458', 'palak2@gmail.com', '9978576458', 'palak@123', 1, '2020-09-19 12:12:25', 48520),
(42, 'rashmi', '9546895415', 'rashmi2@gmail.com', '9546895415', 'rashmi2@', 1, '2020-09-21 10:52:21', 850414),
(43, 'arun', '8975979874', 'arun5@gmail.com', '8975979874', 'arun123@', 1, '2020-09-23 12:11:04', 940839),
(44, 'teju', '4739373794', 'teju3@gmail.com', '4739373794', 'teju', 1, '2020-09-24 12:32:25', 139095),
(45, 'sara khan', '9943783834', 'sara8@gmail.com', '9943783834', 'sara@123', 1, '2020-09-25 11:42:46', 640538),
(46, 'kinjal', '9839748383', 'k7@gmail.com', '9839748383', 'kinjal23', 1, '2020-09-26 10:41:11', 817899);

-- --------------------------------------------------------

--
-- Table structure for table `sales_log`
--

CREATE TABLE `sales_log` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `party_id` int(11) NOT NULL,
  `deposit` int(11) NOT NULL,
  `detail` text NOT NULL,
  `user` varchar(20) NOT NULL,
  `date_time` datetime NOT NULL,
  `cheque_status` varchar(20) NOT NULL,
  `cheque_deposit_date` date NOT NULL,
  `return_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_log_2`
--

CREATE TABLE `sales_log_2` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `deposit` int(11) NOT NULL,
  `detail` text NOT NULL,
  `user` varchar(20) NOT NULL,
  `date_time` datetime NOT NULL,
  `cheque_status` varchar(20) NOT NULL,
  `cheque_deposit_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_type_2`
--

CREATE TABLE `sales_type_2` (
  `id` int(11) NOT NULL,
  `party_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `taxable_amt` varchar(20) NOT NULL,
  `c_gst` varchar(20) NOT NULL,
  `s_gst` varchar(20) NOT NULL,
  `i_gst` varchar(20) NOT NULL,
  `total_amt` varchar(100) NOT NULL,
  `cod_percent` varchar(20) NOT NULL,
  `cod_amt` varchar(20) NOT NULL,
  `receive_amt` varchar(11) NOT NULL,
  `credit_amt` varchar(50) NOT NULL,
  `item_detail` text NOT NULL,
  `tax_detail` text NOT NULL,
  `return_item` text NOT NULL,
  `return_date` date NOT NULL,
  `return_amt` varchar(100) NOT NULL,
  `cancel_status` varchar(50) NOT NULL,
  `user` varchar(20) NOT NULL,
  `date_time` datetime NOT NULL,
  `pay_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `state_id` int(11) NOT NULL,
  `state_name` varchar(30) NOT NULL,
  `tn_no` int(11) NOT NULL,
  `state_code` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `state_name`, `tn_no`, `state_code`) VALUES
(1, 'Andaman and Nicobar Islands', 35, 'AN'),
(2, 'Andhra Pradesh', 28, 'AP'),
(3, 'Andhra Pradesh (New)', 37, 'AD'),
(4, 'Arunachal Pradesh', 12, 'AR'),
(5, 'Assam', 18, 'AS'),
(6, 'Bihar', 10, 'BH'),
(7, 'Chandigarh', 4, 'CH'),
(8, 'Chattisgarh', 22, 'CT'),
(9, 'Dadra and Nagar Haveli', 26, 'DN'),
(10, 'Daman and Diu', 25, 'DD'),
(11, 'Delhi', 7, 'DL'),
(12, 'Goa', 30, 'GA'),
(13, 'Gujarat', 24, 'GJ'),
(14, 'Haryana', 6, 'HR'),
(15, 'Himachal Pradesh', 2, 'HP'),
(16, 'Jammu and Kashmir', 1, 'JK'),
(17, 'Jharkhand', 20, 'JH'),
(18, 'Karnataka', 29, 'KA'),
(19, 'Kerala', 32, 'KL'),
(20, 'Lakshadweep Islands', 31, 'LD'),
(21, 'Madhya Pradesh', 23, 'MP'),
(22, 'Maharashtra', 27, 'MH'),
(23, 'Manipur', 14, 'MN'),
(24, 'Meghalaya', 17, 'ME'),
(25, 'Mizoram', 15, 'MI'),
(26, 'Nagaland', 13, 'NL'),
(27, 'Odisha', 21, 'OR'),
(28, 'Pondicherry', 34, 'PY'),
(29, 'Punjab', 3, 'PB'),
(30, 'Rajasthan', 8, 'RJ'),
(31, 'Sikkim', 11, 'SK'),
(32, 'Tamil Nadu', 33, 'TN'),
(33, 'Telangana', 36, 'TS'),
(34, 'Tripura', 16, 'TR'),
(35, 'Uttar Pradesh', 9, 'UP'),
(36, 'Uttarakhand', 5, 'UT'),
(37, 'West Bengal', 19, 'WB');

-- --------------------------------------------------------

--
-- Table structure for table `stock_counter`
--

CREATE TABLE `stock_counter` (
  `id` int(11) NOT NULL,
  `prod_desc_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `date` date NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock_request`
--

CREATE TABLE `stock_request` (
  `id` int(11) NOT NULL,
  `bill_no` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `from_location` varchar(100) NOT NULL,
  `to_location` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `issue_array` text NOT NULL,
  `receive_array` text NOT NULL,
  `date_time` datetime NOT NULL,
  `unique_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reg`
--

CREATE TABLE `tbl_reg` (
  `reg_id` int(11) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `m_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `dob` varchar(30) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact_no` varchar(30) NOT NULL,
  `role` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_reg`
--

INSERT INTO `tbl_reg` (`reg_id`, `f_name`, `m_name`, `l_name`, `dob`, `email_address`, `username`, `password`, `address`, `contact_no`, `role`, `status`) VALUES
(6, 'ashish', 'ra', 'so', '23-08-2018', 'ashishd@xlitworks.in', 'admin', '$2y$10$Gw8WSkCHs7r1o2v6cNimXOliw.C2LCi91PYAgcmjKps/71unh6fru', 'greater bnoida', '8982377452', 'admin', 'Active'),
(8, 'rahul', 'l', 'tiwari', '01-02-1985', 'rahul@gmail.com', 'rahul', '$2y$10$Gw8WSkCHs7r1o2v6cNimXOliw.C2LCi91PYAgcmjKps/71unh6fru', 'nagpur ', '8237443811', 'role_1', 'Active'),
(9, 'priya', 'b', 'b', '22-07-2000', 'priya5@gmail.com', 'priya', '$2y$10$GSCFta1VZvXXHMGDm0vklOBulb2Wh0tvFVjitCeaBjCLuMjZ4dSIK', 'nagpur', '9875975847', 'role_1', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `temp_sales`
--

CREATE TABLE `temp_sales` (
  `id` int(11) NOT NULL,
  `party_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `taxable_amt` varchar(20) NOT NULL,
  `c_gst` varchar(20) NOT NULL,
  `s_gst` varchar(20) NOT NULL,
  `i_gst` varchar(20) NOT NULL,
  `total_amt` varchar(100) NOT NULL,
  `cod_percent` varchar(20) NOT NULL,
  `cod_amt` varchar(20) NOT NULL,
  `receive_amt` varchar(11) NOT NULL,
  `credit_amt` varchar(50) NOT NULL,
  `item_detail` text NOT NULL,
  `tax_detail` text NOT NULL,
  `return_item` text NOT NULL,
  `return_date` date NOT NULL,
  `return_amt` varchar(100) NOT NULL,
  `cancel_status` varchar(50) NOT NULL,
  `user` varchar(20) NOT NULL,
  `date_time` datetime NOT NULL,
  `pay_type` varchar(20) NOT NULL,
  `sale_exe` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_details`
--

CREATE TABLE `vendor_details` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` int(11) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gstin` varchar(20) NOT NULL,
  `user` varchar(20) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor_details`
--

INSERT INTO `vendor_details` (`id`, `name`, `email`, `contact`, `city`, `state`, `pincode`, `address`, `gstin`, `user`, `date_time`) VALUES
(1, 'abcd', 'abcd@gmail.com', '8787800000', 'nagpur', 22, '550056', 'rerefrf', '33', 'admin', '2019-01-25 12:21:33'),
(2, 'aa', 'a@gmail.com', '3333322222', 'mumbai', 22, '550055', 'greyygd', '44', 'admin', '2019-01-25 12:22:40'),
(3, 'guru nanak agency', 'guru@gmail.com', '1236165156', 'nagpur ', 23, '440056', 'plot no 45 jai durga layout near meena bazzar  nagpur M.H. ', 'JFFH5457JNG4755', 'admin', '2019-01-25 12:29:24'),
(4, 'anand electronic mart ', 'anand@gmail.com', '1121126555', 'nagpur', 22, '440015', 'PLOT NO. 34 GANDHI MARKET, NEAR AGRASEN CHOWK,  \r\nNAGPUR  M.H ', 'NDSKHF7568758HRH', 'admin', '2019-01-25 15:12:29'),
(5, 'anurag', 'a@gmail.com', '1234567899', 'nagpur', 22, '440011', 'cosmos town nagpur ', 'AAZXC23748', 'admin', '2019-01-30 15:19:40'),
(6, 'avinas ', 'a@gmail.com', '1234567890', 'pune', 22, '440002', 'pune maharashtra', 'gfhfgdgfdgklgk', 'admin', '2019-01-31 12:12:04'),
(7, 'asdf', 'm@gmail.com', '1234567979', 'ad', 22, '123123', 'asdf', 'asd', 'admin', '2020-02-07 17:18:34'),
(8, 'priya', 'priya20@gmail.com', '9096404311', 'nagpur', 22, '440022', 'plot no.30 cosmos town, near deshpande clinic,\r\ntrimurti nagar, jaitala road, nagpur.', '12', 'admin', '2020-09-07 12:12:23'),
(9, 'priti', 'priti32@gmail.com', '9504773475', 'nagpur', 22, '440022', 'nagpur', '2334', 'admin', '2020-09-07 16:12:40'),
(10, 'palak', 'palak2@gmail.com', '9657456476', 'nagpur', 22, '440022', 'nagpur', 'gfdryert', 'admin', '2020-09-19 12:41:53'),
(11, 'rashmi', 'rashmi2@gmail.com', '2546548796', 'nagpur', 22, '440022', 'nagpur', '27hgfsh1234gfhh', 'admin', '2020-09-21 11:00:33'),
(12, 'vidya nair', 'vidya4@gmail.com', '9858463587', 'nagpur', 22, '440022', 'nagpur', '27nbhfg1234b6z4', 'admin', '2020-09-22 11:04:36'),
(13, 'sanjana', 'sanjana6@gmail.com', '7598784584', 'nagpur', 22, '440022', 'nagpur', '27hddhh4525cyzt', 'admin', '2020-09-23 12:37:15'),
(14, 'parvathi', 'parvathi7@gmail.com', '9784348434', 'nagpur', 22, '440022', 'nagpur', '27hfhfj3777byzt', 'admin', '2020-09-23 12:38:38'),
(15, 'deepti', 'deepti7@gmail.com', '9888347734', 'nagpur', 22, '440022', 'nagpur', '27ncxbn6564vtzr', 'admin', '2020-09-23 12:39:47'),
(16, 'teju', 'teju8@gmail.com', '9874833483', 'nagpur', 22, '440022', 'nagpur', '27ckgit5484nuzt', 'admin', '2020-09-24 11:00:36'),
(17, 'sara', 'sara75@gmail.com', '9789989349', 'nagpur', 22, '440022', 'nagpur', '27bcvfh2341nuzy', 'admin', '2020-09-25 13:09:44'),
(18, 'kinjal', 'kinjal2@gmail.com', '7674674787', 'nagpur', 22, '440022', 'nagpur', '27afsgs', 'admin', '2020-09-26 10:49:40'),
(19, 'raman', 'raman2@gmail.com', '9874754875', 'nagpur', 22, '440022', 'nagpur', '27bvhfg3475buzr', 'admin', '2020-10-03 10:08:53');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_party`
--

CREATE TABLE `vendor_party` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(150) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state_id` int(11) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `landmark` varchar(100) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `contact_person` varchar(30) NOT NULL,
  `email_id` varchar(20) NOT NULL,
  `gst_in` varchar(20) NOT NULL,
  `limit_days` int(11) NOT NULL,
  `credit_type` varchar(255) NOT NULL,
  `user` varchar(20) NOT NULL,
  `date_time` datetime NOT NULL,
  `opening_date` date NOT NULL,
  `fssai_no` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor_party`
--

INSERT INTO `vendor_party` (`id`, `name`, `address`, `city`, `state_id`, `pincode`, `landmark`, `contact_no`, `contact_person`, `email_id`, `gst_in`, `limit_days`, `credit_type`, `user`, `date_time`, `opening_date`, `fssai_no`) VALUES
(1, 'Dipak Andraskar', '', '', 22, '', '', '9021204958', '', '', '22GSTINNUMBER', 0, '', '', '0000-00-00 00:00:00', '0000-00-00', ''),
(3, 'Sunil Chambhare', '', '', 22, '', '', '1021204958', '', '', '', 0, '', '', '0000-00-00 00:00:00', '0000-00-00', ''),
(4, 'Ganesh', '', '', 22, '', '', '4455664564', '', '', '123456123123', 0, '', '', '0000-00-00 00:00:00', '0000-00-00', ''),
(5, 'Mohan', '', '', 21, '', '', '1122336655', '', '', '', 0, '', '', '0000-00-00 00:00:00', '0000-00-00', ''),
(6, 'Chaitanya', '', '', 22, '', '', '7276510942', '', '', '123', 0, '', '', '0000-00-00 00:00:00', '0000-00-00', ''),
(7, 'prakash', '', '', 22, '', '', '8425153212', '', '', '27123456', 0, '', '', '0000-00-00 00:00:00', '0000-00-00', ''),
(8, 'aditya Mozarkar', '', '', 22, '', '', '7387676916', '', '', '23AAQFA1879B1ZL', 0, '', '', '0000-00-00 00:00:00', '0000-00-00', ''),
(9, 'karan', '', '', 22, '', '', '1233211233', '', '', '46689689689', 0, '', '', '0000-00-00 00:00:00', '0000-00-00', ''),
(10, 'arjun', '', '', 22, '', '', '3265432123', '', '', '', 0, '', '', '0000-00-00 00:00:00', '0000-00-00', ''),
(11, 'priya', '', '', 22, '', '', '8390579842', '', '', '7487384', 0, '', '', '0000-00-00 00:00:00', '0000-00-00', ''),
(12, 'priya', '', '', 22, '', '', '9784646834', '', '', '27bcvdg1234c7z4', 0, '', '', '0000-00-00 00:00:00', '0000-00-00', ''),
(13, 'teju', '', '', 22, '', '', '8673743764', '', '', '27nmhku3344buzy', 0, '', '', '0000-00-00 00:00:00', '0000-00-00', ''),
(14, 'sara', '', '', 22, '', '', '6487957567', '', '', '27dgffr6475byzt', 0, '', '', '0000-00-00 00:00:00', '0000-00-00', ''),
(15, 'vidya', '', '', 22, '', '', '9749484939', '', '', '27recdg5436vrze', 0, '', '', '0000-00-00 00:00:00', '0000-00-00', ''),
(16, 'v', '', '', 22, '', '', '5748757485', '', '', '27tryeg6453brze', 0, '', '', '0000-00-00 00:00:00', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_product`
--

CREATE TABLE `vendor_product` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `prod_desc_id` int(11) NOT NULL,
  `price` varchar(20) NOT NULL,
  `user` varchar(20) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `id` int(11) NOT NULL,
  `items` text NOT NULL,
  `vendor_name` varchar(30) NOT NULL,
  `party_id` int(11) NOT NULL,
  `cont_no` varchar(30) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state_id` int(11) NOT NULL,
  `gst_in` varchar(100) NOT NULL,
  `bill_no` varchar(250) NOT NULL,
  `total` int(11) NOT NULL,
  `prepared` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `approved` varchar(200) NOT NULL,
  `received` varchar(30) NOT NULL,
  `payment_detail` text NOT NULL,
  `user` varchar(60) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand_master`
--
ALTER TABLE `brand_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_master`
--
ALTER TABLE `company_master`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `creditor`
--
ALTER TABLE `creditor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footer`
--
ALTER TABLE `footer`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `hold_order`
--
ALTER TABLE `hold_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_party`
--
ALTER TABLE `manage_party`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contact_no` (`contact_no`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_desc`
--
ALTER TABLE `product_desc`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `barcode` (`barcode`);

--
-- Indexes for table `purchase_log`
--
ALTER TABLE `purchase_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_demi`
--
ALTER TABLE `sales_demi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_executive`
--
ALTER TABLE `sales_executive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_log`
--
ALTER TABLE `sales_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_log_2`
--
ALTER TABLE `sales_log_2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_type_2`
--
ALTER TABLE `sales_type_2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `stock_counter`
--
ALTER TABLE `stock_counter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_request`
--
ALTER TABLE `stock_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reg`
--
ALTER TABLE `tbl_reg`
  ADD PRIMARY KEY (`reg_id`);

--
-- Indexes for table `temp_sales`
--
ALTER TABLE `temp_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_details`
--
ALTER TABLE `vendor_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contact` (`contact`);

--
-- Indexes for table `vendor_party`
--
ALTER TABLE `vendor_party`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contact_no` (`contact_no`);

--
-- Indexes for table `vendor_product`
--
ALTER TABLE `vendor_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand_master`
--
ALTER TABLE `brand_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `company_master`
--
ALTER TABLE `company_master`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `creditor`
--
ALTER TABLE `creditor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `footer`
--
ALTER TABLE `footer`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hold_order`
--
ALTER TABLE `hold_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `manage_party`
--
ALTER TABLE `manage_party`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `product_desc`
--
ALTER TABLE `product_desc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `purchase_log`
--
ALTER TABLE `purchase_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT for table `sales_demi`
--
ALTER TABLE `sales_demi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `sales_executive`
--
ALTER TABLE `sales_executive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `sales_log`
--
ALTER TABLE `sales_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `sales_log_2`
--
ALTER TABLE `sales_log_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales_type_2`
--
ALTER TABLE `sales_type_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `stock_counter`
--
ALTER TABLE `stock_counter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stock_request`
--
ALTER TABLE `stock_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_reg`
--
ALTER TABLE `tbl_reg`
  MODIFY `reg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `temp_sales`
--
ALTER TABLE `temp_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `vendor_details`
--
ALTER TABLE `vendor_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `vendor_party`
--
ALTER TABLE `vendor_party`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `vendor_product`
--
ALTER TABLE `vendor_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
