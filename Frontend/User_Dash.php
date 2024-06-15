<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: Log-In.php");
    exit();
}
include 'database.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logout'])) {
    session_destroy();
    header("Location: Log-In.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard | Codehal</title>
    <link rel="stylesheet" href="CSS/User_dash.css">
</head>
<body>
<div class="tab">
    <div class="sidebar">
        <div class="logo-tab">
            <div class="logo"></div>
            <div class="logo-name">Logo Name</div>
        </div>
        <div class="profile-frame">
            <div class="profile-picture-frame">
                <div class="ellipse-2"></div>
                <img class="profile-vector" src="images/Vector0.png" alt="Profile Picture" />
                <img class="add" src="images/Component1.png" alt="Add Component" />
            </div>
            <div class="text-18"><?php echo $_SESSION['username']; ?></div>
        </div>
    </div>
    <div class="main">
        <div class="header">
            <div class="group-2">
                <form method="POST">
                    <button type="submit" name="logout" class="next">LOG OUT</button>
                </form>
            </div>
            <img class="vector2" src="images/Vector1.png" alt="Header Image" />
        </div>
        <div class="frame-14">
            <div class="text-24">Dashboard</div>
        </div>
        <div class="frame-12">
            <div class="frame-13">
                <div class="text-18">List of Safehouses</div>
                <div class="sh-box">
                    <div class="sh-name">
                        <div class="text-18">Safehouse name</div>
                        <div class="status">
                            <div class="text-18">Status</div>
                            <div class="input-box"></div>
                        </div>
                    </div>
                    <div class="sh-detail">
                        <div class="text-18">Contact Number</div>
                        <div class="input-box"></div>
                        <div class="text-18">Location</div>
                        <div class="input-box"></div>
                    </div>
                    <div class="register">
                        <div id="overlay" onclick="off()">
                            <div class="sh-detail">
                                <div class="text-18">Safehouse</div>
                                <div class="input-box"></div>
                                <div class="text-18">Room</div>
                                <div class="input-box"></div>
                                <div class="register">
                                    <button class="text-16">Register</button>
                                </div>
                            </div>
                        </div>
                        <button class="text-16" onclick="on()">Register</button>
                    </div>
                </div>
                <script src="js/User_Dash.js"></script>
            </div>
        </div> 
    </div>
</div> 
</body>
</html>
