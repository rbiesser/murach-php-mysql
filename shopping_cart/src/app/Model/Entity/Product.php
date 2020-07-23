<?php
class Product
{
    private $productID;
    private $code;
    private $artwork;
    private $name;
    private $description;
    private $price;
    private $dateAdded;

    function __construct($product)
    {
        $this->productID = $product['productID'];
        $this->code = $product['productCode'];
        $this->name = $product['productName'];
        $this->description = $product['description'];
        $this->price = $product['listPrice'];
        $this->artwork = '/img/placeholder.png';
    }

    function getProductID() {
        return $this->productID;
    }

    function getCode() {
        return $this->code;
    }

    function getArtwork() {
        return $this->artwork;
    }

    function getName() {
        return $this->name;
    }

    function getDescription() {
        return $this->description;
    }

    function getPrice() {
        return $this->price;
    }

    function validate() {
        return true;
    }
}
