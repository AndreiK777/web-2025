<div class="post">
    <?php if ($userInfo): ?>
    <div class='user'>
        <img src='<?= htmlspecialchars($userInfo['avatar']) ?>' alt='Аватар'>
        <span class='user-name'><?= htmlspecialchars($userInfo['full_name']) ?></span>
    </div>
    <?php endif; ?>
    
    <img class='home_photo' src='<?= htmlspecialchars($post['image_path']) ?>' alt='Фото поста'>
    <h2><?= htmlspecialchars($post['title']) ?></h2>
    <div class='reaction'>
        <img src='./icons/like.png' alt='лайк'>
        <span><?= isset($post['likes']) ? (int)$post['likes'] : 0 ?></span>
    </div>
    <p class='comment'><?= htmlspecialchars($post['description']) ?></p>
    
    <p><small>Опубликовано: <?php displayTimeAgo($post['created_at']); ?></small></p>
</div>