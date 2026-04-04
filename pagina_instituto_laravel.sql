-- MySQL dump 10.13  Distrib 8.0.45, for Win64 (x86_64)
--
-- Host: localhost    Database: web-institute
-- ------------------------------------------------------
-- Server version	9.6.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup 
--

SET @@GLOBAL.GTID_PURGED=/*!80000 '+'*/ 'b370e485-ffae-11f0-bc01-5811223ff292:1-1363';

--
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `areas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `formal_education_description` text COLLATE utf8mb4_unicode_ci,
  `formal_education_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `formal_education_color` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `non_formal_education_description` text COLLATE utf8mb4_unicode_ci,
  `non_formal_education_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `non_formal_education_color` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `educational_materials_description` text COLLATE utf8mb4_unicode_ci,
  `educational_materials_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `educational_materials_color` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int unsigned NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `coordinator_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `areas_slug_unique` (`slug`),
  KEY `areas_created_by_foreign` (`created_by`),
  KEY `areas_updated_by_foreign` (`updated_by`),
  KEY `areas_order_index` (`order`),
  KEY `areas_active_index` (`active`),
  KEY `areas_coordinator_id_foreign` (`coordinator_id`),
  CONSTRAINT `areas_coordinator_id_foreign` FOREIGN KEY (`coordinator_id`) REFERENCES `teams` (`id`) ON DELETE SET NULL,
  CONSTRAINT `areas_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `areas_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `areas`
--

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` VALUES (1,'Educación y Comunicación','educacion-comunicacion','<p><strong>Lorem Ipsum</strong> es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum</p><p><br></p>','Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.','areas/education/01KME3MD446ZK3DQ0Y6RYRR1P0.jpg','#d4db37','Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.','areas/education/01KME1DMSSZEJZ7QGQPPN0KFC1.jpg','#3ab525','Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.\n','areas/education/01KME1DMSVHNPA79FZKT5AHXD9.jpg','#d91919','heroicon-o-academic-cap','areas/images/01KMDZ4Q24JT3527RCJ1TVTT0D.jpg','areas/logos/01KN0ZRPYP0M7N5D932XRKDVYV.png',1,1,NULL,4,'2026-03-09 05:09:28','2026-03-31 08:42:30',3),(2,'Investigación','investigacion','<p><strong>Lorem Ipsum</strong> es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición.</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'heroicon-o-beaker','areas/images/01KMDZ0N6ZXDGZYEVJ7TZACB6V.jpg','areas/logos/01KN0ZSBWB6D2V06XS8EG49RTP.png',2,1,NULL,4,'2026-03-09 05:09:28','2026-03-31 08:42:52',2),(3,'Proyección Social','proyeccion-social','Área dedicada a la promoción de la salud en diferentes grupos poblacionales.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'heroicon-o-heart','areas/images/01KMDZ3B2EP1032PVXTSCVBNRK.jpg','areas/logos/01KN0ZT37QT01TK456M93WHFBR.png',3,1,NULL,4,'2026-03-09 05:09:28','2026-03-31 08:43:16',4);
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `banners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `page` enum('about_us','what_we_do','social_projection','education_communication','research','repository','news','contact_us','default') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#000000',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#000000',
  `button_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `type` enum('main','secondary') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'main',
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` VALUES (4,'default','Promovemos la Salud Integral','#FFFFFF','banners/01KN0Z7DVWB1DK4E2BSSS9390F.jpg','Programas de educación, investigación y proyección social','#F0F0F0','https://www.drpedroperez.com/','#eb9b11',1,'main',4,'2026-03-09 05:51:52','2026-03-31 09:23:23'),(5,'default','Formación que Transforma Vidas','#de2525','banners/01KN0ZY3865DAEHTV3A9PA8Y7C.jpg','Cursos, diplomados y programas de formación continua','#e01f1f','https://www.drpedroperez.com/','#f50a2e',1,'main',2,'2026-03-09 05:51:52','2026-03-31 08:45:27'),(6,'default','Investigación con Impacto Social','#41de11','banners/01KN0ZZET1NZMP43WCNPMH2DCA.jpg','Generamos conocimiento científico aplicado para responder','#6bd10e','https://www.drpedroperez.com/','#00ff09',1,'main',3,'2026-03-09 05:51:52','2026-03-31 08:46:11'),(7,'about_us','Quiénes Somos','#ffffff','banners/01KMDX8A65CWP8FCP0H9BMJ71W.jpg','Más de 18 años promoviendo la salud y el bienestar en las comunidades de Antioquia','#4B5563',NULL,NULL,1,'secondary',1,'2026-03-09 05:51:52','2026-03-23 22:53:02'),(8,'what_we_do','Lo Que Hacemos','#ffffff','banners/01KM8YA0FS06V15SZFV5MCSJ8C.jpg','Educación, investigación y proyección social al servicio del bienestar humano','#4B5563',NULL,NULL,1,'secondary',1,'2026-03-09 05:51:52','2026-03-23 22:53:15'),(9,'social_projection','Proyección Social','#ffffff','banners/01KM8Y9BNK2MDJM9E7HK7QAMGQ.jpg','Llegamos a las comunidades con programas de salud diseñados para cada grupo poblacional','#4B5563',NULL,NULL,1,'secondary',1,'2026-03-09 05:51:52','2026-03-23 22:53:48'),(10,'education_communication','Educación y Comunicación','#ffffff','banners/01KM98SRBJ07V98PQ73HV6JZSR.jpg','Formación de calidad para profesionales y comunidades comprometidas con la salud','#4B5563',NULL,NULL,1,'secondary',1,'2026-03-09 05:51:52','2026-03-23 22:54:12'),(11,'research','Investigación','#ffffff','banners/01KMDXB83ZYS0TWASCTEBNWX8N.jpg','Producción de conocimiento científico riguroso para la toma de decisiones en salud pública','#4B5563',NULL,NULL,1,'secondary',1,'2026-03-09 05:51:52','2026-03-23 22:54:38'),(12,'repository','Repositorio','#ffffff','banners/01KMBANB52781WW43KB2VYWFHQ.jpg','Accede a nuestra colección de guías, manuales, investigaciones y documentos de política en salud','#4B5563',NULL,NULL,1,'secondary',1,'2026-03-09 05:51:52','2026-03-22 22:49:37'),(13,'news','Noticias e Información','#f2f2f2','banners/01KME8P42R1DYPVP3S8XASQ06P.jpg','Mantente informado sobre nuestras actividades, eventos y publicaciones más recientes','#4B5563',NULL,NULL,1,'secondary',1,'2026-03-09 05:51:52','2026-03-24 02:12:48'),(14,'contact_us','Contáctanos','#1F2937','placeholder.jpg','Estamos aquí para atenderte. Escríbenos, llámanos o visítanos en nuestras instalaciones','#4B5563',NULL,NULL,1,'secondary',1,'2026-03-09 05:51:52','2026-03-09 05:51:52'),(17,'default','prueba de banner','#2c06ed','banners/01KN12F84XF9VWP3HTX78XS8WZ.jpg',NULL,'#000000',NULL,NULL,1,'main',5,'2026-03-31 09:29:46','2026-03-31 09:29:46'),(18,'default','prueba de banner 2','#f100ff','banners/01KN12GCP8QQTS2DY1KF167GCT.jpg',NULL,'#000000','https://claude.ai/chat/b4d030e4-3bd2-4671-a186-d616c4b9fca6','#f01068',1,'main',6,'2026-03-31 09:30:23','2026-03-31 09:30:23'),(19,'default','Gestión intersectorial','#09ded0','banners/01KN12QVYAF609J7DCFVJZWS2M.jpg',NULL,'#000000','https://www.drpedroperez.com/','#98b817',1,'main',7,'2026-03-31 09:34:28','2026-03-31 09:34:28'),(20,'default','educacion y comunicacion','#e08d01','banners/01KN12RXAZ19MTA3M8ZXB8GSTW.jpg',NULL,'#000000',NULL,NULL,1,'main',8,'2026-03-31 09:35:03','2026-03-31 09:35:03');
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `companies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `business_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `x_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `threads_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `privacy_policy_pdf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slogan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mission_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mission_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mission_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vision_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vision_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `vision_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `trajectory_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trajectory_description` text COLLATE utf8mb4_unicode_ci,
  `trajectory_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `methodology_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `methodology_description` longtext COLLATE utf8mb4_unicode_ci,
  `methodology_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `values_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,'Instituto Proinapsa de Salud y Bienestar','(604) 444-5566','(604) 444-5567','300 123 4567','310 987 6543',NULL,'contacto@proinapsa.edu.co','informacion@proinapsa.edu.co','investigacion@proinapsa.edu.co','company/logos/01KN12Z1M7BFDAADPVXFN54ZAQ.png','company/favicons/01KN12Z1M8JR5SN0TRNH43B08J.png','El Instituto Proinapsa es una institución comprometida con la promoción de la salud, la formación integral y el bienestar de las comunidades. Trabajamos con diferentes grupos poblacionales —primera infancia, niñez, mujeres y trabajadores— a través de programas de educación, investigación y proyección social. Nuestra labor está orientada a generar conocimiento aplicado y transformar realidades mediante el acompañamiento profesional y la construcción de entornos saludables.','https://www.facebook.com/InstitutoProinapsa','https://www.instagram.com/proinapsa_oficial','https://www.youtube.com/@InstitutoProinapsa','https://x.com/proinapsa','https://wa.me/573001234567','https://www.threads.com/?hl=es-la','Calle 50 # 42 - 78, Laureles, Medellín, Antioquia, Colombia','company/policies/01KN11G29R7RXXD914VA3H6XJ1.pdf','https://www.youtube.com/embed/dQw4w9WgXcQ','Promoviendo la salud integral para todos','2026-03-09 05:51:52','2026-03-31 09:38:24','Nuestra Misión','Promover la salud integral y el bienestar de las comunidades a través de procesos de educación, investigación y proyección social, con un enfoque humanista, científico y ético. Trabajamos para generar transformaciones positivas en la calidad de vida de los diferentes grupos poblacionales, especialmente en primera infancia, niñez, mujeres y trabajadores.','company/mission/01KM9CPZB0XJ0PHQSF0TEMKZZW.jpg','Nuestra Visión','Para 2030, ser reconocidos como una institución de referencia nacional en la promoción de la salud, la formación integral y la investigación aplicada, contribuyendo de manera significativa al desarrollo humano sostenible y al bienestar de las comunidades colombianas.','company/vision/01KM9CPZB1GRQ20FZG4D32HAWJ.jpg',6.24421000,-75.58116000,'Nuestra Trayectoria','Desde nuestra fundación en 2005, el Instituto Proinapsa ha acompañado a miles de personas y comunidades en su camino hacia el bienestar. Con más de 18 años de experiencia, hemos desarrollado programas de formación, investigado problemáticas de salud pública y ejecutado proyectos de intervención comunitaria en todo el departamento de Antioquia. Nuestro recorrido está marcado por la pasión por servir, el rigor académico y el compromiso con la dignidad humana.','company/trajectory/01KN12CRNVX0AZDJD1NE8BCTFN.jpg','Nuestra Metodología','<p>En el Instituto Proinapsa aplicamos una metodología integrada que combina la teoría con la práctica, el conocimiento científico con el saber popular, y la acción individual con la transformación colectiva. Nuestro enfoque se basa en cuatro pilares fundamentales:</p><ul><li><strong>Participación activa:</strong> Involucramos a las comunidades como protagonistas de su propio bienestar.</li><li><strong>Interdisciplinariedad:</strong> Contamos con equipos de diferentes disciplinas que trabajan de forma colaborativa.</li><li><strong>Basado en evidencia:</strong> Nuestras intervenciones se fundamentan en investigación y buenas prácticas.</li><li><strong>Contextualización:</strong> Adaptamos nuestros programas a las realidades culturales y sociales de cada comunidad.</li><li><strong>Basado en evidencia:</strong> Nuestras intervenciones se fundamentan en investigación y buenas prácticas.</li><li><strong>Contextualización:</strong> Adaptamos</li></ul>','company/methodology/01KME4ACQY69DP48ACEDGMM7VE.jpg','company/values/01KN0ZE6R6P5811RJ37EVE3455.jpg');
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `courses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `area_id` bigint unsigned NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery_image_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pdf_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','finished','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `registration_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration_hours` int unsigned DEFAULT NULL,
  `order` int unsigned NOT NULL DEFAULT '1',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `courses_title_unique` (`title`),
  UNIQUE KEY `courses_slug_unique` (`slug`),
  KEY `courses_created_by_foreign` (`created_by`),
  KEY `courses_updated_by_foreign` (`updated_by`),
  KEY `courses_area_id_index` (`area_id`),
  KEY `courses_status_index` (`status`),
  KEY `courses_order_index` (`order`),
  CONSTRAINT `courses_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `courses_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `courses_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,1,'Primeros Auxilios Psicológicos','primeros-auxilios-psicologicos','Aprende a brindar apoyo psicológico básico en situaciones de emergencia, crisis o desastre. Curso práctico con enfoque en intervención inmediata y estabilización emocional.','courses/images/01KM9B0W2BFM9ZF5DX1F4F7MG8.jpg','<p>Los <strong>Primeros Auxilios Psicológicos (PAP)</strong> son una intervención de apoyo psicológico básico que se brinda a personas afectadas por situaciones de emergencia, crisis, desastres o eventos traumáticos.</p><p>Este curso te enseñará a <strong>identificar, acercarte y estabilizar</strong> emocionalmente a personas en situación de crisis, utilizando técnicas validadas y recomendadas por la Organización Mundial de la Salud y la Federación Internacional de la Cruz Roja.</p><p><strong>Contenidos del curso:</strong></p><ul><li>Fundamentos de los Primeros Auxilios Psicológicos</li><li>El modelo de los 5 principios básicos de los PAP</li><li>Cómo acercarse a alguien en crisis</li><li>Técnicas de estabilización emocional</li><li>Autocuidado del auxiliador</li><li>Casos prácticos y simulaciones</li></ul>','courses/gallery/01KM9B8YHRCE4N5AP1JQ87JCE6.jpeg','courses/pdfs/01KM9B8YHWW9CPCRP8K1FM14BV.pdf','active','https://www.proinapsa.edu.co/inscripciones/primeros-auxilios-psicologicos',40,1,NULL,1,NULL,'2026-03-09 05:51:52','2026-03-22 04:21:50'),(2,1,'Salud Mental en el Entorno Laboral','salud-mental-en-el-entorno-laboral','Herramientas para promover el bienestar psicológico en el trabajo, prevenir el burnout y gestionar el estrés laboral. Dirigido a profesionales y líderes de equipos.','courses/images/01KM9B3FM05E103W82XX6JD22F.jpg','<p>El <strong>entorno laboral</strong> es uno de los principales determinantes de la salud mental de las personas. Este curso ofrece herramientas conceptuales y prácticas para promover ambientes de trabajo saludables y prevenir el deterioro del bienestar psicológico.</p><p>Al finalizar el curso, los participantes estarán en capacidad de <strong>identificar factores de riesgo psicosocial en el trabajo</strong>, implementar estrategias de autocuidado y bienestar, y promover una cultura organizacional que favorezca la salud mental.</p><p><strong>Contenidos:</strong></p><ul><li>Salud mental y trabajo: marco conceptual</li><li>Factores psicosociales laborales</li><li>El síndrome de burnout: diagnóstico y prevención</li><li>Gestión del estrés y técnicas de afrontamiento</li><li>Comunicación asertiva en el trabajo</li><li>Diseño de programas de bienestar laboral</li></ul>','courses/gallery/01KME4HT7DH3RM4VND4NX835GA.jpg',NULL,'active','https://www.proinapsa.edu.co/inscripciones/salud-mental-laboral',60,2,NULL,1,NULL,'2026-03-09 05:51:52','2026-03-24 01:00:33'),(3,1,'Comunicación Asertiva y Resolución de Conflictos','comunicacion-asertiva-y-resolucion-de-conflictos','Desarrolla habilidades de comunicación efectiva y aprende técnicas para resolver conflictos de manera constructiva en contextos personales, comunitarios y organizacionales.','courses/images/01KME0P5P0B1CWBP23H1B6537B.png','<p>La <strong>comunicación asertiva</strong> es una habilidad fundamental para el bienestar personal y las relaciones interpersonales. En este curso aprenderás a expresarte de forma clara, respetuosa y efectiva, y a manejar los conflictos como oportunidades de crecimiento.</p><p>El curso combina teoría, práctica y role-playing para desarrollar competencias comunicativas aplicables en diferentes contextos: familiar, laboral, comunitario y social.</p><p><strong>Contenidos:</strong></p><ul><li>Estilos de comunicación: pasivo, agresivo y asertivo</li><li>Comunicación no verbal y paraverbal</li><li>Escucha activa y empatía</li><li>El conflicto como oportunidad</li><li>Técnicas de negociación y mediación</li><li>Comunicación en contextos de diversidad</li></ul>','courses/gallery/01KME0P5P2WB9SSDNVXNEQMSG0.png','courses/pdfs/01KME0P5P5SSFAK24CNSSZDA0M.pdf','active','https://www.proinapsa.edu.co/inscripciones/comunicacion-asertiva',32,3,NULL,1,NULL,'2026-03-09 05:51:52','2026-03-23 23:53:02'),(4,1,'Educación para la Salud Sexual y Reproductiva','educacion-para-la-salud-sexual-y-reproductiva','Formación integral en salud sexual y reproductiva desde un enfoque de derechos, género e interseccionalidad. Dirigido a docentes, orientadores y profesionales de la salud.','placeholder.jpg','<p>Este curso ofrece una formación integral en <strong>salud sexual y reproductiva</strong> con un enfoque basado en derechos, género e interseccionalidad. Está diseñado para profesionales que trabajan con jóvenes y adolescentes en contextos educativos, de salud o comunitarios.</p><p><strong>Contenidos:</strong></p><ul><li>Marco de derechos sexuales y reproductivos</li><li>Anatomía y fisiología sexual y reproductiva</li><li>Métodos anticonceptivos: evidencia y orientación</li><li>Prevención de ITS y VIH/SIDA</li><li>Educación sexual integral en la escuela</li><li>Violencia sexual: prevención, detección y ruta de atención</li><li>Diversidad sexual e identidad de género</li></ul>','placeholder.jpg','placeholder.pdf','finished','https://www.proinapsa.edu.co/inscripciones/educacion-sexual',80,4,NULL,NULL,NULL,'2026-03-09 05:51:52','2026-03-22 02:27:21'),(5,1,'Metodología de Investigación en Salud','metodologia-de-investigacion-en-salud','Curso teórico-práctico para el diseño y ejecución de investigaciones en salud pública. Aborda enfoques cuantitativos, cualitativos y mixtos con aplicaciones reales.','courses/images/01KME0WHN997V4Q26EGQ553EKK.jpg','<p>Este curso proporciona los fundamentos metodológicos para el diseño y ejecución de investigaciones en el campo de la salud pública y las ciencias de la salud.</p><p>Los participantes aprenderán a <strong>formular preguntas de investigación</strong>, seleccionar el diseño metodológico más apropiado, construir instrumentos de recolección de datos, analizar resultados y presentar hallazgos con rigor científico.</p><p><strong>Contenidos:</strong></p><ul><li>Fundamentos del pensamiento científico en salud</li><li>Investigación cuantitativa: diseños descriptivos y analíticos</li><li>Investigación cualitativa: etnografía, fenomenología y teoría fundamentada</li><li>Métodos mixtos en investigación en salud</li><li>Ética en la investigación con seres humanos</li><li>Escritura científica y publicación académica</li></ul>','courses/gallery/01KME0WHNBMSANZD64XG6EDYHM.jpg','courses/pdfs/01KME0WHNDQBDJKP1RSX1VK2D5.pdf','active','https://www.proinapsa.edu.co/inscripciones/metodologia-investigacion',120,1,NULL,1,NULL,'2026-03-09 05:51:52','2026-03-23 23:56:30'),(6,1,'Análisis de Datos con SPSS para Investigadores en Salud','analisis-de-datos-con-spss-para-investigadores-en-salud','Aprende a procesar, analizar e interpretar datos cuantitativos usando SPSS. Curso práctico con ejercicios basados en investigaciones reales de salud pública.','courses/images/01KME0JFF8F34652Q98YTW47Z7.jpg','<p>El dominio del <strong>análisis estadístico</strong> es una competencia esencial para los investigadores en salud. Este curso proporciona los conocimientos y habilidades para usar SPSS en el análisis de datos de investigaciones en salud pública.</p><p><strong>Contenidos:</strong></p><ul><li>Introducción a SPSS: interfaz y funciones básicas</li><li>Estadística descriptiva: medidas de tendencia central y dispersión</li><li>Tablas de frecuencia y gráficos estadísticos</li><li>Pruebas de normalidad y supuestos estadísticos</li><li>Pruebas de hipótesis: T-test, ANOVA, Chi-cuadrado</li><li>Correlación y regresión lineal</li><li>Interpretación y reporte de resultados</li></ul>','courses/gallery/01KME0JFFATQXHJZWAJK6T8GN5.png','courses/pdfs/01KME0JFFEYG83A80EG47EVBB5.pdf','active','https://www.proinapsa.edu.co/inscripciones/spss-investigadores',48,2,NULL,1,NULL,'2026-03-09 05:53:13','2026-03-23 23:51:00'),(7,1,'Estrategias de Intervención Comunitaria en Salud','estrategias-de-intervencion-comunitaria-en-salud','Formación en metodologías participativas para la intervención comunitaria en salud. Diseño, implementación y evaluación de proyectos con enfoque territorial y de derechos.','courses/images/01KMDZSTX7DAB19262FNQJCM8T.jpg','<p>La <strong>intervención comunitaria en salud</strong> requiere de metodologías participativas, contextualización territorial y un profundo respeto por el saber comunitario. Este curso forma a los participantes en el diseño e implementación de estrategias efectivas de intervención en salud con comunidades.</p><p><strong>Contenidos:</strong></p><ul><li>Fundamentos de la participación comunitaria en salud</li><li>Diagnóstico participativo y mapeo de actores</li><li>Diseño de proyectos de salud comunitaria</li><li>Comunicación para el cambio de comportamiento</li><li>Trabajo con grupos poblacionales específicos: mujeres, niñez, adultos mayores</li><li>Evaluación y sistematización de experiencias comunitarias</li></ul>','courses/gallery/01KMDZSTXAJ1K639V69SQN8Y12.jpeg','courses/pdfs/01KMDZSTXCZWSHY8CF3DYXQG7F.pdf','active','https://www.proinapsa.edu.co/inscripciones/intervencion-comunitaria',80,1,NULL,1,NULL,'2026-03-09 05:53:13','2026-03-23 23:37:33'),(8,1,'Atención Psicosocial a Víctimas del Conflicto Armado','atencion-psicosocial-a-victimas-del-conflicto-armado','Curso especializado en atención psicosocial a personas y comunidades afectadas por el conflicto armado en Colombia, con enfoque de derechos y enfoques diferenciales.','placeholder.jpg','<p>Colombia tiene una deuda histórica con las víctimas del conflicto armado. Este curso forma a profesionales en la <strong>atención psicosocial con enfoque diferencial y de derechos</strong>, para acompañar procesos de recuperación emocional, reparación y reconciliación en comunidades afectadas.</p><p><strong>Contenidos:</strong></p><ul><li>Marco legal y normativo para la atención a víctimas en Colombia</li><li>Impactos psicosociales del conflicto armado</li><li>El duelo y la pérdida en contextos de violencia</li><li>Atención psicosocial individual y grupal</li><li>Enfoque diferencial: género, etnia, ciclo vital</li><li>El modelo de atención psicosocial en salud (PAPSIVI)</li><li>Autocuidado del profesional en contextos de violencia</li></ul>','placeholder.jpg','placeholder.pdf','inactive','https://www.proinapsa.edu.co/inscripciones/atencion-victimas',100,2,NULL,NULL,NULL,'2026-03-09 05:53:13','2026-03-22 02:27:21');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `educational_material_groups`
--

DROP TABLE IF EXISTS `educational_material_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `educational_material_groups` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category` enum('early_childhood','childhood','women','workers') COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('guides_manuals','games') COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `order` smallint unsigned NOT NULL DEFAULT '1',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `educational_material_groups_category_type_unique` (`category`,`type`),
  UNIQUE KEY `educational_material_groups_slug_unique` (`slug`),
  KEY `educational_material_groups_category_type_is_active_index` (`category`,`type`,`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `educational_material_groups`
