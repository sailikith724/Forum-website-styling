# System Architecture & Dev Forum

A simple **Interactive Developer Discussion Forum** developed using **PHP, MySQL, HTML, CSS, and JavaScript**.

The application allows users to create discussion threads by entering a display name, topic title, and message. All posts are stored in a MySQL database and displayed dynamically on the forum page.

## 📌 Project Overview

The **System Architecture & Dev Forum** is designed as a basic discussion platform for developers and students to:

* Discuss technical concepts
* Share research and ideas
* Ask questions
* Create discussion threads
* Read previously submitted discussions

The project uses **PHP PDO** to securely communicate with a MySQL database.

## ✨ Features

* Create new discussion threads
* Enter a display name
* Add a topic title
* Write a detailed message
* Store posts in MySQL
* Display recent threads
* Automatically display post date and time
* Latest posts displayed first
* Secure output using `htmlspecialchars()`
* Prepared SQL statements using PDO
* Post/Redirect/Get pattern
* Automatic rotating background images
* Background image changes every 5 seconds
* Frosted-glass card design
* Responsive layout

## 🛠️ Technologies Used

* **HTML5** – Web page structure
* **CSS3** – Styling and responsive interface
* **PHP** – Server-side processing
* **MySQL** – Database storage
* **PDO** – Secure database connection
* **JavaScript** – Automatic background slideshow
* **XAMPP** – Apache, PHP, and MySQL environment

## 📂 Project Structure

```text
dev_forum/
│
├── index.php
├── db.php
└── style.css
```

## 📄 Main Files

### `index.php`

The main page of the forum.

It performs the following operations:

* Loads the database connection
* Accepts form submissions
* Validates required fields
* Inserts new posts into MySQL
* Redirects after successful submission
* Retrieves existing posts
* Displays posts from newest to oldest
* Escapes user-generated content
* Runs the background-image slideshow

### `db.php`

Creates the connection between PHP and MySQL using **PDO**.

Database configuration:

```php
$host = '127.0.0.1';
$db   = 'forum_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';
```

The PDO connection uses:

```php
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
```

### `style.css`

Contains the visual design of the application.

It includes styling for:

* Page background
* Dark background overlay
* Header
* Forum form
* Input fields
* Textarea
* Submit button
* Discussion cards
* Post headers
* Post dates
* Post author
* Hover effects
* Frosted-glass effect

## 🗄️ Database Setup

Create the database:

```sql
CREATE DATABASE forum_db;
```

Select it:

```sql
USE forum_db;
```

Create the `posts` table:

```sql
CREATE TABLE posts (
    id INT(11) NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    topic_title VARCHAR(150) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);
```

## 📝 Sample Data

You can insert a sample post using:

```sql
INSERT INTO posts
(username, topic_title, message)
VALUES
('karthikeswaran19', 'k jiy8b', 'j 9');
```

The `id` and `created_at` fields will be generated automatically.

## 💬 Creating a New Thread

Users can create a discussion by entering:

1. **Display Name**
2. **Topic Title**
3. **Message**

The form uses:

```html
<form action="index.php" method="POST">
```

PHP checks whether all required fields contain values:

```php
if (
    $_SERVER["REQUEST_METHOD"] == "POST" &&
    !empty($_POST['username']) &&
    !empty($_POST['topic_title']) &&
    !empty($_POST['message'])
) {
```

## 💾 Saving Posts

New posts are inserted using a **PDO prepared statement**:

```php
$stmt = $pdo->prepare(
    "INSERT INTO posts (username, topic_title, message)
     VALUES (?, ?, ?)"
);

$stmt->execute([
    $_POST['username'],
    $_POST['topic_title'],
    $_POST['message']
]);
```

Using prepared statements is safer than directly inserting user input into an SQL query.

## 🔄 Post/Redirect/Get Pattern

After successfully adding a post, the application redirects back to the main page:

```php
header("Location: index.php");
exit();
```

This helps prevent duplicate form submissions when the user refreshes the page.

## 📥 Retrieving Posts

Existing forum posts are retrieved using:

```php
$stmt = $pdo->query(
    "SELECT * FROM posts ORDER BY created_at DESC"
);

$posts = $stmt->fetchAll();
```

