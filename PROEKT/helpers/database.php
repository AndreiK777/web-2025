<?php
include 'functions.php';

function connectionDatabase(): PDO {
    $dsn = "mysql:host=localhost;dbname=blog"; 
    $username = "root";   // Ваше имя пользователя MySQL
    $password = "";   // Ваш пароль MySQL
    
    return new PDO($dsn, $username, $password);
    }

function getUsersInfo(array $userIds): array {
    if (empty($userIds)) {
        return [];
    }

    // Получаем соединение с БД
    $conn = connectionDatabase();
    
    // Подготовка запроса для получения данных пользователей
    $query = "SELECT id, full_name, avatar FROM users WHERE id IN (" . implode(',', array_fill(0, count($userIds), '?')) . ")";
    
    $stmt = $conn->prepare($query);
    $stmt->execute($userIds);
    
    // Получаем все данные о пользователях
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Индексируем по user_id для быстрого доступа
    $usersInfo = [];
    foreach ($users as $user) {
        $usersInfo[$user['id']] = $user;
    }

    return $usersInfo;
}

function getPosts(?int $userId = null): array {
    // Получаем соединение с БД
    $conn = connectionDatabase();
    
    // Запрос для получения всех постов
    $query = "SELECT id, users_id, title, description, image_path, created_at, likes FROM posts";
    
    // Если выбран пользователь, добавляем фильтрацию по users_id
    if ($userId !== null) {
        $query .= " WHERE users_id = :user_id";
    }

    $stmt = $conn->prepare($query);

    // Привязываем параметр, если нужно
    if ($userId !== null) {
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    }

    $stmt->execute();
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $posts;
}

function selectUsers(?int $selectedUserId = null): void {
    // Получаем соединение с БД
    $conn = connectionDatabase();
    
    // Запрос для получения всех пользователей
    $query = "SELECT id, full_name FROM users";
    
    // Если выбран пользователь, добавляем фильтр
    if ($selectedUserId !== null) {
        $query .= " WHERE id = :user_id";  // Здесь оставляем id, так как фильтрация по id пользователя
    }

    $stmt = $conn->prepare($query);
    
    // Привязываем параметр, если нужно
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
?>