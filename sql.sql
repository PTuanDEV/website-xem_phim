CREATE DATABASE IF NOT EXISTS `web_phim`;
--
USE `web_phim`;
-- 
-- Categories
--
CREATE TABLE IF NOT EXISTS `categories` (
  `id_cate` int NOT NULL AUTO_INCREMENT,
  `name_cate` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `create_at` datetime NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_cate`)
) ENGINE=InnoDB AUTO_INCREMENT=236 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
--
INSERT INTO `categories` (`id_cate`, `name_cate`, `create_at`, `status`) VALUES
	(1, 'hành động', '2002-03-20 00:00:00', 1),
	(2, 'kinh dị', '2002-03-21 00:00:00', 1),
	(3, 'trẻ con', '2002-03-22 00:00:00', 1);
-- 
-- User
--
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `img` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `role` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '1',
  `money` double NOT NULL DEFAULT '0',
  `creater` datetime NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
--
INSERT INTO `user` (`id_user`, `fullname`, `email`, `phone`, `username`, `password`, `img`, `role`, `status`, `money`, `creater`) VALUES
	(1, 'Phạm Bá Tuấn', 'tuanpbph30046@fpt.edu.vn', '0352532002', 'admin123', '$2y$10$kQ1yfdP9EgeESkFNz3gA5.4F7ki/MlBAQ2pL9g7tXB3Q/OfUGiydC', 'logo.png', 1, 1, 121212121, '2023-11-18 00:00:00'),
	(2, 'Phạm Bá Tuấn Anh', 'tuan@gmail.com', '0352532002', 'tuan', '$2y$10$LmPjuSDUZ3bU1f0GTdxCfO8VfVonDXN9rJ7b470DSNXQuFUp/J8Tm', 'logo.png', 0, 1, 120000, '2023-11-18 00:00:00'),
	(3, 'Nguyễn Văn A', 'tuanpbph30046@fpt.edu.vn', '0352532002', 'nguoidung', '$2y$10$NXeso3wt4OsFuKW0ei7ATe39LBmFk2H0gKiDg2rV0WSxEQ5O0rgAa', 'logo.png', 2, 1, 0, '2023-11-19 00:00:00');
--
-- Movie
--
CREATE TABLE IF NOT EXISTS `movie` (
  `id_movie` int NOT NULL AUTO_INCREMENT,
  `name_movie` varchar(100) NOT NULL,
  `name_trailer` varchar(200) NOT NULL,
  `name_video` varchar(200) NOT NULL,
  `img` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `performer` text NOT NULL COMMENT 'diễn viên',
  `rearelease_year` int NOT NULL COMMENT 'năm phát hành',
  `time` int NOT NULL,
  `country` varchar(50) NOT NULL COMMENT 'quốc gia',
  `creater_at` datetime NOT NULL,
  `date_play` datetime NOT NULL,
  `describe` text NOT NULL COMMENT 'mô tả',
  `viewer` int NOT NULL DEFAULT '0' COMMENT 'lượt xem',
  `status` int NOT NULL DEFAULT '1',
  `id_cate` int NOT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id_movie`),
  KEY `id_cate` (`id_cate`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `FK_movie_categories` FOREIGN KEY (`id_cate`) REFERENCES `categories` (`id_cate`),
  CONSTRAINT `FK_movie_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
--
INSERT INTO `movie` ( `name_movie`, `name_trailer`, `name_video`, `img`, `performer`, `rearelease_year`, `time`, `country`, `creater_at`, `date_play`, `describe`, `viewer`, `status`, `id_cate`, `id_user`) VALUES
	('Phim Hành động 1', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 1', 1, 1, 'vn', '2023-11-01 00:00:00', '2023-11-02 00:00:00', 'Mô tả 1', 0, 2, 1, 2),
	('Phim Hành động 2', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 2', 2, 2, 'vn', '2023-11-02 00:00:00', '2023-11-03 00:00:00', 'Mô tả 2', 0, 2, 1, 2),
	('Phim Hành động 3', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 3', 3, 3, 'vn', '2023-11-03 00:00:00', '2023-11-04 00:00:00', 'Mô tả 3', 0, 2, 1, 2),
	('Phim Hành động 4', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 4', 4, 4, 'vn', '2023-11-04 00:00:00', '2023-11-05 00:00:00', 'Mô tả 4', 0, 2, 1, 2),
	('Phim Hành động 5', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 5', 5, 5, 'vn', '2023-11-05 00:00:00', '2023-11-06 00:00:00', 'Mô tả 5', 0, 2, 1, 2),
	('Phim Hành động 6', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 6', 6, 6, 'vn', '2023-11-06 00:00:00', '2023-11-07 00:00:00', 'Mô tả 6', 0, 2, 1, 2),
	('Phim Hành động 7', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 7', 7, 7, 'vn', '2023-11-07 00:00:00', '2023-11-08 00:00:00', 'Mô tả 7', 0, 2, 1, 2),
	('Phim Hành động 8', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 8', 8, 8, 'vn', '2023-11-08 00:00:00', '2023-11-09 00:00:00', 'Mô tả 8', 0, 2, 1, 2),
	('Phim Hành động 9', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 9', 9, 8, 'vn', '2023-11-09 00:00:00', '2023-11-10 00:00:00', 'Mô tả 9', 0, 2, 1, 2),
	('Phim Hành động 10', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 10', 10, 10, 'vn', '2023-11-10 00:00:00', '2023-11-11 00:00:00', 'Mô tả 10', 0, 2, 1, 2),
	('Phim Hành động 11', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 11', 11, 11, 'vn', '2023-11-11 00:00:00', '2023-11-12 00:00:00', 'Mô tả 11', 0, 2, 1, 2),
	('Phim Hành động 12', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 12', 12, 12, 'vn', '2023-11-12 00:00:00', '2023-11-13 00:00:00', 'Mô tả 12', 0, 2, 1, 2),
	('Phim Hành động 13', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 13', 13, 13, 'vn', '2023-11-13 00:00:00', '2023-11-14 00:00:00', 'Mô tả 13', 0, 2, 1, 2),
	('Phim Hành động 14', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 14', 14, 14, 'vn', '2023-11-14 00:00:00', '2023-11-15 00:00:00', 'Mô tả 14', 0, 2, 1, 2),
	('Phim Hành động 15', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 15', 15, 15, 'vn', '2023-11-15 00:00:00', '2023-11-16 00:00:00', 'Mô tả 15', 0, 2, 1, 2),
	('Phim Hành động 16', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 16', 16, 16, 'vn', '2023-11-16 00:02:02', '2023-11-17 00:00:00', 'Mô tả 16', 0, 0, 1, 2),
	('Phim Hành động 17', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 17', 17, 17, 'vn', '2023-11-17 00:00:00', '2023-11-18 00:00:00', 'Mô tả 17', 5, 2, 1, 2),
	('Phim Hành động 18', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 18', 18, 18, 'vn', '2023-11-18 00:00:00', '2023-11-19 00:00:00', 'Mô tả 18', 0, 3, 1, 2),
	('Phim Hành động 19', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 19', 19, 19, 'vn', '2023-11-19 00:00:00', '2023-11-20 00:00:00', 'Mô tả 19', 0, 3, 1, 2),
	('Phim Hành động 20', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 20', 20, 20, 'vn', '2023-11-20 00:00:00', '2023-11-21 00:00:00', 'Mô tả 20', 0, 2, 1, 2),
	('Phim kinh dị 1', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 1', 1, 1, 'vn', '2023-11-01 00:00:00', '2023-11-02 00:00:00', 'Mô tả 1', 1, 2, 2, 3),
	('Phim kinh dị 2', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 2', 2, 2, 'vn', '2023-11-02 00:00:00', '2023-11-03 00:00:00', 'Mô tả 2', 1, 2, 2, 3),
	('Phim kinh dị 3', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 3', 3, 3, 'vn', '2023-11-03 00:00:00', '2023-11-04 00:00:00', 'Mô tả 3', 1, 2, 2, 3),
	('Phim kinh dị 4', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 4', 4, 4, 'vn', '2023-11-04 00:00:00', '2023-11-05 00:00:00', 'Mô tả 4', 1, 2, 2, 3),
	('Phim kinh dị 5', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 5', 5, 5, 'vn', '2023-11-05 00:00:00', '2023-11-06 00:00:00', 'Mô tả 5', 1, 2, 2, 3),
	('Phim kinh dị 6', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 6', 6, 6, 'vn', '2023-11-06 00:00:00', '2023-11-07 00:00:00', 'Mô tả 6', 1, 2, 2, 3),
	('Phim kinh dị 7', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 7', 7, 7, 'vn', '2023-11-07 00:00:00', '2023-11-08 00:00:00', 'Mô tả 7', 1, 2, 2, 3),
	('Phim kinh dị 8', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 8', 8, 8, 'vn', '2023-11-08 00:00:00', '2023-11-09 00:00:00', 'Mô tả 8', 1, 2, 2, 3),
	('Phim kinh dị 9', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 9', 9, 8, 'vn', '2023-11-09 00:00:00', '2023-11-10 00:00:00', 'Mô tả 9', 1, 2, 2, 3),
	('Phim kinh dị 10', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 10', 10, 10, 'vn', '2023-11-10 00:00:00', '2023-11-11 00:00:00', 'Mô tả 10', 1, 2, 2, 1),
	('Phim kinh dị 11', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 11', 11, 11, 'vn', '2023-11-11 00:00:00', '2023-11-12 00:00:00', 'Mô tả 11', 1, 2, 2, 1),
	('Phim kinh dị 12', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 12', 12, 12, 'vn', '2023-11-12 00:00:00', '2023-11-13 00:00:00', 'Mô tả 12', 1, 2, 2, 1),
	('Phim kinh dị 13', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 13', 13, 13, 'vn', '2023-11-13 00:00:00', '2023-11-14 00:00:00', 'Mô tả 13', 1, 2, 2, 1),
	('Phim kinh dị 14', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 14', 14, 14, 'vn', '2023-11-14 00:00:00', '2023-11-15 00:00:00', 'Mô tả 14', 1, 2, 2, 1),
	('Phim kinh dị 15', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 15', 15, 15, 'vn', '2023-11-15 00:00:00', '2023-11-16 00:00:00', 'Mô tả 15', 1, 2, 2, 1),
	('Phim kinh dị 16', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 16', 16, 16, 'vn', '2023-11-16 00:00:00', '2023-11-17 00:00:00', 'Mô tả 16', 1, 2, 2, 1),
	('Phim kinh dị 17', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 17', 17, 17, 'vn', '2023-11-17 00:00:00', '2023-11-18 00:00:00', 'Mô tả 17', 1, 2, 2, 1),
	('Phim kinh dị 18', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 18', 18, 18, 'vn', '2023-11-18 00:00:00', '2023-11-19 00:00:00', 'Mô tả 18', 1, 2, 2, 1),
	('Phim kinh dị 19', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 19', 19, 19, 'vn', '2023-11-19 00:00:00', '2023-11-20 00:00:00', 'Mô tả 19', 1, 2, 2, 1),
	('Phim kinh dị 20', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 20', 20, 20, 'vn', '2023-11-20 00:00:00', '2023-11-21 00:00:00', 'Mô tả 20', 1, 3, 2, 1),
	('Phim trẻ con 1', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 1', 1, 1, 'vn', '2023-11-01 00:00:00', '2023-11-02 00:00:00', 'Mô tả 1', 2, 2, 3, 2),
	('Phim trẻ con 2', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 2', 2, 2, 'vn', '2023-11-02 00:00:00', '2023-11-03 00:00:00', 'Mô tả 2', 2, 2, 3, 2),
	('Phim trẻ con 3', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 3', 3, 3, 'vn', '2023-11-03 00:00:00', '2023-11-04 00:00:00', 'Mô tả 3', 2, 2, 3, 2),
	('Phim trẻ con 4', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 4', 4, 4, 'vn', '2023-11-04 00:00:00', '2023-11-05 00:00:00', 'Mô tả 4', 2, 2, 3, 2),
	('Phim trẻ con 5', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 5', 5, 5, 'vn', '2023-11-05 00:00:00', '2023-11-06 00:00:00', 'Mô tả 5', 2, 2, 3, 2),
	('Phim trẻ con 6', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 6', 6, 6, 'vn', '2023-11-06 00:00:00', '2023-11-07 00:00:00', 'Mô tả 6', 2, 2, 3, 2),
	('Phim trẻ con 7', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 7', 7, 7, 'vn', '2023-11-07 00:00:00', '2023-11-08 00:00:00', 'Mô tả 7', 2, 2, 3, 2),
	('Phim trẻ con 8', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 8', 8, 8, 'vn', '2023-11-08 00:00:00', '2023-11-09 00:00:00', 'Mô tả 8', 2, 2, 3, 2),
	('Phim trẻ con 9', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 9', 9, 8, 'vn', '2023-11-09 00:00:00', '2023-11-10 00:00:00', 'Mô tả 9', 2, 2, 3, 2),
	('Phim trẻ con 10', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 10', 10, 10, 'vn', '2023-11-10 00:00:00', '2023-11-11 00:00:00', 'Mô tả 10', 2, 2, 3, 2),
	('Phim trẻ con 11', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 11', 11, 11, 'vn', '2023-11-11 00:00:00', '2023-11-12 00:00:00', 'Mô tả 11', 2, 2, 3, 2),
	('Phim trẻ con 12', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 12', 12, 12, 'vn', '2023-11-12 00:00:00', '2023-11-13 00:00:00', 'Mô tả 12', 2, 2, 3, 2),
	('Phim trẻ con 13', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 13', 13, 13, 'vn', '2023-11-13 00:00:00', '2023-11-14 00:00:00', 'Mô tả 13', 2, 2, 3, 2),
	('Phim trẻ con 14', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 14', 14, 14, 'vn', '2023-11-14 00:00:00', '2023-11-15 00:00:00', 'Mô tả 14', 2, 2, 3, 3),
	('Phim trẻ con 15', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 15', 15, 15, 'vn', '2023-11-15 00:00:00', '2023-11-16 00:00:00', 'Mô tả 15', 2, 2, 3, 2),
	('Phim trẻ con 16', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 16', 16, 16, 'vn', '2023-11-16 00:00:00', '2023-11-17 00:00:00', 'Mô tả 16', 2, 2, 3, 3),
	('Phim trẻ con 17', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 17', 17, 17, 'vn', '2023-11-17 00:00:00', '2023-11-18 00:00:00', 'Mô tả 17', 2, 2, 3, 3),
	('Phim trẻ con 18', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 18', 18, 18, 'vn', '2023-11-18 00:00:00', '2023-11-19 00:00:00', 'Mô tả 18', 2, 3, 3, 3),
	('Phim trẻ con 19', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 19', 19, 19, 'vn', '2023-11-19 00:00:00', '2023-11-20 00:00:00', 'Mô tả 19', 2, 1, 3, 3),
	('Phim trẻ con 20', 'https://drive.google.com/file/d/1oLkoDyb6ZoTh7irRB2jwAfXh4WpKmdDE/preview', 'https://drive.google.com/file/d/17UnPCVV-WHBqHjF8CBWSbCcD_Er59FiV/preview', 'logo.png', 'Diễn viên 20', 20, 20, 'vn', '2023-11-20 00:00:00', '2023-11-21 00:00:00', 'Mô tả 20', 2, 2, 3, 1);
--
-- List_bill
--
CREATE TABLE IF NOT EXISTS `list_bill` (
  `id_list_bill` int NOT NULL AUTO_INCREMENT,
  `name_member` varchar(200) NOT NULL,
  `pricing_plan` double NOT NULL DEFAULT '0',
  `create_at` datetime NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_list_bill`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
--
INSERT INTO `list_bill` (`id_list_bill`, `name_member`, `pricing_plan`, `create_at`, `status`) VALUES
	(1, 'Hội viên thường', 120000, '2023-11-26 02:39:01', 1),
	(2, 'Hội viên bt', 1300, '2023-11-30 00:18:33', 1);
--
-- Bill
--
CREATE TABLE IF NOT EXISTS `bill` (
  `id_bill` int NOT NULL AUTO_INCREMENT,
  `date_buy` datetime NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `id_user` int NOT NULL,
  `id_list_bill` int NOT NULL,
  PRIMARY KEY (`id_bill`),
  KEY `FK__list_bill` (`id_list_bill`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `FK__list_bill` FOREIGN KEY (`id_list_bill`) REFERENCES `list_bill` (`id_list_bill`),
  CONSTRAINT `FK_bill_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
--
INSERT INTO `bill` (`id_bill`, `date_buy`, `price`, `id_user`, `id_list_bill`) VALUES
	(1, '2023-11-26 15:37:07', 10000, 1, 1),
	(2, '2023-11-29 03:23:48', 0, 1, 1),
	(3, '2023-11-28 01:12:09', 0, 1, 1),
	(18, '2023-11-29 23:22:11', 120000, 2, 1);
--
-- History
--
CREATE TABLE IF NOT EXISTS `history` (
  `id_his` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_movie` int NOT NULL,
  `date_see` datetime NOT NULL,
  PRIMARY KEY (`id_his`),
  KEY `id_user` (`id_user`),
  KEY `id_movie` (`id_movie`),
  CONSTRAINT `FK__movie` FOREIGN KEY (`id_movie`) REFERENCES `movie` (`id_movie`),
  CONSTRAINT `FK__user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Comment
--
CREATE TABLE IF NOT EXISTS `comment` (
  `id_com` int NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `create_at` datetime NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `id_user` int NOT NULL,
  `id_movie` int NOT NULL,
  PRIMARY KEY (`id_com`),
  KEY `FK_comment_user` (`id_user`),
  KEY `id_movie` (`id_movie`),
  CONSTRAINT `FK_comment_movie` FOREIGN KEY (`id_movie`) REFERENCES `movie` (`id_movie`),
  CONSTRAINT `FK_comment_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vnpay
--
CREATE TABLE IF NOT EXISTS `vnpay` (
  `id_pay` int NOT NULL AUTO_INCREMENT,
  `vnp_Amount` varchar(250) NOT NULL COMMENT 'Giá tiền',
  `vnp_BankCode` varchar(250) NOT NULL COMMENT 'Ngân hàng chuyển',
  `vnp_BankTranNo` varchar(250) NOT NULL COMMENT 'Mã của ngân hàng',
  `vnp_CardType` varchar(250) NOT NULL COMMENT 'Loại',
  `vnp_OrderInfo` text NOT NULL COMMENT 'Nội dung ck',
  `vnp_PayDate` datetime NOT NULL COMMENT 'Ngày thanh toán',
  `vnp_TmnCode` varchar(250) NOT NULL COMMENT 'Mã bảo mật',
  `vnp_TransactionNo` varchar(250) NOT NULL,
  `vnp_TxnRef` varchar(250) NOT NULL,
  `vnp_SecureHash` text NOT NULL,
  `id_user` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_pay`),
  KEY `FK_vnpay_user` (`id_user`),
  CONSTRAINT `FK_vnpay_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
--
INSERT INTO `vnpay` (`id_pay`, `vnp_Amount`, `vnp_BankCode`, `vnp_BankTranNo`, `vnp_CardType`, `vnp_OrderInfo`, `vnp_PayDate`, `vnp_TmnCode`, `vnp_TransactionNo`, `vnp_TxnRef`, `vnp_SecureHash`, `id_user`) VALUES
	(1, '12000000', 'NCB', 'VNP14209617', 'ATM', 'Nộp tiền vào tài khoản', '2023-11-29 21:13:44', '5N23P3P2', '14209617', '498', 'e5e89336cf3f1dcfd1f1908da3fdc65a618605a44b48b430842db9c35aabf58c36c4bdff8fbe1566014c8f77a8951709bd5749b58db5214707ae974270c5b159', 2),
	(2, '12000000', 'NCB', 'VNP14209961', 'ATM', 'Nộp tiền vào tài khoản', '2023-11-29 23:20:34', '5N23P3P2', '14209961', '3518', 'eb101a5714536b55324caa5c66ef5d2c8cb9230a1265137f0e87f7ea097383332c4ff9c00f28ff715132a51141dffb111456a562ed5e4a6f75b3c94b2a2aa1e5', 2),
	(3, '12000000', 'NCB', 'VNP14211350', 'ATM', 'Nộp tiền vào tài khoản', '2023-11-30 14:20:17', '5N23P3P2', '14211350', '3809', '0f550a34426cd318560631987f429948fa536defb7553312dc1bc6efd4785e6cf9ddcf1c9b06521cbca92a0a544e35388b5452bc1b1bfae0a7ac28875aefbf10', 2);
