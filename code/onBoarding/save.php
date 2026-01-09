<?php
include '../../config/db.php';
session_start();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

$data = json_decode(file_get_contents("php://input"), true);
$userId = $_SESSION['userId'] ?? null;

$name = $data['name'] ?? '';
$knowledge = $data['knowledge'] ?? '';
$riskLevel = $data['riskLevel'] ?? '';
$goal = $data['goal'] ?? '';
$horizon = $data['horizon'] ?? '';

if (empty($name) || empty($riskLevel) || empty($goal)) {
    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
    exit();
} 
$sql = "INSERT INTO user_onboarding 
                (user_id, name, knowledge_level, risk_level, investment_goal, 
                 time_horizon, created_at) 
                VALUES (?, ?, ?, ?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isssss", $userId, $name, $knowledge, $riskLevel, $goal, $horizon);
$stmt->execute();

$updateUser = $conn->prepare("UPDATE users SET has_onboarded = 1 WHERE id = ?");
$updateUser->bind_param("i", $userId);
$updateUser->execute();

if($stmt->affected_rows > 0) {
    echo json_encode(['success' => true, 'message' => 'Onboarding data saved successfully']);
} else {
    echo json_encode(['success' => false, 'error' => 'Failed to save onboarding data']);
}

?>