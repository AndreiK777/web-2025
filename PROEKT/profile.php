<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Профиль</title>
    <link href="css/profile.css" rel="stylesheet">
</head>

<body>
    <nav>
        <img src="./icons/home.svg" alt="домик">
        <img src="./icons/user.svg" alt="человек">
        <img src="./icons/plus.svg" alt="плюсик">
    </nav>

    <?php
    // Чтение данных из JSON
    $users = json_decode(file_get_contents('users.json'), true);
    $profile_posts = json_decode(file_get_contents('profile_posts.json'), true);

    include 'validation.php'; // Подключаем файл с функциями валидации

    // Ищем пользователя с id = 1
    $user = null;
    foreach ($users as $u) {
        if ($u['id'] == 1) {
            $user = $u;
            break;
        }
    }

    // Находим все посты пользователя с user_id == 1
    $userPosts = [];
    foreach ($profile_posts as $post) {
        if ($post['user_id'] == 1) {
            $userPosts[] = $post;
        }
    }

    // Валидация пользователя
    if ($user) {
        $validationResult = validateUser($user);
        if ($validationResult !== true) {
            echo "<p>Error in user data: " . $validationResult . "</p>";
        }
    } else {
        echo "<p>User not found</p>";
    }

    // Валидация постов (выполняется независимо от валидации пользователя)
    $validPosts = [];
    foreach ($userPosts as $post) {
        $postValidationResult = validatePost($post);
        if ($postValidationResult !== true) {
            echo "<p>Error in post data: " . $postValidationResult . "</p>";
            continue;
        }
        $validPosts[] = $post;
    }

    // Подключаем шаблон профиля только если есть что показывать
    if ($user && !empty($validPosts)) {
        include 'profile_template.php';
    } else {
        echo "<p>No valid data to display</p>";
    }
    ?>

</body>

</html>