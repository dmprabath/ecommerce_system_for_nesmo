-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2020 at 08:22 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nesmo_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_backup`
--

CREATE TABLE `tbl_backup` (
  `backup_id` int(11) NOT NULL,
  `backup_date` date NOT NULL,
  `backup_time` time NOT NULL,
  `file_name` varchar(200) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `backup_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_backup`
--

INSERT INTO `tbl_backup` (`backup_id`, `backup_date`, `backup_time`, `file_name`, `user_id`, `backup_status`) VALUES
(1, '2020-01-11', '17:51:31', 'db_1578745291', 'EMP00001', 1),
(2, '2020-01-11', '17:53:15', 'db_1578745395.sql', 'EMP00001', 1),
(3, '2020-01-11', '17:54:35', 'db_1578745475.sql', 'EMP00001', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batch`
--

CREATE TABLE `tbl_batch` (
  `bat_id` varchar(10) NOT NULL,
  `grn_id` int(10) NOT NULL,
  `prod_id` varchar(10) NOT NULL,
  `bat_cprice` float(15,2) NOT NULL,
  `bat_sprice` float(15,2) NOT NULL,
  `bat_qty` int(11) NOT NULL,
  `bat_rem` int(11) NOT NULL,
  `bat_rdate` date NOT NULL,
  `total_price` float(15,2) NOT NULL,
  `bat_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_batch`
--

INSERT INTO `tbl_batch` (`bat_id`, `grn_id`, `prod_id`, `bat_cprice`, `bat_sprice`, `bat_qty`, `bat_rem`, `bat_rdate`, `total_price`, `bat_status`) VALUES
('BAT00001', 1, 'PRO00001', 37000.00, 43000.00, 20, 15, '2018-04-08', 740000.00, 1),
('BAT00002', 2, 'PRO00007', 79000.00, 95000.00, 30, 24, '2018-05-30', 2370000.00, 1),
('BAT00003', 3, 'PRO00005', 1400.00, 2700.00, 300, 286, '2018-06-02', 420000.00, 1),
('BAT00004', 3, 'PRO00002', 2200.00, 2800.00, 300, 284, '2018-06-02', 660000.00, 1),
('BAT00005', 3, 'PRO00012', 2800.00, 3600.00, 300, 299, '2018-06-02', 840000.00, 1),
('BAT00006', 4, 'PRO00003', 35000.00, 40000.00, 50, 49, '2020-01-09', 1750000.00, 1),
('BAT00007', 4, 'PRO00004', 52000.00, 57000.00, 70, 66, '2020-01-09', 3640000.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cat_id` varchar(10) NOT NULL,
  `cat_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cat_id`, `cat_name`) VALUES
('CAT00001', 'domestic'),
('CAT00002', 'commercial'),
('CAT00003', 'accessories');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cuslogin`
--

CREATE TABLE `tbl_cuslogin` (
  `cus_email` varchar(100) NOT NULL,
  `cus_pass` varchar(100) NOT NULL,
  `temp_pass` varchar(10) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cuslogin`
--

INSERT INTO `tbl_cuslogin` (`cus_email`, `cus_pass`, `temp_pass`, `status`) VALUES
('dasun2@gmail.com', '1adbb3178591fd5bb0c248518f39bf6d', '', 0),
('dasun@gmail.com', '202cb962ac59075b964b07152d234b70', '', 0),
('dhanushkssa@gmail.com', '202cb962ac59075b964b07152d234b70', '', 0),
('safrazroxhameed96@gmail.com', '202cb962ac59075b964b07152d234b70', '', 0),
('sumudsu@gmail.com', '202cb962ac59075b964b07152d234b70', '', 0),
('user@gmail.com', '8af3982673455323883c06fa59d2872a', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customers`
--

CREATE TABLE `tbl_customers` (
  `cus_id` varchar(10) NOT NULL,
  `cus_fname` varchar(25) NOT NULL,
  `cus_lname` varchar(25) NOT NULL,
  `cus_email` varchar(100) NOT NULL,
  `cus_gender` tinyint(1) NOT NULL,
  `cus_mobile` varchar(10) NOT NULL,
  `cus_dob` date NOT NULL,
  `cus_jdate` date NOT NULL,
  `temp_pass` int(10) NOT NULL,
  `cus_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customers`
--

INSERT INTO `tbl_customers` (`cus_id`, `cus_fname`, `cus_lname`, `cus_email`, `cus_gender`, `cus_mobile`, `cus_dob`, `cus_jdate`, `temp_pass`, `cus_status`) VALUES
('CUS00001', 'prabath', 'Lakshitha', 'user@gmail.com', 0, '0775197009', '0000-00-00', '2019-10-12', 0, 0),
('CUS00002', 'Dhanushka', 'Sampath', 'dhanushkssa@gmail.com', 1, '071-454544', '2001-03-13', '2019-12-24', 0, 1),
('CUS00003', 'Sumudu', 'Geeth', 'sumudsu@gmail.com', 1, '0785822254', '2001-12-20', '2019-12-24', 0, 1),
('CUS00004', 'saahen', 'Fernando', 'sahen@gmail.com', 1, '0774524568', '2000-12-18', '2020-01-10', 0, 1),
('CUS00005', 'dasun Pathirana', 'Pathiramna', 'dasun@gmail.com', 1, '0745868952', '2002-01-02', '2020-01-10', 0, 1),
('CUS00006', 'hameed', 'bhai', 'safrazroxhameed96@gmail.com', 1, '0752490206', '1996-05-31', '2020-01-11', 0, 1),
('CUS00007', 'pradeep', 'chathuranga', 'pradeep@gmail.com', 1, '0719334543', '0000-00-00', '2020-01-12', 0, 1),
('CUS00008', 'dasun', 'sampath', 'dasun2@gmail.com', 1, '', '2002-01-03', '2020-01-12', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cus_address`
--

CREATE TABLE `tbl_cus_address` (
  `id` int(11) NOT NULL,
  `cus_id` varchar(10) NOT NULL,
  `line1` varchar(100) NOT NULL,
  `line2` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `district` varchar(50) NOT NULL,
  `province` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cus_address`
--

INSERT INTO `tbl_cus_address` (`id`, `cus_id`, `line1`, `line2`, `city`, `district`, `province`) VALUES
(2, 'CUS00001', 'sample', 'sample 2', 'Beliattass', 'Mullaitivu', 'Eastern'),
(3, 'CUS00003', 'parassgahena', 'kudaheella', 'Beliatta', 'Polonnaruwa', 'Southern'),
(4, 'CUS00002', '', '', '', '', ''),
(5, 'CUS00005', 'kasun niwasa', 'pathirage road', 'maharagama', 'Colombo', 'Western'),
(6, 'CUS00006', '62/9', 'st ritas rd', 'rathmalana', 'Colombo', 'Western'),
(7, 'CUS00008', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cus_notification`
--

CREATE TABLE `tbl_cus_notification` (
  `id` int(11) NOT NULL,
  `cus_id` varchar(10) NOT NULL,
  `notif_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cus_notification`
--

INSERT INTO `tbl_cus_notification` (`id`, `cus_id`, `notif_id`) VALUES
(1, 'CUS00003', 1),
(2, 'CUS00003', 2),
(3, 'CUS00005', 3),
(4, 'CUS00006', 4),
(5, 'CUS00006', 5),
(8, 'CUS00003', 8),
(9, 'CUS00003', 9),
(10, 'CUS00003', 10),
(11, 'CUS00003', 11),
(12, 'CUS00006', 12),
(13, 'CUS00003', 13),
(14, 'CUS00006', 14);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `feed_id` int(11) NOT NULL,
  `cus_id` varchar(10) NOT NULL,
  `prod_id` varchar(10) NOT NULL,
  `feed_msg` varchar(500) NOT NULL,
  `feed_star` tinyint(1) NOT NULL,
  `feed_date` date NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`feed_id`, `cus_id`, `prod_id`, `feed_msg`, `feed_star`, `feed_date`, `status`) VALUES
(1, 'CUS00005', 'PRO00012', 'Good quality product to minimum price', 5, '2020-01-11', 1),
(2, 'CUS00005', 'PRO00001', 'Good quality product with great service', 4, '2020-01-11', 1),
(3, 'CUS00005', 'PRO00007', 'Best product', 5, '2020-01-11', 1),
(4, 'CUS00005', 'PRO00006', 'superb one', 3, '2020-01-11', 1),
(5, 'CUS00005', 'PRO00011', 'best one', 3, '2020-01-11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grn`
--

CREATE TABLE `tbl_grn` (
  `grn_id` int(10) NOT NULL,
  `sup_id` varchar(10) NOT NULL,
  `grn_rdate` date NOT NULL,
  `grn_total` float(15,2) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `grn_discount` float NOT NULL,
  `grn_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_grn`
--

INSERT INTO `tbl_grn` (`grn_id`, `sup_id`, `grn_rdate`, `grn_total`, `total_qty`, `grn_discount`, `grn_status`) VALUES
(1, 'SUP0001', '2018-04-08', 740000.00, 20, 0, 1),
(2, 'SUP0002', '2018-05-30', 2370000.00, 30, 0, 1),
(3, 'SUP0002', '2018-06-02', 1920000.00, 900, 0, 1),
(4, 'SUP0003', '2020-01-09', 5390000.00, 120, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `inv_id` varchar(25) NOT NULL,
  `cus_id` varchar(10) NOT NULL,
  `inv_date` date NOT NULL,
  `inv_qty` int(10) NOT NULL,
  `inv_discount` float NOT NULL,
  `inv_total` float(15,2) NOT NULL,
  `inv_paid` float(15,2) NOT NULL,
  `pay_id` varchar(10) NOT NULL,
  `inv_user` varchar(10) NOT NULL,
  `inv_type` varchar(15) NOT NULL,
  `inv_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_invoice`
--

INSERT INTO `tbl_invoice` (`inv_id`, `cus_id`, `inv_date`, `inv_qty`, `inv_discount`, `inv_total`, `inv_paid`, `pay_id`, `inv_user`, `inv_type`, `inv_status`) VALUES
('INV20200109_0001', 'CUS00003', '2019-08-09', 1, 0, 95000.00, 70000.00, '1', '', 'online', 3),
('INV20200110_0001', 'CUS00003', '2019-09-10', 3, 0, 126000.00, 30000.00, '5', '', 'online', 2),
('INV20200110_0002', 'CUS00003', '2019-10-10', 3, 0, 126000.00, 126000.00, '6', '', 'online', 1),
('INV20200110_0003', 'CUS00003', '2019-12-10', 1, 0, 2700.00, 2700.00, '7', '', 'online', 2),
('INV20200110_0004', 'CUS00003', '2020-01-10', 1, 0, 95000.00, 95000.00, '8', '', 'online', 2),
('INV20200110_0005', 'CUS00001', '2020-01-10', 2, 0, 86000.00, 0.00, '', 'EMP00004', 'offline', 1),
('INV20200110_0006', 'CUS00004', '2020-01-10', 2, 0, 43000.00, 43000.00, '10', 'EMP00004', 'offline', 2),
('INV20200110_0007', 'CUS00003', '2020-01-10', 1, 0, 95000.00, 95000.00, '11', '', 'online', 1),
('INV20200110_0008', 'CUS00003', '2020-01-10', 1, 0, 95000.00, 95000.00, '12', '', 'online', 1),
('INV20200110_0009', 'CUS00003', '2020-01-10', 1, 0, 2700.00, 2700.00, '13', '', 'online', 2),
('INV20200110_0010', 'CUS00003', '2020-01-10', 1, 0, 95000.00, 95000.00, '14', '', 'online', 1),
('INV20200110_0011', 'CUS00003', '2020-01-10', 1, 0, 95000.00, 95000.00, '15', '', 'online', 2),
('INV20200110_0012', 'CUS00003', '2020-01-10', 1, 0, 2700.00, 2700.00, '16', '', 'online', 1),
('INV20200110_0013', 'CUS00003', '2020-01-10', 10, 0, 45000.00, 20000.00, '17', '', 'online', 2),
('INV20200110_0014', 'CUS00003', '2020-01-10', 1, 0, 2700.00, 1000.00, '18', '', 'online', 2),
('INV20200110_0015', 'CUS00003', '2020-01-10', 6, 0, 16200.00, 16200.00, '19', '', 'online', 1),
('INV20200110_0016', 'CUS00005', '2020-01-10', 1, 0, 3600.00, 3600.00, '20', '', 'online', 1),
('INV20200111_0001', 'CUS00006', '2020-01-11', 1, 0, 40000.00, 40000.00, '21', '', 'online', 1),
('INV20200111_0002', 'CUS00006', '2020-01-11', 4, 0, 10800.00, 10800.00, '22', '', 'online', 3),
('INV20200112_0001', 'CUS00007', '2020-01-12', 3, 0, 8400.00, 8400.00, '23', 'EMP00001', 'offline', 1),
('INV20200112_0002', 'CUS00001', '2020-01-12', 7, 10, 212760.00, 212760.00, '24', 'EMP00001', 'offline', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inv_prod`
--

CREATE TABLE `tbl_inv_prod` (
  `id` int(11) NOT NULL,
  `inv_id` varchar(25) NOT NULL,
  `prod_id` varchar(10) NOT NULL,
  `prod_cprice` float(15,2) NOT NULL,
  `prod_qty` int(11) NOT NULL,
  `prod_sprice` float(15,2) NOT NULL,
  `warr_expire` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_inv_prod`
--

INSERT INTO `tbl_inv_prod` (`id`, `inv_id`, `prod_id`, `prod_cprice`, `prod_qty`, `prod_sprice`, `warr_expire`) VALUES
(1, 'INV20200109_0001', 'PRO00007', 95000.00, 1, 20000.00, '0000-00-00'),
(2, 'INV20200110_0001', 'PRO00001', 37000.00, 3, 42000.00, '2021-01-09'),
(3, 'INV20200110_0002', 'PRO00001', 37000.00, 3, 42000.00, '2021-01-09'),
(4, 'INV20200110_0003', 'PRO00005', 1400.00, 1, 2700.00, '2020-01-10'),
(5, 'INV20200110_0004', 'PRO00007', 79000.00, 1, 95000.00, '2021-01-09'),
(6, 'INV20200110_0005', 'PRO00001', 0.00, 2, 43000.00, '2021-01-09'),
(7, 'INV20200110_0006', 'PRO00001', 37000.00, 2, 43000.00, '2021-01-09'),
(8, 'INV20200110_0007', 'PRO00007', 79000.00, 1, 95000.00, '2021-01-09'),
(9, 'INV20200110_0008', 'PRO00007', 79000.00, 1, 95000.00, '2021-01-09'),
(10, 'INV20200110_0009', 'PRO00005', 1400.00, 1, 2700.00, '2020-01-10'),
(11, 'INV20200110_0010', 'PRO00007', 79000.00, 1, 95000.00, '2021-01-09'),
(12, 'INV20200110_0011', 'PRO00007', 79000.00, 1, 95000.00, '2021-01-09'),
(13, 'INV20200110_0012', 'PRO00005', 1400.00, 1, 2700.00, '2020-01-10'),
(14, 'INV20200110_0013', 'PRO00002', 2200.00, 10, 4500.00, '2020-07-08'),
(15, 'INV20200110_0014', 'PRO00005', 1400.00, 1, 2700.00, '2020-01-10'),
(16, 'INV20200110_0015', 'PRO00005', 1400.00, 6, 2700.00, '2020-01-10'),
(17, 'INV20200110_0016', 'PRO00012', 2800.00, 1, 3600.00, '2021-01-09'),
(18, 'INV20200111_0001', 'PRO00003', 35000.00, 1, 40000.00, '2021-01-10'),
(19, 'INV20200111_0002', 'PRO00005', 1400.00, 4, 2700.00, '2020-01-11'),
(20, 'INV20200112_0001', 'PRO00002', 2200.00, 3, 2800.00, '2020-07-10'),
(21, 'INV20200112_0002', 'PRO00002', 2200.00, 3, 2800.00, '2020-07-10'),
(22, 'INV20200112_0002', 'PRO00004', 52000.00, 4, 57000.00, '2020-01-20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_messages`
--

CREATE TABLE `tbl_messages` (
  `msg_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `msg_email` varchar(200) NOT NULL,
  `msg_contact` varchar(50) NOT NULL,
  `msg_title` varchar(100) NOT NULL,
  `msg_message` varchar(500) NOT NULL,
  `msg_date` date NOT NULL,
  `msg_time` time NOT NULL,
  `parent_id` tinyint(1) NOT NULL,
  `msg_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_messages`
--

INSERT INTO `tbl_messages` (`msg_id`, `name`, `msg_email`, `msg_contact`, `msg_title`, `msg_message`, `msg_date`, `msg_time`, `parent_id`, `msg_status`) VALUES
(1, 'HIRu', 'hiru@gmail.com', '456465465', 'asasas', 'sdsdsdasda', '2019-10-12', '11:01:55', 0, 1),
(2, 'lahiru Chamara', 'chamara@gmail.com', '0714567892', 'Emergency', 'Messages brings a refreshingly beautiful and responsive Material Design touch to the stale state of text messaging. In a world with clunky SMS and MMS apps ...', '2020-01-08', '15:01:07', 0, 1),
(12, 'lahiru Chamara', 'chamara@gmail.com', '', 'Reply For :Emergency', 'This email From nesmo international(pvt)ltd Sales Team,\r\nNesmo International (pvt)ltd,\r\n103,\r\nHighlevel Road,                            \r\n                    ', '2020-01-08', '18:00:53', 2, 1),
(13, 'Kasun Sampath', 'kasun@gmail.com', '0713137009', 'Report to Crazy Horse', 'All the Sioux were defeated. Our clan   \r\ngot poor, but a few got richer.\r\nThey fought two wars. I did not\r\ntake part. No one remembers your vision   \r\nor even your real name. Now   \r\nthe children go to town and like   \r\nloud music. I married a.', '2020-01-09', '01:01:53', 0, 1),
(14, 'Dilina', 'dilina@gmail.com', '0717513294', 'Mal chamara', 'Hr CSS Style â€“ Change Color Border Style. The HTML <hr> element represents a Horizontal-rule and it is used for page break via line. It creates horizontal line, which makes someone to understand that there is an end of the page or a sentence break.\r\n', '2020-01-10', '11:01:05', 0, 1),
(15, 'Dilina', 'dilina@gmail.com', '', 'Reply For :Mal chamara', 'Thank you contact with us', '2020-01-12', '08:06:44', 14, 1),
(16, 'Kasun Sampath', 'kasun@gmail.com', '', 'Reply For :Report to Crazy Horse', '  good luck                          \r\n                    ', '2020-01-12', '08:11:26', 13, 1),
(17, 'HIRu', 'hiru@gmail.com', '', 'Reply For :asasas', 'Please contact our agent         \r\n                    ', '2020-01-12', '08:12:27', 1, 1),
(18, 'manju prasad', 'manju@gmail.com', '0454567984', 'contact', 'I want to contact you', '2020-01-12', '08:01:39', 0, 1),
(19, 'manju prasad', 'manju@gmail.com', '', 'Reply For :contact', 'We will contact you soon                            \r\n                    ', '2020-01-12', '08:16:09', 18, 1),
(20, 'manju prasad', 'manju@gmail.com', '', 'Reply For :contact', 'Please contact our admin                         \r\n                    ', '2020-01-12', '08:18:32', 18, 1),
(21, 'dddsd', 'fdf@gmail.com', '0713647858', 'sadas', 'hgssa', '2020-01-26', '04:01:15', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification`
--

CREATE TABLE `tbl_notification` (
  `not_id` int(11) NOT NULL,
  `not_title` varchar(100) NOT NULL,
  `not_msg` varchar(200) NOT NULL,
  `not_date` date NOT NULL,
  `not_time` time NOT NULL,
  `not_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_notification`
--

INSERT INTO `tbl_notification` (`not_id`, `not_title`, `not_msg`, `not_date`, `not_time`, `not_status`) VALUES
(1, 'Order Success', 'Your order  has been paid successfully. needs several days to process your order Thank You', '2020-01-10', '20:01:41', 1),
(2, 'Order Success', 'Your order  has been paid successfully. needs several days to process your order Thank You', '2020-01-10', '22:01:06', 1),
(3, 'Order Success', 'Your order  has been paid successfully. needs several days to process your order Thank You', '2020-01-10', '23:01:52', 1),
(4, 'Order Success', 'Your order  has been paid successfully. needs several days to process your order Thank You', '2020-01-11', '14:01:17', 0),
(5, 'Order Success', 'Your order  has been paid successfully. needs several days to process your order Thank You', '2020-01-11', '14:01:31', 0),
(6, 'Order Confirm', 'INV20200110_0014 This order has Confirmed, we are preparing your order', '2020-01-11', '15:01:12', 0),
(7, 'Order Confirm', 'INV20200110_0013 This order has Confirmed, we are preparing your order', '2020-01-11', '15:01:04', 0),
(8, 'Order Confirm', 'INV20200110_0003 This order has Confirmed, we are preparing your order', '2020-01-11', '15:01:20', 0),
(9, 'Order Confirm', 'INV20200110_0001 This order has Confirmed, we are preparing your order', '2020-01-11', '15:01:51', 0),
(10, 'Order Confirm', 'INV20200110_0009 This order has Confirmed, we are preparing your order', '2020-01-11', '15:01:55', 0),
(11, 'Order Confirm', 'INV20200110_0011 This order has Confirmed, we are preparing your order', '2020-01-11', '15:01:42', 0),
(12, 'Order Confirm', 'INV20200111_0002 This order has Confirmed, we are preparing your order', '2020-01-11', '15:01:09', 1),
(13, 'Order was deliverd', ' INV20200109_0001 This order has Deliverd, Thank you deal with us', '2020-01-11', '16:01:46', 0),
(14, 'Order was deliverd', ' INV20200111_0002 This order has Deliverd, Thank you deal with us', '2020-01-11', '16:01:01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `pay_id` int(11) NOT NULL,
  `inv_id` varchar(25) NOT NULL,
  `pay_amount` float(15,2) NOT NULL,
  `pay_date` date NOT NULL,
  `pay_time` time NOT NULL,
  `pay_type` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`pay_id`, `inv_id`, `pay_amount`, `pay_date`, `pay_time`, `pay_type`) VALUES
(1, 'INV20200109_0001', 95000.00, '2019-08-09', '16:01:27', 'online'),
(2, 'INV20200109_0001', 25000.00, '2019-09-02', '02:50:00', 'offline'),
(3, 'INV20200109_0001', 10000.00, '2019-10-02', '01:00:00', 'offline'),
(4, 'INV20200109_0001', 10000.00, '2019-12-01', '01:00:00', 'offline'),
(5, 'INV20200110_0001', 30000.00, '2020-01-10', '12:01:18', 'online'),
(6, 'INV20200110_0002', 126000.00, '2020-01-10', '12:01:24', 'offline'),
(7, 'INV20200110_0003', 2700.00, '2020-01-10', '12:01:41', 'online'),
(8, 'INV20200110_0004', 95000.00, '2020-01-10', '12:01:12', 'online'),
(9, 'INV20200110_0005', 86000.00, '2020-01-10', '16:01:00', 'offline'),
(10, 'INV20200110_0006', 43000.00, '2020-01-10', '17:01:40', 'offline'),
(11, 'INV20200110_0007', 95000.00, '2020-01-10', '19:01:27', 'online'),
(12, 'INV20200110_0008', 95000.00, '2020-01-10', '19:01:37', 'online'),
(13, 'INV20200110_0009', 2700.00, '2020-01-10', '19:01:06', 'online'),
(14, 'INV20200110_0010', 95000.00, '2020-01-10', '19:01:07', 'online'),
(15, 'INV20200110_0011', 95000.00, '2020-01-10', '19:01:51', 'online'),
(16, 'INV20200110_0012', 2700.00, '2020-01-10', '20:01:40', 'online'),
(17, 'INV20200110_0013', 20000.00, '2020-01-10', '20:01:54', 'online'),
(18, 'INV20200110_0014', 1000.00, '2020-01-10', '20:01:35', 'online'),
(19, 'INV20200110_0015', 16200.00, '2020-01-10', '22:01:05', 'online'),
(20, 'INV20200110_0016', 3600.00, '2020-01-10', '23:01:44', 'online'),
(21, 'INV20200111_0001', 40000.00, '2020-01-11', '14:01:11', 'online'),
(22, 'INV20200111_0002', 10800.00, '2020-01-11', '14:01:26', 'online'),
(23, 'INV20200112_0001', 8400.00, '2020-01-12', '00:01:24', 'offline'),
(24, 'INV20200112_0002', 212760.00, '2020-01-12', '01:01:54', 'offline');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `prod_id` varchar(10) NOT NULL,
  `prod_name` varchar(200) NOT NULL,
  `prod_modal` varchar(100) NOT NULL,
  `prod_color` varchar(20) NOT NULL,
  `desc_id` varchar(10) NOT NULL,
  `prod_price` float(15,2) NOT NULL,
  `prod_dprice` float(15,2) NOT NULL,
  `prod_qty` int(11) NOT NULL,
  `prod_rlevel` int(11) NOT NULL,
  `prod_img` varchar(500) NOT NULL,
  `cat_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`prod_id`, `prod_name`, `prod_modal`, `prod_color`, `desc_id`, `prod_price`, `prod_dprice`, `prod_qty`, `prod_rlevel`, `prod_img`, `cat_id`) VALUES
('PRO00001', 'RO Luxury water purifier-Blue', 'NI-RO50-B', 'Blue', 'PRO00001', 45000.00, 42000.00, 10, 30, 'CAT00001/PRO00001/CAT00001_PRO00001_1576208438.jpg', 'CAT00001'),
('PRO00002', 'Faucets', 'Faucets12', 'None', 'PRO00002', 3000.00, 4500.00, 284, 20, 'CAT00003/PRO00002/CAT00003_PRO00002_1576117347.jpg', 'CAT00003'),
('PRO00003', 'Ro Basic Filter 500 Galloons', 'RO-BF-500', 'Blue', 'PRO00003', 42000.00, 0.00, 49, 10, 'CAT00001/PRO00003/CAT00001_PRO00003_1576172250.jpg', 'CAT00001'),
('PRO00004', '3 Stage Filter', 'ROG-50', 'Blue Transparent', 'PRO00004', 39000.00, 0.00, 66, 40, 'CAT00001/PRO00004/CAT00001_PRO00004_1576172268.jpg', 'CAT00001'),
('PRO00005', 'Ro Mambrane', 'romembrane', 'White', 'PRO00005', 2000.00, 0.00, 286, 15, 'CAT00003/PRO00005/CAT00003_PRO00005_1576656012.jpg', 'CAT00003'),
('PRO00006', 'Mineral ', 'mineral', 'None', 'PRO00006', 2500.00, 0.00, 0, 10, 'CAT00003/PRO00006/CAT00003_PRO00006_1576656727.jpg', 'CAT00003'),
('PRO00007', 'Warehouse Basic Filter', 'NI-RO-400G-WH', 'Blue', 'PRO00007', 95000.00, 0.00, 24, 25, 'CAT00002/PRO00007/CAT00002_PRO00007_1577129089.jpg', 'CAT00002'),
('PRO00008', 'Reverse Osmosis Warehouse 300 Gallons', 'NI-RO-300G-WOH', 'None', 'PRO00008', 54000.00, 0.00, 0, 5, 'CAT00002/PRO00008/CAT00002_PRO00008_1577160682.jpg', 'CAT00002'),
('PRO00009', 'RO Mineral Water Filter - RED', 'NI-RO50-R', 'Wine Red', 'PRO00009', 0.00, 41999.00, 0, 20, 'CAT00001/PRO00009/CAT00001_PRO00009_1578221976.jpg', 'CAT00001'),
('PRO00010', 'RO Mineral Water Filter - Pink', 'NI-RO50-P', 'Pink', 'PRO00010', 43000.00, 40000.00, 0, 20, 'CAT00001/PRO00010/CAT00001_PRO00010_1578222413.jpg', 'CAT00001'),
('PRO00011', 'Rivers Osmosis Basic Filter 200 Gallons', 'RO-BF-200', 'none', 'PRO00011', 35000.00, 0.00, 0, 30, 'CAT00001/PRO00011/CAT00001_PRO00011_1578223316.JPG', 'CAT00001'),
('PRO00012', 'RO CTO water filter', 'cto-filter', 'none', 'PRO00012', 0.00, 0.00, 299, 1, 'CAT00003/PRO00012/CAT00003_PRO00012_1578237663.png', 'CAT00003');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prod_desc`
--

CREATE TABLE `tbl_prod_desc` (
  `desc_id` varchar(10) NOT NULL,
  `prod_desc` varchar(1000) NOT NULL,
  `capacity` varchar(150) NOT NULL,
  `voltage` varchar(10) NOT NULL,
  `power` varchar(10) NOT NULL,
  `tank_capacity` varchar(10) NOT NULL,
  `material` varchar(150) NOT NULL,
  `dimension` varchar(150) NOT NULL,
  `contains` varchar(150) NOT NULL,
  `stage_pp` tinyint(4) NOT NULL,
  `stage_cto` tinyint(4) NOT NULL,
  `stage_post` tinyint(4) NOT NULL,
  `stage_ro` tinyint(4) NOT NULL,
  `stage_udf` tinyint(4) NOT NULL,
  `stage_min` tinyint(4) NOT NULL,
  `warr_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_prod_desc`
--

INSERT INTO `tbl_prod_desc` (`desc_id`, `prod_desc`, `capacity`, `voltage`, `power`, `tank_capacity`, `material`, `dimension`, `contains`, `stage_pp`, `stage_cto`, `stage_post`, `stage_ro`, `stage_udf`, `stage_min`, `warr_id`) VALUES
('PRO00001', 'The K2533 inline GAC filter is one of Omnipure\'s K series inline filters that easily install directly to your water line and reduce weeping or seepage potential. This filter uses granular activated carbon to reduce chlorine, taste and odor in your water and is available with various fittings to meet\r\n                  \r\n                  \r\n                  ', '190L', '220', '50Hz', '6L', 'Plastic', '52x20.5x45CM', 'Pressure Tank and Faucets', 1, 1, 1, 1, 1, 1, '1'),
('PRO00002', 'Free |  Metrial\r\n                  \r\n                  \r\n                  \r\n                  \r\n                  \r\n                  ', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '2'),
('PRO00003', 'ffff\r\n                  \r\n                  \r\n                  \r\n                  \r\n                  \r\n                  \r\n                  \r\n                  \r\n                  \r\n                  \r\n                  \r\n                  \r\n                  ', '200 Gallons', '220V', '50Hz', '6', 'Food safe, Non Toxic, engineering grade Plastics', '49CM x 35CM x 82 CM', 'NESMO RO water purifier with Pressure Tank and Faucets', 1, 1, 1, 1, 1, 1, '1'),
('PRO00004', 'The Nesmo RO System Can Be Configured To Meet Your Specific Requirements. There Are Ten Interchangeable Filters With A Variety Of Treatment That Can Be Tailored To Local Water Conditions, So You Water Is The Best It Can Be. The Innovative QC Twist And Lock Design Makes Service Simple. Twist Off The Old Cortege And Twist On The New. No Messy Sump Removal. Nesmo RO Systems Make Daring Water Better And Life Easier.\r\n                  ', '200', '220V', '50Hz', '6L', 'Food Safe, Non Toxic, Engineering Grade Plastics', '52x20.5x45CM 12.5/11.5KGS', 'NESMO RO Luxury Water Purifier With Pressure Tank And Faucets', 1, 1, 0, 0, 0, 0, '1'),
('PRO00005', 'The K2533 inline GAC filter is one of Omnipure\'s K series inline filters that easily install directly to your water line and reduce weeping or seepage potential. This filter uses granular activated carbon to reduce chlorine, taste and odor in your water and is available with various fittings to meet your water line\'s specifications. Compatible parts include K2536, K2528, and K2540.  |\r\nDimensions: 11.25\" X 2.125\" |\r\nReplace every 6-12 months |\r\nReduces chlorine, taste and odor\r\nNSF Certified |\r\nAvailable Fittings', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '3'),
('PRO00006', 'The AF-10-4010 filter uses mixed bed resins to reduce total ion concentration in your water. |\r\nDimensions: 9.9\" X 3.0\" | Replace every 6-12 months | Reduces ion concentration\r\n                  ', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '3'),
('PRO00007', 'This filter suitable for warehouse. its support to cover more than 500L daily. Works without any intervention. The system senses if the water tank is not full, purifies and stores water automatically.\r\n                  ', '50', '220', '50', '6000', 'Food safe, Non Toxic, engineering grade Plastics', '500', 'Free Installation with Guide', 1, 1, 1, 1, 1, 1, '1'),
('PRO00008', 'NESMO WATER Light Commercial Economy 200 GPD RO with enhanced chlorine removal with 20 Filter Housings\r\n                  ', 'MAX: GDP:300G/24H', '220', '50Hz', '11 Galloon', 'Food safe, Non Toxic, engineering grade Plastics', '20CM x 10CM X 40CM', 'Frucets,', 1, 1, 1, 1, 1, 1, '1'),
('PRO00009', 'Special Filter for home use this output is 300Galloons within 24Hours. this support 7 stages', '300', '220', '50', '6', 'Food safe, Non Toxic, engineering grade Plastics', '10 x 40 x 30', 'NESMO RO water purifier with Pressure Tank and Faucets', 1, 1, 1, 1, 1, 1, '1'),
('PRO00010', 'Special Filter for home use this output is 300Galloons within 24Hours. this support 7 stages', '300', '220', '50', '6', 'Food safe, Non Toxic, engineering grade Plastics', '', 'NESMO RO water purifier with Pressure Tank and Faucets', 1, 1, 1, 1, 1, 1, '1'),
('PRO00011', 'This filter suitable for home used ', '200', '220', '50', '6', 'Food safe, Non Toxic, engineering grade Plastics', '15 x 50 x 60', 'NESMO RO water purifier with Pressure Tank and Faucets', 0, 0, 1, 1, 1, 1, '1'),
('PRO00012', 'CTO is an acronym for Chlorine, Taste, and Odor. A filter recommended for CTO removal will produce water that is much clearer in color with a more appealing taste and elimination of odors.  |  Size : 70 x 248 MM | Weight: 350g', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prod_img`
--

CREATE TABLE `tbl_prod_img` (
  `pi_id` int(11) NOT NULL,
  `prod_id` varchar(10) NOT NULL,
  `prod_image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_prod_img`
--

INSERT INTO `tbl_prod_img` (`pi_id`, `prod_id`, `prod_image`) VALUES
(33, 'PRO00002', 'CAT00003/PRO00002/CAT00003_PRO00002_1578373224_0.JPG'),
(34, 'PRO00002', 'CAT00003/PRO00002/CAT00003_PRO00002_1578373294_0.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prod_warr`
--

CREATE TABLE `tbl_prod_warr` (
  `id` varchar(10) NOT NULL,
  `warrenty` varchar(500) NOT NULL,
  `nodate` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_prod_warr`
--

INSERT INTO `tbl_prod_warr` (`id`, `warrenty`, `nodate`) VALUES
('1', '1 year Warranty', 365),
('2', '6 Months warranty', 180),
('3', 'No Warranty', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_province`
--

CREATE TABLE `tbl_province` (
  `id` int(11) NOT NULL,
  `province` varchar(50) NOT NULL,
  `districts` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_province`
--

INSERT INTO `tbl_province` (`id`, `province`, `districts`) VALUES
(1, 'Central', 'Kandy'),
(2, 'Central', 'Matale'),
(3, 'Central', 'Nuwara Eliya'),
(4, 'Eastern', 'Ampara'),
(5, 'Eastern', 'Batticaloa'),
(6, 'Eastern', 'Trincomalee'),
(7, 'Northern', 'Jaffna'),
(8, 'Northern', 'Kilinochchi'),
(9, 'Northern', 'Mannar'),
(10, 'Northern', 'Mullaitivu'),
(11, 'Northern', 'Vavuniya'),
(12, 'North Central', 'Anuradhapura'),
(13, 'North Central', 'Polonnaruwa'),
(14, 'North Western', 'Kurunegala'),
(15, 'North Western', 'Puttalam'),
(16, 'Sabaragamuwa', 'Kegalle'),
(17, 'Sabaragamuwa', 'Ratnapura'),
(18, 'Southern', 'Galle'),
(19, 'Southern', 'Hambantota'),
(20, 'Southern', 'Matara'),
(21, 'Uva', 'Badulla'),
(22, 'Uva', 'Monaragala'),
(23, 'Western', 'Colombo'),
(24, 'Western', 'Gampaha'),
(25, 'Western', 'Kalutara');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `role_id` tinyint(1) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`role_id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Manager'),
(3, 'Sales Manager'),
(4, 'Technician ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_suppliers`
--

CREATE TABLE `tbl_suppliers` (
  `sup_id` varchar(10) NOT NULL,
  `sup_name` varchar(200) NOT NULL,
  `sup_contact` varchar(50) NOT NULL,
  `sup_email` varchar(200) NOT NULL,
  `sup_address` varchar(200) NOT NULL,
  `sup_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_suppliers`
--

INSERT INTO `tbl_suppliers` (`sup_id`, `sup_name`, `sup_contact`, `sup_email`, `sup_address`, `sup_status`) VALUES
('SUP0001', 'Ningbo Keman Environmental Technology Co Ltd', '85229458888', 'info@ningbo.com', 'Yuyao, Ningbo, Zhejiang, China', 1),
('SUP0002', 'HANGZHOU DEEFINE FILTRATION TECHNOLOGY CO., LTD.', '86-571-85858787', 'info@HANGZHOU.com', 'No. 32 Xianxing Road, Xianlin Town, Yuhang District, Hangzhou, Zhejiang, China 311122', 1),
('SUP0003', 'NanJing Tsung Water Technology Co., Ltd.', ' 86-25-87152848', 'info@NanJing.com', 'Dongshan Town, Jiangning Distrinct, Nanjing City, Nanjing, Jiangsu, China 211100', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ulogin`
--

CREATE TABLE `tbl_ulogin` (
  `user_name` varchar(100) NOT NULL,
  `user_pass` varchar(100) NOT NULL,
  `user_type` tinyint(1) NOT NULL,
  `pwd_reset` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ulogin`
--

INSERT INTO `tbl_ulogin` (`user_name`, `user_pass`, `user_type`, `pwd_reset`) VALUES
('admin@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 1),
('Lahiru@gmail.com', '202cb962ac59075b964b07152d234b70', 2, 1),
('sasith@gmail.com', '202cb962ac59075b964b07152d234b70', 4, 1),
('udara@gmail.com', '202cb962ac59075b964b07152d234b70', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `emp_id` varchar(9) NOT NULL,
  `emp_fname` varchar(100) NOT NULL,
  `emp_lname` varchar(100) NOT NULL,
  `emp_email` varchar(100) NOT NULL,
  `emp_address` varchar(200) NOT NULL,
  `emp_mobile` varchar(10) NOT NULL,
  `emp_gender` tinyint(1) NOT NULL,
  `emp_nic` varchar(20) NOT NULL,
  `emp_birth` date NOT NULL,
  `emp_join` date NOT NULL,
  `emp_role` tinyint(1) NOT NULL,
  `emp_img` varchar(200) NOT NULL,
  `emp_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`emp_id`, `emp_fname`, `emp_lname`, `emp_email`, `emp_address`, `emp_mobile`, `emp_gender`, `emp_nic`, `emp_birth`, `emp_join`, `emp_role`, `emp_img`, `emp_status`) VALUES
('EMP00001', 'admin', 'admin', 'admin@gmail.com', 'beliattaas8-97-', '0713137009', 1, '950340649V', '2019-10-16', '2019-10-30', 1, 'user.png', 1),
('EMP00002', 'Sasith', 'Sampath', 'sasith@gmail.com', 'Middiniya road, Weerakatiya                            ', '0775662750', 1, '970456852V', '2002-01-03', '0000-00-00', 0, 'EMP00002_1575396929.jpg', 1),
('EMP00003', 'Lahiru', 'Chamara', 'Lahiru@gmail.com', 'Ambala Beliatta', '0772564620', 1, '950214456V', '2002-01-01', '0000-00-00', 0, 'EMP00003_1575397234.jpg', 1),
('EMP00004', 'Udara', 'Weerasinghe', 'udara@gmail.com', 'gsfgsgfsgf\r\n                            ', '0714567894', 1, '852456852V', '0000-00-00', '0000-00-00', 0, 'EMP00004_1576564561.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_notification`
--

CREATE TABLE `tbl_user_notification` (
  `id` int(11) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `notif_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_warrenty`
--

CREATE TABLE `tbl_warrenty` (
  `warr_id` int(11) NOT NULL,
  `cus_id` varchar(10) NOT NULL,
  `inv_id` varchar(100) NOT NULL,
  `warr_claim` varchar(2000) NOT NULL,
  `operator` varchar(10) NOT NULL,
  `warr_date` date NOT NULL,
  `complete_date` date NOT NULL,
  `description` varchar(800) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_warrenty`
--

INSERT INTO `tbl_warrenty` (`warr_id`, `cus_id`, `inv_id`, `warr_claim`, `operator`, `warr_date`, `complete_date`, `description`, `status`) VALUES
(1, 'CUS00003', 'INV20200110_0010', '', '', '2020-01-10', '0000-00-00', '', 3),
(2, 'CUS00003', 'INV20200110_0013', '', 'EMP00001', '2020-01-12', '2020-01-12', 'or contact our system                            \r\n                        ', 1),
(4, 'CUS00003', 'INV20200110_0010', '', '', '2020-01-12', '0000-00-00', '', 3),
(5, 'CUS00003', 'INV20200110_0008', '', 'EMP00002', '2020-01-12', '2020-01-12', '                            \r\n                        ', 1),
(6, 'CUS00003', 'INV20200110_0008', '', '', '2020-01-12', '0000-00-00', '', 1),
(7, 'CUS00003', 'INV20200110_0004', '', '', '2020-01-12', '0000-00-00', '', 0),
(8, 'CUS00003', 'INV20200110_0010', '', '', '2020-01-12', '0000-00-00', '', 0),
(9, 'CUS00003', 'INV20200110_0010', '', '', '2020-01-12', '0000-00-00', '', 1),
(10, 'CUS00003', 'INV20200110_0010', '', '', '2020-01-12', '0000-00-00', '', 1),
(11, 'CUS00003', 'INV20200110_0010', '', '', '2020-01-12', '0000-00-00', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_warr_prod`
--

CREATE TABLE `tbl_warr_prod` (
  `id` int(11) NOT NULL,
  `warr_id` varchar(11) NOT NULL,
  `prod_id` varchar(10) NOT NULL,
  `warr_probleme` varchar(200) NOT NULL,
  `solution` varchar(600) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_warr_prod`
--

INSERT INTO `tbl_warr_prod` (`id`, `warr_id`, `prod_id`, `warr_probleme`, `solution`, `status`) VALUES
(1, '1', 'PRO00007', 'Can i change this                            \r\n                            ', '', 0),
(2, '2', 'PRO00002', 'I want to exchange this                            \r\n                            ', ' Definily you can sir , please come to our store                           \r\n                        ', 0),
(3, '4', 'PRO00007', ' request warrenty                           \r\n                            ', 'customer was caneled', 0),
(4, '5', 'PRO00007', 'I want to change my product', 'Yes We will contact you.                             \r\n                        ', 0),
(5, '6', 'PRO00007', 'I want', '', 0),
(6, '7', 'PRO00007', 'I want', '', 0),
(7, '8', 'PRO00007', 'I want              \r\n                            ', '', 0),
(8, '9', 'PRO00007', 'I want                            \r\n                            ', '', 0),
(9, '10', 'PRO00007', 'I want            \r\n                            ', '', 0),
(10, '11', 'PRO00007', 'I want      \r\n                            ', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_backup`
--
ALTER TABLE `tbl_backup`
  ADD PRIMARY KEY (`backup_id`);

--
-- Indexes for table `tbl_batch`
--
ALTER TABLE `tbl_batch`
  ADD PRIMARY KEY (`bat_id`),
  ADD KEY `prod_id` (`prod_id`),
  ADD KEY `fk_grn` (`grn_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `tbl_cuslogin`
--
ALTER TABLE `tbl_cuslogin`
  ADD PRIMARY KEY (`cus_email`);

--
-- Indexes for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  ADD PRIMARY KEY (`cus_id`),
  ADD KEY `cus_email` (`cus_email`);

--
-- Indexes for table `tbl_cus_address`
--
ALTER TABLE `tbl_cus_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cus_id` (`cus_id`);

--
-- Indexes for table `tbl_cus_notification`
--
ALTER TABLE `tbl_cus_notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cust` (`cus_id`),
  ADD KEY `fk_noti` (`notif_id`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`feed_id`),
  ADD KEY `fk_cus` (`cus_id`),
  ADD KEY `fk_prod` (`prod_id`);

--
-- Indexes for table `tbl_grn`
--
ALTER TABLE `tbl_grn`
  ADD PRIMARY KEY (`grn_id`),
  ADD KEY `kk_sup` (`sup_id`);

--
-- Indexes for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`inv_id`),
  ADD KEY `cus_id` (`cus_id`),
  ADD KEY `fk_users` (`inv_user`);

--
-- Indexes for table `tbl_inv_prod`
--
ALTER TABLE `tbl_inv_prod`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_inv` (`inv_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Indexes for table `tbl_messages`
--
ALTER TABLE `tbl_messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  ADD PRIMARY KEY (`not_id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`pay_id`),
  ADD KEY `inv_id` (`inv_id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`prod_id`),
  ADD KEY `fk_cat_id` (`cat_id`),
  ADD KEY `fk_desc` (`desc_id`);

--
-- Indexes for table `tbl_prod_desc`
--
ALTER TABLE `tbl_prod_desc`
  ADD PRIMARY KEY (`desc_id`),
  ADD KEY `desc_id` (`desc_id`);

--
-- Indexes for table `tbl_prod_img`
--
ALTER TABLE `tbl_prod_img`
  ADD PRIMARY KEY (`pi_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Indexes for table `tbl_prod_warr`
--
ALTER TABLE `tbl_prod_warr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_province`
--
ALTER TABLE `tbl_province`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tbl_suppliers`
--
ALTER TABLE `tbl_suppliers`
  ADD PRIMARY KEY (`sup_id`);

--
-- Indexes for table `tbl_ulogin`
--
ALTER TABLE `tbl_ulogin`
  ADD PRIMARY KEY (`user_name`),
  ADD KEY `fk_type` (`user_type`),
  ADD KEY `user_name` (`user_name`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `fk_email` (`emp_email`),
  ADD KEY `fk_role` (`emp_role`);

--
-- Indexes for table `tbl_user_notification`
--
ALTER TABLE `tbl_user_notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`user_id`),
  ADD KEY `fk_not` (`notif_id`);

--
-- Indexes for table `tbl_warrenty`
--
ALTER TABLE `tbl_warrenty`
  ADD PRIMARY KEY (`warr_id`),
  ADD KEY `cus_id` (`cus_id`),
  ADD KEY `operater` (`operator`),
  ADD KEY `inv_id` (`inv_id`);

--
-- Indexes for table `tbl_warr_prod`
--
ALTER TABLE `tbl_warr_prod`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_backup`
--
ALTER TABLE `tbl_backup`
  MODIFY `backup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_cus_address`
--
ALTER TABLE `tbl_cus_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_cus_notification`
--
ALTER TABLE `tbl_cus_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `feed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_inv_prod`
--
ALTER TABLE `tbl_inv_prod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_messages`
--
ALTER TABLE `tbl_messages`
  MODIFY `msg_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  MODIFY `not_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_prod_img`
--
ALTER TABLE `tbl_prod_img`
  MODIFY `pi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_province`
--
ALTER TABLE `tbl_province`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_user_notification`
--
ALTER TABLE `tbl_user_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_warrenty`
--
ALTER TABLE `tbl_warrenty`
  MODIFY `warr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_warr_prod`
--
ALTER TABLE `tbl_warr_prod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_batch`
--
ALTER TABLE `tbl_batch`
  ADD CONSTRAINT `fk_grn` FOREIGN KEY (`grn_id`) REFERENCES `tbl_grn` (`grn_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_batch_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `tbl_products` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_cuslogin`
--
ALTER TABLE `tbl_cuslogin`
  ADD CONSTRAINT `tbl_cuslogin_ibfk_1` FOREIGN KEY (`cus_email`) REFERENCES `tbl_customers` (`cus_email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_cus_address`
--
ALTER TABLE `tbl_cus_address`
  ADD CONSTRAINT `tbl_cus_address_ibfk_1` FOREIGN KEY (`cus_id`) REFERENCES `tbl_customers` (`cus_id`);

--
-- Constraints for table `tbl_cus_notification`
--
ALTER TABLE `tbl_cus_notification`
  ADD CONSTRAINT `fk_cust` FOREIGN KEY (`cus_id`) REFERENCES `tbl_customers` (`cus_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_noti` FOREIGN KEY (`notif_id`) REFERENCES `tbl_notification` (`not_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD CONSTRAINT `fk_cus` FOREIGN KEY (`cus_id`) REFERENCES `tbl_customers` (`cus_id`),
  ADD CONSTRAINT `fk_prod` FOREIGN KEY (`prod_id`) REFERENCES `tbl_products` (`prod_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_grn`
--
ALTER TABLE `tbl_grn`
  ADD CONSTRAINT `kk_sup` FOREIGN KEY (`sup_id`) REFERENCES `tbl_suppliers` (`sup_id`);

--
-- Constraints for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD CONSTRAINT `tbl_invoice_ibfk_1` FOREIGN KEY (`cus_id`) REFERENCES `tbl_customers` (`cus_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_inv_prod`
--
ALTER TABLE `tbl_inv_prod`
  ADD CONSTRAINT `fk_inv` FOREIGN KEY (`inv_id`) REFERENCES `tbl_invoice` (`inv_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_inv_prod_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `tbl_products` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD CONSTRAINT `tbl_payment_ibfk_1` FOREIGN KEY (`inv_id`) REFERENCES `tbl_invoice` (`inv_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD CONSTRAINT `fk_cat_id` FOREIGN KEY (`cat_id`) REFERENCES `tbl_category` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_prod_desc`
--
ALTER TABLE `tbl_prod_desc`
  ADD CONSTRAINT `fk_desc` FOREIGN KEY (`desc_id`) REFERENCES `tbl_products` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_prod_img`
--
ALTER TABLE `tbl_prod_img`
  ADD CONSTRAINT `tbl_prod_img_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `tbl_products` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_ulogin`
--
ALTER TABLE `tbl_ulogin`
  ADD CONSTRAINT `fk_role` FOREIGN KEY (`user_type`) REFERENCES `tbl_role` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_ulogin_ibfk_1` FOREIGN KEY (`user_name`) REFERENCES `tbl_users` (`emp_email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_user_notification`
--
ALTER TABLE `tbl_user_notification`
  ADD CONSTRAINT `fk_not` FOREIGN KEY (`notif_id`) REFERENCES `tbl_notification` (`not_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`emp_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_warrenty`
--
ALTER TABLE `tbl_warrenty`
  ADD CONSTRAINT `tbl_warrenty_ibfk_1` FOREIGN KEY (`cus_id`) REFERENCES `tbl_customers` (`cus_id`),
  ADD CONSTRAINT `tbl_warrenty_ibfk_3` FOREIGN KEY (`inv_id`) REFERENCES `tbl_invoice` (`inv_id`);

--
-- Constraints for table `tbl_warr_prod`
--
ALTER TABLE `tbl_warr_prod`
  ADD CONSTRAINT `tbl_warr_prod_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `tbl_products` (`prod_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
