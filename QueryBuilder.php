<?php

class QueryBuilder
{
    public static string $table = '';
    private static string $host = 'localhost';
    private static string $user = 'root';
    private static string $password = '';
    private static string $database = 'backendproject';
    private static $connection = null;

    public static function connect()
    {
        if (self::$connection === null) {
            try {
                self::$connection = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$database,
                    self::$user,
                    self::$password
                );
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Bağlantı xətası: " . $e->getMessage();
                exit;
            }
        }
        return self::$connection;
    }

    public static function find($id)
    {
        $db = self::connect();
        $sql = "SELECT * FROM " . self::$table . " WHERE id = :id";
        $query = $db->prepare($sql);
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public static function findByName($name)
    {
        $db = self::connect();
        $sql = "SELECT * FROM " . self::$table . " WHERE name = :name";
        $query = $db->prepare($sql);
        $query->execute(['name' => $name]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
?>
