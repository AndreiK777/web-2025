<?php
include './helpers/functions.php';

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); // Разрешаем CORS

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  echo json_encode(['error' => 'Метод не разрешён']);
  exit;
}

// Получаем JSON данные
$input = json_decode(file_get_contents('php://input'), true);

if (json_last_error() !== JSON_ERROR_NONE) {
  http_response_code(400);
  echo json_encode(['error' => 'Неверный формат JSON']);
  exit;
}

// Подготовка данных
$title = $input['title'] ?? '';
$createdBy = $input['created_by'] ?? 1;
$images = $input['images'] ?? [];

try {
  $conn = connectionDatabase();
  $conn->beginTransaction();
  
  // Обработка первой фотографии (если есть)
  $firstImagePath = null;
  if (!empty($images[0])) {
    $imageData = $images[0];
    if (strpos($imageData, 'data:image') === 0) {
      list($type, $data) = explode(';', $imageData);
      list(, $data) = explode(',', $data);
      $data = base64_decode($data);
      
      $extension = str_replace('image/', '', str_replace('data:', '', $type));
      $filename = uniqid() . '.' . $extension;
      $filepath = "photos/" . $filename;
      
      file_put_contents($filepath, $data);
      $firstImagePath = $filepath;
    }
  }

  // 1. Создаем пост (с первым изображением, если есть)
  $stmt = $conn->prepare(
    "INSERT INTO posts (title, image_path, created_at, created_by, users_id) 
     VALUES (:title, :image_path, NOW(), :created_by, :created_by)"
  );
  $stmt->execute([
    ':title' => $title,
    ':image_path' => $firstImagePath,
    ':created_by' => $createdBy
  ]);
  
  $postId = $conn->lastInsertId();
  
  // 2. Сохраняем остальные изображения (если есть)
  $savedImages = [];
  if ($firstImagePath) {
    $savedImages[] = $firstImagePath; // Добавляем первое изображение в массив сохраненных
  }

  // Начинаем со второго изображения (индекс 1)
  for ($i = 1; $i < count($images); $i++) {
    $imageData = $images[$i];
    if (strpos($imageData, 'data:image') === 0) {
      list($type, $data) = explode(';', $imageData);
      list(, $data) = explode(',', $data);
      $data = base64_decode($data);
      
      $extension = str_replace('image/', '', str_replace('data:', '', $type));
      $filename = uniqid() . '.' . $extension;
      $filepath = "photos/" . $filename;
      
      file_put_contents($filepath, $data);
      
      $stmt = $conn->prepare(
        "INSERT INTO post_images (post_id, image_path) 
         VALUES (:post_id, :image_path)"
      );
      $stmt->execute([
        ':post_id' => $postId,
        ':image_path' => $filepath
      ]);
      
      $savedImages[] = $filepath;
    }
  }
  
  $conn->commit();
  
  echo json_encode([
    'success' => true,
    'post_id' => $postId,
    'saved_images' => count($savedImages),
    'first_image_in_post' => $firstImagePath ? true : false
  ]);
  
} catch (Exception $e) {
  $conn->rollBack();
  
  // Удаляем сохраненные файлы в случае ошибки
  foreach ($savedImages as $filepath) {
    if (file_exists($filepath)) {
      unlink($filepath);
    }
  }
  
  http_response_code(500);
  echo json_encode(['error' => 'Ошибка сервера: ' . $e->getMessage()]);
}