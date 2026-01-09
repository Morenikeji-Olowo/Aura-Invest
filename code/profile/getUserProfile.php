<?php
include '../../config/db.php';
session_start();
$frontend_origin = "https://aurainvestfront-o4ksfwed4-morenikeji-olowos-projects.vercel.app";

header("Access-Control-Allow-Origin: $frontend_origin");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true"); // 👈 allow cookies


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
