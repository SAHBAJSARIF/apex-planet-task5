<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM posts WHERE id=$id";
$result = mysqli_query($conn, $sql);
$post = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    
    $sql = "UPDATE posts SET title='$title', content='$content' WHERE id=$id";
    
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
    <title>Edit Post</title>
</head>
<body>
    <h2>Edit Post</h2>
    <form method="POST">
        <input type="text" name="title" value="<?php echo $post['title']; ?>" required><br><br>
        <textarea name="content" rows="5" cols="40" required><?php echo $post['content']; ?></textarea><br><br>
        <button type="submit">Update Post</button>
    </form>
    <a href="index.php">Back to Posts</a>
</body>
</html>