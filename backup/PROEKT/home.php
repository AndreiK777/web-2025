<?php
    include 'validation.php'; 
    include './helpers/functions.php'; 
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Основная лента</title>
  <link href="css/home.css?v=1.0" rel="stylesheet">
</head>

<body>

  <nav class="sidebar">
    <img class="sidebar__icon" src="./icons/home.svg" alt="домик">
    <img class="sidebar__icon" src="./icons/user.svg" alt="человек">
    <img class="sidebar__icon" src="./icons/plus.svg" alt="плюсик">
  </nav>

  <main class="content">
    <form class="content__form" method="GET" action="home.php">
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

    <div class="content__posts">
      <?php
        $allPosts = getPosts($selectedUserId);
        displayPosts($allPosts);
      ?>
    </div>
</main>


</body>
</html>
