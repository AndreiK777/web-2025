<?php
    date_default_timezone_set('Europe/Moscow');
    include 'validation.php'; 
    include './helpers/functions.php'; 
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Основная лента</title>
    <link href="css/layout.css?v=6.0" rel="stylesheet"> 
    <link href="css/home.css?v=13.0" rel="stylesheet">
    <link href="css/modal.css?v=4.0" rel="stylesheet">
    <script src="js/slider.js" defer></script>
    <script src="js/modal.js" defer></script>
    <script src="js/additions.js" defer></script>
    <script src="js/sidebar.js" defer></script>
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

    <main class="content">
        <form class="form" method="GET" action="home.php">
            <label for="user_select">Выберите пользователя:</label>
            <select id="user_select" name="user_id">
                <option value="">Все пользователи</option>
                <?php
                    $selectedUserId = isset($_GET['user_id']) && $_GET['user_id'] !== '' ? (int)$_GET['user_id'] : null;
                    selectUsers($selectedUserId);
                ?>
            </select>
            <button type="submit">Показать</button>
        </form>

        <div>
            <?php
                $allPosts = getPosts($selectedUserId);
                displayPosts($allPosts);
            ?>
        </div>
    </main>

    <div id="modal-container" class="modal-container">
        <div class="modal-content">
            <span class="modal-close">&times;</span>
            <div class="modal-image-container">
                <img class="modal-image" src="" alt="Просмотр фото">
            </div>
            <div class="modal-counter"></div>
        </div>
    </div>

</body>
</html>