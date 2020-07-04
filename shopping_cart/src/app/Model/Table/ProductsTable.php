<?php
require dirname(__DIR__) . '/Entity/Product.php';

class ProductsTable {
    protected $db;

    function __construct(PDO $db)
    {
        $this->db = $db;
    }

    function getCountOfItems() {
        $query = 'SELECT COUNT(*) FROM products';
        $result = $this->db->query($query);
        return $result->fetchColumn();
    }

    function getPaginatedItems($page = 1, $items_per_page = 9) {
        $page = $page * $items_per_page - $items_per_page;

        $query = "SELECT * FROM products LIMIT $page, $items_per_page";
        $result = $this->db->query($query);
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

    function getFeaturedItems() {
        // $query = 'SELECT * FROM products WHERE isFeatured = 1';
        $query = 'SELECT * FROM products LIMIT 3';
        $result = $this->db->query($query);
        $products = array();
        foreach ($result as $row) {
            $product = new Product($row);
            $products[] = $product;
        }
        return $products;
    }

    function getItemByCode($code) {
        $query = "SELECT * FROM products
                  WHERE productCode = '$code'";
        $result = $this->db->query($query);
        $row = $result->fetch();
        
        if (empty($row)) {
            throw new Exception('Item not found!');
        }
        
        $product = new Product($row);
        return $product;
    }
}