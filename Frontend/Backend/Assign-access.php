<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    require_once "database.php"; 

    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $query = "SELECT *, USER_INFO.Username, Rooms.RoomName
                FROM assignedsafehouseandrooms
                JOIN USER_INFO ON assignedsafehouseandrooms.UserID = USER_INFO.UserID
                JOIN Rooms ON assignedsafehouseandrooms.RoomID = Rooms.RoomID
                WHERE USER_INFO.Username LIKE :search OR Rooms.RoomName LIKE :search";
    
    $statement = $pdo->prepare($query);
    $statement->execute(array(':search' => '%' . $search . '%'));

    if (!$statement){
        die("Invalid query: " . $pdo->errorInfo());
    }

    echo "<table class='table'>
            <thead>
                <tr>
                    <th>AssignmentID</th>
                    <th>Username</th>
                    <th>RoomName</th>
                    <th>Current_STATUS</th>
                    <th>AssignedTIME</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>";

    while($row = $statement->fetch(PDO::FETCH_ASSOC)){
        echo "<tr>
                <td>{$row['AssignmentID']}</td>
                <td>{$row['Username']}</td>
                <td>{$row['RoomName']}</td>
                <td>{$row['Current_STATUS']}</td>
                <td>{$row['AssignedTIME']}</td>
                <td>
                    
                    <a class='btn btn-danger btn-sm' href='backend/delete-assign.php?id={$row['AssignmentID']}'>DELETE</a>
                </td>
              </tr>";
    }
    echo "</tbody></table>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
