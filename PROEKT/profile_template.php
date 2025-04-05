<div class="profile">
    <!-- Аватар и имя пользователя -->
    <img src="<?= $user['avatar'] ?>" alt="Аватар">
    <h2>
        <?= $user['name'] ?>
    </h2>
    <p>
        <?= $user['bio'] ?>
    </p>

    <!-- Количество постов -->
    <div>
        <button>
            <img src="./icons/post.svg" alt="Посты">
        </button>
        <span>
            <?= $user['post_count'] ?> постов
        </span>
    </div>

    <!-- Отображение постов пользователя -->
    <div class="post_photos">
      <?php displayPostImages($userPosts)?>
   </div> 
</div>
