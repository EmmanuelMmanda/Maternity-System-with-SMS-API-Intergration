
DROP TABLE IF EXISTS `appointments`;
CREATE TABLE `appointments` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `maternal_uname` varchar(233) NOT NULL,
  `description` varchar(400) NOT NULL,
  `req_date` varchar(34) NOT NULL COMMENT 'date of need appointment',
  `stage` varchar(23) NOT NULL,
  `status` int(5) NOT NULL DEFAULT 0 COMMENT '0=Def. 1=Approved 2=Denied',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

LOCK TABLES `appointments` WRITE;
INSERT INTO `appointments` VALUES (14,'winnie',' I need checkup, i am nearly giving birth','2022-06-23','Pre Natal',1),(15,'winnie','I need to see the doctor, i am feeling unusual','2022-06-25','Pre Natal',0),(19,'avina','I need a vaccine for my pregnancy','2022-06-22','Pre Natal',1),(20,'avina','My baby moves so fast in the womb','2022-07-14','Pre Natal',0);
UNLOCK TABLES;

DROP TABLE IF EXISTS `child`;
CREATE TABLE `child` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `child_name` varchar(322) NOT NULL,
  `maternal_uname` varchar(50) NOT NULL,
  `gender` varchar(32) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `birthdate` varchar(23) NOT NULL,
  `weight` int(23) NOT NULL,
  `vaccinated` varchar(32) NOT NULL,
  `remarks` varchar(23) NOT NULL,
  `added_on` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
LOCK TABLES `child` WRITE;
INSERT INTO `child` VALUES (4,'James Mligo','winnie','Male','B+','2022-06-20',12,'Yes','So healthy and fine','2022-06-20'),(5,'Jaluti Mroso','winnie','Female','0-','2022-06-17',10,'Yes','She is so healthy','2022-06-20');
UNLOCK TABLES;
DROP TABLE IF EXISTS `diagnosis`;
CREATE TABLE `diagnosis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `maternal_uname` varchar(23) NOT NULL,
  `blood_group` varchar(23) NOT NULL,
  `weight` varchar(50) NOT NULL,
  `stage` varchar(22) NOT NULL,
  `remarks` varchar(323) NOT NULL,
  `diag_date` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

LOCK TABLES `diagnosis` WRITE;
INSERT INTO `diagnosis` VALUES (10,'winnie','A+','45','Pre Natal','She is Alright.','2022-06-20'),(11,'winnie','A-','50','Post Natal','Suucesfull Given Birth','2022-06-20'),(12,'Avina','A+','56','Pre Natal','Doing Fine','2022-06-21');
UNLOCK TABLES;

DROP TABLE IF EXISTS `maternals`;

CREATE TABLE `maternals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(244) NOT NULL,
  `username` varchar(244) NOT NULL,
  `password` varchar(233) NOT NULL,
  `email` varchar(233) NOT NULL,
  `phone` int(20) NOT NULL,
  `address` varchar(233) NOT NULL,
  `birth_date` varchar(20) NOT NULL,
  `joined_on` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

LOCK TABLES `maternals` WRITE;
INSERT INTO `maternals` VALUES (8,'Wiinie Mroso','winnie','827ccb0eea8a706c4c34a16891f84e7b','winie@gmail.com',769642928,'Sinza Tanzania','2004-06-15','0000-00-00 00:00:00'),(9,'Avina Jego','Avina','827ccb0eea8a706c4c34a16891f84e7b','avina@gmail.com',693123153,'Sinza Dar es salaam','2001-06-11','2022-06-21 08:14:17');
UNLOCK TABLES;


DROP TABLE IF EXISTS `medical_officer`;
CREATE TABLE `medical_officer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(244) NOT NULL,
  `username` varchar(344) NOT NULL,
  `password` varchar(232) NOT NULL,
  `email` varchar(233) NOT NULL,
  `phone` varchar(322) NOT NULL,
  `role` varchar(322) NOT NULL,
  `joined_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
LOCK TABLES `medical_officer` WRITE;
INSERT INTO `medical_officer` VALUES (1,'Dr.Emmanuel Mmanda','Administrator','827ccb0eea8a706c4c34a16891f84e7b','admin@man.com','769642828','Admin','2022-06-16 02:50:55');
UNLOCK TABLES;

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `maternal_uname` varchar(233) NOT NULL,
  `phone` int(30) NOT NULL,
  `notification` varchar(232) NOT NULL,
  `appointment_date` varchar(30) NOT NULL,
  `appointment_time` varchar(30) NOT NULL,
  `sent_on` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4;

LOCK TABLES `notifications` WRITE;
INSERT INTO `notifications` VALUES (51,'winnie',769642928,'Martenity Clinic: Hello winnie, Your clinic Appointment has been accepted. You are expected on 2022-06-23 at 15:43 Thanks.','2022-06-23','15:43','2022-06-20'),(54,'Avina',693123153,'Martenity Clinic: Hello Avina, Your clinic Appointment has been accepted. You are expected on 2022-06-23 at 11:00 Thanks.','2022-06-23','11:00','2022-06-21');
UNLOCK TABLES;
