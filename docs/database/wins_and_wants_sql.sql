delimiter $$

CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci$$

delimiter $$

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci$$

delimiter $$

CREATE TABLE `user_has_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `fk_user_has_role_role1` (`role_id`),
  CONSTRAINT `fk_user_has_role_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_role_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci$$

delimiter $$

CREATE TABLE `wins_and_wants` (
  `id` int(11) NOT NULL,
  `created` date DEFAULT NULL,
  `wins_01` varchar(140) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wins_02` varchar(140) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wins_03` varchar(140) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wins_04` varchar(140) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wins_05` varchar(140) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wants_01` varchar(140) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wants_02` varchar(140) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wants_03` varchar(140) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wants_04` varchar(140) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wants_05` varchar(140) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`user_id`),
  KEY `fk_wins_and_wants_user1` (`user_id`),
  CONSTRAINT `fk_wins_and_wants_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci$$

