/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.27-MariaDB : Database - kelompok4
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`kelompok4` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `kelompok4`;

/*Table structure for table `assets` */

DROP TABLE IF EXISTS `assets`;

CREATE TABLE `assets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(250) NOT NULL,
  `harga_beli` varchar(25) NOT NULL,
  `jumlah` varchar(25) NOT NULL,
  `kondisi_barang` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `assets` */

insert  into `assets`(`id`,`nama`,`harga_beli`,`jumlah`,`kondisi_barang`) values 
(1,'komputer','2700000','112','Baru'),
(2,'AC','3000000','47','Baru'),
(3,'Monitor','150000','112','Baru'),
(4,'mobil','3000000','3','Baru'),
(5,'rumah dinas dosen','3000000','20','Baru'),
(6,'rumah dinas pimpinan','3000000','5','Baru'),
(7,'mobil avanza ','200000000','2','Baru'),
(8,'Genset','2700000','3','Baru'),
(9,'motor','2000000','25','Baru'),
(10,'alat musik','2700000','25','Baru'),
(11,'cctv','2000000','35','Baru'),
(12,'meja & kursi','1000000','350','Baru');

/*Table structure for table `images` */

DROP TABLE IF EXISTS `images`;

CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(250) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `images` */

insert  into `images`(`id`,`filename`,`created_at`) values 
(4,'1686250969_e4fde5f2628cf63de59f.jpg','2023-06-09 02:02:49.836844'),
(5,'1686250981_894b018dca5d6fef134b.jpg','2023-06-09 02:03:01.326732'),
(6,'1686250991_5c92e2ac2d71770471e8.jpg','2023-06-09 02:03:11.890336'),
(7,'1686251000_14df5d5cce29fa98478b.jpg','2023-06-09 02:03:20.443645'),
(8,'1686251006_12ccae0a7afeacab9447.jpeg','2023-06-09 02:03:26.675298'),
(9,'1686251012_3e090055b939df6c66df.jpg','2023-06-09 02:03:32.394237'),
(10,'1686251237_484067b24b48df7b23d7.png','2023-06-09 02:07:17.278767'),
(11,'1686251250_524fb09cdf9ca34a7769.jpg','2023-06-09 02:07:30.266454'),
(12,'1686251464_82ddc8e9bc6d7cd1ec55.jpg','2023-06-09 02:11:04.422711');

/*Table structure for table `investasi` */

DROP TABLE IF EXISTS `investasi`;

CREATE TABLE `investasi` (
  `nama_investasi` varchar(250) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `tahun` varchar(250) DEFAULT NULL,
  `keuntungan` decimal(10,0) DEFAULT NULL,
  `biaya` decimal(10,0) DEFAULT NULL,
  `roi` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `investasi` */

insert  into `investasi`(`nama_investasi`,`tanggal`,`tahun`,`keuntungan`,`biaya`,`roi`) values 
('saham','2023-06-13','2023',20000000,2000000,18000000),
('penelitian','2023-06-20','2023',200000000,100000000,100000000),
('solarcshell','2023-06-05','2023',250000000,100000000,150000000),
('metavers','2023-06-06','2023',20000000,10000000,10000000),
('penelitianS','2023-06-14','2023',200000000,50000000,150000000);

/*Table structure for table `karyawan` */

DROP TABLE IF EXISTS `karyawan`;

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `karyawan_username` varchar(50) NOT NULL,
  `karyawan_password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `karyawan` */

insert  into `karyawan`(`id`,`karyawan_username`,`karyawan_password`) values 
(1,'vera','e10adc3949ba59abbe56e057f20f883e'),
(3,'tipal','20f4884318669da9bd3a965f78b046ae'),
(4,'admin','e10adc3949ba59abbe56e057f20f883e'),
(5,'karyawan','e10adc3949ba59abbe56e057f20f883e');

/*Table structure for table `log_asset` */

DROP TABLE IF EXISTS `log_asset`;

