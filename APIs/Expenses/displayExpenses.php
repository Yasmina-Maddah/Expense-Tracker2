<?php
require_once '../Database/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $expense_id = $_POST['id'];

    $sql = "DELETE FROM expenses WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('i', $expense_id);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Expense deleted successfully"]);
    } else {
        echo json_encode(["error" => "Failed to delete expense"]);
    }

    $stmt->close();
    $connection->close();
}
?>