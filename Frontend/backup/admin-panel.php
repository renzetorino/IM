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
    <link rel="stylesheet" href="admin_panel.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

</head>
<body>
<body>
<div class="frame-6">
    <div class="frame-8">
        <div class="frame-9">
            <div class="frame-3">
                <div class="ellipse-1"></div>
                <div class="logo-name">Logo Name</div>
            </div>
            <div class="frame-2">
                <div class="group-12">
                    <div class="ellipse-12"></div>
                    <img class="vector" src="Vector0.png" />
                    <img class="component-1" src="Component 1.png" />
                </div>
                <div class="firstname-name">Admin</div>
            </div>
        </div>
        <div class="frame-4">
            <div class="dashboard">Dashboard</div>
        </div>
    </div>
    <div class="frame-10">
        <div class="frame-11">
            <div class="group-2">
                <button name="Logout" class="next">LOG OUT</button></div>
            <img class="vector2" src="Vector1.png" />
        </div>
        <div class="frame-14">
            <div class="dashboard2">Admin panel</div>
        </div>

        <div class="frame-12">
            <div class="frame-13">
                <div class="frame-30">
                    <form method="post">
                        <button name="Button2" class="buttons"><span class="text">USER INFO</span></button>
                        <button name="Button3" class="buttons"><span class="text">SAFEHOUSES</span></button>
                        <button name="Button4" class="buttons"><span class="text">ASSIGN</span></button>
                    </form>
                </div> 
            </div> 

            <?php
            if(isset($_POST['Logout'])){
                session_destroy();
                header("location: Admin-Log-In.php");
            }
            ?>
            <div class="container my-5">
                <h2>USER INFO</h2>
                    <!--<a class="btn btn-primary" href="create-safehouse.php" role="button">New SafeHouse</a>-->
                    <br>
                    <table class="table">   
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Username</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once "User-Admin-access.php"; 
                            ?>
                        </tbody>
                    </table>
            </div>
        </div> 
    </div>
</div>
</body>
</html>