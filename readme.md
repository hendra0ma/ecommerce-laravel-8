# how to install
1. clone repositori ini
2. Lalu buka terminal di Folder ini dan jalankan "composer install"
3. lalu buka project di kode editor
4. ubah file .env.example menjadi .env dan konfigurasikan dengan database
5. lalu generate app:key dengan mengetikan "php artisan key:generate"
6. lalu migrate table yang ada dengan mengetikan "php artisan migrate"
7. lalu jalankan db:seed dengan mengetikan "php artisan db:seed"
8. lalu jalankan aplikasi dengan mengetikan "php artisan serve"

## note

- JANGAN LUPA UNTUK SEED DATABASE KARNA ADA DATA PROVINSI , KOTA , KECAMATAN
- untuk login admin bisa buka localhost:8000/login
- untuk email dan password admin dapat di cek di folder database/seeds/UsersTableSeeder.php
