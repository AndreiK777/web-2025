<?php
function isExistUser(int $userId) {
    $users = json_decode(file_get_contents(__DIR__ . '/../users.json'), true);
    if ($users === null) return null;

    foreach ($users as $user) {
        if ($user['id'] == $userId) {
            return validateUser($user) ? $user : null;
        }
    }
}

// if (validateUser($user) !== true) {
//     echo "<p>Ошибка в данных пользователя: " . validateUser($user) . "</p>";
//     exit; 
// }

function getUserPosts(int $userId): array {
    $profilePosts = json_decode(file_get_contents(__DIR__ . '/../profile_posts.json'), true);

    // Находим все посты пользователя
    $userPosts = [];
    foreach ($profilePosts as $post) {
        if ($post['user_id'] == $userId) {
            $userPosts[] = $post;
        }
    }

    /*$validPosts = [];
    foreach ($userPosts as $post) {
        $postValidationResult = validatePost($post);
        if ($postValidationResult !== true) {
            echo "<p>Ошибка в данных постов: " . $postValidationResult . "</p>";
            continue;
        }
        $validPosts[] = $post;
    }*/
    return $userPosts;
}

function getPosts(?int $userId = null): array {
    $posts = json_decode(file_get_contents(__DIR__ . '/../posts.json'), true) ?? [];

    if ($userId === null) {
        return $posts; // Если userId не указан, возвращаем все посты
    }
    
    // Фильтруем посты для конкретного пользователя
    $filteredPosts = [];
    foreach ($posts as $post) {
        if (($post['user_id'] ?? null) == $userId) {
            $filteredPosts[] = $post;
        }
    }
    
    return $filteredPosts;
}

function selectUsers(?int $selectedUserId = null): void {
    // Загружаем список пользователей
    $users = json_decode(file_get_contents(__DIR__ . '/../users.json'), true);

    foreach ($users as $user) {
        // Проверяем, нужно ли поставить атрибут 'selected' для этого пользователя
        $isSelected = ($user['id'] == $selectedUserId) ? 'selected' : '';  
        echo "<option value='{$user['id']}' $isSelected>{$user['name']}</option>";
    }
}

function displayTimeAgo($postTimestamp) {
    // Разница во времени в секундах
    $timeDifference = time() - $postTimestamp;

    // Вычисляем количество дней, часов и минут
    $days = floor($timeDifference / 86400); // 86400 секунд в одном дне
    $hours = floor(($timeDifference % 86400) / 3600); // Оставшиеся часы
    $minutes = floor(($timeDifference % 3600) / 60); // Оставшиеся минуты

    // В зависимости от разницы во времени выводим нужное сообщение
    if ($days > 0) {
        echo "{$days} дней назад";
    } elseif ($hours > 0) {
        echo "{$hours} часов назад";
    } elseif ($minutes > 0) {
        echo "{$minutes} минут назад";
    } else {
        echo "Только что";
    }
}

function displayPostImages(array $userPosts): void {
    foreach ($userPosts as $post): 
        foreach ($post['images'] as $image): ?>
            <img src="<?= $image ?>" alt="Фото из поста">
        <?php endforeach; 
    endforeach;
}

function displayPosts(array $allPosts, ?int $selectedUserId = null): void {
    foreach ($allPosts as $post) {
        // Если выбран пользователь и пост не принадлежит ему - пропускаем
        if ($selectedUserId !== null && $post['user_id'] != $selectedUserId) {
            continue;
        }
        
        // Проверяем, существует ли пользователь для этого поста
        $user = isExistUser($post['user_id']);
        if ($user) {
            include('post_template.php');  // Отображаем пост с помощью шаблона
        } else {
            echo "Пользователь для поста не найден.<br>";  // Отладка: если пользователь не найден
        }
    }
}
?>
