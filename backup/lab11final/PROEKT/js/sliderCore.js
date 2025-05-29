export function initSlider(images, prevBtn, nextBtn, counter) {
    if (images.length <= 1) return; 

    let currentIndex = 0;

    const updateSlider = () => {
        images.forEach((img, i) => {
            img.classList.toggle('active', i === currentIndex);
        });
        if (counter) {
            counter.textContent = `${currentIndex + 1}/${images.length}`;
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

    updateSlider(); 
}