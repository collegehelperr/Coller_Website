-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2021 at 01:01 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

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

--
-- Dumping data for table `college_jenis_task`
--

INSERT INTO `college_jenis_task` (`id_jenis`, `jenis_task`) VALUES
(1, 'Quiz'),
(2, 'Assignment');

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

--
-- Dumping data for table `college_notes`
--

INSERT INTO `college_notes` (`id_note`, `uid`, `judul_note`, `tgl_note`, `isi_note`) VALUES
(2, 1, 'asd bambang 555', '2021-11-22', 'asd bambang ttt'),
(3, 1, 'test popstman 2', '2021-11-22', 'postman2nsjsjs\n'),
(6, 1, 'tes update aaaa', '2021-11-22', 'update'),
(7, 1, '2', '2021-11-22', 'enjdkkskskssmsk\njskskskks\njsjsjsnnss'),
(8, 1, 'jsjskks', '2021-11-22', 'hsjsjsjsjsjsjsjjsjsjs\nhsjsjsjsjsjsjsjjsjsjshsjsjsjsjsjsjsjjsjsjs\nhsjsjsjsjsjsjsjjsjsjshsjsjsjsjsjsjsjjsjsjs\nhsjsjsjsjsjsjsjjsjsjshsjsjsjsjsjsjsjjsjsjs\nhsjsjsjsjsjsjsjjsjsjs\nhsjsjsjsjsjsjsjjsjsjs\nhsjsjsjsjsjsjsjjsjsjs'),
(9, 1, 'test popstman 2', '2021-11-22', 'postman'),
(10, 1, 'jsjskks 8', '2021-11-22', 'hsjsjsjsjsjsjsjjsjsjs\nhsjsjsjsjsjsjsjjsjsjshsjsjsjsjsjsjsjjsjsjs\nhsjsjsjsjsjsjsjjsjsjshsjsjsjsjsjsjsjjsjsjs\nhsjsjsjsjsjsjsjjsjsjshsjsjsjsjsjsjsjjsjsjs\nhsjsjsjsjsjsjsjjsjsjs\nhsjsjsjsjsjsjsjjsjsjs\nhsjsjsjsjsjsjsjjsjsjs'),
(11, 2, 'haha', '2021-11-22', 'hahahahahhaa'),
(12, 2, 'haha', '2021-11-22', 'hahahahahhaa'),
(13, 2, 'haha', '2021-11-22', 'hahahahahhaa'),
(14, 2, 'haha', '2021-11-22', 'hahahahahhaa'),
(15, 2, 'haha', '2021-11-22', 'hahahahahhaa'),
(16, 2, 'haha', '2021-11-22', 'hahahahahhaa'),
(17, 1, 'hahaha', '2021-11-22', 'hahahaha\n'),
(18, 1, 'rukdgkgd', '2021-11-22', 'sgjgsjgs'),
(19, 1, 'rukdgkgd', '2021-11-22', 'sgjgsjgs'),
(20, 1, 'tes update aaaa', '2021-11-22', 'update'),
(21, 2, 'tes update aaaa', '2021-11-22', 'update'),
(22, 1, 'baba', '2021-11-22', 'bababa'),
(23, 2, 'tes bambang ', '2021-11-22', 'bambang'),
(26, 1, 'tambah', '2021-11-22', 'baru'),
(27, 1, 'asd bambang up', '2021-11-22', 'asd bambang up'),
(28, 1, 'test popstman 23', '2021-11-22', 'postman2nsjsjs\n haha'),
(29, 1, 'Tes maa', '2021-11-22', 'mamamamammaa');

-- --------------------------------------------------------

--
-- Table structure for table `college_schedule`
--

CREATE TABLE `college_schedule` (
  `id_schedule` int(6) NOT NULL,
  `uid` int(6) NOT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu') NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_berakhir` time NOT NULL,
  `nama_schedule` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `college_schedule`
--

INSERT INTO `college_schedule` (`id_schedule`, `uid`, `hari`, `waktu_mulai`, `waktu_berakhir`, `nama_schedule`) VALUES
(22, 22, 'Senin', '11:11:00', '11:12:00', 'Interaksi Manusia & Komputer');

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

--
-- Dumping data for table `college_task`
--

INSERT INTO `college_task` (`id_task`, `uid`, `detail_task`, `tgl_ddline`, `status`, `id_jenis`) VALUES
(1, 1, 'tes task', '2021-11-22', 0, 2);

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
  `nama_lengkap` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `profile_img` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `email`, `password`, `nama_lengkap`, `no_hp`, `profile_img`) VALUES
(1, 'admin@gmail.com', '1', 'Admins', '081212341231', 'https://www.99.co/blog/indonesia/wp-content/uploads/2021/01/perbedaan-am-dan-pm.jpg'),
(2, 'clay@mail.co', 'clay', 'Clayman', '111', 'http://localhost/coller_website/img/thumb_profile.png'),
(3, 'user@mail.co', 'user', 'User', '1122', '/img/profil/default.jpg'),
(7, 'muhammadathallah70@gmail.com', '123456', 'Athallah3', '081383090391', '/img/profil/default.jpg'),
(8, 'aaaa', 'bbb', 'vva', '2311', '/img/profil/default.jpg'),
(9, 'aa1', 'bb1', 'cc1', '4411', '/img/profil/default.jpg'),
(10, 'tes@admin.com', 'admin', 'tes admin', '991', '/img/profil/default.jpg'),
(11, 'tesemail@mail.co', 'admin', 'Adam H', '67671', '/img/profil/default.jpg'),
(12, 'tes3@mail.co', 'admin', 'Tes ke 3', '08876', '/img/profil/default.jpg'),
(13, 'dfrt@gmail.com', 'q', 'bsjsjsj', '3434', '/img/profil/default.jpg'),
(14, 'admin1@admin.com', 'admin', 'admin 1', '4412', '/img/profil/default.jpg'),
(15, '11', '111', '11', '115', '/img/profil/default.jpg'),
(16, 'claycupu@admin.com', 'admin', 'Clayman', '08525896643', '/img/profil/IMG_20211120_172432810.jpg'),
(17, 'newuser@mail.co', 'admin', 'User ', '077', '/img/profil/IMG_20211120_173637730.jpg'),
(18, 'bambang@mail.co', 'admin', 'Bambang', '08877', '/img/profil/IMG_20211120_175138366.jpg'),
(19, 'k.nisa11602@gmail.com', '12345678', 'khoirunnisa', '087853123339', '/img/profil/default.jpg'),
(20, 'haha@mail.co', 'hahaha', 'hahaha', '8856', '/img/profil/IMG_20211120_233607707.jpg'),
(21, 'col@gmail.com', 'col', 'col', '11231', '/img/profil/default.jpg'),
(22, 'rap@gmail.com', 'rap', 'Rap Karta', '08214739338299', 'img/profil/pngwing.com.png');

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
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `no_hp` (`no_hp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `college_jenis_task`
--
ALTER TABLE `college_jenis_task`
  MODIFY `id_jenis` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `college_notes`
--
ALTER TABLE `college_notes`
  MODIFY `id_note` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `college_schedule`
--
ALTER TABLE `college_schedule`
  MODIFY `id_schedule` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `college_task`
--
ALTER TABLE `college_task`
  MODIFY `id_task` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `college_todolist`
--
ALTER TABLE `college_todolist`
  MODIFY `id_todolist` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
