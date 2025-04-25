-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2025 at 03:54 PM
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
-- Database: `coca_cola_talent_bot`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_position_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `applicant_name` varchar(255) NOT NULL,
  `applicant_email` varchar(255) NOT NULL,
  `applicant_phone` varchar(255) DEFAULT NULL,
  `cv_file_path` varchar(255) DEFAULT NULL,
  `additional_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`additional_info`)),
  `status` enum('new','reviewed','interview_scheduled','rejected','hired') NOT NULL DEFAULT 'new',
  `notes` longtext DEFAULT NULL,
  `last_status_change` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `job_position_id`, `user_id`, `applicant_name`, `applicant_email`, `applicant_phone`, `cv_file_path`, `additional_info`, `status`, `notes`, `last_status_change`, `created_at`, `updated_at`) VALUES
(1, 6, 12, 'iure', 'temporibus', 'vel', 'cumque', '\"{}\"', 'hired', 'Tempora itaque nemo rerum quos vero blanditiis expedita. Saepe nihil sit voluptatem voluptatem nulla. Praesentium ipsa iure quibusdam omnis molestiae magni.', '2014-02-23 03:56:35', '2025-04-25 07:52:17', '2025-04-25 07:52:17'),
(2, 7, 14, 'nesciunt', 'aut', 'ratione', 'nihil', '\"{}\"', 'hired', 'At illo ducimus sapiente qui id. Occaecati voluptatem eos non dolores. Dolorum quasi iste non dignissimos aliquid culpa. Commodi aut velit delectus quos cumque alias.', '2013-07-29 13:14:08', '2025-04-25 07:52:17', '2025-04-25 07:52:17'),
(3, 8, 16, 'eos', 'corrupti', 'non', 'autem', '\"{}\"', 'interview_scheduled', 'Est rerum minima voluptas qui dolorem aut fuga ut. Sequi aut explicabo sit id cum. Qui omnis sint hic voluptas fuga.', '1996-02-27 21:02:17', '2025-04-25 07:52:17', '2025-04-25 07:52:17'),
(4, 9, 18, 'reprehenderit', 'sit', 'maxime', 'perferendis', '\"{}\"', 'new', 'Qui molestiae labore distinctio error quo omnis molestiae. Qui soluta quia labore explicabo sapiente. Voluptates itaque quo autem sunt voluptatibus nam.', '2013-01-10 01:11:06', '2025-04-25 07:52:17', '2025-04-25 07:52:17'),
(5, 10, 20, 'cum', 'aut', 'ex', 'vel', '\"{}\"', 'hired', 'Magnam eos iste molestiae recusandae ut unde. Maxime atque molestiae aut dolores porro assumenda in. Rerum veritatis molestiae rerum. Assumenda eveniet perferendis eaque fugiat.', '1980-03-01 14:30:29', '2025-04-25 07:52:17', '2025-04-25 07:52:17'),
(6, 21, 42, 'nihil', 'enim', 'libero', 'aut', '\"{}\"', 'new', 'Quia aut laudantium non facilis veniam dignissimos. Quia voluptatem ab laboriosam nesciunt ea. Corrupti sunt commodi facilis culpa.', '2002-08-09 08:20:26', '2025-04-25 07:52:29', '2025-04-25 07:52:29'),
(7, 23, 46, 'aliquid', 'minus', 'ea', 'illo', '\"{}\"', 'new', 'Nemo aut quisquam officia illo. Qui non repellendus eaque. Sunt numquam veniam tempora corrupti.', '2025-02-06 13:55:24', '2025-04-25 07:52:31', '2025-04-25 07:52:31'),
(8, 25, 50, 'praesentium', 'eos', 'eum', 'voluptatem', '\"{}\"', 'interview_scheduled', 'Qui in magni sequi placeat sit. Iure quo itaque asperiores sit. Omnis quo et dolores id commodi. Aut eius porro sunt ipsum sequi dicta aut.', '2023-11-11 03:26:02', '2025-04-25 07:52:33', '2025-04-25 07:52:33'),
(9, 27, 54, 'et', 'voluptatem', 'tenetur', 'cumque', '\"{}\"', 'new', 'Molestias nesciunt ut eos et. Aut cupiditate aut accusantium consectetur minima. Vel quia deleniti autem veritatis. Illo assumenda distinctio optio.', '1987-08-29 03:02:03', '2025-04-25 07:52:36', '2025-04-25 07:52:36'),
(10, 29, 58, 'adipisci', 'temporibus', 'sunt', 'eum', '\"{}\"', 'interview_scheduled', 'At voluptatem impedit et illo dolores possimus. Qui sit aut quo aliquam alias eum ipsa. Est a ipsam non corporis fugit harum.', '1984-05-28 15:50:43', '2025-04-25 07:52:38', '2025-04-25 07:52:38');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chatbot_flows`
--

