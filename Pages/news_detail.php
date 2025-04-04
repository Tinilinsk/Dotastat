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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'], $_POST['comment'])) {
    $comment = trim($_POST['comment']);
    if (!empty($comment)) {
        $stmt = $conn->prepare("INSERT INTO comments (news_id, user_id, content) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $id, $_SESSION['user_id'], $comment);
        $stmt->execute();
        header("Location: news_detail.php?id=$id");
        exit();
    }
}

$stmt = $conn->prepare("SELECT comments.content, comments.created_at, users.username 
                        FROM comments 
                        JOIN users ON comments.user_id = users.id 
                        WHERE comments.news_id = ? 
                        ORDER BY comments.created_at DESC");
$stmt->bind_param("i", $id);
$stmt->execute();
$comments_result = $stmt->get_result();
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
        <div class="header_menu">
            <div class="navigation_menu">
                <div class="logo">
                    <a href="index.php">
                    <svg width="120" height="32" xmlns="http://www.w3.org/2000/svg">
                    <rect x="0" y="0" width="120" height="32" fill="#ED3B1C"/>
                    <text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" font-family="Arial, sans-serif" font-size="20" fill="white" text-transform="uppercase">DOTASTAT</text>
                    </svg>
                        <!-- <span>DOTASTAT</span> -->
                    </a>    
                </div>
                <div class="navigation_item">
                    <ul class="navigation_list" style="list-style-type: none;">
                        <li>
                        <a href="heroes.php">Heroes</a>
                        </li>
                        <li>
                        <a href="">Items</a>
                        </li>
                        <li><a href="">Players</a></li>
                        <li>
                        <a href="">Matches</a>
                        </li>
                        <li>
                        <a href="news.php">News</a>
                        </li>
                    </ul>    
                </div>
            </div>
            <div class="small_menu">
                <div class="search_icon">
                    <a href="">
                        <i class="fa fa-search"></i>
                    </a>
                </div>
                <div class="registration">
                    <?php if (isset($_SESSION['username'])): ?>
                        <a href="profile.php"><?php echo htmlspecialchars($_SESSION['username']); ?></a>
                    <?php else: ?>
                        <a href="singIn.php">Sing In</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
    <div class="news-detail">
        <h1><?= htmlspecialchars($news['title']) ?></h1>
        <p>By <?= htmlspecialchars($news['username'] ?? 'Unknown') ?> on <?= date('F d, Y', strtotime($news['created_at'])) ?></p>
        <img src="<?= htmlspecialchars($news['img_url']) ?>" alt="<?= htmlspecialchars($news['title']) ?>">
        <p><?= htmlspecialchars_decode($news['content']) ?></p>
    </div>

    <div class="comments-section">
        <h2>Comments</h2>

        <?php if (isset($_SESSION['user_id'])): ?>
            <div class="comment-form-container">
                <form method="post" class="comment-form">
                    <textarea name="comment" rows="4" placeholder="Write your comment here..." required></textarea>
                    <button type="submit">Post Comment</button>
                </form>
            </div>
        <?php else: ?>
            <p><a href="singIn.php">Sing In</a> to leave a comment.</p>
        <?php endif; ?>

        <div class="comment-list">
            <?php while ($comment = $comments_result->fetch_assoc()): ?>
                <div class="comment">
                    <strong><?= htmlspecialchars($comment['username']) ?></strong> 
                    <em><?= date('F d, Y H:i', strtotime($comment['created_at'])) ?></em>
                    <p><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>
