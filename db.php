<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$conn = mysqli_connect("localhost", "root", "", "forum_db");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>