<?php
require_once 'QueryBuilder.php';

$blogId = $_GET['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    if ($blogId) {
        $db = QueryBuilder::connect();
        $sql = "UPDATE blogs SET title = :title, content = :content WHERE id = :id";
        $query = $db->prepare($sql);
        $query->execute([
            'title' => $title,
            'content' => $content,
            'id' => $blogId
        ]);

        echo "Blog yeniləndi!";
        header('Location: index.php');
        exit;
    }
} else if ($blogId) {
    $db = QueryBuilder::connect();
    $sql = "SELECT * FROM blogs WHERE id = :id";
    $query = $db->prepare($sql);
    $query->execute(['id' => $blogId]);
    $blog = $query->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogu Redaktə Et</title>
</head>
<body>

<h1>Blogu Redaktə Et</h1>

<form action="edit_blog.php?id=<?php echo htmlspecialchars($blogId); ?>" method="post">
    <label for="title">Başlıq:</label>
    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($blog['title']); ?>" required><br>
    <label for="content">Məzmun:</label>
    <textarea id="content" name="content" rows="4" cols="50" required><?php echo htmlspecialchars($blog['content']); ?></textarea><br>
    <button type="submit">Yenilə</button>
</form>

</body>
</html>
