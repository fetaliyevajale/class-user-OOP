<?php
require_once 'QueryBuilder.php';

$blogId = $_GET['id'] ?? null;

if ($blogId) {
    $db = QueryBuilder::connect();
    $sql = "DELETE FROM blogs WHERE id = :id";
    $query = $db->prepare($sql);
    $query->execute(['id' => $blogId]);

    echo "Blog silindi!";
    header('Location: index.php');
    exit;
} else {
    echo "Blog ID mövcud deyil.";
}
?>
