<?php
class ProductDB {
    public static function getProducts() {
        $db = Database::getDB();
        $query = 'SELECT * FROM products
                  INNER JOIN categories
                      ON products.categoryID = categories.categoryID';
        $result = $db->query($query);
        $products = array();
        foreach ($result as $row) {
            $category = new Category($row['categoryID'],
                                     $row['categoryName']);
            $product = new Product($category,
                                   $row['productCode'],
                                   $row['productName'],
                                   $row['listPrice']);
            $product->setId($row['productID']);
            $products[] = $product;
        }
        return $products;
    }

    public static function getProductsByCategory($category_id) {
        $db = Database::getDB();

        $category = CategoryDB::getCategory($category_id);

        $query = "SELECT * FROM products
                  WHERE categoryID = '$category_id'
                  ORDER BY productID";
        $result = $db->query($query);
        $products = array();
        foreach ($result as $row) {
            $product = new Product($category,
                                   $row['productCode'],
                                   $row['productName'],
                                   $row['listPrice']);
            $product->setId($row['productID']);
            $products[] = $product;
        }
        return $products;
    }

    public static function getProduct($product_id) {
        $db = Database::getDB();
        $query = "SELECT * FROM products
                  WHERE productID = '$product_id'";
        $result = $db->query($query);
        $row = $result->fetch();
        $category = CategoryDB::getCategory($row['categoryID']);
        $product = new Product($category,
                               $row['productCode'],
                               $row['productName'],
                               $row['listPrice']);
        $product->setID($row['productID']);
        return $product;
    }

    public static function deleteProduct($product_id) {
        $db = Database::getDB();
        $query = "DELETE FROM products
                  WHERE productID = '$product_id'";
        $row_count = $db->exec($query);
        return $row_count;
    }

    public static function addProduct($product) {
        $db = Database::getDB();

        $category_id = $product->getCategory()->getID();
        $code = $product->getCode();
        $name = $product->getName();
        $price = $product->getPrice();

        $query =
            "INSERT INTO products
                 (categoryID, productCode, productName, listPrice)
             VALUES
                 ('$category_id', '$code', '$name', '$price')";

        $row_count = $db->exec($query);
        return $row_count;
    }
}
?>