CREATE TABLE `chatbot_flows` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_position_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chatbot_flows`
--

INSERT INTO `chatbot_flows` (`id`, `job_position_id`, `name`, `is_active`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 11, 'Fay Heaney IV', 1, 21, '2025-04-25 07:52:22', '2025-04-25 07:52:22'),
(2, 12, 'Sofia Tromp III', 0, 23, '2025-04-25 07:52:22', '2025-04-25 07:52:22'),
(3, 13, 'Camren Stehr', 0, 25, '2025-04-25 07:52:22', '2025-04-25 07:52:22'),
(4, 14, 'Shanny Stracke', 0, 27, '2025-04-25 07:52:22', '2025-04-25 07:52:22'),
(5, 15, 'Kameron Flatley', 1, 29, '2025-04-25 07:52:22', '2025-04-25 07:52:22'),
(6, 16, 'Ms. Cleta Berge DVM', 0, 31, '2025-04-25 07:52:23', '2025-04-25 07:52:23'),
(7, 17, 'Dr. Celestino Schultz DVM', 1, 33, '2025-04-25 07:52:25', '2025-04-25 07:52:25'),
(8, 18, 'Dr. Brandon Gottlieb', 0, 35, '2025-04-25 07:52:26', '2025-04-25 07:52:26'),
(9, 19, 'Prof. Jaren Towne Jr.', 1, 37, '2025-04-25 07:52:26', '2025-04-25 07:52:26'),
(10, 20, 'Katelyn Rau III', 0, 39, '2025-04-25 07:52:28', '2025-04-25 07:52:28'),
(11, 22, 'Coby Bradtke Sr.', 0, 43, '2025-04-25 07:52:30', '2025-04-25 07:52:30'),
(12, 24, 'Arthur Ondricka', 1, 47, '2025-04-25 07:52:32', '2025-04-25 07:52:32'),
(13, 26, 'Jan Schiller', 1, 51, '2025-04-25 07:52:34', '2025-04-25 07:52:34'),
(14, 28, 'Rasheed Donnelly', 1, 55, '2025-04-25 07:52:37', '2025-04-25 07:52:37'),
(15, 30, 'Therese Kovacek', 0, 59, '2025-04-25 07:52:39', '2025-04-25 07:52:39');

-- --------------------------------------------------------

--
-- Table structure for table `chatbot_steps`
--

CREATE TABLE `chatbot_steps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `flow_id` bigint(20) UNSIGNED NOT NULL,
  `step_order` int(11) NOT NULL,
  `message_text` longtext NOT NULL,
  `step_type` enum('greeting','question','file_request','confirmation','end') NOT NULL,
  `expected_response_type` enum('text','file','selection','none') NOT NULL,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`options`)),
  `validation_rules` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`validation_rules`)),
  `next_step_logic` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`next_step_logic`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chatbot_steps`
--

INSERT INTO `chatbot_steps` (`id`, `flow_id`, `step_order`, `message_text`, `step_type`, `expected_response_type`, `options`, `validation_rules`, `next_step_logic`, `created_at`, `updated_at`) VALUES
(1, 6, 803, 'Totam sed facilis qui quae cupiditate. Ea cum cupiditate ea totam. Dolores eius qui ullam id et id. Beatae corrupti cupiditate dolor dolor pariatur minima sunt vitae.', 'end', 'file', '\"{}\"', '\"{}\"', '\"{}\"', '2025-04-25 07:52:28', '2025-04-25 07:52:28'),
(2, 7, -4245, 'Nesciunt sed veniam ullam blanditiis placeat. Officiis dolorem aut quia illum amet ea. Omnis ut consequatur non dignissimos est eos.', 'confirmation', 'file', '\"{}\"', '\"{}\"', '\"{}\"', '2025-04-25 07:52:28', '2025-04-25 07:52:28'),
(3, 8, 8597, 'Modi sunt quasi quae et. Facilis maiores ad omnis quis doloremque. Asperiores eaque voluptatem et occaecati est commodi aut placeat.', 'greeting', 'selection', '\"{}\"', '\"{}\"', '\"{}\"', '2025-04-25 07:52:28', '2025-04-25 07:52:28'),
(4, 9, -1777, 'Officia amet beatae deleniti est. Aliquid doloribus minima tempora itaque repellat veritatis eum. Dolor saepe voluptates voluptatem totam modi vel dolores nemo.', 'end', 'selection', '\"{}\"', '\"{}\"', '\"{}\"', '2025-04-25 07:52:28', '2025-04-25 07:52:28'),
(5, 10, 6179, 'Eum iste sed est pariatur optio ut perferendis. Velit repellendus quas est aut pariatur ducimus in harum.', 'end', 'text', '\"{}\"', '\"{}\"', '\"{}\"', '2025-04-25 07:52:28', '2025-04-25 07:52:28'),
(6, 11, 2309, 'At omnis perspiciatis at officia nobis dolor. Deleniti vero omnis officia dolores omnis. Harum iste atque nisi.', 'greeting', 'text', '\"{}\"', '\"{}\"', '\"{}\"', '2025-04-25 07:52:30', '2025-04-25 07:52:30'),
(7, 12, -4045, 'Itaque libero ea possimus. Veritatis eum est praesentium molestiae repudiandae repudiandae ut.', 'file_request', 'file', '\"{}\"', '\"{}\"', '\"{}\"', '2025-04-25 07:52:32', '2025-04-25 07:52:32'),
(8, 13, 8302, 'Unde minus debitis rerum ut. Non sit dolores rem error nemo quisquam. Occaecati labore dolore inventore eos praesentium cupiditate.', 'end', 'text', '\"{}\"', '\"{}\"', '\"{}\"', '2025-04-25 07:52:34', '2025-04-25 07:52:34'),
(9, 14, -683, 'Cum accusantium perspiciatis soluta mollitia. Ipsam dolorem ut et. Tenetur voluptatum qui nisi a id sequi quas.', 'end', 'text', '\"{}\"', '\"{}\"', '\"{}\"', '2025-04-25 07:52:37', '2025-04-25 07:52:37'),
(10, 15, -4830, 'Alias fugiat saepe aut dolores vero. Nostrum est doloremque eos rerum quisquam. Et quod quis cumque.', 'confirmation', 'none', '\"{}\"', '\"{}\"', '\"{}\"', '2025-04-25 07:52:39', '2025-04-25 07:52:39');

-- --------------------------------------------------------

--
-- Table structure for table `conversation_logs`
--

CREATE TABLE `conversation_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `application_id` bigint(20) UNSIGNED DEFAULT NULL,
  `step_id` bigint(20) UNSIGNED NOT NULL,
  `user_message` longtext DEFAULT NULL,
  `bot_message` longtext DEFAULT NULL,
  `file_uploaded` tinyint(1) NOT NULL DEFAULT 0,
  `file_path` varchar(255) DEFAULT NULL,
  `session_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conversation_logs`
--

