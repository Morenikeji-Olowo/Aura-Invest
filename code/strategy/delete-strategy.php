<?php
include '../../config/db.php';
session_start();
$frontend_origin = "https://aurainvestfront.vercel.app";

header("Access-Control-Allow-Origin: $frontend_origin");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true");


$data = json_decode(file_get_contents("php://input"), true);
$userId = $data["userId"] ?? null;
$strategy_id = $data["strategy_id"] ?? null;

try {
    $stmt = $conn->prepare("DELETE FROM user_strategies WHERE user_id = ? AND strategy_id = ?");
    $stmt->bind_param("is", $userId, $strategyId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true, 'message' => 'Strategy deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Strategy not found']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
