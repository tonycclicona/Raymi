-- =============================================================================
-- Unu Raymi - MySQL Database Schema for Hostinger Web Business
-- Compatible with MariaDB / MySQL 5.7+ / MySQL 8.x
-- =============================================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- -----------------------------------------------------------------------------
-- Table: settings
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `settings` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `brand_name` VARCHAR(100) NOT NULL DEFAULT 'Unu Raymi',
  `tagline` VARCHAR(255) DEFAULT 'Bespoke Luxury Journeys to Peru & South America',
  `email` VARCHAR(150) NOT NULL DEFAULT 'concierge@unu-raymi.com',
  `phone` VARCHAR(50) DEFAULT '+51 84 263 456',
  `whatsapp` VARCHAR(50) DEFAULT '+51 915 082 539',
  `address` VARCHAR(255) DEFAULT 'Plaza Nazarenas 211, Cusco, Peru',
  `currency` VARCHAR(10) DEFAULT 'USD',
  `instagram` VARCHAR(255) DEFAULT 'https://instagram.com/unuraymitravel',
  `facebook` VARCHAR(255) DEFAULT 'https://facebook.com/unuraymitravel',
  `founded_year` VARCHAR(10) DEFAULT '2010',
  `social_impact_initiative` VARCHAR(255) DEFAULT 'Yaku Kausay Andean Water & Heritage Fund',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Table: destinations
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `destinations` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `country` VARCHAR(50) NOT NULL DEFAULT 'peru',
  `name` VARCHAR(150) NOT NULL,
  `slug` VARCHAR(150) NOT NULL UNIQUE,
  `subtitle` VARCHAR(255) DEFAULT NULL,
  `image` TEXT DEFAULT NULL,
  `excerpt` TEXT DEFAULT NULL,
  `has_form` TINYINT(1) DEFAULT 0,
  `highlights` JSON DEFAULT NULL,
  `signature_tours` JSON DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Table: tours
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `tours` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(200) NOT NULL,
  `slug` VARCHAR(200) NOT NULL UNIQUE,
  `duration_days` INT NOT NULL DEFAULT 1,
  `category` VARCHAR(100) DEFAULT 'Iconic Luxury',
  `country` VARCHAR(50) DEFAULT 'peru',
  `featured` TINYINT(1) DEFAULT 0,
  `image` TEXT DEFAULT NULL,
  `tagline` VARCHAR(255) DEFAULT NULL,
  `overview` TEXT DEFAULT NULL,
  `inclusions` JSON DEFAULT NULL,
  `exclusions` JSON DEFAULT NULL,
  `itinerary` JSON DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Table: travel_styles
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `travel_styles` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `slug` VARCHAR(100) NOT NULL UNIQUE,
  `description` TEXT DEFAULT NULL,
  `icon` VARCHAR(50) DEFAULT 'compass',
  `image` TEXT DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Table: leads (Inquiries CRM)
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `leads` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `first_name` VARCHAR(100) NOT NULL,
  `last_name` VARCHAR(100) DEFAULT NULL,
  `email` VARCHAR(150) NOT NULL,
  `phone` VARCHAR(50) DEFAULT NULL,
  `destination` VARCHAR(100) DEFAULT 'Peru',
  `travel_date` VARCHAR(100) DEFAULT NULL,
  `trip_length` VARCHAR(100) DEFAULT NULL,
  `travelers` VARCHAR(100) DEFAULT '2 adults',
  `budget` VARCHAR(100) DEFAULT '$8,000 - $12,000 per person',
  `accommodation` VARCHAR(100) DEFAULT 'Luxury (5-star)',
  `source` VARCHAR(100) DEFAULT 'Website Direct',
  `status` ENUM('New', 'Contacted', 'Booked', 'Archived') DEFAULT 'New',
  `notes` TEXT DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
