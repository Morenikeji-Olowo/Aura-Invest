<?php
include '../../config/db.php';
session_start();

$frontend_origin = "https://aurainvestfront.vercel.app";

header("Access-Control-Allow-Origin: $frontend_origin");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true"); // 👈 allow cookies

$data = json_decode(file_get_contents("php://input"), true);

$firstname = $data['firstname'] ?? null;
$lastname  = $data['lastname'] ?? null;
$confimedPassword = $data['confimedPassword'] ?? null;
$filedPassword = $data['password'] ?? null;
$filedEmail = $data['email'] ?? null;
$agreeToTerms = $data['agreeToTerms'] ?? null;

$errors = [];

// Field-specific validation
if (!$firstname) {
    $errors['firstname'] = "First name is required.";
}

if (!$lastname) {
    $errors['lastname'] = "Last name is required.";
}

if (!$filedEmail) {
    $errors['email'] = "Email is required.";
} elseif (!filter_var($filedEmail, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Invalid email format.";
}

if (!$filedPassword) {
    $errors['password'] = "Password is required.";
} elseif (strlen($filedPassword) < 6) {
    $errors['password'] = "Password must be more than 6 characters.";
}

if (!$confimedPassword) {
    $errors['confirmedPassword'] = "Please confirm your password.";
} elseif ($confimedPassword !== $filedPassword) {
    $errors['confirmedPassword'] = "Passwords must match.";
}

if (!$agreeToTerms) {
    $errors['agreeToTerms'] = "You must agree to the Terms and Conditions.";
}

if (!empty($errors)) {
    echo json_encode([
        "success" => false,
        "errors" => $errors,
        "message" => "Please fix the errors below."
    ]);
    exit();
}

$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $filedEmail);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode([
        "success" => false,
        "errors" => ["email" => "Email already exists."],
        "message" => "Email already exists."
    ]);
    exit();
}

$hashedPassword = password_hash($filedPassword, PASSWORD_BCRYPT);

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
        "errors" => ["general" => "Registration failed. Please try again."],
        "message" => "Registration failed."
    ]);
}

?>