<?php
include './helpers/functions.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Метод не разрешён']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    echo json_encode(['error' => 'Неверный формат JSON']);
    exit;
}

$title = $input['title'] ?? '';
$createdBy = $input['created_by'] ?? 1;
$images = $input['images'] ?? [];

try {
    $conn = connectionDatabase();
    $conn->beginTransaction();

    // Сохранение изображения
    function saveImage($imageData) {
        list($type, $data) = explode(';', $imageData);
        list(, $data) = explode(',', $data);
        $data = base64_decode($data);

        $extension = str_replace('image/', '', str_replace('data:', '', $type));
        $filename = uniqid() . '.' . $extension;
        $filepath = "photos/" . $filename;

        file_put_contents($filepath, $data);
        return $filepath;
    }

    // Первое изображение
    $firstImagePath = !empty($images[0]) ? saveImage($images[0]) : null;

    // Создание поста
    $stmt = $conn->prepare("
        INSERT INTO posts (title, image_path, created_at, created_by, users_id)
        VALUES (:title, :image_path, NOW(), :created_by, :created_by)
    ");
    $stmt->execute([
        ':title' => $title,
        ':image_path' => $firstImagePath,
        ':created_by' => $createdBy
    ]);

    $postId = $conn->lastInsertId();

    // Сохранение остальных изображений
   $savedImages = [];

if (count($images) > 1) {
    $savedImages[] = $firstImagePath;

    foreach (array_slice($images, 1) as $imageData) {
        $imagePath = saveImage($imageData);
        $stmt = $conn->prepare("
            INSERT INTO post_images (post_id, image_path)
            VALUES (:post_id, :image_path)
        ");
        $stmt->execute([
            ':post_id' => $postId,
            ':image_path' => $imagePath
        ]);
        $savedImages[] = $imagePath;
    }
}

    $conn->commit();
    echo json_encode([
        'success' => true,
        'post_id' => $postId,
        'saved_images' => count($savedImages),
        'first_image_in_post' => (bool) $firstImagePath
    ]);

} catch (Exception $e) {
    $conn->rollBack();

    foreach ($savedImages ?? [] as $filepath) {
        if (file_exists($filepath)) {
            unlink($filepath);
        }
    }

    http_response_code(500);
    echo json_encode(['error' => 'Ошибка сервера: ' . $e->getMessage()]);
}
?>
