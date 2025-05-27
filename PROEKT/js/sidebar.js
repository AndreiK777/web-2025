document.addEventListener('DOMContentLoaded', function() {
    const sidebars = document.querySelectorAll('.sidebar');
    sidebars.forEach(sidebar => {
        const plusIcon = sidebar.querySelector('.sidebar__icon[src*="plus.svg"]');
        if (plusIcon) {
            plusIcon.addEventListener('click', function() {
                window.location.href = 'post.php';
            });
        }
    });
});