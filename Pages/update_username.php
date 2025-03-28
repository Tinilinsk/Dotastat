<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: singIn.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/singInStyle.css">
    <title>Document</title>
</head>
<body>
    <div class="ring">
        <i></i>
        <i></i>
        <i></i>
        <div class="contact">
            <h2>Change username</h2>
            <form action="<?php echo htmlspecialchars(string: $_SERVER['PHP_SELF']); ?>" method="post">
                <div class="InputBx">
                    <input type="text" name="old_username" placeholder="Old username" required>
                </div>
                <div class="InputBx">
                    <input type="text" name="new_username" placeholder="New username" required>
                </div>
                <div class="InputBx">
                    <input type="submit" value="Send">
                </div>
                <div class="links">
                    <a href="index.php">Home</a>
                    <a href="profile.php">Profile</a>
                </div>
            </form>
        </div>
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
    die("Connection error: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $old_username = $_POST['old_username'];
    $new_username = $_POST['new_username'];

    $result = $conn->query("SELECT username FROM users WHERE id = $user_id");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['username'] == $old_username) {
            $sql = "UPDATE users SET username='$new_username' WHERE id=$user_id"; 
            if ($conn->query($sql) === TRUE) {
                $_SESSION['username'] = $new_username;
                header("Location: profile.php");
                exit();
                } else {
                    echo "Error changing username: " . $conn->error;
                    }
    }

}
}

    

$conn->close();
?>