<?php
$error = $_GET['error'] ?? '';
$success = $_GET['success'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap / Kayıt Ol</title>
    <link rel="stylesheet" href="giris.css">
    <script src="giris.js" defer></script>
</head>
<body>
    <?php if ($error): ?>
  <div style="color:red;"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>
<?php if ($success): ?>
  <div style="color:green;"><?php echo htmlspecialchars($success); ?></div>
<?php endif; ?>
    <div class="header">
        <img src="logo.jpg" alt="Logo">
        <h1>Zanaatkar</h1>
        
    </div>

    <div class="nav">
        <ul>
            <li><a href="anasayfa.php">Anasayfa</a></li>
            <li><a href="hakkımızda.php">Hakkımızda</a></li>
            <li><a href="#">Yardım</a></li>
        </ul>
    </div>

    <div class="container">
        <div class="form-switch">
            <button id="show-login" class="active">Giriş Yap</button>
            <button id="show-register">Kayıt Ol</button>
        </div>

        <?php if ($error): ?>
        <div style="color:red;"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
  <div style="color:green;"><?php echo htmlspecialchars($success); ?></div>
<?php endif; ?>
<div class="form active" id="login-form">
        <h3>Giriş Yap</h3>
        <form action="giris.php" method="POST">
    <label for="login-email">E-posta:</label>
    <input type="email" id="login-email" name="Eposta" placeholder="E-posta adresinizi giriniz" required>
    
    <label for="login-password">Şifre:</label>
    <input type="password" id="login-password" name="Sifre" placeholder="Şifrenizi giriniz" required>
    
    <input type="submit" value="Giriş Yap">
</form>
    </div>


        <div class="form" id="register-form">
            <h3>Kayıt Ol</h3>
            <form action="kayit_ol.php" method="POST">
    <label>Ad:</label>
    <input type="text" name="Ad" required><br>
    <label>Soyad:</label>
    <input type="text" name="Soyad" required><br>
    <label>E-posta:</label>
    <input type="email" name="Eposta" required><br>
    <label>Şifre:</label>
    <input type="password" name="Sifre" required><br>
    <label>Telefon:</label>
    <input type="text" name="Telefon"><br>
    <label>Kullanıcı Tipi:</label>
    <select name="KullaniciTip" required>
        <option value="musteri">Müşteri</option>
        <option value="zanaatkar">Zanaatkar</option>
    </select><br>
    <input type="submit" value="Kayıt Ol">
</form>
        </div>
    
        
    </div>
</body>
</html>
