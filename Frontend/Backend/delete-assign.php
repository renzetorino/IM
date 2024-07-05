<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    require_once "database.php";

    // Check if 'id' is set in the query string
    if (isset($_GET['id'])) {
        $AssignmentID = $_GET['id'];

        $query = "DELETE FROM assignedsafehouseandrooms WHERE AssignmentID = :AssignmentID";
        $statement = $pdo->prepare($query);

        // Bind the AssignmentID parameter
        $statement->bindParam(':AssignmentID', $AssignmentID, PDO::PARAM_INT);

    } else {
        $_SESSION['message'] = "Invalid request.";
    }
} catch (PDOException $e) {
    $_SESSION['message'] = "Error: " . $e->getMessage();
}

// Redirect to the admin panel
header("Location: ../admin-panel-assign.php");
exit();
?>
