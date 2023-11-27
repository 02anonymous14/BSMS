/*
SQLyog Enterprise v12.09 (64 bit)
MySQL - 10.4.28-MariaDB : Database - beauty
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`beauty` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;

USE `beauty`;

/*Table structure for table `tblappointment` */

DROP TABLE IF EXISTS `tblappointment`;

CREATE TABLE `tblappointment` (
  `Appointment_ID` int(10) NOT NULL AUTO_INCREMENT,
  `AptNumber` varchar(80) DEFAULT NULL,
  `Name` varchar(120) DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `PhoneNumber` bigint(11) DEFAULT NULL,
  `Beautician` varchar(50) DEFAULT NULL,
  `AptDate` varchar(120) DEFAULT NULL,
  `AptTime` varchar(120) DEFAULT NULL,
  `Services` varchar(120) DEFAULT NULL,
  `ApplyDate` timestamp NULL DEFAULT current_timestamp(),
  `Remark` varchar(250) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `RemarkDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`Appointment_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tblappointment` */

insert  into `tblappointment`(`Appointment_ID`,`AptNumber`,`Name`,`Email`,`PhoneNumber`,`Beautician`,`AptDate`,`AptTime`,`Services`,`ApplyDate`,`Remark`,`Status`,`RemarkDate`) values (22,'869782272','online1','online1@gmail.com',24234,'DAVID SALON','11/28/2023','12:30am','Fruit Facial','2023-11-22 18:23:59','online','1','2023-11-22 18:32:57'),(23,'641046643','ONLINEASD','ONLINEASD@GMAIL.COM',3252345,'DAVID SALON','11/28/2023','1:30am','Charcol Facial','2023-11-25 09:32:47','','','0000-00-00 00:00:00'),(24,'178424107','online1ASD','online1ASD@GMAIL.COM',543,'DAVID SALON','11/27/2023','1:00am','Fruit Facial','2023-11-25 09:41:58','ACCEPTED','1','2023-11-25 09:42:20');

/*Table structure for table `tblbeautician_expertise` */

DROP TABLE IF EXISTS `tblbeautician_expertise`;

CREATE TABLE `tblbeautician_expertise` (
  `Beautician_Expertise_ID` int(10) NOT NULL AUTO_INCREMENT,
  `Beautician_ID` int(10) DEFAULT NULL,
  `Services_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`Beautician_Expertise_ID`),
  KEY `Beautician_ID` (`Beautician_ID`),
  KEY `Services_ID` (`Services_ID`),
  CONSTRAINT `tblbeautician_expertise_ibfk_1` FOREIGN KEY (`Beautician_ID`) REFERENCES `tblbeauticians` (`Beautician_ID`),
  CONSTRAINT `tblbeautician_expertise_ibfk_2` FOREIGN KEY (`Services_ID`) REFERENCES `tblservices` (`Services_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tblbeautician_expertise` */

/*Table structure for table `tblbeauticians` */

DROP TABLE IF EXISTS `tblbeauticians`;

CREATE TABLE `tblbeauticians` (
  `Beautician_ID` int(10) NOT NULL AUTO_INCREMENT,
  `Name` varchar(120) DEFAULT NULL,
  `Phone` varchar(11) NOT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Department` varchar(100) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`Beautician_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tblbeauticians` */

insert  into `tblbeauticians`(`Beautician_ID`,`Name`,`Phone`,`Email`,`Department`,`CreationDate`,`UpdationDate`) values (15,'MISS KAYE','231456','MISSKAYE@GMAIL.COM','Facial','2023-10-12 10:44:55','2023-11-21 14:15:53'),(16,'DAVID SALON','9898987','DAVIDSALON@GMAIL.COM','Facial','2023-10-12 11:12:45','2023-11-21 14:15:58'),(17,'JACK SPAROW','4324523','JACKSPAROW@GMAIL.COM','Hair','2023-10-12 13:48:37','2023-11-21 18:11:41'),(18,'WINNIE THE POOH','2354','WINNIETHEPOOH@GMAIL.COM','Hair','2023-10-12 14:13:06','2023-11-21 14:15:39'),(21,'sample1 beautician1','09554452222','sample beautician@gmail.com','Massage','2023-11-21 13:28:49',NULL);

/*Table structure for table `tblcategory` */

DROP TABLE IF EXISTS `tblcategory`;

CREATE TABLE `tblcategory` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tblcategory` */

insert  into `tblcategory`(`category_id`,`category`) values (1,'Hair'),(2,'Nail'),(3,'Facial'),(4,'Massage'),(5,'Nurse & Clinic'),(7,'Dental');

/*Table structure for table `tblcustomers` */

DROP TABLE IF EXISTS `tblcustomers`;

CREATE TABLE `tblcustomers` (
  `Customers_ID` int(10) NOT NULL AUTO_INCREMENT,
  `Name` varchar(120) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(11) DEFAULT NULL,
  `Gender` enum('Female','Male','Transgender') DEFAULT NULL,
  `Details` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`Customers_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tblcustomers` */

insert  into `tblcustomers`(`Customers_ID`,`Name`,`Email`,`MobileNumber`,`Gender`,`Details`,`CreationDate`,`UpdationDate`) values (19,'sample1','sample1@gmail.com',12311111,'Female','asd','2023-11-22 18:25:46',NULL),(20,'wew','wew@gmail.com',54,'Female','wew','2023-11-23 19:34:44',NULL),(21,'try1','try1@gmail.com',123432,'Female','try1','2023-11-25 08:46:06',NULL);

/*Table structure for table `tblinvoice` */

DROP TABLE IF EXISTS `tblinvoice`;

CREATE TABLE `tblinvoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `beautician` varchar(20) DEFAULT NULL,
  `Services_ID` int(10) DEFAULT NULL,
  `BillingId` int(11) DEFAULT NULL,
  `invoicefrom` varchar(20) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `Customers_ID` int(11) DEFAULT NULL,
  `Paymentstatus` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Customers_ID` (`Customers_ID`),
  KEY `Services_Id` (`Services_ID`),
  CONSTRAINT `tblinvoice_ibfk_1` FOREIGN KEY (`Customers_ID`) REFERENCES `tblcustomers` (`Customers_ID`),
  CONSTRAINT `tblinvoice_ibfk_2` FOREIGN KEY (`Services_ID`) REFERENCES `tblservices` (`Services_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tblinvoice` */

insert  into `tblinvoice`(`id`,`beautician`,`Services_ID`,`BillingId`,`invoicefrom`,`PostingDate`,`Customers_ID`,`Paymentstatus`) values (70,'MISS KAYE',1,716497116,'WALK IN CLIENT','2023-11-22 18:26:28',19,'PAID'),(71,'JACK SPAROW',8,716497116,'WALK IN CLIENT','2023-11-22 18:26:28',19,'PAID'),(72,'JACK SPAROW',8,305999518,'WALK IN CLIENT','2023-11-23 19:35:19',20,NULL),(73,'sample1 beautician1',19,305999518,'WALK IN CLIENT','2023-11-23 19:35:19',20,NULL),(74,'MISS KAYE',1,287257922,'WALK IN CLIENT','2023-11-25 08:46:20',21,'PAID');

/*Table structure for table `tblinvoice_from_onlineappointment` */

DROP TABLE IF EXISTS `tblinvoice_from_onlineappointment`;

CREATE TABLE `tblinvoice_from_onlineappointment` (
  `tblinvoice_from_onlineappointment_id` int(11) NOT NULL AUTO_INCREMENT,
  `beautician` varchar(50) DEFAULT NULL,
  `Services_ID` int(10) DEFAULT NULL,
  `BillingId` int(11) DEFAULT NULL,
  `invoicefrom` varchar(20) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `Appointment_ID` int(11) DEFAULT NULL,
  `Paymentstatus` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`tblinvoice_from_onlineappointment_id`),
  KEY `Services_ID` (`Services_ID`),
  KEY `Appointment_ID` (`Appointment_ID`),
  CONSTRAINT `tblinvoice_from_onlineappointment_ibfk_1` FOREIGN KEY (`Services_ID`) REFERENCES `tblservices` (`Services_ID`),
  CONSTRAINT `tblinvoice_from_onlineappointment_ibfk_2` FOREIGN KEY (`Appointment_ID`) REFERENCES `tblappointment` (`Appointment_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tblinvoice_from_onlineappointment` */

insert  into `tblinvoice_from_onlineappointment`(`tblinvoice_from_onlineappointment_id`,`beautician`,`Services_ID`,`BillingId`,`invoicefrom`,`PostingDate`,`Appointment_ID`,`Paymentstatus`) values (9,'DAVID SALON',2,954011002,'ONLINE APPOINTMENT','2023-11-25 09:42:20',24,'PAID');

/*Table structure for table `tblservices` */

DROP TABLE IF EXISTS `tblservices`;

CREATE TABLE `tblservices` (
  `Services_ID` int(10) NOT NULL AUTO_INCREMENT,
  `Category` varchar(20) DEFAULT NULL,
  `ServiceName` varchar(200) DEFAULT NULL,
  `Cost` int(10) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Services_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tblservices` */

insert  into `tblservices`(`Services_ID`,`Category`,`ServiceName`,`Cost`,`CreationDate`) values (1,'Facial','O3 Facial',1200,'2019-07-25 19:22:38'),(2,'Facial','Fruit Facial',500,'2019-07-25 19:22:53'),(3,'Facial','Charcol Facial',1000,'2019-07-25 19:23:10'),(4,'Nail','Deluxe Menicure',500,'2019-07-25 19:23:34'),(5,'Nail','Deluxe Pedicure',600,'2019-07-25 19:23:47'),(6,'Nail','Normal Menicure',300,'2019-07-25 19:24:01'),(7,'Nail','Normal Pedicure',400,'2019-07-25 19:24:19'),(8,'Hair','U-Shape Hair Cut',250,'2019-07-25 19:24:38'),(9,'Hair','Layer Haircut',550,'2019-07-25 19:24:53'),(10,'Hair','Rebonding',300,'2019-07-25 19:25:08'),(11,'Hair','Loreal Hair Color(Full)',1200,'2019-07-25 19:25:35'),(12,'Massage','Body Spa',1500,'2019-08-19 21:36:27'),(17,'Nail','Manicure',150,'2023-08-03 22:25:04'),(18,'Nail','Pedicure',250,'2023-08-04 10:55:54'),(19,'Massage','Hilot',100,'2023-08-04 11:07:40');

/*Table structure for table `tblusers` */

DROP TABLE IF EXISTS `tblusers`;

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `permission` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` int(11) NOT NULL,
  `userimage` varchar(255) NOT NULL DEFAULT 'but.jpg',
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tblusers` */

insert  into `tblusers`(`id`,`name`,`lastname`,`username`,`email`,`sex`,`permission`,`password`,`mobile`,`userimage`,`status`) values (15,'Kane','Torress','AppointmentInCharge','torreskane@gmail.com','Male','Super User','81dc9bdb52d04dc20036dbd8313ed055',2147483647,'358143046_664977285662796_1398645901509796520_n.jpg',1),(21,'Arinaitwe','Gerald','gerald','gerald@gmail.com','Male','Admin','81dc9bdb52d04dc20036dbd8313ed055',770546590,'but.jpg',1),(22,'Jessica ','Lim','Admin','limjessica@gmail.com','Female','Admin','81dc9bdb52d04dc20036dbd8313ed055',2147483647,'ssalon7.jpg',1),(25,'user','user','user','user@gmail.com','Male','User','81dc9bdb52d04dc20036dbd8313ed055',11,'but.jpg',1);

/*Table structure for table `userlog` */

DROP TABLE IF EXISTS `userlog`;

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userEmail` varchar(20) DEFAULT NULL,
  `userip` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `lastname` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `userlog` */

insert  into `userlog`(`id`,`userEmail`,`userip`,`status`,`username`,`name`,`lastname`) values (1,'user@gmail.com','::1','1','user','user','user'),(2,'limjessica@gmail.com','::1','1','admin','Jessica ','Lim'),(3,'user@gmail.com','::1','1','user','user','user'),(4,'user@gmail.com','::1','1','user','user','user'),(5,'Not registered in sy','::1','0','user','Potential Hacker',NULL),(6,'user@gmail.com','::1','1','user','user','user'),(7,'user@gmail.com','::1','1','user','user','user');

/*Table structure for table `allinvoices` */

DROP TABLE IF EXISTS `allinvoices`;

/*!50001 DROP VIEW IF EXISTS `allinvoices` */;
/*!50001 DROP TABLE IF EXISTS `allinvoices` */;

/*!50001 CREATE TABLE  `allinvoices`(
 `id` int(11) ,
 `Services_ID` int(11) ,
 `BillingId` int(11) ,
 `invoicefrom` varchar(20) ,
 `PostingDate` timestamp ,
 `Customers_ID` int(11) 
)*/;

/*Table structure for table `allsales` */

DROP TABLE IF EXISTS `allsales`;

/*!50001 DROP VIEW IF EXISTS `allsales` */;
/*!50001 DROP TABLE IF EXISTS `allsales` */;

/*!50001 CREATE TABLE  `allsales`(
 `BillingId` int(11) ,
 `PostingDate` timestamp ,
 `invoicefrom` varchar(20) ,
 `ServiceName` varchar(200) ,
 `Cost` int(11) 
)*/;

/*Table structure for table `beautician_with_services` */

DROP TABLE IF EXISTS `beautician_with_services`;

/*!50001 DROP VIEW IF EXISTS `beautician_with_services` */;
/*!50001 DROP TABLE IF EXISTS `beautician_with_services` */;

/*!50001 CREATE TABLE  `beautician_with_services`(
 `Name` varchar(120) ,
 `Department` varchar(100) ,
 `Services_ID` int(10) ,
 `ServiceName` varchar(200) ,
 `Cost` int(10) 
)*/;

/*Table structure for table `onlineapointmentsales` */

DROP TABLE IF EXISTS `onlineapointmentsales`;

/*!50001 DROP VIEW IF EXISTS `onlineapointmentsales` */;
/*!50001 DROP TABLE IF EXISTS `onlineapointmentsales` */;

/*!50001 CREATE TABLE  `onlineapointmentsales`(
 `BillingId` int(11) ,
 `PostingDate` timestamp ,
 `invoicefrom` varchar(20) ,
 `ServiceName` varchar(200) ,
 `Cost` int(10) 
)*/;

/*Table structure for table `searchforinvoice` */

DROP TABLE IF EXISTS `searchforinvoice`;

/*!50001 DROP VIEW IF EXISTS `searchforinvoice` */;
/*!50001 DROP TABLE IF EXISTS `searchforinvoice` */;

/*!50001 CREATE TABLE  `searchforinvoice`(
 `Name` varchar(120) ,
 `invoicefrom` varchar(20) ,
 `BillingId` int(11) ,
 `PostingDate` timestamp ,
 `Paymentstatus` varchar(10) 
)*/;

/*Table structure for table `walkinclientsales` */

DROP TABLE IF EXISTS `walkinclientsales`;

/*!50001 DROP VIEW IF EXISTS `walkinclientsales` */;
/*!50001 DROP TABLE IF EXISTS `walkinclientsales` */;

/*!50001 CREATE TABLE  `walkinclientsales`(
 `BillingId` int(11) ,
 `PostingDate` timestamp ,
 `invoicefrom` varchar(20) ,
 `ServiceName` varchar(200) ,
 `Cost` int(10) 
)*/;

/*View structure for view allinvoices */

/*!50001 DROP TABLE IF EXISTS `allinvoices` */;
/*!50001 DROP VIEW IF EXISTS `allinvoices` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `allinvoices` AS select `tblinvoice`.`id` AS `id`,`tblinvoice`.`Services_ID` AS `Services_ID`,`tblinvoice`.`BillingId` AS `BillingId`,`tblinvoice`.`invoicefrom` AS `invoicefrom`,`tblinvoice`.`PostingDate` AS `PostingDate`,`tblinvoice`.`Customers_ID` AS `Customers_ID` from `tblinvoice` union all select `tblinvoice_from_onlineappointment`.`tblinvoice_from_onlineappointment_id` AS `tblinvoice_from_onlineappointment_id`,`tblinvoice_from_onlineappointment`.`Services_ID` AS `Services_ID`,`tblinvoice_from_onlineappointment`.`BillingId` AS `BillingId`,`tblinvoice_from_onlineappointment`.`invoicefrom` AS `invoicefrom`,`tblinvoice_from_onlineappointment`.`PostingDate` AS `PostingDate`,`tblinvoice_from_onlineappointment`.`Appointment_ID` AS `Appointment_ID` from `tblinvoice_from_onlineappointment` */;

/*View structure for view allsales */

/*!50001 DROP TABLE IF EXISTS `allsales` */;
/*!50001 DROP VIEW IF EXISTS `allsales` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `allsales` AS select `onlineapointmentsales`.`BillingId` AS `BillingId`,`onlineapointmentsales`.`PostingDate` AS `PostingDate`,`onlineapointmentsales`.`invoicefrom` AS `invoicefrom`,`onlineapointmentsales`.`ServiceName` AS `ServiceName`,`onlineapointmentsales`.`Cost` AS `Cost` from `onlineapointmentsales` union all select `walkinclientsales`.`BillingId` AS `BillingId`,`walkinclientsales`.`PostingDate` AS `PostingDate`,`walkinclientsales`.`invoicefrom` AS `invoicefrom`,`walkinclientsales`.`ServiceName` AS `ServiceName`,`walkinclientsales`.`Cost` AS `Cost` from `walkinclientsales` */;

/*View structure for view beautician_with_services */

/*!50001 DROP TABLE IF EXISTS `beautician_with_services` */;
/*!50001 DROP VIEW IF EXISTS `beautician_with_services` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `beautician_with_services` AS select `tblbeauticians`.`Name` AS `Name`,`tblbeauticians`.`Department` AS `Department`,`tblservices`.`Services_ID` AS `Services_ID`,`tblservices`.`ServiceName` AS `ServiceName`,`tblservices`.`Cost` AS `Cost` from ((`tblbeauticians` join `tblbeautician_expertise` on(`tblbeauticians`.`Beautician_ID` = `tblbeautician_expertise`.`Beautician_ID`)) join `tblservices` on(`tblbeautician_expertise`.`Services_ID` = `tblservices`.`Services_ID`)) */;

/*View structure for view onlineapointmentsales */

/*!50001 DROP TABLE IF EXISTS `onlineapointmentsales` */;
/*!50001 DROP VIEW IF EXISTS `onlineapointmentsales` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `onlineapointmentsales` AS select `tblinvoice_from_onlineappointment`.`BillingId` AS `BillingId`,`tblinvoice_from_onlineappointment`.`PostingDate` AS `PostingDate`,`tblinvoice_from_onlineappointment`.`invoicefrom` AS `invoicefrom`,`tblservices`.`ServiceName` AS `ServiceName`,`tblservices`.`Cost` AS `Cost` from (`tblinvoice_from_onlineappointment` join `tblservices` on(`tblinvoice_from_onlineappointment`.`Services_ID` = `tblservices`.`Services_ID`)) where `tblinvoice_from_onlineappointment`.`Paymentstatus` = 'PAID' */;

/*View structure for view searchforinvoice */

/*!50001 DROP TABLE IF EXISTS `searchforinvoice` */;
/*!50001 DROP VIEW IF EXISTS `searchforinvoice` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `searchforinvoice` AS select distinct `tblcustomers`.`Name` AS `Name`,`tblinvoice`.`invoicefrom` AS `invoicefrom`,`tblinvoice`.`BillingId` AS `BillingId`,`tblinvoice`.`PostingDate` AS `PostingDate`,`tblinvoice`.`Paymentstatus` AS `Paymentstatus` from (`tblcustomers` join `tblinvoice` on(`tblcustomers`.`Customers_ID` = `tblinvoice`.`Customers_ID`)) union all select distinct `tblappointment`.`Name` AS `Name`,`tblinvoice_from_onlineappointment`.`invoicefrom` AS `invoicefrom`,`tblinvoice_from_onlineappointment`.`BillingId` AS `BillingId`,`tblinvoice_from_onlineappointment`.`PostingDate` AS `PostingDate`,`tblinvoice_from_onlineappointment`.`Paymentstatus` AS `Paymentstatus` from (`tblappointment` join `tblinvoice_from_onlineappointment` on(`tblappointment`.`Appointment_ID` = `tblinvoice_from_onlineappointment`.`Appointment_ID`)) */;

/*View structure for view walkinclientsales */

/*!50001 DROP TABLE IF EXISTS `walkinclientsales` */;
/*!50001 DROP VIEW IF EXISTS `walkinclientsales` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `walkinclientsales` AS select `tblinvoice`.`BillingId` AS `BillingId`,`tblinvoice`.`PostingDate` AS `PostingDate`,`tblinvoice`.`invoicefrom` AS `invoicefrom`,`tblservices`.`ServiceName` AS `ServiceName`,`tblservices`.`Cost` AS `Cost` from (`tblinvoice` join `tblservices` on(`tblservices`.`Services_ID` = `tblinvoice`.`Services_ID`)) where `tblinvoice`.`Paymentstatus` = 'PAID' */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
