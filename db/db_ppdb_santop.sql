-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 08, 2018 at 03:34 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.18

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
-- Table structure for table `album_foto`
--

CREATE TABLE `album_foto` (
  `album_id` int(5) NOT NULL,
  `album_title` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `album_slug` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `album_desc` text COLLATE latin1_general_ci NOT NULL,
  `album_pict` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `album_foto`
--

INSERT INTO `album_foto` (`album_id`, `album_title`, `album_slug`, `album_desc`, `album_pict`) VALUES
(1, 'Arsip Sekolah', 'arsip-sekolah', '<p>Arsip Sekolah<br></p>', 'album_833458pict_1.jpg');

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
-- Table structure for table `berkas_docs`
--

CREATE TABLE `berkas_docs` (
  `berkas_id` int(10) NOT NULL,
  `cs_nisn` varchar(10) NOT NULL,
  `berkas_file` varchar(100) NOT NULL,
  `berkas_status` tinyint(4) NOT NULL COMMENT '1:not_verified,2:verified'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `berkas_docs`
--

INSERT INTO `berkas_docs` (`berkas_id`, `cs_nisn`, `berkas_file`, `berkas_status`) VALUES
(1, '1234567890', 'R1806001_berkas_pendaftaran.zip', 2);

-- --------------------------------------------------------

--
-- Table structure for table `calon_siswa`
--

CREATE TABLE `calon_siswa` (
  `cs_id` int(11) NOT NULL,
  `cs_nisn` varchar(10) NOT NULL,
  `cs_nis` varchar(12) NOT NULL,
  `cs_nama_lengkap` varchar(100) NOT NULL,
  `cs_tmpt_lahir` varchar(100) NOT NULL,
  `cs_tgl_lahir` date NOT NULL,
  `cs_jkel` enum('L','P') NOT NULL,
  `cs_agama` varchar(35) NOT NULL,
  `cs_no_tlp` varchar(36) NOT NULL,
  `cs_alamat_lengkap` text NOT NULL,
  `cs_nama_ayah` varchar(100) NOT NULL,
  `cs_nama_ibu` varchar(100) NOT NULL,
  `cs_nama_wali` varchar(100) NOT NULL,
  `cs_asal_sekolah` varchar(100) NOT NULL,
  `cs_email` varchar(100) NOT NULL,
  `berkas_id` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `calon_siswa`
--

INSERT INTO `calon_siswa` (`cs_id`, `cs_nisn`, `cs_nis`, `cs_nama_lengkap`, `cs_tmpt_lahir`, `cs_tgl_lahir`, `cs_jkel`, `cs_agama`, `cs_no_tlp`, `cs_alamat_lengkap`, `cs_nama_ayah`, `cs_nama_ibu`, `cs_nama_wali`, `cs_asal_sekolah`, `cs_email`, `berkas_id`) VALUES
(1, '1234567890', '123456789012', 'Roni Siahaan', 'Jakarta', '2006-05-05', 'L', 'Katholik', '081345676755', 'Jl. KH Agus Salim 16, Sabang, Menteng Jakarta Pusat', 'Toni Jefferson', 'Shinta Bashor', '', 'SDN Tebu Besar', 'ronisiaha@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `galeri_foto`
--

CREATE TABLE `galeri_foto` (
  `galeri_id` int(5) NOT NULL,
  `album_id` int(5) NOT NULL,
  `galeri_title` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `galeri_slug` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `galeri_desc` text COLLATE latin1_general_ci NOT NULL,
  `galeri_pict` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `galeri_foto`
--

INSERT INTO `galeri_foto` (`galeri_id`, `album_id`, `galeri_title`, `galeri_slug`, `galeri_desc`, `galeri_pict`) VALUES
(1, 1, 'Kegiatan Upacara', 'kegiatan-upacara', '<p>Kegiatan Upacara<br></p>', 'gal_231004g3.jpg'),
(2, 1, 'Ekskul Musik', 'ekskul-musik', '<p>Ekskul Musik<br></p>', 'gal_799939g1.jpg'),
(3, 1, 'Olahraga Bersepeda', 'olahraga-bersepeda', '<p>Olahraga Bersepeda<br></p>', 'gal_531195g2.jpg'),
(4, 1, 'Seminar Pendidikan', 'seminar-pendidikan', '<p>Seminar Pendidikan<br></p>', 'gal_724033g4.jpg');

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
  `reg_status` tinyint(4) NOT NULL COMMENT '1:process,2:file_verified,3:pass,4:not_pass'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registrasi`
--

INSERT INTO `registrasi` (`reg_id`, `reg_date`, `cs_nisn`, `reg_status`) VALUES
('R1806001', '2018-06-02', '1234567890', 1);

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
(1, 'tentang kami', 'tentang-kami', '<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse volutpat enim massa, facilisis ultrices nisi tempus quis. Fusce quis turpis vehicula, congue sapien at, vulputate tortor. Donec vitae nibh quam. Maecenas dapibus sem eget rhoncus molestie. In venenatis vitae libero eget porta. Proin cursus quam quis dolor euismod sollicitudin. Fusce eget elementum sem. Praesent sit amet placerat ante. Phasellus facilisis ante ac leo congue tristique. Aenean sed tincidunt enim, quis mollis libero. Morbi porttitor, diam quis lobortis laoreet, neque nunc varius tellus, eu sagittis magna arcu et nisl.</p><p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">Vivamus urna dolor, tristique ut faucibus vitae, faucibus et ante. Pellentesque convallis varius erat sed placerat. Nulla luctus sed urna non vehicula. Integer lobortis et tortor quis tempus. Nunc fermentum orci iaculis mauris pretium, vitae bibendum mi convallis. Fusce ullamcorper, massa quis laoreet auctor, justo neque pharetra ex, at cursus quam nunc ut leo. Ut sit amet enim tincidunt, ultricies mauris in, blandit nibh. Nam interdum odio vehicula, molestie risus sit amet, elementum justo. In ac maximus mi, et pellentesque mauris. Maecenas in neque ut diam dictum consequat et eget arcu. Sed ac suscipit velit. Donec lobortis mauris sapien, at consectetur purus rhoncus imperdiet. Cras lorem lacus, lacinia ac elit id, ullamcorper molestie odio. Mauris non magna tempor, porta libero ac, accumsan dui. Aliquam ac semper justo.</p><p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">Sed pretium lorem consequat nulla venenatis, eu gravida dui sollicitudin. Quisque id feugiat orci. Donec commodo nibh quis finibus volutpat. Fusce sit amet orci pellentesque, scelerisque augue at, maximus enim. Aliquam malesuada ligula tortor, ut molestie risus tempus efficitur. Sed sit amet euismod velit. Nullam pulvinar rutrum dapibus. Cras porta orci nec risus efficitur, vitae eleifend nulla pulvinar.</p><p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\">Phasellus mattis lacinia purus sed viverra. Maecenas quis nisl finibus, ultrices sapien facilisis, vulputate ante. Etiam non tristique magna. Nunc quis nulla sem. Vestibulum ut ante convallis arcu porta suscipit. Nulla ornare nec nisi vel hendrerit. Pellentesque vel ligula eleifend, pellentesque nisl non, imperdiet ante.</p>', 'Y'),
(2, 'Syarat Pendaftaran', 'syarat-pendaftaran', '<p>Harap membawa dokumen-dokumen sebagai berikut:</p><ol style=\"margin: 0px; padding: 0px 0px 10px; color: rgb(85, 85, 85); font-family: &quot;Lucida Grande&quot;, Tahoma, Verdana, Helvetica, sans-serif; font-size: 12px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\"><li style=\"margin: 0px; padding: 0px 0px 0px 20px; list-style-position: inside;\">Fotokopi Akta Kelahiran (1 lembar)</li><li style=\"margin: 0px; padding: 0px 0px 0px 20px; list-style-position: inside;\">Fotokopi Kartu Keluarga (1 lembar)</li><li style=\"margin: 0px; padding: 0px 0px 0px 20px; list-style-position: inside;\">Fotokopi surat baptis bagi yang beragama Katolik (1 lembar)</li><li style=\"margin: 0px; padding: 0px 0px 0px 20px; list-style-position: inside;\">Membuat surat pernyataan di atas kertas segel</li><li style=\"margin: 0px; padding: 0px 0px 0px 20px; list-style-position: inside;\">Pas foto hitam putih ukuran 3 x 4 cm (1 lembar)</li><li style=\"margin: 0px; padding: 0px 0px 0px 20px; list-style-position: inside;\">Fotokopi Ijazah dan Surat Tanda Lulus yang dilegalisir (masing-masing 1 lembar, menyusul) untuk SMP</li><li style=\"margin: 0px; padding: 0px 0px 0px 20px; list-style-position: inside;\">Fotokopi Rapor kelas V Semester 1, 2 dan Rapor kelas VI Semester I masing-masing 1 lembar, untuk SMP</li></ol>', 'Y');

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
(3, 'ronisiaha@gmail.com', 'd78b154c99fe7f06ebc02ebd63d1c87c', 'Roni Siahaan', 'ronisiaha@gmail.com', 3, 1);

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
(2, 'staff'),
(3, 'registrants');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`ag_id`);

--
-- Indexes for table `album_foto`
--
ALTER TABLE `album_foto`
  ADD PRIMARY KEY (`album_id`);

--
-- Indexes for table `bank_soal`
--
ALTER TABLE `bank_soal`
  ADD PRIMARY KEY (`bs_id`);

--
-- Indexes for table `berkas_docs`
--
ALTER TABLE `berkas_docs`
  ADD PRIMARY KEY (`berkas_id`);

--
-- Indexes for table `calon_siswa`
--
ALTER TABLE `calon_siswa`
  ADD PRIMARY KEY (`cs_id`),
  ADD UNIQUE KEY `cs_nisn` (`cs_nisn`);

--
-- Indexes for table `galeri_foto`
--
ALTER TABLE `galeri_foto`
  ADD PRIMARY KEY (`galeri_id`);

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
-- AUTO_INCREMENT for table `album_foto`
--
ALTER TABLE `album_foto`
  MODIFY `album_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bank_soal`
--
ALTER TABLE `bank_soal`
  MODIFY `bs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `berkas_docs`
--
ALTER TABLE `berkas_docs`
  MODIFY `berkas_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `calon_siswa`
--
ALTER TABLE `calon_siswa`
  MODIFY `cs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `galeri_foto`
--
ALTER TABLE `galeri_foto`
  MODIFY `galeri_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `pg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_role`
--
ALTER TABLE `users_role`
  MODIFY `role_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
