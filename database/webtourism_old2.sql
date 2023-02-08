-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2023 at 04:05 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webtourism`
--

-- --------------------------------------------------------

--
-- Table structure for table `agen_wisata`
--

CREATE TABLE `agen_wisata` (
  `id_agen_wisata` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `no_kontak` varchar(30) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `thumbnail` text DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `lokasi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agen_wisata`
--

INSERT INTO `agen_wisata` (`id_agen_wisata`, `nama`, `no_kontak`, `deskripsi`, `thumbnail`, `alamat`, `lokasi`) VALUES
(1, 'Agen Bintan Holiday', '+023923882', 'Sebuah agen wisata terkenal di Bintan. Telah melayani 20 wisata, lorem ipsum dolor sit amet', 'agen1.png', 'Jalan Lorem Ipsum Dolir SIt', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d510623.53749404545!2d104.14084880347531!3d0.9701504529757412!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d97070dc436f5b%3A0xdb8214e8b5e9cd18!2sPulau%20Bintan!5e0!3m2!1sid!2sid!4v1668910249536!5m2!1sid!2sid\" style=\"width: 100%; height: 600px;\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>');

-- --------------------------------------------------------

--
-- Table structure for table `akomodasi`
--

CREATE TABLE `akomodasi` (
  `id_akomodasi` int(11) NOT NULL,
  `id_akomodasi_cat` int(11) NOT NULL,
  `judul` varchar(256) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `lokasi` text DEFAULT NULL,
  `thumbnail` text DEFAULT NULL,
  `daftar_data` text DEFAULT NULL,
  `galeri_src` text DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akomodasi`
--

