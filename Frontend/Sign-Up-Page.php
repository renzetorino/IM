<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form in HTML and CSS | Codehal</title>
    <link rel="stylesheet" href="CSS/Sign-Up-Page-Layout.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

    <div class="wrapper">
        <form action="backend/SIGNUP.php" method="post">
            <h1>Sign Up</h1>
            <div class="input-box">
                <input type="text" name="Username" placeholder="Username" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="text" name="Firstname" placeholder="Firstname" required>
                <i class='bx bxs-envelope'></i>
            </div>
            <div class="input-box">
                <input type="text" name="Lastname" placeholder="Lastname" required>
                <i class='bx bxs-envelope'></i>
            </div>
            <div class="input-box">
                <input type="text" name="Address" placeholder="Address" required>
                <i class='bx bxs-envelope'></i>
            </div>
            <div class="input-box">
                <input type="email" name="Email" placeholder="Email" required>
                <i class='bx bxs-envelope'></i>
            </div>
            <div class="input-box">
                <input type="password" name="Password" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <button type="submit" class="btn">Sign Up</button>
            
            <div class="register-link">
                <p>Already have an account? <a href="Log-In.php">Login</a></p>
            </div>
        </form>
    </div>

</body>
</html>
