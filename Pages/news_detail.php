<?php
session_start();

if (!isset($_GET['id'])) {
    die("News not found.");
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dota_stat";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

$id = (int)$_GET['id'];
$sql = "SELECT title, img_url, content, author_id, created_at FROM news WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    die("News not found.");
}

$news = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/news_detail.css">
    <title><?= htmlspecialchars($news['title']) ?></title>
</head>
<body class="container">
    <header>
        <a href="news.php">Back to News</a>
    </header>
    <div class="news-detail">
        <h1><?= htmlspecialchars($news['title']) ?></h1>
        <img src="<?= htmlspecialchars($news['img_url']) ?>" alt="<?= htmlspecialchars($news['title']) ?>">
        <p><?= htmlspecialchars_decode($news['content']) ?></p>
        <p>Published on: <?= $news['created_at'] ?></p>
    </div>
</body>
</html>

<?php $conn->close(); ?>
