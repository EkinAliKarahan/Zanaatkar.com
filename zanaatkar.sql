-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3308
-- Üretim Zamanı: 18 May 2025, 16:25:38
-- Sunucu sürümü: 9.1.0
-- PHP Sürümü: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `zanaatkar`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bosgunler`
--

DROP TABLE IF EXISTS `bosgunler`;
CREATE TABLE IF NOT EXISTS `bosgunler` (
  `GunID` int NOT NULL AUTO_INCREMENT,
  `ZanaatkarID` int NOT NULL,
  `Gun` date NOT NULL,
  PRIMARY KEY (`GunID`),
  KEY `ZanaatkarID` (`ZanaatkarID`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `bosgunler`
--

INSERT INTO `bosgunler` (`GunID`, `ZanaatkarID`, `Gun`) VALUES
(1, 1, '2025-05-19'),
(2, 1, '2025-05-22'),
(3, 2, '2025-05-20'),
(4, 2, '2025-05-24'),
(5, 2, '2025-05-25'),
(6, 3, '2025-05-21'),
(7, 4, '2025-05-19'),
(8, 4, '2025-05-23'),
(9, 5, '2025-05-22'),
(10, 5, '2025-05-24'),
(11, 6, '2025-05-20'),
(12, 7, '2025-05-25'),
(13, 7, '2025-05-21'),
(14, 8, '2025-05-23'),
(15, 9, '2025-05-22'),
(16, 9, '2025-05-19'),
(17, 10, '2025-05-24'),
(18, 11, '2025-05-20'),
(19, 11, '2025-05-23'),
(20, 12, '2025-05-25');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `gecmisisler`
--

DROP TABLE IF EXISTS `gecmisisler`;
CREATE TABLE IF NOT EXISTS `gecmisisler` (
  `IsID` int NOT NULL AUTO_INCREMENT,
  `MusteriID` int NOT NULL,
  `ZanaatkarID` int NOT NULL,
  `BaslangicTarihi` date NOT NULL,
  `BitisTarihi` date NOT NULL,
  `IsTuru` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`IsID`),
  KEY `MusteriID` (`MusteriID`),
  KEY `ZanaatkarID` (`ZanaatkarID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `gecmisisler`
--

INSERT INTO `gecmisisler` (`IsID`, `MusteriID`, `ZanaatkarID`, `BaslangicTarihi`, `BitisTarihi`, `IsTuru`) VALUES
(1, 1, 3, '2023-01-10', '2023-01-20', 'Ahşap Mobilya Tamiri'),
(2, 2, 5, '2023-02-15', '2023-02-25', 'El Yapımı Seramik Üretimi'),
(3, 3, 2, '2023-03-05', '2023-03-15', 'Deri Cüzdan Dikimi'),
(4, 4, 8, '2023-04-01', '2023-04-10', 'Özel Tasarım Takı'),
(5, 5, 1, '2023-05-10', '2023-05-20', 'Metal İşlemeciliği'),
(6, 6, 6, '2023-06-05', '2023-06-12', 'Yenileme ve Restorasyon'),
(7, 7, 7, '2023-07-15', '2023-07-25', 'El Örgüsü Tekstil'),
(8, 8, 4, '2023-08-10', '2023-08-18', 'El Yapımı Seramik Üretimi'),
(9, 9, 9, '2023-09-01', '2023-09-10', 'Ahşap Oymacılık'),
(10, 10, 12, '2023-10-05', '2023-10-15', 'Deriden Çanta Tasarımı'),
(11, 11, 11, '2023-11-12', '2023-11-22', 'Özel Takı Tasarımı'),
(12, 12, 10, '2023-12-01', '2023-12-10', 'Mobilya Yenileme');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `musteriler`
--

