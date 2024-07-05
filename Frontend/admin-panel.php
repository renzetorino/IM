<?php
session_start();

if (!isset($_SESSION['firstname'])) {
    header("Location: ADMIN-Log-In.php");
    exit();
}

    if(isset($_POST['Logout'])){
        session_destroy();
        header("location: Admin-Log-In.php");
    }
?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN-PANEL</title>
    <link rel="stylesheet" href="css/admin-panel-layout.css">
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

   

<div class="container my-5">
        <h2>USER INFO</h2>
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
                </tr>
            </thead>
            <tbody>
                <?php
                require_once "backend/User-Admin-access.php"; 
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>