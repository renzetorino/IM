<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Username = $_POST["Username"];
    $Password = $_POST["Password"];

    try {
        require_once "database.php"; 

        
        $query = "SELECT STAFFID FROM baranggay_staff WHERE Username = ? AND Password = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$Username, $Password]);

        
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            
            $_SESSION['staffID'] = $user['STAFFID'];
            $_SESSION['username'] = $Username;

            
            header("Location: Profile-Page.php");
            exit();
        } else {
            
            $_SESSION['error'] = "Invalid username or password.";
            header("Location: ADMIN-Log-In.php");
            exit();
        }
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    } finally {
        
        if (isset($stmt)) {
            $stmt = null;
        }
        if (isset($pdo)) {
            $pdo = null;
        }
    }
} else {
    header("Location: ADMIN-Log-In.php");
    exit();
}
?>


