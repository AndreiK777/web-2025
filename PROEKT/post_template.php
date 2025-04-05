<div class="user">
    <img src="<?= $user['avatar'] ?>" alt="фото профиля">
    <span><?= $user['name'] ?></span>
</div>

<!-- Изображения поста (если они есть) -->
<?php foreach ($post['images'] as $image): ?>
    <img class="home_photo" src="<?= $image ?>" alt="фотография поста">
<?php endforeach; ?>

<!-- Лайки и описание поста -->
<div class="reaction">
    <img src="./icons/like.png" alt="лайк">
    <span><?= isset($post['likes']) ? $post['likes'] : 0 ?></span>
</div>

<div>
    <p class="comment"><?= isset($post['description']) ? $post['description'] : 'Нет описания' ?></p>
    <button>еще</button>
    <small>
        <?php displayTimeAgo($post['timestamp']); ?>
    </small>
</div>
<br>
