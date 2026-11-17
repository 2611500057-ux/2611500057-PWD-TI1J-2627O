pada p9, saya melakukan:

1. menyalin artefak p7 ke p9, dengan alamat URL http://localhost/pwd/2611500057-PWD-TI1J-26270/pertemuan-09/ fitur yang sebelumnya masih berfungsi dengan baik
2. Mencoba membuat array menggunakan index dari array itu sendiri,dimulai dari 0 bukan 1
3. Membuat file `fungsi.php` yang berisi dua fungsi utama:
   - `bersihkan($teks)`: untuk membersihkan input dari karakter berbahaya (mencegah XSS) menggunakan `htmlspecialchars`.
   - `tebal($teks)`: untuk memformat teks menjadi tebal (menggunakan tag `<strong>`).
4. Mengimplementasikan fungsi `bersihkan()` dan `tebal()` pada file `index.php` menggunakan `include("fungsi.php")`.
5. Memodifikasi penyimpanan data formulir ke dalam satu array asosiatif (`$_SESSION["form_data"]`) agar lebih terstruktur.
6. Memodifikasi proses penampilan data formulir menggunakan array `$labels` dan perulangan `foreach` agar kode lebih ringkas, lalu memanggil fungsi `bersihkan()` dan `tebal()` di dalamnya.
7. Melakukan pengujian keamanan dengan mengirimkan script berbahaya (seperti `<script>alert('hai');</script>`) melalui form, dan memastikan script tersebut tidak tereksekusi (hanya tampil sebagai teks biasa) berkat fungsi `bersihkan()`.
