<?php
include 'database.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: Log-In.php");
    exit();
}

$userID = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT Rooms.RoomID, Rooms.RoomName, Safe_Houses.SafeHouseName 
                       FROM AssignedSafehouseandRooms 
                       JOIN Rooms ON AssignedSafehouseandRooms.RoomID = Rooms.RoomID
                       JOIN Safe_Houses ON Rooms.SafeHouseID = Safe_Houses.SafeHouseID
                       WHERE AssignedSafehouseandRooms.UserID = ? AND AssignedSafehouseandRooms.Current_STATUS = 1");
$stmt->execute([$userID]);
$assignedRoom = $stmt->fetch(PDO::FETCH_ASSOC);


$assignedRoomID = $assignedRoom ? $assignedRoom['RoomID'] : null;


$safeHouses = [];
$safeHouseStmt = $pdo->query("SELECT * FROM Safe_Houses");
$safeHouseData = $safeHouseStmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($safeHouseData as $safeHouse) {
    $safeHouseID = $safeHouse['SafeHouseID'];
    $roomStmt = $pdo->prepare("SELECT Rooms.*, roomtype.ROOMTYPE_NAME 
                               FROM Rooms 
                               JOIN roomtype ON Rooms.ROOMTYPE_ID = roomtype.ROOMTYPE_ID 
                               WHERE Rooms.SafeHouseID = ?");
    $roomStmt->execute([$safeHouseID]);
    $rooms = $roomStmt->fetchAll(PDO::FETCH_ASSOC);
    $safeHouse['rooms'] = $rooms;
    $safeHouses[] = $safeHouse;
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    if ($assignedRoomID) {
        echo "You have already registered for a room.";
        exit();
    }

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

    $_SESSION['assignedRoomID'] = $roomID;

   
    header("Location: User_Dash.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logout'])) {
    session_destroy();
    header("Location: Log-In.php");
    exit();
}
?>