CREATE TABLE `log_asset` (
  `id` int(11) NOT NULL,
  `action` varchar(250) NOT NULL,
  `data` varchar(250) NOT NULL,
  `user` varchar(250) NOT NULL,
  `timestamp` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `log_asset` */

insert  into `log_asset`(`id`,`action`,`data`,`user`,`timestamp`) values 
(12,'update','{\"nama\":\"meja & kursi\",\"harga_beli\":\"1000000\",\"jumlah\":\"350\",\"kondisi_barang\":\"Baru\"}','tipal','18:38:32'),
(4,'update','{\"nama\":\"mobil\",\"harga_beli\":\"3000000\",\"jumlah\":\"3\",\"kondisi_barang\":\"seken\"}','vera','18:42:01'),
(4,'update','{\"nama\":\"mobil\",\"harga_beli\":\"3000000\",\"jumlah\":\"3\",\"kondisi_barang\":\"Baru\"}','vera','00:24:58');

/*Table structure for table `log_peminjaman` */

DROP TABLE IF EXISTS `log_peminjaman`;

CREATE TABLE `log_peminjaman` (
  `id` int(11) NOT NULL,
  `action` varchar(250) NOT NULL,
  `data` text NOT NULL,
  `user` varchar(250) NOT NULL,
  `timestamp` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `log_peminjaman` */

insert  into `log_peminjaman`(`id`,`action`,`data`,`user`,`timestamp`) values 
(4,'update','{\"nama_peminjam\":\"Sma 2 Bandar Lampung\",\"nama_barang\":\"Metaverse\",\"tanggal\":\"2023-06-12\",\"nama_penanggung_jawab\":\"parjito\"}','vera','19:47:17');

/*Table structure for table `log_tracking` */

DROP TABLE IF EXISTS `log_tracking`;

CREATE TABLE `log_tracking` (
  `id` int(11) NOT NULL,
  `action` varchar(250) NOT NULL,
  `data` text NOT NULL,
  `user` varchar(250) NOT NULL,
  `timestamp` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `log_tracking` */

insert  into `log_tracking`(`id`,`action`,`data`,`user`,`timestamp`) values 
(2,'insert','{\"nama\":\"rumah dinas dosen\",\"keadaan\":\"bagus\",\"tanggal\":\"2023-06-19\",\"lokasi\":\"kedaton,bandar lampung\"}','vera','20:25:25'),
(3,'update','{\"nama\":\"Monitor\",\"keadaan\":\"cukup baik\",\"tanggal\":\"2023-06-07\",\"lokasi\":\"jl.tengku umar\"}','vera','21:28:06');

/*Table structure for table `peminjaman` */

DROP TABLE IF EXISTS `peminjaman`;

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_peminjam` varchar(250) NOT NULL,
  `nama_barang` varchar(250) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_penanggung_jawab` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `peminjaman` */

insert  into `peminjaman`(`id`,`nama_peminjam`,`nama_barang`,`tanggal`,`nama_penanggung_jawab`) values 
(1,'smk 2 bandar lampung','komputer','2023-05-30','agus'),
(2,'smk 1 bandar lampung','perkakas praktek','2023-06-08','parjito'),
(3,'Smk 2 Kalianda','genset','2023-06-07','parjito'),
(4,'Sma 2 Bandar Lampung','Metaverse','2023-06-12','parjito'),
(5,'tipal','helm sefty','2023-06-19','kisworo');

/*Table structure for table `pengaduan` */

DROP TABLE IF EXISTS `pengaduan`;

CREATE TABLE `pengaduan` (
  `pengaduan` varchar(250) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `ruangan` varchar(250) NOT NULL,
  `nama_user` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pengaduan` */

insert  into `pengaduan`(`pengaduan`,`tanggal`,`waktu`,`ruangan`,`nama_user`) values 
('kerusakan pada wifi ','2023-06-10','13:09:00','lab A','sisno'),
('ac tidak dingin ','2023-06-16','03:06:00','Lab gsg 2','afit'),
('memerlukan 20 korsi','2023-06-16','17:10:00','lab A 2','Muhidin');

/*Table structure for table `tracking` */

DROP TABLE IF EXISTS `tracking`;

CREATE TABLE `tracking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(250) NOT NULL,
  `keadaan` varchar(250) NOT NULL,
  `tanggal` date NOT NULL,
  `lokasi` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tracking` */

insert  into `tracking`(`id`,`nama`,`keadaan`,`tanggal`,`lokasi`) values 
(1,'komputer','cukup baik','2023-05-30','teknokrat'),
(2,'rumah dinas dosen','bagus','2023-06-19','kedaton,bandar lampung'),
(3,'Monitor','cukup baik','2023-06-07','jl.tengku umar');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user` */

insert  into `user`(`id_user`,`username`,`password`) values 
(1,'tipal','5945e5066f79a8c03d3875fe2af21403'),
(5,'Kholifah','e10adc3949ba59abbe56e057f20f883e');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
