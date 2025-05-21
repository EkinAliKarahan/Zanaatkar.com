<?php
session_start();
include 'db.php';


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


$musteriler = [];
$result = $baglanti->query("SELECT MusteriID, Ad, Soyad, Eposta FROM musteriler");
while ($row = $result->fetch_assoc()) {
    $musteriler[] = $row;
}


$zanaatkarlar = [];
$result = $baglanti->query("SELECT ZanaatkarID, Ad, Soyad, Eposta, Telefon FROM zanaatkarlar");
while ($row = $result->fetch_assoc()) {
    $zanaatkarlar[] = $row;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Admin Paneli - Kullanıcı Yönetimi</title>
    <link rel="stylesheet" href="giris.css">
    <style>
        .admin-table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px 0;
        }
        .admin-table th, .admin-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        .admin-table th {
            background-color: orange;
            color: white;
        }
        .delete-btn {
            background-color: #c0392b;
            color: white;
            padding: 5px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .delete-btn:hover {
            background-color: #e74c3c;
        }
        .container {
            max-width: 1000px;
        }
    </style>
    <script>
        function confirmDelete(userType, userId, userName) {
            if (confirm(userName + " adlı kullanıcı silinsin mi?")) {
                window.location.href = "delete_user.php?type=" + encodeURIComponent(userType) + "&id=" + encodeURIComponent(userId);
            }
        }
    </script>
</head>
<body>
    <div class="header">
        <img src="logo.jpg" alt="Logo">
        <h1>Zanaatkar Admin</h1>
        <a href="cikis.php"><h2>Çıkış Yap</h2></a>
    </div>
    <div class="nav">
        <ul>
            <li><a href="anasayfa.php">Anasayfa</a></li>
            <li><a href="admin.php">Admin Paneli</a></li>
        </ul>
    </div>
    <div class="container">
        <h2>Müşteriler</h2>
        <table class="admin-table">
            <tr>
                <th>ID</th>
                <th>Ad</th>
                <th>Soyad</th>
                <th>Eposta</th>
                <th>Sil</th>
            </tr>
            <?php foreach ($musteriler as $m): ?>
            <tr>
                <td><?= htmlspecialchars($m['MusteriID']) ?></td>
                <td><?= htmlspecialchars($m['Ad']) ?></td>
                <td><?= htmlspecialchars($m['Soyad']) ?></td>
                <td><?= htmlspecialchars($m['Eposta']) ?></td>
                <td>
                    <button class="delete-btn" onclick="confirmDelete('musteri', '<?= $m['MusteriID'] ?>', '<?= htmlspecialchars($m['Ad'].' '.$m['Soyad']) ?>')">Sil</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <h2>Zanaatkarlar</h2>
        <table class="admin-table">
            <tr>
                <th>ID</th>
                <th>Ad</th>
                <th>Soyad</th>
                <th>Eposta</th>
                <th>Telefon</th>
                <th>Sil</th>
            </tr>
            <?php foreach ($zanaatkarlar as $z): ?>
            <tr>
                <td><?= htmlspecialchars($z['ZanaatkarID']) ?></td>
                <td><?= htmlspecialchars($z['Ad']) ?></td>
                <td><?= htmlspecialchars($z['Soyad']) ?></td>
                <td><?= htmlspecialchars($z['Eposta']) ?></td>
                <td><?= htmlspecialchars($z['Telefon']) ?></td>
                <td>
                    <button class="delete-btn" onclick="confirmDelete('zanaatkar', '<?= $z['ZanaatkarID'] ?>', '<?= htmlspecialchars($z['Ad'].' '.$z['Soyad']) ?>')">Sil</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>