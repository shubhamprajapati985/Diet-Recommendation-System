<?php
session_start();
include 'config.php';

// Ensure the user is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    die("Access denied!");
}

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'get_users':
        getUsers($conn);
        break;
    case 'get_profiles':
        getProfiles($conn);
        break;
    case 'delete_user':
        $user_id = $_GET['id'] ?? 0;
        deleteUser($conn, $user_id);
        break;
    default:
        echo "Invalid action!";
        break;
}

function getUsers($conn) {
    $sql = "SELECT id, username, email, role FROM users";
    $result = $conn->query($sql);

    $users = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }

    echo json_encode($users);
}

function getProfiles($conn) {
    $sql = "SELECT * FROM user_profiles";
    $result = $conn->query($sql);

    $profiles = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $profiles[] = $row;
        }
    }

    echo json_encode($profiles);
}

function deleteUser($conn, $user_id) {
    // Delete user
    $sql = "DELETE FROM users WHERE id='$user_id'";
    if ($conn->query($sql) === TRUE) {
        // Delete user profile
        $sql = "DELETE FROM user_profiles WHERE user_id='$user_id'";
        $conn->query($sql);

        echo "User deleted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
