<?php
include '../../config/db.php';
session_start();

header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json");


$userId;
if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];

    $sql = "SELECT * FROM user_profile WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 1){
        $profile = $result->fetch_assoc();
        echo json_encode([
            "success" => true,
            "profile" => $profile
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Profile not found."
        ]);
        exit();
    }
} else {
    echo json_encode([
        "success" => false,
        "message" => "User not logged in."
    ]);
    exit();
}
exit();

?>
