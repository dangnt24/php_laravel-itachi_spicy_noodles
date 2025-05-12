-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 13, 2025 at 12:39 AM
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
-- Database: `itachi_spicy_noodles`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `username` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `fullname` varchar(128) NOT NULL,
  `gender` varchar(10) NOT NULL DEFAULT 'male',
  `birthday` datetime NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'user.png',
  `position` varchar(100) DEFAULT NULL,
  `role_id` int(10) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`username`, `password`, `fullname`, `gender`, `birthday`, `email`, `phone`, `address`, `avatar`, `position`, `role_id`, `created_at`, `updated_at`, `deleted`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'male', '0000-00-00 00:00:00', 'admin@gmail.com', '0123456789', 'Viet Nam', 'user.png', NULL, 1, '2023-06-29 16:57:28', NULL, b'0'),
('dvp', '202cb962ac59075b964b07152d234b70', 'Dang Vip Pro', 'male', '2024-07-18 00:00:00', 'dangvippro@gmail.com', '0123456789', 'Việt Nam', 'IMG_2024-07-17-18-07-18_avatar-3x4.jpg', NULL, 2, '2023-07-03 19:23:16', '2024-10-26 00:38:17', b'0'),
('user', '202cb962ac59075b964b07152d234b70', 'Dang dz', 'male', '2000-02-04 00:00:00', 'dvp@gmail.com', '0154645', 'VN', 'user.png', 'Direction', 2, '2024-10-25 12:11:21', '2024-10-25 12:48:57', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `c_id` int(10) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`c_id`, `c_name`, `created_at`, `updated_at`, `deleted`) VALUES
(1, 'Mì kim chi', '2023-07-03 19:41:25', NULL, b'0'),
(2, 'Mì lẩu thái', '2023-07-03 00:00:00', NULL, b'0'),
(3, 'Các loại bánh', '2023-07-03 00:00:00', NULL, b'0'),
(4, 'Đồ ăn vặt', '2023-07-03 19:43:22', NULL, b'0'),
(5, 'Bingsu và kem', '2023-07-03 00:00:00', NULL, b'0'),
(6, 'Trà và nước uống', '2023-07-03 19:43:22', NULL, b'0'),
(7, 'Món Thêm', '2024-11-03 06:58:24', NULL, b'0'),
(8, 'Khác', '2024-11-03 06:47:42', NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `o_id` int(10) NOT NULL,
  `username` varchar(32) NOT NULL,
  `total_pay` decimal(10,0) NOT NULL,
  `order_note` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `address` varchar(255) NOT NULL,
  `delivery_method` varchar(10) NOT NULL,
  `status` varchar(255) NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`o_id`, `username`, `total_pay`, `order_note`, `fullname`, `phone`, `address`, `delivery_method`, `status`, `reason`, `created_at`, `updated_at`, `deleted`) VALUES
