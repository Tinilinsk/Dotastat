<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../Style/profileStyle.css">
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
                        <a href="">News</a>
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
                    <a href="logOut.php">Log out</a>
                </div>
            </div>
        </div>
    </header>
    <div class="main">
        <div class="info">
            <h4>Username: </h4>
            <p><?php echo htmlspecialchars($_SESSION['username']); ?></p>
            <h4>Email: </h4>
            <p><?php echo $_SESSION['email']; ?></p>
        </div>
    </div>
</body>
</html>