INSERT INTO `conversation_logs` (`id`, `application_id`, `step_id`, `user_message`, `bot_message`, `file_uploaded`, `file_path`, `session_id`, `created_at`, `updated_at`) VALUES
(1, 6, 6, 'Molestiae exercitationem molestiae occaecati sequi perferendis illum doloribus. Suscipit voluptatibus autem alias sit. Facilis corporis et sed consequuntur et quis.', 'Pariatur eius cupiditate voluptas ea id eum optio nihil. Magni ut nisi et in. Ad aut ut qui ex sequi error laudantium.', 0, 'fuga', 'aliquid', '2025-04-25 07:52:39', '2025-04-25 07:52:39'),
(2, 7, 7, 'Rerum quis sapiente odit est. Dolores mollitia aut expedita assumenda totam accusantium dolorem. Aut voluptas et eaque optio deserunt cum et.', 'Deserunt ut ut et corrupti cumque. Et quis qui laboriosam provident. Deserunt ea mollitia culpa ad eum dolorem pariatur. Quis consequuntur et incidunt non impedit.', 0, 'et', 'quos', '2025-04-25 07:52:39', '2025-04-25 07:52:39'),
(3, 8, 8, 'Sunt reprehenderit aut ea et officiis eius optio. Est ut et natus qui ratione rerum laborum. Velit beatae nisi sunt quo iusto ut esse.', 'Accusantium fuga alias voluptates dolorem et aut. Accusantium nihil unde voluptate est beatae occaecati maiores. Velit eveniet sapiente sit architecto natus iste.', 0, 'excepturi', 'qui', '2025-04-25 07:52:39', '2025-04-25 07:52:39'),
(4, 9, 9, 'Labore quis placeat ipsam et occaecati fuga culpa culpa. Reprehenderit qui enim quia corrupti sint quas officiis. Consequuntur perspiciatis perferendis voluptatem ut et veritatis est.', 'In cupiditate et itaque et totam. Et numquam et asperiores quia voluptas nam adipisci aut. Porro dolorem repudiandae consectetur. Quasi sequi nisi et qui minus corrupti illo necessitatibus.', 1, 'fugit', 'quia', '2025-04-25 07:52:39', '2025-04-25 07:52:39'),
(5, 10, 10, 'Quia laborum repellendus ea. Dolorem et harum ab quia necessitatibus doloribus. Aut est amet nemo. Facere est est illo harum. Ipsum dolor ut et quae et ut. Ut ea delectus vel enim quos.', 'Excepturi iste unde nobis fugit cumque. Magnam fugit quae dolorem temporibus. Ut porro aut omnis. Ipsam est sapiente et exercitationem dignissimos sint.', 1, 'veritatis', 'doloribus', '2025-04-25 07:52:39', '2025-04-25 07:52:39');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_positions`
--

CREATE TABLE `job_positions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `requirements` longtext NOT NULL,
  `responsibilities` longtext NOT NULL,
  `location` varchar(255) NOT NULL,
  `salary_range` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_positions`
--

INSERT INTO `job_positions` (`id`, `title`, `department`, `description`, `requirements`, `responsibilities`, `location`, `salary_range`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Recusandae dolorem reprehenderit nobis quas.', 'eligendi', 'Quis qui sapiente sunt tempore. Totam voluptatem praesentium delectus ipsa recusandae labore. Inventore quas quidem omnis nulla.', 'Quod placeat nesciunt rerum placeat aut distinctio numquam. Omnis vitae perferendis esse. Dolores inventore provident et quia dolorum error in. Accusantium corporis est et dolor sit eos voluptas.', 'Ratione est qui corrupti aperiam quas ullam consequuntur. Recusandae impedit eligendi cumque earum. Ut quod culpa qui debitis inventore ea. Quo totam et corporis laudantium aut et velit.', 'nostrum', 'aut', 'active', 6, '2025-04-25 07:52:11', '2025-04-25 07:52:11'),
(2, 'Cum neque in nisi tempora.', 'hic', 'Est sequi voluptates eos sint aliquam sapiente id. Quasi voluptas occaecati eum repellendus magnam minus laudantium.', 'Fugit numquam quis et possimus itaque quas iure. Sunt eius illum eaque natus. Dolorem culpa et a rerum magni quisquam et.', 'Aliquam aut est suscipit. Et ducimus quibusdam ab maiores facilis eaque. Nihil nihil quod dolorum nihil quis asperiores.', 'consequatur', 'maiores', 'inactive', 7, '2025-04-25 07:52:11', '2025-04-25 07:52:11'),
(3, 'Pariatur voluptatem vel illum aut.', 'sed', 'Iure sit officia repellendus eos sint. Aspernatur dolore hic optio reprehenderit. Voluptas rerum voluptatem ea nesciunt minima autem est.', 'Iste et illo aperiam quia. Dolores voluptatem repudiandae eaque ut. Enim dolores quia magni suscipit debitis molestias.', 'Eaque aliquam qui harum et accusamus. Unde dolor atque nihil eius quaerat ut quas. Officiis laudantium consequuntur aut est rerum voluptatem enim eum. Rem ut ut hic itaque blanditiis velit nihil.', 'ut', 'corrupti', 'active', 8, '2025-04-25 07:52:11', '2025-04-25 07:52:11'),
(4, 'Enim voluptas perferendis.', 'sunt', 'Id iure ex eius aut. Voluptate rerum voluptas alias harum amet eligendi quia ut. A consequuntur quia et dolor. Ut dolor suscipit ut placeat. Accusantium illo itaque vero veniam maxime.', 'Veritatis ea magni quibusdam inventore fuga rem. Et incidunt quia dicta sapiente recusandae adipisci quisquam. Exercitationem mollitia esse beatae ipsa. Iure asperiores eligendi in tempora.', 'Minima enim doloribus totam quaerat culpa recusandae magni. Unde possimus vitae fugiat corporis. Maxime quod necessitatibus error magnam fuga. Ducimus ullam est modi aut nulla aut voluptatem.', 'rerum', 'iusto', 'active', 9, '2025-04-25 07:52:11', '2025-04-25 07:52:11'),
(5, 'Eligendi debitis illum exercitationem delectus.', 'labore', 'Minus aliquam magni et dolore cum assumenda sed. Voluptatem dignissimos sint ratione et adipisci quod. Voluptatibus nihil commodi non esse aliquam.', 'Nobis facere veritatis saepe ipsum. Aut mollitia minima provident voluptate. Optio architecto et pariatur quo est accusamus numquam. Est explicabo ipsum nesciunt voluptates earum quia est ut.', 'Explicabo id et nisi enim ad. Dolorum ut officiis voluptate aut. Quia eveniet quos fuga rem debitis.', 'repudiandae', 'voluptatem', 'active', 10, '2025-04-25 07:52:11', '2025-04-25 07:52:11'),
(6, 'Ex dignissimos fugit.', 'molestiae', 'Magni facere unde velit temporibus mollitia. Qui in aut blanditiis inventore et eius. Et sunt et aliquid dolorum mollitia.', 'Illo et eius ea quia iusto. Blanditiis rerum quibusdam sunt nesciunt. Saepe optio eaque officiis quas. A fugit repudiandae accusantium iste.', 'Ea et voluptatem temporibus ut id. Dicta ut nihil sed aliquid. Est omnis quaerat nisi sunt est. Fugit qui sapiente dolor. Sunt ut ut eum vitae vel quo nihil. Officia ut minus nostrum aspernatur est.', 'nisi', 'sed', 'active', 11, '2025-04-25 07:52:12', '2025-04-25 07:52:12'),
(7, 'Omnis maxime dolorum dignissimos nobis.', 'magnam', 'Mollitia nihil consequatur explicabo reiciendis omnis. Libero quam et velit sunt vel enim. Modi qui laboriosam harum dolorum et. Nesciunt consequatur qui commodi.', 'Inventore optio consequatur nisi aut magni fugit. Magnam eligendi porro architecto illo quia ut. Quos nesciunt officia doloribus dolor laudantium quas aut. Quidem voluptas voluptatum non.', 'Fuga quis doloribus pariatur. Hic ad omnis soluta molestiae. Illum ut magni qui vitae. Saepe consectetur numquam distinctio et eligendi id atque.', 'rerum', 'veritatis', 'active', 13, '2025-04-25 07:52:14', '2025-04-25 07:52:14'),
(8, 'Minima molestias non totam.', 'accusantium', 'Aut et sed repellendus tempore ut. Dolores ut est saepe nam temporibus illum maxime. Architecto accusamus explicabo minima nam et. Assumenda tenetur repellat labore hic earum eos.', 'Quam molestiae omnis excepturi. Porro iusto occaecati perferendis tempore et fugiat. Accusantium in est ipsam totam aperiam numquam qui. Praesentium facilis velit occaecati iure.', 'Dignissimos doloremque earum consequatur unde totam sed et. Recusandae ab alias aliquam. Ea distinctio illum vel quidem aliquid neque quos.', 'quae', 'in', 'inactive', 15, '2025-04-25 07:52:15', '2025-04-25 07:52:15'),
(9, 'Tenetur impedit porro et reprehenderit.', 'totam', 'At autem ipsum cupiditate veritatis. Non fugit maxime ea voluptatem quia nihil aliquam. Voluptatem omnis non enim eaque. Laborum perspiciatis exercitationem quisquam autem possimus eos.', 'Suscipit porro et vel est. Ipsa sit occaecati dolorem alias modi modi hic. Vitae necessitatibus ut voluptates et a pariatur possimus tempore. Aut alias totam exercitationem odio qui.', 'Iste mollitia ipsa officia recusandae consectetur. Quia provident deleniti qui excepturi. Quos possimus iure sed sed et. Consectetur aut ullam et iure cumque sed.', 'sed', 'rerum', 'active', 17, '2025-04-25 07:52:16', '2025-04-25 07:52:16'),
(10, 'Quibusdam sint deleniti facilis.', 'facilis', 'Suscipit quas quidem laborum ducimus laboriosam tenetur. Eius eos est vel velit magnam. Optio corrupti voluptas praesentium cumque.', 'Molestiae rerum aliquid maxime voluptatem sit aut quisquam. Iste et temporibus totam fugit illum quia. Delectus porro ipsam nemo at. Quia eligendi ab iusto praesentium ut est reprehenderit.', 'Atque quisquam vel sint rerum voluptate. Quo corrupti deserunt iste ullam delectus quia modi. Sunt quos et consectetur dolores. Porro est rerum ab est doloribus voluptate non voluptas.', 'soluta', 'tempora', 'inactive', 19, '2025-04-25 07:52:17', '2025-04-25 07:52:17'),
(11, 'Expedita ea tempora.', 'occaecati', 'Eveniet dolor eaque accusantium omnis. Laboriosam veniam consequuntur facilis. Eos voluptatum ut non et nemo.', 'Asperiores adipisci doloribus odit sapiente minus et. Eos fugit tenetur illo atque qui. Corporis nihil eos pariatur facere provident quibusdam numquam nam. Eos aut animi fuga dolore quis.', 'Aut et et et sed. Rerum quia quis reiciendis temporibus harum accusantium rerum.', 'dolorem', 'saepe', 'inactive', 22, '2025-04-25 07:52:18', '2025-04-25 07:52:18'),
(12, 'Nostrum ex praesentium ea impedit.', 'illum', 'Nemo delectus rerum voluptatibus nihil eveniet numquam qui officiis. Harum et iure deleniti. Ut labore laborum eos eos dignissimos.', 'Aut aut placeat vero iure. Aut voluptatum vitae reprehenderit. Molestias labore est unde eum eum quis. Saepe rerum ut suscipit voluptatibus. Et non delectus molestias in aut eos est magni.', 'Quo quidem cupiditate consequatur suscipit. Dolorum est voluptas eius accusantium labore commodi. Distinctio aperiam aut rerum illum debitis temporibus.', 'fugit', 'et', 'inactive', 24, '2025-04-25 07:52:19', '2025-04-25 07:52:19'),
(13, 'Qui atque culpa.', 'labore', 'Perferendis soluta accusantium vitae. Assumenda quam esse aut. Fugit deleniti sequi minus ab quaerat. Possimus ut dolor voluptas molestias enim. Et eos sapiente amet.', 'Nostrum doloribus eos autem nihil quos ex. Dolor earum reiciendis suscipit maxime iure. Qui earum dolore fugiat vel nulla provident.', 'Expedita odio aut eum praesentium voluptatem tempora. Tempora dolorum repudiandae rem adipisci. Ut eligendi fuga exercitationem ut. Ipsum suscipit mollitia culpa nemo eaque.', 'velit', 'ipsum', 'inactive', 26, '2025-04-25 07:52:20', '2025-04-25 07:52:20'),
(14, 'Soluta rerum dignissimos natus.', 'consequatur', 'Aut consequatur fugit consequatur inventore. Occaecati sunt est enim. Veniam ut hic excepturi iure asperiores vel enim. Numquam quisquam id culpa beatae.', 'Rem qui aut ut quo. Et nostrum assumenda omnis a odit voluptatem. Et quod odit consequatur non beatae laboriosam laborum quos.', 'Cupiditate exercitationem adipisci officia molestiae expedita consectetur. At consectetur minima cum. Eum nesciunt illum non aut. Impedit qui consequatur maiores rerum.', 'corporis', 'ullam', 'inactive', 28, '2025-04-25 07:52:21', '2025-04-25 07:52:21'),
(15, 'Recusandae vero sit quibusdam quo.', 'cum', 'Dignissimos dignissimos rerum assumenda adipisci voluptas. Quam facere reiciendis quas blanditiis necessitatibus. Et ducimus esse et.', 'Eveniet quod molestias harum hic quis magni. Error quas qui sed culpa vel at. Et aut blanditiis aspernatur voluptas.', 'Asperiores dolorem nam sed qui voluptas dolores doloribus. Dolores et tenetur et quod repellat. Iure unde nostrum occaecati.', 'doloribus', 'et', 'inactive', 30, '2025-04-25 07:52:22', '2025-04-25 07:52:22'),
(16, 'In consequatur consequuntur dolores ut.', 'ipsa', 'Facilis perspiciatis recusandae consectetur numquam. Praesentium nihil aut dolores quod. Quisquam id vel odit.', 'Quo consequatur quae sint asperiores. Dolor enim ut minus aspernatur. Explicabo dolorum amet maxime explicabo fuga veritatis molestias.', 'Quibusdam voluptates nihil ut ducimus at minus quisquam. Corrupti id ut et. Odio cumque non recusandae debitis veniam autem. Voluptatem sint cumque rerum iste modi.', 'enim', 'ducimus', 'active', 32, '2025-04-25 07:52:23', '2025-04-25 07:52:23'),
(17, 'Ad iste saepe libero omnis.', 'quae', 'Ut dolorem commodi labore cum. Sequi et et ipsam rem provident saepe aperiam. Quia cupiditate qui non dolore.', 'Adipisci sint voluptates voluptas mollitia aut molestias ab. Aut omnis sit ullam quod. Dolor rerum maxime nesciunt nostrum perspiciatis voluptate.', 'Laudantium consequatur vel quibusdam non rerum eaque. Impedit nihil quibusdam placeat sit et. Ut quisquam eaque et temporibus porro reprehenderit pariatur.', 'iusto', 'accusantium', 'inactive', 34, '2025-04-25 07:52:25', '2025-04-25 07:52:25'),
(18, 'Illo et est minus.', 'rem', 'Nostrum aut ad neque vel corporis natus. Soluta non omnis iste et nam officia quia quia. Nihil maiores voluptatem nostrum ex ut illum.', 'Harum non facilis ut sint quis et culpa. Sit et est et eum. Similique ipsam tempore eos deleniti.', 'Rerum officiis illum libero quidem nihil illo. Et aut pariatur quis delectus. Nemo sequi quaerat voluptatem.', 'alias', 'est', 'active', 36, '2025-04-25 07:52:25', '2025-04-25 07:52:25'),
(19, 'Dignissimos et nihil provident quia.', 'porro', 'Voluptas odit illum harum magnam et. Dolores ut eum quibusdam quos earum facilis. Omnis sed nihil dolor.', 'Ut quo aut minima possimus. Veniam quasi ut cumque itaque. Vitae laborum voluptatem perspiciatis vero repudiandae est itaque.', 'Occaecati pariatur sint est accusamus. Eaque qui rerum natus quia perspiciatis consequatur id. Harum amet quia eum molestias ut. Sint distinctio dolor dolore ex et.', 'facere', 'aspernatur', 'inactive', 38, '2025-04-25 07:52:26', '2025-04-25 07:52:26'),
(20, 'Voluptatum quidem at aut maiores.', 'sapiente', 'Corrupti id tempore minus iste aut delectus est. Corporis quidem doloremque modi voluptas. Deleniti dignissimos iure voluptates dignissimos. Maiores libero dolorem voluptatibus omnis rerum.', 'Qui autem eum velit sint laboriosam perspiciatis maxime minus. Tempora error cupiditate ut quis vel commodi consequatur voluptate. Cumque est nostrum tenetur sunt id.', 'Vel at sapiente velit explicabo porro et nam. Ut dolores magnam aperiam magni ipsam. Earum ipsum tempora consectetur. Accusantium perspiciatis cupiditate a dolorem.', 'in', 'velit', 'inactive', 40, '2025-04-25 07:52:28', '2025-04-25 07:52:28'),
(21, 'Molestias saepe minus itaque.', 'officiis', 'Harum consequatur minima et. Suscipit quidem illo ut. Aut eos incidunt quam tempore et.', 'Saepe soluta perferendis voluptates qui tenetur ullam. Et fugit quia natus et doloribus id nobis. Fugiat inventore modi ullam. Modi error qui tenetur labore eos enim corporis quasi.', 'Omnis architecto architecto fugit. Tempora modi et id est enim mollitia. Dolorem id et itaque dolore laudantium excepturi non ducimus.', 'inventore', 'odio', 'active', 41, '2025-04-25 07:52:28', '2025-04-25 07:52:28'),
(22, 'Qui vitae eos.', 'nisi', 'Officia et magni sunt nostrum. Ratione laudantium voluptate consectetur quia ea dicta rerum a. Dolorem possimus laudantium quasi iure optio. Et et est fugit et et enim.', 'Quam ab suscipit id quia commodi molestias. Ullam velit et non. Autem iure quidem ut dolores non et non. Et quae voluptatum sit dolore iure. Provident eius et nesciunt enim ut soluta.', 'Distinctio ratione voluptas doloribus magnam rerum molestiae. Ut corporis voluptatem nisi temporibus. Aut accusantium excepturi nulla recusandae atque.', 'et', 'ipsum', 'inactive', 44, '2025-04-25 07:52:30', '2025-04-25 07:52:30'),
(23, 'Natus laborum rerum qui ut.', 'perferendis', 'Inventore perferendis sequi magnam consequatur soluta rem. Eos nesciunt corporis fugiat dolores incidunt quas.', 'Error veritatis ut ducimus autem maxime at quibusdam. Iure et sunt autem. Reprehenderit voluptates maiores ullam ut molestiae et in.', 'Eligendi dolor maiores fugit. Unde et fugit possimus qui voluptatem cum. Enim cumque itaque doloribus minus placeat quam.', 'autem', 'quam', 'inactive', 45, '2025-04-25 07:52:30', '2025-04-25 07:52:30'),
(24, 'Sed alias voluptatem sunt.', 'aut', 'Aut quidem sapiente eos dolorum. Et dolor quidem hic ut. Sit sunt minus sapiente libero aut suscipit magni quisquam.', 'Temporibus modi in corporis doloribus occaecati commodi nam. Tempore sapiente quidem corporis iste. Omnis eos enim doloribus nulla maxime neque suscipit.', 'Blanditiis animi optio impedit qui. In ut sunt ratione illum numquam. Autem quia dolores nihil ut. Vero dolor est eveniet voluptatibus.', 'nesciunt', 'asperiores', 'active', 48, '2025-04-25 07:52:32', '2025-04-25 07:52:32'),
(25, 'Vel repellendus iure dignissimos laborum accusantium.', 'vitae', 'Consectetur consectetur dolor quia voluptate illum est. Consequuntur possimus velit aliquid nesciunt modi. Quia modi rerum quam sit. Ea est vero consequatur ut.', 'Saepe dignissimos dolore fuga corrupti optio cupiditate quos. Eum et ea quibusdam aut modi aut quia. Inventore laudantium nihil et dolorum iure in adipisci. Veritatis eum velit voluptatem.', 'Doloribus debitis accusamus non. Et deserunt et eum magni quisquam non corrupti quibusdam. Qui rerum et sapiente alias.', 'doloremque', 'consequatur', 'inactive', 49, '2025-04-25 07:52:32', '2025-04-25 07:52:32'),
(26, 'Rem et et consequatur rerum.', 'occaecati', 'Velit beatae harum atque enim doloremque unde natus. Ad neque voluptatem aut iusto. Hic quis omnis sapiente voluptates suscipit ut perspiciatis. Voluptas voluptate est velit expedita distinctio sint.', 'Repellat perferendis blanditiis temporibus. Sed ducimus cum molestiae. Fugiat accusamus eligendi tenetur omnis.', 'Quidem necessitatibus fuga explicabo ex et sint doloribus. Quasi est pariatur quibusdam blanditiis quisquam voluptatum. Velit blanditiis beatae aspernatur consequatur.', 'commodi', 'vel', 'inactive', 52, '2025-04-25 07:52:34', '2025-04-25 07:52:34'),
(27, 'Laboriosam quod explicabo quia.', 'et', 'Totam voluptatem quia cum voluptates quis. Temporibus officia repudiandae aut harum. Qui voluptatem quas ipsum et.', 'Vel placeat perferendis qui tempore totam quis odit. Eos eos sequi dolor recusandae laboriosam excepturi. Et a quia animi necessitatibus quia nostrum.', 'Nihil est quod voluptatem qui minima aut. Earum animi quo est qui vel. Et exercitationem esse nihil et cupiditate.', 'voluptatibus', 'accusantium', 'active', 53, '2025-04-25 07:52:35', '2025-04-25 07:52:35'),
(28, 'Nulla fugiat ut molestiae.', 'nobis', 'Quis quas facilis at quia. At neque nam et eos voluptates voluptatem in. Dolore officia facere pariatur earum.', 'Placeat corrupti tempore vitae quia similique totam. Accusantium voluptates ab ullam aut. Quia architecto qui pariatur. Quaerat reprehenderit non error dolores voluptatem.', 'Perspiciatis non nemo dicta quod est. Sunt sit voluptatem iste qui molestias. Tenetur saepe unde mollitia doloribus sequi. Placeat temporibus unde consequuntur odio.', 'aut', 'itaque', 'inactive', 56, '2025-04-25 07:52:37', '2025-04-25 07:52:37'),
(29, 'Nulla ex ut.', 'odio', 'Sed aut magni numquam qui natus qui illo. Dolores repellendus aut non. Ut optio maiores magnam dolores doloremque.', 'Impedit hic voluptatem unde assumenda excepturi voluptates. Tempora perspiciatis libero voluptatibus dolores nesciunt. Iste voluptatum libero nihil. Autem amet consequatur tenetur similique est quia.', 'Est aut nisi et omnis similique. Quibusdam consequatur quia quisquam modi id maiores aut eum.', 'qui', 'magni', 'active', 57, '2025-04-25 07:52:37', '2025-04-25 07:52:37'),
(30, 'Et quasi dolores eaque adipisci.', 'veniam', 'Excepturi cumque quia suscipit nostrum sunt. Aspernatur dignissimos dolorem dolorem eaque ut. Soluta excepturi nam dolorem sed officiis dolorum. Et non dolorem id fugit sit maiores.', 'Est magni ut quisquam modi cumque unde. Architecto ea quisquam qui perspiciatis amet. Quae neque voluptatem et id. Quaerat et nesciunt dignissimos ea pariatur.', 'Quibusdam ab quibusdam in rem. Ad officia omnis voluptatem id sit et dignissimos. Iure et architecto aut natus et culpa molestiae. Aut quo debitis ullam voluptas veniam doloremque.', 'eum', 'accusamus', 'inactive', 60, '2025-04-25 07:52:39', '2025-04-25 07:52:39');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_04_25_121731_create_job_positions_table', 1),
(5, '2025_04_25_121732_create_applications_table', 1),
(6, '2025_04_25_121733_create_chatbot_flows_table', 1),
(7, '2025_04_25_121734_create_chatbot_steps_table', 1),
(8, '2025_04_25_121735_create_conversation_logs_table', 1),
(9, '2025_04_25_125417_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `role` enum('admin','recruiter','viewer') NOT NULL DEFAULT 'viewer',
  `profile_image` varchar(255) DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `profile_image`, `last_login`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Nicklaus Kutch', 'mann.mellie@example.com', NULL, '$2y$12$RBUCHmvicwlMZ.jxV9pFa.BjsQX0Y4EFpT5RDLcy.8fDcZRAZTGs6', NULL, 'viewer', 'eum', '1977-03-27 23:01:30', 'inactive', '2025-04-25 07:52:09', '2025-04-25 07:52:09'),
(2, 'Dr. Abbey Fahey DVM', 'lockman.audrey@example.net', NULL, '$2y$12$1dTtJkMHF1VWo8P/ORPCeufQyqjXxYSQ13l9i0MwG5Wwemc1ZEQz2', NULL, 'admin', 'voluptas', '1990-04-04 18:59:42', 'active', '2025-04-25 07:52:09', '2025-04-25 07:52:09'),
(3, 'Prof. Jason Wilkinson', 'emie.stokes@example.org', NULL, '$2y$12$HqH60hXL505EM/JlkJ5.nuUHWTTlPNrbUaZ2z3o2P7X4RPHxARYei', NULL, 'admin', 'aperiam', '1999-06-09 20:34:17', 'inactive', '2025-04-25 07:52:09', '2025-04-25 07:52:09'),
(4, 'Jayne Bartell', 'bailee51@example.com', NULL, '$2y$12$C0pMx3zTYq30xJbG0xvEoOCj3CtlTGYLOPPfELg3G12SvJceTZ0H2', NULL, 'viewer', 'quo', '1990-08-22 16:36:59', 'active', '2025-04-25 07:52:09', '2025-04-25 07:52:09'),
(5, 'Nona McCullough', 'jordane.douglas@example.net', NULL, '$2y$12$lfGsRWTJTrbENyF6ADtZveB28Ljb0uLOSEqhtAvzho9mWZq8MFCQO', NULL, 'admin', 'ut', '2022-01-24 14:30:04', 'active', '2025-04-25 07:52:09', '2025-04-25 07:52:09'),
(6, 'Alejandra Macejkovic', 'narciso45@example.net', NULL, '$2y$12$MISNvydDQgw7Mbsf.ay02ePMvghlrAcDvD7E0q5cesXtlbeVSk4su', NULL, 'admin', 'voluptatem', '1996-09-14 22:39:09', 'active', '2025-04-25 07:52:09', '2025-04-25 07:52:09'),
(7, 'Madisyn Terry', 'qpfannerstill@example.org', NULL, '$2y$12$Jzbeu7.ML7o17nhpHWx7m.en.8NJGgLeufXkeaAIPMmxb197W16Hi', NULL, 'admin', 'assumenda', '1992-08-04 07:00:21', 'inactive', '2025-04-25 07:52:10', '2025-04-25 07:52:10'),
(8, 'Ramiro Osinski', 'bhand@example.com', NULL, '$2y$12$3V4Dk.k8FvVAbR90PjCfQ.1eY/r3TKeBr2BlXE9RxbOKvihT3edjm', NULL, 'admin', 'repudiandae', '1979-10-26 06:04:08', 'active', '2025-04-25 07:52:10', '2025-04-25 07:52:10'),
(9, 'Ms. Annetta Anderson DDS', 'jacinto.johnson@example.org', NULL, '$2y$12$vFalnkWT18FPmQxJbdqgYe6fcc0gO82e85tUJXy6AigXujAR5vGyG', NULL, 'viewer', 'vero', '2021-02-27 21:10:15', 'inactive', '2025-04-25 07:52:11', '2025-04-25 07:52:11'),
(10, 'Sadie Feil', 'hailie.wiza@example.org', NULL, '$2y$12$qNs03JrfEIno9Q13CLZ//.ZtV3r/xF93QGsyfLs5/FCq8mmYo3/A2', NULL, 'recruiter', 'ea', '1971-08-03 22:00:46', 'inactive', '2025-04-25 07:52:11', '2025-04-25 07:52:11'),
(11, 'Ezekiel Balistreri', 'lauren.hessel@example.com', NULL, '$2y$12$gqk3x7.h28PmIM6GWFrdgOtljy0YnTjZYlsl3pMhaXXe7xpSg9ayu', NULL, 'viewer', 'quia', '2006-12-01 06:22:46', 'inactive', '2025-04-25 07:52:12', '2025-04-25 07:52:12'),
(12, 'Rico Hintz', 'cdenesik@example.com', NULL, '$2y$12$gxllRp7CU6jorqK0ktw5KucL5ysr0qzELOOu01.mZnhJVsEAMA4VO', NULL, 'recruiter', 'autem', '1981-02-12 22:40:41', 'active', '2025-04-25 07:52:12', '2025-04-25 07:52:12'),
(13, 'Citlalli Monahan', 'stanton.clementina@example.net', NULL, '$2y$12$VFyyI1AZ1ShFA0vQ/Okeveew.WsalFfxeDqzu0F1xndXTZf2ESr2K', NULL, 'recruiter', 'quos', '2023-09-08 09:59:18', 'active', '2025-04-25 07:52:13', '2025-04-25 07:52:13'),
(14, 'Dr. Jannie Willms', 'dameon99@example.org', NULL, '$2y$12$cOFl4TZPOTjFzcbsDVQNpeFeN6LPZDZ1fhhRJV.BOTl1uhgC7cxki', NULL, 'recruiter', 'accusantium', '2001-03-18 08:35:49', 'inactive', '2025-04-25 07:52:14', '2025-04-25 07:52:14'),
(15, 'Serena Wisozk', 'kemmer.montana@example.org', NULL, '$2y$12$YWF78zufhh5FQhoKAxJvsuY7uqnrLfX6YWCjKHel.kmLfVkBV2r8G', NULL, 'viewer', 'adipisci', '2000-02-29 10:43:25', 'inactive', '2025-04-25 07:52:15', '2025-04-25 07:52:15'),
(16, 'Prof. Fernando Klein', 'mohammad.mcclure@example.org', NULL, '$2y$12$AxKA/sBIZdpkvI8vVQ32nOz2LEiplBn3paPAR5duzF0keLoc4htEO', NULL, 'recruiter', 'illo', '2025-03-02 17:15:04', 'inactive', '2025-04-25 07:52:15', '2025-04-25 07:52:15'),
(17, 'Noble Shanahan', 'cruickshank.florine@example.com', NULL, '$2y$12$yja2Yz7DNvNl8qj89Q7QM.o/.I5yhFUifclQ81FuPeteaQt0X8vf2', NULL, 'viewer', 'voluptates', '1974-01-31 23:40:04', 'active', '2025-04-25 07:52:15', '2025-04-25 07:52:15'),
(18, 'Edna Hahn III', 'ulices51@example.org', NULL, '$2y$12$Xqw6z4r/zYnQ.dJaExl/Le0qXKLg6djpzVdUAM.HUGrmkh7VPyiem', NULL, 'admin', 'non', '2003-08-14 19:06:24', 'active', '2025-04-25 07:52:16', '2025-04-25 07:52:16'),
(19, 'Ervin Dooley', 'renee03@example.com', NULL, '$2y$12$3R63YJt2Vjbki1WPEixgSOdQvuKXYwpFy9TMjzQs7wdgYjleqKrYC', NULL, 'recruiter', 'rerum', '1977-05-22 10:38:32', 'active', '2025-04-25 07:52:17', '2025-04-25 07:52:17'),
(20, 'Ewell Conn', 'dkautzer@example.com', NULL, '$2y$12$HlETl5d4gVe6mHHqCLQjCOtPBpP5yltDhYX6KnUTGHOQKVnrdep/K', NULL, 'viewer', 'magni', '1970-04-17 01:44:48', 'active', '2025-04-25 07:52:17', '2025-04-25 07:52:17'),
(21, 'Easton Skiles', 'luettgen.darius@example.org', NULL, '$2y$12$bq0.rg1z9BAtB9IxjrKfcO4xm.fn.rd37q1EJKik9hFRhQH5sOJgG', NULL, 'viewer', 'iure', '2012-06-21 20:06:28', 'inactive', '2025-04-25 07:52:18', '2025-04-25 07:52:18'),
(22, 'Trevion Hill', 'wolf.jeffrey@example.net', NULL, '$2y$12$a/aDJkYIv1gmb6zq5OY4C.0zXtIwjVEezLZZ9tniorgkhPiKwKIIy', NULL, 'viewer', 'aliquam', '2016-08-01 17:56:03', 'active', '2025-04-25 07:52:18', '2025-04-25 07:52:18'),
(23, 'Dewitt Kiehn', 'treutel.kenny@example.com', NULL, '$2y$12$BZIThdUXtYetVfrLs2C28uwK0qp/.TQtGFrBmBiK69h1XbDjawtIa', NULL, 'recruiter', 'doloremque', '2013-10-28 02:39:15', 'active', '2025-04-25 07:52:19', '2025-04-25 07:52:19'),
(24, 'Prof. Madisyn Davis Sr.', 'darius.toy@example.org', NULL, '$2y$12$pTVSbl3CZyTn/0885RbKVeEI5quY5QKeZriOFjjLGjBXWlt9wbE2S', NULL, 'admin', 'reprehenderit', '2025-04-21 15:09:06', 'inactive', '2025-04-25 07:52:19', '2025-04-25 07:52:19'),
(25, 'Dr. Rudolph Bruen DDS', 'therese.waelchi@example.com', NULL, '$2y$12$ludfOY7y3Drz.x7niAwrlOqeL1wqzSat6ul1VDapO63KhuIOSkZFa', NULL, 'recruiter', 'eos', '1996-10-12 23:56:03', 'active', '2025-04-25 07:52:20', '2025-04-25 07:52:20'),
(26, 'Miss Lessie Crooks II', 'oberbrunner.fay@example.com', NULL, '$2y$12$fol8BMNmKzHseDA/0bQNp.MVwfImARotuANHDcI9jKLPFqosUojIm', NULL, 'recruiter', 'suscipit', '2003-05-02 12:52:57', 'inactive', '2025-04-25 07:52:20', '2025-04-25 07:52:20'),
(27, 'Kristian Langosh', 'adaline.wisozk@example.com', NULL, '$2y$12$y0TBC/aJAE/z5U40zJgB6OPp0yUdvoK2tPcC4uhO6MVLNo5jZLf1S', NULL, 'viewer', 'repellendus', '2023-04-17 08:00:06', 'inactive', '2025-04-25 07:52:21', '2025-04-25 07:52:21'),
(28, 'Miss Vivienne Schmeler', 'ellen.parisian@example.com', NULL, '$2y$12$Ho8PAeFdU5VNf1LztCs7UOeUIXogBtbe1gSNPrHyOCZwy1oCF19Cm', NULL, 'recruiter', 'sed', '2022-02-13 23:43:24', 'inactive', '2025-04-25 07:52:21', '2025-04-25 07:52:21'),
(29, 'Tressie Hahn', 'doyle.ashlynn@example.net', NULL, '$2y$12$8mEhpwMW5ief9W6Ovh7Z0eUVMYqIv1/7Nt2HGAk9bo0KGpxjORoJu', NULL, 'admin', 'autem', '2025-04-02 03:00:38', 'active', '2025-04-25 07:52:22', '2025-04-25 07:52:22'),
(30, 'Mr. August Quitzon V', 'emard.myrl@example.com', NULL, '$2y$12$VnT4SAxnfKIgMXTV/4U0JOSYAYCLOCPrsRVfjdgYH1ybnXuYC68Vm', NULL, 'admin', 'consequuntur', '2013-04-26 12:59:43', 'active', '2025-04-25 07:52:22', '2025-04-25 07:52:22'),
(31, 'Makayla Pollich', 'wcrona@example.com', NULL, '$2y$12$sLtLhIo6MFnMdTf3QThdVOW3N8wzBw3mnufICQAk.UJy47d7uA7UK', NULL, 'viewer', 'perferendis', '2009-07-08 02:55:20', 'inactive', '2025-04-25 07:52:23', '2025-04-25 07:52:23'),
(32, 'Corrine Morar', 'antonetta14@example.com', NULL, '$2y$12$LRTpq/lOHOqXCdi3XCzc0e5Cuwpop6AxAsEYBZGUmKytZ6gI.8ocy', NULL, 'admin', 'laudantium', '2014-05-18 06:27:20', 'inactive', '2025-04-25 07:52:23', '2025-04-25 07:52:23'),
(33, 'Mr. Mauricio Wunsch DVM', 'yzemlak@example.net', NULL, '$2y$12$s2Hiyce2el9K/4T6eFQnuu8SX1M82M869eKN6g/VlZ/nDCv5BpDKu', NULL, 'admin', 'distinctio', '1971-02-11 22:43:00', 'active', '2025-04-25 07:52:24', '2025-04-25 07:52:24'),
(34, 'Raegan O\'Hara', 'karolann63@example.net', NULL, '$2y$12$3e5FQxK/5cwpUe4MszkqlO/OvZd8FLo9Veku/ViepwtAFrr9CTp4C', NULL, 'admin', 'deleniti', '1988-01-16 03:12:11', 'active', '2025-04-25 07:52:25', '2025-04-25 07:52:25'),
(35, 'Ms. Gwendolyn Kuhn', 'vena52@example.net', NULL, '$2y$12$tQuINZmIbE7WqrKZX.OXhevs..ccGyinf8Xzc5xNXVnjCLYGMnj9q', NULL, 'recruiter', 'distinctio', '1978-10-19 21:17:48', 'inactive', '2025-04-25 07:52:25', '2025-04-25 07:52:25'),
(36, 'Prof. Harrison Kihn', 'gsipes@example.com', NULL, '$2y$12$anmKjjhisPRDl9CQ4VBSe.lv3kCiFk8zO6FhXblXkwq1YLCtvBkaO', NULL, 'admin', 'molestias', '1983-05-18 00:34:11', 'active', '2025-04-25 07:52:25', '2025-04-25 07:52:25'),
(37, 'Claudia Parker', 'marian.willms@example.com', NULL, '$2y$12$h6ItExryQLpLT4uJpZXSw.Rq6uHhlOaCGJXWzDNg8qVCFwEYr/Idu', NULL, 'viewer', 'odit', '1987-04-12 02:46:37', 'inactive', '2025-04-25 07:52:26', '2025-04-25 07:52:26'),
(38, 'Dr. Akeem O\'Reilly Sr.', 'ora59@example.org', NULL, '$2y$12$xBhAGASl6MnxP9JjEeIS9OrxWTIV8uHRPvetHebIu0CwwmyEI9/jS', NULL, 'viewer', 'itaque', '2024-04-23 19:51:18', 'inactive', '2025-04-25 07:52:26', '2025-04-25 07:52:26'),
(39, 'Ansley Corwin', 'dina.toy@example.com', NULL, '$2y$12$6Ij0jzhTbexrexqfVgiPk.IoOubIWerbCGhBJIAJS1HkDTT2nMw3e', NULL, 'admin', 'quas', '2014-11-25 10:33:01', 'active', '2025-04-25 07:52:27', '2025-04-25 07:52:27'),
(40, 'Favian Koelpin', 'branson.kozey@example.com', NULL, '$2y$12$m3d15wiZtpNNYx4pqMpTeeEPCLcwVkU1SFyqk0Vr8qAau9/PK8Us6', NULL, 'recruiter', 'provident', '1991-08-30 18:49:52', 'active', '2025-04-25 07:52:27', '2025-04-25 07:52:27'),
(41, 'Miss Yessenia Walsh', 'larson.anahi@example.com', NULL, '$2y$12$LFPVc1EKgJ457B8oYnKa5eT5kycG0b7sJ8EKZvXwYo7bcuJ8t5D0i', NULL, 'admin', 'perspiciatis', '2011-04-14 00:29:45', 'inactive', '2025-04-25 07:52:28', '2025-04-25 07:52:28'),
(42, 'Mrs. Eulalia Hills I', 'madie.kerluke@example.org', NULL, '$2y$12$E3neNzXSQyJEfu5xssPdae533mC3CZX1o.KSHUMiu3nd1zJygw14e', NULL, 'recruiter', 'nostrum', '2013-06-15 21:18:41', 'active', '2025-04-25 07:52:29', '2025-04-25 07:52:29'),
(43, 'Brice Padberg II', 'rohan.marion@example.com', NULL, '$2y$12$UfLqG5xHcCbjgICAyLwGhuxwUT4P6h11sAMd7P37n8nERHbzW5xY.', NULL, 'admin', 'fuga', '2012-07-22 00:35:08', 'active', '2025-04-25 07:52:29', '2025-04-25 07:52:29'),
(44, 'Chaim Mills', 'albin.reichert@example.net', NULL, '$2y$12$1wBvQ/QYJRptffaWuLBFJ.e7jUPlyklS.UXH2jVRJHjzinpg1g4yi', NULL, 'admin', 'debitis', '1996-09-07 23:43:11', 'inactive', '2025-04-25 07:52:30', '2025-04-25 07:52:30'),
(45, 'Madisyn Bartoletti II', 'mariela92@example.org', NULL, '$2y$12$7B3DVj5q2s/oIMZ82XMB5OH/loG/B0PrNOpiz0iCv29Z7hbrHLI.i', NULL, 'viewer', 'optio', '2024-08-31 09:57:29', 'active', '2025-04-25 07:52:30', '2025-04-25 07:52:30'),
(46, 'Ada Muller', 'tkunde@example.org', NULL, '$2y$12$dRSLPbqGXiZ1gkGVJCmHguifMtaGEQSGT5KNQtpNWA4Cd7gccs8aq', NULL, 'viewer', 'sunt', '1980-02-07 23:12:22', 'inactive', '2025-04-25 07:52:31', '2025-04-25 07:52:31'),
(47, 'Filomena Hills', 'lthompson@example.org', NULL, '$2y$12$e2qODStUC/mCy9FsEzFuX.uRCtLMA9qnd3p7EC0F0ANh7NYD0/Owe', NULL, 'viewer', 'nihil', '1993-07-30 10:50:25', 'active', '2025-04-25 07:52:31', '2025-04-25 07:52:31'),
(48, 'Dale Wunsch', 'clay94@example.org', NULL, '$2y$12$zYWIW07PffI0kkurM086huTUE77scxXeH/Ho3kiLrxrGxGQHXv6hO', NULL, 'viewer', 'odio', '1990-07-22 19:06:38', 'inactive', '2025-04-25 07:52:32', '2025-04-25 07:52:32'),
(49, 'Mr. Orland Heller DVM', 'larkin.carmela@example.com', NULL, '$2y$12$qBrD9H/.A6Av/W2her8ihO3nseDCAFAo2AJ9xhpzUJkzhknPYRDzi', NULL, 'admin', 'unde', '1987-12-18 08:45:34', 'inactive', '2025-04-25 07:52:32', '2025-04-25 07:52:32'),
(50, 'Mrs. Felicia Pagac', 'bernier.clarabelle@example.com', NULL, '$2y$12$XowKzr8bFJ52Hin9zFFT2eklD6TrmkKbEGQQnad27R/CLzYedkKT.', NULL, 'admin', 'tempore', '2004-03-28 07:14:09', 'inactive', '2025-04-25 07:52:33', '2025-04-25 07:52:33'),
(51, 'Addie Sawayn PhD', 'ibernhard@example.org', NULL, '$2y$12$M93VPIvbGnbZHIsIYlZKyOK2gNZyRnDmDqR6NxBaCrnJeipdfeY02', NULL, 'recruiter', 'minus', '1995-08-31 07:57:45', 'inactive', '2025-04-25 07:52:33', '2025-04-25 07:52:33'),
(52, 'Selena Langosh', 'brakus.lorenz@example.net', NULL, '$2y$12$SCcYYuk2m028N4pv.O2GJu8e7KD/FqG5/mOPiAowt5p.HZ4EP1a0O', NULL, 'admin', 'voluptatem', '2001-12-31 02:23:20', 'active', '2025-04-25 07:52:34', '2025-04-25 07:52:34'),
(53, 'Carlotta Fay', 'conroy.giovanna@example.net', NULL, '$2y$12$2OaCPhFF2LKq8aMQvzaz.e.YwjKpn0fzeM/Zb90MtphN.DnrNsJGO', NULL, 'recruiter', 'voluptatem', '1997-10-17 23:47:23', 'active', '2025-04-25 07:52:35', '2025-04-25 07:52:35'),
(54, 'Nicholas Schuppe PhD', 'ward.anastasia@example.net', NULL, '$2y$12$bP1p6j59cejedkGkxxPh4eZ/AdSqNzmNd4jJSIxULl00YMjyynnQS', NULL, 'admin', 'adipisci', '1971-01-13 13:49:56', 'inactive', '2025-04-25 07:52:36', '2025-04-25 07:52:36'),
(55, 'Elvie Roberts IV', 'william.miller@example.net', NULL, '$2y$12$8HLzYKcdVXmTd21.Y7Mt8uOTqezXxpZjUq3ZX6QcTAAL.4kmf46NG', NULL, 'recruiter', 'autem', '2018-11-18 00:02:34', 'inactive', '2025-04-25 07:52:36', '2025-04-25 07:52:36'),
(56, 'Mrs. Emily Jakubowski III', 'weldon86@example.org', NULL, '$2y$12$2kfhqvnaf/9cPpqUdSmlPu5T5J8bxGEJe5uvDgNJ800bELm3n8IzO', NULL, 'viewer', 'libero', '2019-04-16 18:23:58', 'active', '2025-04-25 07:52:37', '2025-04-25 07:52:37'),
(57, 'Lelah Rowe', 'maximo.heller@example.org', NULL, '$2y$12$i4Tmd.XLoGOQwiJrTLZgJeus5E3KEbiX0LDY/gxZ75.xWVh6V2vMC', NULL, 'admin', 'a', '1994-03-09 23:36:03', 'active', '2025-04-25 07:52:37', '2025-04-25 07:52:37'),
(58, 'Dr. Belle Romaguera IV', 'lily76@example.com', NULL, '$2y$12$0qTL1/3rMA4rVUJV883.M.VlMgFw9w.WVb0n8setsbz/5yc1MMgFa', NULL, 'admin', 'error', '2006-04-05 05:32:21', 'active', '2025-04-25 07:52:38', '2025-04-25 07:52:38'),
(59, 'Destin Anderson', 'agutmann@example.org', NULL, '$2y$12$7cS5wPR7QJyOLYF.7iqN3uW9DVosINclrePlxj4gt.HAFLDhYNSFy', NULL, 'recruiter', 'sint', '2001-04-17 12:19:31', 'active', '2025-04-25 07:52:38', '2025-04-25 07:52:38'),
(60, 'Jennyfer Olson', 'oleta.cormier@example.com', NULL, '$2y$12$88MCAv861nUd1mHXmb8Va.q5aYxWauMdiTaFEsEmhJbfKhmK9DQMq', NULL, 'recruiter', 'nihil', '2014-10-20 12:38:39', 'inactive', '2025-04-25 07:52:39', '2025-04-25 07:52:39'),
(61, 'Admin', 'admin@gmail.com', NULL, '$2y$12$mTUqzGcTKtUsACRIAWyQhuFn5tP2sSPUVnzO2/j0MegGxEN/FJf9u', NULL, 'admin', NULL, NULL, 'active', '2025-04-25 07:52:52', '2025-04-25 07:52:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applications_job_position_id_foreign` (`job_position_id`),
  ADD KEY `applications_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `chatbot_flows`
--
ALTER TABLE `chatbot_flows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chatbot_flows_job_position_id_foreign` (`job_position_id`),
  ADD KEY `chatbot_flows_created_by_foreign` (`created_by`);

--
-- Indexes for table `chatbot_steps`
--
ALTER TABLE `chatbot_steps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chatbot_steps_flow_id_foreign` (`flow_id`);

--
-- Indexes for table `conversation_logs`
--
ALTER TABLE `conversation_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conversation_logs_application_id_foreign` (`application_id`),
  ADD KEY `conversation_logs_step_id_foreign` (`step_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_positions`
--
ALTER TABLE `job_positions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_positions_created_by_foreign` (`created_by`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `chatbot_flows`
--
ALTER TABLE `chatbot_flows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `chatbot_steps`
--
ALTER TABLE `chatbot_steps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `conversation_logs`
--
ALTER TABLE `conversation_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_positions`
--
ALTER TABLE `job_positions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_job_position_id_foreign` FOREIGN KEY (`job_position_id`) REFERENCES `job_positions` (`id`),
  ADD CONSTRAINT `applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `chatbot_flows`
--
ALTER TABLE `chatbot_flows`
  ADD CONSTRAINT `chatbot_flows_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `chatbot_flows_job_position_id_foreign` FOREIGN KEY (`job_position_id`) REFERENCES `job_positions` (`id`);

--
-- Constraints for table `chatbot_steps`
--
ALTER TABLE `chatbot_steps`
  ADD CONSTRAINT `chatbot_steps_flow_id_foreign` FOREIGN KEY (`flow_id`) REFERENCES `chatbot_flows` (`id`);

--
-- Constraints for table `conversation_logs`
--
ALTER TABLE `conversation_logs`
  ADD CONSTRAINT `conversation_logs_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`),
  ADD CONSTRAINT `conversation_logs_step_id_foreign` FOREIGN KEY (`step_id`) REFERENCES `chatbot_steps` (`id`);

--
-- Constraints for table `job_positions`
--
ALTER TABLE `job_positions`
  ADD CONSTRAINT `job_positions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
