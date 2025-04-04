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
$stmt = $conn->prepare("SELECT news.id, news.title, news.img_url, news.created_at, news.content, users.username 
                        FROM news 
                        LEFT JOIN users ON news.author_id = users.id 
                        WHERE news.id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

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
        <p>By <?= htmlspecialchars($news['username'] ?? 'Unknown') ?> on <?= strftime('%B %d %Y', strtotime($news['created_at'])) ?></p>
        <img src="<?= htmlspecialchars($news['img_url']) ?>" alt="<?= htmlspecialchars($news['title']) ?>">
        <p><?= htmlspecialchars_decode($news['content']) ?></p>
    </div>
</body>
</html>

<?php $conn->close(); ?>
