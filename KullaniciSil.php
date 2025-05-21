<?php
session_start();
include 'db.php';

// Sadece admine izin ver
if (!isset($_SESSION['KullaniciID']) || !isset($_SESSION['KullaniciTip'])) {
    header("Location: kayit_html.php?error=Yetkisiz erişim!");
    exit;
}


$admin_email = '';
if ($_SESSION['KullaniciTip'] === 'musteri') {
    $stmt = $baglanti->prepare("SELECT Eposta FROM musteriler WHERE MusteriID = ?");
    $stmt->bind_param("i", $_SESSION['KullaniciID']);
    $stmt->execute();
    $stmt->bind_result($admin_email);
    $stmt->fetch();
    $stmt->close();
} elseif ($_SESSION['KullaniciTip'] === 'zanaatkar') {
    $stmt = $baglanti->prepare("SELECT Eposta FROM zanaatkarlar WHERE ZanaatkarID = ?");
    $stmt->bind_param("i", $_SESSION['KullaniciID']);
    $stmt->execute();
    $stmt->bind_result($admin_email);
    $stmt->fetch();
    $stmt->close();
}

if ($admin_email !== 'ekinaliadmin@gmail.com') {
    header("Location: kayit_html.php?error=Yetkisiz erişim!");
    exit;
}

// Kullanıcı silme işlemi
$type = $_GET['type'] ?? '';
$id = intval($_GET['id'] ?? 0);

if ($type === 'musteri') {
    $stmt = $baglanti->prepare("DELETE FROM musteriler WHERE MusteriID=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
} elseif ($type === 'zanaatkar') {
    $stmt = $baglanti->prepare("DELETE FROM zanaatkarlar WHERE ZanaatkarID=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

header("Location: admin.php?success=Kullanıcı silindi!");
exit;
?>