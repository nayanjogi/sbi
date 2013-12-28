-- WordPress Backup to Dropbox SQL Dump
-- Version 1.5.4
-- http://wpb2d.com
-- Generation Time: July 20, 2013 at 17:59

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Create and use the backed up database
--

CREATE DATABASE IF NOT EXISTS ashvinvi_sbi2db;
USE ashvinvi_sbi2db;

--
-- Table structure for table `wp_easy_gallery`
--

CREATE TABLE `wp_easy_gallery` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `slug` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `thumbnail` longtext NOT NULL,
  `thumbwidth` int(11) DEFAULT NULL,
  `thumbheight` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_easy_gallery`
--

INSERT INTO `wp_easy_gallery` (`Id`, `name`, `slug`, `description`, `thumbnail`, `thumbwidth`, `thumbheight`) VALUES
('1', 'subscriber', 'subscriber', '', '', '0', '0');

--
-- Table structure for table `wp_easy_gallery_images`
--

CREATE TABLE `wp_easy_gallery_images` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` int(11) NOT NULL,
  `imagePath` longtext NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` longtext NOT NULL,
  `sortOrder` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_easy_gallery_images`
--

INSERT INTO `wp_easy_gallery_images` (`Id`, `gid`, `imagePath`, `title`, `description`, `sortOrder`) VALUES
('1', '1', 'http://ashvinvi.5gbfree.com/sbi/wp-content/uploads/2013/05/2-300x221.jpg', '', '', '0'),
('2', '1', 'http://ashvinvi.5gbfree.com/sbi/wp-content/uploads/2012/08/0508-long-beach-framing2-300x203.jpg', '', '', '0');

--
-- Table structure for table `wp_hsa_plugin`
--

