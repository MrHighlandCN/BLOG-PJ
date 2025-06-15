<?php 
require 'consts.php';
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Kiểm tra kết nối
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode([
        "error" => "Kết nối database thất bại: " . $conn->connect_error
    ]);
    exit;
}

// Thiết lập charset (nên dùng)
$conn->set_charset("utf8mb4");
?>