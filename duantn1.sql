-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 08, 2024 at 08:11 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `duantn1`
--

-- --------------------------------------------------------

--
-- Table structure for table `combos`
--

CREATE TABLE `combos` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `combos`
--

INSERT INTO `combos` (`id`, `name`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Bỏng nước', '20000.00', '2024-11-19 01:58:35', '2024-11-19 01:58:35');

-- --------------------------------------------------------

--
-- Table structure for table `combo_food_drink`
--

CREATE TABLE `combo_food_drink` (
  `id` bigint UNSIGNED NOT NULL,
  `combo_id` bigint UNSIGNED NOT NULL,
  `food_id` bigint UNSIGNED DEFAULT NULL,
  `drink_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `combo_food_drink`
--

INSERT INTO `combo_food_drink` (`id`, `combo_id`, `food_id`, `drink_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, NULL),
(2, 1, NULL, 1, '2024-11-19 01:58:35', '2024-11-19 01:58:35');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `movie_id` bigint UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `rating` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `movie_id`, `comment`, `rating`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'Phim rất hay!', 3, '2024-11-28 00:29:46', '2024-12-06 02:44:54'),
(2, 1, 2, 'Phim rất hay!', 3, '2024-11-28 00:59:31', '2024-12-06 02:44:56'),
(3, 1, 1, 'Phim rất hay!', 3, '2024-11-28 01:05:50', '2024-12-06 02:44:57'),
(4, 2, 3, 'A', 3, '2024-12-05 15:35:00', '2024-12-05 15:35:00'),
(5, 2, 7, 'ádasd', 3, '2024-12-05 17:08:39', '2024-12-05 17:08:39');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `user_id`, `name`, `email`, `message`, `created_at`, `updated_at`) VALUES
(1, 1, 'Nguyễn Như Huy', 'vipdktq@gmail.com', '123', '2024-11-30 06:07:51', '2024-11-30 06:07:51'),
(2, 1, 'Nguyễn Như Huy', 'vipdktq@gmail.com', '123', '2024-11-30 06:08:27', '2024-11-30 06:08:27');

-- --------------------------------------------------------

--
-- Table structure for table `drinks`
--

