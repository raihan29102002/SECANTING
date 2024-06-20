-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Mar 2024 pada 14.28
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pertanahan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `user`, `password`) VALUES
(1, 'admin', 'admin', '$2y$10$Fcogi5THQu78haq2FvQAweTRiftQVsPM5fkGNqy8TpdSJdANA.amW');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_kuasa`
--

CREATE TABLE `data_kuasa` (
  `id_kuasa` int(11) NOT NULL,
  `no_ktpk` bigint(255) DEFAULT NULL,
  `nama_kuasa` varchar(255) DEFAULT NULL,
  `ttl_kuasa` varchar(255) DEFAULT NULL,
  `umur_kuasa` varchar(255) DEFAULT NULL,
  `pekerjaan_kuasa` varchar(255) DEFAULT NULL,
  `alamat_kuasa` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_kuasa`
--

INSERT INTO `data_kuasa` (`id_kuasa`, `no_ktpk`, `nama_kuasa`, `ttl_kuasa`, `umur_kuasa`, `pekerjaan_kuasa`, `alamat_kuasa`) VALUES
(1, 0, '', '', '', '', ''),
(2, 0, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_desa`
--

CREATE TABLE `master_desa` (
  `id_desa` int(11) NOT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `desa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `master_desa`
--

INSERT INTO `master_desa` (`id_desa`, `kecamatan`, `desa`) VALUES
(1, 'Sragen', 'Sine'),
(2, 'Sragen', 'Sragen Kulon'),
(3, 'Sragen', 'Sragen Tengah'),
(4, 'Sragen', 'Sragen Wetan'),
(5, 'Sragen', 'Nglorog'),
(6, 'Sragen', 'Karangtengah'),
(7, 'Sragen', 'Tengkil'),
(8, 'Sragen', 'Kedungupit'),
(9, 'Kedawung', 'Pengkok'),
(10, 'Kedawung', 'Celep'),
(11, 'Kedawung', 'Karangpelem'),
(12, 'Kedawung', 'Mojodoyong'),
(13, 'Kedawung', 'Jenggrik'),
(14, 'Kedawung', 'Mojokerto'),
(15, 'Kedawung', 'Wonorejo'),
(16, 'Kedawung', 'Wonokerso'),
(17, 'Kedawung', 'Kadawung'),
(18, 'Kedawung', 'Bendungan'),
(19, 'Masaran', 'Sidodadi'),
(20, 'Masaran', 'Karangmalang'),
(21, 'Masaran', 'Krebet'),
(22, 'Masaran', 'Sepat'),
(23, 'Masaran', 'Jirapan'),
(24, 'Masaran', 'Gebang'),
(25, 'Masaran', 'Dawungan'),
(26, 'Masaran', 'Masaran'),
(27, 'Masaran', 'Jati'),
(28, 'Masaran', 'Kliwonan'),
(29, 'Masaran', 'Pilang'),
(30, 'Masaran', 'Pringanom'),
(31, 'Masaran', 'Krikilan'),
(32, 'Sidoharjo', 'Bentak'),
(33, 'Sidoharjo', 'Purwosuman'),
(34, 'Sidoharjo', 'Patihan'),
(35, 'Sidoharjo', 'Duyungan'),
(36, 'Sidoharjo', 'Jetak'),
(37, 'Sidoharjo', 'Sidoharjo'),
(38, 'Sidoharjo', 'Singopadu'),
(39, 'Sidoharjo', 'Taraman'),
(40, 'Sidoharjo', 'Tenggak'),
(41, 'Sidoharjo', 'Sribit'),
(42, 'Sidoharjo', 'Jambanan'),
(43, 'Sidoharjo', 'Pandak'),
(44, 'Karangmalang', 'Kedungwaduk'),
(45, 'Karangmalang', 'Jurangjero'),
(46, 'Karangmalang', 'Saradan'),
(47, 'Karangmalang', 'Plosokerep'),
(48, 'Karangmalang', 'Guworejo'),
(49, 'Karangmalang', 'Puro'),
(50, 'Karangmalang', 'Mojorejo'),
(51, 'Karangmalang', 'Pelemgadung'),
(52, 'Karangmalang', 'Plumbungan'),
(53, 'Karangmalang', 'Kroyo'),
(54, 'Gondang', 'Srimulyo'),
(55, 'Gondang', 'Tegalrejo'),
(56, 'Gondang', 'Tunggul'),
(57, 'Gondang', 'Glonggong'),
(58, 'Gondang', 'Kaliwede'),
(59, 'Gondang', 'Wonotolo'),
(60, 'Gondang', 'Plosorejo'),
(61, 'Gondang', 'Gondang'),
(62, 'Gondang', 'Bumiaji'),
(63, 'Ngrampal', 'Ngarum'),
(64, 'Ngrampal', 'Bener'),
(65, 'Ngrampal', 'Kebonromo'),
(66, 'Ngrampal', 'Pilangsari'),
(67, 'Ngrampal', 'Kladungan'),
(68, 'Ngrampal', 'Gabus'),
(69, 'Ngrampal', 'Karangudi'),
(70, 'Ngrampal', 'Bandung'),
(71, 'Sambirejo', 'Sukorejo'),
(72, 'Sambirejo', 'Jambeyan'),
(73, 'Sambirejo', 'Jetis'),
(74, 'Sambirejo', 'Musuk'),
(75, 'Sambirejo', 'Kadipiro'),
(76, 'Sambirejo', 'Sambirejo'),
(77, 'Sambirejo', 'Blimbing'),
(78, 'Sambirejo', 'Dawung'),
(79, 'Sambirejo', 'Sambi'),
(80, 'Sambungmacan', 'Plumbon'),
(81, 'Sambungmacan', 'Karanganyar'),
(82, 'Sambungmacan', 'Cemeng'),
(83, 'Sambungmacan', 'Bedoro'),
(84, 'Sambungmacan', 'Toyogo'),
(85, 'Sambungmacan', 'Banyurip'),
(86, 'Sambungmacan', 'Gringging'),
(87, 'Sambungmacan', 'Banaran'),
(88, 'Sambungmacan', 'Sambungmacan'),
(89, 'Tangen', 'Katelan '),
(90, 'Tangen', 'Dukuh'),
(91, 'Tangen', 'Jekawal'),
(92, 'Tangen', 'Ngrombo'),
(93, 'Tangen', 'Sigit'),
(94, 'Tangen', 'Denanyar'),
(95, 'Gesi', 'Tanggan'),
(96, 'Gesi', 'Pilangsari'),
(97, 'Gesi', 'Blangu'),
(98, 'Gesi', 'Gesi'),
(99, 'Gesi', 'Srawung'),
(100, 'Gesi', 'Poleng'),
(101, 'Gesi', 'Slendro'),
(102, 'Sukodono', 'Newung'),
(103, 'Sukodono', 'Jatitengah'),
(104, 'Sukodono', 'Bendo'),
(105, 'Sukodono', 'Juwok'),
(106, 'Sukodono', 'Pantirejo'),
(107, 'Sukodono', 'Majenang'),
(108, 'Sukodono', 'Karanganom'),
(109, 'Sukodono', 'Gebang'),
(110, 'Sukodono', 'Baleharjo'),
(111, 'Mondokan', 'Sono'),
(112, 'Mondokan', 'Tempelrejo'),
(113, 'Mondokan', 'Trombol'),
(114, 'Mondokan', 'Pare'),
(115, 'Mondokan', 'Jekani'),
(116, 'Mondokan', 'Kedawung'),
(117, 'Mondokan', 'Jembangan'),
(118, 'Mondokan', 'Gemantar'),
(119, 'Mondokan', 'Sumberejo'),
(120, 'Jenar', 'Japoh'),
(121, 'Jenar', 'Ngepringan'),
(122, 'Jenar', 'Mlale'),
(123, 'Jenar', 'Dawung'),
(124, 'Jenar', 'Kandangsapi'),
(125, 'Jenar', 'Jenar'),
(126, 'Jenar', 'Banyurip'),
(127, 'Gemolong', 'Kaloran'),
(128, 'Gemolong', 'Ngembatpadas'),
(129, 'Gemolong', 'Kragilan'),
(130, 'Gemolong', 'Brangkal'),
(131, 'Gemolong', 'Jatibatur'),
(132, 'Gemolong', 'Peleman'),
(133, 'Gemolong', 'Genengduwur'),
(134, 'Gemolong', 'Tegaldowo'),
(135, 'Gemolong', 'Gemolong'),
(136, 'Gemolong', 'Kwangen'),
(137, 'Gemolong', 'Purworejo'),
(138, 'Gemolong', 'Jenalas'),
(139, 'Gemolong', 'Kalangan'),
(140, 'Gemolong', 'Nganti'),
(141, 'Kalijambe', 'Keden'),
(142, 'Kalijambe', 'Trobayan'),
(143, 'Kalijambe', 'Kalimacan'),
(144, 'Kalijambe', 'Jetiskarangpung'),
(145, 'Kalijambe', 'Krikilan'),
(146, 'Kalijambe', 'Bukurran'),
(147, 'Kalijambe', 'Ngebung'),
(148, 'Kalijambe', 'Tegalombo'),
(149, 'Kalijambe', 'Banaran'),
(150, 'Kalijambe', 'Karangjati'),
(151, 'Kalijambe', 'Saren'),
(152, 'Kalijambe', 'Sambirembe'),
(153, 'Kalijambe', 'Donoyudan'),
(154, 'Kalijambe', 'Wonorejo'),
(155, 'Plupuh', 'Karangwaru'),
(156, 'Plupuh', 'Ngrombo'),
(157, 'Plupuh', 'Sambirejo'),
(158, 'Plupuh', 'Somomorodukuh'),
(159, 'Plupuh', 'Cangkol'),
(160, 'Plupuh', 'Menyarejo'),
(161, 'Plupuh', 'Pungsari'),
(162, 'Plupuh', 'Jembangan'),
(163, 'Plupuh', 'Sidokarto'),
(164, 'Plupuh', 'Jabung'),
(165, 'Plupuh', 'Gedongan'),
(166, 'Plupuh', 'Plupuh'),
(167, 'Plupuh', 'Dari'),
(168, 'Plupuh', 'Karanganyar'),
(169, 'Plupuh', 'Karungan'),
(170, 'Plupuh', 'Gentanbnaran'),
(171, 'Miri', 'Jruk'),
(172, 'Miri', 'Sunggingan'),
(173, 'Miri', 'Girimargo'),
(174, 'Miri', 'Doyong'),
(175, 'Miri', 'Soko'),
(176, 'Miri', 'Brojol'),
(177, 'Miri', 'Bagor'),
(178, 'Miri', 'Gilirejo'),
(179, 'Miri', 'Genng'),
(180, 'Miri', 'Gilirejo Baru'),
(181, 'Sumberlawang', 'Pendem'),
(182, 'Sumberlawang', 'Hadiluwih'),
(183, 'Sumberlawang', 'Jati'),
(184, 'Sumberlawang', 'Cepoko'),
(185, 'Sumberlawang', 'Mojopuro'),
(186, 'Sumberlawang', 'Ngandul'),
(187, 'Sumberlawang', 'Ngargotirto'),
(188, 'Sumberlawang', 'Peagak'),
(189, 'Sumberlawang', 'Tlogotirto'),
(190, 'Sumberlawang', 'Ngargosari'),
(191, 'Sumberlawang', 'Kacangan'),
(192, 'Gading', 'Karangasem'),
(193, 'Gading', 'Slogo'),
(194, 'Gading', 'Jono'),
(195, 'Gading', 'Gawan'),
(196, 'Gading', 'Kecik'),
(197, 'Gading', 'Pengkol'),
(198, 'Gading', 'Suwatu'),
(199, 'Gading', 'Padas'),
(200, 'Gading', 'Tanon'),
(201, 'Gading', 'Gabugan'),
(202, 'Gading', 'Ketro'),
(203, 'Gading', 'Sambiduwur'),
(204, 'Gading', 'Karangtalun'),
(205, 'Gading', 'Bonagung'),
(206, 'Gading', 'Kalikobok'),
(207, 'Gading', 'Gading');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_notaris`
--

CREATE TABLE `master_notaris` (
  `id_notaris` int(11) NOT NULL,
  `nama_notaris` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `master_notaris`
--

INSERT INTO `master_notaris` (`id_notaris`, `nama_notaris`) VALUES
(1, 'Perseorangan'),
(2, 'Abdul Bakik'),
(3, 'Alfitri Setyaningrum'),
(4, 'Amelia Citra Lavinia'),
(5, 'Amin Nugroho'),
(6, 'Ananto Prasetyo Wijanarko'),
(7, 'Anita Rumani'),
(8, 'Ari Kristina'),
(9, 'Arida Syah Hariyani'),
(10, 'Dewi Angkasari Komar'),
(11, 'Djoko Slamet Waharto'),
(12, 'Dwi Astuti'),
(13, 'Dwi Jayanto'),
(14, 'Dwi Sudaryanti'),
(15, 'Dyah Kusumaningrum'),
(16, 'Elizabeth Yanuari Widiarto'),
(17, 'Emy Rachmawati'),
(18, 'Erna Tulus Setyowati'),
(19, 'Evalina Ori Kristiana'),
(20, 'Hari Budiono'),
(21, 'Hendri Budiyanto'),
(22, 'Indri Hapsari'),
(23, 'Irene Mandasari Karina Yasya'),
(24, 'Janika Dinar Umaratih'),
(25, 'Joko Hendang Murdono'),
(26, 'Joseph Christianto'),
(27, 'Juanita Nur Komala'),
(28, 'Lies Setyorini, Sh., M.pd'),
(29, 'Lina Dwi Marthani Sh Mkn'),
(30, 'Mozedayen Eirene Alfa Lande'),
(31, 'Muhamad Dahlan Muladi'),
(32, 'Muhammad Rohyani Syafii'),
(33, 'Muhammad Zulkarnain Mustofa'),
(34, 'Nancy Nilakandi'),
(35, 'Natalia Ambar Kristiani'),
(36, 'Partatmi Siti Sandari'),
(37, 'Prancisca Romana Dwi Hastuti'),
(38, 'Rahmatika'),
(39, 'Ratna'),
(40, 'Rindu Legawati'),
(41, 'Riyadi Guntur Rilo Subroto'),
(42, 'Roostanty'),
(43, 'Rus Utaryono'),
(44, 'Sri Hartati'),
(45, 'Sudarmi, S.h., M.kn'),
(46, 'Sunastitiningsih'),
(47, 'Sunindar'),
(48, 'Suryanti'),
(49, 'Taufiq Effendi'),
(50, 'Tri Mulyono'),
(51, 'Tri Rahaju Hartinah'),
(52, 'Triana Febrianty Syafaruddin'),
(53, 'Trini Atmasari'),
(54, 'Tulus Dwi Mulyanto'),
(55, 'Winarsih'),
(56, 'Windarti'),
(57, 'Woro Indrijati'),
(58, 'Yudi Ariyanto');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id_pengajuan` int(11) NOT NULL,
  `id_notaris` int(11) DEFAULT NULL,
  `id_desa` int(11) DEFAULT NULL,
  `id_kuasa` int(11) DEFAULT NULL,
  `no_ktp` bigint(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `tanggal_lahir` varchar(255) DEFAULT NULL,
  `umur` int(11) DEFAULT NULL,
  `pekerjaan` varchar(255) DEFAULT NULL,
  `selaku` varchar(255) DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `alamat_rumah` varchar(255) DEFAULT NULL,
  `no_hp` bigint(255) DEFAULT NULL,
  `lokasi_tanah` varchar(255) DEFAULT NULL,
  `koordinat_x` varchar(255) DEFAULT NULL,
  `koordinat_y` varchar(255) DEFAULT NULL,
  `jenis_hak` varchar(255) DEFAULT NULL,
  `no_hak` varchar(255) DEFAULT NULL,
  `no_su` varchar(255) DEFAULT NULL,
  `nib` varchar(255) DEFAULT NULL,
  `luas` int(11) DEFAULT NULL,
  `penggunaan` varchar(255) DEFAULT NULL,
  `tanggal_pengajuan` datetime DEFAULT NULL,
  `status_pengajuan` enum('Approved','Awaiting','Declined') DEFAULT NULL,
  `keterangan_decline` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengajuan`
--

INSERT INTO `pengajuan` (`id_pengajuan`, `id_notaris`, `id_desa`, `id_kuasa`, `no_ktp`, `nama`, `tanggal_lahir`, `umur`, `pekerjaan`, `selaku`, `kecamatan`, `alamat_rumah`, `no_hp`, `lokasi_tanah`, `koordinat_x`, `koordinat_y`, `jenis_hak`, `no_hak`, `no_su`, `nib`, `luas`, `penggunaan`, `tanggal_pengajuan`, `status_pengajuan`, `keterangan_decline`) VALUES
(26, 5, 6, 1, 3505022910020004, 'Muhammad Raihan Ahsin Arif', 'Bondowoso, 29 Oktober 2002', 21, 'Mahasiswa', 'diri_sendiri', 'Sragen', 'Tunjung Udanawu Blitar', 895807814466, 'Tunjung Udanawu Blitar', '221213', '2123231', 'hak_milik', '231231', '231213231', '2231', 213213, 'Sendiri', '2024-02-29 13:39:51', 'Approved', NULL),
(27, 5, 6, 1, 3505022910020004, 'Muhammad Raihan Ahsin Arif', 'Bondowoso, 29 Oktober 2002', 21, 'Mahasiswa', 'diri_sendiri', 'Sragen', 'Tunjung Udanawu Blitar', 895807814466, 'Tunjung Udanawu Blitar', '221213', '2123231', 'hak_milik', '231231', '231213231', '2231', 213213, 'Sendiri', '2024-02-29 13:39:51', 'Declined', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `data_kuasa`
--
ALTER TABLE `data_kuasa`
  ADD PRIMARY KEY (`id_kuasa`);

--
-- Indeks untuk tabel `master_desa`
--
ALTER TABLE `master_desa`
  ADD PRIMARY KEY (`id_desa`);

--
-- Indeks untuk tabel `master_notaris`
--
ALTER TABLE `master_notaris`
  ADD PRIMARY KEY (`id_notaris`);

--
-- Indeks untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`),
  ADD KEY `pengajuan_ibfk_1` (`id_desa`),
  ADD KEY `id_notaris` (`id_notaris`) USING BTREE,
  ADD KEY `id_kuasa` (`id_kuasa`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `data_kuasa`
--
ALTER TABLE `data_kuasa`
  MODIFY `id_kuasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `master_desa`
--
ALTER TABLE `master_desa`
  MODIFY `id_desa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT untuk tabel `master_notaris`
--
ALTER TABLE `master_notaris`
  MODIFY `id_notaris` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD CONSTRAINT `id_kuasa` FOREIGN KEY (`id_kuasa`) REFERENCES `data_kuasa` (`id_kuasa`),
  ADD CONSTRAINT `id_notaris` FOREIGN KEY (`id_notaris`) REFERENCES `master_notaris` (`id_notaris`),
  ADD CONSTRAINT `pengajuan_ibfk_1` FOREIGN KEY (`id_desa`) REFERENCES `master_desa` (`id_desa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
