<?php
include '../../config/db.php';
session_start();

header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, Accept, credentials");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

$data = json_decode(file_get_contents("php://input"), true);

$email = $data['email'] ?? null;
$password = $data['password'] ?? null;

if (!$email || !$password) {
    echo json_encode([
        "success" => false,
        "message" => "Email and password are required."
    ]);
    exit();
}

$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    
    // Check if user has a profile and get hasOnboarded
    $hasOnboarded = false; // Default to false

    $sql = "SELECT has_onboarded FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user['id']);
    $stmt->execute();
    $profileResult = $stmt->get_result();
    
    if ($profileResult->num_rows === 1) {
        $profile = $profileResult->fetch_assoc();
        $hasOnboarded = ($profile['has_onboarded'] == 1);
    }

    if (password_verify($password, $user['password'])) {
        $_SESSION['userId'] = $user['id'];
        $_SESSION['user'] = [
            "id" => $user['id'],
            "email" => $user['email'],
            "hasCompletedOnboarding" => $hasOnboarded
        ];

        echo json_encode([
            "success" => true,
            "message" => "Login successful.",
            "user" => $_SESSION['user']
        ]);
        exit();
    }
}

echo json_encode([
    "success" => false,
    "message" => "Invalid email or password."
]);
exit();
?>