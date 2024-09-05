<?php

require_once 'QueryBuilder.php';

class User
{
    private int $id;
    
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getBlogs()
    {
        $db = QueryBuilder::connect();
        $sql = "SELECT * FROM blogs WHERE user_id = :user_id"; 
        $query = $db->prepare($sql);
        $query->execute(['user_id' => $this->id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
