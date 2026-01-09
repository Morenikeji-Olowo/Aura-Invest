<?php
include '../../config/db.php';

$frontend_origin = "https://aurainvestfront-q81d5r6vu-morenikeji-olowos-projects.vercel.app";

header("Access-Control-Allow-Origin: $frontend_origin");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true"); // 👈 allow cookies

session_start();
if(isset($_SESSION['user']) && isset($_SESSION['userId'])) {
    echo json_encode([
        "success" => true,
        "user" => $_SESSION['user']
    ]);
    exit();
}
echo json_encode([
    "success" => false,
    "message" => "No user is logged in."
]);
exit();
?>
