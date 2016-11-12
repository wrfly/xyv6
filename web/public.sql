-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: ss
-- ------------------------------------------------------
-- Server version	5.5.47-0ubuntu0.14.04.1-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `invite_code`
--

DROP TABLE IF EXISTS `invite_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invite_code` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `code` varchar(128) NOT NULL,
  `user` int(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6389 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invite_code`
--

LOCK TABLES `invite_code` WRITE;
/*!40000 ALTER TABLE `invite_code` DISABLE KEYS */;
/*!40000 ALTER TABLE `invite_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notify`
--

DROP TABLE IF EXISTS `notify`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notify` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(32) NOT NULL,
  `trade_no` bigint(20) NOT NULL,
  `gmt_create` datetime NOT NULL,
  `gmt_payment` datetime NOT NULL,
  `notify_time` datetime NOT NULL,
  `notify_type` varchar(32) NOT NULL,
  `total_amount` float NOT NULL,
  `out_trade_no` varchar(32) NOT NULL,
  `invoice_amount` float NOT NULL,
  `receipt_amount` float NOT NULL,
  `buyer_pay_amount` float NOT NULL,
  `body` varchar(32) NOT NULL,
  `trade_status` varchar(32) NOT NULL,
  `seller_email` varchar(32) NOT NULL,
  `buyer_logon_id` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=238 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notify`
--

LOCK TABLES `notify` WRITE;
/*!40000 ALTER TABLE `notify` DISABLE KEYS */;
/*!40000 ALTER TABLE `notify` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offline_download`
--

DROP TABLE IF EXISTS `offline_download`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offline_download` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `file_size` int(20) NOT NULL,
  `file_format` varchar(64) NOT NULL,
  `file_url` text NOT NULL,
  `down_link` varchar(128) NOT NULL,
  `start_time` int(11) NOT NULL,
  `finish_time` int(11) NOT NULL,
  `percentage` int(4) NOT NULL,
  `ave_speed` varchar(64) NOT NULL,
  `is_start` int(1) NOT NULL,
  `is_finish` int(1) NOT NULL,
  `exist` int(1) NOT NULL,
  `add_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offline_download`
--

LOCK TABLES `offline_download` WRITE;
/*!40000 ALTER TABLE `offline_download` DISABLE KEYS */;
/*!40000 ALTER TABLE `offline_download` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `port_pool`
--

DROP TABLE IF EXISTS `port_pool`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `port_pool` (
  `port` int(11) NOT NULL,
  `used` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `port_pool`
--

LOCK TABLES `port_pool` WRITE;
/*!40000 ALTER TABLE `port_pool` DISABLE KEYS */;
/*!40000 ALTER TABLE `port_pool` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pre_create`
--

DROP TABLE IF EXISTS `pre_create`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pre_create` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `out_trade_no` varchar(32) NOT NULL,
  `total_amount` float NOT NULL,
  `subject` varchar(32) NOT NULL,
  `plan` char(2) NOT NULL,
  `month` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `time_create` datetime NOT NULL,
  `success` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pre_create`
--

LOCK TABLES `pre_create` WRITE;
/*!40000 ALTER TABLE `pre_create` DISABLE KEYS */;
/*!40000 ALTER TABLE `pre_create` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_link`
--

DROP TABLE IF EXISTS `ref_link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_link` (
  `uid` int(11) NOT NULL,
  `link_code` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_link`
--

LOCK TABLES `ref_link` WRITE;
/*!40000 ALTER TABLE `ref_link` DISABLE KEYS */;
/*!40000 ALTER TABLE `ref_link` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ss_node`
--

DROP TABLE IF EXISTS `ss_node`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ss_node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `node_name` varchar(128) NOT NULL,
  `node_type` int(3) NOT NULL,
  `node_server` varchar(128) NOT NULL,
  `node_method` varchar(64) NOT NULL,
  `node_info` varchar(128) NOT NULL DEFAULT '正常',
  `node_status` varchar(128) NOT NULL,
  `node_order` int(3) NOT NULL,
  `node_speed` varchar(64) NOT NULL DEFAULT '0 KB/s',
  `node_free_space` bigint(20) NOT NULL DEFAULT '0',
  `node_ipv4` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ss_node`
--

LOCK TABLES `ss_node` WRITE;
/*!40000 ALTER TABLE `ss_node` DISABLE KEYS */;
/*!40000 ALTER TABLE `ss_node` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ss_reset_pwd`
--

DROP TABLE IF EXISTS `ss_reset_pwd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ss_reset_pwd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `init_time` int(11) NOT NULL,
  `expire_time` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `uni_char` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=726 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ss_reset_pwd`
--

LOCK TABLES `ss_reset_pwd` WRITE;
/*!40000 ALTER TABLE `ss_reset_pwd` DISABLE KEYS */;
/*!40000 ALTER TABLE `ss_reset_pwd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ss_user_admin`
--

DROP TABLE IF EXISTS `ss_user_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ss_user_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ss_user_admin`
--

LOCK TABLES `ss_user_admin` WRITE;
/*!40000 ALTER TABLE `ss_user_admin` DISABLE KEYS */;
INSERT INTO `ss_user_admin` VALUES (1,1);
/*!40000 ALTER TABLE `ss_user_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(128) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(32) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `passwd` varchar(16) NOT NULL,
  `t` int(11) NOT NULL DEFAULT '0',
  `u` bigint(20) NOT NULL,
  `d` bigint(20) NOT NULL,
  `plan` varchar(2) CHARACTER SET utf8mb4 NOT NULL,
  `transfer_enable` bigint(20) NOT NULL,
  `port` int(11) NOT NULL,
  `switch` tinyint(4) NOT NULL DEFAULT '1',
  `enable` tinyint(4) NOT NULL DEFAULT '1',
  `type` tinyint(4) NOT NULL DEFAULT '1',
  `last_get_gift_time` int(11) NOT NULL DEFAULT '0',
  `last_check_in_time` int(11) NOT NULL DEFAULT '0',
  `last_rest_pass_time` int(11) NOT NULL DEFAULT '0',
  `reg_date` datetime NOT NULL,
  `invite_num` int(8) NOT NULL,
  `money` decimal(12,2) NOT NULL,
  `ref_by` int(11) NOT NULL DEFAULT '0',
  `vip_start_time` int(11) NOT NULL DEFAULT '0',
  `vip_end_time` int(11) NOT NULL DEFAULT '0',
  `w_n` int(8) NOT NULL DEFAULT '0',
  `valid` tinyint(4) NOT NULL DEFAULT '1',
  `ovpn` tinyint(4) NOT NULL DEFAULT '0',
  `ovpn_start` int(11) NOT NULL DEFAULT '0',
  `ovpn_end` int(11) NOT NULL DEFAULT '0',
  `vip_month` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=4673 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-11 13:17:01
