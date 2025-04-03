<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dota_stat";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error: " . $conn->connect_error);
}

$sql = "SELECT id, title, img_url FROM news ORDER BY created_at DESC LIMIT 4";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../Style/style.css">
    <title>Dota Stat</title>
</head>
<body class="container">
    <header>
        <div class="header_menu">
            <div class="navigation_menu">
                <div class="logo">
                    <a href="index.php">
                        <span>DOTASTAT</span>
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
    <div class="main">
        <div class="news_section">
        <h2>Latest News</h2>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="news_item">
                    <a href="news_detail.php?id=<?php echo $row['id']; ?>">
                        <img src="<?php echo htmlspecialchars($row['img_url']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                        <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="side_section">
            <div class="top_players">
                <h2>Top Players</h2>
                <div class="player_item">Player 1</div>
                <div class="player_item">Player 2</div>
                <div class="player_item">Player 3</div>
            </div>
            <div class="top_heroes">
                <h2>Top Heroes</h2>
                <div class="hero_item">Hero 1</div>
                <div class="hero_item">Hero 2</div>
                <div class="hero_item">Hero 3</div>
            </div>
        </div>
    </div>
</body>
</html>