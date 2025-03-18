<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../Style/heroesStyle.css">
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
                        <a href="">Heroes</a>
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
                    <button>Sing In</button>
                </div>
            </div>
        </div>
    </header>
    <div class="main">
        <div class="text">
            <h1>Hero facet stats</h1>
            <h2>Explore the meta trends for all heroes and facets in Dota 2. 
                Filter by position, rank, game mode, and date range to see the most popular heroes and how they perform.</h2>
        </div>
        <div class="switchers">
            <div class="switch-container">
                <input type="radio" id="option1" name="option" checked>
                <label for="option1" class="switch-option">All Pick</label>

                <input type="radio" id="option2" name="option">
                <label for="option2" class="switch-option">Turbo</label>
            </div>
        </div>
    </div>
</body>
</html>