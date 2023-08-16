-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jun 12, 2021 at 06:51 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko`
--
DROP DATABASE IF EXISTS `toko`;
CREATE DATABASE IF NOT EXISTS `toko` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `toko`;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `kode_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kode_kategori`, `nama_kategori`) VALUES
(1, 'Handphone'),
(2, 'Kosmetik'),
(3, 'Sembako'),
(4, 'Makanan & Snack'),
(7, 'Hobby & Mainan');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

DROP TABLE IF EXISTS `keranjang`;
CREATE TABLE `keranjang` (
  `kode_keranjang` int(11) NOT NULL,
  `kode_sesi` varchar(100) NOT NULL,
  `kode_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

DROP TABLE IF EXISTS `penjualan`;
CREATE TABLE `penjualan` (
  `nomor` varchar(20) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `nama` varchar(100) NOT NULL,
  `nohp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `provinsi` int(11) NOT NULL DEFAULT 0,
  `kota` int(11) NOT NULL DEFAULT 0,
  `kurir` varchar(50) NOT NULL,
  `ongkir` int(11) NOT NULL DEFAULT 0,
  `total` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`nomor`, `tanggal`, `nama`, `nohp`, `alamat`, `provinsi`, `kota`, `kurir`, `ongkir`, `total`) VALUES
('20210612-002', '2021-06-12 04:28:21', 'Andi', '123', 'Jl. Bunti', 20, 477, 'jne', 77000, 281900),
('20210612-003', '2021-06-12 04:28:56', 'Daniel', '147', 'tes', 3, 232, 'jne', 31000, 2442900),
('20210612-004', '2021-06-12 04:30:46', 'Dewi', '666', 'bbb', 9, 107, 'pos', 30000, 98250);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_detail`
--

DROP TABLE IF EXISTS `penjualan_detail`;
CREATE TABLE `penjualan_detail` (
  `id` int(11) NOT NULL,
  `nomor` varchar(20) NOT NULL,
  `kode_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan_detail`
--

INSERT INTO `penjualan_detail` (`id`, `nomor`, `kode_produk`, `jumlah`, `harga`, `subtotal`) VALUES
(16, '20210612-002', 7, 1, 24900, 24900),
(17, '20210612-002', 9, 4, 45000, 180000),
(19, '20210612-003', 8, 1, 12900, 12900),
(20, '20210612-003', 12, 1, 2399000, 2399000),
(22, '20210612-004', 10, 5, 13650, 68250);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk` (
  `kode_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `kode_kategori` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `foto` text NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`kode_produk`, `nama_produk`, `kode_kategori`, `harga`, `foto`, `deskripsi`) VALUES
(3, 'Wardah Hydra Rose Petal Infused Toner 100 ml', 2, 80000, '3c7b8200-ac67-42c7-a8db-c41ce0e4e256.jpg', 'Wardah Hydra Rose Petal Infused Toner, dengan 72 hours hydration active menghidrasi dan mengembalikan kelembapan kulit agar siap menyerap nutrisi dari produk skin care yang digunakan selanjutnya. Pure rose water dengan Real Rose Petal di dalamnya bantu menenangkan serta mengembalikan kelembapan optimal kulit wajah.'),
(4, '10 pcs boneka jari finger family animal puppet binatang mainan bayi', 7, 39000, '1107915_9010647c-bd50-4932-87c3-6cdeab17ee3d_700_696.jpg', 'PRODUK BARU IMPOR & BERKUALITAS!!!\r\n\r\nBoneka tangan finger family bentuk binatang\r\n- Harga 1 set isi 10 pcs binatang seperti digambar\r\n- Bahan KAIN Velboa LEMBUT yg bisa dicuci tangan\r\n- Merangsang DAYA IMAJINASI dan mengajak baby bermain\r\nHappy shopping di Mamia Sale :)\r\n\r\nTersedia juga 6 pcs finger family boneka keluarga\r\nBeli 6 pcs boneka jari keluarga finger family puppet mainan edukasi bayi'),
(5, 'DON PEDRO TANGO DRINK 250ml [Bundle 4 Pcs] FREE POUCH', 4, 10000, '321a8aa7-32fa-4422-9ae1-e557420fa5d1.jpg', 'Don Pedro Tango Drink, Perpaduan lelehan es krim vanilla yang terbuat dari Susu Sapi Segar\r\nMengandung 7 Vitamin, Cokelat, Kopi dan Hazelnut dalam kemasan RTD PET menggunakan teknologi aseptik yang membuat minuman ini tidak rusak oleh panas & bebas dari bahan pengawet.\r\nDon Pedro Tango Drink, Black is The New Vanilla\r\n\r\nDeskripsi Produk :\r\n- Volume: 250 ml\r\n- Isi : 4 Botol + FREE Pouch Menarik [1 PCS]\r\n- Varian Rasa: Black Vanilla\r\n\r\nAYO BURUAN BELI, STOK TERBATAS!!!\r\n\r\nDi produksi oleh :\r\nPT. CS2 Pola Sehat (Orang Tua Group)\r\nJl. Lingkar Luar Barat Kav. 35 - 36, Cengkareng, Jakarta Barat, 11740, Indonesia.'),
(6, 'PowerBank Kivee 10000mah Mini Dual USB Fast Charging Phone PT32', 1, 75000, '70872897_b579307e-87b4-4144-a400-85a89e3571d9_850_850.jpg', 'Kivee KV-PT32 Power Bank dengan kapasitas yang besar 10.000 mAh untuk mengisi daya handphone kapapun dan dimanapun dengan tampilan yang Sangat Mini dan\r\n\r\nMemiliki dua saluran pengisian 2.1A distrubusi adaptif pintar saat ini, Dapat mendukung dua perangkat untuk mengisi pada waktu yang bersamaan. Pengisian stabil tidak merusak mesin dan tidak membuat panas'),
(7, 'Mouse Wireless SPC SMW-10', 1, 24900, '28583479_1b11b95c-131a-4d17-9f1b-6a1ad93a3985_1280_1280.jpg', 'Mouse Wireless SPC SMW-10 - SPC SMW 10 Wireless Mouse\r\n\r\nwireless 2.4 Ghz technology\r\nergonomic design, comfortable hand touch, easy operation\r\nbuilt in sensitive optical sensor\r\nmini nano receiver is slot in side mouse\r\non/off power switch to extend battery life\r\nautomatic off function to save battery energy\r\nup to 10 meters operation distance\r\nkey switch life more than million times\r\nlow power consumption\r\n1200Dpi, precise and prompt, work freely\r\nsupports windows XP/ME/NT/Vista/10 and Mac or higher version\r\n1*AA battery'),
(8, 'ACMIC Flexy Line Kabel Data Charger 100cm Fast Charging Cable - Type-C FC100', 1, 12900, '8efbd9e8-81ca-4840-9938-0545c94f2ad3.jpg', 'Varian :\r\n• Micro USB FM100 = Kabel Micro USB untuk Android (Lihat produk di gambar Varian)\r\n• Type-C USB FC100 = Kabel USB Type C untuk Android (Lihat produk di gambar Varian)\r\n• iPhone FL100 = Kabel USB Lightning untuk iPhone (Lihat produk di gambar Varian)'),
(9, 'Delfi Twister Black Vanilla 140g - 5pcs', 4, 45000, '092acd33-c462-410b-95dd-12759ee279be.jpg', 'Delfi Twister, wafer gulung cokelat hitam isi krim vanilla yang melimpah dan lezat, cocok untuk menjadi camilanmu setiap saat!\r\n\r\n\r\nSaran penyimpanan :\r\n- Hindari tempat panas / matahari langsung\r\n\r\nSebelum dikirim produk akan melalui proses pengecekan untuk memastikan barang yang customer terima dalam keadaan baik, Packing juga menggunakan dus untuk meminimalisir resiko kerusakan pada pengiriman.\r\nNamun apabila produk rusak diakibatkan handling kurir yang kurang baik, hal tersebut diluar tanggung jawab kami. Terima Kasih atas pengertiannya.'),
(10, 'Royco Bumbu Penyedap Rasa Ayam Pouch 460g', 3, 13650, '23031162_d668daee-1772-408b-8b98-1086ac2e413b_2048_2048.jpg', 'Memberikan rasa mantap khas Indonesia\r\n- Terbuat dari daging ayam pilihan , dan rempah-rempah alami khas Indonesia\r\n- Mudah terserap sehingga cocok untuk beragam hidangan berkuah, aneka tumisan, dan lain-lain.\r\n- Kemasan ekonomis , lebih hemat 35%\r\n\r\nINFORMASI UTAMA PRODUK:\r\n\r\nBAHAN - BAHAN:\r\nGaram, Gula, Penguat Rasa (Mononatrium Glutamat, Dinatrium Inosinat dan Guanilat), Dekstrin, Lemak Nabati, Perisa Identik Alami Ayam (Mengandung Telur), Bawang Bubuk (1%), Pati Jagung, Anti Kempal Silikon Dioksida, Lada Putih Bubuk, Pengatur Keasaman Asam Sitrat, Seledri Bubuk, Daging Ayam (0,02%) (Mengandung Antioksidan TBHQ), Kunyit Bubuk, Pewarna Tartrazin Cl 19140\r\n\r\nDESKRIPSI:\r\nBumbu penyedap khas Indonesia. Terbuat dari daging ayam pilihan & rempah-rempah alami khas Indonesia untuk hasilkan masakan dengan citarasa gurih & rasa daging yang mantap dengan cepat! Mudah terserap sehingga cocok untuk beragam hidangan berkuah, aneka tumisan, dan lain-lain.'),
(11, 'ABC Kecap Manis 225 ml - Multi Pack 6 pcs', 3, 39900, '7ef3d3ba-a397-4385-91ac-8c2ef1f39da7.jpg', 'ABC Kecap Manis 225ml 6pcs\r\n\r\nKecap Manis ABC, terbuatdariperasanpertamakedelaipilihan. Untukmasakan yang lebih kaya rasa, siapapun yang masak. Kecap ABC, disukai oleh 9 dari 10 ibu di Indonesia\r\n\r\nDetail:\r\n- PerasanPertamaKedelaiPilihan\r\n- Lebih Kaya Rasa\r\n- LebihKental&Hitam\r\n\r\nKomposisi:\r\nGula, sari kacangkedelai 12% (mengandunggandum 0.6%), air, garam, pewarnaalamikaramel III dan IV, pengawet natrium benzoat,penstabilnabati, pengaturkeasaman,'),
(12, 'XIAOMI REDMI NOTE 10 4GB-64GB', 1, 2399000, 'data.jpg', 'spesifikasi redmi note 10\r\nsnapdragon 678\r\ncamera 48+8+2\r\ncamera selfie13MP\r\ndisplay 6.43 inchi\r\nbahteray 5000mah\r\n1080x2400 pixels\r\ndisplay super amoled\r\ncorning gorilla glass 3\r\nandroid 11,MIUI 12\r\ninternal 64GB RAM 4GB\r\nfingerprint yes\r\nfast charging 33wat\r\ndual sim (nano sim dual stanby)');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` enum('User','Admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `password`, `level`) VALUES
('admin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kode_kategori`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`kode_keranjang`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`nomor`);

--
-- Indexes for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`kode_produk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kode_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `kode_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `kode_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
