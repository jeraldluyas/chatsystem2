/*
SQLyog Ultimate v8.71 
MySQL - 5.5.35-log : Database - chatsystem
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`chatsystem` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `chatsystem`;

/*Table structure for table `messages` */

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `message_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `message` text,
  `create_at` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL,
  `flag` int(11) DEFAULT '0' COMMENT '0 mean new, 1 mean edited, 2 mean deleted',
  `room_id` int(11) NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

/*Data for the table `messages` */

insert  into `messages`(`message_id`,`user_id`,`message`,`create_at`,`update_at`,`flag`,`room_id`) values (13,4,'hello WOrld',1387163439,1387254321,1,1),(14,4,'123',1387182214,1387186740,1,1),(15,4,'1',1387182297,1387185941,2,1),(16,4,'Hello World',1387182327,1387185911,0,1),(17,4,'getMessage()',1387183268,1387185815,2,1),(19,4,'hello mama',1387184413,1387186769,1,1),(20,5,'Anh san desuka',1387186833,1387186851,1,1),(21,4,'hay sou desu',1387186839,1387186839,0,1),(22,4,'a',1387186887,1387186903,2,1),(23,4,'b',1387186887,1387186905,2,1),(24,4,'cxxbbb',1387186888,1387186898,1,1),(25,5,'Test room phÃ¡t',1387186933,1387186933,0,2),(26,7,'Hello everybody',1387252305,1387253078,2,1),(27,7,'xxx',1387253095,1387253101,2,3),(28,7,'KKK',1387253104,1387254245,1,3),(29,4,'Hello ruichi',1387254947,1387255093,2,4),(30,4,'Ohayou haha',1387254954,1387255099,1,4),(31,5,'hieut',1387254997,1387254997,0,4),(32,8,'watashi wa ruichi desu hello world',1387255070,1387255080,1,4);

/*Table structure for table `rooms` */

DROP TABLE IF EXISTS `rooms`;

CREATE TABLE `rooms` (
  `room_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `create_at` int(11) DEFAULT '0',
  `update_at` int(11) DEFAULT NULL,
  `flag` int(11) DEFAULT NULL COMMENT '0 mean create, 1 mean deleted',
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `rooms` */

insert  into `rooms`(`room_id`,`user_id`,`name`,`create_at`,`update_at`,`flag`) values (1,4,'Demo room',1387159470,1387159470,NULL),(2,4,'Hello World',1387163439,1387163439,NULL),(3,4,'Chatroom 3',1387244464,1387244464,NULL),(4,8,'Ruichi room',1387254936,1387254936,NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`user_id`,`username`,`password`) values (4,'anhvn','1de2156869e32a0b701ac11d1361dd7f'),(5,'hieutt','a9d978c96105e59a6cd5dea96515cc49'),(7,'hoangch','599648dd4d84b1f61f90225980a3562b'),(8,'ruichi','3e9c0003ed312c9ec331e7a76229d1e5');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
