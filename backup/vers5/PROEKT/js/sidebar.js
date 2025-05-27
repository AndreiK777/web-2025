document.addEventListener('DOMContentLoaded', function() {
    // Находим все сайдбары на странице
    const sidebars = document.querySelectorAll('.sidebar');
    
    // Для каждого сайдбара (на случай, если их несколько)
    sidebars.forEach(sidebar => {
        // Находим иконку плюса в текущем сайдбаре
        const plusIcon = sidebar.querySelector('.sidebar__icon[src*="plus.svg"]');
        
        // Добавляем обработчик клика
        if (plusIcon) {
            plusIcon.addEventListener('click', function() {
                // Переходим на страницу post.php
                window.location.href = 'post.php';
            });
            
            // Добавляем стиль курсора для интерактивности
            plusIcon.style.cursor = 'pointer';
        }
    });
});