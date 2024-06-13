<?php
include 'database.php';

if (isset($_POST['add_safehouse'])) {
    $name = $_POST['safehouse_name'];
    $location = $_POST['location'];
    $contact_number = $_POST['contact_number'];
    $status = $_POST['status'];

    $sql = "INSERT INTO Safe_Houses (SafeHouseName, Location, ContactNumber, Status) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $location);
    $stmt->bindParam(3, $contact_number);
    $stmt->bindParam(4, $status);

    if ($stmt->execute()) {
        header("Location: admin-panel-safehouses.php");
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
}
?>
