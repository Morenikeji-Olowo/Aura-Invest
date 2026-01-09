<?php
include '../../config/db.php';

$frontend_origin = "https://aurainvestfront-p37upl8us-morenikeji-olowos-projects.vercel.app";

header("Access-Control-Allow-Origin: $frontend_origin");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true"); // 👈 allow cookies

session_start();

$_SESSION = [];

session_destroy();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

echo json_encode([
    "success" => true,
    "message" => "Logged out successfully."
]);
exit();
?>
