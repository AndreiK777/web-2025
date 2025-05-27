<div class="profile">
    <div class="profile__header">
        <div class="profile__avatar">
            <?php if (!empty($user['avatar'])): ?>
                <img class="profile__avatar-img" src="<?= htmlspecialchars($user['avatar']) ?>" alt="Аватар">
            <?php endif; ?>
        </div>
        
        <h1 class="profile__name"><?= htmlspecialchars($user['full_name']) ?></h1>
        
        <?php if (!empty($user['bio'])): ?>
            <p class="profile__bio"><?= htmlspecialchars($user['bio']) ?></p>
        <?php endif; ?>
        
        <div class="profile__stats">
            <span class="profile__stats-count">Постов: <?= $user['number_posts'] ?? 0 ?></span>
        </div>
    </div>

    <div class="profile__posts">
        <?php
        $userPosts = getPosts($userId);
        
        if (!empty($userPosts)) {
            foreach ($userPosts as $post):
                if (!empty($post['image_path'])): ?>
                    <div class="profile__post">
                        <img class="profile__post-img" src="<?= htmlspecialchars($post['image_path']) ?>" alt="Пост">
                    </div>
                <?php endif;
            endforeach;
        } else {
            echo "<p class='profile__empty'>У пользователя пока нет постов</p>";
        }
        ?>
    </div>
</div>