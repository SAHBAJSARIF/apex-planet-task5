<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blog Posts</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <a href="create.php">Add New Post</a> | 
    <a href="logout.php">Logout</a>
    
    <h3>All Posts</h3>
    <?php while ($post = mysqli_fetch_assoc($result)) { ?>
        <div>
            <h4><?php echo $post['title']; ?></h4>
            <p><?php echo $post['content']; ?></p>
            <a href="edit.php?id=<?php echo $post['id']; ?>">Edit</a> | 
            <a href="delete.php?id=<?php echo $post['id']; ?>">Delete</a>
        </div>
        <hr>
    <?php } ?>
</body>
</html>