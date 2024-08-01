-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 30 2024 г., 20:26
-- Версия сервера: 5.7.39
-- Версия PHP: 8.1.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `airlinesMar`
--

-- --------------------------------------------------------

--
-- Структура таблицы `airplanes`
--

CREATE TABLE `airplanes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `number` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `airplanes`
--

INSERT INTO `airplanes` (`id`, `number`, `created_at`, `updated_at`) VALUES
(4, 'Самолет 1', '2023-12-27 05:50:10', '2023-12-27 05:50:10'),
(5, 'Самолет 2', '2023-12-27 05:50:15', '2023-12-27 05:50:15'),
(6, 'Самолет 3', '2023-12-27 05:50:20', '2023-12-27 05:50:20'),
(7, 'Самолет 4', '2023-12-27 05:50:26', '2023-12-27 05:50:26'),
(8, 'Самолет 5', '2023-12-27 05:50:31', '2023-12-27 05:50:31'),
(9, 'Самолет 6', '2023-12-27 05:50:49', '2023-12-27 05:50:49'),
(10, 'Самолет 7', '2023-12-27 05:50:58', '2023-12-27 05:50:58');

-- --------------------------------------------------------

--
-- Структура таблицы `airports`
--

CREATE TABLE `airports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `airports`
--

INSERT INTO `airports` (`id`, `title`, `city_id`, `address`, `created_at`, `updated_at`) VALUES
(9, 'Аэропорт Москва', 8, 'адрес аэропорта Москвы', '2023-12-27 05:58:48', '2023-12-27 05:58:48'),
(10, 'Аэропорт Нижний Новгород', 9, 'пр-т. Героев, 11, Нижний Новгород', '2023-12-27 05:59:03', '2023-12-27 05:59:03'),
(11, 'Аэропорт Волгоград', 10, 'ул. Фильченкова, 1, Нижний Новгород', '2023-12-27 05:59:45', '2023-12-27 05:59:45'),
(12, 'Аэропорт Казань', 11, 'ул. Фильченкова, 1, Нижний Новгород', '2023-12-27 06:00:00', '2023-12-27 06:00:00'),
(13, 'Аэропорт Астрахань', 12, 'площадь Революции, 9, Нижний Новгород', '2023-12-27 06:00:11', '2023-12-27 06:00:11');

-- --------------------------------------------------------

--
-- Структура таблицы `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cities`
--

INSERT INTO `cities` (`id`, `name`, `img`, `created_at`, `updated_at`) VALUES
(8, 'Москва', '/storage/public/img/X99CzNL5vmU1AK6EI5NZU6WND8R24S1ThtE7WsDe.jpg', '2023-12-27 05:48:00', '2023-12-27 05:48:00'),
(9, 'Нижний Новгород', '/storage/public/img/9IgGjybXKPWPf8zqS7gEoOtwbvV07AQVjvNseBOz.jpg', '2023-12-27 05:48:42', '2023-12-27 05:48:42'),
(10, 'Волгоград', '/storage/public/img/mUpLMrxFx5ahvwLtnRufA50Kr0BhzzHJBWj4pWPd.jpg', '2023-12-27 05:48:56', '2023-12-27 05:48:56'),
(11, 'Казань', '/storage/public/img/9k1QLNrXOZFmP9qexZHVgy662H3kArlNDu9X90OT.jpg', '2023-12-27 05:49:05', '2023-12-27 05:49:05'),
(12, 'Астрахань', '/storage/public/img/Ee2IFsbH1V3soiFR8rcn6KXNDvUJ6FZwWo1Xq5cU.jpg', '2023-12-27 05:49:18', '2023-12-27 05:49:18');

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `flights`
--

