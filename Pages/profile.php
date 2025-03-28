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
                    <a href="logOut.php">Log out</a>
                </div>
            </div>
        </div>
    </header>
    <div class="main">
        <div class="info">
            <div class="user_info">
                <h4>Username: </h4>
                <p><?php echo htmlspecialchars($_SESSION['username']); ?></p>
                <a href="update_username.php">Update</a>
            </div>
            <h4>Email: </h4>
            <p><?php echo $_SESSION['email']; ?></p>
        </div>
        <form method="post">
            <div class="delete">
                <input type="submit" name="delete" value="Delete">
            </div>
        </form>
    </div>
</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dota_stat";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "DELETE FROM users WHERE id=$user_id";
    echo $user_id;

    if ($conn->query($sql) === true) {
        session_destroy();
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
    }

?>