CREATE TABLE `drinks` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drinks`
--

INSERT INTO `drinks` (`id`, `name`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Pepsi', '10000.00', '2024-11-19 01:58:18', '2024-11-19 01:58:18');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `name`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Bỏng', '10000.00', '2024-11-19 01:58:04', '2024-11-19 01:58:04'),
(2, 'Bim bim', '1.00', '2024-11-19 05:21:04', '2024-11-19 05:21:04');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `genre_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`genre_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Kinh Dị', '2024-12-01 16:35:50', '2024-12-01 16:35:50'),
(2, 'Hành động', '2024-12-01 16:35:50', '2024-12-01 16:35:50'),
(3, 'Tâm Lý', '2024-12-01 16:35:50', '2024-12-01 16:35:50'),
(4, 'Hài Hước', '2024-12-01 16:35:59', '2024-12-01 16:35:59'),
(5, 'Hoạt Hình', '2024-12-02 03:24:15', '2024-12-02 03:24:15'),
(6, 'Khoa học', '2024-12-02 03:35:27', '2024-12-02 03:35:27'),
(7, 'Viễn tưởng', '2024-12-02 03:35:35', '2024-12-02 03:35:35'),
(8, 'Phưu lưu', '2024-12-02 03:39:25', '2024-12-02 03:39:25'),
(9, 'Gia Đình', '2024-12-02 03:39:29', '2024-12-02 03:39:29'),
(10, 'Kịch', '2024-12-02 03:39:38', '2024-12-02 03:39:38'),
(11, 'Âm nhạc', '2024-12-02 04:07:51', '2024-12-02 04:07:51');

-- --------------------------------------------------------

--
-- Table structure for table `genre_movie`
--

CREATE TABLE `genre_movie` (
  `movie_id` bigint UNSIGNED NOT NULL,
  `genre_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genre_movie`
--

INSERT INTO `genre_movie` (`movie_id`, `genre_id`) VALUES
(5, 1),
(10, 1),
(13, 1),
(15, 1),
(17, 1),
(21, 1),
(7, 2),
(15, 2),
(4, 3),
(8, 3),
(18, 3),
(4, 4),
(11, 4),
(13, 4),
(14, 4),
(16, 4),
(6, 5),
(20, 5),
(9, 6),
(9, 7),
(12, 8),
(14, 8),
(20, 8),
(22, 8),
(12, 9),
(11, 10),
(18, 10),
(19, 10),
(22, 11);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_10_11_105742_create_theaters_table', 1),
(6, '2024_10_12_144713_genres', 1),
(7, '2024_10_12_144718_movies', 1),
(8, '2024_10_12_144725_genre_movie', 1),
(9, '2024_10_28_132652_create_rows_table', 1),
(10, '2024_10_28_132702_create_types_table', 1),
(11, '2024_10_29_142955_create_rooms_table', 1),
(12, '2024_10_29_143353_create_seats_table', 1),
(13, '2024_10_29_143525_create_shifts_table', 1),
(14, '2024_10_29_143525_create_showtimes_table', 1),
(15, '2024_10_29_143726_create_tickets_table', 1),
(16, '2024_10_29_143758_create_payments_table', 1),
(17, '2024_10_29_144232_create_tickets_seats_table', 1),
(18, '2024_11_17_072309_create_combos_table', 1),
(19, '2024_11_17_072329_create_foods_table', 1),
(20, '2024_11_17_072345_create_drinks_table', 1),
(21, '2024_11_17_072410_create_combo_food_drink_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `duration` int NOT NULL,
  `release_date` date DEFAULT NULL,
  `rating` decimal(3,1) DEFAULT NULL,
  `poster_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `director` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `performer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trailer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `title`, `description`, `duration`, `release_date`, `rating`, `poster_url`, `status`, `director`, `performer`, `trailer`, `created_at`, `updated_at`) VALUES
(1, 'Test', '123456', 2, '2222-12-13', NULL, 'movie/45c5rzjMjDfEcwq4j2tHkiNLJdjS9kxx60cPJQQM.jpg', 'Sắp ra mắt', NULL, NULL, 'https://www.youtube.com/embed/akOLfNUYBbY', '2024-11-19 01:49:05', '2024-11-19 03:16:30'),
(2, 'Phim 1', 'Phim 1', 60, '2024-11-19', NULL, 'movie/M6WfucHY0brPycbdTwzP0AICUSQ2ND920v5Y596D.jpg', 'Sắp ra mắt', NULL, NULL, NULL, '2024-11-25 14:18:18', '2024-11-25 14:18:18'),
(3, 'Phim 2', '123456', 60, '2024-11-20', '3.0', 'movie/cvgBIVSF3OndxwidukJgLNLP7skiFHhxbjosaThl.jpg', 'Đang chiếu', 'HUY', 'HUY 2', 'Chưa có trailer :}}', '2024-11-25 14:22:43', '2024-12-05 15:35:00'),
(4, 'Công Tử Bạc Liêu', 'Lấy cảm hứng từ giai thoại nổi tiếng của nhân vật được mệnh danh là thiên hạ đệ nhất chơi ngông, Công Tử Bạc Liêu là bộ phim tâm lý hài hước, lấy bối cảnh Nam Kỳ Lục Tỉnh xưa của Việt Nam. BA HƠN - Con trai được thương yêu hết mực của ông Hội đồng Lịnh vốn là chủ ngân hàng đầu tiên tại Việt Nam, sau khi du học Pháp về đã sử dụng cả gia sản của mình vào những trò vui tiêu khiển, ăn chơi trác tán – nên được người dân gọi bằng cái tên Công Tử Bạc Liêu.', 113, '2024-12-06', NULL, 'storage/movie/contubaclieu.jpg', 'Sắp ra mắt', 'Lý Minh Thắng', 'NSUT Thành Lộc, Song Luân, Công Dương, Đoàn Thiên Ân,…', 'https://www.youtube.com/embed/akOLfNUYBbY', '2024-12-01 16:37:12', '2024-12-01 16:37:12'),
(5, '1', '1', 1, '2024-12-05', NULL, 'storage/movie/0ftUoLJ64YbUcrLq4ifrYVkmwx2nlcdlkhZsysVZ.jpg', 'Sắp ra mắt', 'HUY', 'HUY 2', 'https://www.youtube.com/embed/akOLfNUYBbY', '2024-12-02 14:49:21', '2024-12-02 14:49:21'),
(6, 'Mèo Ma Bê Tha', 'Câu chuyện tình bạn của cô bé Karin - mồ côi Mẹ và bị Cha bỏ rơi - và một con mèo ma Anzu sống hơi lôi thôi nhưng rất cố gắng chữa lành vết thương tinh thần của cô bé.', 97, '2024-12-06', NULL, 'storage/movie/meobetha.jpg', 'Sắp ra mắt', 'Yōko Kuno, Nobuhiro Yamashita', 'Mirai Moriyama, Noa Gotô, Munetaka Aoki', 'https://www.youtube.com/embed/S5C0glZaKxE', '2024-12-02 03:25:26', '2024-12-02 03:25:49'),
(7, 'Chúa Tể Của Những Chiếc Nhẫn: Cuộc Chiến Của Rohirrim', 'Lấy bối cảnh 183 năm trước những sự kiện trong bộ ba phim gốc, “Chúa Tể Của Những Chiếc Nhẫn: Cuộc Chiến Của Rohirrim\" kể về số phận của Gia tộc của Helm Hammerhand, vị vua huyền thoại của Rohan. Cuộc tấn công bất ngờ của Wulf, lãnh chúa xảo trá và tàn nhẫn của tộc Dunlending, nhằm báo thù cho cái chết của cha hắn, đã buộc Helm và thần dân của ngài phải chống cự trong pháo đài cổ Hornburg - một thành trì vững chãi sau này được biết đến với tên gọi Helm\'s Deep. Tình thế ngày càng tuyệt vọng, Héra, con gái của Helm, phải dốc hết sức dẫn dắt cuộc chiến chống lại kẻ địch nguy hiểm, quyết tâm tiêu diệt bọn chúng.', 135, '2024-12-13', '3.0', 'storage/movie/chuatecuanhungchiecnhan.png', 'Sắp ra mắt', 'Kenji Kamiyama', 'Brian Cox, Gaia Wise, Luke Pasqualino, Miranda Otto,…', 'https://www.youtube.com/embed/ST08liEjNsw', '2024-12-02 03:29:53', '2024-12-05 17:08:39'),
(8, 'Gia Đình Hoàn Hảo', 'Jae-wan là một luật sư chuyên bào chữa thành công cho những vụ án giết người. Em trai Jae-wan là một bác sĩ lương tri, luôn ưu tiên và đặt bệnh nhân lên trên lợi ích của chính mình. Bất ngờ, một sự việc nghiêm trọng giữa hai người con của hai anh em đã diễn ra và đặt ra cho họ một bài toán lương tâm về hướng giải quyết.', 116, '2024-12-13', NULL, 'storage/movie/giadinhhoanhao.png', 'Sắp ra mắt', 'Hur Jin-ho', 'Sul Kyung-gu, Jang Dong-gun, Kim Hee-ae, Claudia Kim', 'https://www.youtube.com/embed/y-0Tfhc2sCM', '2024-12-02 03:32:03', '2024-12-02 03:32:03'),
(9, 'Kraven - Thợ Săn Thủ Lĩnh', 'Kraven the Hunter là câu chuyện đầy khốc liệt và hoành tráng về sự hình thành của một trong những phản diện biểu tượng nhất của Marvel - kẻ thù truyền kiếp của Spiderman. Aaron Taylor-Johnson đảm nhận vai Kraven, một người đàn ông có người cha mafia vô cùng tàn nhẫn, Nikolai Kravinoff (Russell Crowe) - người đã đưa anh vào con đường báo thù với những hệ quả tàn khốc. Điều này thúc đẩy anh không chỉ trở thành thợ săn vĩ đại nhất thế giới, mà còn là một trong những nhân vật đáng sợ nhất.', 119, '2024-12-13', NULL, 'storage/movie/Kraventhosanthulinh.png', 'Sắp ra mắt', 'J. C. Chandor', 'Aaron Taylor-Johnson, Ariana DeBose, Fred Hechinger, Alessandro Nivola, Christopher Abbott, Russell Crowe', 'https://www.youtube.com/embed/rze8QYwWGMs', '2024-12-02 03:36:35', '2024-12-02 03:36:35'),
(10, 'Ngài Quỷ', 'Một bác sĩ chuyên khoa tim nghi ngờ cái chết của con gái mình sau một cuộc trừ tà, tin rằng trái tim cô bé vẫn đập. Trong đám tang kéo dài ba ngày của cô bé, anh và một linh mục đã tranh cãi về sự thật, mỗi người đều cố gắng chứng minh lập trường của mình và có khả năng cứu mạng cô bé.', 95, '2024-12-13', NULL, 'storage/movie/Ngaiquy.png', 'Sắp ra mắt', 'Moon-Sub Hyun', 'Park Shin-yang, Lee Min-ki, Lee Re', 'https://www.youtube.com/embed/q4mZKsSosiY', '2024-12-02 03:37:44', '2024-12-02 03:37:44'),
(11, 'Chị Dâu', 'Chuyện bắt đầu khi bà Nhị - con dâu cả của gia đình quyết định nhân dịp đám giỗ của mẹ chồng, tụ họp cả bốn chị em gái - con ruột trong nhà lại để thông báo chuyện sẽ tự bỏ tiền túi ra sửa sang căn nhà từ đường cũ kỹ trước khi bão về.', 100, '2024-12-20', NULL, 'storage/movie/chidau.png', 'Sắp ra mắt', 'Khương Ngọc', 'Ngọc Trinh, Việt Hương, Hồng Đào,...', 'https://www.youtube.com/embed/XU4oplOtoQo', '2024-12-02 03:38:57', '2024-12-02 03:38:57'),
(12, 'Mufasa: Vua Sư Tử', 'Mufasa: Vua Sư Tử là phần tiền truyện của bộ phim hoạt hình Vua Sư Tử trứ danh, kể về cuộc đời của Mufasa - cha của Simba. Phim là hành trình Mufasa từ một chú sư tử mồ côi lạc đàn trở thành vị vua sư tử huyền thoại của Xứ Vua (Pride Land). Ngoài ra, quá khứ về tên phản diện Scar và hành trình hắc hóa của hắn cũng sẽ được phơi bày trong phần phim này.', 118, '2024-12-20', NULL, 'storage/movie/mufasavuasutu.png', 'Sắp ra mắt', 'Barry Jenkins', 'Aaron Pierre, Kelvin Harrison Jr., Tiffany Boone, Kagiso Lediga,...', 'https://www.youtube.com/embed/o17MF9vnabg', '2024-12-02 03:41:09', '2024-12-02 03:41:09'),
(13, '404 Chạy Ngay Đi', 'Nakrob, một kẻ lừa đảo bất động sản trẻ tuổi, phát hiện ra một khách sạn trên sườn đồi bị bỏ hoang gần bãi biển. Nhìn thấy cơ hội, anh ta quyết định biến nó thành một vụ lừa đảo khách sạn sang trọng.', 101, '2024-12-27', NULL, 'storage/movie/404chayngaydi.png', 'Đang chiếu', 'Pichaya Jarusboonpracha', 'Chantavit Dhanasevi, Kanyawee Songmuang, Pittaya Saechua, Chookiat Iamsook, Supathat Opas', 'https://www.youtube.com/embed/1dR-JmWBi-g', '2024-12-02 03:42:20', '2024-12-02 03:56:45'),
(14, 'Kính Vạn Hoa', 'Sau sự thành công của hai phim điện ảnh chuyển thể từ hai tác phẩm đình đám của nhà văn Nguyễn Nhật Ánh, một tác phẩm nổi bật khác của nhà văn hiện đại thành công nhất Việt Nam chuẩn bị được đưa lên màn ảnh rộng: “Kính Vạn Hoa”. Và đạo diễn dự án bom tấn này là “đạo diễn trăm tỷ” Võ Thanh Hòa.', 100, '2024-12-27', NULL, 'storage/movie/kinhvanhoa.jpg', 'Sắp ra mắt', 'Võ Thanh Hòa', 'none', 'https://www.youtube.com/embed/DsTUfZ0h_KM', '2024-12-02 03:44:39', '2024-12-02 03:44:39'),
(15, 'Chiến Địa Tử Thi', 'Chiến Địa Tử Thi lấy bối cảnh miền Nam Thái Lan trong một cuộc xâm lược ít được biết đến của quân đội Nhật Bản thời kỳ Thế chiến 2. Mek (Nonkul) là một hạ sĩ quan trong quân đội Thái Lan mang tình yêu lớn với đất nước, sẵn sàng hy sinh thân mình vì đại cuộc. Ngược lại, người em trai Mok (Awat Rattanaphinta) là một chàng trai trẻ thích tự do, không bao giờ muốn trở thành một người lính như cha và anh trai mình. Đối với Mok, việc tham gia chiến tranh giống như vứt bỏ mạng sống một cách vô ích.', 105, '2024-11-29', NULL, 'storage/movie/chiendiatuthi.jpg', 'Đang chiếu', 'Kongkiat Komesiri', 'Nonkul, Awat Ratanapintha, Supitcha Sangkhachinda, Akkarat Nimitchai, Thawatchanin Darayon, Thanadol Auepong, Guntapat Kasemsan Na Ayudhya, Seigi Ohzeki', 'https://www.youtube.com/embed/BkM-we8h9b4', '2024-12-02 03:54:54', '2024-12-02 03:54:54'),
(16, 'Cười Xuyên Biên Giới', 'Cười Xuyên Biên Giới kể về hành trình của Jin-bong (Ryu Seung-ryong) - cựu vô địch bắn cung quốc gia, sau khi nghỉ hưu, anh đã trở thành một nhân viên văn phòng bình thường. Đứng trước nguy cơ bị sa thải, Jin-bong phải nhận một nhiệm vụ bất khả thi là bay đến nửa kia của trái đất trong nỗ lực tuyệt vọng để sinh tồn. Sống sót sau một sự cố đe doạ tính mạng, Jin-bong đã “hạ cánh” xuống khu rừng Amazon, nơi anh gặp bộ ba thổ dân bản địa có kỹ năng bắn cung thượng thừa: Sika, Eeba và Walbu. Tin rằng đã tìm ra cách để tự cứu mình, Jin-bong hợp tác với phiên dịch ngáo ngơ Bbang-sik (Jin Sun-kyu) và đưa ba chiến thần cung thủ đến Hàn Quốc cho một nhiệm vụ táo bạo.', 113, '2024-11-15', NULL, 'storage/movie/cuõiuyenbiengioi.jpg', 'Đang chiếu', 'KIM Chang-ju', 'Ryu Seung-ryong , Jin Sun-kyu, Igor Rafael P EDROSO, Luan B RUM DE ABREU E LIMA, JB João Batista GOMES DE O LIVEIRA, Yeom Hye-ran và Go Kyoung- pyo, Lee Soon-won', 'https://www.youtube.com/embed/c-XbI-G6bqE', '2024-12-02 03:55:49', '2024-12-02 03:55:49'),
(17, 'Quỷ Treo Đầu', 'Quỷ Treo Đầu Petai & Nicha - cặp đôi trẻ đẹp liên tục bị quấy phá sau khi chuyển đến ngôi nhà gia truyền của Nicha. Từ những tiếng động cót két chói tai đến những cái chết mất xác; tất cả đều xuất phát từ một lời nguyền cổ xưa ma quái.', 97, '2024-11-29', NULL, 'storage/movie/quytreodau.jpg', '', 'Bo Nipan Chawcharernpon', 'Khun Chanon Ukkharachata, Aniporn Chalermburanawong', 'https://www.youtube.com/embed/yjL9YgnmVlg', '2024-12-02 03:56:32', '2024-12-02 03:56:32'),
(18, 'Blue Period', 'Một học sinh trung học thành đạt nhưng buồn chán đã có động lực theo đuổi sự nghiệp nghệ thuật và khám phá ra niềm đam mê hội họa của mình.', 115, '2024-11-29', NULL, 'storage/movie/blueperiod.jpg', 'Đang chiếu', 'Kentarô Hagiwara', 'Gordon Maeda, Fumiya Takahashi, Rihito Itagaki, Hiyori Sakurada', 'https://www.youtube.com/embed/bMcNeq229Ms', '2024-12-02 04:03:14', '2024-12-02 04:03:14'),
(19, 'Cu Li Không Bao Giờ Khóc', 'Sau đám tang người chồng cũ ở nước ngoài, bà Nguyện quay lại Hà Nội với một bình tro và một con cu li nhỏ - loài linh trưởng đặc hữu của bán đảo Đông Dương. Về tới nơi, bà phát hiện ra cô cháu gái mang bầu đang vội vã chuẩn bị đám cưới. Lo sợ cô đi theo vết xe đổ của đời mình, bà kịch liệt phản đối. Bộ phim Cu Li Không Bao Giờ Khóc khéo léo pha trộn đời sống hiện tại và những dư âm phức tạp của lịch sử Việt Nam bằng cách đan xen hoài niệm về quá khứ của người dì lớn tuổi và dự cảm về tương lai đầy bất định của cặp đôi trẻ.', 91, '2024-11-15', NULL, 'storage/movie/culikhongbaogiokhoc.png', 'Đang chiếu', 'Phạm Ngọc Lân', 'NSND Minh Châu, Hà Phương, Xuân An, Hoàng Hà', 'https://www.youtube.com/embed/eoYdy-9-YkA', '2024-12-02 04:04:08', '2024-12-02 04:04:08'),
(20, 'Hành Trình Của Moana 2', '“Hành Trình của Moana 2” là màn tái hợp của Moana và Maui sau 3 năm, trở lại trong chuyến phiêu lưu cùng với những thành viên mới. Theo tiếng gọi của tổ tiên, Moana sẽ tham gia cuộc hành trình đến những vùng biển xa xôi của Châu Đại Dương và sẽ đi tới vùng biển nguy hiểm, đã mất tích từ lâu. Cùng chờ đón cuộc phiêu lưu của Moana đầy chông gai sắp tới vào 29.11.2024.', 99, '2024-12-04', NULL, 'storage/movie/mona2.jpg', 'Đang chiếu', 'David G. Derrick Jr.', 'Auli\'i Cravalho, Dwayne Johnson, Alan Tudyk', 'https://www.youtube.com/embed/HA56rBQSueY', '2024-12-02 04:04:58', '2024-12-02 04:04:58'),
(21, 'Hồn Ma Mae Nak', 'Một cặp đôi trẻ đánh thức lại tinh thần của một truyền thuyết cổ xưa nổi tiếng của Thái Lan.', 101, '2024-11-22', NULL, 'storage/movie/Hônmamaenak.jpg', 'Đang chiếu', 'Mark Duffield', 'Pataratida Pacharawirapong, Siwat Chotchaicharin, Porntip Papanai', 'https://www.youtube.com/embed/p25Oc8fsr5c', '2024-12-02 04:05:52', '2024-12-02 04:05:52'),
(22, 'Wicked', 'Sau hai thập kỷ là một trong những vở nhạc kịch được yêu thích và bền bỉ nhất trên sân khấu, Wicked đã thực hiện hành trình được mong đợi từ lâu lên màn ảnh rộng như một sự kiện điện ảnh hai phần ngoạn mục, định hình thế hệ trong mùa lễ này.', 161, '2024-11-22', NULL, 'storage/movie/wicked.jpg', 'Đang chiếu', 'Jon M. Chu', 'Cynthia Erivo, Ariana Grande, Jonathan Bailey', 'https://www.youtube.com/embed/6COmYeLsz4c', '2024-12-02 04:06:43', '2024-12-02 04:06:43');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` bigint UNSIGNED NOT NULL,
  `ticket_id` bigint UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` enum('credit_card','paypal','cash') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` enum('pending','completed','failed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` bigint UNSIGNED NOT NULL,
  `theater_id` bigint UNSIGNED NOT NULL,
  `room_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `theater_id`, `room_name`, `created_at`, `updated_at`) VALUES
(6, 2, '1', '2024-11-24 08:18:34', '2024-11-24 08:18:34'),
(7, 2, '2', '2024-11-25 14:23:33', '2024-11-25 14:23:33'),
(8, 2, '3', '2024-11-25 14:23:44', '2024-11-25 14:23:44'),
(9, 2, 'phong 111', '2024-12-08 07:39:56', '2024-12-08 07:39:56');

-- --------------------------------------------------------

--
-- Table structure for table `rows`
--

CREATE TABLE `rows` (
  `row_id` bigint UNSIGNED NOT NULL,
  `row_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `room_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rows`
--

INSERT INTO `rows` (`row_id`, `row_name`, `created_at`, `updated_at`, `room_id`) VALUES
(1, 'A', '2024-11-30 16:03:19', '2024-11-30 16:03:19', 6),
(2, 'B', '2024-11-30 16:03:41', '2024-11-30 16:03:41', 6),
(6, 'A', '2024-12-03 04:31:06', '2024-12-03 04:31:06', 7),
(7, 'B', '2024-12-03 04:31:51', '2024-12-03 04:31:51', 7),
(8, 'A', '2024-12-03 05:39:03', '2024-12-03 05:39:03', 8);

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `seat_id` bigint UNSIGNED NOT NULL,
  `room_id` bigint UNSIGNED NOT NULL,
  `seat_number` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('available','booked') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `row_id` bigint UNSIGNED DEFAULT NULL,
  `type_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`seat_id`, `room_id`, `seat_number`, `status`, `created_at`, `updated_at`, `row_id`, `type_id`) VALUES
(1, 6, 'A1', 'available', '2024-11-30 16:07:21', '2024-12-01 00:56:09', 1, 1),
(2, 6, 'A2', 'available', '2024-11-30 16:07:30', '2024-12-01 00:56:14', 1, 1),
(3, 6, 'A3', 'available', '2024-11-30 16:07:36', '2024-12-01 00:56:18', 1, 1),
(4, 6, 'A4', 'available', '2024-11-30 16:07:41', '2024-12-01 00:56:22', 1, 1),
(5, 6, 'A5', 'available', '2024-11-30 16:07:48', '2024-12-01 00:56:27', 1, 1),
(6, 6, 'B1', 'available', '2024-11-30 16:08:02', '2024-12-01 00:56:32', 2, 2),
(7, 6, 'B2', 'available', '2024-11-30 16:08:08', '2024-12-01 00:56:37', 2, 2),
(8, 6, 'B3', 'available', '2024-11-30 16:08:15', '2024-12-01 00:56:41', 2, 2),
(9, 6, 'B4', 'available', '2024-11-30 16:08:22', '2024-12-01 00:56:45', 2, 2),
(10, 6, 'B5', 'available', '2024-11-30 16:08:32', '2024-12-01 00:56:53', 2, 2),
(11, 6, 'B6', 'available', '2024-11-30 18:03:52', '2024-11-30 18:03:52', 2, 1),
(12, 6, 'A6', 'available', '2024-11-30 18:04:11', '2024-11-30 18:04:11', 1, 1),
(13, 6, 'A7', 'available', '2024-11-30 18:04:20', '2024-11-30 18:04:20', 1, 1),
(14, 7, 'A1', 'available', NULL, NULL, 6, 1),
(999, 6, 'B7', 'available', '2024-12-05 14:51:08', '2024-12-05 14:51:08', 2, 2),
(1000, 6, 'B8', 'available', '2024-12-05 14:51:08', '2024-12-05 14:51:08', 2, 2),
(1001, 6, 'B9', 'available', '2024-12-05 14:51:08', '2024-12-05 14:51:08', 2, 2),
(1002, 6, 'B10', 'available', '2024-12-05 14:51:08', '2024-12-05 14:51:08', 2, 2),
(1003, 6, 'B11', 'available', '2024-12-05 14:51:08', '2024-12-05 14:51:08', 2, 2),
(1004, 6, 'A8', 'available', '2024-12-05 16:14:00', '2024-12-05 16:14:00', 1, 1),
(1005, 6, 'A9', 'available', '2024-12-05 16:14:00', '2024-12-05 16:14:00', 1, 1),
(1006, 6, 'A10', 'available', '2024-12-05 16:14:00', '2024-12-05 16:14:00', 1, 1),
(1007, 6, 'A11', 'available', '2024-12-05 16:14:00', '2024-12-05 16:14:00', 1, 1),
(1008, 6, 'A12', 'available', '2024-12-05 16:14:00', '2024-12-05 16:14:00', 1, 1),
(1009, 6, 'A13', 'available', '2024-12-05 16:14:00', '2024-12-05 16:14:00', 1, 1),
(1010, 6, 'A14', 'available', '2024-12-05 16:14:00', '2024-12-05 16:14:00', 1, 1),
(1011, 6, 'A15', 'available', '2024-12-05 16:14:00', '2024-12-05 16:14:00', 1, 1),
(1012, 6, 'A16', 'available', '2024-12-05 16:14:00', '2024-12-05 16:14:00', 1, 1),
(1013, 6, 'A17', 'available', '2024-12-05 16:14:00', '2024-12-05 16:14:00', 1, 1),
(1014, 6, 'A18', 'available', '2024-12-05 16:14:20', '2024-12-05 16:14:20', 1, 1),
(1015, 6, 'A19', 'available', '2024-12-05 16:14:20', '2024-12-05 16:14:20', 1, 1),
(1016, 6, 'A20', 'available', '2024-12-05 16:14:20', '2024-12-05 16:14:20', 1, 1),
(1017, 6, 'A21', 'available', '2024-12-05 16:14:20', '2024-12-05 16:14:20', 1, 1),
(1018, 6, 'A22', 'available', '2024-12-05 16:14:20', '2024-12-05 16:14:20', 1, 1),
(1019, 6, 'A23', 'available', '2024-12-05 16:14:20', '2024-12-05 16:14:20', 1, 1),
(1020, 6, 'A24', 'available', '2024-12-05 16:14:20', '2024-12-05 16:14:20', 1, 1),
(1021, 6, 'B12', 'available', '2024-12-05 16:14:46', '2024-12-05 16:14:46', 2, 2),
(1022, 6, 'B13', 'available', '2024-12-05 16:14:46', '2024-12-05 16:14:46', 2, 2),
(1023, 6, 'B14', 'available', '2024-12-05 16:14:46', '2024-12-05 16:14:46', 2, 2),
(1024, 6, 'B15', 'available', '2024-12-05 16:14:46', '2024-12-05 16:14:46', 2, 2),
(1025, 6, 'B16', 'available', '2024-12-05 16:14:46', '2024-12-05 16:14:46', 2, 2),
(1026, 6, 'B17', 'available', '2024-12-05 16:14:46', '2024-12-05 16:14:46', 2, 2),
(1027, 6, 'B18', 'available', '2024-12-05 16:14:46', '2024-12-05 16:14:46', 2, 2),
(1028, 6, 'B19', 'available', '2024-12-05 16:14:46', '2024-12-05 16:14:46', 2, 2),
(1029, 6, 'B20', 'available', '2024-12-05 16:14:46', '2024-12-05 16:14:46', 2, 2),
(1030, 6, 'B21', 'available', '2024-12-05 16:14:46', '2024-12-05 16:14:46', 2, 2),
(1031, 6, 'B22', 'available', '2024-12-05 16:14:46', '2024-12-05 16:14:46', 2, 2),
(1032, 6, 'B23', 'available', '2024-12-05 16:14:46', '2024-12-05 16:14:46', 2, 2),
(1033, 6, 'B24', 'available', '2024-12-05 16:14:46', '2024-12-05 16:14:46', 2, 2),
(1034, 6, 'A25', 'available', '2024-12-06 02:14:39', '2024-12-06 02:14:39', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `shift_id` bigint UNSIGNED NOT NULL,
  `shift_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`shift_id`, `shift_name`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(1, 'Sáng', '06:00:00', '08:00:00', '2024-11-19 01:51:58', '2024-11-19 01:51:58'),
(2, 'Sáng', '09:00:00', '11:00:00', '2024-11-19 01:52:13', '2024-11-19 01:52:13'),
(3, 'Sáng', '12:00:00', '14:00:00', '2024-11-19 05:14:57', '2024-11-19 05:14:57'),
(4, 'Chiều', '14:00:00', '16:00:00', '2024-12-05 17:17:52', '2024-12-05 17:17:52');

-- --------------------------------------------------------

--
-- Table structure for table `showtimes`
--

CREATE TABLE `showtimes` (
  `showtime_id` bigint UNSIGNED NOT NULL,
  `movie_id` bigint UNSIGNED NOT NULL,
  `room_id` bigint UNSIGNED NOT NULL,
  `shift_id` bigint UNSIGNED NOT NULL,
  `theater_id` bigint UNSIGNED DEFAULT NULL,
  `datetime` date DEFAULT NULL,
  `normal_price` int DEFAULT NULL,
  `vip_price` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `showtimes`
--

INSERT INTO `showtimes` (`showtime_id`, `movie_id`, `room_id`, `shift_id`, `theater_id`, `datetime`, `normal_price`, `vip_price`, `created_at`, `updated_at`) VALUES
(7, 1, 6, 1, 2, '2024-12-03', 10000, 20000, NULL, NULL),
(8, 1, 6, 2, 2, '2024-12-03', 10000, 20000, NULL, NULL),
(9, 1, 6, 3, 2, '2024-12-03', 10000, 20000, NULL, NULL),
(11, 1, 7, 3, 2, '2024-12-05', 10000, 20000, NULL, NULL),
(13, 4, 6, 1, 1, '2024-12-05', 10000, 20000, NULL, NULL),
(14, 4, 6, 1, 1, '2024-12-09', 10000, 20000, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `theaters`
--

CREATE TABLE `theaters` (
  `theater_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `theaters`
--

INSERT INTO `theaters` (`theater_id`, `name`, `location`, `created_at`, `updated_at`) VALUES
(1, 'Nguyễn Như Huy', 'test', '2024-11-19 01:45:45', '2024-11-19 01:45:45'),
(2, 'Hà Nội', 'hà Nọi', '2024-11-19 05:13:35', '2024-11-19 05:13:35');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `showtime_id` bigint UNSIGNED NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `ticket_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `food_id` bigint UNSIGNED DEFAULT NULL,
  `drink_id` bigint UNSIGNED DEFAULT NULL,
  `combo_id` bigint UNSIGNED DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `user_id`, `showtime_id`, `total_price`, `ticket_time`, `food_id`, `drink_id`, `combo_id`, `status`) VALUES
(44, 1, 7, '50000.00', '2024-11-24 15:31:33', 1, 1, 1, 'completed'),
(81, 2, 7, '30000.00', '2024-12-03 01:57:40', NULL, NULL, NULL, 'completed'),
(82, 2, 7, '30000.00', '2024-12-03 02:16:22', NULL, NULL, NULL, 'completed'),
(83, 2, 7, '70000.00', '2024-12-03 03:54:39', NULL, NULL, NULL, 'completed'),
(84, 2, 8, '10000.00', '2024-12-03 04:17:30', NULL, NULL, NULL, 'completed'),
(92, 2, 7, '60000.00', '2024-12-05 16:16:58', NULL, NULL, NULL, 'completed'),
(102, 2, 13, '30000.00', '2024-12-06 17:22:40', 1, 1, NULL, 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `tickets_seats`
--

CREATE TABLE `tickets_seats` (
  `ticket_id` bigint UNSIGNED NOT NULL,
  `seat_id` bigint UNSIGNED NOT NULL,
  `showtime_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets_seats`
--

INSERT INTO `tickets_seats` (`ticket_id`, `seat_id`, `showtime_id`) VALUES
(81, 1, 7),
(81, 6, 7),
(82, 2, 7),
(82, 7, 7),
(83, 3, 7),
(92, 1008, 7),
(92, 1009, 7),
(92, 1021, 7),
(92, 1022, 7),
(84, 1, 8),
(102, 1, 13),
(102, 6, 13);

-- --------------------------------------------------------

--
-- Table structure for table `tintuc`
--

CREATE TABLE `tintuc` (
  `id_tintuc` int NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `poster_url` text NOT NULL,
  `release_date` date NOT NULL,
  `ngon_ngu` int NOT NULL,
  `status` varchar(255) NOT NULL,
  `id_genres` bigint UNSIGNED NOT NULL,
  `detailed_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `type_id` bigint UNSIGNED NOT NULL,
  `type_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`type_id`, `type_name`, `created_at`, `updated_at`) VALUES
(1, 'Ghế thường', '2024-11-30 14:58:53', '2024-11-30 14:58:53'),
(2, 'VIP', '2024-11-30 14:58:53', '2024-11-30 14:58:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'storage/users/avatar-mac-dinh-30xJKPDu.png',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `member_point` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `avt`, `email_verified_at`, `password`, `created_at`, `updated_at`, `status`, `member_point`) VALUES
(1, '1', 'abc@gmail.com', 'storage/users/avatar-mac-dinh-30xJKPDu.png	', NULL, '', NULL, '2024-12-02 15:52:09', 'member', 130),
(2, 'Nguyễn Như Huy', 'nguyennhuhuy1312@gmail.com', 'storage/users/8jcChAg3dJgrmR4ApNkPqMHecybGFL1MbeRfRX2W.jpg', NULL, '$2y$12$Ppc4r.8U8G20ZxZi7Kq6Cerrdczxkak5VK7KexQxJuoq8FOUkGgfO', '2024-12-02 14:16:54', '2024-12-06 17:23:28', 'member', 470);

-- --------------------------------------------------------

--
-- Table structure for table `vourchers`
--

CREATE TABLE `vourchers` (
  `id` bigint UNSIGNED NOT NULL,
  `vourcher_code` varchar(255) NOT NULL,
  `vourcher_price` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vourchers`
--

INSERT INTO `vourchers` (`id`, `vourcher_code`, `vourcher_price`, `created_at`, `updated_at`) VALUES
(1, 'QWERTY', '2', NULL, NULL),
(2, 'QWERTY', '10', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vourcher_user`
--

CREATE TABLE `vourcher_user` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `vourcher_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vourcher_user`
--

INSERT INTO `vourcher_user` (`id`, `user_id`, `vourcher_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `combos`
--
ALTER TABLE `combos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `combo_food_drink`
--
ALTER TABLE `combo_food_drink`
  ADD PRIMARY KEY (`id`),
  ADD KEY `combo_food_drink_combo_id_foreign` (`combo_id`),
  ADD KEY `combo_food_drink_food_id_foreign` (`food_id`),
  ADD KEY `combo_food_drink_drink_id_foreign` (`drink_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `drinks`
--
ALTER TABLE `drinks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `genre_movie`
--
ALTER TABLE `genre_movie`
  ADD PRIMARY KEY (`movie_id`,`genre_id`),
  ADD KEY `genre_movie_genre_id_foreign` (`genre_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `payments_ticket_id_foreign` (`ticket_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `rooms_theater_id_foreign` (`theater_id`);

--
-- Indexes for table `rows`
--
ALTER TABLE `rows`
  ADD PRIMARY KEY (`row_id`),
  ADD KEY `fk_room_id` (`room_id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`seat_id`),
  ADD KEY `seats_room_id_foreign` (`room_id`),
  ADD KEY `seats_row_id_foreign` (`row_id`),
  ADD KEY `seats_type_id_foreign` (`type_id`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`shift_id`);

--
-- Indexes for table `showtimes`
--
ALTER TABLE `showtimes`
  ADD PRIMARY KEY (`showtime_id`),
  ADD KEY `showtimes_movie_id_foreign` (`movie_id`),
  ADD KEY `showtimes_room_id_foreign` (`room_id`),
  ADD KEY `showtimes_shift_id_foreign` (`shift_id`),
  ADD KEY `showtimes_theater_id_foreign` (`theater_id`);

--
-- Indexes for table `theaters`
--
ALTER TABLE `theaters`
  ADD PRIMARY KEY (`theater_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `tickets_user_id_foreign` (`user_id`),
  ADD KEY `tickets_showtime_id_foreign` (`showtime_id`),
  ADD KEY `fk_food_id` (`food_id`),
  ADD KEY `fk_drink_id` (`drink_id`),
  ADD KEY `fk_combo_id` (`combo_id`);

--
-- Indexes for table `tickets_seats`
--
ALTER TABLE `tickets_seats`
  ADD PRIMARY KEY (`ticket_id`,`seat_id`),
  ADD KEY `tickets_seats_seat_id_foreign` (`seat_id`),
  ADD KEY `tickets_seats_showtime_id_foreign` (`showtime_id`);

--
-- Indexes for table `tintuc`
--
ALTER TABLE `tintuc`
  ADD PRIMARY KEY (`id_tintuc`),
  ADD KEY `lk_pro` (`id_genres`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vourchers`
--
ALTER TABLE `vourchers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vourcher_user`
--
ALTER TABLE `vourcher_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `combos`
--
ALTER TABLE `combos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `combo_food_drink`
--
ALTER TABLE `combo_food_drink`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `drinks`
--
ALTER TABLE `drinks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `genre_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rows`
--
ALTER TABLE `rows`
  MODIFY `row_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `seat_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1037;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `shift_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `showtimes`
--
ALTER TABLE `showtimes`
  MODIFY `showtime_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `theaters`
--
ALTER TABLE `theaters`
  MODIFY `theater_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `type_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vourchers`
--
ALTER TABLE `vourchers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vourcher_user`
--
ALTER TABLE `vourcher_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `combo_food_drink`
--
ALTER TABLE `combo_food_drink`
  ADD CONSTRAINT `combo_food_drink_combo_id_foreign` FOREIGN KEY (`combo_id`) REFERENCES `combos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `combo_food_drink_drink_id_foreign` FOREIGN KEY (`drink_id`) REFERENCES `drinks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `combo_food_drink_food_id_foreign` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`);

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `genre_movie`
--
ALTER TABLE `genre_movie`
  ADD CONSTRAINT `genre_movie_genre_id_foreign` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`genre_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `genre_movie_movie_id_foreign` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`ticket_id`) ON DELETE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_theater_id_foreign` FOREIGN KEY (`theater_id`) REFERENCES `theaters` (`theater_id`) ON DELETE CASCADE;

--
-- Constraints for table `rows`
--
ALTER TABLE `rows`
  ADD CONSTRAINT `fk_room_id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `seats_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `seats_row_id_foreign` FOREIGN KEY (`row_id`) REFERENCES `rows` (`row_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `seats_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`type_id`) ON DELETE CASCADE;

--
-- Constraints for table `showtimes`
--
ALTER TABLE `showtimes`
  ADD CONSTRAINT `showtimes_movie_id_foreign` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `showtimes_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `showtimes_shift_id_foreign` FOREIGN KEY (`shift_id`) REFERENCES `shifts` (`shift_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `showtimes_theater_id_foreign` FOREIGN KEY (`theater_id`) REFERENCES `theaters` (`theater_id`) ON DELETE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `fk_combo_id` FOREIGN KEY (`combo_id`) REFERENCES `combos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_drink_id` FOREIGN KEY (`drink_id`) REFERENCES `drinks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_food_id` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tickets_showtime_id_foreign` FOREIGN KEY (`showtime_id`) REFERENCES `showtimes` (`showtime_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `tickets_seats`
--
ALTER TABLE `tickets_seats`
  ADD CONSTRAINT `tickets_seats_seat_id_foreign` FOREIGN KEY (`seat_id`) REFERENCES `seats` (`seat_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tickets_seats_showtime_id_foreign` FOREIGN KEY (`showtime_id`) REFERENCES `showtimes` (`showtime_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tickets_seats_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`ticket_id`) ON DELETE CASCADE;

--
-- Constraints for table `tintuc`
--
ALTER TABLE `tintuc`
  ADD CONSTRAINT `lk_pro` FOREIGN KEY (`id_genres`) REFERENCES `genres` (`genre_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
