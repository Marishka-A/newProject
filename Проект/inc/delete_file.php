<?php
$data = json_decode(file_get_contents('php://input'), true);
$filePath = $data['filePath'];

if (!empty($filePath)) {
    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            echo json_encode(['success' => true]);
            exit;
        }
    }
}

echo json_encode(['success' => false]);
