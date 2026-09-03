<?php
include "db.php";

$msg = "";

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: index.php");
            exit();
        } else {
            $msg = "Invalid password";
        }
    } else {
        $msg = "Email not found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - ForumHub</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="auth-body">

<div class="auth-wrapper">
    <div class="auth-banner">
        <h1>ForumHub</h1>
        <p>Discuss. Learn. Share.</p>
    </div>

    <div class="auth-card">
        <h2>Welcome Back</h2>

        <?php if($msg != "") { ?>
            <div class="error-box"><?php echo $msg; ?></div>
        <?php } ?>

        <form method="POST">
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <button name="login">Login</button>
        </form>

        <p>New user? <a href="register.php">Create Account</a></p>
    </div>
</div>

</body>
</html>