(16, 'dvp', 129, NULL, 'Dang Vip Pro', '0123456789', 'Việt Nam', 'Delivery', 'Done', NULL, '2024-11-01 19:18:25', '2024-11-02 23:41:24', b'0'),
(17, 'dvp', 70, NULL, 'Dang Vip Pro', '0123456789', 'Việt Nam', 'Delivery', 'Done', NULL, '2024-11-03 07:26:50', '2024-11-03 00:29:06', b'0'),
(18, 'user', 62, NULL, 'Dang dz', '0154645', 'VN', 'Delivery', 'Done', NULL, '2024-11-03 07:31:27', '2024-11-03 00:32:14', b'0'),
(19, 'user', 50, NULL, 'Dang dz', '0154645', 'VN', 'Delivery', 'Done', NULL, '2024-11-03 07:34:55', '2024-11-03 00:36:07', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `od_id` int(11) NOT NULL,
  `o_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `quantity` int(11) NOT NULL,
  `level` int(11) DEFAULT NULL,
  `isFresh` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`od_id`, `o_id`, `pro_id`, `price`, `quantity`, `level`, `isFresh`, `note`) VALUES
(16, 16, 1, 42, 2, 7, 1, 'xx=cá'),
(17, 16, 2, 45, 1, 3, 0, NULL),
(18, 17, 2, 45, 1, 3, 0, 'mì thêm'),
(19, 17, 47, 10, 2, 0, 0, NULL),
(20, 17, 50, 5, 1, 0, 0, NULL),
(21, 18, 1, 42, 1, 1, 0, NULL),
(22, 18, 48, 10, 2, 0, 0, NULL),
(23, 19, 2, 45, 1, 2, 0, 'kim chi bù nấm kim châm'),
(24, 19, 49, 5, 1, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pro_id` int(10) NOT NULL,
  `pro_name` varchar(255) NOT NULL,
  `pro_price` decimal(10,0) NOT NULL,
  `pro_discount` decimal(10,0) DEFAULT NULL,
  `pro_description` varchar(1000) NOT NULL,
  `pro_image` varchar(255) DEFAULT NULL,
  `outstanding` bit(1) NOT NULL DEFAULT b'0',
  `c_id` int(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pro_id`, `pro_name`, `pro_price`, `pro_discount`, `pro_description`, `pro_image`, `outstanding`, `c_id`, `created_at`, `updated_at`, `deleted`) VALUES
(1, 'Mì Kim Chi Bò', 42, NULL, 'Sợi mì dai dai thấm nhuần hương vị từ nước lẩu kim chi, topping thì vừa mềm vừa thơm, cắn một miếng là quên ngay mọi việc xung quanh luôn nha. Chưa hết đâu, vị chua chua cay cay của nước lẩu lại siêu kích thích vị giác, ăn một miếng liền muốn ăn thêm miếng nữa. Ăn món mới này các bạn sẽ không biết no khi nào đâu nhé.', 'mi-kim-chi-bo.jpg', b'1', 1, '2023-07-03 19:16:29', '2024-10-25 19:54:44', b'0'),
(2, 'Mì Kim Chi Hải Sản', 45, NULL, 'Sợi mì dai dai thấm nhuần hương vị từ nước lẩu kim chi, topping thì vừa mềm vừa thơm, cắn một miếng là quên ngay mọi việc xung quanh luôn nha. Chưa hết đâu, vị chua chua cay cay của nước lẩu lại siêu kích thích vị giác, ăn một miếng liền muốn ăn thêm miếng nữa. Ăn món mới này các bạn sẽ không biết no khi nào đâu nhé.', 'mi-kim-chi-hai-san.jpg', b'1', 1, '2023-07-01 02:03:04', '2024-07-17 18:10:44', b'0'),
(3, 'Mì Kim Chi Xúc Xích Cá Viên', 35, NULL, 'Sợi mì dai dai thấm nhuần hương vị từ nước lẩu kim chi, topping thì vừa mềm vừa thơm, cắn một miếng là quên ngay mọi việc xung quanh luôn nha. Chưa hết đâu, vị chua chua cay cay của nước lẩu lại siêu kích thích vị giác, ăn một miếng liền muốn ăn thêm miếng nữa. Ăn món mới này các bạn sẽ không biết no khi nào đâu nhé.', 'mi-kim-chi-xuc-xich-ca-vien.jpg', b'0', 1, '2023-07-01 02:03:04', NULL, b'0'),
(4, 'Mì Kim Chi Bò Mỹ Cuộn Nấm Kim Châm', 48, NULL, 'Sợi mì dai dai thấm nhuần hương vị từ nước lẩu kim chi, topping thì vừa mềm vừa thơm, cắn một miếng là quên ngay mọi việc xung quanh luôn nha. Chưa hết đâu, vị chua chua cay cay của nước lẩu lại siêu kích thích vị giác, ăn một miếng liền muốn ăn thêm miếng nữa. Ăn món mới này các bạn sẽ không biết no khi nào đâu nhé.', 'mi-bo-my.jpg', b'0', 1, '2023-07-01 02:03:04', NULL, b'0'),
(5, 'Mì Kim Chi Thập Cẩm', 60, NULL, 'Sợi mì dai dai thấm nhuần hương vị từ nước lẩu kim chi, topping thì vừa mềm vừa thơm, cắn một miếng là quên ngay mọi việc xung quanh luôn nha. Chưa hết đâu, vị chua chua cay cay của nước lẩu lại siêu kích thích vị giác, ăn một miếng liền muốn ăn thêm miếng nữa. Ăn món mới này các bạn sẽ không biết no khi nào đâu nhé.', 'mi-kim-chi-thap-cam.jpg', b'1', 1, '2023-07-01 02:03:04', NULL, b'0'),
(6, 'Mì Kim Chi Bạch Tuộc', 45, NULL, 'Sợi mì dai dai thấm nhuần hương vị từ nước lẩu kim chi, topping thì vừa mềm vừa thơm, cắn một miếng là quên ngay mọi việc xung quanh luôn nha. Chưa hết đâu, vị chua chua cay cay của nước lẩu lại siêu kích thích vị giác, ăn một miếng liền muốn ăn thêm miếng nữa. Ăn món mới này các bạn sẽ không biết no khi nào đâu nhé.', 'mi-kim-chi-bach-tuoc.jpg', b'0', 1, '2023-07-01 02:03:04', NULL, b'0'),
(7, 'Mì Kim Chi Cá Itachi', 39, NULL, 'Sợi mì dai dai thấm nhuần hương vị từ nước lẩu kim chi, topping thì vừa mềm vừa thơm, cắn một miếng là quên ngay mọi việc xung quanh luôn nha. Chưa hết đâu, vị chua chua cay cay của nước lẩu lại siêu kích thích vị giác, ăn một miếng liền muốn ăn thêm miếng nữa. Ăn món mới này các bạn sẽ không biết no khi nào đâu nhé.', 'mi-kim-chi-ca.jpg', b'0', 1, '2023-07-01 02:03:04', NULL, b'0'),
(8, 'Mì Kim Chi Sườn Sụn', 45, NULL, 'Sợi mì dai dai thấm nhuần hương vị từ nước lẩu kim chi, topping thì vừa mềm vừa thơm, cắn một miếng là quên ngay mọi việc xung quanh luôn nha. Chưa hết đâu, vị chua chua cay cay của nước lẩu lại siêu kích thích vị giác, ăn một miếng liền muốn ăn thêm miếng nữa. Ăn món mới này các bạn sẽ không biết no khi nào đâu nhé.', 'mi-kim-chi-suon-sun.jpg', b'0', 1, '2023-07-01 02:03:04', NULL, b'0'),
(9, 'Mì Kim Chi Đùi Gà', 45, NULL, 'Sợi mì dai dai thấm nhuần hương vị từ nước lẩu kim chi, topping thì vừa mềm vừa thơm, cắn một miếng là quên ngay mọi việc xung quanh luôn nha. Chưa hết đâu, vị chua chua cay cay của nước lẩu lại siêu kích thích vị giác, ăn một miếng liền muốn ăn thêm miếng nữa. Ăn món mới này các bạn sẽ không biết no khi nào đâu nhé.', 'mi-kim-chi-dui-ga.jpg', b'0', 1, '2023-07-01 02:03:04', '2024-07-17 18:11:03', b'0'),
(10, 'Mì Kim Chi Tôm Càng', 79, NULL, 'Sợi mì dai dai thấm nhuần hương vị từ nước lẩu kim chi, topping thì vừa mềm vừa thơm, cắn một miếng là quên ngay mọi việc xung quanh luôn nha. Chưa hết đâu, vị chua chua cay cay của nước lẩu lại siêu kích thích vị giác, ăn một miếng liền muốn ăn thêm miếng nữa. Ăn món mới này các bạn sẽ không biết no khi nào đâu nhé.', 'mi-kim-chi-tom-cang.jpg', b'0', 1, '2023-07-01 02:03:04', NULL, b'0'),
(11, 'Mì Lẩu Thái Bò Mỹ Cuộn Nấm', 51, NULL, 'Một nồi lẩu Thái chua chua cay cay thơm nồng bốc khói nghi ngút là sự lựa chọn vô cùng lý tưởng cho đại gia đình quây quần trong những dịp họp mặt cuối năm. Có rất nhiều loại với mức độ cay khác nhau để các bạn có thể chủ động lựa chọn, nên những ai không ăn được cay cũng đừng lo lắng nhé!', 'mi-lau-thai-bo-my-cuon-nam.jpg', b'1', 2, '2023-07-01 02:03:04', NULL, b'0'),
(12, 'Mì Lẩu Thái Hải Sản', 48, NULL, 'Một nồi lẩu Thái chua chua cay cay thơm nồng bốc khói nghi ngút là sự lựa chọn vô cùng lý tưởng cho đại gia đình quây quần trong những dịp họp mặt cuối năm. Có rất nhiều loại với mức độ cay khác nhau để các bạn có thể chủ động lựa chọn, nên những ai không ăn được cay cũng đừng lo lắng nhé!', 'mi-lau-thai-hai-san.jpg', b'0', 2, '2023-07-01 02:03:04', NULL, b'0'),
(13, 'Mì Lẩu Thái Bò', 45, NULL, 'Một nồi lẩu Thái chua chua cay cay thơm nồng bốc khói nghi ngút là sự lựa chọn vô cùng lý tưởng cho đại gia đình quây quần trong những dịp họp mặt cuối năm. Có rất nhiều loại với mức độ cay khác nhau để các bạn có thể chủ động lựa chọn, nên những ai không ăn được cay cũng đừng lo lắng nhé!', 'mi-lau-thai-bo.jpg', b'0', 2, '2023-07-01 02:03:04', '2024-07-17 18:11:21', b'0'),
(14, 'Mì Lẩu Thái Sườn Sụn', 48, NULL, 'Một nồi lẩu Thái chua chua cay cay thơm nồng bốc khói nghi ngút là sự lựa chọn vô cùng lý tưởng cho đại gia đình quây quần trong những dịp họp mặt cuối năm. Có rất nhiều loại với mức độ cay khác nhau để các bạn có thể chủ động lựa chọn, nên những ai không ăn được cay cũng đừng lo lắng nhé!', 'mi-lau-thai-suon-sun.jpg', b'0', 2, '2023-07-01 02:03:04', NULL, b'0'),
(15, 'Mì Lẩu Thái Bạch Tuộc', 49, NULL, 'Một nồi lẩu Thái chua chua cay cay thơm nồng bốc khói nghi ngút là sự lựa chọn vô cùng lý tưởng cho đại gia đình quây quần trong những dịp họp mặt cuối năm. Có rất nhiều loại với mức độ cay khác nhau để các bạn có thể chủ động lựa chọn, nên những ai không ăn được cay cũng đừng lo lắng nhé!', 'mi-lau-thai-bach-tuoc.jpg', b'0', 2, '2023-07-01 02:03:04', NULL, b'0'),
(16, 'Mì Lẩu Thái Đùi Gà', 48, NULL, 'Một nồi lẩu Thái chua chua cay cay thơm nồng bốc khói nghi ngút là sự lựa chọn vô cùng lý tưởng cho đại gia đình quây quần trong những dịp họp mặt cuối năm. Có rất nhiều loại với mức độ cay khác nhau để các bạn có thể chủ động lựa chọn, nên những ai không ăn được cay cũng đừng lo lắng nhé!', 'mi-lau-thai-dui-ga.jpg', b'0', 2, '2023-07-01 03:12:58', NULL, b'0'),
(17, 'Mì Lẩu Thái Thập Cẩm', 60, NULL, 'Một nồi lẩu Thái chua chua cay cay thơm nồng bốc khói nghi ngút là sự lựa chọn vô cùng lý tưởng cho đại gia đình quây quần trong những dịp họp mặt cuối năm. Có rất nhiều loại với mức độ cay khác nhau để các bạn có thể chủ động lựa chọn, nên những ai không ăn được cay cũng đừng lo lắng nhé!', 'mi-lau-thai-thap-cam.jpg', b'1', 2, '2023-07-01 03:12:58', NULL, b'0'),
(18, 'Mì Lẩu Thái Xúc Xích Cá Viên', 38, NULL, 'Một nồi lẩu Thái chua chua cay cay thơm nồng bốc khói nghi ngút là sự lựa chọn vô cùng lý tưởng cho đại gia đình quây quần trong những dịp họp mặt cuối năm. Có rất nhiều loại với mức độ cay khác nhau để các bạn có thể chủ động lựa chọn, nên những ai không ăn được cay cũng đừng lo lắng nhé!', 'mi-lau-thai-xuc-xich-ca-vien.jpg', b'0', 2, '2023-07-01 03:12:58', NULL, b'0'),
(19, 'Mì Lẩu Thái Cá', 42, NULL, 'Một nồi lẩu Thái chua chua cay cay thơm nồng bốc khói nghi ngút là sự lựa chọn vô cùng lý tưởng cho đại gia đình quây quần trong những dịp họp mặt cuối năm. Có rất nhiều loại với mức độ cay khác nhau để các bạn có thể chủ động lựa chọn, nên những ai không ăn được cay cũng đừng lo lắng nhé!', 'mi-lau-thai-ca.jpg', b'0', 2, '2023-07-01 03:12:58', NULL, b'0'),
(20, 'Tokbokki Lắc Phô Mai', 30, NULL, 'Hàn Quốc không chỉ là xứ sở của nhân sâm và kim chi mà còn có vô vàn những món ăn vặt vô cùng hấp dẫn nữa. Nếu yêu thích tìm hiểu những điều mới lạ về ẩm thực, chắc chắn, những món mà  Itachi giới thiệu sẽ khiến bạn vô cùng thích thú. Thử tìm xem món ăn yêu thích của bạn là gì nhé!', 'banh-tokbokki-lac-pho-mai.jpg', b'0', 3, '2023-07-01 03:12:58', NULL, b'0'),
(21, 'Bánh Takoyaki', 39, NULL, 'Hàn Quốc không chỉ là xứ sở của nhân sâm và kim chi mà còn có vô vàn những món ăn vặt vô cùng hấp dẫn nữa. Nếu yêu thích tìm hiểu những điều mới lạ về ẩm thực, chắc chắn, những món mà  Itachi giới thiệu sẽ khiến bạn vô cùng thích thú. Thử tìm xem món ăn yêu thích của bạn là gì nhé!', 'banh-takoyaki.jpg', b'1', 3, '2023-07-01 03:12:58', NULL, b'0'),
(22, 'Tokbokki Bò', 55, NULL, 'Hàn Quốc không chỉ là xứ sở của nhân sâm và kim chi mà còn có vô vàn những món ăn vặt vô cùng hấp dẫn nữa. Nếu yêu thích tìm hiểu những điều mới lạ về ẩm thực, chắc chắn, những món mà  Itachi giới thiệu sẽ khiến bạn vô cùng thích thú. Thử tìm xem món ăn yêu thích của bạn là gì nhé!', 'banh-tokbokki-bo.jpg', b'0', 3, '2023-07-01 03:12:58', NULL, b'0'),
(23, 'Bánh Xếp Hàn Quốc', 30, NULL, 'Hàn Quốc không chỉ là xứ sở của nhân sâm và kim chi mà còn có vô vàn những món ăn vặt vô cùng hấp dẫn nữa. Nếu yêu thích tìm hiểu những điều mới lạ về ẩm thực, chắc chắn, những món mà  Itachi giới thiệu sẽ khiến bạn vô cùng thích thú. Thử tìm xem món ăn yêu thích của bạn là gì nhé!', 'banh-xep-han-quoc.jpg', b'0', 3, '2023-07-01 03:12:58', NULL, b'0'),
(24, 'Tokbokki Itachi', 35, NULL, 'Hàn Quốc không chỉ là xứ sở của nhân sâm và kim chi mà còn có vô vàn những món ăn vặt vô cùng hấp dẫn nữa. Nếu yêu thích tìm hiểu những điều mới lạ về ẩm thực, chắc chắn, những món mà  Itachi giới thiệu sẽ khiến bạn vô cùng thích thú. Thử tìm xem món ăn yêu thích của bạn là gì nhé!', 'banh-tokbokki.jpg', b'1', 3, '2023-07-01 03:12:58', NULL, b'0'),
(25, 'Tokbokki Hải Sản', 55, NULL, 'Hàn Quốc không chỉ là xứ sở của nhân sâm và kim chi mà còn có vô vàn những món ăn vặt vô cùng hấp dẫn nữa. Nếu yêu thích tìm hiểu những điều mới lạ về ẩm thực, chắc chắn, những món mà  Itachi giới thiệu sẽ khiến bạn vô cùng thích thú. Thử tìm xem món ăn yêu thích của bạn là gì nhé!', 'banh-tokbokki-hai-san.jpg', b'0', 3, '2023-07-01 03:12:58', NULL, b'0'),
(26, 'Bánh Kimbap', 35, NULL, 'Hàn Quốc không chỉ là xứ sở của nhân sâm và kim chi mà còn có vô vàn những món ăn vặt vô cùng hấp dẫn nữa. Nếu yêu thích tìm hiểu những điều mới lạ về ẩm thực, chắc chắn, những món mà  Itachi giới thiệu sẽ khiến bạn vô cùng thích thú. Thử tìm xem món ăn yêu thích của bạn là gì nhé!', 'banh-kimbap.jpg', b'0', 3, '2023-07-01 03:12:58', NULL, b'0'),
(27, 'Bibimbap Truyền Thống', 40, NULL, 'Hàn Quốc không chỉ là xứ sở của nhân sâm và kim chi mà còn có vô vàn những món ăn vặt vô cùng hấp dẫn nữa. Nếu yêu thích tìm hiểu những điều mới lạ về ẩm thực, chắc chắn, những món mà  Itachi giới thiệu sẽ khiến bạn vô cùng thích thú. Thử tìm xem món ăn yêu thích của bạn là gì nhé!', 'bibimbap-truyen-thong.jpg', b'0', 3, '2023-07-01 03:12:58', NULL, b'0'),
(28, 'Bánh Kimbap Chiên', 40, NULL, 'Hàn Quốc không chỉ là xứ sở của nhân sâm và kim chi mà còn có vô vàn những món ăn vặt vô cùng hấp dẫn nữa. Nếu yêu thích tìm hiểu những điều mới lạ về ẩm thực, chắc chắn, những món mà  Itachi giới thiệu sẽ khiến bạn vô cùng thích thú. Thử tìm xem món ăn yêu thích của bạn là gì nhé!', 'banh-kimbap-chien.jpg', b'1', 3, '2023-07-01 03:12:58', NULL, b'0'),
(29, 'Bibimbap Bò', 50, NULL, 'Hàn Quốc không chỉ là xứ sở của nhân sâm và kim chi mà còn có vô vàn những món ăn vặt vô cùng hấp dẫn nữa. Nếu yêu thích tìm hiểu những điều mới lạ về ẩm thực, chắc chắn, những món mà  Itachi giới thiệu sẽ khiến bạn vô cùng thích thú. Thử tìm xem món ăn yêu thích của bạn là gì nhé!', 'bibimbap-bo.jpg', b'0', 3, '2023-07-01 03:12:58', NULL, b'0'),
(30, 'Bánh Okonomiyaki', 39, NULL, 'Hàn Quốc không chỉ là xứ sở của nhân sâm và kim chi mà còn có vô vàn những món ăn vặt vô cùng hấp dẫn nữa. Nếu yêu thích tìm hiểu những điều mới lạ về ẩm thực, chắc chắn, những món mà  Itachi giới thiệu sẽ khiến bạn vô cùng thích thú. Thử tìm xem món ăn yêu thích của bạn là gì nhé!', 'banh-okonomiyaki.jpg', b'0', 3, '2023-07-01 03:12:58', NULL, b'0'),
(31, 'Xúc Xích Chiên', 20, NULL, 'Một trong những điều thu hút khách du lịch Hàn Quốc nhất đó chính là các khu phố ẩm thực với các món ăn vặt lạ miệng, thơm ngon nóng hổi. Đến xứ sở kim chi vào một ngày mùa đông, đi dọc theo con đường Seoul sầm uất, thưởng thức tất cả các đồ ăn vặt Hàn Quốc từ món nóng cho đến món lạnh,..\r\n<br>Itachi không giám chắc rằng sẽ hoàn toàn làm thỏa mãn điều mong muốn của các bạn, nhưng chúng tôi tin rằng các món ăn ở Itachi rất ngon và mang hương vị của đất nước Hàn Quốc tươi đẹp. Cùng với không gian được thiết kế theo phong cách Hàn Quốc làm cho bạn như đang hòa mình vào phong cảnh và con người nơi xứ sở kim chi ấy.', 'xuc-xich-chien.jpg', b'0', 4, '2023-07-01 03:30:24', NULL, b'0'),
(32, 'Há Cảo Chiên', 20, NULL, 'Một trong những điều thu hút khách du lịch Hàn Quốc nhất đó chính là các khu phố ẩm thực với các món ăn vặt lạ miệng, thơm ngon nóng hổi. Đến xứ sở kim chi vào một ngày mùa đông, đi dọc theo con đường Seoul sầm uất, thưởng thức tất cả các đồ ăn vặt Hàn Quốc từ món nóng cho đến món lạnh,..\r\n<br>Itachi không giám chắc rằng sẽ hoàn toàn làm thỏa mãn điều mong muốn của các bạn, nhưng chúng tôi tin rằng các món ăn ở Itachi rất ngon và mang hương vị của đất nước Hàn Quốc tươi đẹp. Cùng với không gian được thiết kế theo phong cách Hàn Quốc làm cho bạn như đang hòa mình vào phong cảnh và con người nơi xứ sở kim chi ấy.', 'ha-cao-chien.jpg', b'0', 4, '2023-07-01 03:30:24', NULL, b'0'),
(33, 'Đùi Gà Chiên', 25, NULL, 'Một trong những điều thu hút khách du lịch Hàn Quốc nhất đó chính là các khu phố ẩm thực với các món ăn vặt lạ miệng, thơm ngon nóng hổi. Đến xứ sở kim chi vào một ngày mùa đông, đi dọc theo con đường Seoul sầm uất, thưởng thức tất cả các đồ ăn vặt Hàn Quốc từ món nóng cho đến món lạnh,..\r\n<br>Itachi không giám chắc rằng sẽ hoàn toàn làm thỏa mãn điều mong muốn của các bạn, nhưng chúng tôi tin rằng các món ăn ở Itachi rất ngon và mang hương vị của đất nước Hàn Quốc tươi đẹp. Cùng với không gian được thiết kế theo phong cách Hàn Quốc làm cho bạn như đang hòa mình vào phong cảnh và con người nơi xứ sở kim chi ấy.', 'dui-ga-chien.jpg', b'1', 4, '2023-07-01 03:30:24', NULL, b'0'),
(34, 'Khoai Tây Chiên', 25, NULL, 'Một trong những điều thu hút khách du lịch Hàn Quốc nhất đó chính là các khu phố ẩm thực với các món ăn vặt lạ miệng, thơm ngon nóng hổi. Đến xứ sở kim chi vào một ngày mùa đông, đi dọc theo con đường Seoul sầm uất, thưởng thức tất cả các đồ ăn vặt Hàn Quốc từ món nóng cho đến món lạnh,..\r\n<br>Itachi không giám chắc rằng sẽ hoàn toàn làm thỏa mãn điều mong muốn của các bạn, nhưng chúng tôi tin rằng các món ăn ở Itachi rất ngon và mang hương vị của đất nước Hàn Quốc tươi đẹp. Cùng với không gian được thiết kế theo phong cách Hàn Quốc làm cho bạn như đang hòa mình vào phong cảnh và con người nơi xứ sở kim chi ấy.', 'khoai-tay-chien.jpg', b'0', 4, '2023-07-01 03:30:24', NULL, b'0'),
(35, 'Hồ Lô Chiên', 20, NULL, 'Một trong những điều thu hút khách du lịch Hàn Quốc nhất đó chính là các khu phố ẩm thực với các món ăn vặt lạ miệng, thơm ngon nóng hổi. Đến xứ sở kim chi vào một ngày mùa đông, đi dọc theo con đường Seoul sầm uất, thưởng thức tất cả các đồ ăn vặt Hàn Quốc từ món nóng cho đến món lạnh,..\r\n<br>Itachi không giám chắc rằng sẽ hoàn toàn làm thỏa mãn điều mong muốn của các bạn, nhưng chúng tôi tin rằng các món ăn ở Itachi rất ngon và mang hương vị của đất nước Hàn Quốc tươi đẹp. Cùng với không gian được thiết kế theo phong cách Hàn Quốc làm cho bạn như đang hòa mình vào phong cảnh và con người nơi xứ sở kim chi ấy.', 'ho-lo-chien.jpg', b'0', 4, '2023-07-01 03:30:24', NULL, b'0'),
(36, 'Phô Mai Que Cốm Xanh', 25, NULL, 'Một trong những điều thu hút khách du lịch Hàn Quốc nhất đó chính là các khu phố ẩm thực với các món ăn vặt lạ miệng, thơm ngon nóng hổi. Đến xứ sở kim chi vào một ngày mùa đông, đi dọc theo con đường Seoul sầm uất, thưởng thức tất cả các đồ ăn vặt Hàn Quốc từ món nóng cho đến món lạnh,..\r\n<br>Itachi không giám chắc rằng sẽ hoàn toàn làm thỏa mãn điều mong muốn của các bạn, nhưng chúng tôi tin rằng các món ăn ở Itachi rất ngon và mang hương vị của đất nước Hàn Quốc tươi đẹp. Cùng với không gian được thiết kế theo phong cách Hàn Quốc làm cho bạn như đang hòa mình vào phong cảnh và con người nơi xứ sở kim chi ấy.', 'pho-mai-que-com-xanh.jpg', b'0', 4, '2023-07-01 03:30:24', NULL, b'0'),
(37, 'Chả Giò Rế', 20, NULL, 'Một trong những điều thu hút khách du lịch Hàn Quốc nhất đó chính là các khu phố ẩm thực với các món ăn vặt lạ miệng, thơm ngon nóng hổi. Đến xứ sở kim chi vào một ngày mùa đông, đi dọc theo con đường Seoul sầm uất, thưởng thức tất cả các đồ ăn vặt Hàn Quốc từ món nóng cho đến món lạnh,..\r\n<br>Itachi không giám chắc rằng sẽ hoàn toàn làm thỏa mãn điều mong muốn của các bạn, nhưng chúng tôi tin rằng các món ăn ở Itachi rất ngon và mang hương vị của đất nước Hàn Quốc tươi đẹp. Cùng với không gian được thiết kế theo phong cách Hàn Quốc làm cho bạn như đang hòa mình vào phong cảnh và con người nơi xứ sở kim chi ấy.', 'cha-gio-re.jpg', b'0', 4, '2023-07-01 03:30:24', NULL, b'0'),
(38, 'Phô Mai Que Sữa', 25, NULL, 'Một trong những điều thu hút khách du lịch Hàn Quốc nhất đó chính là các khu phố ẩm thực với các món ăn vặt lạ miệng, thơm ngon nóng hổi. Đến xứ sở kim chi vào một ngày mùa đông, đi dọc theo con đường Seoul sầm uất, thưởng thức tất cả các đồ ăn vặt Hàn Quốc từ món nóng cho đến món lạnh,..\r\n<br>Itachi không giám chắc rằng sẽ hoàn toàn làm thỏa mãn điều mong muốn của các bạn, nhưng chúng tôi tin rằng các món ăn ở Itachi rất ngon và mang hương vị của đất nước Hàn Quốc tươi đẹp. Cùng với không gian được thiết kế theo phong cách Hàn Quốc làm cho bạn như đang hòa mình vào phong cảnh và con người nơi xứ sở kim chi ấy.', 'pho-mai-que-sua.jpg', b'0', 4, '2023-07-01 03:30:24', NULL, b'0'),
(39, 'Bingsu Trái Cây', 45, NULL, 'Bingsu là thuật ngữ chỉ món kem tuyết có xuất xứ từ Hàn Quốc, được tạo nên từ quá trình bào mịn các loại sữa tươi, nước ngọt hay siro trong máy làm kem tuyết rồi phủ lên trên các loại trái cây, kem tươi hay bánh oreo, mứt, thạch với nhiều màu sắc bắt mắt, hấp dẫn cùng hương vị ngọt ngào nhưng mát lạnh, kích thích vị giác và thần kinh.<br>Cũng giống như Hàn Quốc, tại Việt Nam, Bingsu được dùng như một món tráng miệng hay “món ăn chơi” vô cùng ưa chuộng. Hãy đến Itachi để dùng qua và cảm nhận nhé các bạn.', 'bingsu-trai-cay.jpg', b'1', 5, '2023-07-01 03:30:24', NULL, b'0'),
(40, 'Bingsu Đào', 50, NULL, 'Bingsu là thuật ngữ chỉ món kem tuyết có xuất xứ từ Hàn Quốc, được tạo nên từ quá trình bào mịn các loại sữa tươi, nước ngọt hay siro trong máy làm kem tuyết rồi phủ lên trên các loại trái cây, kem tươi hay bánh oreo, mứt, thạch với nhiều màu sắc bắt mắt, hấp dẫn cùng hương vị ngọt ngào nhưng mát lạnh, kích thích vị giác và thần kinh.<br>Cũng giống như Hàn Quốc, tại Việt Nam, Bingsu được dùng như một món tráng miệng hay “món ăn chơi” vô cùng ưa chuộng. Hãy đến Itachi để dùng qua và cảm nhận nhé các bạn.', 'bingsu-dao.jpg', b'0', 5, '2023-07-01 03:30:24', NULL, b'0'),
(41, 'Trà Đào', 22, NULL, 'Nước trà hay còn được gọi nước chè là thức uống phổ biến thứ hai trên thế giới sau cà phê. Trà được làm bằng cách oxy hóa (ủ để lên men), sấy rang, phơi lá, chồi, hay cành của cây trà. Ngoài ra trà còn được thêm vào các thành phần khác từ thảo mộc, hoa, hay trái cây.<br>Mùa hè nóng đổ lửa sẽ không còn làm khó bạn với các loại nước uống mùa hè mát lạnh mà Itachi mang đến cho các bạn.', 'tra-dao.jpg', b'1', 6, '2023-07-01 03:30:24', NULL, b'0'),
(42, 'Trà Trái Cây Nhiệt Đới ', 30, NULL, 'Nước trà hay còn được gọi nước chè là thức uống phổ biến thứ hai trên thế giới sau cà phê. Trà được làm bằng cách oxy hóa (ủ để lên men), sấy rang, phơi lá, chồi, hay cành của cây trà. Ngoài ra trà còn được thêm vào các thành phần khác từ thảo mộc, hoa, hay trái cây.<br>Mùa hè nóng đổ lửa sẽ không còn làm khó bạn với các loại nước uống mùa hè mát lạnh mà Itachi mang đến cho các bạn.', 'tra-trai-cay-nhiet-doi.jpg', b'0', 6, '2023-07-01 03:30:24', NULL, b'0'),
(43, 'Lục Trà Macchiato', 27, NULL, 'Nước trà hay còn được gọi nước chè là thức uống phổ biến thứ hai trên thế giới sau cà phê. Trà được làm bằng cách oxy hóa (ủ để lên men), sấy rang, phơi lá, chồi, hay cành của cây trà. Ngoài ra trà còn được thêm vào các thành phần khác từ thảo mộc, hoa, hay trái cây.<br>Mùa hè nóng đổ lửa sẽ không còn làm khó bạn với các loại nước uống mùa hè mát lạnh mà Itachi mang đến cho các bạn.', 'luc-tra-macchiato.jpg', b'0', 6, '2023-07-01 03:30:24', NULL, b'0'),
(44, 'Trà Sữa Thái', 20, NULL, 'Nước trà hay còn được gọi nước chè là thức uống phổ biến thứ hai trên thế giới sau cà phê. Trà được làm bằng cách oxy hóa (ủ để lên men), sấy rang, phơi lá, chồi, hay cành của cây trà. Ngoài ra trà còn được thêm vào các thành phần khác từ thảo mộc, hoa, hay trái cây.<br>Mùa hè nóng đổ lửa sẽ không còn làm khó bạn với các loại nước uống mùa hè mát lạnh mà Itachi mang đến cho các bạn.', 'tra-sua-thai.jpg', b'0', 6, '2023-07-01 03:30:24', NULL, b'0'),
(45, 'Tra Sữa Itachi', 18, NULL, 'Nước trà hay còn được gọi nước chè là thức uống phổ biến thứ hai trên thế giới sau cà phê. Trà được làm bằng cách oxy hóa (ủ để lên men), sấy rang, phơi lá, chồi, hay cành của cây trà. Ngoài ra trà còn được thêm vào các thành phần khác từ thảo mộc, hoa, hay trái cây.<br>Mùa hè nóng đổ lửa sẽ không còn làm khó bạn với các loại nước uống mùa hè mát lạnh mà Itachi mang đến cho các bạn.', 'tra-sua.jpg', b'1', 6, '2023-07-01 03:30:24', NULL, b'0'),
(47, 'Mì Thêm', 10, NULL, 'Nếu mì cay chưa làm bạn đủ no, ngần ngại chi hãy ẳm ngay 1 gói mì thêm đi kèm đi nào!', 'mi-them.jpg', b'0', 7, '2024-11-03 06:50:17', '2024-11-03 07:00:03', b'0'),
(48, 'Bò', 10, NULL, 'Bò dai ngon góp phần làm món ăn bạn thêm hấp dẫn', 'bo-them.png', b'0', 7, '2024-11-03 06:50:17', '2024-11-03 07:00:03', b'0'),
(49, 'Cá Viên', 5, NULL, 'Cá viên dai ngon góp phần làm món ăn bạn thêm hấp dẫn', 'ca-them.png', b'0', 7, '2024-11-03 06:50:17', '2024-11-03 07:00:03', b'0'),
(50, 'Xúc Xích', 5, NULL, 'Xúc xích dai ngon góp phần làm món ăn bạn thêm hấp dẫn', 'xuc-xich-them.png', b'0', 7, '2024-11-03 06:50:17', '2024-11-03 07:00:03', b'0'),
(51, 'Nấm Kim Châm', 5, NULL, 'Nấm kim châm tươi ngon, giòn ngọt, hòa quyện hoàn hảo trong nước dùng cay nồng, tạo nên hương vị độc đáo cho tô mì cay. Thêm ngay để tăng độ ngon và dinh dưỡng cho món ăn của bạn!', 'nam-them.png', b'0', 7, '2024-11-03 06:50:17', '2024-11-03 07:00:03', b'0'),
(52, 'Kim Chi', 5, NULL, 'Kim chi Hàn Quốc chua cay đậm đà, thấm vị tự nhiên từ cải thảo và gia vị truyền thống. Khi kết hợp trong tô mì cay, kim chi mang đến hương vị đặc trưng, giòn ngon và kích thích vị giác, tạo nên trải nghiệm ẩm thực hoàn hảo!', 'kim-chi-them.png', b'0', 7, '2024-11-03 06:50:17', '2024-11-03 07:00:03', b'0'),
(53, 'Tôm', 5, NULL, 'Tôm tươi ngọt, săn chắc, thấm đều trong nước dùng cay nóng, làm tăng hương vị đậm đà và hấp dẫn cho tô mì cay. Thêm tôm để cảm nhận độ tươi ngon và bổ dưỡng trong từng miếng!', 'tom-them.png', b'0', 7, '2024-11-03 06:50:17', '2024-11-03 07:00:03', b'0'),
(54, 'Mực', 5, NULL, 'Mực tươi giòn sần sật, thấm đẫm vị cay nồng của nước dùng, mang đến hương vị biển cả tươi ngon trong từng miếng. Thêm mực vào tô mì cay để món ăn thêm hấp dẫn và giàu dinh dưỡng!', 'muc-them.png', b'0', 7, '2024-11-03 06:50:17', '2024-11-03 07:00:03', b'0'),
(55, 'Súp', 5, NULL, 'Nước súp đậm đà, cay nồng từ ớt và gia vị đặc trưng, kết hợp hài hòa với vị ngọt tự nhiên từ xương hầm. Từng muỗng nước súp thơm ngon, kích thích vị giác, tạo nên nền tảng hoàn hảo cho tô mì cay đầy hấp dẫn!', 'sup-them.png', b'0', 7, '2024-11-03 06:50:17', '2024-11-03 07:00:03', b'0'),
(56, 'Bông Cải', 5, NULL, 'Bông cải xanh tươi, giòn ngọt tự nhiên, hòa quyện trong nước dùng cay nồng, tạo điểm nhấn thanh mát cho tô mì cay. Thêm bông cải để món ăn thêm hấp dẫn và bổ dưỡng!', 'bong-cai-them.png', b'0', 7, '2024-11-03 06:50:17', '2024-11-03 07:00:03', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `r_id` int(11) NOT NULL,
  `o_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `deleted` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`r_id`, `o_id`, `pro_id`, `username`, `rating`, `comment`, `created_at`, `update_at`, `deleted`) VALUES
(41, 16, 1, 'dvp', 5, 'Mì ngon nước súp đậm đà', '2024-11-03 07:28:17', NULL, b'0'),
(42, 16, 2, 'dvp', 4, 'Hải sản ngon nước dùng đậm đà', '2024-11-03 07:28:17', NULL, b'0'),
(43, 17, 2, 'dvp', 5, 'Nước súp đậm đà hòa nguyện cùng vị hải sản nói chung tuyệt vời', '2024-11-03 07:30:13', NULL, b'0'),
(44, 17, 47, 'dvp', 5, 'Mì dai ngon', '2024-11-03 07:30:13', NULL, b'0'),
(45, 17, 50, 'dvp', 5, 'Xúc xích tươi', '2024-11-03 07:30:13', NULL, b'0'),
(46, 18, 1, 'user', 3, 'Mì ngon nhưng chưa đặc sắc lắm', '2024-11-03 07:32:48', NULL, b'0'),
(47, 18, 48, 'user', 5, 'Bò Tươi', '2024-11-03 07:32:48', NULL, b'0'),
(48, 19, 2, 'user', 5, 'Ngon', '2024-11-03 07:36:39', NULL, b'0'),
(49, 19, 49, 'user', 4, 'Cá viên dai có vẻ nhiều cá hơn bột', '2024-11-03 07:36:39', NULL, b'0');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(10) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `deleted` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `name`, `create_at`, `update_at`, `deleted`) VALUES
(1, 'admin', '2024-10-25 00:00:00', NULL, b'0'),
(2, 'user', '2024-10-25 00:00:00', NULL, b'0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`username`),
  ADD KEY `fk_role_id` (`role_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `fk_accounts` (`username`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`od_id`),
  ADD KEY `fk_orders` (`o_id`),
  ADD KEY `fk_products` (`pro_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pro_id`),
  ADD KEY `fk_categories` (`c_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `c_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `o_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `od_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pro_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `fk_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_accounts` FOREIGN KEY (`username`) REFERENCES `accounts` (`username`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `fk_orders` FOREIGN KEY (`o_id`) REFERENCES `orders` (`o_id`),
  ADD CONSTRAINT `fk_products` FOREIGN KEY (`pro_id`) REFERENCES `products` (`pro_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_categories` FOREIGN KEY (`c_id`) REFERENCES `categories` (`c_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
