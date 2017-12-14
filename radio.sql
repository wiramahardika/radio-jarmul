/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 10.1.26-MariaDB : Database - radio-jarmul
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`radio-jarmul` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `radio-jarmul`;

/*Table structure for table `broadcaster` */

DROP TABLE IF EXISTS `broadcaster`;

CREATE TABLE `broadcaster` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `broadcaster` */

insert  into `broadcaster`(`id`,`username`,`password`,`token`) values (1,'user1','$2y$10$H0ol/ChBSJIxd71dgCBjZeDLidghjH2RL7O8OSjvrwQbOXYtZ6Dnu',NULL);

/*Table structure for table `user-request` */

DROP TABLE IF EXISTS `user-request`;

CREATE TABLE `user-request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `song` varchar(255) DEFAULT NULL,
  `artist` varchar(255) DEFAULT NULL,
  `message` text,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `user-request` */

insert  into `user-request`(`id`,`nama`,`song`,`artist`,`message`,`time`) values (2,'hml9dO2zGT2xRNQTXsW6zA==','sPLWMtnjaKw8e7sGT8lZ7A==','h0vdw1GRe6443LaNc1/HxA==','1WxyM0Kwd0Ka1r1RpPn9eQ==','2017-12-13 23:00:25'),(3,'5oj15DQmRuVreoJA/fPXrQ==','sPLWMtnjaKw8e7sGT8lZ7A==','h0vdw1GRe6443LaNc1/HxA==','1WxyM0Kwd0Ka1r1RpPn9eQ==','2017-12-13 23:00:49');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
