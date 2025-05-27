document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.post__slider').forEach(slider => {
    const images = slider.querySelectorAll('.post__image');
    const prevBtn = slider.querySelector('.slider-icon--left');
    const nextBtn = slider.querySelector('.slider-icon--right');
    const counter = slider.querySelector('.post__indicator-text');
    
    if (images.length <= 1) {
      prevBtn.remove();
      nextBtn.remove();
      slider.querySelector('.post__indicator').remove();
      return;
    }

    let currentIndex = 0;
    
    const updateSlider = () => {
      images.forEach(img => img.style.display = 'none');
      images[currentIndex].style.display = 'block';
      if (counter) counter.textContent = (currentIndex + 1) + "/" + images.length;
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
  });
});