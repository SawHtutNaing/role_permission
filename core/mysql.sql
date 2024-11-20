-- -------------------------------------------------------------
-- -------------------------------------------------------------
-- TablePlus 1.1.8
--
-- https://tableplus.com/
--
-- Database: mysql
-- Generation Time: 2024-11-20 20:50:54.944102
-- -------------------------------------------------------------

DROP TABLE `role_pp_test`.`blogs`;


CREATE TABLE `blogs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blogs_user_id_foreign` (`user_id`),
  CONSTRAINT `blogs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE `role_pp_test`.`cache`;


CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE `role_pp_test`.`cache_locks`;


CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE `role_pp_test`.`failed_jobs`;


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

DROP TABLE `role_pp_test`.`features`;


CREATE TABLE `features` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE `role_pp_test`.`job_batches`;


CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE `role_pp_test`.`jobs`;


CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE `role_pp_test`.`migrations`;


CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE `role_pp_test`.`password_reset_tokens`;


CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE `role_pp_test`.`permissions`;


CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feature_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permissions_feature_id_foreign` (`feature_id`),
  CONSTRAINT `permissions_feature_id_foreign` FOREIGN KEY (`feature_id`) REFERENCES `features` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE `role_pp_test`.`role_permission`;


CREATE TABLE `role_permission` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint unsigned NOT NULL,
  `permission_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_permission_role_id_foreign` (`role_id`),
  KEY `role_permission_permission_id_foreign` (`permission_id`),
  CONSTRAINT `role_permission_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_permission_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE `role_pp_test`.`role_permissions`;


CREATE TABLE `role_permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint unsigned NOT NULL,
  `permissions_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_permissions_role_id_foreign` (`role_id`),
  KEY `role_permissions_permissions_id_foreign` (`permissions_id`),
  CONSTRAINT `role_permissions_permissions_id_foreign` FOREIGN KEY (`permissions_id`) REFERENCES `permissions` (`id`),
  CONSTRAINT `role_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE `role_pp_test`.`roles`;


CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE `role_pp_test`.`sessions`;


CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE `role_pp_test`.`users`;


CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint unsigned DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `role_pp_test`.`blogs` (`id`, `title`, `content`, `user_id`, `created_at`, `updated_at`) VALUES 
(3, 'Quis exercitationem ', 'Voluptatem praesenti', 1, '2024-11-20 13:34:04', '2024-11-20 13:34:04'),
(4, 'Cupidatat vitae repe', 'Quidem et ea aliquid', 1, '2024-11-20 14:17:17', '2024-11-20 14:17:17');

INSERT INTO `role_pp_test`.`features` (`id`, `name`, `created_at`, `updated_at`) VALUES 
(1, 'user_management', '2024-11-20 13:02:36', '2024-11-20 13:02:36'),
(2, 'blog_management', '2024-11-20 13:02:36', '2024-11-20 13:02:36'),
(3, 'sss', NULL, NULL),
(4, 'sss', NULL, NULL);

INSERT INTO `role_pp_test`.`migrations` (`id`, `migration`, `batch`) VALUES 
(1, '0000_11_09_171602_create_roles_table', 1),
(2, '0001_01_01_000000_create_users_table', 1),
(3, '0001_01_01_000001_create_cache_table', 1),
(4, '0001_01_01_000002_create_jobs_table', 1),
(5, '2023_11_09_171618_create_features_table', 1),
(6, '2024_11_09_171607_create_permissions_table', 1),
(7, '2024_11_09_171612_create_blogs_table', 1),
(8, '2024_11_09_182544_create_role_permissions_table', 1),
(9, '2024_11_09_194024_create_role_permission_table', 1);

INSERT INTO `role_pp_test`.`permissions` (`id`, `name`, `feature_id`, `created_at`, `updated_at`) VALUES 
(1, 'user_create', 1, '2024-11-20 13:02:36', '2024-11-20 13:02:36'),
(2, 'user_view', 1, '2024-11-20 13:02:36', '2024-11-20 13:02:36'),
(3, 'user_update', 1, '2024-11-20 13:02:36', '2024-11-20 13:02:36'),
(4, 'user_delete', 1, '2024-11-20 13:02:36', '2024-11-20 13:02:36'),
(5, 'blog_create', 2, '2024-11-20 13:02:36', '2024-11-20 13:02:36'),
(6, 'blog_view', 2, '2024-11-20 13:02:36', '2024-11-20 13:02:36'),
(7, 'blog_update', 2, '2024-11-20 13:02:36', '2024-11-20 13:02:36'),
(8, 'blog_delete', 2, '2024-11-20 13:02:36', '2024-11-20 13:02:36'),
(9, 'ddd', 1, NULL, NULL),
(10, 'ss', 2, NULL, NULL),
(11, 'Avye Drake', 3, NULL, NULL);

INSERT INTO `role_pp_test`.`role_permission` (`id`, `role_id`, `permission_id`, `created_at`, `updated_at`) VALUES 
(9, 2, 5, NULL, NULL),
(10, 2, 6, NULL, NULL),
(11, 2, 7, NULL, NULL),
(12, 2, 8, NULL, NULL),
(26, 3, 1, NULL, NULL),
(27, 3, 2, NULL, NULL),
(28, 3, 3, NULL, NULL),
(29, 3, 4, NULL, NULL),
(30, 3, 9, NULL, NULL),
(31, 3, 5, NULL, NULL),
(32, 3, 6, NULL, NULL),
(33, 3, 7, NULL, NULL),
(34, 3, 8, NULL, NULL),
(35, 1, 1, NULL, NULL),
(36, 1, 3, NULL, NULL),
(37, 1, 4, NULL, NULL),
(38, 1, 5, NULL, NULL),
(39, 1, 6, NULL, NULL),
(40, 1, 7, NULL, NULL),
(41, 1, 8, NULL, NULL);

INSERT INTO `role_pp_test`.`roles` (`id`, `name`, `created_at`, `updated_at`) VALUES 
(1, 'admin', '2024-11-20 13:02:36', '2024-11-20 13:02:36'),
(2, 'user', '2024-11-20 13:02:36', '2024-11-20 13:02:36'),
(3, 'ddd', NULL, NULL);

INSERT INTO `role_pp_test`.`users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES 
(1, 'admin', 'admin@gmail.com', NULL, '$2y$12$/F7CwIWfeliIFZ3QzCKcL.7G8.DOYN31OqM55G/AqU4dX0.CvbSkS', 1, NULL, '2024-11-20 13:02:37', '2024-11-20 13:02:37'),
(2, 'Samuel Sosa', 'puzasok@mailinator.com', NULL, '$2y$10$Z9NZ/YsNIbYcOl9ALu782uqocCDRhS7qBDlo8IWczUNPj0tSdMs0C', 2, '74b297184bd4751a5d2ca53e08f5ee6e625d9f7a8179f0e4465d7df4b90a', NULL, NULL),
(3, 'aa', 'aa@gmail.com', NULL, '$2y$10$ftySFNtFVeoy3Is41Phf5e8u3Jo7jkZ/ETtx3kEOq.F1XRCDRUuwy', 1, '7d726cd8082ebcf90581563ff03de684de398752e842b2a527d3c80f6507', NULL, NULL),
(4, 'Cherokee Horton', 'vylowyhyl@mailinator.com', NULL, '$2y$10$5Vq3kyIm1KRFTAS56gYEB.QDL0B2olsT/pDu4L0mJvCY5O3VVKoUW', 2, '0bb9ce457ec0bb3bad93b7fcf0f2d4c09f52580e9bc93cbbcb0f541860ea', NULL, NULL),
(5, 'Shana Norman', 'muco@mailinator.com', NULL, '$2y$10$.zq5Xv9o5JyDJgcBhM8Do.CgNnUyF87rFv1s83yYrLaA9FUEJrSuW', 2, '7d25ef5da7bd294c213dff9604ee39d5c820b00a6a2a93e93cbdf3b1a8e4', NULL, NULL),
(6, 'Wynne Ewing', 'cywajuqep@mailinator.com', NULL, '$2y$10$2DARvMtnRfHwYvYr/AJlMOmFISircv0VFxrj82yK2yeU9e..S21a.', 1, '72d8a2f5abf926fe17776af21ea19b05667dfd0e043149fd2959e0d12ebb', NULL, NULL),
(7, 'Althea Boone', 'fepawero@mailinator.com', NULL, '$2y$10$wXx5U6McS0KBTZhfPA4IM.LPkqOMzsAffxgNFP4JXQ7tdPcT74cCa', 3, '563714ee8b39c23734fb9c36e872434bb1fcbbe531b5956c88216972ea33', NULL, NULL),
(8, 'Benedict Neal', 'kedobecixe@mailinator.com', NULL, '$2y$10$80aUk41a6hx/ptOHbccFxOm3ji2.0F//uIS1YjxcxWOcAnvycJBSy', 2, '9ffe70abe803fe39bed9e159a016dcf6c33e02e669cd91f994e079c97332', NULL, NULL),
(9, 'Zephania Cantrell', 'topy@mailinator.com', NULL, '$2y$10$./bDySEMUeJRMEgdNsfSCeLKFvjcAkVdLpmnyz5GOD0ETo.8z03J2', 1, NULL, NULL, NULL);

