<?php
include '../../config/db.php';
session_start();

header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$username = $data['username'] ?? null;
$password = $data['password'] ?? null;

if (!$username || !$password) {
    echo json_encode([
        "success" => false,
        "message" => "Username and password are required."
    ]);
    exit();
}

$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {

        $_SESSION['userId'] = $user['id'];
        $_SESSION['user'] = [
            "id" => $user['id'],
            "username" => $user['username'],
            "email" => $user['email']
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
    "message" => "Invalid username or password."
]);
exit();

?>
