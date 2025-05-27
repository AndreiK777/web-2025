document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.post__slider').forEach(slider => {
        const images = slider.querySelectorAll('.post__image');
        const prevBtn = slider.querySelector('.slider-icon_left');
        const nextBtn = slider.querySelector('.slider-icon_right');
        const counter = slider.querySelector('.post__indicator-text');

        if (images.length > 1) {
            let currentIndex = 0;
            
            const updateSlider = () => {
                images.forEach(img => img.classList.remove('active'));
                images[currentIndex].classList.add('active');
                if (counter) {
                    counter.textContent = (currentIndex + 1) + "/" + images.length;
                }
            };

            prevBtn.addEventListener('click', () => {
                currentIndex = (currentIndex - 1 + images.length) % images.length;
                updateSlider();
            });

            nextBtn.addEventListener('click', () => {
                currentIndex = (currentIndex + 1) % images.length;
                updateSlider();
            });
        }
    });
});