# Laporan Praktikum Pemrograman Web Dasar

**Nama:** Cantika  
**NIM:** 2611500057  
**Program Studi:** Teknik Informatika  
**Institut:** Institut Sains dan Bisnis Atma Luhur  

---

## Pertemuan 7: Pemrosesan Formulir (GET, POST, Validasi, Session, PRG)

### Catatan Pengembangan & Pengujian
1. **Baseline P7:** Menyalin artefak dari `pertemuan-06` ke `pertemuan-07` (index.php, style.css, script.js, img).
2. **Metode GET:** Menambahkan kode `$_GET['nama']` dan memodifikasi `script.js` dengan `contactForm.submit()`.
   - *Pengujian:* Mengakses URL `?nama=Andi` berhasil menampilkan data. Form juga berhasil mengirim data via URL.
3. **Artefak GET (`indexGet.php`):** Membuat salinan `index.php` untuk demonstrasi GET.
4. **Metode POST:** Mengubah form utama menjadi `method="post"`.
   - *Pengujian:* Data tidak lagi terlihat di URL, namun diterima oleh PHP melalui `$_POST`.
5. **Validasi & Sanitasi Sisi Peladen:**
   - Menambahkan validasi nama (3-50 karakter), email valid, semester 1-14, dan pesan maksimal 300 karakter.
   - Menggunakan `htmlspecialchars()` untuk mencegah XSS.
   - *Pengujian:* Form kosong menampilkan pesan error merah. Data yang sudah diisi tidak hilang.
6. **Session & PRG (Post-Redirect-Get):**
   - Data disimpan ke `$_SESSION` dan halaman di-redirect menggunakan `header('Location: index.php#contact')`.
   - *Pengujian:* Setelah submit sukses, muncul pesan hijau. Saat halaman di-refresh, tidak ada peringatan "Confirm Form Resubmission" dan data tidak terkirim ganda.

---

## Pertemuan 8: Fitur Peminjaman Fasilitas Kampus

### Catatan Pengembangan & Pengujian
1. **Menu Baru:** Menambahkan menu navigasi "Peminjaman Fasilitas" dan section `#peminjaman` pada `index.php`.
2. **Form Peminjaman:** Membuat form dengan input Nama Penanggung Jawab, Jenis Fasilitas (dropdown), Tanggal, Durasi (1-8 jam), dan Keperluan.
3. **Validasi Sisi Peladen (Server-side):**
   - Nama: 3-50 karakter.
   - Fasilitas: Harus salah satu dari daftar yang tersedia.
   - Tanggal: Tidak boleh sebelum hari ini.
   - Durasi: Angka bulat 1-8.
   - Keperluan: 10-200 karakter.
4. **Session & PRG:**
   - Data yang berhasil divalidasi disimpan ke `$_SESSION['pj_list']`.
   - Redirect menggunakan `header('Location: index.php#peminjaman')`.
5. **Keamanan:** Menggunakan `htmlspecialchars()` saat menampilkan data di tabel agar aman dari XSS.
6. **Tampilan Data:** Menampilkan tabel "Data Permohonan" berisi data yang sudah diinput.

### Hasil Pengujian
- **Menu Navigasi:** Semua menu (Beranda, Tentang, Peminjaman, Kontak) berfungsi normal.
- **Validasi Form:** Jika form dikosongkan atau diisi tidak sesuai aturan, muncul pesan error berwarna merah dan form tidak terkirim.
- **Keamanan:** Input berupa kode HTML/script akan ditampilkan sebagai teks biasa (aman dari XSS).
- **PRG:** Setelah submit, halaman redirect. Saat di-refresh, tidak terjadi duplikasi data.
- **Data:** Data permohonan berhasil muncul di tabel setelah form dikirim.
- **Fitur Lama:** Form Kontak dari Pertemuan 7 masih berfungsi normal setelah penambahan fitur baru.

### Kendala dan Solusi
- **Kendala:** Sempat terjadi galat pada `index.php` di mana pesan "Permohonan berhasil dikirim" tidak muncul.
- **Solusi:** Menambahkan kode yang kurang pada logika pemrosesan session dan memperbaiki struktur logika. Setelah diperbaiki, pesan sukses berwarna hijau muncul dan data berhasil ditampilkan.