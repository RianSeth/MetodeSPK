## Cara Install

GITHUB : https://github.com/RianSeth/MetodeSPK.git

# Beberapa syarat:
- Menggunakan internet (untuk penggunaan tailwind beserta library lainnya)
- Terinstall **Composer
- Terinstall **NodeJS

# Project ini dapat diambil menggunakan git bash (melakukan clone projek) atau mendownload dari github
# Rekomendasi menggunakan Laragon dan meletakkan file projek di dalam folder root (www) karena lebih mudah menggunakan command line dari laragon (sudah termasuk composer di laragon)
# Setelah project diambil:
- Composer install
- Copy file .env.example menjadi .env (cp .env.example .env)
- Buka file .env dan ubah database menjadi metodespk
- Jalankan (php artisan key:generate)
- Jalankan (php artisan migrate), jika terdapat perintah pembuatan database maka pilih yes / y

# Untuk menjalankan langkahnya:
- Menggunakan Laragon, pilih command line
- command line pertama jalankan perintah (npm run dev)
- tambahkan command line kedua, jalankan perintah (php artisan serve)
- ambil link dari hasil perintah artisan serve, dan buka pada browser
