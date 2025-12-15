-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2025 at 05:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `avipro`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `travel_date` date DEFAULT NULL,
  `num_persons` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` enum('new','viewed','confirmed','cancelled') DEFAULT 'new',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `name`, `email`, `phone`, `package_id`, `destination`, `travel_date`, `num_persons`, `message`, `status`, `created_at`) VALUES
(1, 'Anurag Thakur', 'atiampro6@gmail.com', '09140189784', 5, 'bhopal', '2025-12-20', 1, 'want to book', 'new', '2025-12-03 17:33:11'),
(2, 'kaushal tanna', 'kaushaltanna2007@gmail.com', '9157798931', 1, 'kashmir ', '2025-12-25', 1, 'want to know about the package ', 'new', '2025-12-03 17:34:30');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `short_desc` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT 0.00,
  `duration` varchar(100) DEFAULT NULL,
  `itinerary` text DEFAULT NULL,
  `highlights` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `title`, `slug`, `short_desc`, `description`, `price`, `duration`, `itinerary`, `highlights`, `created_at`, `updated_at`, `active`) VALUES
(1, 'Kashmir Delight', 'kashmir-delight', 'Experience the beauty of Kashmir with serene lakes, snowy mountains, Mughal gardens, and unforgettable moments.', 'Kashmir, often called “Paradise on Earth”, offers breathtaking landscapes, peaceful lakes, green valleys, and the magnificent Himalayas.\r\nThis trip gives you the perfect blend of nature, adventure, culture, and relaxation.\r\n\r\nEnjoy a relaxing Shikara ride on Dal Lake, explore the Mughal Gardens, witness the snowy slopes of Gulmarg, and experience the peaceful charm of Pahalgam.\r\nThis tour is perfect for couples, families, and travelers seeking a magical mountain escape.', 4999.00, '4 Days / 3 Nights', 'Day 1 – Arrival in Srinagar\r\n\r\nPickup from airport\r\n\r\nCheck-in at houseboat / hotel\r\n\r\nShikara ride on Dal Lake\r\n\r\nVisit local markets\r\n\r\nOvernight stay in Srinagar\r\n\r\nDay 2 – Gulmarg Excursion\r\n\r\nBreakfast at hotel\r\n\r\nDrive to Gulmarg (Meadows of Flowers)\r\n\r\nGondola Cable Car ride (optional)\r\n\r\nEnjoy snow activities (seasonal)\r\n\r\nReturn to Srinagar\r\n\r\nOvernight stay\r\n\r\nDay 3 – Pahalgam Tour\r\n\r\nBreakfast\r\n\r\nDrive to Pahalgam (Valley of Shepherds)\r\n\r\nVisit Aru Valley, Betaab Valley & Chandanwari\r\n\r\nEnjoy river-side views & photography\r\n\r\nReturn to Srinagar\r\n\r\nOvernight stay\r\n\r\nDay 4 – Mughal Gardens & Departure\r\n\r\nVisit Shalimar Bagh, Nishat Bagh & Chashme Shahi\r\n\r\nShopping for Kashmiri handicrafts\r\n\r\nDrop at airport\r\n\r\nTour ends with beautiful memories', 'Scenic Shikara ride on Dal Lake\r\n\r\nVisit to Gulmarg & Gondola Experience\r\n\r\nPahalgam valley exploration\r\n\r\nMughal Gardens tour\r\n\r\nHimalayan views & snow activities\r\n\r\nComfortable hotel stay\r\n\r\nPerfect for couples, families & honeymooners', '2025-12-02 18:24:06', '2025-12-03 17:26:35', 1),
(5, 'Bhopal City Delight', 'bhopal-city-delight', 'Discover the “City of Lakes” with its serene landscapes, vibrant culture, ancient heritage, and peaceful ambiance.', 'Bhopal, the capital city of Madhya Pradesh, offers a beautiful blend of historical monuments, natural lakes, tribal heritage, spiritual sites, and modern culture.\r\nKnown as the “City of Lakes”, Bhopal is perfect for those seeking relaxation, culture, and light adventure.\r\n\r\nThis trip gives you a complete experience of the city\'s charm, including the famous Upper Lake, the soulful Taj-ul-Masajid, the Tribal Museum, and the peaceful Van Vihar National Park.\r\nWith beautiful sunsets, local cuisine, and rich history, Bhopal is a perfect weekend getaway for families, couples, and explorers.', 5999.00, '2 Nights / 3 Days', 'Day 1 – Arrival & Lakeside Tour\r\n\r\nArrival in Bhopal\r\n\r\nCheck-in at hotel\r\n\r\nVisit Upper Lake (boat ride optional)\r\n\r\nWalk through Van Vihar National Park\r\n\r\nEnjoy local street food & lakeside views\r\n\r\nOvernight stay in Bhopal\r\n\r\nDay 2 – Museums & Heritage Walk\r\n\r\nBreakfast at hotel\r\n\r\nVisit Tribal Museum (Top attraction)\r\n\r\nExplore Manav Sangrahalaya (Museum of Man)\r\n\r\nVisit Taj-ul-Masajid – one of India’s largest mosques\r\n\r\nExplore Sadar Bazaar & local shopping\r\n\r\nReturn to hotel & overnight stay\r\n\r\nDay 3 – Temples & Departure\r\n\r\nBreakfast\r\n\r\nVisit Bhojpur Temple (ancient Shiva temple)\r\n\r\nOptional: Sanchi Stupa half-day tour\r\n\r\nDrop at station/airport\r\n\r\nTour ends with pleasant memories', 'Upper & Lower Lake\r\n\r\nVan Vihar National Park\r\n\r\nTribal Museum (must-visit)\r\n\r\nManav Sangrahalaya (anthropology museum)\r\n\r\nTaj-ul-Masajid – architectural wonder\r\n\r\nBhojpur Temple\r\n\r\nScenic views & calm environment\r\n\r\nIdeal for small vacations & cultural trips', '2025-12-03 17:30:39', '2025-12-03 17:30:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `package_images`
--

CREATE TABLE `package_images` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `is_cover` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package_images`
--

INSERT INTO `package_images` (`id`, `package_id`, `filename`, `is_cover`, `created_at`) VALUES
(3, 5, 'Screenshot 2025-12-03 230007.png', 1, '2025-12-03 17:30:39');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL,
  `meta_key` varchar(100) NOT NULL,
  `meta_value` longtext DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `meta_key`, `meta_value`, `updated_at`) VALUES
(1, 'site_title', 'Avipro Travels', '2025-12-02 18:24:06'),
(2, 'site_about', 'Welcome to Avipro Travels - sample about text', '2025-12-02 18:24:06'),
(3, 'site_contact', '{\"address\":\"Sample Address\",\"phone\":\"+911234567890\",\"email\":\"info@avipro.com\"}', '2025-12-02 18:24:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `package_images`
--
ALTER TABLE `package_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `meta_key` (`meta_key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `package_images`
--
ALTER TABLE `package_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `package_images`
--
ALTER TABLE `package_images`
  ADD CONSTRAINT `package_images_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
