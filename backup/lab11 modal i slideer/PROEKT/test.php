<div class="post">
    <?php if ($userInfo): ?>
        <div class="post__user">
            <div class="post__userinfo">
                <img class="post__userimg" src="<?= htmlspecialchars($userInfo['avatar']) ?>" alt="Аватар">
                <span class="post__username"><?= htmlspecialchars($userInfo['full_name']) ?></span>
            </div>
            <img class="post__edit" src="./icons/edit.svg" alt="Иконка действия">
        </div>
    <?php endif; ?>
    
    <!-- Изображение поста -->
    <div class="post__slider">
        <div class="post__image-container">
            <?php if (!empty($post['image_path'])): ?>
                <img class="post__image" src="<?= htmlspecialchars($post['image_path']) ?>" alt="Фото поста">
                <div class="post__indicator">
                    <span class="post__indicator-text">1/3</span>
                </div>
            <?php endif; ?>
        </div>
        <img class="slider-icon slider-icon--left" src="./icons/left-slider.svg" alt="Предыдущее" role="presentation">
        <img class="slider-icon slider-icon--right" src="./icons/right-slider.svg" alt="Следующее" role="presentation">
    </div>
    
    <div class="post__content-footer">
    <div class="post__reaction">
        <img src="./icons/like.png" alt="Лайк" width="16" height="16">
        <span><?= isset($post['likes']) ? (int)$post['likes'] : 0 ?></span>
    </div>
    
    <?php if (!empty($post['description'])): ?>
        <p class="post__comment"><?= htmlspecialchars($post['description']) ?></p>
        <span class="post__more">ещё</span>
    <?php endif; ?>
    
    <p class="post__timestamp">Опубликовано: <?php displayTimeAgo($post['created_at']); ?></p>
</div>
</div>