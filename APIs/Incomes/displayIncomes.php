<?php
include ('../connection.php');

$sql = "SELECT * FROM incomes";
$result = $connection->query($sql);

$incomes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $incomes[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($incomes);
$connection->close();
?>