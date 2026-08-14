<?php
// api/edit_handler.php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['filepath']) || empty($_POST['filepath'])) {
        $_SESSION['gallery_status'] = [
            'type' => 'danger',
            'message' => 'Walang media file na tinukoy para i-edit.'
        ];
        header('Location: ../gallery.php');
        exit;
    }

    $filepath = $_POST['filepath'];
    $new_title = isset($_POST['mediaTitle']) ? trim($_POST['mediaTitle']) : '';
    $new_description = isset($_POST['mediaDescription']) ? trim($_POST['mediaDescription']) : '';
    $redirect = isset($_POST['redirect']) ? $_POST['redirect'] : '../gallery.php';

    $json_file = "../uploads/media_data.json";

    if (empty($new_title)) {
        $_SESSION['gallery_status'] = [
            'type' => 'danger',
            'message' => 'Ang pamagat (Title) ay hindi pwedeng ibukod.'
        ];
        header('Location: ' . $redirect);
        exit;
    }

    // Read existing metadata JSON
    $metadata = [];
    if (file_exists($json_file)) {
        $json_content = file_get_contents($json_file);
        $metadata = json_decode($json_content, true) ?: [];
    }

    $found = false;
    foreach ($metadata as &$item) {
        if ($item['filepath'] === $filepath) {
            $item['title'] = $new_title;
            $item['description'] = $new_description;
            $found = true;
            break;
        }
    }
    unset($item);

    // If item was not yet in JSON (e.g. system default file), add an entry for it
    if (!$found) {
        $category = "image";
        $ext = strtolower(pathinfo($filepath, PATHINFO_EXTENSION));
        if (in_array($ext, ['mp3', 'ogg', 'wav'])) {
            $category = "audio";
        } elseif (in_array($ext, ['mp4', 'webm'])) {
            $category = "video";
        }

        $metadata[] = [
            'id' => time() . '_' . rand(100, 999),
            'filename' => basename($filepath),
            'original_name' => basename($filepath),
            'title' => $new_title,
            'description' => $new_description,
            'category' => $category,
            'filepath' => $filepath,
            'upload_date' => date('Y-m-d H:i:s')
        ];
    }

    // Save JSON back
    file_put_contents($json_file, json_encode(array_values($metadata), JSON_PRETTY_PRINT));

    $_SESSION['gallery_status'] = [
        'type' => 'success',
        'message' => 'Tagumpay! Bagong na-update ang pamagat at deskripsyon ng "' . htmlspecialchars($new_title) . '".'
    ];

    header('Location: ' . $redirect);
    exit;
}
