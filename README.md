# SIPMAM

> Sistem Pemesanan Makanan dan Minuman

## Tutorial Instal

### Instal

Pastikan telah instal `php 7.2`, dan [`composer`](https://getcomposer.org/download/)

### Download / Clone Repo

Silahkan untuk mendownload repo ini, atau clone :

```
git clone https://github.com/retry19/sipmam.git
```

### Configurasi

Buka `cmd` atau `terminal`, lalu masuk ke lokasi folder repo yang telah didownload atau clone

```
cd sipmam
```

Instal dependencies yang berada composer.lock

```
composer install
```

Salin file `.env.example`, tempel di folder tersebut namun ubah menjadi `.env`

```
cp .env.example .env
```

Generate App Key melalui `cmd` atau `terminal`

```
php artisan key:generate
```

Buat database pada mysql, contohnya melalui `phpmyadmin`

Ubah file .env, masukan informasi mengenai database yang telah dibuat
```
DB_DATABASE=isi_dengan_nama_database_yang_dibuat
DB_USERNAME=isi_dengan_username_database
DB_PASSWORD=isi_dengan_password_database
```

Lakukan migration dan seeder table yang dibutuhkan

```
php artisan migrate --seed
```

### Menjalankan App

Buka `cmd` atau `terminal`, pastikan lokasinya berada di project sipmam

```
php artisan serve
```

Pastikan muncul tulisan (port bisa berbeda) : 

```
Laravel development server started: http://127.0.0.1:8000
```

Buka [`http://127.0.0.1:8000`](http://127.0.0.1:8000) pada browser kesayangan.