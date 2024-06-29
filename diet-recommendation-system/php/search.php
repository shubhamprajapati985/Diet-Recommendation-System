<?php
header('Content-Type: application/json');
include 'config.php';

$query = $_GET['query'];

$sql = "SELECT * FROM foods WHERE name LIKE '%$query%'";
$result = $conn->query($sql);

$foods = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $foods[] = $row;
    }
}

echo json_encode($foods);
?>
