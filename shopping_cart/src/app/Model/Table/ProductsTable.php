<?php
// require dirname(__DIR__) . '/Entity/Product.php';

class ProductsTable {
    // protected $db;

    // function __construct(PDO $db)
    // {
    //     $this->db = $db;
    // }

    public static function getCountOfItems() {
        $db = Database::getDB();
        $query = 'SELECT COUNT(*) FROM products';
        $result = $db->query($query);
        return $result->fetchColumn();
    }

    public static function getPaginatedItems($page = 1, $items_per_page = 9) {
        $db = Database::getDB();
        $page = $page * $items_per_page - $items_per_page;

        $query = "SELECT * FROM products LIMIT $page, $items_per_page";
        $result = $db->query($query);
        $products = array();
        foreach ($result as $row) {
            $product = new Product($row);
            $products[] = $product;
        }

        if (empty($products)) {
            throw new Exception('No items found!');
        }

        return $products;
    }

    public static function getFeaturedItems() {
        $db = Database::getDB();
        // $query = 'SELECT * FROM products WHERE isFeatured = 1';
        $query = 'SELECT * FROM products LIMIT 3';
        $result = $db->query($query);
        $products = array();
        foreach ($result as $row) {
            $product = new Product($row);
            $products[] = $product;
        }
        return $products;
    }

    public static function getItemByCode($code) {
        $db = Database::getDB();
        $query = "SELECT * FROM products
                  WHERE productCode = '$code'";
        $result = $db->query($query);
        $row = $result->fetch();
        
        if (empty($row)) {
            throw new Exception('Item not found!');
        }
        
        $product = new Product($row);
        return $product;
    }

    public static function getItem($productID) {
        $db = Database::getDB();
        $query = "SELECT * FROM products
                  WHERE productID = '$productID'";
        $result = $db->query($query);
        $row = $result->fetch();
        
        if (empty($row)) {
            throw new Exception('Item not found!');
        }
        
        $product = new Product($row);
        return $product;
    }
}