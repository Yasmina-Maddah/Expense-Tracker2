<?php
include '../connection.php';

$sql = "SELECT * FROM users";
$result = $connection->query($sql);

$users = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($users);
$connection->close();
?>