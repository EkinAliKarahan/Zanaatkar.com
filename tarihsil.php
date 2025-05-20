<?php
header('Content-Type: application/json');
$host = "localhost:3308";
$db = "zanaatkar";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);
$conn->set_charset("utf8");
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Veritabanı bağlantı hatası"]);
    exit;
}

$tarih = isset($_POST['tarih']) ? $_POST['tarih'] : null;
$usta_id = isset($_GET['id']) ? intval($_GET['id']) : 1;

if (!$tarih) {
    http_response_code(400);
    echo json_encode(["error" => "Tarih gönderilmedi"]);
    exit;
}

if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $tarih)) {
    http_response_code(400);
    echo json_encode(["error" => "Tarih formatı hatalı"]);
    exit;
}

// Silme işlemi
$stmtDelete = $conn->prepare("DELETE FROM bosgunler WHERE ZanaatkarID = ? AND Gun = ?");
$stmtDelete->bind_param("is", $usta_id, $tarih);

// Ekleme işlemi
// Burada MusteriID'yi sabit 1 verdin, istersen değiştir
$musteri_id = 1;
$stmtInsert = $conn->prepare("INSERT INTO randevulanangunler (ZanaatkarID, MusteriID, Gun) VALUES (?, ?, ?)");
$stmtInsert->bind_param("iis", $usta_id, $musteri_id, $tarih);

if ($stmtDelete->execute()) {
    if ($stmtInsert->execute()) {
        echo json_encode(["success" => true, "message" => "Tarih silindi ve randevulanangunler tablosuna eklendi"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Randevulanangunler tablosuna ekleme başarısız"]);
    }
} else {
    http_response_code(500);
    echo json_encode(["error" => "Silme işlemi başarısız"]);
}

$stmtDelete->close();
$stmtInsert->close();
$conn->close();
?>
