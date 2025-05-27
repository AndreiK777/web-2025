document.addEventListener('DOMContentLoaded', () => {
    // Элементы модального окна
    const modal = document.getElementById('modal-container');
    const modalImg = modal.querySelector('.modal-image');
    const counter = modal.querySelector('.modal-counter');
    const closeBtn = modal.querySelector('.modal-close');
    const modalContent = modal.querySelector('.modal-content');

    // Состояние слайдера
    let currentIndex = 0;
    let images = [];
    let navButtons = { prev: null, next: null };

    // Обновление модального окна (аналогично updateSlider)
    const updateModal = () => {
        modalImg.src = images[currentIndex];
        if (counter) counter.textContent = (currentIndex + 1) + "/" + images.length;
    };

    // Открытие модального окна
    document.addEventListener('click', (e) => {
        if (!e.target.classList.contains('post__image')) return;
        
        const post = e.target.closest('.post');
        const imageElements = post.querySelectorAll('.post__image');
        images = Array.from(imageElements, img => img.src);
        currentIndex = Array.from(imageElements).indexOf(e.target);
        
        // Переносим кнопки навигации
        navButtons.prev = post.querySelector('.slider-icon--left');
        navButtons.next = post.querySelector('.slider-icon--right');
        
        if (images.length > 1) {
            modalContent.append(navButtons.prev, navButtons.next);
            
            // Реализация навигации в вашем стиле
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
        modal.style.display = 'flex';
    });

    // Закрытие модального окна
    const closeModal = () => {
        // Возвращаем кнопки на место
        if (navButtons.prev && navButtons.next) {
            const slider = document.querySelector('.post__slider');
            slider.querySelector('.post__image-container').append(navButtons.prev, navButtons.next);
        }
        modal.style.display = 'none';
    };

    closeBtn.addEventListener('click', closeModal);
});