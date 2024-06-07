<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Username = $_POST["Username"];
    $Password = $_POST["Password"];

    try {
        require_once "database.php"; // Ensure this file sets up $pdo correctly

        // Prepare the SELECT query
        $query = "SELECT UserID, Password FROM user_info WHERE Username = ?";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$Username]);

        // Check if the user exists
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $hashed_password = $user['Password'];

            // Verify the provided password against the hashed password
            if (password_verify($Password, $hashed_password)) {
                // Set session variables
                $_SESSION['user_id'] = $user['UserID'];
                $_SESSION['username'] = $Username;

                // Redirect to the profile page
                header("Location: Profile-Page.php");
                exit();
            } else {
                // Invalid password
                $_SESSION['error'] = "Invalid password.";
                header("Location: Log-In.php");
                exit();
            }
        } else {
            // No user found with that username
            $_SESSION['error'] = "No user found with that username.";
            header("Location: Log-In.php");
            exit();
        }

        // Close the connection and statement
        $pdo = null;
        $stmt = null;
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
} else {
    header("Location: Log-In.php"); 
    exit();
}



