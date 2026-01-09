<?php
session_start();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
if (isset($_SESSION['userId'])) {
    echo json_encode([
        "loggedIn" => true,
        "user" => $_SESSION['user']
    ]);
} else {
    echo json_encode(["loggedIn" => false]);
}
?>
