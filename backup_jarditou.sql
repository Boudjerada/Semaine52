-- MySQL dump 10.13  Distrib 8.0.21, for Win64 (x86_64)
--
-- Host: localhost    Database: jarditou
-- ------------------------------------------------------
-- Server version	8.0.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `jarditou`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `jarditou` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `jarditou`;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `cat_id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'Clé de la table catégorie',
  `cat_nom` varchar(200) NOT NULL COMMENT 'Nom de la catégorie',
  `cat_parent` int unsigned DEFAULT NULL COMMENT 'Catégorie parente',
  PRIMARY KEY (`cat_id`),
  KEY `fk_categories_cat_parent` (`cat_parent`),
  CONSTRAINT `fk_categories_cat_parent` FOREIGN KEY (`cat_parent`) REFERENCES `categories` (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Outillage',NULL),(2,'Outillage manuel',1),(3,'Outillage mécanique',2),(4,'Plants et semis',NULL),(5,'Arbres et arbustes',NULL),(6,'Pots et accessoires',NULL),(7,'Mobilier de jardin',NULL),(8,'Matériaux',NULL),(9,'Tondeuses éléctriques',3),(10,'Tondeuses à moteur thermique',3),(11,'Débroussailleuses',3),(12,'Sécateurs',2),(13,'Brouettes',2),(14,'Tomates',4),(15,'Poireaux',4),(16,'Salade',4),(17,'Haricots',4),(18,'Thuyas',5),(19,'Oliviers',5),(20,'Pommiers',5),(21,'Pots de fleurs',6),(22,'Soucoupes',6),(23,'Supports',6),(24,'Transats',7),(25,'Parasols',7),(26,'Tonnelles',7),(27,'Barbecues',7),(28,'Lames de terrasse',8),(29,'Grillages',8),(30,'Panneaux de clôture',8);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produits`
--

