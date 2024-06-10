<?php
include 'database.php';

if (isset($_POST['add_room'])) {
    $room_name = $_POST['room_name'];
    $capacity = $_POST['capacity'];
    $safehouse_id = $_POST['safehouse_id'];
    $room_type_id = $_POST['room_type_id'];

    $sql = "INSERT INTO Rooms (RoomName, CAPACITY, SafeHouseID, ROOMTYPE_ID) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $room_name);
    $stmt->bindParam(2, $capacity);
    $stmt->bindParam(3, $safehouse_id);
    $stmt->bindParam(4, $room_type_id);

    if ($stmt->execute()) {
        header("Location: admin-panel-safehouses.php");
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
}
?>
