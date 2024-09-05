<?php
require_once 'QueryBuilder.php';


$commentId = $_GET['id'] ?? null;

if ($commentId) {
    $db = QueryBuilder::connect();
    $sql = "DELETE FROM comments WHERE id = :id";
    $query = $db->prepare($sql);
    $query->execute(['id' => $commentId]);

    echo "Şərh silindi!";
    header('Location: index.php');
    exit;
} else {
    echo "Şərh ID mövcud deyil.";
}
?>
