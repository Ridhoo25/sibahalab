-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: bahalab
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Current Database: `bahalab`
--

/*!40000 DROP DATABASE IF EXISTS `bahalab`*/;

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `bahalab` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `bahalab`;

--
-- Table structure for table `sib_bhp`
--

DROP TABLE IF EXISTS `sib_bhp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sib_bhp` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(50) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `stok` int NOT NULL,
  `satuan` varchar(50) DEFAULT 'pcs',
  `lab` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sib_bhp`
--

LOCK TABLES `sib_bhp` WRITE;
/*!40000 ALTER TABLE `sib_bhp` DISABLE KEYS */;
INSERT INTO `sib_bhp` VALUES (15,'HBs AG','Test Card',291,'pcs','Laboratorium Mikrobiologi Klinik'),(16,'HBs Ab','Test Card',211,'pcs','Laboratorium Mikrobiologi Klinik'),(17,'DBT (Ig.G / Ig.M)','Test Card',37,'pcs','Laboratorium Mikrobiologi Klinik'),(18,'RF','reagen',63,'pcs','Laboratorium Mikrobiologi Klinik'),(19,'Syphilis Antibody','Test Card',37,'pcs','Laboratorium Mikrobiologi Klinik'),(20,'BC-3D Hematology Control N','Vial ( 1x3 ml )',1,'pcs','Laboratorium Hematologi Klinik'),(21,'RPR','reagen',31,'pcs','Laboratorium Mikrobiologi Klinik'),(22,'Tubex TF','reagen',68,'pcs','Laboratorium Mikrobiologi Klinik'),(23,'M-30CFL Lyse','Botol (1 x 500 ml)',0,'pcs','Laboratorium Hematologi Klinik'),(24,'HCV','Test Card',48,'pcs','Laboratorium Mikrobiologi Klinik'),(25,'M-30D Diluent','Pack (1 x 20 liter)',1,'pcs','Laboratorium Hematologi Klinik'),(26,'Test Kehamilan','Test Card',0,'pcs','Laboratorium Mikrobiologi Klinik'),(27,'M-30R Rinse','Pack (1 x 20 liter)',2,'pcs','Laboratorium Hematologi Klinik'),(28,'NS-1','Test Card',48,'pcs','Laboratorium Mikrobiologi Klinik'),(29,'HIV','Test Card',39,'pcs','Laboratorium Mikrobiologi Klinik'),(30,'Probe Cleanser','Botol (1 x 50 ml)',2,'pcs','Laboratorium Hematologi Klinik'),(31,'Control-Test M','Strip',94,'pcs','Laboratorium Hematologi Klinik'),(32,'Combur 10 Test M','Strip',173,'pcs','Laboratorium Hematologi Klinik'),(33,'Combur 10 Test UX','Strip',100,'pcs','Laboratorium Hematologi Klinik'),(34,'Liquichek Urinalysis Control Level 1','Vial (1x12 ml)',3,'pcs','Laboratorium Hematologi Klinik'),(35,'Liquichek Urinalysis Control Level 2','Vial (1x12 ml)',2,'pcs','Laboratorium Hematologi Klinik'),(36,'Amphetamine Single Card','Test card',146,'pcs','Laboratorium Hematologi Klinik'),(37,'Methamphetamine Single Card','Test Card',91,'pcs','Laboratorium Hematologi Klinik'),(38,'Benzodiazepine Single Card','Test Card',152,'pcs','Laboratorium Hematologi Klinik'),(39,'THC Single Card','Test Card',154,'pcs','Laboratorium Hematologi Klinik'),(40,'Napza 5 Parameter','Test Card',22,'pcs','Laboratorium Hematologi Klinik'),(41,'Napza 7 Parameter','Test Card',53,'pcs','Laboratorium Hematologi Klinik'),(42,'Anti-A monoclonal','Vial (1 x 10 ml)',1,'pcs','Laboratorium Hematologi Klinik'),(43,'Glucose A15','Reagen, 10 x 50 ml',1,'pcs','Laboratorium Kimia Klinik'),(44,'Anti-B monoclonal','Vial (1 x 10 ml)',1,'pcs','Laboratorium Hematologi Klinik'),(45,'Triglycerides BTS-350','Reagen, 4 x 50 ml',1,'pcs','Laboratorium Kimia Klinik'),(46,'Anti-AB monoclonal','Vial (1 x 10 ml)',1,'pcs','Laboratorium Hematologi Klinik'),(47,'Uric Acid A15','Reagen, 10 x 50 ml',0,'pcs','Laboratorium Kimia Klinik'),(48,'Anti-D monoclonal','Vial (1 x 10 ml)',1,'pcs','Laboratorium Hematologi Klinik'),(49,'Cholesterol HDL A15','Reagen, 4 x 20 ml',0,'pcs','Laboratorium Kimia Klinik'),(50,'Giemsa','Botol (1 x 500 ml)',1,'pcs','Laboratorium Mikrobiologi Klinik'),(51,'Cholesterol LDL A15','Reagen, 4 x 20 ml',1,'pcs','Laboratorium Kimia Klinik'),(52,'Alkohol 70%','Botol (1 liter)',2,'pcs','Laboratorium Hematologi Klinik'),(53,'Urea A15','Reagen, 5 x 50 ml',0,'pcs','Laboratorium Kimia Klinik'),(54,'ALT/GPT A15','Reagen, 5 x 50 ml',0,'pcs','Laboratorium Kimia Klinik'),(55,'Albumin A15','Reagen, 5 x 50 ml',0,'pcs','Laboratorium Kimia Klinik'),(56,'Protein Total','Reagen, 1 x 250 ml',0,'pcs','Laboratorium Kimia Klinik'),(57,'Hemoglobin A1C Direct A15','Reagen, 1x50 + 1x10 ml',0,'pcs','Laboratorium Kimia Klinik'),(58,'Biochemistry Control Serum (Human) II','Control Serum, 5 x 5 ml',2,'pcs','Laboratorium Kimia Klinik'),(59,'Hemoglobin A1c Direct Standards','Standard, 4 x 0,5 ml',4,'pcs','Laboratorium Kimia Klinik'),(60,'Cholesterol HDL/LDL Calibrator BTS-350','Calibrator, 1 x 1 ml',13,'pcs','Laboratorium Kimia Klinik'),(61,'Biochemistry Control Serum (Human) I','Control Serum, 5 x 5 ml',2,'pcs','Laboratorium Kimia Klinik'),(62,'Widal test','reagen',32,'pcs','Laboratorium Mikrobiologi Klinik'),(66,'DUS 10M','Strip',25,'pcs','Laboratorium Mikrobiologi Klinik'),(67,'Metanol','Botol (1x250 ml)',0,'pcs','Laboratorium Hematologi Klinik'),(68,'NaCl 0.9%','Botol (1x250 ml)',0,'pcs','Laboratorium Hematologi Klinik'),(69,'Minyak emersi','Botol (1x250 ml)',0,'pcs','Laboratorium Hematologi Klinik'),(70,'Extran MA 02 (liquid, neutral, concentrated)','Botol (1x2.5 Liter)',1,'pcs','Laboratorium Hematologi Klinik'),(71,'AST/GOT A15','Reagen, 5 x 50 ml',0,'pcs','Laboratorium Kimia Klinik'),(72,'Bilirubin Direct A15','Reagen',0,'pcs','Laboratorium Kimia Klinik'),(73,'Cholesterol A15','Reagen, 10 x 50 ml',0,'pcs','Laboratorium Kimia Klinik'),(74,'Creatinine BTS-350','Reagen, 4 x 50 ml',1,'pcs','Laboratorium Kimia Klinik'),(75,'Triglycerides A15','Reagen, 10 x 50 ml',0,'pcs','Laboratorium kimia Klinik'),(76,'Creatinine A15','Reagen, 10 x 50 ml',0,'pcs','Laboratorium Kimia Klinik'),(77,'Bilirubin Total A15','Reagen, 5 x 50 ml',0,'pcs','Laboratorium Kimia Klinik'),(78,'Calcium Arsenazo A15','Reagen, 10 x 50 ml',0,'pcs','Laboratorium Kimia Klinik'),(79,'Glucose BTS-350','Reagen, 1 x 200 ml',2,'pcs','Laboratorium Kimia Klinik'),(80,'Cholesterol BTS-350','Reagen, 1 x 200 ml',2,'pcs','Laboratorium Kimia Klinik'),(81,'Uric Acid BTS-350','Reagen, 1 x 200 ml',1,'pcs','Laboratorium Kimia Klinik'),(82,'Urea BTS-350','Reagen, 4 x 50 ml',0,'pcs','Laboratorium Kimia Klinik'),(83,'AST/GOT BTS-350 ','Reagen, 1 x 50 ml',1,'pcs','Laboratorium Kimia Klinik'),(84,'ALT/GPT BTS-350','Reagen, 1 x 200 ml',1,'pcs','Laboratorium Kimia Klinik'),(85,'Albumin BTS-350','Reagen, 1 x 250 ml',0,'pcs','Laboratorium Kimia Klinik'),(86,'Alkaline Phosphatase BTS-350','Reagen',0,'pcs','Laboratorium Kimia Klinik'),(87,'CK BTS-350','Reagen, 1 x 50 ml',0,'pcs','Laboratorium Kimia Klinik'),(88,'Gamma-GT BTS-350','Reagen, 1 x 50 ml',0,'pcs','Laboratorium Kimia Klinik'),(89,'LDH BTS-350','Reagen, 1 x 50 ml',1,'pcs','Laboratorium Kimia Klinik'),(90,'Cholinesterase BTS-350','Reagen, 1 x 50 ml',2,'pcs','Laboratorium Kimia Klinik'),(91,'Biochemistry Calibrator (Human)','Calibrator, 5 x 5 ml',1,'pcs','Laboratorium Kimia Klinik'),(92,'Hemoglobin A1C Control','Control, 1 x 0,5 ml',2,'pcs','Laboratorium Kimia Klinik');
/*!40000 ALTER TABLE `sib_bhp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sib_bhp_keluar`
--

DROP TABLE IF EXISTS `sib_bhp_keluar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sib_bhp_keluar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_bhp` int NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `penerima` varchar(50) NOT NULL,
  `qty` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=245 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sib_bhp_keluar`