CREATE TABLE `flights` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city_from_id` bigint(20) UNSIGNED NOT NULL,
  `city_to_id` bigint(20) UNSIGNED NOT NULL,
  `airport_from_id` bigint(20) UNSIGNED NOT NULL,
  `airport_to_id` bigint(20) UNSIGNED NOT NULL,
  `number` varchar(255) NOT NULL,
  `price` double(8,2) NOT NULL,
  `procent` double(8,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'готов',
  `airplane_id` bigint(20) UNSIGNED NOT NULL,
  `departure_time` datetime NOT NULL,
  `arrival_time` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `flights`
--

INSERT INTO `flights` (`id`, `city_from_id`, `city_to_id`, `airport_from_id`, `airport_to_id`, `number`, `price`, `procent`, `status`, `airplane_id`, `departure_time`, `arrival_time`, `created_at`, `updated_at`) VALUES
(6, 8, 9, 9, 10, 'Рейс 1', 4000.00, 23.00, 'в полёте', 4, '2023-12-27 16:00:00', '2023-12-27 22:01:00', '2023-12-27 06:01:26', '2023-12-27 06:08:12'),
(7, 8, 10, 9, 11, 'Рейс 2', 2500.00, 23.00, 'готов', 5, '2023-12-28 07:07:00', '2023-12-28 16:02:00', '2023-12-27 06:02:33', '2023-12-27 06:02:33'),
(8, 9, 11, 10, 12, 'Рейс 3', 14300.00, 23.00, 'готов', 6, '2023-12-28 15:03:00', '2023-12-27 17:03:00', '2023-12-27 06:03:24', '2023-12-27 06:03:24'),
(9, 11, 12, 12, 13, 'Рейс 4', 13000.00, 12.00, 'готов', 7, '2023-12-28 14:03:00', '2023-12-28 00:03:00', '2023-12-27 06:03:56', '2023-12-27 06:03:56');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_12_16_052323_create_airplanes_table', 1),
(6, '2023_12_16_052333_create_seats_table', 1),
(7, '2023_12_16_052343_create_cities_table', 1),
(8, '2023_12_16_052354_create_airports_table', 1),
(9, '2023_12_16_052429_create_flights_table', 1),
(16, '2023_12_16_052547_create_tikets_table', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `seats`
--

CREATE TABLE `seats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `number` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'свободно',
  `airplane_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `seats`
--

INSERT INTO `seats` (`id`, `number`, `status`, `airplane_id`, `created_at`, `updated_at`) VALUES
(31, '1', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(32, '2', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(33, '3', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(34, '4', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(35, '5', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(36, '6', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(37, '7', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(38, '8', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(39, '9', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(40, '10', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(41, '11', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(42, '12', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(43, '13', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(44, '14', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(45, '15', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(46, '16', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(47, '17', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(48, '18', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(49, '19', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(50, '20', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(51, '21', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(52, '22', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(53, '23', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(54, '24', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(55, '25', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(56, '26', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(57, '27', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(58, '28', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(59, '29', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(60, '30', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(61, '31', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(62, '32', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(63, '33', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(64, '34', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(65, '35', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(66, '36', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(67, '37', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(68, '38', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(69, '39', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(70, '40', 'свободно', 4, '2023-12-27 05:53:22', '2023-12-27 05:53:22'),
(71, '1', 'свободно', 5, '2023-12-27 05:53:57', '2023-12-27 05:53:57'),
(72, '2', 'занято', 5, '2023-12-27 05:53:57', '2023-12-27 06:07:49'),
(73, '3', 'свободно', 5, '2023-12-27 05:53:57', '2023-12-27 05:53:57'),
(74, '4', 'свободно', 5, '2023-12-27 05:53:57', '2023-12-27 05:53:57'),
(75, '5', 'свободно', 5, '2023-12-27 05:53:57', '2023-12-27 05:53:57'),
(76, '6', 'свободно', 5, '2023-12-27 05:53:57', '2023-12-27 05:53:57'),
(77, '7', 'свободно', 5, '2023-12-27 05:53:57', '2023-12-27 05:53:57'),
(78, '8', 'свободно', 5, '2023-12-27 05:53:57', '2023-12-27 05:53:57'),
(79, '9', 'свободно', 5, '2023-12-27 05:53:57', '2023-12-27 05:53:57'),
(80, '10', 'свободно', 5, '2023-12-27 05:53:57', '2023-12-27 05:53:57'),
(81, '11', 'свободно', 5, '2023-12-27 05:53:57', '2023-12-27 05:53:57'),
(82, '12', 'свободно', 5, '2023-12-27 05:53:57', '2023-12-27 05:53:57'),
(83, '13', 'свободно', 5, '2023-12-27 05:53:57', '2023-12-27 05:53:57'),
(84, '14', 'свободно', 5, '2023-12-27 05:53:57', '2023-12-27 05:53:57'),
(85, '15', 'свободно', 5, '2023-12-27 05:53:57', '2023-12-27 05:53:57'),
(86, '1', 'свободно', 6, '2023-12-27 05:55:01', '2023-12-27 05:55:01'),
(87, '2', 'свободно', 6, '2023-12-27 05:55:01', '2023-12-27 05:55:01'),
(88, '3', 'свободно', 6, '2023-12-27 05:55:01', '2023-12-27 05:55:01'),
(89, '4', 'свободно', 6, '2023-12-27 05:55:01', '2023-12-27 05:55:01'),
(90, '5', 'свободно', 6, '2023-12-27 05:55:01', '2023-12-27 05:55:01'),
(91, '6', 'свободно', 6, '2023-12-27 05:55:01', '2023-12-27 05:55:01'),
(92, '7', 'свободно', 6, '2023-12-27 05:55:01', '2023-12-27 05:55:01'),
(93, '8', 'свободно', 6, '2023-12-27 05:55:01', '2023-12-27 05:55:01'),
(94, '9', 'свободно', 6, '2023-12-27 05:55:01', '2023-12-27 05:55:01'),
(95, '10', 'свободно', 6, '2023-12-27 05:55:01', '2023-12-27 05:55:01'),
(96, '11', 'свободно', 6, '2023-12-27 05:55:01', '2023-12-27 05:55:01'),
(97, '12', 'свободно', 6, '2023-12-27 05:55:01', '2023-12-27 05:55:01'),
(98, '13', 'свободно', 6, '2023-12-27 05:55:01', '2023-12-27 05:55:01'),
(99, '14', 'свободно', 6, '2023-12-27 05:55:01', '2023-12-27 05:55:01'),
(100, '15', 'свободно', 6, '2023-12-27 05:55:01', '2023-12-27 05:55:01'),
(101, '1', 'свободно', 7, '2023-12-27 05:56:18', '2023-12-27 05:56:18'),
(102, '2', 'свободно', 7, '2023-12-27 05:56:18', '2023-12-27 05:56:18'),
(103, '3', 'свободно', 7, '2023-12-27 05:56:18', '2023-12-27 05:56:18'),
(104, '4', 'свободно', 7, '2023-12-27 05:56:18', '2023-12-27 05:56:18'),
(105, '5', 'свободно', 7, '2023-12-27 05:56:18', '2023-12-27 05:56:18'),
(106, '6', 'свободно', 7, '2023-12-27 05:56:18', '2023-12-27 05:56:18'),
(107, '7', 'свободно', 7, '2023-12-27 05:56:18', '2023-12-27 05:56:18'),
(108, '8', 'свободно', 7, '2023-12-27 05:56:18', '2023-12-27 05:56:18'),
(109, '9', 'свободно', 7, '2023-12-27 05:56:18', '2023-12-27 05:56:18'),
(110, '10', 'свободно', 7, '2023-12-27 05:56:18', '2023-12-27 05:56:18'),
(111, '11', 'свободно', 7, '2023-12-27 05:56:18', '2023-12-27 05:56:18'),
(112, '12', 'свободно', 7, '2023-12-27 05:56:18', '2023-12-27 05:56:18'),
(113, '13', 'свободно', 7, '2023-12-27 05:56:18', '2023-12-27 05:56:18'),
(114, '14', 'свободно', 7, '2023-12-27 05:56:18', '2023-12-27 05:56:18'),
(115, '15', 'свободно', 7, '2023-12-27 05:56:18', '2023-12-27 05:56:18'),
(116, '1', 'свободно', 8, '2023-12-27 05:57:14', '2023-12-27 05:57:14'),
(117, '2', 'свободно', 8, '2023-12-27 05:57:14', '2023-12-27 05:57:14'),
(118, '3', 'свободно', 8, '2023-12-27 05:57:14', '2023-12-27 05:57:14'),
(119, '4', 'свободно', 8, '2023-12-27 05:57:14', '2023-12-27 05:57:14'),
(120, '5', 'свободно', 8, '2023-12-27 05:57:14', '2023-12-27 05:57:14'),
(121, '6', 'свободно', 8, '2023-12-27 05:57:14', '2023-12-27 05:57:14'),
(122, '7', 'свободно', 8, '2023-12-27 05:57:14', '2023-12-27 05:57:14'),
(123, '8', 'свободно', 8, '2023-12-27 05:57:14', '2023-12-27 05:57:14'),
(124, '9', 'свободно', 8, '2023-12-27 05:57:14', '2023-12-27 05:57:14'),
(125, '10', 'свободно', 8, '2023-12-27 05:57:14', '2023-12-27 05:57:14'),
(126, '11', 'свободно', 8, '2023-12-27 05:57:14', '2023-12-27 05:57:14'),
(127, '12', 'свободно', 8, '2023-12-27 05:57:14', '2023-12-27 05:57:14'),
(128, '13', 'свободно', 8, '2023-12-27 05:57:14', '2023-12-27 05:57:14'),
(129, '14', 'свободно', 8, '2023-12-27 05:57:14', '2023-12-27 05:57:14'),
(130, '15', 'свободно', 8, '2023-12-27 05:57:14', '2023-12-27 05:57:14'),
(131, '1', 'свободно', 9, '2023-12-27 05:58:04', '2023-12-27 05:58:04'),
(132, '2', 'свободно', 9, '2023-12-27 05:58:04', '2023-12-27 05:58:04'),
(133, '3', 'свободно', 9, '2023-12-27 05:58:05', '2023-12-27 05:58:05'),
(134, '4', 'свободно', 9, '2023-12-27 05:58:05', '2023-12-27 05:58:05'),
(135, '5', 'свободно', 9, '2023-12-27 05:58:05', '2023-12-27 05:58:05'),
(136, '6', 'свободно', 9, '2023-12-27 05:58:05', '2023-12-27 05:58:05'),
(137, '7', 'свободно', 9, '2023-12-27 05:58:05', '2023-12-27 05:58:05'),
(138, '8', 'свободно', 9, '2023-12-27 05:58:05', '2023-12-27 05:58:05'),
(139, '9', 'свободно', 9, '2023-12-27 05:58:05', '2023-12-27 05:58:05'),
(140, '10', 'свободно', 9, '2023-12-27 05:58:05', '2023-12-27 05:58:05'),
(141, '11', 'свободно', 9, '2023-12-27 05:58:05', '2023-12-27 05:58:05'),
(142, '12', 'свободно', 9, '2023-12-27 05:58:05', '2023-12-27 05:58:05'),
(143, '13', 'свободно', 9, '2023-12-27 05:58:05', '2023-12-27 05:58:05'),
(144, '14', 'свободно', 9, '2023-12-27 05:58:05', '2023-12-27 05:58:05'),
(145, '15', 'свободно', 9, '2023-12-27 05:58:05', '2023-12-27 05:58:05');

-- --------------------------------------------------------

--
-- Структура таблицы `tikets`
--

CREATE TABLE `tikets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `birth_certificate_num` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date NOT NULL,
  `seat_id` bigint(20) UNSIGNED NOT NULL,
  `flight_id` bigint(20) UNSIGNED NOT NULL,
  `price` double(8,2) NOT NULL,
  `fio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fio_buy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_seria_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'бронь',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tikets`
