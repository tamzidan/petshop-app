# PETSHOP-APP

*Transformasi Perawatan Hewan, Memberdayakan Hewan Peliharaan Bahagia Setiap Hari*

![last commit](https://img.shields.io/github/last-commit/tamzidan/petshop-app)
![Made with](https://img.shields.io/badge/Made%20with-PHP-777BB4?style=flat&logo=php)
![Languages](https://img.shields.io/github/languages/top/tamzidan/petshop-app)

**Dibangun dengan tools dan teknologi:**
![JSON](https://img.shields.io/badge/JSON-000000?style=flat&logo=json)\
![Markdown](https://img.shields.io/badge/Markdown-000000?style=flat&logo=markdown)\
![HTML](https://img.shields.io/badge/npm-DD3735?style=flat&logo=npm&logoColor=white)
![Autoprefixer](https://img.shields.io/badge/Autoprefixer-DD3735?style=flat&logo=autoprefixer&logoColor=white)
![PostCSS](https://img.shields.io/badge/PostCSS-DD3A0A?style=flat&logo=postcss&logoColor=white)
![Composer](https://img.shields.io/badge/Composer-885630?style=flat&logo=composer&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=flat&logo=javascript&logoColor=black)
![XML](https://img.shields.io/badge/XML-FF6600?style=flat&logo=xml)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat&logo=php&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-646CFF?style=flat&logo=Vite&logoColor=white)
![Swiper](https://img.shields.io/badge/Swiper-5A29E4?style=flat&logo=swiper&logoColor=white)
![Axios](https://img.shields.io/badge/Axios-5A29E4?style=flat&logo=axios&logoColor=white)

---

## Daftar Isi

- [Gambaran Umum](#gambaran-umum)
- [Fitur](#fitur)
- [Memulai](#memulai)
  - [Prasyarat](#prasyarat)
  - [Instalasi](#instalasi)
- [Penggunaan](#penggunaan)
- [Peran Pengguna & Izin Akses](#peran-pengguna--izin-akses)
- [Integrasi API](#integrasi-api)
- [Testing](#testing)
- [Kontribusi](#kontribusi)
- [Lisensi](#lisensi)

---

## Gambaran Umum

**petshop-app** adalah platform berbasis Laravel yang komprehensif dirancang untuk mengelola layanan perawatan hewan peliharaan, termasuk booking grooming, booking hotel, penjualan produk, dan konsultasi veteriner. Aplikasi ini menampilkan antarmuka responsif modern yang dibangun dengan Tailwind CSS dan Blade, memberikan pengalaman pengguna yang lancar di semua perangkat.

Platform ini terintegrasi dengan berbagai layanan pihak ketiga termasuk WhatsApp Business API untuk komunikasi, berbagai platform e-commerce untuk penjualan produk, dan mengimplementasikan sistem referral yang kuat dengan reward poin.

### Mengapa petshop-app?

Proyek ini memberdayakan developer untuk membangun platform layanan hewan yang scalable dengan:

🌸 🌿 **Tailwind CSS & PostCSS**: Styling yang streamlined dan utility-first untuk desain yang konsisten dan kompatibel lintas browser.

🚀 ⚡ **Blade Laravel**: Workflow pengembangan yang cepat dan efisien dengan hot module replacement dan optimasi asset bundling.

📱 🔐 **Autentikasi WhatsApp OTP**: Onboarding dan login pengguna yang aman berbasis nomor telepon melalui WhatsApp.

🛡️ 🔒 **Role-Based Middleware**: Kontrol akses yang detail untuk role admin, owner, dan user.

🔄 ⭐ **Komponen Blade Modular**: Elemen UI yang dapat digunakan kembali untuk pengalaman frontend yang kohesif.

📡 🔔 **Real-Time Broadcasting**: Update langsung dan notifikasi untuk meningkatkan engagement pengguna.

---

## Fitur

### 🔐 **Autentikasi & Keamanan**
- **Login/Register Berbasis WhatsApp**: Pengguna melakukan autentikasi menggunakan nomor WhatsApp dan password
- **Verifikasi OTP**: Proses registrasi yang aman dengan verifikasi OTP WhatsApp
- **Kontrol Akses Berbasis Role**: Tiga peran pengguna yang berbeda (Owner, Admin, User)

### 🎁 **Sistem Referral**
- **Sistem Reward Ganda**: Baik pemberi referral maupun pengguna baru mendapatkan poin saat registrasi
- **Bonus Transaksi**: Poin tambahan diberikan kepada pemberi referral ketika pengguna baru melakukan transaksi pertama
- **Pelacakan Referral**: Analitik komprehensif untuk performa referral

### 🛍️ **Manajemen Produk**
- **Integrasi Multi-Platform**: Link langsung ke WhatsApp, Tokopedia, Shopee, Lazada, dan platform lainnya
- **Katalog Produk**: Menampilkan gambar, nama, harga, dan deskripsi produk
- **Sistem Tanpa Keranjang**: Pendekatan yang streamlined mengarahkan pengguna ke platform pembelian eksternal

### 📅 **Layanan Booking**

#### **Pet Grooming**
- **Booking Berbasis Form**: Form booking yang user-friendly
- **Integrasi WhatsApp**: Pengiriman form otomatis ke WhatsApp untuk konfirmasi
- **Manajemen Booking**: Pelacakan riwayat lengkap dengan opsi edit, konfirmasi, dan batal
- **Reward Poin**: Dapatkan poin untuk setiap sesi grooming yang selesai

#### **Pet Hotel**
- **Sistem Booking Serupa**: Workflow yang identik dengan booking grooming
- **Manajemen Akomodasi**: Pelacakan jadwal dan masa tinggal hewan
- **Akumulasi Poin**: Sistem reward untuk booking hotel

### 🏥 **Layanan Veteriner**
- **Konsultasi WhatsApp**: Koneksi langsung ke klinik veteriner via WhatsApp
- **Akses Mudah**: Booking konsultasi dengan satu klik

### 🎯 **Sistem Poin**
- **Mendapatkan Poin**: Akumulasi poin melalui booking, referral, dan transaksi
- **Penukaran Produk**: Tukar poin dengan produk yang tersedia
- **Kode Voucher Unik**: Generate kode yang dapat ditukarkan untuk produk yang diklaim
- **Integrasi Kasir**: Sistem penukaran di toko dengan kode unik

### 👥 **Peran Pengguna & Kemampuan**

#### **Fitur User**
- Membeli produk melalui platform eksternal
- Booking layanan grooming dan hotel
- Konsultasi dengan klinik veteriner
- Mengelola referral dan mendapatkan poin
- Menukar poin untuk produk

#### **Fitur Admin**
- **Manajemen Produk**: Menambah, mengedit, dan mengelola daftar produk
- **Konfirmasi Booking**: Mencari dan mengelola booking berdasarkan kode transaksi
- **Manajemen Produk Poin**: Mengkonfigurasi katalog penukaran poin
- **Manajemen Voucher**: Memproses dan memvalidasi kode penukaran unik
- **Customer Support**: Menangani konfirmasi booking WhatsApp

#### **Fitur Owner**
- **Akses Admin Penuh**: Kemampuan administratif lengkap
- **Analitik Referral**: Memantau performa program referral
- **Manajemen User**: Mengatur peran pengguna dan saldo poin
- **Gambaran Sistem**: Dashboard komprehensif dan pelaporan

---

## Memulai

### Prasyarat

Proyek ini memerlukan dependensi berikut:

- **Bahasa Pemrograman**: PHP 8.1+
- **Framework**: Laravel 10.x
- **Package Manager**: Composer, NPM
- **Database**: MySQL 8.0+
- **Node.js**: 16.x atau lebih tinggi

### Instalasi

Build petshop-app dari source dan install dependensi:

#### 1. Clone repository:
```bash
git clone https://github.com/tarmidan/petshop-app
```

#### 2. Navigasi ke direktori proyek:
```bash
cd petshop-app
```

#### 3. Install dependensi PHP:

**Menggunakan composer:**
```bash
composer install
```

#### 4. Install dependensi Node.js:

**Menggunakan npm:**
```bash
npm install
```

#### 5. Konfigurasi Environment:
```bash
cp .env.example .env
php artisan key:generate
```

#### 6. Setup Database:
```bash
php artisan migrate --seed
```

#### 7. Storage Link:
```bash
php artisan storage:link
```

#### 8. Build Assets:
```bash
npm run build
```

---

## Penggunaan

### Development Server

**Menggunakan Laravel Artisan:**
```bash
php artisan serve
```

**Menggunakan NPM untuk kompilasi asset:**
```bash
npm run dev
```

### Deployment Production

**Build asset yang dioptimasi:**
```bash
npm run build
```

**Optimasi Laravel:**
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## Peran Pengguna & Izin Akses

### 🔵 **Peran User**
- Browsing dan pembelian produk eksternal
- Booking layanan (grooming, hotel)
- Akses konsultasi veteriner
- Partisipasi sistem referral
- Mendapatkan dan menukar poin

### 🟡 **Peran Admin**
- Manajemen katalog produk
- Konfirmasi dan manajemen booking
- Administrasi produk poin
- Pemrosesan kode voucher
- Operasi customer service

### 🔴 **Peran Owner**
- Administrasi sistem lengkap
- Manajemen peran pengguna dan poin
- Analitik program referral
- Konfigurasi dan pengawasan sistem

---

## Integrasi API

### WhatsApp Business API
- Verifikasi OTP selama registrasi
- Pengiriman form booking
- Permintaan konsultasi
- Komunikasi customer service

### Link Platform E-commerce
- Integrasi Tokopedia
- Marketplace Shopee
- Platform Lazada
- Katalog WhatsApp Business kustom

### API Sistem Poin
- Pelacakan transaksi
- Algoritma perhitungan poin
- Sistem generasi voucher
- Validasi penukaran

---

## Testing

Jalankan test suite yang komprehensif:

```bash
php artisan test
```

**Feature Tests:**
- Testing flow autentikasi
- Validasi sistem booking
- Verifikasi sistem poin
- Testing akses berbasis role

**Unit Tests:**
- Testing service layer
- Validasi relasi model
- Testing utility function

---

## Kontribusi

Kami menyambut kontribusi untuk petshop-app! Silakan ikuti panduan berikut:

1. Fork repository
2. Buat feature branch (`git checkout -b feature/fitur-keren`)
3. Commit perubahan Anda (`git commit -m 'Tambah fitur keren'`)
4. Push ke branch (`git push origin feature/fitur-keren`)
5. Buka Pull Request

---

## Lisensi

Proyek ini dilisensikan di bawah MIT License. Lihat file [LICENSE](LICENSE) untuk detail.

---

## Dukungan

Untuk dukungan, silakan hubungi:
- **Email**: tamzidan01@gmail.com
- **WhatsApp**: +62-857-2240-3823
- **Dokumentasi**: [docs.petshop-app.com](https://tamzidan.site)

---

**Dibangun dengan ❤️ untuk pecinta hewan dan sahabat berbulu mereka**