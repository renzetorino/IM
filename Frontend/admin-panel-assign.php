<?php
session_start();

if (!isset($_SESSION['firstname'])) {
    header("Location: ADMIN-Log-In.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN-PANEL</title>
    <style>
        body{
            margin: 0px;
        }
        div.header{
            font-family: poppins;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0px 60px;
            background-color: lightblue;
        }
        div.header button{
            background-color: beige;
            font-size: 16px;
            font-weight: 550;
            padding: 8px 12px;
            border:2px solid black;
            border-radius: 5px;
        }
        div.Panels {
            text-align: center;
            margin-top: 20px; /* Adjust margin as needed */
            background-color: whitesmoke;
            border: 2px solid black;
        }
        div.Panels button {
            background-color: pink;
            font-size: 16px;
            font-weight: 550;
            padding: 12px 48px;
            border: 2px solid black;
            border-radius: 5px;
            margin: 100px; 
    }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class = "header">
        <H1>Admin panel = <?php echo $_SESSION['firstname']?></H1>
        <form method = "post"   >
            <button name = "Logout">LOG OUT</button>
        </form>
    </div>

    <div class="Panels">
        <form method="post" action ="admin-panel.php" style="display: inline-block;">
            <button name="Button2">USER INFO</button>
        </form>
        <form method="post" action="admin-panel-safehouses.php" style="display: inline-block;">
            <button name="Button3">SAFEHOUSES</button>
        </form>
        <form method="post" action="admin-panel-assign.php" style="display: inline-block;">
            <button name="Button4">ASSIGN</button>
        </form>
       
    </div>

    <?php
    if(isset($_POST['Logout'])){
        session_destroy();
        header("location: Admin-Log-In.php");
    }
    ?>

<div class="container my-5">
        <h2>Assigned Safe house and rooms</h2>
        <br>
        <table class="table">
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
            <tbody>
                <?php
                require_once "Assign-access.php"; 
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>