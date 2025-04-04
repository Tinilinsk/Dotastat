<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dota_stat";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Database connection error: " . $conn->connect_error);
}

$sql = "SELECT news.id, news.title, news.img_url, news.created_at, users.username 
        FROM news 
        LEFT JOIN users ON news.author_id = users.id 
        ORDER BY news.created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../Style/newsStyle.css">
    <title>Dota Stat</title>
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
                </a> 
                </div>
                <div class="navigation_item">
                    <ul class="navigation_list" style="list-style-type: none;">
                        <li><a href="heroes.php">Heroes</a></li>
                        <li><a href="items.php">Items</a></li>
                        <li><a href="">Players</a></li>
                        <li><a href="">Matches</a></li>
                        <li><a href="news.php">News</a></li>
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
    <div class="main">
        <h1>The Dotastat News</h1>
        <div class="add_news">
            <a href="add_news.php">Add News</a>
        </div>
        <div class="news_list">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="news_item">
                    <a href="news_detail.php?id=<?= $row['id'] ?>">
                        <h2><?= htmlspecialchars($row['title']) ?></h2>
                        <img src="<?= htmlspecialchars($row['img_url']) ?>" alt="<?= htmlspecialchars($row['title']) ?>">
                    </a>
                    <p>By <?= htmlspecialchars($row['username'] ?? 'Unknown') ?> on <?= strftime('%B %d %Y', strtotime($row['created_at'])) ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
