<?php
include ('../connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $amount = $_POST['amount'];
    $note = $_POST['note'];
    $date = $_POST['date'];

    $sql = "UPDATE expenses SET amount = ?, note = ?, date = ? WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('issi', $amount, $note, $date, $id);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Expense updated successfully"]);
    } else {
        echo json_encode(["error" => "Failed to update expense"]);
    }

    $stmt->close();
    $connection->close();
}
?>