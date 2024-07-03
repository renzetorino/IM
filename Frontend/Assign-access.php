<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    require_once "database.php"; 

    $query = "SELECT *, USER_INFO.Username, Rooms.RoomName
                FROM assignedsafehouseandrooms
                JOIN USER_INFO ON assignedsafehouseandrooms.UserID = USER_INFO.UserID
                JOIN Rooms ON assignedsafehouseandrooms.RoomID = Rooms.RoomID";
    $statement = $pdo->query($query); 

    if (!$statement){
        die("Invalid query: " . $pdo->errorInfo());
    }
    while($row = $statement->fetch(PDO::FETCH_ASSOC)){
        echo "<tr>
                <td>{$row['AssignmentID']}</td>
                <td>{$row['Username']}</td>
                <td>{$row['RoomName']}</td>
                <td>{$row['Current_STATUS']}</td>
                <td>{$row['AssignedTIME']}</td>
                <td>
                    <a class='btn btn-primary btn-sm' href='update-assign.php?id={$row['AssignmentID']}'>EDIT</a>
                    <a class='btn btn-danger btn-sm' href='delete-user.php?id={$row['AssignmentID']}'>DELETE</a>
                </td>
              </tr>";
    }
    echo "</table>";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
