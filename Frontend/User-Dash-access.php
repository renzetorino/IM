<?php
session_start();
include 'database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: Log-In.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $userID = $_SESSION['user_id'];
    $roomID = $_POST['room_id'];
    $currentStatus = 1;

    $stmt = $pdo->prepare("SELECT RoomID FROM Rooms WHERE RoomID = ?");
    $stmt->execute([$roomID]);
    if ($stmt->rowCount() == 0) {
        echo "Invalid RoomID.";
        exit();
    }

    $sql = "INSERT INTO AssignedSafehouseandRooms (UserID, RoomID, Current_STATUS) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userID, $roomID, $currentStatus]);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logout'])) {
    session_destroy();
    header("Location: Log-In.php");
    exit();
}
?>