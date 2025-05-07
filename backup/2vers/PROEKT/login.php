<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <title>Логин</title>
  <link href="css/login.css?v=3.0" rel="stylesheet">
</head>

<body>
<div class="container">
  <header>
    <h1 class="header">Войти</h1>
  </header>
  <img class="start-image" src="./photos/login.png" alt="фотография">
  <form class="form">
    <div class="login-form">
      <label class="label" for="username">Электропочта</label>
      <div class="field">
        <input class="field__input" type="text" id="username" name="username" required>
      </div>
      <small class="login-form__description">Введите электропочту в формате *****@***.**</small>
    </div>
    <div class="login-form">
      <label class="label" for="password_label">Пароль</label>
      <div class="field field_password">
        <input class="field__input" type="password" id="password_label" name="password" required>
        <img src="./icons/eye-off.svg" alt="скрыть пароль" class="eye eye_off">
        <img src="./icons/eye-on.svg" alt="показать пароль" class="eye eye_on">
      </div>
    </div>
    <div>
      <button class="button button__text" type="submit">Продолжить</button>
    </div>
  </form>
</div>
</body>

</html>