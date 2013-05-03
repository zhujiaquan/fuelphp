--
-- DATABASE: `fuel_dev`
--

-- --------------------------------------------------------
DROP DATABASE IF EXISTS fuel_dev;
CREATE DATABASE IF NOT EXISTS `fuel_dev` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `fuel_dev`;

--
-- table struct `users`
--
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `group` int(11) NOT NULL DEFAULT '1',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `login_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profile_fields` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
