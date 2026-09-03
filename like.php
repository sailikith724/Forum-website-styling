<?php
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$post_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$check = mysqli_query($conn, "SELECT * FROM post_likes WHERE post_id='$post_id' AND user_id='$user_id'");

if (mysqli_num_rows($check) == 0) {
    mysqli_query($conn, "INSERT INTO post_likes(post_id,user_id) VALUES('$post_id','$user_id')");
    mysqli_query($conn, "UPDATE posts SET likes = likes + 1 WHERE id='$post_id'");
}

header("Location: view_post.php?id=$post_id");
exit();
?>