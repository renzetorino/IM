<?php
include 'database.php';

$querySafeHouses = "SELECT * FROM safe_houses";
$resultSafeHouses = $pdo->query($querySafeHouses); // Use $pdo instead of $conn

$safeHouses = [];
if ($resultSafeHouses->rowCount() > 0) {
    while ($row = $resultSafeHouses->fetch(PDO::FETCH_ASSOC)) {
        $SafeHouseID = $row['SafeHouseID'];
        $queryRooms = "SELECT rooms.*, roomtype.ROOMTYPE_NAME FROM rooms 
                       JOIN roomtype ON rooms.ROOMTYPE_ID = roomtype.ROOMTYPE_ID
                       WHERE rooms.SafeHouseID = :SafeHouseID"; // Using named parameter
        $stmt = $pdo->prepare($queryRooms);
        $stmt->bindParam(':SafeHouseID', $SafeHouseID, PDO::PARAM_INT);
        $stmt->execute();
        $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $row['rooms'] = $rooms;
        $safeHouses[] = $row;
    }
}
?>


