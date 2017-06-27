-- MySQL dump 10.13  Distrib 5.5.24, for Win64 (x86)
--
-- Host: localhost    Database: testshop
-- ------------------------------------------------------
-- Server version	5.5.24-log

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
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `linkman` varchar(50) DEFAULT NULL,
  `code` int(11) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
INSERT INTO `address` VALUES (1,'张娜',421302,2147483647,'湖北随州',22,0),(2,'张阳',100000,2147483647,'河南郑州',26,0),(3,'张娜',100000,2147483647,'湖北随州',28,1),(4,'2',3333,222,'222',28,0),(5,'张娜',100000,2147483647,'湖北随州',29,0);
/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `pid` int(11) unsigned DEFAULT '0',
  `path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (37,'衣服',0,'0,'),(38,'鞋子',0,'0,'),(39,'包包',0,'0,'),(40,'家居',0,'0,'),(41,'配饰',0,'0,'),(42,'美妆',0,'0,'),(43,'风衣',37,'0,37,'),(44,'短袖',37,'0,37,'),(45,'衬衫',37,'0,37,'),(46,'裙子',37,'0,37,'),(47,'短靴',38,'0,38,'),(48,'雪地靴',38,'0,38,'),(49,'运动',38,'0,38,'),(50,'双肩',39,'0,39,'),(51,'单肩',39,'0,39,'),(52,'斜挎',39,'0,39,'),(53,'手表',41,'0,41,'),(54,'配件',41,'0,41,'),(55,'墨镜',41,'0,41,'),(56,'围巾',41,'0,41,'),(57,'抱枕',40,'0,40,'),(58,'四件套',40,'0,40,'),(59,'毛毯',40,'0,40,');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `collects`
--

DROP TABLE IF EXISTS `collects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `collects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `collects`
--

LOCK TABLES `collects` WRITE;
/*!40000 ALTER TABLE `collects` DISABLE KEYS */;
INSERT INTO `collects` VALUES (1,22,6),(2,22,9),(6,22,1),(5,22,10),(7,22,3),(8,22,8),(9,22,17),(10,22,27),(11,26,2),(12,28,1),(13,0,1),(14,0,41),(15,0,3),(16,0,3),(17,0,3),(22,28,31),(20,29,2),(21,29,42),(25,28,22);
/*!40000 ALTER TABLE `collects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `addtime` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (9,22,'<p>发顺丰<br/></p>',3,1447588386,1),(8,22,'<p>店主很好还送了赠品<br/></p>',21,1447587458,1),(6,22,'<p>打豆豆<br/></p>',5,1447576586,0),(7,22,'该包质量很好，可以购买而且价格还便宜',29,1447587340,1),(10,26,'<p>衣服质量很好 可以买哦<br/></p>',6,1447640576,1),(11,26,'<p>非常好，值得你买<br/></p>',43,1447642350,1),(12,28,'<p>很好卡的<br/></p>',6,1447645567,1),(13,28,'<p>很好看的订单<br/></p>',26,1447645898,1),(14,29,'<p>很好的<br/></p>',23,1447651942,1),(15,28,'<p>打豆豆<br/></p>',26,1447658316,1),(16,28,'<p>规范<br/></p>',34,1447658405,1),(17,28,'<p>的地方法规<br/></p>',6,1447663526,1),(18,28,'<p>美女，<br/></p>',26,1447664525,1);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link`
--

DROP TABLE IF EXISTS `link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `descr` varchar(255) DEFAULT NULL,
  `http` varchar(255) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `addtime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `link`
--

LOCK TABLES `link` WRITE;
/*!40000 ALTER TABLE `link` DISABLE KEYS */;
INSERT INTO `link` VALUES (1,'淘宝网','<p>这是淘宝的链接<br/></p>','http://www.taobao.com',1,1447602780),(2,'京东','<p>这是京东的链接<br/></p>','http://www.jD.com',1,1447604011),(3,'唯品会','<p>这是唯品会的链接<br/></p>','http://www.weipinghui.com',1,1447604023),(4,'美丽购','<p>这是美丽购的链接<br/></p>','http://meiligo.com',1,1447604098),(6,'聚美','<p>这是聚美的链接<br/></p>','http://www.jumei.com',1,1447604238);
/*!40000 ALTER TABLE `link` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lunbo`
--

