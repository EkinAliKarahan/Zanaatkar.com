<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
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
   justify-content: space-between;
    padding: 0 20px;
    color: white;
}

.header h1 {
    font-size: 40px;
    margin: 30px;
}
.header h2{
            margin-right: 40px;
            background-color: #333;
            text-decoration: none;
            color: white;
            padding: 5px;
            border-radius: 5px;
            cursor: pointer;
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

        

       
        .nav {
    background-color: rgb(43, 43, 43);
    display: flex;
    justify-content: center;
    padding: 10px 0;
    height: 40px;
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
  
    </style>
</head>
<body>
    
    <div class="header">
        <img src="logo.jpg" alt="Logo">
        <h1>Zanaatkar</h1>
        <a href="kayit_html.php"><h2>Giriş Yap</h2></a>
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

           <div>

            <h1>
                Hakkımızda<br><br>
Zanaatkar: Her İşin Uzmanını Bulabileceğiniz Platform<br><br>

Hayatta her zaman işler yolunda gitmeyebilir; bir anda elektrik arızası, su tesisatı problemi veya mobilya tamiri gibi 
sorunlarla karşılaşabilirsiniz. İşte biz, tam da bu noktada devreye giriyoruz!<br><br>

Zanaatkar, ihtiyacınız olan her türlü hizmeti kolayca bulmanızı ve doğru uzmanla buluşmanızı sağlayan bir platformdur. 
Kullanıcı dostu arayüzümüz ve kapsamlı hizmet kategorilerimiz sayesinde, artık işlerinizi halletmek bir sorun olmaktan çıkıyor.<br><br>

Misyonumuz
İnsanların günlük hayatlarında karşılaştıkları sorunlara hızlı, güvenilir ve uygun fiyatlı çözümler sunmak. Herkesin ihtiyaç duyduğu hizmeti 
doğru uzmanla kolayca buluşturmayı hedefliyoruz.<br><br>

Vizyonumuz<br>
Sektöründe lider bir platform olarak, her bireyin güvenle kullanabileceği bir hizmet ağı oluşturmak ve iş süreçlerini dijital dünyanın olanaklarıyla modernize etmek.<br><br>

Neden Bizi Tercih Etmelisiniz?<br>
<ul>
    <li>
        Uzman Kadro: Onaylı ve güvenilir hizmet verenlerimizle kaliteli çözümler sunuyoruz.
    </li>
    <li>
        Kullanıcı Yorumları: Diğer kullanıcıların deneyimlerini inceleyerek en doğru kararı verebilirsiniz.
    </li>
    <li>
        Kolay Erişim: İhtiyacınız olan hizmeti saniyeler içinde bulabilir, teklif alabilirsiniz.
    </li>
    <li>
        Geniş Kapsam: Marangozdan tesisatçıya, boyacıdan bilgisayar teknisyenine kadar her kategoride hizmet.
    </li>
    <li>
        Zanaatkar ailesi olarak, sorunlarınızı hızlı ve etkili bir şekilde çözüme kavuşturmak için buradayız. Bizi tercih ettiğiniz için teşekkür ederiz!
    </li>
</ul>

            </h1>  

           </div>
</body>
</html>