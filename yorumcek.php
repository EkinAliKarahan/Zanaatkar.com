<?php
header('Content-Type: application/json');
$baglanti = new mysqli("localhost:3308", "root", "", "zanaatkar");
if ($baglanti->connect_error) {
    echo json_encode(["hata" => "Veritabanına bağlanılamadı"]);
    exit;
}

$ustaid = isset($_GET['id']) ? intval($_GET['id']) : 1;

$sorgu = $baglanti->prepare("
    SELECT m.Ad,m.Soyad, y.Mesaj, y.Puan 
    FROM yorumlar y
    JOIN musteriler m ON y.MusteriID = m.MusteriID
    WHERE y.ZanaatkarID = ?
    ORDER BY y.YorumID DESC
");
$sorgu->bind_param("i", $ustaid);
$sorgu->execute();
$sonuc = $sorgu->get_result();

$yorumlar = [];
while ($satir = $sonuc->fetch_assoc()) {
    $yorumlar[] = $satir;
}

echo json_encode($yorumlar);
?>
