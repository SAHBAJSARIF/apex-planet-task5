<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    
    $sql = "INSERT INTO posts (title, content) VALUES ('$title', '$content')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Post</title>
</head>
<body>
    <h2>Add New Post</h2>
    <form method="POST">
        <input type="text" name="title" placeholder="Post Title" required><br><br>
        <textarea name="content" placeholder="Post Content" rows="5" cols="40" required></textarea><br><br>
        <button type="submit">Add Post</button>
    </form>
    <a href="index.php">Back to Posts</a>
</body>
</html>