DROP TABLE IF EXISTS `musteriler`;
CREATE TABLE IF NOT EXISTS `musteriler` (
  `MusteriID` int NOT NULL AUTO_INCREMENT,
  `Ad` varchar(50) NOT NULL,
  `Soyad` varchar(50) NOT NULL,
  `Eposta` varchar(100) NOT NULL,
  `Sifre` varchar(255) NOT NULL,
  `Telefon` varchar(20) NOT NULL,
  PRIMARY KEY (`MusteriID`),
  UNIQUE KEY `Eposta` (`Eposta`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `musteriler`
--

INSERT INTO `musteriler` (`MusteriID`, `Ad`, `Soyad`, `Eposta`, `Sifre`, `Telefon`) VALUES
(1, 'Kemal', 'Özdemir', 'kemal.ozdemir@example.com', 'kemal123', '05001112233'),
(2, 'Buse', 'Kılıç', 'buse.kilic@example.com', 'buse2024', '05331112233'),
(3, 'Serkan', 'Acar', 'serkan.acar@example.com', 'acar321', '05551112233'),
(4, 'Gizem', 'Yavuz', 'gizem.yavuz@example.com', 'gyavuz', '05221112233'),
(5, 'Cem', 'Türkmen', 'cem.turkmen@example.com', 'cturkmen', '05091112233'),
(6, 'Seda', 'Güler', 'seda.guler@example.com', 'seda_987', '05411112233'),
(7, 'Onur', 'Başar', 'onur.basar@example.com', 'onurpass', '05611112233'),
(8, 'Eda', 'Aslan', 'eda.aslan@example.com', 'aslan456', '05361112233'),
(9, 'Volkan', 'Ergin', 'volkan.ergin@example.com', 'verg2024', '05381112233'),
(10, 'Yasemin', 'Çetin', 'yasemin.cetin@example.com', 'yasemin789', '05491112233'),
(11, 'Mert', 'Ay', 'mert.ay@example.com', 'mertay', '05121112233'),
(12, 'Elvan', 'Bozkurt', 'elvan.bozkurt@example.com', 'elvan123', '05321112233');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `randevulanangunler`
--

DROP TABLE IF EXISTS `randevulanangunler`;
CREATE TABLE IF NOT EXISTS `randevulanangunler` (
  `RandevulananGunID` int NOT NULL AUTO_INCREMENT,
  `ZanaatkarID` int NOT NULL,
  `MusteriID` int NOT NULL,
  `Gun` date NOT NULL,
  PRIMARY KEY (`RandevulananGunID`),
  KEY `ZanaatkarID` (`ZanaatkarID`),
  KEY `MusteriID` (`MusteriID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `randevulanangunler`
--

INSERT INTO `randevulanangunler` (`RandevulananGunID`, `ZanaatkarID`, `MusteriID`, `Gun`) VALUES
(1, 1, 3, '2025-05-26'),
(2, 2, 5, '2025-05-27'),
(3, 3, 7, '2025-05-28'),
(4, 4, 1, '2025-05-29'),
(5, 5, 9, '2025-05-30'),
(6, 6, 11, '2025-06-01'),
(7, 7, 4, '2025-06-02'),
(8, 8, 6, '2025-06-03'),
(9, 9, 8, '2025-06-04'),
(10, 10, 2, '2025-06-05'),
(11, 11, 12, '2025-06-06'),
(12, 12, 10, '2025-06-07');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumlar`
--

DROP TABLE IF EXISTS `yorumlar`;
CREATE TABLE IF NOT EXISTS `yorumlar` (
  `YorumID` int NOT NULL AUTO_INCREMENT,
  `ZanaatkarID` int NOT NULL,
  `MusteriID` int NOT NULL,
  `Mesaj` text NOT NULL,
  `Puan` int NOT NULL,
  PRIMARY KEY (`YorumID`),
  KEY `ZanaatkarID` (`ZanaatkarID`),
  KEY `MusteriID` (`MusteriID`)
) ;

--
-- Tablo döküm verisi `yorumlar`
--

INSERT INTO `yorumlar` (`YorumID`, `ZanaatkarID`, `MusteriID`, `Mesaj`, `Puan`) VALUES
(1, 1, 3, 'Çok kaliteli iş çıkardı, kesinlikle tavsiye ederim.', 9),
(2, 2, 5, 'Hızlı teslimat ve çok güzel ürünler.', 8),
(3, 3, 7, 'Deneyimli ve güvenilir bir zanaatkâr.', 10),
(4, 4, 1, 'İletişimi iyiydi fakat teslimatta küçük gecikme oldu.', 7),
(5, 5, 9, 'Ürün tam istediğim gibi, çok memnun kaldım.', 9),
(6, 6, 11, 'Çalışmaları çok titiz ve profesyonel.', 10),
(7, 7, 4, 'Kalite standartlarının üzerinde bir işçilik.', 9),
(8, 8, 6, 'Fiyat performans dengesi çok iyi.', 8),
(9, 9, 8, 'Müşteri ilgisi biraz daha iyi olabilirdi.', 6),
(10, 10, 2, 'Siparişim zamanında ve eksiksiz geldi.', 9),
(11, 11, 12, 'Yaratıcı ve özgün tasarımlar sunuyor.', 10),
(12, 12, 10, 'Beklentilerimin çok üstünde çıktı, teşekkürler.', 10);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `zanaatkarlar`
--

DROP TABLE IF EXISTS `zanaatkarlar`;
CREATE TABLE IF NOT EXISTS `zanaatkarlar` (
  `ZanaatkarID` int NOT NULL AUTO_INCREMENT,
  `Isim` varchar(50) NOT NULL,
  `Soyisim` varchar(50) NOT NULL,
  `Eposta` varchar(100) NOT NULL,
  `Sifre` varchar(255) NOT NULL,
  `Yas` int NOT NULL,
  `DeneyimYili` int NOT NULL,
  `Telefon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Sehir` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Ilce` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Semt` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `meslek` varchar(50) NOT NULL,
  PRIMARY KEY (`ZanaatkarID`),
  UNIQUE KEY `Eposta` (`Eposta`)
) ;

--
-- Tablo döküm verisi `zanaatkarlar`
--

INSERT INTO `zanaatkarlar` (`ZanaatkarID`, `Isim`, `Soyisim`, `Eposta`, `Sifre`, `Yas`, `DeneyimYili`, `Telefon`, `Sehir`, `Ilce`, `Semt`, `meslek`) VALUES
(1, 'Ahmet', 'Yılmaz', 'ahmet.yilmaz@example.com', '123456', 35, 10, '05321234567', 'İstanbul', 'Kadıköy', 'Moda', 'Marangoz'),
(2, 'Ayşe', 'Demir', 'ayse.demir@example.com', 'abcdef', 28, 5, '05431234567', 'Ankara', 'Çankaya', 'Bahçelievler', 'Elektrikçi'),
(3, 'Mehmet', 'Kaya', 'mehmet.kaya@example.com', 'qwerty', 42, 18, '05551234567', 'İzmir', 'Konak', 'Alsancak', 'Tesisatçı'),
(4, 'Elif', 'Çelik', 'elif.celik@example.com', 'sifre123', 31, 7, '05361234567', 'Bursa', 'Nilüfer', 'Görükle', 'Boyacı'),
(5, 'Mustafa', 'Arslan', 'mustafa.arslan@example.com', 'pass2024', 39, 15, '05001234567', 'Antalya', 'Muratpaşa', 'Lara', 'Mermerci'),
(6, 'Zeynep', 'Aydın', 'zeynep.aydin@example.com', 'zey123', 26, 4, '05311234567', 'Eskişehir', 'Tepebaşı', 'Yenibağlar', 'Camcı'),
(7, 'Fatma', 'Koç', 'fatma.koc@example.com', 'kocpass', 33, 9, '05221234567', 'Konya', 'Selçuklu', 'Bosna Hersek', 'Kaynakçı'),
(8, 'Ali', 'Şahin', 'ali.sahin@example.com', 'ali2024', 45, 20, '05661234567', 'Gaziantep', 'Şahinbey', 'Karataş', 'Sıvacı'),
(9, 'Hülya', 'Öztürk', 'hulya.ozturk@example.com', 'ozturk123', 29, 6, '05491234567', 'Adana', 'Seyhan', 'Reşatbey', 'Mobilyacı'),
(10, 'Emre', 'Kurt', 'emre.kurt@example.com', 'ekurt456', 37, 12, '05351234567', 'Mersin', 'Yenişehir', 'Pozcu', 'Alçı Ustası'),
(11, 'Melike', 'Yıldız', 'melike.yildiz@example.com', 'mel2024', 30, 8, '05381234567', 'Trabzon', 'Ortahisar', 'Kalkınma', 'Kaportacı'),
(12, 'Burak', 'Ersoy', 'burak.ersoy@example.com', 'ers456', 41, 17, '05371234567', 'Samsun', 'Atakum', 'Denizevleri', 'Seramikçi');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
