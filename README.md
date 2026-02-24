# Matris Çiz

## Proje Açıklaması
**Matris Çiz**, kullanıcıların belirli bir boyut ve şekil seçerek dinamik bir matris oluşturmasını sağlayan bir web uygulamasıdır. Bu proje, özellikle PHP ve CSS kullanılarak, kullanıcı dostu bir arayüzle matris çizimlerini görselleştirmeyi hedefler.

## Özellikler (Features)
- **5 Farklı Şekil Seçeneği:**
  - Dış Çerçeve
  - Tam Ortadan Artı (+)
  - Köşeden Köşeye X
  - İçte Baklava Dilimi
  - Satranç Tahtası
- **Dinamik Boyut:** Kullanıcı, 5 ile 25 arasında tek sayı olacak şekilde matris boyutunu belirleyebilir.
- **Hata Yönetimi:** Geçersiz girişlerde kullanıcıya bilgilendirici hata mesajları gösterilir.
- **Responsive Tasarım:** Mobil cihazlar için optimize edilmiş bir arayüz.

## Kullanılan Teknolojiler
- **PHP:** Dinamik matris oluşturma ve kullanıcı girişlerini işleme.
- **CSS Grid:** Matris hücrelerinin düzenlenmesi.
- **CSS Flexbox:** Sayfa düzeninin esnek bir şekilde oluşturulması.
- **Bootstrap:** Form ve genel tasarım için hazır bileşenler.

## Teknik Detaylar (Algoritma)
### Baklava Dilimi Algoritması
- **Manhattan Mesafesi:** Baklava dilimi şekli, her hücrenin merkeze olan Manhattan mesafesi hesaplanarak oluşturulur. Bu mesafe, $|satır - merkez| + |sütun - merkez|$ formülüyle hesaplanır.
- **Merkez Noktası:** Matrisin merkez noktası, `(boyut + 1) / 2` formülüyle belirlenir.
- **Yarıçap:** Baklava diliminin sınırları, merkezden itibaren yarıçap değeriyle kontrol edilir.

### CSS Teknikleri
- **Aspect-Ratio:** Hücrelerin kare şeklinde kalmasını sağlamak için `aspect-ratio: 1 / 1` kullanılmıştır.
- **Clamp():** Hücre yazı boyutları, `clamp()` fonksiyonu ile dinamik olarak ayarlanmıştır. Örneğin:
  ```css
  font-size: clamp(0.35rem, calc(1.8vw / max(var(--hucre-sayisi, 5), 5) + 0.3rem), 0.85rem);
  ```

## Kurulum
1. Proje dosyalarını yerel bir sunucuya (ör. WAMP, XAMPP) kopyalayın.
2. Tarayıcınızda `http://localhost/PHP/matris.php` adresine gidin.
3. Matris boyutunu ve şekli seçerek "Şekli Çiz" butonuna tıklayın.

---

Bu proje, PHP ve CSS kullanılarak dinamik matris çizimi için geliştirilmiştir. Herhangi bir sorunuz veya öneriniz varsa lütfen iletişime geçin.
