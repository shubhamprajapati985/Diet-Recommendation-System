<?php
session_start();
include 'config.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Access denied!");
}

// Profile update
if (isset($_POST['update_profile'])) {
    $user_id = $_SESSION['user_id'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $dietary_preferences = $_POST['dietary_preferences'];
    $allergies = $_POST['allergies'];
    $health_goals = $_POST['health_goals'];

    $sql = "REPLACE INTO user_profiles (user_id, age, gender, weight, height, dietary_preferences, allergies, health_goals) 
            VALUES ('$user_id', '$age', '$gender', '$weight', '$height', '$dietary_preferences', '$allergies', '$health_goals')";
    if ($conn->query($sql) === TRUE) {
        echo "Profile updated successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
