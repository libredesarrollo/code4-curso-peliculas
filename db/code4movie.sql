-- -------------------------------------------------------------
-- TablePlus 6.2.1(578)
--
-- https://tableplus.com/
--
-- Database: code4movie
-- Generation Time: 2025-01-25 09:38:00.7010
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `auth_groups_users`;
CREATE TABLE `auth_groups_users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auth_groups_users_user_id_foreign` (`user_id`),
  CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `auth_identities`;
CREATE TABLE `auth_identities` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `secret` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `secret2` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `extra` text COLLATE utf8mb4_general_ci,
  `force_reset` tinyint(1) NOT NULL DEFAULT '0',
  `last_used_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `type_secret` (`type`,`secret`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `auth_identities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `auth_logins`;
CREATE TABLE `auth_logins` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `identifier` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_type_identifier` (`id_type`,`identifier`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `auth_permissions_users`;
CREATE TABLE `auth_permissions_users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `permission` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auth_permissions_users_user_id_foreign` (`user_id`),
  CONSTRAINT `auth_permissions_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `auth_remember_tokens`;
CREATE TABLE `auth_remember_tokens` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `selector` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `hashedValidator` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int unsigned NOT NULL,
  `expires` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `selector` (`selector`),
  KEY `auth_remember_tokens_user_id_foreign` (`user_id`),
  CONSTRAINT `auth_remember_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `auth_token_logins`;
CREATE TABLE `auth_token_logins` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `identifier` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_type_identifier` (`id_type`,`identifier`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `imagenes`;
CREATE TABLE `imagenes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `imagen` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `extension` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `data` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `pelicula_imagen`;
CREATE TABLE `pelicula_imagen` (
  `pelicula_id` int unsigned NOT NULL,
  `imagen_id` int unsigned NOT NULL,
  KEY `pelicula_imagen_pelicula_id_foreign` (`pelicula_id`),
  KEY `pelicula_imagen_imagen_id_foreign` (`imagen_id`),
  CONSTRAINT `pelicula_imagen_imagen_id_foreign` FOREIGN KEY (`imagen_id`) REFERENCES `imagenes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pelicula_imagen_pelicula_id_foreign` FOREIGN KEY (`pelicula_id`) REFERENCES `peliculas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `peliculas`;
CREATE TABLE `peliculas` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_general_ci,
  `categoria_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_categoria_id_foreign` (`categoria_id`),
  CONSTRAINT `products_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `value` text COLLATE utf8mb4_general_ci,
  `type` varchar(31) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'string',
  `context` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_message` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `last_active` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `usuario` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `contrasena` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `tipo` enum('admin','regular') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'regular',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `auth_groups_users` (`id`, `user_id`, `group`, `created_at`) VALUES
(1, 1, 'user', '2025-01-25 13:20:09'),
(2, 1, 'admin', '2025-01-25 13:37:04');

INSERT INTO `auth_identities` (`id`, `user_id`, `type`, `name`, `secret`, `secret2`, `expires`, `extra`, `force_reset`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'email_password', NULL, 'admin@admin.com', '$2y$12$hBc0fxxLXeh63fww15ICDu/Jqy7mRYfbFQcS3EBe5MgimuwXI.WAm', NULL, NULL, 0, NULL, '2025-01-25 13:20:09', '2025-01-25 13:20:09');

INSERT INTO `auth_permissions_users` (`id`, `user_id`, `permission`, `created_at`) VALUES
(2, 1, 'users.create', '2025-01-25 13:36:54'),
(3, 1, 'users.edit', '2025-01-25 13:36:54'),
(4, 1, 'users.delete', '2025-01-25 13:36:55'),
(5, 1, 'users.detail', '2025-01-25 13:36:58');

INSERT INTO `categorias` (`id`, `titulo`) VALUES
(1, 'Categoría 1'),
(21, 'Categoría 1'),
(22, 'Categoría 2'),
(23, 'Categoría 3'),
(24, 'Categoría 4'),
(25, 'Categoría 5'),
(26, 'Categoría 6'),
(27, 'Categoría 7'),
(28, 'Categoría 8'),
(29, 'Categoría 9'),
(30, 'Categoría 10'),
(31, 'Categoría 11'),
(32, 'Categoría 12'),
(33, 'Categoría 13'),
(34, 'Categoría 14'),
(35, 'Categoría 15'),
(36, 'Categoría 16'),
(37, 'Categoría 17'),
(38, 'Categoría 18'),
(39, 'Categoría 19'),
(40, 'Categoría 20');

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2022-01-21-180032', 'App\\Database\\Migrations\\Peliculas', 'default', 'App', 1737110237, 1),
(2, '2022-01-25-210713', 'App\\Database\\Migrations\\Categorias', 'default', 'App', 1737110237, 1),
(3, '2022-02-06-181718', 'App\\Database\\Migrations\\Usuarios', 'default', 'App', 1737110237, 1),
(4, '2022-02-08-190647', 'App\\Database\\Migrations\\AgregarCategoriaAPelicula', 'default', 'App', 1737110237, 1),
(5, '2022-02-10-182014', 'App\\Database\\Migrations\\Imagenes', 'default', 'App', 1737110237, 1),
(6, '2022-02-10-183022', 'App\\Database\\Migrations\\PeliculaImagen', 'default', 'App', 1737110237, 1),
(7, '2020-12-28-223112', 'CodeIgniter\\Shield\\Database\\Migrations\\CreateAuthTables', 'default', 'CodeIgniter\\Shield', 1737810680, 2),
(8, '2021-07-04-041948', 'CodeIgniter\\Settings\\Database\\Migrations\\CreateSettingsTable', 'default', 'CodeIgniter\\Settings', 1737810680, 2),
(9, '2021-11-14-143905', 'CodeIgniter\\Settings\\Database\\Migrations\\AddContextColumn', 'default', 'CodeIgniter\\Settings', 1737810680, 2);

INSERT INTO `peliculas` (`id`, `titulo`, `descripcion`, `categoria_id`) VALUES
(22, 'Pelicula 1', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum quasi iusto voluptate...', 1),
(23, 'Pelicula 2', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum quasi iusto voluptate...', 1),
(24, 'Pelicula 3', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum quasi iusto voluptate...', 1),
(25, 'Pelicula 4', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum quasi iusto voluptate...', 1),
(26, 'Pelicula 5', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum quasi iusto voluptate...', 1),
(27, 'Pelicula 6', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum quasi iusto voluptate...', 1),
(28, 'Pelicula 7', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum quasi iusto voluptate...', 1),
(29, 'Pelicula 8', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum quasi iusto voluptate...', 1),
(30, 'Pelicula 9', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum quasi iusto voluptate...', 1),
(31, 'Pelicula 10', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum quasi iusto voluptate...', 1),
(32, 'Pelicula 11', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum quasi iusto voluptate...', 1),
(33, 'Pelicula 12', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum quasi iusto voluptate...', 1),
(34, 'Pelicula 13', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum quasi iusto voluptate...', 1),
(35, 'Pelicula 14', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum quasi iusto voluptate...', 1),
(36, 'Pelicula 15', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum quasi iusto voluptate...', 1),
(37, 'Pelicula 16', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum quasi iusto voluptate...', 1),
(38, 'Pelicula 17', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum quasi iusto voluptate...', 1),
(39, 'Pelicula 18', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum quasi iusto voluptate...', 1),
(40, 'Pelicula 19', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum quasi iusto voluptate...', 1),
(41, 'Pelicula 20', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum quasi iusto voluptate...', 1);

INSERT INTO `users` (`id`, `username`, `status`, `status_message`, `active`, `last_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', NULL, NULL, 1, NULL, '2025-01-25 13:20:09', '2025-01-25 13:20:09', NULL);

INSERT INTO `usuarios` (`id`, `usuario`, `email`, `contrasena`, `tipo`) VALUES
(2, 'admin', 'admin@admin.com', '$2y$10$w9xsPNbyhoMJ4k.MaWGui.0JIYSE0ykOOsnwjwbAO8svsMI8JLd8C', 'admin');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;