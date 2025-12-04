<?php
include '../../config/db.php';
session_start();

header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, Accept");

$data = json_decode(file_get_contents("php://input"), true);

$firstname = $data['firstname'] ?? null;
$lastname  = $data['lastname'] ?? null;
$confimedPassword = $data['confimedPassword'] ?? null;
$filedPassword = $data['password'] ?? null;
$filedEmail = $data['email'] ?? null;
$agreeToTerms = $data['agreeToTerms'] ?? null;

$messages = [];

if (!$firstname || !$lastname || !$filedPassword || !$filedEmail) {
    echo json_encode([
        "success" => false,
        "message" => "All fields are required."
    ]);
    exit();
}

if ($confimedPassword !== $filedPassword) {
    echo json_encode([
        "success" => false,
        "message" => "Passwords must match."
    ]);
    exit();
}
    else if (strlen($filedPassword) < 6) {
    echo json_encode([
        "success" => false,
        "message" => "Password must be more than 6 characters."
    ]);
    exit();

}
else if (!filter_var($filedEmail, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        "success" => false,
        "message" => "Invalid email format."
    ]);
    exit();
}

$hashedPassword = password_hash($filedPassword, PASSWORD_BCRYPT);

$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $filedUsername);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode([
        "success" => false,
        "message" => "Username already exists."
    ]);
    exit();
}

$sql = "INSERT INTO users (firstname, lastname, password, email, accepted_terms)
        VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $firstname, $lastname, $hashedPassword, $filedEmail, $agreeToTerms);

if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "message" => "Registration successful."
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Registration failed."
    ]);
}

?>
