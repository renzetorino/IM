<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $userId = $_SESSION['user_id'];
    $roomId = $_POST['room_id'];
    
    include 'db_connection.php'; 
    $sql = "INSERT INTO AssignedSafehouseandRooms (UserID, RoomID, Current_STATUS) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $currentStatus = 1; // 
    $stmt->bind_param("iii", $userId, $roomId, $currentStatus);
    $stmt->execute();
    
    $stmt->close();
    $conn->close();
    
   
    header("Location: user_dashboard.php");
    exit();
} else {
    
    header("Location: user_dashboard.php"); 
    exit();
}
?>
