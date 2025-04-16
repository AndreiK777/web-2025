<?php


function connectionDatabase(): PDO {
    $dsn = "mysql:host=localhost;dbname=blog"; 
    $username = "root";   // имя пользователя MySQL
    $password = "";   // пароль MySQL
    
    return new PDO($dsn, $username, $password);
    }

function selectUsers(?int $selectedUserId = null): void {
    
        $conn = connectionDatabase();
        
        // запрос для получения всех пользователей
        $query = "SELECT id, full_name FROM users";
        

        if ($selectedUserId !== null) {
            $query .= " WHERE id = :user_id";  // фильтрация по id пользователя
        }
    
        $stmt = $conn->prepare($query);
        
        // привязываем параметр
        if ($selectedUserId !== null) {
            $stmt->bindParam(':user_id', $selectedUserId, PDO::PARAM_INT);
        }
    
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($users as $user) {
            $isSelected = ($user['id'] == $selectedUserId) ? 'selected' : '';  
            echo "<option value='{$user['id']}' $isSelected>{$user['full_name']}</option>";
        }
    }

function getUsersInfo(array $userIds): array {
    if (empty($userIds)) {
        return [];
    }

    $conn = connectionDatabase();
    
    // получение данных 
    $query = "SELECT id, full_name, avatar FROM users WHERE id IN (" . implode(',', array_fill(0, count($userIds), '?')) . ")";
    
    $stmt = $conn->prepare($query);
    $stmt->execute($userIds);
    
    // данные о пользователях
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $usersInfo = [];
    foreach ($users as $user) {
        $usersInfo[$user['id']] = $user;
    }

    return $usersInfo;
}

function getPosts(?int $userId = null): array {

    $conn = connectionDatabase();
    
    // запрос для получения всех постов
    $query = "SELECT id, users_id, title, description, image_path, created_at, likes FROM posts";
    
    // фильтрация по users_id
    if ($userId !== null) {
        $query .= " WHERE users_id = :user_id";
    }

    $stmt = $conn->prepare($query);

    // привязываем параметр
    if ($userId !== null) {
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    }

    $stmt->execute();
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $posts;
}


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

function displayTimeAgo($postTimestamp) {
    // Преобразуем строку в Unix timestamp, используя strtotime()
    $timestamp = strtotime($postTimestamp);

    // Разница во времени в секундах
    $timeDifference = time() - $timestamp;

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

function displayPosts(array $posts): void {
    // Извлекаем все уникальные user_id из постов
    $userIds = array_unique(array_column($posts, 'users_id'));
    
    // Получаем информацию о всех пользователях
    $usersInfo = getUsersInfo($userIds);

    foreach ($posts as $post) {
        // Получаем информацию о пользователе для текущего поста
        $userInfo = $usersInfo[$post['users_id']] ?? null;
        
   
        
        // Отображаем информацию о пользователе
        if ($userInfo) {
            echo "<div class='user'>";
            echo "<img src='" . $userInfo['avatar'] . "' alt='Аватар' >";
            echo "<span class='user-name'>" . $userInfo['full_name'] . "</span>";
            echo "</div>";
        }
        
        // Отображаем сам пост
        echo "<img class='home_photo' src='" . $post['image_path'] . "' alt='Фото поста'>";
        echo "<h2>" . $post['title'] . "</h2>";
        echo "<div class='reaction'>";
        echo "<img src='./icons/like.png' alt='лайк'>";
        echo "<span>" . (isset($post['likes']) ? $post['likes'] : 0) . "</span>";
        echo "</div>";
        echo "<p class='comment'>" . $post['description'] . "</p>";
        

        // Получаем время публикации и выводим "X времени назад"
        echo "<p><small>Опубликовано: ";
        displayTimeAgo($post['created_at']);
        echo "</small></p>";

    }
}

?>