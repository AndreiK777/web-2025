<?php
include './helpers/functions.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Профиль</title>
    <link href="css/layout.css?v=5.0" rel="stylesheet"> 
    <link href="css/profile.css?v=6.0" rel="stylesheet">
</head>

<body>
    <header class="header">
        <div class="header__content">
            <!-- содержимое шапки -->
        </div>
    </header>

    <nav class="sidebar">
        <img class="sidebar__icon" src="./icons/home.svg" alt="домик">
        <img class="sidebar__icon" src="./icons/user.svg" alt="человек">
        <img class="sidebar__icon" src="./icons/plus.svg" alt="плюсик">
    </nav>

    <main class="main-content"> <!-- Изменяем класс -->
        <?php
        $userId = isset($_GET['id']) ? (int)$_GET['id'] : 1;
        $user = getUserById($userId);

        if ($user) {
            include 'profile_template.php';
        } else {
            echo "<p class='profile__error'>Пользователь не найден</p>";
        }
        ?>
    </main>
</body>
</html>