--

LOCK TABLES `sib_bhp_keluar` WRITE;
/*!40000 ALTER TABLE `sib_bhp_keluar` DISABLE KEYS */;
INSERT INTO `sib_bhp_keluar` VALUES (4,4,'2025-12-01 08:40:40','Fitri, Afifah, Memes, Isma',500),(5,5,'2025-12-02 00:34:33','hafiz',250),(23,40,'2025-12-04 08:30:32','Mesrawani Silalahi, A.Md.AK',31),(24,36,'2025-12-08 04:26:49','Mesrawani Silalahi, A.Md.AK',1),(25,37,'2025-12-08 04:27:05','Mesrawani Silalahi, A.Md.AK',1),(26,38,'2025-12-08 04:27:16','Mesrawani Silalahi, A.Md.AK',1),(27,39,'2025-12-08 04:27:28','Mesrawani Silalahi, A.Md.AK',1),(28,41,'2025-12-08 04:28:03','Mesrawani Silalahi, A.Md.AK',1),(29,41,'2025-12-08 08:38:51','Ismawati, S.Tr.AK',7),(30,40,'2025-12-08 08:41:50','Ismawati, S.Tr.AK',2),(31,36,'2025-12-08 08:42:12','Ismawati, S.Tr.AK',7),(32,37,'2025-12-08 08:42:27','Ismawati, S.Tr.AK',7),(33,38,'2025-12-08 08:42:44','Ismawati, S.Tr.AK',7),(35,39,'2025-12-08 08:43:31','Ismawati, S.Tr.AK',7),(36,18,'2025-12-09 01:50:10','Eka FIttera Astuty',1),(37,41,'2025-12-09 08:52:38','Ismawati, S.Tr.AK',3),(38,32,'2025-12-10 08:38:53','Ismawati, S.Tr.AK',2),(39,15,'2025-12-11 02:29:56','Eka Fittera Astuty , S.Tr.Kes',1),(40,16,'2025-12-11 02:30:09','Eka Fittera Astuty , S.Tr.Kes',1),(41,32,'2025-12-15 08:02:43','Ismawati, S.Tr.AK',3),(42,36,'2025-12-15 08:12:29','Ismawati, S.Tr.AK',2),(43,37,'2025-12-15 08:12:54','Ismawati, S.Tr.AK',2),(44,38,'2025-12-15 08:13:09','Ismawati, S.Tr.AK',2),(45,39,'2025-12-15 08:13:19','Ismawati, S.Tr.AK',2),(46,32,'2025-12-16 08:09:42','Ismawati, S.Tr.AK',3),(47,65,'2025-12-17 03:41:23','Ridho',1),(48,41,'2025-12-17 09:05:33','Ismawati, S.Tr.AK',1),(49,17,'2025-12-18 01:47:32','Eka Fittera Astuty , S.Tr.Kes',1),(50,17,'2025-12-19 03:49:09','Eka Fittera Astuty, S.Tr.Kes',1),(51,19,'2025-12-19 03:49:27','Eka Fittera Astuty, S.Tr.Kes',1),(52,21,'2025-12-19 03:49:42','Eka Fittera Astuty, S.Tr.Kes',1),(53,15,'2025-12-23 01:31:11','Eka Fittera Astuty , S.Tr.Kes',1),(54,16,'2025-12-23 01:31:27','Eka Fittera Astuty , S.Tr.Kes',1),(55,32,'2025-12-23 01:47:58','Ismawati, S.Tr.AK',3),(56,41,'2025-12-23 01:48:27','Ismawati, S.Tr.AK',1),(58,36,'2026-01-05 05:31:44','Mesrawani Silalahi, A.Md.AK',2),(59,37,'2026-01-05 05:32:27','Mesrawani Silalahi, A.Md.AK',2),(60,38,'2026-01-05 05:32:53','Mesrawani Silalahi, A.Md.AK',2),(61,39,'2026-01-05 05:33:09','Mesrawani Silalahi, A.Md.AK',2),(62,41,'2026-01-05 05:35:08','Mesrawani Silalahi, A.Md.AK',7),(63,32,'2026-01-05 05:37:58','Mesrawani Silalahi, A.Md.AK',2),(64,34,'2026-01-05 05:38:44','Ismawati, S.Tr.AK',1),(65,35,'2026-01-05 05:38:52','Ismawati, S.Tr.AK',1),(66,20,'2026-01-05 05:39:15','Ismawati, S.Tr.AK',1),(67,32,'2026-01-05 08:44:51','Ismawati, S.Tr.AK',3),(68,31,'2026-01-05 08:45:06','Ismawati, S.Tr.AK',1),(69,41,'2026-01-05 08:45:31','Ismawati, S.Tr.AK',1),(70,36,'2026-01-05 08:45:43','Ismawati, S.Tr.AK',1),(71,37,'2026-01-05 08:45:51','Ismawati, S.Tr.AK',1),(72,38,'2026-01-05 08:46:02','Ismawati, S.Tr.AK',1),(73,39,'2026-01-05 08:46:11','Ismawati, S.Tr.AK',1),(74,15,'2026-01-06 01:36:54','kuantitas ',1),(75,16,'2026-01-06 01:37:11','kuantitas ',1),(76,28,'2026-01-06 01:37:36','kuantitas ',1),(77,17,'2026-01-06 01:38:22','kuantitas ',1),(78,22,'2026-01-06 01:38:44','kuantitas ',2),(79,15,'2026-01-06 01:39:05','kuantitas ',2),(80,15,'2026-01-06 06:43:45','kuantitas ',1),(81,15,'2026-01-06 06:44:22','kuantitas ',1),(82,16,'2026-01-06 06:44:32','kuantitas ',1),(83,32,'2026-01-06 08:52:48','Ismawati, S.Tr.AK',3),(84,36,'2026-01-06 08:53:06','Ismawati, S.Tr.AK',1),(85,37,'2026-01-06 08:53:15','Ismawati, S.Tr.AK',1),(86,38,'2026-01-06 08:53:23','Ismawati, S.Tr.AK',1),(87,39,'2026-01-06 08:53:31','Ismawati, S.Tr.AK',1),(88,17,'2026-01-07 06:03:32','Test card',1),(89,62,'2026-01-07 06:04:31','Yuliati',1),(90,32,'2026-01-07 08:44:19','Ismawati, S.Tr.AK',3),(91,18,'2026-01-09 02:59:19','kuantitas ',1),(92,15,'2026-01-12 05:01:48','kuantitas ',1),(93,16,'2026-01-12 05:01:59','kuantitas ',1),(94,41,'2026-01-13 01:50:58','Mesrawani Silalahi, A.Md.AK',2),(95,41,'2026-01-15 07:19:39','Mesrawani Silalahi, A.Md.AK',2),(96,36,'2026-01-15 07:20:05','Mesrawani Silalahi, A.Md.AK',4),(97,37,'2026-01-15 07:20:37','Mesrawani Silalahi, A.Md.AK',4),(98,38,'2026-01-15 07:21:00','Mesrawani Silalahi, A.Md.AK',4),(99,38,'2026-01-15 07:21:17','Mesrawani Silalahi, A.Md.AK',4),(100,36,'2026-01-15 07:22:10','Mesrawani Silalahi, A.Md.AK',1),(101,37,'2026-01-15 07:22:23','Mesrawani Silalahi, A.Md.AK',1),(102,38,'2026-01-15 07:22:37','Mesrawani Silalahi, A.Md.AK',1),(103,39,'2026-01-15 07:22:51','Mesrawani Silalahi, A.Md.AK',1),(104,15,'2026-01-15 07:24:27','Eka Fittera Astuty , S.Tr.Kes',2),(105,16,'2026-01-15 07:24:52','Eka Fittera Astuty , S.Tr.Kes',2),(106,17,'2026-01-15 07:25:06','Eka Fittera Astuty , S.Tr.Kes',1),(107,22,'2026-01-15 07:25:18','Eka Fittera Astuty , S.Tr.Kes',1),(108,16,'2026-01-19 04:07:50','Eka FIttera Astuty',1),(109,19,'2026-01-19 04:09:01','Eka FIttera Astuty',1),(110,23,'2026-01-19 04:09:16','Eka FIttera Astuty',1),(111,66,'2026-01-19 04:09:44','Eka FIttera Astuty',1),(112,41,'2026-01-21 05:58:03','Ismawati, S.Tr.AK',1),(113,32,'2026-01-21 06:02:55','Mesrawani Silalahi, A.Md.AK',4),(114,32,'2026-01-21 06:03:07','Ismawati, S.Tr.AK',3),(115,32,'2026-01-21 06:03:25','Ismawati, S.Tr.AK',5),(116,32,'2026-01-21 06:09:23','Mesrawani Silalahi, A.Md.AK',3),(117,36,'2026-01-21 06:15:35','Ismawati, S.Tr.AK',1),(118,37,'2026-01-21 06:15:46','Ismawati, S.Tr.AK',1),(119,38,'2026-01-21 06:15:55','Ismawati, S.Tr.AK',1),(120,39,'2026-01-21 06:16:03','Ismawati, S.Tr.AK',1),(121,15,'2026-01-28 07:58:54','Eka FIttera Astuty',1),(122,24,'2026-01-28 07:59:47','Eka FIttera Astuty',1),(123,24,'2026-01-28 08:00:03','Eka FIttera Astuty',1),(124,16,'2026-01-30 03:26:15','Eka FIttera Astuty',1),(125,17,'2026-01-30 03:26:23','Eka FIttera Astuty',1),(126,16,'2026-01-30 03:26:42','Eka FIttera Astuty',1),(127,30,'2026-01-30 03:30:37','Eka FIttera Astuty',1),(128,41,'2026-01-30 03:32:47','Mesrawani Silalahi, A.Md.AK',1),(129,40,'2026-01-30 03:33:22','Mesrawani Silalahi, A.Md.AK',1),(130,41,'2026-01-30 03:33:55','Ismawati, S.Tr.AK',1),(131,40,'2026-01-30 03:34:33','Ismawati, S.Tr.AK',1),(132,36,'2026-01-30 03:34:53','Mesrawani Silalahi, A.Md.AK',1),(133,37,'2026-01-30 03:35:01','Mesrawani Silalahi, A.Md.AK',1),(134,36,'2026-01-30 03:35:13','Ismawati, S.Tr.AK',1),(135,37,'2026-01-30 03:35:24','Ismawati, S.Tr.AK',1),(136,15,'2026-01-30 07:51:26','Eka Fittera Astuty , S.Tr.Kes',2),(137,16,'2026-01-30 07:51:34','Eka Fittera Astuty , S.Tr.Kes',2),(138,18,'2026-01-30 07:51:44','Eka Fittera Astuty , S.Tr.Kes',1),(139,15,'2026-02-02 03:46:27','Eka FIttera Astuty',2),(140,41,'2026-02-03 07:20:17','Ismawati, S.Tr.AK',2),(141,36,'2026-02-03 07:20:44','Ismawati, S.Tr.AK',2),(142,37,'2026-02-03 07:20:55','Ismawati, S.Tr.AK',2),(143,41,'2026-02-03 07:21:15','Ismawati, S.Tr.AK',1),(144,40,'2026-02-03 07:21:57','Ismawati, S.Tr.AK',13),(145,36,'2026-02-03 07:22:19','Ismawati, S.Tr.AK',2),(146,37,'2026-02-03 07:22:32','Ismawati, S.Tr.AK',2),(147,38,'2026-02-03 07:22:40','Ismawati, S.Tr.AK',2),(148,39,'2026-02-03 07:22:49','Ismawati, S.Tr.AK',2),(149,32,'2026-02-03 07:23:33','Ismawati, S.Tr.AK',1),(150,32,'2026-02-03 07:23:54','Ismawati, S.Tr.AK',4),(151,32,'2026-02-03 07:25:09','Ismawati, S.Tr.AK',3),(152,35,'2026-02-05 00:16:48','Ismawati, S.Tr.AK',1),(153,15,'2026-02-05 04:27:23','Eka FIttera Astuty',1),(154,15,'2026-02-05 07:47:02','Eka Fittera Astuty , S.Tr.Kes',1),(155,36,'2026-02-05 07:57:02','Ismawati, S.Tr.AK',2),(156,36,'2026-02-05 07:57:14','Ismawati, S.Tr.AK',1),(157,37,'2026-02-05 07:57:21','Ismawati, S.Tr.AK',3),(158,38,'2026-02-05 07:57:29','Ismawati, S.Tr.AK',3),(159,39,'2026-02-05 07:57:38','Ismawati, S.Tr.AK',3),(160,17,'2026-02-06 02:50:02','Eka FIttera Astuty',1),(161,28,'2026-02-06 02:50:13','Eka FIttera Astuty',1),(162,18,'2026-02-09 04:33:03','Yuliati',1),(163,41,'2026-02-09 05:02:28','Mesrawani Silalahi, A.Md.AK',2),(164,18,'2026-02-11 03:52:49','Eka FIttera Astuty',1),(165,18,'2026-02-11 03:53:12','Eka FIttera Astuty',1),(166,18,'2026-02-11 03:54:38','Eka FIttera Astuty',1),(167,32,'2026-02-11 08:21:11','Ismawati, S.Tr.AK (6/2)',6),(168,32,'2026-02-11 08:21:56','Ismawati, S.Tr.AK (10/2)',0),(169,32,'2026-02-11 08:22:26','Ismawati, S.Tr.AK (11/2)',3),(170,36,'2026-02-11 08:56:20','Mesrawani Silalahi, A.Md.AK',13),(171,37,'2026-02-11 08:56:44','Mesrawani Silalahi, A.Md.AK',13),(172,38,'2026-02-11 08:56:59','Mesrawani Silalahi, A.Md.AK',13),(173,39,'2026-02-11 08:57:16','Mesrawani Silalahi, A.Md.AK',13),(174,36,'2026-02-13 01:12:28','Mesrawani Silalahi, A.Md.AK',25),(175,37,'2026-02-13 01:12:54','Mesrawani Silalahi, A.Md.AK',25),(176,38,'2026-02-13 01:13:16','Mesrawani Silalahi, A.Md.AK',25),(177,39,'2026-02-13 01:13:54','Mesrawani Silalahi, A.Md.AK',25),(178,41,'2026-02-13 01:14:18','Mesrawani Silalahi, A.Md.AK',55),(179,15,'2026-02-18 08:32:28','Yuliati',14),(180,16,'2026-02-18 08:32:49','Yuliati',8),(181,29,'2026-02-18 08:33:06','Yuliati',1),(182,41,'2026-02-18 08:38:19','Mesrawani Silalahi,A.Md.AK',25),(183,41,'2026-02-18 08:39:35','Ismawati, S.Tr.AK (Retur 2 box Merk SR)',50),(184,36,'2026-02-18 08:41:10','Ismawati, S.Tr.AK',1),(185,37,'2026-02-18 08:41:18','Ismawati, S.Tr.AK',1),(186,38,'2026-02-18 08:41:26','Ismawati, S.Tr.AK',1),(187,39,'2026-02-18 08:41:33','Ismawati, S.Tr.AK',1),(188,41,'2026-02-18 08:50:34','Ismawati, S.Tr.AK',17),(189,15,'2026-02-20 03:35:19','Yuliati',1),(190,32,'2026-02-20 06:22:40','Ismawati, S.Tr.AK (QC : 2)',4),(191,34,'2026-02-20 06:22:54','Ismawati, S.Tr.AK',1),(192,70,'2026-02-20 06:24:08','Ismawati, S.Tr.AK',1),(193,15,'2026-02-26 04:30:57','Yuliati',17),(194,43,'2026-03-02 01:19:08','Fitri, tgl 6 Januari 2026',1),(195,71,'2026-03-02 01:20:27','Fitri, tgl 6 Januari 2026',1),(196,49,'2026-03-02 01:25:01','Fitri, tgl 6 Januari 2026',2),(197,51,'2026-03-02 01:26:24','Fitri, tgl 6 Januari 2026',2),(198,72,'2026-03-02 01:30:19','Fitri, tgl 6 Januari 2026',1),(199,73,'2026-03-02 01:33:27','Fitri, tgl 6 Januari 2026',1),(200,60,'2026-03-02 01:35:14','Fitri, tgl 6 Januari 2026',4),(201,54,'2026-03-02 01:37:35','Fitri, tgl 28 Januari 2026',1),(202,74,'2026-03-02 01:40:21','Fitri, tgl 28 Januari 2026',1),(203,45,'2026-03-02 01:42:22','Fitri, tgl 28 Januari 2026',1),(204,41,'2026-03-09 06:25:53','Mesrawani Silalahi,A.Md.AK',2),(205,41,'2026-03-10 07:35:36','Mesrawani Silalahi,A.Md.AK',1),(206,36,'2026-03-10 07:35:53','Mesrawani Silalahi,A.Md.AK',1),(207,37,'2026-03-10 07:36:15','Mesrawani Silalahi,A.Md.AK',1),(208,38,'2026-03-10 07:36:36','Mesrawani Silalahi,A.Md.AK',1),(209,39,'2026-03-10 07:37:00','Mesrawani Silalahi,A.Md.AK',1),(210,41,'2026-03-11 08:00:33','Mesrawani Silalahi,A.Md.AK',4),(211,36,'2026-03-11 08:01:04','Mesrawani Silalahi,A.Md.AK',1),(212,37,'2026-03-11 08:01:24','Mesrawani Silalahi,A.Md.AK',1),(213,38,'2026-03-11 08:01:39','Mesrawani Silalahi,A.Md.AK',1),(214,38,'2026-03-11 08:01:57','Mesrawani Silalahi,A.Md.AK',1),(215,41,'2026-03-13 08:12:02','Mesrawani Silalahi,A.Md.AK',1),(216,36,'2026-03-27 05:46:08','Mesrawani Silalahi,A.Md.AK',3),(217,37,'2026-03-27 05:46:31','Mesrawani Silalahi,A.Md.AK',3),(218,37,'2026-03-27 05:46:44','Mesrawani Silalahi,A.Md.AK',3),(219,39,'2026-03-27 05:47:06','Mesrawani Silalahi,A.Md.AK',3),(220,40,'2026-03-27 05:47:17','Mesrawani Silalahi,A.Md.AK',1),(221,41,'2026-03-27 05:47:42','Mesrawani Silalahi,A.Md.AK',5),(222,36,'2026-03-27 05:48:17','Mesrawani Silalahi,A.Md.AK',1),(223,37,'2026-03-27 05:48:40','Mesrawani Silalahi,A.Md.AK',1),(224,38,'2026-03-27 05:48:55','Mesrawani Silalahi,A.Md.AK',1),(225,39,'2026-03-27 05:49:13','Mesrawani Silalahi,A.Md.AK',1),(226,41,'2026-04-06 07:48:16','Mesrawani Silalahi,A.Md.AK',1),(227,36,'2026-04-06 07:48:30','Mesrawani Silalahi,A.Md.AK',1),(228,37,'2026-04-06 07:48:40','Mesrawani Silalahi,A.Md.AK',1),(229,38,'2026-04-06 07:48:52','Mesrawani Silalahi,A.Md.AK',1),(230,39,'2026-04-06 07:49:06','Mesrawani Silalahi,A.Md.AK',1),(231,41,'2026-04-08 07:43:41','Mesrawani Silalahi,A.Md.AK',1),(232,36,'2026-04-08 07:44:30','Mesrawani Silalahi,A.Md.AK',7),(233,37,'2026-04-08 07:45:16','Mesrawani Silalahi,A.Md.AK',7),(234,38,'2026-04-08 07:45:51','Mesrawani Silalahi,A.Md.AK',7),(235,39,'2026-04-08 07:46:15','Mesrawani Silalahi,A.Md.AK',7),(236,36,'2026-04-09 08:44:46','Mesrawani Silalahi,A.Md.AK',1),(237,37,'2026-04-09 08:44:58','Mesrawani Silalahi,A.Md.AK',1),(238,38,'2026-04-09 08:45:21','Mesrawani Silalahi,A.Md.AK',1),(239,39,'2026-04-09 08:45:40','Mesrawani Silalahi,A.Md.AK',1),(241,95,'2026-07-31 14:07:32','TP',999),(244,95,'2026-07-31 14:51:30','gg',1001);
/*!40000 ALTER TABLE `sib_bhp_keluar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sib_bhp_masuk`
--

DROP TABLE IF EXISTS `sib_bhp_masuk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sib_bhp_masuk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_bhp` int NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `keterangan` varchar(50) NOT NULL,
  `qty` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1163 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sib_bhp_masuk`
--

LOCK TABLES `sib_bhp_masuk` WRITE;
/*!40000 ALTER TABLE `sib_bhp_masuk` DISABLE KEYS */;
INSERT INTO `sib_bhp_masuk` VALUES (1131,4,'2025-12-01 08:39:39','Dika Aprianti',1000),(1132,4,'2025-12-02 00:37:02','',600),(1133,4,'2025-12-02 00:37:15','',10),(1134,2,'2025-12-02 00:38:55','ffffff',1000),(1135,8,'2025-12-02 01:56:47','dika ',30),(1136,10,'2025-12-03 03:55:09','dika',500),(1137,11,'2025-12-03 04:21:30','Dika afrianti ',5),(1138,1,'2025-12-03 04:22:20','dika',10),(1139,13,'2025-12-04 03:41:16','Dika Apriyanthy',25),(1140,20,'2025-12-04 07:19:07','Vial',1),(1141,40,'2025-12-04 07:19:29','Test Card',25),(1142,41,'2025-12-04 07:19:43','Test Card',25),(1143,40,'2025-12-05 02:39:56','Test Card',25),(1144,65,'2025-12-17 03:41:07','Ridho',1),(1145,31,'2025-12-18 07:31:42','Strip Test',50),(1146,28,'2026-01-06 01:33:59','test card',50),(1147,24,'2026-01-06 01:34:22','test card',50),(1148,62,'2026-01-06 01:35:40','reagen',33),(1149,29,'2026-01-30 03:27:46','test card',40),(1150,70,'2026-02-03 07:30:02','Satuan : Botol (2,5 L), Diterima tgl 23/01/2026',2),(1151,20,'2026-02-13 01:11:00','Satuan : Vial (1x3ml), Diterima tgl 12/02/2026',1),(1152,15,'2026-02-18 08:33:48','Test Card',250),(1153,25,'2026-02-23 02:57:26','Pack',1),(1154,38,'2026-02-23 02:57:46','Test Card',150),(1155,39,'2026-02-23 02:58:04','Test Card',150),(1156,43,'2026-02-27 03:04:45','Kemasan : 10 x 50 ml',1),(1157,43,'2026-02-27 03:06:37','Kemasan : 10 x 50 ml, ED : 31-08-2027',1),(1158,71,'2026-02-27 03:10:12','Kemasan : 5 x 50 ml, ED : 10-07-2026',1),(1159,15,'2026-03-02 06:05:34','Box',5),(1161,95,'2026-07-31 14:06:34','HHH',1000);
/*!40000 ALTER TABLE `sib_bhp_masuk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sib_hpv_dna`
--

DROP TABLE IF EXISTS `sib_hpv_dna`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sib_hpv_dna` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tanggal_penerimaan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nama` varchar(100) DEFAULT NULL,
  `kabupaten` varchar(100) DEFAULT NULL,
  `jenis` varchar(100) DEFAULT NULL,
  `suhu` decimal(5,2) DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `harga_satuan` decimal(10,0) DEFAULT NULL,
  `harga_total` decimal(10,0) DEFAULT NULL,
  `status` enum('Belum Dikerjakan','Sudah Dikerjakan') NOT NULL DEFAULT 'Belum Dikerjakan',
  `alasan` text,
  `diproses_oleh` varchar(50) DEFAULT NULL,
  `tgl_disetujui` timestamp NULL DEFAULT NULL,
  `tgl_ditolak` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sib_hpv_dna`
--

LOCK TABLES `sib_hpv_dna` WRITE;
/*!40000 ALTER TABLE `sib_hpv_dna` DISABLE KEYS */;
INSERT INTO `sib_hpv_dna` VALUES (58,'2026-02-06 05:53:00','PKM SELAT','Kapuas','SWAB BASAH',2.50,16,40000,640000,'Sudah Dikerjakan',NULL,'Pimpinan Labkes','2026-08-03 03:49:09',NULL),(59,'2026-02-06 05:53:00','PKM MELATI','Kapuas','SWAB BASAH',2.50,18,40000,720000,'Sudah Dikerjakan',NULL,'Pimpinan Labkes','2026-08-03 03:48:50',NULL),(60,'2026-02-06 05:53:00','PKM PULAU TELO','Kapuas','SWAB BASAH',2.50,15,40000,600000,'Sudah Dikerjakan',NULL,'Pimpinan Labkes','2026-08-03 03:48:48',NULL),(61,'2026-02-06 05:53:00','PKM DANAU RAWAH','Kapuas','SWAB BASAH',2.50,4,40000,160000,'Sudah Dikerjakan',NULL,'Pimpinan Labkes','2026-08-03 03:48:46',NULL),(62,'2026-02-06 05:53:00','PKM BARIMBA','Kapuas','SWAB BASAH',2.50,12,40000,480000,'Sudah Dikerjakan',NULL,'Pimpinan Labkes','2026-08-03 03:48:42',NULL),(63,'2026-02-06 05:53:00','PKM MANDOMAI','Kapuas','SWAB BASAH',2.50,1,40000,40000,'Sudah Dikerjakan',NULL,'Pimpinan Labkes','2026-08-03 03:48:38',NULL),(64,'2026-02-06 05:53:00','PKM PULAU KUPANG','Kapuas','SWAB BASAH',2.50,15,40000,600000,'Sudah Dikerjakan',NULL,'Pimpinan Labkes','2026-08-03 03:48:36',NULL),(65,'2026-02-06 05:53:00','PKM TAMBAN CATUR','Kapuas','SWAB BASAH',2.50,10,40000,400000,'Sudah Dikerjakan',NULL,'Pimpinan Labkes','2026-08-03 03:48:34',NULL),(66,'2026-02-06 05:53:00','PKM TERUSAN TENGAH','Kapuas','SWAB BASAH',2.50,31,40000,1240000,'Sudah Dikerjakan',NULL,'Pimpinan Labkes','2026-08-03 03:48:32',NULL),(67,'2026-02-11 01:44:00','PKM LANJAS','Barito Utara','SWAB BASAH',29.50,29,40000,1160000,'Sudah Dikerjakan',NULL,'Pimpinan Labkes','2026-08-03 03:52:10',NULL);
/*!40000 ALTER TABLE `sib_hpv_dna` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sib_payment_hpv`
--

DROP TABLE IF EXISTS `sib_payment_hpv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sib_payment_hpv` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kabupaten` varchar(191) NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('Unpaid','Paid') NOT NULL DEFAULT 'Unpaid',
  `nomor_invoice` varchar(191) DEFAULT NULL,
  `tgl_paid` datetime DEFAULT NULL,
  `diproses_oleh` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_tagihan` (`kabupaten`,`tanggal`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sib_payment_hpv`
--

LOCK TABLES `sib_payment_hpv` WRITE;
/*!40000 ALTER TABLE `sib_payment_hpv` DISABLE KEYS */;
INSERT INTO `sib_payment_hpv` VALUES (7,'Kapuas','2026-02-06','Unpaid','001/UPTLabkeskal/HPV-DNA/443.46/VIII/2026',NULL,NULL,'2026-08-03 03:53:59'),(8,'Barito Utara','2026-02-11','Paid','002/UPTLabkeskal/HPV-DNA/443.46/VIII/2026','2026-08-03 14:18:32','Pimpinan Labkes','2026-08-03 03:54:07');
/*!40000 ALTER TABLE `sib_payment_hpv` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sib_payment_tb`
--

DROP TABLE IF EXISTS `sib_payment_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sib_payment_tb` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kabupaten` varchar(191) NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('Unpaid','Paid') NOT NULL DEFAULT 'Unpaid',
  `tgl_paid` datetime DEFAULT NULL,
  `diproses_oleh` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_tagihan` (`kabupaten`,`tanggal`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sib_payment_tb`
--

LOCK TABLES `sib_payment_tb` WRITE;
/*!40000 ALTER TABLE `sib_payment_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `sib_payment_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sib_pemeriksaan_tb`
--

DROP TABLE IF EXISTS `sib_pemeriksaan_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sib_pemeriksaan_tb` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tanggal_penerimaan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nama` varchar(100) DEFAULT NULL,
  `kabupaten` varchar(191) DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `harga_satuan` decimal(10,0) DEFAULT NULL,
  `harga_total` decimal(10,0) DEFAULT NULL,
  `status` enum('Belum Dikerjakan','Sudah Dikerjakan') NOT NULL DEFAULT 'Belum Dikerjakan',
  `alasan` text,
  `diproses_oleh` varchar(50) DEFAULT NULL,
  `tgl_disetujui` timestamp NULL DEFAULT NULL,
  `tgl_ditolak` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sib_pemeriksaan_tb`
--

LOCK TABLES `sib_pemeriksaan_tb` WRITE;
/*!40000 ALTER TABLE `sib_pemeriksaan_tb` DISABLE KEYS */;
INSERT INTO `sib_pemeriksaan_tb` VALUES (4,'2026-07-31 15:15:00','pkm a','Kapuas',10,5000,50000,'Belum Dikerjakan',NULL,NULL,NULL,NULL),(5,'2026-07-31 15:15:00','pkm b','Kapuas',50,5000,250000,'Belum Dikerjakan',NULL,NULL,NULL,NULL),(6,'2026-07-31 15:15:00','pkm c','Kapuas',20,5000,100000,'Belum Dikerjakan',NULL,NULL,NULL,NULL),(7,'2026-07-31 15:16:00','pkm 1','Barito Timur',100,5000,500000,'Belum Dikerjakan',NULL,NULL,NULL,NULL),(8,'2026-07-31 15:16:00','pkm 2','Barito Timur',20,5000,100000,'Belum Dikerjakan',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `sib_pemeriksaan_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sib_penerimaan`
--

DROP TABLE IF EXISTS `sib_penerimaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sib_penerimaan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `nama_bhp` varchar(100) NOT NULL,
  `merek` varchar(100) NOT NULL,
  `jumlah` int NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `exp_date` date NOT NULL,
  `laboratorium` varchar(255) DEFAULT NULL,
  `penerima` varchar(100) NOT NULL,
  `status` varchar(100) DEFAULT 'Tersedia',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sib_penerimaan`
--

LOCK TABLES `sib_penerimaan` WRITE;
/*!40000 ALTER TABLE `sib_penerimaan` DISABLE KEYS */;
INSERT INTO `sib_penerimaan` VALUES (5,'2026-01-22','HIV I & II Card Test 40 T','Intec',1,'Box','2027-02-01','Laboratorium Mikrobiologi Klinik','M. Jamaudin Ridho, A.Md.T','Sudah Didistribusikan'),(6,'2026-01-22','HIV 1, 2 Rapid Test Cassette','Ezitell',1,'Box','2026-09-01','Laboratorium Mikrobiologi Klinik','M. Jamaudin Ridho, A.Md.T','Sudah Didistribusikan'),(7,'2026-01-22','Salmonella Paratyphil AH','Dumolab',1,'Vial','2026-06-01','Laboratorium Mikrobiologi Klinik','M. Jamaudin Ridho, A.Md.T','Sudah Didistribusikan'),(8,'2026-01-22','Salmonella Typhi O','Dumolab',1,'Vial','2026-09-01','Laboratorium Mikrobiologi Klinik','M. Jamaudin Ridho, A.Md.T','Sudah Didistribusikan'),(11,'2026-02-18','HBsAg Strip ','SR',1,'Box','2027-05-01','Laboratorium Mikrobiologi Klinik','M. Jamaudin Ridho, A.Md.T','Sudah Didistribusikan'),(12,'2026-02-18','HBsAg Strip ','SR',4,'Box','2027-12-01','Laboratorium Mikrobiologi Klinik','M. Jamaudin Ridho, A.Md.T','Sudah Didistribusikan'),(13,'2026-03-02','Sampel Cup','Biosystem',1,'Pak','2030-11-03','Laboratorium Kimia Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(14,'2026-03-02','Triglycerides','Biosystem',1,'Kit','2026-07-31','Laboratorium Kimia Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(15,'2026-03-02','Uric Acid','Biosystem',1,'Kit','2027-08-31','Laboratorium Kimia Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(16,'2026-03-02','Cholesterol HDL Direct','Biosystem',1,'Kit','2026-10-31','Laboratorium Kimia Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(17,'2026-03-02','Urea/ BUN','Biosystem',1,'Kit','2026-11-30','Laboratorium Kimia Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(18,'2026-03-02','Cholesterol HDL/LDL Calibrator','Biosystem',2,'Kit','2027-07-31','Laboratorium Kimia Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(19,'2026-03-02','Egg Yolk Tel Emulsion','Himedia',1,'Pak','2027-11-30','Laboratorium Mikrobiologi Kesehatan Masyarakat','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(22,'2026-01-06','Glokose','Biosystem',1,'Kit','2027-08-31','Laboratorium Kimia Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(23,'2026-01-06','AST/ GOT','Biosystem',1,'Kit','2026-07-10','Laboratorium Kimia Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(24,'2026-01-06','Cholesterol HDL Direct','Biosystem',2,'Kit','2026-08-18','Laboratorium Kimia Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(25,'2026-01-06','Cholesterol LDL Direct','Biosystem',2,'Kit','2026-10-12','Laboratorium Kimia Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(26,'2026-01-06','Bilirubin Direct','Biosystem',1,'Kit','2026-06-09','Laboratorium Kimia Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(27,'2026-01-06','Cholesterol','Biosystem',1,'Kit','2027-06-08','Laboratorium Kimia Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(28,'2026-01-06','Cholesterol HDL/LDL Calibrator','Biosystem',4,'Kit','2027-07-31','Laboratorium Kimia Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(29,'2026-01-15','Microfil Funnel With S-Pak Membrane Filter','Milipore',2,'Pak','2027-08-31','Laboratorium Mikrobiologi Kesehatan Masyarakat','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(30,'2026-01-15','Extran MA 02 Neutral ','Merck',2,'Botol','2030-11-30','Laboratorium Mikrobiologi Kesehatan Masyarakat','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(31,'2026-01-19','Gas Acetylene','-',2,'Unit','2028-12-04','Laboratorium Kimia Kesehatan dan Toksikologi','M. Jamaudin Ridho, A.Md.T','Sudah Didistribusikan'),(32,'2026-01-28','ALT/ GPT','Biosystem',1,'Kit','2026-10-31','Laboratorium Kimia Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(33,'2026-01-28','Creatinine','Biosystem',1,'Kit','2027-10-30','Laboratorium Kimia Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(34,'2026-01-28','Triglycerides','Biosystem',1,'Kit','2026-07-31','Laboratorium Kimia Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(35,'2026-01-28','AST/ GOT','Biosystem',1,'Kit','2026-11-30','Laboratorium Kimia Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(36,'2026-01-28','Biochemistery Calibrator','Biosystem',1,'Kit','2026-11-30','Laboratorium Kimia Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(37,'2026-01-28','Cholesterol','Biosystem',2,'Kit','2027-03-31','Laboratorium Kimia Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(38,'2026-01-28','Uric Acid','Biosystem',1,'Kit','2027-03-31','Laboratorium Kimia Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(39,'2026-02-12','Control B30 Normal Hematologi','Mindray',1,'Vial','2026-05-31','Laboratorium Hematologi Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(40,'2026-02-12','Methamphetamine Strip','Egens',2,'Box','2027-04-30','Laboratorium Hematologi Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(41,'2026-02-12','Amphetamine Strip','Egens',3,'Box','2027-04-30','Laboratorium Hematologi Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(42,'2026-02-12','Multi Drug 7 Panel','SR',2,'Box','2026-11-30','Laboratorium Hematologi Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(43,'2026-02-12','Multi Drug 7 Panel','Ecotest',1,'Box','2027-10-31','Laboratorium Hematologi Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(44,'2026-02-18','Multi Drug 7 Panel','Ecotest',2,'Box','2027-10-08','Laboratorium Hematologi Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(45,'2026-02-20','Benzodiazepine Strip','Egens',3,'Box','2027-08-31','Laboratorium Hematologi Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(46,'2026-02-20','THC Strip','Egens',3,'Box','2028-01-31','Laboratorium Hematologi Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(47,'2026-02-20','Diluent M-30D','Mindray',1,'Jerigen','2027-06-30','Laboratorium Hematologi Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(48,'2026-02-24','Plate Count Agar','Oxoid',1,'Botol','2027-07-01','Laboratorium Mikrobiologi Kesehatan Masyarakat','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(49,'2026-02-25','Multi Drug 7 Panel','Fastep',5,'Box','2028-02-11','Laboratorium Hematologi Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(50,'2026-02-25','XLD Agar Xylose Lysine Desoxycholate','Merck',1,'Botol','2029-08-31','Laboratorium Mikrobiologi Kesehatan Masyarakat','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(51,'2026-02-25','M-Endo Agar Les For Micribiology','Merck',1,'Botol','2029-05-31','Laboratorium Mikrobiologi Kesehatan Masyarakat','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(52,'2026-02-25','Lactose Broth','Merck',1,'Botol','2029-11-30','Laboratorium Mikrobiologi Kesehatan Masyarakat','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(53,'2026-02-25','Tryptic Soy Broth','Merck',1,'Botol','2030-04-30','Laboratorium Mikrobiologi Kesehatan Masyarakat','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(54,'2026-02-25','GranuCult Prime L-EMB Agar','Merck',1,'Botol','2029-06-30','Laboratorium Mikrobiologi Kesehatan Masyarakat','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(55,'2026-03-04','H2O2 3%','Bio Analitika',1,'Botol','2028-02-29','Laboratorium Mikrobiologi Kesehatan Masyarakat','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(56,'2026-03-04','Gram Hucker Set','Bio Analitika',1,'Set','2028-02-29','Laboratorium Mikrobiologi Kesehatan Masyarakat','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(57,'2026-03-05','Alkaline Saline Peptone Water','Himedia',1,'Botol','2029-04-30','Laboratorium Mikrobiologi Kesehatan Masyarakat','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(58,'2026-03-05','Bacillus Cereus Selective Agar Base','Himedia',1,'Botol','2030-09-30','Laboratorium Mikrobiologi Kesehatan Masyarakat','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(59,'2026-03-05','Methyl Red Indikator','Merck',1,'Botol','2030-12-05','Laboratorium Mikrobiologi Kesehatan Masyarakat','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(60,'2026-03-05','1,5 Diphenylcarbazide','Merck',1,'Botol','2030-12-05','Laboratorium Kimia Kesehatan dan Toksikologi','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(61,'2026-03-05','Malachite Green','Loba Chemie',1,'Botol','2028-07-31','Laboratorium Mikrobiologi Kesehatan Masyarakat','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(62,'2026-03-09','Oxydase For The Detection','Merck',1,'Box','2027-01-31','Laboratorium Mikrobiologi Kesehatan Masyarakat','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(63,'2026-03-09','Azide Dextrose Broth','Merck',1,'Botol','2030-11-30','Laboratorium Mikrobiologi Kesehatan Masyarakat','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(64,'2026-03-09','Extran MA 02','Merck',1,'Botol','2030-10-31','Laboratorium Mikrobiologi Kesehatan Masyarakat','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(65,'2026-03-12','TCBS Cholera Medium','Oxoid',1,'Botol','2030-02-01','Laboratorium Mikrobiologi Kesehatan Masyarakat','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(66,'2026-03-12','Lauryl Tryptose Broth','Oxoid',1,'Botol','2030-08-01','Laboratorium Mikrobiologi Kesehatan Masyarakat','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(67,'2026-03-12','Bacillus Cereus ATCC','Remel',1,'Pack','2027-03-04','Laboratorium Mikrobiologi Kesehatan Masyarakat','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(68,'2026-03-25','Barritt Reagen A For Voges-Proskauer A Test','Himedia',1,'Vial','2028-08-31','Laboratorium Mikrobiologi Kesehatan Masyarakat','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(69,'2026-03-31','HbA1C Direct','Biosystems',1,'Kit','2026-09-25','Laboratorium Kimia Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(70,'2026-03-31','HbA1C Direct Standards','Biosystems',1,'Kit','2026-10-31','Laboratorium Kimia Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(71,'2026-04-07','Surfactants (anionic) CT 25 Test','Merck',1,'Buah','2028-06-30','Laboratorium Kimia Kesehatan dan Toksikologi','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(72,'2026-04-07','Billirubin Total','Biosystems',1,'Kit','2026-09-26','Laboratorium Kimia Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(73,'2026-04-07','Liq Control Urine Chemistry LV. 1','Bio-Rad',1,'Kit','2027-04-30','Laboratorium Hematologi Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(74,'2026-04-07','Liq Control Urine Chemistry LV. 2','Bio-Rad',1,'Kit','2027-04-30','Laboratorium Hematologi Klinik','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(75,'2026-04-13','Gas Acetylene','-',2,'Unit','2029-04-30','Laboratorium Kimia Kesehatan dan Toksikologi','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(76,'2026-04-16','Potassium Peroxodisulfate For Analysis','Merck',1,'Botol','2029-04-30','Laboratorium Kimia Kesehatan dan Toksikologi','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(77,'2026-04-16','CRM Hexavalent Chromium Potable Watr','ERA',2,'Buah','2029-04-30','Laboratorium Kimia Kesehatan dan Toksikologi','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(78,'2026-04-16','CRM Nitrite','ERA',1,'Buah','2029-04-30','Laboratorium Kimia Kesehatan dan Toksikologi','Dika Apriyanthy, A.Md. Kep','Sudah Didistribusikan'),(80,'2026-07-31','Ridho','Ridho',5,'Botol','2031-07-31','Laboratorium Kimia Kesehatan dan Toksikologi','M. Jamaudin Ridho, A.Md.T','Sudah Didistribusikan');
/*!40000 ALTER TABLE `sib_penerimaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sib_pengajuan`
--

DROP TABLE IF EXISTS `sib_pengajuan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sib_pengajuan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `laboratorium` varchar(100) NOT NULL,
  `nama_bhp` varchar(100) NOT NULL,
  `spesifikasi` text NOT NULL,
  `jumlah` int NOT NULL,
  `satuan` text NOT NULL,
  `pemohon` varchar(100) NOT NULL,
  `status` enum('Diajukan','Disetujui','Ditolak','Diproses','Selesai') NOT NULL DEFAULT 'Diajukan',
  `alasan` text,
  `tgl_aksi` timestamp NULL DEFAULT NULL,
  `diproses_oleh` varchar(100) DEFAULT NULL,
  `tgl_disetujui` timestamp NULL DEFAULT NULL,
  `tgl_ditolak` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sib_pengajuan`
--

LOCK TABLES `sib_pengajuan` WRITE;
/*!40000 ALTER TABLE `sib_pengajuan` DISABLE KEYS */;
INSERT INTO `sib_pengajuan` VALUES (46,'2026-01-05 03:53:25','Laboratorium Hematologi Klinik','M-30D Diluent','Merk Mindray, kemasan pack (1x20 liter)',1,'','Ismawati, S.Tr.AK','Disetujui',NULL,NULL,'Prof. Ridho','2026-01-05 06:15:13',NULL),(47,'2026-01-05 03:55:49','Laboratorium Hematologi Klinik','Extran MA 02 (liquid, neutral, concentrated)','Merk \"Merck\", kemasan botol (2,5 Liter)',4,'Botol','Ismawati, S.Tr.AK','Ditolak','Terlalu Banyak',NULL,'Prof. Ridho',NULL,'2026-01-05 06:15:26'),(50,'2026-01-14 00:43:18','Laboratorium Kimia Klinik','Tisu','BHP',10,'','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(51,'2026-01-14 00:45:37','Laboratorium Kimia Klinik','Tip Kuning ( 10 - 100 ??l )','BHP',2,'','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(52,'2026-01-14 00:46:19','Laboratorium Kimia Klinik','Tip Biru ( 200 - 1000 ??l )','BHP',2,'','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(53,'2026-01-14 00:47:39','Laboratorium Kimia Klinik','Larutan Extran MA 02 (Liquid, Neutral, Concentrated), isi 2,5 L','BHP',2,'','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(54,'2026-01-14 00:48:33','Laboratorium Kimia Klinik','Masker Hijab','BHP',3,'','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(55,'2026-01-14 00:49:42','Laboratorium Kimia Klinik','Sarung Tangan Nitrile uk. S','BHP',2,'','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(56,'2026-01-14 00:50:37','Laboratorium Kimia Klinik','Kantung Limbah Infeksius / Plastik Kuning uk. 40','BHP',2,'','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(57,'2026-01-14 00:51:35','Laboratorium Kimia Klinik','Bayclin','Kebersihan',2,'','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(58,'2026-01-14 00:56:47','Laboratorium Kimia Klinik','Cartridge Printer Canon IP2770 (warna)','ATK',1,'','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(59,'2026-01-14 00:58:45','Laboratorium Kimia Klinik','Spidol Permanen','ATK',3,'','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(60,'2026-01-14 00:59:26','Laboratorium Kimia Klinik','Baterai Kecil (AC)','ATK',3,'','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(61,'2026-01-20 04:07:27','Laboratorium Kimia Klinik','Triglycerides','Reagen\r\n\r\nKemasan : 10 x 50 ml\r\nMerk : Biosystems\r\nAlat : A15',1,'','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(62,'2026-01-20 04:08:56','Laboratorium Kimia Klinik','Uric Acid','Reagen\r\n\r\nKemasan : 10 x 50 ml\r\nMerk : Biosystems\r\nAlat : A15',1,'','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(63,'2026-01-20 04:09:36','Laboratorium Kimia Klinik','ALT/GPT','Reagen\r\n\r\nKemasan : 5 x 50 ml\r\nMerk : Biosystems\r\nAlat : A15',1,'','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(64,'2026-01-20 04:10:13','Laboratorium Kimia Klinik','Bilirubin Total','Reagen\r\n\r\nKemasan : 5 x 50 ml\r\nMerk : Biosystems\r\nAlat : A15',1,'','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(65,'2026-01-20 04:11:42','Laboratorium Kimia Klinik','Biochemistry Calibrator (Human)','Calibrator\r\n\r\nKemasan : 5 x 5 ml\r\nMerk : Biosystems\r\n',1,'','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(66,'2026-01-20 04:12:57','Laboratorium Kimia Klinik','Sample Cup','BHP\r\n\r\nKemasan : 1000 pcs/pk\r\nMerk : Biosystems\r\nAlat : A15',1,'','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(67,'2026-01-20 04:13:59','Laboratorium Kimia Klinik','Cholesterol','Reagen\r\n\r\nKemasan : 1 x 500 ml\r\nMerk : Biosystems\r\nAlat : BTS-350',1,'','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(68,'2026-01-20 04:14:50','Laboratorium Kimia Klinik','Uric Acid','Reagen\r\n\r\nKemasan : 1 x 500 ml\r\nMerk : Biosystems\r\nAlat : BTS-350',1,'','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(69,'2026-01-20 04:15:27','Laboratorium Kimia Klinik','Creatinine','Reagen\r\n\r\nKemasan : 4 x 50 ml\r\nMerk : Biosystems\r\nAlat : BTS-350',1,'','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(70,'2026-01-20 04:16:00','Laboratorium Kimia Klinik','AST/GOT','Reagen\r\n\r\nKemasan : 1 x 500 ml\r\nMerk : Biosystems\r\nAlat : BTS-350',1,'','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(71,'2026-01-20 04:16:39','Laboratorium Kimia Klinik','Protein Total','Reagen\r\n\r\nKemasan : 2 x 250 ml\r\nMerk : Biosystems\r\nAlat : BTS-350',1,'','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(72,'2026-01-20 04:17:11','Laboratorium Kimia Klinik','Alkaline Phosphatase','Reagen\r\n\r\nKemasan : 1 x 200 ml\r\nMerk : Biosystems\r\nAlat : BTS-350',1,'Kit','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(75,'2026-02-27 02:27:55','Laboratorium Kimia Klinik','Sample cup','Isi 1000 pcs\r\nMerk Biosystems',1,'Pack','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(76,'2026-02-27 02:29:10','Laboratorium Kimia Klinik','Bilirubin Total','Kemasan 5 x 50 ml\r\nMerk Biosystems',1,'Kit','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(77,'2026-02-27 02:30:45','Laboratorium Kimia Klinik','Triglycerides','Reagen\r\nKemasan 10 x 50 ml\r\nMerk Biosystems\r\nAlat A15',1,'Kit','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(78,'2026-02-27 02:31:49','Laboratorium Kimia Klinik','Uric Acid','Reagen\r\nKemasan : 10 x 50 ml\r\nMerk : Biosystems\r\nAlat : A15',1,'Kit','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(79,'2026-02-27 02:32:34','Laboratorium Kimia Klinik','Cholesterol HDL','Reagen\r\nKemasan : 4 x 20 ml\r\nMerk Biosystems\r\nAlat A15',2,'Kit','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(80,'2026-02-27 02:33:18','Laboratorium Kimia Klinik','Urea','Reagen\r\nKemasan : 5 x 50 ml\r\nMerk : Biosystems\r\nAlat A15',1,'Kit','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(81,'2026-02-27 02:34:11','Laboratorium Kimia Klinik','Protein Total','Reagen\r\nKemasan : 2 x 250 ml\r\nMerk Biosystems\r\nAlat BTS-350',1,'Kit','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(82,'2026-02-27 02:34:55','Laboratorium Kimia Klinik','Alkaline Phosphatase','Reagen\r\nKemasan : 1 x 200 ml\r\nMerk Biosystems\r\nAlat BTS-350',1,'Kit','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(83,'2026-02-27 02:35:41','Laboratorium Kimia Klinik','Creatinine Kinase (CK)','Reagen\r\nKemasan 1 x 50 ml\r\nMerk Biosystems\r\nAlat BTS-350',1,'Kit','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(84,'2026-02-27 02:36:31','Laboratorium Kimia Klinik','Gamma - GT','Reagen\r\nKemasan : 1 x 200 ml\r\nMerk : Biosystems\r\nAlat : BTS 350',1,'Kit','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(85,'2026-04-14 02:20:16','Laboratorium Kimia Klinik','Bayclin','Kebersihan',2,'botol','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(86,'2026-04-14 02:20:46','Laboratorium Kimia Klinik','Kain Lap','Kebersihan',2,'pcs','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(87,'2026-04-14 02:21:20','Laboratorium Kimia Klinik','Handwash refill','Kebersihan',2,'pcs','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(88,'2026-04-14 02:23:00','Laboratorium Kimia Klinik','Tisu','merk See-U',10,'roll','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(89,'2026-04-14 02:23:40','Laboratorium Kimia Klinik','Sarung tangan Nitrile black size S','Merk Onemed',3,'box','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(90,'2026-04-14 02:24:45','Laboratorium Kimia Klinik','Sarung tangan Nitrile size M','-',1,'box','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(91,'2026-04-14 02:25:57','Laboratorium Kimia Klinik','Blue tip','merk Monotes',2,'pack','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(92,'2026-04-14 02:26:36','Laboratorium Kimia Klinik','Yellow tip','merk Nesco',2,'pack','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(93,'2026-04-14 02:27:11','Laboratorium Kimia Klinik','Masker earloop','-',1,'box','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(94,'2026-04-14 02:27:39','Laboratorium Kimia Klinik','Masker hijab','merk Baymed',2,'box','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(95,'2026-04-14 02:28:23','Laboratorium Kimia Klinik','Kantong plastik limbah medis','size 40 x 60 cm',3,'pak','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(96,'2026-04-14 02:29:17','Laboratorium Kimia Klinik','Alkohol 70%','-',1,'botol','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(97,'2026-04-14 02:30:12','Laboratorium Kimia Klinik','Hand Sanitizer','merk Uline',2,'pcs','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(98,'2026-04-14 02:31:01','Laboratorium Kimia Klinik','Jerigen putih','Kemasan 10 liter',2,'pcs','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(99,'2026-04-14 02:31:39','Laboratorium Kimia Klinik','Plastik klip','size 10 x 15 cm',3,'pcs','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(100,'2026-04-14 02:32:37','Laboratorium Kimia Klinik','Spidol permanen','merk Snowman',5,'pcs','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(101,'2026-04-14 02:33:25','Laboratorium Kimia Klinik','Baterai remote AC','merk ABC',3,'pcs','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(102,'2026-04-14 02:34:08','Laboratorium Kimia Klinik','Isi staples kecil No.10','merk Joyko',3,'pcs','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(103,'2026-04-14 02:34:50','Laboratorium Kimia Klinik','Cartridge warna Canon IP2770','merk Canon',1,'pcs','Fitri','Diajukan',NULL,NULL,NULL,NULL,NULL),(105,'2026-07-31 14:08:19','Laboratorium Mikrobiologi Kesehatan Masyarakat','Ridho','Ridho',1000,'Pcs','Ridho coba','Disetujui',NULL,NULL,'Pimpinan Labkes','2026-07-31 14:08:27',NULL),(108,'2026-07-31 15:03:06','Laboratorium Kalibrasi','rr','rr',10,'pcs','rr','Disetujui',NULL,NULL,'Pimpinan Labkes','2026-07-31 15:31:56',NULL);
/*!40000 ALTER TABLE `sib_pengajuan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sib_sbbk`
--

DROP TABLE IF EXISTS `sib_sbbk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sib_sbbk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `no_sbbk` varchar(100) NOT NULL,
  `laboratorium` varchar(100) NOT NULL,
  `serah` varchar(100) NOT NULL,
  `penerima` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sib_sbbk`
--

LOCK TABLES `sib_sbbk` WRITE;
/*!40000 ALTER TABLE `sib_sbbk` DISABLE KEYS */;
INSERT INTO `sib_sbbk` VALUES (22,'2026-01-28','001/SBBK/UPTLABKESKAL/I/2026','Laboratorium Mikrobiologi Klinik','M. Jamaudin Ridho, A.Md.T','Eka'),(25,'2026-02-18','002/SBBK/UPTLABKESKAL/II/2026','Laboratorium Mikrobiologi Klinik','M. Jamaudin Ridho, A.Md.T','Eka'),(26,'2026-01-06','003/SBBK/UPTLABKESKAL/I/2026','Laboratorium Kimia Klinik','Dika Apriyanthy, A.Md. Kep','Fitri Handayani'),(27,'2026-01-15','004/SBBK/UPTLABKESKAL/I/2026','Laboratorium Mikrobiologi Kesehatan Masyarakat','Dika Apriyanthy, A.Md. Kep','Marwati'),(28,'2026-01-19','005/SBBK/UPTLABKESKAL/I/2026','Laboratorium Kimia Kesehatan dan Toksikologi','M. Jamaudin Ridho, A.Md.T','Maria Regina'),(29,'2026-01-28','006/SBBK/UPTLABKESKAL/I/2026','Laboratorium Kimia Klinik','Dika Apriyanthy, A.Md. Kep','Fitri Handayani'),(30,'2026-02-12','007/SBBK/UPTLABKESKAL/II/2026','Laboratorium Hematologi Klinik','Dika Apriyanthy, A.Md. Kep','Ismawati'),(31,'2026-02-18','008/SBBK/UPTLABKESKAL/II/2026','Laboratorium Hematologi Klinik','Dika Apriyanthy, A.Md. Kep','Ismawati'),(32,'2026-02-23','009/SBBK/UPTLABKESKAL/II/2026','Laboratorium Hematologi Klinik','Dika Apriyanthy, A.Md. Kep','Mesrawani Silalahi'),(33,'2026-02-24','010/SBBK/UPTLABKESKAL/II/2026','Laboratorium Mikrobiologi Kesehatan Masyarakat','Dika Apriyanthy, A.Md. Kep','Artsoneta Vivaneli'),(34,'2026-02-25','011/SBBK/UPTLABKESKAL/II/2026','Laboratorium Hematologi Klinik','Dika Apriyanthy, A.Md. Kep','Ismawati'),(35,'2026-02-25','012/SBBK/UPTLABKESKAL/II/2026','Laboratorium Mikrobiologi Kesehatan Masyarakat','Dika Apriyanthy, A.Md. Kep','Marwati'),(36,'2026-03-02','013/SBBK/UPTLABKESKAL/III/2026','Laboratorium Kimia Klinik','Dika Apriyanthy, A.Md. Kep','Fitri Handayani'),(37,'2026-03-02','014/SBBK/UPTLABKESKAL/III/2026','Laboratorium Mikrobiologi Kesehatan Masyarakat','Dika Apriyanthy, A.Md. Kep','Artsoneta Vivaneli'),(38,'2026-03-05','015/SBBK/UPTLABKESKAL/III/2026','Laboratorium Mikrobiologi Kesehatan Masyarakat','Dika Apriyanthy, A.Md. Kep','Artsoneta Vivaneli'),(39,'2026-03-05','016/SBBK/UPTLABKESKAL/III/2026','Laboratorium Mikrobiologi Kesehatan Masyarakat','Dika Apriyanthy, A.Md. Kep','Artsoneta Vivaneli'),(40,'2026-03-05','017/SBBK/UPTLABKESKAL/III/2026','Laboratorium Kimia Kesehatan dan Toksikologi','Dika Apriyanthy, A.Md. Kep','Maria Regina'),(41,'2026-03-09','018/SBBK/UPTLABKESKAL/III/2026','Laboratorium Mikrobiologi Kesehatan Masyarakat','Dika Apriyanthy, A.Md. Kep','Artsoneta Vivaneli, S. Si'),(42,'2026-03-09','019/SBBK/UPTLABKESKAL/III/2026','Laboratorium Mikrobiologi Kesehatan Masyarakat','Dika Apriyanthy, A.Md. Kep','Artsoneta Vivaneli, S. Si'),(43,'2026-03-12','020/SBBK/UPTLABKESKAL/III/2026','Laboratorium Mikrobiologi Kesehatan Masyarakat','Dika Apriyanthy, A.Md. Kep','Kiki Novita'),(44,'2026-03-25','021/SBBK/UPTLABKESKAL/III/2026','Laboratorium Mikrobiologi Kesehatan Masyarakat','Dika Apriyanthy, A.Md. Kep','Artsoneta Vivaneli, S. Si'),(45,'2026-03-31','022/SBBK/UPTLABKESKAL/III/2026','Laboratorium Kimia Klinik','Dika Apriyanthy, A.Md. Kep','Fitri Handayani'),(46,'2026-04-07','023/SBBK/UPTLABKESKAL/IV/2026','Laboratorium Kimia Kesehatan dan Toksikologi','Dika Apriyanthy, A.Md. Kep','Maria Regina'),(47,'2026-04-07','024/SBBK/UPTLABKESKAL/IV/2026','Laboratorium Kimia Klinik','Dika Apriyanthy, A.Md. Kep','Fitri Handayani'),(48,'2026-04-07','025/SBBK/UPTLABKESKAL/IV/2026','Laboratorium Hematologi Klinik','Dika Apriyanthy, A.Md. Kep','Mesrawani Silalahi'),(49,'2026-04-13','026/SBBK/UPTLABKESKAL/IV/2026','Laboratorium Kimia Kesehatan dan Toksikologi','Dika Apriyanthy, A.Md. Kep','Maria Regina'),(50,'2026-04-16','027/SBBK/UPTLABKESKAL/IV/2026','Laboratorium Kimia Kesehatan dan Toksikologi','Dika Apriyanthy, A.Md. Kep','Maria Regina'),(54,'2026-07-31','028/SBBK/UPTLABKESKAL/VII/2026','Laboratorium Kalibrasi','Dika Apriyanthy, A.Md. Kep','rr');
/*!40000 ALTER TABLE `sib_sbbk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sib_sbbk_detail`
--

DROP TABLE IF EXISTS `sib_sbbk_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sib_sbbk_detail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_sbbk` int NOT NULL,
  `id_bhp` int NOT NULL,
  `nama_bhp` varchar(100) NOT NULL,
  `terima` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sib_sbbk_detail`
--

LOCK TABLES `sib_sbbk_detail` WRITE;
/*!40000 ALTER TABLE `sib_sbbk_detail` DISABLE KEYS */;
INSERT INTO `sib_sbbk_detail` VALUES (18,22,5,'HIV I & II Card Test 40 T',NULL),(19,22,6,'HIV 1, 2 Rapid Test Cassette',NULL),(20,22,7,'Salmonella Paratyphil AH',NULL),(21,22,8,'Salmonella Typhi O',NULL),(29,25,11,'HBsAg Strip ',NULL),(30,25,12,'HBsAg Strip ',NULL),(32,26,22,'Glokose',NULL),(33,26,23,'AST/ GOT',NULL),(34,26,24,'Cholesterol HDL Direct',NULL),(35,26,25,'Cholesterol LDL Direct',NULL),(36,26,26,'Bilirubin Direct',NULL),(37,26,27,'Cholesterol',NULL),(38,26,28,'Cholesterol HDL/LDL Calibrator',NULL),(39,27,29,'Microfil Funnel With S-Pak Membrane Filter',NULL),(40,27,30,'Extran MA 02 Neutral ',NULL),(42,28,31,'Gas Acetylene',NULL),(43,29,32,'ALT/ GPT',NULL),(44,29,33,'Creatinine',NULL),(45,29,34,'Triglycerides',NULL),(46,29,35,'AST/ GOT',NULL),(47,29,36,'Biochemistery Calibrator',NULL),(48,29,37,'Cholesterol',NULL),(49,29,38,'Uric Acid',NULL),(50,30,39,'Control B30 Normal Hematologi',NULL),(51,30,40,'Methamphetamine Strip',NULL),(52,30,41,'Amphetamine Strip',NULL),(53,30,42,'Multi Drug 7 Panel',NULL),(54,30,43,'Multi Drug 7 Panel',NULL),(57,31,44,'Multi Drug 7 Panel',NULL),(58,32,45,'Benzodiazepine Strip',NULL),(59,32,46,'THC Strip',NULL),(60,32,47,'Diluent M-30D',NULL),(61,33,48,'Plate Count Agar',NULL),(62,34,49,'Multi Drug 7 Panel',NULL),(63,35,50,'XLD Agar Xylose Lysine Desoxycholate',NULL),(64,35,51,'M-Endo Agar Les For Micribiology',NULL),(65,35,52,'Lactose Broth',NULL),(66,35,53,'Tryptic Soy Broth',NULL),(67,35,54,'GranuCult Prime L-EMB Agar',NULL),(70,36,13,'Sampel Cup',NULL),(71,36,14,'Triglycerides',NULL),(72,36,15,'Uric Acid',NULL),(73,36,16,'Cholesterol HDL Direct',NULL),(74,36,17,'Urea/ BUN',NULL),(75,36,18,'Cholesterol HDL/LDL Calibrator',NULL),(77,37,19,'Egg Yolk Tel Emulsion',NULL),(78,38,55,'H2O2 3%',NULL),(79,38,56,'Gram Hucker Set',NULL),(81,39,57,'Alkaline Saline Peptone Water',NULL),(82,39,58,'Bacillus Cereus Selective Agar Base',NULL),(83,39,59,'Methyl Red Indikator',NULL),(84,39,61,'Malachite Green',NULL),(88,40,60,'1,5 Diphenylcarbazide',NULL),(89,41,62,'Oxydase For The Detection',NULL),(90,41,63,'Azide Dextrose Broth',NULL),(92,42,64,'Extran MA 02',NULL),(93,43,65,'TCBS Cholera Medium',NULL),(94,43,66,'Lauryl Tryptose Broth',NULL),(95,43,67,'Bacillus Cereus ATCC',NULL),(96,44,68,'Barritt Reagen A For Voges-Proskauer A Test',NULL),(97,45,69,'HbA1C Direct',NULL),(98,45,70,'HbA1C Direct Standards',NULL),(100,46,71,'Surfactants (anionic) CT 25 Test',NULL),(101,47,72,'Billirubin Total',NULL),(102,48,73,'Liq Control Urine Chemistry LV. 1',NULL),(103,48,74,'Liq Control Urine Chemistry LV. 2',NULL),(105,49,75,'Gas Acetylene',NULL),(106,50,76,'Potassium Peroxodisulfate For Analysis',NULL),(107,50,77,'CRM Hexavalent Chromium Potable Watr',NULL),(108,50,78,'CRM Nitrite',NULL),(111,54,80,'Ridho',NULL);
/*!40000 ALTER TABLE `sib_sbbk_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sib_users`
--

DROP TABLE IF EXISTS `sib_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sib_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sib_users`
--

LOCK TABLES `sib_users` WRITE;
/*!40000 ALTER TABLE `sib_users` DISABLE KEYS */;
INSERT INTO `sib_users` VALUES (1,'Agus, S.Si., M.Si., M.MKes','agus@bahalab','Berkah@2026'),(2,'Ismawati, S.Tr.AK','ismawati@bahalab','Berkah@2026'),(3,'Dika Apriyanthy, A.Md.Kep','dika@bahalab','Berkah@2026'),(4,'Fitri Handayani, Amd.AK','fitri@bahalab','Berkah@2026'),(5,'Yuliati, A.Md. AK','yuliati@bahalab\n','Berkah@2026'),(6,'Dina Wahyuni,S.Si, M.Si','dina@bahalab','Berkah@2026'),(7,'Artsoneta Vivaneli, S. Si','artsoneta@bahalab','Berkah@2026'),(8,'dr. Lestari, Sp.PK','lestari@bahalab','Berkah@2026'),(9,'M. Jamaludin Ridho, A.Md.T','admin@bahalab','$2y$10$Lkhw0HaRWlm3qlmuXbghtey3YKfuRn4qUirsmOwPCVAoRO9BdvriS'),(10,'Muhammad Rustam Effendy, S. Kep., M.A.P.','rustam@bahalab','Berkah@2026'),(11,'Elviana Satriani Suardie, A.Md.Kep','elviana@bahalab','Berkah@2026'),(12,'Eko Hafiz Rianto, S.Si, M.KL','ekohafiz@bahalab','Berkah@2026'),(13,'Boyke Purnomo, S.ST','boyke@bahalab','Berkah@2026'),(14,'dr. Imelda Wulandari','drimel@bahalab','Berkah@2026'),(15,'dr. Valencia Wilentine','valencia@bahalab','Berkah@2026'),(16,'Fransiska R.,SKM','siska@bahalab','Berkah@2026'),(17,'Ellin Korilina, S.Kep., Ns','ellin@bahalab','Berkah@2026'),(18,'Heksano Rendian, A.Md. Kep','heksano.r@bahalab','Berkah@2026'),(19,'Noorjannah. B, A.Md.AK','noorjanah.b@bahalab','Berkah@2026'),(20,'Emae Diarilia Hawun, A.Md','emaediarilia.h@bahalab','Berkah@2026'),(21,'Thya Agustina Nugraha, S. Kep','tya@bahalab','Berkah@2026'),(22,'Afrianady, SKM','afrianady@bahalab','Berkah@2026'),(23,'Duadi Retolf Tingang, S.Kom','duadi@bahalab','Berkah@2026'),(24,'Evie,A.Md.AK','evie@bahalab','Berkah@2026'),(25,'Mesrawani Silalahi, A.Md.AK','mesrawani.s@bahalab','Berkah@2026'),(26,'M Khoirul Anam, A.Md.Ak','m.khoirul@bahalab','Berkah@2026'),(27,'Eka Fittera Astuty,S.Tr.Kes','eka.f@bahalab','Berkah@2026'),(28,'Marwati, Amd, AK','marwati@bahalab','Berkah@2026'),(29,'Kiki novita, S.Tr.Kes','kiki.n@bahalab','Berkah@2026'),(30,'Siswanto Simpei, A. Md. AK','siswanto.s@bahalab','Berkah@2026'),(31,'Diniati finda Sasani, A.Md ','diniati.fs@bahalab','Berkah@2026'),(32,'Andi Budi Kusumayadi, A.Md','andi.bk@bahalab','Berkah@2026'),(33,'Jayalena Simarmata, A.Md','jayalena.s@bahalab','Berkah@2026'),(34,'Maria Regina Dwi Astuti, S. Si','regina@bahalab','Berkah@2026'),(35,'Afni Larasati Dyah Kusheryaningtyas, ST','afnilarasati@bahalab','Berkah@2026'),(36,'Nurul Hidayah, A.Md','nurul.h@bahalab','Berkah@2026'),(37,'Dian Reysalia N, S. T','dian.rn@bahalab','Berkah@2026'),(38,'Martina Nadapdap, S.Si., M.Si','martina.n@bahalab','Berkah@2026'),(39,'Wina Fitria Neovita, A.Md., Farm','wina.fn@bahalab','Berkah@2026'),(40,'Bahrian, A.Md.A.K. ','bahrian@bahalab','Berkah@2026'),(41,'Puteri Aysa, A.Md.Keb','puteri@bahalab','Berkah@2026'),(42,'Nor Afifah Riana, A.Md.A.K. ','afifah@bahalab','Berkah@2026'),(43,'Rudi Wellidiarto, S.H.','rudi@bahalab','Berkah@2026'),(44,'Hua Lelu, S.E','hua@bahalab','Berkah@2026'),(45,'Linde','linde@bahalab','Berkah@2026'),(46,'Didianto','didi@bahalab','Berkah@2026'),(47,'Sari Kemantang','sari@bahalab','Berkah@2026'),(48,'Riang','riang@bahalab','Berkah@2026'),(49,'Pimpinan Labkes','admin1@bahalab','$2y$10$jg1Npwb5ASOE55Kero6vA.JoWPkVNalxQ8sqFh5NMt0BgZXnoOUEu');
/*!40000 ALTER TABLE `sib_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'bahalab'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-08-04 15:40:29
