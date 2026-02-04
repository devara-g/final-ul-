-- Database: p3
-- Created for SMP PGRI 3 Bogor Admin Dashboard

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Administrator','Editor','Kontributor') NOT NULL DEFAULT 'Kontributor',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--
-- Password default: admin123 (MD5: 0192023a7bbd73250516f069df18b500)
-- Note: Disarankan mengganti mekanisme hashing ke password_hash() (Bcrypt/Argon2) di backend PHP.

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Admin Utama', 'admin@smppgri3bogor.sch.id', '0192023a7bbd73250516f069df18b500', 'Administrator', '2026-02-04 02:00:00'),
(2, 'Guru BK', 'bk@smppgri3bogor.sch.id', '0192023a7bbd73250516f069df18b500', 'Editor', '2026-02-04 02:00:00'),
(3, 'Kesiswaan', 'kesiswaan@smppgri3bogor.sch.id', '0192023a7bbd73250516f069df18b500', 'Kontributor', '2026-02-04 02:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` text NOT NULL,
  `content` longtext NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `title`, `slug`, `excerpt`, `content`, `thumbnail`, `author_id`, `created_at`) VALUES
(1, 'Prestasi Gemilang di Olimpiade Sains', 'prestasi-gemilang-di-olimpiade-sains', 'Tim sains SMP PGRI 3 Bogor meraih juara umum pada ajang Olimpiade Sains Nasional tingkat kota.', '<p>Tim sains SMP PGRI 3 Bogor berhasil meraih prestasi gemilang dengan menjadi juara umum pada ajang Olimpiade Sains Nasional (OSN) tingkat kota Bogor tahun 2026. Kompetisi ini diikuti oleh puluhan sekolah dari seluruh penjuru kota.</p><p>Kepala Sekolah menyampaikan apresiasi setinggi-tingginya kepada para siswa dan guru pembimbing yang telah bekerja keras mempersiapkan diri.</p>', 'https://picsum.photos/seed/pgri-news1/600/400', 1, '2026-01-25 08:00:00'),
(2, 'Peresmian Laboratorium STEAM', 'peresmian-laboratorium-steam', 'Laboratorium baru dilengkapi peralatan robotik dan printer 3D untuk mendukung kurikulum STEAM.', '<p>SMP PGRI 3 Bogor resmi membuka Laboratorium STEAM (Science, Technology, Engineering, Arts, Mathematics) baru yang dilengkapi dengan fasilitas canggih seperti printer 3D, kit robotika, dan komputer spesifikasi tinggi untuk desain grafis.</p><p>Fasilitas ini diharapkan dapat memacu kreativitas siswa dalam menciptakan inovasi teknologi tepat guna.</p>', 'https://picsum.photos/seed/pgri-news2/600/400', 1, '2026-01-18 09:30:00'),
(3, 'Program Adiwiyata Tingkat Nasional', 'program-adiwiyata-tingkat-nasional', 'Sekolah siap mengikuti penilaian Adiwiyata Nasional dengan berbagai inovasi lingkungan.', '<p>Sebagai sekolah yang berwawasan lingkungan, SMP PGRI 3 Bogor tengah bersiap untuk penilaian Adiwiyata tingkat Nasional. Berbagai program unggulan seperti bank sampah, kebun hidroponik, dan pengolahan kompos telah dimaksimalkan.</p><p>Partisipasi seluruh warga sekolah sangat diharapkan untuk mensukseskan program ini demi lingkungan sekolah yang asri dan nyaman.</p>', 'https://picsum.photos/seed/pgri-news3/600/400', 1, '2026-01-10 07:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `category` enum('kegiatan','fasilitas','prestasi','lainnya') NOT NULL DEFAULT 'kegiatan',
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id`, `title`, `category`, `image`, `created_at`) VALUES
(1, 'Upacara Pembukaan MPLS', 'kegiatan', 'https://picsum.photos/seed/pgri-gal1/500/350', '2026-01-15 01:00:00'),
(2, 'Laboratorium STEAM', 'fasilitas', 'https://picsum.photos/seed/pgri-gal2/500/350', '2026-01-18 02:00:00'),
(3, 'Juara Paskibra', 'prestasi', 'https://picsum.photos/seed/pgri-gal3/500/350', '2026-01-20 03:00:00'),
(4, 'Kunjungan Industri', 'kegiatan', 'https://picsum.photos/seed/pgri-gal4/500/350', '2026-01-22 04:00:00'),
(5, 'Smart Library', 'fasilitas', 'https://picsum.photos/seed/pgri-gal5/500/350', '2026-01-25 05:00:00'),
(6, 'Medali Olimpiade Sains', 'prestasi', 'https://picsum.photos/seed/pgri-gal6/500/350', '2026-01-28 06:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `kalender_acara`
--

CREATE TABLE `kalender_acara` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `location` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kalender_acara`
--

INSERT INTO `kalender_acara` (`id`, `title`, `event_date`, `event_time`, `location`, `description`, `created_at`) VALUES
(1, 'Rapat Orang Tua & Guru', '2026-02-10', '08:00:00', 'Aula Utama', 'Pertemuan rutin untuk membahas perkembangan belajar siswa semester gasal.', '2026-02-01 10:00:00'),
(2, 'Pameran Proyek STEAM', '2026-02-21', '09:00:00', 'Gedung Kreativitas', 'Pameran hasil karya siswa dalam bidang Sains, Teknologi, Engineering, Seni, dan Matematika.', '2026-02-01 10:00:00'),
(3, 'Ujian Tengah Semester', '2026-03-04', '07:00:00', 'Seluruh Kelas', 'Pelaksanaan Penilaian Tengah Semester (PTS) Genap Tahun Ajaran 2025/2026.', '2026-02-01 10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'Budi Santoso', 'budi.santoso@gmail.com', 'Pertanyaan PPDB', 'Selamat siang, saya ingin bertanya mengenai jadwal pendaftaran siswa baru untuk tahun ajaran depan. Terima kasih.', '2026-02-03 09:00:00'),
(2, 'Siti Aminah', 'siti.aminah@yahoo.com', 'Undangan Kerjasama', 'Kami dari penerbit buku ingin menawarkan kerjasama pengadaan buku perpustakaan.', '2026-02-02 14:30:00'),
(3, 'Rina Aulia', 'rina.aulia88@gmail.com', 'Keluhan Fasilitas', 'Mohon diperbaiki AC di ruang kelas 8B yang sepertinya rusak/tidak dingin.', '2026-02-01 08:15:00');

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
