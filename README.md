# Audit Management System

## Deskripsi
Aplikasi web **Audit Management System** dirancang untuk mendukung proses audit internal perusahaan, mulai dari pembuatan Surat Perintah Pelaksanaan Audit (SP2A), pembuatan Kertas Kerja Audit (KKA), hingga pengelolaan dan review laporan hasil audit. Aplikasi ini telah mendukung teknologi Progressive Web Apps (PWA), sehingga dapat diinstal dan diakses secara offline.

## Fitur Utama

### 1. Pembuatan SP2A
- **Akses Pembuatan SP2A:**
  - Hanya akun dengan status **Senior Manager** dari berbagai bidang yang dapat membuat Surat Perintah Pelaksanaan Audit (SP2A).
  - Bidang yang memiliki akses:
    - Senior Manager Quality Assurance
    - Senior Manager Akuntansi dan Keuangan
    - Senior Manager Manajemen dan Lingkungan
    - Senior Manager Teknik dan Operasi
    - Senior Manager Komersil

- **Proses Pembuatan SP2A:**
  - Halaman pembuatan SP2A
  - Input jadwal audit
  - Input daftar auditor
  - Input daftar auditi
  - Preview Surat SP2A

### 2. Pembuatan KKA
- **Akses Pembuatan KKA:**
  - Hanya auditor yang dipilih oleh Ketua Bidang pada saat pembuatan SP2A yang dapat membuat Kertas Kerja Audit (KKA).
  - Auditor yang dipilih akan melihat form pembuatan KKA di akun mereka setelah login.

- **Proses Pembuatan KKA:**
  - Login sebagai auditor terpilih (contoh: Pak Ahmad).
  - Menu pembuatan KKA akan tersedia di dashboard auditor.
  - Auditor dapat membuat dan mengisi KKA yang terkait dengan SP2A yang ditugaskan.
  - Tersedia tombol untuk mengirim KKA yang telah selesai dikerjakan kepada Ketua Tim dan Pengawas untuk direview.

- **Output KKA:**
  - Output tampilan hasil Kertas Kerja Audit.

### 3. Review KKA oleh Ketua Tim dan Pengawas
- **Akses Review KKA:**
  - Setelah auditor mengirim KKA untuk direview, KKA tersebut akan masuk ke akun Pengawas yang bersangkutan.
  - Ketua Tim dan Pengawas memiliki akses untuk memberikan catatan dan feedback atas KKA yang telah dibuat.

- **Proses Review KKA:**
  - Pengawas dan Ketua Tim dapat login dan mengakses KKA yang perlu direview melalui menu sidebar.
  - Form catatan untuk Pengawas dan Ketua Tim tersedia untuk memberikan feedback.
  - Auditor dapat melihat feedback yang diberikan melalui menu sidebar di akun mereka.

- **Output Review KKA:**
  - KKA yang statusnya diterima akan diproses lebih lanjut menjadi Laporan Hasil Audit (LHAP).

### 4. Review LHAP oleh General Manager
- **Akses Review LHAP:**
  - KKA yang telah diterima oleh Ketua Tim atau Pengawas akan menjadi LHAP dan masuk ke akun General Manager untuk direview lebih lanjut.
  - Hanya akun dengan jabatan **General Manager** yang memiliki akses untuk mereview LHAP.

- **Proses Review LHAP:**
  - General Manager dapat melihat dan mereview LHAP melalui menu yang tersedia.

### 5. Teknologi PWA (Progressive Web Apps)
- **Instalasi PWA:**
  - Aplikasi web ini mendukung instalasi sebagai PWA, sehingga dapat dipasang di perangkat pengguna.
  - Tampilan aplikasi saat diinstal akan menyesuaikan dengan perangkat yang digunakan.

- **Output PWA:**
  - Ini adalah tampilan aplikasi web setelah diinstal di laptop.
  - Tampilan aplikasi setelah terpasang di komputer pengguna.

## Cara Instalasi
1. Clone repositori ini ke direktori lokal Anda:
    ```bash
    git clone https://github.com/username/repository.git
    ```
2. Masuk ke direktori proyek:
    ```bash
    cd directory-name
    ```
3. Install dependencies:
    ```bash
    composer install
    ```
4. Konfigurasi environment variables:
    - Salin file `.env.example` menjadi `.env`.
    - Atur variabel seperti `DB_CONNECTION`, `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD`.

5. Jalankan migrasi database:
    ```bash
    php artisan migrate
    ```

6. Jalankan aplikasi:
    ```bash
    php artisan serve
    ```
    Akses aplikasi melalui [http://127.0.0.1:8000](http://127.0.0.1:8000).

## Kontribusi
Kontribusi sangat dihargai. Silakan buat pull request atau ajukan issue untuk perbaikan atau fitur baru.

## Lisensi
Aplikasi ini dilisensikan di bawah lisensi [MIT](LICENSE).

## Kontak
Untuk informasi lebih lanjut, hubungi:
- **Nama:** [Nama Anda]
- **Email:** [email@domain.com]
