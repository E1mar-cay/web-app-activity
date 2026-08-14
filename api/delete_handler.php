<?php
// api/delete_handler.php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['filepath']) || empty($_POST['filepath'])) {
        $_SESSION['gallery_status'] = [
            'type' => 'danger',
            'message' => 'No media file specified for deletion.'
        ];
        header('Location: ../gallery.php');
        exit;
    }

    $filepath = $_POST['filepath'];
    $json_file = "../uploads/media_data.json";
    
    // Security check: Only allow deleting files inside web_app root directory (images/, audio/, videos/, uploads/)
    $base_dir = realpath("../");
    $target_real = realpath("../" . $filepath);

    if ($target_real && strpos($target_real, $base_dir) === 0 && file_exists($target_real)) {
        // Prevent deleting core system scripts
        $ext = strtolower(pathinfo($target_real, PATHINFO_EXTENSION));
        if (in_array($ext, ['php', 'css', 'js', 'html', 'htaccess', 'json'])) {
            $_SESSION['gallery_status'] = [
                'type' => 'danger',
                'message' => 'System script files cannot be deleted.'
            ];
        } else {
            if (unlink($target_real)) {
                // Update JSON metadata storage
                if (file_exists($json_file)) {
                    $json_content = file_get_contents($json_file);
                    $metadata = json_decode($json_content, true) ?: [];
                    
                    $updated_metadata = array_filter($metadata, function($item) use ($filepath) {
                        return $item['filepath'] !== $filepath;
                    });

                    file_put_contents($json_file, json_encode(array_values($updated_metadata), JSON_PRETTY_PRINT));
                }

                $_SESSION['gallery_status'] = [
                    'type' => 'success',
                    'message' => 'The file "' . htmlspecialchars(basename($filepath)) . '" was successfully deleted from the server and gallery.'
                ];
            } else {
                $_SESSION['gallery_status'] = [
                    'type' => 'danger',
                    'message' => 'Failed to delete file from server disk.'
                ];
            }
        }
    } else {
        $_SESSION['gallery_status'] = [
            'type' => 'danger',
            'message' => 'Invalid file path or file does not exist.'
        ];
    }

    header('Location: ../gallery.php');
    exit;
}
