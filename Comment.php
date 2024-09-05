<?php
require_once 'QueryBuilder.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $blogId = $_POST['blog_id'];
    $content = $_POST['content'];


    $db = QueryBuilder::connect();
    $sql = "INSERT INTO comments (blog_id, content) VALUES (:blog_id, :content)";
    $query = $db->prepare($sql);
    $query->execute([
        'blog_id' => $blogId,
        'content' => $content
    ]);

    echo "Şərh əlavə olundu!";
}
?>