--

INSERT INTO `tikets` (`id`, `user_id`, `birth_certificate_num`, `birthday`, `seat_id`, `flight_id`, `price`, `fio`, `fio_buy`, `passport_seria_number`, `status`, `created_at`, `updated_at`) VALUES
(7, 5, NULL, '2023-12-05', 72, 7, 3075.00, 'Лиана Марина Юрьевна', NULL, '1234561234', 'бронь', '2023-12-27 06:07:49', '2023-12-27 06:07:49');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fio` varchar(255) NOT NULL,
  `birthday_date` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `fio`, `birthday_date`, `email`, `phone`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(5, 'Лиана Марина Юрьевна', '2004-03-05', 'liana.marina.2004@mail.ru', '89040462334', NULL, '8c09869aa2bd1e3de45d9453394a585a', 1, NULL, '2023-12-27 05:44:35', '2023-12-27 05:44:35'),
(6, 'Юлия Марина Юрьевна', '2006-04-23', 'gekafol721@turuma.com', '99999999999', NULL, 'e10adc3949ba59abbe56e057f20f883e', 0, NULL, '2023-12-27 05:45:20', '2023-12-27 05:45:20'),
(7, 'Юлия', '2023-11-28', 'gekafolhhh721@turuma.com', '11111111111', NULL, 'e10adc3949ba59abbe56e057f20f883e', 0, NULL, '2023-12-27 06:06:47', '2023-12-27 06:06:47');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `airplanes`
--
ALTER TABLE `airplanes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `airports`
--
ALTER TABLE `airports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `airports_city_id_foreign` (`city_id`);

--
-- Индексы таблицы `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flights_airplane_id_foreign` (`airplane_id`),
  ADD KEY `flights_city_from_id_foreign` (`city_from_id`),
  ADD KEY `flights_city_to_id_foreign` (`city_to_id`),
  ADD KEY `flights_airport_from_id_foreign` (`airport_from_id`),
  ADD KEY `flights_airport_to_id_foreign` (`airport_to_id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seats_airplane_id_foreign` (`airplane_id`);

--
-- Индексы таблицы `tikets`
--
ALTER TABLE `tikets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tikets_passport_seria_number_unique` (`passport_seria_number`),
  ADD KEY `tikets_user_id_foreign` (`user_id`),
  ADD KEY `tikets_seat_id_foreign` (`seat_id`),
  ADD KEY `tikets_flight_id_foreign` (`flight_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `airplanes`
