-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2018 at 09:59 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.1.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ppdb_santop`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `ag_id` int(11) NOT NULL,
  `ag_tgl_posting` date NOT NULL,
  `ag_tgl_mulai` date NOT NULL,
  `ag_tgl_selesai` date NOT NULL,
  `ag_jam` varchar(50) NOT NULL,
  `ag_judul` varchar(100) NOT NULL,
  `ag_konten` text NOT NULL,
  `ag_tipe` enum('agenda','pengumuman') NOT NULL,
  `ag_publish` enum('Y','N') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`ag_id`, `ag_tgl_posting`, `ag_tgl_mulai`, `ag_tgl_selesai`, `ag_jam`, `ag_judul`, `ag_konten`, `ag_tipe`, `ag_publish`) VALUES
(1, '2018-05-10', '2018-05-31', '2018-05-31', '09:00 s/d 11:00', 'Test Judul Agenda', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'agenda', 'Y'),
(2, '2018-05-10', '2018-05-31', '2018-05-31', '09:00 s/d 11:00', 'Test Judul Pengumuman', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'pengumuman', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `bank_soal`
--

CREATE TABLE `bank_soal` (
  `bs_id` int(11) NOT NULL,
  `bs_pertanyaan` text NOT NULL,
  `bs_opsi_jawaban` text NOT NULL,
  `bs_jawaban` varchar(50) NOT NULL,
  `bs_publish` enum('Y','N') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_soal`
--

INSERT INTO `bank_soal` (`bs_id`, `bs_pertanyaan`, `bs_opsi_jawaban`, `bs_jawaban`, `bs_publish`) VALUES
(1, 'Siapakah nama presiden pertama Indonesia?', 'A. Joko Widodo;B. Susilo Bambang Yudhoyono;C. Ir. Soekarno;D. Megawati Soekarno Putri', 'C', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `calon_siswa`
--

CREATE TABLE `calon_siswa` (
  `cs_id` int(11) NOT NULL,
  `cs_nisn` varchar(10) NOT NULL,
  `cs_nama` varchar(100) NOT NULL,
  `cs_nama_panggilan` varchar(50) NOT NULL,
  `cs_tmpt_lahir` varchar(100) NOT NULL,
  `cs_tgl_lahir` date NOT NULL,
  `cs_jkel` enum('L','P') NOT NULL,
  `cs_agama` varchar(35) NOT NULL,
  `cs_tlp` varchar(36) NOT NULL,
  `cs_alamat` text NOT NULL,
  `cs_nama_ayah` varchar(100) NOT NULL,
  `cs_nama_ibu` varchar(100) NOT NULL,
  `cs_tlp_ortu` varchar(36) NOT NULL,
  `cs_nilai_un` double NOT NULL,
  `cs_email` varchar(100) NOT NULL,
  `cs_status` enum('acc','nacc') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ppdb_setup`
--

CREATE TABLE `ppdb_setup` (
  `setup_id` int(5) NOT NULL,
  `setup_date_pre` date NOT NULL,
  `setup_date_post` date NOT NULL,
  `setup_quota` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ppdb_setup`
--

INSERT INTO `ppdb_setup` (`setup_id`, `setup_date_pre`, `setup_date_post`, `setup_quota`) VALUES
(1, '2018-05-01', '2018-05-31', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `registrasi`
--

CREATE TABLE `registrasi` (
  `reg_id` varchar(8) NOT NULL,
  `reg_date` date NOT NULL,
  `cs_nisn` varchar(10) NOT NULL,
  `reg_key` varchar(64) NOT NULL,
  `reg_status` enum('pending','complete') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seleksi_penerimaan`
--

CREATE TABLE `seleksi_penerimaan` (
  `sp_id` int(11) NOT NULL,
  `reg_id` varchar(8) NOT NULL,
  `nilai_tes` int(11) NOT NULL,
  `sp_status` enum('V','X') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `site_pages`
--

CREATE TABLE `site_pages` (
  `pg_id` int(11) NOT NULL,
  `pg_title` varchar(100) NOT NULL,
  `pg_slug` varchar(250) NOT NULL,
  `pg_content` text NOT NULL,
  `pg_publish` enum('Y','N') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_pages`
--

INSERT INTO `site_pages` (`pg_id`, `pg_title`, `pg_slug`, `pg_content`, `pg_publish`) VALUES
(1, 'visi dan misi', 'visi-dan-misi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_keyname` varchar(50) NOT NULL,
  `user_keypass` varchar(64) NOT NULL,
  `user_fullname` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `role_id` int(5) NOT NULL,
  `user_status` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_keyname`, `user_keypass`, `user_fullname`, `user_email`, `role_id`, `user_status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin@domain.com', 1, 1),
(2, 'johndoe', 'johndoe', 'John Doe', 'johndoe@gmail.com', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_role`
--

CREATE TABLE `users_role` (
  `role_id` int(2) NOT NULL,
  `role_name` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_role`
--

INSERT INTO `users_role` (`role_id`, `role_name`) VALUES
(1, 'administrator'),
(2, 'staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`ag_id`);

--
-- Indexes for table `bank_soal`
--
ALTER TABLE `bank_soal`
  ADD PRIMARY KEY (`bs_id`);

--
-- Indexes for table `calon_siswa`
--
ALTER TABLE `calon_siswa`
  ADD PRIMARY KEY (`cs_id`),
  ADD UNIQUE KEY `cs_nisn` (`cs_nisn`);

--
-- Indexes for table `ppdb_setup`
--
ALTER TABLE `ppdb_setup`
  ADD PRIMARY KEY (`setup_id`);

--
-- Indexes for table `registrasi`
--
ALTER TABLE `registrasi`
  ADD PRIMARY KEY (`reg_id`);

--
-- Indexes for table `seleksi_penerimaan`
--
ALTER TABLE `seleksi_penerimaan`
  ADD PRIMARY KEY (`sp_id`);

--
-- Indexes for table `site_pages`
--
ALTER TABLE `site_pages`
  ADD PRIMARY KEY (`pg_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_role`
--
ALTER TABLE `users_role`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `ag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bank_soal`
--
ALTER TABLE `bank_soal`
  MODIFY `bs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `calon_siswa`
--
ALTER TABLE `calon_siswa`
  MODIFY `cs_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ppdb_setup`
--
ALTER TABLE `ppdb_setup`
  MODIFY `setup_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `seleksi_penerimaan`
--
ALTER TABLE `seleksi_penerimaan`
  MODIFY `sp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_pages`
--
ALTER TABLE `site_pages`
  MODIFY `pg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_role`
--
ALTER TABLE `users_role`
  MODIFY `role_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