DROP TABLE IF EXISTS `produits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produits` (
  `pro_id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'Clé de la table produits',
  `pro_cat_id` int unsigned NOT NULL COMMENT 'Catégorie du produit',
  `pro_ref` varchar(10) NOT NULL COMMENT 'Référence produit',
  `pro_libelle` varchar(200) NOT NULL COMMENT 'Nom du produit',
  `pro_description` varchar(1000) DEFAULT NULL COMMENT 'Description du produit',
  `pro_prix` decimal(6,2) unsigned NOT NULL COMMENT 'Prix ',
  `pro_stock` int NOT NULL DEFAULT '0' COMMENT 'Nombre d''unités en stock',
  `pro_couleur` varchar(30) DEFAULT NULL COMMENT 'Couleur',
  `pro_photo` varchar(4) DEFAULT 'jpg' COMMENT 'Extension de la photo',
  `pro_d_ajout` date NOT NULL COMMENT 'Date d''ajout',
  `pro_d_modif` datetime DEFAULT NULL COMMENT 'Date de modification',
  `pro_bloque` tinyint(1) DEFAULT NULL COMMENT 'Bloquer le produit à la vente',
  PRIMARY KEY (`pro_id`),
  UNIQUE KEY `idx_pro_ref` (`pro_ref`),
  KEY `fk_produits_cat_id` (`pro_cat_id`),
  CONSTRAINT `fk_produits_cat_id` FOREIGN KEY (`pro_cat_id`) REFERENCES `categories` (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produits`
--

LOCK TABLES `produits` WRITE;
/*!40000 ALTER TABLE `produits` DISABLE KEYS */;
INSERT INTO `produits` VALUES (7,27,'barb001','Aramis ','Lorem ipsum dolor sit amet, consectetur adipiscing elit. In porttitor sit amet ipsum sit amet dapibus. Cras suscipit neque ac magna sagittis lobortis. Duis venenatis enim ac nisl luctus, a scelerisque velit porttitor. Integer nec massa quis urna mollis consectetur et et nisl. Nullam eget nunc vitae nisl convallis faucibus. Vestibulum dapibus, metus nec molestie lobortis, nunc sem mollis tortor, et auctor dolor nunc at nisi. Pellentesque sit amet turpis nisi. ',110.00,2,'Brun','jpg','2018-04-18',NULL,NULL),(8,27,'barb002','Athos','Curabitur pellentesque posuere luctus. Sed et risus vel quam pharetra pretium non quis odio. Praesent varius risus vel orci ultrices tincidunt.',249.99,0,'Noir','jpg','2016-06-14',NULL,NULL),(11,27,'barb003','Clatronic','Fusce rutrum odio sem, quis finibus nisl finibus a. Praesent dictum ex in lectus porta, vitae varius lacus eleifend. Sed sed lacinia mi, sed egestas odio. Integer a congue lectus.',135.90,10,'Chrome','jpg','2017-10-18',NULL,NULL),(12,27,'barb004','Camping','Phasellus auctor mattis justo, in semper urna congue eget. Nunc sit amet nunc sed dui fringilla scelerisque a eget sem. Aenean cursus eros vehicula arcu blandit, sit amet faucibus leo finibus. Duis pharetra felis eget viverra tempor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas',88.00,5,'Noir','jpg','2018-08-20',NULL,1),(13,13,'brou001','Green','Fusce interdum ex justo, vel imperdiet erat volutpat non. Donec et maximus lacus. ',49.00,25,'Verte','jpg','2018-08-01',NULL,NULL),(14,13,'brou002','Silver','Pellentesque ultrices vestibulum sagittis.',88.00,0,'Argent','jpg','2018-08-09',NULL,NULL),(15,13,'brou003','Yellow','Sed lobortis pulvinar orci, ut efficitur urna egestas eu.',54.49,3,'Jaune','jpg','2018-08-12',NULL,NULL),(16,2,'GA410','Bêche GA 410','Nulla at consequat orci.',19.90,50,'Gris','png','2018-08-13',NULL,NULL),(17,2,'beche002','Bêche GA 388','Curabitur varius interdum nulla, sit amet consequat massa. Vestibulum rutrum leo lectus. Phasellus sit amet viverra velit.',24.90,1,'Argent','png','2018-03-15',NULL,NULL),(18,2,'scm0555','Scie à main SCM0555','Pellentesque fermentum ut est sagittis feugiat. Morbi in turpis augue. Maecenas dapibus ligula velit, ac gravida risus imperdiet in.',31.19,0,'Bleue','png','2018-08-19',NULL,NULL),(19,2,'scm559','Scie couteau','raesent ante felis, iaculis vitae lectus sed, luctus laoreet metus. Aenean mattis egestas eleifend. Morbi dictum erat ut lorem porta, a volutpat nibh ultrices. Nunc ut tortor ac velit fringilla dictum at non nulla.',14.90,4,'Bleu','png','2018-04-13',NULL,NULL),(20,2,'h0662','Hache H062','Cras nec dapibus erat. Cras bibendum auctor dui quis tristique.',31.19,0,'Noir','png','2018-08-12',NULL,NULL),(21,11,'DB0703','Titan','Etiam eu sem ligula. Donec aliquet velit a condimentum sagittis. Nullam ipsum augue, porta non vestibulum cursus, eleifend tempor erat. Proin et turpis molestie augue mollis laoreet. Nulla lorem tellus, pellentesque nec hendrerit vehicula, consectetur non nisl. Maecenas eget accumsan lectus. Vivamus eleifend lorem scelerisque augue rutrum laoreet. ',599.99,4,'Bleue','png','1999-08-26',NULL,NULL),(22,11,'DB0755','Attila','Là où passe Attila, l herbe ne repousse pas.',499.99,0,'Bleue','png','2018-05-16',NULL,NULL),(23,28,'LAM121','Aquitaine','Integer aliquet accumsan eleifend. Pellentesque mauris tortor, ultricies a pulvinar ut, fringilla ac mi. Sed consequat, nibh at tempus porttitor, tellus nunc dictum nulla, sed finibus felis augue sed libero. Donec augue mi, mattis et orci ac, mollis feugiat elit.',12.00,0,'Rouge','jpg','2018-03-17',NULL,NULL),(24,28,'LAM233','Brown','Morbi porta ultricies nibh vel varius. Vestibulum nec rutrum ex, vel posuere nisi. Ut scelerisque sit amet ligula sed imperdiet. Morbi lacinia sapien in elementum iaculis. Vivamus a ultrices enim. ',9.98,500,'Brun','jpg','2018-03-17',NULL,NULL),(25,25,'PRS-01C','Biarritz','Quisque fermentum, dui eu elementum sagittis, risus lorem placerat ipsum, vitae venenatis tellus sapien id nibh. Suspendisse et aliquet tellus, in suscipit magna.',157.00,5,'Brun','jpg','2018-08-19',NULL,NULL),(26,25,'PRS-38A','Cannes','Curabitur sodales sem vitae ex commodo, in ullamcorper quam congue. Aliquam erat volutpat. Praesent mollis at velit eu molestie. Proin ac tellus a enim venenatis ultrices vitae sed libero. Vivamus at vulputate orci. Curabitur mattis ac turpis id tempus. Sed turpis enim, egestas ac arcu et, elementum luctus ante.',299.40,4,'rOSE','jpg','2018-08-12',NULL,NULL),(27,25,'PRS-87F','Crotoy','Morbi porta ultricies nibh vel varius. Vestibulum nec rutrum ex, vel posuere nisi. Ut scelerisque sit amet ligula sed imperdiet. Morbi lacinia sapien in elementum iaculis.',89.00,21,'Rouge','jpg','2018-04-12','2018-08-21 00:00:00',NULL),(28,21,'POT_001','Agave','. Vivamus a ultrices enim. Etiam at viverra justo. Cras consectetur justo euismod mi maximus, ac tincidunt leo suscipit. Quisque fermentum, dui eu elementum sagittis, risus lorem placerat ipsum, vitae venenatis tellus sapien id nibh.',288.32,11,'Orange','jpg','2017-11-12',NULL,NULL),(29,21,'POT-002','Dark','Curabitur sodales sem vitae ex commodo, in ullamcorper quam congue. Aliquam erat volutpat. Praesent mollis at velit eu molestie.',32.50,45,'Noir','jpg','2018-08-19',NULL,NULL),(30,21,'POT_003','Fuschia','Vel porta orci convallis. Duis sodales vehicula porta. Etiam sit amet scelerisque massa. ',149.97,0,'Rose','jpg','2018-03-04',NULL,NULL),(31,6,'POT-381','Iris','Praesent nunc dui, porta at leo eget, iaculis ultrices quam. Mauris vulputate metus in nisl aliquam, et sollicitudin nisl mollis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. ',245.00,10,'Marron','jpg','2017-04-16',NULL,NULL),(32,2,'SEC-A','Bahco','In hac habitasse platea dictumst. Quisque at sagittis nunc.',9.90,280,'Orange','jpg','2018-08-14',NULL,NULL),(33,2,'SEC-B','Red','Phasellus ac gravida lorem. Aliquam sed aliquam nisl. Etiam non ornare sapien. Aenean ut tellus non risus varius bibendum quis vel ligula.',14.99,16,'Rouge','jpg','2018-08-05',NULL,NULL),(34,10,'ENH0335','Einhell','Suspendisse congue nibh sed dui commodo sollicitudin. Vestibulum augue eros, accumsan vel vulputate ut, gravida id libero. Nullam sodales urna id nulla porta vestibulum. Aliquam lectus lacus, tincidunt nec metus.',335.00,1,'Rouge','jpg','2018-05-17',NULL,NULL),(35,10,'GRIZ_001','Grizzly','luctus aliquet enim. Phasellus quis velit quis tellus pharetra aliquam in at urna. Cras vitae turpis erat. Phasellus libero arcu, fringilla sit amet tempus blandit, congue eu nulla. Morbi id efficitur tellus.',990.00,1,'Chrome','jpg','2018-08-05',NULL,NULL),(36,9,'HERO','Hero',NULL,75.00,7,'Vert','jpg','2018-08-13',NULL,NULL),(37,9,'SL1280','SL 1280','Quisque nec nisi risus. Fusce eu est non velit mollis tristique a et magna. Proin sodales.',120.50,5,'Vert','jpg','2018-08-05','2018-08-22 00:00:00',NULL),(38,10,'6cv','Red 6CV ','uis vehicula risus in nibh lobortis euismod. In hac habitasse platea dictumst. Quisque at sagittis nunc. Phasellus ac gravida lorem. Aliquam sed aliquam nisl. Etiam non ornare sapien.',348.00,2,'Rouge','jpg','2018-08-16','2018-08-21 00:00:00',NULL),(39,10,'TRIKE','Trike','Aenean ut tellus non risus varius bibendum quis vel ligula. ',497.00,1,'Rouge','jpg','2018-08-21','2018-08-21 10:05:51',NULL),(40,9,'WAZAA','Wazaa',NULL,68.00,14,'Vert','jpg','2018-04-27',NULL,0),(41,9,'ZOOM','Zoom','Nunc magna erat, ultrices et facilisis non, viverra in turpis. Nulla orci mi, maximus eu facilisis a, pretium sit amet ex.',49.80,223,'Gris','jpg','2018-08-13',NULL,NULL);
/*!40000 ALTER TABLE `produits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `us_id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'Clé de la table users',
  `us_nom` varchar(30) NOT NULL COMMENT 'Nom utilisateur',
  `us_prenom` varchar(20) NOT NULL COMMENT 'Prénom utilisateur',
  `us_mail` varchar(250) NOT NULL COMMENT 'Mail utilisateur',
  `us_log` varchar(30) NOT NULL COMMENT 'Login utilisateur',
  `us_mp` varchar(60) NOT NULL COMMENT 'Mot de passe utilisateur',
  `us_d_ins` datetime NOT NULL COMMENT 'Date inscription',
  `us_d_dercon` datetime DEFAULT NULL COMMENT 'Date dernière connexion',
  `us_status` tinyint(1) DEFAULT NULL COMMENT 'Status utilisateur',
  PRIMARY KEY (`us_id`),
  UNIQUE KEY `idx_us_log` (`us_log`),
  UNIQUE KEY `idx_us_mail` (`us_mail`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,'Boudjerada','Nadir','nadir.boudjerada@gmail.com','Nadir82','$2y$10$k4vMuAoWOTTjBz9x5IU1deiRlgO5y3dJHlG/JGdOmm9XEZsFqUbCa','2020-12-23 00:00:00',NULL,1),(4,'Boudjerada','Akim','akim-34@hotmail.fr','mamourette','$2y$10$lzU42DntdvKXjXJJVJB.AuRx6vOnDUglV30D1zFumjDftE/L5ZV.W','2020-12-23 00:00:00',NULL,0),(6,'Boudjerada','Nora','nora.boudjerada@hotmail.fr','antille','$2y$10$VMPbtoKd7A6f9ZfiNilGK.HpkLS3lH9RaJuDXX5.ZeTCBEJNQ/kGG','2020-12-23 00:00:00',NULL,1),(7,'fadika','Fode ','mauro.fadika2@afpa.fr','fodba1','$2y$10$UdbiiN1wEHC5iknsxmbmpuL3ogsADJfL4ZX0rrVIBjS7ukx04Beey','2020-12-24 00:00:00',NULL,1),(8,'fadika','fode','mauro.fadika@afpa.fr','fodba2','$2y$10$QNxVQ94Z7n6hiqSYa11DG.HRsjPR3Lt9ddAs3OnRXumxjX4XE3i62','2020-12-24 00:00:00',NULL,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-12-24 18:11:42
