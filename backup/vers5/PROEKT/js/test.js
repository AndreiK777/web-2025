document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.post__slider').forEach(slider => {
      const images = slider.querySelectorAll('.post__image');
      const counter = slider.querySelector('.post__indicator-text');
  
      let navButtons = { prev: null, next: null };

      navButtons.prev = post.querySelector('.slider-icon--left');
      navButtons.next = post.querySelector('.slider-icon--right');
      
      if (images.length <= 1) {
        navButtons.prev.remove();
        navButtons.next.remove();
        slider.querySelector('.post__indicator').remove();
        return;
      }
  
      let currentIndex = 0;
      
      const updateSlider = () => {
        images.forEach(img => img.style.display = 'none');
        images[currentIndex].style.display = 'block';
        if (counter) counter.textContent = (currentIndex + 1) + "/" + images.length;
      };
  
      navButtons.prev.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        updateSlider();
      });
  
      navButtons.next.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % images.length;
        updateSlider();
      });
      
      updateSlider();
    });
  });