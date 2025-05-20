document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');

    if (!id) {
        alert("Usta ID'si bulunamadı.");
        return;
    }

    fetchUsta(id);
    loadCalendar(id);
    fetchYorumlar(id);

    function fetchUsta(id) {
        fetch(`ustacek.php?id=${id}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const usta = data.usta;
                    document.getElementById('profile').innerHTML = `
                        <img src="${usta.Resim || 'usta.jpg'}" alt="Usta Resmi">
                        <h2>${usta.Isim} ${usta.Soyisim}</h2>
                    `;
                    document.getElementById('details').innerHTML = `
                        <p><span>Meslek:</span> ${usta.meslek}</p>
                        <p><span>Deneyim:</span> ${usta.DeneyimYili} Yıl</p>
                        <p><span>Telefon:</span> ${usta.Telefon}</p>
                        <p><span>Lokasyon:</span></p>
                        <ul style="margin-left: 20px; color: #555;">
                            <li>Şehir: ${usta.Sehir}</li>
                            <li>İlçe: ${usta.Ilce}</li>
                            <li>Semt: ${usta.Semt}</li>
                        </ul>
                    `;
                } else {
                    document.getElementById('profile').textContent = "Usta bulunamadı.";
                }
            })
            .catch(err => console.error("Usta verisi çekilemedi:", err));
    }

    function fetchYorumlar(id) {
        fetch(`yorumcek.php?id=${id}`)
            .then(response => response.json())
            .then(data => {
                const container = document.querySelector(".comment-column");
                container.innerHTML = "";
                if(Array.isArray(data)){
                    data.forEach((yorum) => {
                        container.innerHTML += `
                            <div class="comment">
                                <h4>${yorum.Ad} ${yorum.Soyad}</h4>
                                <p>${yorum.Mesaj}</p>
                                <div class="stars">Puan: ${yorum.Puan}</div>
                            </div>
                        `;
                    });
                } else {
                    container.textContent = "Yorum bulunamadı.";
                }
            })
            .catch(error => console.error("Yorumları çekerken hata oluştu:", error));
    }

    let selectedDate = null;

    function selectDate(el) {
        document.querySelectorAll('.calendar-box').forEach(box => box.classList.remove('selected'));
        el.classList.add('selected');
        selectedDate = el.textContent;
    }

    function loadCalendar(id) {
        fetch(`tarihcek.php?id=${id}`)
            .then(response => response.json())
            .then(dates => {
                const grid = document.getElementById('calendar-grid');
                grid.innerHTML = "";
                dates.forEach(tarih => {
                    const div = document.createElement("div");
                    div.className = "calendar-box";
                    div.textContent = tarih;
                    div.onclick = () => selectDate(div);
                    grid.appendChild(div);
                });
            })
            .catch(error => console.error("Takvim yüklenirken hata:", error));
    }

    const randevuBtn = document.querySelector('button.randevu-al');
    if(randevuBtn){
        randevuBtn.addEventListener('click', function () {
            if (!selectedDate) {
                alert("Lütfen bir tarih seçin!");
                return;
            }

            const aylar = {
                'Jan': '01', 'Feb': '02', 'Mar': '03',
                'Apr': '04', 'May': '05', 'Jun': '06',
                'Jul': '07', 'Aug': '08', 'Sep': '09',
                'Oct': '10', 'Nov': '11', 'Dec': '12'
            };

            const parts = selectedDate.split(' ');
            if(parts.length < 2){
                alert("Geçersiz tarih formatı.");
                return;
            }

            const gun = parts[0].padStart(2, '0');
            const ay = aylar[parts[1]];
            if(!ay){
                alert("Geçersiz ay bilgisi.");
                return;
            }
            const yil = new Date().getFullYear();
            const tarih = `${yil}-${ay}-${gun}`;

            fetch(`tarihsil.php?id=${id}`, {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `tarih=${encodeURIComponent(tarih)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Randevu başarıyla alındı.");
                    loadCalendar(id);
                    selectedDate = null;
                } else {
                    alert("Hata: " + (data.error || "Bilinmeyen hata"));
                }
            })
            .catch(err => alert("Hata oluştu: " + err.message));
        });
    }
});
