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

$usta_id = isset($_GET['id']) ? intval($_GET['id']) : 1;
$query = $conn->prepare("SELECT Gun FROM bosgunler WHERE ZanaatkarID = ? ORDER BY Gun ASC");
$query->bind_param("i", $usta_id);
$query->execute();
$result = $query->get_result();

$tarihler = [];
while ($row = $result->fetch_assoc()) {
    // Tarih formatını "19 May" olarak göstermek için PHP'de değiştiriyoruz
    $dateObj = new DateTime($row['Gun']);
    $tarihler[] = $dateObj->format('j M');
}

echo json_encode($tarihler);

$query->close();
$conn->close();
?>
