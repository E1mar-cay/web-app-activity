<?php
// api/upload_handler.php
session_start();

$target_dir_base = "../uploads/";
$json_file = "../uploads/media_data.json";
$max_file_size = 25 * 1024 * 1024; // 25 Megabytes

$allowed_types = [
    // Images
    'jpg' => 'image/jpeg',
    'jpeg' => 'image/jpeg',
    'png' => 'image/png',
    'webp' => 'image/webp',
    'svg' => 'image/svg+xml',
    // Audio
    'mp3' => 'audio/mpeg',
    'ogg' => 'audio/ogg',
    'wav' => 'audio/wav',
    // Video
    'mp4' => 'video/mp4',
    'webm' => 'video/webm'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_FILES['mediaFile']) || $_FILES['mediaFile']['error'] === UPLOAD_ERR_NO_FILE) {
        $_SESSION['upload_status'] = [
            'type' => 'danger',
            'message' => 'Mangyaring pumili ng media file na iu-upload.'
        ];
        header('Location: ../upload.php');
        exit;
    }

    $file = $_FILES['mediaFile'];
    $title = isset($_POST['mediaTitle']) ? trim($_POST['mediaTitle']) : '';
    $description = isset($_POST['mediaDescription']) ? trim($_POST['mediaDescription']) : '';

    // 1. Check upload error code
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['upload_status'] = [
            'type' => 'danger',
            'message' => 'Nagkaroon ng error sa pag-upload. Error code: ' . $file['error']
        ];
        header('Location: ../upload.php');
        exit;
    }

    // 2. Check File Size
    if ($file['size'] > $max_file_size) {
        $_SESSION['upload_status'] = [
            'type' => 'danger',
            'message' => 'Ang laki ng file ay lumampas sa pinapayagang limitasyon (25 MB).'
        ];
        header('Location: ../upload.php');
        exit;
    }

    // 3. Check Extension & MIME Type
    $filename = basename($file['name']);
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    if (!array_key_exists($ext, $allowed_types)) {
        $_SESSION['upload_status'] = [
            'type' => 'danger',
            'message' => 'Hindi pinapayagang file extension (.' . htmlspecialchars($ext) . '). Images, audio, at video files lamang ang pwede.'
        ];
        header('Location: ../upload.php');
        exit;
    }

    // Detect MIME type
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    // Determine target subfolder based on media type
    $subfolder = "";
    $category = "image";

    if (strpos($mime_type, 'image/') === 0) {
        $subfolder = "images/";
        $category = "image";
    } elseif (strpos($mime_type, 'audio/') === 0) {
        $subfolder = "audio/";
        $category = "audio";
    } elseif (strpos($mime_type, 'video/') === 0) {
        $subfolder = "videos/";
        $category = "video";
    } else {
        $_SESSION['upload_status'] = [
            'type' => 'danger',
            'message' => 'Hindi valid na MIME type (' . htmlspecialchars($mime_type) . ').'
        ];
        header('Location: ../upload.php');
        exit;
    }

    // 4. Sanitize Filename
    $clean_filename = preg_replace("/[^a-zA-Z0-9\._-]/", "_", pathinfo($filename, PATHINFO_FILENAME));
    $final_filename = time() . "_" . $clean_filename . "." . $ext;
    $target_file_path = $target_dir_base . $subfolder . $final_filename;

    // Ensure target subfolder exists
    if (!file_exists($target_dir_base . $subfolder)) {
        mkdir($target_dir_base . $subfolder, 0777, true);
    }

    // 5. Move Uploaded File & Store Metadata
    if (move_uploaded_file($file['tmp_name'], $target_file_path)) {
        // Read existing JSON metadata
        $metadata = [];
        if (file_exists($json_file)) {
            $json_content = file_get_contents($json_file);
            $metadata = json_decode($json_content, true) ?: [];
        }

        // Add new media metadata record
        $relative_path = "uploads/" . $subfolder . $final_filename;
        $metadata[] = [
            'id' => time() . '_' . rand(100, 999),
            'filename' => $final_filename,
            'original_name' => $filename,
            'title' => !empty($title) ? $title : pathinfo($filename, PATHINFO_FILENAME),
            'description' => $description,
            'category' => $category,
            'filepath' => $relative_path,
            'upload_date' => date('Y-m-d H:i:s')
        ];

        // Save updated JSON array
        file_put_contents($json_file, json_encode($metadata, JSON_PRETTY_PRINT));

        $_SESSION['upload_status'] = [
            'type' => 'success',
            'message' => 'Tagumpay! Ang media file na "' . htmlspecialchars(!empty($title) ? $title : $final_filename) . '" ay na-upload at lalabas na sa Home page at Media Gallery.'
        ];
    } else {
        $_SESSION['upload_status'] = [
            'type' => 'danger',
            'message' => 'Bumagsak ang pag-save ng uploaded file sa server storage.'
        ];
    }

    header('Location: ../upload.php');
    exit;
}
