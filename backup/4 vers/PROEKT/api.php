<?php
include './helpers/functions.php';

// проверка метода
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['message' => 'Метод не разрешён, используйте POST']);
    exit;
}

// получаем данные в зависимости от типа контента
$contentType = $_SERVER['CONTENT_TYPE'] ?? '';
$data = [];
$imagePath = '';

if (strpos($contentType, 'multipart/form-data') !== false) {
    // Форма с файлом
    $data = $_POST;
    
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $targetDir = "photos/";
        $targetFile = $targetDir . basename($_FILES['image']['name']);
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imagePath = $targetFile; // Сохраняем путь
        }
    }
} else {
    //  JSON
    $data = json_decode(file_get_contents('php://input'), true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(['message' => 'Некорректный формат JSON']);
        exit;
    }
}

// проверка обязательных полей
if (empty($data['title']) || empty($data['description'])) {
    echo json_encode(['message' => 'Отсутствуют обязательные данные: title или description']);
    exit;
}

// вставка в БД 
function insertPost(array $data, string $imagePath): void {
    $conn = connectionDatabase();
    
    $query = "INSERT INTO posts (title, description, image_path, created_at, created_by, users_id) 
            VALUES (:title, :description, :image_path, NOW(), :created_by, :created_by);";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':title', $data['title'], PDO::PARAM_STR);
    $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
    $stmt->bindParam(':image_path', $imagePath, PDO::PARAM_STR);
    $stmt->bindParam(':created_by', $data['created_by'], PDO::PARAM_INT);
    $stmt->bindParam(':users_id', $data['created_by'], PDO::PARAM_INT);
    
    try {
        $stmt->execute();
        echo json_encode([
            'message' => 'Пост успешно добавлен'
        ]);
    } catch (PDOException $e) {
        echo json_encode(['message' => 'Ошибка базы данных: ' . $e->getMessage()]);
    }
}

insertPost($data, $imagePath);
?>