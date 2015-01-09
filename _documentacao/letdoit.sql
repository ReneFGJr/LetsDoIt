-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 07, 2015 at 05:18 PM
-- Server version: 5.6.20-log
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `letdoit`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
`id_cy` bigint(20) unsigned NOT NULL,
  `cy_name` char(40) NOT NULL,
  `cy_codigo` char(5) NOT NULL,
  `cy_state` char(3) NOT NULL,
  `cy_country` char(3) NOT NULL,
  `cy_ordem` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id_cy`, `cy_name`, `cy_codigo`, `cy_state`, `cy_country`, `cy_ordem`) VALUES
(1, 'Sao Paulo', '00001', 'SP', 'BRA', 1),
(2, 'Curitiba', '00002', 'PR', 'BRA', 20);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
`id_e` bigint(20) unsigned NOT NULL,
  `e_codigo` char(7) NOT NULL,
  `e_name` char(60) NOT NULL,
  `e_text` text NOT NULL,
  `e_date` int(11) NOT NULL,
  `e_place` char(7) NOT NULL,
  `e_time` char(5) NOT NULL,
  `e_sent` int(11) NOT NULL,
  `e_back` int(11) NOT NULL,
  `e_sponsor` char(7) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id_e`, `e_codigo`, `e_name`, `e_text`, `e_date`, `e_place`, `e_time`, `e_sent`, `e_back`, `e_sponsor`) VALUES
(1, '0000001', 'On the Rocks', 'DJS\r\npista 1\r\nDE PLAINAS\r\n\r\nposta 2\r\nGISA GABRIEL\r\nCASAL BELALUGOSI * NENÃŠ KRAWITZ\r\n\r\nlounge\r\nGUI ÃVILA * ISADORA KRIEGER\r\n\r\ndireÃ§Ã£o geral RENATO RATIER\r\norganizaÃ§Ã£o VIVI FLAKBAUM\r\ndoor VIC FLAKBAUM\r\npinup doll LEKKA GLAM\r\nphotos ANDRÃ‰ LIGEIRO & ORNELLA\r\nlight JOHNSON TELES & REGÃ‰RIO', 20130812, '0000001', '23:59', 0, 0, '0000003');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
`id_p` bigint(20) unsigned NOT NULL,
  `p_name` char(80) NOT NULL,
  `p_nick` char(20) NOT NULL,
  `p_title` char(5) NOT NULL,
  `p_email_1` char(80) NOT NULL,
  `p_email_2` char(80) NOT NULL,
  `p_codigo` char(7) NOT NULL,
  `p_update` int(11) NOT NULL,
  `p_lastcall` int(11) NOT NULL,
  `p_invitation` int(11) NOT NULL,
  `p_active` int(11) NOT NULL,
  `p_birthday_day` int(11) NOT NULL,
  `p_birthday_month` int(11) NOT NULL,
  `p_birthday_year` int(11) NOT NULL,
  `p_cidade` char(7) NOT NULL,
  `p_cep` char(10) NOT NULL,
  `p_endereco` char(80) NOT NULL,
  `p_numero` char(6) NOT NULL,
  `p_complement` char(50) NOT NULL,
  `p_block` char(20) NOT NULL,
  `p_lat` float NOT NULL,
  `p_lon` float NOT NULL,
  `p_fone_ddi` char(5) NOT NULL DEFAULT '+55',
  `p_fone_dd` char(2) NOT NULL,
  `p_phone_1` char(10) NOT NULL,
  `p_phone_2` char(10) NOT NULL,
  `p_phone_3` char(10) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`id_p`, `p_name`, `p_nick`, `p_title`, `p_email_1`, `p_email_2`, `p_codigo`, `p_update`, `p_lastcall`, `p_invitation`, `p_active`, `p_birthday_day`, `p_birthday_month`, `p_birthday_year`, `p_cidade`, `p_cep`, `p_endereco`, `p_numero`, `p_complement`, `p_block`, `p_lat`, `p_lon`, `p_fone_ddi`, `p_fone_dd`, `p_phone_1`, `p_phone_2`, `p_phone_3`) VALUES
(1, 'Rene Faustino Gabriel Junior', 'Rene', 'MR', 'renefgj@gmail.com', '', '0000001', 20150106, 20150106, 20150106, 1, 5, 10, 1969, '00002', '80.710-000', 'Rua Padre Agostinho', '2885', 'ap.1203 torre barigui', 'Bigorrilho', 0, 0, '+55', '41', '8811.9061', '', ''),
(2, 'Viviane F. Tulio', 'Viviane', '', 'vivianetulio@gmail.com', '', '0000002', 0, 0, 0, 1, 20, 9, 1970, '00002', '80710000', '', '', '', '', 0, 0, '+55', '41', '8866.6389', '', ''),
(3, 'D.EDGE', 'D.EDGE', '', '', '', '0000003', 0, 0, 0, 0, 0, 0, 0, '00001', '', 'Av. Auro Moura Andrade', '141', '', 'Barra Funda', 0, 0, '+55', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
`id_pr` bigint(20) unsigned NOT NULL,
  `pr_cod` char(5) NOT NULL,
  `pr_name` char(30) NOT NULL,
  `pr_active` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id_pr`, `pr_cod`, `pr_name`, `pr_active`) VALUES
(1, '00001', 'Jornalista (Blog)', 1);

-- --------------------------------------------------------

--
-- Table structure for table `titles`
--

CREATE TABLE IF NOT EXISTS `titles` (
`id_tl` bigint(20) unsigned NOT NULL,
  `tl_codigo` char(5) NOT NULL,
  `tl_descricao` char(40) NOT NULL,
  `tl_active` int(11) NOT NULL,
  `tl_ordem` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `titles`
--

INSERT INTO `titles` (`id_tl`, `tl_codigo`, `tl_descricao`, `tl_active`, `tl_ordem`) VALUES
(1, 'M', 'Masculino', 1, 5),
(2, 'F', '', 0, 6),
(3, '-', '-não categorizado-', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `to_send`
--

CREATE TABLE IF NOT EXISTS `to_send` (
`id_st` bigint(20) unsigned NOT NULL,
  `st_person` char(7) NOT NULL,
  `st_event` int(7) NOT NULL,
  `st_status` char(1) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `to_send`
--

INSERT INTO `to_send` (`id_st`, `st_person`, `st_event`, `st_status`) VALUES
(2, '0000001', 1, '@'),
(3, '0000002', 1, '@');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city`
--
ALTER TABLE `city`
 ADD UNIQUE KEY `id_cy` (`id_cy`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
 ADD UNIQUE KEY `id_e` (`id_e`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
 ADD UNIQUE KEY `id_p` (`id_p`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
 ADD UNIQUE KEY `id_pr` (`id_pr`);

--
-- Indexes for table `titles`
--
ALTER TABLE `titles`
 ADD UNIQUE KEY `id_tl` (`id_tl`);

--
-- Indexes for table `to_send`
--
ALTER TABLE `to_send`
 ADD UNIQUE KEY `id_st` (`id_st`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
MODIFY `id_cy` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
MODIFY `id_e` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
MODIFY `id_p` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
MODIFY `id_pr` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `titles`
--
ALTER TABLE `titles`
MODIFY `id_tl` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `to_send`
--
ALTER TABLE `to_send`
MODIFY `id_st` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