The newest discussions are therefore displayed first.

## 🔒 Output Security

User-generated information is displayed using:

```php
htmlspecialchars()
```

For example:

```php
<?= htmlspecialchars($post['topic_title']) ?>
```

Messages use:

```php
<?= nl2br(htmlspecialchars($post['message'])) ?>
```

This preserves line breaks while safely displaying user content.

## 📅 Date and Time

The application formats the post creation date using:

```php
date(
    'M j, Y, g:i a',
    strtotime($post['created_at'])
)
```

Example:

```text
Jun 11, 2026, 11:49 am
```

## 🖼️ Background Slideshow

JavaScript automatically rotates the website background.

The background changes every:

```text
5000 milliseconds = 5 seconds
```

The rotation is handled using:

```javascript
setInterval(() => {
    currentIndex = (currentIndex + 1) % imageArray.length;
    document.body.style.backgroundImage =
        imageArray[currentIndex];
}, 5000);
```

Images are also preloaded to reduce flickering during transitions.

## 🎨 User Interface

The application uses a modern interface with:

* Full-screen background images
* Dark transparent overlay
* White headings
* Frosted-glass forum cards
* Blue accent colors
* Hover animations
* Focus effects
* Rounded corners
* Shadows

Important CSS variables include:

```css
:root {
    --primary-bg: #f4f7f6;
    --accent-color: #2563eb;
    --accent-hover: #1d4ed8;
    --text-main: #333333;
    --text-muted: #6b7280;
    --border-color: #e5e7eb;
}
```

## ⚙️ Installation

### Step 1: Install XAMPP

Install **XAMPP** with:

* Apache
* MySQL
* PHP

### Step 2: Create the Project Folder

Place the project inside:

```text
xampp/htdocs/dev_forum/
```

Add:

```text
index.php
db.php
style.css
```

### Step 3: Start the Server

Open the XAMPP Control Panel and start:

```text
Apache
MySQL
```

### Step 4: Create the Database

Open **phpMyAdmin** and create:

```text
forum_db
```

Then create the `posts` table using the SQL provided above.

### Step 5: Check Database Connection

Make sure `db.php` contains:

```php
$host = '127.0.0.1';
$db   = 'forum_db';
$user = 'root';
$pass = '';
```

Change the username or password if your MySQL configuration is different.

### Step 6: Run the Project

Open your browser and visit:

```text
http://localhost/dev_forum/
```

## 🔄 Application Workflow

```text
Open Dev Forum
       ↓
Load Existing Posts
       ↓
Enter Display Name
       ↓
Enter Topic Title
       ↓
Enter Message
       ↓
Submit Form
       ↓
Validate Input
       ↓
Insert Post into MySQL
       ↓
Redirect to index.php
       ↓
Display Newest Post
```

## 📊 Database Table

The `posts` table contains:

| Field         | Type         | Description          |
| ------------- | ------------ | -------------------- |
| `id`          | INT          | Unique post ID       |
| `username`    | VARCHAR(50)  | Display name of user |
| `topic_title` | VARCHAR(150) | Discussion title     |
| `message`     | TEXT         | Discussion content   |
| `created_at`  | TIMESTAMP    | Date and time posted |

## 🚀 Future Enhancements

The project can be improved by adding:

* User registration and login
* Admin dashboard
* Edit posts
* Delete posts
* Comments and replies
* Likes and reactions
* Topic categories
* Search functionality
* User profiles
* Pagination
* Image uploads
* Email notifications
* Dark mode
* Better mobile responsiveness

## 🎯 Project Objective

The main objective of this project is to demonstrate the development of a simple **interactive discussion forum using PHP and MySQL**.

The project demonstrates:

* PHP form handling
* PDO database connectivity
* MySQL CRUD concepts
* Prepared SQL statements
* Dynamic content rendering
* Input/output security
* HTML forms
* CSS interface design
* JavaScript background animation
* Post/Redirect/Get pattern

## 👨‍💻 Project Type

**PHP & MySQL Mini Project – Interactive Dev Forum**

## 📜 License

This project is created for **educational and academic purposes**.
