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
            <h2>Sing In</h2>
            <form action="<?php echo htmlspecialchars(string: $_SERVER['PHP_SELF']); ?>" method="post">
                <div class="InputBx">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="InputBx">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="InputBx">
                    <input type="submit" value="Send">
                </div>
                <div class="links">
                    <a href="index.php">Home</a>
                    <a href="singup.php">SingUp</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<?php
session_start();
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "dota_stat"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT id, username, user_password FROM users WHERE email = '$email'");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($password == $row['user_password']) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            // echo "Login successful!";
            header("Location: index.php");
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "User not found!";
    }

}

    

$conn->close();
?>