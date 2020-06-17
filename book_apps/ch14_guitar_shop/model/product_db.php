<?php
class ProductDB {
    public static function getProductsByCategory($category_id) {
        $db = Database::getDB();

        $category = CategoryDB::getCategory($category_id);

        $query = 'SELECT * FROM products
                  WHERE products.categoryID = :category_id
                  ORDER BY productID';
        $statement = $db->prepare($query);
        $statement->bindValue(":category_id", $category_id);
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();
    
        foreach ($rows as $row) {
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
        $query = 'SELECT * FROM products
                  WHERE productID = :product_id';
        $statement = $db->prepare($query);
        $statement->bindValue(":product_id", $product_id);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();
    
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
        $query = 'DELETE FROM products
                  WHERE productID = :product_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':product_id', $product_id);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function addProduct($product) {
        $db = Database::getDB();

        $category_id = $product->getCategory()->getID();
        $code = $product->getCode();
        $name = $product->getName();
        $price = $product->getPrice();

        $query = 'INSERT INTO products
                     (categoryID, productCode, productName, listPrice)
                  VALUES
                     (:category_id, :code, :name, :price)';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->bindValue(':code', $code);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':price', $price);
        $statement->execute();
        $statement->closeCursor();
    }
}
?>