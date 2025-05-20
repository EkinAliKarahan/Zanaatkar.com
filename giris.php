<?php
include 'db.php';

$email = trim($_POST["Eposta"] ?? "");
$sifre = trim($_POST["Sifre"] ?? "");

if (empty($email) || empty($sifre)) {
    header("Location: kayit_html.php?error=E-posta ve şifre boş olamaz!");
    exit;
}

function dogrula_ve_giris($satir, $kullanici_tip, $email, $sifre, $baglanti) {
    $id = $satir[0];
    $veritabani_sifre = $satir[1];

    $is_valid = false;
    // Şifre hashli ise veya doğru şifre düz ise kontrol
    if (password_verify($sifre, $veritabani_sifre)) {
        $is_valid = true;
    } elseif ($sifre === $veritabani_sifre) {
        $is_valid = true;
        // Hangi tablo ve id sütunu?
        if ($kullanici_tip === 'musteri') {
            $table = 'musteriler';
            $id_col = 'MusteriID';
        } else {
            $table = 'zanaatkarlar';
            $id_col = 'ZanaatkarID';
        }
        // Düz şifreyi hashleyip güncelle
        $sifre_hash = password_hash($sifre, PASSWORD_DEFAULT);
        $update = $baglanti->prepare("UPDATE $table SET Sifre=? WHERE $id_col=?");
        $update->bind_param("si", $sifre_hash, $id);
        $update->execute();
    }

    if ($is_valid) {
        session_start();
        $_SESSION['KullaniciID'] = $id;
        $_SESSION['KullaniciTip'] = $kullanici_tip;

        // Giriş kaydını ekle
        $simdi = date("Y-m-d H:i:s");
        $log_stmt = $baglanti->prepare("INSERT INTO girisler (MusteriID, KullaniciTip, GirisZamani) VALUES (?, ?, ?)");
        $log_stmt->bind_param("iss", $id, $kullanici_tip, $simdi);
        $log_stmt->execute();

        header("Location: anasayfa.php?success=Giriş başarılı!");
        exit;
    } else {
        header("Location: kayit_html.php?error=Şifre yanlış!");
        exit;
    }
}

// Önce musteriler tablosunda kontrol et
$stmt = $baglanti->prepare("SELECT MusteriID, Sifre FROM musteriler WHERE Eposta = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
if ($satir = $result->fetch_row()) {
    dogrula_ve_giris($satir, 'musteri', $email, $sifre, $baglanti);
}

// Eğer müşteri bulunamazsa zanaatkarlar tablosunda dene
$stmt = $baglanti->prepare("SELECT ZanaatkarID, Sifre FROM zanaatkarlar WHERE Eposta = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
if ($satir = $result->fetch_row()) {
    dogrula_ve_giris($satir, 'zanaatkar', $email, $sifre, $baglanti);
}

// Hiçbiri bulunamazsa:
header("Location: kayit_html.php?error=Kullanıcı bulunamadı!");
exit;
?>