<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Username = $_POST["Username"];
    $Password = $_POST["Password"];

    try {
        require_once "database.php"; 

        $query = "SELECT UserID, Password FROM user_info WHERE Username = ?";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$Username]);

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $hashed_password = $user['Password'];

            if (password_verify($Password, $hashed_password)) {
                $_SESSION['user_id'] = $user['UserID'];
                $_SESSION['username'] = $Username;
                header("Location: ../User_Dash.php");
                exit();
            } else {
                $_SESSION['error'] = "Invalid password.";
                header("Location:  ../Log-In.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "No user found with that username.";
            header("Location: ../Log-In.php");
            exit();
        }

        $pdo = null;
        $stmt = null;
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
} else {
    header("Location: ../Log-In.php"); 
    exit();
}
?>