--
ALTER TABLE `airplanes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `airports`
--
ALTER TABLE `airports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `flights`
--
ALTER TABLE `flights`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `seats`
--
ALTER TABLE `seats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT для таблицы `tikets`
--
ALTER TABLE `tikets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `airports`
--
ALTER TABLE `airports`
  ADD CONSTRAINT `airports_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `flights`
--
ALTER TABLE `flights`
  ADD CONSTRAINT `flights_airplane_id_foreign` FOREIGN KEY (`airplane_id`) REFERENCES `airplanes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `flights_airport_from_id_foreign` FOREIGN KEY (`airport_from_id`) REFERENCES `airports` (`id`),
  ADD CONSTRAINT `flights_airport_to_id_foreign` FOREIGN KEY (`airport_to_id`) REFERENCES `airports` (`id`),
  ADD CONSTRAINT `flights_city_from_id_foreign` FOREIGN KEY (`city_from_id`) REFERENCES `cities` (`id`),
  ADD CONSTRAINT `flights_city_to_id_foreign` FOREIGN KEY (`city_to_id`) REFERENCES `cities` (`id`);

--
-- Ограничения внешнего ключа таблицы `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `seats_airplane_id_foreign` FOREIGN KEY (`airplane_id`) REFERENCES `airplanes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tikets`
--
ALTER TABLE `tikets`
  ADD CONSTRAINT `tikets_flight_id_foreign` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tikets_seat_id_foreign` FOREIGN KEY (`seat_id`) REFERENCES `seats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tikets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
