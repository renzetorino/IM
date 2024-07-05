<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    require_once "database.php";

    if (isset($safehouses) && $safehouses) {
        $result = $pdo->query("SELECT * FROM Safe_Houses");
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>{$row['SafeHouseID']}</td>
                    <td>{$row['SafeHouseName']}</td>
                    <td>{$row['Location']}</td>
                    <td>{$row['ContactNumber']}</td>
                    <td>" . ($row['Status'] ? 'Active' : 'Inactive') . "</td>
                </tr>";
        }
    }

    if (isset($rooms) && $rooms) {
        $result = $pdo->query("SELECT Rooms.*, Safe_Houses.SafeHouseName, ROOMTYPE.ROOMTYPE_NAME 
                        FROM Rooms 
                        JOIN Safe_Houses ON Rooms.SafeHouseID = Safe_Houses.SafeHouseID
                        JOIN ROOMTYPE ON Rooms.ROOMTYPE_ID = ROOMTYPE.ROOMTYPE_ID");
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>{$row['RoomID']}</td>
                    <td>{$row['RoomName']}</td>
                    <td>{$row['CAPACITY']}</td>
                    <td>{$row['SafeHouseName']}</td>
                    <td>{$row['ROOMTYPE_NAME']}</td>
                </tr>";
            }
        }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

