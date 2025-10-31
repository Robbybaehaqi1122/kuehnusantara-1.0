# Webkul Duitku (scaffold)

Scaffold minimal integrasi Duitku untuk Bagisto.

## File penting:
- `Config/paymentmethods.php` — daftar metode pembayaran Duitku.
- `Payment/Duitku.php` — class payment, siap diisi logika request ke API Duitku.
- `Http/Controllers/PaymentController.php` — endpoint create dan webhook.
- `Http/routes.php` — route endpoint.
- `Providers/DuitkuServiceProvider.php` — provider untuk config dan route.

## Langkah selanjutnya:
1. Tambahkan kunci di `.env`:
   ```
   DUITKU_MERCHANT_CODE=XXXXXX
   DUITKU_API_KEY=XXXXXXXXXXXXXXXXXXXXXXXX
   DUITKU_IS_PRODUCTION=false
   ```
2. Implementasikan logika request ke API Duitku di `Payment/Duitku.php` (lihat dokumentasi Duitku).
3. Daftarkan provider di `config/app.php` jika perlu:
   ```php
   Webkul\Duitku\Providers\DuitkuServiceProvider::class,
   ```
4. Jalankan:
   ```powershell
   composer dump-autoload
   php artisan config:clear
   php artisan cache:clear
   php artisan route:clear
   ```
5. Uji endpoint `/duitku/create` dan `/duitku/webhook`.

Lihat dokumentasi resmi Duitku: https://docs.duitku.com/docs/online-api/
