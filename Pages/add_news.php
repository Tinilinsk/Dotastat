<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить новость</title>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
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

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "your_database");

    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);

    if ($_FILES['image']['error'] == 0) {
        $imagePath = 'uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    } else {
        die("Ошибка загрузки изображения.");
    }

    $sql = "INSERT INTO news (title, content, image) VALUES ('$title', '$content', '$imagePath')";

    if ($conn->query($sql) === TRUE) {
        echo "Новость добавлена!";
    } else {
        echo "Ошибка: " . $conn->error;
    }

    $conn->close();
}
?>

<form method="post" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Заголовок" required><br>
    <textarea id="content" name="content" placeholder="Текст новости" required></textarea><br>
    <input type="file" name="image" required><br>
    <button type="submit">Добавить новость</button>
</form>

</body>
</html>
