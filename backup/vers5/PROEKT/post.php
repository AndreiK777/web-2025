<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Создание поста</title>
    <link href="css/layout.css?v=6.0" rel="stylesheet"> 
    <link href="css/post.css?v=6.0" rel="stylesheet"> 
    <script src="js/post.js" defer></script>
    <script src="js/sidebar.js" defer></script>
</head>

<body>
    <header class="header header_post"></header>

    <nav class="sidebar">
        <img class="sidebar__icon" src="./icons/home.svg" alt="домик">
        <img class="sidebar__icon" src="./icons/user.svg" alt="человек">
        <img class="sidebar__icon" src="./icons/plus.svg" alt="плюсик">
    </nav>

    <main class="content-wrapper">
        <input type="file" id="fileInput" class="file-input" accept="image/*" multiple>

        <div id="imagesContainer" class="images-container">
            <div class="images-slider" id="imagesSlider"></div>
            <div class="post__indicator" id="sliderCounter">
                <span class="post__indicator-text"></span>
            </div>
            <img class="slider-icon slider-icon_left" src="./icons/left-slider.svg" alt="Назад">
            <img class="slider-icon slider-icon_right" src="./icons/right-slider.svg" alt="Вперед">
        </div>
        
        <div class="create-post" id="createPost">
            <div class="create-post__field">
                <img class="create-post__icon" src="./icons/create-post.png" alt="Добавить фото">
                <button class="create-post__button" type="button" id="addPhotoBtn">Добавить фото</button>
            </div>
        </div>

        <div class="plus-field" id="addMorePhotos">
            <img class="plus-field__icon" src="./icons/plus-square.svg" alt="плюс">
            <span class="plus-field__text">Добавить фотографию</span>
        </div>

        <textarea class="post-tittle" id="postTittle" placeholder="Добавьте подпись..." rows="1"></textarea>

        <div class="panel">
            <button class="panel__button" type="button" id="shareBtn" disabled>Поделиться</button>
        </div>
    </main>
</body>
</html>