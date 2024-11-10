<?php
include ('../connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $budget = $_POST['budget'];

    $sql = "INSERT INTO users (name, budget) VALUES (?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('si', $name, $budget);

    if ($stmt->execute()) {
        echo json_encode(["message" => "User created successfully"]);
    } else {
        echo json_encode(["error" => "Failed to create user"]);
    }

    $stmt->close();
    $connection->close();
}
?>