<?php
include '../../config/db.php';
session_start();

$frontend_origin = "https://aurainvestfront-r89j7e1do-morenikeji-olowos-projects.vercel.app";

header("Access-Control-Allow-Origin: $frontend_origin");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true"); // 👈 allow cookies

$data = json_decode(file_get_contents("php://input"), true);

$fullname = $data['fullname'] ?? null;
$email  = $data['email'] ?? null;
$phone_number = $data['phoneNumber'] ?? null;
$date_of_birth = $data['DateofBirth'] ?? null;
$gender = $data['gender'] ?? null;
$country = $data['country'] ?? null;
$state = $data['state'] ?? null;
$city = $data['city'] ?? null;
$postal_code = $data['postalCode'] ?? null;
$address = $data['address'] ?? null;

$employment_status = $data['employmentStatus'] ?? null;
$income_range = $data['incomeRange'] ?? null;
$saving_habits = $data['savingHabits'] ?? null;
$existing_investments = $data['existingInvestments'] ?? null;
$investment_reason = $data['whyInvesting'] ?? null;
$time_range = $data['timeRange'] ?? null;
$monthly_contribution = $data['monthlyContribution'] ?? 0;
$risk_level = $data['riskLevel'] ?? null;

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        "success" => false,
        "message" => "Invalid email format."
    ]);
    exit();
}
// ? for both inserts
$conn->begin_transaction();

try {
    $sql1 = "INSERT INTO user_profile (user_id, full_name, email, phone_number, date_of_birth, gender, country, state, city, postal_code, address, hasOnboarded) 
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1)";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param("issssssssss", $_SESSION['userId'], $fullname, $email, $phone_number, $date_of_birth, $gender, $country, $state, $city, $postal_code, $address);
    $stmt1->execute();

    $sql2 = "INSERT INTO user_financial_info (user_id, employment_status, income_range, monthly_contribution, saving_habits, existing_investments, investment_reason, time_range, risk_level) 
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("issdsssss", $_SESSION['userId'], $employment_status, $income_range, $monthly_contribution, $saving_habits, $existing_investments, $investment_reason, $time_range, $risk_level);
    $stmt2->execute();

    $conn->commit();

    echo json_encode([
        "success" => true,
        "message" => "Onboarding completed successfully!"
    ]);
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode([
        "success" => false,
        "message" => "Setup failed: " . $e->getMessage()
    ]);
}
?>
