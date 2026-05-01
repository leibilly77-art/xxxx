CREATE TABLE IF NOT EXISTS `xpay_admins` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(64) NOT NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  `nickname` VARCHAR(64) NOT NULL DEFAULT '',
  `status` TINYINT UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=启用,0=停用',
  `last_login_at` DATETIME NULL DEFAULT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_xpay_admins_username` (`username`),
  KEY `idx_xpay_admins_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='XPAY后台管理员';

INSERT INTO `xpay_admins` (
  `username`,
  `password_hash`,
  `nickname`,
  `status`,
  `created_at`,
  `updated_at`
) VALUES (
  'admin',
  '$2y$10$H0V2x6sv5Jvo39XW1VwICuF8VgbaqAyGK03MuiMtlIzDkLDWLWERC',
  '超级管理员',
  1,
  NOW(),
  NOW()
) ON DUPLICATE KEY UPDATE
  `nickname` = VALUES(`nickname`),
  `status` = VALUES(`status`);
