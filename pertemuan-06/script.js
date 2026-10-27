const navToggle = document.getElementById("navToggle");
const navMenu = document.getElementById("navMenu");

navToggle.addEventListener("click", () => {
    const isOpen = navMenu.classList.toggle("nav-open");

    navToggle.setAttribute("aria-expanded", isOpen);

    if (isOpen) {
        navToggle.setAttribute("aria-label", "Tutup navigasi");
    } else {
        navToggle.setAttribute("aria-label", "Buka navigasi");
    }
});

const contactForm = document.getElementById("contactForm");
const formFeedback = document.getElementById("formFeedback");
const namaInput = document.getElementById("nama");
const emailInput = document.getElementById("email");
const semesterInput = document.getElementById("semester");
const tanggalInput = document.getElementById("tanggal");
const prodiInput = document.getElementById("prodi");
const pesanInput = document.getElementById("pesan");

const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

function showError(message) {
    formFeedback.className = "form-feedback-error";
    formFeedback.textContent = message;
}

contactForm.addEventListener("submit", (event) => {
    event.preventDefault();

    const nama = namaInput.value.trim();
    const email = emailInput.value.trim();
    const semester = Number(semesterInput.value);
    const tanggal = tanggalInput.value;
    const jenisPesan = document.querySelector('input[name="jenis_pesan"]:checked');
    const topikDipilih = document.querySelectorAll('input[name="minat"]:checked');
    const prodi = prodiInput.value;
    const pesan = pesanInput.value.trim();

    if (nama.length < 3 || nama.length > 50) {
        showError("Nama lengkap harus diisi 3 sampai 50 karakter.");
        return;
    }

    if (!emailPattern.test(email)) {
        showError("Masukkan alamat email yang valid.");
        return;
    }

    if (semesterInput.value === "" || semester < 1 || semester > 14) {
        showError("Semester harus diisi dengan angka 1 sampai 14.");
        return;
    }

    if (tanggal === "") {
        showError("Tanggal kunjungan harus diisi.");
        return;
    }

    if (!jenisPesan) {
        showError("Pilih jenis pesan.");
        return;
    }

    if (topikDipilih.length === 0) {
        showError("Pilih minimal satu topik yang diminati.");
        return;
    }

    if (prodi === "") {
        showError("Pilih program studi.");
        return;
    }

    if (pesan.length === 0) {
        showError("Pesan harus diisi.");
        return;
    }

    if (pesan.length > 300) {
        showError("Pesan maksimal 300 karakter.");
        return;
    }

    formFeedback.className = "form-feedback-success";
    formFeedback.textContent = "Form berhasil divalidasi.";
});

contactForm.addEventListener("input", () => {
    formFeedback.textContent = "";
});

contactForm.addEventListener("reset", () => {
    formFeedback.textContent = "";
});