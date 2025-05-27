document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.post__slider').forEach(slider => {
        const images = slider.querySelectorAll('.post__image');
        const prevBtn = slider.querySelector('.slider-icon_left');
        const nextBtn = slider.querySelector('.slider-icon_right');
        const counter = slider.querySelector('.post__indicator-text');

        if (images.length > 1) {
            initSlider({ slider, images, prevBtn, nextBtn, counter });
        }
    });
});

function initSlider({ images, prevBtn, nextBtn, counter }) {
    let currentIndex = 0;
    
    const updateSlider = () => {
        images.forEach(img => img.classList.remove('active'));
        images[currentIndex].classList.add('active');
        if (counter) {
            counter.textContent = (currentIndex + 1) + "/" + images.length;
        }
    };

    const goToPrev = () => {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        updateSlider();
    };

    const goToNext = () => {
        currentIndex = (currentIndex + 1) % images.length;
        updateSlider();
    };

    prevBtn.addEventListener('click', goToPrev);
    nextBtn.addEventListener('click', goToNext);
    
    // Инициализация первого состояния
    updateSlider();
}