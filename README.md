# Aplikasi CRUD Sederhana - Tes Interview PHP Developer

Ini adalah aplikasi sederhana yang menerapkan fungsi dasar **CRUD** (Create, Read, Update, Delete) menggunakan **PHP native** dan **MySQL**. Proyek ini dibuat sebagai bagian dari proses seleksi teknikal untuk posisi PHP Developer.

## Fitur

- Menambahkan data baru ke database
- Menampilkan daftar data
- Mengedit data yang sudah ada
- Menghapus data dari database

## Teknologi yang Digunakan

- PHP
- MySQL / MariaDB
- HTML & CSS
- Composer

## Kompatibilitas

Aplikasi ini telah dan diuji berjalan dengan baik pada:
- PHP 8.1, 8.2, dan 8.3
- MySQL 8.0.40
- MariaDB 11.3.2


## Instalasi

1. Clone repositori
    ```bash
    git clone https://github.com/rohmatnov/test-crud.git
    ```

2. Masuk ke direktori proyek
    ```bash
    cd test-crud
    ```

3. Jalankan perintah berikut untuk mengatur autoload
    ```bash
    composer install
    ```

## Pengaturan database
1. Buat database baru di MySQL atau MariaDB, misal `crud_test`

2. Import File `database.sql` ke dalam database yang telah dibuat. File ini berisi struktur dan data awal database

3. Sesuaikan Koneksi Database pada file  `src/config/database.php` sesuai dengan detail koneksi MySQL atau MariaDB anda

## Jalankan Aplikasi
Aplikasi ini dapat dijalankan menggunakan PHP built-in server atau Apache lokal.

### Menggunakan Built-in Server (PHP)
1. Jalankan perintah berikut di root direktori proyek
    ```bash
    php -S localhost:8000 -t public
    ```

2. Akses aplikasi melalui browser.
    ```bash
    http://localhost:8000
    ```

### Menggunakan Server Lokal (Apache)
1. Pastikan Apache sedang berjalan

2. Akses aplikasi melalui browser. misal
    ```bash
    http://localhost/test-crud/public
    ```

## Struktur Folder
Struktur direktori utama aplikasi, memisahkan file publik, kode, dan tampilan.
```markdown
test-crud/
├── public/         # File yang diakses langsung oleh user (index.php, assets)
├── src/            # Source code utama (controller, config, dll.)
├── views/          # Tampilan HTML
├── database.sql    # Struktur dan data awal database
└── README.md
```

## Catatan Tambahan
- Aplikasi ini dibuat tanpa framework (PHP native) untuk menunjukkan pemahaman dasar terhadap arsitektur aplikasi berbasis PHP.

- Mendukung penggunaan Composer untuk autoloading (jika diperlukan).

## Penulis
Dibuat oleh [Muhammad Rohmat Abdullah](https://linkedin.com/in/mrohmat) sebagai bagian dari tes interview PHP Developer.