INSERT INTO `akomodasi` (`id_akomodasi`, `id_akomodasi_cat`, `judul`, `deskripsi`, `lokasi`, `thumbnail`, `daftar_data`, `galeri_src`, `alamat`) VALUES
(1, 1, 'Hotel Sheraton Bintan', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti adipisci explicabo modi? Numquam, ipsa animi consequuntur odio, natus maiores quo illum suscipit voluptate amet id eos impedit rerum porro consectetur.\n<h4></h4>\n<ul>\n <li>Morning breakfast</li>\n <li>Coffee and lounge</li>\n <li>Lorem ipsum</li>\n <li>Dolor Sit</li>\n <li>Amet</li>\n</ul>\n<h4>Jam Operasional</h4>\n24 Jam', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d510623.53749404545!2d104.14084880347531!3d0.9701504529757412!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d97070dc436f5b%3A0xdb8214e8b5e9cd18!2sPulau%20Bintan!5e0!3m2!1sid!2sid!4v1668910249536!5m2!1sid!2sid\" style=\"width: 100%; height: 600px;\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'hotel.jpg', NULL, 'hotel1.jpg;hotel2.jpg;hotel4.jpg;hotel5.jfif;hotel6.jpg', 'Jalan Perjungan Bintan'),
(2, 1, 'Hotel Bintan', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti adipisci explicabo modi? Numquam, ipsa animi consequuntur odio, natus maiores quo illum suscipit voluptate amet id eos impedit rerum porro consectetur.\r\n<h4></h4>\r\n<ul>\r\n <li>Morning breakfast</li>\r\n <li>Coffee and lounge</li>\r\n <li>Lorem ipsum</li>\r\n <li>Dolor Sit</li>\r\n <li>Amet</li>\r\n</ul>\r\n<h4>Jam Operasional</h4>\r\n24 Jam', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d510623.53749404545!2d104.14084880347531!3d0.9701504529757412!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d97070dc436f5b%3A0xdb8214e8b5e9cd18!2sPulau%20Bintan!5e0!3m2!1sid!2sid!4v1668910249536!5m2!1sid!2sid\" style=\"width: 100%; height: 600px;\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'hotel.jpg', NULL, 'hotel1.jpg;hotel2.jpg;hotel4.jpg;hotel5.jfif;hotel6.jpg', 'Jalan Pesisir Pantai Bintan'),
(3, 3, 'Pasar', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti adipisci explicabo modi? Numquam, ipsa animi consequuntur odio, natus maiores quo illum suscipit voluptate amet id eos impedit rerum porro consectetur.\r\n<h4></h4>\r\n<ul>\r\n <li>Morning breakfast</li>\r\n <li>Coffee and lounge</li>\r\n <li>Lorem ipsum</li>\r\n <li>Dolor Sit</li>\r\n <li>Amet</li>\r\n</ul>\r\n<h4>Jam Operasional</h4>\r\n24 Jam', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d510623.53749404545!2d104.14084880347531!3d0.9701504529757412!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d97070dc436f5b%3A0xdb8214e8b5e9cd18!2sPulau%20Bintan!5e0!3m2!1sid!2sid!4v1668910249536!5m2!1sid!2sid\" style=\"width: 100%; height: 600px;\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'pasar.jpg', NULL, 'pasar1.jpg;pasar2.jpg;pasar3.jpg;pasar4.jpg', 'Jalan Lorem Ipsum'),
(4, 5, 'Rental Motor Bintan 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent dictum bibendum ex, sed commodo sapien rhoncus nec. Proin porta varius tellus et ornare. Morbi varius fermentum molestie. Integer at mi maximus, pulvinar massa in, tristique diam. Ut in elit feugiat, pharetra turpis vitae, pretium ante. Nulla auctor ipsum nisl, eget aliquam dolor tincidunt ut. Nulla a risus tellus. Duis efficitur aliquam volutpat. Morbi ultricies lorem nec vestibulum luctus. Duis sollicitudin libero et libero viverra, eget vestibulum dui placerat. Nulla facilisi. Nunc tristique dui sem, ut cursus orci ornare vel.', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d510623.53749404545!2d104.14084880347531!3d0.9701504529757412!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d97070dc436f5b%3A0xdb8214e8b5e9cd18!2sPulau%20Bintan!5e0!3m2!1sid!2sid!4v1668910249536!5m2!1sid!2sid\" style=\"width: 100%; height: 600px;\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'motor-rental.jpg', NULL, 'motor-rental1.jpg;motor-rental2.jpg;motor-rental3.jpg', 'Jalan Lorem Ipsum no 23 Bintan');

-- --------------------------------------------------------

--
-- Table structure for table `akomodasi_cat`
--

CREATE TABLE `akomodasi_cat` (
  `id_akomodasi_cat` int(11) NOT NULL,
  `nama_cat` varchar(256) DEFAULT NULL,
  `jenis` enum('penginapan','penyewaan','umum') DEFAULT 'umum',
  `deskripsi` text DEFAULT NULL,
  `thumbnail` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akomodasi_cat`
--

INSERT INTO `akomodasi_cat` (`id_akomodasi_cat`, `nama_cat`, `jenis`, `deskripsi`, `thumbnail`) VALUES
(1, 'Hotel', 'penginapan', 'Bintan menyediakan layanan hotel yang terjangkau untuk menikmati liburan Anda.', 'hotel-logo.png'),
(2, 'Restoran/RM', 'umum', 'Bintan menyimpan makanan yang menarik untuk dicoba.', 'restaurant.png'),
(3, 'Pasar/Swalayan', 'umum', 'Ini adalah pasar. Lorem ipsum dolor sith amet.', 'market.png'),
(4, 'Rumah Sakit', 'umum', 'Pusat informasi mengenai rumah sakit di Bintan bisa didapat dari sistem ini.', 'hospital.png'),
(5, 'Rental Motor', 'penyewaan', 'List daftar tempat rental motor di Bintan', 'motor-rental.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `destinasi`
--

CREATE TABLE `destinasi` (
  `id_destinasi` int(11) NOT NULL,
  `id_wisata` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dt`
--

CREATE TABLE `dt` (
  `id_dt` int(11) NOT NULL,
  `id_dt_cat` int(11) NOT NULL,
  `judul` varchar(256) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `lokasi` text DEFAULT NULL,
  `thumbnail` text DEFAULT NULL,
  `galeri_src` text DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dt_cat`
--

CREATE TABLE `dt_cat` (
  `id_dt_cat` int(11) NOT NULL,
  `nama_dt` varchar(256) NOT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dt_cat`
--

INSERT INTO `dt_cat` (`id_dt_cat`, `nama_dt`, `deskripsi`) VALUES
(1, 'Daya Tarik Alam', 'Alam sebagai daya tarik wisata untuk menikmati keindahan pulau Bintan.'),
(2, 'Daya Tarik Budaya', 'Manusia membutuhkan budaya sebagai tujuan bagaimana berkehidupan.'),
(3, 'Daya Tarik Buatan Manusia', 'Manusia menghasilkan berbagai produk sesuai dengan kebutuhan tradisional dan modern.');

-- --------------------------------------------------------

--
-- Table structure for table `emergency`
--

CREATE TABLE `emergency` (
  `id_emergency` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `no_kontak` varchar(40) NOT NULL,
  `alamat` text DEFAULT NULL,
  `thumbnail` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emergency`
--

INSERT INTO `emergency` (`id_emergency`, `nama`, `no_kontak`, `alamat`, `thumbnail`) VALUES
(1, 'Crisis Center', '+62 (770) 691 010', NULL, NULL),
(2, 'Fire Emergency', '+62 (770) 691 911', NULL, NULL),
(3, 'Police', '+62 (813) 7125 2100', NULL, NULL),
(4, 'Medical Clinic', '+62 (811) 7714546', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kalender`
--

CREATE TABLE `kalender` (
  `id_kalender` int(11) NOT NULL,
  `id_kalender_cat` int(11) NOT NULL,
  `judul` varchar(256) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `thumbnail` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kalender`
--

INSERT INTO `kalender` (`id_kalender`, `id_kalender_cat`, `judul`, `deskripsi`, `thumbnail`) VALUES
(1, 1, 'Kalender Kegiatan Budaya di Bintan', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste sequi excepturi rerum id quasi numquam iure autem perspiciatis dolores saepe recusandae fuga quidem distinctio nulla mollitia, fugit neque eius facilis?\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Iste sequi excepturi rerum id quasi numquam iure autem perspiciatis dolores saepe recusandae fuga quidem distinctio nulla mollitia, fugit neque eius facilis?\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Iste sequi excepturi rerum id quasi numquam iure autem perspiciatis dolores saepe recusandae fuga quidem distinctio nulla mollitia, fugit neque eius facilis?\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Iste sequi excepturi rerum id quasi numquam iure autem perspiciatis dolores saepe recusandae fuga quidem distinctio nulla mollitia, fugit neque eius facilis?\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Iste sequi excepturi rerum id quasi numquam iure autem perspiciatis dolores saepe recusandae fuga quidem distinctio nulla mollitia, fugit neque eius facilis?\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Iste sequi excepturi rerum id quasi numquam iure autem perspiciatis dolores saepe recusandae fuga quidem distinctio nulla mollitia, fugit neque eius facilis?', 'infographic1.jpeg'),
(2, 2, 'Kalender Kegiatan Liburan di Bintan', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste sequi excepturi rerum id quasi numquam iure autem perspiciatis dolores saepe recusandae fuga quidem distinctio nulla mollitia, fugit neque eius facilis?\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Iste sequi excepturi rerum id quasi numquam iure autem perspiciatis dolores saepe recusandae fuga quidem distinctio nulla mollitia, fugit neque eius facilis?\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Iste sequi excepturi rerum id quasi numquam iure autem perspiciatis dolores saepe recusandae fuga quidem distinctio nulla mollitia, fugit neque eius facilis?\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Iste sequi excepturi rerum id quasi numquam iure autem perspiciatis dolores saepe recusandae fuga quidem distinctio nulla mollitia, fugit neque eius facilis?\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Iste sequi excepturi rerum id quasi numquam iure autem perspiciatis dolores saepe recusandae fuga quidem distinctio nulla mollitia, fugit neque eius facilis?\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Iste sequi excepturi rerum id quasi numquam iure autem perspiciatis dolores saepe recusandae fuga quidem distinctio nulla mollitia, fugit neque eius facilis?', 'infographic2.png'),
(3, 4, 'Kalender Kegiatan Lorem Ipsum di Bintan', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste sequi excepturi rerum id quasi numquam iure autem perspiciatis dolores saepe recusandae fuga quidem distinctio nulla mollitia, fugit neque eius facilis?\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Iste sequi excepturi rerum id quasi numquam iure autem perspiciatis dolores saepe recusandae fuga quidem distinctio nulla mollitia, fugit neque eius facilis?\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Iste sequi excepturi rerum id quasi numquam iure autem perspiciatis dolores saepe recusandae fuga quidem distinctio nulla mollitia, fugit neque eius facilis?\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Iste sequi excepturi rerum id quasi numquam iure autem perspiciatis dolores saepe recusandae fuga quidem distinctio nulla mollitia, fugit neque eius facilis?\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Iste sequi excepturi rerum id quasi numquam iure autem perspiciatis dolores saepe recusandae fuga quidem distinctio nulla mollitia, fugit neque eius facilis?\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Iste sequi excepturi rerum id quasi numquam iure autem perspiciatis dolores saepe recusandae fuga quidem distinctio nulla mollitia, fugit neque eius facilis?', 'infographic3.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `kalender_cat`
--

CREATE TABLE `kalender_cat` (
  `id_kalender_cat` int(11) NOT NULL,
  `nama_cat` varchar(256) NOT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kalender_cat`
--

INSERT INTO `kalender_cat` (`id_kalender_cat`, `nama_cat`, `deskripsi`) VALUES
(1, 'Kalender Budaya', 'Kalender kegiatan budaya di Bintan'),
(2, 'Kalender Liburan', 'Kalender liburan di Bintan'),
(3, 'Kalender Musim', 'Kalender kegiatan berdasarkan musim di Pulau Bintan'),
(4, 'Kalender Lorem Ipsum', 'Kalender tentang lorem ipsum');

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id_paket` int(11) NOT NULL,
  `judul` varchar(256) DEFAULT NULL,
  `subjudul` varchar(256) DEFAULT NULL,
  `harga` varchar(256) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `poster_iklan` text DEFAULT NULL,
  `sisa_paket` int(11) DEFAULT NULL,
  `durasi` varchar(256) DEFAULT NULL,
  `daftar_kegiatan` text DEFAULT NULL,
  `id_agen_wisata` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama_user` varchar(256) NOT NULL,
  `pass` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama_user`, `pass`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `transportasi`
--

CREATE TABLE `transportasi` (
  `id_transportasi` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `lokasi` text DEFAULT NULL,
  `thumbnail` text DEFAULT NULL,
  `fasilitas` text DEFAULT NULL,
  `galeri_src` text DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transportasi`
--

INSERT INTO `transportasi` (`id_transportasi`, `nama`, `deskripsi`, `lokasi`, `thumbnail`, `fasilitas`, `galeri_src`, `alamat`) VALUES
(1, 'Bandara', 'Ini adalah pelabuhan. Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti adipisci explicabo modi? Numquam, ipsa animi consequuntur odio, natus maiores quo illum suscipit voluptate amet id eos impedit rerum porro consectetur.\n<h4>Fasilitas</h4>\n<ul>\n <li>Musholla</li>\n <li>Lorem</li>\n <li>Ipsum</li>\n <li>Dolor</li>\n</ul>\n<h4>Jam Operasional</h4>\n24 Jam', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d510623.53749404545!2d104.14084880347531!3d0.9701504529757412!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d97070dc436f5b%3A0xdb8214e8b5e9cd18!2sPulau%20Bintan!5e0!3m2!1sid!2sid!4v1668910249536!5m2!1sid!2sid\" style=\"width: 100%; height: 600px;\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'bandara.jpeg', NULL, 'bandara1.jfif;bandara2.jpg;bandara3.png;bandara4.jpeg', NULL),
(2, 'Pelabuhan', 'Ini adalah pelabuhan. Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti adipisci explicabo modi? Numquam, ipsa animi consequuntur odio, natus maiores quo illum suscipit voluptate amet id eos impedit rerum porro consectetur.\n<h4>Fasilitas</h4>\n<ul>\n <li>Musholla</li>\n <li>Lorem</li>\n <li>Ipsum</li>\n <li>Dolor</li>\n</ul>\n<h4>Jam Operasional</h4>\n24 Jam', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d510623.53749404545!2d104.14084880347531!3d0.9701504529757412!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d97070dc436f5b%3A0xdb8214e8b5e9cd18!2sPulau%20Bintan!5e0!3m2!1sid!2sid!4v1668910249536!5m2!1sid!2sid\" style=\"width: 100%; height: 600px;\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'pelabuhan.jpg', NULL, 'ship1.png;ship2.jpg;ship3.jpg;ship4.jpg', NULL),
(3, 'Terminal', 'Ini adalah contoh terminal. Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti adipisci explicabo modi? Numquam, ipsa animi consequuntur odio, natus maiores quo illum suscipit voluptate amet id eos impedit rerum porro consectetur.\r\n<h4>Fasilitas</h4>\r\n<ul>\r\n <li>Musholla</li>\r\n <li>Lorem</li>\r\n <li>Ipsum</li>\r\n <li>Dolor</li>\r\n</ul>\r\n<h4>Jam Operasional</h4>\r\n24 Jam', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d510623.53749404545!2d104.14084880347531!3d0.9701504529757412!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d97070dc436f5b%3A0xdb8214e8b5e9cd18!2sPulau%20Bintan!5e0!3m2!1sid!2sid!4v1668910249536!5m2!1sid!2sid\" style=\"width: 100%; height: 600px;\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'terminal.jpg', NULL, 'bus2.jpg;bus3.jpg;bus4.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wisata`
--

CREATE TABLE `wisata` (
  `id_wisata` int(11) NOT NULL,
  `id_wisata_cat` int(11) NOT NULL,
  `judul` varchar(256) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `lokasi` text DEFAULT NULL,
  `thumbnail` text DEFAULT NULL,
  `galeri_src` text DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wisata`
--

INSERT INTO `wisata` (`id_wisata`, `id_wisata_cat`, `judul`, `deskripsi`, `lokasi`, `thumbnail`, `galeri_src`, `alamat`) VALUES
(1, 1, 'Wisata Pantai Bintan', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti adipisci explicabo modi? Numquam, ipsa animi consequuntur odio, natus maiores quo illum suscipit voluptate amet id eos impedit rerum porro consectetur.\n<h4>Jam Buka</h4>\n08.00 - 17.00 WIB\n<h4>Fasilitas</h4>\n<ul>\n <li>Lorem Ipsum</li>\n <li>Lorem Ipsum</li>\n <li>Lorem Ipsum</li>\n <li>Lorem Ipsum</li>\n</ul>', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d510623.53749404545!2d104.14084880347531!3d0.9701504529757412!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d97070dc436f5b%3A0xdb8214e8b5e9cd18!2sPulau%20Bintan!5e0!3m2!1sid!2sid!4v1668910249536!5m2!1sid!2sid\" style=\"width: 100%; height: 600px;\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'wisataBintan1.jpg', 'wisata2.jpg;wisata3.jpg;wisata4.jpg;wisata5.jpg;wisata6.jpeg;wisata7.jpg;wisata8.jpg', 'Jalan Kapten Bintan No. 22'),
(2, 1, 'Hutan Bintan Pesisir', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti adipisci explicabo modi? Numquam, ipsa animi consequuntur odio, natus maiores quo illum suscipit voluptate amet id eos impedit rerum porro consectetur.\r\n<h4>Jam Buka</h4>\r\n08.00 - 17.00 WIB\r\n<h4>Fasilitas</h4>\r\n<ul>\r\n <li>Lorem Ipsum</li>\r\n <li>Lorem Ipsum</li>\r\n <li>Lorem Ipsum</li>\r\n <li>Lorem Ipsum</li>\r\n</ul>', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d510623.53749404545!2d104.14084880347531!3d0.9701504529757412!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d97070dc436f5b%3A0xdb8214e8b5e9cd18!2sPulau%20Bintan!5e0!3m2!1sid!2sid!4v1668910249536!5m2!1sid!2sid\" style=\"width: 100%; height: 600px;\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'wisataBintan2.jpg', 'wisata10.jpg;wisata11.jpg;wisata12.jpg;wisata13.jpg;wisata17.jpg', 'Jalan Hutan Bintan Pesisir'),
(3, 2, 'Air Terjun Bintan Timur', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti adipisci explicabo modi? Numquam, ipsa animi consequuntur odio, natus maiores quo illum suscipit voluptate amet id eos impedit rerum porro consectetur.\r\n<h4>Jam Buka</h4>\r\n08.00 - 17.00 WIB\r\n<h4>Fasilitas</h4>\r\n<ul>\r\n <li>Lorem Ipsum</li>\r\n <li>Lorem Ipsum</li>\r\n <li>Lorem Ipsum</li>\r\n <li>Lorem Ipsum</li>\r\n</ul>', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d510623.53749404545!2d104.14084880347531!3d0.9701504529757412!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d97070dc436f5b%3A0xdb8214e8b5e9cd18!2sPulau%20Bintan!5e0!3m2!1sid!2sid!4v1668910249536!5m2!1sid!2sid\" style=\"width: 100%; height: 600px;\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'wisataBintan3.jpg', 'wisata15.jpeg;wisata16.jpg;wisata18.jpg', 'Jalan Air Terjun Bintan Timur');

-- --------------------------------------------------------

--
-- Table structure for table `wisata_cat`
--

CREATE TABLE `wisata_cat` (
  `id_wisata_cat` int(11) NOT NULL,
  `kecamatan` varchar(256) NOT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wisata_cat`
--

INSERT INTO `wisata_cat` (`id_wisata_cat`, `kecamatan`, `deskripsi`) VALUES
(1, 'Bintan Pesisir', 'Data lokasi wisata di kecamatan Bintan Pesisir. Lorem ipsum dolor sith amet.'),
(2, 'Bintan Timur', 'Data lokasi wisata di kecamatan Bintan Timur. Lorem ipsum dolor sith amet.'),
(3, 'Bintan Utara', 'Data lokasi wisata di kecamatan Bintan Utara. Lorem ipsum dolor sith amet.'),
(4, 'Gunung Kijang', 'Data lokasi wisata di kecamatan Gunung Kijang. Lorem ipsum dolor sith amet.'),
(5, 'Mantang', 'Data lokasi wisata di kecamatan Mantang. Lorem ipsum dolor sith amet.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agen_wisata`
--
ALTER TABLE `agen_wisata`
  ADD PRIMARY KEY (`id_agen_wisata`);

--
-- Indexes for table `akomodasi`
--
ALTER TABLE `akomodasi`
  ADD PRIMARY KEY (`id_akomodasi`),
  ADD KEY `fk_id_akomodasi_cat` (`id_akomodasi_cat`);

--
-- Indexes for table `akomodasi_cat`
--
ALTER TABLE `akomodasi_cat`
  ADD PRIMARY KEY (`id_akomodasi_cat`);

--
-- Indexes for table `destinasi`
--
ALTER TABLE `destinasi`
  ADD PRIMARY KEY (`id_destinasi`),
  ADD KEY `fk_id_destinasi_wisata` (`id_wisata`),
  ADD KEY `fk_id_destinasi_paket` (`id_paket`);

--
-- Indexes for table `dt`
--
ALTER TABLE `dt`
  ADD PRIMARY KEY (`id_dt`),
  ADD KEY `fk_id_dt_cat` (`id_dt_cat`);

--
-- Indexes for table `dt_cat`
--
ALTER TABLE `dt_cat`
  ADD PRIMARY KEY (`id_dt_cat`);

--
-- Indexes for table `emergency`
--
ALTER TABLE `emergency`
  ADD PRIMARY KEY (`id_emergency`);

--
-- Indexes for table `kalender`
--
ALTER TABLE `kalender`
  ADD PRIMARY KEY (`id_kalender`),
  ADD KEY `fk_id_kalender_cat` (`id_kalender_cat`);

--
-- Indexes for table `kalender_cat`
--
ALTER TABLE `kalender_cat`
  ADD PRIMARY KEY (`id_kalender_cat`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id_paket`),
  ADD KEY `fk_id_agen_wisata` (`id_agen_wisata`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `transportasi`
--
ALTER TABLE `transportasi`
  ADD PRIMARY KEY (`id_transportasi`);

--
-- Indexes for table `wisata`
--
ALTER TABLE `wisata`
  ADD PRIMARY KEY (`id_wisata`),
  ADD KEY `fk_id_wisata_cat` (`id_wisata_cat`);

--
-- Indexes for table `wisata_cat`
--
ALTER TABLE `wisata_cat`
  ADD PRIMARY KEY (`id_wisata_cat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agen_wisata`
--
ALTER TABLE `agen_wisata`
  MODIFY `id_agen_wisata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `akomodasi`
--
ALTER TABLE `akomodasi`
  MODIFY `id_akomodasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `akomodasi_cat`
--
ALTER TABLE `akomodasi_cat`
  MODIFY `id_akomodasi_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `destinasi`
--
ALTER TABLE `destinasi`
  MODIFY `id_destinasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dt`
--
ALTER TABLE `dt`
  MODIFY `id_dt` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dt_cat`
--
ALTER TABLE `dt_cat`
  MODIFY `id_dt_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `emergency`
--
ALTER TABLE `emergency`
  MODIFY `id_emergency` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kalender`
--
ALTER TABLE `kalender`
  MODIFY `id_kalender` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kalender_cat`
--
ALTER TABLE `kalender_cat`
  MODIFY `id_kalender_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transportasi`
--
ALTER TABLE `transportasi`
  MODIFY `id_transportasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wisata`
--
ALTER TABLE `wisata`
  MODIFY `id_wisata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wisata_cat`
--
ALTER TABLE `wisata_cat`
  MODIFY `id_wisata_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akomodasi`
--
ALTER TABLE `akomodasi`
  ADD CONSTRAINT `fk_id_akomodasi_cat` FOREIGN KEY (`id_akomodasi_cat`) REFERENCES `akomodasi_cat` (`id_akomodasi_cat`);

--
-- Constraints for table `destinasi`
--
ALTER TABLE `destinasi`
  ADD CONSTRAINT `fk_id_destinasi_paket` FOREIGN KEY (`id_paket`) REFERENCES `paket` (`id_paket`),
  ADD CONSTRAINT `fk_id_destinasi_wisata` FOREIGN KEY (`id_wisata`) REFERENCES `wisata` (`id_wisata`);

--
-- Constraints for table `dt`
--
ALTER TABLE `dt`
  ADD CONSTRAINT `fk_id_dt_cat` FOREIGN KEY (`id_dt_cat`) REFERENCES `dt_cat` (`id_dt_cat`);

--
-- Constraints for table `kalender`
--
ALTER TABLE `kalender`
  ADD CONSTRAINT `fk_id_kalender_cat` FOREIGN KEY (`id_kalender_cat`) REFERENCES `kalender_cat` (`id_kalender_cat`);

--
-- Constraints for table `paket`
--
ALTER TABLE `paket`
  ADD CONSTRAINT `fk_id_agen_wisata` FOREIGN KEY (`id_agen_wisata`) REFERENCES `agen_wisata` (`id_agen_wisata`);

--
-- Constraints for table `wisata`
--
ALTER TABLE `wisata`
  ADD CONSTRAINT `fk_id_wisata_cat` FOREIGN KEY (`id_wisata_cat`) REFERENCES `wisata_cat` (`id_wisata_cat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
