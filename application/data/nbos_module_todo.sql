-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jul 31, 2016 at 02:36 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nbos_module_todo`
--

-- --------------------------------------------------------

--
-- Table structure for table `nbos_tenant`
--

CREATE TABLE `nbos_tenant` (
  `id` int(11) NOT NULL,
  `tenant_id` varchar(200) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `tenant_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tenant module is going to serve';

-- --------------------------------------------------------

--
-- Table structure for table `nbos_user`
--

CREATE TABLE `nbos_user` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `uuid` varchar(200) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

CREATE TABLE `todos` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `user_id` varchar(200) NOT NULL,
  `tenant_id` varchar(200) NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `todos`
--

INSERT INTO `todos` (`id`, `title`, `description`, `user_id`, `tenant_id`, `completed`) VALUES
(1, 'Get grocery  ', 'Get grocery from super market where discount offer is huge', '', '0', 0),
(2, 'pick kids ', 'Pick kids from school in evening', '', 'TNT:hariome', 0),
(3, 'Get grocery  ', 'Get grocery from super market where discount offer is huge', '', '0', 0),
(4, 'Get pundits online', 'Get pundits online', 'MBR:a131cc78-4a19-4ea6-aef6-72de8e0745ab', 'TNT:hariome', 0),
(5, 'pick kids ', 'Pick kids from school in evening', 'MBR:a131cc78-4a19-4ea6-aef6-72de8e0745ab', '0', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nbos_tenant`
--
ALTER TABLE `nbos_tenant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tenant_id` (`tenant_id`);

--
-- Indexes for table `nbos_user`
--
ALTER TABLE `nbos_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `todos`
--
ALTER TABLE `todos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `tenant_id` (`tenant_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nbos_tenant`
--
ALTER TABLE `nbos_tenant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nbos_user`
--
ALTER TABLE `nbos_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `todos`
--
ALTER TABLE `todos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
