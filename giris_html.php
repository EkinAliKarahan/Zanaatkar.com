<?php
$error = $_GET['error'] ?? '';
$success = $_GET['success'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kullanıcı Girişi</title>
</head>
<body>
    
    <?php if ($error): ?>
        <div style="color:red;"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
  <div style="color:green;"><?php echo htmlspecialchars($success); ?></div>
<?php endif; ?>
</body>
</html>