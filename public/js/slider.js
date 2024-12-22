document.addEventListener('DOMContentLoaded', () => {
    let currentIndex = 0;
    const slides = document.querySelectorAll('.slider-image');
    const totalSlides = slides.length;

    // Sembunyikan semua slide kecuali yang pertama
    slides.forEach((slide, index) => {
        if (index !== 0) {
            slide.style.display = 'none';
        }
    });

    function showNextSlide() {
        // Sembunyikan slide saat ini
        slides[currentIndex].style.display = 'none';

        // Update index ke slide berikutnya
        currentIndex = (currentIndex + 1) % totalSlides;

        // Tampilkan slide berikutnya
        slides[currentIndex].style.display = 'block';
    }

    // Jalankan slider setiap 3 detik
    setInterval(showNextSlide, 3000);
});
