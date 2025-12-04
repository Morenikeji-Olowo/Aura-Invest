<?php
include '../../config/db.php';

header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, Accept");

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
