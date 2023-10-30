// Fungsi untuk mengganti mode gelap
function toggleDarkMode() {
    const body = document.body;
    const isDarkMode = body.getAttribute("data-bs-theme") === "dark";
    const darkModeToggle = document.getElementById("darkModeToggle");
    const iconSun = darkModeToggle.querySelector(".fa-sun");
    const iconMoon = darkModeToggle.querySelector(".fa-moon");

    // Mengganti atribut data-bs-theme
    if (isDarkMode) {
        body.setAttribute("data-bs-theme", "light");
        iconSun.style.display = "inline";
        iconMoon.style.display = "none";
    } else {
        body.setAttribute("data-bs-theme", "dark");
        iconSun.style.display = "none";
        iconMoon.style.display = "inline";
    }

    // Menyimpan preferensi mode gelap ke local storage
    localStorage.setItem("darkMode", isDarkMode ? "light" : "dark");
}

// Mengambil preferensi mode gelap dari local storage
const storedDarkMode = localStorage.getItem("darkMode");
if (storedDarkMode) {
    const body = document.body;
    body.setAttribute("data-bs-theme", storedDarkMode);
    const darkModeToggle = document.getElementById("darkModeToggle");
    const iconSun = darkModeToggle.querySelector(".fa-sun");
    const iconMoon = darkModeToggle.querySelector(".fa-moon");

    if (storedDarkMode === "dark") {
        iconSun.style.display = "none";
        iconMoon.style.display = "inline";
    } else {
        iconSun.style.display = "inline";
        iconMoon.style.display = "none";
    }
}

// Menambahkan event click ke tombol mode gelap
const darkModeToggle = document.getElementById("darkModeToggle");
if (darkModeToggle) {
    darkModeToggle.addEventListener("click", toggleDarkMode);
}

// Fungsi untuk mengubah toggler
document.querySelector('.navbar-toggler').addEventListener('click', function() {
    const navbar = document.querySelector('.navbar');
    if (navbar.classList.contains('show')) {
        navbar.classList.remove('show');
    } else {
        navbar.classList.add('show');
    }
});

// Fungsi untuk menambahkan 'show' jika layar besar
function toggleNavbarOnResize() {
    const navbar = document.querySelector('.navbar-nav');
    const windowWidth = window.innerWidth;

    if (windowWidth >= 768) { // Ganti angka ini sesuai dengan ukuran layar besar yang Anda inginkan
        navbar.classList.add('show');
    } else {
        navbar.classList.remove('show');
    }
}

// Panggil fungsi saat halaman dimuat dan saat ukuran jendela berubah
window.addEventListener('load', toggleNavbarOnResize);
window.addEventListener('resize', toggleNavbarOnResize);


const toggler = document.querySelectorAll('.navbar-toggler');

// Menambahkan event listener untuk mengubah warna border saat dihover
toggler.forEach(element => {
    element.addEventListener('mouseenter', () => {
        if (document.body.dataset.bs-theme === 'dark') {
            element.style.borderColor = "#007BFF"; // Warna border saat dihover dalam mode gelap
        } else {
            element.style.borderColor = "#007BFF"; // Warna border saat dihover dalam mode terang
        }
    });

    element.addEventListener('mouseleave', () => {
        if (document.body.dataset.bs-theme === 'dark') {
            element.style.borderColor = "#FFF"; // Kembalikan ke warna border mode gelap
        } else {
            element.style.borderColor = "#000"; // Kembalikan ke warna border mode terang
        }
    });
});
