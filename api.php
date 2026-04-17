<?php
header('Content-Type: application/json');
require_once 'db.php';

$method = $_SERVER['REQUEST_METHOD'];

// Helper to send response
function sendResponse($success, $message, $data = null) {
    echo json_encode(['success' => $success, 'message' => $message, 'data' => $data]);
    exit;
}

// GET: Fetch Data
if ($method === 'GET') {
    try {
        $stmt = $pdo->prepare("SELECT value FROM site_settings WHERE key_name = 'site_data'");
        $stmt->execute();
        $row = $stmt->fetch();
        if ($row) {
            echo $row['value'];
        } else {
            sendResponse(false, "Data not found in database.");
        }
    } catch (PDOException $e) {
        sendResponse(false, "DB Error: " . $e->getMessage());
    }
    exit;
}

// POST: Save Data or Upload Image
if ($method === 'POST') {
    $action = $_POST['action'] ?? 'save';
    
    // Auth Check (Simple)
    if (($_POST['password'] ?? '') !== 'cabe') {
        sendResponse(false, "Unauthorized: Invalid password.");
    }

    if ($action === 'upload') {
        if (!isset($_FILES['image'])) {
            sendResponse(false, "No image file provided.");
        }

        $file = $_FILES['image'];
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = 'upload_' . time() . '.' . $ext;
        $targetPath = 'assets/' . $filename;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            sendResponse(true, "Image uploaded successfully.", ['url' => $targetPath]);
        } else {
            sendResponse(false, "Failed to move uploaded file.");
        }
    }

    if ($action === 'save') {
        $data = $_POST['data'] ?? null;
        if (!$data) {
            sendResponse(false, "No data provided.");
        }

        try {
            $stmt = $pdo->prepare("UPDATE site_settings SET value = ? WHERE key_name = 'site_data'");
            $stmt->execute([$data]);
            sendResponse(true, "Settings saved successfully.");
        } catch (PDOException $e) {
            sendResponse(false, "DB Error: " . $e->getMessage());
        }
    }
}
?>
