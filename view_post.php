<?php
include "db.php";

$id = $_GET['id'];

$post = mysqli_query($conn, "
    SELECT posts.*, users.name, categories.name AS category
    FROM posts
    JOIN users ON posts.user_id = users.id
    JOIN categories ON posts.category_id = categories.id
    WHERE posts.id='$id'
");

$row = mysqli_fetch_assoc($post);

if (isset($_POST['comment'])) {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    $comment = mysqli_real_escape_string($conn, $_POST['comment_text']);
    $user_id = $_SESSION['user_id'];

    mysqli_query($conn, "INSERT INTO comments(post_id,user_id,comment)
    VALUES('$id','$user_id','$comment')");

    header("Location: view_post.php?id=$id");
    exit();
}

$comments = mysqli_query($conn, "
    SELECT comments.*, users.name
    FROM comments
    JOIN users ON comments.user_id = users.id
    WHERE comments.post_id='$id'
    ORDER BY comments.created_at DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="navbar">
    <div class="logo">ForumHub</div>
    <nav>
        <a href="index.php">Home</a>
        <a href="create_post.php">Create Post</a>
        <?php if(isset($_SESSION['user_id'])) { ?>
            <a href="logout.php" class="logout-btn">Logout</a>
        <?php } else { ?>
            <a href="login.php">Login</a>
        <?php } ?>
    </nav>
</header>

<div class="container">
    <div class="detail-card">
        <span class="category"><?php echo $row['category']; ?></span>
        <h1><?php echo $row['title']; ?></h1>
        <p><?php echo nl2br($row['content']); ?></p>

        <div class="post-info">
            <span>👤 <?php echo $row['name']; ?></span>
            <span>❤️ <?php echo $row['likes']; ?> Likes</span>
        </div>

        <a href="like.php?id=<?php echo $row['id']; ?>" class="like-btn">Like Post</a>
    </div>

    <div class="comment-section">
        <h2>Comments</h2>

        <form method="POST">
            <textarea name="comment_text" placeholder="Write your comment..." required></textarea>
            <button name="comment">Add Comment</button>
        </form>

        <?php while($c = mysqli_fetch_assoc($comments)) { ?>
            <div class="comment-card">
                <b><?php echo $c['name']; ?></b>
                <p><?php echo $c['comment']; ?></p>
            </div>
        <?php } ?>
    </div>
</div>

</body>
</html>