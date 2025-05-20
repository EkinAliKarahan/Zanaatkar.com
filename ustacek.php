<?php
header('Content-Type: application/json');

$servername = "localhost:3308";
$username = "root";
$password = "";
$dbname = "zanaatkar";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'error' => 'Bağlantı hatası']);
    exit;
}

$ustaID = isset($_GET['id']) ? intval($_GET['id']) : 1;

$sql = "SELECT * FROM zanaatkarlar WHERE ZanaatkarID = $ustaID";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $usta = $result->fetch_assoc();
    echo json_encode(['success' => true, 'usta' => $usta]);
} else {
    echo json_encode(['success' => false, 'error' => 'Usta bulunamadı']);
}

$conn->close();
?>
