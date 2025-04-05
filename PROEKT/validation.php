<?php

// длина строки
function validateLength($string, $minLength, $maxLength) {
    return strlen($string) >= $minLength && strlen($string) <= $maxLength;
}

// дата
function validateDate($timestamp) {
    return (is_int($timestamp) || strtotime($timestamp) !== false);
}

// целое число
function validateInteger($value) {
    return is_int($value) || ctype_digit($value);
}

// Валидация данных пользователя
function validateUser($user) {
    // Проверка имени (должно быть от 1 до 100 символов)
    if (!validateLength($user['name'], 1, 100)) {
        return "Имя пользователя должно быть от 1 до 100 символов.";
    }

    // Проверка количества постов (целое число)
    if (!validateInteger($user['post_count'])) {
        return "Количество постов должно быть целым числом.";
    }

    // Проверка даты регистрации (должна быть валидной датой)
    if (!validateDate($user['registration_date'])) {
        return "Некорректная дата регистрации.";
    }

    return true;
}

// Валидация данных поста
function validatePost($post) {
    // Проверка ID пользователя (целое число)
    if (!validateInteger($post['user_id'])) {
        return "ID пользователя должно быть целым числом.";
    }

    // Проверка описания (максимальная длина 500 символов)
    if (isset($post['description']) && strlen($post['description']) > 500) {
        return "Описание не должно превышать 500 символов.";
    }

    // Проверка времени (должна быть валидной датой)
    if (!validateDate($post['timestamp'])) {
        return "Некорректная дата поста.";
    }

    return true;
}
?>
