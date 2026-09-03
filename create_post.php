<?php
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$categories = mysqli_query($conn, "SELECT * FROM categories");

if (isset($_POST['post'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $category = $_POST['category'];
    $user_id = $_SESSION['user_id'];

    mysqli_query($conn, "INSERT INTO posts(user_id, category_id, title, content)
    VALUES('$user_id','$category','$title','$content')");

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="navbar">
    <div class="logo">ForumHub</div>
    <nav>
        <a href="index.php">Home</a>
        <a href="logout.php" class="logout-btn">Logout</a>
    </nav>
</header>

<div class="form-box">
    <h2>Create New Discussion</h2>

    <form method="POST">
        <input type="text" name="title" placeholder="Discussion Title" required>

        <select name="category" required>
            <option value="">Select Category</option>
            <?php while($cat = mysqli_fetch_assoc($categories)) { ?>
                <option value="<?php echo $cat['id']; ?>">
                    <?php echo $cat['name']; ?>
                </option>
            <?php } ?>
        </select>

        <textarea name="content" placeholder="Write your discussion..." required></textarea>

        <button name="post">Publish Post</button>
    </form>
</div>

</body>
</html>