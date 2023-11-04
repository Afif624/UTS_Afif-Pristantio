// Mode gelap
function toggleDarkMode() {
    const body = document.body;
    const isDarkMode = body.getAttribute("data-bs-theme") === "dark";
    const darkModeToggle = document.getElementById("darkModeToggle");
    const iconSun = darkModeToggle.querySelector(".fa-sun");
    const iconMoon = darkModeToggle.querySelector(".fa-moon");

    if (isDarkMode) {
        body.setAttribute("data-bs-theme", "light");
        iconSun.style.display = "inline";
        iconMoon.style.display = "none";
    } else {
        body.setAttribute("data-bs-theme", "dark");
        iconSun.style.display = "none";
        iconMoon.style.display = "inline";
    }

    localStorage.setItem("darkMode", isDarkMode ? "light" : "dark");
}

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

const darkModeToggle = document.getElementById("darkModeToggle");
if (darkModeToggle) {
    darkModeToggle.addEventListener("click", toggleDarkMode);
}

// Show/Remove Navbar saat layar kecil
document.querySelector('.navbar-toggler').addEventListener('click', function() {
    const navbar = document.querySelector('.navbar');
    if (navbar.classList.contains('show')) {
        navbar.classList.remove('show');
    } else {
        navbar.classList.add('show');
    }
});

// Show Navbar jika layar besar
function toggleNavbarOnResize() {
    const navbar = document.querySelector('.navbar-nav');
    const windowWidth = window.innerWidth;

    if (windowWidth >= 768) {
        navbar.classList.add('show');
    } else {
        navbar.classList.remove('show');
    }
}

// Panggil fungsi Navbar
window.addEventListener('load', toggleNavbarOnResize);
window.addEventListener('resize', toggleNavbarOnResize);
