<?php
session_start();
header('Content-Type: application/json');
include 'config.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode([]);
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM meal_plans WHERE user_id='$user_id'";
$result = $conn->query($sql);

$meal_plans = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $meal_plans[] = $row;
    }
}

echo json_encode($meal_plans);
?>
