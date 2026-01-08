<?php
$conn = new mysqli(
    getenv("DB_HOST"),
    getenv("DB_USER"),
    getenv("DB_PASS"),
    getenv("DB_NAME"),
    getenv("DB_PORT") ?: 3306
);

if ($conn->connect_error) {
    die("DB FAILED: " . $conn->connect_error);
}

echo "DB CONNECTED SUCCESSFULLY 🎉";
?>
