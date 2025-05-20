
<?php
session_start();
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

include 'db.php';

if (!isset($_SESSION['KullaniciID']) || !isset($_SESSION['KullaniciTip'])) {
    header("Location: giris_html.php?error=Giriş yapmalısınız!");
    exit;
}

$kullanici_id = $_SESSION['KullaniciID'];
$kullanici_tip = $_SESSION['KullaniciTip'];

// Bilgiler ve randevular
if ($kullanici_tip === 'musteri') {
    // Müşteri bilgileri
    $stmt = $baglanti->prepare("SELECT Ad, Soyad, Eposta, Telefon FROM musteriler WHERE MusteriID = ?");
    $stmt->bind_param("i", $kullanici_id);
    $stmt->execute();
    $stmt->bind_result($ad, $soyad, $eposta, $telefon);
    $stmt->fetch();
    $stmt->close();

    // Müşteri randevuları
    $randevu_stmt = $baglanti->prepare(
        "SELECT r.Gun, z.Ad, z.Soyad, z.Telefon
         FROM randevulanangunler r
         JOIN zanaatkarlar z ON r.ZanaatkarID = z.ZanaatkarID
         WHERE r.MusteriID = ?
         ORDER BY r.Gun"
    );
    $randevu_stmt->bind_param("i", $kullanici_id);
    $randevu_stmt->execute();
    $randevu_stmt->store_result();
    $randevular = [];
    if ($randevu_stmt->num_rows > 0) {
        $randevu_stmt->bind_result($gun, $zad, $zsoyad, $ztel);
        while ($randevu_stmt->fetch()) {
            $randevular[] = [
                'Gun' => $gun,
                'UstaAd' => $zad,
                'UstaSoyad' => $zsoyad,
                'UstaTelefon' => $ztel
            ];
        }
    }
    $randevu_stmt->close();

} elseif ($kullanici_tip === 'zanaatkar') {
    // Zanaatkar bilgileri
    $stmt = $baglanti->prepare("SELECT Ad, Soyad, Eposta, Yas, DeneyimYili, Telefon, Sehir, Ilce, Semt, meslek FROM zanaatkarlar WHERE ZanaatkarID = ?");
    $stmt->bind_param("i", $kullanici_id);
    $stmt->execute();
    $stmt->bind_result($zad, $zsoyad, $zeposta, $zyas, $zdeneyim, $ztel, $zsehir, $zilce, $zsemt, $zmeslek);
    $stmt->fetch();
    $stmt->close();

    // Zanaatkar randevuları
    $randevu_stmt = $baglanti->prepare(
        "SELECT r.Gun, m.Ad, m.Soyad, m.Telefon
         FROM randevulanangunler r
         JOIN musteriler m ON r.MusteriID = m.MusteriID
         WHERE r.ZanaatkarID = ?
         ORDER BY r.Gun"
    );
    $randevu_stmt->bind_param("i", $kullanici_id);
    $randevu_stmt->execute();
    $randevu_stmt->store_result();
    $randevular = [];
    if ($randevu_stmt->num_rows > 0) {
        $randevu_stmt->bind_result($gun, $mad, $msoyad, $mtel);
        while ($randevu_stmt->fetch()) {
            $randevular[] = [
                'Gun' => $gun,
                'MusteriAd' => $mad,
                'MusteriSoyad' => $msoyad,
                'MusteriTelefon' => $mtel
            ];
        }
    }
    $randevu_stmt->close();
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f7f7f7; padding: 40px; }
        .header {
            background-color: orange;
            height: 80px;
            display: flex;
            align-items: center;
            padding: 0 20px;
            color: white;
            position: fixed;
            width: 100%;
            top: 0;
            justify-content: space-between;
            z-index: 1;
        }
        .header h1 {
            font-size: 40px;
            margin: 30px;
        }
        .header h2{
            margin-right: 80px;
            background-color: #333;
            text-decoration: none;
            color: white;
            padding: 5px;
            border-radius: 5px;
            cursor: pointer;
        }
        .header a{
            text-decoration: none;
        }
        .header img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
        .nav {
            background-color: rgb(43, 43, 43);
            display: flex;
            justify-content: center;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            height: 40px;
            top: 80px;
            z-index: 1;
        }
        .nav ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }
        .nav ul li {
            margin: 0 15px;
            margin-top: 9px;
        }
        .nav ul li a {
            text-decoration: none;
            color: white;
            font-size: 20px;
            transition: color 0.3s;
        }
        .nav ul li a:hover {
            color: orange;
        }
        .profil-container {
            background: #fff;
            padding: 30px 40px;
            margin: auto;
            max-width: 500px;
            border-radius: 10px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.07);
            margin-top: 150px;
        }
        h2, h3 { color: #0d6efd; }
        .profil-info p { margin: 6px 0; }
        .randevu-listesi {
            background: #f4f4fc;
            padding: 15px;
            margin: 15px 0 0 0;
            border-radius: 6px;
        }
        .randevu-listesi ul { margin: 0; padding-left: 20px; }
        .logout-btn {
            margin-top: 24px;
            display: inline-block;
            padding: 8px 18px;
            background: #dc3545;
            color: #fff;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.2s;
        }
        .logout-btn:hover {
            background: #b02a37;
        }
    </style>
</head>
<body>
<div class="header">
    <img src="logo.jpg" alt="Logo">
    <h1>Zanaatkar</h1>
    <?php if (isset($_SESSION["KullaniciID"])): ?>
        <a href="profil.php"><h2>Profil</h2></a>
    <?php else: ?>
        <a href="kayit_html.php"><h2>Giriş Yap</h2></a>
    <?php endif; ?>
</div>
<div class="nav">
    <ul>
        <li><a href="anasayfa.php">Anasayfa</a></li>
        <li><a href="hakkımızda.php">Hakkımızda</a></li>
        <li><a href="#">Yardım</a></li>
    </ul>
</div>
<div class="profil-container">

<?php if ($kullanici_tip === 'musteri'): ?>
    <h2>Müşteri Profili</h2>
    <div class='profil-info'>
        <p><strong>Ad:</strong> <?= htmlspecialchars($ad) ?></p>
        <p><strong>Soyad:</strong> <?= htmlspecialchars($soyad) ?></p>
        <p><strong>E-posta:</strong> <?= htmlspecialchars($eposta) ?></p>
        <p><strong>Telefon:</strong> <?= htmlspecialchars($telefon) ?></p>
    </div>
    <h3>Mevcut Randevularım</h3>
    <div class='randevu-listesi'>
        <?php if (!empty($randevular)): ?>
            <ul>
            <?php foreach ($randevular as $r): ?>
                <li>
                    <b>Tarih:</b> <?= htmlspecialchars($r['Gun']) ?>,
                    <b>Usta:</b> <?= htmlspecialchars($r['UstaAd']) ?> <?= htmlspecialchars($r['UstaSoyad']) ?> (<b>Tel:</b> <?= htmlspecialchars($r['UstaTelefon']) ?>)
                </li>
            <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Mevcut randevunuz yok.</p>
        <?php endif; ?>
    </div>
<?php elseif ($kullanici_tip === 'zanaatkar'): ?>
    <h2>Zanaatkar Profili</h2>
    <div class='profil-info'>
        <p><strong>Ad:</strong> <?= htmlspecialchars($zad) ?></p>
        <p><strong>Soyad:</strong> <?= htmlspecialchars($zsoyad) ?></p>
        <p><strong>E-posta:</strong> <?= htmlspecialchars($zeposta) ?></p>
        <p><strong>Telefon:</strong> <?= htmlspecialchars($ztel) ?></p>
        <p><strong>Yaş:</strong> <?= htmlspecialchars($zyas) ?></p>
        <p><strong>Deneyim Yılı:</strong> <?= htmlspecialchars($zdeneyim) ?></p>
        <p><strong>Meslek:</strong> <?= htmlspecialchars($zmeslek) ?></p>
        <p><strong>Şehir:</strong> <?= htmlspecialchars($zsehir) ?></p>
        <p><strong>İlçe:</strong> <?= htmlspecialchars($zilce) ?></p>
        <p><strong>Semt:</strong> <?= htmlspecialchars($zsemt) ?></p>
    </div>
    <h3>Mevcut Randevular</h3>
    <div class='randevu-listesi'>
        <?php if (!empty($randevular)): ?>
            <ul>
            <?php foreach ($randevular as $r): ?>
                <li>
                    <b>Tarih:</b> <?= htmlspecialchars($r['Gun']) ?>,
                    <b>Müşteri:</b> <?= htmlspecialchars($r['MusteriAd']) ?> <?= htmlspecialchars($r['MusteriSoyad']) ?> (<b>Tel:</b> <?= htmlspecialchars($r['MusteriTelefon']) ?>)
                </li>
            <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Mevcut randevu yok.</p>
        <?php endif; ?>
    </div>
<?php endif; ?>
    <a href="cikis.php" class="logout-btn">Çıkış Yap</a>
</div>
</body>
</html>