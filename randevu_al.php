<?php
session_start();
include 'db.php';

if (!isset($_SESSION['KullaniciID']) || $_SESSION['KullaniciTip'] !== 'musteri') {
    header("Location: giris_html.php?error=Giriş yapmalısınız!");
    exit;
}

$musteri_id = $_SESSION['KullaniciID'];
$zanaatkar_id = $_POST['ZanaatkarID'];
$gun = $_POST['Gun'];

$stmt = $baglanti->prepare("INSERT INTO randevulanangunler (ZanaatkarID, MusteriID, Gun) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $zanaatkar_id, $musteri_id, $gun);
$stmt->execute();
$stmt->close();

$zanaatkar_id = $_POST['ZanaatkarID'];
$musteri_id = $_SESSION['KullaniciID'];
$gun = $_POST['Gun']; // örnek

$stmt = $baglanti->prepare("INSERT INTO randevulanangunler (ZanaatkarID, MusteriID, Gun) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $zanaatkar_id, $musteri_id, $gun);
$stmt->execute();
$stmt->close();

header("Location: profil.php?basari=randevu");
exit;

?>
