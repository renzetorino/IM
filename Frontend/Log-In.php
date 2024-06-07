<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form in HTML and CSS | Codehal</title>
    <link rel="stylesheet" href="Log-In.Layout2.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

        <div class="wrapper">
            <form action="LOGIN.php" method="POST">
                <h1>Login</h1>
                <div class="input-box">
                    <input type="text" name ="Username" placeholder="Username" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="Password" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>

                <div class="remember-forgot">
                    <label><input type="checkbox"> Remember me</label>
                    <a href="#">Forgot password?</a>
                </div>
                
                <?php
                session_start();
                if (isset($_SESSION['error'])) {
                    echo "<div class='error-message'>" . $_SESSION['error'] . "</div>";
                    unset($_SESSION['error']);
                }
            ?>

                <button type="submit" class="btn">Login</button>
                
                <div class="register-link">
                    <p>Don't have an account? <a href="Sign-Up-Page.php">Register</a></p>
                </div>
            </form>
        </div>
    
</body>
</html>