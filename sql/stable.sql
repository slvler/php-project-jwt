-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 01 Mar 2021, 12:18:35
-- Sunucu sürümü: 10.4.11-MariaDB
-- PHP Sürümü: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `stable`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `item_text` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `user_id` int(2) NOT NULL,
  `item_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `item_text`, `user_id`, `item_status`) VALUES
(3, 'de2', 'text1', 12, 1),
(4, 'text1', 'den1', 12, 1),
(5, 't', 'a', 12, 12),
(8, '12', '12', 12, 12),
(9, 'deneme', 'deneem', 1, 1313),
(13, '12', '12', 12, 12),
(14, 'deneme', 'deneem', 1, 1313),
(15, 'de2', 'text1', 12, 1),
(16, 'text1', 'den1', 12, 1),
(17, 't', 'a', 12, 12),
(18, '12', '12', 12, 12),
(19, 'deneme', 'deneem', 1, 1313),
(20, 'de2', 'text1', 12, 1),
(21, 'text1', 'den1', 12, 1),
(22, 't', 'a', 12, 12),
(23, '12', '12', 12, 12),
(24, 'deneme', 'deneem', 1, 1313);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `login`
--

CREATE TABLE `login` (
  `login_id` int(11) NOT NULL,
  `login_email` varchar(225) COLLATE utf8_turkish_ci NOT NULL,
  `login_pass` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `login_apikey` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `login_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `login`
--

INSERT INTO `login` (`login_id`, `login_email`, `login_pass`, `login_apikey`, `login_status`) VALUES
(1, 'deneme@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '12', 1),
(10, 'tamamdır@gmail', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '998', 1);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Tablo için indeksler `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Tablo için AUTO_INCREMENT değeri `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
