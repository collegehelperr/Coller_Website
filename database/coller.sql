-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2021 at 08:57 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coller`
--

-- --------------------------------------------------------

--
-- Table structure for table `college_jenis_task`
--

CREATE TABLE `college_jenis_task` (
  `id_jenis` int(2) NOT NULL,
  `jenis_task` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `college_notes`
--

CREATE TABLE `college_notes` (
  `id_note` int(6) NOT NULL,
  `uid` int(6) NOT NULL,
  `judul_note` varchar(225) NOT NULL,
  `tgl_note` date NOT NULL,
  `isi_note` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `college_schedule`
--

CREATE TABLE `college_schedule` (
  `id_schedule` int(6) NOT NULL,
  `uid` int(6) NOT NULL,
  `hari` enum('senin','selasa','rabu','kamis','jumat','sabtu','minggu') NOT NULL,
  `waktu` time NOT NULL,
  `nama_schedule` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `college_task`
--

CREATE TABLE `college_task` (
  `id_task` int(6) NOT NULL,
  `uid` int(6) NOT NULL,
  `detail_task` varchar(225) NOT NULL,
  `tgl_ddline` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `id_jenis` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `college_todolist`
--

CREATE TABLE `college_todolist` (
  `id_todolist` int(6) NOT NULL,
  `uid` int(6) NOT NULL,
  `nama_todolist` varchar(225) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `tgl_todolist` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(6) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(16) NOT NULL,
  `conpass` varchar(8) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `nomor_telepon` varchar(13) NOT NULL,
  `profile_img` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `email`, `password`, `conpass`, `nama_lengkap`, `nomor_telepon`, `profile_img`) VALUES
(5, 'nab@gmail.com', 'tes', 'tes', 'tes', '090', 'https://i0.wp.com/lia-martadinata.com/wp-content/uploads/2019/11/iconfinder-8-avatar-2754583_120515.png?ssl=1'),
(6, 'pal@gmail.com', '123', '123', 'tes', '000', 'https://i0.wp.com/lia-martadinata.com/wp-content/uploads/2019/11/iconfinder-8-avatar-2754583_120515.png?ssl=1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `college_jenis_task`
--
ALTER TABLE `college_jenis_task`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `college_notes`
--
ALTER TABLE `college_notes`
  ADD PRIMARY KEY (`id_note`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `college_schedule`
--
ALTER TABLE `college_schedule`
  ADD PRIMARY KEY (`id_schedule`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `college_task`
--
ALTER TABLE `college_task`
  ADD PRIMARY KEY (`id_task`),
  ADD KEY `uid` (`uid`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indexes for table `college_todolist`
--
ALTER TABLE `college_todolist`
  ADD PRIMARY KEY (`id_todolist`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `college_jenis_task`
--
ALTER TABLE `college_jenis_task`
  MODIFY `id_jenis` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `college_notes`
--
ALTER TABLE `college_notes`
  MODIFY `id_note` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `college_schedule`
--
ALTER TABLE `college_schedule`
  MODIFY `id_schedule` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `college_task`
--
ALTER TABLE `college_task`
  MODIFY `id_task` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `college_todolist`
--
ALTER TABLE `college_todolist`
  MODIFY `id_todolist` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `college_notes`
--
ALTER TABLE `college_notes`
  ADD CONSTRAINT `college_notes_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `college_schedule`
--
ALTER TABLE `college_schedule`
  ADD CONSTRAINT `college_schedule_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `college_task`
--
ALTER TABLE `college_task`
  ADD CONSTRAINT `college_task_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `college_task_ibfk_2` FOREIGN KEY (`id_jenis`) REFERENCES `college_jenis_task` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `college_todolist`
--
ALTER TABLE `college_todolist`
  ADD CONSTRAINT `college_todolist_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
