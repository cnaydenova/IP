CREATE TABLE IF NOT EXISTS `members` (
  `member_id` int(9) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `email` varchar(64) NOT NULL DEFAULT '',
  `admin` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `members` (`member_id`, `username`, `password`, `email`, `admin`) VALUES
(1, 'dsa', 's81dc9bdb52d04dc20036dbd8313ed055', 'dsa@abv.bg', 0),
(2, 'test', '81dc9bdb52d04dc20036dbd8313ed055', 'sad@abv.bg', 1);

CREATE TABLE IF NOT EXISTS `nomer_obuvki` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

INSERT INTO `parzalki` (`id`, `name`) VALUES
(1, 'Slavia'),
(3, 'The mall');

CREATE TABLE IF NOT EXISTS `purzalki_obuvki` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_purzalka` int(11) NOT NULL,
  `nomer_obuvka` varchar(40) DEFAULT NULL,
  `broi_chifta` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

INSERT INTO `purzalki_obuvki` (`id`, `id_purzalka`, `nomer_obuvka`, `broi_chifta`) VALUES
(1, 1, '37', '5'),
(2, 1, '40', '8'),
(3, 1, '42', '10'),
(4, 3, '34', '50');

CREATE TABLE IF NOT EXISTS `razpisanie` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_rink` int(2) unsigned NOT NULL,
  `start` int(10) unsigned NOT NULL,
  `end` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

INSERT INTO `razpisanie` (`id`, `id_rink`, `start`, `end`) VALUES
(3, 1, 10900, 11030),
(4, 1, 21130, 11300),
(5, 1, 11700, 11830);

CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_obuvka` int(2) unsigned NOT NULL,
  `id_rink` int(2) unsigned NOT NULL,
  `id_member` int(10) unsigned NOT NULL,
  `id_razpisanie` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

INSERT INTO `reservation` (`id`, `id_obuvka`, `id_rink`, `id_member`, `id_razpisanie`) VALUES
(6, 3, 1, 2, 4);