CREATE TABLE `wp_hsa_plugin` (
  `hsa_id` int(11) NOT NULL AUTO_INCREMENT,
  `hsa_text` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `hsa_order` int(11) NOT NULL DEFAULT '0',
  `hsa_status` char(3) NOT NULL DEFAULT 'No',
  `hsa_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hsa_link` varchar(1024) NOT NULL,
  PRIMARY KEY (`hsa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_hsa_plugin`
--

INSERT INTO `wp_hsa_plugin` (`hsa_id`, `hsa_text`, `hsa_order`, `hsa_status`, `hsa_date`, `hsa_link`) VALUES
('2', 'Central Govt Scheme - 145.12 as on 2013-03-17 || State Govt Scheme - 22.8 as on 2013-03-17 || Scheme E - 48.25 as on 2013-03-17 || Scheme C - 45 as on 2013-03-17 || Scheme G - 63 as on 2013-03-17 || Scheme T2E - 12 as on 2013-03-17 || Scheme T2C - 96.0 as on 2013-03-17 || Scheme T2G - 25 as on 2013-03-17 || NPS Lite - 147 as on 2013-03-17 || Corporate CG - 258.33 as on 2013-03-17', '1', 'YES', '0000-00-00 00:00:00', '');

--
-- Table structure for table `wp_nav`
--

CREATE TABLE `wp_nav` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `centralGovtScheme` float NOT NULL,
  `stateGovtScheme` float NOT NULL,
  `scheme_E` float NOT NULL,
  `scheme_C` float NOT NULL,
  `scheme_G` float NOT NULL,
  `scheme_T2E` float NOT NULL,
  `scheme_T2C` float NOT NULL,
  `scheme_T2G` float NOT NULL,
  `nps_lite` float NOT NULL,
  `corporate_cg` float NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_nav`
--

INSERT INTO `wp_nav` (`id`, `centralGovtScheme`, `stateGovtScheme`, `scheme_E`, `scheme_C`, `scheme_G`, `scheme_T2E`, `scheme_T2C`, `scheme_T2G`, `nps_lite`, `corporate_cg`, `date`) VALUES
('5', '12', '10.23', '111111', '12.4589', '175.369', '10.2365', '9', '7', '258.33', '256.33', '2013-03-16'),
('53', '12', '32', '45', '65', '78', '45', '14', '78', '59', '380.222', '2013-03-17'),
('54', '145.12', '1452.2', '45.55', '78', '59', '57', '25', '36', '21', '22.222', '2013-03-17'),
('55', '12', '48.25', '59', '63', '58', '96.22', '3', '24', '50', '6', '2013-03-17'),
('56', '145.12', '48.25', '45', '63', '12', '96', '25', '147.22', '258.33', '6', '2013-03-17');

--
-- Table structure for table `wp_useful_banner_manager_banners`
--

CREATE TABLE `wp_useful_banner_manager_banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_name` varchar(255) NOT NULL,
  `banner_type` varchar(4) NOT NULL,
  `banner_title` varchar(255) NOT NULL,
  `banner_alt` text NOT NULL,
  `banner_link` varchar(255) NOT NULL,
  `link_target` varchar(7) NOT NULL,
  `link_rel` varchar(8) NOT NULL,
  `banner_width` int(11) NOT NULL,
  `banner_height` int(11) NOT NULL,
  `added_date` varchar(10) NOT NULL,
  `active_until` varchar(10) NOT NULL,
  `banner_order` int(11) NOT NULL DEFAULT '0',
  `is_visible` varchar(3) NOT NULL,
  `banner_added_by` varchar(50) NOT NULL,
  `banner_edited_by` text NOT NULL,
  `last_edited_date` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wp_useful_banner_manager_banners`
--

INSERT INTO `wp_useful_banner_manager_banners` (`id`, `banner_name`, `banner_type`, `banner_title`, `banner_alt`, `banner_link`, `link_target`, `link_rel`, `banner_width`, `banner_height`, `added_date`, `active_until`, `banner_order`, `is_visible`, `banner_added_by`, `banner_edited_by`, `last_edited_date`) VALUES
('2', 'banner2', 'png', 'banner1', '', '', '', '', '1000', '321', '2013-05-15', '-1', '0', 'no', 'admin', 'admin', '2013-06-09'),
('4', '4-4-Banner_7_1', 'jpg', 'banner2', '', '', '', '', '1000', '321', '2013-05-15', '-1', '0', 'yes', 'admin', 'admin', '2013-06-09'),
('5', '5-Banner_6_1', 'jpg', 'banner4', '', '', '', '', '1000', '321', '2013-05-16', '-1', '0', 'yes', 'admin', 'admin', '2013-06-17'),
('6', 'Banner_4', 'jpg', 'banner3', '', '', '', '', '1000', '321', '2013-05-16', '-1', '0', 'yes', 'admin', 'admin', '2013-06-09');

--
-- Table structure for table `wp_wpb2d_excluded_files`
--

CREATE TABLE `wp_wpb2d_excluded_files` (
  `file` varchar(255) NOT NULL,
  `isdir` tinyint(1) NOT NULL,
  UNIQUE KEY `file` (`file`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table `wp_wpb2d_excluded_files` is empty
--

--
-- Table structure for table `wp_wpb2d_options`
--

CREATE TABLE `wp_wpb2d_options` (
  `name` varchar(50) NOT NULL,
  `value` varchar(255) NOT NULL,
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_wpb2d_options`
--

INSERT INTO `wp_wpb2d_options` (`name`, `value`) VALUES
('access_token', 'w3f7ndpi56y3med'),
('access_token_secret', '7k5novxuyw1i0r7'),
('database_version', '1'),
('dropbox_location', 'sbi_backup'),
('history', '1371574822,1371576871,1371751164,1371864673,1372113073,1372307768,1372743405,1372834582,1372983071,1373117764,1373221261,1373239870,1373408052,1373480209,1373578718,1373849393,1373999409,1374179621,1374238145,1374300165'),
('in_progress', '1'),
('is_running', '1'),
('last_backup_time', '1374300165'),
('oauth_state', 'access'),
('request_token', 'tVdpWqQeDwY3Zfqy');

INSERT INTO `wp_wpb2d_options` (`name`, `value`) VALUES
('request_token_secret', '6rac04UtRs2Pyeac'),
('store_in_subfolder', '1'),
('total_file_count', '2126');

--
-- Table structure for table `wp_wpb2d_premium_extensions`
--

CREATE TABLE `wp_wpb2d_premium_extensions` (
  `name` varchar(50) NOT NULL,
  `file` varchar(255) NOT NULL,
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table `wp_wpb2d_premium_extensions` is empty
--

--
-- Table structure for table `wp_wpb2d_processed_files`
--

CREATE TABLE `wp_wpb2d_processed_files` (
  `file` varchar(255) NOT NULL,
  `offset` int(11) NOT NULL DEFAULT '0',
  `uploadid` varchar(50) DEFAULT NULL,
  UNIQUE KEY `file` (`file`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table `wp_wpb2d_processed_files` is empty
--

