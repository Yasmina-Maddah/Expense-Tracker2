<?php
include ('../connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $income_id = $_POST['id'];

    $sql = "DELETE FROM incomes WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('i', $income_id);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Income deleted successfully"]);
    } else {
        echo json_encode(["error" => "Failed to delete income"]);
    }

    $stmt->close();
    $connection->close();
}
?>