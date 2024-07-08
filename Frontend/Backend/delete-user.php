<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    require_once "database.php";

    
    if (isset($_GET['id'])) {
        $UserID = $_GET['id'];

        $query = "DELETE FROM user_info WHERE UserID = :UserID";
        $statement = $pdo->prepare($query);

        
        $statement->bindParam(':UserID', $UserID, PDO::PARAM_INT);

        if ($statement->execute()) {
            $_SESSION['message'] = "User data deleted succesfully.";
        } else {
            $_SESSION['message'] = "Failed to delete user data.";
        }
    } else {
        $_SESSION['message'] = "Invalid request.";
    }
} catch (PDOException $e) {
    $_SESSION['message'] = "Error: " . $e->getMessage();
}


header("Location: ../admin-panel.php");
exit();
?>
