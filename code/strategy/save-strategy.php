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

$input = json_decode(file_get_contents('php://input'), true);

if (!$input || !isset($input['userId']) || !isset($input['strategyId'])) {
    echo json_encode(['success' => false, 'message' => 'Missing userId or strategyId']);
    exit;
}

$userId = $input['userId'];
$strategyId = $input['strategyId'];
$strategyData = isset($input['strategyData']) ? json_encode($input['strategyData']) : null;

try {
    $stmt = $conn->prepare("SELECT id FROM user_strategies WHERE user_id = ? AND strategy_id = ?");
    $stmt->bind_param("is", $userId, $strategyId);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $update = $conn->prepare("UPDATE user_strategies SET strategy_data = ?, updated_at = NOW() WHERE user_id = ? AND strategy_id = ?");
        $update->bind_param("sis", $strategyData, $userId, $strategyId);
        $update->execute();
    } else {
        $insert = $conn->prepare("INSERT INTO user_strategies (user_id, strategy_id, strategy_data, created_at) VALUES (?, ?, ?, NOW())");
        $insert->bind_param("iss", $userId, $strategyId, $strategyData);
        $insert->execute();
    }

    echo json_encode(['success' => true, 'message' => 'Strategy saved successfully']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
