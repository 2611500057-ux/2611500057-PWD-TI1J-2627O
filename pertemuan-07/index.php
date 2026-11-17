<?php
session_start();

$errors = [];
$old = [
    'nama' => '', 'email' => '', 'semester' => '', 'tanggal' => '',
    'jenis_pesan' => '', 'minat' => '', 'prodi' => '', 'pesan' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old['nama'] = trim($_POST['nama'] ?? '');
    $old['email'] = trim($_POST['email'] ?? '');
    $old['semester'] = trim($_POST['semester'] ?? '');
    $old['tanggal'] = trim($_POST['tanggal'] ?? '');
    $old['jenis_pesan'] = trim($_POST['jenis_pesan'] ?? '');
    $old['minat'] = $_POST['minat'] ?? '';
    $old['prodi'] = trim($_POST['prodi'] ?? '');
    $old['pesan'] = trim($_POST['pesan'] ?? '');

    if (empty($old['nama'])) { $errors['nama'] = "Nama lengkap wajib diisi."; }
    elseif (strlen($old['nama']) < 3) { $errors['nama'] = "Nama lengkap minimal 3 karakter."; }
    elseif (strlen($old['nama']) > 50) { $errors['nama'] = "Nama lengkap maksimal 50 karakter."; }

    if (empty($old['email'])) { $errors['email'] = "Email wajib diisi."; }
    elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) { $errors['email'] = "Format email tidak valid."; }

    if (empty($old['semester'])) { $errors['semester'] = "Semester wajib diisi."; }
    elseif (!is_numeric($old['semester']) || $old['semester'] < 1 || $old['semester'] > 14) { $errors['semester'] = "Semester harus angka 1-14."; }

    if (empty($old['tanggal'])) { $errors['tanggal'] = "Tanggal kunjungan wajib diisi."; }

    if (empty($old['jenis_pesan'])) { $errors['jenis_pesan'] = "Jenis pesan wajib dipilih."; }
    elseif (!in_array($old['jenis_pesan'], ['pertanyaan', 'saran'])) { $errors['jenis_pesan'] = "Jenis pesan tidak valid."; }

    if (empty($old['prodi'])) { $errors['prodi'] = "Program studi wajib dipilih."; }
    elseif (!in_array($old['prodi'], ['SI', 'TI'])) { $errors['prodi'] = "Program studi tidak valid."; }

    if (empty($old['pesan'])) { $errors['pesan'] = "Pesan wajib diisi."; }
    elseif (strlen($old['pesan']) > 300) { $errors['pesan'] = "Pesan maksimal 300 karakter."; }

    if (empty($errors)) {
        $_SESSION['form_data'] = $old;
        $_SESSION['form_success'] = "Form berhasil dikirim dan divalidasi di sisi peladen!";
        header('Location: index.php');
        exit;
    }
}

$successMessage = null;
if (isset($_SESSION['form_success'])) {
    $successMessage = $_SESSION['form_success'];
    unset($_SESSION['form_success']);
}

if (isset($_SESSION['form_data'])) {
    $old = $_SESSION['form_data'];
    unset($_SESSION['form_data']);
}

