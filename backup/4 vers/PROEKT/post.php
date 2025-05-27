<?php
    include 'validation.php'; 
    include './helpers/functions.php'; 
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Создание поста</title>
    <link rel="icon" href="data:,">
    <link href="css/layout.css?v=6.0" rel="stylesheet"> 
    <link href="css/post.css?v=6.0" rel="stylesheet"> 
</head>

<body>
    <header class="header header_post"></header>

    <nav class="sidebar">
        <img class="sidebar__icon" src="./icons/home.svg" alt="домик">
        <img class="sidebar__icon" src="./icons/user.svg" alt="человек">
        <img class="sidebar__icon" src="./icons/plus.svg" alt="плюсик">
    </nav>

    <main class="content-wrapper">
        <div class="create-post">
            <div class="create-post__field">
                <img class="create-post__icon" src="./icons/create-post.png" alt="Добавить фото">
                <button class="create-post__button" type="button">Добавить фото</button>
            </div>
        </div>

        <div class="plus-field">
            <img class="plus-field__icon" src="./icons/plus-square.svg" alt="плюс">
            <span class="plus-field__text">Добавить фотографию</span>
        </div>

        <div class="text-description">
            <span>Добавьте подпись</span>
        </div>

        <div class="panel">
            <button class="panel__button" type="button">Поделиться</button>
        </div>
    </main>
</body>
</html>