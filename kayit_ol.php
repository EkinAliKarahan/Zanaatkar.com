<?php
include 'db.php';

// Formdan gelen veriler
$ad = trim($_POST["Ad"] ?? "");
$soyad = trim($_POST["Soyad"] ?? "");
$email = trim($_POST["Eposta"] ?? "");
$sifre = trim($_POST["Sifre"] ?? "");
$telefon = trim($_POST["Telefon"] ?? "");
$kullanici_tip = trim($_POST["KullaniciTip"] ?? "");

// Eksik alan kontrolü
if (empty($ad) || empty($soyad) || empty($email) || empty($sifre) || empty($kullanici_tip) || ($kullanici_tip === "zanaatkar" && empty($telefon))) {
    header("Location: kayit_html.php?error=Eksik alan bırakmayınız!");
    exit;
}

// Hangi tablo?
if ($kullanici_tip === 'musteri') {
    $tablo = 'musteriler';
    $id_kolon = 'MusteriID';
} elseif ($kullanici_tip === 'zanaatkar') {
    $tablo = 'zanaatkarlar';
    $id_kolon = 'ZanaatkarID';
} else {
    header("Location: kayit_html.php?error=Geçersiz kullanıcı türü!");
    exit;
}

// E-posta daha önce kayıtlı mı kontrolü
$kontrol = $baglanti->prepare("SELECT $id_kolon FROM $tablo WHERE Eposta = ?");
$kontrol->bind_param("s", $email);
$kontrol->execute();
$kontrol->store_result();

if ($kontrol->num_rows > 0) {
    $kontrol->close();
    header("Location: kayit_html.php?error=Bu e-posta ile zaten kayıt olunmuş!");
    exit;
}
$kontrol->close();

// Şifreyi hashle
$sifre_hash = password_hash($sifre, PASSWORD_DEFAULT);

// Kayıt ekle
if ($kullanici_tip === 'musteri') {
    $stmt = $baglanti->prepare("INSERT INTO musteriler (Ad, Soyad, Eposta, Sifre) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $ad, $soyad, $email, $sifre_hash);
} else { // zanaatkar
    $stmt = $baglanti->prepare("INSERT INTO zanaatkarlar (Ad, Soyad, Eposta, Sifre, Telefon) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $ad, $soyad, $email, $sifre_hash, $telefon);
}

if ($stmt->execute()) {
    $stmt->close();
    header("Location: kayit_html.php?success=Kayıt başarılı!");
    exit;
} else {
    $stmt->close();
    header("Location: kayit_html.php?error=Kayıt sırasında hata oluştu!");
    exit;
}
?>