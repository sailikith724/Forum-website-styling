<?php
include "db.php";

$msg = "";

if (isset($_POST['register'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if (mysqli_num_rows($check) > 0) {
        $msg = "Email already exists";
    } else {
        mysqli_query($conn, "INSERT INTO users(name,email,password) VALUES('$name','$email','$password')");
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - ForumHub</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="auth-body">

<div class="auth-wrapper">
    <div class="auth-banner">
        <h1>Join ForumHub</h1>
        <p>Create your account and start discussions.</p>
    </div>

    <div class="auth-card">
        <h2>Create Account</h2>

        <?php if($msg != "") { ?>
            <div class="error-box"><?php echo $msg; ?></div>
        <?php } ?>

        <form method="POST">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <button name="register">Register</button>
        </form>

        <p>Already have account? <a href="login.php">Login</a></p>
    </div>
</div>

</body>
</html>