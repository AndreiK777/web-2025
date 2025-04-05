<?php
function connectionDatabase(): PDO {
$dsn = "mysql:host=localhost;dbname=blog"; 
$username = "LocalSQL";   // Ваше имя пользователя MySQL
$password = "";   // Ваш пароль MySQL

return new PDO($dsn, $username, $password);
}
$conn = connectionDatabase();

function savePostToDatabase(PDO $conn, array $params): int {
    
}
?>

