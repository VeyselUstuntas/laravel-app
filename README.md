# Laravel Uygulaması

Bu proje, temel Laravel özelliklerini içeren bir uygulamadır. Laravel'in sunduğu standart araçları ve özellikleri kullanarak bir web uygulaması geliştirilmiştir.

## Özellikler

- **Kimlik Doğrulama**: Kullanıcı girişi işlemi.
- **Laravel Eloquent ORM**: Veritabanı işlemlerini gerçekleştirmek için kullanılır.
- **Bootstrap ile UI**: Kullanıcı arayüzü Bootstrap ile stilize edilmiştir.

## Proje Yapısı

- **app/Http/Controllers**: İstekleri işlemek ve ilgili görünümleri yönlendirmek için kullanılan denetleyici (controller) sınıfları.
- **app/Models**: Veritabanı işlemlerini gerçekleştiren Eloquent modelleri.
- **resources/views**: Blade kullanılarak oluşturulmuş kullanıcı arayüzü bileşenleri.
- **routes/web.php**: Uygulamanın rotalarını tanımlar.

## Kurulum

1. Depoyu klonlayın:
   ```bash
   git clone https://github.com/VeyselUstuntas/laravel-app.git

2. Proje dizinine gidin:
    ```bash
    cd laravel-app

3. Bağımlılıkları yükleyin
    ```bash
    composer install

4. .env dosyasını yapılandırarak veritabanı bilgilerini ve diğer ortam ayarlarını yapın.

5. Veritabanı tablolarını oluşturun:
    ```bash
    php artisan migrate

6. Laravel sunucusunu başlatın
    ```bash
    php artisan serve

