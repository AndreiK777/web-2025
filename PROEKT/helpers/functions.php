<?php

function connectionDatabase(): PDO {
    $dsn = "mysql:host=localhost;dbname=blog"; 
    $username = "root";
    $password = "";
    return new PDO($dsn, $username, $password);
}

// получение данных пользователя
function getUserById(int $userId): array|false {
    $conn = connectionDatabase();
    $stmt = $conn->prepare("SELECT id, full_name, avatar, bio, number_posts FROM users WHERE id = :user_id");
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function selectUsers(?int $selectedUserId = null): void {
    $conn = connectionDatabase();
    $query = "SELECT id, full_name FROM users";
    
    if ($selectedUserId !== null) {
        $query .= " WHERE id = :user_id";
    }

    $stmt = $conn->prepare($query);
    
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
    if (empty($userIds)) return [];

    $conn = connectionDatabase();
    $query = "SELECT id, full_name, avatar FROM users WHERE id IN (".implode(',', array_fill(0, count($userIds), '?')).")";
    $stmt = $conn->prepare($query);
    $stmt->execute($userIds);
    
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $usersInfo = [];
    
    foreach ($users as $user) {
        $usersInfo[$user['id']] = $user;
    }

    return $usersInfo;
}

function getPosts(?int $userId = null): array {
    $conn = connectionDatabase();
    
    $query = "SELECT 
                 p.*,
                 (SELECT GROUP_CONCAT(image_path) FROM post_images WHERE post_id = p.id) AS additional_images
              FROM posts p";
    
    if ($userId !== null) {
        $query .= " WHERE p.users_id = :user_id";
    }

     $query .= " ORDER BY p.created_at DESC";

    $stmt = $conn->prepare($query);

    if ($userId !== null) {
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    }

    $stmt->execute();
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // единый массив изображений для каждого поста
    foreach ($posts as &$post) {
        $post['images'] = [];
        
        // Главное изображение
        if (!empty($post['image_path'])) {
            $post['images'][] = $post['image_path'];
        }
        
        // Дополнительные изображения
        if (!empty($post['additional_images'])) {
            $additional = explode(',', $post['additional_images']);
            $post['images'] = array_merge($post['images'], $additional);
        }
    }
    
    return $posts;
}

function displayTimeAgo($postTimestamp) {
    $timestamp = strtotime($postTimestamp);
    $timeDifference = time() - $timestamp;

    $days = floor($timeDifference / 86400);
    $hours = floor(($timeDifference % 86400) / 3600);
    $minutes = floor(($timeDifference % 3600) / 60);

    /**
    $postDate = new DateTime($postTimestamp, new DateTimeZone('GMT+03'));
    $date = new DateTime('now', new DateTimeZone('GMT+03'));
    $timeDifference = $date->diff($postDate, true);

    $days = $timeDifference->d;
    $hours = $timeDifference->h;
    $minutes = $timeDifference->i;
     */

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

function displayPosts(array $posts): void {

    
    $userIds = array_unique(array_column($posts, 'users_id'));
    $usersInfo = getUsersInfo($userIds);

    foreach ($posts as $post) {
        $userInfo = $usersInfo[$post['users_id']] ?? null;
        
        // массив всех изображений поста
        $images = [];
        if (!empty($post['image_path'])) {
            $images[] = $post['image_path']; // Главное изображение
        }
        if (!empty($post['images'])) {
            $images = array_merge($images, (array)$post['images']);
        }
        
        include 'post_template.php';
    }
}
?>