document.addEventListener('DOMContentLoaded', () => {
    let currentIndex = 0;
    const slides = document.querySelectorAll('.slide');
    const totalSlides = slides.length;

    console.log('Total Slides:', totalSlides);

    function showNextSlide() {
        slides.forEach((slide, index) => {
            slide.classList.remove('active');
            console.log('Removing active from:', index);
        });

        slides[currentIndex].classList.add('active');
        console.log('Adding active to:', currentIndex);

        currentIndex = (currentIndex + 1) % totalSlides;
    }

    setInterval(showNextSlide, 3000);
});