$nim = "2611500057";
$namaMahasiswa = "Cantika";
$programStudi = "TI";
$tahunAkademik = "2026/2027";
$semester = 1;
$ipk = 3.75;
$statusAktif = true;
$catatanTambahan = null;
const NAMA_MATA_KULIAH = "Pemrograman Web Dasar";
const PROFIL_GITHUB = "2611500057-ux";
$batasSemester = 8;
$sisaSemester = $batasSemester - $semester;
$semesterValid = $semester >= 1 && $semester <= $batasSemester;
$statusSemester = ($semesterValid && $statusAktif) ? "Sesuai rentang" : "Perlu diperiksa";
if ($semester < 3) { $keteranganSemester = "Semester awal"; } elseif ($semester <= 6) { $keteranganSemester = "Semester menengah"; } else { $keteranganSemester = "Semester akhir"; }
$namaProdi = ($programStudi == "SI") ? "Sistem Informasi" : (($programStudi == "TI") ? "Teknik Informatika" : "Lainnya");
switch ($programStudi) {
    case "SI": $fokusProgramStudi = "Sistem informasi dan proses bisnis"; break;
    case "TI": $fokusProgramStudi = "Komputasi dan pengembangan perangkat lunak"; break;
    default: $fokusProgramStudi = "Belum ditentukan";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Profil Mahasiswa</h1>
        <nav>
            <button class="nav-toggle" id="navToggle" type="button" aria-label="Buka navigasi" aria-controls="navMenu" aria-expanded="false">&#9776;</button>
            <ul id="navMenu">
                <li><a href="#home">Beranda</a></li>
                <li><a href="#about">Tentang</a></li>
                <li><a href="#contact">Kontak</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="home">
            <h2>Selamat Datang</h2>
            <p>Halo, saya <strong><?php echo $namaMahasiswa; ?></strong>. Saya sedang mempelajari matakuliah <strong><?php print NAMA_MATA_KULIAH; ?></strong> pada tahun akademik <?php echo $tahunAkademik; ?>.</p>
            <img src="img/foto.jpeg" alt="Foto profil mahasiswa" width="200">
        </section>

        <section id="about">
            <h2>Tentang Saya</h2>
            <article>
                <h3>Profil Singkat</h3>
                <p>Program Studi: <?php echo $namaProdi . " (" . $programStudi . ")"; ?></p>
                <p>Fokus program studi: <?php echo $fokusProgramStudi; ?></p>
                <p>Status mahasiswa: <?php echo $statusAktif ? "Aktif" : "Tidak aktif"; ?></p>
                <p>Semester: <?php echo $semester . " (" . $keteranganSemester . ")"; ?></p>
                <p>Sisa semester hingga batas: <?php echo $sisaSemester; ?></p>
                <p>Pemeriksaan rentang semester: <?php echo $statusSemester; ?></p>
                <p>IPK: <?php echo number_format($ipk, 2, ',', '.'); ?></p>
                <p>Catatan tambahan: <?php echo $catatanTambahan === null ? "Belum ada" : $catatanTambahan; ?></p>
                <p>Nama saya adalah <strong>Cantika</strong>. Saya adalah mahasiswa Program Studi Teknik Informatika di Institut Sains dan Bisnis Atma Luhur. Saat ini saya sedang mempelajari dasar-dasar pemrograman web, khususnya HTML5 dan struktur semantik.</p>
                
                <h3>Target Belajar (Perulangan for)</h3>
                <ol>
                    <?php
                    for ($i = 1; $i <= 5; $i++) {
                        echo "<li>Target belajar ke-" . $i . ": ";
                        switch ($i) {
                            case 1: echo "Memahami sintaks dasar PHP."; break;
                            case 2: echo "Menggunakan variabel dan konstanta."; break;
                            case 3: echo "Menerapkan operator dan percabangan."; break;
                            case 4: echo "Menggunakan perulangan for dan while."; break;
                            default: echo "Belum dipetakan"; break;
                        }
                        echo "</li>";
                    }
                    ?>
                </ol>
                <h3>Semester (Perulangan while):</h3>
                <ol>
                    <?php
                    $nomorSemester = 1;
                    while ($nomorSemester <= 3) { echo "<li>Semester " . $nomorSemester . "</li>"; $nomorSemester++; }
                    ?>
                </ol>
            </article>
        </section>

        <section id="contact">
            <h2>Kontak</h2>
            <p>Kunjungi <a href="https://github.com/<?= PROFIL_GITHUB ?>" target="_blank" rel="noopener noreferrer">profil GitHub saya</a>.</p>

            <?php if ($successMessage): ?>
                <div style="background-color: #d4edda; color: #155724; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
                    <?= htmlspecialchars($successMessage, ENT_QUOTES, 'UTF-8') ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($errors)): ?>
                <div style="background-color: #f8d7da; color: #721c24; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        <?php foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form id="contactForm" action="index.php" method="post" novalidate>
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label><br>
                    <input class="input-form" type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" minlength="3" maxlength="50" value="<?= htmlspecialchars($old['nama'], ENT_QUOTES, 'UTF-8') ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label><br>
                    <input class="input-form" type="email" id="email" name="email" placeholder="nama@email.com" value="<?= htmlspecialchars($old['email'], ENT_QUOTES, 'UTF-8') ?>" required>
                </div>
                <div class="form-group">
                    <label for="semester">Semester</label><br>
                    <input class="input-form" type="number" id="semester" name="semester" min="1" max="14" value="<?= htmlspecialchars($old['semester'], ENT_QUOTES, 'UTF-8') ?>" required>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal Kunjungan</label><br>
                    <input class="input-form" type="date" id="tanggal" name="tanggal" value="<?= htmlspecialchars($old['tanggal'], ENT_QUOTES, 'UTF-8') ?>" required>
                </div>
                <div class="form-group">
                    <p>Jenis Pesan</p>
                    <input type="radio" id="pertanyaan" name="jenis_pesan" value="pertanyaan" <?= ($old['jenis_pesan'] === 'pertanyaan') ? 'checked' : '' ?> required>
                    <label for="pertanyaan">Pertanyaan</label>
                    <input type="radio" id="saran" name="jenis_pesan" value="saran" <?= ($old['jenis_pesan'] === 'saran') ? 'checked' : '' ?>>
                    <label for="saran">Saran</label>
                </div>
                <div class="form-group">
                    <p>Topik yang Diminati</p>
                    <input type="checkbox" id="minat-html" name="minat" value="HTML" <?= ($old['minat'] === 'HTML') ? 'checked' : '' ?>>
                    <label for="minat-html">HTML</label>
                    <input type="checkbox" id="minat-css" name="minat" value="CSS" <?= ($old['minat'] === 'CSS') ? 'checked' : '' ?>>
                    <label for="minat-css">CSS</label>
                </div>
                <div class="form-group">
                    <label for="prodi">Program Studi</label><br>
                    <select class="input-form" id="prodi" name="prodi" required>
                        <option value="">-- Pilih Program Studi --</option>
                        <option value="SI" <?= ($old['prodi'] === 'SI') ? 'selected' : '' ?>>Sistem Informasi</option>
                        <option value="TI" <?= ($old['prodi'] === 'TI') ? 'selected' : '' ?>>Teknik Informatika</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pesan">Pesan</label><br>
                    <textarea class="input-form" id="pesan" name="pesan" maxlength="300" placeholder="Tulis pesan Anda" required><?= htmlspecialchars($old['pesan'], ENT_QUOTES, 'UTF-8') ?></textarea>
                </div>
                <p id="formFeedback"></p>
                <button type="submit">Kirim</button>
                <button type="reset">Batal</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; <?= date("Y") ?> <?php echo $namaMahasiswa; ?> [<?= $nim ?>]</p>
        <p>Pemrograman Web Dasar - Pertemuan 7</p>
    </footer>
    <script src="script.js"></script>
</body>
</html>