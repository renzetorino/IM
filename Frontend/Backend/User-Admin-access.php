<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    require_once "database.php"; 

    $query = "SELECT * FROM user_info";
    $statement = $pdo->query($query); 

    if (!$statement){
        die("Invalid query: " . $pdo->errorInfo());
    }
    while($row = $statement->fetch(PDO::FETCH_ASSOC)){
        echo "<tr>
                <td>{$row['UserID']}</td>
                <td>{$row['Username']}</td>
                <td>{$row['Firstname']}</td>
                <td>{$row['Lastname']}</td>
                <td>{$row['Address']}</td>
                <td>{$row['Email']}</td>
                <td>{$row['created_at']}</td>
                <td>
                    
                    <a class='btn btn-danger btn-sm' href='backend/delete-user.php?id={$row['UserID']}'>DELETE</a>
                </td>
              </tr>";
    }
    echo "</table>";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
