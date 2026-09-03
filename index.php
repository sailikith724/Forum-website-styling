<?php
include "db.php";

$search = "";

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $where = "WHERE posts.title LIKE '%$search%' OR posts.content LIKE '%$search%'";
} else {
    $where = "";
}

$posts = mysqli_query($conn, "
    SELECT posts.*, users.name, categories.name AS category,
    (SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.id) AS comment_count
    FROM posts
    JOIN users ON posts.user_id = users.id
    JOIN categories ON posts.category_id = categories.id
    $where
    ORDER BY posts.created_at DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>ForumHub</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="navbar">
    <div class="logo">ForumHub</div>

    <nav>
        <a href="index.php">Home</a>

        <?php if(isset($_SESSION['user_id'])) { ?>
            <a href="create_post.php">Create Post</a>
            <a href="logout.php" class="logout-btn">Logout</a>
        <?php } else { ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php } ?>
    </nav>
</header>

<section class="hero">
    <div class="hero-content">
        <span>Professional Community Forum</span>
        <h1>Discuss. Learn. Share.</h1>
        <p>Ask questions, post ideas, comment on discussions and grow with the community.</p>

        <form class="search-box" method="GET">
            <input type="text" name="search" placeholder="Search discussions..." value="<?php echo $search; ?>">
            <button>Search</button>
        </form>
    </div>
</section>

<div class="container">
    <h2 class="main-title">Latest Discussions</h2>

    <div class="post-grid">
        <?php while($row = mysqli_fetch_assoc($posts)) { ?>
            <div class="post-card">
                <span class="category"><?php echo $row['category']; ?></span>

                <h3>
                    <a href="view_post.php?id=<?php echo $row['id']; ?>">
                        <?php echo $row['title']; ?>
                    </a>
                </h3>

                <p><?php echo substr($row['content'], 0, 130); ?>...</p>

                <div class="post-info">
                    <span>👤 <?php echo $row['name']; ?></span>
                    <span>❤️ <?php echo $row['likes']; ?></span>
                    <span>💬 <?php echo $row['comment_count']; ?></span>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<script>
const images = [
    "images/forum1.jpg",
    "images/forum2.jpg",
    "images/forum3.jpg",
    "images/forum4.jpg",
    "images/forum5.jpg"
];

let current = 0;
const hero = document.getElementById("hero");

function changeBackground() {
    hero.style.backgroundImage =
        "linear-gradient(rgba(8,17,31,0.75), rgba(37,99,235,0.65)), url('" +
        images[current] + "')";

    current = (current + 1) % images.length;
}

changeBackground();


setInterval(changeBackground, 5000);
</script>
</body>
</html>
<section class="hero" id="hero">
    <div class="hero-content">
        <span>Professional Community Forum</span>
        <h1>Discuss. Learn. Share.</h1>
        <p>Ask questions, post ideas, comment on discussions, and grow with the community.</p>
    </div>
</section>
<script>
const images = [
    "images/forum1.jpg",
    "images/forum2.jpg",
    "images/forum3.jpg",
    "images/forum4.jpg",
    "images/forum5.jpg"
];

let current = 0;

function changeBackground() {
    document.getElementById("hero").style.background =
        "linear-gradient(rgba(8,17,31,0.75), rgba(37,99,235,0.65)), url('" +
        images[current] + "') center/cover no-repeat";

    current++;
    if(current >= images.length){
        current = 0;
    }
}

changeBackground();
setInterval(changeBackground, 5000);
</script>

changeBackground();

// Change every 5 seconds
setInterval(changeBackground, 5000);
</script>
<section class="hero" id="hero">
    <div class="hero-content">
        <h1>Discuss. Learn. Share.</h1>
    </div>
</section>
document.getElementById("hero").style.background =
"url('images/forum1.jpg')";