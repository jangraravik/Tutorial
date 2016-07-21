-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2016 at 07:53 AM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_login_with_role_access_level_privileges`
--

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `mod_modulegroupcode` varchar(25) NOT NULL,
  `mod_modulegroupname` varchar(50) NOT NULL,
  `mod_modulecode` varchar(25) NOT NULL,
  `mod_modulename` varchar(50) NOT NULL,
  `mod_modulegrouporder` int(3) NOT NULL,
  `mod_moduleorder` int(3) NOT NULL,
  `mod_modulepagename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`mod_modulegroupcode`, `mod_modulegroupname`, `mod_modulecode`, `mod_modulename`, `mod_modulegrouporder`, `mod_moduleorder`, `mod_modulepagename`) VALUES
('CHECKOUT', 'Customer Checkout', 'PAYMENT', 'Payment', 3, 2, 'payment.php'),
('CHECKOUT', 'Customer Checkout', 'SHIPPING', 'Shipping', 3, 1, 'shipping.php'),
('CHECKOUT', 'Customer Checkout', 'TAX', 'Tax', 3, 3, 'tax.php'),
('INVT', 'Inventory', 'PURCHASES', 'Purchases', 2, 1, 'purchases.php'),
('INVT', 'Inventory', 'SALES', 'Sales', 2, 3, 'sales.php'),
('INVT', 'Inventory', 'STOCKS', 'Stocks', 2, 2, 'stocks.php');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_rolecode` varchar(50) NOT NULL,
  `role_rolename` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_rolecode`, `role_rolename`) VALUES
('ADMIN', 'Administrator'),
('STAFF', 'Office Staff'),
('SUPERADMIN', 'Super Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `role_rights`
--

CREATE TABLE `role_rights` (
  `rr_rolecode` varchar(50) NOT NULL,
  `rr_modulecode` varchar(25) NOT NULL,
  `rr_create` enum('yes','no') NOT NULL DEFAULT 'no',
  `rr_edit` enum('yes','no') NOT NULL DEFAULT 'no',
  `rr_delete` enum('yes','no') NOT NULL DEFAULT 'no',
  `rr_view` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_rights`
--

INSERT INTO `role_rights` (`rr_rolecode`, `rr_modulecode`, `rr_create`, `rr_edit`, `rr_delete`, `rr_view`) VALUES
('ADMIN', 'PAYMENT', 'no', 'yes', 'yes', 'yes'),
('ADMIN', 'PURCHASES', 'no', 'yes', 'yes', 'yes'),
('ADMIN', 'SALES', 'no', 'yes', 'yes', 'yes'),
('ADMIN', 'SHIPPING', 'no', 'yes', 'yes', 'yes'),
('ADMIN', 'STOCKS', 'no', 'yes', 'yes', 'yes'),
('ADMIN', 'TAX', 'no', 'yes', 'yes', 'yes'),
('STAFF', 'PAYMENT', 'no', 'no', 'no', 'yes'),
('STAFF', 'SALES', 'yes', 'yes', 'yes', 'yes'),
('STAFF', 'SHIPPING', 'yes', 'yes', 'yes', 'yes'),
('STAFF', 'STOCKS', 'no', 'no', 'no', 'yes'),
('SUPERADMIN', 'PAYMENT', 'yes', 'yes', 'yes', 'yes'),
('SUPERADMIN', 'PURCHASES', 'yes', 'yes', 'yes', 'yes'),
('SUPERADMIN', 'SALES', 'yes', 'yes', 'yes', 'yes'),
('SUPERADMIN', 'SHIPPING', 'yes', 'yes', 'yes', 'yes'),
('SUPERADMIN', 'STOCKS', 'yes', 'yes', 'yes', 'yes'),
('SUPERADMIN', 'TAX', 'yes', 'yes', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `system_users`
--

CREATE TABLE `system_users` (
  `u_userid` int(11) NOT NULL,
  `u_username` varchar(100) NOT NULL,
  `u_password` varchar(255) NOT NULL,
  `u_rolecode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `system_users`
--

INSERT INTO `system_users` (`u_userid`, `u_username`, `u_password`, `u_rolecode`) VALUES
(1, 'superadmin', 'superadmin', 'SUPERADMIN'),
(2, 'admin', 'admin', 'ADMIN'),
(3, 'staff', 'staff', 'STAFF');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`mod_modulegroupcode`,`mod_modulecode`),
  ADD UNIQUE KEY `mod_modulecode` (`mod_modulecode`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_rolecode`);

--
-- Indexes for table `role_rights`
--
ALTER TABLE `role_rights`
  ADD PRIMARY KEY (`rr_rolecode`,`rr_modulecode`),
  ADD KEY `role_rights_ibfk_2` (`rr_modulecode`);

--
-- Indexes for table `system_users`
--
ALTER TABLE `system_users`
  ADD PRIMARY KEY (`u_userid`),
  ADD KEY `system_users_ibfk_1` (`u_rolecode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `system_users`
--
ALTER TABLE `system_users`
  MODIFY `u_userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `role_rights`
--
ALTER TABLE `role_rights`
  ADD CONSTRAINT `role_rights_ibfk_1` FOREIGN KEY (`rr_rolecode`) REFERENCES `role` (`role_rolecode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `role_rights_ibfk_2` FOREIGN KEY (`rr_modulecode`) REFERENCES `module` (`mod_modulecode`) ON UPDATE CASCADE;

--
-- Constraints for table `system_users`
--
ALTER TABLE `system_users`
  ADD CONSTRAINT `system_users_ibfk_1` FOREIGN KEY (`u_rolecode`) REFERENCES `role` (`role_rolecode`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
