document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('modal-container');
    const modalImg = modal.querySelector('.modal-image');
    const counter = modal.querySelector('.modal-counter');
    const closeBtn = modal.querySelector('.modal-close');
    const modalContent = modal.querySelector('.modal-content');

    let currentIndex = 0;
    let images = [];
    let navButtons = { prev: null, next: null };

    const updateModal = () => {
        modalImg.src = images[currentIndex];
        if (counter) counter.textContent = (currentIndex + 1) + " из " + images.length;
    };

    // Вешаем обработчик только на .post__image
    document.querySelectorAll('.post__image').forEach(image => {
        image.addEventListener('click', (e) => {
            const post = e.target.closest('.post');
            const imageElements = post.querySelectorAll('.post__image');
            images = Array.from(imageElements, img => img.src);
            currentIndex = Array.from(imageElements).indexOf(e.target);
            
            // Переносим кнопки
            navButtons.prev = post.querySelector('.slider-icon--left');
            navButtons.next = post.querySelector('.slider-icon--right');
            
            if (images.length > 1) {
                modalContent.append(navButtons.prev, navButtons.next);
                
                navButtons.prev.onclick = () => {
                    currentIndex = (currentIndex - 1 + images.length) % images.length;
                    updateModal();
                };
                
                navButtons.next.onclick = () => {
                    currentIndex = (currentIndex + 1) % images.length;
                    updateModal();
                };
            }
            
            updateModal();
            modal.classList.add('is-open');
        });
    });

    const closeModal = () => {
        // Возвращаем кнопки на место
        if (navButtons.prev && navButtons.next) {
            const slider = document.querySelector('.post__slider');
            slider.querySelector('.post__image-container').append(navButtons.prev, navButtons.next);
        }
        modal.classList.remove('is-open');
    };

    closeBtn.addEventListener('click', closeModal);
});