# Smart Meritim — Laravel

Konversi tugas akhir Smart Meritim ke Laravel 13, Eloquent, migration, database seeder, dan Blade. Aplikasi menampilkan ringkasan armada, hasil tangkapan, pemantauan, parkir, harga ikan, dan cuaca.

## Menjalankan aplikasi

1. Buat database baru di phpMyAdmin bernama `db_smartmerine_ta` dengan collation `utf8mb4_unicode_ci`.
2. Pastikan `.env` berisi koneksi MySQL yang sesuai dengan komputer Anda. Nilai awalnya:

   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=db_smartmerine_ta
   DB_USERNAME=root
   DB_PASSWORD=
   APP_LOCALE=id
   APP_FAKER_LOCALE=id_ID
   ```

3. Dari folder proyek, jalankan:

   ```bash
   composer install
   php artisan key:generate
   php artisan migrate
   php artisan db:seed
   php artisan serve
   ```

   Untuk membuat ulang seluruh tabel sekaligus data contoh, jalankan `php artisan migrate:fresh --seed`. Perintah ini menghapus data di database terpilih sebelum membuatnya kembali.
4. Buka alamat yang ditampilkan oleh `php artisan serve`. Halaman Blade dashboard membaca data dari model Eloquent. Navigasi di sisi kiri membuka tabel setiap modul.
5. Untuk melihat hasil pada phpMyAdmin, pilih database `db_smartmerine_ta`, lalu buka tab **Structure**. Tabel aplikasi: `kapal`, `tangkapan`, `monitoring`, `parkir`, `harga_ikan`, dan `cuaca`. Buka tab **Browse** untuk memeriksa 10 baris contoh per tabel yang diisi seeder. Tabel pendukung Laravel `cache` dan `jobs` juga dibuat oleh migration.

## Analisis data dan relasi

| Tabel | Kolom utama | Relasi / catatan |
| --- | --- | --- |
| `kapal` | `nama_kapal`, `jenis_kapal`, `nama_kapten`, `status`, `foto` | Satu kapal dapat memiliki banyak tangkapan, monitoring, dan catatan parkir |
| `tangkapan` | `kapal_id`, `jenis_ikan`, `berat`, `tanggal_tangkap`, `lokasi_tangkap`, `foto_bukti` | `kapal_id` foreign key ke `kapal.id`; berat memakai decimal |
| `monitoring` | `kapal_id`, `lokasi`, `status_monitoring`, `waktu_monitoring` | `kapal_id` foreign key ke `kapal.id` |
| `parkir` | `kapal_id`, `lokasi_parkir`, `waktu_masuk`, `waktu_keluar`, `status`, `biaya`, `foto_bukti` | `kapal_id` foreign key ke `kapal.id`; waktu keluar boleh kosong |
| `harga_ikan` | `jenis_ikan`, `harga_per_kg`, `lokasi_pasar`, `tanggal_update`, `foto` | Harga memakai decimal; foto boleh kosong |
| `cuaca` | `suhu`, `kondisi`, `kecepatan_angin`, `kelembapan`, `update_terakhir` | Suhu dan ukuran cuaca boleh kosong saat belum tersedia |

Semua tabel aplikasi memakai primary key `id` dan timestamps. Jika kapal dihapus, catatan tangkapan, monitoring, dan parkir terkait ikut terhapus.

Migration dibuat terpisah melalui `php artisan make:migration create_nama_tabel_table`, dan model dibuat dengan `php artisan make:model NamaModel`. Seeder `SmartMaritimSeeder` memakai Faker locale `id_ID` dan membuat 10 data kapal, tangkapan, monitoring, parkir, harga ikan, cuaca. `DatabaseSeeder` memanggil seeder tersebut.

Struktur tabel dapat diperiksa di terminal dengan `php artisan db:table nama_tabel`, atau melalui tab **Structure** phpMyAdmin setelah migration dijalankan.

## CRUD, Blade View, Component, dan Layout App

- Aplikasi tidak menggunakan authentication; dashboard dan halaman pengelolaan data dapat dibuka langsung.
- Navigasi di sisi kiri membuka halaman daftar setiap modul. Tombol **Tambah data**, **Ubah**, dan **Hapus** menyediakan operasi CRUD untuk kapal, tangkapan, monitoring, parkir, harga ikan, dan cuaca.
- View Blade memakai layout bersama `resources/views/layouts/app.blade.php` dan komponen Blade untuk judul halaman, notifikasi, serta badge status. Form memakai validasi Laravel dan token CSRF. Penghapusan kapal menghapus catatan terkait mengikuti foreign key `cascadeOnDelete`.
