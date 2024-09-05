<?php
require_once 'QueryBuilder.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';

    if (!empty($title) && !empty($content)) {
       
        $data = [
            'title' => $title,
            'content' => $content,
        ];

        $db = QueryBuilder::connect();
        $sql = "INSERT INTO blogs (title, content) VALUES (:title, :content)";
        $query = $db->prepare($sql);
        $query->execute($data);
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yeni Blog Əlavə Et</title>
</head>
<body>

<h1>Yeni Blog Əlavə Et</h1>

<form action="add_blog.php" method="POST">
    <label for="title">Başlıq:</label>
    <input type="text" id="title" name="title" required>
    <br>
    <label for="content">Məzmun:</label>
    <textarea id="content" name="content" rows="4" required></textarea>
    <br>
    <button type="submit">Əlavə et</button>
</form>

<a href="index.php">Geri dön</a>

</body>
</html>
