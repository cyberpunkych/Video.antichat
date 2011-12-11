/*
SQLyog Ultimate v8.55 
MySQL - 5.0.92-community-log : Database - bonken_demo
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;




/*Table structure for table `cattegories` */

DROP TABLE IF EXISTS `cattegories`;

CREATE TABLE `cattegories` (
  `id` int(10) NOT NULL auto_increment,
  `cattegory` varchar(500) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `cattegories` */

insert  into `cattegories`(`id`,`cattegory`) values (5,'Movie Trailers'),(6,'South Park'),(7,'The Walking Dead'),(8,'Breaking Bad');

/*Table structure for table `configurations` */

DROP TABLE IF EXISTS `configurations`;

CREATE TABLE `configurations` (
  `id` int(10) NOT NULL auto_increment,
  `domain` varchar(1000) default NULL,
  `description` varchar(1000) default NULL,
  `keywords` varchar(1000) default NULL,
  `title` varchar(1000) default NULL,
  `cpalead_enabled` varchar(50) NOT NULL default 'No',
  `cpalead_id` text,
  `home_ad` text,
  `cattegories` varchar(200) default NULL,
  `statcounter_security` varchar(150) default NULL,
  `statcounter_project` varchar(150) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `configurations` */

insert  into `configurations`(`id`,`domain`,`description`,`keywords`,`title`,`cpalead_enabled`,`cpalead_id`,`home_ad`,`cattegories`,`statcounter_security`,`statcounter_project`) values (1,'MyDomain.com','The demo page for SimpleVideoScript','watch,movie,trailers,online,simple,video,script,SimpleVideoScript,demo','The demo page for SimpleVideoScript','Disabled','None.','<a href=\"http://secure.hostgator.com/~affiliat/cgi-bin/affiliates/clickthru.cgi?id=bonken-\"><img src=\"http://tracking.hostgator.com/img/Shared/160x600.gif\" border=0></a>','True Blood','99','50');

/*Table structure for table `ratings` */

DROP TABLE IF EXISTS `ratings`;

CREATE TABLE `ratings` (
  `id` int(10) NOT NULL auto_increment,
  `client_ip` text,
  `rating` varchar(500) default NULL,
  `date` varchar(500) default NULL,
  `video_id` int(10) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

/*Data for the table `ratings` */

/*Table structure for table `videos` */

DROP TABLE IF EXISTS `videos`;

CREATE TABLE `videos` (
  `id` int(10) NOT NULL auto_increment,
  `video_name` varchar(1000) default NULL,
  `video_description` varchar(1000) default NULL,
  `video_keywords` varchar(1000) default NULL,
  `video_embed` varchar(1000) default NULL,
  `video_thumb` varchar(1000) default NULL,
  `featured_status` varchar(50) NOT NULL default 'off',
  `featured_image` varchar(1000) default NULL,
  `video_date` varchar(500) default NULL,
  `cattegory` varchar(500) default 'All',
  `rating` varchar(500) NOT NULL default '0',
  `raters` varchar(500) NOT NULL default '0',
  `views` int(100) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=112 DEFAULT CHARSET=latin1;

/*Data for the table `videos` */

insert  into `videos`(`id`,`video_name`,`video_description`,`video_keywords`,`video_embed`,`video_thumb`,`featured_status`,`featured_image`,`video_date`,`cattegory`,`rating`,`raters`,`views`) values (90,'Underworld: Awakening 3D - Movie Trailer (2012) HD ','','','<iframe width=\"1280\" height=\"750\" src=\"http://www.youtube.com/embed/Tw_-jAeRmwc?hd=1\" frameborder=\"0\" allowfullscreen></iframe>','http://celebrity.ycpics.com/wp-content/uploads/2011/08/underworld-awakening-kate-beckinsale.jpg','','','Fri, 26 Aug 2011 01:47:52 +0200','Movie Trailers','0','0',0),(91,'Captain America (2011) HD Movie New Trailer #2 - The First Avenger ','','','<iframe width=\"560\" height=\"345\" src=\"http://www.youtube.com/embed/IGmvyWxRlbQ\" frameborder=\"0\" allowfullscreen></iframe>','http://observerzparadise.com/wp-content/uploads/2011/07/Captain-America-The-First-Avenger-a-Fair-review.Spoilers.jpg','','','Fri, 26 Aug 2011 01:50:35 +0200','Movie Trailers','0','0',0),(92,'The Woman in Black - Movie Trailer (2012) HD ','','','<iframe width=\"1280\" height=\"750\" src=\"http://www.youtube.com/embed/LghXxTR215M?hd=1\" frameborder=\"0\" allowfullscreen></iframe>','http://www.thenerfherder.com/wordpress/wp-content/uploads/2011/08/radcliffe_the_woman_in_black-4-11-11DH-430x286.jpg','','','Fri, 26 Aug 2011 01:52:07 +0200','Movie Trailers','0','0',0),(93,'Immortals (2011) Amazing New Trailer #3 - HD Movie ','','','<iframe width=\"1280\" height=\"750\" src=\"http://www.youtube.com/embed/GSmJ5UXtUnk?hd=1\" frameborder=\"0\" allowfullscreen></iframe>','http://cdn.buzznet.com/media-cdn/jj1/headlines/2011/04/henry-cavill-immortals-posters.jpg','','','Fri, 26 Aug 2011 01:56:22 +0200','Movie Trailers','0','0',0),(94,'Conan The Barbarian - Official Trailer 2 [HD] ','','','<iframe width=\"1280\" height=\"750\" src=\"http://www.youtube.com/embed/ptC_KlAP_Ko?hd=1\" frameborder=\"0\" allowfullscreen></iframe>','http://xernest.com/wp-content/uploads/2011/08/Conan-The-Barbarian-2011.jpg','','','Fri, 26 Aug 2011 01:57:19 +0200','Movie Trailers','0','0',0),(95,'Mission Impossible 4 - Ghost Protocol - Official Trailer ','','','<iframe width=\"1280\" height=\"750\" src=\"http://www.youtube.com/embed/V0LQnQSrC-g?hd=1\" frameborder=\"0\" allowfullscreen></iframe>','http://newedgemovies.com/wp-content/uploads/2011/07/Mission-Impossible-4-Movie-Poster-300x169.jpg','','','Fri, 26 Aug 2011 01:58:40 +0200','Movie Trailers','0','0',0),(96,'Transformers 3 : Dark of the Moon - Official Trailer 2 [HD] ','','','<iframe width=\"1280\" height=\"750\" src=\"http://www.youtube.com/embed/gKOQAnvBHCw?hd=1\" frameborder=\"0\" allowfullscreen></iframe>','http://ramascreen.com/wp-content/uploads/2010/10/Transformers-Dark-Of-The-Moon-header.jpg','','','Fri, 26 Aug 2011 01:59:34 +0200','Movie Trailers','0','0',0),(97,'Final Destination 5 - Official Trailer [HD] ','','','<iframe width=\"1280\" height=\"750\" src=\"http://www.youtube.com/embed/zLKR3GdIK80?hd=1\" frameborder=\"0\" allowfullscreen></iframe>','http://1.bp.blogspot.com/_PbuvyrkIAzw/S6L50zoRnVI/AAAAAAAAABE/UX6CwgReTwk/s400/Final+Destination+5+Film.jpg','','','Fri, 26 Aug 2011 02:01:21 +0200','Movie Trailers','0','0',0),(98,'Puss In Boots - Official Trailer [HD] ','','','<iframe width=\"1280\" height=\"750\" src=\"http://www.youtube.com/embed/jpZwLMaa2CY?hd=1\" frameborder=\"0\" allowfullscreen></iframe>','http://www.onlinemovieshut.com/wp-content/uploads/2011/02/puss-in-boots-movie.jpg','','','Fri, 26 Aug 2011 02:02:18 +0200','Movie Trailers','0','0',0),(99,'Sherlock Holmes : Game Of Shadows - Official Trailer [HD] ','','','<iframe width=\"1280\" height=\"750\" src=\"http://www.youtube.com/embed/Tj3qx_HbPSE?hd=1\" frameborder=\"0\" allowfullscreen></iframe>','http://fanboyz.net/wp-content/uploads/2011/07/sherlockholmes2poster-e1310521485165.jpeg','','','Fri, 26 Aug 2011 02:05:28 +0200','Movie Trailers','0','0',0),(100,'Johnny English Reborn - Official Trailer [HD] ','','','<iframe width=\"1280\" height=\"750\" src=\"http://www.youtube.com/embed/qXQSfSu1Y0s?hd=1\" frameborder=\"0\" allowfullscreen></iframe>','http://gillianla.files.wordpress.com/2011/05/johnny_english_reborn_poster.jpg?w=535&h=401','','','Fri, 26 Aug 2011 02:06:58 +0200','Movie Trailers','0','0',0),(101,'30 Minutes Or Less - Official Trailer 2 [HD] ','dd','kk','<iframe width=\"1280\" height=\"750\" src=\"http://www.youtube.com/embed/I7slC-1CY7w?hd=1\" frameborder=\"0\" allowfullscreen></iframe>','http://www.pajiba.com/assets_c/2011/08/30-minutes-or-less-movie-poster-01-550x814-thumb-450x330-28653.jpg','on','http://www.moviewallpaper.net/wpp/Jesse_Eisenberg_in_30_Minutes_or_Less_Wallpaper_1_800.jpg','Fri, 26 Aug 2011 02:08:10 +0200','Movie Trailers','0','0',0),(102,'The Amazing Spider Man - Official Trailer [HD] ','The trailer for the amazing spiderman.','amazing,spiderman,trailer','<iframe width=\"1280\" height=\"750\" src=\"http://www.youtube.com/embed/oX9ZT3RbYE4?hd=1\" frameborder=\"0\" allowfullscreen></iframe>','http://img.poptower.com/news-pic-3338/amazing-spider-man-2012-movie.jpg?d=360','on','http://celebsbuzz.com/wp-content/uploads/2011/07/spider_man_2012_by_hyzak-d396n0d.jpg','Fri, 26 Aug 2011 02:10:16 +0200','Movie Trailers','0','0',1),(106,'South Park Bigger Longer And Uncut Trailer','Trailer for South Park Bigger Longer And Uncut','South Park Bigger Longer And Uncut Trailer','<iframe width=\"560\" height=\"345\" src=\"http://www.youtube.com/embed/5KDs6ah_XOM\" frameborder=\"0\" allowfullscreen></iframe>','http://pixhost.me/avaxhome/d7/b1/0010b1d7_medium.jpeg','','','Wed, 31 Aug 2011 21:34:29 +0200','South Park','0','0',2),(107,'The Walking Dead Season 1 Trailer','the walking dead season 1 trailer','The Walking Dead Season 1 Trailer','<iframe width=\"560\" height=\"345\" src=\"http://www.youtube.com/embed/GB9pG71kfxM\" frameborder=\"0\" allowfullscreen></iframe>','http://primetime.unrealitytv.co.uk/wp-content/uploads/2010/06/walking-dead.jpg','','','Wed, 31 Aug 2011 21:37:22 +0200','The Walking Dead','0','0',2),(108,'The Walking Dead Season 2 Trailer','The Walking Dead Season 2 Trailer','The Walking Dead Season 2 Trailer','<iframe width=\"560\" height=\"345\" src=\"http://www.youtube.com/embed/grWV8WZtAQc\" frameborder=\"0\" allowfullscreen></iframe>','http://primetime.unrealitytv.co.uk/wp-content/uploads/2010/06/walking-dead.jpg','','','Wed, 31 Aug 2011 21:38:27 +0200','The Walking Dead','0','0',2),(109,'Breaking Bad Season 4 Trailer','Breaking Bad Season 4 Trailer','Breaking Bad Season 4 Trailer','<iframe width=\"560\" height=\"345\" src=\"http://www.youtube.com/embed/YyKc2LIiqHc\" frameborder=\"0\" allowfullscreen></iframe>','http://www.whitegadget.com/attachments/pc-wallpapers/71085d1314243263-breaking-bad-breaking-bad-pictures.jpg','','','Wed, 31 Aug 2011 21:40:46 +0200','Breaking Bad','0','0',0),(110,'Breaking Bad Season 2 Trailer','Breaking Bad Season 2 Trailer','Breaking Bad Season 2 Trailer','<iframe width=\"420\" height=\"345\" src=\"http://www.youtube.com/embed/0t_tGu-Os70\" frameborder=\"0\" allowfullscreen></iframe>','http://2.bp.blogspot.com/_ojhO_7coVAw/SbPmoFBoikI/AAAAAAAABs8/ZQhJvNt7rTU/s400/BreakingBad_S2_800x600_03.jpg','','','Wed, 31 Aug 2011 21:42:10 +0200','Breaking Bad','0','0',0),(111,'South Park Season 14 Trailer','Trailer for South Park Season 14','South Park Season 14 Trailer','<iframe width=\"560\" height=\"345\" src=\"http://www.youtube.com/embed/pOAzrxspXD8\" frameborder=\"0\" allowfullscreen></iframe>','http://tvmedia.ign.com/tv/image/article/113/1136636/south-park-season-14-20101124090001783.jpg','','','Wed, 31 Aug 2011 21:44:29 +0200','South Park','0','0',2);

/*Table structure for table `visitor_views` */

DROP TABLE IF EXISTS `visitor_views`;

CREATE TABLE `visitor_views` (
  `id` int(10) NOT NULL auto_increment,
  `hostname` tinytext,
  `visited_id` int(10) default NULL,
  `date` tinytext,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `visitor_views` */

insert  into `visitor_views`(`id`,`hostname`,`visited_id`,`date`) values (1,'93.97.124.31',102,'Wed, 31 Aug 2011'),(2,'93.97.124.31',106,'Wed, 31 Aug 2011'),(3,'93.97.124.31',107,'Wed, 31 Aug 2011'),(4,'66.220.158.245',107,'Wed, 31 Aug 2011'),(5,'93.97.124.31',108,'Wed, 31 Aug 2011'),(6,'66.220.158.249',108,'Wed, 31 Aug 2011'),(7,'93.97.124.31',111,'Wed, 31 Aug 2011'),(8,'66.220.153.246',111,'Wed, 31 Aug 2011'),(9,'66.220.153.249',106,'Wed, 31 Aug 2011');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
