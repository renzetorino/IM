<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Username = $_POST["Username"];
    $Password = $_POST["Password"];

    try {
        require_once "database.php"; 

      
        $query = "SELECT STAFFID, Firstname, Password FROM baranggay_staff WHERE Username = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$Username]);

        
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            
            if ($Password === $user['Password']) { 
               
                $_SESSION['staffID'] = $user['STAFFID'];
                $_SESSION['username'] = $Username;
                $_SESSION['firstname'] = $user['Firstname']; 

                header("Location:../admin-panel.php");
                exit();
            } else {
                
                $_SESSION['error'] = "Invalid username or password.";
                header("Location: ../Admin-Log-In.php");
                exit();
            }
        } else {
            
            $_SESSION['error'] = "Invalid username or password.";
            header("Location: ../Admin-Log-In.php");
            exit();
        }
    } catch (PDOException $e) {
        
        $_SESSION['error'] = "An error occurred. Please try again later.";
        header("Location: ../Admin-Log-In.php");
        exit();
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



