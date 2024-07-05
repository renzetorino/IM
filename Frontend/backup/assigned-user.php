<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    // Insert the registration data into the database
    $userId = $_SESSION['user_id'];
    $roomId = $_POST['room_id'];
    
    include 'db_connection.php'; // Your database connection file
    $sql = "INSERT INTO AssignedSafehouseandRooms (UserID, RoomID, Current_STATUS) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $currentStatus = 1; // Assuming 1 means active/registered
    $stmt->bind_param("iii", $userId, $roomId, $currentStatus);
    $stmt->execute();
    
    $stmt->close();
    $conn->close();
    
    // Redirect back to the dashboard after registration
    header("Location: user_dashboard.php");
    exit();
} else {
    // Handle any validation or error messages if needed
   
    header("Location: user_dashboard.php"); // Redirect to dashboard if not submitted properly
    exit();
}
?>
