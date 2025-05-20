<?php
session_start();
session_unset();   // Tüm oturum değişkenlerini sil
session_destroy(); // Oturumu tamamen yok et
header("Location: kayit_html.php"); // Giriş ekranına yönlendir
exit;
?>