-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2021 at 10:23 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kelas_b`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chat_message`
--

CREATE TABLE `tbl_chat_message` (
  `chat_message_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `chat_message` mediumtext NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_file`
--

CREATE TABLE `tbl_file` (
  `id_file` int(255) NOT NULL,
  `id_pemilik_file` int(11) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `ukuran_file` int(255) NOT NULL,
  `tipe_file` varchar(50) NOT NULL,
  `waktu_upload` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_file`
--

INSERT INTO `tbl_file` (`id_file`, `id_pemilik_file`, `nama_file`, `ukuran_file`, `tipe_file`, `waktu_upload`) VALUES
(149, 1806000, '66613264_p0_master1200.png', 1278684, 'png', 'June 6, 2021');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_file_tmp`
--

CREATE TABLE `tbl_file_tmp` (
  `id_file` int(255) NOT NULL,
  `id_pemilik_file` int(11) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `ukuran_file` int(255) NOT NULL,
  `tipe_file` varchar(50) NOT NULL,
  `waktu_upload` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`user_id`, `username`, `password`, `id_role`) VALUES
(1, 'admin@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 1),
(2, '1806010@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(3, '1806020@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(4, '1806034@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(5, '1806037@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(6, '1806039@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(7, '1806040@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(8, '1806041@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(9, '1806042@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(10, '1806043@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(11, '1806044@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(12, '1806045@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(13, '1806046@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(14, '1806048@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(15, '1806049@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(16, '1806050@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(17, '1806052@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(18, '1806053@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(19, '1806054@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(20, '1806055@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(21, '1806057@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(22, '1806058@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(23, '1806059@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(24, '1806060@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(25, '1806061@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(26, '1806062@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(27, '1806063@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(28, '1806065@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(29, '1806067@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(30, '1806068@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(31, '1806069@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(32, '1806070@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(33, '1806071@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(34, '1806072@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(35, '1806074@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(36, '1806075@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(37, '1706056@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2),
(38, '2006039@sttgarut.ac.id', 'dd333e8fd2983f714843c636620f2a57', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login_details`
--

CREATE TABLE `tbl_login_details` (
  `login_details_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_activitity` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_type` enum('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mahasiswa`
--

CREATE TABLE `tbl_mahasiswa` (
  `npm` int(7) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kelas` char(1) NOT NULL,
  `jurusan` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_mahasiswa`
--

INSERT INTO `tbl_mahasiswa` (`npm`, `nama`, `alamat`, `kelas`, `jurusan`, `email`, `foto`) VALUES
(1706056, 'Zulfikar Mauludinnata', 'Garut', 'B', 'Teknik Informatika', '1706056@sttgarut.ac.id', 'sttgarut.png'),
(1806000, 'Admin', 'Sekolah Tinggi Teknologi Garut', 'B', 'Teknik Informatika', 'admin@sttgarut.ac.id', 'foto_1806000.png'),
(1806010, 'Sindi Mulyawati', 'Cilawu', 'B', 'Teknik Informatika', '1806010@sttgarut.ac.id', 'foto_1806010.jpg'),
(1806020, 'Indra', 'Pembangunan', 'B', 'Teknik Informatika', '1806020@sttgarut.ac.id', 'foto_1806020.jpg'),
(1806034, 'Fakhrul Hawariyan', 'Leles', 'B', 'Teknik Informatika', '1806034@sttgarut.ac.id', 'foto_1806034.jpg'),
(1806037, 'Mohamad Fikri Haekal', 'Nagrog', 'B', 'Teknik Informatika', '1806037@sttgarut.ac.id', 'foto_1806037.jpg'),
(1806039, 'Sandra Budi Garnisa', 'Rancabango', 'B', 'Teknik Informatika', '1806039@sttgarut.ac.id', 'foto_1806039.jpg'),
(1806040, 'Husni Firman Yusuf', 'Ciparay', 'B', 'Teknik Informatika', '1806040@sttgarut.ac.id', 'foto_1806040.jpg'),
(1806041, 'Muhamad Iqbal Ismail Safei', 'Cibatu', 'B', 'Teknik Informatika', '1806041@sttgarut.ac.id', 'foto_1806041.jpg'),
(1806042, 'David Friedman', 'David Gaming House', 'B', 'Teknik Informatika', '1806042@sttgarut.ac.id', 'foto_1806042.jpg'),
(1806043, 'Ilham Syahidatul Rajab', 'Limbangan Garut', 'B', 'Teknik Informatika', '1806043@sttgarut.ac.id', 'foto_1806043.jpg'),
(1806044, 'Asep Kurniawan', 'Cilawu', 'B', 'Teknik Informatika', '1806044@sttgarut.ac.id', 'foto_1806044.png'),
(1806045, 'Wulan Dwi Lestari', 'Cikajang', 'B', 'Teknik Informatika', '1806045@sttgarut.ac.id', 'foto_1806045.jpg'),
(1806046, 'Muhammad Ihsan Riyadhi', 'Tasik', 'B', 'Teknik Informatika', '1806046@sttgarut.ac.id', 'foto_1806046.png'),
(1806048, 'Moch. Renaldi Rismawan', 'Samarang', 'B', 'Teknik Informatika', '1806048@sttgarut.ac.id', 'foto_1806048.jpg'),
(1806049, 'Moch. Lutfhi Waliyul Fahmi', 'Tarogong Kidul', 'B', 'Teknik Informatika', '1806049@sttgarut.ac.id', 'foto_1806049.jpg'),
(1806050, 'Diar Nur Rizky', 'Bayongbong', 'B', 'Teknik Informatika', '1806050@sttgarut.ac.id', 'foto_1806050.jpg'),
(1806052, 'Tania Agusviani Wahidah', 'Cibatu', 'B', 'Teknik Informatika', '1806052@sttgarut.ac.id', 'foto_1806052.png'),
(1806053, 'Renaldy Alamsyah', 'Cibatu', 'B', 'Teknik Informatika', '1806053@sttgarut.ac.id', 'foto_1806053.jpg'),
(1806054, 'Ridwan Burhanudin', 'Cempaka', 'B', 'Teknik Informatika', '1806054@sttgarut.ac.id', 'foto_1806054.jpg'),
(1806055, 'Kiki Indra Nugraha', 'Samarang', 'B', 'Teknik Informatika', '1806055@sttgarut.ac.id', 'foto_1806055.jpg'),
(1806057, 'Andra Septiandri Rahmawan', 'Leuwigoong', 'B', 'Teknik Informatika', '1806057@sttgarut.ac.id', 'foto_1806057.jpg'),
(1806058, 'M. Aldi Nugraha ', 'Cempaka', 'B', 'Teknik Informatika', '1806058@sttgarut.ac.id', 'foto_1806058.jpg'),
(1806059, 'Candra Kirana', 'Kontrakan Candra', 'B', 'Teknik Informatika', '1806059@sttgarut.ac.id', 'foto_1806059.jpg'),
(1806060, 'Rizki Raisha Nurhakim', 'Leles', 'B', 'Teknik Informatika', '1806060@sttgarut.ac.id', 'foto_1806060.png'),
(1806061, 'Alfian Akmal Adiwangsa', 'Mawar', 'B', 'Teknik Informatika', '1806061@sttgarut.ac.id', 'foto_1806061.jpg'),
(1806062, 'Abdul Basri Musa', 'Limbangan', 'B', 'Teknik Informatika', '1806062@sttgarut.ac.id', 'foto_1806062.jpg'),
(1806063, 'Taufik Darul Ikhrom', 'Perum Oma Indah', 'B', 'Teknik Informatika', '1806063@sttgarut.ac.id', 'foto_1806063.jpg'),
(1806065, 'Fauzan Abdurrahman', 'Sucikaler', 'B', 'Teknik Informatika', '1806065@sttgarut.ac.id', 'foto_1806065.jpg'),
(1806067, 'Muhammad Zidan Fauzan', 'Jayaraga', 'B', 'Teknik Informatika', '1806067@sttgarut.ac.id', 'foto_1806067.png'),
(1806068, 'Naufal Muhammad', 'Cibatu', 'B', 'Teknik Informatika', '1806068@sttgarut.ac.id', 'foto_1806068.jpg'),
(1806069, 'Nabilla Febriani Helmalia P', 'Sucinaraja', 'B', 'Teknik Informatika', '1806069@sttgarut.ac.id', 'foto_1806069.jpg'),
(1806070, 'Marshell Auliaano Dwiefashcky', 'Luar Garut', 'B', 'Teknik Informatika', '1806070@sttgarut.ac.id', 'foto_1806070.jpg'),
(1806071, 'Ghina Ambarrona Rosita', 'Samarang', 'B', 'Teknik Informatika', '1806071@sttgarut.ac.id', 'foto_1806071.png'),
(1806072, 'Epril Mohamad Rizaludin', 'Samarang', 'B', 'Teknik Informatika', '1806072@sttgarut.ac.id', 'foto_1806072.jpg'),
(1806074, 'Pazar Ahmad Alawi', 'Garut Kota', 'B', 'Teknik Informatika', '1806074@sttgarut.ac.id', 'foto_1806074.jpg'),
(1806075, 'Novan Pawazhiki', 'Kerkop', 'B', 'Teknik Informatika', '1806075@sttgarut.ac.id', 'foto_1806075.png'),
(2006039, 'Teguh Aji Renaldi', 'Garut', 'B', 'Teknik Informatika', '2006039@sttgarut.ac.id', 'foto_2006039.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_role` int(1) NOT NULL,
  `role` enum('Admin','User') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_role`, `role`) VALUES
(1, 'Admin'),
(2, 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_chat_message`
--
ALTER TABLE `tbl_chat_message`
  ADD PRIMARY KEY (`chat_message_id`);

--
-- Indexes for table `tbl_file`
--
ALTER TABLE `tbl_file`
  ADD PRIMARY KEY (`id_file`);

--
-- Indexes for table `tbl_file_tmp`
--
ALTER TABLE `tbl_file_tmp`
  ADD PRIMARY KEY (`id_file`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_login_details`
--
ALTER TABLE `tbl_login_details`
  ADD PRIMARY KEY (`login_details_id`);

--
-- Indexes for table `tbl_mahasiswa`
--
ALTER TABLE `tbl_mahasiswa`
  ADD PRIMARY KEY (`npm`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_file`
--
ALTER TABLE `tbl_file`
  MODIFY `id_file` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `tbl_file_tmp`
--
ALTER TABLE `tbl_file_tmp`
  MODIFY `id_file` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
