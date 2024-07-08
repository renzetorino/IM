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
                    <td>
                    <form method='POST' action=''>
                        <input type='hidden' name='SafeHouseID' value='{$row['SafeHouseID']}'>
                        <select name='Status'>
                            <option value='1' " . ($row['Status'] ? 'selected' : '') . ">Active</option>
                            <option value='0' " . (!$row['Status'] ? 'selected' : '') . ">Inactive</option>
                        </select>
                        <button type='submit' name='updateStatus'>Update</button>
                    </form>
                </td>
                </tr>";
        }
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateStatus'])) {
        $safeHouseID = $_POST['SafeHouseID'];
        $status = $_POST['Status'];

        $updateQuery = "UPDATE Safe_Houses SET Status = :Status WHERE SafeHouseID = :SafeHouseID";
        $updateStmt = $pdo->prepare($updateQuery);
        $updateStmt->bindParam(':Status', $status, PDO::PARAM_INT);
        $updateStmt->bindParam(':SafeHouseID', $safeHouseID, PDO::PARAM_INT);

        if ($updateStmt->execute()) {
            echo "Status updated successfully.";
        } else {
            echo "Failed to update status.";
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

