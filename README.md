## Kurulum
+ En az PHP 8.1 sürümü gereklidir. 
+ Laravel yüklü olması gereklidir.
+ Veritabanı oluşturuyoruz.
+ "database.sql" dosyayı oluşturduğunuz veritabanın içine aktarın (import) [CPanel için örnek import](https://www.youtube.com/watch?v=PGG70alsSLo).
+ ".env" dosyasını açıp veritabanı bilgilerimizi kendi bilgilerimizle değiştiriyoruz.
+ Terminal kullanarak proje dizinimize giriyoruz.
+ "php artisan serve" diyerek projeyi ayağa kaldırıyoruz.
+ Admin Demo Kullanıcı Bilgileri:
+ "admin@admin.com":"adminadmin"

## Proje Hakkında
Proje Adı: Basit Bir Blog Uygulaması
Proje Açıklaması: Bu proje, basit bir blog uygulaması geliştirmenizi gerektirir. Kullanıcıların kaydolabileceği, giriş yapabileceği ve blog yazıları oluşturabileceği bir web sitesi oluşturmanız gerekiyor. Ayrıca, kullanıcıların diğer kullanıcıların blog yazılarını beğenip yorum yapabileceği bir yorum sistemi de eklemeniz gerekiyor.

Gereksinimler:
    + Kullanıcıların kaydolabilmesi ve giriş yapabilmesi gerekiyor. Kullanıcıların kayıt olurken ad, soyad, e-posta ve şifre bilgilerini girmesi gerekiyor. Giriş yaptıklarında, blog yazılarını oluşturabilirler.
    + Kullanıcıların blog yazıları oluşturabilmesi gerekiyor. Her blog yazısı için başlık, içerik ve resim (isteğe bağlı) yükleyebilirler. Blog yazıları, oluşturulma tarihlerine göre sıralanmalıdır.
    + Tüm blog yazılarına ve yorumlara, yalnızca kayıtlı kullanıcılar erişebilmelidir.
    + Yönetici kullanıcılar, tüm blog yazılarını ve yorumları görüntüleyebilmeli ve bunları silme yetkisine sahip olmalıdır.

## Bilgilendirme
+ Frontend için araştırma yapıldı. 
+ Basit ve backend ağırlık olacağı için ücretsiz temalar bulundu. 
+ Frontend tema için : https://startbootstrap.com/theme/clean-blog
+ Admin Panel frontend tema için : https://startbootstrap.com/previews/sb-admin
+ Herhangi bir frontend framework kullanmayacağım resources içinde css ve js klasörleri silindi.
+ Admin Panel parçalama işlemi için "public","resources","controllers" klasörlerinde "front","back" diye klasörler oluşturuldu.
+ Admin panelle ortak login ve kayıt ol sayfası olacağı için resources içerisine auth klasörü oluşturuldu.
+ Admin panel assetleri "public/back" içine kopyalandı. 
+ Blog tema assetleri "public/front" içine kopyalandı.
+ phpmyadmin kullanarak task_blogs adında veritabanı oluşturuldu utf8mb4_unicode_ci
+ php artisan migrate
+ users tablosuna surname,role sütunu eklendi. Models/Users fillable surname,role eklendi.
+ role tinyint(1) unsigned default 0 // 0=Kullanıcı - 1=admin
+ Middleware oluşturuldu eğer role 1 ise /admin giriş izni var değilse yok
+ Menüde eğer admin ise Yönetim Paneli menüsü normal kullanıcılara gözükmez.
+ Api rate limit koruması eklendi."app/Providers/RouteServiceProvider" "throttle:auth" : dakika başına 5 istek
+ Kullanılan Paketler
+ Sweetalert,Axios,Bootstrap Icons,
+ Görselleri otomatik .webp formatına çevirmek için PHP intervation/image paketi yüklendi.
+ Yüklenen yazıların öne çıkarılan görselleri "public/uploads/posts" klasörü içine yüklenecektir.
