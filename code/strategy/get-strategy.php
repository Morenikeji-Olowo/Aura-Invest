<?php
include '../../config/db.php';
session_start();
$frontend_origin = "https://aurainvestfront.vercel.app";

header("Access-Control-Allow-Origin: $frontend_origin");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true");


$data = json_decode(file_get_contents("php://input"), true);
$userId = $data["user_id"] ?? null;
try {
    $stmt = $conn->prepare("SELECT id, strategy_id, strategy_data FROM user_strategies WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    $strategies = [];
    while ($row = $result->fetch_assoc()) {
        $row['strategy_data'] = json_decode($row['strategy_data'], true); 
        $strategies[] = $row;
    }

    echo json_encode([
        'success' => true,
        'strategies' => $strategies
    ]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
