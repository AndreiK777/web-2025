<?php
    include 'validation.php'; 
    include './helpers/functions.php'; 
    // Получаем и проверяем параметр id
    $userId = isset($_GET['id']) ? $_GET['id'] : null;
    if ($userId === null || !is_numeric($userId)) {
        header("Location: home.php");
        exit;
    }

    $user = isExistUser($userId);
    // Если пользователь не найден - редирект
    if ($user === null) {
        header("Location: home.php");
        exit;
    }

    $userPosts = getUserPosts($userId);

?>

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
    // Показываем профиль, если пользователь существует
    include 'profile_template.php'; 

    if (empty(getUserPosts($userId))) {
        echo "<p>Нет постов</p>";
    }
    ?>

</body>
</html>
