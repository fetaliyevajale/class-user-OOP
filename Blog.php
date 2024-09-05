<?php

require_once 'QueryBuilder.php';

class Blog
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getComments()
    {
        $db = QueryBuilder::connect();
        $sql = "SELECT * FROM comments WHERE blog_id = :blog_id";
        $query = $db->prepare($sql);
        $query->execute(['blog_id' => $this->id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
