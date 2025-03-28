<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Error: You must be logged in.");
}

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "dota_stat";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $author_id = $_SESSION['user_id'];

    if (!empty($_FILES['image']['name'])) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $imageName = time() . "_" . basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $imageName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            $img_url = $targetFilePath;
        } else {
            die("Image upload error.");
        }
    } else {
        die("Image is required.");
    }

    $sql = "INSERT INTO news (title, img_url, content, author_id) 
            VALUES ('$title', '$img_url', '$content', '$author_id')";

    if ($conn->query($sql) === TRUE) {
        echo "News added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add News</title>
    <script src="https://cdn.tiny.cloud/1/noaqx1hqwceye6a1vahwgtd06tnay4g5k5rst7iw5q5y37l6/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#content',
            plugins: 'advlist autolink lists link image charmap print preview anchor',
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
            menubar: false
        });
    </script>
</head>
<body>

<h2>Add News</h2>
<form method="post" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Title" required><br>
    <textarea id="content" name="content" placeholder="News content" required></textarea><br>
    <input type="file" name="image" required><br>
    <button type="submit">Add News</button>
</form>

</body>
</html>