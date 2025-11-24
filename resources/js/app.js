import './bootstrap';
const html = document.documentElement;
const iconLight = document.getElementById('icon-light');
const iconDark = document.getElementById('icon-dark');

const theme = localStorage.getItem('theme');

// Kalau belum ada theme di localStorage, set default light
if (!theme) {
    localStorage.setItem('theme', 'light');
}

// Saat halaman load
if (localStorage.getItem('theme') === 'dark') {
    html.classList.add('dark');
    iconLight.classList.remove('hidden');
    iconDark.classList.add('hidden');
} else {
    html.classList.remove('dark');
    iconDark.classList.remove('hidden');
    iconLight.classList.add('hidden');
}

// Klik Matahari = pindah light
iconLight.addEventListener('click', () => {
    html.classList.remove('dark');
    localStorage.setItem('theme', 'light');

    iconLight.classList.add('hidden');
    iconDark.classList.remove('hidden');
});

// Klik Bulan = pindah dark
iconDark.addEventListener('click', () => {
    html.classList.add('dark');
    localStorage.setItem('theme', 'dark');

    iconDark.classList.add('hidden');
    iconLight.classList.remove('hidden');
});
