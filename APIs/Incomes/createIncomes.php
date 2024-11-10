<?php
include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = $_POST['amount'];
    $note = $_POST['note'];
    $user_id = $_POST['user_id'];
    $date = $_POST['date'];

    $sql = "INSERT INTO incomes (amount, note, user_id, date) VALUES (?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('isis', $amount, $note, $user_id, $date);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Income created successfully"]);
    } else {
        echo json_encode(["error" => "Failed to create income"]);
    }

    $stmt->close();
    $connection->close();
}
?>