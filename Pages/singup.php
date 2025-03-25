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
                    <input type="text" name="username" placeholder="Username" required>
                </div>
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
                    <a href="singIn.php">SingIn</a>
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
    die("Error: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $check_stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        echo "Account with this email already exists!";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (password_hash, username, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $password_hash, $username, $email);

        if ($stmt->execute()) {
            
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $check_stmt->close();
}



$conn->close();
?>