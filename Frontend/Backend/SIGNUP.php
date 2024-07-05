<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $Username = $_POST["Username"];
    $Firstname = $_POST["Firstname"];
    $Lastname = $_POST["Lastname"];
    $Address = $_POST["Address"];
    $Email = $_POST["Email"];
    $Password = password_hash($_POST["Password"], PASSWORD_DEFAULT);
    try{
        require_once "database.php";

        $query = "INSERT INTO user_info (Username, FirstName, Lastname, Address, Email, Password) VALUES 
        (?,?,?,?,?,?);";

        $stmt = $pdo -> prepare($query);

        $stmt->execute([$Username, $Firstname, $Lastname, $Address, $Email, $Password]);

        $pdo = null;
        $stmt = null;

        header("Location: ../Log-In.php");

        die();
    } catch (PDOException $e){
        die("Query Failed: " . $e->getMessage());
    }
}else{
    header("Location: ../Sign-Up-Page.php");
}

header("Location: ../admin-panel-assign.php");