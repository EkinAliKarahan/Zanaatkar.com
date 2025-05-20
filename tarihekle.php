<?php
// Veritabanı bağlantısını kur
$host = "localhost:3308";
$dbname = "zanaatkar";
$username = "root"; // kendi kullanıcı adınızı girin
$password = "";         // kendi şifrenizi girin

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
} catch (PDOException $e) {
    die("Veritabanı bağlantı hatası: " . $e->getMessage());
}

// Formdan gelen veriyi al
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $gun = $_POST['Gun'] ?? null;
$zanaatkarID = isset($_GET['id']) ? intval($_GET['id']) : 1;

    if ($gun) {
        // Aynı tarih zaten var mı diye kontrol et
        $kontrol = $pdo->prepare("SELECT COUNT(*) FROM bosgunler WHERE ZanaatkarID = ? AND Gun = ?");
        $kontrol->execute([$zanaatkarID, $gun]);
        $varMi = $kontrol->fetchColumn();

        if ($varMi == 0) {
            // Tarihi ekle
            $stmt = $pdo->prepare("INSERT INTO bosgunler (ZanaatkarID, Gun) VALUES (?, ?)");
            $stmt->execute([$zanaatkarID, $gun]);
            echo "<script>alert('Tarih başarıyla eklendi.'); window.history.back();</script>";
        } else {
            echo "<script>alert('Bu tarih zaten eklenmiş.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Geçerli bir tarih giriniz.'); window.history.back();</script>";
    }
} else {
    echo "Geçersiz istek.";
}
?>
