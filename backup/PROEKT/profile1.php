<?php
include './helpers/functions.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Профиль</title>
    <link href="css/profile.css?v=3.0" rel="stylesheet">
</head>

<body>
      <header class="header">
        <!-- Здесь будет содержимое шапки -->
        <div class="header__content">
            Логотип, меню и другие элементы
        </div>
     </header>

    <nav class="sidebar">
        <img class="sidebar__icon" src="./icons/home.svg" alt="домик">
        <img class="sidebar__icon" src="./icons/user.svg" alt="человек">
        <img class="sidebar__icon" src="./icons/plus.svg" alt="плюсик">
    </nav>

    <main class="main-content"> <!-- Изменили класс -->
        <?php
        $userId = isset($_GET['id']) ? (int)$_GET['id'] : 1;
        $user = getUserById($userId);

        if ($user) {
            include 'profile_template1.php';
        } else {
            echo "<p class='error-message'>Пользователь не найден</p>";
        }
        ?>
    </main>
</body>
</html>