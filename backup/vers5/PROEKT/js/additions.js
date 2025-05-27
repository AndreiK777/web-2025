document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.post__description').forEach(desc => {
        const post = desc.closest('.post'); 
        const moreBtn = post.querySelector('.post__more'); 
        
        if (!moreBtn) return; 
        
        if (desc.scrollHeight <= parseInt(getComputedStyle(desc).lineHeight) * 2) {
            moreBtn.style.display = 'none';
            return;
        }
        
        moreBtn.addEventListener('click', function() {
            desc.classList.toggle('expanded');
            this.textContent = desc.classList.contains('expanded') ? 'свернуть' : 'ещё';
        });
    });
});