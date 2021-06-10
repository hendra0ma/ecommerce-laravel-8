# how to install
1. clone repositori ini
2. Lalu buka terminal dan jalankan "composer install"
3. lalu buka project di kode editor
4. ubah file .env.example menjadi .env dan konfigurasikan dengan database
5. lalu generate app:key dengan mengetikan "php artisan key:generate"
6. lalu migrate table yang ada dengan mengetikan "php artisan migrate"
7. lalu jalankan db:seed dengan mengetikan "php artisan db:seed"
8. lalu jalankan aplikasi dengan mengetikan "php artisan serve"