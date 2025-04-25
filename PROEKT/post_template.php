<div class="post">
    <?php if ($userInfo): ?>
    <div class="post__user">
        <img src="<?= htmlspecialchars($userInfo['avatar']) ?>" alt="Аватар">
        <span class="post__user-name"><?= htmlspecialchars($userInfo['full_name']) ?></span>
    </div>
    <?php endif; ?>
    
    <!-- Изображение поста -->
    <?php if (!empty($post['image_path'])): ?>
    <img class="post__image" src="<?= htmlspecialchars($post['image_path']) ?>" alt="Фото поста">
    <?php endif; ?>
    
    <?php if (!empty($post['title'])): ?>
    <h2 class="post__title"><?= htmlspecialchars($post['title']) ?></h2>
    <?php endif; ?>
    
    <div class="post__reaction">
        <img src="./icons/like.png" alt="Лайк" width="16" height="16">
        <span><?= isset($post['likes']) ? (int)$post['likes'] : 0 ?></span>
    </div>
    
    <?php if (!empty($post['description'])): ?>
    <p class="post__comment"><?= htmlspecialchars($post['description']) ?></p>
    <?php endif; ?>
    
    <p class="post__timestamp">Опубликовано: <?php displayTimeAgo($post['created_at']); ?></p>
</div>