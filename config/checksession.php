<?php
session_start();

$frontend_origin = "https://aurainvestfront.vercel.app";

header("Access-Control-Allow-Origin: $frontend_origin");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true"); // 👈 allow cookies

if (isset($_SESSION['userId'])) {
    echo json_encode([
        "loggedIn" => true,
        "user" => $_SESSION['user']
    ]);
} else {
    echo json_encode(["loggedIn" => false]);
}
?>