DROP TABLE IF EXISTS `lunbo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lunbo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img1` varchar(254) NOT NULL,
  `img2` varchar(254) NOT NULL,
  `img3` varchar(254) NOT NULL,
  `img4` varchar(254) NOT NULL,
  `adname1` varchar(200) DEFAULT NULL,
  `adname2` varchar(200) DEFAULT NULL,
  `adname3` varchar(200) DEFAULT NULL,
  `adname4` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lunbo`
--

LOCK TABLES `lunbo` WRITE;
/*!40000 ALTER TABLE `lunbo` DISABLE KEYS */;
INSERT INTO `lunbo` VALUES (1,'201511141723598374.jpg','201511141723591202.jpg','201511141725322110.jpg','201511141736354287.jpg','经典好货俘虏你的心','凹造型美包 任性不躲手照着买就对了','多来A梦伴我行 限量发售','明星访谈各种娱乐');
/*!40000 ALTER TABLE `lunbo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderdetail`
--

DROP TABLE IF EXISTS `orderdetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderdetail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `orderid` int(11) unsigned DEFAULT NULL,
  `pid` int(11) unsigned DEFAULT NULL,
  `pname` varchar(32) DEFAULT NULL,
  `price` double(6,2) DEFAULT NULL,
  `buynum` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderdetail`
--

LOCK TABLES `orderdetail` WRITE;
/*!40000 ALTER TABLE `orderdetail` DISABLE KEYS */;
INSERT INTO `orderdetail` VALUES (55,1000005,6,'夏新款韩版翻领蝙蝠袖衬衫',22.00,50),(56,1000006,41,'2015秋新款韩版女装翻领抽绳收腰长袖百搭风衣外套',0.00,2),(57,1000006,40,'2015秋新款韩版女装翻领抽绳收腰长袖百搭风衣外套',100.00,1),(58,1000007,29,'买一得三▲韩版学院风小熊挂件双肩包',100.00,1),(63,1000013,22,'574经典款真皮夏威夷2代复古运动鞋 ',100.00,1),(60,1000010,21,'秋冬季新款 真皮气垫运动情侣鞋',100.00,2),(61,1000011,39,'2015秋新长袖百搭风衣外套',100.00,2),(62,1000012,3,'韩衣社 无袖下摆流苏背心T恤',49.00,1),(64,1000013,3,'韩衣社 无袖下摆流苏背心T恤',49.00,1),(65,1000014,6,'夏新款韩版翻领蝙蝠袖衬衫',22.00,1),(66,1000015,43,'2015秋冬新款韩版女装西装领卡通人物刺绣毛呢大衣外套',100.00,1),(67,1000016,6,'夏新款韩版翻领蝙蝠袖衬衫',22.00,1),(68,1000017,26,'【升级版】欧美小香风链条包',100.00,3),(69,1000018,3,'韩衣社 无袖下摆流苏背心T恤',49.00,50),(70,1000019,3,'韩衣社 无袖下摆流苏背心T恤',49.00,1),(71,1000020,23,'防水台尖头粗高跟及踝靴.  ',100.00,50),(72,1000021,34,'双11大促销美白补水套盒',102.00,1),(73,1000022,6,'夏新款韩版翻领蝙蝠袖衬衫',22.00,1);
/*!40000 ALTER TABLE `orderdetail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned DEFAULT NULL,
  `linkman` varchar(32) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `code` char(6) DEFAULT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `addtime` int(11) unsigned DEFAULT NULL,
  `total` double(8,2) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `remark` varchar(100) DEFAULT NULL,
  `isdel` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1000023 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1000005,22,'1','1','1','1',1447486472,880.00,6,'22',0),(1000006,22,'张阳','湖北随州','100000','18687556289',1447549659,80.00,3,'',1),(1000007,22,'张甜甜','湖北随州','100000','18744055563',1447549716,80.00,5,'请尽快发货',1),(1000008,22,'王五','王五','100000','222',1447549842,17.60,5,'222',0),(1000013,22,'张娜','湖北随州','421302','2147483647',1447639904,119.20,1,'',1),(1000010,22,'张阳','湖北随州国际汽配城','421302','15172764834',1447549977,160.00,5,'请尽快发货',1),(1000011,22,'张阳','湖北随州国际汽配城1栋1101室','421302','18687556289',1447550141,160.00,1,'请尽快发货',1),(1000012,22,'符','飞飞飞','100000','444343',1447550654,39.20,1,'3434',1),(1000014,26,'张阳','河南郑州','100000','2147483647',1447640541,17.60,5,'尽快发货',1),(1000015,26,'张阳','河南郑州','100000','2147483647',1447642289,80.00,5,'',1),(1000016,28,'张娜','湖北随州','100000','2147483647',1447645525,17.60,5,'',1),(1000017,28,'张娜','湖北随州','100000','2147483647',1447645850,240.00,5,'反反复复',1),(1000018,22,'张娜','湖北随州','421302','2147483647',1447646561,1960.00,5,'',1),(1000019,22,'张娜','湖北随州','421302','2147483647',1447646763,39.20,5,'',1),(1000020,29,'张娜','湖北随州','100000','2147483647',1447651890,4000.00,5,'fff',1),(1000021,28,'张娜','湖北随州','100000','2147483647',1447658376,81.60,5,'好',1),(1000022,28,'张娜','湖北随州','100000','2147483647',1447663501,17.60,5,'',1);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(11) unsigned DEFAULT NULL,
  `pname` varchar(32) DEFAULT NULL,
  `company` varchar(50) DEFAULT NULL,
  `describes` text,
  `price` double(6,2) DEFAULT NULL,
  `picname` varchar(255) DEFAULT NULL,
  `state` tinyint(1) DEFAULT '1',
  `store` int(11) unsigned DEFAULT '0',
  `num` int(11) unsigned DEFAULT '0',
  `clicknum` int(11) unsigned DEFAULT '0',
  `addtime` int(11) unsigned DEFAULT NULL,
  `count` float DEFAULT '0.8',
  `color` varchar(50) DEFAULT '白色,黑色',
  `size` varchar(50) DEFAULT 'S,M,L',
  `isdel` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,44,'韩版字母无袖T恤','韩味服饰','韩版字母无袖T恤',29.40,'201511110654003674.jpg',1,100,0,19,1447141438,0.8,'白色,黑色','S,M,L',1),(2,44,'jcoolstory羽毛宽松纯棉T恤','东东服饰','这是jcoolstory羽毛宽松纯棉T恤',49.00,'201511100813553475.jpg',1,100,0,26,1447143235,0.8,'白色,黑色','S,M,L',1),(3,44,'韩衣社 无袖下摆流苏背心T恤','韩东服饰','韩衣社 无袖下摆流苏背心T恤',49.00,'201511110654528768.jpg',4,49,51,110,1447154560,0.8,'白色,黑色','S,M,L',1),(6,44,'夏新款韩版翻领蝙蝠袖衬衫','韩东服饰','夏新款韩版翻领蝙蝠袖衬衫',22.00,'201511110656324697.jpg',1,46,54,46,1447155989,0.8,'白色,黑色','S,M,L',1),(7,44,'时髦露肩 性感一夏短袖','湖北大东公司','时髦露肩 性感一夏短袖',40.00,'201511110658148097.jpg',4,100,0,11,1447156026,0.8,'白色,黑色','S,M,L',1),(8,51,'米非亮片时尚单肩包','湖北大东','米非亮片时尚单肩包',128.00,'201511110836326173.jpg',1,100,0,2,1447227631,0.8,'白色,黑色','S,M,L',1),(9,50,'美少女战士samantha vega限量款黑猫双肩多用包','东东服饰','美少女战士samantha vega限量款黑猫双肩多用包',148.00,'201511110837099109.jpg',1,100,0,2,1447227726,0.8,'白色,黑色','S,M,L',1),(10,51,'大花朵朵欧美经典复古纯色百搭通勤大包','东东服饰','大花朵朵欧美经典复古纯色百搭通勤大包',62.00,'201511110837574474.jpg',4,100,0,34,1447227794,0.8,'白色,黑色','S,M,L',1),(11,53,'香港GUOU潮流时尚大牌韩版奢华手表','湖北大东公司','香港GUOU潮流时尚大牌韩版奢华手表',141.50,'201511110815143657.jpg',1,100,0,0,1447229714,0.8,'白色,黑色','S,M,L',1),(12,56,'秋冬新款angelababy同款仿羊绒围巾','湖北大东公司','秋冬新款angelababy同款仿羊绒围巾',23.99,'201511110817265395.jpg',1,100,0,0,1447229846,0.8,'白色,黑色','S,M,L',1),(13,56,'韩版情侣秋冬毛线围巾','东东服饰','韩版情侣秋冬毛线围巾',43.99,'201511110818308423.jpg',1,100,0,1,1447229910,0.8,'白色,黑色','S,M,L',1),(14,54,'原创公仔USB暖手鼠标垫','东东服饰','原创公仔USB暖手鼠标垫',100.00,'201511110818598721.jpg',1,100,0,0,1447229939,0.8,'白色,黑色','S,M,L',1),(15,54,'s925纯银主君的太阳','湖北大东','s925纯银主君的太阳',22.00,'201511110819476750.jpg',1,100,0,0,1447229987,0.8,'白色,黑色','S,M,L',1),(16,57,'萌物~可爱大号睡觉河马抱枕公仔','湖北大东公司','萌物~可爱大号睡觉河马抱枕公仔',12.00,'201511110822475556.jpg',1,100,0,0,1447230167,0.8,'白色,黑色','S,M,L',1),(17,57,'可爱经典熊猫枕头','东东服饰','可爱经典熊猫枕头',23.00,'201511110823461839.jpg',1,100,0,1,1447230226,0.8,'白色,黑色','S,M,L',1),(18,58,'小小LOVE 法莱绒时尚印花四件套','湖北大东公司','小小LOVE 法莱绒时尚印花四件套',100.00,'201511110824492616.jpg',1,100,0,4,1447230289,0.8,'白色,黑色','S,M,L',1),(19,58,'普尔家 加厚印花法莱','湖北大东公司','普尔家 加厚印花法莱',100.00,'201511110825255606.jpg',1,100,0,0,1447230325,0.8,'白色,黑色','S,M,L',1),(20,59,'法兰绒加厚素色纯色毛毯','湖北大东公司','法兰绒加厚素色纯色毛毯',100.00,'201511110826342958.jpg',1,100,0,1,1447230394,0.8,'白色,黑色','S,M,L',1),(21,49,'秋冬季新款 真皮气垫运动情侣鞋','东东服饰','秋冬季新款 真皮气垫运动情侣鞋',100.00,'201511110829129440.jpg',1,98,2,1,1447230552,0.8,'白色,黑色','S,M,L',1),(22,49,'574经典款真皮夏威夷2代复古运动鞋 ','湖北大东公司','￥119.00 10586 秋冬季明星款透气情侣运动鞋  秋冬季明星款透气情侣运动鞋 ￥133.00 4992 韩版潮新款neo跑步运动鞋  韩版潮新款neo跑步运动鞋 ￥150.00 2073 情侣款经典绿真皮运动鞋  情侣款经典绿真皮运动鞋 ￥71.00 10844 韩normancho街拍原宿气垫运动鞋  韩normancho街拍原宿气垫运动鞋 ￥79.00 17982 秋冬季新款 真皮气垫运动情侣跑鞋  秋冬季新款 真皮气垫运动情侣跑鞋 ￥100.80 21465 韩国休闲运动跑步鞋女  韩国休闲运动跑步鞋女 ￥103.50 3536 街头实拍574三原色情侣鞋  街头实拍574三原色情侣鞋 ￥115.00 2283 秋冬新款小清新运动鞋  秋冬新款小清新运动鞋 ￥55.00 15820 限量版跑鞋  限量版跑鞋 ￥133.00 23210 秋冬新款杨幂同款华夫运动鞋  秋冬新款杨幂同款华夫运动鞋 ￥139.00 10354 亚瑟土火山红情侣运动鞋  亚瑟土火山红情侣运动鞋 ￥129.00 18677 实拍N字574飞线女款运动跑鞋  实拍N字574飞线女款运动跑鞋 ￥121.00 2844 【浆果】欧美大牌情侣款运动鞋  【浆果】欧美大牌情侣款运动鞋 ￥88.90 26491 韩国超人气！荧光拼色运动鞋  韩国超人气！荧光拼色运动鞋 ￥79.90 7496 专柜品质迷彩韩版运动鞋  专柜品质迷彩韩版运动鞋 ￥142.00 6810 四季款！经典绿真皮运动鞋  四季款！经典绿真皮运动鞋 ￥131.00 32227 亚se士经典款运动鞋  亚se士经典款运动鞋 ￥114.00 2138 真皮秋冬款情侣运动鞋  真皮秋冬款情侣运动鞋 ￥108.00 213 真皮运动鞋  真皮运动鞋 ￥115.00 12185 隐形增高5.5cm高帮运动鞋  隐形增高5.5cm高帮运动鞋 ￥109.50 1240 红人同款拼色运动鞋  红人同款拼色运动鞋 ￥78.00 20088 真皮拼接内增高休闲高帮运动板鞋  真皮拼接内增高休闲高帮运动板鞋 ￥148.00 3200 专柜品质真皮贝壳头板鞋  专柜品质真皮贝壳头板鞋 ￥99.90 90',100.00,'201511110830193735.jpg',1,100,0,8,1447230619,0.8,'白色,黑色','S,M,L',1),(23,47,'防水台尖头粗高跟及踝靴.  ','东东服饰','防水台尖头粗高跟及踝靴.  ',100.00,'201511110832058945.jpg',1,50,50,6,1447230725,0.8,'白色,黑色','S,M,L',1),(24,47,'新秋款头层牛皮复古马丁靴','湖北大东公司','新秋款头层牛皮复古马丁靴',100.00,'201511110832552944.jpg',1,100,0,1,1447230775,0.8,'白色,黑色','S,M,L',1),(25,48,'冬季韩版磨砂真皮毛线口加厚雪地靴','东东服饰','冬季韩版磨砂真皮毛线口加厚雪地靴',100.00,'201511110834591696.jpg',1,100,0,1,1447230899,0.8,'白色,黑色','S,M,L',1),(26,51,'【升级版】欧美小香风链条包','湖北大东公司','【升级版】欧美小香风链条包',100.00,'201511110838475070.jpg',1,97,3,10,1447231127,0.8,'白色,黑色','S,M,L',1),(27,50,'【赠公主兔】韩版大气百搭链条双肩包','湖北大东公司','【赠公主兔】韩版大气百搭链条双肩包',100.00,'201511110840096505.jpg',1,100,0,3,1447231209,0.8,'白色,黑色','S,M,L',1),(28,50,'亚倪家/ 定制款 欧美走秀2015秋冬超可爱小熊双肩包','东东服饰','亚倪家/ 定制款 欧美走秀2015秋冬超可爱小熊双肩包',100.00,'201511110840579789.jpg',1,100,0,1,1447231257,0.8,'白色,黑色','S,M,L',1),(29,50,'买一得三▲韩版学院风小熊挂件双肩包','湖北大东公司','买一得三▲韩版学院风小熊挂件双肩包',100.00,'201511110846502985.jpg',1,99,1,3,1447231610,0.8,'白色,黑色','S,M,L',1),(30,52,'亚倪家/ 秋冬新款可爱兔毛猫咪链条包','湖北大东公司','亚倪家/ 秋冬新款可爱兔毛猫咪链条包',100.00,'201511110847266357.jpg',1,100,0,6,1447231646,0.8,'白色,黑色','S,M,L',1),(31,51,'亚倪家/韩系可爱风小羊皮单肩包包','湖北大东公司','亚倪家/韩系可爱风小羊皮单肩包包',100.00,'201511110848027575.jpg',1,100,0,2,1447231682,0.8,'白色,黑色','S,M,L',1),(32,51,'亚倪家/早秋新款恶搞大眼怪迷你水桶包','湖北大东公司','亚倪家/早秋新款恶搞大眼怪迷你水桶包',100.00,'201511110849069299.jpg',1,100,0,7,1447231746,0.8,'白色,黑色','S,M,L',1),(33,51,'亚倪家/日系小丸子便利购物袋学生单肩包','湖北大东公司','亚倪家/日系小丸子便利购物袋学生单肩包',100.00,'201511110849536407.jpg',1,100,0,4,1447231793,0.8,'白色,黑色','S,M,L',1),(34,42,'双11大促销美白补水套盒','湖北大东化妆品有限公司','这是美白的必备武器',102.00,'201511140859163329.jpg',1,99,1,6,1447491556,0.8,'无色','600ml,800ml,1000ml',1),(39,43,'2015秋新长袖百搭风衣外套','湖北大东公司','<p>急急急<br/></p>',100.00,'201511141308276914.jpg',1,100,0,2,1447506507,0.8,'灰色,黑色,白色','100ml,300ml',1),(47,49,'运动舒适的鞋子非常好的','湖北大东公司','<p><br/></p><br/><p><br/></p><p><img alt=\"ksavr_ie3tmnbtmztdoyjxgqzdambqgayde_900x1350.jpg_750x999.jpg\" src=\"/ueditor/php/upload/image/20151116/1447643436138329.jpg\" title=\"1447643436138329.jpg\"/></p>',100.00,'201511160333297288.jpg',1,100,0,2,1447644188,0.8,'红色,白色,黑色','M,L,S',1),(41,43,'2015秋新款韩版女装翻领抽绳收腰长袖百搭风衣外套','时尚潮流疯一点','<h1>商品描述</h1><p><img alt=\"13pnsf_ie2tkolgmizdkntdgmzdimbqhayde_750x1036.jpg\" title=\"1447507114862270.jpg\" src=\"/ueditor/php/upload/image/20151114/1447507114862270.jpg\"/></p><p><img src=\"/ueditor/php/upload/image/20151114/1447507114850480.jpg\" style=\"\" title=\"1447507114850480.jpg\"/></p><p><img src=\"/ueditor/php/upload/image/20151114/1447507114971657.jpg\" style=\"\" title=\"1447507114971657.jpg\"/></p><p><img src=\"/ueditor/php/upload/image/20151114/1447507114950141.jpg\" style=\"\" title=\"1447507114950141.jpg\"/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><h2>尺码说明</h2><p><span style=\"font-size: 18px; font-family: 宋体,SimSun;\">1、照片中的配饰是搭配拍照时的道具，不随衣服一起附送哦。\r\n2、因是手动测量，会存在1-2cm误差，测量单位为CM。\r\n3、由于光线、显示器等原因，图案颜色可能与实物有细微差别。\r\n4、为响应商标保护法，多数服装都做了剪标处理，衣服保证全新，请亲们放心购买！</span></p><table class=\"size-table\"><thead><tr class=\"firstRow\"><th>尺码</th><th>衣长</th><th>袖长</th><th>胸围</th><th>肩宽</th></tr></thead><tbody><tr><td>S</td><td>76</td><td>57</td><td>100</td><td>39</td></tr><tr><td>M</td><td>78</td><td>58</td><td>106</td><td>40</td></tr><tr><td>L</td><td>80</td><td>59</td><td>112</td><td>41</td></tr></tbody></table><p>※ 以上尺寸为实物人工测量，因测量当时不同会有1-2cm误差，相关数据仅作参考，以收到实物为准。</p><p><br/></p><p><br/></p><h2>商品描述</h2><p>柔软舒适的棉混纺面料，无弹性，无内衬，厚度适中。简洁干练的翻领，长袖，袖口褶皱设计两粒扣收口，休闲时尚，前身单排按扣开襟，上半身加层拼接设计，酷帅十足，腰部松紧抽绳收腰，可以自由调节腰部线条，两插袋，美观又实用！推荐~</p><h2>产品参数</h2><table id=\"J_ParameterTable\" class=\"parameter-table\"><tbody><tr class=\"firstRow\"><td>领型：翻领/Polo领</td><td>袖型：常规袖</td><td>袖长：长袖</td></tr><tr><td>衣长：中长款（66-80cm）</td><td>衣门襟：单排扣</td><td>厚薄：普通</td></tr><tr><td>图案：纯色</td><td>风格：小清新,日韩,森系,学院,街头（潮人）,甜美,韩系</td><td>版型：X型（收腰）</td></tr></tbody></table><h2>穿着效果</h2><p><img alt=\"13pnsf_ie2tkolgmizdkntdgmzdimbqhayde_750x1036.jpg\" title=\"1447507114862270.jpg\" src=\"/ueditor/php/upload/image/20151114/1447507114862270.jpg\"/></p><p><img src=\"/ueditor/php/upload/image/20151114/1447507114850480.jpg\" style=\"\" title=\"1447507114850480.jpg\"/></p><p><img src=\"/ueditor/php/upload/image/20151114/1447507114971657.jpg\" style=\"\" title=\"1447507114971657.jpg\"/></p><p><img src=\"/ueditor/php/upload/image/20151114/1447507114950141.jpg\" style=\"\" title=\"1447507114950141.jpg\"/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><h2>尺码说明</h2><p>1、照片中的配饰是搭配拍照时的道具，不随衣服一起附送哦。\r\n2、因是手动测量，会存在1-2cm误差，测量单位为CM。\r\n3、由于光线、显示器等原因，图案颜色可能与实物有细微差别。\r\n4、为响应商标保护法，多数服装都做了剪标处理，衣服保证全新，请亲们放心购买！</p><table class=\"size-table\"><thead><tr class=\"firstRow\"><th>尺码</th><th>衣长</th><th>袖长</th><th>胸围</th><th>肩宽</th></tr></thead><tbody><tr><td>S</td><td>76</td><td>57</td><td>100</td><td>39</td></tr><tr><td>M</td><td>78</td><td>58</td><td>106</td><td>40</td></tr><tr><td>L</td><td>80</td><td>59</td><td>112</td><td>41</td></tr></tbody></table><p>※ 以上尺寸为实物人工测量，因测量当时不同会有1-2cm误差，相关数据仅作参考，以收到实物为准。</p><p><br/></p>',0.00,'201511141337432462.jpg',1,100,0,3,1447508263,0.8,'灰色,黑色,白色','S,M,L',1),(42,43,'大风衣服','湖北大东公司','<h1>商品描述</h1><p>还\r\n记得还记得么 这款我去年自己有自留 到现在家里还挂着呢 想着天气冷的时候穿 穿出去真的超级多的人问的呢 颜色好看 版型好看 质量也很赞 \r\n市面上真的超级多的盗图和仿版 去年厂家也有跟我说有便宜50寄拿货价的面料问我要不要换换我果断拒绝了 我相信品质和信誉亲们真的能清楚</p><p><img alt=\"13pnsf_ieztknrvhezdkntdgmzdambqgyyde_750x686.jpg\" src=\"/ueditor/php/upload/image/20151116/1447642072224884.jpg\" title=\"1447642072224884.jpg\"/></p>',100.00,'201511160247557897.jpg',1,200,0,2,1447642075,0.8,'红色,黑色','M,L,S',1),(43,43,'2015秋冬新款韩版女装西装领卡通人物刺绣毛呢大衣外套','湖北大东公司','<h1>商品描述</h1><p>优质柔软的毛呢面料，厚度适中，有弹性。简约大方的西装领，七分袖袖长，露出民族风图案，前身两粒扣开身门襟，知性大方，两侧的卡通人物刺绣，时尚不失甜美，两插袋美观实用，中长款直身型。推荐~~</p><h1>产品参数</h1><table class=\"parameter-table\" id=\"J_ParameterTable\"><tbody><tr class=\"firstRow\"><td>领型：西装领</td><td>袖长：七分袖</td><td>袖型：常规袖</td></tr><tr><td>衣长：中长款（66-80cm）</td><td>细节：拼接,绣花</td><td>风格：日韩,小清新,学院,通勤（OL）,街头（潮人）,韩系,轻熟</td></tr><tr><td>材质：毛呢</td><td>衣门襟：两粒单排扣</td><td><br/></td></tr></tbody></table><p><img alt=\"1tuf0l_ie4tqzlfmyydgmbwgqzdambqgqyde_750x430.jpg_750x999.jpg\" src=\"/ueditor/php/upload/image/20151116/1447642224753959.jpg\" title=\"1447642224753959.jpg\"/></p>',100.00,'201511160250333449.jpg',1,99,1,8,1447642233,0.8,'灰色,白色，黑色','S,M,L',1);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` char(32) NOT NULL,
  `sex` tinyint(1) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `state` tinyint(1) DEFAULT '1',
  `addtime` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'张燕','123',0,'湖北随州','15172764834','403786960@qq.com',0,1446873656),(8,'司丹','123456',0,'河南郑州','15172764834','1234@qq.com',0,1447069724),(9,'张翔','666666',1,'湖北随州','15172764834','1234@qq.com',0,1447069838),(10,'王强','123456',1,'河南郑州','15172764834','403786960@qq.com',0,1447070291),(38,'55453453','11',1,'11','11','11',0,1447676871),(13,'找草','123456',1,'湖北随州','15172764834','403786960@qq.com',0,1447071596),(14,'王新答','1234567',1,'河南郑州','15172764834','403786960@qq.com',0,1447072201),(15,'123','123',1,'湖北随州','15172764834','1234@qq.com',0,1447072267),(33,'22','22',1,'22','1122','22',1,1447676209),(36,'5555','55',0,'55','55','55',1,1447676757),(23,'bb','aa',1,'湖北随州','123','1234@qq.com',0,1447639990),(28,'zn234','234',0,'湖北随州','00000','1234@qq.com',1,1447644853),(29,'ymg2','123',1,'11111','1122','1111',1,1447651807);
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

-- Dump completed on 2015-11-16 20:31:36
