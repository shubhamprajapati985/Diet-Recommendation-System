<?php
header('Content-Type: application/json');
include 'config.php';

$sql = "SELECT * FROM user_profiles";
$result = $conn->query($sql);

$profiles = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $profiles[] = $row;
    }
}

echo json_encode($profiles);
?>
