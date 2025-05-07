<div class="post">
    <?php if ($userInfo): ?>
        <div class="post__user">
            <div class="post__userinfo">
                <img class="post__userimg" src="<?= htmlspecialchars($userInfo['avatar'] ?? 'default_avatar.jpg') ?>" alt="Аватар">
                <span class="post__username"><?= htmlspecialchars($userInfo['full_name']) ?></span>
            </div>
            <img class="post__edit" src="./icons/edit.svg" alt="Иконка действия">
        </div>
    <?php endif; ?>
    
    <div class="post__content">
        <div class="post__slider">
            <div class="post__image-container">
                <?php if (!empty($post['images'])): ?>
                    <?php foreach ($post['images'] as $index => $image): ?>
                        <img class="post__image" 
                             src="<?= htmlspecialchars($image) ?>" 
                             alt="Фото поста"
                             style="display: <?= $index === 0 ? 'block' : 'none' ?>">
                    <?php endforeach; ?>
                    
                    <?php if (count($post['images']) > 1): ?>
                        <div class="post__indicator">
                            <span class="post__indicator-text">1/<?= count($post['images']) ?></span>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            
            <?php if (count($post['images'] ?? []) > 1): ?>
                <img class="slider-icon slider-icon--left" src="./icons/left-slider.svg" alt="Предыдущее">
                <img class="slider-icon slider-icon--right" src="./icons/right-slider.svg" alt="Следующее">
            <?php endif; ?>
        </div>
        
        <div class="post__footer">
            <div class="post__reaction">
                <img src="./icons/like.png" alt="Лайк">
                <span><?= $post['likes'] ?? 0 ?></span>
            </div>
            
            <?php if (!empty($post['description'])): ?>
                <p class="post__comment"><?= htmlspecialchars($post['description']) ?></p>
                <span class="post__more">ещё</span>
            <?php endif; ?>
            
            <p class="post__timestamp">Опубликовано: <?php displayTimeAgo($post['created_at']) ?></p>
        </div>
    </div>
</div>