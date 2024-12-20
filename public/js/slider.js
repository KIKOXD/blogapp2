document.addEventListener('DOMContentLoaded', () => {
    let currentIndex = 0;
    const slides = document.querySelectorAll('.slide');
    const totalSlides = slides.length;

    function showNextSlide() {
        slides.forEach((slide) => slide.classList.remove('active'));
        slides[currentIndex].classList.add('active');
        currentIndex = (currentIndex + 1) % totalSlides;
    }

    setInterval(showNextSlide, 3000);
    slides[currentIndex].classList.add('active'); // Tampilkan slide pertama
});