--

LOCK TABLES `educational_material_groups` WRITE;
/*!40000 ALTER TABLE `educational_material_groups` DISABLE KEYS */;
INSERT INTO `educational_material_groups` VALUES (1,'early_childhood','Primera Infancia','guides_manuals','Primera Infancia','guias-y-manuales-primera-infancia','Guías y manuales educativos dirigidos a la primera infancia.',NULL,NULL,1,1,NULL,NULL,'2026-03-11 05:49:45','2026-03-11 05:54:20'),(3,'childhood','Niñez, Adolescencia y Juventud','guides_manuals','Niñez, Adolescencia y Juventud','guias-y-manuales-escolar-y-adolescencia','Guías y manuales educativos para la población escolar y adolescente.',NULL,NULL,1,3,NULL,NULL,'2026-03-11 05:49:45','2026-03-11 06:02:20'),(5,'women','MUJER MARAVILLA','guides_manuals','Mujer','mujer',NULL,NULL,NULL,1,5,NULL,1,'2026-03-30 07:34:08','2026-03-30 07:46:22'),(6,'workers','Trabajadores','guides_manuals','Trabajadores','trabajadores',NULL,NULL,NULL,1,4,NULL,NULL,'2026-03-30 07:34:08','2026-03-30 07:34:08');
/*!40000 ALTER TABLE `educational_material_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `educational_materials`
--

DROP TABLE IF EXISTS `educational_materials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `educational_materials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `area_id` bigint unsigned NOT NULL,
  `group_id` bigint unsigned NOT NULL,
  `category` enum('early_childhood','childhood','women','workers') COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('guides_manuals','games') COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_description` text COLLATE utf8mb4_unicode_ci,
  `gallery_image_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery_image_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery_image_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery_image_4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery_image_5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pdf_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int unsigned NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `educational_materials_category_title_unique` (`category`,`title`),
  KEY `educational_materials_created_by_foreign` (`created_by`),
  KEY `educational_materials_updated_by_foreign` (`updated_by`),
  KEY `educational_materials_area_id_index` (`area_id`),
  KEY `educational_materials_category_index` (`category`),
  KEY `educational_materials_type_index` (`type`),
  KEY `educational_materials_order_index` (`order`),
  KEY `educational_materials_active_index` (`active`),
  KEY `educational_materials_group_id_foreign` (`group_id`),
  CONSTRAINT `educational_materials_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `educational_materials_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `educational_materials_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `educational_material_groups` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `educational_materials_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `educational_materials`
--

LOCK TABLES `educational_materials` WRITE;
/*!40000 ALTER TABLE `educational_materials` DISABLE KEYS */;
INSERT INTO `educational_materials` VALUES (1,1,1,'early_childhood','guides_manuals','Guía de Estimulación Temprana','Manual práctico para padres y cuidadores sobre técnicas de estimulación del desarrollo cognitivo, motor y socioemocional en niños de 0 a 3 años.','educational-materials/images/01KMDY8T39DRN6VM8PXQ5YX9PZ.jpg','<p>Esta guía ofrece a padres, madres y cuidadores herramientas concretas para estimular el desarrollo integral de los niños en sus primeros tres años de vida, la etapa más crítica del desarrollo humano.</p><p>Incluye actividades clasificadas por mes de vida, orientaciones sobre el desarrollo esperado, señales de alerta y recomendaciones para cada área del desarrollo: cognitiva, motora, comunicativa y socioemocional.</p><p>Todo el contenido está basado en evidencia científica y adaptado al contexto colombiano.</p>','placeholder.jpg','placeholder.jpg',NULL,NULL,NULL,'educational-materials/pdfs/01KMDY8T40C1HFJV84431SK6PX.pdf',1,1,NULL,1,NULL,'2026-03-09 05:53:13','2026-03-23 23:10:47'),(2,1,1,'early_childhood','guides_manuals','Manual del Agente Educativo en Primera Infancia','Recurso formativo para agentes educativos del ICBF y hogares comunitarios sobre prácticas de cuidado, crianza y educación inicial con enfoque de derechos.','educational-materials/images/01KMDYBCMSFXGPRV8RG6FZTHY4.jpg','<p>Este manual está diseñado para fortalecer las competencias de los <strong>agentes educativos</strong> que trabajan con la primera infancia en hogares comunitarios, centros de desarrollo infantil y jardines infantiles.</p><p>Aborda los fundamentos del desarrollo infantil, las prácticas de cuidado calificado, la importancia del juego como mediador del aprendizaje, la atención a la diversidad y el trabajo con familias.</p><p>Incluye guías de actividad, fichas de observación del desarrollo y orientaciones para el trabajo con familias en situación de vulnerabilidad.</p>','placeholder.jpg',NULL,NULL,NULL,NULL,'educational-materials/pdfs/01KMDYBCMVT5T1XCVE18R24HDQ.pdf',1,1,NULL,1,NULL,'2026-03-09 05:53:13','2026-03-30 05:24:19'),(3,1,1,'early_childhood','games','Juegos Sensoriales para Bebés de 0 a 18 Meses','Colección de juegos y actividades sensoriales diseñadas para estimular los sentidos y el desarrollo neurológico de bebés en sus primeros 18 meses de vida.','educational-materials/images/01KMDYAE2061V1KBT9P9SDZF75.jpg','<p>Los primeros 18 meses de vida son fundamentales para el desarrollo neurológico. Esta colección de <strong>juegos sensoriales</strong> ofrece actividades simples, económicas y efectivas para estimular los sentidos del bebé y fortalecer el vínculo con sus cuidadores.</p><p>Cada juego incluye descripción, materiales necesarios (preferiblemente del hogar), instrucciones y el objetivo de desarrollo que trabaja. Las actividades están organizadas por rango de edad: 0-3 meses, 4-6 meses, 7-12 meses y 13-18 meses.</p>','placeholder.jpg','placeholder.jpg','placeholder.jpg',NULL,NULL,'educational-materials/pdfs/01KMDYAE22KRDSRX99JVVYNQP8.pdf',1,1,NULL,1,'2026-03-30 05:24:19','2026-03-09 05:53:13','2026-03-30 05:24:19'),(4,1,3,'childhood','games','educacion formal','Manual práctico para padres y cuidadores sobre técnicas de estimulación del desarrollo cognitivo, motor y socioemocional en niños de 0 a 3 años.','educational-materials/images/01KM92EQ0662C0PN07ZGZ39DEM.jpg',NULL,NULL,NULL,NULL,NULL,NULL,'educational-materials/pdfs/01KM92EQ0ATQGJQB3T597B5W4J.pdf',1,1,1,NULL,'2026-03-30 05:24:25','2026-03-22 01:47:42','2026-03-30 05:24:25'),(5,1,3,'childhood','games','JUEGOS EDUCATIVOS PARA LA SALUD MENTAL','Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló\n','educational-materials/images/01KMDYFJ6P54XVZVV8HYAXFWXA.jpg',NULL,NULL,NULL,NULL,NULL,NULL,'educational-materials/pdfs/01KMDYFJ6R3W5GW52THMTPTF45.pdf',1,1,1,NULL,NULL,'2026-03-23 23:14:28','2026-03-30 05:24:25'),(6,1,5,'women','guides_manuals','Proyeccion social','HOLAAAHOLAAAHOLAAAHOLAAAHOLAAAHOLAAAHOLAAAHOLAAAHOLAAAHOLAAAHOLAAAHOLAAAHOLAAAHOLAAAHOLAAAHOLAAAHOLAAAHOLAAAHOLAAAHOLAAAHOLAAAHOLAAA','educational-materials/images/01KMY113XB8S2KFR01KW6G8VNQ.png',NULL,NULL,NULL,NULL,NULL,NULL,'educational-materials/pdfs/01KMY113XFFBVS018KYT58XWW0.pdf',1,1,1,NULL,NULL,'2026-03-30 05:06:51','2026-03-30 05:06:51'),(7,1,1,'early_childhood','guides_manuals','Gestión intersectorial','ADADADADADADADADADADADADADAD','educational-materials/images/01KMY22EKFSXE128Y3VFJKSRXF.png',NULL,NULL,NULL,NULL,NULL,NULL,'educational-materials/pdfs/01KMY22EKJ0AFAE7YJSCHZ10M0.pdf',2,1,1,NULL,NULL,'2026-03-30 05:25:03','2026-03-30 05:25:03'),(8,1,1,'childhood','guides_manuals','Gestión intersectorial','ADADADADADADAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA','educational-materials/images/01KMY23V62F7T4KD0N5Y99PZ4Z.png',NULL,NULL,NULL,NULL,NULL,NULL,'educational-materials/pdfs/01KMY23V66M90R7QA70VPHQV6X.pdf',1,1,1,1,NULL,'2026-03-30 05:25:49','2026-03-30 08:01:21'),(9,1,6,'workers','games','Proyeccion social1','JAJAJJAA','educational-materials/images/01KMY252MSRE7YD2RN854KNRW8.png',NULL,NULL,NULL,NULL,NULL,NULL,'educational-materials/pdfs/01KMY252MXS54E54Y97K9QDBH9.pdf',2,1,1,NULL,NULL,'2026-03-30 05:26:29','2026-03-30 05:26:29'),(10,1,6,'workers','games','PEDRO PEREZ','PEDRO PEREZPEDRO PEREZPEDRO PEREZPEDRO PEREZPEDRO PEREZPEDRO PEREZ','educational-materials/images/01KMY48D0FT7CH6Z5E641R0HNF.jpg',NULL,NULL,NULL,NULL,NULL,NULL,'educational-materials/pdfs/01KMY48D0JKJJS9KQWFZ04SN2G.pdf',3,1,1,NULL,NULL,'2026-03-30 06:03:15','2026-03-30 06:03:15'),(11,1,5,'women','guides_manuals','JULIO','PEDRO PEREZPEDRO PEREZPEDRO PEREZPEDRO PEREZPEDRO PEREZPEDRO PEREZPEDRO PEREZPEDRO PEREZPEDRO PEREZPEDRO PEREZPEDRO PEREZPEDRO PEREZPEDRO PEREZPEDRO PEREZPEDRO PEREZPEDRO PEREZPEDRO PEREZPEDRO PEREZPEDRO PEREZPEDRO PEREZPEDRO PEREZPEDRO PEREZPEDRO PEREZPEDRO ','educational-materials/images/01KMY4CJWSGN3GNNRF49RFBDSN.png',NULL,NULL,NULL,NULL,NULL,NULL,'educational-materials/pdfs/01KMY4CJWXF8RKCAEB4S017JKY.pdf',2,1,1,NULL,NULL,'2026-03-30 06:05:33','2026-03-30 06:05:33');
/*!40000 ALTER TABLE `educational_materials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formal_education_sections`
--

DROP TABLE IF EXISTS `formal_education_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `formal_education_sections` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `area_id` bigint unsigned NOT NULL,
  `section` enum('generalities','modalities','procedures','access_conditions','intern_commitments','institute_commitments') COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pdf_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int unsigned NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `formal_education_sections_section_unique` (`section`),
  KEY `formal_education_sections_created_by_foreign` (`created_by`),
  KEY `formal_education_sections_updated_by_foreign` (`updated_by`),
  KEY `formal_education_sections_area_id_index` (`area_id`),
  KEY `formal_education_sections_section_index` (`section`),
  KEY `formal_education_sections_order_index` (`order`),
  KEY `formal_education_sections_active_index` (`active`),
  CONSTRAINT `formal_education_sections_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `formal_education_sections_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `formal_education_sections_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formal_education_sections`
--

LOCK TABLES `formal_education_sections` WRITE;
/*!40000 ALTER TABLE `formal_education_sections` DISABLE KEYS */;
INSERT INTO `formal_education_sections` VALUES (1,1,'generalities','formal-education/icons/01KM98GVS8ZHBSP617RYK7CJFN.png','formal-education/pdfs/01KM98GVSDE5JKZV44T6JVWNTN.pdf',5,1,NULL,1,NULL,'2026-03-09 05:51:52','2026-03-22 03:33:44'),(4,1,'modalities','formal-education/icons/01KM98KQ8BMB907RQP00BQ2KK0.png','formal-education/pdfs/01KM98KQ8FYZAQDTEM26H7PRKF.pdf',3,1,NULL,1,NULL,'2026-03-09 05:51:52','2026-03-22 03:35:18'),(7,1,'procedures','formal-education/icons/01KMDX6M1MA8E98WPMGNDRPJSJ.png','formal-education/pdfs/01KMDX6M1QPE05WEBFR98Y6ANP.pdf',1,1,NULL,1,NULL,'2026-03-09 05:51:52','2026-03-23 22:52:06'),(9,1,'institute_commitments','formal-education/icons/01KM98N1ZFG5PD62574BSDK17Y.png','formal-education/pdfs/01KM98N1ZMHFTQ95FBBFQPFR9V.pdf',4,1,NULL,1,NULL,'2026-03-09 05:51:52','2026-03-22 03:36:01'),(11,1,'intern_commitments','formal-education/icons/01KM98P5KQGC6TSKD359NTF87W.png','formal-education/pdfs/01KM98P5KVMER5TGT8KKRNTWZX.pdf',6,1,NULL,1,NULL,'2026-03-09 05:51:52','2026-03-22 03:36:38'),(13,1,'access_conditions','formal-education/icons/01KM98RF9T1CP66WJA9M7DA535.png','formal-education/pdfs/01KM98RF9WZ07PXWRP4BFAC3CZ.pdf',2,1,1,1,NULL,'2026-03-11 08:41:39','2026-03-22 03:37:53');
/*!40000 ALTER TABLE `formal_education_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `health_promotion_categories`
--

DROP TABLE IF EXISTS `health_promotion_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `health_promotion_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `area_id` bigint unsigned NOT NULL,
  `category` enum('early_childhood','childhood','women','workers') COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pdf_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int unsigned NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `health_promotion_categories_category_unique` (`category`),
  KEY `health_promotion_categories_created_by_foreign` (`created_by`),
  KEY `health_promotion_categories_updated_by_foreign` (`updated_by`),
  KEY `health_promotion_categories_area_id_index` (`area_id`),
  KEY `health_promotion_categories_category_index` (`category`),
  KEY `health_promotion_categories_order_index` (`order`),
  KEY `health_promotion_categories_active_index` (`active`),
  CONSTRAINT `health_promotion_categories_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `health_promotion_categories_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `health_promotion_categories_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `health_promotion_categories`
--

LOCK TABLES `health_promotion_categories` WRITE;
/*!40000 ALTER TABLE `health_promotion_categories` DISABLE KEYS */;
INSERT INTO `health_promotion_categories` VALUES (8,3,'early_childhood','Primera Infancia',NULL,NULL,1,1,1,NULL,'2026-03-30 08:47:30','2026-03-30 08:47:30'),(9,3,'women','Mujer',NULL,NULL,2,1,1,NULL,'2026-03-30 08:47:40','2026-03-30 08:47:40'),(10,3,'workers','Trabajadores',NULL,NULL,3,1,1,NULL,'2026-03-30 08:47:51','2026-03-30 08:47:51'),(11,3,'childhood','Niñez, adolescencia y juventud',NULL,NULL,4,1,1,NULL,'2026-03-30 08:48:06','2026-03-30 08:48:06');
/*!40000 ALTER TABLE `health_promotion_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `health_promotion_items`
--

DROP TABLE IF EXISTS `health_promotion_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `health_promotion_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `order` int unsigned NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `health_promotion_items_created_by_foreign` (`created_by`),
  KEY `health_promotion_items_updated_by_foreign` (`updated_by`),
  KEY `health_promotion_items_category_id_index` (`category_id`),
  KEY `health_promotion_items_order_index` (`order`),
  KEY `health_promotion_items_active_index` (`active`),
  CONSTRAINT `health_promotion_items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `health_promotion_categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `health_promotion_items_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `health_promotion_items_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `health_promotion_items`
--

LOCK TABLES `health_promotion_items` WRITE;
/*!40000 ALTER TABLE `health_promotion_items` DISABLE KEYS */;
INSERT INTO `health_promotion_items` VALUES (23,9,'LACTANTE','LACTANTELACTANTELACTANTELACTANTELACTANTE',1,1,1,NULL,NULL,'2026-03-30 08:48:30','2026-03-30 08:48:30'),(24,8,'LACTANTE','LACTANTELACTANTELACTANTELACTANTELACTANTE',1,1,1,NULL,NULL,'2026-03-30 08:48:42','2026-03-30 08:48:42'),(25,10,'LACTANTE','LACTANTELACTANTELACTANTELACTANTELACTANTELACTANTELACTANTELACTANTELACTANTE',1,1,1,NULL,NULL,'2026-03-30 08:48:55','2026-03-30 08:48:55'),(26,11,'LACTANTE','LACTANTELACTANTELACTANTELACTANTELACTANTELACTANTELACTANTE',1,1,1,NULL,NULL,'2026-03-30 08:49:09','2026-03-30 08:49:09'),(27,9,'lorem insup','LACTANTELACTANTELACTANTELACTANTELACTANTE',2,1,1,NULL,NULL,'2026-03-30 08:49:41','2026-03-30 08:49:41'),(28,10,'futbol','parquesparquesparquesparquesparques',2,1,1,NULL,NULL,'2026-03-30 08:50:06','2026-03-30 08:50:06'),(29,8,'juegos','parquesparquesparques',2,1,1,NULL,NULL,'2026-03-30 08:50:27','2026-03-30 08:50:27'),(30,11,'carros','lo que se les ocurra',2,1,1,NULL,NULL,'2026-03-30 08:50:54','2026-03-30 08:50:54');
/*!40000 ALTER TABLE `health_promotion_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `home_cards`
--

DROP TABLE IF EXISTS `home_cards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `home_cards` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('pdf','url') COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Ver más',
  `order` int unsigned NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `home_cards_order_unique` (`order`),
  KEY `home_cards_estado_index` (`estado`),
  KEY `home_cards_order_index` (`order`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `home_cards`
--

LOCK TABLES `home_cards` WRITE;
/*!40000 ALTER TABLE `home_cards` DISABLE KEYS */;
INSERT INTO `home_cards` VALUES (1,'Cursos y Formación','home-cards/icons/01KN10701SZTSFEVDFY297D4PM.png','Explora nuestro portafolio de cursos, diplomados y programas de formación continua en salud pública, bienestar comunitario y educación para la.','url',NULL,'https://www.fundacionproinapsauis.org/','Ver cursos',1,1,'2026-03-09 05:51:52','2026-03-31 08:50:18'),(2,'DATOS RANDON','home-cards/icons/01KN10AJX8ZGVQA23WEJX9GBSY.png','Consulta nuestra política de tratamiento de datos personales y privacidad. Conoce cómo protegemos tu información y cuáles son tus derechos como.','pdf','home-cards/pdfs/01KMBC7H0YWHWJ1J568C2Z75Q1.pdf',NULL,'Descargar PDF',2,1,'2026-03-09 05:51:52','2026-03-31 08:52:16'),(5,'BOLETIN','home-cards/icons/01KN105V4EN1S4MN8C0A7Z5HG8.png','Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industri','pdf','home-cards/pdfs/01KN105V4K99RAT18HNQSBZ74M.pdf',NULL,'Ver más',3,1,'2026-03-31 08:49:41','2026-03-31 08:49:41');
/*!40000 ALTER TABLE `home_cards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `institutional_resources`
--

DROP TABLE IF EXISTS `institutional_resources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `institutional_resources` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('interest_link','partner') COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int unsigned NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `institutional_resources_created_by_foreign` (`created_by`),
  KEY `institutional_resources_updated_by_foreign` (`updated_by`),
  KEY `institutional_resources_type_index` (`type`),
  KEY `institutional_resources_order_index` (`order`),
  KEY `institutional_resources_active_index` (`active`),
  CONSTRAINT `institutional_resources_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `institutional_resources_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `institutional_resources`
--

LOCK TABLES `institutional_resources` WRITE;
/*!40000 ALTER TABLE `institutional_resources` DISABLE KEYS */;
INSERT INTO `institutional_resources` VALUES (1,'interest_link','Ministerio de Salud y Protección Social','https://www.minsalud.gov.co',NULL,NULL,1,1,NULL,NULL,NULL,'2026-03-10 07:11:31','2026-03-10 07:11:31'),(2,'interest_link','Instituto Nacional de Salud (INS)','https://www.ins.gov.co',NULL,NULL,2,1,NULL,NULL,NULL,'2026-03-10 07:11:32','2026-03-10 07:11:32'),(3,'interest_link','Organización Panamericana de la Salud (OPS/OMS)','https://www.paho.org/es',NULL,NULL,3,1,NULL,NULL,NULL,'2026-03-10 07:11:32','2026-03-10 07:11:32'),(4,'interest_link','ICBF - Instituto Colombiano de Bienestar Familiar','https://www.icbf.gov.co',NULL,NULL,4,1,NULL,NULL,NULL,'2026-03-10 07:11:32','2026-03-10 07:11:32'),(5,'interest_link','Minciencias - Ministerio de Ciencia y Tecnología','https://minciencias.gov.co',NULL,NULL,5,1,NULL,NULL,NULL,'2026-03-10 07:11:32','2026-03-10 07:11:32'),(6,'interest_link','Secretaría de Salud de Antioquia','https://www.dssa.gov.co',NULL,NULL,6,1,NULL,NULL,NULL,'2026-03-10 07:11:32','2026-03-10 07:11:32'),(7,'partner',NULL,NULL,'Universidad de Antioquia','partners/logos/01KN10NDHQBKA535J9XFAXRDYY.png',1,1,NULL,4,NULL,'2026-03-10 07:11:32','2026-03-31 08:58:11'),(8,'partner',NULL,NULL,'Gobernación de Antioquia','partners/logos/01KN10RRX0ZH1GXXX6ESQF2WGM.png',2,1,NULL,4,NULL,'2026-03-10 07:11:32','2026-03-31 09:00:01'),(9,'partner',NULL,NULL,'Alcaldía de Medellín','partners/logos/01KN10S7DZ5HRB4QASAJ4E5PFP.png',3,1,NULL,4,NULL,'2026-03-10 07:11:32','2026-03-31 09:00:16'),(10,'partner',NULL,NULL,'Corporación Universitaria Minuto de Dios','partners/logos/01KN10SN6BE855CTKFTM2MFAPE.png',4,1,NULL,4,NULL,'2026-03-10 07:11:32','2026-03-31 09:00:30'),(11,'partner',NULL,NULL,'Fundación Saldarriaga Concha','partners/logos/01KN10T9BD8A43FGF1H3JQX076.png',5,1,NULL,4,NULL,'2026-03-10 07:11:32','2026-03-31 09:00:51'),(12,'interest_link','LACTANTE','https://www.twitch.tv/',NULL,NULL,7,1,4,NULL,NULL,'2026-03-31 09:13:28','2026-03-31 09:13:28'),(13,'interest_link','Proyeccion social1','https://www.twitch.tv/',NULL,NULL,8,1,4,NULL,NULL,'2026-03-31 09:13:38','2026-03-31 09:13:38'),(14,'interest_link','lo que sea','https://www.twitch.tv/',NULL,NULL,9,1,4,NULL,NULL,'2026-03-31 09:13:48','2026-03-31 09:13:48'),(15,'interest_link','lorem insup','https://www.twitch.tv/',NULL,NULL,10,1,4,NULL,NULL,'2026-03-31 09:14:07','2026-03-31 09:14:07'),(16,'partner',NULL,NULL,'SuperAdmin','partners/logos/01KN11K9672CJ49FTQ89PSY3FQ.png',6,1,4,NULL,NULL,'2026-03-31 09:14:30','2026-03-31 09:14:30');
/*!40000 ALTER TABLE `institutional_resources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2026_02_01_210950_create_permission_tables',1),(6,'2026_02_04_010532_create_banners_table',1),(7,'2026_02_04_220802_create_companies_table',1),(8,'2026_02_04_230731_add_campos_to_tabla_table',1),(9,'2026_02_04_234657_add_campos_longitud_latitud',1),(10,'2026_02_05_000712_create_teams_table',1),(11,'2026_02_05_004145_add_logo_favicon',1),(12,'2026_02_05_013817_update_mission_vision_images_in_companies_table',1),(13,'2026_02_05_060742_create_values_table',1),(14,'2026_02_06_214256_create_repository_categories_table',1),(15,'2026_02_06_214333_create_repository_documents_table',1),(16,'2026_02_10_001806_add_field',1),(17,'2026_02_11_002940_create_home_card_table',1),(18,'2026_02_14_215649_create_areas_table',1),(19,'2026_02_14_215723_create_formal_education_sections_table',1),(20,'2026_02_14_215753_create_courses_table',1),(21,'2026_02_14_215815_create_educational_materials_table',1),(22,'2026_02_14_215842_create_publications_table',1),(23,'2026_02_14_215917_create_research_group_table',1),(24,'2026_02_14_215935_create_health_promotion_categories_table',1),(25,'2026_02_14_220019_create_health_promotion_items_table',1),(26,'2026_02_17_013513_create_institutional_resources_table',1),(27,'2026_02_28_000000_add_coordinator_id_to_areas_table',1),(28,'2026_02_28_100000_create_testimonials_table',1),(29,'2026_02_28_200000_move_research_lines_to_research_group_table',1),(30,'2026_02_28_300000_add_trajectory_methodology_to_companies_table',1),(31,'2026_02_28_400000_create_news_table',1),(32,'2026_02_28_500000_create_research_lines_table',1),(33,'2026_03_09_005236_increase_courses_title_length',2),(34,'2026_03_09_005453_increase_publications_title_length',2),(35,'2026_03_10_013049_add_slug_to_news_table',2),(36,'2026_03_10_015048_add_slug_to_repository_categories_table',2),(37,'2026_03_10_020917_increase_health_promotion_items_short_description_length',3),(38,'2026_03_10_034318_add_image_to_areas_table',4),(39,'2026_03_10_042638_add_profesion_to_teams_table',5),(40,'2026_03_10_000001_add_descriptions_to_areas_table',6),(41,'2026_03_10_000002_create_educational_material_groups_table',6),(42,'2026_03_10_000003_update_short_description_in_educational_materials_table',6),(43,'2026_03_10_000004_update_educational_material_groups_add_icon_color_slug',7),(44,'2026_03_10_000005_add_order_to_educational_material_groups_table',8),(45,'2026_03_10_000006_simplify_formal_education_sections_table',9),(46,'2026_03_10_000007_add_access_conditions_to_formal_education_sections',10),(47,'2026_03_10_000008_add_icons_and_colors_to_areas_table',11),(48,'2026_03_10_000009_rename_education_icons_to_images_in_areas',12),(49,'2026_03_21_000001_make_full_description_nullable_in_educational_materials',13),(50,'2026_03_21_000002_add_slug_to_courses_table',14),(51,'2026_03_21_000003_remove_gallery_columns_from_courses',15),(52,'2026_03_21_000004_remove_mini_description_from_research_groups',16),(53,'2026_03_21_000005_fix_publications_table',17),(54,'2026_03_23_214242_add_icon_to_home_cards_table',18),(55,'2026_03_29_184250_add_logo_to_areas_table',19),(56,'2026_03_29_184821_add_display_name_to_educational_material_groups_table',20),(57,'2026_03_29_225924_add_image_to_values_table',21),(58,'2026_03_29_232419_add_slug_to_teams_table',22),(59,'2026_03_29_233831_add_women_to_educational_materials_category_enum',23),(60,'2026_03_29_234646_add_unique_name_to_teams_table',24),(61,'2026_03_30_001550_update_values_image_to_companies_table',25),(62,'2026_03_30_002149_make_image_nullable_in_health_promotion_categories',26),(63,'2026_03_30_020719_standardize_educational_materials_category',27),(64,'2026_03_30_023235_simplify_educational_material_groups',28),(65,'2026_03_30_030000_add_group_id_to_educational_materials',29);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(1,'App\\Models\\User',4),(2,'App\\Models\\User',6);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `news` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int unsigned NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `news_slug_unique` (`slug`),
  KEY `news_created_by_foreign` (`created_by`),
  KEY `news_updated_by_foreign` (`updated_by`),
  KEY `news_order_index` (`order`),
  KEY `news_active_index` (`active`),
  CONSTRAINT `news_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `news_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,'Proinapsa lanza nueva cohorte del Diplomado en Salud Mental Comu','proinapsa-lanza-nueva-cohorte-del-diplomado-en-salud-mental-comu','El Instituto Proinapsa abre inscripciones para la quinta cohorte de su reconocido Diplomado en Salud Mental Comunitaria, con cupos limitados y modalidad híbrida.','<p>El <strong>Instituto Proinapsa</strong> se complace en anunciar la apertura de inscripciones para la quinta cohorte del <em>Diplomado en Salud Mental Comunitaria</em>, uno de los programas de formación más reconocidos de la institución.</p><p>Este diplomado está dirigido a profesionales de la salud, trabajo social, psicología y ciencias humanas que deseen profundizar en estrategias de intervención en salud mental con enfoque comunitario. La formación tiene una duración de 6 meses, se desarrolla en modalidad híbrida y cuenta con el aval académico de instituciones de educación superior aliadas.</p><p>Entre los módulos del programa se incluyen: <strong>fundamentos de salud mental comunitaria</strong>, intervención en crisis, redes de apoyo social, salud mental y derechos humanos, y gestión de programas en salud mental.</p><p>Las inscripciones están abiertas hasta el 30 de abril. Para más información, comuníquese con nosotros a través de nuestro correo institucional o visítenos en nuestras instalaciones.</p>','news/images/01KME8FMCG1R92EBHNMMKSGCC0.jpg',1,1,NULL,1,'2026-03-09 05:51:52','2026-03-24 02:09:16'),(2,'Resultados del estudio sobre bienestar psicológico en primera infancia antioqueña',NULL,'Investigadores de Proinapsa presentaron los resultados de un estudio de dos años sobre factores protectores del bienestar psicológico en niños de 0 a 6 años en zonas rurales de Antioquia.','<p>El equipo de investigación del <strong>Instituto Proinapsa</strong> presentó los resultados de un estudio de dos años titulado <em>\"Factores protectores del bienestar psicológico en primera infancia en zonas rurales de Antioquia\"</em>, financiado por el Sistema General de Regalías.</p><p>La investigación, que involucró a 847 familias de 12 municipios del departamento, identificó que el <strong>vínculo afectivo seguro</strong> con los cuidadores principales, el acceso a espacios de juego y las redes de apoyo comunitario son los principales factores protectores del desarrollo socioemocional en los primeros años de vida.</p><p>Los resultados han sido publicados en la <em>Revista Colombiana de Salud Pública</em> y servirán de insumo para el diseño de políticas públicas de infancia en el departamento de Antioquia.</p><p>La presentación de resultados contó con la participación de representantes de la Gobernación de Antioquia, el ICBF regional y organizaciones de la sociedad civil.</p>','news/images/01KME8E60GA8ND4M643F3RWKY1.jpg',2,1,NULL,1,'2026-03-09 05:51:52','2026-03-24 02:08:28'),(3,'Jornada de promoción de la salud llegó a 5 comunidades rurales de Antioquia',NULL,'El equipo de Proyección Social del Instituto Proinapsa realizó jornadas de salud gratuitas en 5 municipios de Antioquia, atendiendo a más de 1.200 personas.','<p>Durante los últimos tres meses, el equipo de <strong>Proyección Social</strong> del Instituto Proinapsa realizó jornadas de promoción de la salud en los municipios de Ituango, Briceño, Valdivia, Tarazá y Caucasia, en el norte de Antioquia.</p><p>Las jornadas, completamente gratuitas, incluyeron actividades de <strong>tamizaje de salud mental</strong>, talleres de habilidades para la vida, charlas sobre nutrición y hábitos saludables, y sesiones de orientación psicosocial para familias.</p><p>En total, más de <em>1.200 personas</em> se beneficiaron de estas actividades, entre ellas mujeres gestantes, madres lactantes, niños y adultos mayores. Las jornadas contaron con el apoyo de las alcaldías municipales y centros de salud locales.</p><p>\"Estas comunidades tienen una gran capacidad de resiliencia pero también necesidades urgentes de atención en salud mental y bienestar\", señaló la Coordinadora de Proyección Social del instituto.</p>','news/images/01KME8RTDZ1K6M9K3XW5FNMAQR.jpg',3,1,NULL,1,'2026-03-09 05:51:52','2026-03-24 02:14:17'),(4,'Proinapsa firma convenio con la Universidad de Antioquia para fortalecer la investigación',NULL,'El Instituto Proinapsa y la Facultad de Salud Pública de la Universidad de Antioquia firmaron un convenio de cooperación académica e investigativa por tres años.','<p>En un acto solemne celebrado en el auditorio principal del Instituto Proinapsa, se firmó un <strong>Convenio de Cooperación Académica e Investigativa</strong> entre el instituto y la Facultad Nacional de Salud Pública de la Universidad de Antioquia.</p><p>Este convenio, con una vigencia de tres años, contempla la <strong>coinvestigación en proyectos de salud pública</strong>, la movilidad docente entre ambas instituciones, el intercambio de publicaciones científicas y la oferta de programas de formación conjuntos.</p><p>El rector del Instituto Proinapsa destacó que \"este convenio nos permite articular el conocimiento científico de la universidad con nuestra experiencia en territorio, generando una sinergia que beneficiará directamente a las comunidades\". Por su parte, el decano de la facultad subrayó la importancia de fortalecer los vínculos entre la academia y las organizaciones de la sociedad civil en el campo de la salud.</p><p>Como primer producto de la alianza, se desarrollará conjuntamente un estudio sobre salud mental en trabajadores del sector informal de Medellín.</p>','news/images/01KME8SW0MEKFS57EMEARCFEWC.jpg',4,1,NULL,1,'2026-03-09 05:51:52','2026-03-24 02:14:51'),(5,'Lanzamiento de guía de actividades lúdicas para el desarrollo infantil',NULL,'El área de Educación y Comunicación de Proinapsa presentó una nueva guía de actividades lúdicas diseñada para promover el desarrollo cognitivo, emocional y social en niños de 3 a 8 años.','<p>El área de <strong>Educación y Comunicación</strong> del Instituto Proinapsa presentó oficialmente la publicación de la <em>Guía de Actividades Lúdicas para el Desarrollo Infantil Integral</em>, un material educativo diseñado para padres, cuidadores y docentes de primera infancia.</p><p>La guía, disponible de forma gratuita en el repositorio documental del instituto, contiene más de <strong>60 actividades lúdicas</strong> clasificadas por rango de edad (3-5 años y 6-8 años) y por área de desarrollo: cognitiva, socioemocional, motriz y comunicativa.</p><p>Cada actividad incluye descripción, materiales necesarios, instrucciones paso a paso y pautas de evaluación del desarrollo. El material fue desarrollado con el apoyo de psicólogos, pedagogos y trabajadores sociales del equipo de Proinapsa.</p><p>\"Esta guía es el resultado de años de trabajo directo con familias y comunidades. Quisimos condensar ese conocimiento en una herramienta práctica y accesible para todos\", explicó la coordinadora del proyecto.</p>','news/images/01KME8TV5MZQ1N6A68JR2S26SD.jpg',5,1,NULL,1,'2026-03-09 05:51:52','2026-03-24 02:15:23'),(6,'Proinapsa participa en el XIII Congreso Colombiano de Salud Pública',NULL,'Investigadores y docentes del Instituto Proinapsa presentaron tres ponencias en el Congreso Colombiano de Salud Pública, celebrado en Bogotá.','<p>Del 15 al 18 de octubre, representantes del <strong>Instituto Proinapsa</strong> participaron en el <em>XIII Congreso Colombiano de Salud Pública</em>, celebrado en el Centro de Convenciones de Bogotá con la participación de más de 2.000 profesionales del sector.</p><p>El instituto presentó <strong>tres ponencias</strong> en diferentes ejes temáticos del congreso:<br>1. <em>\"Intervención psicosocial en comunidades afectadas por el conflicto armado en Antioquia\"</em><br>2. <em>\"Indicadores de bienestar en primera infancia: una propuesta de medición comunitaria\"</em><br>3. <em>\"Educación para la salud con enfoque intercultural en comunidades rurales\"</em></p><p>Las ponencias recibieron una valoración muy positiva por parte de los asistentes y el comité científico del congreso. La participación de Proinapsa en este evento reafirma su posicionamiento como una institución de referencia en salud pública a nivel nacional.</p>','news/images/01KME8WAWCQAV04N846YTQBVZT.jpg',6,1,NULL,1,'2026-03-09 05:51:52','2026-03-24 02:16:12'),(7,'Nuevo programa de apoyo psicológico para mujeres trabajadoras en situación de vulnerabilidad',NULL,'Proinapsa pone en marcha un programa gratuito de atención psicológica y orientación social para mujeres trabajadoras en situación de vulnerabilidad en Medellín.','<p>El Instituto Proinapsa, en alianza con la Secretaría de las Mujeres de la Alcaldía de Medellín, pone en marcha el programa <em>\"Mujeres Fuertes: Bienestar y Autonomía\"</em>, una iniciativa de atención psicológica y orientación social completamente gratuita para mujeres trabajadoras en situación de vulnerabilidad.</p><p>El programa ofrece <strong>atención psicológica individual y grupal</strong>, talleres de empoderamiento económico, orientación jurídica básica y acompañamiento en la creación de redes de apoyo entre mujeres. Está dirigido especialmente a mujeres cabezas de hogar, víctimas del conflicto armado y trabajadoras del sector informal.</p><p>Las inscripciones están abiertas en las instalaciones del instituto y en las Casas de Justicia de los barrios La Candelaria, Manrique y Belén. Los cupos son limitados.</p><p>\"Este programa es una respuesta concreta a las necesidades que identificamos en nuestros años de trabajo comunitario con mujeres\", afirmó la directora del instituto.</p>','news/images/01KME8XAWYESNXT7CSCFA35AQ3.jpg',7,1,NULL,1,'2026-03-09 05:51:52','2026-03-24 02:16:45'),(8,'Convocatoria abierta: Curso de Estrategias de Intervención Comunitaria en Salud',NULL,'Proinapsa abre inscripciones para el curso \"Estrategias de Intervención Comunitaria en Salud\", con modalidad virtual y certificado de participación.','<p>El Instituto Proinapsa tiene el placer de anunciar la apertura de inscripciones para el curso <strong>\"Estrategias de Intervención Comunitaria en Salud\"</strong>, dirigido a profesionales y técnicos de las áreas de salud, trabajo social, educación y desarrollo comunitario.</p><p>Este curso de <strong>80 horas</strong> se desarrollará en modalidad completamente virtual, con clases en vivo los jueves y viernes de 6:00 p.m. a 9:00 p.m. a partir del próximo mes. Los contenidos incluyen:</p><ul><li>Marco conceptual de la intervención comunitaria en salud</li><li>Diagnóstico participativo y mapeo de actores</li><li>Diseño y gestión de proyectos de salud comunitaria</li><li>Comunicación para el cambio de comportamiento</li><li>Evaluación y sistematización de experiencias</li></ul><p>Al finalizar, los participantes recibirán un certificado de participación avalado por el Instituto Proinapsa. El valor de inscripción incluye acceso a todos los materiales del curso, grabación de las sesiones y tutoría virtual.</p>','news/images/01KME8Y5BX0GKFP073GC73ZVFT.jpg',8,1,NULL,1,'2026-03-09 05:51:52','2026-03-24 02:17:12'),(9,'Publicación de nuevos materiales educativos digitales para adolescentes',NULL,'El área de Educación de Proinapsa presenta tres nuevos materiales educativos digitales dirigidos a adolescentes sobre salud sexual, salud mental y hábitos saludables.','<p>El área de <strong>Educación y Comunicación</strong> del Instituto Proinapsa lanza tres nuevos materiales educativos digitales diseñados especialmente para adolescentes entre 12 y 17 años:</p><p><strong>1. \"Hablemos de Salud Sexual con Respeto\"</strong>: Guía interactiva sobre salud sexual y reproductiva desde una perspectiva de derechos, que aborda temas como consentimiento, identidad de género, métodos anticonceptivos y prevención de ITS.</p><p><strong>2. \"Mi Mente también Importa\"</strong>: Material de psicoeducación sobre salud mental adolescente, que incluye información sobre ansiedad, depresión, autolesiones y dónde buscar ayuda.</p><p><strong>3. \"Rutinas que me Cuidan\"</strong>: Guía práctica sobre hábitos saludables en la adolescencia: sueño, alimentación, actividad física y uso responsable de pantallas.</p><p>Todos los materiales están disponibles de forma gratuita en el repositorio del instituto y pueden ser descargados por docentes, orientadores escolares y padres de familia.</p>','news/images/01KME8ZHH6MNTQ59YBDMMFT76D.jpg',9,1,NULL,1,'2026-03-09 05:51:52','2026-03-24 02:17:57'),(10,'Proinapsa capacita a 200 trabajadores de la salud en gestión del estrés laboral',NULL,'A través de un programa intensivo de tres meses, el Instituto Proinapsa capacitó a 200 profesionales de la salud en estrategias de gestión del estrés y autocuidado.','<p>En el marco del programa de <strong>Bienestar para Profesionales de la Salud</strong>, el Instituto Proinapsa completó exitosamente el proceso de capacitación de 200 trabajadores del sector salud en estrategias de gestión del estrés laboral y autocuidado.</p><p>El programa, desarrollado en alianza con tres instituciones hospitalarias de Medellín, tuvo una duración de tres meses e incluyó sesiones presenciales de taller, consulta psicológica individual y herramientas de seguimiento virtual.</p><p>Los participantes, entre los que se contaban médicos, enfermeros, auxiliares de enfermería y técnicos de diferentes servicios, reportaron una <strong>reducción significativa en los niveles de burnout</strong> y una mejora en la percepción de bienestar general al finalizar el proceso.</p><p>\"El personal de salud cuida a los demás, pero también necesita ser cuidado. Este programa es nuestra contribución a ese propósito\", afirmó el psicólogo coordinador del proceso en el instituto.</p>','news/images/01KME905YYQT9DKSQSHTNB63R4.jpg',10,1,NULL,1,'2026-03-09 05:51:52','2026-03-24 02:18:18'),(11,'Proinapsa lanza nueva cohorte del Diplomado en Salud Mental Comunitaria','proinapsa-lanza-nueva-cohorte-del-diplomado-en-salud-mental-comunitaria','El Instituto Proinapsa abre inscripciones para la quinta cohorte de su reconocido Diplomado en Salud Mental Comunitaria, con cupos limitados y modalidad híbrida.','<p>El <strong>Instituto Proinapsa</strong> se complace en anunciar la apertura de inscripciones para la quinta cohorte del <em>Diplomado en Salud Mental Comunitaria</em>, uno de los programas de formación más reconocidos de la institución.</p><p>Este diplomado está dirigido a profesionales de la salud, trabajo social, psicología y ciencias humanas que deseen profundizar en estrategias de intervención en salud mental con enfoque comunitario. La formación tiene una duración de 6 meses, se desarrolla en modalidad híbrida y cuenta con el aval académico de instituciones de educación superior aliadas.</p><p>Entre los módulos del programa se incluyen: <strong>fundamentos de salud mental comunitaria</strong>, intervención en crisis, redes de apoyo social, salud mental y derechos humanos, y gestión de programas en salud mental.</p><p>Las inscripciones están abiertas hasta el 30 de abril. Para más información, comuníquese con nosotros a través de nuestro correo institucional o visítenos en nuestras instalaciones.</p>','news/images/01KME8D66PE00FNVYV1DVSR7PF.png',13,1,NULL,1,'2026-03-22 00:29:38','2026-03-24 02:07:56'),(12,'Jornada de innovación fortalece la transformación digital','proinapsa-es-pionera-en-instituciones-en-rpomocion-para-la-salud','Hay muchas variaciones de los pasajes de Lorem Ipsum disponibles, pero la mayoría sufrió alteraciones en alguna manera, ya sea porque se le agregó humor, o palabras aleatorias que no parecen ni un poco creíbles.','<p>Una iniciativa orientada al uso de herramientas tecnológicas y mejora de procesos reunió a equipos de distintas áreas para impulsar la eficiencia, la colaboración y la adaptación al cambio.</p><ul><li>&nbsp;Se promovieron buenas prácticas en transformación digital y gestión de procesos.&nbsp;</li><li>&nbsp;La jornada permitió identificar oportunidades de mejora en distintas áreas.&nbsp;</li><li>&nbsp;Se resaltó la importancia de la innovación como motor de crecimiento institucional.&nbsp;</li><li>&nbsp;Los participantes adquirieron herramientas para optimizar tiempos y recursos.&nbsp;</li></ul><p>En una apuesta por la modernización y el fortalecimiento institucional, diversas organizaciones participaron en una jornada enfocada en innovación, transformación digital y mejora continua, con el propósito de impulsar procesos más eficientes, colaborativos y alineados con las necesidades actuales del entorno. La actividad reunió a equipos de trabajo de distintas áreas, quienes analizaron retos operativos, compartieron experiencias y revisaron estrategias orientadas a optimizar la gestión interna.</p><p>Durante el encuentro se abordaron temas relacionados con el uso de herramientas tecnológicas, automatización de tareas, organización de la información y fortalecimiento de capacidades para la toma de decisiones. Asimismo, se destacó la importancia de adaptar los procesos a escenarios cada vez más dinámicos, en los que la agilidad, la trazabilidad y la capacidad de respuesta se convierten en factores clave para garantizar mejores resultados.</p><h3>Por ejemplo cuando murio jorge elicer gaitan</h3><p>Los asistentes señalaron que este tipo de espacios no solo permiten actualizar conocimientos, sino también identificar oportunidades concretas de mejora dentro de sus áreas de trabajo. Entre los principales beneficios identificados se encuentran la reducción de tiempos en actividades repetitivas, mayor claridad en los flujos de trabajo, mejor control de la información y una gestión más articulada entre equipos.</p><p>De igual forma, se hizo énfasis en que la innovación no depende únicamente de la incorporación de nuevas tecnologías, sino también de una cultura organizacional dispuesta al cambio, al aprendizaje constante y a la revisión crítica de sus propios procesos. En este sentido, la jornada sirvió como escenario para reflexionar sobre la importancia de fortalecer las competencias del talento humano y promover iniciativas que generen impacto real en la operación.</p><p>Los organizadores destacaron que este tipo de actividades hacen parte de una visión orientada al crecimiento sostenible, la mejora del servicio y la consolidación de prácticas más modernas y efectivas. También indicaron que los aprendizajes obtenidos permitirán definir nuevas acciones de fortalecimiento, con miras a consolidar procesos más ágiles, estructurados y centrados en resultados.</p><p>Con este tipo de espacios, las organizaciones reafirman su compromiso con la mejora continua y con la construcción de entornos de trabajo más preparados para responder a los desafíos actuales, promoviendo una gestión más eficiente, innovadora y enfocada en la calidad.</p>','news/images/01KME9A17V75F29VSG075N5EJ9.png',14,1,1,1,'2026-03-24 02:23:41','2026-03-24 02:36:32'),(13,'el dia llovieron ranas','el-dia-llovieron-ranas','Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó\n','<h2><strong>Lorem Ipsum</strong>&nbsp;</h2><p><strong>Lorem Ipsum</strong> es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.</p><p><br><strong>Lorem Ipsum</strong> es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.</p><p><br><strong>Lorem Ipsum</strong> es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.</p><p><br></p><p><strong>Lorem Ipsum</strong> es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.</p><p><br><strong>Lorem Ipsum</strong> es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.</p><p><br><strong>Lorem Ipsum</strong> es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.</p><p><br><strong>Lorem Ipsum</strong> es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.</p><p><br><strong>Lorem Ipsum</strong> es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.</p><p><br><br></p><p><br><br></p>','news/images/01KMKV68T7JTT2NRFH8XCJS730.jpg',15,1,1,NULL,'2026-03-26 06:12:24','2026-03-26 06:12:24');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'createUser','web','2026-02-02 07:18:19','2026-02-02 07:18:19'),(2,'editUser','web','2026-02-02 07:18:34','2026-02-02 07:18:34'),(3,'listUsers','web','2026-02-02 07:18:58','2026-02-02 07:18:58'),(4,'deleteUser','web','2026-02-02 07:19:13','2026-02-02 07:19:13'),(5,'deleteBanner','web','2026-02-04 12:01:12','2026-02-04 12:01:12'),(6,'createBanner','web','2026-02-04 12:02:04','2026-02-04 12:02:04'),(7,'editBanner','web','2026-02-04 12:02:28','2026-02-04 12:02:28'),(8,'listBanner','web','2026-02-04 12:02:41','2026-02-04 12:02:41'),(9,'deleteCompany','web','2026-02-05 08:22:24','2026-02-05 08:22:24'),(10,'createCompany','web','2026-02-05 08:22:54','2026-02-05 08:22:54'),(11,'editCompany','web','2026-02-05 08:23:05','2026-02-05 08:23:05'),(12,'listCompany','web','2026-02-05 08:23:26','2026-02-05 08:23:26'),(13,'createTeam','web','2026-02-05 10:20:30','2026-02-05 10:20:30'),(14,'editTeam','web','2026-02-05 10:20:44','2026-02-05 10:20:44'),(15,'deleteTeam','web','2026-02-05 10:21:12','2026-02-05 10:21:12'),(16,'listTeam','web','2026-02-05 10:21:53','2026-02-05 10:21:53'),(17,'deleteValues','web','2026-02-05 16:15:44','2026-02-05 16:15:44'),(18,'createValues','web','2026-02-05 16:16:28','2026-02-05 16:16:28'),(19,'editValues','web','2026-02-05 16:16:41','2026-02-05 16:44:33'),(20,'listValues','web','2026-02-05 16:16:54','2026-02-05 16:16:54'),(21,'createArea','web','2026-02-05 18:06:18','2026-02-05 18:06:18'),(22,'deleteArea','web','2026-02-05 18:06:30','2026-02-05 18:06:30'),(23,'editArea','web','2026-02-05 18:06:44','2026-02-05 18:06:44'),(24,'listArea','web','2026-02-05 18:06:58','2026-02-05 18:06:58'),(43,'createPublication','web','2026-02-06 15:49:09','2026-02-06 15:49:09'),(44,'deletePublication','web','2026-02-06 15:49:27','2026-02-06 15:49:27'),(45,'editPublication','web','2026-02-06 15:49:38','2026-02-06 15:49:38'),(46,'listPublication','web','2026-02-06 15:50:00','2026-02-06 15:50:00'),(55,'createCourse','web','2026-02-06 16:34:55','2026-02-06 16:34:55'),(56,'deleteCourse','web','2026-02-06 16:35:06','2026-02-06 16:35:06'),(57,'editCourse','web','2026-02-06 16:35:19','2026-02-06 16:35:19'),(58,'listCourse','web','2026-02-06 16:35:30','2026-02-06 16:35:30'),(68,'deleteRepositoryCategory','web','2026-02-07 07:50:03','2026-02-07 07:50:03'),(69,'editRepositoryCategory','web','2026-02-07 07:50:14','2026-02-07 07:50:14'),(70,'listRepositoryCategory','web','2026-02-07 07:50:36','2026-02-07 07:50:36'),(72,'createRepositoryDocument','web','2026-02-07 07:51:12','2026-02-07 07:51:12'),(73,'deleteRepositoryDocument','web','2026-02-07 07:51:23','2026-02-07 07:51:23'),(74,'editRepositoryDocument','web','2026-02-07 07:51:40','2026-02-07 07:51:40'),(75,'listRepositoryDocument','web','2026-02-07 07:52:30','2026-02-07 07:52:30'),(76,'createHomeCard','web','2026-02-11 10:36:12','2026-02-11 10:36:12'),(77,'editHomeCard','web','2026-02-11 10:36:26','2026-02-11 10:36:26'),(78,'deleteHomeCard','web','2026-02-11 10:36:40','2026-02-11 10:36:40'),(79,'listHomeCard','web','2026-02-11 10:37:01','2026-02-11 10:37:01'),(80,'createFormalEducationSection','web','2026-02-17 10:40:49','2026-02-17 10:40:49'),(81,'deleteFormalEducationSection','web','2026-02-17 10:40:59','2026-02-17 10:40:59'),(82,'listFormalEducationSection','web','2026-02-17 10:41:10','2026-02-17 10:41:10'),(83,'editFormalEducationSection','web','2026-02-17 10:41:21','2026-02-17 10:41:21'),(84,'createEducationalMaterial','web','2026-02-17 10:41:41','2026-02-17 10:41:41'),(85,'deleteEducationalMaterial','web','2026-02-17 10:41:50','2026-02-17 10:41:50'),(86,'editEducationalMaterial','web','2026-02-17 10:42:01','2026-02-17 10:42:01'),(87,'listEducationalMaterial','web','2026-02-17 10:42:13','2026-02-17 10:42:13'),(88,'createHealthPromotionCategory','web','2026-02-17 10:42:33','2026-02-17 10:42:33'),(89,'deleteHealthPromotionCategory','web','2026-02-17 10:42:43','2026-02-17 10:42:43'),(90,'editHealthPromotionCategory','web','2026-02-17 10:42:54','2026-02-17 10:42:54'),(91,'listHealthPromotionCategory','web','2026-02-17 10:43:03','2026-02-17 10:43:03'),(92,'createHealthPromotionItem','web','2026-02-17 10:44:09','2026-02-17 10:44:09'),(93,'deleteHealthPromotionItem','web','2026-02-17 10:44:20','2026-02-17 10:44:20'),(94,'editHealthPromotionItem','web','2026-02-17 10:44:32','2026-02-17 10:44:32'),(95,'listHealthPromotionItem','web','2026-02-17 10:44:42','2026-02-17 10:44:42'),(96,'createResearchGroup','web','2026-02-17 10:45:56','2026-02-17 10:45:56'),(97,'deleteResearchGroup','web','2026-02-17 10:46:07','2026-02-17 10:46:07'),(98,'editResearchGroup','web','2026-02-17 10:46:18','2026-02-17 10:46:18'),(99,'listResearchGroup','web','2026-02-17 10:46:28','2026-02-17 10:46:28'),(100,'createRepositoryCategory','web','2026-02-17 12:24:21','2026-02-17 12:24:21'),(101,'createInstitutional','web','2026-02-17 12:27:30','2026-02-17 12:33:05'),(102,'deleteInstitutional','web','2026-02-17 12:27:41','2026-02-17 12:33:41'),(103,'editInstitutional','web','2026-02-17 12:27:52','2026-02-17 12:33:46'),(104,'listInstitutional','web','2026-02-17 12:28:04','2026-02-17 12:33:51'),(105,'createNews','web','2026-03-10 06:48:33','2026-03-10 06:48:33'),(106,'deleteNews','web','2026-03-10 06:49:14','2026-03-10 06:49:14'),(107,'listNews','web','2026-03-10 06:49:30','2026-03-10 06:49:30'),(108,'editNews','web','2026-03-10 06:49:43','2026-03-10 06:49:43');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publications`
--

DROP TABLE IF EXISTS `publications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `publications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `area_id` bigint unsigned NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `external_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `order` int unsigned NOT NULL DEFAULT '1',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `publications_title_unique` (`title`),
  KEY `publications_created_by_foreign` (`created_by`),
  KEY `publications_updated_by_foreign` (`updated_by`),
  KEY `publications_area_id_index` (`area_id`),
  KEY `publications_status_index` (`status`),
  KEY `publications_order_index` (`order`),
  CONSTRAINT `publications_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `publications_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `publications_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publications`
--

LOCK TABLES `publications` WRITE;
/*!40000 ALTER TABLE `publications` DISABLE KEYS */;
INSERT INTO `publications` VALUES (1,2,'Salud mental en adolescentes colombianos','Estudio transversal sobre la asociación entre el uso intensivo de redes sociales y la prevalencia de síntomas de ansiedad y depresión en adolescentes ','publications/images/01KMEKR5RJ0ERNQ7CRYYC1H75D.png','https://www.google.com/search?q=flor&ie=UTF-8','active',1,NULL,1,NULL,'2026-03-09 05:54:08','2026-03-24 05:26:10'),(2,2,'Factores protectores en el desarrollo de la primera infancia','Revisión sistemática de la literatura científica sobre los principales factores protectores del desarrollo integral en la primera infancia, con énfasi','placeholder.jpg','https://doi.org/10.1000/proinapsa.2023.002','active',2,NULL,NULL,NULL,'2026-03-10 07:09:01','2026-03-10 07:09:01'),(3,2,'Bienestar psicológico en trabajadores de la salud','Investigación cuantitativa sobre la prevalencia del burnout y los factores protectores del bienestar psicológico en 520 trabajadores del sector salud ','placeholder.jpg','https://doi.org/10.1000/proinapsa.2023.003','active',3,NULL,NULL,NULL,'2026-03-10 07:09:01','2026-03-10 07:09:01'),(4,2,'Educación para la salud con enfoque intercultural','Sistematización de experiencias de educación para la salud con enfoque intercultural desarrolladas en comunidades indígenas del Urabá antioqueño, anal','placeholder.jpg','https://doi.org/10.1000/proinapsa.2022.004','active',4,NULL,NULL,NULL,'2026-03-10 07:09:01','2026-03-10 07:09:01'),(5,2,'Intervención psicosocial en comunidades afectadas por el conflicto','Revisión sistemática de las intervenciones psicosociales desarrolladas en comunidades colombianas afectadas por el conflicto armado en el período posa','placeholder.jpg','https://doi.org/10.1000/proinapsa.2022.005','active',5,NULL,NULL,NULL,'2026-03-10 07:09:01','2026-03-10 07:09:01'),(6,2,'Promoción de hábitos alimentarios saludables en edad escolar','Estudio cuasiexperimental que evalúa la efectividad de un programa de promoción de hábitos alimentarios saludables implementado en 8 instituciones edu','placeholder.jpg','https://doi.org/10.1000/proinapsa.2022.006','active',6,NULL,NULL,NULL,'2026-03-10 07:09:01','2026-03-10 07:09:01'),(7,2,'Resiliencia comunitaria en mujeres rurales de Antioquia','Investigación cualitativa sobre las estrategias de resiliencia y afrontamiento del estrés en grupos de mujeres rurales de Antioquia, con especial aten','placeholder.jpg','https://doi.org/10.1000/proinapsa.2021.007','active',7,NULL,NULL,NULL,'2026-03-10 07:09:01','2026-03-10 07:09:01'),(8,2,'Indicadores de bienestar en primera infancia','Artículo metodológico que propone un sistema de indicadores de bienestar en primera infancia diseñado de manera participativa con comunidades rurales,','placeholder.jpg','https://doi.org/10.1000/proinapsa.2021.008','active',8,NULL,NULL,NULL,'2026-03-10 07:09:01','2026-03-10 07:09:01'),(9,2,'Gestión del estrés en entornos laborales modernos','Revisión narrativa de la literatura sobre la efectividad de las intervenciones basadas en mindfulness para la gestión del estrés en trabajadores de di','placeholder.jpg','https://doi.org/10.1000/proinapsa.2021.009','inactive',9,NULL,NULL,NULL,'2026-03-10 07:09:01','2026-03-10 07:09:01');
/*!40000 ALTER TABLE `publications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repository_categories`
--

DROP TABLE IF EXISTS `repository_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `repository_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `repository_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repository_categories`
--

LOCK TABLES `repository_categories` WRITE;
/*!40000 ALTER TABLE `repository_categories` DISABLE KEYS */;
INSERT INTO `repository_categories` VALUES (1,'educacion y comunicacion para la salud','educacion-y-comunicacion-para-la-salud','Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.','repository/categories/01KME7SBCH557JMA7MV38RRSGR.jpg',1,1,'2026-03-01 12:27:42','2026-03-24 01:57:06'),(6,'Municipios Saludables','municipios-saludables','Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.','repository/categories/01KME7QMJKFF7BDMC1Z9W4JSRJ.jpg',2,1,'2026-03-22 22:53:00','2026-03-24 01:56:10'),(7,'Promoción de la salud','promocion-de-la-salud','Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.','repository/categories/01KME7Q3X1QGMYJ1PH44QPQRZT.jpg',3,1,'2026-03-22 22:54:34','2026-03-24 01:55:52'),(8,'Educación integral de la sexualidad','educacion-integral-de-la-sexualidad','Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.','repository/categories/01KME7NT075VP5AZST5QM7G8DH.jpg',4,1,'2026-03-22 22:56:24','2026-03-24 01:55:10'),(9,'Gestión intersectorial','gestion-intersectorial','Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.','repository/categories/01KME7H9DJ1FFSGR2461TPXDTB.jpg',5,1,'2026-03-22 22:57:26','2026-03-24 01:52:42'),(10,'Convivencia y Ciudadanía','convivencia-y-ciudadania','Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.','repository/categories/01KME7N5FH6CZA0SZB937PZY9A.jpg',6,1,'2026-03-22 22:59:22','2026-03-24 01:54:49'),(11,'Artículos y otras Publicaciones','articulos-y-otras-publicaciones','Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum..','repository/categories/01KME7F7DQ17PKR55NRNNMSJN5.png',7,1,'2026-03-22 22:59:58','2026-03-24 01:51:34');
/*!40000 ALTER TABLE `repository_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repository_documents`
--

DROP TABLE IF EXISTS `repository_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `repository_documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `repository_category_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authors` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `topic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `repository_documents_repository_category_id_foreign` (`repository_category_id`),
  CONSTRAINT `repository_documents_repository_category_id_foreign` FOREIGN KEY (`repository_category_id`) REFERENCES `repository_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repository_documents`
--

LOCK TABLES `repository_documents` WRITE;
/*!40000 ALTER TABLE `repository_documents` DISABLE KEYS */;
INSERT INTO `repository_documents` VALUES (14,11,'Proyeccion social','Kevin Perez','lo que sea','Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original.','repository/images/01KMBBZ75X7KRR3XE5QC7N8MGT.jpg','repository/documents/01KMBBZ760R3MZHX0WR7VP1662.pdf',1,1,'2026-03-22 23:12:29','2026-03-22 23:12:29'),(15,11,'PRUEBA DE DOCUMENTOS','JULIO BOLAÑO','PROINAPSA 2026','Hay muchas variaciones de los pasajes de Lorem Ipsum disponibles, pero la mayoría sufrió alteraciones en alguna manera, ya sea porque se le agregó humor, o palabras aleatorias que no parecen ni un poco creíbles. Si vas a utilizar un pasaje de Lorem Ipsum, necesitás estar seguro de que no hay nada avergonzante escondido en el medio del texto. Todos los generadores de Lorem Ipsum que se encuentran en Internet tienden a repetir trozos predefinidos cuando sea necesario, haciendo a este el único generador verdadero (válido) en la Internet.','repository/images/01KME80SK7S97GW35GHF2NJP1Z.jpg','repository/documents/01KME80SKBM852YGCXB2YJ6WJ5.pdf',2,1,'2026-03-24 02:01:10','2026-03-24 02:01:10'),(16,11,'LACTANCIA MATERNA','KEVIN BECERRA','LACTACIA MATERNA','Hay muchas variaciones de los pasajes de Lorem Ipsum disponibles, pero la mayoría sufrió alteraciones en alguna manera, ya sea porque se le agregó humor, o palabras aleatorias que no parecen ni un poco creíbles. Si vas a utilizar un pasaje de Lorem Ipsum, necesitás estar seguro de que no hay nada avergonzante escondido en el medio del texto. Todos los generadores de Lorem Ipsum que se encuentran en Internet tienden a repetir trozos predefinidos cuando sea necesario, haciendo a este el único generador verdadero (válido) en la Internet. ','repository/images/01KME8349ZVSSPQ9KFQD14SR71.jpg','repository/documents/01KME834A4D0XP2RNBDZ8RM5EA.pdf',3,1,'2026-03-24 02:02:26','2026-03-24 02:02:26'),(17,11,'PREVENCION CONTRA EL VIH','PEPITO PEREZ','ETS','Hay muchas variaciones de los pasajes de Lorem Ipsum disponibles, pero la mayoría sufrió alteraciones en alguna manera, ya sea porque se le agregó humor, o palabras aleatorias que no parecen ni un poco creíbles. Si vas a utilizar un pasaje de Lorem Ipsum, necesitás estar seguro de que no hay nada avergonzante escondido en el medio del texto. Todos los generadores de Lorem Ipsum que se encuentran en Internet tienden a repetir trozos predefinidos cuando sea necesario, haciendo a este el único generador verdadero (válido) en la Internet. ','repository/images/01KME898C5AD8C62MD8K7YA08M.jpg','repository/documents/01KME898C7JR2DPBG2RSQVRYD0.pdf',4,1,'2026-03-24 02:03:36','2026-03-24 02:05:47'),(18,11,'boletines','ROCHY',NULL,'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\",','repository/images/01KMKVGET5GNB1F585JDM2YEYJ.jpg','repository/documents/01KMKVGET9P8CRWFCXYQZ4WSX7.pdf',5,1,'2026-03-26 06:17:58','2026-03-26 06:17:58');
/*!40000 ALTER TABLE `repository_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `research_group`
--

DROP TABLE IF EXISTS `research_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `research_group` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `area_id` bigint unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `research_group_created_by_foreign` (`created_by`),
  KEY `research_group_updated_by_foreign` (`updated_by`),
  KEY `research_group_area_id_index` (`area_id`),
  KEY `research_group_active_index` (`active`),
  CONSTRAINT `research_group_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `research_group_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `research_group_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `research_group`
--

LOCK TABLES `research_group` WRITE;
/*!40000 ALTER TABLE `research_group` DISABLE KEYS */;
INSERT INTO `research_group` VALUES (1,2,'Grupo de Investigación en Salud, Bienestar y Comunidad - GISBC','<h2>CATEGORIA B</h2><p>El <strong>Grupo de Investigación en Salud, Bienestar y Comunidad (GISBC)</strong> es el centro de producción científica del Instituto Proinapsa. Fundado en 2010, el grupo reúne a investigadores de diferentes disciplinas —psicología, salud pública, trabajo social, educación y medicina preventiva— en torno a preguntas comunes sobre la salud y el bienestar de las comunidades colombianas.</p><p>Nuestro enfoque investigativo es interdisciplinar, participativo y orientado al impacto social. Trabajamos con metodologías tanto cuantitativas como cualitativas, y privilegiamos la investigación en contextos reales, con y para las comunidades.</p><p>El GISBC está clasificado en la categoría B de Minciencias y cuenta con publicaciones en revistas indexadas nacionales e internacionales. Anualmente convocamos estudiantes de pregrado y posgrado para participar en nuestros semilleros y proyectos de investigación.</p>','https://scienti.minciencias.gov.co/grupos',1,NULL,1,'2026-03-10 07:09:01','2026-03-26 06:43:33');
/*!40000 ALTER TABLE `research_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `research_lines`
--

DROP TABLE IF EXISTS `research_lines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `research_lines` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `research_group_id` bigint unsigned NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `order` int unsigned NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `research_lines_research_group_id_foreign` (`research_group_id`),
  KEY `research_lines_order_index` (`order`),
  KEY `research_lines_active_index` (`active`),
  CONSTRAINT `research_lines_research_group_id_foreign` FOREIGN KEY (`research_group_id`) REFERENCES `research_group` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `research_lines`
--

LOCK TABLES `research_lines` WRITE;
/*!40000 ALTER TABLE `research_lines` DISABLE KEYS */;
INSERT INTO `research_lines` VALUES (1,1,'Salud Mental y Bienestar Psicosocial','Esta línea de investigación se centra en el estudio de los determinantes sociales de la salud mental, la prevalencia de trastornos mentales en diferentes grupos poblacionales y el desarrollo y evaluación de intervenciones psicosociales. Incluye investigación sobre burnout, resiliencia.',1,1,'2026-03-10 07:09:01','2026-03-22 04:09:14'),(2,1,'Educación para la Salud y Comunicación en Salud','Esta línea de investigación se centra en el estudio de los determinantes sociales de la salud mental, la prevalencia de trastornos mentales en diferentes grupos poblacionales y el desarrollo y evaluación de intervenciones psicosociales. Incluye investigación sobre burnout, resiliencia.',2,1,'2026-03-10 07:09:01','2026-03-22 04:09:14'),(3,1,'Salud en la Primera Infancia y Desarrollo Infantil','Esta línea de investigación se centra en el estudio de los determinantes sociales de la salud mental, la prevalencia de trastornos mentales en diferentes grupos poblacionales y el desarrollo y evaluación de intervenciones psicosociales. Incluye investigación sobre burnout, resiliencia.',3,1,'2026-03-10 07:09:01','2026-03-22 04:09:14'),(4,1,'Salud Laboral y Bienestar Ocupacional','Esta línea de investigación se centra en el estudio de los determinantes sociales de la salud mental, la prevalencia de trastornos mentales en diferentes grupos poblacionales y el desarrollo y evaluación de intervenciones psicosociales. Incluye investigación sobre burnout, resiliencia.',4,1,'2026-03-10 07:09:01','2026-03-22 04:09:14'),(5,1,'Intervención Comunitaria y Salud Pública','Esta línea de investigación se centra en el estudio de los determinantes sociales de la salud mental, la prevalencia de trastornos mentales en diferentes grupos poblacionales y el desarrollo y evaluación de intervenciones psicosociales. Incluye investigación sobre burnout, resiliencia.',5,1,'2026-03-10 07:09:01','2026-03-22 04:09:14');
/*!40000 ALTER TABLE `research_lines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(43,1),(44,1),(45,1),(46,1),(55,1),(56,1),(57,1),(58,1),(68,1),(69,1),(70,1),(72,1),(73,1),(74,1),(75,1),(76,1),(77,1),(78,1),(79,1),(80,1),(81,1),(82,1),(83,1),(84,1),(85,1),(86,1),(87,1),(88,1),(89,1),(90,1),(91,1),(92,1),(93,1),(94,1),(95,1),(96,1),(97,1),(98,1),(99,1),(100,1),(101,1),(102,1),(103,1),(104,1),(105,1),(106,1),(107,1),(108,1),(5,2),(6,2),(7,2),(8,2),(9,2),(10,2),(11,2),(12,2),(13,2),(14,2),(15,2),(16,2),(17,2),(18,2),(19,2),(20,2),(21,2),(22,2),(23,2),(24,2),(43,2),(44,2),(45,2),(46,2),(55,2),(56,2),(57,2),(58,2),(68,2),(69,2),(70,2),(72,2),(73,2),(74,2),(75,2),(76,2),(77,2),(78,2),(79,2),(80,2),(81,2),(82,2),(83,2),(84,2),(85,2),(86,2),(87,2),(88,2),(89,2),(90,2),(91,2),(92,2),(93,2),(94,2),(95,2),(96,2),(97,2),(98,2),(99,2),(100,2),(101,2),(102,2),(103,2),(104,2),(105,2),(106,2),(107,2),(108,2);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Super Admin','web','2026-02-02 06:58:55','2026-02-02 06:58:55'),(2,'Coordinador-Area','web','2026-02-02 06:58:55','2026-04-03 21:24:24');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teams` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profesion` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `teams_name_unique` (`name`),
  UNIQUE KEY `teams_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES (1,'Dra. María Elena González Ruiz','dra-maria-elena-gonzalez-ruiz','team/01KM8ZCZHKD8011DKMZMMYMK2V.jpg','Directora General','Psicóloga','Psicóloga especialista en Salud Mental y Bienestar Comunitario con más de 20 años de experiencia en instituciones de educación y promoción de la salud. Lidera los procesos estratégicos del instituto con enfoque en el desarrollo integral de las comunidades.',1,'2026-03-09 05:09:28','2026-03-30 04:42:06'),(2,'Esp. Carlos Alberto Martínez López','esp-carlos-alberto-martinez-lopez','team/01KMXZ1YD7VFH035RWBTRXA473.png','Coordinador de Investigación','Investigador en Salud Pública','Investigador en salud pública con amplia trayectoria en el diseño y ejecución de proyectos de investigación sobre promoción de la salud en contextos comunitarios e institucionales. Magíster en Epidemiología.',1,'2026-03-09 05:09:28','2026-03-30 04:32:21'),(3,'Lic. Ana Cristina Rodríguez Vargas','lic-ana-cristina-rodriguez-vargas','team/01KMDRBNMTNNDZSZMSS24K6EPZ.jpg','Coordinadora de Educación y Comunicación','Pedagoga y Comunicadora en Salud','Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian.',1,'2026-03-09 05:09:28','2026-03-23 21:27:29'),(4,'Lic. Laura Patricia Sánchez Moreno','lic-laura-patricia-sanchez-moreno','team/01KMYDX3P093974EPA7Y0XH09W.jpg','Coordinadora de Proyección Social','Trabajadora Social','Trabajadora social con enfoque en intervención comunitaria y promoción de derechos, especialmente en poblaciones vulnerables como primera infancia, niñez y mujeres. Coordina las estrategias de salud en territorio.',1,'2026-03-09 05:09:28','2026-03-30 08:51:51'),(5,'Psic. Juan David Pérez Hernández','psic-juan-david-perez-hernandez','placeholder.jpg','Psicólogo Institucional','Psicólogo','Psicólogo clínico y organizacional con experiencia en atención individual y grupal. Enfocado en el bienestar emocional y la salud mental de los diferentes grupos poblacionales atendidos por el instituto.',1,'2026-03-09 05:09:28','2026-03-22 00:29:38'),(6,'Ts. Diana Marcela López Castro','ts-diana-marcela-lopez-castro','placeholder.jpg','Trabajadora Social','Trabajadora Social','Profesional en Trabajo Social especializada en intervención familiar y comunitaria, con énfasis en la promoción de entornos saludables y el fortalecimiento de redes de apoyo en comunidades rurales y urbanas.',1,'2026-03-09 05:09:28','2026-03-22 00:29:38'),(7,'Enf. Roberto Andrés Castillo Mejía','enf-roberto-andres-castillo-mejia','placeholder.jpg','Profesional de Salud Pública','Enfermero Profesional','Enfermero profesional con especialización en Salud Pública y Promoción de la Salud. Lidera los programas de atención en salud para trabajadores y comunidades en general, con énfasis en prevención de enfermedades.',1,'2026-03-09 05:09:28','2026-03-22 00:29:38');
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testimonials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `testimonial` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` tinyint unsigned NOT NULL DEFAULT '5',
  `order` int unsigned NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `testimonials_created_by_foreign` (`created_by`),
  KEY `testimonials_updated_by_foreign` (`updated_by`),
  KEY `testimonials_order_index` (`order`),
  KEY `testimonials_active_index` (`active`),
  CONSTRAINT `testimonials_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `testimonials_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES (1,'kevin','INGENIERO DE SISTEMAS','Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando.',5,10,1,1,4,'2026-03-01 08:19:54','2026-03-31 08:54:03'),(2,'kevin','INGENIERO DE SISTEMAS','Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor',5,2,1,1,4,'2026-03-01 08:20:44','2026-03-31 08:56:05'),(3,'Sandra Milena Ospina','Participante del Diplomado en Salud Mental','El diplomado en Salud Mental superó todas mis expectativas. Los docentes son excelentes profesionales y el contenido es completamente aplicable a mi labor diaria como psicóloga de una institución',3,1,1,NULL,4,'2026-03-09 05:51:52','2026-03-31 08:55:42'),(4,'Carlos Esteban Morales','Profesional de Salud Pública','Gracias a los cursos de Proinapsa pude actualizar mis conocimientos en epidemiología y promoción de la salud. La metodología es muy práctica y el acompañamiento del equipo docente es constante',5,11,1,NULL,4,'2026-03-09 05:51:52','2026-03-31 08:54:59'),(5,'María Fernanda Giraldo','Trabajadora Social, Alcaldía de Medellín','Participé en el programa de intervención comunitaria y fue una experiencia transformadora. Aprendí herramientas concretas para trabajar con comunidades vulnerables. El equipo de Proinapsa es muy comprometido y siempre está dispuesto a orientar.',5,3,1,NULL,NULL,'2026-03-09 05:51:52','2026-03-09 05:51:52'),(6,'Andrés Felipe Restrepo','Licenciado en Educación, docente universitario','Excelente institución. La formación que ofrece Proinapsa en educación para la salud es de primer nivel. Los materiales son actualizados, los profesores muy preparados y la plataforma funciona perfectamente. Completé dos cursos y ya estoy inscrito en el tercero.',5,4,1,NULL,NULL,'2026-03-09 05:51:52','2026-03-09 05:51:52'),(7,'Gloria Inés Zapata','Enfermera jefe, Clínica Las Américas','El curso de Primeros Auxilios Psicológicos fue muy completo y práctico. Lo recomendé a todo mi equipo de enfermería. Proinapsa tiene una propuesta de formación muy pertinente para los profesionales de la salud que trabajamos en contextos de alta demanda.',4,5,1,NULL,NULL,'2026-03-09 05:51:52','2026-03-09 05:51:52'),(8,'Juliana Ríos Betancur','Madre comunitaria, ICBF','Gracias a los talleres de primera infancia que ofrece Proinapsa, mejoré mucho mi manera de trabajar con los niños. Ahora entiendo mejor su desarrollo y puedo apoyarlos de manera más efectiva. Es una institución que realmente piensa en las comunidades.',5,6,1,NULL,NULL,'2026-03-09 05:51:52','2026-03-09 05:51:52'),(9,'Hernán Darío Cárdenas','Coordinador de Bienestar Laboral','Contratamos a Proinapsa para desarrollar un programa de bienestar para nuestros colaboradores y los resultados fueron excelentes. El equipo es muy profesional, puntual y el impacto en el clima organizacional fue notorio desde los primeros talleres.',5,7,1,NULL,NULL,'2026-03-09 05:51:52','2026-03-09 05:51:52'),(10,'Patricia Lorena Muñoz','Investigadora independiente en salud','Las publicaciones e investigaciones del Instituto Proinapsa son un referente en salud pública regional. Acceder a su repositorio documental es de gran valor para quienes trabajamos en investigación. Una institución seria y con rigor científico.',4,8,1,NULL,NULL,'2026-03-09 05:51:52','2026-03-09 05:51:52'),(11,'PEPITO PEREZ','INGENIERO DE SISTEMAS','me gusto el trabajoLorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando.\n',5,9,1,1,4,'2026-03-26 06:09:07','2026-03-31 08:53:37');
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'kevin','kevin@admin.com',NULL,'$2y$12$zap40UIEibJjK/Y3JQTYsu/HVBVgtS8soa3B0/kNXvCo9vospkzXy','2HMi28NCvjeYTdtDfiLcyu3lfYwBYE507SRExIf1MA0tn8ijQcf8KY57FfVI','2026-02-02 06:58:55','2026-02-02 06:58:55'),(4,'Root','kevinbecerram07@gmail.com','2026-03-31 02:54:06','$2y$12$BIzDfqMK5EHPYdpx4htdSu2bapS9xjffNP9ef4NP89UQI5E9.mrW2',NULL,'2026-03-31 02:54:06','2026-03-31 02:54:06'),(6,'prueba coordinador','coordinador@gmail.com',NULL,'$2y$12$SFuIn85AUZjzjwif0cE89OuYjCaEIwOmkTo.pdheX3M//8TUSdF0a',NULL,'2026-04-03 22:01:07','2026-04-03 22:01:07');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `values`
--

DROP TABLE IF EXISTS `values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `values` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `values_order_unique` (`order`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `values`
--

LOCK TABLES `values` WRITE;
/*!40000 ALTER TABLE `values` DISABLE KEYS */;
INSERT INTO `values` VALUES (1,'Respeto','Reconocemos la dignidad y los derechos de cada persona, valorando la diversidad cultural, social y humana como fundamento de nuestras relaciones institucionales y comunitarias.',1,1,'2026-03-09 05:51:52','2026-03-09 05:51:52'),(2,'Integridad','Actuamos con honestidad, transparencia y coherencia en todos nuestros procesos, garantizando que nuestras acciones estén alineadas con los principios éticos y los compromisos adquiridos.',2,1,'2026-03-09 05:51:52','2026-03-09 05:51:52'),(3,'Compromiso','Asumimos con responsabilidad y dedicación nuestra labor en favor del bienestar comunitario, aportando lo mejor de nuestra capacidad profesional y humana en cada proyecto que emprendemos.',3,1,'2026-03-09 05:51:52','2026-03-09 05:51:52'),(4,'Innovación','Fomentamos el pensamiento creativo y la búsqueda constante de nuevas estrategias para responder a los desafíos de la salud y el bienestar, adaptándonos a los cambios del entorno con apertura y flexibilidad.',4,1,'2026-03-09 05:51:52','2026-03-09 05:51:52'),(5,'Solidaridad','Trabajamos de manera colaborativa, apoyando a las comunidades más vulnerables y fortaleciendo los lazos de cooperación entre instituciones, profesionales y ciudadanos en torno a objetivos comunes de bienestar.',5,1,'2026-03-09 05:51:52','2026-03-09 05:51:52'),(6,'Excelencia','Buscamos la mejora continua en la calidad de nuestros programas, servicios e investigaciones, orientándonos por altos estándares académicos, científicos y profesionales que generen impacto real en la sociedad.',6,1,'2026-03-09 05:51:52','2026-03-09 05:51:52');
/*!40000 ALTER TABLE `values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'web-institute'
--

--
-- Dumping routines for database 'web-institute'
--
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-03 15:51:29
