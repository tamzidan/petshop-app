import './bootstrap';
import Alpine from 'alpinejs';
import 'swiper/css'; // Import CSS dasar Swiper
import Swiper from 'swiper/bundle'; // Import Swiper bundle (termasuk semua modul)

// Inisialisasi Swiper setelah halaman dimuat
window.addEventListener('DOMContentLoaded', (event) => {
    const swiper = new Swiper('.swiper', {
        // Opsi
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
});

window.Alpine = Alpine;

Alpine.start();
