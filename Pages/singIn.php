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
            <form action="#" method="post">
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
    die("Error connect: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $username, $hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        echo "Error: Incorrect password!";
    }
} else {
    echo "Error: User not found!";
}

$stmt->close();
$conn->close();
?>