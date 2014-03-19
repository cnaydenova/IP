SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `members` (
  `member_id` int(9) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `password` varchar(32) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `email` varchar(64) CHARACTER SET utf8 NOT NULL DEFAULT '',
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

INSERT INTO `members` (`member_id`, `username`, `password`, `email`) VALUES
(1, 'dux', '81dc9bdb52d04dc20036dbd8313ed055', 'dsa@abv.bg'),
(2, 'test', '81dc9bdb52d04dc20036dbd8313ed055', 'sad@abv.bg');

CREATE TABLE IF NOT EXISTS `nomer_obuvki` (
  `id` int(11) NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `nomer_obuvki` (`id`, `name`) VALUES
(1, '35'),
(2, '36'),
(3, '37'),
(4, '38'),
(5, '39'),
(6, '40'),
(7, '41'),
(8, '42'),
(9, '43'),
(10, '44');

CREATE TABLE IF NOT EXISTS `parzalki` (
  `id` int(11) NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `parzalki` (`id`, `name`) VALUES
(1, 'Slavia'),
(2, 'Ariana'),
(3, 'The mall');

CREATE TABLE IF NOT EXISTS `purzalki_obuvki` (
  `id` int(11) NOT NULL,
  `id_purzalka` int(11) NOT NULL,
  `nomer_obuvka` varchar(40) DEFAULT NULL,
  `broi_chifta` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `purzalki_obuvki` (`id`, `id_purzalka`, `nomer_obuvka`, `broi_chifta`) VALUES
(1, 1, '37', '5'),
(2, 1, '40', '8'),
(3, 1, '42', '10'),
(4, 3, '34', '50');

