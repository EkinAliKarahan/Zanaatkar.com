<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hizmet Sayfası</title>
    
    <style>
        
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            
        }

        
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
        
        .ara {
            text-align: center; 
            
        }

        .ara input {
            width: 50%;
            padding: 15px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 100px;
            margin-bottom: 150px;
        }

        .ara button {
            padding: 15px 30px;
            font-size: 16px;
            background-color: orange;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
            transition: background-color 0.3s;
        }

        .ara button:hover {
            background-color: darkorange;
        }

        .detay{
            text-align: center;
           transform: scale(0.8);
            
            
        }
        .detay2{
            margin-left: 450px;
            height: 600px;
            margin: 0;
            padding: 0;
            margin-top: 250px;
            margin-bottom: 250px;
            
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

        
        .container {
            margin-top: 140px;
            padding: 20px;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            
        }

        .content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .menu {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            transition: transform 0.3s;
            width: auto;
            height: 400px;
        }

        .menu:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .menu img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .menu h2 {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }

        .teklifbutton p {
            background-color: orange;
            color: white;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .teklifbutton p:hover {
            background-color: darkorange;
        }

        .h1 {
            float: none;
            margin: 20px auto;
            padding: 20px;
            font-size: 18px;
            line-height: 1.6;
            text-align: center;
        }

        .h1 span {
            display: block;
            font-size: 30px;
        }

       
        
        .footer {
            background-color: rgb(43, 43, 43);
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
            font-size: 14px;
            
            
        }

        .footer a {
            color: orange;
            text-decoration: none;
            margin: 0 5px;
        }

        .footer a:hover {
            text-decoration: underline;
        }
        .content  a {
            text-decoration: none;
        }
        
    </style>
</head>
<body>
    

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
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
         
    <div>
       
              <div style="text-align: center; margin-top: 200px;">
                <h1 style="font-size: 70px;">Usta İşler, Hızlı Çözümler</h1>
                <h1 style="font-size: 40px;">Hayatınızı Kolaylaştıracak Hizmetler Parmaklarınızın Ucunda!</h1>
                
             </div>
             <form class="ara" style="margin-top: 100px; margin-bottom: 100px;"> 
                <input type="search" id="query" name="a" placeholder="Hangi hizmeti arıyorsunuz?">
                <button type="submit" style="height: 60px; background-color: orange;">Ara</button>
           </form>
           
             </div> 
            <div class="detay">
              
              <img src="large-group-professionals_53876-22745.jpg.avif" alt="Zanaatkar" style="width: 80%;">
            </div>
       
   
    <div class="container">
        <div class="content">
            
            <div class="menu">
                <h2>MERMERCİ</h2>
                <img src="mermerci.jpg" alt="Mermerci">
                <h4>İlan Sayısı: 1238</h4>
                <h4>Puan:4,8(435 Değerlendirme)</h4>
                <div class="teklifbutton">
                    <a href="zanaatkarliste.php"><p>TEKLİF AL</p></a>
                </div>
            </div>

            <div class="menu">
                <h2>MARANGOZ</h2>
                <img src="marangoz.jpg" alt="Marangoz">
                <h4>İlan Sayısı: 1238</h4>
                <h4>Puan:4,8(435 Değerlendirme)</h4>
                <div class="teklifbutton">
                    <a href="zanaatkarliste.php"><p>TEKLİF AL</p></a>
                </div>
            </div>

            <div class="menu">
                <h2>ELEKTRİKÇİ</h2>
                <img src="elektrikçi.avif" alt="Elektrikçi">
                <h4>İlan Sayısı: 1238</h4>
                <h4>Puan:4,8(435 Değerlendirme)</h4>
                <div class="teklifbutton">
                    <a href="zanaatkarliste.php"><p>TEKLİF AL</p></a>
                </div>
            </div>

            <div class="menu">
                <h2>BOYACI</h2>
                <img src="boyacı.jpg" alt="Boyacı">
                <h4>İlan Sayısı: 1238</h4>
                <h4>Puan:4,8(435 Değerlendirme)</h4>
                <div class="teklifbutton">
                    <a href="zanaatkarliste.php"><p>TEKLİF AL</p></a>
                </div>
            </div>

            <div class="menu">
                <h2>TESİSATÇI</h2>
                <img src="tesisatci.jpg" alt="Tesisatçı">
                <h4>İlan Sayısı: 1238</h4>
                <h4>Puan:4,8(435 Değerlendirme)</h4>
                <div class="teklifbutton">
                    <a href="zanaatkarliste.php"><p>TEKLİF AL</p></a>
                </div>
            </div>

            <div class="menu">
                <h2>KUAFÖR</h2>
                <img src="kuafor.jpg" alt="Kuaför">
                <h4>İlan Sayısı: 1238</h4>
                <h4>Puan:4,8(435 Değerlendirme)</h4>
                <div class="teklifbutton">
                    <a href="zanaatkarliste.php"><p>TEKLİF AL</p></a>
                </div>
            </div>

            <div class="menu">
                <h2>FAYANSCI</h2>
                <img src="fayansci.jpg" alt="Fayansçı">
                <h4>İlan Sayısı: 1238</h4>
                <h4>Puan:4,8(435 Değerlendirme)</h4>
                <div class="teklifbutton">
                    <a href="zanaatkarliste.php"><p>TEKLİF AL</p></a>
                </div>
            </div>

            <div class="menu">
                <h2>NAKLİYECİ</h2>
                <img src="nakliyeci.jpg" alt="Nakliyeci">
                <h4>İlan Sayısı: 1238</h4>
                <h4>Puan:4,8(435 Değerlendirme)</h4>
                <div class="teklifbutton">
                    <a href="zanaatkarliste.php"><p>TEKLİF AL</p></a>
                </div>
            </div>

            <div class="menu">
                <h2>TERZİ</h2>
                <img src="terzi.jpg" alt="Terzi">
                <h4>İlan Sayısı: 1238</h4>
                <h4>Puan:4,8(435 Değerlendirme)</h4>
                <div class="teklifbutton">
                    <a href="zanaatkarliste.php"><p>TEKLİF AL</p></a>
                </div>
            </div>

            <div class="menu">
                <h2>HALI YIKAMA</h2>
                <img src="halici.jpg" alt="Halı Yıkama">
                <h4>İlan Sayısı: 1238</h4>
                <h4>Puan:4,8(435 Değerlendirme)</h4>
                <div class="teklifbutton">
                    <a href="zanaatkarliste.php"><p>TEKLİF AL</p></a>
                </div>
            </div>

            <div class="menu">
                <h2>BİLGİSAYAR TEKNİSYENİ</h2>
                <img src="bilgisayarteknisyeni.jpg" alt="Bilgisayar Teknisyeni">
                <h4>İlan Sayısı: 1238</h4>
                <h4>Puan:4,8(435 Değerlendirme)</h4>
                <div class="teklifbutton">
                    <a href="zanaatkarliste.php"><p>TEKLİF AL</p></a>
                </div>
            </div>

            <div class="menu">
                <h2>ASANSÖR TEKNİSYENİ</h2>
                <img src="asansorteknisyeni.jpg" alt="Asansör Teknisyeni">
                <h4>İlan Sayısı: 1238</h4>
                <h4>Puan:4,8(435 Değerlendirme)</h4>
                <div class="teklifbutton">
                    <a href="zanaatkarliste.php"><p>TEKLİF AL</p></a>
                </div>
            </div>

            
        </div>
    </div>

    
    
        <div class="detay2">
             <img src="zanaatkardetayresim.jpg" alt="Zanaatkar" style="width: 25%;height: 500px;margin-top:50px;margin-left: 200px;border-style: solid;border-width: 30px;
             border-color:orange; border-radius: 20px;">
                  <h1 class="h1" style="float: right;margin-right: 100px;font-size: 20px;margin-top: 100px;"><span style="margin-bottom: 0px;font-size: 50px;">İhtiyacınız 
                    Olan Hizmete Kolayca Ulaşın<br></span><br>Her işin uzmanı burada! İhtiyacınız olan her türlü hizmeti detaylı bilgiler ve <br> 
                   değerlendirmelerle kolayca seçin ve sorunlarınıza hızla çözüm bulun.<br><br>Hangi alanda bir çözüme ihtiyaç duyuyorsanız,
                   uzmanlarımızı sizin için bir araya getiriyoruz. <br>Kolayca arayın, en uygun hizmeti bulun ve çözüm sürecini başlatın.<br><br>Kolay kullanım arayüzü 
                   ile istediğin kategoriden istediğin ustayı kolayca bulabilir ve yardım alabilirsin</h1>
       
        </div>
    
 
    <div class="footer">
     <div class="footer-sections">
         <div>
             <h3 style="color: orange;">İLETİŞİM</h3>
             <h3>Bize Ulaşın ve Sorularınıza Yanıt Bulun!</h3>
             <p>Telefon: +90 123 456 78 90</p>
             <p>E-posta: klu@edu.com</p>
         </div>
         <div>
             <h3 style="color: orange;">SORULAR</h3>
            <a href="sıksorulansorular.html"style="color:white;">Sıkça Sorulan Sorular</a>
             <p>Yardım Merkezi</p>
         </div>
         <div>
             <h3 style="color: orange;">ADRES</h3>
             <p>Adres: Kırklareli Mahallesi, 39000 Kırklareli</p>
         </div>
         <div>
             <h3 style="color: orange;">ŞİKAYET</h3>
             <p>Geri Bildirim</p>
             <p>Şikayet Formu</p>
         </div>
     </div>
     
     <p class="footer-copy">© 2024 Örnek Web Sitesi. Tüm hakları saklıdır.</p>
 </div>
</body>
</html>