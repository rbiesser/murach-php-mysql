<?php
class Database {
    private static $dsn = 'mysql:host=db;dbname=shopping_cart';
    private static $username = 'user';
    private static $password = 'pa55word';
    private static $db;

    private function __construct() {}

    public static function getDB () {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn,
                                     self::$username,
                                     self::$password);
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                // include('../errors/database_error.php');
                echo $error_message;
                exit();
            }
        }
        return self::$db;
    }
}