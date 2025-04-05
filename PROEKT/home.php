<?php
    include 'validation.php'; 
    include './helpers/functions.php'; 
?>


<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <title>Основная лента</title>
  <link href="css/home.css" rel="stylesheet">
</head>

<body>

  <nav>
    <img src="./icons/home.svg" alt="домик">
    <img src="./icons/user.svg" alt="человек">
    <img src="./icons/plus.svg" alt="плюсик">
  </nav>
  
  <!-- Форма для выбора пользователя -->
  <form method="GET" action="home.php">
    <label for="user_select">Выберите пользователя:</label>
    <select id="user_select" name="user_id">  <!-- выпадающий список -->
      <?php
      
      selectUsers();
        
      ?>
    </select>
    <button type="submit">Показать</button>
  </form>

  <div class="post_container">
  <?php
    $selectedUserId = isset($_GET['user_id']) && $_GET['user_id'] !== '' ? (int)$_GET['user_id'] : null;
    $allPosts = getPosts($selectedUserId);
    displayPosts($allPosts, $selectedUserId);
    ?>
  </div>

</body>

</html>
